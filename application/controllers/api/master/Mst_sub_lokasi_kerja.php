<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mst_sub_lokasi_kerja extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function list() {
		$q = "select a.*,b.lokasi_kerja 
			from tbl_master_sub_lokasi_kerja a 
			left join tbl_master_lokasi_kerja b on a.id_lokasi_kerja=b.id_lokasi_kerja  
			order by a.sub_lokasi_kerja asc";
		echo json_encode($this->db->query($q)->result_array());
	}
}