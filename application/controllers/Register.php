<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index()
	{
		$this->load->view('register/index_register');
	}
	function aksi_register(){
		$ci_user = str_replace(' ','',$this->input->post('Email'));
		$ci_pass =  md5($this->input->post('password'));
		$Nama_anggota 	= $this->input->post('Nama_anggota');
		$Email 	= $this->input->post('Email');
		$Alamat 	= $this->input->post('Alamat');
		$data['Email'] 		= $ci_user;
		$data['Gid'] 			= '3';
		$data['Password'] 		= $ci_pass;
		$data['Nama_anggota'] 	= $Nama_anggota;
		$data['Alamat'] 	= $Alamat;

		$this->db->insert('tb_anggota', $data);
		redirect(base_url('login'));
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
