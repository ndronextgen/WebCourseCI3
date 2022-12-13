<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_hukuman extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('arsip_hukuman_model');
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('file');
		$this->load->helper('download');
	}

	public function hukuman_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->arsip_hukuman_model->get_datatables($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->title;
			$row[] = $r->file_name_ori;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Lihat" onclick="lihat_file_hukuman(' . "'" . $r->id_arsip_hukuman . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Lihat File</a>
					  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-hukuman" data-id="' . utf8_encode($r->id_arsip_hukuman) . '" data-title="Download" title="Download Data">
					  <i class="fa fa-download"></i> Download</button>';

			$row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_hukuman(' . "'" . $r->id_arsip_hukuman . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_hukuman(' . "'" . $r->id_arsip_hukuman . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->arsip_pribadi_model->count_all($id),
			"recordsFiltered" => $this->arsip_pribadi_model->count_filtered($id),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function hukuman_lihat($id)
	{
		$data = $this->arsip_hukuman_model->get_by_id($id);
		echo json_encode($data);
	}

	public function hukuman_edit($id)
	{
		$data = $this->arsip_hukuman_model->get_by_id($id);
		echo json_encode($data);
	}

	public function hukuman_add()
	{
		$status = true;
		$this->_validate_hukuman();
		$data = array(
			'title' => $this->input->post('title_hukuman'),
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert_id = $this->arsip_hukuman->save($data);

		if ($insert_id != 0) {
			if (!empty($_FILES['file_hukuman']['name'])) {
				$upload = $this->_do_upload($insert_id, $insert_id);
				$upd['id_hukuman'] = $insert_id;
				$upd['file_name'] = $upload;
				$upd['file_name_ori'] = $_FILES['file_hukuman']['name'];

				$this->arsip_hukuman_model->update(array('id_arsip_hukuman' => $insert_id), $upd);
			}
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function hukuman_update()
	{
		$status = true;
		$this->_validate_hukuman();

		$data = array(
			'title' => $this->input->post('title_hukuman'),
			'id_arsip_hukuman' => $this->input->post('id_hukuman')
		);

		$id = $this->input->post('id_hukuman');
		$dataOld = $this->arsip_hukuman_model->get_by_id($id);
		if ($dataOld != null) {
			if (!empty($_FILES['file_hukuman']['name'])) {
				//delete old file
				$path = 'asset/upload/Hukuman/Hukuman' . $dataOld->id_hukuman . '_' . $id . '/' . $dataOld->file_name;

				if (file_exists($path))
					unlink($path);

				$upload = $this->_do_upload($id, $dataOld->id_hukuman);
				$data['file_name'] = $upload;
				$data['file_name_ori'] = $_FILES['file_hukuman']['name'];
			}

			$this->arsip_hukuman_model->update(array('id_arsip_hukuman' => $id), $data);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function hukuman_delete($id)
	{
		$status = true;
		$data = $this->arsip_hukuman_model->get_by_id($id);

		if ($data != null) {
			$dir = "asset/upload/Hukuman/Hukuman_" . $data->id_hukuman . "_" . $id;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_hukuman_model->delete_by_id($id);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	private function _do_upload($insert_id, $id_ref = 0)
	{
		$dir = "Hukuman_" . $id_ref . "_" . $insert_id;
		$path = "./asset/upload/Hukuman/" . $dir;

		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_hukuman')) //upload and validate
		{
			$data['inputerror'][] = 'file_hukuman';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}

		return $this->upload->data('file_name');
	}

	private function _validate_hukuman()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('title_hukuman') == '') {
			$data['inputerror'][] = 'title_hukuman';
			$data['error_string'][] = 'Judul wajib di isi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	public function download($id)
	{
		$data = $this->arsip_hukuman_model->get_by_id($id);

		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
			redirect(base_url() . 'dashboard_publik/arsip_digital/');
		} else {
			$dir = "Hukuman_" . $data->id_hukuman . "_" . $id;
			$path = file_get_contents('asset/upload/Hukuman/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function hukuman_list($id)
	{
		$list = $this->arsip_hukuman_model->get_datatables($id);

		echo json_encode($list);
	}

	public function download_file($id)
	{
		$data = $this->arsip_hukuman_model->get_by_id($id);

		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
		} else {
			$dir = "Hukuman_" . $data->id_hukuman . "_" . $id;
			$path = file_get_contents('asset/upload/Hukuman/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function download_all()
	{
		$this->load->library('zip');
		$objArsip = $this->arsip_hukuman_model->get_by_id_input($this->session->userdata('id_pegawai'));

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'Hukuman_' . $arsip->id_hukuman . '_' . $arsip->id_arsip_hukuman;
				$pathFile = FCPATH . 'asset/upload/Hukuman/' . $dir . '/' . $arsip->file_name;


				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/Hukuman/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_HUKUMAN.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_adm_hukuman($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_HUKUMAN.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_hukuman WHERE created_id = '$Id'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'Hukuman_' . $arsip->id_hukuman . '_' . $arsip->id_arsip_hukuman;
				$pathFile = FCPATH . 'asset/upload/Hukuman/' . $dir . '/' . $arsip->file_name;

				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/Hukuman/' . $dir . '/' . $arsip->file_name);
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
