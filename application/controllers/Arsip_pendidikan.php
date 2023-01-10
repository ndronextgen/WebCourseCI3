<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_pendidikan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('arsip_pendidikan_model');
		$this->load->model('pendidikan_model');
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('file');
		$this->load->helper('download');
	}

	public function pendidikan_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->arsip_pendidikan_model->get_datatables($id);
		$data = array();
		$no = (isset($_POST['start']) ? $_POST['start'] : 0) + 1;
		foreach ($list as $r) {
			$row = array();

			$row[] = $no;
			$row[] = $r->title;
			$row[] = $r->tipe_pendidikan;
			$row[] = $r->file_name_ori;

			// === begin: kolom "file" ===
			$path_file = 'asset/upload/pendidikan/pendidikan_' . $r->id_tipe_pendidikan . '_' . $r->id_pendidikan . '_' . $r->id_arsip_pendidikan;
			$path_folder    = $path_file . '/' . $r->file_name;
			if (file_exists($path_folder)) {
				$ext = pathinfo($path_folder, PATHINFO_EXTENSION);

				if (strtolower($ext) == 'pdf') {
					$file = '<a data-fancybox data-type="iframe" data-src="' . base_url($path_folder) . '" href="javascript:void(0);">
								<button type="button" class="btn btn-danger btn-sm" title="' . $r->file_name_ori . '"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>
							</a>';
				} else {
					$file = '<a data-fancybox="images" href="' . base_url($path_folder) . '" target="_blank">
								<img height="40px" width="40px" src="' . base_url($path_folder) . '" title="' . $r->file_name_ori . '">
							</a>';
				}
			} else {
				$file = '-';
				goto skip_row;
			}
			$row[] = $file;
			// === end: kolom "file" ===

			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_pendidikan(' . "'" . $r->id_arsip_pendidikan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pendidikan(' . "'" . $r->id_arsip_pendidikan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_download_pendidikan" data-id="' . utf8_encode($r->id_arsip_pendidikan) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';

			$data[] = $row;

			$no++;
			skip_row:
		}

		$output = array(
			"draw" => (isset($_POST['draw']) ? $_POST['draw'] : ''),
			"recordsTotal" => $this->arsip_pendidikan_model->count_all($id),
			"recordsFiltered" => $this->arsip_pendidikan_model->count_filtered($id),
			"data" => $data
		);

		//output to json format
		echo json_encode($output);
	}

	public function pendidikan_lihat($id_pendidikan)
	{
		$data = $this->arsip_pendidikan_model->get_by_id($id_pendidikan);
		echo json_encode($data);
	}

	public function pendidikan_edit($id_pendidikan)
	{
		$data = $this->arsip_pendidikan_model->get_by_id($id_pendidikan);
		echo json_encode($data);
	}

	public function pendidikan_add()
	{
		$status = true;
		$this->_validate_pendidikan();
		$data = array(
			'title' => $this->input->post('title_pendidikan'),
			'id_tipe_pendidikan' => 2, //tipe pendidikan informal
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert_id = $this->arsip_pendidikan_model->save($data);

		if ($insert_id != 0) {
			if (!empty($_FILES['file_pendidikan']['name'])) {
				$upload = $this->_do_upload($insert_id, 2, $insert_id);
				$upd['id_pendidikan'] = $insert_id;
				$upd['file_name'] = $upload;
				$upd['file_name_ori'] = $_FILES['file_pendidikan']['name'];
			} else {
				$upd['id_pendidikan'] = $insert_id;
			}

			$this->arsip_pendidikan_model->update(array('id_arsip_pendidikan' => $insert_id), $upd);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function pendidikan_update()
	{
		$status = true;
		$this->_validate_pendidikan();
		$data = array(
			'title' => $this->input->post('title_pendidikan'),
			'id_arsip_pendidikan' => $this->input->post('id_pendidikan')
		);

		$id = $this->input->post('id_pendidikan');
		$dataOld = $this->arsip_pendidikan_model->get_by_id($id);

		if ($dataOld != null) {
			if (!empty($_FILES['file_pendidikan']['name'])) {
				//delete old file
				$path = 'asset/upload/pendidikan/pendidikan_' . $dataOld->id_tipe_pendidikan . '_' . $dataOld->id_pendidikan . '_' . $id . '/' . $dataOld->file_name;

				if (file_exists($path))
					unlink($path);

				$upload = $this->_do_upload($id, $dataOld->id_tipe_pendidikan, $dataOld->id_pendidikan);
				$data['file_name'] = $upload;
				$data['file_name_ori'] = $_FILES['file_pendidikan']['name'];
			}

			$this->arsip_pendidikan_model->update(array('id_arsip_pendidikan' => $id), $data);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function ajax_delete($id)
	{
		//delete file
		$person = $this->person->get_by_id($id);

		if (file_exists('upload/' . $person->photo) && $person->photo)
			unlink('upload/' . $person->photo);

		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function pendidikan_delete($id_pendidikan)
	{
		$status = true;
		$data = $this->arsip_pendidikan_model->get_by_id($id_pendidikan);

		if ($data != null) {
			$path = "asset/upload/pendidikan/pendidikan_" . $data->id_tipe_pendidikan . "_" . $data->id_pendidikan . "_" . $id_pendidikan;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			$this->arsip_pendidikan_model->delete_by_id($id_pendidikan);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	private function _do_upload($id, $id_tipe_pendidikan, $id_ref = 0)
	{
		$dir = "pendidikan_" . $id_tipe_pendidikan . "_" . $id_ref . "_" . $id;
		$path = "asset/upload/pendidikan/" . $dir;

		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_pendidikan')) //upload and validate
		{
			$data['inputerror'][] = 'file_pendidikan';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}

		return $this->upload->data('file_name');
	}

	private function _validate_pendidikan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('title_pendidikan') == '') {
			$data['inputerror'][] = 'title_pendidikan';
			$data['error_string'][] = 'Judul pendidikan wajib di isi';
			$data['status'] = FALSE;
		}

		// if ($_FILES['file_pendidikan']['name'] == '') {
		// 	$data['inputerror'][] = 'file_pendidikan';
		// 	$data['error_string'][] = 'File wajib ada.';
		// 	$data['status'] = FALSE;
		// }

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	public function download($id)
	{
		$id_pendidikan = utf8_encode($id);
		if ($id_pendidikan == "") {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
			redirect(base_url() . 'dashboard_publik/arsip_digital/');
		} else {
			$data = $this->arsip_pendidikan_model->get_by_id($id_pendidikan);
			$dir = "pendidikan_" . $data->id_tipe_pendidikan . '_' . $data->id_pendidikan . '_' . $id_pendidikan;
			$path = file_get_contents('asset/upload/pendidikan/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function pendidikan_list($id)
	{
		$list = $this->arsip_pendidikan_model->get_datatables($id);

		echo json_encode($list);
	}

	public function download_file($id)
	{
		$data = $this->arsip_pendidikan_model->get_by_id($id);

		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
		} else {
			$dir = "pendidikan_" . $data->id_tipe_pendidikan . '_' . $data->id_pendidikan . '_' . $id;
			$path = file_get_contents('asset/upload/pendidikan/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function download_all()
	{
		$this->load->library('zip');
		$objArsip = $this->arsip_pendidikan_model->get_by_id_input($this->session->userdata('id_pegawai'));

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pendidikan_' . $arsip->id_tipe_pendidikan . '_' . $arsip->id_pendidikan . '_' . $arsip->id_arsip_pendidikan;
				$pathFile = FCPATH . 'asset/upload/pendidikan/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pendidikan/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_PENDIDIKAN.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_adm_pendidikan($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_PENDIDIKAN.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_pendidikan WHERE created_id = '$Id'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pendidikan_' . $arsip->id_tipe_pendidikan . '_' . $arsip->id_pendidikan . '_' . $arsip->id_arsip_pendidikan;
				$pathFile = FCPATH . 'asset/upload/pendidikan/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pendidikan/' . $dir . '/' . $arsip->file_name);
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
