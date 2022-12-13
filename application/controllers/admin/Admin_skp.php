<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_skp extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('skp_model', 'tbl_data_dp3');
		$this->load->model('arsip_skp_model');
	}

	public function skp_add() {
		$response = array('status' => false);
		$validate_skp = $this->_validate_skp();

		$data = array(
				'uraian' => $this->input->post('mdlArsip_SKP_uraian'),
				'tahun' => $this->input->post('mdlArsip_SKP_tahun'),
				'orientasi' => $this->input->post('mdlArsip_SKP_orientasi'),
				'integritas' => $this->input->post('mdlArsip_SKP_integritas'),
				'komitmen' => $this->input->post('mdlArsip_SKP_komitmen'),
				'disiplin' => $this->input->post('mdlArsip_SKP_disiplin'),
				'kesetiaan' => $this->input->post('mdlArsip_SKP_kesetiaan'),
				'prestasi' => $this->input->post('mdlArsip_SKP_prestasi'),
				'tanggung_jawab' => $this->input->post('mdlArsip_SKP_tanggung_jawab'),
				'ketaatan' => $this->input->post('mdlArsip_SKP_ketaatan'),
				'kejujuran' => $this->input->post('mdlArsip_SKP_kejujuran'),
				'kerjasama' => $this->input->post('mdlArsip_SKP_kerjasama'),
				'prakarsa' => $this->input->post('mdlArsip_SKP_prakarsa'),
				'kepemimpinan' => $this->input->post('mdlArsip_SKP_kepemimpinan'),
				'rata_rata' => $this->input->post('mdlArsip_SKP_rata_rata'),
				'atasan' => $this->input->post('mdlArsip_SKP_atasan'),
				'penilai' => $this->input->post('mdlArsip_SKP_penilai'),
				'id_pegawai' => $this->input->post('mdlArsip_SKP_id_pegawai')
			);
			
		if ($validate_skp['status'] == true) {
			$insert_id = $this->tbl_data_dp3->save($data);
			$response = array('status' => true);
			
			if ($insert_id) {
				if ($_FILES['mdlArsip_SKP_file']['name'] != '') {
					$ins = [
						'id_dp3' => $insert_id,
						'title' => $this->input->post('mdlArsip_SKP_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->input->post('mdlArsip_SKP_id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_skp', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_dp3->update_arsip(
							['id_arsip_skp' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_dp3->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_dp3->delete_by_id($insert_id);
					
						//delete arsip file
						$path = './asset/upload/SKP/SKP_'.$insert_id.'_'.$id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		}
		else {
			$response = $validate_skp;
		}
		
		echo json_encode($response);
	}

	public function skp_edit() {
		$response = array('status' => false);
		$validate_skp = $this->_validate_skp();

		$id = $this->input->post('mdlArsip_SKP_id');

		$data = array(
				'uraian' => $this->input->post('mdlArsip_SKP_uraian'),
				'tahun' => $this->input->post('mdlArsip_SKP_tahun'),
				'orientasi' => $this->input->post('mdlArsip_SKP_orientasi'),
				'integritas' => $this->input->post('mdlArsip_SKP_integritas'),
				'komitmen' => $this->input->post('mdlArsip_SKP_komitmen'),
				'disiplin' => $this->input->post('mdlArsip_SKP_disiplin'),
				'kesetiaan' => $this->input->post('mdlArsip_SKP_kesetiaan'),
				'prestasi' => $this->input->post('mdlArsip_SKP_prestasi'),
				'tanggung_jawab' => $this->input->post('mdlArsip_SKP_tanggung_jawab'),
				'ketaatan' => $this->input->post('mdlArsip_SKP_ketaatan'),
				'kejujuran' => $this->input->post('mdlArsip_SKP_kejujuran'),
				'kerjasama' => $this->input->post('mdlArsip_SKP_kerjasama'),
				'prakarsa' => $this->input->post('mdlArsip_SKP_prakarsa'),
				'kepemimpinan' => $this->input->post('mdlArsip_SKP_kepemimpinan'),
				'rata_rata' => $this->input->post('mdlArsip_SKP_rata_rata'),
				'atasan' => $this->input->post('mdlArsip_SKP_atasan'),
				'penilai' => $this->input->post('mdlArsip_SKP_penilai'),
				'id_pegawai' => $this->input->post('mdlArsip_SKP_id_pegawai')
			);

		$updId = [
			'id_dp3' => $id
		];

		if ($validate_skp['status'] == true) { 
			$this->tbl_data_dp3->update($updId,$data);
			$response = array('status' => false);
			
			if ($_FILES['mdlArsip_SKP_file']['name'] != '') {
				// delete arsip first
				$oldArsip = $this->tbl_data_dp3->get_arsip_by_id_ref($id);
				if ($oldArsip) {
					// delete file fisik
					$path = './asset/upload/SKP/SKP_'.$id.'_'.$oldArsip->id_arsip_skp;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}

					// delete data from table
					$this->tbl_data_dp3->delete_arsip($oldArsip->id_arsip_skp);
				}

				$ins = [
					'id_dp3' => $id,
					'title' => $this->input->post('mdlArsip_SKP_title'),
					'file_name' => '',
					'file_name_ori' => '',
					'created_id' => $this->input->post('mdlArsip_SKP_id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_skp', $ins);
				$id_arsip = $this->db->insert_id();
				
				$validate_arsip = $this->_do_upload($id_arsip,$id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_dp3->update_arsip(
						['id_arsip_skp' => $id_arsip], 
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);

					$response = ['status' => true];
				}
				else {
					//delete tabel arsip
					$this->tbl_data_dp3->delete_arsip($id_arsip);

					//delete tabel tubel
					$this->tbl_data_dp3->delete_by_id($id);
				
					//delete arsip file
					$path = './asset/upload/SKP/SKP_'.$id.'_'.$oldArsip->id_arsip_skp;
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
			$response = $validate_skp;
		}
		
		echo json_encode($response);
	}

	private function _validate_skp()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('mdlArsip_SKP_uraian') == '')
		{
			$data['inputerror'][] = 'mdlArsip_SKP_uraian';
			$data['error_string'][] = 'Jenis Data wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_SKP_tahun') == '')
		{
			$data['inputerror'][] = 'mdlArsip_SKP_tahun';
			$data['error_string'][] = 'Tahun wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_SKP_rata_rata') == '')
		{
			$data['inputerror'][] = 'mdlArsip_SKP_rata_rata';
			$data['error_string'][] = 'Nilai Rata-rata wajib dipilih';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_SKP_atasan') == '')
		{
			$data['inputerror'][] = 'mdlArsip_SKP_atasan';
			$data['error_string'][] = 'Atasan wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_SKP_penilai') == '')
		{
			$data['inputerror'][] = 'mdlArsip_SKP_penilai';
			$data['error_string'][] = 'Penilai wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('mdlArsip_SKP_title') == '')
		{
			$data['inputerror'][] = 'mdlArsip_SKP_title';
			$data['error_string'][] = 'Nama File wajib di isi';
			$data['status'] = FALSE;
		}
		
		return $data;
	}

	private function _do_upload($id,$id_ref=0) {
		$dir = "SKP_".$id_ref.'_'.$id;
		$config['upload_path']          = './asset/upload/SKP/'.$dir;
        $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		//$config['max_size']             = 50000; //set max size allowed in Kilobyte
		$config['max_size']             = 100000; //set max size allowed in Kilobyte
		
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;
		
		if ($_FILES['mdlArsip_SKP_file']['name'] != '') {
			$name = time().str_replace(' ','',$_FILES['mdlArsip_SKP_file']['name']);
			$_FILES['mdlArsip_SKP_file']['name'] = $name;
			
            if(!($this->upload->do_upload('mdlArsip_SKP_file')) ||  $_FILES['mdlArsip_SKP_file']['error'] !=0) {
				$data['inputerror'][] = 'mdlArsip_SKP_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['mdlArsip_SKP_file']['name'];
            }
		}
		
		return $data;
	}
}

