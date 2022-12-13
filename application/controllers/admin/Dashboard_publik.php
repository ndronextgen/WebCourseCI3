<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Publik extends CI_Controller {

	/*
		***	Controller : dashboard_publik.php
	*/
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_model');
		$this->load->model('riwayat_jabatan_model');
		$this->load->model('history_srt_ket_model');
	}
	
	public function index()
	{
			if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
			{
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				
				$id['id_pegawai'] = $this->session->userdata('id_pegawai');
				$this->session->set_userdata($id);
				$kode['id_pegawai'] = $this->session->userdata('id_pegawai');
				
				$q = $this->db->get_where("tbl_data_pegawai",$id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai",$set_detail->nama_pegawai);
				
				foreach($q->result() as $data)
				{
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
				$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi','nama_provinsi'))->get('tbl_master_wilayah');
				$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten','nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
				$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan','nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
				$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan','nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
				$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten','nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
				$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan','nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
				$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan','nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));

				$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
				$x['status_jabatan']=$this->riwayat_jabatan_model->status_jabatan();
				$x['nama_jabatan']=$this->riwayat_jabatan_model->nama_jabatann();
				//$x['jabatan'] = $this->db->get('tbl_data_riwayat_jabatan');
			
				$this->load->helper('url');
				//$this->load->view('master/header2',$d);
				$this->load->view('dashboard_publik/home/home',$d); 
				$this->load->view('dashboard_publik/home/keluarga');
				$this->load->view('dashboard_publik/home/pangkat');
				$this->load->view('dashboard_publik/home/jabatan',$x);
				$this->load->view('dashboard_publik/home/pendidikan');
				$this->load->view('dashboard_publik/home/pelatihan');
				$this->load->view('dashboard_publik/home/penghargaan');
				$this->load->view('dashboard_publik/home/tubel');
				$this->load->view('dashboard_publik/home/skp');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		 
	function nama_jabatan()
	{
		if($this->input->post('id_status_jabatan'))
		{
			echo $this->jabatan_model->nama_jabatan($this->input->post('id_status_jabatan'));
		}
	}
	
	function nama_pangkat()
	{
		if($this->input->post('id_golongan'))
		{
			echo $this->jabatan_model->nama_jabatan($this->input->post('id_golongan'));
		}
	}

	public function arsip_digital()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai",$id);
			
			if($data_pegawai->num_rows()>0)
			{
				$q = $this->db->get_where("tbl_data_pegawai",$id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai",$set_detail->nama_pegawai);
				
				foreach($q->result() as $data)
				{
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
								
				$this->load->view('dashboard_publik/home/arsip_digital',$d);	
				$this->load->view('dashboard_publik/home/arsip_sk');	
				$this->load->view('dashboard_publik/home/arsip_pribadi');	
				$this->load->view('dashboard_publik/home/arsip_pendidikan');
				$this->load->view('dashboard_publik/home/arsip_skp');	
				$this->load->view('dashboard_publik/home/arsip_pelatihan');				
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
	
	public function pengajuan_surat()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai",$id);
			
			if($data_pegawai->num_rows()>0)
			{
				$q = $this->db->get_where("tbl_data_pegawai",$id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai",$set_detail->nama_pegawai);
				
				foreach($q->result() as $data)
				{
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
				$d['mst_kecamatan'] = $this->db->get('tbl_master_kecamatan');
				$d['mst_kelurahan'] = $this->db->get('tbl_master_kelurahan');
				$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
				$x['status_jabatan']=$this->riwayat_jabatan_model->status_jabatan();
				$x['nama_jabatan']=$this->riwayat_jabatan_model->nama_jabatann();
			
				$this->load->helper('url');
				//$this->load->view('master/header3',$d);				
				$this->load->view('dashboard_publik/home/pengajuan_surat',$d);
				$this->load->view('dashboard_publik/home/arsip_sk');
	
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
	
	public function status_surat()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai",$id);
			
			if($data_pegawai->num_rows()>0)
			{
				$q = $this->db->get_where("tbl_data_pegawai",$id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai",$set_detail->nama_pegawai);
				
				foreach($q->result() as $data)
				{
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
				//$this->load->view('master/header3',$d);				
				$this->load->view('dashboard_publik/home/status_surat',$d);	
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
	
	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');
			
			$q = $this->db->get_where("tbl_data_pegawai",$id);
			$set_detail = $q->row();
			$this->session->set_userdata("nama_pegawai",$set_detail->nama_pegawai);
			
			foreach($q->result() as $data)
			{
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
				}
				else {
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
			$d['mst_sub_lokasi_kerja'] = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $d['lokasi_kerja']));
			$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi','nama_provinsi'))->get('tbl_master_wilayah');
			$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten','nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
			$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan','nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
			$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan','nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
			$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten','nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
			$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan','nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
			$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan','nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$x['status_jabatan']=$this->riwayat_jabatan_model->status_jabatan();
			$x['nama_jabatan']=$this->riwayat_jabatan_model->nama_jabatann();
			//$x['jabatan'] = $this->db->get('tbl_data_riwayat_jabatan');
			//echo '<pre>'.print_r($d,true).'</pre>';
			//echo '<pre>'.print_r($d['mst_kecamatan_ktp']->result_array(),true).'</pre>';exit;
			$this->load->helper('url');
			//$this->load->view('master/header2',$d);
			
			$this->load->view('dashboard_publik/home/edit',$d);
			$this->load->view('dashboard_publik/home/keluarga');
			$this->load->view('dashboard_publik/home/pangkat');
			$this->load->view('dashboard_publik/home/jabatan',$x);
			$this->load->view('dashboard_publik/home/pendidikan');
			$this->load->view('dashboard_publik/home/pelatihan');
			$this->load->view('dashboard_publik/home/penghargaan');
			$this->load->view('dashboard_publik/home/tubel');
			$this->load->view('dashboard_publik/home/skp');
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
		
	public function simpan_surat()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
			
			$id = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$in['id_user'] = $id;
					$in['nip'] = $this->input->post('nip');
					$in['nrk'] = $this->input->post('nrk');
					$in['nama'] = $this->input->post('nama_pegawai');
					$in['status_pegawai'] = $this->input->post('status_pegawai');
					$in['alamat_domisili'] = $this->input->post('alamat');						
					$in['keterangan'] = $this->input->post('keterangan');
					$in['tgl_surat'] = date("Y-m-d H:i:s");
					$in['jenis_surat'] = "1";														

					$this->session->set_flashdata('suksesedit', 'Data Berhasil Di Ubah...');
					redirect (base_url() . 'dashboard_publik');				
						//header("location:".base_url()."pegawai/edit/".$this->session->userdata("kode_pegawai")."");
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$in['id_user'] = $id;
					$in['nip'] = $this->input->post('nip');
					$in['nrk'] = $this->input->post('nrk');
					$in['nama'] = $this->input->post('nama_pegawai');
					$in['status_pegawai'] = $this->input->post('status_pegawai');
					$in['alamat_domisili'] = $this->input->post('alamat');						
					$in['keterangan'] = $this->input->post('keterangan');
					$in['tgl_surat'] = date("Y-m-d H:i:s");
					$in['id_status_srt'] = "0";
					$in['jenis_surat'] = "1";
													
					$this->db->insert("tbl_data_srt_ket",$in);
					
					//get email
					$email = '';
					$q = $this->db->query("select email from tbl_data_pegawai where id_pegawai = ".$id);
					
					foreach ($q->result() as $p) {
						$email = $p->email;
					}

					$message = 'Hai '.$this->input->post('nama_pegawai').', Selamat Anda telah berhasil melakukan Pengajuan Surat Keterangan. Silahkan tunggu validasi dari Kepegawaian DCKTRP.<br/>
					<br/>Terimakasih<br/><br/><br/><b>Best Regards,<br/>Subbagian Kepegawaian<br/>Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta<br/>Gedung Dinas Teknis Jatibaru Lt.2 
					<br/>Jl. Taman Jatibaru No.1, RT.17/RW.1, Cideng, Gambir, Kota Jakarta Pusat, <br/>Daerah Khusus Ibukota Jakarta 10150</b>';
					
					$objSendEmail = [
						'email' => $email,
						'subject' => 'Pengajuan Surat Keterangan',
						'message' => $message
					];
					
					$this->load->helper('send_email');
					//SendMail($objSendEmail);
					
					//insert to history
					$id_surat = $this->db->insert_id();
					$hist_srt['id_srt'] = $id_surat;
					$hist_srt['id_user'] = $id;
					$hist_srt['created_at'] = date("Y-m-d H:i:s");
					$hist_srt['id_status_srt'] = 0;
					$this->db->insert('tbl_history_srt_ket', $hist_srt);

					$this->session->set_flashdata('suksestambah', 'Pengajuan Surat Anda Berhasil...');
					redirect (base_url() . 'dashboard_publik/status_surat');				
						//header("location:".base_url()."pegawai/edit/".$this->session->userdata("kode_pegawai")."");
				}
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
		
	public function simpan()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
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
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if ($st=="edit") {
					$q = $this->db->get_where("tbl_data_pegawai",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_pegawai;
						$d['nip'] = $dt->nip;
						$d['nrk'] = $dt->nrk;
						$d['email'] = $dt->email;
						$d['telepon'] = $dt->telepon;
						$d['nama_pegawai'] = $dt->nama_pegawai;
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
						}
						else {
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
					$d['mst_provinsi'] = $this->db->select('kode_provinsi,nama_provinsi')->group_by(array('kode_provinsi','nama_provinsi'))->get('tbl_master_wilayah');
					$d['mst_kabupaten'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten','nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi']));
					$d['mst_kecamatan'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan','nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten']));
					$d['mst_kelurahan'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan','nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan']));
					$d['mst_kabupaten_ktp'] = $this->db->select('kode_kabupaten,nama_kabupaten')->group_by(array('kode_kabupaten','nama_kabupaten'))->get_where('tbl_master_wilayah', array('kode_provinsi' => $d['kode_provinsi_ktp']));
					$d['mst_kecamatan_ktp'] = $this->db->select('kode_kecamatan,nama_kecamatan')->group_by(array('kode_kecamatan','nama_kecamatan'))->get_where('tbl_master_wilayah', array('kode_kabupaten' => $d['kode_kabupaten_ktp']));
					$d['mst_kelurahan_ktp'] = $this->db->select('kode_kelurahan,nama_kelurahan')->group_by(array('kode_kelurahan','nama_kelurahan'))->get_where('tbl_master_wilayah', array('kode_kecamatan' => $d['kode_kecamatan_ktp']));
					$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
						
					$d['data_keluarga'] = $this->db->get_where("tbl_data_keluarga",$id);		
					$d['data_riwayat_pangkat'] = $this->db->query("select * from tbl_data_riwayat_pangkat a left join tbl_master_golongan b on a.id_golongan=b.id_golongan where a.id_pegawai='".$id['id_pegawai']."'");	
					$d['data_riwayat_jabatan'] = $this->db->query("select c.nama_jabatan, b.nama_status_jabatan, a.id_riwayat_jabatan, a.lokasi, a.tmt_mulai_jabatan, a.nomor_sk, a.tgl_sk_jabatan from tbl_data_riwayat_jabatan a left join tbl_master_status_jabatan b on a.id_status_jabatan=b.id_status_jabatan 
					left join tbl_master_nama_jabatan c on a.id_jabatan=c.id_nama_jabatan where a.id_pegawai='".$id['id_pegawai']."' ORDER BY a.id_riwayat_jabatan DESC");
					$d['data_pendidikan'] = $this->db->query("select c.nama_pendidikan, a.jurusan, a.tempat_sekolah, a.kota, a.nomor_sttb, a.tanggal_lulus, a.id_pendidikan, a.id_master_pendidikan from tbl_data_pendidikan a 
					left join tbl_data_pegawai b on a.id_pegawai=b.id_pegawai left join tbl_master_pendidikan c on a.id_master_pendidikan=c.id_master_pendidikan where a.id_pegawai='".$id['id_pegawai']."'");
					$d['data_pelatihan'] = $this->db->query("select a.nama_pelatihan, a.kota, a.lokasi, a.tanggal_sertifikat, a.no_sertifikat, a.jam_pelatihan, a.negara, a.id_pelatihan from tbl_data_pelatihan a 
					left join tbl_master_pelatihan b on a.id_master_pelatihan=b.id_master_pelatihan left join tbl_master_lokasi_pelatihan c on a.lokasi=c.id_lokasi_pelatihan where a.id_pegawai='".$id['id_pegawai']."'"); 	
					$d['data_penghargaan'] = $this->db->query("select b.nama_penghargaan, a.nomor_sk, a.tgl_sk_penghargaan, a.id_penghargaan from tbl_data_penghargaan a left join tbl_master_penghargaan b on a.id_master_penghargaan=b.id_master_penghargaan where
					a.id_pegawai='".$id['id_pegawai']."'");
					$d['data_seminar'] = $this->db->get_where("tbl_data_seminar",$id);
					$d['data_gaji_pokok'] = $this->db->query("select * from tbl_data_gaji_pokok a left join tbl_master_golongan b on a.id_golongan=b.id_golongan where a.id_pegawai='".$id['id_pegawai']."'");	
					$d['data_hukuman'] =  $this->db->query("select a.id_hukuman, b.nama_hukuman, a.nomor_sk, a.tanggal_sk, a.tanggal_mulai, a.tanggal_selesai, a.masa_berlaku from tbl_data_hukuman a 
					left join tbl_master_hukuman b on a.id_master_hukuman=b.id_hukuman where a.id_pegawai='".$id['id_pegawai']."'");
					$d['data_tubel'] =  $this->db->query("select * from tbl_data_tubel a left join tbl_data_pegawai b on a.id_pegawai=b.id_pegawai where a.id_pegawai='".$id['id_pegawai']."'");
					$d['data_dp3'] = $this->db->get_where("tbl_data_dp3",$id);
					
					$this->load->view('dashboard_admin/master/header2',$d);
					$this->load->view('dashboard_publik/home/edit');
				
				}
			}
			else
			{
				//send email
				
				$message = 'Hai '.$this->input->post('nama_pegawai').', Selamat Anda telah berhasil melakukan update data SI-Adik.<br> Lengkapi dan upload data-data Anda untuk kebutuhan kenaikan pangkat, serta kebutuhan kepegawaian lainnya.<br/>
				<br/>Terimakasih<br/><br/><br/><b>Best Regards,<br/>Subbagian Kepegawaian<br/>Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta<br/>Gedung Dinas Teknis Jatibaru Lt.2 
				<br/>Jl. Taman Jatibaru No.1, RT.17/RW.1, Cideng, Gambir, Kota Jakarta Pusat, <br/>Daerah Khusus Ibukota Jakarta 10150</b>';
				
				$objSendEmail = [
					'email' => $this->input->post('email'),
					'subject' => 'Update Data SI-Adik',
					'message' => $message
				];
				
				$this->load->helper('send_email');
				SendMail($objSendEmail);
				
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['nip'] = $this->input->post('nip');
					$upd['nrk'] = $this->input->post('nrk');
					$upd['email'] = $this->input->post('email');
					$upd['telepon'] = $this->input->post('telepon');
					$upd['nama_pegawai'] = $this->input->post('nama_pegawai');
					$upd['status_pegawai'] = $this->input->post('status_pegawai');
					$upd['id_jabatan'] = $this->input->post('id_jabatan');
					$upd['id_bidang'] = $this->input->post('id_bidang');
					$upd['lokasi_kerja'] = $this->input->post('lokasi_kerja');
					$upd['seksi'] = $this->input->post('seksi');
					$upd['masa_kerja'] = $this->input->post('masa_kerja');
					$upd['usia'] = $this->input->post('usia');
					$upd['jenis_kelamin'] = $this->input->post('jenis_kelamin');
					$upd['tempat_lahir'] = $this->input->post('tempat_lahir');
					$upd['tanggal_lahir'] = $this->input->post('tanggal_lahir');				
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
					}
					else {
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
					$upd['tanggal_mulai_pangkat'] = $this->input->post('tanggal_mulai_pangkat');					
					$upd['tanggal_pengangkatan_cpns'] = $this->input->post('tanggal_pengangkatan_cpns');
					$upd['id_status_jabatan'] = $this->input->post('id_status_jabatan');
					$upd['nomor_sk_jabatan'] = $this->input->post('nomor_sk_jabatan');
					$upd['tanggal_sk_jabatan'] = $this->input->post('tanggal_sk_jabatan');
					$upd['tanggal_mulai_jabatan'] = $this->input->post('tanggal_mulai_jabatan');
					$upd['status_pegawai_pangkat'] = $this->input->post('status_pegawai_pangkat');					
					$upd['tanggal_selesai_pangkat'] = $this->input->post('tanggal_selesai_pangkat');					
					$upd['id_satuan_kerja'] = $this->input->post('id_satuan_kerja');
										
					$upd['tanggal_selesai_jabatan'] = $this->input->post('tanggal_selesai_jabatan');					
					$upd['tmt_eselon'] = $this->input->post('tmt_eselon');
					// echo '<pre>'.print_r($_FILES).'</pre>';exit;
					if(!empty($_FILES['foto']['name']))
					{
						$acak=rand(00000000000,99999999999);
						$bersih=$_FILES['foto']['name'];
						$nm=str_replace(" ","_","$bersih");
						$pisahfoto=explode(".",$nm);
						$nama_murni_lamafoto = preg_replace("/^(.+?);.*$/", "\\1",$pisahfoto[0]);
						$nama_murnifoto=date('Ymd-His');
						$ekstensi_kotorfoto = $pisahfoto[1];
						
						$file_typefoto = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotorfoto);
						$file_type_barufoto = strtolower($file_typefoto);
						
						$ubahfoto=$acak.'-'.$nama_murnifoto.'-'.$nama_murni_lamafoto; //tanpa ekstensi
						$n_barufoto = $ubahfoto.'.'.$file_type_barufoto;
						
						$configfoto['upload_path']	= "./asset/foto_pegawai/";
						$configfoto['allowed_types']= 'gif|jpg|png|jpeg';
						$configfoto['file_name'] = $n_barufoto;
						$configfoto['max_size']     = '2500';
						$configfoto['max_width']  	= '3000';
						$configfoto['max_height']  	= '3000';
					
						$this->load->library('upload', $configfoto);
						$this->upload->initialize($configfoto);
					
						if (!$this->upload->do_upload("foto"))  {
							echo 'upload foto error';exit;
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('msg', 'We had an error trying. Unable upload  image');
						}
						else
						{
							$foto = $this->upload->data();
							echo '<pre>'.print_r($foto).'</pre>';
							$kode = $this->input->post("old_file");

							$image1 = "asset/foto_pegawai/".$kode;
							if (is_file($image1)) {
								unlink($image1);
							}

							$image2 = "asset/foto_pegawai/thumb/".$kode;
							if (is_file($image2)) {
								unlink($image2);
							}

							$image3 = "asset/foto_pegawai/medium/".$kode;
							if (is_file($image3)) {
								unlink($image3);
							}
					
							/* PATH */
							$source             = "./asset/foto_pegawai/".$foto['file_name'] ;
							$destination_thumb	= "./asset/foto_pegawai/thumb/" ;
							$destination_medium	= "./asset/foto_pegawai/medium/" ;
					
							// Permission Configuration
							chmod($source, 0777) ;
					
							/* Resizing Processing */
							// Configuration Of Image Manipulation :: Static
							$this->load->library('image_lib') ;
							$img['image_library'] = 'GD2';
							$img['create_thumb']  = TRUE;
							$img['maintain_ratio']= TRUE;
					
							/// Limit Width Resize
							$limit_medium   = 425 ;
							$limit_thumb    = 150 ;
					
							// Size Image Limit was using (LIMIT TOP)
							$limit_use  = $foto['image_width'] > $foto['image_height'] ? $foto['image_width'] : $foto['image_height'] ;
					
							// Percentase Resize
							if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
								$percent_medium = $limit_medium/$limit_use ;
								$percent_thumb  = $limit_thumb/$limit_use ;
							}
					
							//// Making THUMBNAIL ///////
							$img['width']  = $limit_use > $limit_thumb ?  $foto['image_width'] * $percent_thumb : $foto['image_width'] ;
							$img['height'] = $limit_use > $limit_thumb ?  $foto['image_height'] * $percent_thumb : $foto['image_height'] ;
					
							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%' ;
							$img['source_image'] = $source ;
							$img['new_image']    = $destination_thumb ;
					
							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear() ;
					
							////// Making MEDIUM /////////////
							$img['width']   = $limit_use > $limit_medium ?  $foto['image_width'] * $percent_medium : $foto['image_width'] ;
							$img['height']  = $limit_use > $limit_medium ?  $foto['image_height'] * $percent_medium : $foto['image_height'] ;
					
							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%' ;
							$img['source_image'] = $source ;
							$img['new_image']    = $destination_medium ;

							// echo 'destination_medium : '.$destination_medium.'<br />';
							
							$upd['foto'] = $foto['file_name'];
							// echo $upd['foto'].'<br />';
					
							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear() ;
							// echo 'sukses resizing foto';
							// exit;
						}
					}

					if(!empty($_FILES['signature']['name']))
					{
						$acak=rand(00000000000,99999999999);
						$bersih=$_FILES['signature']['name'];
						$nm=str_replace(" ","_","$bersih");
						$pisahsignature=explode(".",$nm);
						$nama_murni_lamasignature = preg_replace("/^(.+?);.*$/", "\\1",$pisahsignature[0]);
						$nama_murnisignature=date('Ymd-His');
						$ekstensi_kotorsignature = $pisahsignature[1];
						
						$file_typesignature = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotorsignature);
						$file_type_barusignature = strtolower($file_typesignature);
						
						$ubahsignature=$acak.'-'.$nama_murnisignature.'-'.$nama_murni_lamasignature; //tanpa ekstensi
						$n_barusignature = $ubahsignature.'.'.$file_type_barusignature;
						
						$configsignature['upload_path']	= "./asset/foto_pegawai/signature";
						$configsignature['allowed_types']= 'gif|jpg|png|jpeg';
						$configsignature['file_name'] = $n_barusignature;
						$configsignature['max_size']     = '2500';
						$configsignature['max_width']  	= '3000';
						$configsignature['max_height']  	= '3000';
					
						$this->load->library('upload', $configsignature);
						$this->upload->initialize($configsignature);
					
						if (!$this->upload->do_upload("signature"))  {
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('msg', 'We had an error trying. Unable upload  image');
						}
						else
						{
							$signature = $this->upload->data();													
							$kode = $this->input->post("old_signature");

							$image1 = "asset/foto_pegawai/signature".$kode;
							if (is_file($image1)) {
								unlink($image1);
							}

							$image2 = "asset/foto_pegawai/signature/thumb/".$kode;
							if (is_file($image2)) {
								unlink($image2);
							}

							$image3 = "asset/foto_pegawai/signature/medium/".$kode;
							if (is_file($image3)) {
								unlink($image3);
							}
							
							/* PATH */
							$source             = "./asset/foto_pegawai/signature/".$signature['file_name'] ;
							$destination_thumb	= "./asset/foto_pegawai/signature/thumb/" ;
							$destination_medium	= "./asset/foto_pegawai/signature/medium/" ;
					
							// Permission Configuration
							chmod($source, 0777) ;
					
							/* Resizing Processing */
							// Configuration Of Image Manipulation :: Static
							$this->load->library('image_lib') ;
							$img['image_library'] = 'GD2';
							$img['create_thumb']  = TRUE;
							$img['maintain_ratio']= TRUE;
					
							/// Limit Width Resize
							$limit_medium   = 425 ;
							$limit_thumb    = 150 ;
					
							// Size Image Limit was using (LIMIT TOP)
							$limit_use  = $signature['image_width'] > $signature['image_height'] ? $signature['image_width'] : $signature['image_height'] ;
					
							// Percentase Resize
							if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
								$percent_medium = $limit_medium/$limit_use ;
								$percent_thumb  = $limit_thumb/$limit_use ;
							}
					
							//// Making THUMBNAIL ///////
							$img['width']  = $limit_use > $limit_thumb ?  $signature['image_width'] * $percent_thumb : $signature['image_width'] ;
							$img['height'] = $limit_use > $limit_thumb ?  $signature['image_height'] * $percent_thumb : $signature['image_height'] ;
					
							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%';
							$img['source_image'] = $source ;
							$img['new_image']    = $destination_thumb ;
					
							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear() ;
					
							////// Making MEDIUM /////////////
							$img['width']   = $limit_use > $limit_medium ?  $signature['image_width'] * $percent_medium : $signature['image_width'] ;
							$img['height']  = $limit_use > $limit_medium ?  $signature['image_height'] * $percent_medium : $signature['image_height'] ;
					
							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%' ;
							$img['source_image'] = $source ;
							$img['new_image']    = $destination_medium ;
							
							$upd['signature'] = $signature['file_name'];
					
							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear() ;
						}
					}
					
					if ($this->db->update("tbl_data_pegawai",$upd,$id)) {
						$this->session->set_flashdata('suksesedit', 'Data Berhasil Di Ubah...');
					}
					else {
						$this->session->set_flashdata('suksesedit', 'Data Gagal Di Ubah...');
					}
					
					redirect (base_url() . 'dashboard_publik');				
					//header("location:".base_url()."pegawai/edit/".$this->session->userdata("kode_pegawai")."");
				}
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
	
	public function deletelamp1(){
			$kode = $this->session->userdata('id_pegawai');
			$deleteid  = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$nama_folder = "SK".$kode;			 
			$file = "asset/upload/SK/".$nama_folder."/".$name;
			//echo "list url is " .($name) . "<hr>";			
			if (is_readable($file) && unlink($file)) {
				$this->session->set_flashdata('deletelamp1', 'LAMPIRAN BERHASIL DI HAPUS...');
				} 
			$this->db->delete('tbl_lampiran_sk', array('id_sk' => $deleteid));
			header("location:".base_url()."dashboard_publik/edit/".$this->session->userdata("id_pegawai")."");
		}
		
	public function deletelamp2(){
			$kode = $this->session->userdata('id_pegawai');
			$deleteid  = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$nama_folder = "pribadi".$kode;			 
			$file = "asset/upload/pribadi/".$nama_folder."/".$name;
			//echo "list url is " .($name) . "<hr>";			
			if (is_readable($file) && unlink($file)) {
				$this->session->set_flashdata('deletelamp2', 'LAMPIRAN BERHASIL DI HAPUS...');
				} 
			$this->db->delete('tbl_lampiran_pribadi', array('id_pribadi' => $deleteid));
			header("location:".base_url()."dashboard_publik/edit/".$this->session->userdata("id_pegawai")."");
		}
	
	public function deletelamp3(){
			$kode = $this->session->userdata('id_pegawai');
			$deleteid  = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$nama_folder = "pendidikan".$kode;			 
			$file = "asset/upload/pendidikan/".$nama_folder."/".$name;
			//echo "list url is " .($name) . "<hr>";			
			if (is_readable($file) && unlink($file)) {
				$this->session->set_flashdata('deletelamp2', 'LAMPIRAN BERHASIL DI HAPUS...');
				} 
			$this->db->delete('tbl_lampiran_pendidikan', array('id_pendidikan' => $deleteid));
			header("location:".base_url()."dashboard_publik/edit/".$this->session->userdata("id_pegawai")."");
		}
		
	public function deletelamp4(){
			$kode = $this->session->userdata('id_pegawai');
			$deleteid  = $this->uri->segment(3);
			$name = $this->uri->segment(4);
			$nama_folder = "SKP".$kode;			 
			$file = "asset/upload/SKP/".$nama_folder."/".$name;
			//echo "list url is " .($name) . "<hr>";			
			if (is_readable($file) && unlink($file)) {
				$this->session->set_flashdata('deletelamp2', 'LAMPIRAN BERHASIL DI HAPUS...');
				} 
			$this->db->delete('tbl_lampiran_skp', array('id_skp' => $deleteid));
			header("location:".base_url()."dashboard_publik/edit/".$this->session->userdata("id_pegawai")."");
		}
	
	function get_subkategori(){
		$id=$this->input->post('id');
		$data=$this->m_kategori->get_subkategori($id);
		echo json_encode($data);
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		header('location:'.base_url().'');
	}

	public function pengajuan_surat_detail($id_surat = 0)
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai",$id);
			
			if($data_pegawai->num_rows()>0)
			{
				$q = $this->db->get_where("tbl_data_pegawai",$id);
				$set_detail = $q->row();
				$this->session->set_userdata("nama_pegawai",$set_detail->nama_pegawai);
				
				foreach($q->result() as $data)
				{
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
					where a.id_srt=".$id_surat);
					
				foreach ($q->result() as $data) {
					$d['nama_pegawai'] = $data->nama;
					$d['nip'] = $data->nip;
					$d['nrk'] = $data->nrk;
					$d['alamat_domisili'] = $data->alamat_domisili;
					$d['keterangan'] = $data->keterangan;
					$d['nama_status_pegawai'] = $data->nama_status_pegawai;
					$d['keterangan_ditolak'] = $data->keterangan_ditolak;
				}
			
				$this->load->helper('url');
				$this->load->view('dashboard_publik/home/pengajuan_surat_detail',$d);
	
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
		
		
	}

	function nama_rumpun_jabatan()
	{
		echo $this->jabatan_model->nama_jabatan($this->input->post('id_rumpun_jabatan'));
	}
	
}

/* End of file dashboard_admin.php */
/* Location: ./application/controllers/dashboard_admin.php */