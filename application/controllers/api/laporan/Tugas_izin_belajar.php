<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tugas_izin_belajar extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_list() {
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('status_belajar');
		if($search != "0" && $search != "")
		{
			$cond .= " and b.uraian = '".$search."'";
		}

		$q = "
			select * from (
				select a.nip, a.nrk, a.nama_pegawai, b.id_tubel, b.uraian, b.no_sk, b.tgl_sk, b.tgl_selesai, b.sekolah, b.akreditasi 
				from tbl_data_pegawai a 
				left join tbl_data_tubel b on a.id_pegawai=b.id_pegawai 
				".$cond." 
				order by a.nama_pegawai asc
			) tbl where tbl.id_tubel is not null";
		
		echo json_encode($this->db->query($q)->result_array());
	}
}