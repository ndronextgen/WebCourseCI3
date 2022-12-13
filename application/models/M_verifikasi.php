<?php
	
	class M_verifikasi extends CI_Model {

		function listing($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$number = $_POST['length'];
			$offset = $_POST['start'];
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (a.nama LIKE '%$search%' OR a.nrk LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.id_status_srt in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.id_status_srt in ('22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sudinupt'){
				$kond_status = " AND a.id_status_srt in ('21','27','24','28','3')";
				$kond_lokasi = " AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			} else {
				$kond_status = " AND a.id_status_srt in ('')";
				$kond_lokasi = " AND a.is_dinas != '' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}

			// if($id_lokasi_kerja==null || $id_lokasi_kerja=='0' || $id_lokasi_kerja=='' || $id_lokasi_kerja=='52') { //dikelola kasubag kepegawaian
			// 	$kond_lokasi = " AND a.lokasi_kerja_pegawai = ";
			// }
			
			#jika kasubag kepegawaian (mengelola )

			$query = "SELECT
							a.id_srt, a.id_user, a.nama, 
							a.nip, a.nrk, a.alamat_domisili, 
							a.status_pegawai, a.keterangan, 
							a.jenis_surat, a.jenis_pengajuan_surat, 
							a.jenis_pengajuan_surat_lainnya, a.tgl_surat, 
							a.id_status_srt, a.keterangan_ditolak, 
							a.select_ttd, a.tgl_proses, 
							a.id_user_proses, a.is_download, 
							a.file_name, a.file_name_ori, 
							a.nomor_surat, a.Created_at, a.Updated_at,a.lokasi_kerja_pegawai, a.is_dinas,
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
							IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan
						FROM
							tbl_data_srt_ket AS a
						LEFT JOIN (
							SELECT id_mst_srt, nama_surat FROM tbl_master_surat
						) AS b ON b.id_mst_srt = a.jenis_surat
						LEFT JOIN (
							SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
						) AS c ON c.id_status = a.id_status_srt
						LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
							
						WHERE a.id_srt !='' $kond_status $kond_lokasi  $k_search  order by id_srt desc
						limit $offset, $number";

			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$Date_now = date('Y-m-d');
			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.id_status_srt in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.id_status_srt in ('22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sudinupt'){
				$kond_status = " AND a.id_status_srt in ('21','27','24','28','3')";
				$kond_lokasi = " AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			} else {
				$kond_status = " AND a.id_status_srt in ('')";
				$kond_lokasi = " AND a.is_dinas != '' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}
			$sQuery = "SELECT COUNT(*) as jml FROM (
							SELECT
							a.id_srt, a.id_user, a.nama, 
							a.nip, a.nrk, a.alamat_domisili, 
							a.status_pegawai, a.keterangan, 
							a.jenis_surat, a.jenis_pengajuan_surat, 
							a.jenis_pengajuan_surat_lainnya, a.tgl_surat, 
							a.id_status_srt, a.keterangan_ditolak, 
							a.select_ttd, a.tgl_proses, 
							a.id_user_proses, a.is_download, 
							a.file_name, a.file_name_ori, 
							a.nomor_surat, a.Created_at, a.Updated_at,a.lokasi_kerja_pegawai, a.is_dinas,
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
							IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan
						FROM
							tbl_data_srt_ket AS a
						LEFT JOIN (
							SELECT id_mst_srt, nama_surat FROM tbl_master_surat
						) AS b ON b.id_mst_srt = a.jenis_surat
						LEFT JOIN (
							SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
						) AS c ON c.id_status = a.id_status_srt
						LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
							
						WHERE a.id_srt !='' $kond_status $kond_lokasi
						) DATA";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}

		function jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (a.nama LIKE '%$search%' OR a.nrk LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.id_status_srt in ('21','22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.id_status_srt in ('22','23','24','25','26','3')";
				$kond_lokasi = " AND a.is_dinas = '1'";
			} elseif($status_verifikasi == 'sudinupt'){
				$kond_status = " AND a.id_status_srt in ('21','27','24','28','3')";
				$kond_lokasi = " AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			} else {
				$kond_status = " AND a.id_status_srt in ('')";
				$kond_lokasi = " AND a.is_dinas != '' AND a.lokasi_kerja_pegawai = '$id_lokasi_kerja'";
			}

			
			$sQuery = "SELECT COUNT(*) as jml FROM (
							SELECT
							a.id_srt, a.id_user, a.nama, 
							a.nip, a.nrk, a.alamat_domisili, 
							a.status_pegawai, a.keterangan, 
							a.jenis_surat, a.jenis_pengajuan_surat, 
							a.jenis_pengajuan_surat_lainnya, a.tgl_surat, 
							a.id_status_srt, a.keterangan_ditolak, 
							a.select_ttd, a.tgl_proses, 
							a.id_user_proses, a.is_download, 
							a.file_name, a.file_name_ori, 
							a.nomor_surat, a.Created_at, a.Updated_at,a.lokasi_kerja_pegawai, a.is_dinas,
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
							IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan
						FROM
							tbl_data_srt_ket AS a
						LEFT JOIN (
							SELECT id_mst_srt, nama_surat FROM tbl_master_surat
						) AS b ON b.id_mst_srt = a.jenis_surat
						LEFT JOIN (
							SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
						) AS c ON c.id_status = a.id_status_srt
						LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
							
						WHERE a.id_srt !='' $kond_status $kond_lokasi $k_search  order by id_srt desc
						) DATA";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}
	}

?>