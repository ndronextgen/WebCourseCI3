<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pangkat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('pangkat_model', 'tbl_data_riwayat_pangkat');
		$this->load->model('arsip_sk_model');
		$this->load->library('func_table');
		$this->jenis_sk = 2;

		$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
	}

	public function pangkat_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_riwayat_pangkat->get_datatables($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $r->golongan;
			$row[] = $r->lokasi_kerja;
			$row[] = $r->nomor_sk;
			$row[] = date_format(date_create($r->tanggal_sk), 'j M Y');
			$row[] = date_format(date_create($r->tanggal_mulai), 'j M Y');

			$file = '-';

			//add html for action
			$button = '	<a class="btn btn-sm btn-success" href="javascript:void(0);" title="Lihat Detail" onclick="detail_pangkat(' . "'" . $r->id_riwayat_pangkat . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_pangkat(' . "'" . $r->id_riwayat_pangkat . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_pangkat(' . "'" . $r->id_riwayat_pangkat . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			// === begin: untuk tombol download ===
			$arsip = $this->tbl_data_riwayat_pangkat->get_arsip_by_id_ref($r->id_riwayat_pangkat, 2);

			if ($arsip) {
				$path_folder 		= 'asset/upload/SK/SK_' . $arsip->id_jenis_sk . '_' . $arsip->id_ref . '_' . $arsip->id_arsip_sk;
				$path_file	= $path_folder . '/' . $arsip->file_name;
				$is_file_exist = file_exists($path_file);

				if ($is_file_exist) {
					$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="pangkat" data-id="' . utf8_encode($arsip->id_arsip_sk) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';

					// === file ===
					$file = $this->func_table->get_file($path_file, $arsip->file_name_ori);
				}
			}
			// === end: untuk tombol download ===

			$row[] = $file;
			$row[] = $button;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_riwayat_pangkat->count_all($id),
			"recordsFiltered" => $this->tbl_data_riwayat_pangkat->count_filtered($id),
			"data" => $data,
		);

		//output to json format
		echo json_encode($output);
	}

	public function pangkat_edit($id_riwayat_pangkat)
	{
		$data = $this->tbl_data_riwayat_pangkat->get_by_id($id_riwayat_pangkat);
		$data->arsip = $this->tbl_data_riwayat_pangkat->get_arsip_by_id_ref($id_riwayat_pangkat, $this->jenis_sk);
		echo json_encode($data);
	}

	public function pangkat_add()
	{
		$response = array('status' => true);
		$validate_pangkat = $this->_validate_pangkat();
		$id = $this->session->userdata('id_pegawai');

		$data = array(
			'id_golongan' => $this->input->post('id_golongan'),
			'lokasi_kerja' => $this->input->post('lokasi_kerja'),
			'nomor_sk' => $this->input->post('nomor_sk'),
			'tanggal_mulai' => $this->input->post('tanggal_mulai'),
			'tanggal_sk' => $this->input->post('tanggal_sk'),
			'id_pegawai' => $this->session->userdata('id_pegawai')
		);

		if ($validate_pangkat['status'] == true) {
			$insert_id = $this->tbl_data_riwayat_pangkat->save($data);
			$title_file = $this->tbl_data_riwayat_pangkat->getGolonganName($this->input->post('id_golongan'));

			if ($insert_id) {
				if ($_FILES['arsipPangkat_file']['name'] != '') {
					$ins = [
						'id_ref' => $insert_id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $this->jenis_sk, $insert_id);
					if ($validate_arsip['status'] == true) {
						//update filename
						$this->tbl_data_riwayat_pangkat->update_arsip(
							['id_arsip_sk' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);
					} else {
						//delete tabel arsip
						$this->tbl_data_riwayat_pangkat->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_riwayat_pangkat->delete_by_id($insert_id);

						//delete arsip file
						$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_arsip . '_' . $insert_id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				}
			}
		} else {
			$response = $validate_pangkat;
		}

		echo json_encode($response);
	}

	public function pangkat_update()
	{
		$response = array('status' => true);
		$id = $this->input->post('id_riwayat_pangkat');
		$validate_pangkat = $this->_validate_pangkat();

		if ($validate_pangkat['status'] == true) {
			$data = array(
				'id_golongan' => $this->input->post('id_golongan'),
				'lokasi_kerja' => $this->input->post('lokasi_kerja'),
				'nomor_sk' => $this->input->post('nomor_sk'),
				'tanggal_mulai' => $this->input->post('tanggal_mulai'),
				'tanggal_sk' => $this->input->post('tanggal_sk'),
				'id_pegawai' => $this->session->userdata('id_pegawai'),
			);

			$this->tbl_data_riwayat_pangkat->update(array('id_riwayat_pangkat' => $id), $data);

			//update title arsip table
			$title_file = $this->tbl_data_riwayat_pangkat->getGolonganName($this->input->post('id_golongan'));

			if ($_FILES['arsipPangkat_file']['name'] != '') {
				log_message('debug', 'arsip tidak kosong : ' . $id);
				$fileOld = $this->tbl_data_riwayat_pangkat->get_arsip_by_id_ref($id, $this->jenis_sk);
				if (!empty($fileOld)) {
					log_message('debug', 'masuk : ' . json_encode($fileOld));
					$ins = [
						'id_ref' => $id,
						'id_jenis_sk' => $this->jenis_sk,
						'title' => $title_file,
						'file_name' => '',
						'file_name_ori' => '',
						'created_id' => $this->session->userdata('id_pegawai'),
						'created_at' => date('Y-m-d H:i:s')
					];

					//insert into arsip
					$this->db->insert('tbl_arsip_sk', $ins);
					$id_arsip = $this->db->insert_id();

					$validate_arsip = $this->_do_upload($id_arsip, $this->jenis_sk, $id);
					if ($validate_arsip['status'] == true) {
						log_message('debug', 'valid arsip');
						log_message('debug', 'data arsip : ' . json_encode($validate_arsip));
						//update filename
						$this->tbl_data_riwayat_pangkat->update_arsip(
							['id_arsip_sk' => $id_arsip],
							[
								'file_name' => $validate_arsip['file_name'],
								'file_name_ori' => $validate_arsip['file_name_ori']
							]
						);

						//delete arsip old file
						$path = './asset/upload/SK/SK_' . $fileOld->id_jenis_sk . '_' . $fileOld->id_ref . '_' . $fileOld->id_arsip_sk;

						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}

						//delete arsip table
						$this->tbl_data_riwayat_pangkat->delete_arsip($fileOld->id_arsip_sk);
					} else {
						//delete tabel arsip
						$this->tbl_data_riwayat_pangkat->delete_arsip($id_arsip);

						//delete tabel riwayat jabatan
						$this->tbl_data_riwayat_pangkat->delete_by_id($id);

						//delete arsip file
						$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_arsip . '_' . $id;
						if (is_dir($path)) {
							delete_files($path, true);
							rmdir($path);
						}
					}
				} else {
					if ($_FILES['arsipPangkat_file']['name'] != '') {
						$ins = [
							'id_ref' => $id,
							'id_jenis_sk' => $this->jenis_sk,
							'title' => $title_file,
							'file_name' => '',
							'file_name_ori' => '',
							'created_id' => $this->session->userdata('id_pegawai'),
							'created_at' => date('Y-m-d H:i:s')
						];

						//insert into arsip
						$this->db->insert('tbl_arsip_sk', $ins);
						$id_arsip = $this->db->insert_id();

						$validate_arsip = $this->_do_upload($id_arsip, $this->jenis_sk, $id);
						if ($validate_arsip['status'] == true) {
							//update filename
							$this->tbl_data_riwayat_pangkat->update_arsip(
								['id_arsip_sk' => $id_arsip],
								[
									'file_name' => $validate_arsip['file_name'],
									'file_name_ori' => $validate_arsip['file_name_ori']
								]
							);
						} else {
							//delete tabel arsip
							$this->tbl_data_riwayat_pangkat->delete_arsip($id_arsip);

							//delete tabel riwayat jabatan
							$this->tbl_data_riwayat_pangkat->delete_by_id($id);

							//delete arsip file
							$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_arsip . '_' . $id;
							if (is_dir($path)) {
								delete_files($path, true);
								rmdir($path);
							}
						}
					}
				}
			}
		} else {
			$response = $validate_pangkat;
		}

		echo json_encode($response);
	}

	public function pangkat_delete($id_riwayat_pangkat)
	{
		//delete data pangkat
		$this->tbl_data_riwayat_pangkat->delete_by_id($id_riwayat_pangkat, $this->jenis_sk);

		$arsip = $this->tbl_data_riwayat_pangkat->get_arsip_by_id_ref($id_riwayat_pangkat, $this->jenis_sk);
		if ($arsip) {
			//delete arsip file
			$path = './asset/upload/SK/SK_' . $this->jenis_sk . '_' . $id_riwayat_pangkat . '_' . $arsip->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			//delete table arsip
			$this->db->delete('tbl_arsip_sk', ['id_ref' => $id_riwayat_pangkat]);
		}

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_pangkat()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_golongan') == '') {
			$data['inputerror'][] = 'id_golongan';
			$data['error_string'][] = 'Golongan wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('lokasi_kerja') == '') {
			$data['inputerror'][] = 'lokasi_kerja';
			$data['error_string'][] = 'Lokasi Kerja wajib di isi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nomor_sk') == '') {
			$data['inputerror'][] = 'nomor_sk';
			$data['error_string'][] = 'Nomor SK wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_mulai') == '') {
			$data['inputerror'][] = 'tanggal_mulai';
			$data['error_string'][] = 'TMT wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_sk') == '') {
			$data['inputerror'][] = 'tanggal_sk';
			$data['error_string'][] = 'Tanggal SK wajib diisi';
			$data['status'] = FALSE;
		}

		return $data;
	}

	private function _do_upload($id, $jenis_sk = 0, $id_ref = 0)
	{
		$dir = "SK_" . $jenis_sk . '_' . $id_ref . '_' . $id;
		$config['upload_path']          = './asset/upload/SK/' . $dir;
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}
		//log_message('debug', 'do upload : '.$dir);
		$this->load->library('upload', $config);

		$files = $_FILES;
		$data = array();
		$data['status'] = true;
		$data['data'] = null;

		if ($_FILES['arsipPangkat_file']['name'] != '') {
			log_message('debug', 'file tidak kosong');
			$name = time() . str_replace(' ', '', $_FILES['arsipPangkat_file']['name']);
			$_FILES['arsipPangkat_file']['name'] = $name;

			if (!($this->upload->do_upload('arsipPangkat_file')) ||  $_FILES['arsipPangkat_file']['error'] != 0) {
				$data['inputerror'][] = 'arsipPangkat_file';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$data['status'] = true;
				$data['file_name'] = $this->upload->data('file_name');
				$data['file_name_ori'] = $files['arsipPangkat_file']['name'];
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
			$data = $this->tbl_data_riwayat_pangkat->get_arsip_by_id($id);

			$dir = "SK_" . $data->id_jenis_sk . '_' . $data->id_ref . '_' . $data->id_arsip_sk;
			$path = file_get_contents('asset/upload/SK/' . $dir . '/' . $data->file_name); // letak file pada aplikasi kita

			force_download($data->file_name_ori, $path);
		}
	}

	public function delete_arsip($id)
	{
		$status = true;
		$data = $this->tbl_data_riwayat_pangkat->get_arsip_by_id($id);

		if ($data) {
			//delete arsip file
			$path = './asset/upload/SK/SK_' . $data->id_jenis_sk . '_' . $data->id_ref . '_' . $data->id_arsip_sk;

			if (is_dir($path)) {
				delete_files($path, true);
				rmdir($path);
			}

			if (!$this->db->delete('tbl_arsip_sk', ['id_arsip_sk' => $id])) {
				$status = false;
			}
		} else {
			$status = false;
		}

		$response = ['status' => $status];
		echo json_encode($response);
	}

	public function pangkat_list($id)
	{
		// $this->db->select('
		// 	tbl_data_riwayat_pangkat.id_riwayat_pangkat, tbl_master_golongan.golongan, 
		// 	tbl_data_riwayat_pangkat.lokasi_kerja, tbl_data_riwayat_pangkat.nomor_sk, 
		// 	tbl_data_riwayat_pangkat.tanggal_sk, tbl_data_riwayat_pangkat.tanggal_mulai, 
		// 	tbl_arsip_sk.file_name_ori, tbl_arsip_sk.id_arsip_sk, tbl_arsip_sk.file_name
		// ');
		// $this->db->from('tbl_data_riwayat_pangkat');
		// //$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_riwayat_pangkat.id_riwayat_pangkat', 'left');
		// $this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_riwayat_pangkat.id_riwayat_pangkat', 'left');
		// $this->db->join('tbl_master_golongan', 'tbl_master_golongan.id_golongan = tbl_data_riwayat_pangkat.id_golongan');
		// $this->db->where('tbl_data_riwayat_pangkat.id_pegawai', $id);
		// $this->db->where('tbl_arsip_sk.id_jenis_sk', $this->jenis_sk);

		$query_data = $this->db->query(
			"SELECT
				`tbl_data_riwayat_pangkat`.`id_riwayat_pangkat`,
				`tbl_master_golongan`.`golongan`,
				`tbl_data_riwayat_pangkat`.`lokasi_kerja`,
				`tbl_data_riwayat_pangkat`.`nomor_sk`,
				`tbl_data_riwayat_pangkat`.`tanggal_sk`,
				`tbl_data_riwayat_pangkat`.`tanggal_mulai`,
				`file_name_ori`,
				`id_arsip_sk`,
				`file_name` 
			FROM
				`tbl_data_riwayat_pangkat`
			LEFT JOIN (
				SELECT file_name, file_name_ori, id_arsip_sk, id_jenis_sk, id_ref FROM tbl_arsip_sk WHERE id_jenis_sk = '$this->jenis_sk'
			) AS SK ON SK.id_ref = tbl_data_riwayat_pangkat.id_riwayat_pangkat
			LEFT JOIN `tbl_master_golongan` ON `tbl_master_golongan`.`id_golongan` = `tbl_data_riwayat_pangkat`.`id_golongan` 
			WHERE
				`tbl_data_riwayat_pangkat`.`id_pegawai` = '$id'"
		)->result();

		if (isset($_POST['length']))
			$this->db->limit($_POST['length'], $_POST['start']);

		// $query = $this->db->get();
		// $list = $query->result(); 
		echo json_encode($query_data);
	}

	public function pangkat_delete_arsip($id_riwayat_pangkat, $id_arsip_sk)
	{
		$status = true;

		//delete data riwayat pangkat
		$this->tbl_data_riwayat_pangkat->delete_by_id($id_riwayat_pangkat);

		$data = $this->arsip_sk_model->get_by_id($id_arsip_sk);
		if ($data != null) {
			$dir = "asset/upload/SK/SK_" . $data->id_jenis_sk . '_' . $data->id_ref . '_' . $data->id_arsip_sk;
			$path = $dir . '/' . $data->file_name;

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

	public function arsip_pangkat_list($id)
	{
		$this->db->select("*, '' as opsi, '' as aksi");
		$this->db->from('tbl_arsip_sk');
		$this->db->where('created_id', $id);
		$this->db->where('id_jenis_sk', $this->jenis_sk);

		$query = $this->db->get();
		$list = $query->result();

		echo json_encode($list);
	}

	public function pangkat_detail($id)
	{
		$this->db->select('
			tbl_data_riwayat_pangkat.*, tbl_master_golongan.golongan, tbl_arsip_sk.id_ref,
			tbl_arsip_sk.id_jenis_sk,tbl_arsip_sk.id_arsip_sk, tbl_arsip_sk.file_name_ori, tbl_arsip_sk.file_name
		');
		$this->db->from('tbl_data_riwayat_pangkat');
		$this->db->join('tbl_arsip_sk', 'tbl_arsip_sk.id_ref = tbl_data_riwayat_pangkat.id_riwayat_pangkat', 'left');
		$this->db->join('tbl_master_golongan', 'tbl_master_golongan.id_golongan = tbl_data_riwayat_pangkat.id_golongan', 'left');
		$this->db->where('tbl_data_riwayat_pangkat.id_riwayat_pangkat', $id);
		$query = $this->db->get();
		$list = $query->row();
		echo json_encode($list);
	}

	public function form_detail_pangkat()
	{
		$Id = $this->input->post('Id');
		$QData = $this->db->query(
			"SELECT
				a.id_riwayat_pangkat, a.id_pegawai, 
				a.id_golongan, a.lokasi_kerja, 
				a.`status`, a.nomor_sk, 
				a.tanggal_sk, a.tanggal_mulai, 
				a.tanggal_selesai, a.masa_kerja, 
				b.id_arsip_sk, b.id_jenis_sk, b.title, b.id_ref,
				b.file_name_ori, b.file_name, 
				b.created_id, b.created_at, c.golongan
			FROM
				tbl_data_riwayat_pangkat as a
			LEFT JOIN tbl_arsip_sk as b ON  a.id_riwayat_pangkat = b.id_ref
			LEFT JOIN tbl_master_golongan as c ON  a.id_golongan = c.id_golongan
			WHERE a.id_riwayat_pangkat ='$Id'"
		)->row();
		$a['data']	= $QData;
		$a['path_file'] = 'asset/upload/SK/SK_' . $QData->id_jenis_sk . '_' . $QData->id_ref . '_' . $QData->id_arsip_sk;

		$this->load->view('dashboard_publik/homes/group_sk_gubernur/pangkat/form_detail', $a);
	}
}
