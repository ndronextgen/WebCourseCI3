<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('keluarga_model', 'tbl_data_keluarga');
		$this->load->model('arsip_pribadi_model');
		$this->load->library('func_table');
	}

	public function keluarga_datatables()
	{ 
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_keluarga->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = $no;

			if ($r->hub_keluarga !== '1') {
				// === deskripsi hubungan keluarga, dari tabel master hubungan keluarga ===
				$rsSQL = $this->db->select('keterangan')->get_where('tbl_master_hubungan_keluarga', array('kode' => $r->hub_keluarga));

				if ($rsSQL->num_rows() > 0) {
					$hub_kel_desc = $rsSQL->row()->keterangan;
				} else {
					$hub_kel = '-';
					goto skip_hubkel;
				}
				$hub_kel_desc = $rsSQL->row()->keterangan;
				$hub_kel = $hub_kel_desc;
			} else {
				// === jenis kelamin dari tabel pegawai ===
				$rsSQL = $this->db->select('jenis_kelamin')->get_where('tbl_data_pegawai', array('id_pegawai' => $r->id_pegawai));

				if ($rsSQL->num_rows() > 0) {
					$jen_kel = strtolower($rsSQL->row()->jenis_kelamin);
				} else {
					$jen_kel = '-';
				}

				if ($jen_kel == 'laki-laki') {
					$hub_kel = 'Istri';
				} elseif ($jen_kel == 'perempuan') {
					$hub_kel = 'Suami';
				} else {
					$hub_kel = 'Istri / Suami';
				}
			}
			skip_hubkel: $row[] = $hub_kel;

			$row[] = $r->nama_anggota_keluarga;

			if ($r->jenis_kelamin == '1') {
				$row[] = "Laki-Laki";
			} elseif ($r->jenis_kelamin == '2') {
				$row[] = "Perempuan";
			} else {
				$row[] = "-";
			}

			$row[] = date_format(date_create($r->tanggal_lahir_keluarga), 'j M Y');
			$row[] = $r->uraian;

			// === begin: cek file exist ===
			$this->db->select('id_arsip_pribadi, id_data_keluarga, file_name_ori, `file_name`');
			$data_arsip = $this->db->get_where('tbl_arsip_pribadi', array('id_data_keluarga' => $r->id_data_keluarga));
			// === end: cek file exist ===

			// === begin: kolom "file" === 
			$file = '-';
			if ($data_arsip->num_rows() > 0) {
				$data_arsip 	= $data_arsip->row();
				$path_folder 	= 'asset/upload/pribadi/pribadi_' . $data_arsip->id_data_keluarga . '_' . $data_arsip->id_arsip_pribadi;
				$path_file		= $path_folder . '/' . $data_arsip->file_name;
				$is_file_exist 	= file_exists($path_file);

				if ($is_file_exist) {
					$file = $this->func_table->get_file($path_file, $data_arsip->file_name_ori);
				}
			}
			$row[] = $file;
			// === end: kolom "file" ===

			$button = ' <a class="btn btn-sm btn-success" href="javascript:void(0);" title="lihat detail" onclick="detail_keluarga(' . "'" . $r->id_data_keluarga . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_keluarga(' . "'" . $r->id_data_keluarga . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_keluarga(' . "'" . $r->id_data_keluarga . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			if ($file !== '-') {
				$button .=	'&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="keluarga" data-id="' . utf8_encode($data_arsip->id_arsip_pribadi) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';
			}
			$row[] = $button;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_keluarga->count_all($id),
			"recordsFiltered" => $this->tbl_data_keluarga->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function keluarga_edit($id_data_keluarga)
	{
		$data = $this->tbl_data_keluarga->get_by_id($id_data_keluarga);
		// $data->tanggal_lahir_keluarga = ($data->tanggal_lahir_keluarga == '00-00-0000') ? '' : $data->tanggal_lahir_keluarga; // if 0000-00-00 set tu empty for datepicker compatibility

		$data->tanggal_lahir_keluarga = date_format(date_create($data->tanggal_lahir_keluarga), 'd M yyyy');
		$data->tanggal_nikah = ($data->tanggal_nikah == null) ? '' : date_format(date_create($data->tanggal_nikah), 'd M yyyy');

		$data->arsip = $this->tbl_data_keluarga->get_arsip_by_id_ref($id_data_keluarga);
		echo json_encode($data);
	}

	public function keluarga_add()
	{
		$response = array('status' => true);
		$validate_keluarga = $this->_validate_keluarga();

		$data = array(
			'hub_keluarga' 				=> $this->input->post('hub_keluarga'),
			'uraian' 					=> ($this->input->post('uraian') == '') ? null : $this->input->post('uraian'),
			'nama_anggota_keluarga' 	=> $this->input->post('nama_anggota_keluarga'),
			'jenis_kelamin' 			=> $this->input->post('jenis_kelamin'),
			'tempat_lahir' 				=> $this->input->post('tempat_lahir_anggota_keluarga'),
			'tanggal_lahir_keluarga' 	=> date('Y-m-d', strtotime($this->input->post('tanggal_lahir_keluarga'))),
			'agama' 					=> $this->input->post('agama'),
			'agama_lainnya' 			=> ($this->input->post('agama_lainnya') == '') ? null : $this->input->post('agama_lainnya'),
			'alamat' 					=> ($this->input->post('txt_alamat') == '') ? null : $this->input->post('txt_alamat'),
			'alamat_sdp' 				=> ($this->input->post('chk_alamat') == '') ? null : $this->input->post('chk_alamat'),
			'tempat_nikah' 				=> ($this->input->post('tempat_nikah_anggota_keluarga') == '') ? null : $this->input->post('tempat_nikah_anggota_keluarga'),
			'tanggal_nikah' 			=> ($this->input->post('tanggal_pernikahan_keluarga') == '') ? null : date('Y-m-d', strtotime($this->input->post('tanggal_pernikahan_keluarga'))),
			'pns_nonpns' 				=> ($this->input->post('hub_keluarga') !== '1') ? 0 : $this->input->post('opt_pns'),
			'nik' 						=> ($this->input->post('nik_anggota_keluarga') == '') ? null : $this->input->post('nik_anggota_keluarga'),
			'pekerjaan_sekolah' 		=> ($this->input->post('pekerjaan_anggota_keluarga') == '') ? null : $this->input->post('pekerjaan_anggota_keluarga'),
			'pangkat_golongan' 			=> ($this->input->post('pangkat_golongan') == '' or $this->input->post('opt_pns') == 2) ? null : $this->input->post('pangkat_golongan'),

			'id_pegawai' => $this->session->userdata('id_pegawai')
		);

		if ($validate_keluarga['status'] == true) {
			$insert_id = $this->tbl_data_keluarga->save($data);
			
			if ($insert_id) {
				if ($_FILES['arsipPribadi_file']['name'] != '') {
					$ins = [
						'id_data_keluarga' => $insert_id,
						'title' => $this->input->post('arsipPribadi_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pribadi', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_keluarga->update_arsip(
							['id_arsip_pribadi' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_keluarga->delete_arsip($id_arsip);

						//delete tabel riwayat pangkat
						$this->tbl_data_keluarga->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/pribadi/pribadi_' . $insert_id . '_' . $id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		} else {
			$response = $validate_keluarga;
		}

		echo json_encode($response);
	}

	public function keluarga_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_data_keluarga');
		$validate_keluarga = $this->_validate_keluarga();

		if ($validate_keluarga['status'] == true) {

			$data = array(
				'hub_keluarga' 				=> $this->input->post('hub_keluarga'),
				'uraian' 					=> ($this->input->post('uraian') == '') ? null : $this->input->post('uraian'),
				'nama_anggota_keluarga' 	=> $this->input->post('nama_anggota_keluarga'),
				'jenis_kelamin' 			=> $this->input->post('jenis_kelamin'),
				'tempat_lahir' 				=> $this->input->post('tempat_lahir_anggota_keluarga'),
				'tanggal_lahir_keluarga' 	=> date('Y-m-d', strtotime($this->input->post('tanggal_lahir_keluarga'))),
				'agama' 					=> $this->input->post('agama'),
				'agama_lainnya' 			=> ($this->input->post('agama_lainnya') == '') ? null : $this->input->post('agama_lainnya'),
				'alamat' 					=> ($this->input->post('txt_alamat') == '') ? null : $this->input->post('txt_alamat'),
				'alamat_sdp' 				=> ($this->input->post('chk_alamat') == '') ? null : $this->input->post('chk_alamat'),
				'tempat_nikah' 				=> ($this->input->post('tempat_nikah_anggota_keluarga') == '') ? null : $this->input->post('tempat_nikah_anggota_keluarga'),
				'tanggal_nikah' 			=> ($this->input->post('tanggal_pernikahan_keluarga') == '') ? null : date('Y-m-d', strtotime($this->input->post('tanggal_pernikahan_keluarga'))),
				'pns_nonpns' 				=> ($this->input->post('hub_keluarga') !== '1') ? 0 : $this->input->post('opt_pns'),
				'nik' 						=> ($this->input->post('nik_anggota_keluarga') == '') ? null : $this->input->post('nik_anggota_keluarga'),
				'pekerjaan_sekolah' 		=> ($this->input->post('pekerjaan_anggota_keluarga') == '') ? null : $this->input->post('pekerjaan_anggota_keluarga'),
				'pangkat_golongan' 			=> ($this->input->post('pangkat_golongan') == '' or $this->input->post('opt_pns') == 2) ? null : $this->input->post('pangkat_golongan'),

				'id_pegawai' => $this->session->userdata('id_pegawai'),
			);

			$this->tbl_data_keluarga->update(array('id_data_keluarga' => $id), $data);

			if ($_FILES['arsipPribadi_file']['name'] != '') {
				$fileOld = $this->tbl_data_keluarga->get_arsip_by_id_ref($id);
				if (!empty($fileOld)) {
					$ins = [
						'id_data_keluarga' => $id,
						'title' => $this->input->post('arsipPribadi_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pribadi', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_keluarga->update_arsip(
							['id_arsip_pribadi' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/pribadi/pribadi_' . $fileOld->id_data_keluarga . '_' . $fileOld->id_arsip_pribadi;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						//delete arsip table
						$this->tbl_data_keluarga->delete_arsip($fileOld->id_arsip_pribadi);
					} else {
						//delete tabel arsip
						$this->tbl_data_keluarga->delete_arsip($id_arsip);

						//delete tabel riwayat pangkat
						$this->tbl_data_keluarga->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/pribadi/pribadi_' . $id_arsip . '_' . $id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipPribadi_file']['name'] != '') {
						$ins = [
							'id_data_keluarga' => $id,
							'title' => $this->input->post('arsipPribadi_title'),
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
							'created_at' => date('Y-m-d H:i:s')
						];

						//insert into arsip
						$this->db->insert('tbl_arsip_pribadi', $ins);
						$id_arsip = $this->db->insert_id();

						$validate_arsip = $this->_do_upload($id_arsip, $id);
						if ($validate_arsip['status'] == true) {
							//update filename
							$this->tbl_data_keluarga->update_arsip(
								['id_arsip_pribadi' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							$response = $validate_arsip;
							//delete tabel arsip
							$this->tbl_data_keluarga->delete_arsip($id_arsip);

							//delete tabel data pribadi
							$this->tbl_data_keluarga->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/pribadi/pribadi_' . $id_arsip . '_' . $id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_keluarga;
		}

		echo json_encode($response);
	}

	public function keluarga_delete($id_data_keluarga)
	{
		//delete data keluarga
		$this->tbl_data_keluarga->delete_by_id($id_data_keluarga);

		//delete arsip file
		$path = './asset/upload/pribadi/pribadi' . $id_data_keluarga;

		if (is_dir($path)) {
			delete_files($path, true);
			rmdir($path);
		}

		//delete table arsip
		$this->db->delete('tbl_arsip_pribadi', ['id_data_keluarga' => $id_data_keluarga]);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate_keluarga()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('hub_keluarga') == '0X') {
			$data['inputerror'][] = 'hub_keluarga';
			$data['error_string'][] = 'Hubungan Keluarga wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('hub_keluarga') == '0') {
			if ($this->input->post('uraian') == '') {
				$data['inputerror'][] = 'uraian';
				$data['error_string'][] = 'Keterangan wajib diisi';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('nama_anggota_keluarga') == '') {
			$data['inputerror'][] = 'nama_anggota_keluarga';
			$data['error_string'][] = 'Nama wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tempat_lahir_anggota_keluarga') == '') {
			$data['inputerror'][] = 'tempat_lahir_anggota_keluarga';
			$data['error_string'][] = 'Tempat Lahir wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_lahir_keluarga') == '') {
			$data['inputerror'][] = 'tanggal_lahir_keluarga';
			$data['error_string'][] = 'Tanggal Lahir wajib di isi.';
			$data['status'] = FALSE;
		}

		if ($this->input->post('agama') == '0X') {
			$data['inputerror'][] = 'agama';
			$data['error_string'][] = 'Agama wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('agama') == '0') {
			if ($this->input->post('agama_lainnya') == '') {
				$data['inputerror'][] = 'agama_lainnya';
				$data['error_string'][] = 'Agama Lainnya wajib diisi';
				$data['status'] = FALSE;
			}
		}

		// ==================================================

		if ($this->input->post('txt_alamat') == null) {
			$data['inputerror'][] = 'txt_alamat';
			$data['error_string'][] = 'Alamat wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('hub_keluarga') == 1) {
			if ($this->input->post('tempat_nikah_anggota_keluarga') == '') {
				$data['inputerror'][] = 'tempat_nikah_anggota_keluarga';
				$data['error_string'][] = 'Tempat Nikah wajib diisi';
				$data['status'] = FALSE;
			}


			if ($this->input->post('tanggal_pernikahan_keluarga') == '') {
				$data['inputerror'][] = 'tanggal_pernikahan_keluarga';
				$data['error_string'][] = 'Tanggal Nikah wajib di isi.';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('hub_keluarga') == 1 or $this->input->post('hub_keluarga') == 2) {
			if ($this->input->post('nik_anggota_keluarga') == '') {
				$data['inputerror'][] = 'nik_anggota_keluarga';
				$data['error_string'][] = 'NIK wajib diisi.';
				$data['status'] = FALSE;
			}

			if ($this->input->post('pekerjaan_anggota_keluarga') == '') {
				// 
				$data['inputerror'][] = 'pekerjaan_anggota_keluarga';
				$data['status'] = FALSE;
				if ($this->input->post('hub_keluarga') == 2) {
					$data['error_string'][] = 'Pekerjaan / Sekolah wajib diisi.';
				} else {
					if ($this->input->post('opt_pns') == 1) {
						$data['error_string'][] = 'Jabatan / Pekerjaan wajib diisi.';
					} else if ($this->input->post('opt_pns') == 2) {
						$data['error_string'][] = 'Pekerjaan wajib diisi.';
					}
				}
			}
		}

		if ($this->input->post('opt_pns') == 1) {
			if ($this->input->post('pangkat_golongan') == '') {
				$data['inputerror'][] = 'pangkat_golongan';
				$data['error_string'][] = 'Pangkat / Golongan wajib diisi.';
				$data['status'] = FALSE;
			}
		}

		// ==================================================

		if ($_FILES['arsipPribadi_file']['name'] !== '') {
			if ($this->input->post('arsipPribadi_title') == '') {
				$data['inputerror'][] = 'arsipPribadi_title';
				$data['error_string'][] = 'Nama File wajib di isi';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('hub_keluarga') == 1) {
			// if ($_FILES['arsipPribadi_file']['name'] == '') {
			// 	$data['inputerror'][] = 'arsipPribadi_file';
			// 	$data['error_string'][] = 'Wajib upload Akta Nikah';
			// 	$data['status'] = FALSE;
			// }
		}

		return $data;
	}

	private function _do_upload($id, $id_ref = 0)
	{
		$dir = "pribadi_" . $id_ref . '_' . $id;
		$config['upload_path']          = './asset/upload/pribadi/' . $dir;
		$config['allowed_types']        = 'pdf|jpg|png';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		$this->load->library('upload', $config);

		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;

		if ($_FILES['arsipPribadi_file']['name'] != '') {
			$name = time() . str_replace(' ', '', $_FILES['arsipPribadi_file']['name']);
			$_FILES['arsipPribadi_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipPribadi_file')) ||  $_FILES['arsipPribadi_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipPribadi_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipPribadi_file']['name'];
			}
		}

		return $data;
	}

	public function download($id)
	{
		$id = utf8_encode($id);

		if ($id == "") {
			ob_start();
			echo "<script>alert('Gagal download file')</script>";
		} else {
			$data = $this->tbl_data_keluarga->get_arsip_by_id($id);
			$file_name_ori = $data->file_name_ori;
			$file_name = $data->file_name;
			$id_data_keluarga = $data->id_data_keluarga;
			$dir = "pribadi_" . $id_data_keluarga . "_" . $id;
			$path = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $file_name); // letak file pada aplikasi kita
			force_download($file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_keluarga->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/pribadi/pribadi_' . $data->id_ref . '_' . $data->id_arsip_pribadi;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			if (!$this->db->delete('tbl_arsip_pribadi', ['id_arsip_pribadi' => $id])) {
				$status = false;
			}
		} else {
			$status = false;
		}

		$response = ['status' => $status];
		echo json_encode($response);
	}

	public function keluarga_list($id)
	{
		$this->db->select('
			tbl_data_keluarga.id_data_keluarga, tbl_data_keluarga.nama_anggota_keluarga, tbl_data_keluarga.tanggal_lahir_keluarga, 
			tbl_data_keluarga.jenis_kelamin, tbl_data_keluarga.hub_keluarga, tbl_data_keluarga.uraian, 
			tbl_arsip_pribadi.id_arsip_pribadi, tbl_arsip_pribadi.file_name_ori, tbl_arsip_pribadi.file_name
		');
		$this->db->from('tbl_data_keluarga');
		$this->db->join('tbl_arsip_pribadi', 'tbl_arsip_pribadi.id_data_keluarga = tbl_data_keluarga.id_data_keluarga', 'left');
		$this->db->where('tbl_data_keluarga.id_pegawai', $id);

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function keluarga_delete_arsip($id_data_keluarga, $id_arsip_pribadi)
	{
		$status = true;

		//delete data keluarga
		$this->tbl_data_keluarga->delete_by_id($id_data_keluarga);

		$data = $this->arsip_pribadi_model->get_by_id($id_arsip_pribadi);
		if ($data != null) {
			$dir = "asset/upload/pribadi/pribadi_" . $id_data_keluarga . "_" . $id_arsip_pribadi;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_pribadi_model->delete_by_id($id_arsip_pribadi);
		}

		echo json_encode(array("status" => $status));
	}

	public function arsip_keluarga_list($id)
	{
		$this->db->select("*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_pribadi');
		$this->db->where('created_id', $id);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function keluarga_detail($id)
	{
		$this->db->select('
			tbl_data_keluarga.id_data_keluarga, tbl_data_keluarga.nama_anggota_keluarga, 
			tbl_data_keluarga.tanggal_lahir_keluarga, tbl_data_keluarga.id_pegawai, 
			tbl_data_keluarga.jenis_kelamin, tbl_data_keluarga.hub_keluarga, tbl_data_keluarga.uraian, 
			tbl_arsip_pribadi.id_arsip_pribadi, tbl_arsip_pribadi.title, tbl_arsip_pribadi.file_name_ori, 
			tbl_arsip_pribadi.file_name
		');
		$this->db->from('tbl_data_keluarga');
		$this->db->join('tbl_arsip_pribadi', 'tbl_arsip_pribadi.id_data_keluarga = tbl_data_keluarga.id_data_keluarga', 'left');
		$this->db->where('tbl_data_keluarga.id_data_keluarga', $id);

		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}

	public function form_detail_keluarga()
	{
		$Id = $this->input->post('Id');
		// $this->db->select('
		// 	tbl_data_keluarga.id_data_keluarga, tbl_data_keluarga.nama_anggota_keluarga, 
		// 	tbl_data_keluarga.tanggal_lahir_keluarga, tbl_data_keluarga.id_pegawai, 
		// 	tbl_data_keluarga.jenis_kelamin, tbl_data_keluarga.hub_keluarga, tbl_data_keluarga.uraian, 
		// 	tbl_data_keluarga.nik, tbl_data_keluarga.pekerjaan, 
		// 	tbl_arsip_pribadi.id_arsip_pribadi, tbl_arsip_pribadi.title, tbl_arsip_pribadi.file_name_ori, 
		// 	tbl_arsip_pribadi.file_name
		// ');
		$this->db->select('*');
		$this->db->from('tbl_data_keluarga');
		$this->db->join('tbl_arsip_pribadi', 'tbl_arsip_pribadi.id_data_keluarga = tbl_data_keluarga.id_data_keluarga', 'left');
		$this->db->where('tbl_data_keluarga.id_data_keluarga', $Id);
		$query = $this->db->get();
		$QData = $query->row();
		$a['data']	= $QData;
		$a['path_file'] = 'asset/upload/pribadi/pribadi_' . $QData->id_data_keluarga . '_' . $QData->id_arsip_pribadi;

		$this->load->view('dashboard_publik/homes/group_pribadi/keluarga/form_detail', $a);
	}

	public function form_detail_keluarga_old()
	{
		$Id = $this->input->post('Id');
		$QData = $this->db->query("SELECT
										kel.id_data_keluarga, 
										kel.id_pegawai, 
										kel.jenis_kelamin, 
										kel.tanggal_lahir_keluarga, 
										kel.nama_anggota_keluarga, 
										kel.hub_keluarga, 
										kel.status_kawin, 
										kel.tanggal_nikah, 
										kel.uraian, 
										kel.tanggal_cerai_meninggal, 
										kel.pekerjaan, 
										ars.file_name_ori, 
										ars.file_name, 
										ars.created_id, 
										ars.created_at, 
										ars.title, 
										ars.id_data_keluarga as arsip_kel,
										ars.id_arsip_pribadi as arsip_pribadi
									FROM
										tbl_data_keluarga AS kel
									INNER JOIN tbl_arsip_pribadi ars ON kel.id_data_keluarga = ars.id_data_keluarga
									WHERE kel.id_data_keluarga ='$Id'")->row();
		$a['data']	= $QData;
		$a['path_file'] = 'asset/upload/pribadi/pribadi_' . $QData->arsip_kel . '_' . $QData->arsip_pribadi;

		$this->load->view('dashboard_publik/homes/group_pribadi/keluarga/form_detail', $a);
	}
}
