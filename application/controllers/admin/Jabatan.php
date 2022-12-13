<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('riwayat_jabatan_model', 'tbl_data_riwayat_jabatan');
		$this->jenis_sk = 3;
	}

	function nama_jabatan(){
		$id=$this->input->post('id_riwayat_status_jabatan');
		$idr=$this->input->post('id_r_jabatan');
		$data=$this->tbl_data_riwayat_jabatan->nama_jabatan($id,$idr);
		echo ($data);
	}
	
	public function jabatan_datatables() {
        // Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_riwayat_jabatan->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->nama_status_jabatan;
			$row[] = $r->nama_jabatan;
			$row[] = $r->lokasi;
			$row[] = $r->tmt_mulai_jabatan;
			$row[] = $r->tgl_sk_jabatan;
			$row[] = $r->nomor_sk;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_jabatan('."'".$r->id_riwayat_jabatan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_jabatan('."'".$r->id_riwayat_jabatan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					  
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tbl_data_riwayat_jabatan->count_all($id),
						"recordsFiltered" => $this->tbl_data_riwayat_jabatan->count_filtered($id),
						"data" => $data,
				);

		//output to json format
		echo json_encode($output);
	}
	
	public function jabatan_edit($id_riwayat_jabatan) {	
		$data = $this->tbl_data_riwayat_jabatan->get_by_id($id_riwayat_jabatan);
		$data->arsip = $this->tbl_data_riwayat_jabatan->get_arsip_by_id_ref($id_riwayat_jabatan,$this->jenis_sk);
		echo json_encode($data);
	}

	public function jabatan_add() {
		$response = array('status' => true);
		$validate_jabatan = $this->_validate_jabatan();
		$id = $this->session->userdata('id_pegawai');
		
		$data = array(
				'id_riwayat_status_jabatan' => $this->input->post('id_riwayat_status_jabatan'),
				'lokasi' => $this->input->post('lokasi'),
				'nomor_sk' => $this->input->post('nomor_sk'),
				'tmt_mulai_jabatan' => $this->input->post('tmt_mulai_jabatan'),
				'tgl_sk_jabatan' => $this->input->post('tgl_sk_jabatan'),
				'id_pegawai' => $this->session->userdata('id_pegawai'),
			);

		if ((int)$this->input->post('id_riwayat_status_jabatan') == 10) {
			$data['id_r_jabatan'] = 0;
			$data['nama_jabatan'] = $this->input->post('nama_jabatan');
		}
		else {
			$data['id_r_jabatan'] = $this->input->post('id_r_jabatan');
			$data['nama_jabatan'] = '';
		}
			
		if ($validate_jabatan['status'] == true) {
			$insert_id = $this->tbl_data_riwayat_jabatan->save($data);
			
			if ($insert_id) {
				if ($_FILES['arsipJabatan_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $this->input->post('arsipJabatan_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
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
					}
				}
			}
		}
		else {
			$response = $validate_jabatan;
		}
		
		echo json_encode($response);
	}
	
	public function jabatan_update() {
		$response = array('status' => true);
		$id = $this->input->post('id_riwayat_jabatan');
		$validate_jabatan = $this->_validate_jabatan();
		
		if ($validate_jabatan['status'] == true) {
			log_message('debug', 'jabatan valid');
			$data = array(
					'id_riwayat_status_jabatan' => $this->input->post('id_riwayat_status_jabatan'),
					'lokasi' => $this->input->post('lokasi'),
					'nomor_sk' => $this->input->post('nomor_sk'),
					'tmt_mulai_jabatan' => $this->input->post('tmt_mulai_jabatan'),
					'tgl_sk_jabatan' => $this->input->post('tgl_sk_jabatan'),
					'id_pegawai' => $this->session->userdata('id_pegawai')
				);

			if ((int)$this->input->post('id_riwayat_status_jabatan') == 10) {
				$data['id_r_jabatan'] = 0;
				$data['nama_jabatan'] = $this->input->post('nama_jabatan');
			}
			else {
				$data['id_r_jabatan'] = $this->input->post('id_r_jabatan');
				$data['nama_jabatan'] = '';
			}

			$this->tbl_data_riwayat_jabatan->update(array('id_riwayat_jabatan' => $id), $data);

			//update title arsip table
			$this->tbl_data_riwayat_jabatan->update_arsip(['id_ref' => $id], ['title' => $this->input->post('nomor_sk')]);
			
			if ($_FILES['arsipJabatan_file']['name'] != '') {
				log_message('debug', 'arsip tidak kosong : '.$id);
				$fileOld = $this->tbl_data_riwayat_jabatan->get_arsip_by_id_ref($id,$this->jenis_sk);
				if (!empty($fileOld)) {
					log_message('debug', 'masuk : '.json_encode($fileOld));
					$ins = [
						'id_ref' => $id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $this->input->post('arsipJabatan_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip,$this->jenis_sk,$id);
					if ($validate_arsip['status'] == true) {
						log_message('debug', 'valid arsip');
						log_message('debug', 'data arsip : '.json_encode($validate_arsip));
						//update filename
						$this->tbl_data_riwayat_jabatan->update_arsip(
							['id_arsip_sk' => $id_arsip], 
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/SK/SK_'.$fileOld->id_jenis_sk.'_'.$fileOld->id_ref.'_'.$fileOld->id_arsip_sk;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
						
						//delete arsip table
						$this->tbl_data_riwayat_jabatan->delete_arsip($fileOld->id_arsip_sk);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_riwayat_jabatan->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_riwayat_jabatan->delete_by_id($id);
					
						//delete arsip file
						$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id_arsip.'_'.$id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
				else {
					if ($_FILES['arsipJabatan_file']['name'] != '') {
						$ins = [
							'id_ref' => $id,
							'id_jenis_sk' => $this->jenis_sk,
							'title' => $this->input->post('arsipJabatan_title'),
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
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
						}
						else {
							//delete tabel arsip
							$this->tbl_data_riwayat_jabatan->delete_arsip($id_arsip);
	
							//delete tabel riwayat jabatan
							$this->tbl_data_riwayat_jabatan->delete_by_id($id);
						
							//delete arsip file
							$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id_arsip.'_'.$id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		}
		else {
			$response = $validate_jabatan;
		}
		
		echo json_encode($response);
	}
	
	public function jabatan_delete($id_riwayat_jabatan) {
		//delete data jabatan
		$this->tbl_data_riwayat_jabatan->delete_by_id($id_riwayat_jabatan,$this->jenis_sk);

		$arsip = $this->tbl_data_riwayat_jabatan->get_arsip_by_id_ref($id_riwayat_jabatan,$this->jenis_sk);
		if ($arsip) {
			//delete arsip file
			$path = './asset/upload/SK/SK_'.$this->jenis_sk.'_'.$id_riwayat_jabatan.'_'.$arsip->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			//delete table arsip
			$this->db->delete('tbl_arsip_sk', [ 'id_ref' => $id_riwayat_jabatan]);
		}
		
		echo json_encode(array("status" => TRUE));
	}

	

	private function _validate_jabatan() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('id_riwayat_status_jabatan') == '') {
			$data['inputerror'][] = 'id_riwayat_status_jabatan';
			$data['error_string'][] = 'Status Jabatan wajib di isi';
			$data['status'] = FALSE;
		}

		if((int)$this->input->post('id_riwayat_status_jabatan') == 10) {
			if($this->input->post('nama_jabatan') == '') {
				$data['inputerror'][] = 'nama_jabatan';
				$data['error_string'][] = 'Nama Jabatan wajib di isi';
				$data['status'] = FALSE;
			}
		}
		else {
			if($this->input->post('id_r_jabatan') == '') {
				$data['inputerror'][] = 'id_r_jabatan';
				$data['error_string'][] = 'Nama Jabatan wajib di pilih';
				$data['status'] = FALSE;
			}
		}
		
		if($this->input->post('lokasi') == '') {
			$data['inputerror'][] = 'lokasi';
			$data['error_string'][] = 'Lokasi wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('nomor_sk') == '') {
			$data['inputerror'][] = 'nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tmt_mulai_jabatan') == '') {
			$data['inputerror'][] = 'tmt_mulai_jabatan';
			$data['error_string'][] = 'TMT wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tgl_sk_jabatan') == '') {
			$data['inputerror'][] = 'tgl_sk_jabatan';
			$data['error_string'][] = 'Tanggal wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('arsipJabatan_title') == '') {
			$data['inputerror'][] = 'arsipJabatan_title';
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
		
		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;
		
		if ($_FILES['arsipJabatan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time().str_replace(' ','',$_FILES['arsipJabatan_file']['name']);
			$_FILES['arsipJabatan_file']['name'] = $name;
			
            if(!($this->upload->do_upload('arsipJabatan_file')) ||  $_FILES['arsipJabatan_file']['error'] !=0) {
				$data['inputerror'][] = 'arsipJabatan_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipJabatan_file']['name'];
            }
		}
		
		return $data;
	}
	
	public function download($id) {	
		$id = utf8_encode($id);

		if($id=="") {
			ob_start();
			echo "<script>alert('Gagal download file')</script>";
		}
		else {
			$data = $this->tbl_data_riwayat_jabatan->get_arsip_by_id($id);
			
			$dir = "SK_".$data->id_jenis_sk.'_'.$data->id_ref.'_'.$data->id_arsip_sk;
			$path = file_get_contents('asset/upload/SK/'.$dir.'/'.$data->file_name); // letak file pada aplikasi kita

			force_download($data->file_name_ori,$path);
		}
	}

	public function delete_arsip($id) {
		$status = true;
		$data = $this->tbl_data_riwayat_jabatan->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/SK/SK_'.$data->id_jenis_sk.'_'.$data->id_ref.'_'.$data->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}
			
			if (!$this->db->delete('tbl_arsip_sk', ['id_arsip_sk' => $id])) {
				$status = false;
			}
		}
		else {
			$status = false;
		}
		
		$response = ['status' => $status];
		echo json_encode($response);
	}

	public function jabatan_list($id) {
		$this->db->select('
			tbl_data_riwayat_jabatan.id_riwayat_jabatan, tbl_master_status_jabatan.nama_status_jabatan, 
			if (tbl_data_riwayat_jabatan.id_riwayat_status_jabatan = 10, tbl_data_riwayat_jabatan.nama_jabatan,tbl_master_nama_jabatan.nama_jabatan) as nama_jabatan,
			tbl_data_riwayat_jabatan.lokasi, tbl_data_riwayat_jabatan.tmt_mulai_jabatan,
			tbl_data_riwayat_jabatan.tgl_sk_jabatan, tbl_data_riwayat_jabatan.nomor_sk, tbl_arsip_sk.file_name_ori, 
			tbl_arsip_sk.id_arsip_sk, tbl_arsip_sk.file_name
		');
		$this->db->from('tbl_data_riwayat_jabatan');
		$this->db->join('tbl_master_status_jabatan', 'tbl_master_status_jabatan.id_status_jabatan = tbl_data_riwayat_jabatan.id_riwayat_status_jabatan', 'left');
		$this->db->join('tbl_master_nama_jabatan', 'tbl_master_nama_jabatan.id_nama_jabatan = tbl_data_riwayat_jabatan.id_r_jabatan', 'left');
		$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_riwayat_jabatan.id_riwayat_jabatan', 'left');
		$this->db->where('tbl_data_riwayat_jabatan.id_pegawai', $id);
		$this->db->where('tbl_arsip_sk.id_jenis_sk', $this->jenis_sk);

		if(isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result(); 

		echo json_encode($list);
	}

	public function jabatan_delete_arsip($id_riwayat_jabatan, $id_arsip_sk)
	{
		$status = true;
		
		//delete data riwayat jabatan
		$this->tbl_data_riwayat_jabatan->delete_by_id($id_riwayat_jabatan);
		
		$data = $this->arsip_sk_model->get_by_id($id_arsip_sk);
		if ($data != null) {
			$dir = "asset/upload/SK/SK_".$data->id_jenis_sk.'_'.$data->id_ref.'_'.$data->id_arsip_sk;
			$path = $dir.'/'.$data->file_name;
			
			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}
			
			$this->arsip_sk_model->delete_by_id($id_arsip_sk);
		}
		
		echo json_encode(array("status" => $status));
	}

	public function jabatan_detail($id) {
		$this->db->select('
			tbl_data_riwayat_jabatan.*, tbl_master_status_jabatan.nama_status_jabatan, tbl_arsip_sk.id_ref,
			if (tbl_data_riwayat_jabatan.id_riwayat_status_jabatan = 10, tbl_data_riwayat_jabatan.nama_jabatan,tbl_master_nama_jabatan.nama_jabatan) as nama_jabatan,
			tbl_arsip_sk.id_jenis_sk,tbl_arsip_sk.id_arsip_sk, tbl_arsip_sk.file_name_ori, tbl_arsip_sk.file_name
		');
		$this->db->from('tbl_data_riwayat_jabatan');
		$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_riwayat_jabatan.id_riwayat_jabatan', 'left');
		$this->db->join('tbl_master_status_jabatan', 'tbl_master_status_jabatan.id_status_jabatan = tbl_data_riwayat_jabatan.id_riwayat_status_jabatan', 'left');
		$this->db->join('tbl_master_nama_jabatan', 'tbl_master_nama_jabatan.id_nama_jabatan = tbl_data_riwayat_jabatan.id_r_jabatan', 'left');
		$this->db->where('tbl_data_riwayat_jabatan.id_riwayat_jabatan', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}
	
	public function arsip_jabatan_list($id) {
		$this->db->select("*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_sk');
		$this->db->where('created_id', $id);
		$this->db->where('id_jenis_sk', $this->jenis_sk);

		$query = $this->db->get();
		$list = $query->result(); 

		echo json_encode($list);
	}
}

