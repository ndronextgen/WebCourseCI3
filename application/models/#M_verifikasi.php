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
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.id_status_srt in ('22','23','24','25','26','3')";
			} else {
				$kond_status = " AND a.id_status_srt in ('')";
			}

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
							a.nomor_surat, a.Created_at, a.Updated_at,
							b.nama_surat, nama_status as `status`, sort, sort_bidang,if(isnull(jml),0,jml) as jml,
							IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
							list.lokasi_kerja, list.dinas
						FROM
							tbl_data_srt_ket AS a
						LEFT JOIN (
							SELECT id_mst_srt, nama_surat FROM tbl_master_surat
						) AS b ON b.id_mst_srt = a.jenis_surat
						LEFT JOIN (
							SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
						) AS c ON c.id_status = a.id_status_srt
						LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
						LEFT JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
						LEFT JOIN ( 
							SELECT count(*) AS jml, id_view, id_srt FROM tbl_data_srt_ket_see 
							WHERE id_view = '$id_pegawai'
							GROUP BY id_view, id_srt 
							) AS see ON see.id_srt = a.id_srt 
							
						WHERE a.id_srt !='' $kond_status  $k_search  order by id_srt desc
						limit $offset, $number";

			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi) {
			$Date_now = date('Y-m-d');
			if($status_verifikasi == 'kepegawaian'){
				$kond_status = " AND a.id_status_srt in ('21','22','23','24','25','26','3')";
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.id_status_srt in ('22','23','24','25','26','3')";
			} else {
				$kond_status = " AND a.id_status_srt in ('')";
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
							a.nomor_surat, a.Created_at, a.Updated_at,
							b.nama_surat, nama_status as `status`, sort, sort_bidang,if(isnull(jml),0,jml) as jml,
							IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
							list.lokasi_kerja, list.dinas
						FROM
							tbl_data_srt_ket AS a
						LEFT JOIN (
							SELECT id_mst_srt, nama_surat FROM tbl_master_surat
						) AS b ON b.id_mst_srt = a.jenis_surat
						LEFT JOIN (
							SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
						) AS c ON c.id_status = a.id_status_srt
						LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
						LEFT JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
						LEFT JOIN ( 
							SELECT count(*) AS jml, id_view, id_srt FROM tbl_data_srt_ket_see 
							WHERE id_view = '$id_pegawai'
							GROUP BY id_view, id_srt 
							) AS see ON see.id_srt = a.id_srt 
							
						WHERE a.id_srt !='' $kond_status
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
			} elseif($status_verifikasi == 'sekdis'){
				$kond_status = " AND a.id_status_srt in ('22','23','24','25','26','3')";
			} else {
				$kond_status = " AND a.id_status_srt in ('')";
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
							a.nomor_surat, a.Created_at, a.Updated_at,
							b.nama_surat, nama_status as `status`, sort, sort_bidang,if(isnull(jml),0,jml) as jml,
							IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
							list.lokasi_kerja, list.dinas
						FROM
							tbl_data_srt_ket AS a
						LEFT JOIN (
							SELECT id_mst_srt, nama_surat FROM tbl_master_surat
						) AS b ON b.id_mst_srt = a.jenis_surat
						LEFT JOIN (
							SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
						) AS c ON c.id_status = a.id_status_srt
						LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
						LEFT JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
						LEFT JOIN ( 
							SELECT count(*) AS jml, id_view, id_srt FROM tbl_data_srt_ket_see 
							WHERE id_view = '$id_pegawai'
							GROUP BY id_view, id_srt 
							) AS see ON see.id_srt = a.id_srt 
							
						WHERE a.id_srt !='' $kond_status $k_search  order by id_srt desc
						) DATA";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}
	}

?>