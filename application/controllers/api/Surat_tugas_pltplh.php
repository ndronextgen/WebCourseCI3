<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_tugas_pltplh extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function listing() {
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
				(select count(0) from tbl_data_surat_tugas_pltplh where tbl_data_surat_tugas_pltplh.id_pegawai = a.id_pegawai) as count_surat,
				(select date_created from tbl_data_surat_tugas_pltplh where tbl_data_surat_tugas_pltplh.id_pegawai = a.id_pegawai order by date_created desc limit 1) as date_created
			from tbl_data_pegawai a 
			where a.id_pegawai  !='' ".$cond." 
			order by date_created desc, a.nama_pegawai asc ";
		
		echo json_encode($this->db->query($q)->result_array());
	}
	
	public function list_detail() {
		$id_pegawai = $this->input->post('id_pegawai');
		$q = "SELECT p.*, p1.nm_peg1, p2.nm_peg2
				FROM tbl_data_surat_tugas_pltplh as p
					LEFT JOIN (
						SELECT nama_pegawai as nm_peg1, id_pegawai as pid1 FROM tbl_data_pegawai
					) as p1 ON p1.pid1 = p.id_pegawai
					LEFT JOIN (
						SELECT nama_pegawai as nm_peg2, id_pegawai as pid2 FROM tbl_data_pegawai
					) as p2 ON p2.pid2 = p.id_pegawai_berhalangan
				WHERE id_pegawai = '$id_pegawai'";
		
		echo json_encode($this->db->query($q)->result_array());
	}
	
	public function detail() {
		$id_surat = $this->input->post('id_surat');
		$q = "select * 
				from tbl_data_surat_tugas_pltplh 
				where id_surat_tugas_pltplh=".$id_surat;
		
		echo json_encode($this->db->query($q)->row());
	}
}