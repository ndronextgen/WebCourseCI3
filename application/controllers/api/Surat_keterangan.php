<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_Keterangan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function datatable_() {
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and d.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$nama_pegawai = $this->input->post('nama_pegawai');
		if ($nama_pegawai != '') {
			$cond .= " AND a.nama like '%".$nama_pegawai."%'";
		}

		$status = $this->input->post('id_status_surat');
		if ($status != 'x') {
			$cond .= " AND a.id_status_srt=".$status;
		}

		$q = "select a.*, b.nama_surat as jenis_surat, c.nama_status as status 
				from tbl_data_srt_ket a 
				left join tbl_master_surat b on a.jenis_surat = b.id_mst_srt 
				left join tbl_status_surat c on a.id_status_srt = c.id_status 
				left join tbl_data_pegawai d on d.id_pegawai = a.id_user 
				where 1=1 ".$cond." 
				order by tgl_surat desc";

		echo json_encode($this->db->query($q)->result_array());
	}
	
	public function datatable__() {
		$cond = '';
		$id_view = $this->session->userdata('id_user');
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and d.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$nama_pegawai = $this->input->post('nama_pegawai');
		if ($nama_pegawai != '') {
			$cond .= " AND a.nama like '%".$nama_pegawai."%'";
		}

		$status = $this->input->post('id_status_surat');
		if ($status != 'x') {
			$cond .= " AND a.id_status_srt=".$status;
		}

		$q = "SELECT a.*, b.nama_surat as jenis_surat, c.nama_status as status, jml, 
					if(a.jenis_pengajuan_surat='X',concat(e.keterangan,'(',a.jenis_pengajuan_surat_lainnya,')'),e.keterangan)as keterangan_pengajuan
				FROM tbl_data_srt_ket a 
				LEFT JOIN tbl_master_surat b on a.jenis_surat = b.id_mst_srt 
				LEFT JOIN tbl_status_surat c on a.id_status_srt = c.id_status 
				LEFT JOIN tbl_data_pegawai d on d.id_pegawai = a.id_user 
				LEFT JOIN tbl_master_jenis_pengajuan_surat e on a.jenis_pengajuan_surat = e.kode
				LEFT JOIN(
					SELECT count(*) as jml, id_view, id_srt 
					FROM tbl_data_srt_ket_see WHERE id_view='$id_view'
					GROUP BY id_view, id_srt
				) as see ON see.id_srt = a.id_srt
				WHERE 1=1 ".$cond." 
				ORDER BY id_srt DESC";

		echo json_encode($this->db->query($q)->result_array());
	}

	public function datatable() {
		$cond = '';
		$id_view = $this->session->userdata('id_user');
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and d.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$nama_pegawai = $this->input->post('nama_pegawai');
		if ($nama_pegawai != '') {
			$cond .= " AND a.nama like '%".$nama_pegawai."%'";
		}

		$status = $this->input->post('id_status_surat');
		if ($status != 'x') {
			$cond .= " AND a.id_status_srt=".$status;
		}

		$q = "SELECT a.*, b.nama_surat as jenis_surat, c.id_status, c.nama_status as status, c.nama_status_next, c.backcolor, c.fontcolor,
					if(isnull(jml) AND a.id_status_srt not in ('0','23'), '1', jml) as jml, 
					if(a.jenis_pengajuan_surat='X', concat(e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')'), e.keterangan) as keterangan_pengajuan
				FROM tbl_data_srt_ket a 
				LEFT JOIN tbl_master_surat b on a.jenis_surat = b.id_mst_srt 
				LEFT JOIN tbl_status_surat c on a.id_status_srt = c.id_status 
				LEFT JOIN tbl_data_pegawai d on d.id_pegawai = a.id_user 
				LEFT JOIN tbl_master_jenis_pengajuan_surat e on a.jenis_pengajuan_surat = e.kode
				LEFT JOIN(
					SELECT count(*) as jml, id_view, id_srt 
					FROM tbl_data_srt_ket_see WHERE id_view='$id_view' AND (id_status_srt='0' OR id_status_srt='23')
					GROUP BY id_view, id_srt
				) as see ON see.id_srt = a.id_srt
				WHERE 1=1 ".$cond." 
				ORDER BY id_srt DESC";

		echo json_encode($this->db->query($q)->result_array());
	}

}