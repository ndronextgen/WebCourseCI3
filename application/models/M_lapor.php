<?php

class M_lapor extends CI_Model
{

	function listing($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$number = $_POST['length'];
		$offset = $_POST['start'];
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (a.isi_laporan LIKE '%$search%' OR a.judul_laporan LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		if ($user_type == "administrator") {
			if ($id_lokasi_kerja == '' || $id_lokasi_kerja == null || $id_lokasi_kerja == '0') { //admin utama
				$kond_lokasi = '';
			} else { //admin lokasi
				$kond_lokasi = " AND a.id_lokasi_kerja = '$id_lokasi_kerja'";
			}
		} else { //public
			$kond_lokasi = " AND a.id_pegawai = '$id_pegawai'";
		}

		$query = "SELECT
							a.id, 
							a.id_pegawai,
							a.id_lokasi_kerja,
							a.judul_laporan, 
							a.isi_laporan, 
							a.kategori, 
							a.`file_upload`, 
							a.created_at, 
							a.updated_at,
							a.user_type, a.info_lokasi, a.info_sublokasi, a.info_pegawai,
							nama_pegawai,
							lokasi_kerja
						FROM
							tr_lapor AS a
						LEFT JOIN (
							SELECT nama_pegawai, id_pegawai FROM tbl_data_pegawai
						) AS b ON b.id_pegawai =  a.id_pegawai
						
						LEFT JOIN (
							SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
						) AS c ON c.id_lokasi_kerja =  a.id_lokasi_kerja
						WHERE a.id != '' $k_search $kond_lokasi ORDER BY id DESC
						limit $offset, $number";

		if ($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
		return $query;
	}

	function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$Date_now = date('Y-m-d');
		$sQuery = "SELECT COUNT(id) AS jml FROM tr_lapor WHERE id != ''";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	function jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (a.isi_laporan LIKE '%$search%' OR a.judul_laporan LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		if ($user_type == "administrator") {
			if ($id_lokasi_kerja == '' || $id_lokasi_kerja == null || $id_lokasi_kerja == '0') { //admin utama
				$kond_lokasi = '';
			} else { //admin lokasi
				$kond_lokasi = " AND a.id_lokasi_kerja = '$id_lokasi_kerja'";
			}
		} else { //public
			$kond_lokasi = " AND a.id_pegawai = '$id_pegawai'";
		}

		$sQuery = "SELECT COUNT(a.Id) as jml FROM tr_lapor as a where a.Id !='' $k_search $kond_lokasi";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}
}
