<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_penghargaan extends CI_Controller {

	/*
		***	Controller : master_penghargaan.php
	*/

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('template');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Master Penghargaan';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_penghargaan/home',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Ubah Master Penghargaan';
			$d['menu_open'] = 'master';

			$id['id_master_penghargaan'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_penghargaan",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_master_penghargaan;
				$d['nama_penghargaan'] = $dt->nama_penghargaan;
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_penghargaan/input',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function detail()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Detail Master Penghargaan';
			$d['menu_open'] = 'master';
			$id['id_master_penghargaan'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_penghargaan",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_master_penghargaan;
				$d['nama_penghargaan'] = $dt->nama_penghargaan;
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_penghargaan/detail',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function tambah()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Tambah Master Penghargaan';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['nama_penghargaan'] = "";
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master_penghargaan/input',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function hapus()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$id['id_master_penghargaan'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_penghargaan",$id);
			header('location:'.base_url().'admin/master_penghargaan');
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

			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['menu_open'] = 'master';

			$this->form_validation->set_rules('nama_penghargaan', 'Nama Penghargaan', 'trim|required');
			$id['id_master_penghargaan'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$d['page_name'] = 'Ubah Master Penghargaan';
					$q = $this->db->get_where("tbl_master_penghargaan",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_master_penghargaan;
						$d['nama_penghargaan'] = $dt->nama_penghargaan;
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_penghargaan/input',$d);
				}
				else if($st=="tambah")
				{
					$d['page_name'] = 'Tambah Master Penghargaan';
					$d['id_param'] = "";
					$d['nama_penghargaan'] = "";
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_penghargaan/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['nama_penghargaan'] = $this->input->post("nama_penghargaan");
					$this->db->update("tbl_master_penghargaan",$upd,$id);
					redirect('admin/master_penghargaan');
				}
				else if($st=="tambah")
				{
					$in['nama_penghargaan'] = $this->input->post("nama_penghargaan");
					$this->db->insert("tbl_master_penghargaan",$in);
					redirect('admin/master_penghargaan');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_penghargaan.php */
/* Location: ./application/controllers/master_penghargaan.php */