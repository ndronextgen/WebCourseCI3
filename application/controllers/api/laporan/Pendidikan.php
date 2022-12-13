<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendidikan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_list() {
		$cond = 'where 1=1';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('pendidikan_bkd');
		if($search != "0" && $search != "")
		{
			$cond .= " and pendidikan_bkd = '".$search."'";
		}
		
		$q = "
			select nip, nrk, nama_pegawai, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, pendidikan_bkd, asal_sekolah 
			from tbl_data_pegawai 
			".$cond." 
			order by nama_pegawai asc";
		
		echo json_encode($this->db->query($q)->result_array());
	}
}