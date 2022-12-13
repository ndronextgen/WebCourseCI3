<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_user extends CI_Controller {

	/*
		***	Controller : manage_user.php
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
			$d['page_name'] = 'Manajemen User';
			$d['menu_open'] = '';

			$d['stts'] = $this->input->post('stts');
			if ($d['stts'] == '') {
				$d['stts'] = 'administrator';
			}

			$arrSelection = array(
				'administrator'=>'Administrator',
				'publik'=>'Publik'
			);

			$arrSelected = array();
			foreach ($arrSelection as $key=>$arrs) {
				$arrSelected[$key] = '';
				if ($d['stts'] == $key) $arrSelected[$key] = 'selected=selected';
			}

			$d['arrSelection'] = $arrSelection;
			$d['arrSelected'] = $arrSelected;
			
			$this->load->view('dashboard_admin/user/list_user',$d);
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
			$d['page_name'] = 'Ubah User';
			$d['menu_open'] = '';
			$d['st'] = "edit";

			$id_user_login = $this->uri->segment(3);
			$q = $this->db->query("
				select a.*, b.lokasi_kerja 
				from tbl_user_login a 
				left join tbl_master_lokasi_kerja b on b.id_lokasi_kerja=a.id_lokasi_kerja 
				where a.id_user_login = ".$id_user_login);
			
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_user_login;
				$d['username'] = $dt->username; 
				$d['password'] = $dt->password; 
				$d['nama_lengkap'] = $dt->nama_lengkap; 
				$d['email'] = $dt->email; 
				$d['lokasi_kerja'] = $dt->lokasi_kerja; 
				$d['id_lokasi_kerja'] = $dt->id_lokasi_kerja; 
			}
			
			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$d['mst_lokasi_kerja'] = $this->db->get_where('tbl_master_lokasi_kerja', ['id_lokasi_kerja' => $this->session->userdata('lokasi_kerja')]);
			}
			else {
				$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			}
			
			$this->load->view('dashboard_admin/user/input',$d);
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
			$d['page_name'] = 'Detail User';
			$d['menu_open'] = '';

			$id_user_login = $this->uri->segment(3);
			$q = $this->db->query("
				select a.*, b.lokasi_kerja 
				from tbl_user_login a 
				left join tbl_master_lokasi_kerja b on b.id_lokasi_kerja=a.id_lokasi_kerja 
				where a.id_user_login = ".$id_user_login);
			
			foreach($q->result() as $dt)
			{
				$d['id_param'] = $dt->id_user_login;
				$d['username'] = $dt->username; 
				$d['password'] = $dt->password; 
				$d['nama_lengkap'] = $dt->nama_lengkap; 
				$d['email'] = $dt->email; 
				$d['lokasi_kerja'] = $dt->lokasi_kerja; 
			}
			$d['st'] = "edit";
			
			$this->load->view('dashboard_admin/user/detail',$d);
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
			$d['page_name'] = 'Tambah User';
			$d['menu_open'] = '';

			$d['id_param'] = "";
			$d['username'] = ""; 
			$d['password'] = ""; 
			$d['nama_lengkap'] = ""; 
			$d['email'] = ""; 
			
			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$d['mst_lokasi_kerja'] = $this->db->get_where('tbl_master_lokasi_kerja', ['id_lokasi_kerja' => $this->session->userdata('lokasi_kerja')]);
			}
			else {
				$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			}

			$d['st'] = "tambah";
			
			$this->load->view('dashboard_admin/user/input',$d);	
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
			

			# delete user di sso
			$PegId = $this->uri->segment(3);
			$Query_peg = $this->db->query("SELECT username FROM tbl_user_login WHERE id_user_login = '$PegId'")->row();
			$nrk_user = $Query_peg->username;

			$this->load->helper('sso_user');
			#delete access terlebih dahulu
			$del_acc_user = SSODeleteUserAccessApp($nrk_user);
			//print_r($del_acc_user);
			if ($del_acc_user['status']=='success'){
				$del_user_sso = SSODeleteUser($nrk_user);
				print_r($del_user_sso);

				$id['id_user_login'] = $this->uri->segment(3);
				$this->db->delete("tbl_user_login",$id);
				header('location:'.base_url().'manage_user');
			} else {
				header('location:'.base_url().'manage_user');
			}
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
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
			$id['id_user_login'] = $this->input->post("id_param");
			
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['menu_open'] = '';

			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$d['mst_lokasi_kerja'] = $this->db->get_where('tbl_master_lokasi_kerja', ['id_lokasi_kerja' => $this->session->userdata('lokasi_kerja')]);
			}
			else {
				$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			}

			if ($this->form_validation->run() == FALSE)
			{
				$st = $this->input->post('st');

				if($st=="edit")
				{
					$q = $this->db->get_where("tbl_user_login",$id);
					
					foreach($q->result() as $dt)
					{
						$d['id_param'] = $dt->id_user_login;
						$d['username'] = $dt->username; 
						$d['password'] = $dt->password; 
						$d['email'] = $dt->email; 
						$d['nama_lengkap'] = $dt->nama_lengkap; 
					}
					$d['st'] = "edit";
					$d['page_name'] = 'Ubah User';
					
					$this->load->view('dashboard_admin/user/input',$d);
				}
				else if($st=="tambah")
				{
					$d['id_param'] = "";
					$d['username'] = ""; 
					$d['password'] = ""; 
					$d['nama_lengkap'] = ""; 
					$d['email'] = ""; 
					$d['st'] = "tambah";
					$d['page_name'] = 'Tambah User';
					$this->load->view('dashboard_admin/user/input',$d);
				}
			}
			else
			{
				$st = $this->input->post('st');
				if($st=="edit")
				{
					$upd['username'] = $this->input->post("username");
					$upd['nama_lengkap'] = $this->input->post("nama_lengkap");
					$upd['email'] = $this->input->post("email");
					$upd['id_lokasi_kerja'] = $this->input->post("id_lokasi_kerja");

					if($this->input->post("password")!="")
					{
						$upd['password'] = md5($this->input->post("password").'AppSimpeg32');
					}
					
					$this->db->update("tbl_user_login",$upd,$id);
					redirect('manage_user');
				}
				else if($st=="tambah")
				{
					$login['username'] = $this->input->post("username");
					$cek = $this->db->get_where('tbl_user_login', $login);
					if($cek->num_rows()>0)
					{
						$d['id_param'] = "";
						$d['username'] = ""; 
						$d['password'] = ""; 
						$d['nama_lengkap'] = ""; 
						$d['email'] = ""; 
						$d['st'] = "tambah";
						$d['page_name'] = 'Ubah User';
						$d['id_lokasi_kerja'] = '0';
						$this->session->set_flashdata('pass', 'Username telah ada, silahkan gunakan yang lainnya...');
						// print_r($d);exit;
						$this->load->view('dashboard_admin/user/input',$d);
					}
					else
					{
						$in['username'] = $this->input->post("username");
						$in['nama_lengkap'] = $this->input->post("nama_lengkap");
						$in['email'] = $this->input->post("email");
						$in['id_lokasi_kerja'] = $this->input->post("id_lokasi_kerja");
						$in['stts'] = "administrator";
						$in['password'] = md5($this->input->post("password").'AppSimpeg32');
						$this->db->insert("tbl_user_login",$in);
						#insert ke sso
						$this->load->helper('sso_user');
						$user_sso = SSOInsOrUpdUser($this->input->post('username'));
						print_r($this->input->post('username'));

						if ($user_sso['status']=='success'){
							$acc_user = SSOUserAccessApp($this->input->post('username'));
							print_r($acc_user);
						}
						redirect('manage_user');
					}
				}
			}

		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file manage_user.php */
/* Location: ./application/controllers/manage_user.php */