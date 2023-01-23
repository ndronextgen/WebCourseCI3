<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Update_data extends CI_Controller
{

	/*
		***	Controller : update_data.php
	*/

	public function __construct()
	{
		parent::__construct();
	}

	public function datatable_list()
	{
		$tipe 		= $this->input->post('tipe');
		// ---
		$lokasi 	= $this->input->post('lokasi');
		$sublokasi 	= $this->input->post('sublokasi');
		$start_date = $this->input->post('startDate');
		$end_date 	= $this->input->post('endDate');

		$cond = '';
		if ($lokasi != 0 and $lokasi != '' and $lokasi != null) {
			$cond .= 'and peg.lokasi_kerja = \'' . $lokasi . '\'';
		}

		// === filter: date range ===
		if ($start_date != null and $end_date != null) {
			$cond .= ' and date(created_at) between \'' . $start_date . '\' and \'' . $end_date . '\'';
		}

		// === filter: sub lokasi ===
		$join = '';
		if ($sublokasi != null and $sublokasi != '' and $sublokasi != 0) {
			$cond .= ' and peg.sublokasi_kerja = \'' . $sublokasi . '\'';
		} elseif ($sublokasi == 0) {
			$join = 'LEFT ';
		}

		// === list update data pegawai ===
		if ($tipe == '0') {
			$sSQL = "SELECT peg.nrk, peg.nip, 
						concat(' ', peg.nama_pegawai) as nama_pegawai, 
						concat(' ', lok.lokasi_kerja) as lokasi_kerja, 
						concat(' ', ifnull(sublok.lokasi_kerja, '-')) sublokasi_kerja, 
						substring_index(`mod`.module_path,'>',-1) as menu, 
						date_format(`not`.created_at, '%e %b %Y - %H:%i:%s') as created_at 
					FROM tr_notif `not` 
					JOIN tbl_data_pegawai peg ON peg.nrk = `not`.created_by 
					LEFT JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
					LEFT JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
					JOIN mt_notif_modul `mod` ON `mod`.module_id = `not`.module_id 
					WHERE 1 = 1 " . $cond . " 
					ORDER BY created_at DESC";
			$rsSQL = $this->db->query($sSQL);

			// === pegawai yang sudah update ===
		} elseif ($tipe == '1') {
			$sSQL = "SELECT nip, nrk, 
						concat(' ', nama_pegawai) nama_pegawai, 
						concat(' ', IFNULL(lok.lokasi_kerja, '-')) lokasi_kerja, 
						concat(' ', IFNULL(sublok.lokasi_kerja, '-')) sublokasi_kerja, 
						count(notif_id) `notif` 
					FROM tbl_data_pegawai peg 
						JOIN tr_notif `not` ON created_by = nrk 
						JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
						" . $join . "JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
					WHERE nrk IN (SELECT DISTINCT(created_by) created_by FROM tr_notif) 
						" . $cond . " 
					GROUP BY id_pegawai 
					ORDER BY nrk";
			$rsSQL = $this->db->query($sSQL);

			// === pegawai yang belum update ===
		} elseif ($tipe == '2') {
			$sSQL = "SELECT nip, nrk, 
						concat(' ', nama_pegawai) nama_pegawai, 
						concat(' ', IFNULL(lok.lokasi_kerja, '-')) lokasi_kerja, 
						concat(' ', IFNULL(sublok.lokasi_kerja, '-')) sublokasi_kerja, 
						count(notif_id) `notif` 
					FROM tbl_data_pegawai peg 
						LEFT JOIN tr_notif `not` on `not`.created_by = peg.nrk 
						JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
						LEFT JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
					WHERE nrk NOT IN (SELECT DISTINCT(created_by) created_by FROM tr_notif) 
						" . $cond . " 
					GROUP BY id_pegawai 
					ORDER BY peg.lokasi_kerja, peg.sublokasi_kerja, peg.nrk";
			$rsSQL = $this->db->query($sSQL);
		}

		if (isset($rsSQL)) {
			echo json_encode($rsSQL->result());
		}
	}
}

/* End of file Update_data.php */
/* Location: ./application/api/laporan/Update_data.php */
