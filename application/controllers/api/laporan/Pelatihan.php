<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelatihan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_list() {
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('id_master_pelatihan');
		if($search != "0" && $search != "")
		{
			$cond .= " and b.id_master_pelatihan = ".$search;
		}
		
		$q = "select a.nip, a.nrk, a.nama_pegawai, b.uraian, b.tanggal_sertifikat, c.nama_pelatihan, b.nama_pelatihan_lainnya,
				c.id_master_pelatihan, d.nama_lokasi 
				from tbl_data_pegawai a 
				left join tbl_data_pelatihan b on a.id_pegawai=b.id_pegawai 
				left join tbl_master_pelatihan c on b.id_master_pelatihan=c.id_master_pelatihan 
				left join tbl_master_lokasi_pelatihan d on b.lokasi=d.id_lokasi_pelatihan 
				where a.id_pegawai=b.id_pegawai"
				.$cond." order by a.nama_pegawai asc";
		
		echo json_encode($this->db->query($q)->result_array());
	}
}