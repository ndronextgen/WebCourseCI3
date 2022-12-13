<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_sub_lokasi extends CI_Controller {

	/*
		***	Controller : master_sub_lokasi.php
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
			$d['page_name'] = 'Master Seksi/ Subbag/ Satlak';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_sub_lokasi/home',$d);
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
			$d['page_name'] = 'Ubah Master Seksi/ Subbag/ Satlak';
			$d['menu_open'] = 'master';

			$id['id_sub_lokasi_kerja'] = $this->uri->segment(4);
			$q = "select a.*,b.lokasi_kerja  
				from tbl_master_sub_lokasi_kerja a 
				left join tbl_master_lokasi_kerja b on a.id_lokasi_kerja=b.id_lokasi_kerja 
				where a.id_sub_lokasi_kerja = ".$id['id_sub_lokasi_kerja'];
			$rs = $this->db->query($q);
			if ($dt = $rs->row())
			{
				// echo '<pre>'.print_r($dt,true).'</pre>';exit;
				$d['id_param'] = $dt->id_sub_lokasi_kerja;
				$d['id_sub_lokasi_kerja'] = $dt->id_sub_lokasi_kerja; 
				$d['id_lokasi_kerja'] = $dt->id_lokasi_kerja; 
				$d['sub_lokasi_kerja'] = $dt->sub_lokasi_kerja; 
				$d['lokasi_kerja'] = $dt->lokasi_kerja; 
			}
			$d['st'] = "edit";

			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			$this->load->view('dashboard_admin/master_sub_lokasi/input',$d);
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
			$d['page_name'] = 'Detail Master Seksi/ Subbag/ Satlak';
			$d['menu_open'] = 'master';

			$id['id_sub_lokasi_kerja'] = $this->uri->segment(4);
			$q = "select a.*,b.lokasi_kerja 
				from tbl_master_sub_lokasi_kerja a 
				left join tbl_master_lokasi_kerja b on a.id_lokasi_kerja=b.id_lokasi_kerja 
				where a.id_sub_lokasi_kerja = ".$id['id_sub_lokasi_kerja'];
			$rs = $this->db->query($q);
			if ($dt = $rs->row())
			{
				$d['id_param'] = $dt->id_sub_lokasi_kerja;
				$d['id_sub_lokasi_kerja'] = $dt->id_sub_lokasi_kerja; 
				$d['id_lokasi_kerja'] = $dt->id_lokasi_kerja; 
				$d['sub_lokasi_kerja'] = $dt->sub_lokasi_kerja; 
				$d['lokasi_kerja'] = $dt->lokasi_kerja; 
			}
			$d['st'] = "edit";
			// echo '<pre>'.print_r($dt,true).'</pre>';exit;
			$this->load->view('dashboard_admin/master_sub_lokasi/detail',$d);
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
			$d['page_name'] = 'Tambah Master Seksi/ Subbag/ Satlak';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['id_lokasi_kerja'] = ""; 
			$d['id_sub_lokasi_kerja'] = "";
			$d['sub_lokasi_kerja'] = ""; 
			$d['st'] = "tambah";

			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');

			// echo '<pre>'.print_r($d,true).'</pre>';exit;
			$this->load->view('dashboard_admin/master_sub_lokasi/input',$d);
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
			$id['id_sub_lokasi_kerja'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_sub_lokasi_kerja",$id);
			header('location:'.base_url().'admin/master_sub_lokasi');
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

			$this->form_validation->set_rules('id_lokasi_kerja', 'Lokasi Kerja', 'trim|required');
			$this->form_validation->set_rules('sub_lokasi_kerja', 'Seksi/Subbag/Satlak', 'trim|required');
			$id['id_sub_lokasi_kerja'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$d['page_name'] = 'Ubah Master Seksi/ Subbag/ Satlak';
					$q = $this->db->get_where("tbl_master_sub_lokasi_kerja",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_sub_lokasi_kerja;
						$d['id_sub_lokasi_kerja'] = $dt->id_sub_lokasi_kerja;
						$d['sub_lokasi_kerja'] = $dt->sub_lokasi_kerja;
						$d['id_lokasi_kerja'] = $dt->id_lokasi_kerja; 
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_sub_lokasi/input',$d);
				}
				else if($st=="tambah")
				{
					$d['page_name'] = 'Tambah Master Seksi/ Subbag/ Satlak';
					$d['id_param'] = "";
					$d['id_sub_lokasi_kerja'] = "";
					$d['sub_lokasi_kerja'] = "";
					$d['id_lokasi_kerja'] = ""; 
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_sub_lokasi/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['sub_lokasi_kerja'] = $this->input->post("sub_lokasi_kerja");
					$upd['id_lokasi_kerja'] = $this->input->post("id_lokasi_kerja");
					$this->db->update("tbl_master_sub_lokasi_kerja",$upd,$id);
					redirect('admin/master_sub_lokasi');
				}
				else if($st=="tambah")
				{
					$in['sub_lokasi_kerja'] = $this->input->post("sub_lokasi_kerja");
					$in['id_lokasi_kerja'] = $this->input->post("id_lokasi_kerja");
					$this->db->insert("tbl_master_sub_lokasi_kerja",$in);
					redirect('admin/master_sub_lokasi');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_sub_lokasi.php */
/* Location: ./application/controllers/master_sub_lokasi.php */