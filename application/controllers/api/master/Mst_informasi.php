<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mst_informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list()
    {
        $q = "select *
			from tbl_master_informasi a 
            where deleted = 0
			order by a.title, a.tgl_mulai, a.tgl_akhir DESC";
        echo json_encode($this->db->query($q)->result_array());
    }
}
