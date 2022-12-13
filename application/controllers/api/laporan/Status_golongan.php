<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_golongan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_list() {
		$cond = 'where 1=1';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('id_golongan');
		if($search != "0" && $search != "")
		{
			$cond .= " and a.id_golongan = ".$search;
		}
		
		$q = "
			select a.nip, a.nrk, a. nama_pegawai, a.tempat_lahir, a.tanggal_lahir, a.jenis_kelamin, a.agama, a.usia, b.golongan 
			from tbl_data_pegawai a 
			left join tbl_master_golongan b on a.id_golongan=b.id_golongan 
			".$cond." 
			order by a.nama_pegawai asc";
		
		echo json_encode($this->db->query($q)->result_array());
	}
}