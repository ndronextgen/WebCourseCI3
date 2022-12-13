<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penghargaan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('penghargaan_model', 'tbl_data_penghargaan');
		$this->load->model('arsip_sk_model');
		$this->load->library('func_table');
		$this->jenis_sk = 5;
	}

	public function penghargaan_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_penghargaan->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $r->nama_penghargaan;
			$row[] = $r->pemberi_penghargaan;
			$row[] = $r->nomor_sk;
			$row[] = $r->tgl_sk_penghargaan;

			$file = '-';

			//add html for action
			$button = '	<!--<a class="btn btn-sm btn-success" href="javascript:void(0);" title="lihat detail" onclick="detail_penghargaan(' . "'" . $r->id_penghargaan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>-->
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_penghargaan(' . "'" . $r->id_penghargaan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_penghargaan(' . "'" . $r->id_penghargaan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			// === begin: untuk tombol download ===
			$arsip = $this->tbl_data_penghargaan->get_arsip_by_id_ref($r->id_penghargaan, 5);
			if ($arsip) {
				$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="pangkat" data-id="' . utf8_encode($arsip->id_arsip_sk) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';
				
				// === file ===
				$path_file = 'asset/upload/SK/SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk . '/' . $arsip->file_name;
				$file = $this->func_table->get_file($path_file, $arsip->file_name_ori);
			}
			// === end: untuk tombol download ===

			$row[] = $file;
			$row[] = $button;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_penghargaan->count_all($id),
			"recordsFiltered" => $this->tbl_data_penghargaan->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function penghargaan_edit($id_penghargaan)
	{
		$data = $this->tbl_data_penghargaan->get_by_id($id_penghargaan);
		$data->arsip = $this->tbl_data_penghargaan->get_arsip_by_id_ref($id_penghargaan, $this->jenis_sk);

		echo json_encode($data);
	}

	public function penghargaan_add()
	{
		$response = array('status' => true);
		$validate_penghargaan = $this->_validate_penghargaan();
		$id = $this->session->userdata('id_pegawai');

		$data = array(
			'id_master_penghargaan' => $this->input->post('id_master_penghargaan'),
			'nama_penghargaan_lainnya' => $this->input->post('nama_penghargaan_lainnya'),
			'pemberi_penghargaan' => $this->input->post('pemberi_penghargaan'),
			'nomor_sk' => $this->input->post('nomor_sk'),
			'tgl_sk_penghargaan' => $this->input->post('tgl_sk_penghargaan'),
			'id_pegawai' => $this->session->userdata('id_pegawai'),
		);

		if ($validate_penghargaan['status'] == true) {
			$insert_id = $this->tbl_data_penghargaan->save($data);
			$title_file = $this->tbl_data_penghargaan->getMasterPenghargaanName($this->input->post('id_master_penghargaan'));

			if ($insert_id) {
				if ($_FILES['arsipPenghargaan_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $this->jenis_sk, $insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_penghargaan->update_arsip(
							['id_arsip_sk' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_penghargaan->delete_arsip($id_arsip);

						//delete tabel penghargaan
						$this->tbl_data_penghargaan->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_arsip . '_' . $insert_id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		} else {
			$response = $validate_penghargaan;
		}

		echo json_encode($response);
	}

	public function penghargaan_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_penghargaan');
		$validate_penghargaan = $this->_validate_penghargaan();

		if ($validate_penghargaan['status'] == true) {
			$data = array(
				'id_master_penghargaan' => $this->input->post('id_master_penghargaan'),
				'nama_penghargaan_lainnya' => $this->input->post('nama_penghargaan_lainnya'),
				'pemberi_penghargaan' => $this->input->post('pemberi_penghargaan'),
				'nomor_sk' => $this->input->post('nomor_sk'),
				'tgl_sk_penghargaan' => $this->input->post('tgl_sk_penghargaan'),
				'id_pegawai' => $this->session->userdata('id_pegawai'),
			);

			$this->tbl_data_penghargaan->update(array('id_penghargaan' => $id), $data);

			//update title arsip table
			$title_file = $this->tbl_data_penghargaan->getMasterPenghargaanName($this->input->post('id_master_penghargaan'));

			if ($_FILES['arsipPenghargaan_file']['name'] != '') {
				log_message('debug', 'arsip tidak kosong : ' . $id);
				$fileOld = $this->tbl_data_penghargaan->get_arsip_by_id_ref($id, $this->jenis_sk);
				if (!empty($fileOld)) {
					log_message('debug', 'masuk : ' . json_encode($fileOld));
					$ins = [
						'id_ref' => $id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $this->jenis_sk, $id);
					if ($validate_arsip['status'] == true) {
						log_message('debug', 'valid arsip');
						log_message('debug', 'data arsip : ' . json_encode($validate_arsip));
						//update filename
						$this->tbl_data_penghargaan->update_arsip(
							['id_arsip_sk' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/SK/SK_' . $fileOld->id_jenis_sk . '_' . $fileOld->id_ref . '_' . $fileOld->id_arsip_sk;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						//delete arsip table
						$this->tbl_data_penghargaan->delete_arsip($fileOld->id_arsip_sk);
					} else {
						//delete tabel arsip
						$this->tbl_data_penghargaan->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_penghargaan->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_arsip . '_' . $id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipPenghargaan_file']['name'] != '') {
						$ins = [
							'id_ref' => $id,
							'id_jenis_sk' => $this->jenis_sk,
							'title' => $title_file,
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
							'created_at' => date('Y-m-d H:i:s')
						];

						//insert into arsip
						$this->db->insert('tbl_arsip_sk', $ins);
						$id_arsip = $this->db->insert_id();

						$validate_arsip = $this->_do_upload($id_arsip, $this->jenis_sk, $id);
						if ($validate_arsip['status'] == true) {
							//update filename
							$this->tbl_data_penghargaan->update_arsip(
								['id_arsip_sk' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							//delete tabel arsip
							$this->tbl_data_penghargaan->delete_arsip($id_arsip);

							//delete tabel riwayat jabatan
							$this->tbl_data_penghargaan->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_arsip . '_' . $id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_penghargaan;
		}

		echo json_encode($response);
	}

	public function penghargaan_delete($id_penghargaan)
	{
		//delete data penghargaan
		$this->tbl_data_penghargaan->delete_by_id($id_penghargaan, $this->jenis_sk);

		$arsip = $this->tbl_data_penghargaan->get_arsip_by_id_ref($id_penghargaan, $this->jenis_sk);
		if ($arsip) {
			//delete arsip file
			$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_penghargaan . '_' . $arsip->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			//delete table arsip
			$this->db->delete('tbl_arsip_sk', ['id_ref' => $id_penghargaan]);
		}

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_penghargaan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_master_penghargaan') == '') {
			$data['inputerror'][] = 'id_master_penghargaan';
			$data['error_string'][] = 'Nama penghargaan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('pemberi_penghargaan') == '') {
			$data['inputerror'][] = 'pemberi_penghargaan';
			$data['error_string'][] = 'Pemberi Penghargaan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nomor_sk') == '') {
			$data['inputerror'][] = 'nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tgl_sk_penghargaan') == '') {
			$data['inputerror'][] = 'tgl_sk_penghargaan';
			$data['error_string'][] = 'Tanggal SK wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_master_penghargaan') == 394) {
			if ($this->input->post('nama_penghargaan_lainnya') == '') {
				$data['inputerror'][] = 'nama_penghargaan_lainnya';
				$data['error_string'][] = 'Nama Penghargaan Lainnya wajib diisi';
				$data['status'] = FALSE;
			}
		}

		return $data;
	}

	private function _do_upload($id, $jenis_sk = 0, $id_ref = 0)
	{
		$dir = "SK_" . $jenis_sk . '_' . $id_ref . '_' . $id;
		$config['upload_path']          = './asset/upload/SK/' . $dir;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}
		log_message('debug', 'do upload : ' . $dir);
		$this->load->library('upload', $config);

		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;

		if ($_FILES['arsipPenghargaan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time() . str_replace(' ', '', $_FILES['arsipPenghargaan_file']['name']);
			$_FILES['arsipPenghargaan_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipPenghargaan_file')) ||  $_FILES['arsipPenghargaan_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipPenghargaan_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipPenghargaan_file']['name'];
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
			$data = $this->tbl_data_penghargaan->get_arsip_by_id($id);

			$dir = "SK_" . $data->id_jenis_sk . '_' . $data->id_ref . '_' . $data->id_arsip_sk;
			$path = file_get_contents('asset/upload/SK/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita

			force_download($data->file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_penghargaan->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/SK/SK_' . $data->id_jenis_sk . '_' . $data->id_ref . '_' . $data->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			if (!$this->db->delete('tbl_arsip_sk', ['id_arsip_sk' => $id])) {
				$status = false;
			}
		} else {
			$status = false;
		}

		$response = ['status' => $status];
		echo json_encode($response);
	}

	public function penghargaan_list($id)
	{
		$this->db->select('
			tbl_data_penghargaan.id_penghargaan, tbl_master_penghargaan.nama_penghargaan, 
			tbl_data_penghargaan.pemberi_penghargaan, tbl_data_penghargaan.nomor_sk, 
			tbl_data_penghargaan.tgl_sk_penghargaan, tbl_arsip_sk.file_name_ori, tbl_arsip_sk.id_arsip_sk,
			tbl_arsip_sk.file_name
		');
		$this->db->from('tbl_data_penghargaan');
		$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_penghargaan.id_penghargaan', 'left');
		$this->db->join('tbl_master_penghargaan', 'tbl_master_penghargaan.id_master_penghargaan = tbl_data_penghargaan.id_master_penghargaan');
		$this->db->where('tbl_data_penghargaan.id_pegawai', $id);
		$this->db->where('tbl_arsip_sk.id_jenis_sk', $this->jenis_sk);

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function penghargaan_delete_arsip($id_penghargaan, $id_arsip_sk)
	{
		$status = true;

		//delete data penghargaan
		$this->tbl_data_penghargaan->delete_by_id($id_penghargaan);

		$data = $this->arsip_sk_model->get_by_id($id_arsip_sk);
		if ($data != null) {
			$dir = "asset/upload/SK/SK_" . $data->id_jenis_sk . '_' . $data->id_ref . '_' . $data->id_arsip_sk;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_sk_model->delete_by_id($id_arsip_sk);
		}

		echo json_encode(array("status" => $status));
	}

	public function arsip_penghargaan_list($id)
	{
		$this->db->select("*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_sk');
		$this->db->where('created_id', $id);
		$this->db->where('id_jenis_sk', $this->jenis_sk);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function penghargaan_detail($id)
	{
		$this->db->select('
			tbl_data_penghargaan.*, tbl_master_penghargaan.nama_penghargaan, tbl_arsip_sk.id_ref,
			tbl_arsip_sk.id_jenis_sk,tbl_arsip_sk.id_arsip_sk, tbl_arsip_sk.file_name_ori, tbl_arsip_sk.file_name,
			tbl_arsip_sk.title 
		');
		$this->db->from('tbl_data_penghargaan');
		$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_penghargaan.id_penghargaan', 'left');
		$this->db->join('tbl_master_penghargaan', 'tbl_master_penghargaan.id_master_penghargaan = tbl_data_penghargaan.id_master_penghargaan', 'left');
		$this->db->where('tbl_data_penghargaan.id_penghargaan', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}

	public function download_all()
	{
		$this->load->library('zip');
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT * FROM tbl_data_penghargaan 
										LEFT JOIN (
											SELECT id_jenis_sk, id_ref, id_arsip_sk, file_name_ori, file_name FROM tbl_arsip_sk WHERE id_jenis_sk = '5'
										) AS ar ON ar.id_ref = tbl_data_penghargaan.id_penghargaan
										WHERE id_pegawai = '$Id' 
									")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = "SK_" . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
				$pathFile = FCPATH . 'asset/upload/SK/' . $dir . '/' . $arsip->file_name;

				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/SK/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_PENGHARGAAN.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}


	public function download_all_adm_penghargaan($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_PENGHARGAAN.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_data_penghargaan 
										LEFT JOIN (
											SELECT id_jenis_sk, id_ref, id_arsip_sk, file_name_ori, file_name FROM tbl_arsip_sk WHERE id_jenis_sk = '5'
										) AS ar ON ar.id_ref = tbl_data_penghargaan.id_penghargaan
										WHERE id_pegawai = '$Id' 
									")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = "SK_" . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
				$pathFile = FCPATH . 'asset/upload/SK/' . $dir . '/' . $arsip->file_name;

				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/SK/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		if ($zip) {
			$this->zip->download($filename);
		}
	}
}
