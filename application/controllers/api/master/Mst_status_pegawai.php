<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mst_status_pegawai extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function list() {
		echo json_encode($this->db->get("tbl_master_status_pegawai")->result());
	}
}