<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_sklainnya extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('arsip_sklainnya_model', 'arsip_sk_model');
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('file');
		$this->load->helper('download');
	}

	public function sk_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->arsip_sk_model->get_datatables($id);
		$data = array();
		$no = (isset($_POST['start']) ? $_POST['start'] : 0) + 1;

		foreach ($list as $r) {
			$row = array();

			// === begin: file preview ===
			//$path = 'asset/upload/SK/SK_'.$dataOld->id_jenis_sk.'_'.$dataOld->id_ref.'_'.$id.'/'.$dataOld->file_name;
			$path_file = 'asset/upload/SK/SK_' . $r->id_jenis_sk . '_' . $r->id_ref . '_' . $r->id_arsip_sk;
			$path_folder = $path_file . '/' . $r->file_name;
			$is_file_exist = file_exists($path_folder);

			if ($is_file_exist) {
				$ext = pathinfo($path_folder, PATHINFO_EXTENSION);

				if (strtolower($ext) == 'pdf') {
					$file = '<a data-fancybox data-type="iframe" data-src="' . base_url($path_folder) . '" href="javascript:void(0);">
								<button type="button" class="btn btn-sm btn-danger" title="' . $r->file_name_ori . '"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>
							</a>';
				} else {
					$file = '<a data-fancybox="images" href="' . base_url($path_folder) . '" target="_blank">
								<img height="30px" src="' . base_url($path_folder) . '" title="' . $r->file_name_ori . '">
							</a>';
				}
			} else {
				$file = '-';
				goto skip_row;
			}
			// === end: file preview ===

			$row[] = $no;
			$row[] = $r->title;
			$row[] = $r->jenis_sk;
			$row[] = $r->file_name_ori;
			$row[] = $file;

			// $row[] = '	<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Lihat" onclick="lihat_file('."'".$r->id_arsip_sk."'".')"><i class="glyphicon glyphicon-pencil"></i> Lihat File</a>
			// 				<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-download-sk" data-id="'.utf8_encode($r->id_arsip_sk).'" data-title="Download" title="Download Data"><i class="fa fa-download"></i> Download</button>
			//   			<a class="btn btn-sm btn-success" href="javascript:void(0)" title="lihat detail" onclick="detail_sklainnya('."'".$r->id_arsip_sk."'".')"><i class="glyphicon glyphicon-eye-open"></i></a> ';
			$button = '	<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_sk(' . "'" . $r->id_arsip_sk . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_sk(' . "'" . $r->id_arsip_sk . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
			if ($is_file_exist) {
				$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-sk" data-id="' . utf8_encode($r->id_arsip_sk) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';
			}
			$row[] = $button;

			$data[] = $row;

			$no++;
			skip_row:
		}

		$output = array(
			"draw" => (isset($_POST['draw']) ? $_POST['draw'] : ''),
			"recordsTotal" => $this->arsip_sk_model->count_all($id),
			"recordsFiltered" => $this->arsip_sk_model->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function sk_lihat($id)
	{
		$data = $this->arsip_sk_model->get_by_id($id);
		echo json_encode($data);
	}

	public function sk_edit($id)
	{
		$data = $this->arsip_sk_model->get_by_id($id);
		echo json_encode($data);
	}

	public function sk_add()
	{
		$status = true;
		$this->_validate_sk();
		$data = array(
			'title' => $this->input->post('title_sk'),
			'id_jenis_sk' => 4, //jenis sk lainnya
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert_id = $this->arsip_sk_model->save($data);

		if ($insert_id != 0) {
			if (!empty($_FILES['file_sk']['name'])) {
				$upload = $this->_do_upload($insert_id, 4, $insert_id);
				$upd['id_ref'] = $insert_id;
				$upd['file_name'] = $upload;
				$upd['file_name_ori'] = $_FILES['file_sk']['name'];
				$this->arsip_sk_model->update(array('id_arsip_sk' => $insert_id), $upd);
			}
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function sk_update()
	{
		$status = true;
		$this->_validate_sk();
		$data = array(
			'title' => $this->input->post('title_sk'),
			'id_arsip_sk' => $this->input->post('id_sk')
		);

		$id = $this->input->post('id_sk');
		$dataOld = $this->arsip_sk_model->get_by_id($id);

		if ($dataOld != null) {
			if (!empty($_FILES['file_sk']['name'])) {
				//delete old file
				$path = 'asset/upload/SK/SK_' . $dataOld->id_jenis_sk . '_' . $dataOld->id_ref . '_' . $id . '/' . $dataOld->file_name;

				if (file_exists($path))
					unlink($path);

				$upload = $this->_do_upload($id, $dataOld->id_jenis_sk, $dataOld->id_ref);

				$data['file_name'] = $upload;
				$data['file_name_ori'] = $_FILES['file_sk']['name'];
			}

			$this->arsip_sk_model->update(array('id_arsip_sk' => $id), $data);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	public function sk_delete($id_sk)
	{
		$status = true;
		$data = $this->arsip_sk_model->get_by_id($id_sk);

		if ($data != null) {
			$path = "asset/upload/SK/SK_" . $data->id_jenis_sk . "_" . $data->id_ref . "_" . $id_sk;
			log_message('debug', 'path : ' . $path);

			if (is_dir($path)) {
				log_message('debug', 'is_dir');
				delete_files($path, true);
				rmdir($path);
			}

			$this->arsip_sk_model->delete_by_id($id_sk);
		} else {
			$status = false;
		}

		echo json_encode(array("status" => $status));
	}

	private function _do_upload($id, $id_jenis_sk, $id_ref = 0)
	{
		$dir = "SK_" . $id_jenis_sk . "_" . $id_ref . '_' . $id;
		$path = "./asset/upload/SK/" . $dir;
		log_message('debug', 'path: ' . $path);

		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		log_message('debug', $path);
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_sk')) //upload and validate
		{
			$data['inputerror'][] = 'file_sk';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}

		return $this->upload->data('file_name');
	}

	private function _validate_sk()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('title_sk') == '') {
			$data['inputerror'][] = 'title_sk';
			$data['error_string'][] = 'Judul SK wajib di isi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	public function download($id)
	{
		$data = $this->arsip_sk_model->get_by_id($id);
		log_message('debug', json_encode($data));
	}

	public function sk_list($id)
	{
		$list = $this->arsip_sk_model->get_datatables($id);

		echo json_encode($list);
	}

	public function download_file($id)
	{
		$data = $this->arsip_sk_model->get_by_id($id);
		if ($data == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
		} else {
			$dir = "SK_" . $data->id_jenis_sk . "_" . $data->id_ref . '_' . $data->id_arsip_sk;
			$path = file_get_contents('asset/upload/SK/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita
			force_download($data->file_name_ori, $path);
		}
	}

	public function download_all()
	{
		$this->load->library('zip');
		$objArsip = $this->arsip_sk_model->get_by_id_input($this->session->userdata('id_pegawai'));

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
				$pathFile = FCPATH . 'asset/upload/SK/' . $dir . '/' . $arsip->file_name;
				$file = file_get_contents('asset/upload/SK/' . $dir . '/' . $arsip->file_name);

				if (file_exists($pathFile)) {
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}

		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_SK.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	// --------
	public function modal_arsip_sk()
	{
		$param = $this->input->post('param');
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_data_pegawai WHERE id_pegawai='$Id'")->row();

		$this->load->view('dashboard_admin/home/arsip/modal_arsip_sk', $a);
	}

	public function arsip_sk_add()
	{
		$status = true;
		$this->_validate_sk();
		$data = array(
			'title' => $this->input->post('title_sk'),
			'id_jenis_sk' => 4, //jenis sk lainnya
			'created_id' => $this->input->post('Id'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert_id = $this->arsip_sk_model->save($data);

		if ($insert_id != 0) {
			if (!empty($_FILES['file_sk']['name'])) {
				$upload = $this->_do_upload($insert_id, 4, $insert_id);
				$upd['id_ref'] = $insert_id;
				$upd['file_name'] = $upload;
				$upd['file_name_ori'] = $_FILES['file_sk']['name'];
				$this->arsip_sk_model->update(array('id_arsip_sk' => $insert_id), $upd);
			}
		} else {
			$status = false;
		}

		//echo json_encode(array("status" => $status));
		echo 'Berhasil';
	}

	public function modal_arsip_sk_edit()
	{
		$param = $this->input->post('param');
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE id_arsip_sk='$Id'")->row();

		$this->load->view('dashboard_admin/home/arsip/modal_arsip_sk_edit', $a);
	}

	public function arsip_sk_update()
	{
		$status = true;
		$this->_validate_sk();
		$data = array(
			'title' => $this->input->post('title_sk'),
			'id_arsip_sk' => $this->input->post('id_sk')
		);

		$id = $this->input->post('id_sk');
		$dataOld = $this->arsip_sk_model->get_by_id($id);

		if ($dataOld != null) {
			if (!empty($_FILES['file_sk']['name'])) {
				//delete old file
				$path = 'asset/upload/SK/SK_' . $dataOld->id_jenis_sk . '_' . $dataOld->id_ref . '_' . $id . '/' . $dataOld->file_name;

				if (file_exists($path))
					unlink($path);

				$upload = $this->_do_upload($id, $dataOld->id_jenis_sk, $dataOld->id_ref);

				$data['file_name'] = $upload;
				$data['file_name_ori'] = $_FILES['file_sk']['name'];
			}

			$this->arsip_sk_model->update(array('id_arsip_sk' => $id), $data);
		} else {
			$status = false;
		}

		//echo json_encode(array("status" => $status));
		echo 'Berhasil';
	}

	public function modal_arsip_sk_detail()
	{
		$param = $this->input->post('param');
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE id_arsip_sk='$Id'")->row();

		$this->load->view('dashboard_admin/home/arsip/modal_arsip_sk_detail', $a);
	}

	public function arsip_sk_delete()
	{
		$id_sk = $this->input->post('Id');
		$status = true;
		$data = $this->arsip_sk_model->get_by_id($id_sk);

		if ($data != null) {
			$path = "asset/upload/SK/SK_" . $data->id_jenis_sk . "_" . $data->id_ref . "_" . $id_sk;
			log_message('debug', 'path : ' . $path);

			if (is_dir($path)) {
				log_message('debug', 'is_dir');
				delete_files($path, true);
				rmdir($path);
			}

			$this->arsip_sk_model->delete_by_id($id_sk);
		} else {
			$status = false;
		}

		//echo json_encode(array("status" => $status));
		echo 'Berhasil';
	}

	// download newsk

	public function download_all_sk()
	{
		$this->load->library('zip');
		//$objArsip = $this->arsip_sk_model->get_by_id_input($this->session->userdata('id_pegawai'));
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE created_id = '$Id' AND id_jenis_sk = '4'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
				$pathFile = FCPATH . 'asset/upload/SK/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/SK/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_SKLainnya.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_pangkat()
	{
		$this->load->library('zip');
		//$objArsip = $this->arsip_sk_model->get_by_id_input($this->session->userdata('id_pegawai'));
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE created_id = '$Id' AND id_jenis_sk = '2'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
				$pathFile = FCPATH . 'asset/upload/SK/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/SK/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_SKPangkat.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function download_all_jabatan()
	{
		$this->load->library('zip');
		//$objArsip = $this->arsip_sk_model->get_by_id_input($this->session->userdata('id_pegawai'));
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE created_id = '$Id' AND id_jenis_sk = '3'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
				$pathFile = FCPATH . 'asset/upload/SK/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/SK/' . $dir . '/' . $arsip->file_name);
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_SKJabatan.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	// admin
	public function download_all_adm_pangkat($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_SKPangkat.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE created_id = '$Id' AND id_jenis_sk = '2'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
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

	public function download_all_adm_jabatan($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_SKJabatan.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE created_id = '$Id' AND id_jenis_sk = '3'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
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

	public function download_all_adm_sklainnya($Id)
	{
		$this->load->library('zip');
		$Query_pegawai = $this->db->query("SELECT nama_pegawai FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$filename = str_replace(' ', '_', $Query_pegawai->nama_pegawai) . '_ARSIP_DIGITAL_SKLainnya.zip';
		$objArsip = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE created_id = '$Id' AND id_jenis_sk = '4'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = 'SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
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