<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hukuman extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('hukuman_model', 'tbl_data_hukuman');
		$this->load->model('arsip_hukuman_model');
	}

	public function hukuman_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_hukuman->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->jenis_hukuman;
			$row[] = $r->uraian;
			$row[] = $r->nomor_sk;
			$row[] = $r->tanggal_sk;
			$row[] = $r->file_name_ori;

			$btnDownload = '';
			$arsip = $this->tbl_data_hukuman->get_arsip_by_id_ref($r->id_hukuman);
			if ($arsip) {
				$btnDownload = '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="hukuman" data-id="' . utf8_encode($arsip->id_arsip_hukuman) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i> Download</button> ';
			}

			//add html for action
			$row[] = $btnDownload .
				'<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_hukuman(' . "'" . $r->id_hukuman . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_hukuman(' . "'" . $r->id_hukuman . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_hukuman->count_all($id),
			"recordsFiltered" => $this->tbl_data_hukuman->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function hukuman_edit($id)
	{
		$data = $this->tbl_data_hukuman->get_by_id($id);
		$data->arsip = $this->tbl_data_hukuman->get_arsip_by_id_ref($id);
		echo json_encode($data);
	}

	public function hukuman_add()
	{
		$response = array('status' => true);
		$validate_hukuman = $this->_validate_hukuman();

		$data = array(
			'id_pegawai' => $this->session->userdata('id_pegawai'),
			'id_master_hukuman' => $this->input->post('id_master_hukuman'),
			'uraian' => $this->input->post('uraian'),
			'nomor_sk' => $this->input->post('nomor_sk'),
			'tanggal_sk' => $this->input->post('tanggal_sk'),
			'tanggal_mulai' => $this->input->post('tanggal_mulai'),
			'tanggal_selesai' => $this->input->post('tanggal_selesai'),
			'masa_berlaku' => $this->input->post('masa_berlaku'),
			'pejabat_menetapkan' => $this->input->post('pejabat_menetapkan'),
		);

		if ($validate_hukuman['status'] == true) {
			$insert_id = $this->tbl_data_hukuman->save($data);
			$title_file = $this->tbl_data_hukuman->getMasterHukumanName($this->input->post('id_master_hukuman'));

			if ($insert_id) {
				if ($_FILES['arsipHukuman_file']['name'] != '') {
					$ins = [
						'id_hukuman' => $insert_id,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_hukuman', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_hukuman->update_arsip(
							['id_arsip_hukuman' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_hukuman->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_hukuman->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/Hukuman/Hukuman_' . $insert_id . '_' . $id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		} else {
			$response = $validate_hukuman;
		}

		echo json_encode($response);
	}

	public function hukuman_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_hukuman');
		$validate_hukuman = $this->_validate_hukuman();

		if ($validate_hukuman['status'] == true) {
			$data = array(
				'id_pegawai' => $this->session->userdata('id_pegawai'),
				'id_master_hukuman' => $this->input->post('id_master_hukuman'),
				'uraian' => $this->input->post('uraian'),
				'nomor_sk' => $this->input->post('nomor_sk'),
				'tanggal_sk' => $this->input->post('tanggal_sk'),
				'tanggal_mulai' => $this->input->post('tanggal_mulai'),
				'tanggal_selesai' => $this->input->post('tanggal_selesai'),
				'masa_berlaku' => $this->input->post('masa_berlaku'),
				'pejabat_menetapkan' => $this->input->post('pejabat_menetapkan'),
			);

			$this->tbl_data_hukuman->update(array('id_hukuman' => $id), $data);

			if ($_FILES['arsipHukuman_file']['name'] != '') {
				$fileOld = $this->tbl_data_hukuman->get_arsip_by_id_ref($id);
				if (!empty($fileOld)) {
					$title_file = $this->tbl_data_hukuman->getMasterHukumanName($this->input->post('id_master_hukuman'));
					$ins = [
						'id_hukuman' => $id,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_hukuman', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_hukuman->update_arsip(
							['id_arsip_hukuman' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/Hukuman/Hukuman_' . $fileOld->id_hukuman . '_' . $fileOld->id_arsip_hukuman;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						//delete arsip table
						$this->tbl_data_hukuman->delete_arsip($fileOld->id_arsip_hukuman);
					} else {
						//delete tabel arsip
						$this->tbl_data_hukuman->delete_arsip($id_arsip);

						//delete tabel riwayat hukuman
						$this->tbl_data_hukuman->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/Hukuman/Hukuman_' . $id_arsip . '_' . $id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipHukuman_file']['name'] != '') {
						$title_file = $this->tbl_data_hukuman->getMasterHukumanName($this->input->post('id_master_hukuman'));
						$ins = [
							'id_hukuman' => $id,
							'title' => $title_file,
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
							'created_at' => date('Y-m-d H:i:s')
						];

						//insert into arsip
						$this->db->insert('tbl_arsip_hukuman', $ins);
						$id_arsip = $this->db->insert_id();

						$validate_arsip = $this->_do_upload($id_arsip, $id);
						if ($validate_arsip['status'] == true) {
							//update filename
							$this->tbl_data_hukuman->update_arsip(
								['id_arsip_hukuman' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							//delete tabel arsip
							$this->tbl_data_hukuman->delete_arsip($id_arsip);

							//delete tabel data hukuman
							$this->tbl_data_hukuman->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/Hukuman/Hukuman_' . $id_arsip . '_' . $id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_hukuman;
		}

		echo json_encode($response);
	}

	public function hukuman_delete($id)
	{

		//delete data hukuman
		$this->tbl_data_hukuman->delete_by_id($id);

		//delete arsip file
		$path = './asset/upload/Hukuman/Hukuman_' . $id;

		if (is_dir($path)) {
			delete_files($path, true);
			rmdir($path);
		}

		//delete table arsip
		$this->db->delete('tbl_arsip_hukuman', ['id_hukuman' => $id]);

		//delete data
		$this->tbl_data_hukuman->delete_by_id($id);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_hukuman()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_master_hukuman') == '') {
			$data['inputerror'][] = 'id_master_hukuman';
			$data['error_string'][] = 'Jenis Hukuman wajib dipilih';
			$data['status'] = FALSE;
		}

		if ($this->input->post('uraian') == '') {
			$data['inputerror'][] = 'uraian';
			$data['error_string'][] = 'Uraian wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nomor_sk') == '') {
			$data['inputerror'][] = 'nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_sk') == '') {
			$data['inputerror'][] = 'tanggal_sk';
			$data['error_string'][] = 'Tanggal SK wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_mulai') == '') {
			$data['inputerror'][] = 'tanggal_mulai';
			$data['error_string'][] = 'Tanggal Mulai wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_selesai') == '') {
			$data['inputerror'][] = 'tanggal_selesai';
			$data['error_string'][] = 'Tanggal Selesai wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('masa_berlaku') == '') {
			$data['inputerror'][] = 'masa_berlaku';
			$data['error_string'][] = 'Masa Berlaku wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('pejabat_menetapkan') == '') {
			$data['inputerror'][] = 'pejabat_menetapkan';
			$data['error_string'][] = 'Pejabat Menetapkan wajib di isi';
			$data['status'] = FALSE;
		}

		return $data;
	}

	private function _do_upload($id, $id_ref = 0)
	{
		$dir = "Hukuman_" . $id_ref . '_' . $id;
		$config['upload_path']          = './asset/upload/Hukuman/' . $dir;
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

		if ($_FILES['arsipHukuman_file']['name'] != '') {
			$name = time() . str_replace(' ', '', $_FILES['arsipHukuman_file']['name']);
			$_FILES['arsipHukuman_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipHukuman_file')) ||  $_FILES['arsipHukuman_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipHukuman_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipHukuman_file']['name'];
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
			$data = $this->tbl_data_hukuman->get_arsip_by_id($id);
			$file_name_ori = $data->file_name_ori;
			$file_name = $data->file_name;
			$id_hukuman = $data->id_hukuman;
			$dir = "Hukuman_" . $id_hukuman . "_" . $id;
			$path = file_get_contents('asset/upload/Hukuman/' . $dir . '/' . $file_name); // letak file pada aplikasi kita
			force_download($file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_hukuman->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/Hukuman/Hukuman_' . $data->id_hukuman . '_' . $data->id_arsip_hukuman;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			if (!$this->db->delete('tbl_arsip_hukuman', ['id_arsip_hukuman' => $id])) {
				$status = false;
			}
		} else {
			$status = false;
		}

		$response = ['status' => $status];
		echo json_encode($response);
	}

	public function hukuman_list($id)
	{
		$this->db->select('
			tbl_data_hukuman.*, tbl_master_hukuman.nama_hukuman as jenis_hukuman,
			tbl_arsip_hukuman.file_name_ori, tbl_arsip_hukuman.id_arsip_hukuman,
			tbl_arsip_hukuman.file_name, tbl_arsip_hukuman.title
		');
		$this->db->from('tbl_data_hukuman');
		$this->db->join('tbl_master_hukuman', 'tbl_master_hukuman.id_hukuman = tbl_data_hukuman.id_master_hukuman', 'left');
		$this->db->join('tbl_arsip_hukuman', 'tbl_arsip_hukuman.id_hukuman = tbl_data_hukuman.id_hukuman', 'left');
		$this->db->where('tbl_data_hukuman.id_pegawai', $id);

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function hukuman_delete_arsip($id_hukuman, $id_arsip_hukuman)
	{
		$status = true;

		//delete data skp
		$this->tbl_data_hukuman->delete_by_id($id_hukuman);

		$data = $this->arsip_hukuman_model->get_by_id($id_arsip_hukuman);
		if ($data != null) {
			$dir = "asset/upload/Hukuman/Hukuman" . '_' . $data->id_hukuman . '_' . $data->id_arsip_hukuman;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_hukuman_model->delete_by_id($id_arsip_hukuman);
		}

		echo json_encode(array("status" => $status));
	}

	public function arsip_hukuman_list($id)
	{
		$this->db->select("*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_hukuman');
		$this->db->where('created_id', $id);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function hukuman_detail($id)
	{
		$this->db->select('
			tbl_data_hukuman.*, tbl_master_hukuman.nama_hukuman as jenis_hukuman,
			tbl_arsip_hukuman.id_arsip_hukuman, tbl_arsip_hukuman.file_name_ori, tbl_arsip_hukuman.file_name,
			tbl_arsip_hukuman.title
		');
		$this->db->from('tbl_data_hukuman');
		$this->db->join('tbl_master_hukuman', 'tbl_master_hukuman.id_hukuman = tbl_data_hukuman.id_master_hukuman', 'left');
		$this->db->join('tbl_arsip_hukuman', 'tbl_arsip_hukuman.id_hukuman = tbl_data_hukuman.id_hukuman', 'left');
		$this->db->where('tbl_data_hukuman.id_hukuman', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}
}
