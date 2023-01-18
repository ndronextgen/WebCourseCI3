<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tunjangan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_table_lapor');
		$this->load->library('func_wa_tunjangan');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_tunjangan', 'tunjangan');
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
			$d['count_see_verifikasi_pindah_tugas'] = $count_see_verifikasi_pindah_tugas;

			$x['count_see'] = $count_see;

			// $this->load->view('dashboard_publik/tunjangan/index_tunjangan', $d);

			$d['page'] = 'dashboard_publik/template/kertas_kerja/tunjangan_keluarga/index';
			$d['menu'] = 'tunjangan keluarga';
			$this->load->view('dashboard_publik/template/main', $d);
	} else {
			header('location:' . base_url() . '');
		}
	}

	function data_tunjangan()
	{
		// $this->load->view('dashboard_publik/tunjangan/data_tunjangan/index_data_tunjangan');
		$this->load->view('dashboard_publik/template/kertas_kerja/tunjangan_keluarga/data_tunjangan/index_data_tunjangan');
	}

	function table_data_tunjangan()
	{

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');
		$username = $this->session->userdata('username');

		$listing 		= $this->tunjangan->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->tunjangan->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->tunjangan->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$see = $this->func_table->see_public_tj($username, $key->Tunjangan_id);

			$row = array();

			$button_view 		= '<a type="button" class="btn btn-info btn-sm" title="Detail" onclick="view_tunjangan(' . "'" . $key->Tunjangan_id . "'" . ')"><i class="fa fa-eye"></i>&nbsp;Detail</a>';
			$button_edit 		= '<a type="button" class="btn btn-warning btn-sm" title="Edit" onclick="edit_tunjangan(' . "'" . $key->Tunjangan_id . "'" . ')"><i class="fa fa-edit"></i>&nbsp;Edit</a>';
			$button_delete 		= '<a type="button" class="btn btn-danger btn-sm" title="Hapus" onclick="delete_tunjangan(' . "'" . $key->Tunjangan_id . "'" . ')"><i class="fa fa-trash"></i>&nbsp;Hapus</a>';
			$button_download 	= '<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/Data_tunjangan/download_surat/' . $key->Tunjangan_id . '" href="javascript:void(0);">
										<button type="button" class="btn btn-danger btn-sm" title="Download">
											<i class="fa fa-file"></i>&nbsp;Download
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
			$row[] = $button;

			$row[] = $key->Digaji_menurut;

			// $row[] = $key->nama_status;
			// === begin: badge-status ===
			switch ((int) $key->Status_progress) {
				case 0:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 21:
					if ($key->is_dinas == 1) {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subkoordinator<br>Kepegawaian</span>';
					} else {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subbagian</span>';
					}
					// $status_surat = '<span class="badge btn-warning badge-status" 
					// 						onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 22:
				case 27:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
				case 23:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 3:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 24:
				case 25:
				case 28:
				case 26:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				default:
					$status_surat = '<span class="badge btn-dark badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')">' . $key->nama_status_next . '</span>';
					break;
			}
			// === end: badge-status ===
			$row[] = $status_surat;

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

	function add_tunjangan()
	{
		$id_pegawai = $this->session->userdata('id_pegawai');
		$Tunjangan_id = $this->func_table->generateRandomString();
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

		$a['peraturan'] = $this->db->query("SELECT * FROM tbl_master_peraturan WHERE status_aktif='1' AND jenis_peraturan = 'Permohonan Tunjangan Keluarga'")->result();
		$a['Data'] = $Data;
		$a['Tunjangan_id'] = $Tunjangan_id;

		$a['func_table'] = $this->load->library('func_table');

		// $this->load->view('dashboard_publik/tunjangan/data_tunjangan/form_tunjangan_add', $a);
		$this->load->view('dashboard_publik/template/kertas_kerja/tunjangan_keluarga/data_tunjangan/form_tunjangan_add', $a);
	}

	// table pilihan
	function table_data_item_pilihan()
	{
		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');
		$Tunjangan_id = $this->input->post('Tunjangan_id');

		$listing 		= $this->tunjangan->listing_pilihan($Tunjangan_id);
		$jumlah_filter 	= $this->tunjangan->jumlah_filter_pilihan($Tunjangan_id);
		$jumlah_semua 	= $this->tunjangan->jumlah_semua_pilihan($Tunjangan_id);

		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			$no++;
			$row = array();
			$button = '
				<a type="button" class="btn btn-danger btn-xs" onclick="delete_tunjangan_temp_item(' . "'" . $key->Id . "'" . ')"><i class="fa fa-trash"></i></a>
				';
			$row[] = $button;
			$row[] = $key->nama_anggota_keluarga;
			$row[] = $key->tempat_lahir;
			$row[] = str_replace(' ', '&nbsp;', $key->tanggal_lahir_keluarga);
			$row[] = str_replace(' ', '&nbsp;', $key->tanggal_nikah);
			$row[] = $key->pekerjaan_sekolah;
			$row[] = $key->uraian;
			$row[] = '&check;';

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
	// end table pilihan

	// get item
	function get_item()
	{
		$a['id_pegawai'] = $this->input->post('Id');
		$a['Tunjangan_id'] = $this->input->post('Tunjangan_id');
		//$this->load->view('dashboard_publik/homes/group_pribadi/keluarga/index_keluarga');
		//$this->load->view('dashboard_publik/home/keluarga');

		// $this->load->view('dashboard_publik/tunjangan/data_tunjangan/get_item/ajax_item', $a);
		$this->load->view('dashboard_publik/template/kertas_kerja/tunjangan_keluarga/data_tunjangan/get_item/ajax_item', $a);
	}

	function table_data_item()
	{
		$id_pegawai = $this->input->post('id_pegawai');
		$Tunjangan_id = $this->input->post('Tunjangan_id');

		$listing 		= $this->tunjangan->listing_item($id_pegawai, $Tunjangan_id);
		$jumlah_filter 	= $this->tunjangan->jumlah_filter_item($id_pegawai, $Tunjangan_id);
		$jumlah_semua 	= $this->tunjangan->jumlah_semua_item($id_pegawai, $Tunjangan_id);

		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			$no++;
			$row = array();
			$button = '<button class="btn btn-info btn-sm btn-flat" onclick="usulkan_data(' . "'" . $key->id_data_keluarga . "'" . ')"> <i class="fa fa-undo"></i></button>';

			$row[] = $key->id_data_keluarga;
			$row[] = $key->nama_anggota_keluarga;
			$row[] = $key->keterangan;
			$row[] = $key->jenis_kelamin; //1 laki-laki 2 perempuan
			$row[] = str_replace(' ', '&nbsp;', $key->tanggal_lahir_keluarga);
			$row[] = $key->uraian;
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
		$Tunjangan_id = $this->input->post('Tunjangan_id');
		$string = $this->input->post('string');
		$tgl_create = date('Y-m-d H:i:s');
		$tgl_update = date('Y-m-d H:i:s');

		$arr_item = explode('||', $string);

		foreach ($arr_item as $val) {
			// copy
			$this->db->query("INSERT INTO 
			tr_tunjangan_komponen_temp(Tunjangan_id,Keluarga_id,Nama_anggota,Tempat_lahir,Tanggal_lahir,Tanggal_nikah,Pekerjaan_sekolah,Keterangan,Created_at) 
			SELECT 
			'$Tunjangan_id',id_data_keluarga,nama_anggota_keluarga,tempat_lahir,tanggal_lahir_keluarga,tanggal_nikah,pekerjaan_sekolah,uraian,'$tgl_create'
			FROM tbl_data_keluarga WHERE id_data_keluarga = '$val'");
		}

		$jumlah = count($arr_item);

		echo "$jumlah Item telah masuk ke Susunan Keluarga Penerima Tunjangan";
	}

	function delete_tunjangan_temp_item()
	{
		$Id = $this->input->post('Id');
		$del_temp = $this->db->query("DELETE FROM tr_tunjangan_komponen_temp WHERE Id = '$Id'");
		if ($del_temp) {
			echo 'Berhasil Anggota Keluarga Dikembalikan';
		} else {
			echo 'Gagal Anggota Keluarga Dikembalikan';
		}
	}

	// end get litem

	// simpan bos
	function simpan_tambah_tunjangan()
	{
		// === begin: cek tambah data keluarga ===
		if ($this->is_exist_keluarga($this->input->post('Tunjangan_id')) == 0) {
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
		$Tunjangan_id 		= $this->input->post('Tunjangan_id');
		$Digaji_menurut 	= $this->input->post('Digaji_menurut');
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




		$data['id_pegawai'] 			= $id_pegawai;
		$data['lokasi_kerja_pegawai'] 	= $lokasi_kerja_pegawai;
		$data['is_dinas'] 				= $is_dinas;
		$data['Tunjangan_id'] 			= $Tunjangan_id;
		$data['Digaji_menurut'] 		= $Digaji_menurut;
		$data['Status_progress'] 		= $Status_progress;
		$data['Created_by'] 			= $Created_by;
		$data['Created_at'] 			= $Date_now;
		$data['Updated_by'] 			= $Updated_by;
		$data['Updated_at'] 			= $Date_now;

		$in_tunjangan = $this->db->insert('tr_tunjangan', $data);
		if ($in_tunjangan) {
			$data_triger['Act'] 			= $Act;
			$data_triger['Tunjangan_id'] 	= $Tunjangan_id;
			$data_triger['Status_progress'] = $Status_progress;
			$data_triger['Notes'] 			= $Notes;
			$data_triger['User_created'] 	= $Updated_by;
			$data_triger['Created_at'] 		= $Date_now;
			$Q_insert = $this->db->insert('tr_triger_tunjangan', $data_triger);
			// $Query_Getid = $this->db->query("SELECT MAX(id_srt) as id FROM tbl_data_srt_ket")->row();
			// $last_id = $Query_Getid->id;
			$see = $this->func_table->in_tosee_tj($Created_by, $Tunjangan_id, '0', $Created_by);
			#wa/email
			if ($Q_insert) {
				#wa/email to pegawai
				#wa/email to admin bersangkutan
				$send_notif_sk_pegawai 	= $this->func_wa_tunjangan->notif_tj_pegawai_tambah($Tunjangan_id);
			}
			#end wa/email
			echo 'Berhasil';
		} else {
			echo 'Gagal';
		}
	}
	// end simpan

	function is_exist_keluarga($tunjangan_id)
	{
		$sSQL = "SELECT id FROM tr_tunjangan_komponen_temp WHERE tunjangan_id = '$tunjangan_id'";
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
			if ($data->nrk == '') {
				$pesan .= "- <b>NRK</b><br>";
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
			if ($data->nama_status == '') {
				$pesan .= "- <b>Status Kepegawaian</b><br>";
				$is_dirty = 1;
			}
			if ($is_dirty == 1) {
				$pesan_all = $pesan;
			}

			// === query data keluarga ===
			$tunjangan_id =  $this->input->post('Tunjangan_id');
			$sSQL = "SELECT
						a.Id, 
						a.Tunjangan_id, 
						a.Keluarga_id, 
						b.nama_anggota_keluarga,
						b.tempat_lahir,
						b.tanggal_lahir_keluarga,
						b.tanggal_nikah,
						b.nik,
						b.uraian,
						a.Created_at
					FROM
						tr_tunjangan_komponen_temp AS a
						
					LEFT JOIN (
						SELECT id_data_keluarga,nama_anggota_keluarga,tempat_lahir,tanggal_lahir_keluarga,tanggal_nikah,nik,uraian
						FROM tbl_data_keluarga
					) AS b ON b.id_data_keluarga = a.Keluarga_id
						WHERE a.Id != '' AND a.Tunjangan_id = '$tunjangan_id'";
			$rsSQL = $this->db->query($sSQL);



			// === DATA KELUARGA ===
			if (isset($rsSQL)) {
				$is_dirty_kel = 0;
				$is_dirty_kel_all = 0;
				$pesan_kel = '';
				$pesan_kel_all = '';

				foreach ($rsSQL->result() as $data) {
					// === cek hubungan keluarga ===
					$sSQL = "SELECT hub_keluarga FROM tbl_data_keluarga WHERE id_data_keluarga = '$data->Keluarga_id'";
					$hub_kel = $this->db->query($sSQL)->row()->hub_keluarga;

					$pesan_kel = 'Lengkapi data keluarga untuk:<br><b style="color: red">' . $data->nama_anggota_keluarga . '</b> pada field:<br>';

					if ($data->nama_anggota_keluarga == '') {
						$pesan_kel .= "- <b>Nama Anggota Keluarga</b><br>";
						$is_dirty_kel = 1;
					}
					if ($data->tempat_lahir == '') {
						$pesan_kel .= "- <b>Tempat Lahir</b><br>";
						$is_dirty_kel = 1;
					}
					if ($data->tanggal_lahir_keluarga == '') {
						$pesan_kel .= "- <b>Tanggal Lahir</b><br>";
						$is_dirty_kel = 1;
					}
					if ($hub_kel == 1) {
						if ($data->tanggal_nikah == '') {
							$pesan_kel .= "- <b>Tanggal Nikah</b><br>";
							$is_dirty_kel = 1;
						}
					}
					if ($data->nik == '') {
						$pesan_kel .= "- <b>NIK</b><br>";
						$is_dirty_kel = 1;
					}
					if ($hub_kel == 0) {
						if ($data->uraian == '') {
							$pesan_kel .= "- <b>Keterangan</b><br>";
							$is_dirty_kel = 1;
						}
					}

					if ($is_dirty_kel == 1) {
						$pesan_kel_all .= '<br>' . $pesan_kel;
						$is_dirty_kel_all = 1;
					}
					$is_dirty_kel = 0;
				}
			}

			if ($is_dirty == 1 or $is_dirty_kel_all == 1) {
				return '0|' . $pesan_all . $pesan_kel_all;
				exit;
			}

			return '1';
		}
	}


	// edit tunjangan
	function edit_tunjangan()
	{
		$Tunjangan_id = $this->input->post('Tunjangan_id');

		// delete dulu yang di temp 
		$delete_temp = $this->db->query("DELETE FROM tr_tunjangan_komponen_temp WHERE Tunjangan_id = '$Tunjangan_id'");
		if ($delete_temp) {
			// isert temp dari real
			$this->db->query("INSERT INTO tr_tunjangan_komponen_temp (
									tr_tunjangan_komponen_temp.Tunjangan_id, 
									tr_tunjangan_komponen_temp.Keluarga_id, 
									tr_tunjangan_komponen_temp.Nama_anggota, 
									tr_tunjangan_komponen_temp.Tempat_lahir, 
									tr_tunjangan_komponen_temp.Tanggal_lahir, 
									tr_tunjangan_komponen_temp.Tanggal_nikah, 
									tr_tunjangan_komponen_temp.Pekerjaan_sekolah, 
									tr_tunjangan_komponen_temp.Keterangan, 
									tr_tunjangan_komponen_temp.Created_at
								)
								SELECT
									tr_tunjangan_komponen.Tunjangan_id, 
									tr_tunjangan_komponen.Keluarga_id, 
									tr_tunjangan_komponen.Nama_anggota, 
									tr_tunjangan_komponen.Tempat_lahir, 
									tr_tunjangan_komponen.Tanggal_lahir, 
									tr_tunjangan_komponen.Tanggal_nikah, 
									tr_tunjangan_komponen.Pekerjaan_sekolah, 
									tr_tunjangan_komponen.Keterangan, 
									tr_tunjangan_komponen.Created_at
								FROM
									tr_tunjangan_komponen
								WHERE tr_tunjangan_komponen.Tunjangan_id = '$Tunjangan_id'");
		}
		$Data_tunjangan = $this->db->query("SELECT * FROM tr_tunjangan WHERE Tunjangan_id='$Tunjangan_id'")->row();
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
									WHERE id_pegawai = '$Data_tunjangan->id_pegawai'")->row();

		//$Data_tunjangan_komponen = $this->db->query("SELECT * FROM tr_tunjangan_komponen WHERE Tunjangan_id='$Tunjangan_id'")->result();

		$a['peraturan'] = $this->db->query("SELECT * FROM tbl_master_peraturan WHERE status_aktif='1' AND jenis_peraturan = 'Permohonan Tunjangan Keluarga'")->result();
		$a['Data'] = $Data;
		$a['Data_tunjangan'] = $Data_tunjangan;
		$a['Tunjangan_id'] = $Tunjangan_id;
		$a['func_table'] = $this->load->library('func_table');

		// $this->load->view('dashboard_publik/tunjangan/data_tunjangan/form_tunjangan_update', $a);
		$this->load->view('dashboard_publik/template/kertas_kerja/tunjangan_keluarga/data_tunjangan/form_tunjangan_update', $a);
	}

	function simpan_update_tunjangan()
	{
		// === begin: cek tambah data keluarga ===
		if ($this->is_exist_keluarga($this->input->post('Tunjangan_id')) == 0) {
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

		$Tunjangan_id 		= $this->input->post('Tunjangan_id');
		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '1';
		$Digaji_menurut 	= $this->input->post('Digaji_menurut');
		$Date_now 			= date('Y-m-d H:i:s');

		$data['Digaji_menurut'] 		= $Digaji_menurut;
		$data['Updated_by'] 			= $Updated_by;
		$data['Updated_at'] 			= $Date_now;

		$this->db->where('Tunjangan_id', $Tunjangan_id);
		$in_tunjangan = $this->db->update('tr_tunjangan', $data);

		//$in_tunjangan = $this->db->insert('tr_tunjangan', $data);
		if ($in_tunjangan) {
			$data_triger['Act'] 			= $Act;
			$data_triger['Tunjangan_id'] 	= $Tunjangan_id;
			$data_triger['User_created'] 	= $Updated_by;
			$data_triger['Created_at'] 		= $Date_now;
			$this->db->insert('tr_triger_tunjangan', $data_triger);
			echo 'Berhasil';
		} else {
			echo 'Gagal';
		}
	}
	// end edit tunjangan

	function delete_tunjangan()
	{
		$Tunjangan_id = $this->input->post('Tunjangan_id');
		$del = $this->db->query("DELETE FROM tr_tunjangan WHERE Tunjangan_id = '$Tunjangan_id'");
		$del_komp = $this->db->query("DELETE FROM tr_tunjangan_komponen WHERE Tunjangan_id = '$Tunjangan_id'");
		$del_temp = $this->db->query("DELETE FROM tr_tunjangan_komponen_temp WHERE Tunjangan_id = '$Tunjangan_id'");
		if ($del) {
			echo 'Berhasil Hapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	// view tunjangan
	function view_tunjangan()
	{
		$Tunjangan_id = $this->input->post('Tunjangan_id');
		$username 	= $this->session->userdata('username');
		// delete dulu yang di temp 
		$delete_temp = $this->db->query("DELETE FROM tr_tunjangan_komponen_temp WHERE Tunjangan_id = '$Tunjangan_id'");
		if ($delete_temp) {
			// isert temp dari real
			$this->db->query("INSERT INTO tr_tunjangan_komponen_temp (
									tr_tunjangan_komponen_temp.Tunjangan_id, 
									tr_tunjangan_komponen_temp.Keluarga_id, 
									tr_tunjangan_komponen_temp.Nama_anggota, 
									tr_tunjangan_komponen_temp.Tempat_lahir, 
									tr_tunjangan_komponen_temp.Tanggal_lahir, 
									tr_tunjangan_komponen_temp.Tanggal_nikah, 
									tr_tunjangan_komponen_temp.Pekerjaan_sekolah, 
									tr_tunjangan_komponen_temp.Keterangan, 
									tr_tunjangan_komponen_temp.Created_at
								)
								SELECT
									tr_tunjangan_komponen.Tunjangan_id, 
									tr_tunjangan_komponen.Keluarga_id, 
									tr_tunjangan_komponen.Nama_anggota, 
									tr_tunjangan_komponen.Tempat_lahir, 
									tr_tunjangan_komponen.Tanggal_lahir, 
									tr_tunjangan_komponen.Tanggal_nikah, 
									tr_tunjangan_komponen.Pekerjaan_sekolah, 
									tr_tunjangan_komponen.Keterangan, 
									tr_tunjangan_komponen.Created_at
								FROM
									tr_tunjangan_komponen
								WHERE tr_tunjangan_komponen.Tunjangan_id = '$Tunjangan_id'");
		}
		$Data_tunjangan = $this->db->query("SELECT * FROM tr_tunjangan WHERE Tunjangan_id='$Tunjangan_id'")->row();
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
									WHERE id_pegawai = '$Data_tunjangan->id_pegawai'")->row();

		//$Data_tunjangan_komponen = $this->db->query("SELECT * FROM tr_tunjangan_komponen WHERE Tunjangan_id='$Tunjangan_id'")->result();

		$a['peraturan'] = $this->db->query("SELECT * FROM tbl_master_peraturan WHERE status_aktif='1' AND jenis_peraturan = 'Permohonan Tunjangan Keluarga'")->result();
		$a['Data'] = $Data;
		$a['Data_tunjangan'] = $Data_tunjangan;
		$a['Tunjangan_id'] = $Tunjangan_id;
		$a['func_table'] = $this->load->library('func_table');
		$see = $this->func_table->in_tosee_tj($Data_tunjangan->Created_by, $Tunjangan_id, $Data_tunjangan->Status_progress, $username);

		// ===== surat tunjangan history =====
		$sSQL = "SELECT
					his.tunjangan_id,
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
					tr_tunjangan_track his
					join tr_tunjangan surat on surat.tunjangan_id = his.tunjangan_id
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.tunjangan_id = '$Tunjangan_id' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);

		$a['data_history'] = $rsSQL;
		// ===== /surat tunjangan history =====

		// $this->load->view('dashboard_publik/tunjangan/data_tunjangan/view_tunjangan', $a);
		$this->load->view('dashboard_publik/template/kertas_kerja/tunjangan_keluarga/data_tunjangan/view_tunjangan', $a);
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

	public function notify_tj()
	{
		$count_see_kaku		= $this->func_table->count_see_kaku($this->session->userdata('username'));
		$count_see_tj 		= $this->func_table->count_see_tj($this->session->userdata('username'));
		$count_see 			= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
		$total = $count_see + $count_see_tj + $count_see_kaku;

		if ($count_see_tj > 0) {
			$res_count_see_tj = '<span class="badge btn-warning btn-flat">' . $count_see_tj . '</span>';
		} else {
			$res_count_see_tj = '';
		}

		if ($total > 0) {
			$res_total = '<span class="badge btn-warning btn-flat">' . $total . '</span>';
		} else {
			$res_total = '';
		}

		$result = [
			'tunjangan' => $res_count_see_tj,
			'ttl_kertas_kerja' => $res_total
		];

		echo json_encode($result);
	}

	function show_timeline()
	{
		// ===== surat tunjangan history =====
		$tunjangan_id = $this->input->post('tunjangan_id');

		$sSQL = "SELECT
					his.tunjangan_id,
					his.user_created, surat.is_dinas,
					if ( isnull( log.nama_lengkap ), '-', log.nama_lengkap ) nama_pegawai,
					his.created_at,
					stat.id_status, stat.nama_status, stat.style,
					surat.notes as keterangan_ditolak,
					if ( isnull( lok.dinas ), '-', lok.dinas ) dinas,
					if ( isnull( peg.lokasi_kerja ), '-', peg.lokasi_kerja ) lokasi_kerja_id,
					if ( isnull( lok.lokasi_kerja ), '-', lok.lokasi_kerja ) lokasi_kerja_desc 
				from
					tr_tunjangan_track his
					join tr_tunjangan surat on surat.tunjangan_id = his.tunjangan_id
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.tunjangan_id = '$tunjangan_id' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);
		$a['data_history'] = $rsSQL;

		// $this->load->view('dashboard_publik/tunjangan/data_tunjangan/timeline', $a);

		// $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline', $a);
		$this->load->view('dashboard_publik/template/timeline/timeline', $a);
	}
}
