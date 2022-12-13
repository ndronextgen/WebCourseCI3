<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mst_penghargaan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		
	}
	
	public function list() {
		$rs = $this->db->get('tbl_master_penghargaan');
		echo json_encode($rs->result());
	}
}