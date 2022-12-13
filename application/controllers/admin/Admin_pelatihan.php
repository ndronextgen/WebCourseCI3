<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pelatihan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('pelatihan_model', 'tbl_data_pelatihan');
		$this->load->model('arsip_pelatihan_model');
	}
	
	public function pelatihan_add()
	{
		$response = array('status' => false);
		$validate_pelatihan = $this->_validate_pelatihan();
		
		$data = array(
				'id_master_pelatihan' => $this->input->post('mdlArsip_Pelatihan_id_master_pelatihan'),
				'nama_pelatihan_lainnya' => $this->input->post('mdlArsip_Pelatihan_nama_pelatihan_lainnya'),
				'lokasi' => $this->input->post('mdlArsip_Pelatihan_lokasi'),
				'kota' => $this->input->post('mdlArsip_Pelatihan_kota'),
				'no_sertifikat' => $this->input->post('mdlArsip_Pelatihan_no_sertifikat'),
				'tanggal_sertifikat' => $this->input->post('mdlArsip_Pelatihan_tanggal_sertifikat'),
				'id_pegawai' => $this->input->post('mdlArsip_Pelatihan_id_pegawai'),
				'uraian' => $this->input->post('mdlArsip_Pelatihan_uraian'),
			);
			
		if ($validate_pelatihan['status'] == true) {
			$insert_id = $this->tbl_data_pelatihan->save($data);
			$response = array('status' => true);
			
			if ($insert_id) {
				if ($_FILES['mdlArsip_Pelatihan_file']['name'] != '') {
					$ins = [
						'id_pelatihan' => $insert_id,
						'title' => $this->input->post('mdlArsip_Pelatihan_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_Pelatihan_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pelatihan', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_pelatihan->update_arsip(
							['id_arsip_pelatihan' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_pelatihan->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_pelatihan->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/pelatihan/pelatihan_'.$id_arsip.'_'.$insert_id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						$response = array('status' => false);
					}
				}
			}
		}
		else {
			$response = $validate_pelatihan;
		}
		
		echo json_encode($response);
	}
	
	public function pelatihan_edit()
	{
		$response = array('status' => false);
		$validate_pelatihan = $this->_validate_pelatihan();

		$id = $this->input->post('mdlArsip_Pelatihan_id');
		
		$data = array(
				'id_master_pelatihan' => $this->input->post('mdlArsip_Pelatihan_id_master_pelatihan'),
				'nama_pelatihan_lainnya' => $this->input->post('mdlArsip_Pelatihan_nama_pelatihan_lainnya'),
				'lokasi' => $this->input->post('mdlArsip_Pelatihan_lokasi'),
				'kota' => $this->input->post('mdlArsip_Pelatihan_kota'),
				'no_sertifikat' => $this->input->post('mdlArsip_Pelatihan_no_sertifikat'),
				'tanggal_sertifikat' => $this->input->post('mdlArsip_Pelatihan_tanggal_sertifikat'),
				'id_pegawai' => $this->input->post('mdlArsip_Pelatihan_id_pegawai'),
				'uraian' => $this->input->post('mdlArsip_Pelatihan_uraian'),
			);

		$updId = [
			'id_pelatihan' => $id
		];

		if ($validate_pelatihan['status'] == true) { 
			$this->tbl_data_pelatihan->update($updId,$data);
			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Pelatihan_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_pelatihan->get_arsip_by_id_ref($id);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/pelatihan/pelatihan_'.$oldArsip->id_arsip_pelatihan.'_'.$id;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_pelatihan->delete_arsip($oldArsip->id_arsip_pelatihan);
				}

				$ins = [
					'id_pelatihan' => $id,
					'title' => $this->input->post('mdlArsip_Pelatihan_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'created_id' => $this->input->post('mdlArsip_Pelatihan_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_pelatihan', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_pelatihan->update_arsip(
						['id_arsip_pelatihan' => $id_arsip], 
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);

					$response = ['status' => true];
				}
				else {
					//delete tabel arsip
					$this->tbl_data_pelatihan->delete_arsip($id_arsip);

					//delete tabel riwayat pendidikan
					$this->tbl_data_pelatihan->delete_by_id($id);
				
					//delete arsip file
					$path = './asset/upload/pelatihan/pelatihan_'.$oldArsip->id_arsip_pelatihan.'_'.$id;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}
				}
			}
			else {
				$response = ['status' => true];
			}
		}
		else {
			$response = $validate_pelatihan;
		}
		
		echo json_encode($response);
	}
	
	private function _validate_pelatihan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Pelatihan_id_master_pelatihan') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Pelatihan_id_master_pelatihan';
			$data['error_string'][] = 'Nama Pelatihan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pelatihan_lokasi') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Pelatihan_lokasi';
			$data['error_string'][] = 'Lokasi wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pelatihan_no_sertifikat') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Pelatihan_no_sertifikat';
			$data['error_string'][] = 'Nomor Sertifikat wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pelatihan_tanggal_sertifikat') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Pelatihan_tanggal_sertifikat';
			$data['error_string'][] = 'Tanggal Sertifikat wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pelatihan_id_master_pelatihan') == 394)
		{
			if($this->input->post('mdlArsip_Pelatihan_nama_pelatihan_lainnya') == '') {
				$data['inputerror'][] = 'mdlArsip_Pelatihan_nama_pelatihan_lainnya';
				$data['error_string'][] = 'Nama Pelatihan Lainnya wajib diisi';
				$data['status'] = FALSE;
			}
		}
		
		if($this->input->post('mdlArsip_Pelatihan_title') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Pelatihan_title';
			$data['error_string'][] = 'Nama File wajib diisi';
			$data['status'] = FALSE;
		}
		
		return $data;
	}
	
	private function _do_upload($id,$id_pelatihan=0) {
		$dir = "pelatihan_".$id_pelatihan.'_'.$id;
		$config['upload_path']          = './asset/upload/pelatihan/'.$dir;
        $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte
		
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}
		log_message('debug', 'do upload : '.$dir);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;
		
		if ($_FILES['mdlArsip_Pelatihan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Pelatihan_file']['name']);
			$_FILES['mdlArsip_Pelatihan_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_Pelatihan_file')) ||  $_FILES['mdlArsip_Pelatihan_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_Pelatihan_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Pelatihan_file']['name'];
            }
		}
		
		return $data;
	}
		
}

