<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_hukuman extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('hukuman_model', 'tbl_data_hukuman');
		$this->load->model('arsip_hukuman_model');
	}

	public function hukuman_add() {
		$response = array('status' => false);
		$validate_hukuman = $this->_validate_hukuman();
		
		$data = array(
				'id_pegawai' => $this->input->post('mdlArsip_Hukuman_id_pegawai'),
				'id_master_hukuman' => $this->input->post('mdlArsip_Hukuman_id_master_hukuman'),
				'uraian' => $this->input->post('mdlArsip_Hukuman_uraian'),
				'nomor_sk' => $this->input->post('mdlArsip_Hukuman_nomor_sk'),
				'tanggal_sk' => $this->input->post('mdlArsip_Hukuman_tanggal_sk'),
				'tanggal_mulai' => $this->input->post('mdlArsip_Hukuman_tanggal_mulai'),
				'tanggal_selesai' => $this->input->post('mdlArsip_Hukuman_tanggal_selesai'),
				'masa_berlaku' => $this->input->post('mdlArsip_Hukuman_masa_berlaku'),
				'pejabat_menetapkan' => $this->input->post('mdlArsip_Hukuman_pejabat_menetapkan')
			);
			
		if ($validate_hukuman['status'] == true) {
			$insert_id = $this->tbl_data_hukuman->save($data);
			
			if ($insert_id) {
				$response = array('status' => true);
				if ($_FILES['mdlArsip_Hukuman_file']['name'] != '') {
					$ins = [
						'id_hukuman' => $insert_id,
						'title' => $this->input->post('mdlArsip_Hukuman_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_Hukuman_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_hukuman', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_hukuman->update_arsip(
							['id_arsip_hukuman' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_hukuman->delete_arsip($id_arsip);

						//delete tabel riwayat hukuman
						$this->tbl_data_hukuman->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/Hukuman/Hukuman_'.$id_arsip.'_'.$insert_id;
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
			$response = $validate_hukuman;
		}
		
		echo json_encode($response);
	}

	public function hukuman_edit() {
		$response = array('status' => false);
		$validate_hukuman = $this->_validate_hukuman();
		
		$id = $this->input->post('mdlArsip_Hukuman_id');

		$data = array(
				'id_pegawai' => $this->input->post('mdlArsip_Hukuman_id_pegawai'),
				'id_master_hukuman' => $this->input->post('mdlArsip_Hukuman_id_master_hukuman'),
				'uraian' => $this->input->post('mdlArsip_Hukuman_uraian'),
				'nomor_sk' => $this->input->post('mdlArsip_Hukuman_nomor_sk'),
				'tanggal_sk' => $this->input->post('mdlArsip_Hukuman_tanggal_sk'),
				'tanggal_mulai' => $this->input->post('mdlArsip_Hukuman_tanggal_mulai'),
				'tanggal_selesai' => $this->input->post('mdlArsip_Hukuman_tanggal_selesai'),
				'masa_berlaku' => $this->input->post('mdlArsip_Hukuman_masa_berlaku'),
				'pejabat_menetapkan' => $this->input->post('mdlArsip_Hukuman_pejabat_menetapkan')
			);

		$updId = [
			'id_hukuman' => $id
		];

		if ($validate_hukuman['status'] == true) { 
			$this->tbl_data_hukuman->update($updId,$data);
			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Hukuman_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_hukuman->get_arsip_by_id_ref($id);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/Hukuman/Hukuman_'.$id.'_'.$oldArsip->id_arsip_hukuman;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_hukuman->delete_arsip($oldArsip->id_arsip_hukuman);
				}

				$ins = [
					'id_hukuman' => $id,
					'title' => $this->input->post('mdlArsip_Hukuman_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'created_id' => $this->input->post('mdlArsip_Hukuman_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_hukuman', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_hukuman->update_arsip(
						['id_arsip_hukuman' => $id_arsip], 
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);

					$response = ['status' => true];
				}
				else {
					//delete tabel arsip
					$this->tbl_data_hukuman->delete_arsip($id_arsip);

					//delete tabel hukuman
					$this->tbl_data_hukuman->delete_by_id($id);
				
					//delete arsip file
					$path = './asset/upload/Hukuman/Hukuman_'.$id.'_'.$oldArsip->id_arsip_hukuman;
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
			$response = $validate_hukuman;
		}
		
		echo json_encode($response);
	}

	private function _validate_hukuman() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Hukuman_id_master_hukuman') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_id_master_hukuman';
			$data['error_string'][] = 'Jenis Hukuman wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Hukuman_uraian') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_uraian';
			$data['error_string'][] = 'Uraian wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Hukuman_nomor_sk') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Hukuman_tanggal_sk') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_tanggal_sk';
			$data['error_string'][] = 'Tanggal SK wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Hukuman_tanggal_mulai') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_tanggal_mulai';
			$data['error_string'][] = 'Tanggal Mulai wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Hukuman_tanggal_selesai') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_tanggal_selesai';
			$data['error_string'][] = 'Tanggal Selesai wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Hukuman_masa_berlaku') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_masa_berlaku';
			$data['error_string'][] = 'Masa Berlaku wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Hukuman_pejabat_menetapkan') == '') {
			$data['inputerror'][] = 'mdlArsip_Hukuman_pejabat_menetapkan';
			$data['error_string'][] = 'Pejabat Menetapkan wajib di isi';
			$data['status'] = FALSE;
		}
		
		return $data;
	}
	
	private function _do_upload($id,$id_ref=0) {
		$dir = 'Hukuman_'.$id_ref.'_'.$id;
		$config['upload_path']          = './asset/upload/Hukuman/'.$dir;
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
		
		if ($_FILES['mdlArsip_Hukuman_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Hukuman_file']['name']);
			$_FILES['mdlArsip_Hukuman_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_Hukuman_file')) ||  $_FILES['mdlArsip_Hukuman_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_Hukuman_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Hukuman_file']['name'];
            }
		}
		
		return $data;
	}
}

