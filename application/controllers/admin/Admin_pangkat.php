<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pangkat extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('pangkat_model', 'tbl_data_riwayat_pangkat');
		$this->load->model('arsip_sk_model');
		$this->jenis_sk = 2;
	}
	
	public function pangkat_add() {
		$response = array('status' => false);
		$validate_pangkat = $this->_validate_pangkat();
		
		$data = array(
				'id_golongan' => $this->input->post('mdlArsip_Pangkat_id_golongan'),
				'lokasi_kerja' => $this->input->post('mdlArsip_Pangkat_lokasi_kerja'),
				'nomor_sk' => $this->input->post('mdlArsip_Pangkat_nomor_sk'),
				'tanggal_mulai' => $this->input->post('mdlArsip_Pangkat_tanggal_mulai'),
				'tanggal_sk' => $this->input->post('mdlArsip_Pangkat_tanggal_sk'),
				'id_pegawai' => $this->input->post('mdlArsip_Pangkat_id_pegawai')
			);
		
		if ($validate_pangkat['status'] == true) { 
			$insert_id = $this->tbl_data_riwayat_pangkat->save($data);
			$title_file = $this->tbl_data_riwayat_pangkat->getGolonganName($this->input->post('mdlArsip_Pangkat_id_golongan'));
			
			if ($insert_id) {
				$response = array('status' => true);
				if ($_FILES['mdlArsip_Pangkat_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_Pangkat_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_riwayat_pangkat->update_arsip(
							['id_arsip_sk' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_riwayat_pangkat->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_riwayat_pangkat->delete_by_id($insert_id);
					
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
			$response = $validate_pangkat;
		}
		
		echo json_encode($response);
	}
	
	public function pangkat_edit() {
		$response = array('status' => false);
		$validate_pangkat = $this->_validate_pangkat();
		
		$id = $this->input->post('mdlArsip_Pangkat_id');
		$data = array(
				'id_golongan' => $this->input->post('mdlArsip_Pangkat_id_golongan'),
				'lokasi_kerja' => $this->input->post('mdlArsip_Pangkat_lokasi_kerja'),
				'nomor_sk' => $this->input->post('mdlArsip_Pangkat_nomor_sk'),
				'tanggal_mulai' => $this->input->post('mdlArsip_Pangkat_tanggal_mulai'),
				'tanggal_sk' => $this->input->post('mdlArsip_Pangkat_tanggal_sk'),
				'id_pegawai' => $this->input->post('mdlArsip_Pangkat_id_pegawai')
			);

		$updId = [
			'id_riwayat_pangkat' => $id
		];
		
		if ($validate_pangkat['status'] == true) { 
			$this->tbl_data_riwayat_pangkat->update($updId,$data);
			$title_file = $this->tbl_data_riwayat_pangkat->getGolonganName($this->input->post('mdlArsip_Pangkat_id_golongan'));

			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Pangkat_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_riwayat_pangkat->get_arsip_by_id_ref($id, $this->jenis_sk);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id.'_'.$oldArsip->id_arsip_sk;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_riwayat_pangkat->delete_arsip($oldArsip->id_arsip_sk);
				}

				$ins = [
					'id_ref' => $id,
					'title' => $title_file,
					'file_name' => '',
					'file_name_ori' => '',
					'id_jenis_sk' => $this->jenis_sk,
					'created_id' => $this->input->post('mdlArsip_Pangkat_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_sk', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_riwayat_pangkat->update_arsip(
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
					$this->tbl_data_riwayat_pangkat->delete_arsip($id_arsip);

					//delete tabel riwayat pangkat
					$this->tbl_data_riwayat_pangkat->delete_by_id($id);
				
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
			$response = $validate_pangkat;
		}
		
		echo json_encode($response);
	}

	public function pangkat_delete($id_riwayat_pangkat) {
		//delete data pangkat
		$this->tbl_data_riwayat_pangkat->delete_by_id($id_riwayat_pangkat,$this->jenis_sk);

		$arsip = $this->tbl_data_riwayat_pangkat->get_arsip_by_id_ref($id_riwayat_pangkat,$this->jenis_sk);
		if ($arsip) {
			//delete arsip file
			$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id_riwayat_pangkat.'_'.$arsip->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			//delete table arsip
			$this->db->delete('tbl_arsip_sk', [ 'id_ref' => $id_riwayat_pangkat]);
		}
		
		echo json_encode(array("status" => TRUE));
	}

	private function _validate_pangkat() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Pangkat_id_golongan') == '') {
			$data['inputerror'][] = 'mdlArsip_Pangkat_id_golongan';
			$data['error_string'][] = 'Golongan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pangkat_lokasi_kerja') == '') {
			$data['inputerror'][] = 'mdlArsip_Pangkat_lokasi_kerja';
			$data['error_string'][] = 'Lokasi Kerja wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pangkat_nomor_sk') == '') {
			$data['inputerror'][] = 'mdlArsip_Pangkat_nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('mdlArsip_Pangkat_tanggal_mulai') == '') {
			$data['inputerror'][] = 'mdlArsip_Pangkat_tanggal_mulai';
			$data['error_string'][] = 'TMT wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Pangkat_tanggal_sk') == '') {
			$data['inputerror'][] = 'mdlArsip_Pangkat_tanggal_sk';
			$data['error_string'][] = 'Tanggal SK wajib diisi';
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
		
		if ($_FILES['mdlArsip_Pangkat_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Pangkat_file']['name']);
			$_FILES['mdlArsip_Pangkat_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_Pangkat_file')) ||  $_FILES['mdlArsip_Pangkat_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_Pangkat_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Pangkat_file']['name'];
            }
		}
		
		return $data;
	}
}