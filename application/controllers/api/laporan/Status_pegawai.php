<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_pegawai extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_list() {
		$cond = 'where 1=1';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('id_status_pegawai');
		if($search != "0" && $search != "")
		{
			$cond .= " and a.status_pegawai = ".$search;
		}
		
		$q = "
			select a.nip, a.nrk, a. nama_pegawai, a.tempat_lahir, a.tanggal_lahir, a.jenis_kelamin, a.agama, a.usia, b.nama_status  
			from tbl_data_pegawai a 
			left join tbl_master_status_pegawai b on a.status_pegawai=b.id_status_pegawai 
			".$cond." 
			order by a.nama_pegawai asc";
		
		echo json_encode($this->db->query($q)->result_array());
	}
}