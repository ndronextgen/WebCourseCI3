<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kariskarsu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_table_lapor');
		$this->load->library('func_wa_kariskarsu');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_kariskarsu', 'kariskarsu');
		$this->load->library('upload');
		date_default_timezone_set('Asia/Bangkok');
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

			$x['count_see'] = $count_see;

			$this->load->view('dashboard_publik/kertas_kerja/kariskarsu/index_kariskarsu', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function data_kariskarsu()
	{
		$this->load->view('dashboard_publik/kertas_kerja/kariskarsu/data_kariskarsu/index_data_kariskarsu');
	}

	function table_data_kariskarsu()
	{

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');
		$username = $this->session->userdata('username');

		$listing 		= $this->kariskarsu->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->kariskarsu->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->kariskarsu->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			$no++;
			$see = $this->func_table->see_public_kaku($username, $key->Kariskarsu_id);
			$row = array();
			$button_view = '<a type="button" class="btn btn-info btn-sm" title="Detail" onclick="view_kariskarsu(' . "'" . $key->Kariskarsu_id . "'" . ')">
								<i class="fa fa-eye"></i> &nbsp;Detail
							</a>';
			$button_edit = '<a type="button" class="btn btn-warning btn-sm" title="Edit" onclick="edit_kariskarsu(' . "'" . $key->Kariskarsu_id . "'" . ')">
								<i class="fa fa-edit"></i> &nbsp;Edit
							</a>';
			$button_delete = '<a type="button" class="btn btn-danger btn-sm" title="Hapus" onclick="delete_kariskarsu(' . "'" . $key->Kariskarsu_id . "'" . ')">
									<i class="fa fa-trash"></i> &nbsp;Hapus
								</a>';
			//$button_download = '<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/Data_kariskarsu/download_surat/' . $key->Kariskarsu_id . '" href="javascript:;"><button type="button" class="btn btn-danger btn-sm" title="PDF"><i class="fa fa-file"></i> </button></a>';

			$button_download = '<a href="' . base_url() . 'admin/Data_kariskarsu/download_surat/' . $key->Kariskarsu_id . '" target="_blank">
									<button type="button" class="btn btn-danger btn-sm" title="Download">
										<i class="fa fa-file"></i> &nbsp;Download
									</button>
								</a>';
			switch ($key->Status_progress) {
				case 1:
				case 24:
				case 25:
					//ditolak
					$button = $button_view . ' ' . $button_delete;
					break;
				case 2:
					//proses
					$button = $button_view;
					break;
				case 3:
					$button = $button_view . ' ' . $button_download;
					break;
				case 0:
					//menunggu
					$button = $button_view . ' ' . $button_edit . ' ' . $button_delete;
					break;
				case 21:
				case 22:
				case 23:
				case 26:
				case 27:
				case 28:
					//proses
					$button = $button_view;
					break;
			}

			if ($key->Perkawinan_ke == '1') {
				$data_perkawinan = 'Perkawinan Pertama';
			} else {
				$data_perkawinan = 'Perkawinan Janda/Duda';
			}

			// === nama pegawai ===
			$this->db->select('nama_pegawai');
			$nama_pegawai = $this->db->get_where('tbl_data_pegawai', array('id_pegawai' => $key->id_pegawai))->row()->nama_pegawai;

			// === begin: badge-status ===
			switch ((int) $key->Status_progress) {
				case 0:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 21:
					if ($key->is_dinas == 1) {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subkoordinator<br>Kepegawaian</span>';
					} else {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subbagian</span>';
					}
					// $status_surat = '<span class="badge btn-warning badge-status" 
					// 						onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 22:
				case 27:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
				case 23:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 3:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 24:
				case 25:
				case 28:
				case 26:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				default:
					$status_surat = '<span class="badge btn-dark badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')">' . $key->nama_status_next . '</span>';
					break;
			}
			// === end: badge-status ===

			$row[] = $button;
			$row[] = ucwords(strtolower($nama_pegawai));
			$row[] = $data_perkawinan;
			// $row[] = $key->nama_status;
			$row[] = $status_surat;;
			$row[] = $this->func_table->get_file_kariskarsu($key->File_surat_nikah);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_kk);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_ktp_suami);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_ktp_istri);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_sk_pns);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_foto);
			$row[] = date_format(date_create($key->Created_at), 'j M Y' .' ('. 'H:i:s' . ') ');
			$row[] = $see;

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

	function add_kariskarsu()
	{
		$id_pegawai = $this->session->userdata('id_pegawai');
		$Kariskarsu_id = $this->func_table->generateRandomString();
		$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE id_pegawai = '$id_pegawai'")->row();
		$a['Data'] = $Data;
		$a['Kariskarsu_id'] = $Kariskarsu_id;

		$a['func_table'] = $this->load->library('func_table');

		$this->load->view('dashboard_publik/kertas_kerja/kariskarsu/data_kariskarsu/form_kariskarsu_add', $a);
	}

	// item pilihan
	function get_temp_item_pilihan()
	{
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');
		$pasangan_temp = $this->db->query("SELECT
											a.Kariskarsu_id, 
											a.Keluarga_id, 
											b.nama_anggota_keluarga,
											b.nik,
											b.tempat_lahir, 
											b.tanggal_lahir_keluarga,
											b.tempat_nikah,
											b.tanggal_nikah,
											b.pekerjaan_sekolah,
											b.agama, b.alamat_new,b.pangkat_golongan,
											a.Created_at
										FROM
											tr_kariskarsu_komponen_temp AS a
										LEFT JOIN (
											SELECT
											k.id_data_keluarga, 
											k.id_pegawai, 
											k.nama_anggota_keluarga, 
											k.tempat_lahir,  
											k.tanggal_lahir_keluarga, 
											k.jenis_kelamin, 
											k.hub_keluarga, 
											k.nik, 
											k.status_kawin, 
											k.tempat_nikah, 
											k.tanggal_nikah, 
											k.uraian, 
											k.tanggal_cerai_meninggal, 
											IF(k.agama = '0', k.agama_lainnya, c.master_agama) AS agama,
											IF(k.alamat_sdp = '0', k.alamat, d.master_alamat) AS alamat_new,
											k.pangkat_golongan, 
											k.pekerjaan_sekolah
										FROM
											tbl_data_keluarga AS k
											LEFT JOIN ( SELECT kode, agama AS master_agama FROM mt_agama ) AS c ON c.kode = k.agama 
											LEFT JOIN ( SELECT id_pegawai, alamat AS master_alamat FROM tbl_data_pegawai ) AS d ON d.id_pegawai = k.id_pegawai
										) as b ON b.id_data_keluarga = a.Keluarga_id
										WHERE a.Kariskarsu_id = '$Kariskarsu_id'")->row();
		$a['Kariskarsu_id'] = $Kariskarsu_id;
		$a['pasangan_temp'] = $pasangan_temp;
		$this->load->view('dashboard_publik/kertas_kerja/kariskarsu/data_kariskarsu/ajax_pasangan', $a);
	}
	// end table pilihan

	// get item
	function get_item()
	{
		$a['id_pegawai'] = $this->input->post('Id');
		$a['Kariskarsu_id'] = $this->input->post('Kariskarsu_id');
		//$this->load->view('dashboard_publik/homes/group_pribadi/keluarga/index_keluarga');
		//$this->load->view('dashboard_publik/home/keluarga');
		$this->load->view('dashboard_publik/kertas_kerja/kariskarsu/data_kariskarsu/get_item/ajax_item', $a);
	}

	function table_data_item()
	{
		$id_pegawai = $this->input->post('id_pegawai');
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');

		$listing 		= $this->kariskarsu->listing_item($id_pegawai, $Kariskarsu_id);
		$jumlah_filter 	= $this->kariskarsu->jumlah_filter_item($id_pegawai, $Kariskarsu_id);
		$jumlah_semua 	= $this->kariskarsu->jumlah_semua_item($id_pegawai, $Kariskarsu_id);

		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			$no++;
			$row = array();
			$button = '<button class="btn btn-info btn-sm btn-flat" onclick="usulkan_data(' . "'" . $key->id_data_keluarga . "'" . ', ' . "'" . $Kariskarsu_id . "'" . ')"> <i class="fa fa-check-square"></i></button>';
			#cek kelengkapan data keluarga
			//$cek_kelengkapan = $this->func_table->cek_kelengkapan_keluarga($key->id_data_keluarga);
			if ($key->nama_anggota_keluarga == '' || $key->tempat_nikah == '' || $key->nik == '' || $key->pekerjaan_sekolah == '' || $key->tempat_lahir == '' || $key->tanggal_lahir_keluarga == '' || $key->agama == '' || $key->alamat_new == '') {
				$button = '<small class="badge" style="font-size: 9px;padding: 5px;background: #eb4034;overflow-wrap: break-word;word-wrap: break-word;hyphens: auto;white-space: normal;">Lengkapi Data Terlebih Dahulu</small>';
			} else {
				$button = '<button class="btn btn-info btn-sm btn-flat" onclick="usulkan_data(' . "'" . $key->id_data_keluarga . "'" . ', ' . "'" . $Kariskarsu_id . "'" . ')"> <i class="fa fa-check-square"></i></button>';
			}

			$row[] = $button;
			$row[] = $key->nama_anggota_keluarga;
			$row[] = $key->tempat_nikah . ' ' . str_replace(' ', '&nbsp;', $key->tanggal_nikah);
			$row[] = $key->nik;
			$row[] = $key->pangkat_golongan;
			$row[] = $key->pekerjaan_sekolah; //1 laki-laki 2 perempuan
			$row[] = $key->tempat_lahir . ' ' . str_replace(' ', '&nbsp;', $key->tanggal_lahir_keluarga);
			$row[] = $key->agama;
			$row[] = $key->alamat_new;
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

	function pindahkan_item()
	{
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');
		$Keluarga_id = $this->input->post('Keluarga_id');
		$tgl_create = date('Y-m-d H:i:s');
		$tgl_update = date('Y-m-d H:i:s');

		$delitem_temp = $this->db->query("DELETE FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id'");

		// copy
		$this->db->query("INSERT INTO 
		tr_kariskarsu_komponen_temp(Kariskarsu_id, 
									Keluarga_id, 
									Nama_anggota, 
									Nip_nik, 
									Pangkat_gol_ruang, 
									Tempat_lahir, 
									Tanggal_lahir, 
									Tempat_nikah, 
									Tanggal_nikah, 
									Pekerjaan_sekolah, 
									Agama, 
									Alamat, 
									Created_at) 
		SELECT 
		'$Kariskarsu_id',id_data_keluarga,nama_anggota_keluarga,nik,pangkat_golongan,tempat_lahir,tanggal_lahir_keluarga,tempat_nikah,tanggal_nikah,pekerjaan_sekolah,agama,alamat,'$tgl_create'
		FROM tbl_data_keluarga WHERE id_data_keluarga = '$Keluarga_id'");

		//$jumlah = count($arr_item);

		echo "Berhasil Menambahkan";
	}

	// function delete_tunjangan_temp_item()
	// {
	// 	$Id = $this->input->post('Id');
	// 	$del_temp = $this->db->query("DELETE FROM tr_tunjangan_komponen_temp WHERE Id = '$Id'");
	// 	if ($del_temp) {
	// 		echo 'Berhasil Anggota Keluarga Dikembalikan';
	// 	} else {
	// 		echo 'Gagal Anggota Keluarga Dikembalikan';
	// 	}
	// }

	// end get litem

	// simpan bos
	function simpan_tambah_kariskarsu()
	{
		// === begin: cek tambah data keluarga ===
		if ($this->is_exist_keluarga($this->input->post('Kariskarsu_id')) == 0) {
			echo '0|Data keluarga belum ditambahkan!';
			exit;
		}
		// === end: cek tambah data keluarga ===

		// === begin: cek kelengkapan field ===
		$is_valid = $this->cek_mandatory_fields($this->session->userdata('id_pegawai'));
		$is_valid_arr = explode("|", $is_valid);

		if ($is_valid_arr[0] == 0) {
			echo $is_valid;
			exit;
		}
		// === end: cek kelengkapan field ===

		$id_pegawai 		= $this->session->userdata('id_pegawai');
		$Created_by 		= $this->session->userdata('username');
		$Updated_by 		= $this->session->userdata('username');
		$Kariskarsu_id 		= $this->input->post('Kariskarsu_id');
		$Perkawinan_ke 		= $this->input->post('Perkawinan_ke');
		$Status_progress 	= '0'; //menunggu
		$Act 				= '0'; //harus ada track
		$Notes				= '';
		$Date_now 			= date('Y-m-d H:i:s');

		$data_pegawai = $this->db->query(
			"SELECT
				if(isnull(b.dinas),'1',b.dinas) as dinas, 
				a.id_pegawai, 
				a.lokasi_kerja, 
				a.status_pegawai
			FROM
				tbl_data_pegawai AS a
			LEFT JOIN tbl_master_lokasi_kerja AS b ON a.lokasi_kerja = b.id_lokasi_kerja
			WHERE id_pegawai = '$id_pegawai'"
		)->row();

		$lokasi_kerja_pegawai	= $data_pegawai->lokasi_kerja;
		$is_dinas				= $data_pegawai->dinas;

		$File_surat_nikah = $this->input->post('File_surat_nikah');
		$File_kk = $this->input->post('File_kk');
		$File_ktp_suami = $this->input->post('File_ktp_suami');
		$File_ktp_istri = $this->input->post('File_ktp_istri');
		$File_sk_pns = $this->input->post('File_sk_pns');
		$File_foto = $this->input->post('File_foto');

		$Fsurat_nikah 	= $this->upload_file_kariskarsu($File_surat_nikah, 'File_surat_nikah', 'SNIKAH', $Kariskarsu_id);
		$Fsurat_nikah_explode = explode("|", $Fsurat_nikah);
		if ($Fsurat_nikah_explode[0] == '0') {
			echo '0|' . $Fsurat_nikah_explode[1];
			$resFsurat_nikah = '';
			exit;
		} else {
			$resFsurat_nikah = $Fsurat_nikah;
		}
		$Fkk 			= $this->upload_file_kariskarsu($File_kk, 'File_kk', 'KARTUKEL', $Kariskarsu_id);
		$Fkk_explode = explode("|", $Fkk);
		if ($Fkk_explode[0] == '0') {
			echo '0|' . $Fkk_explode[1];
			$resFkk = '';
			exit;
		} else {
			$resFkk = $Fkk;
		}
		$Fktp_suami 	= $this->upload_file_kariskarsu($File_ktp_suami, 'File_ktp_suami', 'KTPSUAMI', $Kariskarsu_id);
		$Fktp_suami_explode = explode("|", $Fktp_suami);
		if ($Fktp_suami_explode[0] == '0') {
			echo '0|' . $Fktp_suami_explode[1];
			$resFktp_suami = '';
			exit;
		} else {
			$resFktp_suami = $Fktp_suami;
		}
		$Fktp_istri 	= $this->upload_file_kariskarsu($File_ktp_istri, 'File_ktp_istri', 'KTPISTRI', $Kariskarsu_id);
		$Fktp_istri_explode = explode("|", $Fktp_istri);
		if ($Fktp_istri_explode[0] == '0') {
			echo '0|' . $Fktp_istri_explode[1];
			$resFktp_istri = '';
			exit;
		} else {
			$resFktp_istri = $Fktp_istri;
		}
		$Fsk_pns 		= $this->upload_file_kariskarsu($File_sk_pns, 'File_sk_pns', 'SKPNSCPNS', $Kariskarsu_id);
		$Fsk_pns_explode = explode("|", $Fsk_pns);
		if ($Fsk_pns_explode[0] == '0') {
			echo '0|' . $Fsk_pns_explode[1];
			$resFsk_pns = '';
			exit;
		} else {
			$resFsk_pns = $Fsk_pns;
		}
		$Ffoto 			= $this->upload_file_kariskarsu($File_foto, 'File_foto', 'FOTO', $Kariskarsu_id);
		$Ffoto_explode = explode("|", $Ffoto);
		if ($Ffoto_explode[0] == '0') {
			echo '0|' . $Ffoto_explode[1];
			$resFfoto = '';
			exit;
		} else {
			$resFfoto = $Ffoto;
		}

		$data['id_pegawai'] 			= $id_pegawai;
		$data['lokasi_kerja_pegawai'] 	= $lokasi_kerja_pegawai;
		$data['is_dinas'] 				= $is_dinas;
		$data['Kariskarsu_id'] 			= $Kariskarsu_id;
		$data['Perkawinan_ke'] 			= $Perkawinan_ke;
		$data['Status_progress'] 		= $Status_progress;
		$data['File_surat_nikah'] 		= $resFsurat_nikah;
		$data['File_kk'] 				= $resFkk;
		$data['File_ktp_suami'] 		= $resFktp_suami;
		$data['File_ktp_istri'] 		= $resFktp_istri;
		$data['File_sk_pns'] 			= $resFsk_pns;
		$data['File_foto'] 				= $resFfoto;
		$data['Created_by'] 			= $Created_by;
		$data['Created_at'] 			= $Date_now;
		$data['Updated_by'] 			= $Updated_by;
		$data['Updated_at'] 			= $Date_now;

		$in_kariskarsu = $this->db->insert('tr_kariskarsu', $data);
		//$in_kariskarsu = 1;
		if ($in_kariskarsu) {
			$data_triger['Act'] 			= $Act;
			$data_triger['Kariskarsu_id'] 	= $Kariskarsu_id;
			$data_triger['Status_progress'] = $Status_progress;
			$data_triger['Notes'] 			= $Notes;
			$data_triger['User_created'] 	= $Updated_by;
			$data_triger['Created_at'] 		= $Date_now;
			$Q_insert = $this->db->insert('tr_kariskarsu_triger', $data_triger);
			$see = $this->func_table->in_tosee_kaku($Created_by, $Kariskarsu_id, '0', $Created_by);
			#wa/email
			if ($Q_insert) {
				#wa/email to pegawai
				#wa/email to admin bersangkutan
				$send_notif_sk_pegawai 	= $this->func_wa_kariskarsu->notif_kaku_pegawai_tambah($Kariskarsu_id);
			}
			#end wa/email
			echo 'Berhasil';
		} else {
			echo 'Gagal';
		}
	}
	// end simpan

	function upload_file_kariskarsu($file_data, $filename, $identity_name, $Kariskarsu_id)
	{

		//$Gencode_file 		= $this->func_table->generateRandomString2();
		$File_upload_name 	= $Kariskarsu_id . '_' . $identity_name;
		$Path_folder = "./asset/upload/kariskarsu/";

		if ($_FILES[$filename]['name'] == '') {
			$new_name = '';
		} else if ($_FILES[$filename]['name'] != '') {
			// --
			$string 		= $_FILES[$filename]['name'];
			$temp 			= explode(".", $string);
			$new_name 		= $File_upload_name . '.' . end($temp);
			$new_name 		= str_replace(' ', '', $new_name);

			// -- delete terlebih dahulu jika sudah ada file yang terupload
			$Path_old = $Path_folder . $new_name;
			if (file_exists($Path_old)) {
				unlink($Path_old);
			}
			// --
			$config['file_name'] 		= $new_name;
			$config['upload_path']      = $Path_folder;
			$config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG|JPEG|pdf';
			$config['max_size']         = 50000; //set max size allowed in Kilobyte

			$this->upload->initialize($config);
			if (!$this->upload->do_upload($filename)) {
				$data['inputerror'][] = $filename;
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = FALSE;
				return '0|' . json_encode($data);
				//echo json_encode($data);
				//exit();
			} else {
				$new_name = $this->upload->file_name;
			}
		} else {
			$new_name = '';
		}
		return $new_name;
	}
	function upload_file_kariskarsu_edit($file_data, $old_file, $filename,  $identity_name, $Kariskarsu_id)
	{

		//$Gencode_file 		= $this->func_table->generateRandomString2();
		$File_upload_name 	= $Kariskarsu_id . '_' . $identity_name;
		$Path_folder = "./asset/upload/kariskarsu/";

		if ($_FILES[$filename]['name'] != '') {
			// --
			$string 		= $_FILES[$filename]['name'];
			$temp 			= explode(".", $string);
			$new_name 		= $File_upload_name . '.' . end($temp);
			$new_name 		= str_replace(' ', '', $new_name);

			// -- delete terlebih dahulu jika sudah ada file yang terupload
			$Path_old = $Path_folder . $old_file;
			if (file_exists($Path_old)) {
				unlink($Path_old);
			}
			// --
			$config['file_name'] 		= $new_name;
			$config['upload_path']      = $Path_folder;
			$config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG|JPEG|pdf';
			$config['max_size']         = 50000; //set max size allowed in Kilobyte

			$this->upload->initialize($config);
			if (!$this->upload->do_upload($filename)) {
				$data['inputerror'][] = $filename;
				$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
				$data['status'] = FALSE;
				return '0|' . json_encode($data);
				//echo json_encode($data);
				//exit();
			} else {
				$new_name = $this->upload->file_name;
			}
		} else {
			$new_name = $old_file;
		}
		return $new_name;
	}

	function is_exist_keluarga($Kariskarsu_id)
	{
		$sSQL = "SELECT Id FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id'";
		$rsSQL = $this->db->query($sSQL)->num_rows();
		if ($rsSQL > 0) {
			return 1;
		}
		return 0;
	}

	function cek_mandatory_fields($id_pegawai)
	{
		// === query data pegawai ===
		$sSQL = "SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
					a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
					a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
					golongan, uraian, nama_jabatan
				FROM tbl_data_pegawai as a
				LEFT JOIN (
							SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
						) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
				LEFT JOIN (
					SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
				) as c ON c.id_status_pegawai =  a.status_pegawai
				LEFT JOIN (
					SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
				) as d ON d.id_golongan =  a.id_golongan
				LEFT JOIN (
					SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
				) as e ON e.id_nama_jabatan =  a.id_jabatan
				WHERE id_pegawai = '$id_pegawai'";
		$rsSQL = $this->db->query($sSQL);

		if (isset($rsSQL)) {
			$data = $rsSQL->row();
			$is_dirty = 0;
			$pesan = '';
			$pesan_all = '';

			$pesan = 'Lengkapi data pegawai pada field:<br>';

			// === DATA PEGAWAI ===
			if ($data->nama_pegawai == '') {
				$pesan .= "- <b>Nama Lengkap</b><br>";
				$is_dirty = 1;
			}
			if ($data->nip == '') {
				$pesan .= "- <b>NIP</b><br>";
				$is_dirty = 1;
			}
			if ($data->tempat_lahir == '') {
				$pesan .= "- <b>Tempat Lahir</b><br>";
				$is_dirty = 1;
			}
			if ($data->tanggal_lahir == '') {
				$pesan .= "- <b>Tanggal Lahir</b><br>";
				$is_dirty = 1;
			}
			if ($data->jenis_kelamin == '') {
				$pesan .= "- <b>Jenis Kelamin</b><br>";
				$is_dirty = 1;
			}
			if ($data->agama == '') {
				$pesan .= "- <b>Agama</b><br>";
				$is_dirty = 1;
			}
			if ($data->alamat == '') {
				$pesan .= "- <b>Alamat</b><br>";
				$is_dirty = 1;
			}
			if ($data->lokasi_kerja == '') {
				$pesan .= "- <b>Lokasi Kerja Pegawai</b><br>";
				$is_dirty = 1;
			}
			if ($data->golongan == '') {
				$pesan .= "- <b>Golongan/b><br>";
				$is_dirty = 1;
			}
			if ($is_dirty == 1) {
				$pesan_all = $pesan;
			}

			if ($is_dirty == 1) {
				return '0|' . $pesan_all;
				exit;
			}

			return '1';
		}
	}


	// edit karis/karsu
	function edit_kariskarsu()
	{
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');

		// delete dulu yang di temp 
		$delete_temp = $this->db->query("DELETE FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id'");
		if ($delete_temp) {
			// isert temp dari real
			$this->db->query("INSERT INTO tr_kariskarsu_komponen_temp (
									Kariskarsu_id, 
									Keluarga_id, 
									Nama_anggota, 
									Nip_nik, 
									Pangkat_gol_ruang, 
									Tempat_lahir, 
									Tanggal_lahir, 
									Tempat_nikah, 
									Tanggal_nikah, 
									Pekerjaan_sekolah, 
									Agama, 
									Alamat, 
									Created_at
								)
								SELECT
									Kariskarsu_id, 
									Keluarga_id, 
									Nama_anggota, 
									Nip_nik, 
									Pangkat_gol_ruang, 
									Tempat_lahir, 
									Tanggal_lahir, 
									Tempat_nikah, 
									Tanggal_nikah, 
									Pekerjaan_sekolah, 
									Agama, 
									Alamat, 
									Created_at
								FROM
									tr_kariskarsu_komponen
								WHERE tr_kariskarsu_komponen.Kariskarsu_id = '$Kariskarsu_id'");
		}
		$Data_kariskarsu = $this->db->query("SELECT * FROM tr_kariskarsu WHERE Kariskarsu_id='$Kariskarsu_id'")->row();
		$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja = a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE id_pegawai = '$Data_kariskarsu->id_pegawai'")->row();

		$a['Data'] = $Data;
		$a['Data_kariskarsu'] = $Data_kariskarsu;
		$a['Kariskarsu_id'] = $Kariskarsu_id;
		$a['func_table'] = $this->load->library('func_table');

		$this->load->view('dashboard_publik/kertas_kerja/kariskarsu/data_kariskarsu/form_kariskarsu_update', $a);
	}

	function simpan_update_kariskarsu()
	{
		// === begin: cek tambah data keluarga ===
		if ($this->is_exist_keluarga($this->input->post('Kariskarsu_id')) == 0) {
			echo '0|Data keluarga belum ditambahkan!';
			exit;
		}
		// === end: cek tambah data keluarga ===

		// === begin: cek kelengkapan field ===
		// $is_valid = $this->cek_mandatory_fields($this->session->userdata('id_pegawai'));
		// $is_valid_arr = explode("|", $is_valid);

		// if ($is_valid_arr[0] == 0) {
		// 	echo $is_valid;
		// 	exit;
		// }
		// === end: cek kelengkapan field ===

		$Kariskarsu_id 		= $this->input->post('Kariskarsu_id');
		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '1';
		$Perkawinan_ke 		= $this->input->post('Perkawinan_ke');
		$Date_now 			= date('Y-m-d H:i:s');

		// file-file
		$File_surat_nikah = $this->input->post('File_surat_nikah');
		$File_kk = $this->input->post('File_kk');
		$File_ktp_suami = $this->input->post('File_ktp_suami');
		$File_ktp_istri = $this->input->post('File_ktp_istri');
		$File_sk_pns = $this->input->post('File_sk_pns');
		$File_foto = $this->input->post('File_foto');

		$File_surat_nikah_lama = $this->input->post('File_surat_nikah_lama');
		$File_kk_lama = $this->input->post('File_kk_lama');
		$File_ktp_suami_lama = $this->input->post('File_ktp_suami_lama');
		$File_ktp_istri_lama = $this->input->post('File_ktp_istri_lama');
		$File_sk_pns_lama = $this->input->post('File_sk_pns_lama');
		$File_foto_lama = $this->input->post('File_foto_lama');

		$Fsurat_nikah 	= $this->upload_file_kariskarsu_edit($File_surat_nikah, $File_surat_nikah_lama, 'File_surat_nikah', 'SNIKAH', $Kariskarsu_id);
		$Fsurat_nikah_explode = explode("|", $Fsurat_nikah);
		if ($Fsurat_nikah_explode[0] == '0') {
			echo '0|' . $Fsurat_nikah_explode[1];
			$resFsurat_nikah = '';
			exit;
		} else {
			$resFsurat_nikah = $Fsurat_nikah;
		}
		$Fkk 			= $this->upload_file_kariskarsu_edit($File_kk, $File_kk_lama, 'File_kk', 'KARTUKEL', $Kariskarsu_id);
		$Fkk_explode = explode("|", $Fkk);
		if ($Fkk_explode[0] == '0') {
			echo '0|' . $Fkk_explode[1];
			$resFkk = '';
			exit;
		} else {
			$resFkk = $Fkk;
		}
		$Fktp_suami 	= $this->upload_file_kariskarsu_edit($File_ktp_suami, $File_ktp_suami_lama, 'File_ktp_suami', 'KTPSUAMI', $Kariskarsu_id);
		$Fktp_suami_explode = explode("|", $Fktp_suami);
		if ($Fktp_suami_explode[0] == '0') {
			echo '0|' . $Fktp_suami_explode[1];
			$resFktp_suami = '';
			exit;
		} else {
			$resFktp_suami = $Fktp_suami;
		}
		$Fktp_istri 	= $this->upload_file_kariskarsu_edit($File_ktp_istri, $File_ktp_istri_lama, 'File_ktp_istri', 'KTPISTRI', $Kariskarsu_id);
		$Fktp_istri_explode = explode("|", $Fktp_istri);
		if ($Fktp_istri_explode[0] == '0') {
			echo '0|' . $Fktp_istri_explode[1];
			$resFktp_istri = '';
			exit;
		} else {
			$resFktp_istri = $Fktp_istri;
		}
		$Fsk_pns 		= $this->upload_file_kariskarsu_edit($File_sk_pns, $File_sk_pns_lama, 'File_sk_pns', 'SKPNSCPNS', $Kariskarsu_id);
		$Fsk_pns_explode = explode("|", $Fsk_pns);
		if ($Fsk_pns_explode[0] == '0') {
			echo '0|' . $Fsk_pns_explode[1];
			$resFsk_pns = '';
			exit;
		} else {
			$resFsk_pns = $Fsk_pns;
		}
		$Ffoto 			= $this->upload_file_kariskarsu_edit($File_foto, $File_foto_lama, 'File_foto', 'FOTO', $Kariskarsu_id);
		$Ffoto_explode = explode("|", $Ffoto);
		if ($Ffoto_explode[0] == '0') {
			echo '0|' . $Ffoto_explode[1];
			$resFfoto = '';
			exit;
		} else {
			$resFfoto = $Ffoto;
		}
		// end file-file

		$data['Perkawinan_ke'] 		= $Perkawinan_ke;
		$data['File_surat_nikah'] 	= $resFsurat_nikah;
		$data['File_kk'] 			= $resFkk;
		$data['File_ktp_suami'] 	= $resFktp_suami;
		$data['File_ktp_istri'] 	= $resFktp_istri;
		$data['File_sk_pns'] 		= $resFsk_pns;
		$data['File_foto'] 			= $resFfoto;
		$data['Updated_by'] 		= $Updated_by;
		$data['Updated_at'] 		= $Date_now;

		$this->db->where('Kariskarsu_id', $Kariskarsu_id);
		$in_kariskarsu = $this->db->update('tr_kariskarsu', $data);

		if ($in_kariskarsu) {
			$data_triger['Act'] 			= $Act;
			$data_triger['Kariskarsu_id'] 	= $Kariskarsu_id;
			$data_triger['User_created'] 	= $Updated_by;
			$data_triger['Created_at'] 		= $Date_now;
			$this->db->insert('tr_kariskarsu_triger', $data_triger);
			echo 'Berhasil';
		} else {
			echo 'Gagal';
		}
	}
	// end edit kariskarsu

	function delete_kariskarsu()
	{
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');
		$Qdata = $this->db->query("SELECT * FROM tr_kariskarsu WHERE Kariskarsu_id = '$Kariskarsu_id'")->row();

		$Path_folder = "./asset/upload/kariskarsu/";
		$Path_file_sn = $Path_folder . $Qdata->File_surat_nikah;
		if (file_exists($Path_file_sn)) {
			unlink($Path_file_sn);
		}
		$Path_file_kk = $Path_folder . $Qdata->File_kk;
		if (file_exists($Path_file_kk)) {
			unlink($Path_file_kk);
		}
		$Path_file_ktps = $Path_folder . $Qdata->File_ktp_suami;
		if (file_exists($Path_file_ktps)) {
			unlink($Path_file_ktps);
		}

		$Path_file_ktpi = $Path_folder . $Qdata->File_ktp_istri;
		if (file_exists($Path_file_ktpi)) {
			unlink($Path_file_ktpi);
		}

		$Path_file_skpns = $Path_folder . $Qdata->File_sk_pns;
		if (file_exists($Path_file_skpns)) {
			unlink($Path_file_skpns);
		}

		$Path_file_foto = $Path_folder . $Qdata->File_foto;
		if (file_exists($Path_file_foto)) {
			unlink($Path_file_foto);
		}

		$del = $this->db->query("DELETE FROM tr_kariskarsu WHERE Kariskarsu_id = '$Kariskarsu_id'");
		$del_komp = $this->db->query("DELETE FROM tr_kariskarsu_komponen WHERE Kariskarsu_id = '$Kariskarsu_id'");
		$del_temp = $this->db->query("DELETE FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id'");
		if ($del) {
			echo 'Berhasil Hapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	// view kariskarsu
	function view_kariskarsu()
	{
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');
		$username 	= $this->session->userdata('username');

		// delete dulu yang di temp 
		$delete_temp = $this->db->query("DELETE FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id'");
		if ($delete_temp) {
			// isert temp dari real
			$this->db->query("INSERT INTO tr_kariskarsu_komponen_temp (
									Kariskarsu_id, 
									Keluarga_id, 
									Nama_anggota, 
									Nip_nik, 
									Pangkat_gol_ruang, 
									Tempat_lahir, 
									Tanggal_lahir, 
									Tempat_nikah, 
									Tanggal_nikah, 
									Pekerjaan_sekolah, 
									Agama, 
									Alamat, 
									Created_at
								)
								SELECT
									Kariskarsu_id, 
									Keluarga_id, 
									Nama_anggota, 
									Nip_nik, 
									Pangkat_gol_ruang, 
									Tempat_lahir, 
									Tanggal_lahir, 
									Tempat_nikah, 
									Tanggal_nikah, 
									Pekerjaan_sekolah, 
									Agama, 
									Alamat, 
									Created_at
								FROM
									tr_kariskarsu_komponen
								WHERE tr_kariskarsu_komponen.Kariskarsu_id = '$Kariskarsu_id'");
		}
		$Data_kariskarsu = $this->db->query("SELECT * FROM tr_kariskarsu WHERE Kariskarsu_id='$Kariskarsu_id'")->row();
		$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja = a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE id_pegawai = '$Data_kariskarsu->id_pegawai'")->row();

		$a['Data'] = $Data;
		$a['Data_kariskarsu'] = $Data_kariskarsu;
		$a['Kariskarsu_id'] = $Kariskarsu_id;
		$a['func_table'] = $this->load->library('func_table');
		$see = $this->func_table->in_tosee_kaku($Data_kariskarsu->Created_by, $Kariskarsu_id, $Data_kariskarsu->Status_progress, $username);

		// ===== surat karis/karsu history =====
		$sSQL = "SELECT his.kariskarsu_id, his.user_created, surat.is_dinas,
					if(isnull(log.nama_lengkap), '-', log.nama_lengkap) nama_pegawai, 
					his.created_at,
					stat.id_status, stat.nama_status, stat.style, surat.notes, 
					if(isnull(lok.dinas), '-', lok.dinas) dinas, 
					if(isnull(peg.lokasi_kerja), '-', peg.lokasi_kerja) lokasi_kerja_id, 
					if(isnull(lok.lokasi_kerja), '-', lok.lokasi_kerja) lokasi_kerja_desc
				from tr_kariskarsu_track his
					join tr_kariskarsu surat
						on surat.kariskarsu_id = his.kariskarsu_id
					join tbl_status_surat stat
						on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg
						on peg.id_pegawai = his.user_created
					left join tbl_user_login log
						on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok
						on lok.id_lokasi_kerja = peg.lokasi_kerja
				where his.kariskarsu_id = '$Kariskarsu_id'
				order by his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);

		$a['data_history'] = $rsSQL;
		// ===== /surat karis/karsu history =====

		$this->load->view('dashboard_publik/kertas_kerja/kariskarsu/data_kariskarsu/view_kariskarsu', $a);
	}

	// public function notify_tj()
	// {
	// 	$count_see = $this->func_table->count_see_tj($this->session->userdata('username'));
	// 	if ($count_see > 0) {
	// 		echo '<span class="badge btn-warning btn-flat">' . $count_see . '</span>';
	// 	} else {
	// 		echo '';
	// 	}
	// }

	public function notify_kariskarsu()
	{
		$count_see 			= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
		$count_see_tj 		= $this->func_table->count_see_tj($this->session->userdata('username'));
		$count_see_kaku		= $this->func_table->count_see_kaku($this->session->userdata('username'));

		$total = $count_see + $count_see_tj + $count_see_kaku;

		if ($count_see_kaku > 0) {
			$res_count_see_kaku = '<span class="badge btn-warning btn-flat">' . $count_see_kaku . '</span>';
		} else {
			$res_count_see_kaku = '';
		}

		if ($total > 0) {
			$res_total = '<span class="badge btn-warning btn-flat">' . $total . '</span>';
		} else {
			$res_total = '';
		}

		$result = [
			'kariskarsu' => $res_count_see_kaku,
			'ttl_kertas_kerja' => $res_total
		];

		echo json_encode($result);
	}

	function show_timeline()
	{
		// ===== surat karis/karsu history =====
		$kariskarsu_id = $this->input->post('kariskarsu_id');

		$sSQL = "SELECT
					his.kariskarsu_id,
					his.user_created, surat.is_dinas,
					if ( isnull( log.nama_lengkap ), '-', log.nama_lengkap ) nama_pegawai,
					his.created_at,
					stat.id_status,
					stat.nama_status, stat.style,
					surat.notes as keterangan_ditolak,
					if ( isnull( lok.dinas ), '-', lok.dinas ) dinas,
					if ( isnull( peg.lokasi_kerja ), '-', peg.lokasi_kerja ) lokasi_kerja_id,
					if ( isnull( lok.lokasi_kerja ), '-', lok.lokasi_kerja ) lokasi_kerja_desc 
				from
					tr_kariskarsu_track his
					join tr_kariskarsu surat on surat.kariskarsu_id = his.kariskarsu_id
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.kariskarsu_id = '$kariskarsu_id' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);
		$a['data_history'] = $rsSQL;

		$this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline', $a);
	}
}
