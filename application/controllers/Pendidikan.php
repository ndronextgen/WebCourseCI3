<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendidikan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('pendidikan_model', 'tbl_data_pendidikan');
		$this->load->model('arsip_pendidikan_model');
		$this->load->library('func_table');
		$this->tipe_pendidikan = 1; //formal, 2: informal
	}

	public function pendidikan_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_pendidikan->get_datatables($id);
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $r->nama_pendidikan;
			$row[] = $r->jurusan;
			$row[] = $r->tempat_sekolah;
			$row[] = $r->kota;
			$row[] = $r->tanggal_lulus;

			$file = '-';

			//add html for action
			$button = '	<a class="btn btn-sm btn-success" href="javascript:void(0);" title="lihat detail" onclick="detail_pendidikan(' . "'" . $r->id_pendidikan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_pendidikan(' . "'" . $r->id_pendidikan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_pendidikan(' . "'" . $r->id_pendidikan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			// === begin: untuk tombol download ===
			$arsip = $this->tbl_data_pendidikan->get_arsip_by_id_ref($r->id_pendidikan);
			if ($arsip) {
				$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="pendidikan" data-id="' . utf8_encode($arsip->id_arsip_pendidikan) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';

				// === file ===
				$path_file = 'asset/upload/pendidikan/pendidikan_' . $arsip->id_tipe_pendidikan . '_' . $arsip->id_pendidikan . '_' . $arsip->id_arsip_pendidikan . '/' . $arsip->file_name;
				$file = $this->func_table->get_file($path_file, $arsip->file_name_ori);
			}
			// === end: untuk tombol download ===

			$row[] = $file;
			$row[] = $button;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_pendidikan->count_all($id),
			"recordsFiltered" => $this->tbl_data_pendidikan->count_filtered($id),
			"data" => $data
		);

		//output to json format
		echo json_encode($output);
	}

	public function pendidikan_edit($id_pendidikan)
	{
		$data = $this->tbl_data_pendidikan->get_by_id($id_pendidikan);
		$data->arsip = $this->tbl_data_pendidikan->get_arsip_by_id_ref($id_pendidikan);
		echo json_encode($data);
	}

	public function pendidikan_add()
	{
		$response = array('status' => true);
		$validate_pendidikan = $this->_validate_pendidikan();
		$id = $this->session->userdata('id_pegawai');

		$data = array(
			'id_master_pendidikan' => $this->input->post('id_master_pendidikan'),
			'jurusan' => $this->input->post('jurusan'),
			'tempat_sekolah' => $this->input->post('tempat_sekolah'),
			'kota' => $this->input->post('kota'),
			'nomor_sttb' => $this->input->post('nomor_sttb'),
			'tanggal_lulus' => $this->input->post('tanggal_lulus'),
			'id_pegawai' => $this->session->userdata('id_pegawai'),
		);

		if ($validate_pendidikan['status'] == true) {
			$insert_id = $this->tbl_data_pendidikan->save($data);
			$title_file = $this->tbl_data_pendidikan->getTingkatPendidikanName($this->input->post('id_master_pendidikan'));

			if ($insert_id) {
				if ($_FILES['arsipPendidikan_file']['name'] != '') {
					$ins = [
						'id_pendidikan' => $insert_id,
						'id_tipe_pendidikan' => $this->tipe_pendidikan,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pendidikan', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $this->tipe_pendidikan, $insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_pendidikan->update_arsip(
							['id_arsip_pendidikan' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_pendidikan->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_pendidikan->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/pendidikan/pendidikan_' . $this->tipe_pendidikan . '_' . $id_arsip . '_' . $insert_id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		} else {
			$response = $validate_pendidikan;
		}

		echo json_encode($response);
	}

	public function pendidikan_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_pendidikan');
		$validate_pendidikan = $this->_validate_pendidikan();

		if ($validate_pendidikan['status'] == true) {
			$data = array(
				'id_master_pendidikan' => $this->input->post('id_master_pendidikan'),
				'jurusan' => $this->input->post('jurusan'),
				'tempat_sekolah' => $this->input->post('tempat_sekolah'),
				'kota' => $this->input->post('kota'),
				'nomor_sttb' => $this->input->post('nomor_sttb'),
				'tanggal_lulus' => $this->input->post('tanggal_lulus'),
				'id_pegawai' => $this->session->userdata('id_pegawai'),
			);

			$this->tbl_data_pendidikan->update(array('id_pendidikan' => $id), $data);

			$title_file = $this->tbl_data_pendidikan->getTingkatPendidikanName($this->input->post('id_master_pendidikan'));

			if ($_FILES['arsipPendidikan_file']['name'] != '') {
				log_message('debug', 'arsip tidak kosong : ' . $id);
				$fileOld = $this->tbl_data_pendidikan->get_arsip_by_id_ref($id);
				if (!empty($fileOld)) {
					log_message('debug', 'masuk : ' . json_encode($fileOld));
					$ins = [
						'id_pendidikan' => $id,
						'id_tipe_pendidikan' => $this->tipe_pendidikan,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pendidikan', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $this->tipe_pendidikan, $id);
					if ($validate_arsip['status'] == true) {
						log_message('debug', 'valid arsip');
						log_message('debug', 'data arsip : ' . json_encode($validate_arsip));
						//update filename
						$this->tbl_data_pendidikan->update_arsip(
							['id_arsip_pendidikan' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/pendidikan/pendidikan_' . $fileOld->id_tipe_pendidikan . '_' . $fileOld->id_pendidikan . '_' . $fileOld->id_arsip_pendidikan;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						//delete arsip table
						$this->tbl_data_pendidikan->delete_arsip($fileOld->id_arsip_pendidikan);
					} else {
						//delete tabel arsip
						$this->tbl_data_pendidikan->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_pendidikan->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/pendidikan/pendidikan_' . $this->jenis_pendidikan . '_' . $id_arsip . '_' . $id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipPendidikan_file']['name'] != '') {
						$ins = [
							'id_pendidikan' => $id,
							'id_tipe_pendidikan' => $this->tipe_pendidikan,
							'title' => $title_file,
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
							'created_at' => date('Y-m-d H:i:s')
						];

						//insert into arsip
						$this->db->insert('tbl_arsip_pendidikan', $ins);
						$id_arsip = $this->db->insert_id();

						$validate_arsip = $this->_do_upload($id_arsip, $this->tipe_pendidikan, $id);
						if ($validate_arsip['status'] == true) {
							//update filename
							$this->tbl_data_pendidikan->update_arsip(
								['id_arsip_pendidikan' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							//delete tabel arsip
							$this->tbl_data_pendidikan->delete_arsip($id_arsip);

							//delete tabel riwayat jabatan
							$this->tbl_data_pendidikan->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/pendidikan/pendidikan_' . $this->tipe_pendidikan . '_' . $id_arsip . '_' . $id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_pendidikan;
		}

		echo json_encode($response);
	}

	public function pendidikan_delete($id_pendidikan)
	{
		//delete data pendidikan
		$this->tbl_data_pendidikan->delete_by_id($id_pendidikan);

		$arsip = $this->tbl_data_pendidikan->get_arsip_by_id_ref($id_pendidikan);
		if ($arsip) {
			//delete arsip file
			$path = './asset/upload/pendidikan/pendidikan_' . $this->tipe_pendidikan . '_' . $id_pendidikan . '_' . $arsip->id_arsip_pendidikan;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			//delete table arsip
			$this->db->delete('tbl_arsip_pendidikan', ['id_pendidikan' => $id_pendidikan]);
		}

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_pendidikan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_master_pendidikan') == '') {
			$data['inputerror'][] = 'id_master_pendidikan';
			$data['error_string'][] = 'Nama Pendidikan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jurusan') == '') {
			$data['inputerror'][] = 'jurusan';
			$data['error_string'][] = 'Jurusan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tempat_sekolah') == '') {
			$data['inputerror'][] = 'tempat_sekolah';
			$data['error_string'][] = 'Tempat Sekolah wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('kota') == '') {
			$data['inputerror'][] = 'kota';
			$data['error_string'][] = 'Kota wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nomor_sttb') == '') {
			$data['inputerror'][] = 'nomor_sttb';
			$data['error_string'][] = 'Nomor STTB wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_lulus') == '') {
			$data['inputerror'][] = 'tanggal_lulus';
			$data['error_string'][] = 'Tanggal Lulus wajib diisi';
			$data['status'] = FALSE;
		}

		return $data;
	}

	private function _do_upload($id, $tipe_pendidikan = 0, $id_pendidikan = 0)
	{
		$dir = "pendidikan_" . $tipe_pendidikan . '_' . $id_pendidikan . '_' . $id;
		$config['upload_path']          = './asset/upload/pendidikan/' . $dir;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}
		log_message('debug', 'do upload : ' . $dir);
		$this->load->library('upload', $config);

		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;

		if ($_FILES['arsipPendidikan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time() . str_replace(' ', '', $_FILES['arsipPendidikan_file']['name']);
			$_FILES['arsipPendidikan_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipPendidikan_file')) ||  $_FILES['arsipPendidikan_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipPendidikan_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipPendidikan_file']['name'];
			}
		}

		return $data;
	}

	public function download($id)
	{
		$id = utf8_encode($id);

		if ($id == "") {
			ob_start();
			echo "<script>alert('Gagal download file')</script>";
		} else {
			$data = $this->tbl_data_pendidikan->get_arsip_by_id($id);

			$dir = "pendidikan_" . $data->id_tipe_pendidikan . '_' . $data->id_pendidikan . '_' . $data->id_arsip_pendidikan;
			$path = file_get_contents('asset/upload/pendidikan/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita

			force_download($data->file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_pendidikan->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/pendidikan/pendidikan_' . $data->id_tipe_pendidikan . '_' . $data->id_pendidikan . '_' . $id;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			if (!$this->db->delete('tbl_arsip_pendidikan', ['id_arsip_pendidikan' => $id])) {
				$status = false;
			}
		} else {
			$status = false;
		}

		$response = ['status' => $status];
		echo json_encode($response);
	}

	public function pendidikan_list($id)
	{
		$this->db->select('
			tbl_data_pendidikan.id_pendidikan, tbl_master_pendidikan.nama_pendidikan, tbl_data_pendidikan.jurusan, 
			tbl_data_pendidikan.tempat_sekolah, tbl_data_pendidikan.kota, tbl_data_pendidikan.tanggal_lulus, 
			tbl_arsip_pendidikan.file_name_ori, tbl_arsip_pendidikan.id_arsip_pendidikan, tbl_arsip_pendidikan.title,
			tbl_arsip_pendidikan.file_name
		');
		$this->db->from('tbl_data_pendidikan');
		$this->db->join('tbl_master_pendidikan', 'tbl_master_pendidikan.id_master_pendidikan = tbl_data_pendidikan.id_master_pendidikan', 'left');
		$this->db->join('tbl_arsip_pendidikan', 'tbl_arsip_pendidikan.id_pendidikan = tbl_data_pendidikan.id_pendidikan', 'left');
		$this->db->where('tbl_data_pendidikan.id_pegawai', $id);

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function pendidikan_delete_arsip($id_pendidikan, $id_arsip_pendidikan)
	{
		$status = true;

		//delete data pendidikan
		$this->tbl_data_pendidikan->delete_by_id($id_pendidikan);

		$data = $this->arsip_pendidikan_model->get_by_id($id_arsip_pendidikan);
		if ($data != null) {
			$dir = './asset/upload/pendidikan/pendidikan_' . $data->id_tipe_pendidikan . '_' . $data->id_pendidikan . '_' . $data->id_arsip_pendidikan;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_pendidikan_model->delete_by_id($id_arsip_pendidikan);
		}

		echo json_encode(array("status" => $status));
	}

	public function arsip_pendidikan_list($id)
	{
		$this->db->select("tbl_arsip_pendidikan.*, tbl_master_tipe_pendidikan.tipe_pendidikan, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_pendidikan');
		$this->db->join('tbl_master_tipe_pendidikan', 'tbl_master_tipe_pendidikan.id_tipe_pendidikan = tbl_arsip_pendidikan.id_tipe_pendidikan', 'left');
		$this->db->where('tbl_arsip_pendidikan.created_id', $id);

		$query = $this->db->get();
		$list = $query->result();
		echo json_encode($list);
	}

	public function pendidikan_detail($id)
	{
		$this->db->select('
			tbl_data_pendidikan.*, tbl_master_pendidikan.nama_pendidikan, tbl_arsip_pendidikan.id_arsip_pendidikan,
			tbl_arsip_pendidikan.id_tipe_pendidikan,tbl_arsip_pendidikan.file_name_ori, tbl_arsip_pendidikan.file_name,
			tbl_arsip_pendidikan.title
		');
		$this->db->from('tbl_data_pendidikan');
		$this->db->join('tbl_arsip_pendidikan', 'tbl_arsip_pendidikan.id_pendidikan = tbl_data_pendidikan.id_pendidikan', 'left');
		$this->db->join('tbl_master_pendidikan', 'tbl_master_pendidikan.id_master_pendidikan = tbl_data_pendidikan.id_master_pendidikan', 'left');
		$this->db->where('tbl_data_pendidikan.id_pendidikan', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}

	public function download_all()
	{
		$this->load->library('zip');
		//$objArsip = $this->arsip_sk_model->get_by_id_input($this->session->userdata('id_pegawai'));
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT * FROM tbl_data_pendidikan WHERE id_pegawai = '$Id'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = "pendidikan_" . $arsip->id_tipe_pendidikan . '_' . $arsip->id_pendidikan . '_' . $arsip->id_arsip_pendidikan;
				$pathFile = FCPATH . 'asset/upload/pendidikan/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pendidikan/' . $dir . '/' . $arsip->file_name); // letak file pada aplikasi kita
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_SKPendidikanFormal.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function form_detail_pendidikan()
	{
		$Id = $this->input->post('Id');
		$this->db->select('
			tbl_data_pendidikan.*, tbl_master_pendidikan.nama_pendidikan, tbl_arsip_pendidikan.id_arsip_pendidikan,
			tbl_arsip_pendidikan.id_tipe_pendidikan,tbl_arsip_pendidikan.file_name_ori, tbl_arsip_pendidikan.file_name,
			tbl_arsip_pendidikan.title
		');
		$this->db->from('tbl_data_pendidikan');
		$this->db->join('tbl_arsip_pendidikan', 'tbl_arsip_pendidikan.id_pendidikan = tbl_data_pendidikan.id_pendidikan', 'left');
		$this->db->join('tbl_master_pendidikan', 'tbl_master_pendidikan.id_master_pendidikan = tbl_data_pendidikan.id_master_pendidikan', 'left');
		$this->db->where('tbl_data_pendidikan.id_pendidikan', $Id);
		$query = $this->db->get();
		$QData = $query->row();
		$a['data']	= $QData;
		$a['path_file'] = 'asset/upload/pendidikan/pendidikan_' . $QData->id_tipe_pendidikan . '_' . $QData->id_pendidikan . '_' . $QData->id_arsip_pendidikan;

		$this->load->view('dashboard_publik/homes/group_pendidikan/formal/form_detail', $a);
	}
}
