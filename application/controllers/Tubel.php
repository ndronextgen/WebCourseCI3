<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tubel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('tubel_model', 'tbl_data_tubel');
		$this->load->model('arsip_sk_model');
		$this->load->library('func_table');
		$this->jenis_sk = 1;
	}

	public function tubel_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_tubel->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $r->uraian;
			$row[] = $r->no_sk;
			$row[] = date_format(date_create($r->tgl_sk), 'j M Y');
			$row[] = $r->sekolah;
			$row[] = $r->akreditasi;
			$row[] = $r->jurusan;

			$file = '-';

			//add html for action
			$button = '	<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_tubel(' . "'" . $r->id_tubel . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  	&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_tubel(' . "'" . $r->id_tubel . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			// === begin: untuk tombol download ===
			$arsip = $this->tbl_data_tubel->get_arsip_by_id_ref($r->id_tubel, 1);
			if ($arsip) {
				$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="tubel" data-id="' . utf8_encode($arsip->id_arsip_sk) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i> Download</button>';
			}

			//add html for action
			$button = '	<!--<a class="btn btn-sm btn-success" href="javascript:void(0);" title="lihat detail" onclick="detail_tubel(' . "'" . $r->id_tubel . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>-->
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_tubel(' . "'" . $r->id_tubel . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_tubel(' . "'" . $r->id_tubel . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			$arsip = $this->tbl_data_tubel->get_arsip_by_id_ref($r->id_tubel, 1);
			if ($arsip) {
				$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="tubel" data-id="' . utf8_encode($arsip->id_arsip_sk) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';

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
			"recordsTotal" => $this->tbl_data_tubel->count_all($id),
			"recordsFiltered" => $this->tbl_data_tubel->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function tubel_edit($id_tubel)
	{
		$data = $this->tbl_data_tubel->get_by_id($id_tubel);
		$data->arsip = $this->tbl_data_tubel->get_arsip_by_id_ref($id_tubel, $this->jenis_sk);
		echo json_encode($data);
	}

	public function tubel_add()
	{
		$response = array('status' => true);
		$validate_tubel = $this->_validate_tubel();
		$id = $this->session->userdata('id_pegawai');

		$data = array(
			'uraian' => $this->input->post('uraian'),
			'no_sk' => $this->input->post('no_sk'),
			'tgl_sk' => $this->input->post('tgl_sk'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'sekolah' => $this->input->post('sekolah'),
			'akreditasi' => $this->input->post('akreditasi'),
			'jurusan' => $this->input->post('jurusan'),
			'id_pegawai' => $this->session->userdata('id_pegawai')
		);

		if ($validate_tubel['status'] == true) {
			$insert_id = $this->tbl_data_tubel->save($data);

			if ($insert_id) {
				if ($_FILES['arsipTubel_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $this->input->post('uraian') . ' ' . $this->input->post('no_sk'),
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
						$this->tbl_data_tubel->update_arsip(
							['id_arsip_sk' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_tubel->delete_arsip($id_arsip);

						//delete
						$this->tbl_data_tubel->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $insert_id . '_' . $id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
						$response = ['status' => false];
					}
				}
			}
		} else {
			$response = $validate_tubel;
		}

		echo json_encode($response);
	}

	public function tubel_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_tubel');
		$validate_tubel = $this->_validate_tubel();

		if ($validate_tubel['status'] == true) {
			$data = array(
				'uraian' => $this->input->post('uraian'),
				'no_sk' => $this->input->post('no_sk'),
				'tgl_sk' => $this->input->post('tgl_sk'),
				'tgl_mulai' => $this->input->post('tgl_mulai'),
				'tgl_selesai' => $this->input->post('tgl_selesai'),
				'sekolah' => $this->input->post('sekolah'),
				'akreditasi' => $this->input->post('akreditasi'),
				'jurusan' => $this->input->post('jurusan'),
				'id_pegawai' => $this->session->userdata('id_pegawai')
			);

			$this->tbl_data_tubel->update(array('id_tubel' => $id), $data);

			//update title arsip table
			$this->tbl_data_tubel->update_arsip(['id_arsip_sk' => $id], ['title' => $this->input->post('uraian') . ' ' . $this->input->post('no_sk'),]);

			if ($_FILES['arsipTubel_file']['name'] != '') {
				$fileOld = $this->tbl_data_tubel->get_arsip_by_id_ref($id, $this->jenis_sk);
				if (!empty($fileOld)) {
					$ins = [
						'id_ref' => $id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $this->input->post('uraian') . ' ' . $this->input->post('no_sk'),
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
						$this->tbl_data_tubel->update_arsip(
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
						$this->tbl_data_tubel->delete_arsip($fileOld->id_arsip_sk);
					} else {
						//delete tabel arsip
						$this->tbl_data_tubel->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_tubel->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id . '_' . $id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipTubel_file']['name'] != '') {
						$ins = [
							'id_ref' => $id,
							'id_jenis_sk' => $this->jenis_sk,
							'title' => $this->input->post('uraian') . ' ' . $this->input->post('no_sk'),
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
							$this->tbl_data_tubel->update_arsip(
								['id_arsip_sk' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							//delete tabel arsip
							$this->tbl_data_tubel->delete_arsip($id_arsip);

							//delete tabel
							$this->tbl_data_tubel->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id . '_' . $id_arsip;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_tubel;
		}

		echo json_encode($response);
	}

	public function tubel_delete($id_tubel)
	{
		//delete data tubel
		$this->tbl_data_tubel->delete_by_id($id_tubel);

		$arsip = $this->tbl_data_tubel->get_arsip_by_id_ref($id_tubel, $this->jenis_sk);
		if ($arsip) {
			//delete arsip file
			$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_tubel . '_' . $arsip->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			//delete table arsip
			$this->db->delete('tbl_arsip_sk', ['id_ref' => $id_tubel]);
		}

		echo json_encode(array("status" => TRUE));
	}



	private function _validate_tubel()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('uraian') == '') {
			$data['inputerror'][] = 'uraian';
			$data['error_string'][] = 'Nama Status wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('no_sk') == '') {
			$data['inputerror'][] = 'no_sk';
			$data['error_string'][] = 'Nomor SK wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tgl_sk') == '') {
			$data['inputerror'][] = 'tgl_sk';
			$data['error_string'][] = 'Tanggal SK wajib dipilih';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tgl_mulai') == '') {
			$data['inputerror'][] = 'tgl_mulai';
			$data['error_string'][] = 'Tanggal Mulai wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tgl_selesai') == '') {
			$data['inputerror'][] = 'tgl_selesai';
			$data['error_string'][] = 'Tanggal Selesai wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('sekolah') == '') {
			$data['inputerror'][] = 'sekolah';
			$data['error_string'][] = 'Sekolah wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('akreditasi') == '') {
			$data['inputerror'][] = 'akreditasi';
			$data['error_string'][] = 'Akreditasi wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jurusan') == '') {
			$data['inputerror'][] = 'jurusan';
			$data['error_string'][] = 'Jurusan wajib di isi';
			$data['status'] = FALSE;
		}

		return $data;
	}

	private function _do_upload($id, $jenis_sk = 0, $id_ref = 0)
	{
		$dir = "SK_" . $this->jenis_sk . '_' . $id_ref . '_' . $id;
		$config['upload_path']          = './asset/upload/SK/' . $dir;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		$this->load->library('upload', $config);

		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;

		if ($_FILES['arsipTubel_file']['name'] != '') {
			$name = time() . str_replace(' ', '', $_FILES['arsipTubel_file']['name']);
			$_FILES['arsipTubel_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipTubel_file')) ||  $_FILES['arsipTubel_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipTubel_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipTubel_file']['name'];
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
			$data = $this->tbl_data_tubel->get_arsip_by_id($id);

			$file_name_ori = $data->file_name_ori;
			$file_name = $data->file_name;
			$id_ref = $data->id_ref;
			$dir = "SK_" . $this->jenis_sk . '_' . $id_ref . '_' . $id;
			$path = file_get_contents('asset/upload/SK/' . $dir . '/' . $file_name); // letak file pada aplikasi kita

			force_download($file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_tubel->get_arsip_by_id($id);

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

	public function tubel_list($id)
	{
		$this->db->select('
			tbl_data_tubel.id_tubel, tbl_data_tubel.uraian, tbl_data_tubel.no_sk, tbl_data_tubel.tgl_sk, 
			tbl_data_tubel.sekolah, tbl_data_tubel.akreditasi, tbl_data_tubel.jurusan,
			tbl_arsip_sk.file_name_ori, tbl_arsip_sk.id_arsip_sk,
			tbl_arsip_sk.file_name
		');
		$this->db->from('tbl_data_tubel');
		$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_tubel.id_tubel', 'left');
		$this->db->where('tbl_data_tubel.id_pegawai', $id);
		$this->db->where('tbl_arsip_sk.id_jenis_sk', $this->jenis_sk);

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function tubel_delete_arsip($id_tubel, $id_arsip_sk)
	{
		$status = true;

		//delete data tubel
		$this->tbl_data_tubel->delete_by_id($id_tubel);

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

	public function arsip_tubel_list($id)
	{
		$this->db->select("tbl_arsip_sk.*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_sk');
		$this->db->where('created_id', $id);
		$this->db->where('id_jenis_sk', $this->jenis_sk);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function tubel_detail($id)
	{
		$this->db->select('
			tbl_data_tubel.*, tbl_arsip_sk.id_ref,
			tbl_arsip_sk.id_jenis_sk,tbl_arsip_sk.id_arsip_sk, tbl_arsip_sk.file_name_ori, tbl_arsip_sk.file_name, 
			tbl_arsip_sk.title 
		');
		$this->db->from('tbl_data_tubel');
		$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_tubel.id_tubel', 'left');
		$this->db->where('tbl_data_tubel.id_tubel', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}

	public function download_all()
	{
		$this->load->library('zip');
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT * FROM tbl_data_tubel 
										LEFT JOIN (
											SELECT id_jenis_sk, id_ref, id_arsip_sk, file_name_ori, file_name FROM tbl_arsip_sk WHERE id_jenis_sk = '1'
										) AS ar ON ar.id_ref = tbl_data_tubel.id_tubel
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
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_TUGBELAJAR.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_adm_tubel($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_TUGBELAJAR.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_data_tubel 
										LEFT JOIN (
											SELECT id_jenis_sk, id_ref, id_arsip_sk, file_name_ori, file_name FROM tbl_arsip_sk WHERE id_jenis_sk = '1'
										) AS ar ON ar.id_ref = tbl_data_tubel.id_tubel
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
