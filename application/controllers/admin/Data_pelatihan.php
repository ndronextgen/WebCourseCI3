<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Pelatihan extends CI_Controller {

	/*
		***	Controller : data_pelatihan.php
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
			
			$id['id_pelatihan'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_pelatihan",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_pelatihan;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['nama_pelatihan'] = $dt->nama_pelatihan; 
				$d['uraian'] = $dt->uraian; 
				$d['lokasi'] = $dt->lokasi; 
				$d['kota'] = $dt->kota;
				$d['no_sertifikat'] = $dt->no_sertifikat;
				$d['tanggal_sertifikat'] = $dt->tanggal_sertifikat;
			}
			$d['st'] = "edit";
			$d['mst_lokasi'] = $this->db->get("tbl_master_lokasi_pelatihan");
			$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_pelatihan/input',$d);
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
			$d['nama_pelatihan'] = ""; 
			$d['uraian'] = ""; 
			$d['lokasi'] = ""; 
			$d['kota'] = "";
			$d['no_sertifikat'] = "";
			$d['tanggal_sertifikat'] = "";			
			$d['st'] = "tambah";
			$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
			$d['mst_lokasi'] = $this->db->get("tbl_master_lokasi_pelatihan");
			$this->load->view('dashboard_admin/master/header',$d);
			$this->load->view('dashboard_admin/master/data_pelatihan/input',$d);
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
			$id['id_pelatihan'] = $this->uri->segment(4);
			$this->db->delete("tbl_data_pelatihan",$id);
			$this->session->set_flashdata('suksehapuspelatihan', 'Data Pelatihan Berhasil Di Hapus...');
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pelatihan');
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
			$this->form_validation->set_rules('nama_pelatihan', 'Nama Pelatihan', 'trim|required');
			$this->form_validation->set_rules('lokasi', 'Tempat Pelatihan', 'trim|required');
			$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
			
			$id['id_pelatihan'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$q = $this->db->get_where("tbl_data_pelatihan",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
						$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
						$a['instansi'] = $this->config->item('nama_instansi');
						$a['credit'] = $this->config->item('credit_aplikasi');
						$a['alamat'] = $this->config->item('alamat_instansi');
					
						$d['id_param'] = $dt->id_pelatihan;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['nama_pelatihan'] = $dt->nama_pelatihan; 
						$d['uraian'] = $dt->uraian; 
						$d['lokasi'] = $dt->lokasi; 
						$d['kota'] = $dt->kota;
						$d['no_sertifikat'] = $dt->no_sertifikat;
						$d['tanggal_sertifikat'] = $dt->tanggal_sertifikat;
					}
					$d['st'] = $st;
					$d['mst_lokasi'] = $this->db->get("tbl_master_lokasi_pelatihan");
					$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_pelatihan/input',$d);
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
					$d['nama_pelatihan'] = ""; 
					$d['uraian'] = ""; 
					$d['lokasi'] = ""; 
					$d['kota'] = "";
					$d['no_sertifikat'] = "";
					$d['tanggal_sertifikat'] = "";
			
					$d['st'] = $st;
					$d['mst_lokasi'] = $this->db->get("tbl_master_lokasi_pelatihan");
					$d['mst_pelatihan'] = $this->db->get("tbl_master_pelatihan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_pelatihan/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] = $this->input->post("id_pegawai");
					$upd['nama_pelatihan'] = $this->input->post("nama_pelatihan");
					$upd['uraian'] = $this->input->post("uraian");
					$upd['lokasi'] = $this->input->post("lokasi");
					$upd['kota'] = $this->input->post("kota");
					$upd['no_sertifikat'] = $this->input->post("no_sertifikat");
					$upd['tanggal_sertifikat'] = $this->input->post("tanggal_sertifikat");
					
					$this->db->update("tbl_data_pelatihan",$upd,$id);
					$this->session->set_flashdata('sukseseditpelatihan', 'Data Pelatihan Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pelatihan');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['nama_pelatihan'] = $this->input->post("nama_pelatihan");
					$in['uraian'] = $this->input->post("uraian");
					$in['lokasi'] = $this->input->post("lokasi");
					$in['kota'] = $this->input->post("kota");
					$in['no_sertifikat'] = $this->input->post("no_sertifikat");
					$in['tanggal_sertifikat'] = $this->input->post("tanggal_sertifikat");
					
					$this->db->insert("tbl_data_pelatihan",$in);
					$this->session->set_flashdata('suksespelatihan', 'Data Pelatihan Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pelatihan');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_pelatihan.php */
/* Location: ./application/controllers/data_pelatihan.php */