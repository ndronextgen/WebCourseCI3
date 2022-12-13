<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_tubel extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('tubel_model', 'tbl_data_tubel');
		$this->load->model('arsip_sk_model');
		$this->jenis_sk = 1;
	}

	public function tubel_add() {
		$response = array('status' => true);
		$validate_tubel = $this->_validate_tubel();
		$id = $this->session->userdata('id_pegawai');
		
		$data = array(
				'uraian' => $this->input->post('mdlArsip_Tubel_uraian'),
				'no_sk' => $this->input->post('mdlArsip_Tubel_no_sk'),
				'tgl_sk' => $this->input->post('mdlArsip_Tubel_tgl_sk'),
				'tgl_mulai' => $this->input->post('mdlArsip_Tubel_tgl_mulai'),
				'tgl_selesai' => $this->input->post('mdlArsip_Tubel_tgl_selesai'),
				'sekolah' => $this->input->post('mdlArsip_Tubel_sekolah'),
				'akreditasi' => $this->input->post('mdlArsip_Tubel_akreditasi'),
				'jurusan' => $this->input->post('mdlArsip_Tubel_jurusan'),
				'id_pegawai' => $this->input->post('mdlArsip_Tubel_id_pegawai')
			);
			
		if ($validate_tubel['status'] == true) {
			$insert_id = $this->tbl_data_tubel->save($data);
			
			if ($insert_id) {
				if ($_FILES['mdlArsip_Tubel_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $this->input->post('mdlArsip_Tubel_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_Tubel_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_tubel->update_arsip(
							['id_arsip_sk' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_tubel->delete_arsip($id_arsip);

						//delete
						$this->tbl_data_tubel->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$insert_id.'_'.$id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		}
		else {
			$response = $validate_tubel;
		}
		
		echo json_encode($response);
	}

	public function tubel_edit() {
		$response = array('status' => false);
		$validate_tubel = $this->_validate_tubel();
		$id = $this->input->post('mdlArsip_Tubel_id');
		
		$data = array(
				'uraian' => $this->input->post('mdlArsip_Tubel_uraian'),
				'no_sk' => $this->input->post('mdlArsip_Tubel_no_sk'),
				'tgl_sk' => $this->input->post('mdlArsip_Tubel_tgl_sk'),
				'tgl_mulai' => $this->input->post('mdlArsip_Tubel_tgl_mulai'),
				'tgl_selesai' => $this->input->post('mdlArsip_Tubel_tgl_selesai'),
				'sekolah' => $this->input->post('mdlArsip_Tubel_sekolah'),
				'akreditasi' => $this->input->post('mdlArsip_Tubel_akreditasi'),
				'jurusan' => $this->input->post('mdlArsip_Tubel_jurusan'),
				'id_pegawai' => $this->input->post('mdlArsip_Tubel_id_pegawai')
			);
		
		$updId = [
			'id_tubel' => $id
		];

		if ($validate_tubel['status'] == true) { 
			$this->tbl_data_tubel->update($updId,$data);
			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Tubel_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_tubel->get_arsip_by_id_ref($id, $this->jenis_sk);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id.'_'.$oldArsip->id_arsip_sk;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_tubel->delete_arsip($oldArsip->id_arsip_sk);
				}

				$ins = [
					'id_ref' => $id,
					'id_jenis_sk' => $this->jenis_sk,
					'title' => $this->input->post('mdlArsip_Tubel_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'created_id' => $this->input->post('mdlArsip_Tubel_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_sk', $ins);
				$id_arsip = $this->db->insert_id();
				
				$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_tubel->update_arsip(
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
					$this->tbl_data_tubel->delete_arsip($id_arsip);

					//delete tabel tubel
					$this->tbl_data_tubel->delete_by_id($id);
				
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
			$response = $validate_tubel;
		}
		
		echo json_encode($response);
	}

	private function _validate_tubel()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Tubel_uraian') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_uraian';
			$data['error_string'][] = 'Nama Status wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Tubel_no_sk') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_no_sk';
			$data['error_string'][] = 'Nomor SK wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Tubel_tgl_sk') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_tgl_sk';
			$data['error_string'][] = 'Tanggal SK wajib dipilih';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Tubel_tgl_mulai') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_tgl_mulai';
			$data['error_string'][] = 'Tanggal Mulai wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Tubel_tgl_selesai') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_tgl_selesai';
			$data['error_string'][] = 'Tanggal Selesai wajib di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('mdlArsip_Tubel_sekolah') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_sekolah';
			$data['error_string'][] = 'Sekolah wajib di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('mdlArsip_Tubel_akreditasi') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_akreditasi';
			$data['error_string'][] = 'Akreditasi wajib di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('mdlArsip_Tubel_jurusan') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_jurusan';
			$data['error_string'][] = 'Jurusan wajib di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('mdlArsip_Tubel_title') == '')
		{
			$data['inputerror'][] = 'mdlArsip_Tubel_title';
			$data['error_string'][] = 'Nama File wajib di isi';
			$data['status'] = FALSE;
		}
		
		return $data;
	}

	private function _do_upload($id,$jenis_sk=0,$id_ref=0) {
		$dir = "SK_".$this->jenis_sk.'_'.$id_ref.'_'.$id;
		$config['upload_path']          = './asset/upload/SK/'.$dir;
        $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte
		
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;
		
		if ($_FILES['mdlArsip_Tubel_file']['name'] != '') {
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Tubel_file']['name']);
            $_FILES['mdlArsip_Tubel_file']['name'] = $name;

            if(!($this->upload->do_upload('mdlArsip_Tubel_file')) ||  $_FILES['mdlArsip_Tubel_file']['error'] !=0)
            {
				$data['inputerror'][] = 'mdlArsip_Tubel_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
            }
            else
            {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Tubel_file']['name'];
            }
		}
		
		return $data;
	}
}

