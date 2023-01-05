<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_pribadi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('arsip_pribadi_model');
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('file');
		$this->load->helper('download');
	}

	public function pribadi_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->arsip_pribadi_model->get_datatables($id);
		$data = array();
		$no = $_POST['start'] + 1;
		foreach ($list as $r) {
			$row = array();

			// === begin: kolom "file" === 
			$path_file 		= 'asset/upload/pribadi/pribadi_' . $r->id_data_keluarga . '_' . $r->id_arsip_pribadi;
			$path_folder	= $path_file . '/' . $r->file_name;
			if (file_exists($path_folder)) {
				$ext = pathinfo($path_folder, PATHINFO_EXTENSION);

				if (strtolower($ext) == 'pdf') {
					$file = '	<a data-fancybox data-type="iframe" data-src="' . base_url($path_folder) . '" href="javascript:void(0);">
									<button type="button" class="btn btn-danger btn-sm" title="' . $r->file_name_ori . '"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>
								</a>';
				} else {
					$file = '	<a data-fancybox="images" href="' . base_url($path_folder) . '" target="_blank">
									<img height="40px" width="40px" src="' . base_url($path_folder) . '" title="' . $r->file_name_ori . '">
								</a>';
				}
			} else {
				$file = '-';
				goto skip_row;
			}
			// === end: kolom "file" ===

			$row[] = $no;
			$row[] = $r->title;
			$row[] = $r->file_name_ori;
			$row[] = $file;

			$button = ' <a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_pribadi(' . "'" . $r->id_arsip_pribadi . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pribadi(' . "'" . $r->id_arsip_pribadi . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-pribadi" data-id="' . utf8_encode($r->id_arsip_pribadi) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';
			$row[] = $button;

			$data[] = $row;

			$no++;
			skip_row:
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

	public function pribadi_lihat($id_pribadi)
	{
		$data = $this->arsip_pribadi_model->get_by_id($id_pribadi);
		echo json_encode($data);
	}

	public function pribadi_edit($id_pribadi)
	{
		$data = $this->arsip_pribadi_model->get_by_id($id_pribadi);
		echo json_encode($data);
	}

	public function pribadi_add()
	{
		$status = true;
		$this->_validate_pribadi();
		$data = array(
			'title' => $this->input->post('title_pribadi'),
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert_id = $this->arsip_pribadi_model->save($data);

		if ($insert_id != 0) {
			if (!empty($_FILES['file_pribadi']['name'])) {
				$upload = $this->_do_upload($insert_id, $insert_id);
				$upd['id_data_keluarga'] = $insert_id;
				$upd['file_name'] = $upload;
				$upd['file_name_ori'] = $_FILES['file_pribadi']['name'];

				$this->arsip_pribadi_model->update(array('id_arsip_pribadi' => $insert_id), $upd);
			}
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function pribadi_update()
	{
		$status = true;
		$this->_validate_pribadi();

		$data = array(
			'title' => $this->input->post('title_pribadi'),
			'id_arsip_pribadi' => $this->input->post('id_pribadi')
		);

		$id = $this->input->post('id_pribadi');
		$dataOld = $this->arsip_pribadi_model->get_by_id($id);
		if ($dataOld != null) {
			if (!empty($_FILES['file_pribadi']['name'])) {
				//delete old file
				$path = 'asset/upload/pribadi/pribadi_' . $dataOld->id_data_keluarga . '_' . $id . '/' . $dataOld->file_name;

				if (file_exists($path))
					unlink($path);

				$upload = $this->_do_upload($id, $dataOld->id_data_keluarga);
				$data['file_name'] = $upload;
				$data['file_name_ori'] = $_FILES['file_pribadi']['name'];
			}

			$this->arsip_pribadi_model->update(array('id_arsip_pribadi' => $id), $data);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function pribadi_delete($id_pribadi)
	{
		$status = true;
		$data = $this->arsip_pribadi_model->get_by_id($id_pribadi);

		if ($data != null) {
			$dir = "asset/upload/pribadi/pribadi_" . $data->id_data_keluarga . "_" . $id_pribadi;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_pribadi_model->delete_by_id($id_pribadi);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	private function _do_upload($insert_id, $id_ref = 0)
	{
		$dir = "pribadi_" . $id_ref . "_" . $insert_id;
		$path = "./asset/upload/pribadi/" . $dir;

		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_pribadi')) //upload and validate
		{
			$data['inputerror'][] = 'file_pribadi';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}

		return $this->upload->data('file_name');
	}

	private function _validate_pribadi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('title_pribadi') == '') {
			$data['inputerror'][] = 'title_pribadi';
			$data['error_string'][] = 'Judul Data Pribadi wajib di isi';
			$data['status'] = FALSE;
		}

		if ($_FILES['file_pribadi']['name'] == '') {
			$data['inputerror'][] = 'file_pribadi';
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
		$data = $this->arsip_pribadi_model->get_by_id($id);

		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
			redirect(base_url() . 'dashboard_publik/arsip_digital/');
		} else {
			$dir = "pribadi_" . $data->id_data_keluarga . "_" . $id;
			$path = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function pribadi_list($id)
	{
		$list = $this->arsip_pribadi_model->get_datatables($id);

		echo json_encode($list);
	}

	public function download_file($id)
	{
		$data = $this->arsip_pribadi_model->get_by_id($id);

		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
		} else {
			$dir = "pribadi_" . $data->id_data_keluarga . "_" . $id;
			$path = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function download_all()
	{
		$this->load->library('zip');
		$objArsip = $this->arsip_pribadi_model->get_by_id_input($this->session->userdata('id_pegawai'));

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pribadi_' . $arsip->id_data_keluarga . '_' . $arsip->id_arsip_pribadi;
				$pathFile = FCPATH . 'asset/upload/pribadi/' . $dir . '/' . $arsip->file_name;
				$file = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $arsip->file_name);

				if (file_exists($pathFile)) {
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_PRIBADI.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	// ---------------
	public function modal_arsip_pribadi()
	{
		$param = $this->input->post('param');
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_data_pegawai WHERE id_pegawai='$Id'")->row();

		$this->load->view('dashboard_admin/home/arsip/modal_arsip_pribadi', $a);
	}

	public function arsip_pribadi_add()
	{
		$status = true;
		$this->_validate_pribadi();
		$data = array(
			'title' => $this->input->post('title_pribadi'),
			'created_id' => $this->input->post('Id'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert_id = $this->arsip_pribadi_model->save($data);

		if ($insert_id != 0) {
			if (!empty($_FILES['file_pribadi']['name'])) {
				$upload = $this->_do_upload($insert_id, $insert_id);
				$upd['id_data_keluarga'] = $insert_id;
				$upd['file_name'] = $upload;
				$upd['file_name_ori'] = $_FILES['file_pribadi']['name'];

				$this->arsip_pribadi_model->update(array('id_arsip_pribadi' => $insert_id), $upd);
			}
		} else {
			$status = false;
		}

		//echo json_encode(array("status" => $status));
		echo 'Berhasil';
	}

	public function modal_arsip_pribadi_edit()
	{
		$param = $this->input->post('param');
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_arsip_pribadi WHERE id_arsip_pribadi='$Id'")->row();

		$this->load->view('dashboard_admin/home/arsip/modal_arsip_pribadi_edit', $a);
	}

	public function arsip_pribadi_update()
	{
		$status = true;
		$this->_validate_pribadi();

		$data = array(
			'title' => $this->input->post('title_pribadi'),
			'id_arsip_pribadi' => $this->input->post('id_pribadi')
		);

		$id = $this->input->post('id_pribadi');
		$dataOld = $this->arsip_pribadi_model->get_by_id($id);
		if ($dataOld != null) {
			if (!empty($_FILES['file_pribadi']['name'])) {
				//delete old file
				$path = 'asset/upload/pribadi/pribadi_' . $dataOld->id_data_keluarga . '_' . $id . '/' . $dataOld->file_name;

				if (file_exists($path))
					unlink($path);

				$upload = $this->_do_upload($id, $dataOld->id_data_keluarga);
				$data['file_name'] = $upload;
				$data['file_name_ori'] = $_FILES['file_pribadi']['name'];
			}

			$this->arsip_pribadi_model->update(array('id_arsip_pribadi' => $id), $data);
		} else {
			$status = false;
		}

		//echo json_encode(array("status" => $status));
		echo 'Berhasil';
	}

	public function modal_arsip_pribadi_detail()
	{
		$param = $this->input->post('param');
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_arsip_pribadi WHERE id_arsip_pribadi='$Id'")->row();

		$this->load->view('dashboard_admin/home/arsip/modal_arsip_pribadi_detail', $a);
	}

	public function arsip_pribadi_delete()
	{
		$id_pribadi = $this->input->post('Id');
		$status = true;
		$data = $this->arsip_pribadi_model->get_by_id($id_pribadi);

		if ($data != null) {
			$dir = "asset/upload/pribadi/pribadi_" . $data->id_data_keluarga . "_" . $id_pribadi;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_pribadi_model->delete_by_id($id_pribadi);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	// ----------------

	public function download_all_dp_arsip()
	{
		$this->load->library('zip');
		$Id = $this->session->userdata('id_pegawai');
		//$objArsip = $this->arsip_pribadi_model->get_by_id_input($this->session->userdata('id_pegawai'));
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_pribadi 
										WHERE 
										id_data_keluarga not in (SELECT id_data_keluarga FROM tbl_data_keluarga)
										AND created_id = '$Id'
									")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pribadi_' . $arsip->id_data_keluarga . '_' . $arsip->id_arsip_pribadi;
				$pathFile = FCPATH . 'asset/upload/pribadi/' . $dir . '/' . $arsip->file_name;
				$file = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $arsip->file_name);

				if (file_exists($pathFile)) {
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_PRIBADI.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_dp_keluarga()
	{
		$this->load->library('zip');
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT *, id_arsip_pribadi FROM tbl_data_keluarga 
										LEFT JOIN (
											SELECT id_data_keluarga, file_name_ori, file_name, id_arsip_pribadi FROM tbl_arsip_pribadi
										) AS ar ON ar.id_data_keluarga = tbl_data_keluarga.id_data_keluarga
										WHERE id_pegawai = '$Id' 
									")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pribadi_' . $arsip->id_data_keluarga . '_' . $arsip->id_arsip_pribadi;
				$pathFile = FCPATH . 'asset/upload/pribadi/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_PRIBADI.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	//admin

	public function download_all_adm_kel($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();

		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_KELUARGA.zip';
		$objArsip = $this->db->query("SELECT *, id_arsip_pribadi FROM tbl_data_keluarga 
										LEFT JOIN (
											SELECT id_data_keluarga, file_name_ori, file_name, id_arsip_pribadi FROM tbl_arsip_pribadi
										) AS ar ON ar.id_data_keluarga = tbl_data_keluarga.id_data_keluarga
										WHERE id_pegawai = '$Id' 
									")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pribadi_' . $arsip->id_data_keluarga . '_' . $arsip->id_arsip_pribadi;
				$pathFile = FCPATH . 'asset/upload/pribadi/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_adm_arsip_pribadi($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_PRIBADI.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_pribadi 
										WHERE 
										id_data_keluarga not in (SELECT id_data_keluarga FROM tbl_data_keluarga)
										AND created_id = '$Id' AND id_data_keluarga = '0'
									")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'pribadi_' . $arsip->id_data_keluarga . '_' . $arsip->id_arsip_pribadi;
				$pathFile = FCPATH . 'asset/upload/pribadi/' . $dir . '/' . $arsip->file_name;

				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		if ($zip) {
			$this->zip->download($filename);
		}
	}


	// ----------------
}
