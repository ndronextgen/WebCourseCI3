<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sklainnya extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('sklainnya_model', 'tbl_data_sklainnya');
		$this->load->model('arsip_sk_model');
	}
	
	public function sklainnya_datatables() {
        // Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_sklainnya->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();
			$row[] = $n1;
			$row[] = $r->title;
			
			$btnDownload = '';
			$arsip = $this->tbl_data_pribadilainnya->get_arsip_by_id_ref($r->id_arsip_pribadi);
			if ($arsip) {
				$btnDownload = '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="keluarga" data-id="'.utf8_encode($arsip->id_arsip_pribadi).'" data-title="Download" title="Download Data"><i class="fa fa-download"></i> Download</button> ';
			}

			//add html for action
			$row[] = $btnDownload. 
					  '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_keluarga('."'".$r->id_arsip_pribadi."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_keluarga('."'".$r->id_arsip_pribadi."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					  
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tbl_data_pribadilainnya->count_all($id),
						"recordsFiltered" => $this->tbl_data_pribadilainnya->count_filtered($id),
						"data" => $data,
				);

		//output to json format
		echo json_encode($output);
	}
	
	public function pribadilainnya_edit($id_data_keluarga) {
		$data = $this->tbl_data_pribadilainnya->get_by_id($id_data_keluarga);
		$data->tanggal_lahir_keluarga = ($data->tanggal_lahir_keluarga == '00-00-0000') ? '' : $data->tanggal_lahir_keluarga; // if 0000-00-00 set tu empty for datepicker compatibility
		$data->arsip = $this->tbl_data_pribadilainnya->get_arsip_by_id_ref($id_data_keluarga);
		echo json_encode($data);
	}
	
	public function pribadilainnya_add() {
		$response = array('status' => true);
		$validate_keluarga = $this->_validate_keluarga();

		$data = array(
				'nama_anggota_keluarga' => $this->input->post('nama_anggota_keluarga'),
				'hub_keluarga' => $this->input->post('hub_keluarga'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir_keluarga' => $this->input->post('tanggal_lahir_keluarga'),
				'uraian' => $this->input->post('uraian'),
				'id_pegawai' => $this->session->userdata('id_pegawai')
			);
			
		if ($validate_keluarga['status'] == true) {
			$insert_id = $this->tbl_data_keluarga->save($data);
			
			if ($insert_id) {
				if ($_FILES['arsipPribadi_file']['name'] != '') {
					$ins = [
						'id_data_keluarga' => $insert_id,
						'title' => $this->input->post('arsipPribadi_title'),
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
	
	public function keluarga_update() {
		$response = array('status' => true);
		$id = $this->input->post('id_data_keluarga');
		$validate_keluarga = $this->_validate_keluarga();
		
		if ($validate_keluarga['status'] == true) {
			$data = array(
					'nama_anggota_keluarga' => $this->input->post('nama_anggota_keluarga'),
					'hub_keluarga' => $this->input->post('hub_keluarga'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'tanggal_lahir_keluarga' => $this->input->post('tanggal_lahir_keluarga'),
					'uraian' => $this->input->post('uraian'),
					'id_pegawai' => $this->session->userdata('id_pegawai'),
				);
				
			$this->tbl_data_keluarga->update(array('id_data_keluarga' => $id), $data);
			
			if ($_FILES['arsipPribadi_file']['name'] != '') {
				$fileOld = $this->tbl_data_keluarga->get_arsip_by_id_ref($id);
				if (!empty($fileOld)) {
					$ins = [
						'id_data_keluarga' => $id,
						'title' => $this->input->post('arsipPribadi_title'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
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

						//delete arsip old file
						$path = './asset/upload/pribadi/pribadi_'.$fileOld->id_data_keluarga.'_'.$fileOld->id_arsip_pribadi;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
						
						//delete arsip table
						$this->tbl_data_keluarga->delete_arsip($fileOld->id_arsip_pribadi);
					}
					else {
						//delete tabel arsip
						$this->tbl_data_keluarga->delete_arsip($id_arsip);

						//delete tabel riwayat pangkat
						$this->tbl_data_keluarga->delete_by_id($id);
					
						//delete arsip file
						$path = './asset/upload/pribadi/pribadi_'.$id_arsip.'_'.$id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
				else {
					if ($_FILES['arsipPribadi_file']['name'] != '') {
						$ins = [
							'id_data_keluarga' => $id,
							'title' => $this->input->post('arsipPribadi_title'),
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
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
						}
						else {
							$response = $validate_arsip;
							//delete tabel arsip
							$this->tbl_data_keluarga->delete_arsip($id_arsip);

							//delete tabel data pribadi
							$this->tbl_data_keluarga->delete_by_id($id);
						
							//delete arsip file
							$path = './asset/upload/pribadi/pribadi_'.$id_arsip.'_'.$id;
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
			$response = $validate_keluarga;
		}
		
		echo json_encode($response);
	}
	
	public function keluarga_delete($id_data_keluarga) {
		//delete data keluarga
		$this->tbl_data_keluarga->delete_by_id($id_data_keluarga);
		
		//delete arsip file
		$path = './asset/upload/pribadi/pribadi'.$id_data_keluarga;

		if (is_dir($path)) {
			delete_files($path, true);
			rmdir($path);
		}
		
		//delete table arsip
		$this->db->delete('tbl_arsip_pribadi', [ 'id_data_keluarga' => $id_data_keluarga]);
		echo json_encode(array("status" => TRUE));
	}
	
	private function _validate_keluarga() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('nama_anggota_keluarga') == '') {
			$data['inputerror'][] = 'nama_anggota_keluarga';
			$data['error_string'][] = 'Nama Anggota Keluarga wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('hub_keluarga') == '') {
			$data['inputerror'][] = 'hub_keluarga';
			$data['error_string'][] = 'Hubungan Keluarga wajib diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('jenis_kelamin') == '') {
			$data['inputerror'][] = 'jenis_kelamin';
			$data['error_string'][] = 'Jenis Kelamin wajib dipilih';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tanggal_lahir_keluarga') == '') {
			$data['inputerror'][] = 'tanggal_lahir_keluarga';
			$data['error_string'][] = 'Tanggal Lahir wajib di isi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('arsipPribadi_title') == '') {
			$data['inputerror'][] = 'arsipPribadi_title';
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
		
		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;
		
		if ($_FILES['arsipPribadi_file']['name'] != '') {
			$name = time().str_replace(' ','',$_FILES['arsipPribadi_file']['name']);
			$_FILES['arsipPribadi_file']['name'] = $name;
			
            if(!($this->upload->do_upload('arsipPribadi_file')) ||  $_FILES['arsipPribadi_file']['error'] !=0) {
				$data['inputerror'][] = 'arsipPribadi_file';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
				$data['status'] = false;
			}
			else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipPribadi_file']['name'];
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
			$data = $this->tbl_data_keluarga->get_arsip_by_id($id);
			$file_name_ori = $data->file_name_ori;
			$file_name = $data->file_name;
			$id_data_keluarga = $data->id_data_keluarga;	
			$dir = "pribadi_".$id_data_keluarga."_".$id;
			$path = file_get_contents('asset/upload/pribadi/'.$dir.'/'.$file_name); // letak file pada aplikasi kita
			force_download($file_name_ori,$path);
		}
	}
	
	public function delete_arsip($id) {
		$status = true;
		$data = $this->tbl_data_keluarga->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/pribadi/pribadi_'.$data->id_ref.'_'.$data->id_arsip_pribadi;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}
			
			if (!$this->db->delete('tbl_arsip_pribadi', ['id_arsip_pribadi' => $id])) {
				$status = false;
			}
		}
		else {
			$status = false;
		}
		
		$response = ['status' => $status];
		echo json_encode($response);
	} 

	public function sklainnya_list($id) {

		// $this->db->select('
		// 				tbl_arsip_pribadi.id_arsip_pribadi, tbl_arsip_pribadi.id_data_keluarga, tbl_arsip_pribadi.title, tbl_arsip_pribadi.file_name_ori, tbl_arsip_pribadi.file_name, tbl_arsip_pribadi.created_id, tbl_arsip_pribadi.created_at, tbl_data_pegawai.nip, tbl_data_pegawai.nrk, tbl_data_pegawai.nama_pegawai, tbl_data_pegawai.email, tbl_data_pegawai.telepon, tbl_data_pegawai.lokasi_kerja
		// ');
		// $this->db->from('tbl_arsip_pribadi');
		// $this->db->join('tbl_data_pegawai', 'tbl_arsip_pribadi.created_id = tbl_data_pegawai.id_pegawai', 'inner');
		// $this->db->order_by("created_at", "desc"); 
		// $this->db->where('tbl_data_pegawai.id_pegawai', $id);

		

		if(isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		// $query = $this->db->get();
		// $list = $query->result(); 

		$list = $this->db->query("SELECT * FROM tbl_arsip_sk WHERE tbl_arsip_sk.created_id  = '$id' AND id_jenis_sk = '4'
						ORDER BY tbl_arsip_sk.created_at DESC
						")->result();

		echo json_encode($list);
	}

	public function keluarga_delete_arsip($id_data_keluarga, $id_arsip_pribadi)
	{
		$status = true;
		
		//delete data keluarga
		$this->tbl_data_keluarga->delete_by_id($id_data_keluarga);
		
		$data = $this->arsip_pribadi_model->get_by_id($id_arsip_pribadi);
		if ($data != null) {
			$dir = "asset/upload/pribadi/pribadi_".$id_data_keluarga."_".$id_arsip_pribadi;
			$path = $dir.'/'.$data->file_name;
			
			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}
			
			$this->arsip_pribadi_model->delete_by_id($id_arsip_pribadi);
		}
		
		echo json_encode(array("status" => $status));
	}

	public function arsip_keluarga_list($id) {
		$this->db->select("*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_pribadi');
		$this->db->where('created_id', $id);

		$query = $this->db->get();
		$list = $query->result(); 

		echo json_encode($list);
	}

	public function keluarga_detail($id) {
		$this->db->select('
			tbl_data_keluarga.id_data_keluarga, tbl_data_keluarga.nama_anggota_keluarga, 
			tbl_data_keluarga.tanggal_lahir_keluarga, tbl_data_keluarga.id_pegawai, 
			tbl_data_keluarga.jenis_kelamin, tbl_data_keluarga.hub_keluarga, tbl_data_keluarga.uraian, 
			tbl_arsip_pribadi.id_arsip_pribadi, tbl_arsip_pribadi.title, tbl_arsip_pribadi.file_name_ori, 
			tbl_arsip_pribadi.file_name
		');
		$this->db->from('tbl_data_keluarga');
		$this->db->join('tbl_arsip_pribadi', 'tbl_arsip_pribadi.id_data_keluarga = tbl_data_keluarga.id_data_keluarga', 'left');
		$this->db->where('tbl_data_keluarga.id_data_keluarga', $id);

		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}
}

