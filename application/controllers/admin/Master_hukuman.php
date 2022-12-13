<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_hukuman extends CI_Controller {

	/*
		***	Controller : master_hukuman.php
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
			$d['page_name'] = 'Master Hukuman';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_hukuman/home',$d);
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
			$d['page_name'] = 'Ubah Master Hukuman';
			$d['menu_open'] = 'master';

			$id['id_hukuman'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_hukuman",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_hukuman;
				$d['nama_hukuman'] = $dt->nama_hukuman;
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_hukuman/input',$d);
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
			$d['page_name'] = 'Detail Master Hukuman';
			$d['menu_open'] = 'master';
			$id['id_hukuman'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_hukuman",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_hukuman;
				$d['nama_hukuman'] = $dt->nama_hukuman;
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_hukuman/detail',$d);
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
			$d['page_name'] = 'Tambah Master Hukuman';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['nama_hukuman'] = "";
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master_hukuman/input',$d);
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
			$id['id_hukuman'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_hukuman",$id);
			header('location:'.base_url().'admin/master_hukuman');
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

			$this->form_validation->set_rules('nama_hukuman', 'Nama Hukuman', 'trim|required');
			$id['id_hukuman'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$d['page_name'] = 'Ubah Master Hukuman';
					$q = $this->db->get_where("tbl_master_hukuman",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_hukuman;
						$d['nama_hukuman'] = $dt->nama_hukuman;
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_hukuman/input',$d);
				}
				else if($st=="tambah")
				{
					$d['page_name'] = 'Tambah Master Hukuman';
					$d['id_param'] = "";
					$d['nama_hukuman'] = "";
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_hukuman/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['nama_hukuman'] = $this->input->post("nama_hukuman");
					$this->db->update("tbl_master_hukuman",$upd,$id);
					redirect('admin/master_hukuman');
				}
				else if($st=="tambah")
				{
					$in['nama_hukuman'] = $this->input->post("nama_hukuman");
					$this->db->insert("tbl_master_hukuman",$in);
					redirect('admin/master_hukuman');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_hukuman.php */
/* Location: ./application/controllers/master_hukuman.php */