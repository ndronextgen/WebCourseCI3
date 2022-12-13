<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mst_lokasi_kerja extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function listing() {
		echo json_encode($this->db->get("tbl_master_lokasi_kerja")->result());
	}
}