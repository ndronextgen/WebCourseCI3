<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pendidikan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('pendidikan_model', 'tbl_data_pendidikan');
		$this->load->model('arsip_pendidikan_model');
		$this->tipe_pendidikan = 1; //formal, 2: informal
	}
	
	public function pendidikan_add() {
		$response = array('status' => true);
		$validate_pendidikan = $this->_validate_pendidikan();
		
		$data = array(
				'id_master_pendidikan' => $this->input->post('mdlArsip_Pendidikan_id_master_pendidikan'),
				'jurusan' => $this->input->post('mdlArsip_Pendidikan_jurusan'),
				'tempat_sekolah' => $this->input->post('mdlArsip_Pendidikan_tempat_sekolah'),
				'kota' => $this->input->post('mdlArsip_Pendidikan_kota'),
				'nomor_sttb' => $this->input->post('mdlArsip_Pendidikan_nomor_sttb'),
				'tanggal_lulus' => $this->input->post('mdlArsip_Pendidikan_tanggal_lulus'),
				'id_pegawai' => $this->input->post('mdlArsip_Pendidikan_id_pegawai'),
			);
			
		if ($validate_pendidikan['status'] == true) {
			$insert_id = $this->tbl_data_pendidikan->save($data);
			
			if ($insert_id) {
				if ($_FILES['mdlArsip_Pendidikan_file']['name'] != '') {
					$ins = [
						'id_pendidikan' => $insert_id,
						'id_tipe_pendidikan' => $this->tipe_pendidikan,
						'title' => $this->input->post('mdlArsip_Pendidikan_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_Pendidikan_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pendidikan', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$this->tipe_pendidikan,$insert_id);
					
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_pendidikan->update_arsip(
							['id_arsip_pendidikan' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_pendidikan->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_pendidikan->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/pendidikan/pendidikan_'.$this->tipe_pendidikan.'_'.$id_arsip.'_'.$insert_id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		}
		else {
			$response = $validate_pendidikan;
		}
		
		echo json_encode($response);
	}
	
	public function pendidikan_edit() {
		$response = array('status' => false);
		$validate_pendidikan = $this->_validate_pendidikan();

		$id = $this->input->post('mdlArsip_Pendidikan_id');
		
		$data = array(
				'id_master_pendidikan' => $this->input->post('mdlArsip_Pendidikan_id_master_pendidikan'),
				'jurusan' => $this->input->post('mdlArsip_Pendidikan_jurusan'),
				'tempat_sekolah' => $this->input->post('mdlArsip_Pendidikan_tempat_sekolah'),
				'kota' => $this->input->post('mdlArsip_Pendidikan_kota'),
				'nomor_sttb' => $this->input->post('mdlArsip_Pendidikan_nomor_sttb'),
				'tanggal_lulus' => $this->input->post('mdlArsip_Pendidikan_tanggal_lulus'),
				'id_pegawai' => $this->input->post('mdlArsip_Pendidikan_id_pegawai'),
			);

		$updId = [
			'id_pendidikan' => $id
		];

		if ($validate_pendidikan['status'] == true) { 
			$this->tbl_data_pendidikan->update($updId,$data);
			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Pendidikan_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_pendidikan->get_arsip_by_id_ref($id);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/pendidikan/pendidikan_'.$oldArsip->id_tipe_pendidikan.'_'.$oldArsip->id_arsip_pendidikan.'_'.$id;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_pendidikan->delete_arsip($oldArsip->id_arsip_pendidikan);
				}

				$ins = [
					'id_pendidikan' => $id,
					'title' => $this->input->post('mdlArsip_Pendidikan_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'id_tipe_pendidikan' => $this->tipe_pendidikan,
					'created_id' => $this->input->post('mdlArsip_Pendidikan_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_pendidikan', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip,$this->tipe_pendidikan,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_pendidikan->update_arsip(
						['id_arsip_pendidikan' => $id_arsip], 
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);

					$response = ['status' => true];
				}
				else {
					//delete tabel arsip
					$this->tbl_data_pendidikan->delete_arsip($id_arsip);

					//delete tabel riwayat pendidikan
					$this->tbl_data_pendidikan->delete_by_id($id);
				
					//delete arsip file
					$path = './asset/upload/pendidikan/pendidikan_'.$oldArsip->id_tipe_pendidikan.'_'.$oldArsip->id_arsip_pendidikan.'_'.$id;
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
			$response = $validate_pendidikan;
		}
		
		echo json_encode($response);
	}
	
	private function _validate_pendidikan() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Pendidikan_id_master_pendidikan') == '') {
			$data['inputerror'][] = 'mdlArsip_Pendidikan_id_master_pendidikan';
			$data['error_string'][] = 'Tingkat Pendidikan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pendidikan_jurusan') == '') {
			$data['inputerror'][] = 'mdlArsip_Pendidikan_jurusan';
			$data['error_string'][] = 'Jurusan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pendidikan_tempat_sekolah') == '') {
			$data['inputerror'][] = 'mdlArsip_Pendidikan_tempat_sekolah';
			$data['error_string'][] = 'Tempat Pendidikan wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pendidikan_kota') == '') {
			$data['inputerror'][] = 'mdlArsip_Pendidikan_kota';
			$data['error_string'][] = 'Kota wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pendidikan_nomor_sttb') == '') {
			$data['inputerror'][] = 'mdlArsip_Pendidikan_nomor_sttb';
			$data['error_string'][] = 'Nomor Ijazah wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pendidikan_tanggal_lulus') == '') {
			$data['inputerror'][] = 'mdlArsip_Pendidikan_tanggal_lulus';
			$data['error_string'][] = 'Tanggal Lulus wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pendidikan_title') == '') {
			$data['inputerror'][] = 'mdlArsip_Pendidikan_title';
			$data['error_string'][] = 'Nama File wajib diisi';
			$data['status'] = FALSE;
		}
		
		return $data;
	}
	
	private function _do_upload($id,$tipe_pendidikan=0,$id_pendidikan=0) {
		$dir = "pendidikan_".$tipe_pendidikan.'_'.$id_pendidikan.'_'.$id;
		$config['upload_path']          = './asset/upload/pendidikan/'.$dir;
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
		
		if ($_FILES['mdlArsip_Pendidikan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Pendidikan_file']['name']);
			$_FILES['mdlArsip_Pendidikan_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_Pendidikan_file')) ||  $_FILES['mdlArsip_Pendidikan_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_Pendidikan_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Pendidikan_file']['name'];
            }
		}
		
		return $data;
	}
}

