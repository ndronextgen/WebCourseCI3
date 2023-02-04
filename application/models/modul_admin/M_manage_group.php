<?php
	
	class M_manage_group extends CI_Model {

		var $aColumns = array(
						'bpiw_group.id',
						'bpiw_group.group_id',
						'bpiw_group.group_nama',
						'bpiw_group.keterangan'
						);

		function listing() {
			$number = $_POST['length'];
			$offset = $_POST['start'];
		
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND bpiw_group.group_nama LIKE '%$search%'";
			}
			else {
				$k_search = "";
			}

			$query = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $this->aColumns))."
						FROM bpiw_group
						WHERE id != '' $k_search order by bpiw_group.id desc
						limit $offset, $number";

			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua() {
			$sQuery = "SELECT COUNT(id) as jml FROM bpiw_group where id != ''";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}

		function jumlah_filter() {
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND bpiw_group.group_nama LIKE '%$search%'";
			}
			else {
				$k_search = "";
			}
			
			$sQuery = "SELECT COUNT(id) as jml FROM bpiw_group where id !='' $k_search ";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}
	}

?>