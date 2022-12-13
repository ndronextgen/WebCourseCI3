<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_golongan extends CI_Controller {

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
			$d['page_name'] = 'Master Golongan';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_golongan/home',$d);
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
			$d['page_name'] = 'Detail Master Golongan';
			$d['menu_open'] = 'master';
			$id['id_golongan'] = $this->uri->segment(4);
			$q = $this->db->get_where("tbl_master_golongan",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_golongan;
				$d['golongan'] = $dt->golongan; 
				$d['uraian'] = $dt->uraian; 
				$d['level'] = $dt->level; 
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_golongan/input',$d);
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
			$d['page_name'] = 'Detail Master Golongan';
			$d['menu_open'] = 'master';
			$id['id_golongan'] = $this->uri->segment(4);

			$q = $this->db->get_where("tbl_master_golongan",$id);
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_golongan;
				$d['golongan'] = $dt->golongan; 
				$d['uraian'] = $dt->uraian; 
				$d['level'] = $dt->level; 
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/master_golongan/detail',$d);
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
			$d['page_name'] = 'Tambah Master Golongan';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['golongan'] = ""; 
			$d['uraian'] = ""; 
			$d['level'] = ""; 
			$d['st'] = "tambah";

			$this->load->view('dashboard_admin/master_golongan/input',$d);
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
			$id['id_golongan'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_golongan",$id);
			header('location:'.base_url().'admin/master_golongan');
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

			$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');
			$this->form_validation->set_rules('uraian', 'Uraian', 'trim|required');
			$this->form_validation->set_rules('level', 'Level', 'trim|required');
			$id['id_golongan'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$d['page_name'] = 'Ubah Master Golongan';

					$q = $this->db->get_where("tbl_master_golongan",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_golongan;
						$d['golongan'] = $dt->golongan; 
						$d['uraian'] = $dt->uraian; 
						$d['level'] = $dt->level; 
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_golongan/input',$d);
				}
				else if($st=="tambah")
				{
					$d['page_name'] = 'Tambah Master Golongan';
					$d['id_param'] = "";
					$d['golongan'] = ""; 
					$d['uraian'] = ""; 
					$d['level'] = "";
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_golongan/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['golongan'] = $this->input->post("golongan");
					$upd['uraian'] = $this->input->post("uraian");
					$upd['level'] = $this->input->post("level");
					$this->db->update("tbl_master_golongan",$upd,$id);
					redirect('admin/master_golongan');
				}
				else if($st=="tambah")
				{
					$in['golongan'] = $this->input->post("golongan");
					$in['uraian'] = $this->input->post("uraian");
					$in['level'] = $this->input->post("level");
					$this->db->insert("tbl_master_golongan",$in);
					redirect('admin/master_golongan');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_golongan.php */
/* Location: ./application/controllers/master_golongan.php */