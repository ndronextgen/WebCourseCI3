<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_status_pegawai extends CI_Controller {

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
			$d['page_name'] = 'Master Status Pegawai';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_status_pegawai/home',$d);
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
			$d['page_name'] = 'Ubah Status Pegawai';
			$d['menu_open'] = 'master';

			$id['id_status_pegawai'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_status_pegawai",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_status_pegawai;
				$d['nama_status'] = $dt->nama_status; 
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_status_pegawai/input',$d);
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
			$d['page_name'] = 'Detail Status Pegawai';
			$d['menu_open'] = 'master';

			$id['id_status_pegawai'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_status_pegawai",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_status_pegawai;
				$d['nama_status'] = $dt->nama_status; 
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_status_pegawai/detail',$d);
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
			$d['page_name'] = 'Tambah Status Pegawai';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['nama_status'] = ""; 
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master_status_pegawai/input',$d);
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
			$id['id_status_pegawai'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_status_pegawai",$id);
			header('location:'.base_url().'admin/master_status_pegawai');
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

			$this->form_validation->set_rules('nama_status', 'Nama Status Pegawai', 'trim|required');
			$id['id_status_pegawai'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$q = $this->db->get_where("tbl_master_status_pegawai",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_status_pegawai;
						$d['nama_status'] = $dt->nama_status; 
					}
					$d['st'] = $st;
					$d['page_name'] = 'Ubah Status Pegawai';
					$this->load->view('dashboard_admin/master_status_pegawai/input',$d);
				}
				else if($st=="tambah")
				{
					$d['id_param'] = "";
					$d['nama_status'] = ""; 
					$d['st'] = $st;
					$d['page_name'] = 'Tambah Status Pegawai';
					$this->load->view('dashboard_admin/master_status_pegawai/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['nama_status'] = $this->input->post("nama_status");
					$this->db->update("tbl_master_status_pegawai",$upd,$id);
					redirect('admin/master_status_pegawai');
				}
				else if($st=="tambah")
				{
					$in['nama_status'] = $this->input->post("nama_status");
					$this->db->insert("tbl_master_status_pegawai",$in);
					redirect('admin/master_status_pegawai');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_status_pegawai.php */
/* Location: ./application/controllers/master_status_pegawai.php */