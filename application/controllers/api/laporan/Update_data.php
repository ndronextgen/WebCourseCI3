<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Update_data extends CI_Controller
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
		$tipe = $this->input->post('tipe');

		$lokasi = $this->input->post('lokasi');

		$cond = '';
		if ($lokasi !== '0') {
			$cond .= 'and peg.lokasi_kerja = ' . $lokasi . ' ';
		}

		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and peg.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
		}

		// === list update data pegawai ===
		if ($tipe == '0') {


			$sSQL = "SELECT peg.nrk, peg.nip, 
				concat(' ', peg.nama_pegawai) as nama_pegawai, 
				concat(' ', lok.lokasi_kerja) as lokasi_kerja, 
				substring_index(`mod`.module_path,'>',-1) as menu, 
				date_format(`not`.created_at, '%e %b %Y - %H:%i:%s') as created_at 
			FROM tr_notif `not` 
			JOIN tbl_data_pegawai peg ON peg.nrk = `not`.created_by 
			JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
			JOIN mt_notif_modul `mod` ON `mod`.module_id = `not`.module_id 
			WHERE 1=1 " . $cond . " 
			ORDER BY created_at DESC";

			$rsSQL = $this->db->query($sSQL);

			// === pegawai yang sudah update ===
		} elseif ($tipe == '1') {
			$sSQL = "SELECT nip, nrk, 
						concat(' ', nama_pegawai) nama_pegawai, 
						concat(' ', ifnull(lok.lokasi_kerja, '-')) lokasi_kerja, 
						count(notif_id) `notif` 
					from tbl_data_pegawai peg 
						left join tr_notif `not` on created_by = nrk 
						left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
					where nrk in (select distinct(created_by) created_by from tr_notif) 
						" . $cond . " 
					group by id_pegawai 
					order by nrk";
			$rsSQL = $this->db->query($sSQL);

			// === pegawai yang belum update ===
		} elseif ($tipe == '2') {
			$sSQL = "SELECT nip, nrk, 
						concat(' ', nama_pegawai) nama_pegawai, 
						concat(' ', ifnull(lok.lokasi_kerja, '-')) lokasi_kerja, 
						count(notif_id) `notif` 
					from tbl_data_pegawai peg 
						left join tr_notif `not` on created_by = nrk 
						left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
					where nrk not in (select distinct(created_by) created_by from tr_notif) 
						" . $cond . " 
					group by id_pegawai 
					order by nrk";
			$rsSQL = $this->db->query($sSQL);
		}

		if (isset($rsSQL)) {
			echo json_encode($rsSQL->result());
		}
	}
}

/* End of file Update_data.php */
/* Location: ./application/api/laporan/Update_data.php */
