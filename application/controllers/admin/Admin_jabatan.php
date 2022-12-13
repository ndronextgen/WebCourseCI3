<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_jabatan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('riwayat_jabatan_model');
		$this->load->model('riwayat_jabatan_model', 'tbl_data_riwayat_jabatan');
		$this->load->model('arsip_sk_model');
		$this->jenis_sk = 3;
	}

	public function jabatan_add() {
		$response = array('status' => false);
		$validate_jabatan = $this->_validate_jabatan();
		
		$data = array(
				'id_riwayat_status_jabatan' => $this->input->post('mdlArsip_Jabatan_id_riwayat_status_jabatan'),
				'lokasi' => $this->input->post('mdlArsip_Jabatan_lokasi'),
				'nomor_sk' => $this->input->post('mdlArsip_Jabatan_nomor_sk'),
				'tmt_mulai_jabatan' => $this->input->post('mdlArsip_Jabatan_tmt_mulai_jabatan'),
				'tgl_sk_jabatan' => $this->input->post('mdlArsip_Jabatan_tgl_sk_jabatan'),
				'id_pegawai' => $this->input->post('mdlArsip_Jabatan_id_pegawai')
			);

		if ((int)$this->input->post('mdlArsip_Jabatan_id_riwayat_status_jabatan') == 10) {
			$data['id_r_jabatan'] = 0;
			$data['nama_jabatan'] = $this->input->post('mdlArsip_Jabatan_nama_jabatan');
		}
		else {
			$data['id_r_jabatan'] = $this->input->post('mdlArsip_Jabatan_id_r_jabatan');
			$data['nama_jabatan'] = '';
		}
			
		if ($validate_jabatan['status'] == true) {
			$insert_id = $this->tbl_data_riwayat_jabatan->save($data);
			
			if ($insert_id) {
				$response = array('status' => true);
				if ($_FILES['mdlArsip_Jabatan_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $this->input->post('mdlArsip_Jabatan_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_Jabatan_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_riwayat_jabatan->update_arsip(
							['id_arsip_sk' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_riwayat_jabatan->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_riwayat_jabatan->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id_arsip.'_'.$insert_id;
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
			$response = $validate_jabatan;
		}
		
		echo json_encode($response);
	}

	public function jabatan_edit() {
		$response = array('status' => false);
		$validate_jabatan = $this->_validate_jabatan();
		
		$id = $this->input->post('mdlArsip_Jabatan_id');

		$data = array(
				'id_riwayat_status_jabatan' => $this->input->post('mdlArsip_Jabatan_id_riwayat_status_jabatan'),
				'lokasi' => $this->input->post('mdlArsip_Jabatan_lokasi'),
				'nomor_sk' => $this->input->post('mdlArsip_Jabatan_nomor_sk'),
				'tmt_mulai_jabatan' => $this->input->post('mdlArsip_Jabatan_tmt_mulai_jabatan'),
				'tgl_sk_jabatan' => $this->input->post('mdlArsip_Jabatan_tgl_sk_jabatan'),
				'id_pegawai' => $this->input->post('mdlArsip_Jabatan_id_pegawai')
			);

		if ((int)$this->input->post('mdlArsip_Jabatan_id_riwayat_status_jabatan') == 10) {
			$data['id_r_jabatan'] = 0;
			$data['nama_jabatan'] = $this->input->post('mdlArsip_Jabatan_nama_jabatan');
		}
		else {
			$data['id_r_jabatan'] = $this->input->post('mdlArsip_Jabatan_id_r_jabatan');
			$data['nama_jabatan'] = '';
		}

		$updId = [
			'id_riwayat_jabatan' => $id
		];

		if ($validate_jabatan['status'] == true) { 
			$this->tbl_data_riwayat_jabatan->update($updId,$data);
			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Jabatan_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_riwayat_jabatan->get_arsip_by_id_ref($id, $this->jenis_sk);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id.'_'.$oldArsip->id_arsip_sk;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_riwayat_jabatan->delete_arsip($oldArsip->id_arsip_sk);
				}

				$ins = [
					'id_ref' => $id,
					'title' => $this->input->post('mdlArsip_Jabatan_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'id_jenis_sk' => $this->jenis_sk,
					'created_id' => $this->input->post('mdlArsip_Jabatan_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_sk', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_riwayat_jabatan->update_arsip(
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
					$this->tbl_data_riwayat_jabatan->delete_arsip($id_arsip);

					//delete tabel riwayat jabatan
					$this->tbl_data_riwayat_jabatan->delete_by_id($id);
				
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
			$response = $validate_jabatan;
		}
		
		echo json_encode($response);
	}

	private function _validate_jabatan() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Jabatan_id_riwayat_status_jabatan') == '') {
			$data['inputerror'][] = 'mdlArsip_Jabatan_id_riwayat_status_jabatan';
			$data['error_string'][] = 'Status Jabatan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if((int)$this->input->post('mdlArsip_Jabatan_id_riwayat_status_jabatan') == 10) {
			if($this->input->post('mdlArsip_Jabatan_nama_jabatan') == '') {
				$data['inputerror'][] = 'mdlArsip_Jabatan_nama_jabatan';
				$data['error_string'][] = 'Nama Jabatan wajib di isi';
				$data['status'] = FALSE;
			}
		}
		else {
			if($this->input->post('mdlArsip_Jabatan_id_r_jabatan') == '') {
				$data['inputerror'][] = 'mdlArsip_Jabatan_id_r_jabatan';
				$data['error_string'][] = 'Nama Jabatan wajib di pilih';
				$data['status'] = FALSE;
			}
		}
		
		if($this->input->post('mdlArsip_Jabatan_lokasi') == '') {
			$data['inputerror'][] = 'mdlArsip_Jabatan_lokasi';
			$data['error_string'][] = 'Lokasi wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Jabatan_nomor_sk') == '') {
			$data['inputerror'][] = 'mdlArsip_Jabatan_nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Jabatan_tmt_mulai_jabatan') == '') {
			$data['inputerror'][] = 'mdlArsip_Jabatan_tmt_mulai_jabatan';
			$data['error_string'][] = 'TMT wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Jabatan_tgl_sk_jabatan') == '') {
			$data['inputerror'][] = 'mdlArsip_Jabatan_tgl_sk_jabatan';
			$data['error_string'][] = 'Tanggal wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Jabatan_title') == '') {
			$data['inputerror'][] = 'mdlArsip_Jabatan_title';
			$data['error_string'][] = 'Nama File wajib di isi';
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
		
		if ($_FILES['mdlArsip_Jabatan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Jabatan_file']['name']);
			$_FILES['mdlArsip_Jabatan_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_Jabatan_file')) ||  $_FILES['mdlArsip_Jabatan_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_Jabatan_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Jabatan_file']['name'];
            }
		}
		
		return $data;
	}
}

