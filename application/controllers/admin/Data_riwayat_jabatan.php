<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Riwayat_Jabatan extends CI_Controller {

	/*
		***	Controller : data_riwayat_jabatan.php
	*/
	
	public function __construct()
		 {
		  parent::__construct();
		  $this->load->model('jabatan_model');
		 }
	 


	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$a['instansi'] = $this->config->item('nama_instansi');
			$a['credit'] = $this->config->item('credit_aplikasi');
			$a['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_riwayat_jabatan'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_riwayat_jabatan",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_riwayat_jabatan;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['id_r_jabatan'] = $dt->id_r_jabatan;
				$d['id_riwayat_status_jabatan'] = $dt->id_riwayat_status_jabatan;	
				$d['nomor_sk'] = $dt->nomor_sk; 
				$d['tgl_sk_jabatan'] = $dt->tgl_sk_jabatan; 
				$d['tmt_mulai_jabatan'] = $dt->tmt_mulai_jabatan; 
				$d['lokasi'] = $dt->lokasi; 
			}
			$d['st'] = "edit";
			$d['mst_eselon'] = $this->db->get("tbl_master_eselon");
			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_riwayat_jabatan/input',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function tambah()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			
			$d['id_param'] = "";
			$d['id_pegawai'] = $this->uri->segment(4);
			$d['id_r_jabatan'] = "";
			$d['id_riwayat_status_jabatan'] = "";	
			$d['nomor_sk'] = "";
			$d['tgl_sk_jabatan'] = "";
			$d['tmt_mulai_jabatan'] = "";
			$d['lokasi'] = "";
			
			$d['st'] = "tambah";
			$d['mst_eselon'] = $this->db->get("tbl_master_eselon");
			$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
			$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			$this->load->view('dashboard_admin/master/header',$d);
			$this->load->view('dashboard_admin/master/data_riwayat_jabatan/input',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function hapus()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$id['id_riwayat_jabatan'] = $this->uri->segment(4);
			if ($this->db->delete("tbl_data_riwayat_jabatan",$id)) {
				$this->session->set_flashdata('suksehapusjabatan', 'Data Riwayat Jabatan Berhasil Di Hapus...');
				}
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-jabatan');
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function simpan()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$this->form_validation->set_rules('id_r_jabatan', 'Jabatan', 'trim|required');
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
			$this->form_validation->set_rules('tmt_mulai_jabatan', 'TMT', 'trim|required');
			$this->form_validation->set_rules('tgl_sk_jabatan', 'Tanggal SK', 'trim|required');
			$this->form_validation->set_rules('nomor_sk', 'Nomor SK', 'trim|required');
			
			$id['id_riwayat_jabatan'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
					$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
					$a['instansi'] = $this->config->item('nama_instansi');
					$a['credit'] = $this->config->item('credit_aplikasi');
					$a['alamat'] = $this->config->item('alamat_instansi');
			
					$q = $this->db->get_where("tbl_data_riwayat_jabatan",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_riwayat_jabatan;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['id_r_jabatan'] = $dt->id_r_jabatan; 
						$d['id_riwayat_status_jabatan'] = $dt->id_riwayat_status_jabatan; 
						$d['nomor_sk'] = $dt->nomor_sk; 
						$d['tgl_sk_jabatan'] = $dt->tgl_sk_jabatan; 
						$d['tmt_mulai_jabatan'] = $dt->tmt_mulai_jabatan;  
						$d['lokasi'] = $dt->lokasi; 
					}
					$d['st'] = $st;	
					$d['mst_eselon'] = $this->db->get("tbl_master_eselon");
					$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
					$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			
					$this->load->view('dashboard_admin/master/data_riwayat_jabatan/input',$d);
					
				}
				else if($st=="tambah")
				{
					$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
					$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
					$a['instansi'] = $this->config->item('nama_instansi');
					$a['credit'] = $this->config->item('credit_aplikasi');
					$a['alamat'] = $this->config->item('alamat_instansi');
			
					$d['id_param'] = "";
					$d['id_pegawai'] = $this->session->userdata("kode_pegawai");
					$d['id_r_jabatan'] = "";
					$d['id_riwayat_status_jabatan'] = "";
					$d['nomor_sk'] = "";
					$d['tgl_sk_jabatan'] = "";
					$d['tmt_mulai_jabatan'] = "";
					$d['lokasi'] = "";
			
					$d['st'] = $st;
					$d['mst_eselon'] = $this->db->get("tbl_master_eselon");
					$d['mst_status_jabatan'] = $this->jabatan_model->status_jabatan();
					$d['mst_jabatan'] = $this->db->get('tbl_master_nama_jabatan');
			
					$this->load->view('dashboard_admin/master/data_riwayat_jabatan/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] = $this->input->post("id_pegawai");
					$upd['id_r_jabatan'] = $this->input->post("id_r_jabatan");
					$upd['id_riwayat_status_jabatan'] = $this->input->post("id_riwayat_status_jabatan");
					$upd['nomor_sk'] = $this->input->post("nomor_sk");
					$upd['tgl_sk_jabatan'] = $this->input->post("tgl_sk_jabatan");
					$upd['tmt_mulai_jabatan'] = $this->input->post("tmt_mulai_jabatan");
					$upd['lokasi'] = $this->input->post("lokasi");
					
					$this->db->update("tbl_data_riwayat_jabatan",$upd,$id);
					$this->session->set_flashdata('sukseseditjabatan', 'Data Riwayat Jabatan Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-jabatan');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['id_r_jabatan'] = $this->input->post("id_r_jabatan");
					$in['id_riwayat_status_jabatan'] = $this->input->post("id_riwayat_status_jabatan");
					$in['nomor_sk'] = $this->input->post("nomor_sk");
					$in['tgl_sk_jabatan'] = $this->input->post("tgl_sk_jabatan");
					$in['tmt_mulai_jabatan'] = $this->input->post("tmt_mulai_jabatan");
					$in['lokasi'] = $this->input->post("lokasi");
					
					$this->db->insert("tbl_data_riwayat_jabatan",$in);
					$this->session->set_flashdata('suksesjabatan', 'Data Riwayat Jabatan Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-jabatan');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_riwayat_jabatan.php */
/* Location: ./application/controllers/data_riwayat_jabatan.php */