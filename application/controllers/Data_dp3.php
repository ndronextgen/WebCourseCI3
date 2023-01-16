<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_dp3 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->helper(array('url', 'download'));
		$this->load->library('func_table');
		$this->load->library('upload');
		$this->load->model('m_data_dp3', 'dp3');
		$this->load->model('skp_model', 'tbl_data_dp3');
		$this->load->model('arsip_skp_model');
	}

	function table_data_dp3()
	{
		// $user_type = $this->session->userdata('stts');
		// $id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');

		$listing 		= $this->dp3->listing($id_pegawai);
		$jumlah_filter 	= $this->dp3->jumlah_filter($id_pegawai);
		$jumlah_semua 	= $this->dp3->jumlah_semua($id_pegawai);

		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			$no++;
			$row = array();

			//$jml_c = '1';
			$jml_c = $this->func_table->get_jml_tanggapan($key->Id);

			$file = '-';

			// $button = '	<a class="btn btn-sm btn-success" href="javascript:void(0);" title="lihat detail" onclick="view_data_dp3(' . "'" . $key->Id . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
			// 			<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_data_dp3(' . "'" . $key->Id . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
			// 			<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_dp3(' . "'" . $key->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> </a>';
			// if ($key->file_name != '') {
			// 	$dir = "SKP_" . $key->Dp3_id . '_' . $key->id_arsip_skp;
			// 	$path_folder = "asset/upload/SKP/" . $dir;
			// 	if (file_exists($path_folder)) {
			// 		$button_download = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-download-arsip" data-key="data_dp3" data-id="' . utf8_encode($key->Id) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';
			// 	} else {
			// 		$button_download = '';
			// 	}
			// } else {
			// 	$button_download = '';
			// }

			//add html for action
			$button = '	<a class="btn btn-sm btn-success" href="javascript:void(0);" title="Lihat Detail" onclick="view_data_dp3(' . "'" . $key->Id . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						&nbsp;<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_data_dp3(' . "'" . $key->Id . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
						&nbsp;<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_dp3(' . "'" . $key->Id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

			// === begin: untuk tombol download ===
			$data_file = $this->db->get_where('tbl_arsip_skp', array('id_arsip_skp' => $key->id_arsip_skp));
			if ($data_file->num_rows() > 0) {
				$data_file = $data_file->row();
				$path_file = 'asset/upload/SKP/SKP_' . $key->Dp3_id . '_' . $key->id_arsip_skp . '/' . $data_file->file_name;
				if (file_exists($path_file)) {
					$button .= '&nbsp;<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-download-arsip" data-key="data_dp3" data-id="' . utf8_encode($key->Id) . '" data-title="Download" title="Download Data"><i class="fa fa-download"></i></button>';

					// === file ===
					$file = $this->func_table->get_file($path_file, $data_file->file_name_ori);
				}
			}
			// === end: untuk tombol download ===

			$row[] = $no;
			$row[] = date_format(date_create($key->Periode_awal), 'j M Y') . ' s/d ' . date_format(date_create($key->Periode_akhir), 'j M Y');
			$row[] = $key->Nama_pejabat_penilai;
			$row[] = $key->Nama_atasan_pejabat_penilai;
			$row[] = $key->Nilai_rata_rata;
			$row[] = date_format(date_create($key->Created_at), 'j M Y');
			$row[] = $file;
			$row[] = $button;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $jumlah_semua->jml,
			"recordsFiltered" => $jumlah_filter->jml,
			"data" => $data,
		);
		echo json_encode($output);
	}

	function form_dp3_add()
	{
		$id_pegawai = $this->session->userdata('id_pegawai');
		$Data = $this->db->query("SELECT a.nama_pegawai, a.id_pegawai, a.nrk,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									WHERE id_pegawai = '$id_pegawai'")->row();
		$Data_list_pegawai = $this->db->query("SELECT * FROM tbl_data_pegawai ORDER BY id_pegawai ASC")->result();
		$a['Data'] 				= $Data;
		$a['Data_list_pegawai'] = $Data_list_pegawai;
		$this->load->view('dashboard_publik/homes/group_skpdp3/data_dp3/form_dp3_add', $a);
	}

	function simpan_add()
	{
		$Id 				= $this->session->userdata('id_pegawai');
		$Periode_awal 		= $this->input->post('Periode_awal');
		$Periode_akhir 		= $this->input->post('Periode_akhir');
		$Pp 				= $this->input->post('Pp');
		$Appn 				= $this->input->post('Appn');
		$Npl 				= $this->input->post('Npl');
		$Anpl 				= $this->input->post('Anpl');
		$Kesetiaan 			= $this->input->post('Kesetiaan');
		$Prestasi_kerja 	= $this->input->post('Prestasi_kerja');
		$Tanggung_jawab 	= $this->input->post('Tanggung_jawab');
		$Ketaatan 			= $this->input->post('Ketaatan');
		$Kejujuran 			= $this->input->post('Kejujuran');
		$Kerja_sama 		= $this->input->post('Kerja_sama');
		$Prakarsa 			= $this->input->post('Prakarsa');
		$Kepemimpinan 		= $this->input->post('Kepemimpinan');
		$Jumlah 			= $this->input->post('Jumlah');
		$Nilai_rata_rata 	= $this->input->post('Nilai_rata_rata');
		$Date_now 			= date('Y-m-d h:i:s');

		$last_id = 0;
		$Query_Getid = $this->db->query("SELECT MAX(id_dp3) as Mid FROM tbl_arsip_skp")->row();
		$R_id = isset($Query_Getid->Mid) ? ($Query_Getid->Mid + 1) : '1';
		$cek_id = $this->db->query("SELECT count(Id) as jml FROM tr_dp3 WHERE Dp3_id = '$R_id'")->row();

		if ($cek_id->jml <= 0) {
			$last_id = $R_id;
		} else {
			$last_id = $R_id + 800;
		}
		if ($Pp == 'X') { //jia dipilih lainnya
			$Nama_pejabat_penilai = $Npl;
		} else {
			$Q_penilai = $this->db->query("SELECT nama_pegawai
											FROM tbl_data_pegawai
											WHERE id_pegawai = '$Pp'")->row();
			$Nama_pejabat_penilai = isset($Q_penilai->nama_pegawai) ? $Q_penilai->nama_pegawai : '';
		}

		if ($Appn == 'X') { //jia dipilih lainnya
			$Nama_atasan_pejabat_penilai = $Anpl;
		} else {
			$Q_atasan_penilai = $this->db->query("SELECT nama_pegawai
											FROM tbl_data_pegawai
											WHERE id_pegawai = '$Appn'")->row();
			$Nama_atasan_pejabat_penilai = isset($Q_atasan_penilai->nama_pegawai) ? $Q_atasan_penilai->nama_pegawai : '';
		}

		$data['Dp3_id'] 				= $last_id;
		$data['Pyd'] 					= $Id;
		$data['Periode_awal'] 			= $Periode_awal;
		$data['Periode_akhir'] 			= $Periode_akhir;
		$data['Pp'] 					= $Pp;
		$data['Appn'] 					= $Appn;
		$data['Nama_pejabat_penilai'] 			= $Nama_pejabat_penilai;
		$data['Nama_atasan_pejabat_penilai'] 	= $Nama_atasan_pejabat_penilai;
		$data['Kesetiaan']				= $Kesetiaan;
		$data['Prestasi_kerja']			= $Prestasi_kerja;
		$data['Tanggung_jawab']			= $Tanggung_jawab;
		$data['Ketaatan']				= $Ketaatan;
		$data['Kejujuran']				= $Kejujuran;
		$data['Kerja_sama']				= $Kerja_sama;
		$data['Prakarsa']				= $Prakarsa;
		$data['Kepemimpinan']			= $Kepemimpinan;
		$data['Jumlah']					= $Jumlah;
		$data['Nilai_rata_rata']		= $Nilai_rata_rata;
		//$data['File_upload'] 			= $new_name_file;
		$data['Created_at'] 			= $Date_now;
		$data['Updated_at'] 			= $Date_now;

		$Insert_dp3 = $this->db->insert('tr_dp3', $data);

		if ($Insert_dp3) {

			// 
			if ($_FILES['File_upload']['name'] != '') {
				$ins = [
					'id_dp3' => $last_id,
					'title' => 'DP3' . $Periode_awal,
					'file_name' => '',
					'file_name_ori' => '',
					'created_id' => $this->session->userdata('id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_skp', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip, $last_id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_dp3->update_arsip(
						['id_arsip_skp' => $id_arsip],
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);
					$result = [
						'status' => 'Berhasil tambah data DP3.',
						'tipe' => 1
					];
					echo json_encode($result);	
				} else {
					//delete tabel arsip
					$this->tbl_data_dp3->delete_arsip($id_arsip);
					//delete tabel
					$this->tbl_data_dp3->delete_by_id($last_id);
					//delete arsip file
					$path = 'asset/upload/SKP/SKP_' . $last_id . '_' . $id_arsip;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}
				}
			} else {
				$result = [
					'status' => 'Berhasil tambah data DP3.',
					'tipe' => 1
				];
				echo json_encode($result);
			}
			// 
		}
	}


	// update data skp
	function form_dp3_update()
	{
		$Id = $this->input->post('Id');
		$Data_dp3 = $this->db->query("SELECT
										*
									FROM
										tr_dp3 AS a
										LEFT JOIN
										tbl_arsip_skp AS b
										ON 
											a.Dp3_id = b.id_dp3 WHERE a.Id='$Id'")->row();

		//$Data_dp3 = $this->db->query("SELECT * FROM tr_dp3 WHERE Id = '$Id'")->row();
		$Data = $this->db->query("SELECT a.nama_pegawai, a.id_pegawai, a.nrk,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									WHERE id_pegawai = '$Data_dp3->Pyd'")->row();
		$Data_list_pegawai = $this->db->query("SELECT * FROM tbl_data_pegawai ORDER BY id_pegawai ASC")->result();
		$a['Data_dp3'] 			= $Data_dp3;
		$a['Data'] 				= $Data;
		$a['Data_list_pegawai']	= $Data_list_pegawai;
		$a['Id'] 				= $Id;
		$this->load->view('dashboard_publik/homes/group_skpdp3/data_dp3/form_dp3_update', $a);
	}

	function simpan_update()
	{
		$Id 				= $this->input->post('Id');
		$Periode_awal 		= $this->input->post('Periode_awal');
		$Periode_akhir 		= $this->input->post('Periode_akhir');
		$Pp 				= $this->input->post('Pp');
		$Appn 				= $this->input->post('Appn');
		$Npl 				= $this->input->post('Npl');
		$Anpl 				= $this->input->post('Anpl');
		$Kesetiaan 			= $this->input->post('Kesetiaan');
		$Prestasi_kerja 	= $this->input->post('Prestasi_kerja');
		$Tanggung_jawab 	= $this->input->post('Tanggung_jawab');
		$Ketaatan 			= $this->input->post('Ketaatan');
		$Kejujuran 			= $this->input->post('Kejujuran');
		$Kerja_sama 		= $this->input->post('Kerja_sama');
		$Prakarsa 			= $this->input->post('Prakarsa');
		$Kepemimpinan 		= $this->input->post('Kepemimpinan');
		$Jumlah 			= $this->input->post('Jumlah');
		$Nilai_rata_rata 	= $this->input->post('Nilai_rata_rata');
		$Date_now 			= date('Y-m-d h:i:s');

		if ($Pp == 'X') { //jia dipilih lainnya
			$Nama_pejabat_penilai = $Npl;
		} else {
			// $Q_penilai = $this->db->query("SELECT nama_pegawai
			// 								FROM tbl_data_pegawai
			// 								WHERE id_pegawai = '$Pp'")->row();
			$this->db->select('nama_pegawai');
			$Q_penilai = $this->db->get_where('tbl_data_pegawai', array('id_pegawai' => $Pp))->row();
			$Nama_pejabat_penilai = isset($Q_penilai->nama_pegawai) ? $Q_penilai->nama_pegawai : '';
		}

		if ($Appn == 'X') { //jia dipilih lainnya
			$Nama_atasan_pejabat_penilai = $Anpl;
		} else {
			// $Q_atasan_penilai = $this->db->query("SELECT nama_pegawai
			// 								FROM tbl_data_pegawai
			// 								WHERE id_pegawai = '$Appn'")->row();
			$this->db->select('nama_pegawai');
			$Q_atasan_penilai = $this->db->get_where('tbl_data_pegawai', array('id_pegawai' => $Appn))->row();
			$Nama_atasan_pejabat_penilai = isset($Q_atasan_penilai->nama_pegawai) ? $Q_atasan_penilai->nama_pegawai : '';
		}

		$data['Periode_awal'] 					= $Periode_awal;
		$data['Periode_akhir'] 					= $Periode_akhir;
		$data['Pp'] 							= $Pp;
		$data['Appn'] 							= $Appn;
		$data['Nama_pejabat_penilai'] 			= $Nama_pejabat_penilai;
		$data['Nama_atasan_pejabat_penilai'] 	= $Nama_atasan_pejabat_penilai;
		$data['Kesetiaan']						= $Kesetiaan;
		$data['Prestasi_kerja']					= $Prestasi_kerja;
		$data['Tanggung_jawab']					= $Tanggung_jawab;
		$data['Ketaatan']						= $Ketaatan;
		$data['Kejujuran']						= $Kejujuran;
		$data['Kerja_sama']						= $Kerja_sama;
		$data['Prakarsa']						= $Prakarsa;
		$data['Kepemimpinan']					= $Kepemimpinan;
		$data['Jumlah']							= $Jumlah;
		$data['Nilai_rata_rata']				= $Nilai_rata_rata;
		//$data['File_upload'] 					= $new_name_file;
		$data['Updated_at'] 					= $Date_now;

		$this->db->where('Id', $Id);
		$QUpdate =  $this->db->update('tr_dp3', $data);

		if ($QUpdate) {
			// file upload
			$File_upload 		= $this->input->post('File_upload');
			$File_upload_lama 	= $this->input->post('File_upload_lama');
			// $QData = $this->db->query(
			// 	"SELECT
			// 		a.Id, 
			// 		a.Dp3_id, 
			// 		b.id_arsip_skp
			// 	FROM
			// 		tr_dp3 AS a
			// 	LEFT JOIN tbl_arsip_skp AS b ON a.Dp3_id = b.id_dp3 
			// 	WHERE a.Id='$Id'"
			// )->row();
			$this->db->select('a.Id, a.Dp3_id, b.id_arsip_skp');
			$this->db->from('tr_dp3 as a');
			$this->db->join('tbl_arsip_skp as b', 'a.dp3_id = b.id_dp3', 'left');
			$this->db->where(array('a.id' => $Id));
			$QData = $this->db->get()->row();

			$ucode_gen = $this->func_table->generateRandomString2();
			$new_name = 'SKP_' . $ucode_gen;
			$path_folder = "asset/upload/SKP/SKP_" . $QData->Dp3_id . '_' . $QData->id_arsip_skp;

			if ($_FILES["File_upload"]['name'] != '' and $File_upload_lama == '') {
				// --
				$ins = [
					'id_dp3' => $QData->Dp3_id,
					'title' => 'SKP' . $Periode_awal,
					'file_name' => '',
					'file_name_ori' => '',
					'created_id' => $this->session->userdata('id_pegawai'),
					'created_at' => date('Y-m-d H:i:s')
				];

				//insert into arsip
				$this->db->insert('tbl_arsip_skp', $ins);
				$id_arsip = $this->db->insert_id();

				$validate_arsip = $this->_do_upload($id_arsip, $QData->Dp3_id);
				if ($validate_arsip['status'] == true) {
					//update filename
					$this->tbl_data_dp3->update_arsip(
						['id_arsip_skp' => $id_arsip],
						[
							'file_name' => $validate_arsip['file_name'],
							'file_name_ori' => $validate_arsip['file_name_ori']
						]
					);
					$result = [
						'status' => 'Berhasil edit data DP3.',
						'tipe' => 1
					];
					echo json_encode($result);
				} else {
					//delete tabel arsip
					$this->tbl_data_dp3->delete_arsip($id_arsip);

					//delete tabel
					$this->tbl_data_dp3->delete_by_id($QData->Dp3_id);

					//delete arsip file
					$path = 'asset/upload/SKP/SKP_' . $QData->Dp3_id . '_' . $id_arsip;
					if (is_dir($path)) {
						delete_files($path, true);
						rmdir($path);
					}
				}
			} else if ($_FILES["File_upload"]['name'] != '' and $File_upload_lama != '') {
				if (file_exists($path_folder . '/' . $File_upload_lama)) {
					unlink($path_folder . '/' . $File_upload_lama);
				}
				// --
				$string = $_FILES["File_upload"]['name'];
				$temp = explode(".", $string);
				$new_name_file = $new_name . '.' . end($temp);
				$new_name_file = str_replace(' ', '', $new_name_file);
				// --
				$config['file_name'] = $new_name_file;
				$config['upload_path'] = $path_folder;
				$config['allowed_types'] = '*';

				$this->upload->initialize($config);

				$validate_arsip = $this->_do_upload($QData->id_arsip_skp, $QData->Dp3_id);
				if (!$validate_arsip) {
					// if (!$this->upload->do_upload('File_upload')) {
					// echo '<script>alert(gagal....!);</script>';
					echo 'Gagal upload file.';
					exit;
				} else {
					$new_name_file = $this->upload->file_name;
					#update
					$data_file['title'] 		= 'DP3' . $Periode_awal;
					$data_file['file_name'] 	= $new_name_file;
					$data_file['file_name_ori'] = $_FILES["File_upload"]['name'];
					$data_file['created_id'] 	= $this->session->userdata('id_pegawai');
					$data_file['created_at'] 	= $Date_now;

					$this->db->where('id_arsip_skp', $QData->id_arsip_skp);
					$QUpdate = $this->db->update('tbl_arsip_skp', $data_file);
				}
				// echo 'berhasil';
				$result = [
					'status' => 'Berhasil edit data DP3.',
					'tipe' => 1
				];
				echo json_encode($result);
			} else {
				// echo 'test';
				$result = [
					'status' => 'Berhasil edit data DP3.',
					'tipe' => 1
				];
				echo json_encode($result);
			}
		}
		// end file upload

	}

	// view data skp
	function view_dp3()
	{
		$Id = $this->input->post('Id');

		$Data_dp3 = $this->dp3->view_dp3($Id);
		$Data = $this->db->query("SELECT a.nama_pegawai, a.id_pegawai, a.nrk,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									WHERE id_pegawai = '$Data_dp3->Pyd'")->row();
		$a['Data_dp3'] 			= $Data_dp3;
		$a['Data'] 				= $Data;
		$a['Id'] 				= $Id;
		$this->load->view('dashboard_publik/homes/group_skpdp3/data_dp3/view_dp3', $a);
	}


	// hapus
	function delete_data_dp3()
	{
		$Id = $this->input->post('Id');
		$QData = $this->db->query("SELECT
										a.Id, 
										a.Dp3_id, 
										b.id_arsip_skp
									FROM
										tr_dp3 AS a
									LEFT JOIN
										tbl_arsip_skp AS b
										ON 
											a.Dp3_id = b.id_dp3 WHERE a.Id='$Id'")->row();
		$path_folder = "asset/upload/SKP/SKP_" . $QData->Dp3_id . '_' . $QData->id_arsip_skp;
		if (is_dir($path_folder)) {
			delete_files($path_folder, true);
			rmdir($path_folder);
		}
		$del_dp3 		= $this->db->query("DELETE FROM tr_dp3 WHERE Id = '$Id'");
		$del_arsip_sk 	= $this->db->query("DELETE FROM tbl_arsip_skp WHERE id_dp3 = '$QData->Dp3_id'");
		if ($del_dp3) {
			echo 'Data Dihapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	public function download($Id)
	{
		$QData = $this->db->query("SELECT
										a.Id, 
										a.Dp3_id, 
										b.id_arsip_skp, b.id_dp3, b.file_name
									FROM
									tr_dp3 AS a
										LEFT JOIN
										tbl_arsip_skp AS b
										ON 
											a.Dp3_id = b.id_dp3 WHERE a.Id='$Id'")->row();

		if ($QData == null) {
			ob_start();
			echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
			redirect(base_url() . 'dashboard_publik/');
			echo "<script>load_data('group_skpdp3');</script>";
		} else {
			$path_file = 'asset/upload/SKP';
			$path_folder    = file_get_contents($path_file . '/SKP_' . $QData->id_dp3 . '_' . $QData->id_arsip_skp . '/' . $QData->file_name);
			force_download($QData->file_name, $path_folder);
		}
	}

	private function _do_upload($id, $id_ref = 0)
	{
		$dir = "SKP_" . $id_ref . '_' . $id;
		$path_folder = "asset/upload/SKP/" . $dir;

		$ucode_gen = $this->func_table->generateRandomString2();
		$new_name = 'DP3_' . $ucode_gen;

		$data = array();
		$data['status'] = true;
		$data['data'] = null;

		if ($_FILES["File_upload"]['name'] == '') {
			$data['status'] = false;
		} else if ($_FILES["File_upload"]['name'] != '') {
			// --
			$string = $_FILES["File_upload"]['name'];
			$temp = explode(".", $string);
			$new_name_file = $new_name . '.' . end($temp);
			$new_name_file = str_replace(' ', '', $new_name_file);
			// --
			$config['file_name'] = $new_name_file;
			$config['upload_path'] = $path_folder;
			$config['allowed_types'] = '*';

			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0775, TRUE);
			}

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('File_upload')) {
				$data['inputerror'][] = 'File_upload';
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = false;
			} else {
				$new_name_file = $this->upload->file_name;
				$data['status'] = true;
				$data['file_name'] = $new_name_file;
				$data['file_name_ori'] = $_FILES["File_upload"]['name'];
			}
		} else {
			$data['status'] = false;
		}

		return $data;
	}
}
