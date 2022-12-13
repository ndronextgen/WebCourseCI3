<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_lokasi_kerja extends CI_Controller {

	/*
		***	Controller : master_lokasi_kerja.php
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
			$d['page_name'] = 'Master Lokasi Kerja';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_lokasi_kerja/home',$d);
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
			$d['page_name'] = 'Ubah Master Lokasi Kerja';
			$d['menu_open'] = 'master';

			$id['id_lokasi_kerja'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_lokasi_kerja",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_lokasi_kerja;
				$d['lokasi_kerja'] = $dt->lokasi_kerja;
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_lokasi_kerja/input',$d);
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
			$id['id_lokasi_kerja'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_lokasi_kerja",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_lokasi_kerja;
				$d['lokasi_kerja'] = $dt->lokasi_kerja;
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_lokasi_kerja/detail',$d);
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
			$d['page_name'] = 'Tambah Master Lokasi Kerja';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['lokasi_kerja'] = "";
			$d['st'] = "tambah";
			//$Query = $this->db->query("SELECT * FROM tbl_master_lokasi_kerja ORDER BY id_lokasi_kerja ASC")->result();
			$this->load->view('dashboard_admin/master_lokasi_kerja/input',$d);
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
			$id['id_lokasi_kerja'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_lokasi_kerja",$id);
			header('location:'.base_url().'admin/master_lokasi_kerja');
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

			$this->form_validation->set_rules('lokasi_kerja', 'Lokasi Kerja', 'trim|required');
			$id['lokasi_kerja'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$d['page_name'] = 'Ubah Master Lokasi Kerja';
					$q = $this->db->get_where("tbl_master_lokasi_kerja",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] 		= $dt->id_lokasi_kerja;
						$d['lokasi_kerja'] 	= $dt->lokasi_kerja;
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_lokasi_kerja/input',$d);
				}
				else if($st=="tambah")
				{
					$d['page_name'] = 'Tambah Master Lokasi Kerja';
					$d['id_param'] = "";
					$d['lokasi_kerja'] = "";
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_lokasi_kerja/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['lokasi_kerja'] = $this->input->post("lokasi_kerja");
					$param = $this->input->post("id_param");
					$lokasi_kerja = $this->input->post("lokasi_kerja");
					$Query_update = $this->db->query("UPDATE tbl_master_lokasi_kerja SET lokasi_kerja = '$lokasi_kerja' WHERE id_lokasi_kerja = '$param'");
					//var_dump($id);
					redirect('admin/master_lokasi_kerja');
				}
				else if($st=="tambah")
				{
					$in['lokasi_kerja'] = $this->input->post("lokasi_kerja");
					$this->db->insert("tbl_master_lokasi_kerja",$in);
					redirect('admin/master_lokasi_kerja');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_lokasi_kerja.php */
/* Location: ./application/controllers/master_lokasi_kerja.php */