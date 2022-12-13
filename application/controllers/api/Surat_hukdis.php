<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_hukdis extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function list() {
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$search = $this->input->post('id_master_pelatihan');
		if($search != "")
		{
			$cond .= " and LOWER(a.nama_pegawai) like '%".strtolower($search)."%'";
		}
		
		$q = "select a.id_pegawai, a.nip, a.nrk, a.nama_pegawai, 
				(select count(0) from tbl_data_surat_hukdis where tbl_data_surat_hukdis.id_pegawai = a.id_pegawai) as count_surat,
				(select date_created from tbl_data_surat_hukdis where tbl_data_surat_hukdis.id_pegawai = a.id_pegawai order by date_created desc limit 1) as date_created
			from tbl_data_pegawai a 
			where a.id_pegawai not in (
				select id_pegawai from tbl_data_hukuman
			) ".$cond." 
			order by date_created desc, a.nama_pegawai asc ";
		
		echo json_encode($this->db->query($q)->result_array());
	}
	
	public function list_detail() {
		$id_pegawai = $this->input->post('id_pegawai');
		$q = "select a.*, b.name as tipe_surat 
				from tbl_data_surat_hukdis a 
				left join tbl_master_tipe_surat_hukdis b on a.id_tipe_surat_hukdis=b.id_tipe_surat_hukdis 
				where a.id_pegawai=".$id_pegawai." 
				order by a.date_created desc";
		
		echo json_encode($this->db->query($q)->result_array());
	}
	
	public function detail() {
		$id_surat = $this->input->post('id_surat');
		$q = "select * 
				from tbl_data_surat_hukdis 
				where id_surat_hukdis=".$id_surat;
		
		echo json_encode($this->db->query($q)->row());
	}
}