<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_bidang extends CI_Controller {

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
			$d['page_name'] = 'Master Bidang';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_bidang/home',$d);
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
			$d['page_name'] = 'Ubah Master Bidang';
			$d['menu_open'] = 'master';
			$id['id_bidang'] = $this->uri->segment(4);

			$q = $this->db->get_where("tbl_master_bidang",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_bidang;
				$d['nama_bidang'] = $dt->nama_bidang;
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_bidang/input',$d);
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
			$d['page_name'] = 'Detail Master Bidang';
			$d['menu_open'] = 'master';

			$id['id_bidang'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_bidang",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_bidang;
				$d['nama_bidang'] = $dt->nama_bidang; 
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_bidang/detail',$d);
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
			$d['page_name'] = 'Tambah Master Bidang';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['nama_bidang'] = ""; 
			$d['st'] = "tambah";
			$this->load->view('dashboard_admin/master_bidang/input',$d);
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
			$id['id_bidang'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_bidang",$id);
			header('location:'.base_url().'admin/master_bidang');
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

			$this->form_validation->set_rules('nama_bidang', 'Nama Bidang', 'trim|required');
			$id['id_bidang'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$d['page_name'] = 'Ubah Master Bidang';
					$q = $this->db->get_where("tbl_master_bidang",$id);
					
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_bidang;
						$d['nama_bidang'] = $dt->nama_bidang;
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_bidang/input',$d);
				}
				else if($st=="tambah")
				{
					$d['page_name'] = 'Tambah Master Bidang';
					$d['id_param'] = "";
					$d['nama_bidang'] = "";
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_bidang/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['nama_bidang'] = $this->input->post("nama_bidang");
					$this->db->update("tbl_master_bidang",$upd,$id);
					redirect('admin/master_bidang');
				}
				else if($st=="tambah")
				{
					$in['nama_bidang'] = $this->input->post("nama_bidang");
					$this->db->insert("tbl_master_bidang",$in);
					redirect('admin/master_bidang');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_bidang.php */
/* Location: ./application/controllers/master_bidang.php */