<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Keluarga extends CI_Controller {

	/*
		***	Controller : data_keluarga.php
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
			
			$id['id_data_keluarga'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_keluarga",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_data_keluarga;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['nama_anggota_keluarga'] = $dt->nama_anggota_keluarga;
				$d['tanggal_lahir_keluarga'] = $dt->tanggal_lahir_keluarga; 
				$d['hub_keluarga'] = $dt->hub_keluarga; 
				$d['jenis_kelamin'] = $dt->jenis_kelamin; 
				$d['uraian'] = $dt->uraian;
			}
			$d['st'] = "edit";
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_keluarga/input',$d);
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
			$d['nama_anggota_keluarga'] = "";
			$d['tanggal_lahir_keluarga'] = "";
			$d['hub_keluarga'] = ""; 
			$d['jenis_kelamin'] = "";
			$d['uraian'] = "";
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master/header',$d);
			$this->load->view('dashboard_admin/master/data_keluarga/input',$d);
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
			$id['id_data_keluarga'] = $this->uri->segment(4);
			if ($this->db->delete("tbl_data_keluarga",$id)) {
				$this->session->set_flashdata('suksehapuskeluarga', 'Data Keluarga Berhasil Di Hapus...');
				}		
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-keluarga');
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
			$this->form_validation->set_rules('nama_anggota_keluarga', 'Nama Anggota Keluarga', 'trim|required');
			$this->form_validation->set_rules('hub_keluarga', 'Hubungan Keluarga', 'trim|required');
			$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
			$this->form_validation->set_rules('tanggal_lahir_keluarga', 'Tanggal Lahir', 'trim|required');					
			
			$id['id_data_keluarga'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$q = $this->db->get_where("tbl_data_keluarga",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
						$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
						$a['instansi'] = $this->config->item('nama_instansi');
						$a['credit'] = $this->config->item('credit_aplikasi');
						$a['alamat'] = $this->config->item('alamat_instansi');
						
						$d['id_param'] = $dt->id_data_keluarga;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['nama_anggota_keluarga'] = $dt->nama_anggota_keluarga;
						$d['tanggal_lahir_keluarga'] = $dt->tanggal_lahir_keluarga; 
						$d['hub_keluarga'] = $dt->hub_keluarga; 
						$d['jenis_kelamin'] = $dt->jenis_kelamin; 
						$d['uraian'] = $dt->uraian;
						
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_keluarga/input',$d);
				}
				else if($st=="tambah")
				{
					$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
					$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
					$a['instansi'] = $this->config->item('nama_instansi');
					$a['credit'] = $this->config->item('credit_aplikasi');
					$a['alamat'] = $this->config->item('alamat_instansi');
					
					$d['id_param'] = "";
					$d['id_pegawai'] = $this->uri->segment(3);
					$d['nama_anggota_keluarga'] = "";
					$d['tanggal_lahir_keluarga'] = "";
					$d['hub_keluarga'] = ""; 
					$d['jenis_kelamin'] = "";
					$d['uraian'] = "";
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_keluarga/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] = $this->input->post("id_pegawai");
					$upd['nama_anggota_keluarga'] = $this->input->post("nama_anggota_keluarga");
					$upd['tanggal_lahir_keluarga'] = $this->input->post("tanggal_lahir_keluarga");
					$upd['hub_keluarga'] = $this->input->post("hub_keluarga");
					$upd['jenis_kelamin'] = $this->input->post("jenis_kelamin");
					$upd['uraian'] = $this->input->post("uraian");
					
					$this->db->update("tbl_data_keluarga",$upd,$id);
					$this->session->set_flashdata('sukseseditkeluarga', 'Data Keluarga Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-keluarga');
					
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['nama_anggota_keluarga'] = $this->input->post("nama_anggota_keluarga");
					$in['tanggal_lahir_keluarga'] = $this->input->post("tanggal_lahir_keluarga");
					$in['hub_keluarga'] = $this->input->post("hub_keluarga");
					$in['jenis_kelamin'] = $this->input->post("jenis_kelamin");
					$in['uraian'] = $this->input->post("uraian");
					
					$this->db->insert("tbl_data_keluarga",$in);
					$this->session->set_flashdata('sukseskeluarga', 'Data Keluarga Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-keluarga');
				}		
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_keluarga.php */
/* Location: ./application/controllers/data_keluarga.php */