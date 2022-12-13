<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Skp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('skp_model', 'tbl_data_dp3');
		$this->load->model('arsip_skp_model');
	}

	public function skp_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_dp3->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $r->uraian;
			$row[] = $r->tahun;
			$row[] = $r->rata_rata;
			$row[] = $r->atasan;
			$row[] = $r->penilai;

			//add html for action
			$button = '	<a class="btn btn-sm btn-success" href="javascript:void(0);" title="lihat detail" onclick="detail_skp(' . "'" . $r->id_dp3 . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_skp(' . "'" . $r->id_dp3 . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_skp(' . "'" . $r->id_dp3 . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			$arsip = $this->tbl_data_pelatihan->get_arsip_by_id_ref($r->id_pelatihan);
			if ($arsip) {
				$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="skp" data-id="' . utf8_encode($arsip->id_arsip_skp) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i> Download</button>';
			}
			$row[] = $button;
			
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_dp3->count_all($id),
			"recordsFiltered" => $this->tbl_data_dp3->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function skp_edit($id_dp3)
	{
		$data = $this->tbl_data_dp3->get_by_id($id_dp3);
		$data->arsip = $this->tbl_data_dp3->get_arsip_by_id_ref($id_dp3);
		echo json_encode($data);
	}

	public function skp_add()
	{
		$response = array('status' => true);
		$validate_skp = $this->_validate_skp();

		$data = array(
			'uraian' => $this->input->post('uraian'),
			'tahun' => $this->input->post('tahun'),
			'orientasi' => $this->input->post('orientasi'),
			'integritas' => $this->input->post('integritas'),
			'komitmen' => $this->input->post('komitmen'),
			'disiplin' => $this->input->post('disiplin'),
			'kesetiaan' => $this->input->post('kesetiaan'),
			'prestasi' => $this->input->post('prestasi'),
			'tanggung_jawab' => $this->input->post('tanggung_jawab'),
			'ketaatan' => $this->input->post('ketaatan'),
			'kejujuran' => $this->input->post('kejujuran'),
			'kerjasama' => $this->input->post('kerjasama'),
			'prakarsa' => $this->input->post('prakarsa'),
			'kepemimpinan' => $this->input->post('kepemimpinan'),
			'rata_rata' => $this->input->post('rata_rata'),
			'atasan' => $this->input->post('atasan'),
			'penilai' => $this->input->post('penilai'),
			'id_pegawai' => $this->session->userdata('id_pegawai'),
		);

		if ($validate_skp['status'] == true) {
			$insert_id = $this->tbl_data_dp3->save($data);

			if ($insert_id) {
				if ($_FILES['arsipSkp_file']['name'] != '') {
					$ins = [
						'id_dp3' => $insert_id,
						'title' => $this->input->post('uraian') . ' ' . $this->input->post('tahun'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_skp', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_dp3->update_arsip(
							['id_arsip_skp' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_dp3->delete_arsip($id_arsip);

						//delete tabel
						$this->tbl_data_dp3->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/SKP/SKP_' . $insert_id . '_' . $id_arsip;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		} else {
			$response = $validate_skp;
		}

		echo json_encode($response);
	}

	public function skp_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_dp3');
		$validate_skp = $this->_validate_skp();

		if ($validate_skp['status'] == true) {
			$data = array(
				'uraian' => $this->input->post('uraian'),
				'tahun' => $this->input->post('tahun'),
				'orientasi' => $this->input->post('orientasi'),
				'integritas' => $this->input->post('integritas'),
				'komitmen' => $this->input->post('komitmen'),
				'disiplin' => $this->input->post('disiplin'),
				'kesetiaan' => $this->input->post('kesetiaan'),
				'prestasi' => $this->input->post('prestasi'),
				'tanggung_jawab' => $this->input->post('tanggung_jawab'),
				'ketaatan' => $this->input->post('ketaatan'),
				'kejujuran' => $this->input->post('kejujuran'),
				'kerjasama' => $this->input->post('kerjasama'),
				'prakarsa' => $this->input->post('prakarsa'),
				'kepemimpinan' => $this->input->post('kepemimpinan'),
				'rata_rata' => $this->input->post('rata_rata'),
				'atasan' => $this->input->post('atasan'),
				'penilai' => $this->input->post('penilai'),
				'id_pegawai' => $this->session->userdata('id_pegawai')
			);

			$this->tbl_data_dp3->update(array('id_dp3' => $id), $data);

			if ($_FILES['arsipSkp_file']['name'] != '') {
				$fileOld = $this->tbl_data_dp3->get_arsip_by_id_ref($id);
				if (!empty($fileOld)) {
					$ins = [
						'id_dp3' => $id,
						'title' => $this->input->post('uraian') . ' ' . $this->input->post('tahun'),
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_skp', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_dp3->update_arsip(
							['id_arsip_skp' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/SKP/SKP_' . $fileOld->id_dp3 . '_' . $fileOld->id_arsip_skp;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						//delete arsip table
						$this->tbl_data_dp3->delete_arsip($fileOld->id_arsip_skp);
					} else {
						//delete tabel arsip
						$this->tbl_data_dp3->delete_arsip($id_arsip);

						//delete tabel riwayat pangkat
						$this->tbl_data_dp3->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/SKP/SKP_' . $id_arsip . '_' . $id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipSkp_file']['name'] != '') {
						$ins = [
							'id_dp3' => $id,
							'title' => $this->input->post('uraian') . ' ' . $this->input->post('tahun'),
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
							'created_at' => date('Y-m-d H:i:s')
						];

						//insert into arsip
						$this->db->insert('tbl_arsip_skp', $ins);
						$id_arsip = $this->db->insert_id();

						$validate_arsip = $this->_do_upload($id_arsip, $id);
						if ($validate_arsip['status'] == true) {
							//update filename
							$this->tbl_data_dp3->update_arsip(
								['id_arsip_skp' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							//delete tabel arsip
							$this->tbl_data_dp3->delete_arsip($id_arsip);

							//delete tabel data pribadi
							$this->tbl_data_dp3->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/SKP/SKP_' . $id_arsip . '_' . $id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_skp;
		}

		echo json_encode($response);
	}

	public function skp_delete($id_dp3)
	{

		//delete data skp
		$this->tbl_data_dp3->delete_by_id($id_dp3);

		//delete arsip file
		$path = './asset/upload/SKP/SKP_' . $id_dp3;

		if (is_dir($path)) {
			delete_files($path, true);
			rmdir($path);
		}

		//delete table arsip
		$this->db->delete('tbl_arsip_skp', ['id_dp3' => $id_dp3]);

		//delete data
		$this->tbl_data_dp3->delete_by_id($id_dp3);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_skp()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('uraian') == '') {
			$data['inputerror'][] = 'uraian';
			$data['error_string'][] = 'Jenis Data wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tahun') == '') {
			$data['inputerror'][] = 'tahun';
			$data['error_string'][] = 'Tahun wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('rata_rata') == '') {
			$data['inputerror'][] = 'rata_rata';
			$data['error_string'][] = 'Nilai Rata-rata wajib dipilih';
			$data['status'] = FALSE;
		}

		if ($this->input->post('atasan') == '') {
			$data['inputerror'][] = 'atasan';
			$data['error_string'][] = 'Atasan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('penilai') == '') {
			$data['inputerror'][] = 'penilai';
			$data['error_string'][] = 'Penilai wajib di isi';
			$data['status'] = FALSE;
		}

		return $data;
	}

	private function _do_upload($id, $id_ref = 0)
	{
		$dir = "SKP_" . $id_ref . '_' . $id;
		$config['upload_path']          = './asset/upload/SKP/' . $dir;
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

		if ($_FILES['arsipSkp_file']['name'] != '') {
			$name = time() . str_replace(' ', '', $_FILES['arsipSkp_file']['name']);
			$_FILES['arsipSkp_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipSkp_file')) ||  $_FILES['arsipSkp_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipSkp_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipSkp_file']['name'];
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
			$data = $this->tbl_data_dp3->get_arsip_by_id($id);
			$file_name_ori = $data->file_name_ori;
			$file_name = $data->file_name;
			$id_dp3 = $data->id_dp3;
			$dir = "SKP_" . $id_dp3 . "_" . $id;
			$path = file_get_contents('asset/upload/SKP/' . $dir . '/' . $file_name); // letak file pada aplikasi kita
			force_download($file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_dp3->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/SKP/SKP_' . $data->id_dp3 . '_' . $data->id_arsip_skp;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			if (!$this->db->delete('tbl_arsip_skp', ['id_arsip_skp' => $id])) {
				$status = false;
			}
		} else {
			$status = false;
		}

		$response = ['status' => $status];
		echo json_encode($response);
	}

	// public function skp_list($id) {
	// 	$this->db->select('
	// 		tbl_data_dp3.id_dp3, tbl_data_dp3.uraian, tbl_data_dp3.tahun, tbl_data_dp3.rata_rata, 
	// 		tbl_data_dp3.atasan, tbl_data_dp3.penilai, tbl_arsip_skp.file_name_ori, tbl_arsip_skp.id_arsip_skp,
	// 		tbl_arsip_skp.file_name
	// 	');
	// 	$this->db->from('tbl_data_dp3');
	// 	$this->db->join('tbl_arsip_skp', 'tbl_arsip_skp.id_dp3 = tbl_data_dp3.id_dp3', 'left');
	// 	$this->db->where('tbl_data_dp3.id_pegawai', $id);

	// 	if(isset($_POST['length']))
	// 		$this->db->limit($_POST['length'], $_POST['start']);

	// 	$query = $this->db->get();
	// 	$list = $query->result(); 

	// 	echo json_encode($list);
	// }
	public function skp_list($id)
	{
		$this->db->select('
			tr_skp.Skp_id, YEAR(tr_skp.Periode_awal) as Periode_awal, tr_skp.Periode_akhir, tr_skp.Pyd, tr_skp.Pp, tr_skp.Appn, tr_skp.Nama_pejabat_penilai,tr_skp.Nama_atasan_pejabat_penilai,
			tr_skp.Orientasi_pelayanan, tr_skp.Integritas, tr_skp.Komitmen, tr_skp.Disiplin, tr_skp.Kerjasama, 
			tr_skp.Kepemimpinan, tr_skp.Nilai_prestasi_kerja,tr_skp.Created_at, tr_skp.Updated_at, 
			tbl_arsip_skp.file_name_ori, tbl_arsip_skp.id_arsip_skp, tbl_arsip_skp.file_name
		');
		$this->db->from('tr_skp');
		$this->db->join('tbl_arsip_skp', 'tbl_arsip_skp.id_dp3 = tr_skp.Skp_id', 'left');
		$this->db->where('tr_skp.Pyd', $id);

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function skp_delete_arsip($id_dp3, $id_arsip_skp)
	{
		$status = true;

		//delete data skp
		$this->tbl_data_dp3->delete_by_id($id_dp3);

		$data = $this->arsip_skp_model->get_by_id($id_arsip_skp);
		if ($data != null) {
			$dir = "asset/upload/SKP/SKP" . '_' . $data->id_dp3 . '_' . $data->id_arsip_skp;
			$path = $dir . '/' . $data->file_name;

			if (is_dir($dir)) {
				unlink($path);
				$count_file = count(glob("$dir/*"));
				if ($count_file == 0) {
					rmdir($dir);
				}
			}

			$this->arsip_skp_model->delete_by_id($id_arsip_skp);
		}

		echo json_encode(array("status" => $status));
	}

	public function arsip_skp_list($id)
	{
		$this->db->select("*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_skp');
		$this->db->where('created_id', $id);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function skp_detail($id)
	{
		$this->db->select('
		tbl_data_dp3.*, tbl_arsip_skp.id_dp3,
			tbl_arsip_skp.id_arsip_skp, tbl_arsip_skp.file_name_ori, tbl_arsip_skp.file_name,
			tbl_arsip_skp.title
		');
		$this->db->from('tbl_data_dp3');
		$this->db->join('tbl_arsip_skp', 'tbl_arsip_skp.id_dp3 = tbl_data_dp3.id_dp3', 'left');
		$this->db->where('tbl_data_dp3.id_dp3', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}
}
