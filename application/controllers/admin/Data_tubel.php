<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Tubel extends CI_Controller {

	/*
		***	Controller : data_tubel.php
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
			
			$id['id_tubel'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_data_tubel",$id);
			$d = array();
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_tubel;
				$d['id_pegawai'] = $dt->id_pegawai; 
				$d['no_sk'] = $dt->no_sk; 
				$d['tgl_sk'] = $dt->tgl_sk; 
				$d['uraian'] = $dt->uraian; 
				$d['tgl_mulai'] = $dt->tgl_mulai; 
				$d['tgl_selesai'] = $dt->tgl_selesai; 
				$d['sekolah'] = $dt->sekolah; 
				$d['akreditasi'] = $dt->akreditasi; 
				$d['jurusan'] = $dt->jurusan;
			}
			$d['st'] = "edit";
			$this->load->view('dashboard_admin/master/header',$a);
			$this->load->view('dashboard_admin/master/data_tubel/input',$d);
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
			$d['no_sk'] = ""; 
			$d['tgl_sk'] = ""; 
			$d['uraian'] = ""; 
			$d['tgl_mulai'] = ""; 
			$d['tgl_selesai'] = ""; 
			$d['sekolah'] = ""; 
			$d['akreditasi'] = ""; 
			$d['jurusan'] = ""; 
			
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master/header',$d);
			$this->load->view('dashboard_admin/master/data_tubel/input',$d);
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
			$id['id_tubel'] = $this->uri->segment(4);
			$this->db->delete("tbl_data_tubel",$id);
			$this->session->set_flashdata('suksehapustubel', 'Data Tugas & Izin Belajar Berhasil Di Hapus...');
			redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-tubel');
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
			$this->form_validation->set_rules('no_sk', 'Nomor SK', 'trim|required');
			$this->form_validation->set_rules('tgl_sk', 'Tanggal SK', 'trim|required');
			$this->form_validation->set_rules('uraian', 'Uraian');
			$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required');
			$this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'trim|required');
			$this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');
			$this->form_validation->set_rules('akreditasi', 'Akreditasi', 'trim|required');
			
			$id['id_tubel'] = $this->input->post("id_param");
			
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
				
					$q = $this->db->get_where("tbl_data_tubel",$id);
					$d = array();
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_tubel;
						$d['id_pegawai'] = $dt->id_pegawai; 
						$d['no_sk'] = $dt->no_sk; 
						$d['tgl_sk'] = $dt->tgl_sk; 
						$d['uraian'] = $dt->uraian; 
						$d['tgl_mulai'] = $dt->tgl_mulai; 
						$d['tgl_selesai'] = $dt->tgl_selesai; 
						$d['sekolah'] = $dt->sekolah; 
						$d['akreditasi'] = $dt->akreditasi; 
						$d['jurusan'] = $dt->jurusan; 
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_tubel/input',$d);
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
					$d['no_sk'] = ""; 
					$d['tgl_sk'] = ""; 
					$d['uraian'] = ""; 
					$d['tgl_mulai'] = ""; 
					$d['tgl_selesai'] = ""; 
					$d['sekolah'] = ""; 
					$d['akreditasi'] = ""; 
					$d['jurusan'] = "";
			
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master/header',$a);
					$this->load->view('dashboard_admin/master/data_tubel/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['id_pegawai'] = $this->input->post("id_pegawai");
					$upd['no_sk'] = $this->input->post("no_sk");
					$upd['tgl_sk'] = $this->input->post("tgl_sk");
					$upd['uraian'] = $this->input->post("uraian");
					$upd['tgl_mulai'] = $this->input->post("tgl_mulai");
					$upd['tgl_selesai'] = $this->input->post("tgl_selesai");
					$upd['sekolah'] = $this->input->post("sekolah");
					$upd['akreditasi'] = $this->input->post("akreditasi");
					$upd['jurusan'] = $this->input->post("jurusan");
					
					$this->db->update("tbl_data_tubel",$upd,$id);
					$this->session->set_flashdata('suksesedittubel', 'Data Tugas & Izin Belajar Berhasil Di Ubah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-tubel');
				}
				else if($st=="tambah")
				{
					$in['id_pegawai'] = $this->input->post("id_pegawai");
					$in['no_sk'] = $this->input->post("no_sk");
					$in['tgl_sk'] = $this->input->post("tgl_sk");
					$in['uraian'] = $this->input->post("uraian");
					$in['tgl_mulai'] = $this->input->post("tgl_mulai");
					$in['tgl_selesai'] = $this->input->post("tgl_selesai");
					$in['sekolah'] = $this->input->post("sekolah");
					$in['akreditasi'] = $this->input->post("akreditasi");
					$in['jurusan'] = $this->input->post("jurusan");
					
					$this->db->insert("tbl_data_tubel",$in);
					$this->session->set_flashdata('suksestubel', 'Data Tugas & Izin Belajar Berhasil Di Tambah...');
					redirect (base_url().'pegawai/edit/'.$this->session->userdata("id_pegawai").'#data-tubel');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file data_tubel.php */
/* Location: ./application/controllers/data_tubel.php */