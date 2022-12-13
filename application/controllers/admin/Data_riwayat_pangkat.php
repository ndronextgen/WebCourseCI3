<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Riwayat_Pangkat extends CI_Controller {

	/*
		***	Controller : data_riwayat_pangkat.php
	*/

	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" or "publik")
		{
			$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$a['instansi'] = $this->config->item('nama_instansi');
			$a['credit'] = $this->config->item('credit_aplikasi');
			$a['alamat'] = $this->config->item('alamat_instansi');
			
			$id['id_riwayat_pangkat'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_riwayat_pangkat",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_riwayat_pangkat;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['id_golongan'] = $dt->id_golongan; 
				$d['lokasi_kerja'] = $dt->lokasi_kerja; 
				$d['nomor_sk'] = $dt->nomor_sk; 
				$d['tanggal_sk'] = $dt->tanggal_sk; 
				$d['tanggal_mulai'] = $dt->tanggal_mulai; 
				$d['tanggal_selesai'] = $dt->tanggal_selesai; 
			}
			$d['st'] = "edit";
			$d['golongan'] = $this->db->get("tbl_master_golongan");
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_riwayat_pangkat/input',$d);
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
			$d['id_golongan'] = "";
			$d['lokasi_kerja'] = "";
			$d['nomor_sk'] = "";
			$d['tanggal_sk'] = "";
			$d['tanggal_mulai'] = "";
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master/header',$d);
			$d['golongan'] = $this->db->get("tbl_master_golongan");
			
			$this->load->view('dashboard_admin/master/data_riwayat_pangkat/input',$d);
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
			$id['id_riwayat_pangkat'] = $this->uri->segment(4);
			$this->db->delete("tbl_data_riwayat_pangkat",$id);
			$this->session->set_flashdata('suksehapuspangkat', 'Data Riwayat Pangkat Berhasil Di Hapus...');
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pangkat');
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function simpan()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$this->form_validation->set_rules('id_golongan', 'Golongan', 'trim|required');
			$this->form_validation->set_rules('lokasi_kerja', 'lokasi_kerja', 'trim|required');
			$this->form_validation->set_rules('nomor_sk', 'Nomor SK', 'trim|required');
			$this->form_validation->set_rules('tanggal_sk', 'Tanggal SK', 'trim|required');
			$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'trim|required');
			
			$id['id_riwayat_pangkat'] = $this->input->post("id_param");
			
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
	
					$q = $this->db->get_where("tbl_data_riwayat_pangkat",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_riwayat_pangkat;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['id_golongan'] = $dt->id_golongan; 
						$d['lokasi_kerja'] = $dt->lokasi_kerja; 
						$d['nomor_sk'] = $dt->nomor_sk; 
						$d['tanggal_sk'] = $dt->tanggal_sk; 
						$d['tanggal_mulai'] = $dt->tanggal_mulai;  
					}
					$d['st'] = $st;
					$d['golongan'] = $this->db->get("tbl_master_golongan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_riwayat_pangkat/input',$d);
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
					$d['id_golongan'] = "";
					$d['lokasi_kerja'] = "";
					$d['nomor_sk'] = "";
					$d['tanggal_sk'] = "";
					$d['tanggal_mulai'] = "";
					$d['st'] = $st;
					$d['golongan'] = $this->db->get("tbl_master_golongan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_riwayat_pangkat/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] = $this->input->post("id_pegawai");
					$upd['id_golongan'] = $this->input->post("id_golongan");
					$upd['lokasi_kerja'] = $this->input->post("lokasi_kerja");
					$upd['nomor_sk'] = $this->input->post("nomor_sk");
					$upd['tanggal_sk'] = $this->input->post("tanggal_sk");
					$upd['tanggal_mulai'] = $this->input->post("tanggal_mulai");
					
					$this->db->update("tbl_data_riwayat_pangkat",$upd,$id);
					$this->session->set_flashdata('sukseseditpangkat', 'Data Riwayat Pangkat Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pangkat');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['id_golongan'] = $this->input->post("id_golongan");
					$in['lokasi_kerja'] = $this->input->post("lokasi_kerja");
					$in['nomor_sk'] = $this->input->post("nomor_sk");
					$in['tanggal_sk'] = $this->input->post("tanggal_sk");
					$in['tanggal_mulai'] = $this->input->post("tanggal_mulai");
					
					$this->db->insert("tbl_data_riwayat_pangkat",$in);
					$this->session->set_flashdata('suksespangkat', 'Data Riwayat Pangkat Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pangkat');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_riwayat_pangkat.php */
/* Location: ./application/controllers/data_riwayat_pangkat.php */