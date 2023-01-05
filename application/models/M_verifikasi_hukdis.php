<?php
	
	class M_verifikasi_hukdis extends CI_Model {

		function listing($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$number = $_POST['length'];
			$offset = $_POST['start'];
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (e.nama_pegawai LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.Status_progress in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " ";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.Status_progress in ('22','23','24','25','26','3')";
				$kond_lokasi = " ";
			} elseif($status_verifikasi == 'sudinupt'){
				$kond_status = " AND a.Status_progress in ('21','27','24','28','3')";
				$kond_lokasi = " AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			} else {
				$kond_status = " AND a.Status_progress in ('')";
				$kond_lokasi = " AND a.is_dinas != '' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}
			
			$query = "SELECT
							a.Id, 
							a.id_pegawai, 
							a.lokasi_kerja_pegawai, 
							a.is_dinas, 
							a.Hukdis_id, 
							a.Type_surat, 
							a.Keterangan, 
							a.Status_progress, 
							a.Notes, 
							a.Nomor_surat, 
							a.Tanggal_verifikasi, 
							a.Created_by, 
							a.Created_at, 
							a.Updated_by, 
							a.Updated_at,
							c.nama_lengkap,
							b.nama_status, b.nama_status_next, b.backcolor, b.fontcolor,
							d.nama_type as nama_type,
							e.nama_pegawai
						FROM
							tr_hukdis AS a
						LEFT JOIN (
							SELECT id_status, nama_status, nama_status_next, backcolor, fontcolor
							FROM tbl_status_surat
						) as b ON b.id_status = a.Status_progress
						LEFT JOIN (
							SELECT username, nama_lengkap FROM tbl_user_login
						) as c ON c.username = a.Created_by
						LEFT JOIN (
							SELECT id_tipe_surat_hukdis, name as nama_type FROM tbl_master_tipe_surat_hukdis
						) as d ON d.id_tipe_surat_hukdis = a.Type_surat
						LEFT JOIN (
							SELECT id_pegawai, nama_pegawai FROM tbl_data_pegawai
						) as e ON e.id_pegawai = a.id_pegawai
							WHERE a.Id != '' $kond_status $kond_lokasi $k_search order by Id desc
							limit $offset, $number";
			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$Date_now = date('Y-m-d');
			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.Status_progress in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " ";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.Status_progress in ('22','23','24','25','26','3')";
				$kond_lokasi = " ";
			} elseif($status_verifikasi == 'sudinupt'){
				$kond_status = " AND a.Status_progress in ('21','27','24','28','3')";
				$kond_lokasi = " AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			} else {
				$kond_status = " AND a.Status_progress in ('')";
				$kond_lokasi = " AND a.is_dinas != '' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}
			$sQuery = "SELECT COUNT(*) as jml FROM (
							SELECT
							a.Id, 
							a.id_pegawai, 
							a.lokasi_kerja_pegawai, 
							a.is_dinas, 
							a.Hukdis_id, 
							a.Type_surat, 
							a.Keterangan, 
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
							d.nama_type as nama_type,
							e.nama_pegawai
						FROM
							tr_hukdis AS a
						LEFT JOIN (
							SELECT id_status, nama_status FROM tbl_status_surat
						) as b ON b.id_status = a.Status_progress
						LEFT JOIN (
							SELECT username, nama_lengkap FROM tbl_user_login
						) as c ON c.username = a.Created_by
						LEFT JOIN (
							SELECT id_tipe_surat_hukdis, name as nama_type FROM tbl_master_tipe_surat_hukdis
						) as d ON d.id_tipe_surat_hukdis = a.Type_surat
						LEFT JOIN (
							SELECT id_pegawai, nama_pegawai FROM tbl_data_pegawai
						) as e ON e.id_pegawai = a.id_pegawai
							WHERE a.Id != '' $kond_status $kond_lokasi
						) DATA";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}

		function jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (e.nama_pegawai LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.Status_progress in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " ";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.Status_progress in ('22','23','24','25','26','3')";
				$kond_lokasi = " ";
			} elseif($status_verifikasi == 'sudinupt'){
				$kond_status = " AND a.Status_progress in ('21','27','24','28','3')";
				$kond_lokasi = " AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			} else {
				$kond_status = " AND a.Status_progress in ('')";
				$kond_lokasi = " AND a.is_dinas != '' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}

			
			$sQuery = "SELECT COUNT(*) as jml FROM (
							SELECT
							a.Id, 
							a.id_pegawai, 
							a.lokasi_kerja_pegawai, 
							a.is_dinas, 
							a.Hukdis_id, 
							a.Type_surat, 
							a.Keterangan, 
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
							d.nama_type as nama_type,
							e.nama_pegawai
						FROM
							tr_hukdis AS a
						LEFT JOIN (
							SELECT id_status, nama_status FROM tbl_status_surat
						) as b ON b.id_status = a.Status_progress
						LEFT JOIN (
							SELECT username, nama_lengkap FROM tbl_user_login
						) as c ON c.username = a.Created_by
						LEFT JOIN (
							SELECT id_tipe_surat_hukdis, name as nama_type FROM tbl_master_tipe_surat_hukdis
						) as d ON d.id_tipe_surat_hukdis = a.Type_surat
						LEFT JOIN (
							SELECT id_pegawai, nama_pegawai FROM tbl_data_pegawai
						) as e ON e.id_pegawai = a.id_pegawai
							WHERE a.Id != '' $kond_status $kond_lokasi $k_search  order by Id desc
						) DATA";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}
	}

?>