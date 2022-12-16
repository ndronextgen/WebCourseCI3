<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Publik extends CI_Controller
{

	/*
		***	Controller : dashboard_publik.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_model');
		$this->load->model('srt_ket_model');
		$this->load->model('riwayat_jabatan_model');
		$this->load->model('history_srt_ket_model');
		$this->load->library('func_table');
		$this->load->library('func_wa_sk');
		$this->load->helper(array('url', 'download'));
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

			// see
			$count_see 					= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj 				= $this->func_table->count_see_tj($this->session->userdata('username'));
			$count_see_kaku				= $this->func_table->count_see_kaku($this->session->userdata('username'));
			$count_see_verifikasi 		= $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
			$count_see_verifikasi_tj 	= $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
			$count_see_verifikasi_kaku	= $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));

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
				$d['gelar'] = $data->gelar;
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

			$d['st'] = "edit";
			$d['lamp_sk'] = $this->db->get_where("tbl_lampiran_sk");
			$d['lamp_pribadi'] = $this->db->get_where("tbl_lampiran_pribadi");
			$d['lamp_pendidikan'] = $this->db->get_where("tbl_lampiran_pendidikan");
			$d['lamp_skp'] = $this->db->get_where("tbl_lampiran_skp");
			$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
			$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
			$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
			$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
			$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
			//$d['mst_stts_jabatan'] = $this->db->get('tbl_master_status_jabatan');
			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$d['mst_bidang'] = $this->db->get('tbl_master_bidang');
			$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			$d['mst_sub_lokasi_kerja'] = $this->db->get('tbl_master_sub_lokasi_kerja');
			$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
			$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
			$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
			$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
			$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
			$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
			$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));

			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$x['status_jabatan'] = $this->riwayat_jabatan_model->status_jabatan();
			$x['nama_jabatan'] = $this->riwayat_jabatan_model->nama_jabatann();
			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');
			//$x['jabatan'] = $this->db->get('tbl_data_riwayat_jabatan');

			$this->load->helper('url');

			// see
			$d['count_see'] 				= $count_see;
			$d['count_see_tj'] 				= $count_see_tj;
			$d['count_see_kaku'] 			= $count_see_kaku;
			$d['count_see_verifikasi'] 		= $count_see_verifikasi;
			$d['count_see_verifikasi_tj'] 	= $count_see_verifikasi_tj;
			$d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;

			$x['count_see'] = $count_see;

			$this->load->view('dashboard_publik/homes/index_home', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	// ---------------------------------------------------------------------------------------------------------------------------------------------
	// ----------------- data pegawai -------------
	public function data_pegawai()
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

			// see
			$count_see 					= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj 				= $this->func_table->count_see_tj($this->session->userdata('username'));
			$count_see_kaku				= $this->func_table->count_see_kaku($this->session->userdata('username'));
			$count_see_verifikasi 		= $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
			$count_see_verifikasi_tj 	= $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
			$count_see_verifikasi_kaku	= $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));

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
				$d['gelar'] = $data->gelar;
				$d['status_pegawai'] = $data->status_pegawai;
				$d['id_jabatan'] = $data->id_jabatan;
				$d['id_bidang'] = $data->id_bidang;
				$d['lokasi_kerja'] = $data->lokasi_kerja;
				$d['sublokasi_kerja'] = $data->sublokasi_kerja;
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

				// --
				//for initiate checklist copy from domisili to ktp
				$checked = '';
				$onchangeProvKtp = '';
				$onchangeKabKtp = '';
				$onchangeKecKtp = '';
				$onchangeKelKtp = '';

				if ($data->is_check == 1) {
					$checked = 'checked';
					$onchangeProvKtp = 'disabled="disabled"';
					$onchangeKabKtp = 'disabled="disabled"';
					$onchangeKecKtp = 'disabled="disabled"';
					$onchangeKelKtp = 'disabled="disabled"';
				} else {
					$onchangeProvKtp = 'onchange="changeProvinsiKtp(this.value)"';
					$onchangeKabKtp = 'onchange="changeKabupatenKtp(this.value)"';
					$onchangeKecKtp = 'onchange="changeKecamatanKtp(this.value)"';
					$onchangeKelKtp = 'onchange="changeKelurahanKtp(this.value)"';
				}

				$d['is_check'] = $checked;
				$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
				$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
				$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
				$d['onchangeKelurahanKtp'] = $onchangeKelKtp;

				$showRumpun = '';
				if ($d['id_status_jabatan'] == 6) {
					//bukan struktural, tampilkan pilihan rumpun jabatan
					$showRumpun = '';
				} else {
					$showRumpun = 'style="display:none;"';
				}
				$d['show_rumpun_jabatan'] = $showRumpun;

				$showNamaJabatan = '';
				if ($d['id_status_jabatan'] == 9) {
					//status jabatan = '-', maka hide pilihan nama jabatan
					$showNamaJabatan = 'style="display:none;"';
				}
				$d['show_nama_jabatan'] = $showNamaJabatan;

				$d['id_rumpun_jabatan'] = $data->id_rumpun_jabatan;
				// --
			}

			$d['st'] = "edit";
			$Query_lokasi_kerja = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja WHERE sublokasi  = '0' ORDER BY lokasi_kerja ASC")->result();
			$Query_sublokasi_kerja = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja WHERE sublokasi  = '1'")->result();
			$d['lamp_sk'] = $this->db->get_where("tbl_lampiran_sk");
			$d['lamp_pribadi'] = $this->db->get_where("tbl_lampiran_pribadi");
			$d['lamp_pendidikan'] = $this->db->get_where("tbl_lampiran_pendidikan");
			$d['lamp_skp'] = $this->db->get_where("tbl_lampiran_skp");
			$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
			$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
			$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
			$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
			$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
			//$d['mst_stts_jabatan'] = $this->db->get('tbl_master_status_jabatan');
			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$d['mst_bidang'] = $this->db->get('tbl_master_bidang');
			$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			$d['mst_sub_lokasi_kerja'] = $this->db->get('tbl_master_sub_lokasi_kerja');
			$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
			$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
			$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
			$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
			$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
			$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
			$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));

			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$x['status_jabatan'] = $this->riwayat_jabatan_model->status_jabatan();
			$x['nama_jabatan'] = $this->riwayat_jabatan_model->nama_jabatann();
			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			//$x['jabatan'] = $this->db->get('tbl_data_riwayat_jabatan');
			$d['mst_rumpun_jabatan'] = $this->db->get('tbl_master_rumpun_jabatan');

			$d['master_lokasi_kerja'] 		= $Query_lokasi_kerja;
			$d['master_sublokasi_kerja'] 	= $Query_sublokasi_kerja;

			$this->load->helper('url');

			// see
			$d['count_see'] 				= $count_see;
			$d['count_see_tj']				= $count_see_tj;
			$d['count_see_kaku'] 			= $count_see_kaku;
			$d['count_see_verifikasi'] 		= $count_see_verifikasi;
			$d['count_see_verifikasi_tj'] 	= $count_see_verifikasi_tj;
			$d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;

			$x['count_see'] = $count_see;

			$this->load->view('dashboard_publik/homes/data_pegawai/index_data_pegawai', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function edit_pegawai()
	{

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$q = $this->db->get_where("tbl_data_pegawai", $id);
			$set_detail = $q->row();
			$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

			foreach ($q->result() as $data) {
				$d['id_param'] = $data->id_pegawai;
				$d['nip'] = $data->nip;
				$d['nrk'] = $data->nrk;
				$d['email'] = $data->email;
				$d['telepon'] = $data->telepon;
				$d['nama_pegawai'] = $data->nama_pegawai;
				$d['gelar'] = $data->gelar;
				$d['status_pegawai'] = $data->status_pegawai;
				$d['id_jabatan'] = $data->id_jabatan;
				$d['id_bidang'] = $data->id_bidang;
				$d['lokasi_kerja'] = $data->lokasi_kerja;
				$d['sublokasi_kerja'] = $data->sublokasi_kerja;
				$d['seksi'] = $data->seksi;
				$d['masa_kerja'] = $data->masa_kerja;
				$d['usia'] =  $data->usia;
				$d['jenis_kelamin'] = $data->jenis_kelamin;
				$d['tempat_lahir'] =  $data->tempat_lahir;
				$d['tanggal_lahir'] = $data->tanggal_lahir;
				$d['agama'] = $data->agama;
				$d['status_nikah'] = $data->status_nikah;
				$d['kode_kelurahan'] = $data->kode_kelurahan;
				$d['nama_kelurahan'] = $data->nama_kelurahan;
				$d['kode_kecamatan'] = $data->kode_kecamatan;
				$d['nama_kecamatan'] = $data->nama_kecamatan;
				$d['kode_kabupaten'] = $data->kode_kabupaten;
				$d['nama_kabupaten'] = $data->nama_kabupaten;
				$d['kode_provinsi'] = $data->kode_provinsi;
				$d['nama_provinsi'] = $data->nama_provinsi;
				$d['alamat_pegawai'] =  $data->alamat;
				$d['kode_kelurahan_ktp'] = $data->kode_kelurahan_ktp;
				$d['nama_kelurahan_ktp'] = $data->nama_kelurahan_ktp;
				$d['kode_kecamatan_ktp'] = $data->kode_kecamatan_ktp;
				$d['nama_kecamatan_ktp'] = $data->nama_kecamatan_ktp;
				$d['kode_kabupaten_ktp'] = $data->kode_kabupaten_ktp;
				$d['nama_kabupaten_ktp'] = $data->nama_kabupaten_ktp;
				$d['kode_provinsi_ktp'] = $data->kode_provinsi_ktp;
				$d['nama_provinsi_ktp'] = $data->nama_provinsi_ktp;
				$d['alamat_ktp'] =  $data->alamat_ktp;
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
				$d['signature'] = $data->signature;
				$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
				$d['id_satuan_kerja'] = $data->id_satuan_kerja;
				$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
				$d['tmt_eselon'] = $data->tmt_eselon;

				//for initiate checklist copy from domisili to ktp
				$checked = '';
				$onchangeProvKtp = '';
				$onchangeKabKtp = '';
				$onchangeKecKtp = '';
				$onchangeKelKtp = '';

				if ($data->is_check == 1) {
					$checked = 'checked';
					$onchangeProvKtp = 'disabled="disabled"';
					$onchangeKabKtp = 'disabled="disabled"';
					$onchangeKecKtp = 'disabled="disabled"';
					$onchangeKelKtp = 'disabled="disabled"';
				} else {
					$onchangeProvKtp = 'onchange="changeProvinsiKtp(this.value)"';
					$onchangeKabKtp = 'onchange="changeKabupatenKtp(this.value)"';
					$onchangeKecKtp = 'onchange="changeKecamatanKtp(this.value)"';
					$onchangeKelKtp = 'onchange="changeKelurahanKtp(this.value)"';
				}

				$d['is_check'] = $checked;
				$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
				$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
				$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
				$d['onchangeKelurahanKtp'] = $onchangeKelKtp;

				$showRumpun = '';
				if ($d['id_status_jabatan'] == 6) {
					//bukan struktural, tampilkan pilihan rumpun jabatan
					$showRumpun = '';
				} else {
					$showRumpun = 'style="display:none;"';
				}
				$d['show_rumpun_jabatan'] = $showRumpun;

				$showNamaJabatan = '';
				if ($d['id_status_jabatan'] == 9) {
					//status jabatan = '-', maka hide pilihan nama jabatan
					$showNamaJabatan = 'style="display:none;"';
				}
				$d['show_nama_jabatan'] = $showNamaJabatan;

				$d['id_rumpun_jabatan'] = $data->id_rumpun_jabatan;
			}

			$d['st'] = "edit";
			$Query_lokasi_kerja = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja WHERE sublokasi  = '0' ORDER BY lokasi_kerja ASC")->result();
			$Query_sublokasi_kerja = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja WHERE sublokasi  = '1'")->result();
			$d['lamp_sk'] = $this->db->get_where("tbl_lampiran_sk");
			$d['lamp_pribadi'] = $this->db->get_where("tbl_lampiran_pribadi");
			$d['lamp_pendidikan'] = $this->db->get_where("tbl_lampiran_pendidikan");
			$d['lamp_skp'] = $this->db->get_where("tbl_lampiran_skp");
			$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
			$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
			$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
			$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
			$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
			//$d['mst_stts_jabatan'] = $this->db->get('tbl_master_status_jabatan');
			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$d['mst_bidang'] = $this->db->get('tbl_master_bidang');
			$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			if ($d['lokasi_kerja'] == '52') {
				$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['sublokasi_kerja']));
			} else {
				$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));
			}
			$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
			$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
			$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
			$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
			$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
			$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
			$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$x['status_jabatan'] = $this->riwayat_jabatan_model->status_jabatan();
			$x['nama_jabatan'] = $this->riwayat_jabatan_model->nama_jabatann();
			$d['mst_rumpun_jabatan'] = $this->db->get('tbl_master_rumpun_jabatan');
			$this->load->helper('url');
			$d['master_lokasi_kerja'] 		= $Query_lokasi_kerja;
			$d['master_sublokasi_kerja'] 	= $Query_sublokasi_kerja;

			//$this->load->view('dashboard_publik/home/edit',$d);
			$this->load->view('dashboard_publik/homes/data_pegawai/index_edit_pegawai', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}
	// data pegawai end
	public function data_hukuman()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			$this->load->view('dashboard_publik/homes/data_hukuman/index_data_hukuman', $d);
			$this->load->view('dashboard_publik/home/hukuman');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_skp()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$this->load->view('dashboard_publik/homes/group_skpdp3/data_skp/index_data_skp');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_dp3()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$this->load->view('dashboard_publik/homes/group_skpdp3/data_dp3/index_data_dp3');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_tubel()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			$this->load->view('dashboard_publik/homes/data_tubel/index_data_tubel', $d);
			$this->load->view('dashboard_publik/home/tubel');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_penghargaan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");

			$this->load->view('dashboard_publik/homes/data_penghargaan/index_data_penghargaan', $d);
			$this->load->view('dashboard_publik/home/penghargaan');
		} else {
			header('location:' . base_url() . '');
		}
	}
	// ----group pendidikan
	public function group_pendidikan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {

			$this->load->view('dashboard_publik/homes/group_pendidikan/index_group_pendidikan');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_formal()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");

			$this->load->view('dashboard_publik/homes/group_pendidikan/formal/index_formal', $d);
			$this->load->view('dashboard_publik/home/pendidikan');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_nonformal()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");

			$this->load->view('dashboard_publik/homes/group_pendidikan/nonformal/index_nonformal', $d);
			$this->load->view('dashboard_publik/home/pelatihan');
		} else {
			header('location:' . base_url() . '');
		}
	}
	// end group pendidikan


	// ----group SK
	public function group_sk_gubernur()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {

			$this->load->view('dashboard_publik/homes/group_sk_gubernur/index_group_sk_gubernur');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_pangkat()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
			$d['mst_golongan'] = $this->db->get('tbl_master_golongan');

			$this->load->view('dashboard_publik/homes/group_sk_gubernur/pangkat/index_pangkat', $d);
			$this->load->view('dashboard_publik/home/pangkat');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_jabatan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$d['status_jabatan'] = $this->riwayat_jabatan_model->status_jabatan();
			$d['nama_jabatan'] = $this->riwayat_jabatan_model->nama_jabatann();

			$this->load->view('dashboard_publik/homes/group_sk_gubernur/jabatan/index_jabatan', $d);
			$this->load->view('dashboard_publik/home/jabatan');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_sklainnya()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');

			$this->load->view('dashboard_publik/homes/group_sk_gubernur/sklainnya/index_sklainnya', $d);
			$this->load->view('dashboard_publik/home/arsip_sk');
		} else {
			header('location:' . base_url() . '');
		}
	}
	// end group SK

	// ----group pribadi
	public function group_pribadi()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {

			$this->load->view('dashboard_publik/homes/group_pribadi/index_group_pribadi');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_keluarga()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
			$d['mst_golongan'] = $this->db->get('tbl_master_golongan');

			$this->load->view('dashboard_publik/homes/group_pribadi/keluarga/index_keluarga', $d);
			$this->load->view('dashboard_publik/home/keluarga');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function data_lainnya()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');

			$this->load->view('dashboard_publik/homes/group_pribadi/lainnya/index_lainnya', $d);
			$this->load->view('dashboard_publik/home/arsip_pribadi');
		} else {
			header('location:' . base_url() . '');
		}
	}
	// end group SK

	// skp dp3

	public function group_skpdp3()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['data_skp'] = $this->db->get('tr_skp');

			$this->load->view('dashboard_publik/homes/group_skpdp3/index_group_skpdp3', $d);
			//$this->load->view('dashboard_publik/home/skp');
		} else {
			header('location:' . base_url() . '');
		}
	}

	// end skp dp3

	// ---------------------------------------------------------------------------------------------------------------------------------------------

	function nama_jabatan()
	{
		if ($this->input->post('id_status_jabatan')) {
			echo $this->jabatan_model->nama_jabatan($this->input->post('id_status_jabatan'));
		}
	}

	function nama_jabatan_new()
	{
		$data = '';
		$status_jabatan  = $this->input->post('status_jabatan');
		$eselon 		 = $this->input->post('eselon');
		//otomatis terisi untuk kepala dinas
		if ($eselon == '25' || $eselon == '26') {
			$id_nama_jabatan = '1';
		} else {
			$id_nama_jabatan = $this->input->post('id_nama_jabatan');
		}

		if ($status_jabatan == '2') { //struktural
			// if($eselon!=''){ //eselon ada
			// 	$Query_eselon = $this->db->query("SELECT level_jabatan FROM tbl_master_eselon WHERE id_eselon = '$eselon'")->row();
			// 	//tampilkan nama jabatan sesuai eselon dan status jabatan
			// 	$Query = $this->db->query("SELECT * FROM tbl_master_nama_jabatan 
			// 								WHERE level_jabatan = '$Query_eselon->level_jabatan' AND id_status_jabatan = '$status_jabatan'")->result();
			// } else {
			// 	$Query = $this->db->query("SELECT * FROM tbl_master_nama_jabatan 
			// 								WHERE id_status_jabatan = '$status_jabatan'")->result();
			//}

			$Query_eselon = $this->db->query("SELECT level_jabatan FROM tbl_master_eselon WHERE id_eselon = '$eselon'")->row();
			//tampilkan nama jabatan sesuai eselon dan status jabatan
			$Query = $this->db->query("SELECT * FROM tbl_master_nama_jabatan 
											WHERE level_jabatan = '$Query_eselon->level_jabatan' AND id_status_jabatan = '$status_jabatan'")->result();
		} else {
			$Query = $this->db->query("SELECT * FROM tbl_master_nama_jabatan 
											WHERE id_status_jabatan = '$status_jabatan'")->result();
		}

		$data .= "<option value=''>[ Pilih Nama Jabatan ]</option>";
		foreach ($Query as $key) {
			if ($key->id_nama_jabatan == $id_nama_jabatan) {
				$cek = " selected";
			} else {
				$cek = "";
			}
			$data .= "<option value='$key->id_nama_jabatan' $cek>$key->nama_jabatan</option>";
		}
		echo $data;
	}

	function nama_pangkat()
	{
		if ($this->input->post('id_golongan')) {
			echo $this->jabatan_model->nama_jabatan($this->input->post('id_golongan'));
		}
	}

	public function arsip_digital()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat_instansi'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

			$count_see 					= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj 				= $this->func_table->count_see_tj($this->session->userdata('username'));
			$count_see_kaku				= $this->func_table->count_see_kaku($this->session->userdata('username'));
			$count_see_verifikasi 		= $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
			$count_see_verifikasi_tj 	= $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
			$count_see_verifikasi_kaku	= $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));

			$status_verifikasi = $this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));
			if ($status_verifikasi == 'kepegawaian' || $status_verifikasi == 'sekdis' || $status_verifikasi == 'sudinupt') {
				$d['status_user'] = 'true';
			} else {
				$d['status_user'] = 'false';
			}

			if ($data_pegawai->num_rows() > 0) {
				$q = $this->db->get_where("tbl_data_pegawai", $id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

				foreach ($q->result() as $data) {
					$d['id_param'] = $data->id_pegawai;
					$d['nip'] = $data->nip;
					$d['nrk'] = $data->nrk;
					$d['email'] = $data->email;
					$d['telepon'] = $data->telepon;
					$d['nama_pegawai'] = $data->nama_pegawai;
					$d['gelar'] = $data->gelar;
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
					$d['alamat_pegawai'] =  $data->alamat;
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
					$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
					$d['id_satuan_kerja'] = $data->id_satuan_kerja;
					$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
					$d['tmt_eselon'] = $data->tmt_eselon;
				}

				$d['st'] = "edit";
				$d['lamp_sk'] = $this->db->get_where("tbl_lampiran_sk");
				$d['lamp_pribadi'] = $this->db->get_where("tbl_lampiran_pribadi");
				$d['lamp_pendidikan'] = $this->db->get_where("tbl_lampiran_pendidikan");
				$d['lamp_skp'] = $this->db->get_where("tbl_lampiran_skp");

				$this->load->helper('url');

				//see
				$d['count_see'] 				= $count_see;
				$d['count_see_tj'] 				= $count_see_tj;
				$d['count_see_kaku'] 			= $count_see_kaku;
				$d['count_see_verifikasi'] 		= $count_see_verifikasi;
				$d['count_see_verifikasi_tj'] 	= $count_see_verifikasi_tj;
				$d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;

				// $this->load->view('dashboard_publik/home/arsip_digital',$d);	
				// $this->load->view('dashboard_publik/home/arsip_sk');	
				// $this->load->view('dashboard_publik/home/arsip_pribadi');	
				// $this->load->view('dashboard_publik/home/arsip_pendidikan');
				// $this->load->view('dashboard_publik/home/arsip_skp');	
				// $this->load->view('dashboard_publik/home/arsip_pelatihan');
				$this->load->view('dashboard_publik/arsip_digital/index_arsip_digital', $d);
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	// -------------------
	public function arsip_pribadi()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			$this->load->view('dashboard_publik/arsip_digital/arsip_pribadi/index_arsip_pribadi', $d);
			$this->load->view('dashboard_publik/home/arsip_pribadi');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function arsip_sk()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			$this->load->view('dashboard_publik/arsip_digital/arsip_sk/index_arsip_sk', $d);
			$this->load->view('dashboard_publik/home/arsip_sk');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function arsip_pendidikan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			$this->load->view('dashboard_publik/arsip_digital/arsip_pendidikan/index_arsip_pendidikan', $d);
			$this->load->view('dashboard_publik/home/arsip_pendidikan');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function arsip_pelatihan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			$this->load->view('dashboard_publik/arsip_digital/arsip_pelatihan/index_arsip_pelatihan', $d);
			$this->load->view('dashboard_publik/home/arsip_pelatihan');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function arsip_skp()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			$this->load->view('dashboard_publik/arsip_digital/arsip_skp/index_arsip_skp', $d);
			$this->load->view('dashboard_publik/home/arsip_skp');
		} else {
			header('location:' . base_url() . '');
		}
	}
	// -------------------

	public function pengajuan_surat()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);
			//see
			$count_see = $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj = $this->func_table->count_see_tj($this->session->userdata('username'));
			if ($data_pegawai->num_rows() > 0) {
				$q = $this->db->get_where("tbl_data_pegawai", $id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

				foreach ($q->result() as $data) {
					$d['id_param'] = $data->id_pegawai;
					$d['nip'] = $data->nip;
					$d['nrk'] = $data->nrk;
					$d['email'] = $data->email;
					$d['telepon'] = $data->telepon;
					$d['nama_pegawai'] = $data->nama_pegawai;
					$d['gelar'] = $data->gelar;
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
					$d['alamat_pegawai'] =  $data->alamat;
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
					$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
					$d['id_satuan_kerja'] = $data->id_satuan_kerja;
					$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
					$d['tmt_eselon'] = $data->tmt_eselon;
				}

				$d['st'] = "edit";
				// $d['lamp_sk'] = $this->db->get_where("tbl_lampiran_sk");
				// $d['lamp_pribadi'] = $this->db->get_where("tbl_lampiran_pribadi");
				// $d['lamp_pendidikan'] = $this->db->get_where("tbl_lampiran_pendidikan");
				// $d['lamp_skp'] = $this->db->get_where("tbl_lampiran_skp");
				// $d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
				// $d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
				// $d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
				$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
				// $d['mst_golongan'] = $this->db->get('tbl_master_golongan');
				//$d['mst_stts_jabatan'] = $this->db->get('tbl_master_status_jabatan');
				//$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
				//$d['mst_bidang'] = $this->db->get('tbl_master_bidang');
				//$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
				//$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
				//$d['mst_kecamatan'] = $this->db->get('tbl_master_kecamatan');
				//$d['mst_kelurahan'] = $this->db->get('tbl_master_kelurahan');
				//$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
				$d['mst_jenis_pengajuan_surat'] = $this->srt_ket_model->jenis_pengajuan_surat();
				$x['status_jabatan'] = $this->riwayat_jabatan_model->status_jabatan();
				$x['nama_jabatan'] = $this->riwayat_jabatan_model->nama_jabatann();

				$this->load->helper('url');
				//see
				$d['count_see'] = $count_see;
				$d['count_see_tj'] = $count_see_tj;
				//$this->load->view('master/header3',$d);				
				$this->load->view('dashboard_publik/home/pengajuan_surat', $d);
				$this->load->view('dashboard_publik/home/arsip_sk');
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function ket_surat_ditolak()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {

			$id_surat = $this->input->post('idSurat');
			// $sSQL = "SELECT * FROM `tbl_data_srt_ket` WHERE id_srt = '$id_surat'";
			$sSQL = "SELECT srt.nama, srt.nip, srt.nrk, srt.alamat_domisili, 
						peg.nama_status, srt.jenis_pengajuan_surat, 
						srt.jenis_pengajuan_surat_lainnya, jen_srt.keterangan AS keterangan_jenis_surat, srt.keterangan_ditolak
					FROM `tbl_data_srt_ket` AS srt
					LEFT JOIN tbl_master_status_pegawai AS peg 
						ON peg.id_status_pegawai = srt.status_pegawai
					LEFT JOIN tbl_master_jenis_pengajuan_surat AS jen_srt
						ON jen_srt.kode = srt.jenis_pengajuan_surat
					WHERE srt.id_srt = '$id_surat'";
			$d['data_surat'] = $this->db->query($sSQL)->row();

			$this->load->view('dashboard_publik/home/pengajuan_surat_detail', $d);
		}
	}

	public function status_surat()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

			//see
			$count_see 					= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj 				= $this->func_table->count_see_tj($this->session->userdata('username'));
			$count_see_kaku				= $this->func_table->count_see_kaku($this->session->userdata('username'));
			$count_see_verifikasi 		= $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
			$count_see_verifikasi_tj 	= $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
			$count_see_verifikasi_kaku	= $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));

			$status_verifikasi = $this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));
			if ($status_verifikasi == 'kepegawaian' || $status_verifikasi == 'sekdis' || $status_verifikasi == 'sudinupt') {
				$d['status_user'] = 'true';
			} else {
				$d['status_user'] = 'false';
			}

			if ($data_pegawai->num_rows() > 0) {
				$q = $this->db->get_where("tbl_data_pegawai", $id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

				foreach ($q->result() as $data) {
					$d['id_param'] = $data->id_pegawai;
					$d['nip'] = $data->nip;
					$d['nrk'] = $data->nrk;
					$d['email'] = $data->email;
					$d['telepon'] = $data->telepon;
					$d['nama_pegawai'] = $data->nama_pegawai;
					$d['gelar'] = $data->gelar;
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
					$d['alamat_pegawai'] =  $data->alamat;
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
					$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
					$d['id_satuan_kerja'] = $data->id_satuan_kerja;
					$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
					$d['tmt_eselon'] = $data->tmt_eselon;
				}

				$d['st'] = "edit";

				$this->load->helper('url');

				//see
				$d['count_see'] 				= $count_see;
				$d['count_see_tj'] 				= $count_see_tj;
				$d['count_see_kaku'] 			= $count_see_kaku;
				$d['count_see_verifikasi'] 		= $count_see_verifikasi;
				$d['count_see_verifikasi_tj'] 	= $count_see_verifikasi_tj;
				$d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;

				//$this->load->view('master/header3',$d);				
				$this->load->view('dashboard_publik/home/status_surat', $d);
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function edit()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$q = $this->db->get_where("tbl_data_pegawai", $id);
			$set_detail = $q->row();
			$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

			foreach ($q->result() as $data) {
				$d['id_param'] = $data->id_pegawai;
				$d['nip'] = $data->nip;
				$d['nrk'] = $data->nrk;
				$d['email'] = $data->email;
				$d['telepon'] = $data->telepon;
				$d['nama_pegawai'] = $data->nama_pegawai;
				$d['gelar'] = $data->gelar;
				$d['status_pegawai'] = $data->status_pegawai;
				$d['id_jabatan'] = $data->id_jabatan;
				$d['id_bidang'] = $data->id_bidang;
				$d['lokasi_kerja'] = $data->lokasi_kerja;
				$d['sublokasi_kerja'] = $data->sublokasi_kerja;
				$d['seksi'] = $data->seksi;
				$d['masa_kerja'] = $data->masa_kerja;
				$d['usia'] =  $data->usia;
				$d['jenis_kelamin'] = $data->jenis_kelamin;
				$d['tempat_lahir'] =  $data->tempat_lahir;
				$d['tanggal_lahir'] = $data->tanggal_lahir;
				$d['agama'] = $data->agama;
				$d['status_nikah'] = $data->status_nikah;
				$d['kode_kelurahan'] = $data->kode_kelurahan;
				$d['nama_kelurahan'] = $data->nama_kelurahan;
				$d['kode_kecamatan'] = $data->kode_kecamatan;
				$d['nama_kecamatan'] = $data->nama_kecamatan;
				$d['kode_kabupaten'] = $data->kode_kabupaten;
				$d['nama_kabupaten'] = $data->nama_kabupaten;
				$d['kode_provinsi'] = $data->kode_provinsi;
				$d['nama_provinsi'] = $data->nama_provinsi;
				$d['alamat_pegawai'] =  $data->alamat;
				$d['kode_kelurahan_ktp'] = $data->kode_kelurahan_ktp;
				$d['nama_kelurahan_ktp'] = $data->nama_kelurahan_ktp;
				$d['kode_kecamatan_ktp'] = $data->kode_kecamatan_ktp;
				$d['nama_kecamatan_ktp'] = $data->nama_kecamatan_ktp;
				$d['kode_kabupaten_ktp'] = $data->kode_kabupaten_ktp;
				$d['nama_kabupaten_ktp'] = $data->nama_kabupaten_ktp;
				$d['kode_provinsi_ktp'] = $data->kode_provinsi_ktp;
				$d['nama_provinsi_ktp'] = $data->nama_provinsi_ktp;
				$d['alamat_ktp'] =  $data->alamat_ktp;
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
				$d['signature'] = $data->signature;
				$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
				$d['id_satuan_kerja'] = $data->id_satuan_kerja;
				$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
				$d['tmt_eselon'] = $data->tmt_eselon;

				//for initiate checklist copy from domisili to ktp
				$checked = '';
				$onchangeProvKtp = '';
				$onchangeKabKtp = '';
				$onchangeKecKtp = '';
				$onchangeKelKtp = '';

				if ($data->is_check == 1) {
					$checked = 'checked';
					$onchangeProvKtp = 'disabled="disabled"';
					$onchangeKabKtp = 'disabled="disabled"';
					$onchangeKecKtp = 'disabled="disabled"';
					$onchangeKelKtp = 'disabled="disabled"';
				} else {
					$onchangeProvKtp = 'onchange="changeProvinsiKtp(this.value)"';
					$onchangeKabKtp = 'onchange="changeKabupatenKtp(this.value)"';
					$onchangeKecKtp = 'onchange="changeKecamatanKtp(this.value)"';
					$onchangeKelKtp = 'onchange="changeKelurahanKtp(this.value)"';
				}

				$d['is_check'] = $checked;
				$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
				$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
				$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
				$d['onchangeKelurahanKtp'] = $onchangeKelKtp;

				$showRumpun = '';
				if ($d['id_status_jabatan'] == 6) {
					//bukan struktural, tampilkan pilihan rumpun jabatan
					$showRumpun = '';
				} else {
					$showRumpun = 'style="display:none;"';
				}
				$d['show_rumpun_jabatan'] = $showRumpun;

				$showNamaJabatan = '';
				if ($d['id_status_jabatan'] == 9) {
					//status jabatan = '-', maka hide pilihan nama jabatan
					$showNamaJabatan = 'style="display:none;"';
				}
				$d['show_nama_jabatan'] = $showNamaJabatan;

				$d['id_rumpun_jabatan'] = $data->id_rumpun_jabatan;
			}

			$d['st'] = "edit";
			$d['lamp_sk'] = $this->db->get_where("tbl_lampiran_sk");
			$d['lamp_pribadi'] = $this->db->get_where("tbl_lampiran_pribadi");
			$d['lamp_pendidikan'] = $this->db->get_where("tbl_lampiran_pendidikan");
			$d['lamp_skp'] = $this->db->get_where("tbl_lampiran_skp");
			$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
			$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
			$d['mst_penghargaan'] = $this->db->get("tbl_master_penghargaan");
			$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
			$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
			//$d['mst_stts_jabatan'] = $this->db->get('tbl_master_status_jabatan');
			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$d['mst_bidang'] = $this->db->get('tbl_master_bidang');
			$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			if ($d['lokasi_kerja'] == '52') {
				$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['sublokasi_kerja']));
			} else {
				$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));
			}
			$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
			$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
			$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
			$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
			$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
			$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
			$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$x['status_jabatan'] = $this->riwayat_jabatan_model->status_jabatan();
			$x['nama_jabatan'] = $this->riwayat_jabatan_model->nama_jabatann();
			$d['mst_rumpun_jabatan'] = $this->db->get('tbl_master_rumpun_jabatan');
			//$x['jabatan'] = $this->db->get('tbl_data_riwayat_jabatan');
			//echo '<pre>'.print_r($d,true).'</pre>';
			//echo '<pre>'.print_r($d['mst_kecamatan_ktp']->result_array(),true).'</pre>';exit;
			$this->load->helper('url');
			//$this->load->view('master/header2',$d);

			$this->load->view('dashboard_publik/home/edit', $d);
			$this->load->view('dashboard_publik/home/keluarga');
			$this->load->view('dashboard_publik/home/pangkat');
			$this->load->view('dashboard_publik/home/jabatan', $x);
			$this->load->view('dashboard_publik/home/pendidikan');
			$this->load->view('dashboard_publik/home/pelatihan');
			$this->load->view('dashboard_publik/home/penghargaan');
			$this->load->view('dashboard_publik/home/tubel');
			$this->load->view('dashboard_publik/home/skp');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function simpan_surat()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');

			// $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
			// begin: add by joe 2022.10.14
			$this->form_validation->set_rules('jenis_pengajuan_surat', 'jenis_pengajuan_surat', 'trim|required');
			if (strtolower($this->input->post('jenis_pengajuan_surat')) == 'x') {
				$this->form_validation->set_rules('jenis_pengajuan_surat_lainnya', 'jenis_pengajuan_surat_lainnya', 'trim|required');
			}
			// end: add by joe 2022.10.14

			$id = $this->input->post("id_param");
			// $data_pegawai = $this->db->get_where("tbl_data_pegawai", "id_pegawai='$id'");
			// $data_pegawai = $data_pegawai->row();
			$data_pegawai = $this->db->query("SELECT
												if(isnull(b.dinas),'1',b.dinas) as dinas, 
												a.id_pegawai, 
												a.nip, 
												a.nrk, 
												a.nama_pegawai, 
												a.email, 
												a.telepon, 
												a.alamat, 
												a.lokasi_kerja, 
												a.status_pegawai
											FROM
												tbl_data_pegawai AS a
											LEFT JOIN tbl_master_lokasi_kerja AS b ON a.lokasi_kerja = b.id_lokasi_kerja
											WHERE id_pegawai = '$id'")->row();
			//gen nomor surat
			$nomor_surat = $this->func_table->gen_nomor_surat($data_pegawai->lokasi_kerja);
			$Date_now = date("Y-m-d H:i:s");

			if ($this->form_validation->run() == '') {
				$st = $this->input->post('st');
				if ($st == "edit") {
					// begin: remark by joe 2022.10.14
					// $in['id_user'] = $id;
					// $in['nip'] = $this->input->post('nip');
					// $in['nrk'] = $this->input->post('nrk');
					// $in['nama'] = $this->input->post('nama_pegawai');
					// $in['status_pegawai'] = $this->input->post('status_pegawai');
					// $in['alamat_domisili'] = $this->input->post('alamat');
					// $in['keterangan'] = $this->input->post('keterangan');
					// $in['tgl_surat'] = date("Y-m-d H:i:s");
					// $in['jenis_surat'] = "1";
					// end: remark by joe 2022.10.14

					// begin: change by joe 2022.10.14
					// $this->session->set_flashdata('suksesedit', 'Data Berhasil Di Ubah...');
					// redirect(base_url() . 'dashboard_publik');
					$this->session->set_flashdata('gagaltambah', 'Gagal tambah pengajuan surat...');
					redirect(base_url() . 'dashboard_publik/status_surat');
					// end: change by joe 2022.10.14

					//header("location:".base_url()."pegawai/edit/".$this->session->userdata("kode_pegawai")."");
				}
			} else {
				$st = $this->input->post('st');
				if ($st == "edit") {
					$in['id_user'] = $id;
					// $in['nip'] = $this->input->post('nip');
					// $in['nrk'] = $this->input->post('nrk');
					// $in['nama'] = $this->input->post('nama_pegawai');
					// $in['status_pegawai'] = $this->input->post('status_pegawai');
					// $in['alamat_domisili'] = $this->input->post('alamat');
					$in['nip'] = $data_pegawai->nip;
					$in['nrk'] = $data_pegawai->nrk;
					$in['nama'] = $data_pegawai->nama_pegawai;
					$in['status_pegawai'] = $data_pegawai->status_pegawai;
					$in['alamat_domisili'] = $data_pegawai->alamat;
					$in['lokasi_kerja_pegawai'] = $data_pegawai->lokasi_kerja;
					$in['is_dinas'] = $data_pegawai->dinas;

					$in['jenis_pengajuan_surat'] = $this->input->post('jenis_pengajuan_surat');
					if (strtolower($in['jenis_pengajuan_surat']) == 'x') {
						$in['jenis_pengajuan_surat_lainnya'] = $this->input->post('jenis_pengajuan_surat_lainnya');
					} else {
						$in['jenis_pengajuan_surat_lainnya'] = null;
					}
					$in['keterangan'] = $this->input->post('keterangan');
					$in['tgl_surat'] = $Date_now;
					$in['id_status_srt'] = "0";
					$in['jenis_surat'] = "1";
					$in['nomor_surat'] = $nomor_surat;
					$in['Updated_at'] = $Date_now;
					$in['Created_at'] = $Date_now;

					$Q_insert = $this->db->insert("tbl_data_srt_ket", $in);

					$Query_Getid = $this->db->query("SELECT MAX(id_srt) as id FROM tbl_data_srt_ket")->row();
					$last_id = $Query_Getid->id;

					//insert to history
					$id_surat = $this->db->insert_id();
					$hist_srt['id_srt'] = $last_id;
					$hist_srt['id_user'] = $id;
					$hist_srt['created_at'] = date("Y-m-d H:i:s");
					$hist_srt['id_status_srt'] = 0;
					$hist_srt['created_by'] = $this->session->userdata("id_user");
					$this->db->insert('tbl_history_srt_ket', $hist_srt);

					$Query_Getid = $this->db->query("SELECT MAX(id_srt) as id FROM tbl_data_srt_ket")->row();
					$last_id = $Query_Getid->id;
					$see = $this->func_table->in_tosee_sk($id, $last_id, '0', $id);

					#wa/email
					if ($Q_insert) {
						#wa/email to pegawai
						#wa/email to admin bersangkutan
						$send_notif_sk_pegawai 	= $this->func_wa_sk->notif_sk_pegawai_tambah($nomor_surat);
					}
					#end wa/email

					$this->session->set_flashdata('suksestambah', 'Pengajuan surat anda berhasil...');
					redirect(base_url() . 'dashboard_publik/status_surat');
					//header("location:".base_url()."pegawai/edit/".$this->session->userdata("kode_pegawai")."");
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function simpan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');

			$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
			$this->form_validation->set_rules('nrk', 'NRK', 'trim|required');
			$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
			// $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			$id['id_pegawai'] = $this->input->post("id_param");

			// gagal validasi
			if ($this->form_validation->run() == FALSE) {
				$st = $this->input->post('st');
				if ($st == "edit") {
					$q = $this->db->get_where("tbl_data_pegawai", $id);
					foreach ($q->result() as $dt) {
						$d['id_param'] = $dt->id_pegawai;
						$d['nip'] = $dt->nip;
						$d['nrk'] = $dt->nrk;
						$d['email'] = $dt->email;
						$d['telepon'] = $dt->telepon;
						$d['nama_pegawai'] = $dt->nama_pegawai;
						$d['gelar'] = $dt->gelar;
						$d['status_pegawai'] = $dt->status_pegawai;
						$d['id_jabatan'] = $dt->id_jabatan;
						$d['id_bidang'] = $dt->id_bidang;
						$d['lokasi_kerja'] = $dt->lokasi_kerja;
						$d['seksi'] = $dt->seksi;
						$d['masa_kerja'] = $dt->masa_kerja;
						$d['usia'] =  $dt->usia;
						$d['jenis_kelamin'] = $dt->jenis_kelamin;
						$d['tempat_lahir'] =  $dt->tempat_lahir;
						$d['tanggal_lahir'] = $dt->tanggal_lahir;
						$d['agama'] = $dt->agama;
						$d['status_nikah'] = $dt->status_nikah;
						$d['kode_kelurahan'] = $dt->kode_kelurahan;
						$d['nama_kelurahan'] = $dt->nama_kelurahan;
						$d['kode_kecamatan'] = $dt->kode_kecamatan;
						$d['nama_kecamatan'] = $dt->nama_kecamatan;
						$d['kode_kabupaten'] = $dt->kode_kabupaten;
						$d['nama_kabupaten'] = $dt->nama_kabupaten;
						$d['kode_provinsi'] = $dt->kode_provinsi;
						$d['nama_provinsi'] = $dt->nama_provinsi;
						$d['alamat_pegawai'] =  $dt->alamat;
						$d['kode_kelurahan_ktp'] = $dt->kode_kelurahan_ktp;
						$d['nama_kelurahan_ktp'] = $dt->nama_kelurahan_ktp;
						$d['kode_kecamatan_ktp'] = $dt->kode_kecamatan_ktp;
						$d['nama_kecamatan_ktp'] = $dt->nama_kecamatan_ktp;
						$d['kode_kabupaten_ktp'] = $dt->kode_kabupaten_ktp;
						$d['nama_kabupaten_ktp'] = $dt->nama_kabupaten_ktp;
						$d['kode_provinsi_ktp'] = $dt->kode_provinsi_ktp;
						$d['nama_provinsi_ktp'] = $dt->nama_provinsi_ktp;
						$d['alamat_ktp'] =  $dt->alamat_ktp;
						$d['longitude'] =  $dt->longitude;
						$d['latitude'] =  $dt->latitude;
						$d['pendidikan'] = $dt->pendidikan;
						$d['pendidikan_bkd'] = $dt->pendidikan_bkd;
						$d['asal_sekolah'] = $dt->asal_sekolah;
						$d['tgl_lulus'] = $dt->tgl_lulus;
						$d['id_golongan'] = $dt->id_golongan;
						$d['id_eselon'] = $dt->id_eselon;
						$d['nomor_sk_pangkat'] = $dt->nomor_sk_pangkat;
						$d['tanggal_sk_pangkat'] = $dt->tanggal_sk_pangkat;
						$d['tanggal_mulai_pangkat'] = $dt->tanggal_mulai_pangkat;
						$d['tanggal_pengangkatan_cpns'] = $dt->tanggal_pengangkatan_cpns;
						$d['id_status_jabatan'] = $dt->id_status_jabatan;
						$d['status_pegawai_pangkat'] = $dt->status_pegawai_pangkat;
						$d['nomor_sk_jabatan'] = $dt->nomor_sk_jabatan;
						$d['tanggal_sk_jabatan'] = $dt->tanggal_sk_jabatan;
						$d['tanggal_mulai_jabatan'] = $dt->tanggal_mulai_jabatan;
						$d['foto'] = $dt->foto;
						$d['signature'] = $dt->signature;
						$d['tanggal_selesai_pangkat'] = $dt->tanggal_selesai_pangkat;
						$d['id_satuan_kerja'] = $dt->id_satuan_kerja;
						$d['tanggal_selesai_jabatan'] = $dt->tanggal_selesai_jabatan;
						$d['tmt_eselon'] = $dt->tmt_eselon;

						//for initiate checklist copy from domisili to ktp
						$checked = '';
						$onchangeProvKtp = '';
						$onchangeKabKtp = '';
						$onchangeKecKtp = '';
						$onchangeKelKtp = '';

						if ($dt->is_check == 1) {
							$checked = 'checked';
							$onchangeProvKtp = 'disabled="disabled"';
							$onchangeKabKtp = 'disabled="disabled"';
							$onchangeKecKtp = 'disabled="disabled"';
							$onchangeKelKtp = 'disabled="disabled"';
						} else {
							$onchangeProvKtp = 'onchange="changeProvinsiKtp(this.value)"';
							$onchangeKabKtp = 'onchange="changeKabupatenKtp(this.value)"';
							$onchangeKecKtp = 'onchange="changeKecamatanKtp(this.value)"';
							$onchangeKelKtp = 'onchange="changeKelurahanKtp(this.value)"';
						}

						$d['is_check'] = $checked;
						$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
						$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
						$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
						$d['onchangeKelurahanKtp'] = $onchangeKelKtp;
					}
					$d['st'] = $st;
					$d['st'] = "edit";
					$d['lamp_sk'] = $this->db->get_where("tbl_lampiran_sk");
					$d['lamp_pribadi'] = $this->db->get_where("tbl_lampiran_pribadi");
					$d['lamp_pendidikan'] = $this->db->get_where("tbl_lampiran_pendidikan");
					$d['lamp_skp'] = $this->db->get_where("tbl_lampiran_skp");
					$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
					$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
					$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
					$d['mst_stts_jabatan'] = $this->db->get('tbl_master_status_jabatan');
					$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
					$d['mst_bidang'] = $this->db->get('tbl_master_bidang');
					$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
					$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
					$d['mst_sub_lokasi_kerja'] = $this->db->get('tbl_master_sub_lokasi_kerja');
					$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
					$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
					$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
					$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
					$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
					$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
					$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
					$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();

					$d['data_keluarga'] = $this->db->get_where("tbl_data_keluarga", $id);
					$d['data_riwayat_pangkat'] = $this->db->query("select * from tbl_data_riwayat_pangkat a left join tbl_master_golongan b on a.id_golongan=b.id_golongan where a.id_pegawai='" . $id['id_pegawai'] . "'");
					$d['data_riwayat_jabatan'] = $this->db->query("select c.nama_jabatan, b.nama_status_jabatan, a.id_riwayat_jabatan, a.lokasi, a.tmt_mulai_jabatan, a.nomor_sk, a.tgl_sk_jabatan from tbl_data_riwayat_jabatan a left join tbl_master_status_jabatan b on a.id_status_jabatan=b.id_status_jabatan 
					left join tbl_master_nama_jabatan c on a.id_jabatan=c.id_nama_jabatan where a.id_pegawai='" . $id['id_pegawai'] . "' ORDER BY a.id_riwayat_jabatan DESC");
					$d['data_pendidikan'] = $this->db->query("select c.nama_pendidikan, a.jurusan, a.tempat_sekolah, a.kota, a.nomor_sttb, a.tanggal_lulus, a.id_pendidikan, a.id_master_pendidikan from tbl_data_pendidikan a 
					left join tbl_data_pegawai b on a.id_pegawai=b.id_pegawai left join tbl_master_pendidikan c on a.id_master_pendidikan=c.id_master_pendidikan where a.id_pegawai='" . $id['id_pegawai'] . "'");
					$d['data_pelatihan'] = $this->db->query("select a.nama_pelatihan, a.kota, a.lokasi, a.tanggal_sertifikat, a.no_sertifikat, a.jam_pelatihan, a.negara, a.id_pelatihan from tbl_data_pelatihan a 
					left join tbl_master_pelatihan b on a.id_master_pelatihan=b.id_master_pelatihan left join tbl_master_lokasi_pelatihan c on a.lokasi=c.id_lokasi_pelatihan where a.id_pegawai='" . $id['id_pegawai'] . "'");
					$d['data_penghargaan'] = $this->db->query("select b.nama_penghargaan, a.nomor_sk, a.tgl_sk_penghargaan, a.id_penghargaan from tbl_data_penghargaan a left join tbl_master_penghargaan b on a.id_master_penghargaan=b.id_master_penghargaan where
					a.id_pegawai='" . $id['id_pegawai'] . "'");
					$d['data_seminar'] = $this->db->get_where("tbl_data_seminar", $id);
					$d['data_gaji_pokok'] = $this->db->query("select * from tbl_data_gaji_pokok a left join tbl_master_golongan b on a.id_golongan=b.id_golongan where a.id_pegawai='" . $id['id_pegawai'] . "'");
					$d['data_hukuman'] =  $this->db->query("select a.id_hukuman, b.nama_hukuman, a.nomor_sk, a.tanggal_sk, a.tanggal_mulai, a.tanggal_selesai, a.masa_berlaku from tbl_data_hukuman a 
					left join tbl_master_hukuman b on a.id_master_hukuman=b.id_hukuman where a.id_pegawai='" . $id['id_pegawai'] . "'");
					$d['data_tubel'] =  $this->db->query("select * from tbl_data_tubel a left join tbl_data_pegawai b on a.id_pegawai=b.id_pegawai where a.id_pegawai='" . $id['id_pegawai'] . "'");
					$d['data_dp3'] = $this->db->get_where("tbl_data_dp3", $id);

					$this->load->view('dashboard_admin/master/header2', $d);
					$this->load->view('dashboard_publik/home/edit');
				}
			} else { // lolos validasi
				//send email to pegawai
				$message = 'Hai ' . $this->input->post('nama_pegawai') . ', Selamat Anda telah berhasil melakukan update data SI-Adik.<br/> Lengkapi dan upload data-data Anda untuk kebutuhan kenaikan pangkat, serta kebutuhan kepegawaian lainnya.<br/>Url : https://dcktrp.jakarta.go.id/si-adik/<br/>
<br/>Terimakasih<br/><br/><br/><b>Best Regards,<br/>Subbagian Kepegawaian<br/>Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta<br/>Gedung Dinas Teknis Jatibaru Lt.2 
<br/>Jl. Taman Jatibaru No.1, RT.17/RW.1, Cideng, Gambir, Kota Jakarta Pusat, <br/>Daerah Khusus Ibukota Jakarta 10150</b>';

				if ($this->input->post('email') == '') {
					$email_spam = 'wongndro@gmail.com';
				} else {
					$email_spam = $this->input->post('email');
				}

				$objSendEmail = [
					'email' => $email_spam,
					'subject' => 'Update Data SI-Adik',
					'message' => $message
				];

				$this->load->helper('send_email');
				//SendMail($objSendEmail);

				// send wa to pegawai
				$this->load->helper('wa');

				if ($this->input->post('telepon') == '') {
					$no_spam = '08121835654';
				} else {
					$no_spam = $this->input->post('telepon');
				}

				$objSendWA = [
					'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '
', $message))),
					'phone' => $no_spam
				];
				//$notifWA = SendWANotif($objSendWA);
				//log_message('info', json_encode($notifWA), false);

				// send mail to admin

				//get data pegawai
				$qPegawai = $this->db->query(
					"
					select lokasi_kerja 
					from tbl_data_pegawai 
					where id_pegawai = " . $id['id_pegawai'] . " limit 1"
				);

				$id_lokasi_kerja = $this->input->post('lokasi_kerja');

				// send mail to admin
				$message = 'Hai Admin, ' . $this->input->post('nama_pegawai') . ' telah berhasil melakukan update data SI-Adik.<br/>Url : https://dcktrp.jakarta.go.id/si-adik/
<br/>Terimakasih<br/><br/><br/><b>Best Regards,<br/>Subbagian Kepegawaian<br/>Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta<br/>Gedung Dinas Teknis Jatibaru Lt.2 
<br/>Jl. Taman Jatibaru No.1, RT.17/RW.1, Cideng, Gambir, Kota Jakarta Pusat, <br/>Daerah Khusus Ibukota Jakarta 10150</b>';

				// get email admin
				$qEmail = "select email
						from tbl_user_login 
						where stts='administrator' and (id_lokasi_kerja = '$id_lokasi_kerja' or id_lokasi_kerja is null)";
				$rsEmail = $this->db->query($qEmail)->result_array();
				if (count($rsEmail) > 0) {
					foreach ($rsEmail as $email) {
						if ($email['email'] != '') {
							$objSendEmail = [
								'email' => $email['email'],
								'subject' => 'Pengajuan Surat Keterangan SI-Adik',
								'message' => $message
							];

							//SendMail($objSendEmail);
						}
					}
				}

				$st = $this->input->post('st');
				if ($st == "edit") {
					$upd['nip'] = $this->input->post('nip');
					$upd['nrk'] = $this->input->post('nrk');
					$upd['email'] = $this->input->post('email');
					$upd['telepon'] = $this->input->post('telepon');
					$upd['nama_pegawai'] = $this->input->post('nama_pegawai');
					$upd['gelar'] = $this->input->post('gelar');
					$upd['status_pegawai'] = $this->input->post('status_pegawai');
					$upd['id_jabatan'] = $this->input->post('id_jabatan_view');
					$upd['id_bidang'] = $this->input->post('id_bidang');
					$upd['lokasi_kerja'] = $this->input->post('lokasi_kerja');
					if ($this->input->post('lokasi_kerja') == '52') { #kalo dinas 
						$upd['sublokasi_kerja'] = $this->input->post('sublokasi_kerja');
					} else {
						$upd['sublokasi_kerja'] = null;
					}
					$upd['seksi'] = $this->input->post('seksi');
					$upd['masa_kerja'] = $this->input->post('masa_kerja');
					$upd['usia'] = $this->input->post('usia');
					$upd['jenis_kelamin'] = $this->input->post('jenis_kelamin');
					$upd['tempat_lahir'] = $this->input->post('tempat_lahir');
					$upd['tanggal_lahir'] = date("Y-m-d", strtotime($this->input->post('tanggal_lahir')));
					$upd['agama'] = $this->input->post('agama');
					$upd['status_nikah'] = $this->input->post('status_nikah');
					$upd['alamat'] = $this->input->post('alamat');
					$upd['kode_kelurahan'] = $this->input->post('kode_kelurahan');
					$upd['nama_kelurahan'] = $this->input->post('nama_kelurahan');
					$upd['kode_kecamatan'] = $this->input->post('kode_kecamatan');
					$upd['nama_kecamatan'] = $this->input->post('nama_kecamatan');
					$upd['kode_kabupaten'] = $this->input->post('kode_kabupaten');
					$upd['nama_kabupaten'] = $this->input->post('nama_kabupaten');
					$upd['kode_provinsi'] = $this->input->post('kode_provinsi');
					$upd['nama_provinsi'] = $this->input->post('nama_provinsi');
					$upd['alamat_ktp'] = $this->input->post('alamat_ktp');

					$upd['is_check'] = $this->input->post('is_check');

					if ($upd['is_check'] == 1) {
						$upd['kode_kelurahan_ktp'] = $this->input->post('kode_kelurahan');
						$upd['nama_kelurahan_ktp'] = $this->input->post('nama_kelurahan');
						$upd['kode_kecamatan_ktp'] = $this->input->post('kode_kecamatan');
						$upd['nama_kecamatan_ktp'] = $this->input->post('nama_kecamatan');
						$upd['kode_kabupaten_ktp'] = $this->input->post('kode_kabupaten');
						$upd['nama_kabupaten_ktp'] = $this->input->post('nama_kabupaten');
						$upd['kode_provinsi_ktp'] = $this->input->post('kode_provinsi');
						$upd['nama_provinsi_ktp'] = $this->input->post('nama_provinsi');
					} else {
						$upd['kode_kelurahan_ktp'] = $this->input->post('kode_kelurahan_ktp');
						$upd['nama_kelurahan_ktp'] = $this->input->post('nama_kelurahan_ktp');
						$upd['kode_kecamatan_ktp'] = $this->input->post('kode_kecamatan_ktp');
						$upd['nama_kecamatan_ktp'] = $this->input->post('nama_kecamatan_ktp');
						$upd['kode_kabupaten_ktp'] = $this->input->post('kode_kabupaten_ktp');
						$upd['nama_kabupaten_ktp'] = $this->input->post('nama_kabupaten_ktp');
						$upd['kode_provinsi_ktp'] = $this->input->post('kode_provinsi_ktp');
						$upd['nama_provinsi_ktp'] = $this->input->post('nama_provinsi_ktp');
					}

					$upd['longitude'] = $this->input->post('longitude');
					$upd['latitude'] = $this->input->post('latitude');
					$upd['pendidikan'] = $this->input->post('pendidikan');
					$upd['pendidikan_bkd'] = $this->input->post('pendidikan_bkd');
					$upd['asal_sekolah'] = $this->input->post('asal_sekolah');
					$upd['tgl_lulus'] = $this->input->post('tgl_lulus');
					$upd['id_golongan'] = $this->input->post('id_golongan');
					$upd['id_eselon'] = $this->input->post('id_eselon');
					$upd['nomor_sk_pangkat'] = $this->input->post('nomor_sk_pangkat');
					$upd['tanggal_sk_pangkat'] = $this->input->post('tanggal_sk_pangkat');
					$upd['tanggal_mulai_pangkat'] = date("Y-m-d", strtotime($this->input->post('tanggal_mulai_pangkat'))); //$this->input->post('tanggal_mulai_pangkat');					
					$upd['tanggal_pengangkatan_cpns'] = $this->input->post('tanggal_pengangkatan_cpns');
					$upd['id_status_jabatan'] = $this->input->post('id_status_jabatan');
					$upd['id_rumpun_jabatan'] = $this->input->post('id_rumpun_jabatan_view');
					$upd['nomor_sk_jabatan'] = $this->input->post('nomor_sk_jabatan');
					$upd['tanggal_sk_jabatan'] = $this->input->post('tanggal_sk_jabatan');
					$upd['tanggal_mulai_jabatan'] = $this->input->post('tanggal_mulai_jabatan');
					$upd['status_pegawai_pangkat'] = $this->input->post('status_pegawai_pangkat');
					$upd['tanggal_selesai_pangkat'] = $this->input->post('tanggal_selesai_pangkat');
					$upd['id_satuan_kerja'] = $this->input->post('id_satuan_kerja');

					$upd['tanggal_selesai_jabatan'] = $this->input->post('tanggal_selesai_jabatan');
					$upd['tmt_eselon'] = $this->input->post('tmt_eselon');

					// echo '<pre>'.print_r($_FILES).'</pre>';exit;
					if (!empty($_FILES['foto']['name'])) {
						$acak = rand(00000000000, 99999999999);
						$bersih = $_FILES['foto']['name'];
						$nm = str_replace(" ", "_", "$bersih");
						$pisahfoto = explode(".", $nm);
						$nama_murni_lamafoto = preg_replace("/^(.+?);.*$/", "\\1", $pisahfoto[0]);
						$nama_murnifoto = date('Ymd-His');
						$ekstensi_kotorfoto = $pisahfoto[1];

						$file_typefoto = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotorfoto);
						$file_type_barufoto = strtolower($file_typefoto);

						$ubahfoto = $acak . '-' . $nama_murnifoto . '-' . $nama_murni_lamafoto; //tanpa ekstensi
						$n_barufoto = $ubahfoto . '.' . $file_type_barufoto;

						$configfoto['upload_path']	= "./asset/foto_pegawai/";
						$configfoto['allowed_types'] = 'gif|jpg|png|jpeg';
						$configfoto['file_name'] = $n_barufoto;
						$configfoto['max_size']     = '2500';
						$configfoto['max_width']  	= '3000';
						$configfoto['max_height']  	= '3000';

						$this->load->library('upload', $configfoto);
						$this->upload->initialize($configfoto);

						if (!$this->upload->do_upload("foto")) {
							echo 'upload foto error';
							$error = array('error' => $this->upload->display_errors());
							// $this->session->set_flashdata('msg', 'We had an error trying. Unable upload  image');
							$this->session->set_flashdata('pict_failed', 'Gagal upload foto pegawai.');
						} else {
							$foto = $this->upload->data();
							echo '<pre>' . print_r($foto) . '</pre>';
							$kode = $this->input->post("old_file");

							$image1 = "asset/foto_pegawai/" . $kode;
							if (is_file($image1)) {
								unlink($image1);
							}

							$image2 = "asset/foto_pegawai/thumb/" . $kode;
							if (is_file($image2)) {
								unlink($image2);
							}

							$image3 = "asset/foto_pegawai/medium/" . $kode;
							if (is_file($image3)) {
								unlink($image3);
							}

							/* PATH */
							$source             = "./asset/foto_pegawai/" . $foto['file_name'];
							$destination_thumb	= "./asset/foto_pegawai/thumb/";
							$destination_medium	= "./asset/foto_pegawai/medium/";

							// Permission Configuration
							chmod($source, 0777);

							/* Resizing Processing */
							// Configuration Of Image Manipulation :: Static
							$this->load->library('image_lib');
							$img['image_library'] = 'GD2';
							$img['create_thumb']  = TRUE;
							$img['maintain_ratio'] = TRUE;

							/// Limit Width Resize
							$limit_medium   = 425;
							$limit_thumb    = 150;

							// Size Image Limit was using (LIMIT TOP)
							$limit_use  = $foto['image_width'] > $foto['image_height'] ? $foto['image_width'] : $foto['image_height'];

							// Percentase Resize
							if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
								$percent_medium = $limit_medium / $limit_use;
								$percent_thumb  = $limit_thumb / $limit_use;
							}

							//// Making THUMBNAIL ///////
							$img['width']  = $limit_use > $limit_thumb ?  $foto['image_width'] * $percent_thumb : $foto['image_width'];
							$img['height'] = $limit_use > $limit_thumb ?  $foto['image_height'] * $percent_thumb : $foto['image_height'];

							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%';
							$img['source_image'] = $source;
							$img['new_image']    = $destination_thumb;

							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear();

							////// Making MEDIUM /////////////
							$img['width']   = $limit_use > $limit_medium ?  $foto['image_width'] * $percent_medium : $foto['image_width'];
							$img['height']  = $limit_use > $limit_medium ?  $foto['image_height'] * $percent_medium : $foto['image_height'];

							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%';
							$img['source_image'] = $source;
							$img['new_image']    = $destination_medium;

							// echo 'destination_medium : '.$destination_medium.'<br />';

							$upd['foto'] = $foto['file_name'];
							// echo $upd['foto'].'<br />';

							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear();
							// echo 'sukses resizing foto';
							// exit;
						}
					}

					//deklarasi ttd digital
					$dig_signature = $this->input->post('dig_signature');

					if ($dig_signature == '') {
						//upload Signature
						if (!empty($_FILES['signature']['name'])) {
							$acak = rand(00000000000, 99999999999);
							$bersih = $_FILES['signature']['name'];
							$nm = str_replace(" ", "_", "$bersih");
							$pisahsignature = explode(".", $nm);
							$nama_murni_lamasignature = preg_replace("/^(.+?);.*$/", "\\1", $pisahsignature[0]);
							$nama_murnisignature = date('Ymd-His');
							$ekstensi_kotorsignature = $pisahsignature[1];

							$file_typesignature = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotorsignature);
							$file_type_barusignature = strtolower($file_typesignature);

							$ubahsignature = $acak . '-' . $nama_murnisignature . '-' . $nama_murni_lamasignature; //tanpa ekstensi
							$n_barusignature = $ubahsignature . '.' . $file_type_barusignature;

							$configsignature['upload_path']		= "./asset/foto_pegawai/signature";
							// $configsignature['allowed_types'] 	= 'gif|jpg|png|jpeg';
							$configsignature['allowed_types'] 	= 'png';
							$configsignature['file_name'] 		= $n_barusignature;
							$configsignature['max_size']     	= '2500';
							$configsignature['max_width']  		= '3000';
							$configsignature['max_height']  	= '3000';

							$this->load->library('upload', $configsignature);
							$this->upload->initialize($configsignature);

							if (!$this->upload->do_upload("signature")) {
								$error = array('error' => $this->upload->display_errors());
								// $this->session->set_flashdata('msg', 'We had an error trying. Unable upload  image.');
								$this->session->set_flashdata('sign_failed', 'Gagal upload tanda tangan.');
							} else {
								$signature = $this->upload->data();
								$kode = $this->input->post("old_signature");

								$image1 = "asset/foto_pegawai/signature" . $kode;
								if (is_file($image1)) {
									unlink($image1);
								}

								$image2 = "asset/foto_pegawai/signature/thumb/" . $kode;
								if (is_file($image2)) {
									unlink($image2);
								}

								$image3 = "asset/foto_pegawai/signature/medium/" . $kode;
								if (is_file($image3)) {
									unlink($image3);
								}

								/* PATH */
								$source             = "./asset/foto_pegawai/signature/" . $signature['file_name'];
								$destination_thumb	= "./asset/foto_pegawai/signature/thumb/";
								$destination_medium	= "./asset/foto_pegawai/signature/medium/";

								// Permission Configuration
								chmod($source, 0777);

								/* Resizing Processing */
								// Configuration Of Image Manipulation :: Static
								$this->load->library('image_lib');
								$img['image_library'] = 'GD2';
								$img['create_thumb']  = TRUE;
								$img['maintain_ratio'] = TRUE;

								/// Limit Width Resize
								$limit_medium   = 425;
								$limit_thumb    = 150;

								// Size Image Limit was using (LIMIT TOP)
								$limit_use  = $signature['image_width'] > $signature['image_height'] ? $signature['image_width'] : $signature['image_height'];

								// Percentase Resize
								if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
									$percent_medium = $limit_medium / $limit_use;
									$percent_thumb  = $limit_thumb / $limit_use;
								}

								//// Making THUMBNAIL ///////
								$img['width']  = $limit_use > $limit_thumb ?  $signature['image_width'] * $percent_thumb : $signature['image_width'];
								$img['height'] = $limit_use > $limit_thumb ?  $signature['image_height'] * $percent_thumb : $signature['image_height'];

								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%';
								$img['source_image'] = $source;
								$img['new_image']    = $destination_thumb;

								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear();

								////// Making MEDIUM /////////////
								$img['width']   = $limit_use > $limit_medium ?  $signature['image_width'] * $percent_medium : $signature['image_width'];
								$img['height']  = $limit_use > $limit_medium ?  $signature['image_height'] * $percent_medium : $signature['image_height'];

								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%';
								$img['source_image'] = $source;
								$img['new_image']    = $destination_medium;

								$upd['signature'] = $signature['file_name'];

								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear();
							}
						}
					} else {
						$kode = $this->input->post("old_signature");
						$image1 = "asset/foto_pegawai/signature/" . $kode;
						$image2 = "asset/foto_pegawai/signature/thumb/" . $kode;
						$image3 = "asset/foto_pegawai/signature/medium/" . $kode;
						$files = array($image1, $image2, $image3);
						array_map('unlink', $files);
						//--
						$imagedata = base64_decode($dig_signature);
						$filename = md5(date("dmYhisA"));
						// --
						$file_name = './asset/foto_pegawai/signature/' . $filename . '.png';
						$file_name_medium = './asset/foto_pegawai/signature/medium/' . $filename . '.png';
						$file_name_thumb = './asset/foto_pegawai/signature/thumb/' . $filename . '.png';

						file_put_contents($file_name, $imagedata);
						file_put_contents($file_name_medium, $imagedata);
						file_put_contents($file_name_thumb, $imagedata);
						// --
						$upd['signature'] = $filename . '.png';
					}

					if ($this->db->update("tbl_data_pegawai", $upd, $id)) {
						$this->session->set_flashdata('suksesedit', 'Data berhasil diubah.');

						#-------tambahkan lokasi pegawai ke gis
						$nama = $this->input->post("nama_pegawai");
						$gelar = $this->input->post("gelar");
						$nrk = $this->input->post("nrk");
						$nip = $this->input->post("nip");
						$email = $this->input->post("email");
						$alamat = $this->input->post("alamat");
						$provinsi = $this->input->post("nama_provinsi");
						$kota = $this->input->post("nama_kabupaten");
						$kecamatan = $this->input->post("nama_kecamatan");
						$kelurahan = $this->input->post("nama_kelurahan");
						$longitude = $this->input->post("longitude");
						$latitude = $this->input->post("latitude");
						//$Session_Id = $this->session->userdata("id_pegawai");
						if ($longitude == '' || $latitude == '') {
							redirect(base_url() . 'dashboard_publik');
						} else {
							echo 'success';

							echo '
								<script type="text/javascript">
									$.dialog({
										title: \'Info\',
										content: \'Testing...\',
										type: \'green\',
										backgroundDismiss: true
									});
								</script>
								';

							// echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
							// echo '<script type="text/javascript">',
							// 		'var url = "https://tataruang.jakarta.go.id/server/rest/services/SIADIK/PegawaiSiadik/FeatureServer/0/query?where=nrk=%27'.$nrk.'%27&outFields=objectid&f=json";
							// 			$.ajax({
							// 				method: "GET",
							// 				url: url,
							// 				dataType: "json",
							// 				processData: true,
							// 				success: function (response) {
							// 					console.log(response.features[0]);
							// 					var isexist = response.features[0];
							// 					var url_ui ="https://tataruang.jakarta.go.id/server/rest/services/SIADIK/PegawaiSiadik/FeatureServer/0/applyEdits";

							// 					//jika tidak ada tambahkan
							// 					if(isexist == null) {
							// 						var attributes = [
							// 							{
							// 								geometry: { x: '.$longitude.', y: '.$latitude.' },
							// 								attributes: {
							// 									namapegawai: "'.$nama.'",
							// 									nip: '.$nip.',
							// 									nrk: '.$nrk.',
							// 									email: "'.$email.'",
							// 									alamat: "'.$alamat.'",
							// 									provinsi: "'.$provinsi.'",
							// 									kota : "'.$kota.'",
							// 									kecamatan : "'.$kecamatan.'",
							// 									kelurahan  : "'.$kelurahan.'",
							// 								},
							// 							},
							// 						];

							// 						var data = {
							// 							f: "json",
							// 							adds: JSON.stringify(attributes),
							// 						};
							// 					//jika ada update
							// 					} else {
							// 						var objectid = response.features[0].attributes.objectid;
							// 						var attributes = [
							// 							{
							// 								geometry: { x: '.$longitude.', y: '.$latitude.' },
							// 								attributes: {
							// 									objectid: objectid,
							// 									namapegawai: "'.$nama.'",
							// 									nip: '.$nip.',
							// 									nrk: '.$nrk.',
							// 									email: "'.$email.'",
							// 									alamat: "'.$alamat.'",
							// 									provinsi: "'.$provinsi.'",
							// 									kota : "'.$kota.'",
							// 									kecamatan : "'.$kecamatan.'",
							// 									kelurahan  : "'.$kelurahan.'",

							// 								},
							// 							},
							// 						];
							// 						var data = {
							// 							f: "json",
							// 							updates: JSON.stringify(attributes),
							// 						};
							// 					}
							// 					$.ajax({
							// 						method: "POST",
							// 						url: url_ui,
							// 						data: data,
							// 						dataType: "json",
							// 						processData: true,
							// 						success: function (response) {
							// 							console.log(response);
							// 							alert("Berhasil");
							// 							load_data("data_pegawai");

							// 						}
							// 					});
							// 				}
							// 			});',
							// 		'</script>';
							//redirect (base_url() . 'dashboard_publik');
						}
						#------- end tambahkan lokasi pegawai ke gis
					} else {
						$this->session->set_flashdata('gagaledit', 'Data gagal diubah.');
						redirect(base_url() . 'dashboard_publik');
					}

					//redirect (base_url() . 'dashboard_publik');				
					//header("location:".base_url()."pegawai/edit/".$this->session->userdata("kode_pegawai")."");
				}

				// === begin: set notif to admin ===
				$ses_username = $this->session->userdata('username');
				// $sSQL = "SELECT id_lokasi_kerja FROM tbl_user_login WHERE username = '$ses_username'";
				// $id_lokasi_kerja = $this->db->query($sSQL)->row()->id_lokasi_kerja;
				$sSQL = "SELECT username FROM tbl_user_login WHERE id_lokasi_kerja = '$id_lokasi_kerja' AND stts = 'administrator' ";
				$user_admin = $this->db->query($sSQL)->row()->username;

				// this page: data pegawai (1668732424)
				$this->func_table->SetNotif(1, '1668732424', $id_lokasi_kerja, $user_admin, $ses_username);
				// === end: set notif to admin ===
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function deletelamp1()
	{
		$kode = $this->session->userdata('id_pegawai');
		$deleteid  = $this->uri->segment(3);
		$name = $this->uri->segment(4);
		$nama_folder = "SK" . $kode;
		$file = "asset/upload/SK/" . $nama_folder . "/" . $name;
		//echo "list url is " .($name) . "<hr>";			
		if (is_readable($file) && unlink($file)) {
			$this->session->set_flashdata('deletelamp1', 'LAMPIRAN BERHASIL DI HAPUS...');
		}
		$this->db->delete('tbl_lampiran_sk', array('id_sk' => $deleteid));
		header("location:" . base_url() . "dashboard_publik/edit/" . $this->session->userdata("id_pegawai") . "");
	}

	public function deletelamp2()
	{
		$kode = $this->session->userdata('id_pegawai');
		$deleteid  = $this->uri->segment(3);
		$name = $this->uri->segment(4);
		$nama_folder = "pribadi" . $kode;
		$file = "asset/upload/pribadi/" . $nama_folder . "/" . $name;
		//echo "list url is " .($name) . "<hr>";			
		if (is_readable($file) && unlink($file)) {
			$this->session->set_flashdata('deletelamp2', 'LAMPIRAN BERHASIL DI HAPUS...');
		}
		$this->db->delete('tbl_lampiran_pribadi', array('id_pribadi' => $deleteid));
		header("location:" . base_url() . "dashboard_publik/edit/" . $this->session->userdata("id_pegawai") . "");
	}

	public function deletelamp3()
	{
		$kode = $this->session->userdata('id_pegawai');
		$deleteid  = $this->uri->segment(3);
		$name = $this->uri->segment(4);
		$nama_folder = "pendidikan" . $kode;
		$file = "asset/upload/pendidikan/" . $nama_folder . "/" . $name;
		//echo "list url is " .($name) . "<hr>";			
		if (is_readable($file) && unlink($file)) {
			$this->session->set_flashdata('deletelamp2', 'LAMPIRAN BERHASIL DI HAPUS...');
		}
		$this->db->delete('tbl_lampiran_pendidikan', array('id_pendidikan' => $deleteid));
		header("location:" . base_url() . "dashboard_publik/edit/" . $this->session->userdata("id_pegawai") . "");
	}

	public function deletelamp4()
	{
		$kode = $this->session->userdata('id_pegawai');
		$deleteid  = $this->uri->segment(3);
		$name = $this->uri->segment(4);
		$nama_folder = "SKP" . $kode;
		$file = "asset/upload/SKP/" . $nama_folder . "/" . $name;
		//echo "list url is " .($name) . "<hr>";			
		if (is_readable($file) && unlink($file)) {
			$this->session->set_flashdata('deletelamp2', 'LAMPIRAN BERHASIL DI HAPUS...');
		}
		$this->db->delete('tbl_lampiran_skp', array('id_skp' => $deleteid));
		header("location:" . base_url() . "dashboard_publik/edit/" . $this->session->userdata("id_pegawai") . "");
	}

	function get_subkategori()
	{
		$id = $this->input->post('id');
		$data = $this->m_kategori->get_subkategori($id);
		echo json_encode($data);
	}

	function logout()
	{
		$this->session->sess_destroy();
		header('location:' . base_url() . '');
	}

	public function pengajuan_surat_detail($id_surat = 0)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

			if ($data_pegawai->num_rows() > 0) {
				$q = $this->db->get_where("tbl_data_pegawai", $id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

				foreach ($q->result() as $data) {
					$d['id_param'] = $data->id_pegawai;
					$d['nip'] = $data->nip;
					$d['nrk'] = $data->nrk;
					$d['email'] = $data->email;
					$d['telepon'] = $data->telepon;
					$d['nama_pegawai'] = $data->nama_pegawai;
					$d['gelar'] = $data->gelar;
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
					$d['alamat_pegawai'] =  $data->alamat;
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
					$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
					$d['id_satuan_kerja'] = $data->id_satuan_kerja;
					$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
					$d['tmt_eselon'] = $data->tmt_eselon;
				}

				$q = $this->db->query("
					select a.*, b.nama_status as nama_status_pegawai 
					from tbl_data_srt_ket a 
					left join tbl_master_status_pegawai b on a.status_pegawai = b.id_status_pegawai 
					where a.id_srt=" . $id_surat);

				foreach ($q->result() as $data) {
					$d['nama_pegawai'] = $data->nama;
					$d['gelar'] = $data->gelar;
					$d['nip'] = $data->nip;
					$d['nrk'] = $data->nrk;
					$d['alamat_domisili'] = $data->alamat_domisili;
					$d['keterangan'] = $data->keterangan;
					$d['nama_status_pegawai'] = $data->nama_status_pegawai;
					$d['keterangan_ditolak'] = $data->keterangan_ditolak;
				}

				$this->load->helper('url');
				$this->load->view('dashboard_publik/home/pengajuan_surat_detail', $d);
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	function nama_rumpun_jabatan()
	{
		echo $this->jabatan_model->nama_jabatan($this->input->post('id_rumpun_jabatan'));
	}

	public function modal_signature()
	{
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_data_pegawai WHERE id_pegawai='$Id'")->row();

		$this->load->view('dashboard_publik/homes/signature/modal_signature', $a);
	}

	public function download_manualbook()
	{
		$fileContents = file_get_contents(base_url('asset/upload/manual_book/manual_book_siadik_publik_2022.10.22.pdf'));
		$file = 'Manual Book SI-ADiK Publik 2022.10.22.pdf';
		force_download($file, $fileContents);
	}

	public function download_pedoman_1()
	{
		$fileContents = file_get_contents(base_url('asset/upload/pedoman/permendikbud_tahun2015_nomor050.pdf'));
		$file = 'Permendikbud RI No. 50 Tahun 2015.pdf';
		force_download($file, $fileContents);
	}

	public function download_pedoman_2()
	{
		$fileContents = file_get_contents(base_url('asset/upload/pedoman/pergub_dki_99_2021.pdf'));
		$file = 'Pergub DKI Jakarta No. 99 Tahun 2021.pdf';
		force_download($file, $fileContents);
	}

	public function download_pedoman_3()
	{
		$fileContents = file_get_contents(base_url('asset/upload/pedoman/sk_ka._dcktrp_no._31_tahun_2022.pdf'));
		$file = 'SK Ka. DCKTRP No. 31 Tahun 2022.pdf';
		force_download($file, $fileContents);
	}

	public function notify_beranda()
	{
		$count_see_kaku		= $this->func_table->count_see_kaku($this->session->userdata('username'));
		$count_see_tj 		= $this->func_table->count_see_tj($this->session->userdata('username'));
		$count_see 			= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
		$total = $count_see + $count_see_tj + $count_see_kaku;

		// if ($count_see_kaku > 0) {
		// 	$res_count_see_kaku = '<span class="badge btn-warning btn-flat">' . $count_see_kaku . '</span>';
		// } else {
		// 	$res_count_see_kaku = '';
		// }

		if ($total > 0) {
			$res_total = '<span class="badge btn-warning btn-flat">' . $total . '</span>';
		} else {
			$res_total = '';
		}

		$result = [
			// 'kariskarsu' => $res_count_see_kaku,
			'ttl_kertas_kerja' => $res_total
		];

		echo json_encode($result);
	}

	public function notify_arsip_digital()
	{
		$count_see_kaku		= $this->func_table->count_see_kaku($this->session->userdata('username'));
		$count_see_tj 		= $this->func_table->count_see_tj($this->session->userdata('username'));
		$count_see 			= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
		$total = $count_see + $count_see_tj + $count_see_kaku;

		// if ($count_see_kaku > 0) {
		// 	$res_count_see_kaku = '<span class="badge btn-warning btn-flat">' . $count_see_kaku . '</span>';
		// } else {
		// 	$res_count_see_kaku = '';
		// }

		if ($total > 0) {
			$res_total = '<span class="badge btn-warning btn-flat">' . $total . '</span>';
		} else {
			$res_total = '';
		}

		$result = [
			// 'kariskarsu' => $res_count_see_kaku,
			'ttl_kertas_kerja' => $res_total
		];

		echo json_encode($result);
	}
}

/* End of file dashboard_admin.php */
/* Location: ./application/controllers/dashboard_admin.php */
