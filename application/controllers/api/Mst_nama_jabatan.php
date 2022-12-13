<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mst_nama_jabatan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		
	}
	
	public function list() {
		$rs = $this->db->get('tbl_master_nama_jabatan');
		echo json_encode($rs->result());
	}
}