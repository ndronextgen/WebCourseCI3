<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatihan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('pelatihan_model', 'tbl_data_pelatihan');
		$this->load->model('arsip_pelatihan_model');
		$this->load->library('func_table');
	}

	public function pelatihan_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_pelatihan->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();

			if ($r->id_master_pelatihan == '394') {
				$nama_pelatihan = $r->nama_pelatihan_lainnya;
			} else {
				$nama_pelatihan = $r->nama_pelatihan;
			}

			$row[] = $no;
			$row[] = $nama_pelatihan;
			$row[] = $r->lokasi;
			$row[] = $r->no_sertifikat;
			$row[] = date_format(date_create($r->tanggal_sertifikat), 'j M Y');
			$row[] = $r->uraian;

			$file = '-';

			//add html for action
			$button = '	<a class="btn btn-sm btn-success" href="javascript:void(0);" title="lihat detail" onclick="detail_pelatihan(' . "'" . $r->id_pelatihan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_pelatihan(' . "'" . $r->id_pelatihan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_pelatihan(' . "'" . $r->id_pelatihan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			// === begin: untuk tombol download ===
			$arsip = $this->tbl_data_pelatihan->get_arsip_by_id_ref($r->id_pelatihan);
			if ($arsip) {
				$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="pelatihan" data-id="' . utf8_encode($arsip->id_arsip_pelatihan) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';

				// === file ===
				$path_file = 'asset/upload/pelatihan/pelatihan_' . $arsip->id_pelatihan . '_' . $arsip->id_arsip_pelatihan . '/' . $arsip->file_name;
				$file = $this->func_table->get_file($path_file, $arsip->file_name_ori);
			}
			// === end: untuk tombol download ===

			$row[] = $file;
			$row[] = $button;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_pelatihan->count_all($id),
			"recordsFiltered" => $this->tbl_data_pelatihan->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function pelatihan_edit($id_pelatihan)
	{
		$data = $this->tbl_data_pelatihan->get_by_id($id_pelatihan);
		$data->arsip = $this->tbl_data_pelatihan->get_arsip_by_id_ref($id_pelatihan);
		echo json_encode($data);
	}

	public function pelatihan_add()
	{
		$response = array('status' => true);
		$validate_pelatihan = $this->_validate_pelatihan();
		$id = $this->session->userdata('id_pegawai');

		$data = array(
			'id_master_pelatihan' => $this->input->post('id_master_pelatihan'),
			'nama_pelatihan_lainnya' => $this->input->post('nama_pelatihan_lainnya'),
			'lokasi' => $this->input->post('lokasi'),
			'no_sertifikat' => $this->input->post('no_sertifikat'),
			'tanggal_sertifikat' => $this->input->post('tanggal_sertifikat'),
			'id_pegawai' => $this->session->userdata('id_pegawai'),
			'uraian' => $this->input->post('uraian'),
		);

		if ($validate_pelatihan['status'] == true) {
			$insert_id = $this->tbl_data_pelatihan->save($data);
			$title_file = $this->tbl_data_pelatihan->getMasterPelatihanName($this->input->post('id_master_pelatihan'));

			if ($insert_id) {
				if ($_FILES['arsipPelatihan_file']['name'] != '') {
					$ins = [
						'id_pelatihan' => $insert_id,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pelatihan', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_pelatihan->update_arsip(
							['id_arsip_pelatihan' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_pelatihan->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_pelatihan->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/pelatihan/pelatihan_' . $id_arsip . '_' . $insert_id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		} else {
			$response = $validate_pelatihan;
		}

		echo json_encode($response);
	}

	public function pelatihan_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_pelatihan');
		$validate_pelatihan = $this->_validate_pelatihan();

		if ($validate_pelatihan['status'] == true) {
			$data = array(
				'id_master_pelatihan' => $this->input->post('id_master_pelatihan'),
				'nama_pelatihan_lainnya' => $this->input->post('nama_pelatihan_lainnya'),
				'lokasi' => $this->input->post('lokasi'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'tanggal_sertifikat' => $this->input->post('tanggal_sertifikat'),
				'id_pegawai' => $this->session->userdata('id_pegawai'),
				'uraian' => $this->input->post('uraian'),
			);

			$this->tbl_data_pelatihan->update(array('id_pelatihan' => $id), $data);

			$title_file = $this->tbl_data_pelatihan->getMasterPelatihanName($this->input->post('id_master_pelatihan'));

			if ($_FILES['arsipPelatihan_file']['name'] != '') {
				log_message('debug', 'arsip tidak kosong : ' . $id);
				$fileOld = $this->tbl_data_pelatihan->get_arsip_by_id_ref($id);
				if (!empty($fileOld)) {
					log_message('debug', 'masuk : ' . json_encode($fileOld));
					$ins = [
						'id_pelatihan' => $id,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_pelatihan', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $id);
					if ($validate_arsip['status'] == true) {
						log_message('debug', 'valid arsip');
						log_message('debug', 'data arsip : ' . json_encode($validate_arsip));
						//update filename
						$this->tbl_data_pelatihan->update_arsip(
							['id_arsip_pelatihan' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/pelatihan/pelatihan_' . $fileOld->id_pelatihan . '_' . $fileOld->id_arsip_pelatihan;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						//delete arsip table
						$this->tbl_data_pelatihan->delete_arsip($fileOld->id_arsip_pelatihan);
					} else {
						//delete tabel arsip
						$this->tbl_data_pelatihan->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_pelatihan->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/pelatihan/pelatihan_' . $id_arsip . '_' . $id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipPelatihan_file']['name'] != '') {
						$ins = [
							'id_pelatihan' => $id,
							'title' => $title_file,
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
							'created_at' => date('Y-m-d H:i:s')
						];

						//insert into arsip
						$this->db->insert('tbl_arsip_pelatihan', $ins);
						$id_arsip = $this->db->insert_id();

						$validate_arsip = $this->_do_upload($id_arsip, $id);
						if ($validate_arsip['status'] == true) {
							//update filename
							$this->tbl_data_pelatihan->update_arsip(
								['id_arsip_pelatihan' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							//delete tabel arsip
							$this->tbl_data_pelatihan->delete_arsip($id_arsip);

							//delete tabel
							$this->tbl_data_pelatihan->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/pelatihan/pelatihan_' . $id_arsip . '_' . $id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_pelatihan;
		}

		echo json_encode($response);
	}

	public function pelatihan_delete($id_pelatihan)
	{
		//delete data pelatihan
		$this->tbl_data_pelatihan->delete_by_id($id_pelatihan);

		$arsip = $this->tbl_data_pelatihan->get_arsip_by_id_ref($id_pelatihan);
		if ($arsip) {
			//delete arsip file
			$path = './asset/upload/pelatihan/pelatihan_' . $id_pelatihan . '_' . $arsip->id_arsip_pelatihan;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			//delete table arsip
			$this->db->delete('tbl_arsip_pelatihan', ['id_pelatihan' => $id_pelatihan]);
		}

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_pelatihan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_master_pelatihan') == '') {
			$data['inputerror'][] = 'id_master_pelatihan';
			$data['error_string'][] = 'Nama Pelatihan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('lokasi') == '') {
			$data['inputerror'][] = 'lokasi';
			$data['error_string'][] = 'Lokasi wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('no_sertifikat') == '') {
			$data['inputerror'][] = 'no_sertifikat';
			$data['error_string'][] = 'Nomor Sertifikat wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_sertifikat') == '') {
			$data['inputerror'][] = 'tanggal_sertifikat';
			$data['error_string'][] = 'Tanggal Sertifikat wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_master_pelatihan') == 394) {
			if ($this->input->post('nama_pelatihan_lainnya') == '') {
				$data['inputerror'][] = 'nama_pelatihan_lainnya';
				$data['error_string'][] = 'Nama Pelatihan Lainnya wajib diisi';
				$data['status'] = FALSE;
			}
		}

		return $data;
	}

	private function _do_upload($id, $id_pelatihan = 0)
	{
		$dir = "pelatihan_" . $id_pelatihan . '_' . $id;
		$config['upload_path']          = './asset/upload/pelatihan/' . $dir;
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

		if ($_FILES['arsipPelatihan_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time() . str_replace(' ', '', $_FILES['arsipPelatihan_file']['name']);
			$_FILES['arsipPelatihan_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipPelatihan_file')) ||  $_FILES['arsipPelatihan_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipPelatihan_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipPelatihan_file']['name'];
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
			$data = $this->tbl_data_pelatihan->get_arsip_by_id($id);
			$dir = "pelatihan_" . $data->id_pelatihan . '_' . $data->id_arsip_pelatihan;
			$path = file_get_contents('asset/upload/pelatihan/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita

			force_download($data->file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_pelatihan->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/pelatihan/pelatihan_' . $data->id_pelatihan . '_' . $data->id_arsip_pelatihan;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			if (!$this->db->delete('tbl_arsip_pelatihan', ['id_arsip_pelatihan' => $id])) {
				$status = false;
			}
		} else {
			$status = false;
		}

		$response = ['status' => $status];

		echo json_encode($response);
	}

	public function pelatihan_list($id)
	{
		$this->db->select('
			tbl_data_pelatihan.id_pelatihan, tbl_master_pelatihan.nama_pelatihan, tbl_data_pelatihan.lokasi,
			tbl_data_pelatihan.no_sertifikat, tbl_data_pelatihan.tanggal_sertifikat, tbl_data_pelatihan.uraian, 
			tbl_arsip_pelatihan.id_arsip_pelatihan, tbl_arsip_pelatihan.file_name_ori, tbl_arsip_pelatihan.file_name
		');
		$this->db->from('tbl_data_pelatihan');
		$this->db->join('tbl_master_pelatihan', 'tbl_master_pelatihan.id_master_pelatihan = tbl_data_pelatihan.id_master_pelatihan', 'left');
		$this->db->join('tbl_arsip_pelatihan', 'tbl_arsip_pelatihan.id_pelatihan = tbl_data_pelatihan.id_pelatihan', 'left');
		$this->db->where('tbl_data_pelatihan.id_pegawai', $id);

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function pelatihan_delete_arsip($id_pelatihan, $id_arsip_pelatihan)
	{
		$status = true;

		//delete data pelatihan
		$this->tbl_data_pelatihan->delete_by_id($id_pelatihan);

		$data = $this->arsip_pelatihan_model->get_by_id($id_arsip_pelatihan);
		if ($data != null) {
			$dir = "asset/upload/pelatihan/pelatihan_" . $data->id_arsip_pelatihan . "_" . $data->id_pelatihan;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_pelatihan_model->delete_by_id($id_arsip_pelatihan);
		}
	}

	public function arsip_pelatihan_list($id)
	{
		$this->db->select("tbl_arsip_pelatihan.*, tbl_master_tipe_pendidikan.tipe_pendidikan, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_pelatihan');
		$this->db->join('tbl_master_tipe_pendidikan', 'tbl_master_tipe_pendidikan.id_tipe_pendidikan = tbl_arsip_pelatihan.id_tipe_pendidikan', 'left');
		$this->db->where('tbl_arsip_pelatihan.created_id', $id);

		$query = $this->db->get();
		$list = $query->result();
		echo json_encode($list);
	}

	public function pelatihan_detail($id)
	{
		$this->db->select('
			tbl_data_pelatihan.*, tbl_master_pelatihan.nama_pelatihan, tbl_arsip_pelatihan.id_arsip_pelatihan,
			tbl_arsip_pelatihan.file_name_ori, tbl_arsip_pelatihan.file_name, tbl_arsip_pelatihan.title
		');
		$this->db->from('tbl_data_pelatihan');
		$this->db->join('tbl_arsip_pelatihan', 'tbl_arsip_pelatihan.id_pelatihan = tbl_data_pelatihan.id_pelatihan', 'left');
		$this->db->join('tbl_master_pelatihan', 'tbl_master_pelatihan.id_master_pelatihan = tbl_data_pelatihan.id_master_pelatihan', 'left');
		$this->db->where('tbl_data_pelatihan.id_pelatihan', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}

	public function download_all()
	{

		$this->load->library('zip');
		//$objArsip = $this->arsip_sk_model->get_by_id_input($this->session->userdata('id_pegawai'));
		$Id = $this->session->userdata('id_pegawai');
		$objArsip = $this->db->query("SELECT * FROM tbl_data_pelatihan WHERE id_pegawai = '$Id'")->result();

		$zip = false;
		if ($objArsip) {
			foreach ($objArsip as $arsip) {
				$dir = "pelatihan_" . $data->id_pelatihan . '_' . $data->id_arsip_pelatihan;
				$pathFile = FCPATH . 'asset/upload/pelatihan/' . $dir . '/' . $arsip->file_name;
				if (file_exists($pathFile)) {
					$file = file_get_contents('asset/upload/pelatihan/' . $dir . '/' . $arsip->file_name); // letak file pada aplikasi kita
					$this->zip->add_data($arsip->file_name_ori, $file);
					$zip = true;
				}
			}
		}
		$filename = str_replace(' ', '_', $this->session->userdata('nama')) . '_ARSIP_DIGITAL_SKPendidikanNonFormal.zip';
		if ($zip) {
			$this->zip->download($filename);
		}
	}

	public function form_detail_pelatihan()
	{
		$Id = $this->input->post('Id');
		$this->db->select('
			tbl_data_pelatihan.*, tbl_master_pelatihan.nama_pelatihan, tbl_arsip_pelatihan.id_arsip_pelatihan,
			tbl_arsip_pelatihan.file_name_ori, tbl_arsip_pelatihan.file_name, tbl_arsip_pelatihan.title
		');
		$this->db->from('tbl_data_pelatihan');
		$this->db->join('tbl_arsip_pelatihan', 'tbl_arsip_pelatihan.id_pelatihan = tbl_data_pelatihan.id_pelatihan', 'left');
		$this->db->join('tbl_master_pelatihan', 'tbl_master_pelatihan.id_master_pelatihan = tbl_data_pelatihan.id_master_pelatihan', 'left');
		$this->db->where('tbl_data_pelatihan.id_pelatihan', $Id);
		$query = $this->db->get();
		$QData = $query->row();
		$a['data']	= $QData;

		$a['path_file'] = 'asset/upload/pelatihan/pelatihan_' . $QData->id_pelatihan . '_' . $QData->id_arsip_pelatihan;
		$this->load->view('dashboard_publik/homes/group_pendidikan/nonformal/form_detail', $a);
	}
}
