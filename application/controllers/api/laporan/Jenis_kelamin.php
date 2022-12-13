<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_kelamin extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_list() {
		$cond = 'where 1=1';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('jenis_kelamin');
		if($search != "0" && $search != "")
		{
			$cond .= " and lower(a.jenis_kelamin) = '".strtolower($search)."'";
		}
		
		$q = "select a.nip, a.nrk, a.nama_pegawai, a.tempat_lahir, a.tanggal_lahir,a.jenis_kelamin, a.agama
				from tbl_data_pegawai a 
				$cond";
		
		echo json_encode($this->db->query($q)->result_array());
	}
}