<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lapor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_table_lapor');
		$this->load->library('func_wa_lapor');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_lapor', 'lapor');
		$this->load->library('upload');
		// $this->load->model('arsip_hukuman_model');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat_instansi'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$q = $this->db->get_where("tbl_data_pegawai", $id);
			$set_detail = $q->row();
			$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

			// === notif count ===
			$count_see = $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj = $this->func_table->count_see_tj($this->session->userdata('username'));
			$count_see_kaku	= $this->func_table->count_see_kaku($this->session->userdata('username'));
			$count_see_verifikasi = $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
			$count_see_verifikasi_tj = $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
			$count_see_verifikasi_kaku = $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));
			$count_see_verifikasi_hukdis = $this->func_table->count_see_verifikasi_hukdis($this->session->userdata('username'));
			$count_see_verifikasi_tp = $this->func_table->count_see_verifikasi_tp($this->session->userdata('username'));
			$count_see_verifikasi_karir = $this->func_table->count_see_verifikasi_karir($this->session->userdata('username'));
			$count_see_lapor = $this->func_table_lapor->count_see_lapor_public($this->session->userdata('username'));
			$count_see_verifikasi_pindah_tugas = $this->func_table->count_see_verifikasi_pindah_tugas($this->session->userdata('username'));

			$status_verifikasi = $this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));
			if ($status_verifikasi == 'kepegawaian' || $status_verifikasi == 'sekdis' || $status_verifikasi == 'sudinupt') {
				$d['status_user'] = 'true';
			} else {
				$d['status_user'] = 'false';
			}

			foreach ($q->result() as $data) {
				$d['id_param'] = $data->id_pegawai;
				$d['nip'] = $data->nip;
				$d['nrk'] = $data->nrk;
				$d['email'] = $data->email;
				$d['telepon'] = $data->telepon;
				$d['nama_pegawai'] = $data->nama_pegawai;
				$d['status_pegawai'] = $data->status_pegawai;
				$d['id_jabatan'] = $data->id_jabatan;
				$d['id_bidang'] = $data->id_bidang;
				$d['lokasi_kerja'] = $data->lokasi_kerja;
				$d['seksi'] = $data->seksi;
				$d['masa_kerja'] = $data->masa_kerja;
				$d['usia'] =  $data->usia;
				$d['jenis_kelamin'] = $data->jenis_kelamin;
				$d['tempat_lahir'] =  $data->tempat_lahir;
				$d['tanggal_lahir'] = $data->tanggal_lahir;
				$d['agama'] = $data->agama;
				$d['status_nikah'] = $data->status_nikah;
				$d['alamat'] =  $data->alamat;
				$d['kode_kelurahan'] =  $data->kode_kelurahan;
				$d['nama_kelurahan'] =  $data->nama_kelurahan;
				$d['kode_kecamatan'] =  $data->kode_kecamatan;
				$d['nama_kecamatan'] =  $data->nama_kecamatan;
				$d['kode_kabupaten'] =  $data->kode_kabupaten;
				$d['nama_kabupaten'] =  $data->nama_kabupaten;
				$d['kode_provinsi'] =  $data->kode_provinsi;
				$d['nama_provinsi'] =  $data->nama_provinsi;
				$d['alamat_ktp'] =  $data->alamat_ktp;
				$d['kode_kelurahan_ktp'] =  $data->kode_kelurahan_ktp;
				$d['nama_kelurahan_ktp'] =  $data->nama_kelurahan_ktp;
				$d['kode_kecamatan_ktp'] =  $data->kode_kecamatan_ktp;
				$d['nama_kecamatan_ktp'] =  $data->nama_kecamatan_ktp;
				$d['kode_kabupaten_ktp'] =  $data->kode_kabupaten_ktp;
				$d['nama_kabupaten_ktp'] =  $data->nama_kabupaten_ktp;
				$d['kode_provinsi_ktp'] =  $data->kode_provinsi_ktp;
				$d['nama_provinsi_ktp'] =  $data->nama_provinsi_ktp;
				$d['longitude'] = $data->longitude;
				$d['latitude'] = $data->latitude;
				$d['pendidikan'] = $data->pendidikan;
				$d['pendidikan_bkd'] = $data->pendidikan_bkd;
				$d['asal_sekolah'] = $data->asal_sekolah;
				$d['tgl_lulus'] = $data->tgl_lulus;
				$d['id_golongan'] = $data->id_golongan;
				$d['id_eselon'] = $data->id_eselon;
				$d['nomor_sk_pangkat'] = $data->nomor_sk_pangkat;
				$d['tanggal_sk_pangkat'] = $data->tanggal_sk_pangkat;
				$d['tanggal_mulai_pangkat'] = $data->tanggal_mulai_pangkat;
				$d['tanggal_pengangkatan_cpns'] = $data->tanggal_pengangkatan_cpns;
				$d['id_status_jabatan'] = $data->id_status_jabatan;
				$d['status_pegawai_pangkat'] = $data->status_pegawai_pangkat;
				$d['nomor_sk_jabatan'] = $data->nomor_sk_jabatan;
				$d['tanggal_sk_jabatan'] = $data->tanggal_sk_jabatan;
				$d['tanggal_mulai_jabatan'] = $data->tanggal_mulai_jabatan;
				$d['foto'] = $data->foto;
				$signature = base_url() . 'asset/foto_pegawai/no-image/nosignature.png';
				if ($data->signature) {
					$signature = base_url() . 'asset/foto_pegawai/signature/thumb/' . $data->signature;
				}
				$d['signature'] = $signature;
				$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
				$d['id_satuan_kerja'] = $data->id_satuan_kerja;
				$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
				$d['tmt_eselon'] = $data->tmt_eselon;
			}
			$this->load->helper('url');

			// === notif count ===
			$d['count_see'] = $count_see;
			$d['count_see_tj'] = $count_see_tj;
			$d['count_see_kaku'] = $count_see_kaku;
			$d['count_see_verifikasi'] = $count_see_verifikasi;
			$d['count_see_verifikasi_tj'] = $count_see_verifikasi_tj;
			$d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;
			$d['count_see_verifikasi_hukdis'] = $count_see_verifikasi_hukdis;
			$d['count_see_verifikasi_tp'] = $count_see_verifikasi_tp;
			$d['count_see_verifikasi_karir'] = $count_see_verifikasi_karir;
			$d['count_see_lapor'] = $count_see_lapor;
			$d['count_see_verifikasi_pindah_tugas'] = $count_see_verifikasi_pindah_tugas;

			// $this->load->view('dashboard_publik/lapor/index_lapor', $d);

			$d['page'] = 'dashboard_publik/template/lapor/index';
			$d['menu'] = 'lapor';
			$this->load->view('dashboard_publik/template/main', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function data_lapor()
	{
		// $this->load->view('dashboard_publik/lapor/ajax_table');
		$this->load->view('dashboard_publik/template/lapor/ajax_table');
	}

	function table_data_lapor()
	{
		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');
		$username = $this->session->userdata('username');

		$listing 		= $this->lapor->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->lapor->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->lapor->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			$see = $this->func_table_lapor->see_table_public_lapor($username, $key->Id);
			$jml_c = $this->func_table->get_jml_tanggapan($key->Id);

			// === begin: buttons (aksi) ===
			$button = '
				<a type="button" class="btn btn-success btn-sm" onclick="view_lapor(' . "'" . $key->Id . "'" . ')"><i class="fa fa-eye"></i></a>
				<a type="button" class="btn btn-warning btn-sm" onclick="edit_lapor(' . "'" . $key->Id . "'" . ')"><i class="fa fa-edit"></i></a>
				<a type="button" class="btn btn-danger btn-sm" onclick="delete_lapor(' . "'" . $key->Id . "'" . ')"><i class="fa fa-trash"></i></a>
				';
			$tanggapan = '<button type="button" class="btn btn-info btn-sm" onclick="gettanggapan(' . "'" . $key->Id . "'" . ')"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<b>' . $jml_c . '</b></button';
			// === end: buttons (aksi) ===

			// === begin: file ===
			$path_file = './asset/upload/Lapor/' . $key->File_upload;
			$file = $this->func_table->get_file($path_file, "View File");
			// === end: file ===

			// === begin: create row ===
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $button;
			$row[] = $file;
			$row[] = $key->Kategori;
			$row[] = $key->Isi_laporan;
			$row[] = ucwords(strtolower($key->nama_pegawai));
			$row[] = $tanggapan;
			$row[] = date_format(date_create($key->Created_at), 'j M Y');
			$row[] = $see;

			$data[] = $row; // rowset
			// === begin: create row ===
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $jumlah_semua->jml,
			"recordsFiltered" => $jumlah_filter->jml,
			"data" => $data,
		);
		echo json_encode($output);
	}

	function form_lapor_add()
	{
		$id_pegawai = $this->session->userdata('id_pegawai');
		$Data = $this->db->query("SELECT a.nama_pegawai, a.id_pegawai, a.nrk,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									WHERE id_pegawai = '$id_pegawai'")->row();
		$a['Data'] = $Data;
		$a['master_lapor'] = $this->db->query("SELECT * FROM tr_master_lapor ORDER BY Id ASC")->result();

		// $this->load->view('dashboard_publik/lapor/form_lapor_add', $a);
		$this->load->view('dashboard_publik/template/lapor/form_lapor_add', $a);
	}

	function simpan_add()
	{
		$Id 			= $this->session->userdata('id_pegawai');
		$Created_by 	= $this->session->userdata('username');
		//$Judul_laporan 	= $this->input->post('Judul_laporan');
		$Isi_laporan 	= $this->input->post('Isi_laporan');
		$Kategori 		= $this->input->post('Kategori');
		$Date_now 		= date('Y-m-d H:i:s');

		$Data = $this->db->query("SELECT lokasi_kerja FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$lokasi_kerja = isset($Data->lokasi_kerja) ? $Data->lokasi_kerja : '';

		$File_upload = $this->input->post('File_upload');
		$ucode_gen = $this->func_table->generateRandomString2();
		$new_name = 'I_' . $ucode_gen;

		$path_folder = "./asset/upload/Lapor/";

		if ($_FILES["File_upload"]['name'] == '') {
			$new_name_file = '';
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

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('File_upload')) {
				// echo '<script>alert(Kosong....!);</script>';
				$result = [
					'status' => 'Gagal upload file.',
					'tipe' => 0,
				];
				echo json_encode($result);
				exit;
			} else {
				$new_name_file = $this->upload->file_name;
			}
		} else {
			$new_name_file = '';
		}


		$data['id_pegawai'] = $Id;
		$data['Tanggapan_id'] = '0';
		$data['id_lokasi_kerja'] = $lokasi_kerja;
		$data['Kategori'] = $Kategori;
		//$data['Judul_laporan'] = $Judul_laporan;
		$data['Isi_laporan'] = $Isi_laporan;
		$data['File_upload'] = $new_name_file;
		$data['Created_by'] = $Created_by;
		$data['Created_at'] = $Date_now;
		$data['Updated_at'] = $Date_now;

		$result_in = $this->db->insert('tr_lapor', $data);
		if ($result_in) {
			$Query_Getid = $this->db->query("SELECT MAX(Id) as Id FROM tr_lapor")->row();
			$last_id = $Query_Getid->Id;
			$see = $this->func_table_lapor->in_tosee_lapor($Created_by, $last_id, '0', $Created_by);
			$send_notif_lapor 	= $this->func_wa_lapor->notif_lapor_tambah($last_id);
			$result = [
				'status' => 'Berhasil simpan data lapor.',
				'tipe' => 1,
			];
		} else {
			$result = [
				'status' => 'Gagal simpan data lapor.',
				'tipe' => 1,
			];
		}
		echo json_encode($result);
	}


	// update lapor
	function form_lapor_update()
	{
		$Id = $this->input->post('Id');

		$Data_lapor = $this->db->query("SELECT * FROM tr_lapor WHERE Id = '$Id'")->row();
		$Data = $this->db->query("SELECT a.nama_pegawai, a.id_pegawai, a.nrk,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									WHERE id_pegawai = '$Data_lapor->id_pegawai'")->row();
		$a['Data_lapor'] 	= $Data_lapor;
		$a['Data'] 			= $Data;
		$a['Id'] 			= $Id;
		$a['master_lapor'] 	= $this->db->query("SELECT * FROM tr_master_lapor ORDER BY Id ASC")->result();

		// $this->load->view('dashboard_publik/lapor/form_lapor_update', $a);
		$this->load->view('dashboard_publik/template/lapor/form_lapor_update', $a);
	}

	function simpan_update()
	{

		$Id 			= $this->input->post('Id');
		$Kategori 		= $this->input->post('Kategori');
		//$Judul_laporan 	= $this->input->post('Judul_laporan');
		$Isi_laporan 	= $this->input->post('Isi_laporan');
		$Date_now 		= date('Y-m-d H:i:s');

		$Data = $this->db->query("SELECT lokasi_kerja FROM tbl_data_pegawai WHERE id_pegawai = '$Id'")->row();
		$lokasi_kerja = isset($Data->lokasi_kerja) ? $Data->lokasi_kerja : '';

		// file upload

		$File_upload 		= $this->input->post('File_upload');
		$File_upload_lama 	= $this->input->post('File_upload_lama');

		$ucode_gen = $this->func_table->generateRandomString2();
		$new_name = 'I_' . $ucode_gen;
		$path_folder = "./asset/upload/Lapor/";


		if ($_FILES["File_upload"]['name'] == '' and $File_upload_lama == '') {
			$new_name_file = '';
		} else if ($_FILES["File_upload"]['name'] == '' and $File_upload_lama != '') {
			$new_name_file = $File_upload_lama;
		} else if ($_FILES["File_upload"]['name'] != '' and $File_upload_lama == '') {
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
			if (!$this->upload->do_upload('File_upload')) {
				echo '<script>alert(Gagal....!);</script>';
				exit;
			} else {
				$new_name_file = $this->upload->file_name;
			}
		} else if ($_FILES["File_upload"]['name'] != '' and $File_upload_lama != '') {
			unlink($path_folder . $File_upload_lama);
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
			if (!$this->upload->do_upload('File_upload')) {
				// echo '<script>alert(gagal....!);</script>';
				$result = [
					'status' => 'Gagal upload file.',
					'tipe' => 0,
				];
				echo json_encode($result);
				exit;
			} else {
				$new_name_file = $this->upload->file_name;
			}
		}

		// end file upload


		$data['Kategori'] = $Kategori;
		//$data['Judul_laporan'] = $Judul_laporan;
		$data['Isi_laporan'] = $Isi_laporan;
		$data['File_upload'] = $new_name_file;
		$data['updated_at'] = $Date_now;

		$this->db->where('Id', $Id);
		$this->db->update('tr_lapor', $data);
		// echo 'Berhasil';
		$result = [
			'status' => 'Berhasil update data lapor.',
			'tipe' => 1,
		];
		echo json_encode($result);
	}


	// hapus
	function delete_lapor()
	{
		$Id = $this->input->post('Id');
		$path_folder = "./asset/upload/Lapor/";

		$QData = $this->db->query("SELECT File_upload FROM tr_lapor WHERE Id = '$Id'")->row();
		if ($QData->File_upload != '') {
			$path_file    = $path_folder . '/' . $QData->File_upload;
			if (file_exists($path_file)) {
				unlink($path_file);
			}
		}

		$del_lapor = $this->db->query("DELETE FROM tr_lapor WHERE Id = '$Id'");
		$del_tanggapan = $this->db->query("DELETE FROM tr_lapor_tanggapan WHERE Lapor_id = '$Id'");
		$del_tanggapan_see = $this->db->query("DELETE FROM tr_lapor_see WHERE Lapor_id = '$Id'");
		if ($del_lapor) {
			echo 'Data Dihapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	// tanggapan
	public function modal_tanggapan()
	{
		$Id = $this->input->post('Id');
		$Data_lapor = $this->db->query("SELECT * FROM tr_lapor WHERE Id = '$Id'")->row();
		$Data = $this->db->query("SELECT a.nama_pegawai, a.id_pegawai, a.nrk,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									WHERE id_pegawai = '$Data_lapor->id_pegawai'")->row();
		$a['Id'] 			= $Id;
		$a['Data_lapor'] 	= $Data_lapor;
		$a['Data'] 			= $Data;

		// $this->load->view('dashboard_publik/lapor/tanggapan/modal_tanggapan', $a);
		$this->load->view('dashboard_publik/template/lapor/tanggapan/modal_tanggapan', $a);
	}

	public function table_tanggapan()
	{
		$Id = $this->input->post('Id');
		$username 	= $this->session->userdata('username');
		$query = $this->db->query("SELECT
										a.Id, 
										a.Lapor_Id, 
										a.Username, 
										a.Tanggapan, 
										a.Created_at, 
										a.Updated_at, nama_lengkap
									FROM
										tr_lapor_tanggapan as a
									LEFT JOIN (
										SELECT nama_lengkap, username FROM tbl_user_login
									) as b ON b.username =  a.username 
									WHERE a.lapor_id = '$Id'")->result();
		$a['Id'] = $Id;
		$a['data'] = $query;
		// --- update notif menu see
		$Query_GetLapor = $this->db->query("SELECT * FROM tr_lapor WHERE Id = '$Id'")->row();
		$Query_Getid = $this->db->query("SELECT MAX(Id) as Id FROM tr_lapor_tanggapan WHERE Lapor_id = '$Id'")->row();
		$last_id = $Query_Getid->Id;
		$see = $this->func_table_lapor->in_tosee_lapor($Query_GetLapor->Created_by, $Id, $last_id, $username);
		// -----
		// $this->load->view('dashboard_publik/lapor/tanggapan/table_tanggapan', $a);
		$this->load->view('dashboard_publik/template/lapor/tanggapan/table_tanggapan', $a);
	}

	public function simpan_tanggapan()
	{
		$Id 		= $this->input->post('Id');
		$username 	= $this->session->userdata('username');
		$user_type 	= $this->session->userdata('stts');

		$Tanggapan = $this->input->post('Tanggapan');
		$tgl_create = date("Y-m-d H:i:s");
		$tgl_update = date("Y-m-d H:i:s");

		$data['Lapor_id'] = $Id;
		$data['username'] = $username;
		$data['Tanggapan'] = $Tanggapan;
		$data['created_at'] = $tgl_create;
		$data['updated_at'] = $tgl_update;

		$result_in = $this->db->insert('tr_lapor_tanggapan', $data);

		if ($result_in) {
			$Query_GetLapor = $this->db->query("SELECT * FROM tr_lapor WHERE Id = '$Id'")->row();
			$Query_Getid = $this->db->query("SELECT MAX(Id) as Id FROM tr_lapor_tanggapan")->row();
			$last_id = $Query_Getid->Id;
			$see = $this->func_table_lapor->in_tosee_lapor($Query_GetLapor->Created_by, $Id, $last_id, $username);
			$Query_update_lapor = $this->db->query("UPDATE tr_lapor SET Tanggapan_id = '$last_id', Updated_at= '$tgl_update' WHERE Id='$Id'");
			$send_notif_lapor 	= $this->func_wa_lapor->notif_lapor_tanggapi($last_id, $Id, $username, $user_type);
			if ($send_notif_lapor) {
				$result = 'Berhasil';
			} else {
				$result = 'Gagal Kirim Notif';
			}
		} else {
			$result = 'Gagal';
		}
		echo $result;
	}

	function edit_tanggapan()
	{
		$Id = $this->input->post('Id');
		$query = $this->db->query("SELECT * FROM tr_lapor_tanggapan WHERE Id = '$Id'")->row();

		echo json_encode($query);
	}

	function update_tanggapan()
	{
		$Id = $this->input->post('Id');
		$Tanggapan = $this->input->post('Tanggapan');
		$tgl_update = date("Y-m-d H:i:s");

		$data['Tanggapan'] 	= $Tanggapan;
		$data['updated_at'] = $tgl_update;

		$this->db->where('Id', $Id);
		$this->db->update('tr_lapor_tanggapan', $data);
		echo 'Berhasil';
	}

	function hapus_tanggapan()
	{
		$Id = $this->input->post('Id');

		$this->db->where('Id', $Id);
		$this->db->delete('tr_lapor_tanggapan');
	}

	public function notify_lapor()
	{
		$count_lapor = $this->func_table_lapor->count_see_lapor_public($this->session->userdata('username'));
		if ($count_lapor > 0) {
			$res_count_lapor = $count_lapor;
		} else {
			$res_count_lapor = '';
		}

		$result = [
			'notify_lapor' => $res_count_lapor
		];

		echo json_encode($result);
	}

	public function form_lapor_detail()
	{
		$Id = $this->input->post('id');

		$Data_lapor = $this->db->query("SELECT * FROM tr_lapor WHERE Id = '$Id'")->row();
		$Data = $this->db->query("SELECT a.nama_pegawai, a.id_pegawai, a.nrk,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									WHERE id_pegawai = '$Data_lapor->id_pegawai'")->row();

		$query = $this->db->query("SELECT
										a.Id, 
										a.Lapor_Id, 
										a.Username, 
										a.Tanggapan, 
										a.Created_at, 
										a.Updated_at, nama_lengkap
									FROM
										tr_lapor_tanggapan as a
									LEFT JOIN (
										SELECT nama_lengkap, username FROM tbl_user_login
									) as b ON b.username =  a.username 
									WHERE a.lapor_id = '$Id'")->result();

		$a['Data_tanggapan'] = $query;
		$a['Data_lapor'] 	= $Data_lapor;
		$a['Data'] 			= $Data;
		$a['Id'] 			= $Id;
		$a['master_lapor'] 	= $this->db->query("SELECT * FROM tr_master_lapor ORDER BY Id ASC")->result();

		$this->load->view('dashboard_publik/template/lapor/form_lapor_detail', $a);
	}
}
