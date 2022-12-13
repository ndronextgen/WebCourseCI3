<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_penghargaan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('penghargaan_model', 'tbl_data_penghargaan');
		$this->load->model('arsip_sk_model');
		$this->jenis_sk = 5;
	}
	
	public function penghargaan_add()
	{
		$response = array('status' => true);
		$validate_penghargaan = $this->_validate_penghargaan();
		$id = $this->session->userdata('id_pegawai');
		
		$data = array(
				'id_master_penghargaan' => $this->input->post('mdlArsip_Penghargaan_id_master_penghargaan'),
				'nama_penghargaan_lainnya' => $this->input->post('mdlArsip_Penghargaan_nama_penghargaan_lainnya'),
				'pemberi_penghargaan' => $this->input->post('mdlArsip_Penghargaan_pemberi_penghargaan'),
				'nomor_sk' => $this->input->post('mdlArsip_Penghargaan_nomor_sk'),
				'tgl_sk_penghargaan' => $this->input->post('mdlArsip_Penghargaan_tgl_sk_penghargaan'),
				'id_pegawai' => $this->input->post('mdlArsip_Penghargaan_id_pegawai')
			);
			
		if ($validate_penghargaan['status'] == true) {
			$insert_id = $this->tbl_data_penghargaan->save($data);
			
			if ($insert_id) {
				if ($_FILES['mdlArsip_Penghargaan_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $this->input->post('mdlArsip_Penghargaan_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_Penghargaan_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_penghargaan->update_arsip(
							['id_arsip_sk' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_penghargaan->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_penghargaan->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id_arsip.'_'.$insert_id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		}
		else {
			$response = $validate_penghargaan;
		}
		
		echo json_encode($response);
	}
	
	public function penghargaan_edit()
	{
		$response = array('status' => false);
		$validate_penghargaan = $this->_validate_penghargaan();
		$id = $this->input->post('mdlArsip_Penghargaan_id');
		
		$data = array(
				'id_master_penghargaan' => $this->input->post('mdlArsip_Penghargaan_id_master_penghargaan'),
				'nama_penghargaan_lainnya' => $this->input->post('mdlArsip_Penghargaan_nama_penghargaan_lainnya'),
				'pemberi_penghargaan' => $this->input->post('mdlArsip_Penghargaan_pemberi_penghargaan'),
				'nomor_sk' => $this->input->post('mdlArsip_Penghargaan_nomor_sk'),
				'tgl_sk_penghargaan' => $this->input->post('mdlArsip_Penghargaan_tgl_sk_penghargaan'),
				'id_pegawai' => $this->input->post('mdlArsip_Penghargaan_id_pegawai')
			);

		$updId = [
			'id_penghargaan' => $id
		];
		
		if ($validate_penghargaan['status'] == true) { 
			$this->tbl_data_penghargaan->update($updId,$data);

			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Penghargaan_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_penghargaan->get_arsip_by_id_ref($id, $this->jenis_sk);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id.'_'.$oldArsip->id_arsip_sk;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_penghargaan->delete_arsip($oldArsip->id_arsip_sk);
				}

				$ins = [
					'id_ref' => $id,
					'title' => $this->input->post('mdlArsip_Penghargaan_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'id_jenis_sk' => $this->jenis_sk,
					'created_id' => $this->input->post('mdlArsip_Penghargaan_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_sk', $ins);
				$id_arsip = $this->db->insert_id();
				
				$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_penghargaan->update_arsip(
						['id_arsip_sk' => $id_arsip], 
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);

					$response = ['status' => true];
				}
				else {
					//delete tabel arsip
					$this->tbl_data_penghargaan->delete_arsip($id_arsip);

					//delete tabel riwayat pangkat
					$this->tbl_data_penghargaan->delete_by_id($id);
				
					//delete arsip file
					$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id.'_'.$oldArsip->id_arsip_sk;
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
			$response = $validate_penghargaan;
		}
		
		echo json_encode($response);
	}
	
	private function _validate_penghargaan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Penghargaan_id_master_penghargaan') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Penghargaan_id_master_penghargaan';
			$data['error_string'][] = 'Nama penghargaan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Penghargaan_pemberi_penghargaan') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Penghargaan_pemberi_penghargaan';
			$data['error_string'][] = 'Pemberi Penghargaan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Penghargaan_nomor_sk') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Penghargaan_nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Penghargaan_tgl_sk_penghargaan') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Penghargaan_tgl_sk_penghargaan';
			$data['error_string'][] = 'Tanggal SK wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Penghargaan_id_master_penghargaan') == 394)
		{
			if($this->input->post('mdlArsip_Penghargaan_nama_penghargaan_lainnya') == '') {
				$data['inputerror'][] = 'mdlArsip_Penghargaan_nama_penghargaan_lainnya';
				$data['error_string'][] = 'Nama Penghargaan Lainnya wajib diisi';
				$data['status'] = FALSE;
			}
		}
		
		if($this->input->post('mdlArsip_Penghargaan_title') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Penghargaan_title';
			$data['error_string'][] = 'Nama File wajib diisi';
			$data['status'] = FALSE;
		}

		return $data;
	}
	
	private function _do_upload($id,$jenis_sk=0,$id_ref=0) {
		$dir = "SK_".$jenis_sk.'_'.$id_ref.'_'.$id;
		$config['upload_path']          = './asset/upload/SK/'.$dir;
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
		
		if ($_FILES['mdlArsip_Penghargaan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Penghargaan_file']['name']);
			$_FILES['mdlArsip_Penghargaan_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_Penghargaan_file')) ||  $_FILES['mdlArsip_Penghargaan_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_Penghargaan_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Penghargaan_file']['name'];
            }
		}
		
		return $data;
	}
}