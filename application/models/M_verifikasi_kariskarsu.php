<?php
	
	class M_verifikasi_kariskarsu extends CI_Model {

		function listing($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$number = $_POST['length'];
			$offset = $_POST['start'];
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (c.nama_lengkap LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.Status_progress in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.Status_progress in ('22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
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
						a.Kariskarsu_id, 
						a.Perkawinan_ke, 
						a.Status_progress,
						b.nama_status, 
						a.Notes, 
						a.File_surat_nikah, 
						a.File_kk, 
						a.File_ktp_suami, 
						a.File_ktp_istri, 
						a.File_sk_pns, 
						a.File_foto, 
						a.Nomor_surat, 
						a.Tanggal_verifikasi, 
						a.Created_by, 
						c.nama_lengkap,
						a.Created_at, 
						a.Updated_by, 
						a.Updated_at
					FROM
						tr_kariskarsu AS a
					LEFT JOIN (
						SELECT id_status, nama_status FROM tbl_status_surat
					) as b ON b.id_status = a.Status_progress
					LEFT JOIN (
						SELECT username, nama_lengkap FROM tbl_user_login
					) as c ON c.username = a.Created_by
						WHERE a.Id != '' $kond_status $kond_lokasi  $k_search  order by Id desc
						limit $offset, $number";

			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$Date_now = date('Y-m-d');
			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.Status_progress in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.Status_progress in ('22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
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
								a.Kariskarsu_id, 
								a.Perkawinan_ke, 
								a.Status_progress,
								b.nama_status, 
								a.Notes, 
								a.File_surat_nikah, 
								a.File_kk, 
								a.File_ktp_suami, 
								a.File_ktp_istri, 
								a.File_sk_pns, 
								a.File_foto, 
								a.Nomor_surat, 
								a.Tanggal_verifikasi, 
								a.Created_by, 
								c.nama_lengkap,
								a.Created_at, 
								a.Updated_by, 
								a.Updated_at
							FROM
								tr_kariskarsu AS a
							LEFT JOIN (
								SELECT id_status, nama_status FROM tbl_status_surat
							) as b ON b.id_status = a.Status_progress
							LEFT JOIN (
								SELECT username, nama_lengkap FROM tbl_user_login
							) as c ON c.username = a.Created_by
								WHERE a.Id != '' $kond_status $kond_lokasi
						) DATA";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}

		function jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (c.nama_lengkap LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.Status_progress in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.Status_progress in ('22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
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
						a.kariskarsu_id, 
						a.Perkawinan_ke, 
						a.Status_progress,
						b.nama_status, 
						a.Notes, 
						a.File_surat_nikah, 
						a.File_kk, 
						a.File_ktp_suami, 
						a.File_ktp_istri, 
						a.File_sk_pns, 
						a.File_foto, 
						a.Nomor_surat, 
						a.Tanggal_verifikasi, 
						a.Created_by, 
						c.nama_lengkap,
						a.Created_at, 
						a.Updated_by, 
						a.Updated_at
					FROM
						tr_kariskarsu AS a
					LEFT JOIN (
						SELECT id_status, nama_status FROM tbl_status_surat
					) as b ON b.id_status = a.Status_progress
					LEFT JOIN (
						SELECT username, nama_lengkap FROM tbl_user_login
					) as c ON c.username = a.Created_by
						WHERE a.Id != '' $kond_status $kond_lokasi $k_search  order by Id desc
						) DATA";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}
	}

?>