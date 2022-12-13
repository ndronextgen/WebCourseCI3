<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function list() {
		$cond = 'where 1=1 ';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.id_lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}
		
		$stts = $this->input->post('stts');
		if ($stts != '' && $stts != 'xxx') {
			$cond .= " and a.stts='".$stts."'";
		}
		
		$q = "
			select a.*,b.lokasi_kerja as nama_lokasi_kerja 
			from tbl_user_login a 
			left join tbl_master_lokasi_kerja b on b.id_lokasi_kerja = a.id_lokasi_kerja 
			".$cond." order by stts asc";
		
		echo json_encode($this->db->query($q)->result_array());
	}
	
	public function get_list() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->post('key');
		
		if ($apiKey == $key) {
			$status = true;

			$q = "
			select a.*,b.lokasi_kerja as nama_lokasi_kerja 
			from tbl_user_login a 
			left join tbl_master_lokasi_kerja b on b.id_lokasi_kerja = a.id_lokasi_kerja 
			order by username asc";
			
			$data = $this->db->query($q)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}
}