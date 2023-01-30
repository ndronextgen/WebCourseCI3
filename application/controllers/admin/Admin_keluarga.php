<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_keluarga extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('keluarga_model', 'tbl_data_keluarga');
	}
	
	public function keluarga_add() {
		$response = array('status' => true);
		$validate_keluarga = $this->_validate_keluarga();

		$data = array(
				'nama_anggota_keluarga' => $this->input->post('mdlArsip_Keluarga_nama_anggota_keluarga'),
				'hub_keluarga' => $this->input->post('mdlArsip_Keluarga_hub_keluarga'),
				'jenis_kelamin' => $this->input->post('mdlArsip_Keluarga_jenis_kelamin'),
				'tanggal_lahir_keluarga' => date('Y-m-d', strtotime($this->input->post('mdlArsip_Keluarga_tanggal_lahir_keluarga'))),
				'uraian' => $this->input->post('mdlArsip_Keluarga_uraian'),
				'id_pegawai' => $this->input->post('mdlArsip_Keluarga_id_pegawai')
			);
		
		if ($validate_keluarga['status'] == true) {
			$insert_id = $this->tbl_data_keluarga->save($data);
			
			if ($insert_id) {
				if ($_FILES['mdlArsip_Keluarga_file']['name'] != '') {
					$ins = [
						'id_data_keluarga' => $insert_id,
						'title' => $this->input->post('mdlArsip_Keluarga_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pribadi', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_keluarga->update_arsip(
							['id_arsip_pribadi' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_keluarga->delete_arsip($id_arsip);

						//delete tabel riwayat pangkat
						$this->tbl_data_keluarga->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/pribadi/pribadi_'.$insert_id.'_'.$id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		}
		else {
			$response = $validate_keluarga;
		}
		
		echo json_encode($response);
	}
	
	public function keluarga_edit() {
		$response = array('status' => false);
		$validate_keluarga = $this->_validate_keluarga();

		$id = $this->input->post('mdlArsip_Keluarga_id');
		$data = array(
				'nama_anggota_keluarga' => $this->input->post('mdlArsip_Keluarga_nama_anggota_keluarga'),
				'hub_keluarga' => $this->input->post('mdlArsip_Keluarga_hub_keluarga'),
				'jenis_kelamin' => $this->input->post('mdlArsip_Keluarga_jenis_kelamin'),
				'tanggal_lahir_keluarga' => $this->input->post('mdlArsip_Keluarga_tanggal_lahir_keluarga'),
				'uraian' => $this->input->post('mdlArsip_Keluarga_uraian'),
				'id_pegawai' => $this->input->post('mdlArsip_Keluarga_id_pegawai')
			);

		$updId = [
			'id_data_keluarga' => $id
		];
			
		if ($validate_keluarga['status'] == true) {
			$update = $this->tbl_data_keluarga->update($updId, $data);
			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_Keluarga_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_keluarga->get_arsip_by_id_ref($id);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/pribadi/pribadi_'.$id.'_'.$oldArsip->id_arsip_pribadi;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_keluarga->delete_arsip($oldArsip->id_arsip_pribadi);
				}

				$ins = [
					'id_data_keluarga' => $id,
					'title' => $this->input->post('mdlArsip_Keluarga_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'created_id' => $this->input->post('mdlArsip_Keluarga_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_pribadi', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_keluarga->update_arsip(
						['id_arsip_pribadi' => $id_arsip], 
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);

					$response = ['status' => true];
				}
				else {
					//delete tabel arsip
					$this->tbl_data_keluarga->delete_arsip($id_arsip);

					//delete tabel riwayat pangkat
					$this->tbl_data_keluarga->delete_by_id($id);
				
					//delete arsip file
					$path = './asset/upload/pribadi/pribadi_'.$id.'_'.$id_arsip;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}
				}
			}
			else {
				$Query_data = $this->db->query("SELECT
												a.id_data_keluarga,
												a.id_pegawai,
												b.id_arsip_pribadi
												FROM
												tbl_data_keluarga as a
												INNER JOIN tbl_arsip_pribadi as b ON a.id_data_keluarga = b.id_data_keluarga
												WHERE a.id_data_keluarga = '$id' limit 0,1")->row();
				
				$data_b['title']=$this->input->post('mdlArsip_Keluarga_title');
				$this->db->where('id_arsip_pribadi', $Query_data->id_arsip_pribadi);
				$this->db->update('tbl_arsip_pribadi', $data_b);
				$response = ['status' => true];
			}
		}
		else {
			$response = $validate_keluarga;
		}
		
		echo json_encode($response);
	}
	
	private function _validate_keluarga() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('mdlArsip_Keluarga_nama_anggota_keluarga') == '') {
			$data['inputerror'][] = 'mdlArsip_Keluarga_nama_anggota_keluarga';
			$data['error_string'][] = 'Nama Anggota Keluarga wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Keluarga_hub_keluarga') == '') {
			$data['inputerror'][] = 'mdlArsip_Keluarga_hub_keluarga';
			$data['error_string'][] = 'Hubungan Keluarga wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Keluarga_jenis_kelamin') == '') {
			$data['inputerror'][] = 'mdlArsip_Keluarga_jenis_kelamin';
			$data['error_string'][] = 'Jenis Kelamin wajib dipilih';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Keluarga_tanggal_lahir_keluarga') == '') {
			$data['inputerror'][] = 'mdlArsip_Keluarga_tanggal_lahir_keluarga';
			$data['error_string'][] = 'Tanggal Lahir wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_Keluarga_title') == '') {
			$data['inputerror'][] = 'mdlArsip_Keluarga_title';
			$data['error_string'][] = 'Nama File wajib di isi';
			$data['status'] = FALSE;
		}

		return $data;
	}
	
	private function _do_upload($id,$id_ref=0) {
		$dir = "pribadi_".$id_ref.'_'.$id;
		$config['upload_path']          = './asset/upload/pribadi/'.$dir;
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
		
		if ($_FILES['mdlArsip_Keluarga_file']['name'] != '') {
			$name = time().str_replace(' ','',$_FILES['mdlArsip_Keluarga_file']['name']);
			$_FILES['mdlArsip_Keluarga_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_Keluarga_file')) ||  $_FILES['mdlArsip_Keluarga_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_Keluarga_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_Keluarga_file']['name'];
            }
		}
		
		return $data;
	}
}