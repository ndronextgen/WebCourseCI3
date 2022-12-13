<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penempatan_kerja extends CI_Controller
{

	/*
		***	Controller : datatable_pegawai.php
	*/

	public function __construct()
	{
		parent::__construct();
	}

	public function datatable_list()
	{
		$cond = 'where 1=1';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('lokasi');
		if ($search != "0" && $search != "") {
			$cond .= " and a.lokasi_kerja = " . $search;
		}

		$q = "
			select a.nip, a.nrk, a. nama_pegawai, a.tempat_lahir, a.tanggal_lahir, a.jenis_kelamin, a.agama, a.usia, b.lokasi_kerja 
			from tbl_data_pegawai a 
			left join tbl_master_lokasi_kerja b on a.lokasi_kerja=b.id_lokasi_kerja 
			" . $cond . " 
			order by a.nama_pegawai asc";

		echo json_encode($this->db->query($q)->result_array());
	}
}

/* End of file dashboard_admin.php */
/* Location: ./application/api/datatable_pegawai.php */
