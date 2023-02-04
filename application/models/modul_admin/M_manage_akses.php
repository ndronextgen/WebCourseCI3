<?php
	
	class M_manage_akses extends CI_Model {

		var $aColumns = array(
						'master_akses.Id',
						'master_akses.Tahun',
						'master_akses.Bulan',
						'master_akses.Aktif'
						);

		function listing($tahun, $bulan) {
			$number = $_POST['length'];
			$offset = $_POST['start'];
		
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND master_akses.Tahun LIKE '%$search%'";
			}
			else {
				$k_search = "";
			}
			
			// Unite2
			if ($tahun == "") {
				$kond_tahun = "";
			}
			else {
				$kond_tahun = " AND master_akses.Tahun = '$tahun'";
			}
			
			// Unite2
			if ($bulan == "") {
				$kond_bulan = "";
			}
			else {
				$kond_bulan = " AND master_akses.Bulan = '$bulan'";
			}

			
			$query = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $this->aColumns))."
						FROM master_akses
						WHERE master_akses.Id != '' $kond_tahun $kond_bulan $k_search 
						limit $offset, $number";

			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua($tahun, $bulan) {
			$sQuery = "SELECT COUNT(Id) as jml FROM master_akses where Id != ''";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}

		function jumlah_filter($tahun, $bulan) {
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND master_akses.Tahun LIKE '%$search%'";
			}
			else {
				$k_search = "";
			}
		
			// Unite2
			if ($tahun == "") {
				$kond_tahun = "";
			}
			else {
				$kond_tahun = " AND master_akses.Tahun = '$tahun'";
			}
			
			// Unite2
			if ($bulan == "") {
				$kond_bulan = "";
			}
			else {
				$kond_bulan = " AND master_akses.Bulan = '$bulan'";
			}

			$sQuery = "SELECT COUNT(Id) as jml FROM master_akses where Id !='' $kond_tahun $kond_bulan $k_search ";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}
	}

?>