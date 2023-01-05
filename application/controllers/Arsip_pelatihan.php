<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_pelatihan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('arsip_pelatihan_model');
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('file');
		$this->load->helper('download');
	}

	public function pelatihan_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->arsip_pelatihan_model->get_datatables($id);
		$data = array();
		$no = $_POST['start'] + 1;
		foreach ($list as $r) {
			$row = array();

			$row[] = $no;
			$row[] = $r->title;
			$row[] = $r->file_name_ori;

			// === begin: kolom "file" ===
			$path_file = 'asset/upload/pelatihan/pelatihan_' . $r->id_pelatihan . '_' . $r->id_arsip_pelatihan;
			$path_folder    = $path_file . '/' . $r->file_name;

			if (file_exists($path_folder)) {
				$ext = pathinfo($path_folder, PATHINFO_EXTENSION);

				if (strtolower($ext['1']) == 'pdf') {
					$file = '<a data-fancybox data-type="iframe" data-src="' . base_url($path_folder) . '" href="javascript:;">
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

			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_pelatihan(' . "'" . $r->id_arsip_pelatihan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pelatihan(' . "'" . $r->id_arsip_pelatihan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_download_pelatihan" data-id="' . utf8_encode($r->id_arsip_pelatihan) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';

			$data[] = $row;

			$no++;
			skip_row:
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->arsip_pelatihan_model->count_all($id),
			"recordsFiltered" => $this->arsip_pelatihan_model->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function pelatihan_lihat($id_pelatihan)
	{
		$data = $this->arsip_pelatihan_model->get_by_id($id_pelatihan);
		echo json_encode($data);
	}

	public function pelatihan_edit($id_pelatihan)
	{
		$data = $this->arsip_pelatihan_model->get_by_id($id_pelatihan);
		echo json_encode($data);
	}

	public function pelatihan_add()
	{
		$status = true;
		$this->_validate_pelatihan();
		$data = array(
			'title' => $this->input->post('title_pelatihan'),
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert_id = $this->arsip_pelatihan_model->save($data);

		if ($insert_id != 0) {
			if (!empty($_FILES['file_pelatihan']['name'])) {
				$upload = $this->_do_upload($insert_id, $insert_id);
				$upd['id_pelatihan'] = $insert_id;
				$upd['file_name'] = $upload;
				$upd['file_name_ori'] = $_FILES['file_pelatihan']['name'];
			} else {
				$upd['id_pelatihan'] = $insert_id;
			}

			$this->arsip_pelatihan_model->update(array('id_arsip_pelatihan' => $insert_id), $upd);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function pelatihan_update()
	{
		$status = true;
		$this->_validate_pelatihan();
		$data = array(
			'title' => $this->input->post('title_pelatihan'),
			'id_arsip_pelatihan' => $this->input->post('id_pelatihan')
		);

		$id = $this->input->post('id_pelatihan');
		$dataOld = $this->arsip_pelatihan_model->get_by_id($id);

		if ($dataOld != null) {
			if (!empty($_FILES['file_pelatihan']['name'])) {
				//delete old file
				$path = 'asset/upload/pelatihan/pelatihan_' . $dataOld->id_pelatihan . '_' . $id . '/' . $dataOld->file_name;

				if (file_exists($path))
					unlink($path);

				$upload = $this->_do_upload($id, $dataOld->id_pelatihan);

				$data['file_name'] = $upload;
				$data['file_name_ori'] = $_FILES['file_pelatihan']['name'];
			}

			$this->arsip_pelatihan_model->update(array('id_arsip_pelatihan' => $id), $data);
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

	public function pelatihan_delete($id_pelatihan)
	{
		$status = true;
		$data = $this->arsip_pelatihan_model->get_by_id($id_pelatihan);

		if ($data != null) {
			$dir = "asset/upload/pelatihan/pelatihan_" . $data->id_pelatihan . "_" . $id_pelatihan;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file =  count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_pelatihan_model->delete_by_id($id_pelatihan);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	private function _do_upload($insert_id, $id_ref = 0)
	{
		$dir = "pelatihan_" . $id_ref . "_" . $insert_id;
		$path = "./asset/upload/pelatihan/" . $dir;

		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_pelatihan')) //upload and validate
		{
			$data['inputerror'][] = 'file_pelatihan';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}

		return $this->upload->data('file_name');
	}

	private function _validate_pelatihan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('title_pelatihan') == '') {
			$data['inputerror'][] = 'title_pelatihan';
			$data['error_string'][] = 'Judul pelatihan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($_FILES['file_pelatihan']['name'] == '') {
			$data['inputerror'][] = 'file_pelatihan';
			$data['error_string'][] = 'File wajib ada.';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	public function download($id)
	{
		$data = $this->arsip_pelatihan_model->get_by_id($id);

		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
			redirect(base_url() . 'dashboard_publik/arsip_digital/');
		} else {
			$dir = "pelatihan_" . $data->id_pelatihan . "_" . $id;
			$path = file_get_contents('asset/upload/pelatihan/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function pelatihan_list($id)
	{
		$list = $this->arsip_pelatihan_model->get_datatables($id);

		echo json_encode($list);
	}

	public function download_file($id)
	{
		$data = $this->arsip_pelatihan_model->get_by_id($id);

		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
		} else {
			$dir = "pelatihan_" . $data->id_pelatihan . "_" . $id;
			$path = file_get_contents('asset/upload/pelatihan/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function download_all()
	{
		$this->load->library('zip');
		$objArsip = $this->arsip_pelatihan_model->get_by_id_input($this->session->userdata('id_pegawai'));

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pelatihan_' . $arsip->id_pelatihan . '_' . $arsip->id_arsip_pelatihan;
				$pathFile = FCPATH . 'asset/upload/pelatihan/' . $dir . '/' . $arsip->file_name;

				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pelatihan/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		//$filename = str_replace(' ','_',$this->session->userdata('nama')).'.zip';
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_PENDIDIKAN_NONFROMAL.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_adm_pelatihan($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_PENDIDIKAN_NONFROMAL.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_pelatihan WHERE created_id = '$Id'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pelatihan_' . $arsip->id_pelatihan . '_' . $arsip->id_arsip_pelatihan;
				$pathFile = FCPATH . 'asset/upload/pelatihan/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pelatihan/' . $dir . '/' . $arsip->file_name);
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
