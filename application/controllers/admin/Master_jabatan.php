<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_jabatan extends CI_Controller {

	/*
		***	Controller : master_jabatan.php
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
			$d['page_name'] = 'Master Jabatan';
			$d['menu_open'] = 'master';
			
			$this->load->view('dashboard_admin/master_jabatan/home',$d);
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
			$d['page_name'] = 'Ubah Master Jabatan';
			$d['menu_open'] = 'master';

			$id['id_nama_jabatan'] = $this->uri->segment(4);
			$q = "select a.*,b.nama_status_jabatan,c.nama_jabatan as nama_jabatan_atasan 
				from tbl_master_nama_jabatan a 
				left join tbl_master_status_jabatan b on a.id_status_jabatan=b.id_status_jabatan 
				left join tbl_master_nama_jabatan c on a.id_jabatan_atasan=c.id_nama_jabatan 
				where a.id_nama_jabatan = ".$id['id_nama_jabatan'];
			$rs = $this->db->query($q);
			if ($dt = $rs->row())
			{
				$d['id_param'] = $dt->id_nama_jabatan;
				$d['nama_jabatan'] = $dt->nama_jabatan; 
				$d['id_status_jabatan'] = $dt->id_status_jabatan; 
				$d['nama_status_jabatan'] = $dt->nama_status_jabatan; 
				$d['level_jabatan'] = $dt->level_jabatan; 
				$d['nama_jabatan_atasan'] = $dt->nama_jabatan_atasan; 
				$d['id_jabatan_atasan'] = $dt->id_jabatan_atasan; 
			}
			$d['st'] = "edit";

			$d['mst_status_jabatan'] = $this->db->get('tbl_master_status_jabatan');
			$d['mst_jabatan_atasan'] = $this->db->get_where('tbl_master_nama_jabatan', ['id_status_jabatan' => 2]);	//get for struktural only
			// echo '<pre>'.print_r($dt,true).'</pre>';exit;
			$this->load->view('dashboard_admin/master_jabatan/input',$d);
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
			$d['page_name'] = 'Detail Master Jabatan';
			$d['menu_open'] = 'master';

			$id['id_nama_jabatan'] = $this->uri->segment(4);
			$q = "select a.*,b.nama_status_jabatan,c.nama_jabatan as nama_jabatan_atasan 
				from tbl_master_nama_jabatan a 
				left join tbl_master_status_jabatan b on a.id_status_jabatan=b.id_status_jabatan 
				left join tbl_master_nama_jabatan c on a.id_jabatan_atasan=c.id_nama_jabatan 
				where a.id_nama_jabatan = ".$id['id_nama_jabatan'];
			$rs = $this->db->query($q);
			if ($dt = $rs->row())
			{
				$d['id_param'] = $dt->id_nama_jabatan;
				$d['nama_jabatan'] = $dt->nama_jabatan; 
				$d['id_status_jabatan'] = $dt->id_status_jabatan; 
				$d['nama_status_jabatan'] = $dt->nama_status_jabatan; 
				$d['level_jabatan'] = $dt->level_jabatan; 
				$d['nama_jabatan_atasan'] = $dt->nama_jabatan_atasan; 
				$d['id_jabatan_atasan'] = $dt->id_jabatan_atasan; 
			}
			$d['st'] = "edit";
			// echo '<pre>'.print_r($dt,true).'</pre>';exit;
			$this->load->view('dashboard_admin/master_jabatan/detail',$d);
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
			$d['page_name'] = 'Tambah Master Jabatan';
			$d['menu_open'] = 'master';
			$d['id_param'] = "";
			$d['nama_jabatan'] = ""; 
			$d['nama_jabatan'] = ""; 
			$d['id_status_jabatan'] = ""; 
			$d['id_jabatan_atasan'] = ""; 
			$d['level_jabatan'] = '';
			$d['st'] = "tambah";

			$d['mst_status_jabatan'] = $this->db->get('tbl_master_status_jabatan');
			$d['mst_jabatan_atasan'] = $this->db->get_where('tbl_master_nama_jabatan', ['id_status_jabatan' => 2]);	//get for struktural only

			// echo '<pre>'.print_r($d,true).'</pre>';exit;
			$this->load->view('dashboard_admin/master_jabatan/input',$d);
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
			$id['id_nama_jabatan'] = $this->uri->segment(4);
			$this->db->delete("tbl_master_nama_jabatan",$id);
			header('location:'.base_url().'admin/master_jabatan');
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

			$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'trim|required');
			$this->form_validation->set_rules('id_status_jabatan', 'Status Jabatan', 'trim|required');
			$id['id_nama_jabatan'] = $this->input->post("id_param");
			
			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$d['page_name'] = 'Ubah Master Jabatan';
					$q = $this->db->get_where("tbl_master_nama_jabatan",$id);
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_nama_jabatan;
						$d['nama_jabatan'] = $dt->nama_jabatan;
						$d['id_status_jabatan'] = $dt->id_status_jabatan; 
					}
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_jabatan/input',$d);
				}
				else if($st=="tambah")
				{
					$d['page_name'] = 'Tambah Master Jabatan';
					$d['id_param'] = "";
					$d['nama_jabatan'] = "";
					$d['id_status_jabatan'] = ""; 
					$d['id_jabatan_atasan'] = ""; 
					$d['st'] = $st;
					$this->load->view('dashboard_admin/master_jabatan/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['nama_jabatan'] = $this->input->post("nama_jabatan");
					$upd['id_status_jabatan'] = $this->input->post("id_status_jabatan");
					$upd['id_jabatan_atasan'] = $this->input->post("id_jabatan_atasan");
					$upd['level_jabatan'] = $this->input->post("level_jabatan");
					$this->db->update("tbl_master_nama_jabatan",$upd,$id);
					redirect('admin/master_jabatan');
				}
				else if($st=="tambah")
				{
					$in['nama_jabatan'] = $this->input->post("nama_jabatan");
					$in['id_status_jabatan'] = $this->input->post("id_status_jabatan");
					$in['id_jabatan_atasan'] = $this->input->post("id_jabatan_atasan");
					$in['level_jabatan'] = $this->input->post("level_jabatan");
					$this->db->insert("tbl_master_nama_jabatan",$in);
					redirect('admin/master_jabatan');
				}
			
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_jabatan.php */
/* Location: ./application/controllers/master_jabatan.php */