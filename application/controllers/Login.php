<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('login/index_login');
	}
	function aksi_login(){
		$ci_user = str_replace(' ','',$this->input->post('username'));
		$ci_pass =  md5($this->input->post('password'));
		
		$cek = $this->db->query("SELECT count(*) as jml FROM tb_user 
							WHERE REPLACE(Username,' ','') = '$ci_user' AND Password = '$ci_pass'")->row();


		$cek_pendaftar = $this->db->query("SELECT count(*) as jml FROM tb_anggota 
									WHERE REPLACE(Email,' ','') = '$ci_user' AND Password = '$ci_pass'")->row();

		if($cek->jml > 0){
			$a = $this->db->query("SELECT * FROM tb_user 
									WHERE REPLACE(Username,' ','') = '$ci_user'  AND Password = '$ci_pass'")->row();
			$data_session = array(
				'ses_id' => $a->Id,
				'ses_Gid' => $a->Gid,
				'ses_user' => $a->Username,
				'ses_user_type' => "admin",
				);

			$this->session->set_userdata($data_session);
			redirect(base_url("Dashboard"));

		} else if($cek_pendaftar->jml > 0){
			$a = $this->db->query("SELECT * FROM tb_anggota 
									WHERE REPLACE(Email,' ','') = '$ci_user' AND Password = '$ci_pass'")->row();
			$data_session = array(
				'ses_id' => $a->Id,
				'ses_Gid' => $a->Gid,
				'ses_user' => $a->Email,
				'ses_user_type' => "pendaftar",
				);

			$this->session->set_userdata($data_session);
			redirect(base_url("Dashboard"));

		} else {
			echo "Username dan password salah !";
		}	
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
