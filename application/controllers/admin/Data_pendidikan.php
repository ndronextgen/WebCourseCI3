<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Pendidikan extends CI_Controller {

	/*
		***	Controller : data_pendidikan.php
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
			
			$id['id_pendidikan'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_pendidikan",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_pendidikan;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['id_master_pendidikan'] = $dt->id_master_pendidikan;  
				$d['jurusan'] = $dt->jurusan; 
				$d['kota'] = $dt->kota; 
				$d['tempat_sekolah'] = $dt->tempat_sekolah; 
				$d['nomor_sttb'] = $dt->nomor_sttb; 
				$d['tanggal_lulus'] = $dt->tanggal_lulus; 
				$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
			}
			$d['st'] = "edit";
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_pendidikan/input',$d);
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
			$d['id_master_pendidikan'] = "";
			$d['jurusan'] = "";
			$d['kota'] = ""; 
			$d['tempat_sekolah'] =  "";
			$d['nomor_sttb'] = "";
			$d['tanggal_lulus'] = "";
			$d['st'] = "tambah";
			$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
			$this->load->view('dashboard_admin/master/header',$d);
			$this->load->view('dashboard_admin/master/data_pendidikan/input',$d);
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
			$id['id_pendidikan'] = $this->uri->segment(4);
			$this->db->delete("tbl_data_pendidikan",$id);
			$this->session->set_flashdata('suksehapuspendidikan', 'Data Pendidikan Berhasil Di Hapus...');
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pendidikan');
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
			$this->form_validation->set_rules('id_master_pendidikan', 'Tingkat Pendidikan', 'trim|required');
			$this->form_validation->set_rules('tempat_sekolah', 'Tempat Sekolah', 'trim|required');
			$this->form_validation->set_rules('kota', 'kota', 'trim|required');
			
			$id['id_pendidikan'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$q = $this->db->get_where("tbl_data_pendidikan",$id);
					$d = array();
					foreach($q->result() as $dt)
					{	
						$a['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
						$a['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
						$a['instansi'] = $this->config->item('nama_instansi');
						$a['credit'] = $this->config->item('credit_aplikasi');
						$a['alamat'] = $this->config->item('alamat_instansi');
						
						$d['id_param'] = $dt->id_pendidikan;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['id_master_pendidikan'] = $dt->id_master_pendidikan;
						$d['jurusan'] = $dt->jurusan; 
						$d['kota'] = $dt->kota; 
						$d['tempat_sekolah'] = $dt->tempat_sekolah; 
						$d['nomor_sttb'] = $dt->nomor_sttb; 
						$d['tanggal_lulus'] = $dt->tanggal_lulus; 
						$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_pendidikan/input',$d);
					
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
					$d['id_master_pendidikan'] = "";
					$d['jurusan'] = "";
					$d['kota'] =  "";
					$d['tempat_sekolah'] =  "";
					$d['nomor_sttb'] = "";
					$d['tanggal_lulus'] = "";
					$d['st'] = $st;
					$d['mst_pendidikan'] = $this->db->get("tbl_master_pendidikan");
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_pendidikan/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] = $this->input->post("id_pegawai");
					$upd['id_master_pendidikan'] = $this->input->post("id_master_pendidikan");
					$upd['jurusan'] = $this->input->post("jurusan");
					$upd['kota'] =  $this->input->post("kota");
					$upd['tempat_sekolah'] =  $this->input->post("tempat_sekolah");
					$upd['nomor_sttb'] = $this->input->post("nomor_sttb");
					$upd['tanggal_lulus'] = $this->input->post("tanggal_lulus");
					
					$this->db->update("tbl_data_pendidikan",$upd,$id);
					$this->session->set_flashdata('sukseseditpendidikan', 'Data Pendidikan Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pendidikan');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['id_master_pendidikan'] = $this->input->post("id_master_pendidikan");
					$in['jurusan'] = $this->input->post("jurusan");
					$in['kota'] =  $this->input->post("kota");
					$in['tempat_sekolah'] =  $this->input->post("tempat_sekolah");
					$in['nomor_sttb'] = $this->input->post("nomor_sttb");
					$in['tanggal_lulus'] = $this->input->post("tanggal_lulus");
					
					$this->db->insert("tbl_data_pendidikan",$in);
					$this->session->set_flashdata('suksespendidikan', 'Data Pendidikan Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-pendidikan');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_pendidikan.php */
/* Location: ./application/controllers/data_pendidikan.php */