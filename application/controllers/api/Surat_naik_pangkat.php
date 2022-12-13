<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_naik_pangkat extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}

	public function datatable_old() {
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and b.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
		}

		$id_status_surat = $this->input->post('id_status_surat');
		if ($id_status_surat != '' && $id_status_surat != 'x') {
			$cond .= " AND a.id_status_srt = ".$id_status_surat;
		}

		$q = "select a.*, b.nama_lengkap as user_created, c.nama_status as status_surat 
			from tbl_data_surat_naik_pangkat a 
			left join tbl_user_login b on a.id_user_created = b.id_user_login
			left join tbl_status_surat c on a.id_status_srt = c.id_status 
			where 1=1
			".$cond." 
			order by a.date_created desc, user_created asc ";
		
		echo json_encode($this->db->query($q)->result_array());
	}

	public function datatable() {
		$cond = '';
		$user_view = $this->session->userdata('username');
		$admin_lk = $this->session->userdata('lokasi_kerja');

		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			//$cond .= ' AND b.id_lokasi_kerja='.$this->session->userdata('lokasi_kerja');
			$cond .= ' AND lk='.$this->session->userdata('lokasi_kerja');
		}

		$id_status_surat = $this->input->post('id_status_surat');
		if ($id_status_surat != '' && $id_status_surat != 'x') {
			$cond .= " AND a.id_status_srt = ".$id_status_surat;
		}

		$q = "SELECT a.*, b.nama_lengkap as user_created, c.nama_status as status_surat, group_nama, group_dinas, lk, '$admin_lk' as admin_lk, jml
				FROM tbl_data_surat_naik_pangkat a 
				LEFT JOIN tbl_user_login b on a.id_user_created = b.id_user_login
				LEFT JOIN tbl_status_surat c on a.id_status_srt = c.id_status 
				LEFT JOIN(
					SELECT count(*) as jml, user_view, id_surat_naik_pangkat 
					FROM tbl_data_surat_naik_pangkat_see WHERE user_view='$user_view'
					GROUP BY user_view, id_surat_naik_pangkat
				) as see ON see.id_surat_naik_pangkat = a.id_surat_naik_pangkat
				LEFT JOIN (
							SELECT 
								DATA.id_surat_naik_pangkat, DATA.id_surat_naik_pangkat_dt, 
								DATA.gid_pegawai, DATA.created_at,
								GROUP_CONCAT(nama_pegawai) as group_nama,
								dinas as group_dinas, lk
							FROM 
							(
								SELECT
								n.id_surat_naik_pangkat_dt,
								n.id_surat_naik_pangkat,
								GROUP_CONCAT(n.id_pegawai) as gid_pegawai,
								n.created_at	
								FROM
								tbl_data_surat_naik_pangkat_dt as n
								GROUP BY n.id_surat_naik_pangkat
							) DATA 
							LEFT JOIN(
								SELECT nama_pegawai, id_pegawai, lokasi_kerja as lk, dinas
								FROM tbl_data_pegawai
								LEFT JOIN (
									SELECT id_lokasi_kerja, dinas FROM tbl_master_lokasi_kerja
								) AS jj ON jj.id_lokasi_kerja =  tbl_data_pegawai.lokasi_kerja
							) as nf ON FIND_IN_SET (nf.id_pegawai,DATA.gid_pegawai) > 0 
							GROUP BY DATA.id_surat_naik_pangkat
				) as tomi ON tomi.id_surat_naik_pangkat = a.id_surat_naik_pangkat
				WHERE 1=1
				".$cond."  ORDER BY a.id_surat_naik_pangkat DESC";
		
		echo json_encode($this->db->query($q)->result_array());
	}
}