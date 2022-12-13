<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	/*
		***	Controller : pegawai.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_model');
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('file');
		$this->load->helper('template');
		$this->load->model('arsip_pribadi_model');
		$this->load->model('pangkat_model', 'tbl_data_riwayat_pangkat');
		$this->load->model('arsip_sk_model');
		$this->load->model('arsip_pendidikan_model');
		$this->load->model('arsip_pelatihan_model');
		$this->load->model('arsip_skp_model');
		$this->load->model('arsip_hukuman_model');
	}

	function nama_jabatan()
	{
		if ($this->input->post('id_status_jabatan')) {
			echo $this->jabatan_model->nama_jabatan($this->input->post('id_status_jabatan'));
		}
	}

	public function index()
	{
		header('location:' . base_url() . '');
	}

	public function detail()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Detail Pegawai';
			$d['menu_open'] = 'dashboard';

			$id['id_pegawai'] = $this->uri->segment(3);
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

			if ($data_pegawai->num_rows() > 0) {
				//$q = $this->db->get_where("tbl_data_pegawai",$id);
				$q = $this->db->query(
					"
					select 
						a.*, b.golongan, c.nama_eselon as eselon, d.nama_status_jabatan, e.nama_jabatan as jabatan, 
						f.lokasi_kerja as nama_lokasi_kerja, g.sub_lokasi_kerja, h.nama_rumpun_jabatan, 
						i.nama_status as nama_status_pegawai, j.lokasi_kerja as nama_sublokasi_kerja 
					from tbl_data_pegawai a 
					left join tbl_master_golongan b on a.id_golongan = b.id_golongan 
					left join tbl_master_eselon c on a.id_eselon = c.id_eselon 
					left join tbl_master_status_jabatan d on a.id_status_jabatan = d.id_status_jabatan 
					left join tbl_master_nama_jabatan e on a.id_jabatan = e.id_nama_jabatan 
					left join tbl_master_lokasi_kerja f on a.lokasi_kerja = f.id_lokasi_kerja 
					left join tbl_master_sub_lokasi_kerja g on a.seksi = g.id_sub_lokasi_kerja 
					left join tbl_master_rumpun_jabatan h on a.id_rumpun_jabatan = h.id_rumpun_jabatan 
					left join tbl_master_status_pegawai i on a.status_pegawai = i.id_status_pegawai 
					left join tbl_master_lokasi_kerja j on a.sublokasi_kerja = j.id_lokasi_kerja 
					where a.id_pegawai = " . $id['id_pegawai']
				);

				foreach ($q->result() as $data) {
					$d['id_param'] = $data->id_pegawai;
					$d['nip'] = $data->nip;
					$d['nrk'] = $data->nrk;
					$d['email'] = $data->email;
					$d['telepon'] = $data->telepon;
					$d['nama_pegawai'] = $data->nama_pegawai;
					$d['gelar'] = $data->gelar;
					$d['status_pegawai'] = $data->status_pegawai;
					$d['nama_status_pegawai'] = $data->nama_status_pegawai;
					$d['id_jabatan'] = $data->id_jabatan;
					$d['jabatan'] = $data->jabatan;
					$d['id_bidang'] = $data->id_bidang;
					$d['lokasi_kerja'] = $data->lokasi_kerja;
					$d['nama_lokasi_kerja'] = $data->nama_lokasi_kerja;
					$d['sublokasi_kerja'] = $data->sublokasi_kerja;
					$d['nama_sublokasi_kerja'] = $data->nama_sublokasi_kerja;
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
					$d['golongan'] = $data->golongan;
					$d['id_eselon'] = $data->id_eselon;
					$d['eselon'] = $data->eselon;
					$d['nomor_sk_pangkat'] = $data->nomor_sk_pangkat;
					$d['tanggal_sk_pangkat'] = $data->tanggal_sk_pangkat;
					$d['tanggal_mulai_pangkat'] = $data->tanggal_mulai_pangkat;
					$d['tanggal_pengangkatan_cpns'] = $data->tanggal_pengangkatan_cpns;
					$d['id_status_jabatan'] = $data->id_status_jabatan;
					$d['id_rumpun_jabatan'] = $data->id_rumpun_jabatan;
					$d['nama_rumpun_jabatan'] = $data->nama_rumpun_jabatan;
					$d['status_jabatan'] = $data->nama_status_jabatan;
					$d['status_pegawai_pangkat'] = $data->status_pegawai_pangkat;
					$d['nomor_sk_jabatan'] = $data->nomor_sk_jabatan;
					$d['tanggal_sk_jabatan'] = $data->tanggal_sk_jabatan;
					$d['tanggal_mulai_jabatan'] = $data->tanggal_mulai_jabatan;
					$d['sub_lokasi_kerja'] = $data->sub_lokasi_kerja;

					$foto = base_url() . 'asset/foto_pegawai/no-image/nofoto.png';
					if ($data->foto) {
						$foto = base_url() . 'asset/foto_pegawai/thumb/' . $data->foto;
					}

					$d['foto'] = $foto;

					$signature = base_url() . 'asset/foto_pegawai/no-image/nosignature.png';
					if ($data->signature) {
						$signature = base_url() . 'asset/foto_pegawai/signature/thumb/' . $data->signature;
					}
					$d['signature'] = $signature;

					$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
					$d['id_satuan_kerja'] = $data->id_satuan_kerja;
					$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
					$d['tmt_eselon'] = $data->tmt_eselon;

					$this->session->set_userdata("nama_pegawai", $data->nama_pegawai);
				}

				setcookie('id_pegawai', $id['id_pegawai']);
				setcookie('act_list', $this->uri->segment(2));
				$this->load->view('dashboard_admin/home/detail_pegawai', $d);
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function tambah()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Tambah Data Pegawai';
			$d['menu_open'] = 'dashboard';
			$id['id_pegawai'] = $this->session->userdata("id_pegawai");

			$d['id_param'] = '';
			$d['nip'] = '';
			$d['nrk'] = '';
			$d['email'] = '';
			$d['telepon'] = '';
			$d['nama_pegawai'] = '';
			$d['gelar'] = '';
			$d['status_pegawai'] = '';
			$d['id_jabatan'] = '';
			$d['jabatan'] = '';
			$d['id_bidang'] = '';
			$d['lokasi_kerja'] = '';
			$d['nama_lokasi_kerja'] = '';
			$d['seksi'] = '';
			$d['masa_kerja'] = '';
			$d['usia'] =  '';
			$d['jenis_kelamin'] = '';
			$d['tempat_lahir'] =  '';
			$d['tanggal_lahir'] = '';
			$d['agama'] = '';
			$d['status_nikah'] = '';
			$d['alamat'] = '';
			$d['kode_kelurahan'] = '';
			$d['nama_kelurahan'] = '';
			$d['kode_kecamatan'] = '';
			$d['nama_kecamatan'] = '';
			$d['kode_kabupaten'] = '';
			$d['nama_kabupaten'] = '';
			$d['kode_provinsi'] = '';
			$d['nama_provinsi'] = '';
			$d['alamat_ktp'] = '';
			$d['kode_kelurahan_ktp'] = '';
			$d['nama_kelurahan_ktp'] = '';
			$d['kode_kecamatan_ktp'] = '';
			$d['nama_kecamatan_ktp'] = '';
			$d['kode_kabupaten_ktp'] = '';
			$d['nama_kabupaten_ktp'] = '';
			$d['kode_provinsi_ktp'] = '';
			$d['nama_provinsi_ktp'] = '';
			$d['longitude'] = '';
			$d['latitude'] = '';
			$d['pendidikan'] = '';
			$d['pendidikan_bkd'] = '';
			$d['asal_sekolah'] = '';
			$d['tgl_lulus'] = '';
			$d['id_golongan'] = '';
			$d['golongan'] = '';
			$d['id_eselon'] = '';
			$d['eselon'] = '';
			$d['nomor_sk_pangkat'] = '';
			$d['tanggal_sk_pangkat'] = '';
			$d['tanggal_mulai_pangkat'] = '';
			$d['tanggal_pengangkatan_cpns'] = '';
			$d['id_status_jabatan'] = '';
			$d['id_rumpun_jabatan'] = '';
			$d['status_jabatan'] = '';
			$d['status_pegawai_pangkat'] = '';
			$d['nomor_sk_jabatan'] = '';
			$d['tanggal_sk_jabatan'] = '';
			$d['tanggal_mulai_jabatan'] = '';
			$d['sub_lokasi_kerja'] = '';
			$d['foto'] = '';
			$d['tanggal_selesai_pangkat'] = '';
			$d['id_satuan_kerja'] = '';
			$d['tanggal_selesai_jabatan'] = '';
			$d['tmt_eselon'] = '';
			$d['show_eselon'] = 'style="display:none;"';
			$d['show_rumpun_jabatan'] = 'style="display:none;"';
			$d['show_nama_jabatan'] = 'style="display:none;"';

			//for initiate checklist copy from domisili to ktp
			$checked = '';
			$onchangeProvKtp = 'onchange="OnChangeKodeProvinsiKtp(this.value)"';
			$onchangeKabKtp = 'onchange="OnChangeKodeKabupatenKtp(this.value)"';
			$onchangeKecKtp = 'onchange="OnChangeKodeKecamatanKtp(this.value)"';
			$onchangeKelKtp = 'onchange="OnChangeKodeKelurahanKtp(this.value)"';

			$d['is_check'] = $checked;
			$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
			$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
			$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
			$d['onchangeKelurahanKtp'] = $onchangeKelKtp;

			$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
			$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
			$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
			$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
			$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
			$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
			$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
			$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
			$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
			$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
			$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$d['mst_rumpun_jabatan'] = $this->db->get('tbl_master_rumpun_jabatan');
			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));
			$d['mst_status_jabatan'] = $this->db->get('tbl_master_status_jabatan');
			$d['mst_pelatihan'] = $this->db->get('tbl_master_pelatihan');
			$d['mst_penghargaan'] = $this->db->get('tbl_master_penghargaan');
			$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');

			setcookie('id_pegawai', $id['id_pegawai']);
			setcookie('act_list', $this->uri->segment(2));

			$d['st'] = "add";
			$this->load->view('dashboard_admin/home/input', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function hapus()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "publik") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$iduser['id_user'] = $this->uri->segment(3);

			# delete user di sso
			$PegId = $this->uri->segment(3);
			$Query_peg = $this->db->query("SELECT nrk FROM tbl_data_pegawai WHERE id_pegawai = '$PegId'")->row();
			$nrk_user = $Query_peg->nrk;

			$this->load->helper('sso_user');
			#delete access terlebih dahulu
			$del_acc_user = SSODeleteUserAccessApp($nrk_user);
			//print_r($del_acc_user);
			if ($del_acc_user['status'] == 'success') {
				$del_user_sso = SSODeleteUser($nrk_user);
				print_r($del_user_sso);
			}

			$q = $this->db->get_where("tbl_data_pegawai", $id);
			foreach ($q->result_array() as $data) {
				if ($data['foto'] != "") {
					$kode = $data['foto'];
					$image1 = "asset/foto_pegawai/" . $kode;
					$image2 = "asset/foto_pegawai/thumb/" . $kode;
					$image3 = "asset/foto_pegawai/medium/" . $kode;
					$files = array($image1, $image2, $image3);
					array_map('unlink', $files);
				}
			}

			$this->db->delete("tbl_data_pegawai", $id);
			$this->db->query("DELETE FROM tbl_user_login WHERE username ='$nrk_user'");
			$this->db->delete("tbl_data_dp3", $id);
			$this->db->delete("tbl_data_gaji_pokok", $id);
			$this->db->delete("tbl_data_hukuman", $id);
			$this->db->delete("tbl_data_keluarga", $id);
			$this->db->delete("tbl_data_pelatihan", $id);
			$this->db->delete("tbl_data_pendidikan", $id);
			$this->db->delete("tbl_data_penghargaan", $id);
			$this->db->delete("tbl_data_riwayat_jabatan", $id);
			$this->db->delete("tbl_data_riwayat_pangkat", $id);
			$this->db->delete("tbl_data_seminar", $id);

			$nama_folder = $id['id_pegawai'];
			$files1 = glob("asset/upload/SK/SK" . $nama_folder . "/*.*");
			$files2 = glob("asset/upload/pribadi/pribadi" . $nama_folder . "/*.*");
			$files3 = glob("asset/upload/pendidikan/pendidikan" . $nama_folder . "/*.*");
			$files4 = glob("asset/upload/SKP/SKP" . $nama_folder . "/*.*");
			foreach ($files1 as $file1) {
				if (is_file($file1))
					unlink($file1);
			}
			$path1   = "asset/upload/SK/SK" . $nama_folder;
			rmdir($path1);

			foreach ($files2 as $file2) {
				if (is_file($file2))
					unlink($file2);
			}
			$path2   = "asset/upload/pribadi/pribadi" . $nama_folder;
			rmdir($path2);

			foreach ($files3 as $file3) {
				if (is_file($file3))
					unlink($file3);
			}
			$path3   = "asset/upload/pendidikan/pendidikan" . $nama_folder;
			rmdir($path3);

			foreach ($files4 as $file4) {
				if (is_file($file4))
					unlink($file4);
			}
			$path4   = "asset/upload/SKP/SKP" . $nama_folder;
			rmdir($path4);

			$this->db->delete('tbl_lampiran_sk', $iduser);
			$this->db->delete('tbl_lampiran_pribadi', $iduser);
			$this->db->delete('tbl_lampiran_pendidikan', $iduser);
			$this->db->delete('tbl_lampiran_skp', $iduser);

			$this->session->set_flashdata('deleteuser', 'Data Pegawai Berhasil Di Hapus...');



			redirect(base_url() . 'admin/dashboard_admin');
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function edit()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Ubah Data Pegawai';
			$d['menu_open'] = 'dashboard';
			$id['id_pegawai'] = $this->uri->segment(3);
			$d['id_pegawai'] = $id['id_pegawai'];

			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

			if ($data_pegawai->num_rows() > 0) {
				//$q = $this->db->get_where("tbl_data_pegawai",$id);
				$q = $this->db->query(
					"SELECT 
						a.*, b.golongan, c.nama_eselon as eselon, d.nama_status_jabatan, e.nama_jabatan as jabatan, 
						f.lokasi_kerja as nama_lokasi_kerja, g.sub_lokasi_kerja 
					from tbl_data_pegawai a 
					left join tbl_master_golongan b on a.id_golongan = b.id_golongan 
					left join tbl_master_eselon c on a.id_eselon = c.id_eselon 
					left join tbl_master_status_jabatan d on a.id_status_jabatan = d.id_status_jabatan 
					left join tbl_master_jabatan e on a.id_jabatan = e.id_jabatan 
					left join tbl_master_lokasi_kerja f on a.lokasi_kerja = f.id_lokasi_kerja 
					left join tbl_master_sub_lokasi_kerja g on a.id_seksi = g.id_sub_lokasi_kerja 
					where a.id_pegawai = " . $id['id_pegawai']
				);

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
					$d['jabatan'] = $data->jabatan;
					$d['id_bidang'] = $data->id_bidang;
					$d['lokasi_kerja'] = $data->lokasi_kerja;
					$d['nama_lokasi_kerja'] = $data->nama_lokasi_kerja;
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
					$d['golongan'] = $data->golongan;
					$d['id_eselon'] = $data->id_eselon;
					$d['eselon'] = $data->eselon;
					$d['nomor_sk_pangkat'] = $data->nomor_sk_pangkat;
					$d['tanggal_sk_pangkat'] = $data->tanggal_sk_pangkat;
					$d['tanggal_mulai_pangkat'] = $data->tanggal_mulai_pangkat;
					$d['tanggal_pengangkatan_cpns'] = $data->tanggal_pengangkatan_cpns;
					$d['id_status_jabatan'] = $data->id_status_jabatan;

					$showEselon = '';
					if ($d['id_status_jabatan'] != 2) {
						//bukan struktural, hide pilihan eselon
						$showEselon = 'style="display:none;"';
					}
					$d['show_eselon'] = $showEselon;

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
					$d['status_jabatan'] = $data->nama_status_jabatan;
					$d['status_pegawai_pangkat'] = $data->status_pegawai_pangkat;
					$d['nomor_sk_jabatan'] = $data->nomor_sk_jabatan;
					$d['tanggal_sk_jabatan'] = $data->tanggal_sk_jabatan;
					$d['tanggal_mulai_jabatan'] = $data->tanggal_mulai_jabatan;
					$d['sub_lokasi_kerja'] = $data->sub_lokasi_kerja;

					$foto = base_url() . 'asset/foto_pegawai/no-image/nofoto.png';
					if ($data->foto) {
						$foto = base_url() . 'asset/foto_pegawai/thumb/' . $data->foto;
					}
					$d['foto'] = $foto;
					$d['old_foto'] = $data->foto;

					$signature = base_url() . 'asset/foto_pegawai/no-image/nosignature.png';
					if ($data->signature) {
						$signature = base_url() . 'asset/foto_pegawai/signature/thumb/' . $data->signature;
					}
					$d['signature'] = $signature;
					$d['old_signature'] = $data->signature;

					$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
					$d['id_satuan_kerja'] = $data->id_satuan_kerja;
					$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
					$d['tmt_eselon'] = $data->tmt_eselon;

					$this->session->set_userdata("nama_pegawai", $data->nama_pegawai);

					//for initiate checklist copy from domisili to ktp
					$checked = '';
					$onchangeProvKtp = '';
					$onchangeKabKtp = '';
					$onchangeKecKtp = '';
					$onchangeKelKtp = '';

					if ($data->is_check == 1) {
						$checked = 'checked';
					} else {
						$onchangeProvKtp = 'onchange="OnChangeKodeProvinsiKtp(this.value)"';
						$onchangeKabKtp = 'onchange="OnChangeKodeKabupatenKtp(this.value)"';
						$onchangeKecKtp = 'onchange="OnChangeKodeKecamatanKtp(this.value)"';
						$onchangeKelKtp = 'onchange="OnChangeKodeKelurahanKtp(this.value)"';
					}

					$d['is_check'] = $checked;
					$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
					$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
					$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
					$d['onchangeKelurahanKtp'] = $onchangeKelKtp;
				}

				$Query_lokasi_kerja = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja WHERE sublokasi  = '0' ORDER BY lokasi_kerja ASC")->result();
				$Query_sublokasi_kerja = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja WHERE sublokasi  = '1'")->result();

				$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
				$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
				$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
				$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
				$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
				$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
				$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
				$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
				$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
				$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
				$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
				$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
				$d['mst_rumpun_jabatan'] = $this->db->get('tbl_master_rumpun_jabatan');
				$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
				$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
				if($d['lokasi_kerja']=='52'){
					$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['sublokasi_kerja']));
				} else {
					$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));
				}
				//$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));
				$d['mst_hukuman'] = $this->db->get('tbl_master_hukuman');
				
				$d['master_lokasi_kerja'] 		= $Query_lokasi_kerja;
				$d['master_sublokasi_kerja'] 	= $Query_sublokasi_kerja;

				setcookie('id_pegawai', $id['id_pegawai']);
				setcookie('act_list', $this->uri->segment(2));
				// echo '<pre>'.print_r($d,true).'</pre>';exit;
				$d['st'] = "edit";
				$this->load->view('dashboard_admin/home/edit', $d);
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function simpan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
			$this->form_validation->set_rules('nrk', 'NRK', 'trim|required');
			$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');

			$id['id_pegawai'] = $this->input->post("id_param");
			$st_frame = $this->input->post("frame");

			if ($this->form_validation->run() == FALSE) {
				$st = $this->input->post('st');
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Tambah Data Pegawai';
				$d['menu_open'] = 'dashboard';

				//for initiate checklist copy from domisili to ktp
				$checked = '';
				$onchangeProvKtp = 'onchange="OnChangeKodeProvinsiKtp(this.value)"';
				$onchangeKabKtp = 'onchange="OnChangeKodeKabupatenKtp(this.value)"';
				$onchangeKecKtp = 'onchange="OnChangeKodeKecamatanKtp(this.value)"';
				$onchangeKelKtp = 'onchange="OnChangeKodeKelurahanKtp(this.value)"';
				$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
				$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
				$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
				$d['onchangeKelurahanKtp'] = $onchangeKelKtp;

				if ($st == "edit") {
					$q = $this->db->query(
						"
						select 
							a.*, b.golongan, c.nama_eselon as eselon, d.nama_status_jabatan, e.nama_jabatan as jabatan, 
							f.lokasi_kerja as nama_lokasi_kerja, g.sub_lokasi_kerja 
						from tbl_data_pegawai a 
						left join tbl_master_golongan b on a.id_golongan = b.id_golongan 
						left join tbl_master_eselon c on a.id_eselon = c.id_eselon 
						left join tbl_master_status_jabatan d on a.id_status_jabatan = d.id_status_jabatan 
						left join tbl_master_jabatan e on a.id_jabatan = e.id_jabatan 
						left join tbl_master_lokasi_kerja f on a.lokasi_kerja = f.id_lokasi_kerja 
						left join tbl_master_sub_lokasi_kerja g on a.id_seksi = g.id_sub_lokasi_kerja 
						where a.id_pegawai = " . $id['id_pegawai']
					);

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
						$d['jabatan'] = $data->jabatan;
						$d['id_bidang'] = $data->id_bidang;
						$d['lokasi_kerja'] = $data->lokasi_kerja;
						$d['nama_lokasi_kerja'] = $data->nama_lokasi_kerja;
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
						$d['golongan'] = $data->golongan;
						$d['id_eselon'] = $data->id_eselon;
						$d['eselon'] = $data->eselon;
						$d['nomor_sk_pangkat'] = $data->nomor_sk_pangkat;
						$d['tanggal_sk_pangkat'] = $data->tanggal_sk_pangkat;
						$d['tanggal_mulai_pangkat'] = $data->tanggal_mulai_pangkat;
						$d['tanggal_pengangkatan_cpns'] = $data->tanggal_pengangkatan_cpns;
						$d['id_status_jabatan'] = $data->id_status_jabatan;

						$showEselon = '';
						if ($d['id_status_jabatan'] != 2) {
							//bukan struktural, hide pilihan eselon
							$showEselon = 'style="display:none;"';
						}
						$d['show_eselon'] = $showEselon;

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
						$d['status_jabatan'] = $data->nama_status_jabatan;
						$d['status_pegawai_pangkat'] = $data->status_pegawai_pangkat;
						$d['nomor_sk_jabatan'] = $data->nomor_sk_jabatan;
						$d['tanggal_sk_jabatan'] = $data->tanggal_sk_jabatan;
						$d['tanggal_mulai_jabatan'] = $data->tanggal_mulai_jabatan;
						$d['sub_lokasi_kerja'] = $data->sub_lokasi_kerja;

						$foto = base_url() . 'asset/foto_pegawai/no-image/nofoto.png';
						if ($data->foto) {
							$foto = base_url() . 'asset/foto_pegawai/thumb/' . $data->foto;
						}
						$d['foto'] = $foto;
						$d['old_foto'] = $data->foto;

						$signature = base_url() . 'asset/foto_pegawai/no-image/nosignature.png';
						if ($data->signature) {
							$signature = base_url() . 'asset/foto_pegawai/signature/thumb/' . $data->signature;
						}
						$d['signature'] = $signature;
						$d['old_signature'] = $data->signature;

						$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
						$d['id_satuan_kerja'] = $data->id_satuan_kerja;
						$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
						$d['tmt_eselon'] = $data->tmt_eselon;

						$this->session->set_userdata("nama_pegawai", $data->nama_pegawai);

						//for initiate checklist copy from domisili to ktp
						if ($data->is_check == 1) {
							$checked = 'checked';
							$onchangeProvKtp = 'disabled="disabled"';
							$onchangeKabKtp = 'disabled="disabled"';
							$onchangeKecKtp = 'disabled="disabled"';
							$onchangeKelKtp = 'disabled="disabled"';
						} else {
							$onchangeProvKtp = 'onchange="OnChangeKodeProvinsiKtp(this.value)"';
							$onchangeKabKtp = 'onchange="OnChangeKodeKabupatenKtp(this.value)"';
							$onchangeKecKtp = 'onchange="OnChangeKodeKecamatanKtp(this.value)"';
							$onchangeKelKtp = 'onchange="OnChangeKodeKelurahanKtp(this.value)"';
						}

						$d['is_check'] = $checked;
						$d['onchangeProvinsiKtp'] = $onchangeProvKtp;
						$d['onchangeKabupatenKtp'] = $onchangeKabKtp;
						$d['onchangeKecamatanKtp'] = $onchangeKecKtp;
						$d['onchangeKelurahanKtp'] = $onchangeKelKtp;
					}

					$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
					$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
					$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
					$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
					$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
					$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
					$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
					$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
					$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
					$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
					$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
					$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
					$d['mst_rumpun_jabatan'] = $this->db->get('tbl_master_rumpun_jabatan');
					$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
					$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
					$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));

					setcookie('id_pegawai', $id['id_pegawai']);
					setcookie('act_list', $this->uri->segment(2));

					$d['st'] = "edit";
					$this->load->view('dashboard_admin/home/edit');
				} else if ($st == "add") {
					$d['id_param'] = '';
					$d['nip'] = '';
					$d['nrk'] = '';
					$d['email'] = '';
					$d['telepon'] = '';
					$d['nama_pegawai'] = '';
					$d['gelar'] = '';
					$d['status_pegawai'] = '';
					$d['id_jabatan'] = '';
					$d['jabatan'] = '';
					$d['id_bidang'] = '';
					$d['lokasi_kerja'] = '';
					$d['nama_lokasi_kerja'] = '';
					$d['seksi'] = '';
					$d['masa_kerja'] = '';
					$d['usia'] =  '';
					$d['jenis_kelamin'] = '';
					$d['tempat_lahir'] =  '';
					$d['tanggal_lahir'] = '';
					$d['agama'] = '';
					$d['status_nikah'] = '';
					$d['alamat'] = '';
					$d['kode_kelurahan'] = '';
					$d['nama_kelurahan'] = '';
					$d['kode_kecamatan'] = '';
					$d['nama_kecamatan'] = '';
					$d['kode_kabupaten'] = '';
					$d['nama_kabupaten'] = '';
					$d['kode_provinsi'] = '';
					$d['nama_provinsi'] = '';
					$d['alamat_ktp'] = '';
					$d['kode_kelurahan_ktp'] = '';
					$d['nama_kelurahan_ktp'] = '';
					$d['kode_kecamatan_ktp'] = '';
					$d['nama_kecamatan_ktp'] = '';
					$d['kode_kabupaten_ktp'] = '';
					$d['nama_kabupaten_ktp'] = '';
					$d['kode_provinsi_ktp'] = '';
					$d['nama_provinsi_ktp'] = '';
					$d['longitude'] = '';
					$d['latitude'] = '';
					$d['pendidikan'] = '';
					$d['pendidikan_bkd'] = '';
					$d['asal_sekolah'] = '';
					$d['tgl_lulus'] = '';
					$d['id_golongan'] = '';
					$d['golongan'] = '';
					$d['id_eselon'] = '';
					$d['eselon'] = '';
					$d['nomor_sk_pangkat'] = '';
					$d['tanggal_sk_pangkat'] = '';
					$d['tanggal_mulai_pangkat'] = '';
					$d['tanggal_pengangkatan_cpns'] = '';
					$d['id_status_jabatan'] = '';
					$d['id_rumpun_jabatan'] = '';
					$d['status_jabatan'] = '';
					$d['status_pegawai_pangkat'] = '';
					$d['nomor_sk_jabatan'] = '';
					$d['tanggal_sk_jabatan'] = '';
					$d['tanggal_mulai_jabatan'] = '';
					$d['sub_lokasi_kerja'] = '';
					$d['foto'] = '';
					$d['signature'] = '';
					$d['tanggal_selesai_pangkat'] = '';
					$d['id_satuan_kerja'] = '';
					$d['tanggal_selesai_jabatan'] = '';
					$d['tmt_eselon'] = '';
					$d['show_eselon'] = 'style="display:none;"';
					$d['show_rumpun_jabatan'] = 'style="display:none;"';
					$d['show_nama_jabatan'] = 'style="display:none;"';
					$d['is_check'] = $checked;

					$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi', 'nama_provinsi'))->get('tbl_master_wilayah');
					$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
					$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
					$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
					$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten', 'nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
					$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan', 'nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
					$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan', 'nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
					$d['mst_status_pegawai'] = $this->db->get('tbl_master_status_pegawai');
					$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
					$d['mst_golongan'] = $this->db->get('tbl_master_golongan');
					$d['mst_eselon'] = $this->db->get('tbl_master_eselon');
					$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
					$d['mst_rumpun_jabatan'] = $this->db->get('tbl_master_rumpun_jabatan');
					$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
					$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
					$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));
					$d['mst_status_jabatan'] = $this->db->get('tbl_master_status_jabatan');
					$d['mst_pelatihan'] = $this->db->get('tbl_master_pelatihan');
					$d['mst_penghargaan'] = $this->db->get('tbl_master_penghargaan');

					setcookie('id_pegawai', $id['id_pegawai']);
					setcookie('act_list', $this->uri->segment(2));
					$d['st'] = "add";
					$this->load->view('dashboard_admin/home/input', $d);
				}
			} else {
				$st = $this->input->post('st');
				if ($st == "edit") {
					$upd['nama_pegawai'] = $this->input->post('nama_pegawai');
					$upd['gelar'] = $this->input->post('gelar');
					$upd['nip'] = $this->input->post('nip');
					$upd['nrk'] = $this->input->post('nrk');
					$upd['email'] = $this->input->post('email');
					$upd['telepon'] = $this->input->post('telepon');
					$upd['jenis_kelamin'] = $this->input->post('jenis_kelamin');
					$upd['tempat_lahir'] = $this->input->post('tempat_lahir');
					// $upd['tanggal_lahir'] = $this->input->post('tanggal_lahir');
					$upd['tanggal_lahir'] = date('Y-m-d', strtotime($this->input->post('tanggal_lahir')));
					$upd['kode_provinsi'] = $this->input->post('kode_provinsi');
					$upd['nama_provinsi'] = $this->input->post('nama_provinsi');
					$upd['kode_kabupaten'] = $this->input->post('kode_kabupaten');
					$upd['nama_kabupaten'] = $this->input->post('nama_kabupaten');
					$upd['kode_kecamatan'] = $this->input->post('kode_kecamatan');
					$upd['nama_kecamatan'] = $this->input->post('nama_kecamatan');
					$upd['kode_kelurahan'] = $this->input->post('kode_kelurahan');
					$upd['nama_kelurahan'] = $this->input->post('nama_kelurahan');
					$upd['alamat'] = $this->input->post('alamat');
					$upd['longitude'] = $this->input->post('longitude');
					$upd['latitude'] = $this->input->post('latitude');
					$upd['is_check'] = $this->input->post('is_check');
					$upd['kode_provinsi_ktp'] = $this->input->post('kode_provinsi_ktp');
					$upd['nama_provinsi_ktp'] = $this->input->post('nama_provinsi_ktp');
					$upd['kode_kabupaten_ktp'] = $this->input->post('kode_kabupaten_ktp');
					$upd['nama_kabupaten_ktp'] = $this->input->post('nama_kabupaten_ktp');
					$upd['kode_kecamatan_ktp'] = $this->input->post('kode_kecamatan_ktp');
					$upd['nama_kecamatan_ktp'] = $this->input->post('nama_kecamatan_ktp');
					$upd['kode_kelurahan_ktp'] = $this->input->post('kode_kelurahan_ktp');
					$upd['nama_kelurahan_ktp'] = $this->input->post('nama_kelurahan_ktp');
					$upd['alamat_ktp'] = $this->input->post('alamat_ktp');
					$upd['agama'] = $this->input->post('agama');
					$upd['status_nikah'] = $this->input->post('status_nikah');
					$upd['status_pegawai'] = $this->input->post('status_pegawai');
					$upd['pendidikan'] = $this->input->post('pendidikan');
					$upd['pendidikan_bkd'] = $this->input->post('pendidikan_bkd');
					$upd['id_golongan'] = $this->input->post('id_golongan');
					// $upd['tanggal_mulai_pangkat'] = $this->input->post('tanggal_mulai_pangkat');
					$upd['tanggal_mulai_pangkat'] = date('Y-m-d', strtotime($this->input->post('tanggal_mulai_pangkat')));
					$upd['id_eselon'] = $this->input->post('id_eselon');
					$upd['id_status_jabatan'] = $this->input->post('id_status_jabatan');
					$upd['id_rumpun_jabatan'] = $this->input->post('id_rumpun_jabatan');
					$upd['id_jabatan'] = $this->input->post('id_jabatan');
					$upd['lokasi_kerja'] = $this->input->post('lokasi_kerja');
					if($this->input->post('lokasi_kerja')=='52'){ #kalo dinas 
						$upd['sublokasi_kerja'] = $this->input->post('sublokasi_kerja');
					} else {
						$upd['sublokasi_kerja'] = null;
					}
					$upd['seksi'] = $this->input->post('seksi');

					//upload foto pegawai
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
						$configfoto['allowed_types'] = 'gif|jpg|png|jpeg|JPG';
						$configfoto['file_name'] = $n_barufoto;
						$configfoto['max_size']     = '10024';
						// $configfoto['max_width']  	= '3000';
						// $configfoto['max_height']  	= '3000';

						$this->load->library('upload', $configfoto);
						$this->upload->initialize($configfoto);

						if (!$this->upload->do_upload("foto")) {
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('msg', $this->upload->display_errors());
						} else {
							$foto	 	= $this->upload->data();
							$kode = $this->input->post("old_file");
							$image1 = "asset/foto_pegawai/" . $kode;
							$image2 = "asset/foto_pegawai/thumb/" . $kode;
							$image3 = "asset/foto_pegawai/medium/" . $kode;
							$files = array($image1, $image2, $image3);
							array_map('unlink', $files);

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

							$upd['foto'] = $foto['file_name'];

							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear();
						}
					}

					//deklarasi ttd digital
					$dig_signature = $this->input->post('dig_signature');

					if ($dig_signature == '') {

						//upload signature
						if (!empty($_FILES['signature']['name'])) {
							$acak = rand(00000000000, 99999999999);
							$bersih = $_FILES['signature']['name'];
							$nm = str_replace(" ", "_", "$bersih");
							$pisah_signature = explode(".", $nm);
							$nama_murni_lama_signature = preg_replace("/^(.+?);.*$/", "\\1", $pisah_signature[0]);
							$nama_murni_signature = date('Ymd-His');
							$ekstensi_kotor_signature = $pisah_signature[1];

							$file_type_signature = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor_signature);
							$file_type_baru_signature = strtolower($file_type_signature);

							$ubah_signature = $acak . '-' . $nama_murni_signature . '-' . $nama_murni_lama_signature; //tanpa ekstensi
							$n_baru_signature = $ubah_signature . '.' . $file_type_baru_signature;

							$config_signature['upload_path']	= "./asset/foto_pegawai/signature/";
							$config_signature['allowed_types'] = 'png';
							$config_signature['file_name'] = $n_baru_signature;
							$config_signature['max_size']     = '2500';
							$config_signature['max_width']  	= '3000';
							$config_signature['max_height']  	= '3000';

							$this->load->library('upload', $config_signature);
							$this->upload->initialize($config_signature);

							if (!$this->upload->do_upload("signature")) {
								$error = array('error' => $this->upload->display_errors());
								$this->session->set_flashdata('msg', 'We had an error trying. Unable upload  image');
							} else {
								$signature	 	= $this->upload->data();
								$kode = $this->input->post("old_signature");
								$image1 = "asset/foto_pegawai/signature/" . $kode;
								$image2 = "asset/foto_pegawai/signature/thumb/" . $kode;
								$image3 = "asset/foto_pegawai/signature/medium/" . $kode;
								$files = array($image1, $image2, $image3);
								array_map('unlink', $files);

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
						//ttd digital
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

					$this->db->update("tbl_data_pegawai", $upd, $id);

					//update tbl_user_login
					$upd_user = array(
						'nama_lengkap' => $this->input->post('nama_pegawai'),
						'id_lokasi_kerja' => $this->input->post('lokasi_kerja')
					);
					$this->db->update("tbl_user_login", $upd_user, $id);

					$insert_id = $this->input->post("id_param");

					if (!empty($_FILES['userfile']['name'][0])) {
						$dir = "SK" . $insert_id;

						// Membuat Folder
						mkdir("./asset/upload/SK/" . $dir);

						$files = $_FILES;
						$cpt = count($_FILES['userfile']['name']);
						for ($i = 0; $i < $cpt; $i++) {
							$_FILES['userfile']['name']		= $files['userfile']['name'][$i];
							$_FILES['userfile']['type']		= $files['userfile']['type'][$i];
							$_FILES['userfile']['tmp_name']	= $files['userfile']['tmp_name'][$i];
							$_FILES['userfile']['error']	= $files['userfile']['error'][$i];
							$_FILES['userfile']['size']		= $files['userfile']['size'][$i];
							$fileName = $_FILES['userfile']['name'];;
							$pisah = explode(".", $fileName);
							$image_type = end($pisah);
							$nama_murni = preg_replace("/[^a-z0-9A-Z]/", "", $pisah[0]);
							$nama_murni_baru = strtolower($nama_murni);
							$file_type = preg_replace("/[^a-z0-9A-Z]/", "", $image_type);
							$file_type_baru = strtolower($file_type);
							$n_baru = $nama_murni_baru . '.' . $file_type_baru;
							$config = array(
								'file_name'     => $n_baru,
								'allowed_types' => 'gif|jpg|jpeg|png|pdf',
								'max_size'      => 5000,
								'overwrite'     => TRUE,
								'upload_path'	=> './asset/upload/SK/' . $dir
							);
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ($this->upload->do_upload('userfile') === FALSE) {
								// Some error occured
								$message = "gagal upload file " . $fileName . ", karena tidak sesuai format atau terlalu besar...";
								$this->session->set_flashdata('gagalupload', $message);
								//redirect (base_url() ."pegawai/edit/".$this->session->userdata("kode_pegawai")."");											
							} else {
								// Upload successful
								$this->upload->data();
								$images[] = $n_baru;
								$asli[] = $fileName;
							}
						}
						foreach (array_combine($images, $asli) as $file => $fileasli) {
							$file_data = array(
								'nama_lampiran' => $file,
								'nama_lampiran_asli' => $fileasli,
								'id_user' => $insert_id
							);
							$this->db->insert('tbl_lampiran_sk', $file_data);
						}
					}

					if (!empty($_FILES['userfile2']['name'][0])) {
						$dir = "pribadi" . $insert_id;

						// Membuat Folder
						mkdir("./asset/upload/pribadi/" . $dir);

						$files = $_FILES;
						$cpt = count($_FILES['userfile2']['name']);
						for ($i = 0; $i < $cpt; $i++) {
							$_FILES['userfile2']['name']		= $files['userfile2']['name'][$i];
							$_FILES['userfile2']['type']		= $files['userfile2']['type'][$i];
							$_FILES['userfile2']['tmp_name']	= $files['userfile2']['tmp_name'][$i];
							$_FILES['userfile2']['error']	= $files['userfile2']['error'][$i];
							$_FILES['userfile2']['size']		= $files['userfile2']['size'][$i];
							$fileName2 = $_FILES['userfile2']['name'];;
							$pisah2 = explode(".", $fileName2);
							$image_type2 = end($pisah2);
							$nama_murni2 = preg_replace("/[^a-z0-9A-Z]/", "", $pisah2[0]);
							$nama_murni_baru2 = strtolower($nama_murni2);
							$file_type2 = preg_replace("/[^a-z0-9A-Z]/", "", $image_type2);
							$file_type_baru2 = strtolower($file_type2);
							$n_baru2 = $nama_murni_baru2 . '.' . $file_type_baru2;
							$config2 = array(
								'file_name'     => $n_baru2,
								'allowed_types' => 'gif|jpg|jpeg|png|pdf',
								'max_size'      => 5000,
								'overwrite'     => TRUE,
								'upload_path'	=> './asset/upload/pribadi/' . $dir
							);
							$this->load->library('upload', $config2);
							$this->upload->initialize($config2);
							if ($this->upload->do_upload('userfile2') === FALSE) {
								// Some error occured
								$message = "gagal upload file " . $fileName2 . ", karena tidak sesuai format atau terlalu besar...";
								$this->session->set_flashdata('gagalupload2', $message);
								//redirect (base_url() ."pegawai/edit/".$this->session->userdata("kode_pegawai")."");											
							} else {
								// Upload successful
								$this->upload->data();
								$images2[] = $n_baru2;
								$asli2[] = $fileName2;
							}
						}

						foreach (array_combine($images2, $asli2) as $file2 => $fileasli2) {
							$file_data2 = array(
								'nama_lampiran' => $file2,
								'nama_lampiran_asli' => $fileasli2,
								'id_user' => $insert_id
							);
							$this->db->insert('tbl_lampiran_pribadi', $file_data2);
						}
					}

					if (!empty($_FILES['userfile3']['name'][0])) {
						$dir = "pendidikan" . $insert_id;

						// Membuat Folder
						mkdir("./asset/upload/pendidikan/" . $dir);

						$files = $_FILES;
						$cpt = count($_FILES['userfile3']['name']);
						for ($i = 0; $i < $cpt; $i++) {
							$_FILES['userfile3']['name']		= $files['userfile3']['name'][$i];
							$_FILES['userfile3']['type']		= $files['userfile3']['type'][$i];
							$_FILES['userfile3']['tmp_name']	= $files['userfile3']['tmp_name'][$i];
							$_FILES['userfile3']['error']	= $files['userfile3']['error'][$i];
							$_FILES['userfile3']['size']		= $files['userfile3']['size'][$i];
							$fileName3 = $_FILES['userfile3']['name'];;
							$pisah3 = explode(".", $fileName3);
							$image_type3 = end($pisah3);
							$nama_murni3 = preg_replace("/[^a-z0-9A-Z]/", "", $pisah3[0]);
							$nama_murni_baru3 = strtolower($nama_murni3);
							$file_type3 = preg_replace("/[^a-z0-9A-Z]/", "", $image_type3);
							$file_type_baru3 = strtolower($file_type3);
							$n_baru3 = $nama_murni_baru3 . '.' . $file_type_baru3;
							$config3 = array(
								'file_name'     => $n_baru3,
								'allowed_types' => 'gif|jpg|jpeg|png|pdf',
								'max_size'      => 5000,
								'overwrite'     => TRUE,
								'upload_path'	=> './asset/upload/pendidikan/' . $dir
							);
							$this->load->library('upload', $config3);
							$this->upload->initialize($config3);
							if ($this->upload->do_upload('userfile3') === FALSE) {
								// Some error occured
								$message = "gagal upload file " . $fileName3 . ", karena tidak sesuai format atau terlalu besar...";
								$this->session->set_flashdata('gagalupload', $message);
								//redirect (base_url() ."pegawai/edit/".$this->session->userdata("kode_pegawai")."");											
							} else {
								// Upload successful
								$this->upload->data();
								$images3[] = $n_baru3;
								$asli3[] = $fileName3;
							}
						}
						foreach (array_combine($images3, $asli3) as $file3 => $fileasli3) {
							$file_data3 = array(
								'nama_lampiran' => $file3,
								'nama_lampiran_asli' => $fileasli3,
								'id_user' => $insert_id
							);
							$this->db->insert('tbl_lampiran_pendidikan', $file_data3);
						}
					}

					if (!empty($_FILES['userfile4']['name'][0])) {
						$dir = "SKP" . $insert_id;

						// Membuat Folder
						mkdir("./asset/upload/SKP/" . $dir);

						$files = $_FILES;
						$cpt = count($_FILES['userfile4']['name']);
						for ($i = 0; $i < $cpt; $i++) {
							$_FILES['userfile4']['name']		= $files['userfile4']['name'][$i];
							$_FILES['userfile4']['type']		= $files['userfile4']['type'][$i];
							$_FILES['userfile4']['tmp_name']	= $files['userfile4']['tmp_name'][$i];
							$_FILES['userfile4']['error']		= $files['userfile4']['error'][$i];
							$_FILES['userfile4']['size']		= $files['userfile4']['size'][$i];
							$fileName4 = $_FILES['userfile4']['name'];;
							$pisah4 = explode(".", $fileName4);
							$image_type4 = end($pisah4);
							$nama_murni4 = preg_replace("/[^a-z0-9A-Z]/", "", $pisah4[0]);
							$nama_murni_baru4 = strtolower($nama_murni4);
							$file_type4 = preg_replace("/[^a-z0-9A-Z]/", "", $image_type4);
							$file_type_baru4 = strtolower($file_type4);
							$n_baru4 = $nama_murni_baru4 . '.' . $file_type_baru4;
							$config4 = array(
								'file_name'     => $n_baru4,
								'allowed_types' => 'gif|jpg|jpeg|png|pdf',
								'max_size'      => 5000,
								'overwrite'     => TRUE,
								'upload_path'	=> './asset/upload/SKP/' . $dir
							);
							$this->load->library('upload', $config4);
							$this->upload->initialize($config4);
							if ($this->upload->do_upload('userfile4') === FALSE) {
								// Some error occured
								$message = "gagal upload file " . $fileName4 . ", karena tidak sesuai format atau terlalu besar...";
								$this->session->set_flashdata('gagalupload4', $message);
								//redirect (base_url() ."pegawai/edit/".$this->session->userdata("kode_pegawai")."");											
							} else {
								// Upload successful
								$this->upload->data();
								$images4[] = $n_baru4;
								$asli4[] = $fileName4;
							}
						}
						foreach (array_combine($images4, $asli4) as $file4 => $fileasli4) {
							$file_data4 = array(
								'nama_lampiran' => $file4,
								'nama_lampiran_asli' => $fileasli4,
								'id_user' => $insert_id
							);
							$this->db->insert('tbl_lampiran_skp', $file_data4);
						}
					}
					$this->session->set_flashdata('suksesedit', 'Data Berhasil Di Ubah...');
					#insert ke sso
					//$this->load->helper('sso_user');
					// $user_sso = SSOInsOrUpdUser($this->input->post('nrk'));

					// if ($user_sso['status'] == 'success') {
					// 	$acc_user = SSOUserAccessApp($this->input->post('nrk'));
					// 	//print_r($acc_user);
					// }

					#-------tambahkan lokasi pegawai ke gis
					$nama = $this->input->post("nama_pegawai");
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
					$Session_Id = $id['id_pegawai'];
					if ($longitude == '' || $latitude == '') {
						//redirect (base_url()."pegawai/edit/".$this->session->userdata("id_pegawai")."");
						redirect(base_url() . "pegawai/edit/" . $Session_Id . "");
					} else {
						redirect(base_url() . "pegawai/edit/" . $Session_Id . "");
						// echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
						// echo '<script type="text/javascript">',
						// 'var url = "https://tataruang.jakarta.go.id/server/rest/services/SIADIK/PegawaiSiadik/FeatureServer/0/query?where=nrk=%27' . $nrk . '%27&outFields=objectid&f=json";
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
						// 								geometry: { x: ' . $longitude . ', y: ' . $latitude . ' },
						// 								attributes: {
						// 									namapegawai: "' . $nama . '",
						// 									nip: ' . $nip . ',
						// 									nrk: ' . $nrk . ',
						// 									email: "' . $email . '",
						// 									alamat: "' . $alamat . '",
						// 									provinsi: "' . $provinsi . '",
						// 									kota : "' . $kota . '",
						// 									kecamatan : "' . $kecamatan . '",
						// 									kelurahan  : "' . $kelurahan . '",
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
						// 								geometry: { x: ' . $longitude . ', y: ' . $latitude . ' },
						// 								attributes: {
						// 									objectid: objectid,
						// 									namapegawai: "' . $nama . '",
						// 									nip: ' . $nip . ',
						// 									nrk: ' . $nrk . ',
						// 									email: "' . $email . '",
						// 									alamat: "' . $alamat . '",
						// 									provinsi: "' . $provinsi . '",
						// 									kota : "' . $kota . '",
						// 									kecamatan : "' . $kecamatan . '",
						// 									kelurahan  : "' . $kelurahan . '",
															
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
						// 							window.location = "' . base_url() . 'pegawai/edit/' . $Session_Id . '";
													
						// 						}
						// 					});
						// 				}
						// 			});',
						// '</script>';
						#------- end tambahkan lokasi pegawai ke gis
					}
					//redirect (base_url()."pegawai/edit/".$this->session->userdata("id_pegawai")."");				
					//header("location:".base_url()."pegawai/edit/".$this->session->userdata("kode_pegawai")."");
				} else if ($st == "add") {
					// echo 'add';
					$in['id_pegawai'] = $this->input->post('id_param');
					$in['nama_pegawai'] = $this->input->post('nama_pegawai');
					$in['gelar'] = $this->input->post('gelar');
					$in['nip'] = $this->input->post('nip');
					$in['nrk'] = $this->input->post('nrk');
					$in['email'] = $this->input->post('email');
					$in['telepon'] = $this->input->post('telepon');
					$in['jenis_kelamin'] = $this->input->post('jenis_kelamin');
					$in['tempat_lahir'] = $this->input->post('tempat_lahir');
					$in['tanggal_lahir'] = $this->input->post('tanggal_lahir');
					$in['kode_provinsi'] = $this->input->post('kode_provinsi');
					$in['nama_provinsi'] = $this->input->post('nama_provinsi');
					$in['kode_kabupaten'] = $this->input->post('kode_kabupaten');
					$in['nama_kabupaten'] = $this->input->post('nama_kabupaten');
					$in['kode_kecamatan'] = $this->input->post('kode_kecamatan');
					$in['nama_kecamatan'] = $this->input->post('nama_kecamatan');
					$in['kode_kelurahan'] = $this->input->post('kode_kelurahan');
					$in['nama_kelurahan'] = $this->input->post('nama_kelurahan');
					$in['alamat'] = $this->input->post('alamat');
					$in['latitude'] = $this->input->post('latitude');
					$in['longitude'] = $this->input->post('longitude');
					$in['is_check'] = ($this->input->post('is_check') != '' ? $this->input->post('is_check') : 0);
					$in['kode_provinsi_ktp'] = $this->input->post('kode_provinsi_ktp');
					$in['nama_provinsi_ktp'] = $this->input->post('nama_provinsi_ktp');
					$in['kode_kabupaten_ktp'] = $this->input->post('kode_kabupaten_ktp');
					$in['nama_kabupaten_ktp'] = $this->input->post('nama_kabupaten_ktp');
					$in['kode_kecamatan_ktp'] = $this->input->post('kode_kecamatan_ktp');
					$in['nama_kecamatan_ktp'] = $this->input->post('nama_kecamatan_ktp');
					$in['kode_kelurahan_ktp'] = $this->input->post('kode_kelurahan_ktp');
					$in['nama_kelurahan_ktp'] = $this->input->post('nama_kelurahan_ktp');
					$in['alamat_ktp'] = $this->input->post('alamat_ktp');
					$in['agama'] = $this->input->post('agama');
					$in['status_nikah'] = $this->input->post('status_nikah');
					$in['status_pegawai'] = $this->input->post('status_pegawai');
					$in['pendidikan'] = $this->input->post('pendidikan');
					$in['pendidikan_bkd'] = $this->input->post('pendidikan_bkd');
					$in['id_golongan'] = $this->input->post('id_golongan');
					$in['tanggal_mulai_pangkat'] = $this->input->post('tanggal_mulai_pangkat');
					$in['id_status_jabatan'] = $this->input->post('id_status_jabatan');
					$in['id_eselon'] = $this->input->post('id_eselon');
					$in['id_rumpun_jabatan'] = $this->input->post('id_rumpun_jabatan');
					$in['id_jabatan'] = $this->input->post('id_jabatan');
					$in['lokasi_kerja'] = $this->input->post('lokasi_kerja');
					$in['seksi'] = $this->input->post('seksi');

					// echo 'jk: '.$this->input->post('jenis_kelamin');exit;
					// echo '<pre>'.print_r($in,true).'</pre>';exit;
					//insert to tabel pegawai
					if ($this->db->insert("tbl_data_pegawai", $in)) {
						$id_pegawai = $this->db->insert_id();

						//insert foto 
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

							$configfoto['upload_path'] = "./asset/foto_pegawai/";
							$configfoto['allowed_types'] = 'gif|jpg|png|jpeg';
							$configfoto['file_name'] = $n_barufoto;
							$configfoto['max_size'] = '2500';
							$configfoto['max_width'] = '3000';
							$configfoto['max_height'] = '3000';

							$this->load->library('upload', $configfoto);
							$this->upload->initialize($configfoto);

							if ($this->upload->do_upload("foto")) {
								$foto = $this->upload->data();

								/* PATH */
								$source = "./asset/foto_pegawai/" . $foto['file_name'];
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
								$img['width'] = $limit_use > $limit_thumb ?  $foto['image_width'] * $percent_thumb : $foto['image_width'];
								$img['height'] = $limit_use > $limit_thumb ?  $foto['image_height'] * $percent_thumb : $foto['image_height'];

								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality'] = '100%';
								$img['source_image'] = $source;
								$img['new_image'] = $destination_thumb;

								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear();

								////// Making MEDIUM /////////////
								$img['width'] = $limit_use > $limit_medium ?  $foto['image_width'] * $percent_medium : $foto['image_width'];
								$img['height'] = $limit_use > $limit_medium ?  $foto['image_height'] * $percent_medium : $foto['image_height'];

								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%';
								$img['source_image'] = $source;
								$img['new_image']    = $destination_medium;

								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear();

								//update foto name to tabel pegawai
								$this->db->update("tbl_data_pegawai", ['foto' => $foto['file_name']], $id_pegawai);
							}
						}

						//insert signature 
						if (!empty($_FILES['signature']['name'])) {
							$acak = rand(00000000000, 99999999999);
							$bersih = $_FILES['signature']['name'];
							$nm = str_replace(" ", "_", "$bersih");
							$pisah_signature = explode(".", $nm);
							$nama_murni_lama_signature = preg_replace("/^(.+?);.*$/", "\\1", $pisah_signature[0]);
							$nama_murni_signature = date('Ymd-His');
							$ekstensi_kotor_signature = $pisah_signature[1];

							$file_type_signature = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor_signature);
							$file_type_baru_signature = strtolower($file_type_signature);

							$ubah_signature = $acak . '-' . $nama_murni_signature . '-' . $nama_murni_lama_signature; //tanpa ekstensi
							$n_baru_signature = $ubah_signature . '.' . $file_type_baru_signature;

							$config_signature['upload_path'] = "./asset/foto_pegawai/signature/";
							$config_signature['allowed_types'] = 'png';
							$config_signature['file_name'] = $n_baru_signature;
							$config_signature['max_size'] = '2500';
							$config_signature['max_width'] = '3000';
							$config_signature['max_height'] = '3000';

							$this->load->library('upload', $config_signature);
							$this->upload->initialize($config_signature);

							if ($this->upload->do_upload("signature")) {
								$signature = $this->upload->data();

								/* PATH */
								$source = "./asset/foto_pegawai/signature/" . $signature['file_name'];
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
								$img['width'] = $limit_use > $limit_thumb ?  $signature['image_width'] * $percent_thumb : $signature['image_width'];
								$img['height'] = $limit_use > $limit_thumb ?  $signature['image_height'] * $percent_thumb : $signature['image_height'];

								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality'] = '100%';
								$img['source_image'] = $source;
								$img['new_image'] = $destination_thumb;

								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear();

								////// Making MEDIUM /////////////
								$img['width'] = $limit_use > $limit_medium ?  $signature['image_width'] * $percent_medium : $signature['image_width'];
								$img['height'] = $limit_use > $limit_medium ?  $signature['image_height'] * $percent_medium : $signature['image_height'];

								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%';
								$img['source_image'] = $source;
								$img['new_image']    = $destination_medium;

								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear();

								//update signature name to tabel pegawai
								$this->db->update("tbl_data_pegawai", ['signature' => $signature['file_name']], $id_pegawai);
							}
						}

						//insert to table user login		
						$login = array(
							'username' => $in['nrk'],
							'password' => md5('123456AppSimpeg32'), //default password : 123456
							'nama_lengkap' => $in['nama_pegawai'],
							'stts' => 'publik',
							'id_pegawai' => $id_pegawai,
							'id_lokasi_kerja' => $in['lokasi_kerja']
						);
						$this->db->insert("tbl_user_login", $login);
						$id_user_login = $this->db->insert_id();

						//insert riwayat keluarga
						$counter_keluarga = $this->input->post('counterFrmKeluarga');
						if ($counter_keluarga > 0) {
							$keluargas = [
								'nama_anggota_keluarga' => $this->input->post('frmKeluarga_nama_anggota_keluarga'),
								'hub_keluarga' => $this->input->post('frmKeluarga_hub_keluarga'),
								'jenis_kelamin' => $this->input->post('frmKeluarga_jenis_kelamin'),
								'tanggal_lahir_keluarga' => $this->input->post('frmKeluarga_tanggal_lahir'),
								'uraian' => $this->input->post('frmKeluarga_keterangan'),
								'title' => $this->input->post('frmKeluarga_title'),
								'file' => $_FILES['frmKeluarga_file']
							];

							for ($i = 0; $i <= $counter_keluarga; $i++) {
								if (isset($keluargas['nama_anggota_keluarga'][$i])) {
									$keluarga = [
										'id_pegawai' => $id_pegawai,
										'nama_anggota_keluarga' => $keluargas['nama_anggota_keluarga'][$i],
										'hub_keluarga' => $keluargas['hub_keluarga'][$i],
										'jenis_kelamin' => $keluargas['jenis_kelamin'][$i],
										'tanggal_lahir_keluarga' => $keluargas['tanggal_lahir_keluarga'][$i],
										'uraian' => $keluargas['uraian'][$i]
									];
									$this->db->insert('tbl_data_keluarga', $keluarga);
									$id_data_keluarga = $this->db->insert_id();

									if ($id_data_keluarga != 0) {
										//insert into arsip
										if (isset($keluargas['title'][$i]) && isset($keluargas['file']['name'][$i])) {
											if ($keluargas['file']['name'][$i] != '') {
												$arsip = [
													'id_data_keluarga' => $id_data_keluarga,
													'title' => $keluargas['title'][$i],
													'file' => [
														'name' => $keluargas['file']['name'][$i],
														'type' => $keluargas['file']['type'][$i],
														'tmp_name' => $keluargas['file']['tmp_name'][$i],
														'error' => $keluargas['file']['error'][$i],
														'size' => $keluargas['file']['size'][$i]
													]
												];

												$this->save_arsip_pribadi($arsip);
											}
										}
									}
									usleep(100);
								}
							}
						}

						//insert riwayat pangkat
						$counter_pangkat = $this->input->post('counterFrmPangkat');
						if ($counter_pangkat > 0) {
							$pangkats = [
								'id_golongan' => $this->input->post('frmPangkat_id_golongan'),
								'lokasi_kerja' => $this->input->post('frmPangkat_lokasi_kerja'),
								'nomor_sk' => $this->input->post('frmPangkat_nomor_sk'),
								'tanggal_sk' => $this->input->post('frmPangkat_tanggal_sk'),
								'tanggal_mulai' => $this->input->post('frmPangkat_tanggal_mulai'),
								'file' => $_FILES['frmPangkat_file']
							];

							for ($i = 0; $i <= $counter_pangkat; $i++) {
								if (isset($pangkats['id_golongan'][$i])) {
									$pangkat = [
										'id_pegawai' => $id_pegawai,
										'id_golongan' => $pangkats['id_golongan'][$i],
										'lokasi_kerja' => $pangkats['lokasi_kerja'][$i],
										'nomor_sk' => $pangkats['nomor_sk'][$i],
										'tanggal_sk' => $pangkats['tanggal_sk'][$i],
										'tanggal_mulai' => $pangkats['tanggal_mulai'][$i]
									];

									$this->db->insert('tbl_data_riwayat_pangkat', $pangkat);
									$id_riwayat_pangkat = $this->db->insert_id();

									if ($id_riwayat_pangkat != 0) {
										//insert into arsip
										if (isset($pangkats['id_golongan'][$i]) && isset($pangkats['file']['name'][$i])) {
											if ($pangkats['file']['name'][$i] != '') {
												$arsip = [
													'id_ref' => $id_riwayat_pangkat,
													'id_jenis_sk' => 2, //pangkat
													'title' => $this->tbl_data_riwayat_pangkat->getGolonganName($pangkats['id_golongan'][$i]),
													'file' => [
														'name' => $pangkats['file']['name'][$i],
														'type' => $pangkats['file']['type'][$i],
														'tmp_name' => $pangkats['file']['tmp_name'][$i],
														'error' => $pangkats['file']['error'][$i],
														'size' => $pangkats['file']['size'][$i]
													]
												];

												$this->save_arsip_pangkat($arsip);
											}
										}
									}
								}
								usleep(100);
							}
						}

						//insert riwayat jabatan
						$counter_jabatan = $this->input->post('counterFrmJabatan');
						if ($counter_jabatan > 0) {
							$jabatans = [
								'id_riwayat_status_jabatan' => $this->input->post('frmJabatan_id_riwayat_status_jabatan'),
								'id_r_jabatan' => $this->input->post('frmJabatan_id_r_jabatan'),
								'lokasi' => $this->input->post('frmJabatan_lokasi'),
								'tmt_mulai_jabatan' => $this->input->post('frmJabatan_tmt_mulai_jabatan'),
								'nomor_sk' => $this->input->post('frmJabatan_nomor_sk'),
								'tgl_sk_jabatan' => $this->input->post('frmJabatan_tgl_sk_jabatan'),
								'title' => $this->input->post('frmJabatan_title'),
								'file' => $_FILES['frmJabatan_file']
							];

							for ($i = 0; $i <= $counter_jabatan; $i++) {
								if (isset($jabatans['title'][$i])) {
									$jabatan = [
										'id_pegawai' => $id_pegawai,
										'id_riwayat_status_jabatan' => $jabatans['id_riwayat_status_jabatan'][$i],
										'id_r_jabatan' => $jabatans['id_r_jabatan'][$i],
										'lokasi' => $jabatans['lokasi'][$i],
										'tmt_mulai_jabatan' => $jabatans['tmt_mulai_jabatan'][$i],
										'nomor_sk' => $jabatans['nomor_sk'][$i],
										'tgl_sk_jabatan' => $jabatans['tgl_sk_jabatan'][$i]
									];

									$this->db->insert('tbl_data_riwayat_jabatan', $jabatan);
									$id_riwayat_jabatan = $this->db->insert_id();

									if ($id_riwayat_jabatan != 0) {
										//insert into arsip
										if (isset($jabatans['title'][$i]) && isset($jabatans['file']['name'][$i])) {
											if ($jabatans['file']['name'][$i] != '') {
												$arsip = [
													'id_ref' => $id_riwayat_jabatan,
													'id_jenis_sk' => 3, //jabatan
													'title' => $jabatans['title'][$i],
													'file' => [
														'name' => $jabatans['file']['name'][$i],
														'type' => $jabatans['file']['type'][$i],
														'tmp_name' => $jabatans['file']['tmp_name'][$i],
														'error' => $jabatans['file']['error'][$i],
														'size' => $jabatans['file']['size'][$i]
													]
												];

												$this->save_arsip_jabatan($arsip);
											}
										}
									}
								}
								usleep(100);
							}
						}

						//insert riwayat pendidikan
						$counter_pendidikan = $this->input->post('counterFrmPendidikan');
						if ($counter_pendidikan > 0) {
							$pendidikans = [
								'id_master_pendidikan' => $this->input->post('frmPendidikan_id_master_pendidikan'),
								'jurusan' => $this->input->post('frmPendidikan_jurusan'),
								'tempat_sekolah' => $this->input->post('frmPendidikan_tempat_sekolah'),
								'kota' => $this->input->post('frmPendidikan_kota'),
								'nomor_sttb' => $this->input->post('frmPendidikan_nomor_sttb'),
								'tanggal_lulus' => $this->input->post('frmPendidikan_tanggal_lulus'),
								'title' => $this->input->post('frmPendidikan_title'),
								'file' => $_FILES['frmPendidikan_file']
							];

							for ($i = 0; $i <= $counter_pendidikan; $i++) {
								if (isset($pendidikans['id_master_pendidikan'][$i])) {
									$pendidikan = [
										'id_pegawai' => $id_pegawai,
										'id_master_pendidikan' => $pendidikans['id_master_pendidikan'][$i],
										'jurusan' => $pendidikans['jurusan'][$i],
										'tempat_sekolah' => $pendidikans['tempat_sekolah'][$i],
										'kota' => $pendidikans['kota'][$i],
										'nomor_sttb' => $pendidikans['nomor_sttb'][$i],
										'tanggal_lulus' => $pendidikans['tanggal_lulus'][$i]
									];
									$this->db->insert('tbl_data_pendidikan', $pendidikan);
									$id_pendidikan = $this->db->insert_id();

									if ($id_pendidikan != 0) {
										//insert into arsip
										if (isset($pendidikans['title'][$i]) && isset($pendidikans['file']['name'][$i])) {
											if ($pendidikans['file']['name'][$i] != '') {
												$arsip = [
													'id_pendidikan' => $id_pendidikan,
													'title' => $pendidikans['title'][$i],
													'id_tipe_pendidikan' => 1, //formal
													'type' => 'pendidikan',
													'file' => [
														'name' => $pendidikans['file']['name'][$i],
														'type' => $pendidikans['file']['type'][$i],
														'tmp_name' => $pendidikans['file']['tmp_name'][$i],
														'error' => $pendidikans['file']['error'][$i],
														'size' => $pendidikans['file']['size'][$i]
													]
												];

												$this->save_arsip_pendidikan($arsip);
											}
										}
									}
								}
								usleep(100);
							}
						}

						//insert riwayat pelatihan
						$counter_pelatihan = $this->input->post('counterFrmPelatihan');
						if ($counter_pelatihan > 0) {
							$pelatihans = [
								'id_master_pelatihan' => $this->input->post('frmPelatihan_id_master_pelatihan'),
								'nama_pelatihan_lainnya' => $this->input->post('frmPelatihan_nama_pelatihan_lainnya'),
								'lokasi' => $this->input->post('frmPelatihan_lokasi'),
								'no_sertifikat' => $this->input->post('frmPelatihan_no_sertifikat'),
								'tanggal_sertifikat' => $this->input->post('frmPelatihan_tanggal_sertifikat'),
								'kota' => $this->input->post('frmPelatihan_kota'),
								'uraian' => $this->input->post('frmPelatihan_uraian'),
								'title' => $this->input->post('frmPelatihan_title'),
								'file' => $_FILES['frmPelatihan_file']
							];

							for ($i = 0; $i <= $counter_pelatihan; $i++) {
								if (isset($pelatihans['id_master_pelatihan'][$i])) {
									$pelatihan = [
										'id_pegawai' => $id_pegawai,
										'id_master_pelatihan' => $pelatihans['id_master_pelatihan'][$i],
										'nama_pelatihan_lainnya' => $pelatihans['nama_pelatihan_lainnya'][$i],
										'lokasi' => $pelatihans['lokasi'][$i],
										'no_sertifikat' => $pelatihans['no_sertifikat'][$i],
										'tanggal_sertifikat' => $pelatihans['tanggal_sertifikat'][$i],
										'kota' => $pelatihans['kota'][$i],
										'uraian' => $pelatihans['uraian'][$i]
									];
									$this->db->insert('tbl_data_pelatihan', $pelatihan);
									$id_pelatihan = $this->db->insert_id();

									if ($id_pelatihan != 0) {
										//insert into arsip
										if (isset($pelatihans['title'][$i]) && isset($pelatihans['file']['name'][$i])) {
											if ($pelatihans['file']['name'][$i] != '') {
												$arsip = [
													'id_pelatihan' => $id_pelatihan,
													'title' => $pelatihans['title'][$i],
													'type' => 'pelatihan',
													'file' => [
														'name' => $pelatihans['file']['name'][$i],
														'type' => $pelatihans['file']['type'][$i],
														'tmp_name' => $pelatihans['file']['tmp_name'][$i],
														'error' => $pelatihans['file']['error'][$i],
														'size' => $pelatihans['file']['size'][$i]
													]
												];

												$this->save_arsip_pelatihan($arsip);
											}
										}
									}
								}
								usleep(100);
							}
						}

						//insert riwayat penghargaan
						$counter_penghargaan = $this->input->post('counterFrmPenghargaan');
						if ($counter_penghargaan > 0) {
							$penghargaans = [
								'id_master_penghargaan' => $this->input->post('frmPenghargaan_id_master_penghargaan'),
								'nama_penghargaan_lainnya' => $this->input->post('frmPenghargaan_nama_penghargaan_lainnya'),
								'pemberi_penghargaan' => $this->input->post('frmPenghargaan_pemberi_penghargaan'),
								'nomor_sk' => $this->input->post('frmPenghargaan_nomor_sk'),
								'tgl_sk_penghargaan' => $this->input->post('frmPenghargaan_tgl_sk_penghargaan'),
								'title' => $this->input->post('frmPenghargaan_title'),
								'file' => $_FILES['frmPenghargaan_file']
							];

							for ($i = 0; $i <= $counter_penghargaan; $i++) {
								if (isset($penghargaans['id_master_penghargaan'][$i])) {
									$penghargaan = [
										'id_pegawai' => $id_pegawai,
										'id_master_penghargaan' => $penghargaans['id_master_penghargaan'][$i],
										'nama_penghargaan_lainnya' => $penghargaans['nama_penghargaan_lainnya'][$i],
										'pemberi_penghargaan' => $penghargaans['pemberi_penghargaan'][$i],
										'nomor_sk' => $penghargaans['nomor_sk'][$i],
										'tgl_sk_penghargaan' => $penghargaans['tgl_sk_penghargaan'][$i]
									];
									$this->db->insert('tbl_data_penghargaan', $penghargaan);
									$id_penghargaan = $this->db->insert_id();

									if ($id_penghargaan != 0) {
										//insert into arsip
										if (isset($penghargaans['title'][$i]) && isset($penghargaans['file']['name'][$i])) {
											if ($penghargaans['file']['name'][$i] != '') {
												$arsip = [
													'id_ref' => $id_penghargaan,
													'id_jenis_sk' => 5, //penghargaan
													'title' => $penghargaans['title'][$i],
													'file' => [
														'name' => $penghargaans['file']['name'][$i],
														'type' => $penghargaans['file']['type'][$i],
														'tmp_name' => $penghargaans['file']['tmp_name'][$i],
														'error' => $penghargaans['file']['error'][$i],
														'size' => $penghargaans['file']['size'][$i]
													]
												];

												$this->save_arsip_penghargaan($arsip);
											}
										}
									}
								}
								usleep(100);
							}
						}

						//insert riwayat tubel
						$counter_tubel = $this->input->post('counterFrmTubel');
						if ($counter_tubel > 0) {
							$tubels = [
								'uraian' => $this->input->post('frmTubel_uraian'),
								'no_sk' => $this->input->post('frmTubel_no_sk'),
								'tgl_sk' => $this->input->post('frmTubel_tgl_sk'),
								'tgl_mulai' => $this->input->post('frmTubel_tgl_mulai'),
								'tgl_selesai' => $this->input->post('frmTubel_tgl_selesai'),
								'sekolah' => $this->input->post('frmTubel_sekolah'),
								'akreditasi' => $this->input->post('frmTubel_akreditasi'),
								'jurusan' => $this->input->post('frmTubel_jurusan'),
								'title' => $this->input->post('frmTubel_title'),
								'file' => $_FILES['frmPenghargaan_file']
							];

							for ($i = 0; $i <= $counter_tubel; $i++) {
								if (isset($tubels['uraian'][$i])) {
									$tubel = [
										'id_pegawai' => $id_pegawai,
										'uraian' => $tubels['uraian'][$i],
										'no_sk' => $tubels['no_sk'][$i],
										'tgl_sk' => $tubels['tgl_sk'][$i],
										'tgl_mulai' => $tubels['tgl_mulai'][$i],
										'tgl_selesai' => $tubels['tgl_selesai'][$i],
										'sekolah' => $tubels['sekolah'][$i],
										'akreditasi' => $tubels['akreditasi'][$i],
										'jurusan' => $tubels['jurusan'][$i]
									];

									$this->db->insert('tbl_data_tubel', $tubel);
									$id_tubel = $this->db->insert_id();

									if ($id_tubel != 0) {
										//insert into arsip
										if (isset($tubels['title'][$i]) && isset($tubels['file']['name'][$i])) {
											if ($tubels['file']['name'][$i] != '') {
												$arsip = [
													'id_ref' => $id_tubel,
													'id_jenis_sk' => 1, //tubel
													'title' => $tubels['title'][$i],
													'file' => [
														'name' => $tubels['file']['name'][$i],
														'type' => $tubels['file']['type'][$i],
														'tmp_name' => $tubels['file']['tmp_name'][$i],
														'error' => $tubels['file']['error'][$i],
														'size' => $tubels['file']['size'][$i]
													]
												];

												$this->save_arsip_tubel($arsip);
											}
										}
									}
								}
								usleep(100);
							}
						}

						//insert riwayat skp
						$counter_skp = $this->input->post('counterFrmSkp');
						if ($counter_skp > 0) {
							$skps = [
								'uraian' => $this->input->post('frmSkp_uraian'),
								'orientasi' => $this->input->post('frmSkp_orientasi'),
								'integritas' => $this->input->post('frmSkp_integritas'),
								'komitmen' => $this->input->post('frmSkp_komitmen'),
								'disiplin' => $this->input->post('frmSkp_disiplin'),
								'kesetiaan' => $this->input->post('frmSkp_kesetiaan'),
								'prestasi' => $this->input->post('frmSkp_prestasi'),
								'tanggung_jawab' => $this->input->post('frmSkp_tanggung_jawab'),
								'ketaatan' => $this->input->post('frmSkp_ketaatan'),
								'kejujuran' => $this->input->post('frmSkp_kejujuran'),
								'kerjasama' => $this->input->post('frmSkp_kerjasama'),
								'prakarsa' => $this->input->post('frmSkp_prakarsa'),
								'kepemimpinan' => $this->input->post('frmSkp_kepemimpinan'),
								'rata_rata' => $this->input->post('frmSkp_rata_rata'),
								'atasan' => $this->input->post('frmSkp_atasan'),
								'penilai' => $this->input->post('frmSkp_penilai'),
								'title' => $this->input->post('frmSkp_title'),
								'file' => $_FILES['frmSkp_file']
							];

							for ($i = 0; $i <= $counter_skp; $i++) {
								if (isset($skps['uraian'][$i])) {
									$skp = [
										'id_pegawai' => $id_pegawai,
										'uraian' => $skps['uraian'][$i],
										'orientasi' => $skps['orientasi'][$i],
										'integritas' => $skps['integritas'][$i],
										'komitmen' => $skps['komitmen'][$i],
										'disiplin' => $skps['disiplin'][$i],
										'kesetiaan' => $skps['kesetiaan'][$i],
										'prestasi' => $skps['prestasi'][$i],
										'tanggung_jawab' => $skps['tanggung_jawab'][$i],
										'ketaatan' => $skps['ketaatan'][$i],
										'kejujuran' => $skps['kejujuran'][$i],
										'kerjasama' => $skps['kerjasama'][$i],
										'prakarsa' => $skps['prakarsa'][$i],
										'kepemimpinan' => $skps['kepemimpinan'][$i],
										'rata_rata' => $skps['rata_rata'][$i],
										'atasan' => $skps['atasan'][$i],
										'penilai' => $skps['penilai'][$i]
									];
									$this->db->insert('tbl_data_dp3', $skp);
									$id_dp3 = $this->db->insert_id();

									if ($id_dp3 != 0) {
										//insert into arsip
										if (isset($skps['title'][$i]) && isset($skps['file']['name'][$i])) {
											if ($skps['file']['name'][$i] != '') {
												$arsip = [
													'id_dp3' => $id_dp3,
													'title' => $skps['title'][$i],
													'type' => 'skp',
													'file' => [
														'name' => $skps['file']['name'][$i],
														'type' => $skps['file']['type'][$i],
														'tmp_name' => $skps['file']['tmp_name'][$i],
														'error' => $skps['file']['error'][$i],
														'size' => $skps['file']['size'][$i]
													]
												];

												$this->save_arsip_skp($arsip);
											}
										}
									}
								}
								usleep(100);
							}
						}
					} else {
						//failed insert to tabel pegawai
						echo 'failed insert to pegawai';
					}

					$this->session->set_flashdata('suksestambah', 'Data Berhasil Di Tambah...');

					#insert ke sso
					// $this->load->helper('sso_user');
					// $user_sso = SSOInsOrUpdUser($this->input->post('nrk'));

					// if ($user_sso['status'] == 'success') {
					// 	$acc_user = SSOUserAccessApp($this->input->post('nrk'));
					// 	print_r($acc_user);
					// }

					#-------tambahkan lokasi pegawai ke gis
					$nama = $this->input->post("nama_pegawai");
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
						redirect(base_url() . 'admin/dashboard_admin');
					} else {
						redirect(base_url() . 'admin/dashboard_admin');
						// echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
						// echo '<script type="text/javascript">',
						// 'var url = "https://tataruang.jakarta.go.id/server/rest/services/SIADIK/PegawaiSiadik/FeatureServer/0/query?where=nrk=%27' . $nrk . '%27&outFields=objectid&f=json";
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
						// 								geometry: { x: ' . $longitude . ', y: ' . $latitude . ' },
						// 								attributes: {
						// 									namapegawai: "' . $nama . '",
						// 									nip: ' . $nip . ',
						// 									nrk: ' . $nrk . ',
						// 									email: "' . $email . '",
						// 									alamat: "' . $alamat . '",
						// 									provinsi: "' . $provinsi . '",
						// 									kota : "' . $kota . '",
						// 									kecamatan : "' . $kecamatan . '",
						// 									kelurahan  : "' . $kelurahan . '",
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
						// 								geometry: { x: ' . $longitude . ', y: ' . $latitude . ' },
						// 								attributes: {
						// 									objectid: objectid,
						// 									namapegawai: "' . $nama . '",
						// 									nip: ' . $nip . ',
						// 									nrk: ' . $nrk . ',
						// 									email: "' . $email . '",
						// 									alamat: "' . $alamat . '",
						// 									provinsi: "' . $provinsi . '",
						// 									kota : "' . $kota . '",
						// 									kecamatan : "' . $kecamatan . '",
						// 									kelurahan  : "' . $kelurahan . '",
															
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
						// 							window.location = "' . base_url() . 'admin/dashboard_admin";
						// 						}
						// 					});
						// 				}
						// 			});',
						// '</script>';
						#------- end tambahkan lokasi pegawai ke gis
					}


					//redirect (base_url() . 'admin/dashboard_admin');
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_sk()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_pegawai", $id);

			foreach ($q->result() as $data) {
				if ($name == "") {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'pegawai/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				} else {
					$dir = "SK" . $id['id_pegawai'];
					$file = file_get_contents('asset/upload/SK/' . $dir . '/' . $name); // letak file pada aplikasi kita
					force_download($name, $file);
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_pribadi()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_pegawai", $id);

			foreach ($q->result() as $data) {
				if ($name == "") {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'pegawai/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				} else {
					$dir = "pribadi" . $id['id_pegawai'];
					$file = file_get_contents('asset/upload/pribadi/' . $dir . '/' . $name); // letak file pada aplikasi kita
					force_download($name, $file);
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_pendidikan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_pegawai", $id);

			foreach ($q->result() as $data) {
				if ($name == "") {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'pegawai/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				} else {
					$dir = "pendidikan" . $id['id_pegawai'];
					$file = file_get_contents('asset/upload/pendidikan/' . $dir . '/' . $name); // letak file pada aplikasi kita
					force_download($name, $file);
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_skp()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_pegawai", $id);

			foreach ($q->result() as $data) {
				if ($name == "") {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'pegawai/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				} else {
					$dir = "SKP" . $id['id_pegawai'];
					$file = file_get_contents('asset/upload/SKP/' . $dir . '/' . $name); // letak file pada aplikasi kita
					force_download($name, $file);
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_all_sk()
	{
		$this->load->library(array('Zip', 'MY_Zip')); // load library zip dan my zip
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$data = $this->db->query("select a.nama_pegawai, a.id_pegawai, b.nama_lampiran, b.id_user from tbl_data_pegawai a left join tbl_lampiran_sk b on a.id_pegawai=b.id_user where a.id_pegawai='" . $id['id_pegawai'] . "'");

			foreach ($data->result_array() as $ds) {
				if ($ds['id_user'] == $ds['id_pegawai']) {
					$folder_nama = "SK" . $ds['id_pegawai'];
					$path = "asset/upload/SK/" . $folder_nama . "/"; // folder yang ingin kita download
					$folder_in_zip = "/";  // tujuan sementara folder zip
					$this->zip->get_files_from_folder($path, $folder_in_zip);
					$this->zip->download($folder_nama);
				} else {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'home/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_all_pribadi()
	{
		$this->load->library(array('Zip', 'MY_Zip')); // load library zip dan my zip
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$data = $this->db->query("select a.nama_pegawai, a.id_pegawai, b.nama_lampiran, b.id_user from tbl_data_pegawai a left join tbl_lampiran_pribadi b on a.id_pegawai=b.id_user where a.id_pegawai='" . $id['id_pegawai'] . "'");

			foreach ($data->result_array() as $dp) {
				if ($dp['id_user'] == $dp['id_pegawai']) {
					$folder_nama = "pribadi" . $dp['id_pegawai'];
					$path = "asset/upload/pribadi/" . $folder_nama . "/"; // folder yang ingin kita download
					$folder_in_zip = "/";  // tujuan sementara folder zip
					$this->zip->get_files_from_folder($path, $folder_in_zip);
					$this->zip->download($dp['nama_pegawai']);
				} else {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'home/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_all_pendidikan()
	{
		$this->load->library(array('Zip', 'MY_Zip')); // load library zip dan my zip
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$data = $this->db->query("select a.nama_pegawai, a.id_pegawai, b.nama_lampiran, b.id_user from tbl_data_pegawai a left join tbl_lampiran_pendidikan b on a.id_pegawai=b.id_user where a.id_pegawai='" . $id['id_pegawai'] . "'");

			foreach ($data->result_array() as $dpe) {
				if ($dpe['id_user'] == $dpe['id_pegawai']) {
					$folder_nama = "pendidikan" . $dpe['id_pegawai'];
					$path = "asset/upload/pendidikan/" . $folder_nama . "/"; // folder yang ingin kita download
					$folder_in_zip = "/";  // tujuan sementara folder zip
					$this->zip->get_files_from_folder($path, $folder_in_zip);
					$this->zip->download($dpe['nama_pegawai']);
				} else {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'home/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function download_all_skp()
	{
		$this->load->library(array('Zip', 'MY_Zip')); // load library zip dan my zip
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" or "operator") {
			$id['id_pegawai'] = $this->uri->segment(3);
			$data = $this->db->query("select a.nama_pegawai, a.id_pegawai, b.nama_lampiran, b.id_user from tbl_data_pegawai a left join tbl_lampiran_skp b on a.id_pegawai=b.id_user where a.id_pegawai='" . $id['id_pegawai'] . "'");

			foreach ($data->result_array() as $dpe) {
				if ($dpe['id_user'] == $dpe['id_pegawai']) {
					$folder_nama = "SKP" . $dpe['id_pegawai'];
					$path = "asset/upload/SKP/" . $folder_nama . "/"; // folder yang ingin kita download
					$folder_in_zip = "/";  // tujuan sementara folder zip
					$this->zip->get_files_from_folder($path, $folder_in_zip);
					$this->zip->download($dpe['nama_pegawai']);
				} else {
					ob_start();
					echo "<script>alert('Belum Ada Data Yang Dilampirkan')</script>";
					redirect(base_url() . 'home/detail/' . $this->session->userdata("id_pegawai") . '', 'refresh');
				}
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
		redirect(base_url() . 'pegawai/edit/' . $this->session->userdata("id_pegawai") . '', 'refresh');
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
		redirect(base_url() . 'pegawai/edit/' . $this->session->userdata("id_pegawai") . '', 'refresh');
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
			$this->session->set_flashdata('deletelamp3', 'LAMPIRAN BERHASIL DI HAPUS...');
		}
		$this->db->delete('tbl_lampiran_pendidikan', array('id_pendidikan' => $deleteid));
		redirect(base_url() . 'pegawai/edit/' . $this->session->userdata("id_pegawai") . '', 'refresh');
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
			$this->session->set_flashdata('deletelamp4', 'LAMPIRAN BERHASIL DI HAPUS...');
		}
		$this->db->delete('tbl_lampiran_skp', array('id_skp' => $deleteid));
		redirect(base_url() . 'pegawai/edit/' . $this->session->userdata("id_pegawai") . '', 'refresh');
	}

	public function sub_lokasi_kerja_by_lokasi_kerja()
	{
		$this->load->model('sub_lokasi_kerja_model');
		$id = $this->input->post('id_lokasi_kerja');
		$data = $this->sub_lokasi_kerja_model->list_by_lokasi_kerja($id);
		echo ($data);
	}

	// public function sub_lokasi_kerja_by_lokasi_kerja() {
	// 	if (!$this->input->is_ajax_request()) {
	// 	   show_404();
	// 	}
	// 	$data = '';
	// 	$id_lokasi_kerja = $this->input->post('id_lokasi_kerja');
	// 	$id_sublokasi_kerja = $this->input->post('seksi');
	// 	#jika dinas maka harus isi sublokasi kerja terlebih dahulu
	// 	if($id_lokasi_kerja=='52'){
	// 		$data .='';
	// 	} else {
	// 		$ak = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja WHERE C='$id_lokasi_kerja'")->result();
	// 		$data .= "<option value=''></option>";
	// 		foreach ($ak as $o) {
	// 			if ($o->id_sublokasi_kerja==$id_sublokasi_kerja) {
	// 				$cek = " selected";
	// 			}
	// 			else {
	// 				$cek = "";
	// 			}
	// 			$data .= "<option value='$o->id_lokasi_kerja' $cek>$o->lokasi</option>";
	// 		}
	// 	}
	// 	echo $data;
	// }

	function save_arsip_pribadi($obj)
	{
		$arsip = [
			'id_data_keluarga' => $obj['id_data_keluarga'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_pribadi_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_data_keluarga'],
				'id_arsip' => $id_arsip,
				'type' => 'pribadi'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_pribadi_model->update(['id_arsip_pribadi' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function save_arsip_pangkat($obj)
	{
		$arsip = [
			'id_ref' => $obj['id_ref'],
			'id_jenis_sk' => $obj['id_jenis_sk'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_sk_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_ref'],
				'id_arsip' => $id_arsip,
				'id_jenis_sk' => $arsip['id_jenis_sk'],
				'type' => 'sk'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_sk_model->update(['id_arsip_sk' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function save_arsip_jabatan($obj)
	{
		$arsip = [
			'id_ref' => $obj['id_ref'],
			'id_jenis_sk' => $obj['id_jenis_sk'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_sk_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_ref'],
				'id_arsip' => $id_arsip,
				'id_jenis_sk' => $arsip['id_jenis_sk'],
				'type' => 'sk'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_sk_model->update(['id_arsip_sk' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function save_arsip_pendidikan($obj)
	{
		$arsip = [
			'id_pendidikan' => $obj['id_pendidikan'],
			'id_tipe_pendidikan' => $obj['id_tipe_pendidikan'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_pendidikan_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_pendidikan'],
				'id_arsip' => $id_arsip,
				'id_tipe_pendidikan' => $obj['id_tipe_pendidikan'],
				'type' => 'pendidikan'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_pendidikan_model->update(['id_arsip_pendidikan' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function save_arsip_pelatihan($obj)
	{
		$arsip = [
			'id_pelatihan' => $obj['id_pelatihan'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_pelatihan_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_pelatihan'],
				'id_arsip' => $id_arsip,
				'type' => 'pelatihan'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_pelatihan_model->update(['id_arsip_pelatihan' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function save_arsip_penghargaan($obj)
	{
		$arsip = [
			'id_ref' => $obj['id_ref'],
			'id_jenis_sk' => $obj['id_jenis_sk'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_sk_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_ref'],
				'id_arsip' => $id_arsip,
				'id_jenis_sk' => $arsip['id_jenis_sk'],
				'type' => 'sk'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_sk_model->update(['id_arsip_sk' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function save_arsip_tubel($obj)
	{
		$arsip = [
			'id_ref' => $obj['id_ref'],
			'id_jenis_sk' => $obj['id_jenis_sk'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_sk_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_ref'],
				'id_arsip' => $id_arsip,
				'id_jenis_sk' => $arsip['id_jenis_sk'],
				'type' => 'sk'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_sk_model->update(['id_arsip_sk' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function save_arsip_skp($obj)
	{
		$arsip = [
			'id_dp3' => $obj['id_dp3'],
			'title' => $obj['title'],
			'file_name_ori' => $obj['file']['name'],
			'created_id' => $this->session->userdata('id_pegawai'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$id_arsip = $this->arsip_skp_model->save($arsip);

		if ($id_arsip != 0) {
			//upload file
			$upload_file = [
				'file' => $obj['file'],
				'id_ref' => $arsip['id_dp3'],
				'id_arsip' => $id_arsip,
				'type' => 'skp'
			];

			$file_name = $this->upload_arsip($upload_file);

			if ($file_name != '') {
				//update filename
				$this->arsip_skp_model->update(['id_arsip_skp' => $id_arsip], ['file_name' => $file_name]);
			}
		}
	}

	function upload_arsip($obj)
	{
		$dir = '';
		switch ($obj['type']) {
			case 'pribadi':
				$dir = 'pribadi_' . $obj['id_ref'] . '_' . $obj['id_arsip'];
				$path = './asset/upload/pribadi/' . $dir;
				break;
			case 'sk':
				$dir = 'SK_' . $obj['id_jenis_sk'] . '_' . $obj['id_ref'] . '_' . $obj['id_arsip'];
				$path = './asset/upload/SK/' . $dir;
				break;
			case 'pendidikan':
				$dir = 'pendidikan_' . $obj['id_tipe_pendidikan'] . '_' . $obj['id_ref'] . '_' . $obj['id_arsip'];
				$path = './asset/upload/pendidikan/' . $dir;
				break;
			case 'pelatihan':
				$dir = 'pelatihan_' . $obj['id_ref'] . '_' . $obj['id_arsip'];
				$path = './asset/upload/pelatihan/' . $dir;
				break;
			case 'penghargaan':
				$dir = 'penghargaan_' . $obj['id_ref'] . '_' . $obj['id_arsip'];
				$path = './asset/upload/penghargaan/' . $dir;
				break;
			case 'skp':
				$dir = 'SKP_' . $obj['id_ref'] . '_' . $obj['id_arsip'];
				$path = './asset/upload/SKP/' . $dir;
				break;
		}

		$config['upload_path']          = $path;
		$config['allowed_types']        = "gif|jpg|jpeg|png|pdf";
		$config['max_size']             = 50000; //set max size allowed in Kilobyte

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0775, TRUE);
		}

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$_FILES['file']['name'] = $obj['file']['name'];
		$_FILES['file']['type'] = $obj['file']['type'];
		$_FILES['file']['tmp_name'] = $obj['file']['tmp_name'];
		$_FILES['file']['error'] = $obj['file']['error'];
		$_FILES['file']['size'] = $obj['file']['size'];
		if (!$this->upload->do_upload_custom($obj['file'])) {
			return '';
		}

		return $this->upload->data('file_name');
	}

	public function modal_signature()
	{
		$Id = $this->input->post('Id');
		$a['Id'] = $Id;
		$a['data'] = $this->db->query("SELECT * FROM tbl_data_pegawai WHERE id_pegawai='$Id'")->row();

		$this->load->view('dashboard_admin/home/signature/modal_signature', $a);
	}

	public function grafik_status()
	{
		$status_data = $this->db->query('SELECT id_status_pegawai, nama_status 
										FROM tbl_master_status_pegawai 
										WHERE id_status_pegawai is not null
										ORDER BY no_urut ASC')->result();
		$a['status_data'] 	= $status_data;

		$pegawai_data = $this->db->query('SELECT id_status_pegawai, status_pegawai, nama_status, count(*) as jml
											FROM tbl_data_pegawai 
											LEFT JOIN (
												SELECT id_status_pegawai, nama_status, no_urut 
												FROM tbl_master_status_pegawai
											) AS sp ON sp.id_status_pegawai = status_pegawai
											WHERE id_status_pegawai is not null
											GROUP BY status_pegawai ORDER BY no_urut')->result();
		$a['pegawai_data'] 	= $pegawai_data;

		// $a['data_tanggal'] = $this->db->query("SELECT x.Tanggal FROM kalender_kerja as x 
		// 											WHERE x.StatusHari = 'HK' AND x.Tanggal BETWEEN (DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)) AND (DATE_SUB(CURRENT_DATE(), INTERVAL 0 DAY))")->result();

		$this->load->view('dashboard_admin/home/grafik/grafik_status', $a, FALSE);
	}

	public function grafik_pensiun()
	{
		$user_view = $this->session->userdata('username');
		$condLokasi = 'where 1=1';
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
			$condLokasi .= ' and b.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
		}

		$q = $this->db->query("SELECT 
		sum(CASE WHEN w_6b = '1' THEN 1 else 0 END) as jum_6b,
		sum(CASE WHEN w_12b = '1' THEN 1 else 0 END) as jum_12b,
		sum(CASE WHEN w_18b = '1' THEN 1 else 0 END) as jum_18b,
		sum(CASE WHEN w_24b = '1' THEN 1 else 0 END) as jum_24b,
		sum(CASE WHEN w_30b = '1' THEN 1 else 0 END) as jum_30b
	
	FROM (
								select a.* from (
							select nip, nrk, nama_pegawai, tanggal_lahir as str_tgl_lahir, 
									str_to_date(substring(nip,1,8), '%Y%m%d') as date_tgl_lahir,
									id_jabatan, timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) as usia, 
									if (id_jabatan = 2351, ((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now())) * 1), 
										((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) * 1))
									) as masa_pensiun,
									if (id_jabatan = 2351, 
										(timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))), 
										(timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))) 
									) as masa_pensiun_bln,
									if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
										(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
									) as tgl_pensiun,
									
									DATE_SUB(
										if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
											(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
										)
										, INTERVAL 6 MONTH) as warning_6b,
									if(DATE_SUB(
										if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
											(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
										)
										, INTERVAL 6 MONTH) <= CURRENT_DATE(),'1', '0') as w_6b,
																	if(DATE_SUB(
										if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
											(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
										)
										, INTERVAL 12 MONTH) <= CURRENT_DATE(),'1', '0') as w_12b,
																	if(DATE_SUB(
										if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
											(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
										)
										, INTERVAL 18 MONTH) <= CURRENT_DATE(),'1', '0') as w_18b,
																			if(DATE_SUB(
																		 if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
																							(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
																					)
																					, INTERVAL 24 MONTH) <= CURRENT_DATE(),'1', '0') as w_24b,
																			if(DATE_SUB(
																			 if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
																								(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
																						)
																						, INTERVAL 30 MONTH) <= CURRENT_DATE(),'1', '0') as w_30b,
																			
																
									lokasi_kerja 
							from tbl_data_pegawai) a 
							where a.masa_pensiun > 0 $cond) DATA")->row();

		$a['pensiun'] 		= $q;
		$this->load->view('dashboard_admin/home/grafik/grafik_pensiun', $a, FALSE);
	}

	public function grafik_naikpangkat()
	{
		$user_view = $this->session->userdata('username');
		$condLokasi = 'where 1=1';
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
			$condLokasi .= ' and b.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
		}



		$q2 = $this->db->query("SELECT 
		sum(CASE WHEN w_6b = '1' THEN 1 else 0 END) as jum_6b,
		sum(CASE WHEN w_12b = '1' THEN 1 else 0 END) as jum_12b,
		sum(CASE WHEN w_18b = '1' THEN 1 else 0 END) as jum_18b,
		sum(CASE WHEN w_24b = '1' THEN 1 else 0 END) as jum_24b,
		sum(CASE WHEN w_30b = '1' THEN 1 else 0 END) as jum_30b 
	FROM (
					select c.*, 
						d.tanggal_sk, d.tanggal_mulai as tmt_pangkat_terakhir, 
						date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year) as tgl_naik_pangkat,
						if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 6 MONTH)<= CURRENT_DATE(),'1', '0') as w_6b,
						if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 12 MONTH)<= CURRENT_DATE(),'1', '0') as w_12b,
						if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 18 MONTH)<= CURRENT_DATE(),'1', '0') as w_18b,
						if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 24 MONTH)<= CURRENT_DATE(),'1', '0') as w_24b,
						if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 30 MONTH)<= CURRENT_DATE(),'1', '0') as w_30b,
						substr(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),1,4) as tahun_naik_pangkat,
						timestampdiff(day,now(),date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) as masa_hari_naik_pangkat,
						e.golongan, e.uraian
					from 
					(
						select b.id_pegawai, b.nama_pegawai, b.nip, b.nrk,jml,
								(
									select a.id_riwayat_pangkat
									from tbl_data_riwayat_pangkat a
									where a.id_pegawai = b.id_pegawai 
									order by date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year) desc 
									limit 1
								) as id_pangkat
						from tbl_data_pegawai b 
						LEFT JOIN(
							SELECT count(*) as jml, user_view, nrk as nomor_rk
							FROM naik_pangkat_see WHERE user_view='$user_view'
							GROUP BY user_view, nrk
						) as see ON see.nomor_rk = b.nrk
						" . $condLokasi . " 
					) c 
					left join tbl_data_riwayat_pangkat d on d.id_riwayat_pangkat = c.id_pangkat 
					left join tbl_master_golongan e on e.id_golongan = d.id_golongan
					where c.id_pangkat is not null 
					) DATA")->row();

		$a['naik_pangkat'] 	= $q2;
		$this->load->view('dashboard_admin/home/grafik/grafik_naikpangkat', $a, FALSE);
	}
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */