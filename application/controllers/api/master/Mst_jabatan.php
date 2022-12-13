<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mst_jabatan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function list() {
		$q = "select a.*,b.*,c.nama_jabatan as nama_jabatan_atasan 
			from tbl_master_nama_jabatan a 
			left join tbl_master_status_jabatan b on a.id_status_jabatan=b.id_status_jabatan 
			left join tbl_master_nama_jabatan c on a.id_jabatan_atasan=c.id_nama_jabatan 
			order by a.nama_jabatan asc";
		echo json_encode($this->db->query($q)->result_array());
	}
}