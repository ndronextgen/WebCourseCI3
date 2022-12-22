<?php

class M_pengembangan_karir extends CI_Model
{

	function listing($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$number = $_POST['length'];
		$offset = $_POST['start'];
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (e.nama_pegawai LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		if ($user_type == "administrator") {
			if ($id_lokasi_kerja == '' || $id_lokasi_kerja == null || $id_lokasi_kerja == '0' || $id_lokasi_kerja == '52') { //admin utama
				$kond_lokasi = '';
			} else { //admin lokasi
				$kond_lokasi = " AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}
		} else { //public
			$kond_lokasi = " AND a.id_pegawai = '$id_pegawai'";
		}

		$query = "SELECT
						a.Id, 
						a.id_pegawai, 
						a.lokasi_kerja_pegawai, 
						a.is_dinas, 
						a.Pengembangan_karir_id, 
						a.Keterangan, 
						a.Keperluan, 
						a.Periode_awal, 
						a.Periode_akhir, 
						a.Status_progress, 
						a.Notes, 
						a.Nomor_surat, 
						a.Tanggal_verifikasi, 
						a.Created_by, 
						a.Created_at, 
						a.Updated_by, 
						a.Updated_at,
						c.nama_lengkap,
						b.nama_status,
						e.nama_pegawai
					FROM
						tr_pengembangan_karir AS a
					LEFT JOIN (
						SELECT id_status, nama_status FROM tbl_status_surat
					) as b ON b.id_status = a.Status_progress
					LEFT JOIN (
						SELECT username, nama_lengkap FROM tbl_user_login
					) as c ON c.username = a.Created_by
					LEFT JOIN (
						SELECT id_pegawai, nama_pegawai FROM tbl_data_pegawai
					) as e ON e.id_pegawai = a.id_pegawai
						WHERE a.Id != '' $kond_lokasi $k_search order by Id desc
						limit $offset, $number";

		if ($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
		return $query;
	}

	function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$Date_now = date('Y-m-d');
		$sQuery = "SELECT COUNT(Id) as jml FROM tr_pengembangan_karir where Id != '' AND id_pegawai = '$id_pegawai'";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	function jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (e.nama_pegawai LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		if ($user_type == "administrator") {
			if ($id_lokasi_kerja == '' || $id_lokasi_kerja == null || $id_lokasi_kerja == '0') { //admin utama
				$kond_lokasi = '';
			} else { //admin lokasi
				$kond_lokasi = " AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}
		} else { //public
			$kond_lokasi = " AND a.id_pegawai = '$id_pegawai'";
		}

		$sQuery = "SELECT COUNT(*) as jml FROM (SELECT
							a.Id, 
							a.id_pegawai, 
							a.lokasi_kerja_pegawai, 
							a.is_dinas, 
							a.Pengembangan_karir_id, 
							a.Keterangan, 
							a.Keperluan, 
							a.Periode_awal, 
							a.Periode_akhir, 
							a.Status_progress, 
							a.Notes, 
							a.Nomor_surat, 
							a.Tanggal_verifikasi, 
							a.Created_by, 
							a.Created_at, 
							a.Updated_by, 
							a.Updated_at,
							c.nama_lengkap,
							b.nama_status,
							e.nama_pegawai
						FROM
							tr_pengembangan_karir AS a
						LEFT JOIN (
							SELECT id_status, nama_status FROM tbl_status_surat
						) as b ON b.id_status = a.Status_progress
						LEFT JOIN (
							SELECT username, nama_lengkap FROM tbl_user_login
						) as c ON c.username = a.Created_by
						LEFT JOIN (
							SELECT id_pegawai, nama_pegawai FROM tbl_data_pegawai
						) as e ON e.id_pegawai = a.id_pegawai
							WHERE a.Id != '' $kond_lokasi $k_search) DATA ";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	
}
