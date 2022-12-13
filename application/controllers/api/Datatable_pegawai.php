<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datatable_pegawai extends CI_Controller {

	/*
		***	Controller : datatable_pegawai.php
	*/

	public function __construct()
    {
        parent::__construct();
		
	}
	
	public function listing() {
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$rs = $this->db->query("SELECT a.nip,a.nrk, a.nama_pegawai, b.golongan, c.nama_status, a.id_pegawai,
								e.nama_jabatan as jabatan, f.lokasi_kerja as nama_lokasi_kerja, g.sub_lokasi_kerja as sub_lokasi_kerja,
								concat(g.sub_lokasi_kerja,'/',f.lokasi_kerja) as lokasi_lengkap,
								if(isnull(concat(g.sub_lokasi_kerja,'/',f.lokasi_kerja)), f.lokasi_kerja, concat(g.sub_lokasi_kerja,'/',f.lokasi_kerja)) as lokasi_group
								FROM tbl_data_pegawai a 
								left join tbl_master_golongan b on a.id_golongan=b.id_golongan
								left join tbl_master_status_pegawai c on a.status_pegawai=c.id_status_pegawai 
								left join tbl_master_nama_jabatan e on a.id_jabatan = e.id_nama_jabatan 
								left join tbl_master_lokasi_kerja f on a.lokasi_kerja = f.id_lokasi_kerja 
								left join tbl_master_sub_lokasi_kerja g on a.lokasi_kerja = g.id_lokasi_kerja AND a.seksi = g.id_sub_lokasi_kerja 
								where 1=1 $cond"
								);

		echo json_encode($rs->result());
	}
}

/* End of file dashboard_admin.php */
/* Location: ./application/api/datatable_pegawai.php */