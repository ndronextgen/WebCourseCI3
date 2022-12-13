<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

DEBUG - 2022-11-06 01:39:10 --> Total execution time: 0.0522
DEBUG - 2022-11-06 01:39:10 --> Total execution time: 0.0860
DEBUG - 2022-11-06 01:39:12 --> Total execution time: 0.0457
DEBUG - 2022-11-06 01:39:24 --> Total execution time: 0.0201
DEBUG - 2022-11-06 01:39:24 --> Total execution time: 0.0187
DEBUG - 2022-11-06 01:39:27 --> Total execution time: 0.0254
DEBUG - 2022-11-06 01:39:28 --> Total execution time: 0.0178
DEBUG - 2022-11-06 01:39:33 --> Total execution time: 0.0236
DEBUG - 2022-11-06 01:39:34 --> Total execution time: 0.0194
DEBUG - 2022-11-06 01:39:34 --> Total execution time: 0.0178
DEBUG - 2022-11-06 01:39:37 --> Total execution time: 0.0382
DEBUG - 2022-11-06 01:39:40 --> Total execution time: 0.0221
DEBUG - 2022-11-06 01:39:40 --> Total execution time: 0.0164
DEBUG - 2022-11-06 01:39:40 --> Total execution time: 0.0172
DEBUG - 2022-11-06 01:39:42 --> Total execution time: 0.0190
DEBUG - 2022-11-06 01:39:43 --> Total execution time: 0.0177
DEBUG - 2022-11-06 01:39:43 --> Total execution time: 0.0201
DEBUG - 2022-11-06 01:39:51 --> Total execution time: 0.0243
DEBUG - 2022-11-06 01:39:51 --> Total execution time: 0.0162
DEBUG - 2022-11-06 01:39:51 --> Total execution time: 0.0176
DEBUG - 2022-11-06 01:39:55 --> Total execution time: 0.0942
DEBUG - 2022-11-06 01:39:55 --> Total execution time: 0.0468
DEBUG - 2022-11-06 01:39:58 --> Total execution time: 0.0204
DEBUG - 2022-11-06 01:39:58 --> Total execution time: 0.0157
DEBUG - 2022-11-06 01:39:58 --> Total execution time: 0.0178
DEBUG - 2022-11-06 01:40:05 --> Total execution time: 0.0227
DEBUG - 2022-11-06 01:40:06 --> Total execution time: 0.0244
DEBUG - 2022-11-06 01:40:06 --> Total execution time: 0.0197
DEBUG - 2022-11-06 01:40:07 --> Total execution time: 0.0185
DEBUG - 2022-11-06 01:40:13 --> Total execution time: 0.0301
DEBUG - 2022-11-06 01:40:13 --> Total execution time: 0.0298
DEBUG - 2022-11-06 01:40:27 --> Total execution time: 0.0209
DEBUG - 2022-11-06 01:40:27 --> Total execution time: 0.0147
DEBUG - 2022-11-06 01:40:27 --> Total execution time: 0.0152
DEBUG - 2022-11-06 01:40:42 --> Total execution time: 0.0345
DEBUG - 2022-11-06 01:40:42 --> Total execution time: 0.0227
DEBUG - 2022-11-06 01:40:43 --> Total execution time: 0.0253
DEBUG - 2022-11-06 01:42:43 --> Total execution time: 0.0379
DEBUG - 2022-11-06 01:42:43 --> Total execution time: 0.0200
DEBUG - 2022-11-06 01:45:43 --> Total execution time: 0.0360
DEBUG - 2022-11-06 01:45:43 --> Total execution time: 0.0205
DEBUG - 2022-11-06 01:45:49 --> Total execution time: 0.0189
DEBUG - 2022-11-06 01:46:06 --> Total execution time: 0.2675
DEBUG - 2022-11-06 01:46:06 --> Total execution time: 0.1033
DEBUG - 2022-11-06 01:46:06 --> Total execution time: 0.0296
DEBUG - 2022-11-06 01:46:26 --> Total execution time: 0.0264
DEBUG - 2022-11-06 01:46:26 --> Total execution time: 0.0160
DEBUG - 2022-11-06 01:46:26 --> Total execution time: 0.0167
DEBUG - 2022-11-06 01:46:36 --> Total execution time: 0.0197
DEBUG - 2022-11-06 01:46:36 --> Total execution time: 0.0178
DEBUG - 2022-11-06 01:46:36 --> Total execution time: 0.0214
ERROR - 2022-11-06 01:46:36 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
DEBUG - 2022-11-06 01:46:40 --> Total execution time: 0.0215
DEBUG - 2022-11-06 01:46:40 --> Total execution time: 0.0155
DEBUG - 2022-11-06 01:46:40 --> Total execution time: 0.0167
DEBUG - 2022-11-06 01:46:57 --> Total execution time: 0.0187
DEBUG - 2022-11-06 01:47:03 --> Total execution time: 0.1356
DEBUG - 2022-11-06 01:47:04 --> Total execution time: 0.0303
DEBUG - 2022-11-06 01:47:04 --> Total execution time: 0.0378
DEBUG - 2022-11-06 01:48:23 --> Total execution time: 0.0184
DEBUG - 2022-11-06 01:48:26 --> Total execution time: 0.0182
DEBUG - 2022-11-06 01:48:27 --> Total execution time: 0.0168
DEBUG - 2022-11-06 01:48:28 --> Total execution time: 0.0181
ERROR - 2022-11-06 01:48:38 --> Severity: Notice --> Undefined variable: count_see_verifikasi /var/www/html/si-adik/application/views/dashboard_publik/homes/index_home.php 249
ERROR - 2022-11-06 01:48:38 --> Severity: Notice --> Undefined variable: count_see_verifikasi /var/www/html/si-adik/application/views/dashboard_publik/homes/index_home.php 259
DEBUG - 2022-11-06 01:48:38 --> Total execution time: 0.0313
DEBUG - 2022-11-06 01:48:38 --> Total execution time: 0.0305
DEBUG - 2022-11-06 01:50:23 --> Total execution time: 0.0311
DEBUG - 2022-11-06 01:50:24 --> Total execution time: 0.0321
DEBUG - 2022-11-06 01:51:28 --> Total execution time: 0.0339
DEBUG - 2022-11-06 01:51:28 --> Total execution time: 0.0311
DEBUG - 2022-11-06 01:51:37 --> Total execution time: 0.0197
DEBUG - 2022-11-06 01:51:37 --> Total execution time: 0.0194
DEBUG - 2022-11-06 01:51:37 --> Total execution time: 0.0224
ERROR - 2022-11-06 01:51:37 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
DEBUG - 2022-11-06 01:51:39 --> Total execution time: 0.0185
DEBUG - 2022-11-06 01:52:42 --> Total execution time: 0.0215
DEBUG - 2022-11-06 01:53:32 --> Total execution time: 0.0232
DEBUG - 2022-11-06 01:53:34 --> Total execution time: 0.0196
DEBUG - 2022-11-06 01:53:37 --> Total execution time: 0.0209
DEBUG - 2022-11-06 01:53:45 --> Total execution time: 0.0196
DEBUG - 2022-11-06 01:53:45 --> Total execution time: 0.0177
DEBUG - 2022-11-06 01:53:45 --> Total execution time: 0.0219
ERROR - 2022-11-06 01:53:45 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
DEBUG - 2022-11-06 01:53:48 --> Total execution time: 0.0193
DEBUG - 2022-11-06 01:53:52 --> Total execution time: 0.0298
DEBUG - 2022-11-06 01:53:52 --> Total execution time: 0.0311
DEBUG - 2022-11-06 01:53:55 --> Total execution time: 0.0202
DEBUG - 2022-11-06 01:53:55 --> Total execution time: 0.0177
DEBUG - 2022-11-06 01:53:55 --> Total execution time: 0.0178
ERROR - 2022-11-06 01:53:55 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
DEBUG - 2022-11-06 01:53:57 --> Total execution time: 0.0194
DEBUG - 2022-11-06 01:54:13 --> Total execution time: 0.0202
DEBUG - 2022-11-06 01:54:14 --> Total execution time: 0.0172
DEBUG - 2022-11-06 01:54:14 --> Total execution time: 0.0204
ERROR - 2022-11-06 01:54:14 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
DEBUG - 2022-11-06 01:54:16 --> Total execution time: 0.0219
DEBUG - 2022-11-06 01:54:19 --> Total execution time: 0.0320
DEBUG - 2022-11-06 01:54:19 --> Total execution time: 0.0324
DEBUG - 2022-11-06 01:54:22 --> Total execution time: 0.0209
DEBUG - 2022-11-06 01:54:39 --> Total execution time: 0.0327
DEBUG - 2022-11-06 01:54:40 --> Total execution time: 0.0317
DEBUG - 2022-11-06 01:54:44 --> Total execution time: 0.0277
DEBUG - 2022-11-06 01:54:44 --> Total execution time: 0.0183
DEBUG - 2022-11-06 01:54:46 --> Total execution time: 0.0330
DEBUG - 2022-11-06 01:54:46 --> Total execution time: 0.0445
DEBUG - 2022-11-06 01:54:47 --> Total execution time: 0.0269
DEBUG - 2022-11-06 01:54:48 --> Total execution time: 0.0187
ERROR - 2022-11-06 01:55:35 --> Severity: Notice --> Undefined variable: count_see_verifikasi /var/www/html/si-adik/application/views/dashboard_publik/arsip_digital/index_arsip_digital.php 253
ERROR - 2022-11-06 01:55:35 --> Severity: Notice --> Undefined variable: count_see_verifikasi /var/www/html/si-adik/application/views/dashboard_publik/arsip_digital/index_arsip_digital.php 261
DEBUG - 2022-11-06 01:55:35 --> Total execution time: 0.0291
DEBUG - 2022-11-06 01:55:36 --> Total execution time: 0.0197
DEBUG - 2022-11-06 01:56:25 --> Total execution time: 0.0345
DEBUG - 2022-11-06 01:56:25 --> Total execution time: 0.0182
DEBUG - 2022-11-06 01:56:38 --> Total execution time: 0.0202
DEBUG - 2022-11-06 01:56:40 --> Total execution time: 0.0193
DEBUG - 2022-11-06 01:56:40 --> Total execution time: 0.0173
DEBUG - 2022-11-06 01:56:40 --> Total execution time: 0.0308
ERROR - 2022-11-06 01:56:40 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
DEBUG - 2022-11-06 01:56:42 --> Total execution time: 0.0413
DEBUG - 2022-11-06 01:56:43 --> Total execution time: 0.0333
DEBUG - 2022-11-06 01:56:45 --> Total execution time: 0.0290
DEBUG - 2022-11-06 01:56:45 --> Total execution time: 0.0302
DEBUG - 2022-11-06 01:56:47 --> Total execution time: 0.0367
DEBUG - 2022-11-06 01:56:47 --> Total execution time: 0.0227
DEBUG - 2022-11-06 01:56:47 --> Total execution time: 0.0264
DEBUG - 2022-11-06 01:56:48 --> Total execution time: 0.0311
DEBUG - 2022-11-06 01:56:50 --> Total execution time: 0.0270
DEBUG - 2022-11-06 01:56:50 --> Total execution time: 0.0161
DEBUG - 2022-11-06 01:56:50 --> Total execution time: 0.0255
ERROR - 2022-11-06 01:56:50 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
ERROR - 2022-11-06 01:56:59 --> Severity: Notice --> Undefined index: length /var/www/html/si-adik/application/models/M_verifikasi.php 6
ERROR - 2022-11-06 01:56:59 --> Severity: Notice --> Undefined index: start /var/www/html/si-adik/application/models/M_verifikasi.php 7
ERROR - 2022-11-06 01:56:59 --> Severity: Notice --> Undefined index: search /var/www/html/si-adik/application/models/M_verifikasi.php 9
ERROR - 2022-11-06 01:56:59 --> Severity: Notice --> Undefined index: length /var/www/html/si-adik/application/models/M_verifikasi.php 60
ERROR - 2022-11-06 01:56:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 34 - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit , 
ERROR - 2022-11-06 02:00:47 --> Severity: Notice --> Undefined index: length /var/www/html/si-adik/application/models/M_verifikasi.php 6
ERROR - 2022-11-06 02:00:47 --> Severity: Notice --> Undefined index: start /var/www/html/si-adik/application/models/M_verifikasi.php 7
ERROR - 2022-11-06 02:00:47 --> Severity: Notice --> Undefined index: search /var/www/html/si-adik/application/models/M_verifikasi.php 9
ERROR - 2022-11-06 02:00:47 --> Severity: Notice --> Undefined index: length /var/www/html/si-adik/application/models/M_verifikasi.php 60
ERROR - 2022-11-06 02:00:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 34 - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit , 
ERROR - 2022-11-06 02:00:48 --> Severity: Notice --> Undefined index: length /var/www/html/si-adik/application/models/M_verifikasi.php 6
ERROR - 2022-11-06 02:00:48 --> Severity: Notice --> Undefined index: start /var/www/html/si-adik/application/models/M_verifikasi.php 7
ERROR - 2022-11-06 02:00:48 --> Severity: Notice --> Undefined index: search /var/www/html/si-adik/application/models/M_verifikasi.php 9
ERROR - 2022-11-06 02:00:48 --> Severity: Notice --> Undefined index: length /var/www/html/si-adik/application/models/M_verifikasi.php 60
ERROR - 2022-11-06 02:00:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 34 - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit , 
DEBUG - 2022-11-06 02:00:51 --> Total execution time: 0.0202
DEBUG - 2022-11-06 02:00:52 --> Total execution time: 0.0184
DEBUG - 2022-11-06 02:00:52 --> Total execution time: 0.0198
ERROR - 2022-11-06 02:00:52 --> Query error: Unknown column 'sort_bidang' in 'field list' - Invalid query: SELECT
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
							b.nama_surat, nama_status as `status`, sort, sort_bidang,
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
						INNER JOIN (
									SELECT
										ax.id_pegawai, ax.lokasi_kerja, bx.dinas
									FROM
										tbl_data_pegawai AS ax
									LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
									WHERE dinas = '1'
						) list ON a.id_user = list.id_pegawai
							
						WHERE a.id_srt !=''  AND a.id_status_srt in ('22','23','24','25','26','3')    order by id_srt desc
						limit 0, 10
DEBUG - 2022-11-06 02:02:42 --> Total execution time: 0.0198
DEBUG - 2022-11-06 02:02:43 --> Total execution time: 0.0181
DEBUG - 2022-11-06 02:02:43 --> Total execution time: 0.0199
DEBUG - 2022-11-06 02:02:43 --> Total execution time: 0.0207
DEBUG - 2022-11-06 02:03:02 --> Total execution time: 0.0189
DEBUG - 2022-11-06 02:03:09 --> Total execution time: 0.0246
DEBUG - 2022-11-06 02:05:04 --> Total execution time: 0.0184
DEBUG - 2022-11-06 02:05:05 --> Total execution time: 0.0172
DEBUG - 2022-11-06 02:05:05 --> Total execution time: 0.0183
DEBUG - 2022-11-06 02:05:05 --> Total execution time: 0.0198
DEBUG - 2022-11-06 02:05:59 --> Total execution time: 0.0193
DEBUG - 2022-11-06 02:06:00 --> Total execution time: 0.0163
DEBUG - 2022-11-06 02:06:00 --> Total execution time: 0.0258
DEBUG - 2022-11-06 02:06:00 --> Total execution time: 0.0192
DEBUG - 2022-11-06 02:06:57 --> Total execution time: 0.0215
DEBUG - 2022-11-06 02:06:57 --> Total execution time: 0.0177
DEBUG - 2022-11-06 02:06:57 --> Total execution time: 0.0206
DEBUG - 2022-11-06 02:06:58 --> Total execution time: 0.0261
DEBUG - 2022-11-06 02:06:59 --> Total execution time: 0.0192
DEBUG - 2022-11-06 02:07:16 --> Total execution time: 0.0913
DEBUG - 2022-11-06 02:07:16 --> Total execution time: 0.0352
DEBUG - 2022-11-06 02:07:24 --> Total execution time: 0.0191
DEBUG - 2022-11-06 02:07:25 --> Total execution time: 0.0189
DEBUG - 2022-11-06 02:07:25 --> Total execution time: 0.0215
DEBUG - 2022-11-06 02:07:25 --> Total execution time: 0.0188
DEBUG - 2022-11-06 02:07:26 --> Total execution time: 0.0272
DEBUG - 2022-11-06 02:08:27 --> Total execution time: 0.0401
DEBUG - 2022-11-06 02:08:30 --> Total execution time: 0.0417
DEBUG - 2022-11-06 02:08:45 --> Total execution time: 0.0333
DEBUG - 2022-11-06 02:08:46 --> Total execution time: 0.0323
DEBUG - 2022-11-06 02:08:49 --> Total execution time: 0.0205
DEBUG - 2022-11-06 02:08:50 --> Total execution time: 0.0159
DEBUG - 2022-11-06 02:08:50 --> Total execution time: 0.0173
DEBUG - 2022-11-06 02:08:50 --> Total execution time: 0.0201
DEBUG - 2022-11-06 02:08:55 --> Total execution time: 0.0320
DEBUG - 2022-11-06 02:08:56 --> Total execution time: 0.0318
DEBUG - 2022-11-06 02:09:02 --> Total execution time: 0.0303
DEBUG - 2022-11-06 02:09:03 --> Total execution time: 0.0197
DEBUG - 2022-11-06 02:09:04 --> Total execution time: 0.0196
DEBUG - 2022-11-06 02:09:05 --> Total execution time: 0.0273
DEBUG - 2022-11-06 02:09:06 --> Total execution time: 0.0281
DEBUG - 2022-11-06 02:11:10 --> administrator
DEBUG - 2022-11-06 02:11:10 --> Total execution time: 0.0490
DEBUG - 2022-11-06 02:11:10 --> Total execution time: 0.2619
DEBUG - 2022-11-06 02:11:16 --> Total execution time: 0.2766
DEBUG - 2022-11-06 02:11:21 --> Total execution time: 0.3227
DEBUG - 2022-11-06 02:11:26 --> Total execution time: 0.2694
DEBUG - 2022-11-06 02:11:30 --> Total execution time: 0.0237
DEBUG - 2022-11-06 02:11:43 --> Total execution time: 0.0526
DEBUG - 2022-11-06 02:11:43 --> Total execution time: 0.0904
DEBUG - 2022-11-06 02:11:43 --> Total execution time: 0.0371
DEBUG - 2022-11-06 02:11:47 --> Total execution time: 0.0213
DEBUG - 2022-11-06 02:11:47 --> Total execution time: 0.0351
DEBUG - 2022-11-06 02:11:47 --> Total execution time: 0.0233
DEBUG - 2022-11-06 02:11:48 --> Total execution time: 0.0290
DEBUG - 2022-11-06 02:11:51 --> Total execution time: 0.1675
DEBUG - 2022-11-06 02:13:06 --> Total execution time: 0.0256
DEBUG - 2022-11-06 02:13:06 --> Total execution time: 0.0158
DEBUG - 2022-11-06 02:13:06 --> Total execution time: 0.0182
DEBUG - 2022-11-06 02:13:08 --> Total execution time: 0.1372
DEBUG - 2022-11-06 02:16:48 --> Total execution time: 0.0275
DEBUG - 2022-11-06 02:16:48 --> Total execution time: 0.0161
DEBUG - 2022-11-06 02:16:48 --> Total execution time: 0.0184
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0224
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0221
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0160
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0163
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0240
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0178
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0225
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0158
DEBUG - 2022-11-06 02:16:49 --> Total execution time: 0.0163
DEBUG - 2022-11-06 02:17:59 --> Total execution time: 0.0223
DEBUG - 2022-11-06 02:17:59 --> Total execution time: 0.0157
DEBUG - 2022-11-06 02:17:59 --> Total execution time: 0.0156
DEBUG - 2022-11-06 02:18:16 --> Total execution time: 0.1194
DEBUG - 2022-11-06 02:18:20 --> Total execution time: 0.0216
DEBUG - 2022-11-06 02:18:21 --> Total execution time: 0.0210
DEBUG - 2022-11-06 02:18:23 --> Total execution time: 0.0157
DEBUG - 2022-11-06 02:18:23 --> Total execution time: 0.0214
DEBUG - 2022-11-06 02:18:25 --> Total execution time: 0.1164
DEBUG - 2022-11-06 02:19:05 --> Total execution time: 0.0241
DEBUG - 2022-11-06 02:19:05 --> Total execution time: 0.0181
DEBUG - 2022-11-06 02:19:05 --> Total execution time: 0.0173
DEBUG - 2022-11-06 02:19:08 --> Total execution time: 0.0200
DEBUG - 2022-11-06 02:19:09 --> Total execution time: 0.0351
DEBUG - 2022-11-06 02:19:09 --> Total execution time: 0.0224
DEBUG - 2022-11-06 02:19:11 --> Total execution time: 0.1122
DEBUG - 2022-11-06 02:19:11 --> Total execution time: 0.0708
DEBUG - 2022-11-06 02:19:13 --> Total execution time: 0.0211
DEBUG - 2022-11-06 02:19:13 --> Total execution time: 0.0152
DEBUG - 2022-11-06 02:19:13 --> Total execution time: 0.0355
DEBUG - 2022-11-06 02:19:14 --> Total execution time: 0.0276
DEBUG - 2022-11-06 02:19:19 --> Total execution time: 0.2575
DEBUG - 2022-11-06 02:19:26 --> Total execution time: 0.0227
DEBUG - 2022-11-06 02:19:26 --> Total execution time: 0.0147
DEBUG - 2022-11-06 02:19:26 --> Total execution time: 0.0147
DEBUG - 2022-11-06 02:19:30 --> Total execution time: 0.0293
DEBUG - 2022-11-06 02:20:20 --> Total execution time: 0.0333
DEBUG - 2022-11-06 02:20:20 --> Total execution time: 0.0182
DEBUG - 2022-11-06 02:20:20 --> Total execution time: 0.0183
DEBUG - 2022-11-06 02:20:28 --> Total execution time: 0.0155
DEBUG - 2022-11-06 02:20:31 --> Total execution time: 0.0252
DEBUG - 2022-11-06 02:20:31 --> Total execution time: 0.0164
DEBUG - 2022-11-06 02:20:31 --> Total execution time: 0.0146
DEBUG - 2022-11-06 02:20:33 --> Total execution time: 0.0185
DEBUG - 2022-11-06 02:20:33 --> Total execution time: 0.0178
DEBUG - 2022-11-06 02:20:33 --> Total execution time: 0.0192
DEBUG - 2022-11-06 02:20:37 --> Total execution time: 0.0228
DEBUG - 2022-11-06 02:21:10 --> Total execution time: 0.2613
DEBUG - 2022-11-06 02:21:21 --> Total execution time: 0.2607
DEBUG - 2022-11-06 02:21:27 --> Total execution time: 0.0255
ERROR - 2022-11-06 02:21:37 --> Severity: Notice --> Undefined property: stdClass::$telepon_email /var/www/html/si-adik/application/libraries/Func_wa_sk.php 379
ERROR - 2022-11-06 02:21:38 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 87
ERROR - 2022-11-06 02:21:38 --> Severity: Notice --> Trying to get property 'msg' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 93
DEBUG - 2022-11-06 02:21:38 --> Total execution time: 1.4300
DEBUG - 2022-11-06 02:22:19 --> Total execution time: 0.0226
DEBUG - 2022-11-06 02:22:19 --> Total execution time: 0.0199
DEBUG - 2022-11-06 02:22:19 --> Total execution time: 0.0207
DEBUG - 2022-11-06 02:22:22 --> Total execution time: 0.1202
DEBUG - 2022-11-06 02:22:56 --> Total execution time: 0.0291
DEBUG - 2022-11-06 02:22:56 --> Total execution time: 0.0176
DEBUG - 2022-11-06 02:22:56 --> Total execution time: 0.0152
DEBUG - 2022-11-06 02:22:59 --> Total execution time: 0.0189
DEBUG - 2022-11-06 02:22:59 --> Total execution time: 0.0150
DEBUG - 2022-11-06 02:22:59 --> Total execution time: 0.0157
DEBUG - 2022-11-06 02:23:01 --> Total execution time: 0.0187
DEBUG - 2022-11-06 02:23:01 --> Total execution time: 0.0177
DEBUG - 2022-11-06 02:23:01 --> Total execution time: 0.0201
DEBUG - 2022-11-06 02:23:45 --> Total execution time: 0.0216
DEBUG - 2022-11-06 02:23:45 --> Total execution time: 0.0160
DEBUG - 2022-11-06 02:23:45 --> Total execution time: 0.0162
DEBUG - 2022-11-06 02:23:50 --> Total execution time: 0.0204
DEBUG - 2022-11-06 02:23:50 --> Total execution time: 0.0151
DEBUG - 2022-11-06 02:23:50 --> Total execution time: 0.0168
DEBUG - 2022-11-06 02:24:32 --> Total execution time: 0.0225
DEBUG - 2022-11-06 02:24:32 --> Total execution time: 0.0159
DEBUG - 2022-11-06 02:24:33 --> Total execution time: 0.0167
DEBUG - 2022-11-06 02:24:37 --> Total execution time: 0.0326
DEBUG - 2022-11-06 02:24:37 --> Total execution time: 0.0336
DEBUG - 2022-11-06 02:24:57 --> Total execution time: 0.0318
DEBUG - 2022-11-06 02:24:58 --> Total execution time: 0.0298
DEBUG - 2022-11-06 02:25:02 --> Total execution time: 0.0206
DEBUG - 2022-11-06 02:25:02 --> Total execution time: 0.0162
DEBUG - 2022-11-06 02:25:02 --> Total execution time: 0.0181
DEBUG - 2022-11-06 02:25:15 --> Total execution time: 0.1185
DEBUG - 2022-11-06 02:25:20 --> Total execution time: 0.0335
DEBUG - 2022-11-06 02:25:24 --> Total execution time: 0.0368
DEBUG - 2022-11-06 02:25:24 --> Total execution time: 0.0276
DEBUG - 2022-11-06 02:25:24 --> Total execution time: 0.0208
DEBUG - 2022-11-06 02:25:26 --> Total execution time: 0.0275
DEBUG - 2022-11-06 02:25:26 --> Total execution time: 0.0160
DEBUG - 2022-11-06 02:25:26 --> Total execution time: 0.0258
DEBUG - 2022-11-06 02:25:38 --> Total execution time: 0.2920
DEBUG - 2022-11-06 02:28:02 --> Total execution time: 0.0349
DEBUG - 2022-11-06 02:28:02 --> Total execution time: 0.0245
DEBUG - 2022-11-06 02:28:02 --> Total execution time: 0.0206
DEBUG - 2022-11-06 02:28:09 --> Total execution time: 0.2732
DEBUG - 2022-11-06 02:28:18 --> Total execution time: 0.0275
DEBUG - 2022-11-06 02:28:19 --> Total execution time: 0.1180
DEBUG - 2022-11-06 02:28:26 --> Total execution time: 0.2576
DEBUG - 2022-11-06 02:28:58 --> Total execution time: 1.7015
DEBUG - 2022-11-06 02:28:59 --> Total execution time: 0.2611
DEBUG - 2022-11-06 02:29:42 --> Total execution time: 0.0206
DEBUG - 2022-11-06 02:29:42 --> Total execution time: 0.0246
DEBUG - 2022-11-06 02:29:49 --> Total execution time: 0.0208
DEBUG - 2022-11-06 02:29:58 --> Total execution time: 0.0287
DEBUG - 2022-11-06 02:30:05 --> Total execution time: 0.0252
DEBUG - 2022-11-06 02:30:06 --> Total execution time: 0.0153
DEBUG - 2022-11-06 02:30:06 --> Total execution time: 0.0165
DEBUG - 2022-11-06 02:30:28 --> Total execution time: 0.0305
DEBUG - 2022-11-06 02:30:28 --> Total execution time: 0.0312
DEBUG - 2022-11-06 02:30:31 --> Total execution time: 0.0239
DEBUG - 2022-11-06 02:30:32 --> Total execution time: 0.0149
DEBUG - 2022-11-06 02:30:32 --> Total execution time: 0.0176
DEBUG - 2022-11-06 02:31:08 --> Total execution time: 0.0834
DEBUG - 2022-11-06 02:31:09 --> Total execution time: 0.0298
DEBUG - 2022-11-06 02:31:11 --> Total execution time: 0.0172
DEBUG - 2022-11-06 02:31:24 --> administrator
DEBUG - 2022-11-06 02:31:24 --> Total execution time: 0.0483
DEBUG - 2022-11-06 02:31:24 --> Total execution time: 0.2945
DEBUG - 2022-11-06 02:31:41 --> Total execution time: 0.3479
DEBUG - 2022-11-06 02:32:08 --> Total execution time: 0.3580
DEBUG - 2022-11-06 02:32:39 --> Total execution time: 0.3037
DEBUG - 2022-11-06 02:32:59 --> Total execution time: 0.3029
DEBUG - 2022-11-06 02:33:33 --> Total execution time: 0.0282
DEBUG - 2022-11-06 02:33:42 --> Total execution time: 0.1263
DEBUG - 2022-11-06 02:33:42 --> Total execution time: 0.0863
DEBUG - 2022-11-06 02:33:43 --> Total execution time: 0.0337
DEBUG - 2022-11-06 02:33:51 --> Total execution time: 0.0201
DEBUG - 2022-11-06 02:33:52 --> Total execution time: 0.0173
DEBUG - 2022-11-06 02:33:52 --> Total execution time: 0.0157
DEBUG - 2022-11-06 02:33:52 --> Total execution time: 0.0188
DEBUG - 2022-11-06 02:33:54 --> Total execution time: 0.0178
DEBUG - 2022-11-06 02:34:00 --> Total execution time: 0.0186
DEBUG - 2022-11-06 02:34:00 --> Total execution time: 0.0174
DEBUG - 2022-11-06 02:34:02 --> Total execution time: 0.0166
DEBUG - 2022-11-06 02:34:02 --> Total execution time: 0.0251
DEBUG - 2022-11-06 02:34:13 --> Total execution time: 0.0207
DEBUG - 2022-11-06 02:34:13 --> Total execution time: 0.0232
DEBUG - 2022-11-06 02:37:48 --> Total execution time: 0.0199
DEBUG - 2022-11-06 02:37:48 --> Total execution time: 0.0171
DEBUG - 2022-11-06 02:37:48 --> Total execution time: 0.0196
DEBUG - 2022-11-06 02:37:48 --> Total execution time: 0.0182
DEBUG - 2022-11-06 02:37:51 --> Total execution time: 0.0255
DEBUG - 2022-11-06 02:37:52 --> Total execution time: 0.0213
DEBUG - 2022-11-06 02:37:52 --> Total execution time: 0.0233
DEBUG - 2022-11-06 02:37:52 --> Total execution time: 0.0217
ERROR - 2022-11-06 02:37:53 --> Severity: Notice --> Undefined variable: count_see_verifikasi /var/www/html/si-adik/application/views/dashboard_publik/home/status_surat.php 160
ERROR - 2022-11-06 02:37:53 --> Severity: Notice --> Undefined variable: count_see_verifikasi /var/www/html/si-adik/application/views/dashboard_publik/home/status_surat.php 170
DEBUG - 2022-11-06 02:37:53 --> Total execution time: 0.0328
DEBUG - 2022-11-06 02:37:53 --> Total execution time: 0.0150
DEBUG - 2022-11-06 02:37:53 --> Total execution time: 0.0163
DEBUG - 2022-11-06 02:40:36 --> Total execution time: 0.0283
DEBUG - 2022-11-06 02:40:36 --> Total execution time: 0.0153
DEBUG - 2022-11-06 02:40:36 --> Total execution time: 0.0161
DEBUG - 2022-11-06 02:41:11 --> Total execution time: 0.0861
DEBUG - 2022-11-06 02:41:12 --> Total execution time: 0.0423
DEBUG - 2022-11-06 02:41:13 --> Total execution time: 0.0281
DEBUG - 2022-11-06 02:41:13 --> Total execution time: 0.0220
DEBUG - 2022-11-06 02:41:15 --> Total execution time: 0.0223
DEBUG - 2022-11-06 02:41:15 --> Total execution time: 0.0152
DEBUG - 2022-11-06 02:41:15 --> Total execution time: 0.0161
DEBUG - 2022-11-06 02:41:17 --> Total execution time: 0.0216
DEBUG - 2022-11-06 02:41:18 --> Total execution time: 0.0165
DEBUG - 2022-11-06 02:41:18 --> Total execution time: 0.0187
DEBUG - 2022-11-06 02:41:18 --> Total execution time: 0.0198
DEBUG - 2022-11-06 02:41:19 --> Total execution time: 0.0209
DEBUG - 2022-11-06 02:41:19 --> Total execution time: 0.0215
DEBUG - 2022-11-06 02:41:19 --> Total execution time: 0.0160
DEBUG - 2022-11-06 02:41:22 --> Total execution time: 0.0194
DEBUG - 2022-11-06 02:41:22 --> Total execution time: 0.0172
DEBUG - 2022-11-06 02:41:22 --> Total execution time: 0.0192
DEBUG - 2022-11-06 02:41:22 --> Total execution time: 0.0212
DEBUG - 2022-11-06 02:41:23 --> Total execution time: 0.0215
DEBUG - 2022-11-06 02:41:23 --> Total execution time: 0.0151
DEBUG - 2022-11-06 02:41:23 --> Total execution time: 0.0159
DEBUG - 2022-11-06 02:41:44 --> Total execution time: 0.0254
DEBUG - 2022-11-06 02:41:44 --> Total execution time: 0.0159
DEBUG - 2022-11-06 02:41:44 --> Total execution time: 0.0172
DEBUG - 2022-11-06 02:41:48 --> Total execution time: 0.0180
DEBUG - 2022-11-06 02:41:48 --> Total execution time: 0.0176
DEBUG - 2022-11-06 02:41:48 --> Total execution time: 0.0194
DEBUG - 2022-11-06 02:41:48 --> Total execution time: 0.0240
DEBUG - 2022-11-06 02:43:04 --> Total execution time: 0.1042
DEBUG - 2022-11-06 02:43:05 --> Total execution time: 0.0322
DEBUG - 2022-11-06 02:43:06 --> Total execution time: 0.0271
DEBUG - 2022-11-06 02:43:07 --> Total execution time: 0.0185
DEBUG - 2022-11-06 02:43:09 --> Total execution time: 0.0208
DEBUG - 2022-11-06 02:43:09 --> Total execution time: 0.0156
DEBUG - 2022-11-06 02:43:09 --> Total execution time: 0.0165
DEBUG - 2022-11-06 02:43:11 --> Total execution time: 0.0366
DEBUG - 2022-11-06 02:43:11 --> Total execution time: 0.0193
DEBUG - 2022-11-06 02:43:12 --> Total execution time: 0.0306
DEBUG - 2022-11-06 02:43:12 --> Total execution time: 0.0340
DEBUG - 2022-11-06 02:43:13 --> Total execution time: 0.0193
DEBUG - 2022-11-06 02:43:14 --> Total execution time: 0.0190
DEBUG - 2022-11-06 02:43:15 --> Total execution time: 0.0171
DEBUG - 2022-11-06 02:43:15 --> Total execution time: 0.0185
DEBUG - 2022-11-06 02:43:15 --> Total execution time: 0.0189
DEBUG - 2022-11-06 02:43:16 --> Total execution time: 0.0316
DEBUG - 2022-11-06 02:43:17 --> Total execution time: 0.0321
DEBUG - 2022-11-06 02:43:19 --> Total execution time: 0.0285
DEBUG - 2022-11-06 02:43:19 --> Total execution time: 0.0185
DEBUG - 2022-11-06 02:43:24 --> Total execution time: 0.0211
DEBUG - 2022-11-06 02:43:24 --> Total execution time: 0.0172
DEBUG - 2022-11-06 02:43:24 --> Total execution time: 0.0182
DEBUG - 2022-11-06 02:43:26 --> Total execution time: 0.0182
DEBUG - 2022-11-06 02:43:26 --> Total execution time: 0.0161
DEBUG - 2022-11-06 02:43:26 --> Total execution time: 0.0188
DEBUG - 2022-11-06 02:43:26 --> Total execution time: 0.0177
DEBUG - 2022-11-06 02:43:29 --> Total execution time: 0.0181
DEBUG - 2022-11-06 02:43:29 --> Total execution time: 0.0176
DEBUG - 2022-11-06 02:43:29 --> Total execution time: 0.0202
DEBUG - 2022-11-06 02:43:29 --> Total execution time: 0.0186
DEBUG - 2022-11-06 02:43:30 --> Total execution time: 0.0798
DEBUG - 2022-11-06 02:43:31 --> Total execution time: 0.0319
DEBUG - 2022-11-06 02:43:32 --> Total execution time: 0.0291
DEBUG - 2022-11-06 02:43:32 --> Total execution time: 0.0275
DEBUG - 2022-11-06 02:43:34 --> Total execution time: 0.0220
DEBUG - 2022-11-06 02:43:34 --> Total execution time: 0.0156
DEBUG - 2022-11-06 02:43:34 --> Total execution time: 0.0260
DEBUG - 2022-11-06 02:43:34 --> Total execution time: 0.0193
DEBUG - 2022-11-06 02:43:36 --> Total execution time: 0.0439
DEBUG - 2022-11-06 02:43:37 --> Total execution time: 0.0646
DEBUG - 2022-11-06 02:43:38 --> Total execution time: 0.0452
DEBUG - 2022-11-06 02:43:39 --> Total execution time: 0.0697
DEBUG - 2022-11-06 02:43:39 --> Total execution time: 0.0704
DEBUG - 2022-11-06 02:44:40 --> Total execution time: 0.0852
DEBUG - 2022-11-06 02:44:40 --> Total execution time: 0.0322
DEBUG - 2022-11-06 02:44:46 --> Total execution time: 0.0190
DEBUG - 2022-11-06 02:44:46 --> Total execution time: 0.0176
DEBUG - 2022-11-06 02:44:46 --> Total execution time: 0.0203
DEBUG - 2022-11-06 02:44:46 --> Total execution time: 0.0216
DEBUG - 2022-11-06 02:44:50 --> Total execution time: 0.0248
DEBUG - 2022-11-06 02:44:50 --> Total execution time: 0.0153
DEBUG - 2022-11-06 02:44:50 --> Total execution time: 0.0174
DEBUG - 2022-11-06 02:44:53 --> Total execution time: 0.0260
DEBUG - 2022-11-06 02:44:53 --> Total execution time: 0.0168
DEBUG - 2022-11-06 02:44:53 --> Total execution time: 0.0197
DEBUG - 2022-11-06 02:44:53 --> Total execution time: 0.0185
DEBUG - 2022-11-06 02:45:30 --> Total execution time: 0.0190
DEBUG - 2022-11-06 02:45:30 --> Total execution time: 0.0176
DEBUG - 2022-11-06 02:45:30 --> Total execution time: 0.0189
DEBUG - 2022-11-06 02:45:30 --> Total execution time: 0.0201
DEBUG - 2022-11-06 02:45:33 --> Total execution time: 0.0178
DEBUG - 2022-11-06 02:45:33 --> Total execution time: 0.0150
DEBUG - 2022-11-06 02:45:33 --> Total execution time: 0.0231
DEBUG - 2022-11-06 02:45:33 --> Total execution time: 0.0192
DEBUG - 2022-11-06 02:45:35 --> Total execution time: 0.0312
DEBUG - 2022-11-06 02:45:35 --> Total execution time: 0.0146
DEBUG - 2022-11-06 02:45:35 --> Total execution time: 0.0172
DEBUG - 2022-11-06 02:45:43 --> Total execution time: 0.0347
DEBUG - 2022-11-06 02:45:44 --> Total execution time: 0.0305
DEBUG - 2022-11-06 01:52:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 01:52:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 01:52:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 01:52:40 --> Total execution time: 0.0466
DEBUG - 2022-11-06 02:24:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 02:24:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 02:24:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 02:24:13 --> Total execution time: 0.0226
DEBUG - 2022-11-06 02:24:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 02:24:14 --> No URI present. Default controller set.
DEBUG - 2022-11-06 02:24:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 02:24:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 02:24:14 --> Total execution time: 0.0166
DEBUG - 2022-11-06 02:41:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 02:41:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 02:41:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 02:41:39 --> Total execution time: 0.0418
DEBUG - 2022-11-06 02:42:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 02:42:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 02:42:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 02:42:15 --> Total execution time: 0.0279
DEBUG - 2022-11-06 04:21:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 04:21:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 04:21:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 04:21:36 --> Total execution time: 0.0431
DEBUG - 2022-11-06 04:21:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 04:21:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 04:21:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 04:21:36 --> Total execution time: 0.0260
DEBUG - 2022-11-06 04:41:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 04:41:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 04:41:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 04:41:12 --> Total execution time: 0.0447
DEBUG - 2022-11-06 05:36:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 05:36:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 05:36:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 05:36:32 --> Total execution time: 0.0457
DEBUG - 2022-11-06 11:11:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:04 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:11:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:11:04 --> Total execution time: 0.0235
DEBUG - 2022-11-06 11:11:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:16 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:11:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:11:16 --> ssoValidateToken : {"status":true,"data":{"id_user":"ef645ec9-116f-4b78-afb7-9faaf8a641f3","username":"181803","nama":"SYAIFUL BAHRI","telepon":"085718439607","email":"syaifulbahri1987@gmail.com","nik":null,"nrk":"181803","passport":null},"message":""}
DEBUG - 2022-11-06 18:11:16 --> Total execution time: 0.2224
DEBUG - 2022-11-06 11:11:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:16 --> Total execution time: 0.1268
DEBUG - 2022-11-06 11:11:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:17 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:11:17 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:11:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:17 --> Total execution time: 0.0698
DEBUG - 2022-11-06 11:11:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:21 --> Total execution time: 0.0203
DEBUG - 2022-11-06 11:11:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:21 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:11:21 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:11:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:11:22 --> Total execution time: 0.0372
DEBUG - 2022-11-06 11:11:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:11:22 --> Total execution time: 0.0409
DEBUG - 2022-11-06 11:11:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:29 --> Total execution time: 0.0223
DEBUG - 2022-11-06 11:11:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:29 --> Total execution time: 0.0154
DEBUG - 2022-11-06 11:11:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:29 --> Total execution time: 0.0184
DEBUG - 2022-11-06 11:11:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:36 --> Total execution time: 0.0182
DEBUG - 2022-11-06 11:11:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:40 --> Total execution time: 0.0836
DEBUG - 2022-11-06 11:11:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:40 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:11:40 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:11:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:11:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:11:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:11:40 --> Total execution time: 0.0311
DEBUG - 2022-11-06 11:12:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:21 --> Total execution time: 0.0257
DEBUG - 2022-11-06 11:12:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:21 --> Total execution time: 0.0153
DEBUG - 2022-11-06 11:12:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:21 --> Total execution time: 0.0179
DEBUG - 2022-11-06 11:12:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:40 --> Total execution time: 0.0327
DEBUG - 2022-11-06 11:12:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:40 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:12:40 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:12:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:12:40 --> Total execution time: 0.0171
DEBUG - 2022-11-06 11:12:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:12:40 --> Total execution time: 0.0180
DEBUG - 2022-11-06 11:12:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:12:42 --> Total execution time: 0.0200
DEBUG - 2022-11-06 11:12:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:46 --> Total execution time: 0.0813
DEBUG - 2022-11-06 11:12:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:46 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:12:46 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:12:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:46 --> Total execution time: 0.0308
DEBUG - 2022-11-06 11:12:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:47 --> Total execution time: 0.0423
DEBUG - 2022-11-06 11:12:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:47 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:12:47 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:12:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:12:47 --> Total execution time: 0.0286
DEBUG - 2022-11-06 11:12:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:12:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:12:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:12:48 --> Total execution time: 0.0275
DEBUG - 2022-11-06 11:15:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:23 --> Total execution time: 0.0205
DEBUG - 2022-11-06 11:15:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:15:23 --> Total execution time: 0.0224
DEBUG - 2022-11-06 11:15:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:27 --> Total execution time: 0.0189
DEBUG - 2022-11-06 11:15:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:15:27 --> Total execution time: 0.0209
DEBUG - 2022-11-06 11:15:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:33 --> Total execution time: 0.0276
DEBUG - 2022-11-06 11:15:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:33 --> Total execution time: 0.0161
DEBUG - 2022-11-06 11:15:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:33 --> Total execution time: 0.0182
DEBUG - 2022-11-06 11:15:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:45 --> Total execution time: 0.0843
DEBUG - 2022-11-06 11:15:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:45 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:15:45 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:15:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:46 --> Total execution time: 0.0307
DEBUG - 2022-11-06 11:15:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:15:52 --> Total execution time: 0.0206
DEBUG - 2022-11-06 11:15:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:52 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:15:52 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:15:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:15:52 --> Total execution time: 0.0172
DEBUG - 2022-11-06 11:15:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:15:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:15:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:15:52 --> Total execution time: 0.0186
DEBUG - 2022-11-06 11:16:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:13 --> Total execution time: 0.0330
DEBUG - 2022-11-06 11:16:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:13 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:16:13 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:16:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:13 --> Total execution time: 0.0356
DEBUG - 2022-11-06 11:16:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:21 --> Total execution time: 0.0279
DEBUG - 2022-11-06 11:16:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:21 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:16:21 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:16:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:21 --> Total execution time: 0.0187
DEBUG - 2022-11-06 11:16:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:16:21 --> Total execution time: 0.0251
DEBUG - 2022-11-06 11:16:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:23 --> Total execution time: 0.0180
DEBUG - 2022-11-06 11:16:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:16:23 --> Total execution time: 0.0154
DEBUG - 2022-11-06 11:16:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:23 --> Total execution time: 0.0187
DEBUG - 2022-11-06 11:16:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:16:23 --> Total execution time: 0.0163
DEBUG - 2022-11-06 11:16:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:24 --> Total execution time: 0.0200
DEBUG - 2022-11-06 11:16:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:16:24 --> Total execution time: 0.0158
DEBUG - 2022-11-06 11:16:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:24 --> Total execution time: 0.0185
DEBUG - 2022-11-06 11:16:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:16:24 --> Total execution time: 0.0160
DEBUG - 2022-11-06 11:16:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:16:26 --> Total execution time: 0.0193
DEBUG - 2022-11-06 11:16:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:26 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:16:26 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:16:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:16:26 --> Total execution time: 0.0170
DEBUG - 2022-11-06 11:16:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:16:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:16:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:16:26 --> Total execution time: 0.0185
DEBUG - 2022-11-06 11:19:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:20 --> Total execution time: 0.0184
DEBUG - 2022-11-06 11:19:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:20 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:19:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:19:20 --> Total execution time: 0.0247
DEBUG - 2022-11-06 11:19:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:35 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:19:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:19:35 --> ssoValidateToken : {"status":true,"data":{"id_user":"275c5982-4ee4-43b4-902b-d3256ca6c716","username":"124621","nama":"WIWIT DJALU ADJI","telepon":"081315170289","email":"djalu74@gmail.com","nik":null,"nrk":"124621","passport":null},"message":""}
DEBUG - 2022-11-06 18:19:35 --> Total execution time: 0.0478
DEBUG - 2022-11-06 11:19:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:36 --> Total execution time: 0.0937
DEBUG - 2022-11-06 11:19:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:36 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:19:36 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:19:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:36 --> Total execution time: 0.0311
DEBUG - 2022-11-06 11:19:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:41 --> Total execution time: 0.0321
DEBUG - 2022-11-06 11:19:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:41 --> Total execution time: 0.0162
DEBUG - 2022-11-06 11:19:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:41 --> Total execution time: 0.0289
DEBUG - 2022-11-06 11:19:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:41 --> Total execution time: 0.0317
DEBUG - 2022-11-06 11:19:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:19:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:19:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:45 --> Total execution time: 0.0183
DEBUG - 2022-11-06 11:19:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:19:45 --> Total execution time: 0.0244
DEBUG - 2022-11-06 11:20:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:20:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:20:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:20:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:20:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:20:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:20:03 --> Total execution time: 0.0192
DEBUG - 2022-11-06 18:20:03 --> Total execution time: 0.0279
DEBUG - 2022-11-06 11:20:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:20:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:20:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:20:05 --> Total execution time: 0.0235
DEBUG - 2022-11-06 11:20:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:20:06 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:20:06 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:20:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:20:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:20:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:20:06 --> Total execution time: 0.0175
DEBUG - 2022-11-06 11:20:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:20:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:20:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:20:06 --> Total execution time: 0.0220
DEBUG - 2022-11-06 11:21:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:21:41 --> Total execution time: 0.0186
DEBUG - 2022-11-06 11:21:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:41 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:21:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:21:41 --> Total execution time: 0.0244
DEBUG - 2022-11-06 11:21:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:55 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:21:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:21:55 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 18:21:55 --> administrator
DEBUG - 2022-11-06 18:21:55 --> Total execution time: 0.1319
DEBUG - 2022-11-06 11:21:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:21:56 --> Total execution time: 0.3073
DEBUG - 2022-11-06 11:21:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:21:56 --> Total execution time: 0.0240
DEBUG - 2022-11-06 11:21:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:21:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:21:56 --> Total execution time: 0.0229
DEBUG - 2022-11-06 11:21:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:21:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:21:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:21:57 --> Total execution time: 0.1594
DEBUG - 2022-11-06 11:21:57 --> Total execution time: 0.1176
DEBUG - 2022-11-06 11:22:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:22:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:22:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:22:05 --> Total execution time: 0.3090
DEBUG - 2022-11-06 11:22:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:22:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:22:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:22:07 --> Total execution time: 0.0280
DEBUG - 2022-11-06 11:22:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:22:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:22:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 18:22:07 --> Severity: error --> Exception: Call to undefined method Func_table::getBulanPendek() /var/www/html/si-adik/application/views/dashboard_admin/visitor/menu_1_grafik.php 58
DEBUG - 2022-11-06 11:22:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:22:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:22:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 18:22:22 --> Severity: error --> Exception: Call to undefined method Func_table::getBulanPendek() /var/www/html/si-adik/application/views/dashboard_admin/visitor/menu_1_grafik.php 58
DEBUG - 2022-11-06 11:22:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:22:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:22:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:22:23 --> Total execution time: 0.0186
DEBUG - 2022-11-06 11:22:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:22:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:22:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:22:25 --> Total execution time: 0.0148
DEBUG - 2022-11-06 11:22:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:22:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:22:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 18:22:46 --> Severity: error --> Exception: Call to undefined method Func_table::getBulanPendek() /var/www/html/si-adik/application/views/dashboard_admin/visitor/menu_1_grafik.php 58
DEBUG - 2022-11-06 11:24:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:24:21 --> Total execution time: 0.0208
DEBUG - 2022-11-06 11:24:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 18:24:22 --> Severity: error --> Exception: Call to undefined method Func_table::getBulanPendek() /var/www/html/si-adik/application/views/dashboard_admin/visitor/menu_1_grafik.php 58
DEBUG - 2022-11-06 11:24:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:28 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:24:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:24:28 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 18:24:28 --> administrator
DEBUG - 2022-11-06 18:24:28 --> Total execution time: 0.1253
DEBUG - 2022-11-06 11:24:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:24:29 --> Total execution time: 0.2924
DEBUG - 2022-11-06 11:24:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:24:29 --> Total execution time: 0.0208
DEBUG - 2022-11-06 11:24:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:24:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:29 --> Total execution time: 0.0227
DEBUG - 2022-11-06 11:24:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:24:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:24:29 --> Total execution time: 0.1628
DEBUG - 2022-11-06 11:24:29 --> Total execution time: 0.0593
DEBUG - 2022-11-06 11:24:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:24:36 --> Total execution time: 0.2931
DEBUG - 2022-11-06 11:24:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:24:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:24:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:24:37 --> Total execution time: 0.0148
DEBUG - 2022-11-06 11:26:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:26:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:26:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:26:18 --> Total execution time: 0.0179
DEBUG - 2022-11-06 11:26:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:26:18 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:26:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:26:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:26:18 --> Total execution time: 0.0146
DEBUG - 2022-11-06 11:26:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:26:31 --> No URI present. Default controller set.
DEBUG - 2022-11-06 11:26:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:26:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:26:31 --> ssoValidateToken : {"status":true,"data":{"id_user":"ef645ec9-116f-4b78-afb7-9faaf8a641f3","username":"181803","nama":"SYAIFUL BAHRI","telepon":"085718439607","email":"syaifulbahri1987@gmail.com","nik":null,"nrk":"181803","passport":null},"message":""}
DEBUG - 2022-11-06 18:26:31 --> Total execution time: 0.0557
DEBUG - 2022-11-06 11:26:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:26:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:26:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:26:32 --> Total execution time: 0.0883
DEBUG - 2022-11-06 11:26:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:26:32 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:26:32 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:26:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:26:32 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:26:32 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:26:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:26:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:26:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:26:32 --> Total execution time: 0.0378
DEBUG - 2022-11-06 11:27:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:27:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:27:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:27:25 --> Total execution time: 0.0182
DEBUG - 2022-11-06 11:27:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:27:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:27:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 11:27:25 --> Total execution time: 0.0174
DEBUG - 2022-11-06 11:48:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:48:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:48:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:48:38 --> Total execution time: 0.0895
DEBUG - 2022-11-06 11:48:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:48:38 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 11:48:38 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 11:48:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 11:48:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 11:48:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 18:48:38 --> Total execution time: 0.0323
DEBUG - 2022-11-06 12:03:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:03:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:03:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:03:14 --> Total execution time: 0.0433
DEBUG - 2022-11-06 12:04:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:04:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:04:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:04:51 --> Total execution time: 0.0254
DEBUG - 2022-11-06 12:17:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:17:34 --> Total execution time: 0.0936
DEBUG - 2022-11-06 12:17:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:34 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:17:34 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:17:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:17:35 --> Total execution time: 0.0322
DEBUG - 2022-11-06 12:17:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:17:37 --> Total execution time: 0.0216
DEBUG - 2022-11-06 12:17:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:17:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 19:17:37 --> Total execution time: 0.0224
DEBUG - 2022-11-06 12:17:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:17:37 --> Total execution time: 0.0198
DEBUG - 2022-11-06 12:17:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:17:40 --> Total execution time: 0.0200
DEBUG - 2022-11-06 12:17:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:41 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:17:41 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:17:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:17:42 --> Total execution time: 0.0155
DEBUG - 2022-11-06 12:17:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:17:42 --> Total execution time: 0.0179
DEBUG - 2022-11-06 12:17:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:17:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:17:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:17:44 --> Total execution time: 0.0177
DEBUG - 2022-11-06 12:32:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:32:32 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:32:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:32:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:32:32 --> Total execution time: 0.0152
DEBUG - 2022-11-06 12:32:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:32:47 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:32:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:32:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:32:47 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 19:32:47 --> administrator
DEBUG - 2022-11-06 19:32:47 --> Total execution time: 0.1304
DEBUG - 2022-11-06 12:32:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:32:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:32:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:32:48 --> Total execution time: 0.2905
DEBUG - 2022-11-06 12:32:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:32:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:32:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:32:54 --> Total execution time: 0.0151
DEBUG - 2022-11-06 12:32:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:32:55 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:32:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:32:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:32:55 --> Total execution time: 0.0155
DEBUG - 2022-11-06 12:33:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:33:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:33:19 --> Total execution time: 0.2899
DEBUG - 2022-11-06 12:33:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:33:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:33:22 --> Total execution time: 0.0256
DEBUG - 2022-11-06 12:33:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:33:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:33:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:33:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:33:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:33:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:33:22 --> Total execution time: 0.0283
DEBUG - 2022-11-06 12:33:22 --> Total execution time: 0.1762
DEBUG - 2022-11-06 12:33:22 --> Total execution time: 0.1866
DEBUG - 2022-11-06 12:33:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:58 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:33:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:33:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:33:58 --> ssoValidateToken : {"status":true,"data":{"id_user":"c41542c9-ec51-4871-a16a-f57482edbfdf","username":"174898","nama":"MUHRONI","telepon":"081298229404","email":"muhroni2005@gmail.com","nik":null,"nrk":"174898","passport":null},"message":""}
DEBUG - 2022-11-06 19:33:58 --> Total execution time: 0.1243
DEBUG - 2022-11-06 12:33:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:33:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:33:58 --> Total execution time: 0.0814
DEBUG - 2022-11-06 12:33:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:59 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:33:59 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:33:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:33:59 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:33:59 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:34:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:34:00 --> Total execution time: 0.0329
DEBUG - 2022-11-06 12:34:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:02 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:34:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:34:02 --> Total execution time: 0.0243
DEBUG - 2022-11-06 12:34:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:34:25 --> Total execution time: 0.0223
DEBUG - 2022-11-06 12:34:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:34:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 19:34:25 --> Total execution time: 0.0213
DEBUG - 2022-11-06 12:34:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:34:25 --> Total execution time: 0.0165
DEBUG - 2022-11-06 12:34:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:34:29 --> Total execution time: 0.0299
DEBUG - 2022-11-06 12:34:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:34:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:34:39 --> Total execution time: 0.0223
DEBUG - 2022-11-06 12:34:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:34:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:34:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:34:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 19:34:39 --> Total execution time: 0.0296
DEBUG - 2022-11-06 12:34:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:34:39 --> Total execution time: 0.0164
DEBUG - 2022-11-06 12:36:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:36:47 --> Total execution time: 0.2898
DEBUG - 2022-11-06 12:36:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:36:48 --> Total execution time: 0.0273
DEBUG - 2022-11-06 12:36:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:36:48 --> Total execution time: 0.0254
DEBUG - 2022-11-06 12:36:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:36:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:36:48 --> Total execution time: 0.1534
DEBUG - 2022-11-06 12:36:48 --> Total execution time: 0.1379
DEBUG - 2022-11-06 12:36:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:36:50 --> Total execution time: 0.3029
DEBUG - 2022-11-06 12:36:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:36:51 --> Total execution time: 0.0320
DEBUG - 2022-11-06 12:36:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:36:58 --> Total execution time: 0.0217
DEBUG - 2022-11-06 12:36:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:36:59 --> Total execution time: 0.3144
DEBUG - 2022-11-06 12:36:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:36:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:36:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:36:59 --> Total execution time: 0.0144
DEBUG - 2022-11-06 12:37:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:37:12 --> Total execution time: 0.3095
DEBUG - 2022-11-06 12:37:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:37:26 --> Total execution time: 0.2992
DEBUG - 2022-11-06 12:37:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:37:27 --> Total execution time: 0.0142
DEBUG - 2022-11-06 12:37:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:37:29 --> Total execution time: 0.2910
DEBUG - 2022-11-06 12:37:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:37:29 --> Total execution time: 0.0133
DEBUG - 2022-11-06 12:37:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:37:32 --> Total execution time: 0.3239
DEBUG - 2022-11-06 12:37:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:37:39 --> Total execution time: 0.0190
DEBUG - 2022-11-06 12:37:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:37:50 --> Total execution time: 7.0626
DEBUG - 2022-11-06 12:37:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:37:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:37:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:37:51 --> Total execution time: 0.2993
DEBUG - 2022-11-06 12:39:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:01 --> Total execution time: 0.0177
DEBUG - 2022-11-06 12:39:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:01 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:39:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:01 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 19:39:01 --> administrator
DEBUG - 2022-11-06 19:39:01 --> Total execution time: 0.0467
DEBUG - 2022-11-06 12:39:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:01 --> Total execution time: 0.2990
DEBUG - 2022-11-06 12:39:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:02 --> Total execution time: 0.0228
DEBUG - 2022-11-06 12:39:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:02 --> Total execution time: 0.0253
DEBUG - 2022-11-06 12:39:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:02 --> Total execution time: 0.0259
DEBUG - 2022-11-06 12:39:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:02 --> Total execution time: 0.1552
DEBUG - 2022-11-06 12:39:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:23 --> Total execution time: 0.0194
DEBUG - 2022-11-06 12:39:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:23 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:39:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:23 --> Total execution time: 0.0148
DEBUG - 2022-11-06 12:39:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:35 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:39:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:35 --> ssoValidateToken : {"status":true,"data":{"id_user":"4225e555-eeae-454f-84ee-fb36f66778a5","username":"119287","nama":"DWI SULISTYANINGSIH","telepon":"08158759404","email":"liesthea55@yahoo.com","nik":null,"nrk":"119287","passport":null},"message":""}
DEBUG - 2022-11-06 19:39:35 --> Total execution time: 0.1260
DEBUG - 2022-11-06 12:39:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:35 --> Total execution time: 0.0859
DEBUG - 2022-11-06 12:39:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:35 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:39:35 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:39:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:35 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:39:35 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:39:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:36 --> Total execution time: 0.0307
DEBUG - 2022-11-06 12:39:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:39 --> Total execution time: 0.0184
DEBUG - 2022-11-06 12:39:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:39:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 19:39:39 --> Total execution time: 0.0184
DEBUG - 2022-11-06 12:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:39 --> Total execution time: 0.0209
DEBUG - 2022-11-06 12:39:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:39 --> Total execution time: 0.0202
DEBUG - 2022-11-06 12:39:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:39:45 --> Total execution time: 0.0387
DEBUG - 2022-11-06 12:39:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:39:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:39:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 19:39:56 --> Query error: Unknown column 'keterangan_ditolak' in 'field list' - Invalid query: INSERT INTO `tbl_history_srt_ket` (`id_srt`, `id_user`, `created_at`, `created_by`, `id_status_srt`, `keterangan_ditolak`) VALUES ('115', '723', '2022-11-06 19:39:56', '1203', '22', '')
DEBUG - 2022-11-06 12:40:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 19:40:22 --> Query error: Unknown column 'keterangan_ditolak' in 'field list' - Invalid query: INSERT INTO `tbl_history_srt_ket` (`id_srt`, `id_user`, `created_at`, `created_by`, `id_status_srt`, `keterangan_ditolak`) VALUES ('115', '723', '2022-11-06 19:40:22', '1203', '22', '')
DEBUG - 2022-11-06 12:40:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:40:29 --> Total execution time: 0.0262
DEBUG - 2022-11-06 12:40:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 19:40:32 --> Query error: Unknown column 'keterangan_ditolak' in 'field list' - Invalid query: INSERT INTO `tbl_history_srt_ket` (`id_srt`, `id_user`, `created_at`, `created_by`, `id_status_srt`, `keterangan_ditolak`) VALUES ('115', '723', '2022-11-06 19:40:32', '1203', '23', '')
DEBUG - 2022-11-06 12:40:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 19:40:34 --> Query error: Unknown column 'keterangan_ditolak' in 'field list' - Invalid query: INSERT INTO `tbl_history_srt_ket` (`id_srt`, `id_user`, `created_at`, `created_by`, `id_status_srt`, `keterangan_ditolak`) VALUES ('115', '723', '2022-11-06 19:40:34', '1203', '23', '')
DEBUG - 2022-11-06 12:40:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 19:40:35 --> Query error: Unknown column 'keterangan_ditolak' in 'field list' - Invalid query: INSERT INTO `tbl_history_srt_ket` (`id_srt`, `id_user`, `created_at`, `created_by`, `id_status_srt`, `keterangan_ditolak`) VALUES ('115', '723', '2022-11-06 19:40:35', '1203', '23', '')
DEBUG - 2022-11-06 12:40:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 19:40:35 --> Query error: Unknown column 'keterangan_ditolak' in 'field list' - Invalid query: INSERT INTO `tbl_history_srt_ket` (`id_srt`, `id_user`, `created_at`, `created_by`, `id_status_srt`, `keterangan_ditolak`) VALUES ('115', '723', '2022-11-06 19:40:35', '1203', '23', '')
DEBUG - 2022-11-06 12:40:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:40:38 --> Total execution time: 0.0191
DEBUG - 2022-11-06 12:40:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:40:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:40:38 --> Total execution time: 0.0211
DEBUG - 2022-11-06 19:40:38 --> Total execution time: 0.0177
DEBUG - 2022-11-06 12:40:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:40:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:40:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:40:38 --> Total execution time: 0.0241
DEBUG - 2022-11-06 12:42:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:42:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:42:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:42:31 --> Total execution time: 0.0214
DEBUG - 2022-11-06 12:42:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:42:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:42:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:42:32 --> Total execution time: 0.0181
DEBUG - 2022-11-06 12:42:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:42:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:42:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:42:32 --> Total execution time: 0.0159
DEBUG - 2022-11-06 12:42:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:42:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:42:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:42:32 --> Total execution time: 0.0200
DEBUG - 2022-11-06 12:42:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:42:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:42:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:42:52 --> Total execution time: 0.0275
DEBUG - 2022-11-06 12:42:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:42:52 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:42:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:42:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:42:52 --> Total execution time: 0.0229
DEBUG - 2022-11-06 12:43:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:02 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:43:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:43:02 --> ssoValidateToken : {"status":true,"data":{"id_user":"275c5982-4ee4-43b4-902b-d3256ca6c716","username":"124621","nama":"WIWIT DJALU ADJI","telepon":"081315170289","email":"djalu74@gmail.com","nik":null,"nrk":"124621","passport":null},"message":""}
DEBUG - 2022-11-06 19:43:02 --> Total execution time: 0.1245
DEBUG - 2022-11-06 12:43:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:43:02 --> Total execution time: 0.0914
DEBUG - 2022-11-06 12:43:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:02 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:43:02 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:43:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:02 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:43:02 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:43:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:43:02 --> Total execution time: 0.0403
DEBUG - 2022-11-06 12:43:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:43:05 --> Total execution time: 0.0182
DEBUG - 2022-11-06 12:43:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:43:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:43:06 --> Total execution time: 0.0165
DEBUG - 2022-11-06 19:43:06 --> Total execution time: 0.0270
DEBUG - 2022-11-06 12:43:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:43:06 --> Total execution time: 0.0288
DEBUG - 2022-11-06 12:43:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:43:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:43:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:43:10 --> Total execution time: 0.0181
DEBUG - 2022-11-06 12:45:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:45:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:45:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:45:04 --> Total execution time: 0.0263
DEBUG - 2022-11-06 12:45:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:45:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:45:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:45:04 --> Total execution time: 0.0149
DEBUG - 2022-11-06 12:45:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:45:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:45:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:45:04 --> Total execution time: 0.0176
DEBUG - 2022-11-06 12:46:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:05 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:46:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:46:05 --> Total execution time: 0.0162
DEBUG - 2022-11-06 12:46:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:20 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:46:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:46:20 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 19:46:20 --> administrator
DEBUG - 2022-11-06 19:46:20 --> Total execution time: 0.1285
DEBUG - 2022-11-06 12:46:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:46:20 --> Total execution time: 0.2966
DEBUG - 2022-11-06 12:46:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:46:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:46:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:46:21 --> Total execution time: 0.0222
DEBUG - 2022-11-06 12:46:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:46:21 --> Total execution time: 0.1764
DEBUG - 2022-11-06 12:46:21 --> Total execution time: 0.1786
DEBUG - 2022-11-06 12:46:21 --> Total execution time: 0.1862
DEBUG - 2022-11-06 12:46:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:46:23 --> Total execution time: 0.3050
DEBUG - 2022-11-06 12:46:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:46:24 --> Total execution time: 0.0157
DEBUG - 2022-11-06 12:46:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:46:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:46:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:46:51 --> Total execution time: 0.2954
DEBUG - 2022-11-06 12:48:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:26 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:48:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:48:26 --> Total execution time: 0.0148
DEBUG - 2022-11-06 12:48:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:26 --> Total execution time: 0.0877
DEBUG - 2022-11-06 12:48:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:26 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:48:26 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:48:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:27 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:48:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:48:27 --> Total execution time: 0.0153
DEBUG - 2022-11-06 12:48:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:27 --> Total execution time: 0.0414
DEBUG - 2022-11-06 12:48:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:27 --> Total execution time: 0.0297
DEBUG - 2022-11-06 12:48:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:30 --> Total execution time: 0.0178
DEBUG - 2022-11-06 12:48:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:30 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:48:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:48:30 --> Total execution time: 0.0181
DEBUG - 2022-11-06 12:48:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:33 --> Total execution time: 0.0191
DEBUG - 2022-11-06 12:48:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:46 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:48:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:48:46 --> ssoValidateToken : {"status":true,"data":{"id_user":"4225e555-eeae-454f-84ee-fb36f66778a5","username":"119287","nama":"DWI SULISTYANINGSIH","telepon":"08158759404","email":"liesthea55@yahoo.com","nik":null,"nrk":"119287","passport":null},"message":""}
DEBUG - 2022-11-06 19:48:46 --> Total execution time: 0.0476
DEBUG - 2022-11-06 12:48:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:46 --> Total execution time: 0.0364
DEBUG - 2022-11-06 12:48:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:47 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:48:47 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:48:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:47 --> Total execution time: 0.0338
DEBUG - 2022-11-06 12:48:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:49 --> Total execution time: 0.0289
DEBUG - 2022-11-06 12:48:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:48:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 19:48:49 --> Total execution time: 0.0224
DEBUG - 2022-11-06 12:48:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:49 --> Total execution time: 0.0165
DEBUG - 2022-11-06 12:48:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:51 --> Total execution time: 0.0195
DEBUG - 2022-11-06 12:48:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:52 --> Total execution time: 0.0234
DEBUG - 2022-11-06 12:48:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:48:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:53 --> Total execution time: 0.0203
DEBUG - 2022-11-06 19:48:53 --> Total execution time: 0.0254
DEBUG - 2022-11-06 12:48:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:53 --> Total execution time: 0.0247
DEBUG - 2022-11-06 12:48:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:48:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:48:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:48:58 --> Total execution time: 0.0171
DEBUG - 2022-11-06 12:49:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:49:07 --> Total execution time: 0.0177
DEBUG - 2022-11-06 12:49:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:07 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:49:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:49:07 --> Total execution time: 0.0153
DEBUG - 2022-11-06 12:49:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:49:13 --> Total execution time: 0.0183
DEBUG - 2022-11-06 12:49:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:21 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:49:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:49:21 --> ssoValidateToken : {"status":true,"data":{"id_user":"275c5982-4ee4-43b4-902b-d3256ca6c716","username":"124621","nama":"WIWIT DJALU ADJI","telepon":"081315170289","email":"djalu74@gmail.com","nik":null,"nrk":"124621","passport":null},"message":""}
DEBUG - 2022-11-06 19:49:21 --> Total execution time: 0.0548
DEBUG - 2022-11-06 12:49:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:49:22 --> Total execution time: 0.0472
DEBUG - 2022-11-06 12:49:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:22 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:49:22 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:49:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:22 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:49:22 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:49:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:49:22 --> Total execution time: 0.0308
DEBUG - 2022-11-06 12:49:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:49:24 --> Total execution time: 0.0178
DEBUG - 2022-11-06 12:49:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:49:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:49:24 --> Total execution time: 0.0180
DEBUG - 2022-11-06 19:49:24 --> Total execution time: 0.0204
DEBUG - 2022-11-06 12:49:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:49:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:49:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:49:25 --> Total execution time: 0.0191
DEBUG - 2022-11-06 12:50:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:50:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:50:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:50:15 --> Total execution time: 0.0177
DEBUG - 2022-11-06 12:51:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:01 --> Total execution time: 0.3043
DEBUG - 2022-11-06 12:51:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:02 --> Total execution time: 0.0140
DEBUG - 2022-11-06 12:51:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:08 --> Total execution time: 0.2965
DEBUG - 2022-11-06 12:51:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:08 --> Total execution time: 0.0155
DEBUG - 2022-11-06 12:51:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:14 --> Total execution time: 0.0218
DEBUG - 2022-11-06 12:51:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:14 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:51:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:14 --> Total execution time: 0.0156
DEBUG - 2022-11-06 12:51:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:39 --> No URI present. Default controller set.
DEBUG - 2022-11-06 12:51:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:39 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 19:51:39 --> administrator
DEBUG - 2022-11-06 19:51:39 --> Total execution time: 0.0486
DEBUG - 2022-11-06 12:51:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:39 --> Total execution time: 0.3370
DEBUG - 2022-11-06 12:51:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:40 --> Total execution time: 0.0227
DEBUG - 2022-11-06 12:51:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:40 --> Total execution time: 0.0230
DEBUG - 2022-11-06 12:51:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:40 --> Total execution time: 0.1557
DEBUG - 2022-11-06 12:51:40 --> Total execution time: 0.1695
DEBUG - 2022-11-06 12:51:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:43 --> Total execution time: 0.3140
DEBUG - 2022-11-06 12:51:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:43 --> Total execution time: 0.0144
DEBUG - 2022-11-06 12:51:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:46 --> Total execution time: 0.2955
DEBUG - 2022-11-06 12:51:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:49 --> Total execution time: 0.2962
DEBUG - 2022-11-06 12:51:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:51:57 --> Total execution time: 0.3600
DEBUG - 2022-11-06 12:51:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:51:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:51:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:51:58 --> Total execution time: 0.0143
DEBUG - 2022-11-06 12:52:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:52:03 --> Total execution time: 0.2927
DEBUG - 2022-11-06 12:52:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:52:11 --> Total execution time: 0.2957
DEBUG - 2022-11-06 12:52:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:52:11 --> Total execution time: 0.0153
DEBUG - 2022-11-06 12:52:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:52:36 --> Total execution time: 0.3107
DEBUG - 2022-11-06 12:52:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:52:50 --> Total execution time: 0.2946
DEBUG - 2022-11-06 12:52:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:52:50 --> Total execution time: 0.0144
DEBUG - 2022-11-06 12:52:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:52:52 --> Total execution time: 0.2872
DEBUG - 2022-11-06 12:52:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:52:53 --> Total execution time: 0.0169
DEBUG - 2022-11-06 12:52:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:52:54 --> Total execution time: 0.2934
DEBUG - 2022-11-06 12:52:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:52:55 --> Total execution time: 0.0143
DEBUG - 2022-11-06 12:52:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:52:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:52:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:52:59 --> Total execution time: 0.3298
DEBUG - 2022-11-06 12:53:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:53:02 --> Total execution time: 0.3011
DEBUG - 2022-11-06 12:53:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:53:07 --> Total execution time: 0.2924
DEBUG - 2022-11-06 12:53:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:53:08 --> Total execution time: 0.0144
DEBUG - 2022-11-06 12:53:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:53:12 --> Total execution time: 0.2878
DEBUG - 2022-11-06 12:53:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:53:12 --> Total execution time: 0.0143
DEBUG - 2022-11-06 12:53:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:53:17 --> Total execution time: 0.2947
DEBUG - 2022-11-06 12:53:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:53:21 --> Total execution time: 0.2971
DEBUG - 2022-11-06 12:53:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:53:21 --> Total execution time: 0.0141
DEBUG - 2022-11-06 12:53:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:53:46 --> Total execution time: 0.0217
DEBUG - 2022-11-06 12:53:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:53:48 --> Total execution time: 0.2893
DEBUG - 2022-11-06 12:53:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:53:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:53:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:53:48 --> Total execution time: 0.0147
DEBUG - 2022-11-06 12:54:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:54:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:54:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:54:20 --> Total execution time: 0.2901
DEBUG - 2022-11-06 12:54:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:54:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:54:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:54:20 --> Total execution time: 0.0141
DEBUG - 2022-11-06 12:54:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:54:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:54:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:54:24 --> Total execution time: 0.2886
DEBUG - 2022-11-06 12:54:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:54:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:54:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:54:27 --> Total execution time: 0.2887
DEBUG - 2022-11-06 12:54:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:54:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:54:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:54:27 --> Total execution time: 0.0139
DEBUG - 2022-11-06 12:58:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:58:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:58:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:58:20 --> Total execution time: 0.3033
DEBUG - 2022-11-06 12:58:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:58:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:58:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:58:27 --> Total execution time: 0.0174
DEBUG - 2022-11-06 12:59:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:59:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:59:44 --> Total execution time: 0.1054
DEBUG - 2022-11-06 12:59:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:45 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:59:45 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:59:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:59:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:59:45 --> Total execution time: 0.0387
DEBUG - 2022-11-06 12:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:59:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:59:46 --> Total execution time: 0.0267
DEBUG - 2022-11-06 12:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:46 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:59:46 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:46 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 12:59:46 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 12:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:59:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:59:46 --> Total execution time: 0.0178
DEBUG - 2022-11-06 12:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:59:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:59:46 --> Total execution time: 0.0212
DEBUG - 2022-11-06 12:59:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:59:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 19:59:47 --> Total execution time: 0.0182
DEBUG - 2022-11-06 12:59:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 12:59:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 12:59:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 12:59:47 --> Total execution time: 0.0227
DEBUG - 2022-11-06 13:00:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:00:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:00:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:00:57 --> Total execution time: 0.3119
DEBUG - 2022-11-06 13:03:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:03:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:03:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:03:32 --> Total execution time: 0.3022
DEBUG - 2022-11-06 13:03:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:03:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:03:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:03:46 --> Total execution time: 0.2954
DEBUG - 2022-11-06 13:03:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:03:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:03:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:03:47 --> Total execution time: 0.0182
DEBUG - 2022-11-06 13:03:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:03:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:03:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:03:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:03:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:03:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:03:50 --> Total execution time: 0.2860
DEBUG - 2022-11-06 20:03:50 --> Total execution time: 0.3838
DEBUG - 2022-11-06 13:04:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:04:01 --> Total execution time: 0.0150
DEBUG - 2022-11-06 13:04:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:04:18 --> Total execution time: 0.0237
DEBUG - 2022-11-06 13:04:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:04:18 --> Total execution time: 0.0178
DEBUG - 2022-11-06 13:04:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:04:18 --> Total execution time: 0.0244
DEBUG - 2022-11-06 13:04:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:04:19 --> Total execution time: 0.0200
DEBUG - 2022-11-06 13:04:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:04:27 --> Total execution time: 0.0211
DEBUG - 2022-11-06 13:04:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:27 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:04:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:04:27 --> Total execution time: 0.0156
DEBUG - 2022-11-06 13:04:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:36 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:04:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:04:36 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 20:04:36 --> administrator
DEBUG - 2022-11-06 20:04:36 --> Total execution time: 0.1313
DEBUG - 2022-11-06 13:04:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:04:36 --> Total execution time: 0.2908
DEBUG - 2022-11-06 13:04:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:04:36 --> Total execution time: 0.0222
DEBUG - 2022-11-06 13:04:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:04:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:04:36 --> Total execution time: 0.0226
DEBUG - 2022-11-06 13:04:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:04:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:04:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:04:37 --> Total execution time: 0.1565
DEBUG - 2022-11-06 13:04:37 --> Total execution time: 0.1239
DEBUG - 2022-11-06 13:07:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:05 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:07:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:07:05 --> ssoValidateToken : {"status":true,"data":{"id_user":"fc151dd3-f0bd-4584-a5bb-e961f4cd5fdb","username":"112622","nama":"DARWATI","telepon":"085775881706","email":"ajengdarwati@gmail.com","nik":null,"nrk":"112622","passport":null},"message":""}
DEBUG - 2022-11-06 20:07:05 --> Total execution time: 0.0453
DEBUG - 2022-11-06 13:07:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:06 --> Total execution time: 0.1228
DEBUG - 2022-11-06 13:07:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:06 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:07:06 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:07:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:06 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:07:06 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:07:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:06 --> Total execution time: 0.0314
DEBUG - 2022-11-06 13:07:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:08 --> Total execution time: 0.0216
DEBUG - 2022-11-06 13:07:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:07:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 20:07:09 --> Total execution time: 0.0203
DEBUG - 2022-11-06 13:07:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:09 --> Total execution time: 0.0164
DEBUG - 2022-11-06 13:07:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:10 --> Total execution time: 0.0313
DEBUG - 2022-11-06 13:07:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:07:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:30 --> Total execution time: 0.0230
DEBUG - 2022-11-06 13:07:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:31 --> Total execution time: 0.0185
DEBUG - 2022-11-06 13:07:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:31 --> Total execution time: 0.0168
DEBUG - 2022-11-06 13:07:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:34 --> Total execution time: 0.0189
DEBUG - 2022-11-06 13:07:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:07:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:34 --> Total execution time: 0.0167
DEBUG - 2022-11-06 20:07:34 --> Total execution time: 0.0189
DEBUG - 2022-11-06 13:07:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:37 --> Total execution time: 0.0178
DEBUG - 2022-11-06 13:07:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:55 --> Total execution time: 0.2945
DEBUG - 2022-11-06 13:07:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:07:55 --> Total execution time: 0.0150
DEBUG - 2022-11-06 13:07:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:07:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:07:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:07:58 --> Total execution time: 0.2957
DEBUG - 2022-11-06 13:08:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:08:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:08:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:08:00 --> Total execution time: 0.0183
DEBUG - 2022-11-06 13:08:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:08:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:08:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:08:09 --> Total execution time: 6.8050
DEBUG - 2022-11-06 13:08:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:08:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:08:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:08:11 --> Total execution time: 0.3015
DEBUG - 2022-11-06 13:10:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:10:05 --> Total execution time: 0.0188
DEBUG - 2022-11-06 13:10:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:05 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:10:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:10:05 --> Total execution time: 0.0152
DEBUG - 2022-11-06 13:10:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:25 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:10:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:10:25 --> ssoValidateToken : {"status":true,"data":{"id_user":"4225e555-eeae-454f-84ee-fb36f66778a5","username":"119287","nama":"DWI SULISTYANINGSIH","telepon":"08158759404","email":"liesthea55@yahoo.com","nik":null,"nrk":"119287","passport":null},"message":""}
DEBUG - 2022-11-06 20:10:25 --> Total execution time: 0.1244
DEBUG - 2022-11-06 13:10:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:10:27 --> Total execution time: 0.0380
DEBUG - 2022-11-06 13:10:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:28 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:10:28 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:10:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:10:29 --> Total execution time: 0.0329
DEBUG - 2022-11-06 13:10:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:10:31 --> Total execution time: 0.0190
DEBUG - 2022-11-06 13:10:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:10:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:10:31 --> Total execution time: 0.0185
DEBUG - 2022-11-06 20:10:31 --> Total execution time: 0.0209
DEBUG - 2022-11-06 13:10:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:10:31 --> Total execution time: 0.0202
DEBUG - 2022-11-06 13:10:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:10:43 --> Total execution time: 0.0189
DEBUG - 2022-11-06 13:10:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:10:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:10:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 20:10:47 --> Query error: Unknown column 'keterangan_ditolak' in 'field list' - Invalid query: INSERT INTO `tbl_history_srt_ket` (`id_srt`, `id_user`, `created_at`, `created_by`, `id_status_srt`, `keterangan_ditolak`) VALUES ('116', '860', '2022-11-06 20:10:47', '1203', '22', '')
DEBUG - 2022-11-06 13:11:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:11:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:11:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:11:47 --> Total execution time: 2.0022
DEBUG - 2022-11-06 13:11:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:11:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:11:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:11:49 --> Total execution time: 0.0207
DEBUG - 2022-11-06 13:11:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:11:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:11:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:11:50 --> Total execution time: 0.0180
DEBUG - 2022-11-06 13:12:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:12:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:12:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:12:46 --> Total execution time: 0.0204
DEBUG - 2022-11-06 13:12:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:12:46 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:12:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:12:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:12:46 --> Total execution time: 0.0154
DEBUG - 2022-11-06 13:13:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:01 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:13:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:13:01 --> ssoValidateToken : {"status":true,"data":{"id_user":"275c5982-4ee4-43b4-902b-d3256ca6c716","username":"124621","nama":"WIWIT DJALU ADJI","telepon":"081315170289","email":"djalu74@gmail.com","nik":null,"nrk":"124621","passport":null},"message":""}
DEBUG - 2022-11-06 20:13:01 --> Total execution time: 0.1294
DEBUG - 2022-11-06 13:13:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:01 --> Total execution time: 0.0456
DEBUG - 2022-11-06 13:13:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:01 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:13:01 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:13:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:02 --> Total execution time: 0.0314
DEBUG - 2022-11-06 13:13:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:03 --> Total execution time: 0.0214
DEBUG - 2022-11-06 13:13:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:13:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:04 --> Total execution time: 0.0197
DEBUG - 2022-11-06 20:13:04 --> Total execution time: 0.0164
DEBUG - 2022-11-06 13:13:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:04 --> Total execution time: 0.0191
DEBUG - 2022-11-06 13:13:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:16 --> Total execution time: 0.0200
DEBUG - 2022-11-06 13:13:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:25 --> Total execution time: 1.8592
DEBUG - 2022-11-06 13:13:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:13:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 20:13:28 --> Total execution time: 0.0359
DEBUG - 2022-11-06 13:13:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:28 --> Total execution time: 0.0196
DEBUG - 2022-11-06 13:13:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:46 --> Total execution time: 0.3059
DEBUG - 2022-11-06 13:13:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:56 --> Total execution time: 0.0204
DEBUG - 2022-11-06 13:13:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:13:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:13:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:13:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:13:58 --> Total execution time: 0.1398
DEBUG - 2022-11-06 20:13:58 --> Total execution time: 0.4034
DEBUG - 2022-11-06 13:15:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:15:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:15:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:15:36 --> Total execution time: 0.3002
DEBUG - 2022-11-06 13:15:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:15:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:15:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:15:36 --> Total execution time: 0.0152
DEBUG - 2022-11-06 13:15:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:15:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:15:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:15:40 --> Total execution time: 0.2893
DEBUG - 2022-11-06 13:15:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:15:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:15:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:15:49 --> Total execution time: 0.0196
DEBUG - 2022-11-06 13:15:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:15:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:15:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:15:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:15:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:15:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:15:51 --> Total execution time: 0.2975
DEBUG - 2022-11-06 20:15:51 --> Total execution time: 0.3713
DEBUG - 2022-11-06 13:16:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:34 --> Total execution time: 6.4096
DEBUG - 2022-11-06 13:16:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:35 --> Total execution time: 0.2932
DEBUG - 2022-11-06 13:16:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:44 --> Total execution time: 0.0200
DEBUG - 2022-11-06 13:16:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:44 --> Total execution time: 0.0178
DEBUG - 2022-11-06 13:16:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:44 --> Total execution time: 0.0206
DEBUG - 2022-11-06 13:16:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:44 --> Total execution time: 0.0196
DEBUG - 2022-11-06 13:16:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:48 --> Total execution time: 0.0184
DEBUG - 2022-11-06 13:16:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:56 --> Total execution time: 0.0187
DEBUG - 2022-11-06 13:16:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:56 --> Total execution time: 0.0162
DEBUG - 2022-11-06 13:16:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:56 --> Total execution time: 0.0265
DEBUG - 2022-11-06 13:16:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:56 --> Total execution time: 0.0296
DEBUG - 2022-11-06 13:16:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:16:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:16:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:16:58 --> Total execution time: 0.0177
DEBUG - 2022-11-06 13:17:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:17:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:17:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:17:07 --> Total execution time: 0.0378
DEBUG - 2022-11-06 13:17:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:17:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:17:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:17:08 --> Total execution time: 0.0154
DEBUG - 2022-11-06 13:17:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:17:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:17:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:17:08 --> Total execution time: 0.0178
DEBUG - 2022-11-06 13:17:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:17:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:17:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:17:09 --> Total execution time: 0.0183
DEBUG - 2022-11-06 13:17:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:17:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:17:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:17:28 --> Total execution time: 0.0224
DEBUG - 2022-11-06 13:17:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:17:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:17:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:17:28 --> Total execution time: 0.0162
DEBUG - 2022-11-06 13:17:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:17:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:17:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:17:28 --> Total execution time: 0.0155
DEBUG - 2022-11-06 13:18:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:18:03 --> Total execution time: 0.0201
DEBUG - 2022-11-06 13:18:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:18:03 --> Total execution time: 0.0176
DEBUG - 2022-11-06 20:18:03 --> Total execution time: 0.0195
DEBUG - 2022-11-06 13:18:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:18:12 --> Total execution time: 0.0258
DEBUG - 2022-11-06 13:18:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 20:18:12 --> Total execution time: 0.0151
DEBUG - 2022-11-06 13:18:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:18:12 --> Total execution time: 0.0154
DEBUG - 2022-11-06 13:18:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:18:27 --> Total execution time: 0.0179
DEBUG - 2022-11-06 13:18:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:27 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:18:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:27 --> Total execution time: 0.0159
DEBUG - 2022-11-06 13:18:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:50 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:18:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:50 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 20:18:50 --> administrator
DEBUG - 2022-11-06 20:18:50 --> Total execution time: 0.0502
DEBUG - 2022-11-06 13:18:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:18:51 --> Total execution time: 0.3011
DEBUG - 2022-11-06 13:18:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:51 --> Total execution time: 0.0227
DEBUG - 2022-11-06 13:18:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:51 --> Total execution time: 0.0236
DEBUG - 2022-11-06 13:18:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:18:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:18:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:18:51 --> Total execution time: 0.1666
DEBUG - 2022-11-06 13:18:51 --> Total execution time: 0.1430
DEBUG - 2022-11-06 13:19:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:03 --> Total execution time: 0.3172
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0239
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0199
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0312
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0255
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0258
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0241
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0159
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0201
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0338
DEBUG - 2022-11-06 13:19:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0152
DEBUG - 2022-11-06 13:19:04 --> Total execution time: 0.0239
DEBUG - 2022-11-06 13:19:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:16 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:19:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:16 --> ssoValidateToken : {"status":true,"data":{"id_user":"790e57c6-891e-4224-9ff8-01ce9110bef8","username":"119587","nama":"SUKISWATI","telepon":"081282240418","email":"sukiswati66@gmail.com","nik":null,"nrk":"119587","passport":null},"message":""}
DEBUG - 2022-11-06 20:19:16 --> Total execution time: 0.1345
DEBUG - 2022-11-06 13:19:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:16 --> Total execution time: 0.0404
DEBUG - 2022-11-06 13:19:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:16 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:19:16 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:19:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:17 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:19:17 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:19:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:17 --> Total execution time: 0.0313
DEBUG - 2022-11-06 13:19:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:21 --> Total execution time: 0.0259
DEBUG - 2022-11-06 13:19:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 20:19:21 --> Total execution time: 0.0169
DEBUG - 2022-11-06 13:19:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:21 --> Total execution time: 0.0187
DEBUG - 2022-11-06 13:19:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:22 --> Total execution time: 0.0335
DEBUG - 2022-11-06 13:19:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:50 --> Total execution time: 0.0231
DEBUG - 2022-11-06 13:19:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:50 --> Total execution time: 0.0178
DEBUG - 2022-11-06 13:19:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:50 --> Total execution time: 0.0187
DEBUG - 2022-11-06 13:19:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:54 --> Total execution time: 0.3016
DEBUG - 2022-11-06 13:19:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:19:54 --> Total execution time: 0.0163
DEBUG - 2022-11-06 13:19:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:19:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:19:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:19:58 --> Total execution time: 0.3098
DEBUG - 2022-11-06 13:20:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:20:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:20:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:20:01 --> Total execution time: 0.0194
DEBUG - 2022-11-06 13:20:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:20:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:20:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 20:20:18 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 38
ERROR - 2022-11-06 20:20:18 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 87
ERROR - 2022-11-06 20:20:18 --> Severity: Notice --> Trying to get property 'msg' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 93
ERROR - 2022-11-06 20:20:18 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 38
ERROR - 2022-11-06 20:20:18 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 87
ERROR - 2022-11-06 20:20:18 --> Severity: Notice --> Trying to get property 'msg' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 93
DEBUG - 2022-11-06 20:20:18 --> Total execution time: 10.2087
DEBUG - 2022-11-06 13:22:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:02 --> Total execution time: 0.3049
DEBUG - 2022-11-06 13:22:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:22:03 --> Total execution time: 0.0156
DEBUG - 2022-11-06 13:22:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:05 --> Total execution time: 0.3046
DEBUG - 2022-11-06 13:22:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:14 --> Total execution time: 0.0237
DEBUG - 2022-11-06 13:22:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:14 --> Total execution time: 0.0165
DEBUG - 2022-11-06 13:22:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:14 --> Total execution time: 0.0184
DEBUG - 2022-11-06 13:22:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:16 --> Total execution time: 0.0479
DEBUG - 2022-11-06 13:22:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:22:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:16 --> Total execution time: 0.0175
DEBUG - 2022-11-06 20:22:16 --> Total execution time: 0.0209
DEBUG - 2022-11-06 13:22:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:27 --> Total execution time: 0.0220
DEBUG - 2022-11-06 13:22:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:22:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:27 --> Total execution time: 0.0162
DEBUG - 2022-11-06 20:22:27 --> Total execution time: 0.0240
DEBUG - 2022-11-06 13:22:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:27 --> Total execution time: 0.0225
DEBUG - 2022-11-06 13:22:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:28 --> Total execution time: 0.0176
DEBUG - 2022-11-06 13:22:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:44 --> Total execution time: 1.9265
DEBUG - 2022-11-06 13:22:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:46 --> Total execution time: 0.0204
DEBUG - 2022-11-06 13:22:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:46 --> Total execution time: 0.0182
DEBUG - 2022-11-06 13:22:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:51 --> Total execution time: 0.0214
DEBUG - 2022-11-06 13:22:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:22:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:51 --> Total execution time: 0.0184
DEBUG - 2022-11-06 20:22:51 --> Total execution time: 0.0213
DEBUG - 2022-11-06 13:22:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:51 --> Total execution time: 0.0212
DEBUG - 2022-11-06 13:22:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:22:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:57 --> Total execution time: 0.0173
DEBUG - 2022-11-06 20:22:57 --> Total execution time: 0.0263
DEBUG - 2022-11-06 13:22:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:22:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:22:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:22:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:22:59 --> Total execution time: 0.0261
DEBUG - 2022-11-06 20:22:59 --> Total execution time: 0.0318
DEBUG - 2022-11-06 13:23:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:23:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:23:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:23:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:23:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:23:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:23:04 --> Total execution time: 0.0195
DEBUG - 2022-11-06 20:23:04 --> Total execution time: 0.0228
DEBUG - 2022-11-06 13:24:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:12 --> Total execution time: 0.0194
DEBUG - 2022-11-06 13:24:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:24:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:12 --> Total execution time: 0.0160
DEBUG - 2022-11-06 20:24:12 --> Total execution time: 0.0246
DEBUG - 2022-11-06 13:24:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:12 --> Total execution time: 0.0204
DEBUG - 2022-11-06 13:24:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:16 --> Total execution time: 0.0193
DEBUG - 2022-11-06 13:24:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:24:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:16 --> Total execution time: 0.0180
DEBUG - 2022-11-06 20:24:16 --> Total execution time: 0.0206
DEBUG - 2022-11-06 13:24:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:16 --> Total execution time: 0.0201
DEBUG - 2022-11-06 13:24:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:17 --> Total execution time: 0.0186
DEBUG - 2022-11-06 13:24:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:29 --> Total execution time: 1.4996
DEBUG - 2022-11-06 13:24:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:31 --> Total execution time: 0.0210
DEBUG - 2022-11-06 13:24:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:31 --> Total execution time: 0.0174
DEBUG - 2022-11-06 13:24:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:34 --> Total execution time: 0.1239
DEBUG - 2022-11-06 13:24:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:24:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:24:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:24:51 --> Total execution time: 0.0203
DEBUG - 2022-11-06 13:33:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:33:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:33:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:33:39 --> Total execution time: 0.0225
DEBUG - 2022-11-06 13:33:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:33:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:33:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:33:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:33:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:33:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:33:39 --> Total execution time: 0.0184
DEBUG - 2022-11-06 20:33:39 --> Total execution time: 0.0204
DEBUG - 2022-11-06 13:33:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:33:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:33:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:33:39 --> Total execution time: 0.0192
DEBUG - 2022-11-06 13:33:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:33:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:33:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:33:41 --> Total execution time: 0.1309
DEBUG - 2022-11-06 13:33:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:33:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:33:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:33:54 --> Total execution time: 0.0257
DEBUG - 2022-11-06 13:35:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:35:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:35:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:35:07 --> Total execution time: 0.0225
DEBUG - 2022-11-06 13:35:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:35:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:35:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:35:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:35:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:35:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:35:07 --> Total execution time: 0.0167
DEBUG - 2022-11-06 20:35:07 --> Total execution time: 0.0193
DEBUG - 2022-11-06 13:35:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:35:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:35:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:35:07 --> Total execution time: 0.0214
DEBUG - 2022-11-06 13:35:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:35:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:35:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:35:09 --> Total execution time: 0.1405
DEBUG - 2022-11-06 13:35:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:35:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:35:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:35:48 --> Total execution time: 0.0238
DEBUG - 2022-11-06 13:35:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:35:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:35:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:00 --> Total execution time: 0.2978
DEBUG - 2022-11-06 13:36:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:05 --> Total execution time: 0.2953
DEBUG - 2022-11-06 13:36:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:36:05 --> Total execution time: 0.0157
DEBUG - 2022-11-06 13:36:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:34 --> Total execution time: 0.3132
DEBUG - 2022-11-06 13:36:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:43 --> Total execution time: 0.3042
DEBUG - 2022-11-06 13:36:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:36:43 --> Total execution time: 0.0148
DEBUG - 2022-11-06 13:36:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:51 --> Total execution time: 0.0245
DEBUG - 2022-11-06 13:36:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:52 --> Total execution time: 0.0146
DEBUG - 2022-11-06 13:36:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:52 --> Total execution time: 0.0175
DEBUG - 2022-11-06 13:36:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:36:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:36:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:36:54 --> Total execution time: 0.1557
DEBUG - 2022-11-06 13:37:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:37:18 --> Total execution time: 0.0213
DEBUG - 2022-11-06 13:37:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:18 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:37:18 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:37:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:18 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:37:18 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:37:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:37:18 --> Total execution time: 0.0157
DEBUG - 2022-11-06 13:37:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:37:18 --> Total execution time: 0.0188
DEBUG - 2022-11-06 13:37:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:37:24 --> Total execution time: 0.3392
DEBUG - 2022-11-06 13:37:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:37:25 --> Total execution time: 0.0414
DEBUG - 2022-11-06 13:37:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:37:25 --> Total execution time: 0.0391
DEBUG - 2022-11-06 13:37:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:37:34 --> Total execution time: 0.0189
DEBUG - 2022-11-06 13:37:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:37:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 20:37:34 --> Total execution time: 0.0166
DEBUG - 2022-11-06 13:37:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:37:34 --> Total execution time: 0.0267
DEBUG - 2022-11-06 13:37:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:37:35 --> Total execution time: 0.0192
DEBUG - 2022-11-06 13:37:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:37:47 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:37:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:37:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:37:47 --> Total execution time: 0.0212
DEBUG - 2022-11-06 13:38:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:24 --> Total execution time: 0.0180
DEBUG - 2022-11-06 13:38:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:33 --> Total execution time: 0.0172
DEBUG - 2022-11-06 13:38:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:36 --> Total execution time: 0.0182
DEBUG - 2022-11-06 13:38:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:46 --> Total execution time: 0.0196
DEBUG - 2022-11-06 13:38:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:46 --> Total execution time: 0.0177
DEBUG - 2022-11-06 13:38:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:46 --> Total execution time: 0.0202
DEBUG - 2022-11-06 13:38:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:46 --> Total execution time: 0.0198
DEBUG - 2022-11-06 13:38:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:38:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:38:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:38:48 --> Total execution time: 0.0182
DEBUG - 2022-11-06 13:39:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:39:02 --> Total execution time: 0.3017
DEBUG - 2022-11-06 13:39:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:39:02 --> Total execution time: 0.0143
DEBUG - 2022-11-06 13:39:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:39:10 --> Total execution time: 0.3077
DEBUG - 2022-11-06 13:39:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:39:13 --> Total execution time: 0.3331
DEBUG - 2022-11-06 13:39:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:39:13 --> Total execution time: 0.0145
DEBUG - 2022-11-06 13:39:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:39:16 --> Total execution time: 0.3247
DEBUG - 2022-11-06 13:39:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:39:18 --> Total execution time: 0.3009
DEBUG - 2022-11-06 13:39:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:39:18 --> Total execution time: 0.0163
DEBUG - 2022-11-06 13:39:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:39:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:39:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:39:59 --> Total execution time: 0.3110
DEBUG - 2022-11-06 13:40:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:25 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:40:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:25 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 20:40:25 --> administrator
DEBUG - 2022-11-06 20:40:25 --> Total execution time: 0.0566
DEBUG - 2022-11-06 13:40:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:40:26 --> Total execution time: 0.2932
DEBUG - 2022-11-06 13:40:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:26 --> Total execution time: 0.0218
DEBUG - 2022-11-06 13:40:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:26 --> Total execution time: 0.0224
DEBUG - 2022-11-06 13:40:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:26 --> Total execution time: 0.1531
DEBUG - 2022-11-06 13:40:27 --> Total execution time: 0.1554
DEBUG - 2022-11-06 13:40:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:40:36 --> Total execution time: 0.3550
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0203
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0179
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0252
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0226
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0209
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0179
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0156
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0179
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0153
DEBUG - 2022-11-06 13:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0152
DEBUG - 2022-11-06 13:40:37 --> Total execution time: 0.0321
DEBUG - 2022-11-06 13:48:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:48:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:48:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:48:52 --> Total execution time: 0.2939
DEBUG - 2022-11-06 13:48:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:48:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:48:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:48:52 --> Total execution time: 0.0151
DEBUG - 2022-11-06 13:48:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:48:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:48:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:48:58 --> Total execution time: 0.2992
DEBUG - 2022-11-06 13:49:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:49:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:49:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:49:05 --> Total execution time: 0.2955
DEBUG - 2022-11-06 13:50:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:50:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:50:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:50:08 --> Total execution time: 0.3274
DEBUG - 2022-11-06 13:50:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:50:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:50:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:50:34 --> Total execution time: 0.2905
DEBUG - 2022-11-06 13:50:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:50:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:50:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:50:35 --> Total execution time: 0.0150
DEBUG - 2022-11-06 13:50:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:50:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:50:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:50:40 --> Total execution time: 0.2970
DEBUG - 2022-11-06 13:50:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:50:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:50:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:51:00 --> Total execution time: 0.3325
DEBUG - 2022-11-06 13:51:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:51:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:51:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:51:00 --> Total execution time: 0.0163
DEBUG - 2022-11-06 13:51:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:51:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:51:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:51:09 --> Total execution time: 0.3236
DEBUG - 2022-11-06 13:52:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:11 --> Total execution time: 0.3225
DEBUG - 2022-11-06 13:52:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:16 --> Total execution time: 0.0237
DEBUG - 2022-11-06 13:52:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:52:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:17 --> Total execution time: 0.1179
DEBUG - 2022-11-06 20:52:18 --> Total execution time: 0.3972
DEBUG - 2022-11-06 13:52:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:25 --> Total execution time: 0.2940
DEBUG - 2022-11-06 13:52:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:52:26 --> Total execution time: 0.0147
DEBUG - 2022-11-06 13:52:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:30 --> Total execution time: 0.2965
DEBUG - 2022-11-06 13:52:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:46 --> Total execution time: 0.3011
DEBUG - 2022-11-06 13:52:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:52:47 --> Total execution time: 0.0147
DEBUG - 2022-11-06 13:52:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:50 --> Total execution time: 0.2910
DEBUG - 2022-11-06 13:52:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:55 --> Total execution time: 0.2839
DEBUG - 2022-11-06 13:52:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:52:55 --> Total execution time: 0.0143
DEBUG - 2022-11-06 13:52:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:52:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:52:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:52:59 --> Total execution time: 0.2841
DEBUG - 2022-11-06 13:53:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:53:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:53:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:53:04 --> Total execution time: 0.2925
DEBUG - 2022-11-06 13:53:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:53:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:53:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:53:05 --> Total execution time: 0.0148
DEBUG - 2022-11-06 13:53:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:53:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:53:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:53:12 --> Total execution time: 0.3071
DEBUG - 2022-11-06 13:53:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:53:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:53:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:53:58 --> Total execution time: 0.3085
DEBUG - 2022-11-06 13:53:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:53:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:53:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:53:59 --> Total execution time: 0.0148
DEBUG - 2022-11-06 13:54:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:54:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:54:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:54:16 --> Total execution time: 0.0298
DEBUG - 2022-11-06 13:54:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:54:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:54:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:54:18 --> Total execution time: 0.2908
DEBUG - 2022-11-06 13:54:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:54:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:54:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:54:19 --> Total execution time: 0.0142
DEBUG - 2022-11-06 13:54:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:54:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:54:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:54:34 --> Total execution time: 0.2941
DEBUG - 2022-11-06 13:54:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:54:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:54:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:54:36 --> Total execution time: 0.0194
DEBUG - 2022-11-06 13:54:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:54:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:54:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:54:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:54:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:54:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:54:37 --> Total execution time: 0.1200
DEBUG - 2022-11-06 20:54:37 --> Total execution time: 0.4195
DEBUG - 2022-11-06 13:55:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:55:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:55:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:55:08 --> Total execution time: 0.2953
DEBUG - 2022-11-06 13:55:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:55:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:55:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:55:08 --> Total execution time: 0.0143
DEBUG - 2022-11-06 13:55:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:55:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:55:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:55:53 --> Total execution time: 0.0215
DEBUG - 2022-11-06 13:55:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:55:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:55:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:55:54 --> Total execution time: 0.3063
DEBUG - 2022-11-06 13:55:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:55:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:55:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:55:55 --> Total execution time: 0.0147
DEBUG - 2022-11-06 13:56:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:00 --> Total execution time: 0.0228
DEBUG - 2022-11-06 13:56:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:02 --> Total execution time: 0.2980
DEBUG - 2022-11-06 13:56:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:56:02 --> Total execution time: 0.0153
DEBUG - 2022-11-06 13:56:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:08 --> Total execution time: 0.0263
DEBUG - 2022-11-06 13:56:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:08 --> Total execution time: 0.0204
DEBUG - 2022-11-06 13:56:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:08 --> Total execution time: 0.0166
DEBUG - 2022-11-06 13:56:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:10 --> Total execution time: 0.0188
DEBUG - 2022-11-06 13:56:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:10 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:56:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:56:10 --> Total execution time: 0.0179
DEBUG - 2022-11-06 13:56:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:21 --> No URI present. Default controller set.
DEBUG - 2022-11-06 13:56:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:56:21 --> ssoValidateToken : {"status":true,"data":{"id_user":"ef645ec9-116f-4b78-afb7-9faaf8a641f3","username":"181803","nama":"SYAIFUL BAHRI","telepon":"085718439607","email":"syaifulbahri1987@gmail.com","nik":null,"nrk":"181803","passport":null},"message":""}
DEBUG - 2022-11-06 20:56:21 --> Total execution time: 0.0637
DEBUG - 2022-11-06 13:56:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:21 --> Total execution time: 0.0843
DEBUG - 2022-11-06 13:56:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:22 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:56:22 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:56:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:22 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 13:56:22 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 13:56:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:23 --> Total execution time: 0.0314
DEBUG - 2022-11-06 13:56:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:25 --> Total execution time: 0.0212
DEBUG - 2022-11-06 13:56:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:26 --> Total execution time: 0.0155
DEBUG - 2022-11-06 13:56:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:26 --> Total execution time: 0.0160
DEBUG - 2022-11-06 13:56:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:27 --> Total execution time: 0.0285
DEBUG - 2022-11-06 13:56:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:56:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:34 --> Total execution time: 0.0246
DEBUG - 2022-11-06 13:56:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:35 --> Total execution time: 0.0152
DEBUG - 2022-11-06 13:56:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:35 --> Total execution time: 0.0171
DEBUG - 2022-11-06 13:56:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:41 --> Total execution time: 0.2918
DEBUG - 2022-11-06 13:56:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 13:56:41 --> Total execution time: 0.0151
DEBUG - 2022-11-06 13:56:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 13:56:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 13:56:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 20:56:44 --> Total execution time: 0.3103
DEBUG - 2022-11-06 14:00:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:25 --> Total execution time: 0.0194
DEBUG - 2022-11-06 14:00:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:39 --> Total execution time: 0.0207
DEBUG - 2022-11-06 14:00:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:39 --> Total execution time: 0.0239
DEBUG - 2022-11-06 21:00:39 --> Total execution time: 0.0256
DEBUG - 2022-11-06 14:00:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:39 --> Total execution time: 0.0198
DEBUG - 2022-11-06 14:00:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:42 --> Total execution time: 0.0175
DEBUG - 2022-11-06 14:00:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:51 --> Total execution time: 1.3103
DEBUG - 2022-11-06 14:00:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:53 --> Total execution time: 0.3304
DEBUG - 2022-11-06 14:00:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:56 --> Total execution time: 0.0199
DEBUG - 2022-11-06 14:00:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:00:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:00:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:00:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:00:58 --> Total execution time: 0.2986
DEBUG - 2022-11-06 21:00:58 --> Total execution time: 0.4245
DEBUG - 2022-11-06 14:01:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:01:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:01:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:01:23 --> Total execution time: 0.0369
DEBUG - 2022-11-06 14:01:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:01:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:01:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:01:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:01:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:01:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:01:35 --> Total execution time: 0.0347
DEBUG - 2022-11-06 14:01:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:01:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:01:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:01:35 --> Total execution time: 0.0156
DEBUG - 2022-11-06 14:01:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:01:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:01:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:01:36 --> Total execution time: 0.0187
DEBUG - 2022-11-06 14:01:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:01:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:01:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:01:41 --> Total execution time: 0.1455
DEBUG - 2022-11-06 14:02:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:01 --> Total execution time: 0.3182
DEBUG - 2022-11-06 14:02:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:02:02 --> Total execution time: 0.0154
DEBUG - 2022-11-06 14:02:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:04 --> Total execution time: 0.3010
DEBUG - 2022-11-06 14:02:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:07 --> Total execution time: 0.0182
DEBUG - 2022-11-06 14:02:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 21:02:16 --> Severity: Notice --> Undefined property: stdClass::$telepon /var/www/html/si-adik/application/libraries/Func_wa_sk.php 650
ERROR - 2022-11-06 21:02:16 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 87
ERROR - 2022-11-06 21:02:16 --> Severity: Notice --> Trying to get property 'msg' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 93
ERROR - 2022-11-06 21:02:16 --> Severity: Notice --> Undefined property: stdClass::$email /var/www/html/si-adik/application/libraries/Func_wa_sk.php 656
ERROR - 2022-11-06 21:02:17 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/send_email_helper.php 52
ERROR - 2022-11-06 21:02:17 --> Severity: Notice --> Trying to get property 'msg' of non-object /var/www/html/si-adik/application/helpers/send_email_helper.php 58
DEBUG - 2022-11-06 21:02:17 --> Total execution time: 0.9941
DEBUG - 2022-11-06 14:02:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:45 --> Total execution time: 0.0259
DEBUG - 2022-11-06 14:02:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:46 --> Total execution time: 0.0189
DEBUG - 2022-11-06 14:02:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:46 --> Total execution time: 0.0145
DEBUG - 2022-11-06 14:02:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:50 --> Total execution time: 0.3059
DEBUG - 2022-11-06 14:02:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:02:51 --> Total execution time: 0.0157
DEBUG - 2022-11-06 14:02:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:55 --> Total execution time: 0.0203
DEBUG - 2022-11-06 14:02:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:02:56 --> Total execution time: 0.2907
DEBUG - 2022-11-06 14:02:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:02:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:02:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:02:57 --> Total execution time: 0.0148
DEBUG - 2022-11-06 14:03:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:03:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:03:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:03:02 --> Total execution time: 0.0262
DEBUG - 2022-11-06 14:03:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:03:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:03:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:03:02 --> Total execution time: 0.0176
DEBUG - 2022-11-06 14:03:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:03:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:03:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:03:02 --> Total execution time: 0.0153
DEBUG - 2022-11-06 14:03:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:03:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:03:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:03:02 --> Total execution time: 0.0356
DEBUG - 2022-11-06 14:04:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:04:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:04:12 --> Total execution time: 0.0292
DEBUG - 2022-11-06 14:04:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:04:12 --> Total execution time: 0.0237
DEBUG - 2022-11-06 14:04:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:04:12 --> Total execution time: 0.0151
DEBUG - 2022-11-06 14:04:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:04:17 --> Total execution time: 0.3136
DEBUG - 2022-11-06 14:04:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:04:19 --> Total execution time: 0.0150
DEBUG - 2022-11-06 14:04:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:04:21 --> Total execution time: 0.3018
DEBUG - 2022-11-06 14:04:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:04:24 --> Total execution time: 0.0184
DEBUG - 2022-11-06 14:04:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:04:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:04:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 21:04:31 --> Severity: Notice --> Undefined property: stdClass::$telepon /var/www/html/si-adik/application/libraries/Func_wa_sk.php 650
ERROR - 2022-11-06 21:04:31 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 87
ERROR - 2022-11-06 21:04:31 --> Severity: Notice --> Trying to get property 'msg' of non-object /var/www/html/si-adik/application/helpers/wa_helper.php 93
ERROR - 2022-11-06 21:04:31 --> Severity: Notice --> Undefined property: stdClass::$email /var/www/html/si-adik/application/libraries/Func_wa_sk.php 656
ERROR - 2022-11-06 21:04:31 --> Severity: Notice --> Trying to get property 'status' of non-object /var/www/html/si-adik/application/helpers/send_email_helper.php 52
ERROR - 2022-11-06 21:04:31 --> Severity: Notice --> Trying to get property 'msg' of non-object /var/www/html/si-adik/application/helpers/send_email_helper.php 58
DEBUG - 2022-11-06 21:04:31 --> Total execution time: 1.1339
DEBUG - 2022-11-06 14:11:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:11:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:11:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:11:54 --> Total execution time: 0.0244
DEBUG - 2022-11-06 14:12:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:12:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:12:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:12:22 --> Total execution time: 0.0232
DEBUG - 2022-11-06 14:19:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:19:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:19:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:19:49 --> Total execution time: 0.3236
DEBUG - 2022-11-06 14:19:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:19:58 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 14:19:58 --> 404 Page Not Found: admin/Surat_keterangan/admin
DEBUG - 2022-11-06 14:20:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:04 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 14:20:04 --> 404 Page Not Found: admin/Surat_keterangan/admin
DEBUG - 2022-11-06 14:20:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:08 --> Total execution time: 0.2974
DEBUG - 2022-11-06 14:20:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:13 --> Total execution time: 0.0234
DEBUG - 2022-11-06 14:20:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:13 --> No URI present. Default controller set.
DEBUG - 2022-11-06 14:20:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:13 --> Total execution time: 0.0185
DEBUG - 2022-11-06 14:20:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:26 --> No URI present. Default controller set.
DEBUG - 2022-11-06 14:20:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:26 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 21:20:26 --> administrator
DEBUG - 2022-11-06 21:20:26 --> Total execution time: 0.0492
DEBUG - 2022-11-06 14:20:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:26 --> Total execution time: 0.2946
DEBUG - 2022-11-06 14:20:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:27 --> Total execution time: 0.0234
DEBUG - 2022-11-06 14:20:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:27 --> Total execution time: 0.0279
DEBUG - 2022-11-06 14:20:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:27 --> Total execution time: 0.2057
DEBUG - 2022-11-06 14:20:27 --> Total execution time: 0.1993
DEBUG - 2022-11-06 14:20:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:30 --> Total execution time: 0.3144
DEBUG - 2022-11-06 14:20:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:30 --> Total execution time: 0.0155
DEBUG - 2022-11-06 14:20:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:35 --> Total execution time: 0.0215
DEBUG - 2022-11-06 14:20:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:36 --> Total execution time: 0.2959
DEBUG - 2022-11-06 14:20:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:37 --> Total execution time: 0.0148
DEBUG - 2022-11-06 14:20:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:45 --> Total execution time: 0.0237
DEBUG - 2022-11-06 14:20:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:46 --> Total execution time: 0.0161
DEBUG - 2022-11-06 14:20:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:46 --> Total execution time: 0.0172
DEBUG - 2022-11-06 14:20:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:49 --> Total execution time: 0.0358
DEBUG - 2022-11-06 14:20:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:20:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:54 --> Total execution time: 0.0222
DEBUG - 2022-11-06 14:20:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:56 --> Total execution time: 0.0176
DEBUG - 2022-11-06 14:20:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:20:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:20:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:20:56 --> Total execution time: 0.0234
DEBUG - 2022-11-06 14:21:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:06 --> Total execution time: 0.3100
DEBUG - 2022-11-06 14:21:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:21:07 --> Total execution time: 0.0155
DEBUG - 2022-11-06 14:21:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:09 --> Total execution time: 0.3180
DEBUG - 2022-11-06 14:21:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:11 --> Total execution time: 0.0250
DEBUG - 2022-11-06 14:21:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:19 --> Total execution time: 1.3391
DEBUG - 2022-11-06 14:21:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:21 --> Total execution time: 0.2934
DEBUG - 2022-11-06 14:21:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:24 --> Total execution time: 0.0272
DEBUG - 2022-11-06 14:21:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:25 --> Total execution time: 0.0152
DEBUG - 2022-11-06 14:21:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:25 --> Total execution time: 0.0171
DEBUG - 2022-11-06 14:21:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:29 --> Total execution time: 0.3534
DEBUG - 2022-11-06 14:21:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:21:30 --> Total execution time: 0.0184
DEBUG - 2022-11-06 14:21:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:36 --> Total execution time: 0.0210
DEBUG - 2022-11-06 14:21:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:38 --> Total execution time: 0.3568
DEBUG - 2022-11-06 14:21:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:21:38 --> Total execution time: 0.0190
DEBUG - 2022-11-06 14:21:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:42 --> Total execution time: 0.0237
DEBUG - 2022-11-06 14:21:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:43 --> Total execution time: 0.2968
DEBUG - 2022-11-06 14:21:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:21:44 --> Total execution time: 0.0143
DEBUG - 2022-11-06 14:21:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:21:48 --> Total execution time: 0.0260
DEBUG - 2022-11-06 14:21:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:21:48 --> No URI present. Default controller set.
DEBUG - 2022-11-06 14:21:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:21:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:21:48 --> Total execution time: 0.0237
DEBUG - 2022-11-06 14:22:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:05 --> No URI present. Default controller set.
DEBUG - 2022-11-06 14:22:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:22:05 --> ssoValidateToken : {"status":true,"data":{"id_user":"33eeee17-53c7-42ef-9d82-d113b471a97b","username":"195698","nama":"MUHAMMAD FAHMI","telepon":"0811112024","email":"fahmimhd86@gmail.com","nik":null,"nrk":"195698","passport":null},"message":""}
DEBUG - 2022-11-06 21:22:05 --> Total execution time: 0.0487
DEBUG - 2022-11-06 14:22:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:05 --> Total execution time: 0.0784
DEBUG - 2022-11-06 14:22:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:05 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 14:22:05 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 14:22:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:06 --> Total execution time: 0.0336
DEBUG - 2022-11-06 14:22:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:47 --> Total execution time: 0.0219
DEBUG - 2022-11-06 14:22:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:47 --> Total execution time: 0.0172
DEBUG - 2022-11-06 14:22:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:47 --> Total execution time: 0.0152
DEBUG - 2022-11-06 14:22:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:49 --> Total execution time: 0.0330
DEBUG - 2022-11-06 14:22:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:49 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 14:22:49 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 14:22:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:49 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 14:22:49 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 14:22:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:49 --> Total execution time: 0.0353
DEBUG - 2022-11-06 14:22:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:57 --> Total execution time: 0.0301
DEBUG - 2022-11-06 14:22:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:57 --> Total execution time: 0.0182
DEBUG - 2022-11-06 14:22:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:57 --> Total execution time: 0.0157
DEBUG - 2022-11-06 14:22:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:22:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:22:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:22:58 --> Total execution time: 0.0291
DEBUG - 2022-11-06 14:23:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:23:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:23:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:23:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:23:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:23:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:23:04 --> Total execution time: 0.0240
DEBUG - 2022-11-06 14:23:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:23:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:23:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:23:05 --> Total execution time: 0.0152
DEBUG - 2022-11-06 14:23:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:23:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:23:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:23:05 --> Total execution time: 0.0176
DEBUG - 2022-11-06 14:25:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:24 --> Total execution time: 0.0219
DEBUG - 2022-11-06 14:25:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:25:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:24 --> Total execution time: 0.0190
DEBUG - 2022-11-06 21:25:24 --> Total execution time: 0.0206
DEBUG - 2022-11-06 14:25:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:24 --> Total execution time: 0.0219
DEBUG - 2022-11-06 14:25:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:35 --> Total execution time: 0.3059
DEBUG - 2022-11-06 14:25:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:25:35 --> Total execution time: 0.0218
DEBUG - 2022-11-06 14:25:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:37 --> Total execution time: 0.3404
DEBUG - 2022-11-06 14:25:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:40 --> Total execution time: 0.0180
DEBUG - 2022-11-06 14:25:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:49 --> Total execution time: 3.1711
DEBUG - 2022-11-06 14:25:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:51 --> Total execution time: 0.2969
DEBUG - 2022-11-06 14:25:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:55 --> Total execution time: 0.0212
DEBUG - 2022-11-06 14:25:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:55 --> Total execution time: 0.0176
DEBUG - 2022-11-06 14:25:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:55 --> Total execution time: 0.0216
DEBUG - 2022-11-06 14:25:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:56 --> Total execution time: 0.0233
DEBUG - 2022-11-06 14:25:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:25:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:25:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:25:57 --> Total execution time: 0.0177
DEBUG - 2022-11-06 14:26:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:04 --> Total execution time: 1.9483
DEBUG - 2022-11-06 14:26:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:06 --> Total execution time: 0.0200
DEBUG - 2022-11-06 14:26:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:06 --> Total execution time: 0.0175
DEBUG - 2022-11-06 14:26:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:30 --> Total execution time: 0.0165
DEBUG - 2022-11-06 14:26:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:31 --> No URI present. Default controller set.
DEBUG - 2022-11-06 14:26:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:26:31 --> Total execution time: 0.0159
DEBUG - 2022-11-06 14:26:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:48 --> No URI present. Default controller set.
DEBUG - 2022-11-06 14:26:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:26:48 --> ssoValidateToken : {"status":true,"data":{"id_user":"275c5982-4ee4-43b4-902b-d3256ca6c716","username":"124621","nama":"WIWIT DJALU ADJI","telepon":"081315170289","email":"djalu74@gmail.com","nik":null,"nrk":"124621","passport":null},"message":""}
DEBUG - 2022-11-06 21:26:48 --> Total execution time: 0.1282
DEBUG - 2022-11-06 14:26:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:48 --> Total execution time: 0.0945
DEBUG - 2022-11-06 14:26:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:48 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 14:26:48 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 14:26:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:48 --> Total execution time: 0.0323
DEBUG - 2022-11-06 14:26:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:51 --> Total execution time: 0.0191
DEBUG - 2022-11-06 14:26:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:26:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:51 --> Total execution time: 0.0181
DEBUG - 2022-11-06 21:26:51 --> Total execution time: 0.0208
DEBUG - 2022-11-06 14:26:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:51 --> Total execution time: 0.0201
DEBUG - 2022-11-06 14:26:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:26:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:26:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:26:52 --> Total execution time: 0.0194
DEBUG - 2022-11-06 14:27:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:27:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:27:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:27:02 --> Total execution time: 1.2488
DEBUG - 2022-11-06 14:27:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:27:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:27:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:27:05 --> Total execution time: 0.0192
DEBUG - 2022-11-06 14:27:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:27:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:27:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:27:05 --> Total execution time: 0.0172
DEBUG - 2022-11-06 14:27:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:27:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:27:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:27:07 --> Total execution time: 0.1247
DEBUG - 2022-11-06 14:32:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:18 --> Total execution time: 0.3068
DEBUG - 2022-11-06 14:32:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:32:18 --> Total execution time: 0.0154
DEBUG - 2022-11-06 14:32:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:22 --> Total execution time: 0.0223
DEBUG - 2022-11-06 14:32:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:23 --> Total execution time: 0.2917
DEBUG - 2022-11-06 14:32:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:32:24 --> Total execution time: 0.0151
DEBUG - 2022-11-06 14:32:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:36 --> Total execution time: 0.0242
DEBUG - 2022-11-06 14:32:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:36 --> Total execution time: 0.0186
DEBUG - 2022-11-06 14:32:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:36 --> Total execution time: 0.0188
DEBUG - 2022-11-06 14:32:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:36 --> Total execution time: 0.0355
DEBUG - 2022-11-06 14:32:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:32:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:42 --> Total execution time: 0.0230
DEBUG - 2022-11-06 14:32:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:42 --> Total execution time: 0.0195
DEBUG - 2022-11-06 14:32:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:32:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:32:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:32:42 --> Total execution time: 0.0197
DEBUG - 2022-11-06 14:34:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:34:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:34:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:34:04 --> Total execution time: 0.2934
DEBUG - 2022-11-06 14:34:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:34:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:34:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:34:16 --> Total execution time: 0.3039
DEBUG - 2022-11-06 14:34:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:34:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:34:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:34:16 --> Total execution time: 0.0146
DEBUG - 2022-11-06 14:34:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:34:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:34:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:34:18 --> Total execution time: 0.3043
DEBUG - 2022-11-06 14:34:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:34:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:34:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:34:20 --> Total execution time: 0.0249
DEBUG - 2022-11-06 14:34:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:34:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:34:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:34:28 --> Total execution time: 4.6151
DEBUG - 2022-11-06 14:34:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:34:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:34:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:34:30 --> Total execution time: 0.3039
DEBUG - 2022-11-06 14:35:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:35:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:35:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:35:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:35:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:35:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:35:54 --> Total execution time: 0.0186
DEBUG - 2022-11-06 21:35:54 --> Total execution time: 0.0268
DEBUG - 2022-11-06 14:35:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:35:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:35:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:35:56 --> Total execution time: 0.0206
DEBUG - 2022-11-06 14:35:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:35:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:35:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:35:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:35:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:35:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:35:57 --> Total execution time: 0.0161
DEBUG - 2022-11-06 21:35:57 --> Total execution time: 0.0263
DEBUG - 2022-11-06 14:35:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:35:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:35:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:35:57 --> Total execution time: 0.0218
DEBUG - 2022-11-06 14:35:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:35:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:35:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:35:58 --> Total execution time: 0.0185
DEBUG - 2022-11-06 14:36:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:36:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:36:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:36:15 --> Total execution time: 1.9096
DEBUG - 2022-11-06 14:36:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:36:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:36:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:36:16 --> Total execution time: 0.0205
DEBUG - 2022-11-06 14:36:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:36:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:36:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:36:17 --> Total execution time: 0.0177
DEBUG - 2022-11-06 14:36:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:36:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:36:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:36:23 --> Total execution time: 0.0263
DEBUG - 2022-11-06 14:36:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:36:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:36:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:36:23 --> Total execution time: 0.0171
DEBUG - 2022-11-06 14:36:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:36:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:36:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:36:23 --> Total execution time: 0.0152
DEBUG - 2022-11-06 14:38:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 14:38:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 14:38:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 14:38:48 --> Total execution time: 0.0409
DEBUG - 2022-11-06 21:41:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:41:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:41:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:41:30 --> Total execution time: 0.2944
DEBUG - 2022-11-06 21:41:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:41:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:41:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:41:31 --> Total execution time: 0.0161
DEBUG - 2022-11-06 21:41:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:41:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:41:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:41:33 --> Total execution time: 0.2937
DEBUG - 2022-11-06 21:41:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:41:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:41:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:41:48 --> Total execution time: 0.2991
DEBUG - 2022-11-06 21:41:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:41:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:41:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:41:48 --> Total execution time: 0.0148
DEBUG - 2022-11-06 21:42:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:30 --> Total execution time: 0.3104
DEBUG - 2022-11-06 21:42:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:31 --> Total execution time: 0.1923
DEBUG - 2022-11-06 21:42:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:36 --> Total execution time: 0.3071
DEBUG - 2022-11-06 21:42:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:37 --> Total execution time: 0.0150
DEBUG - 2022-11-06 21:42:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:42 --> Total execution time: 0.0215
DEBUG - 2022-11-06 21:42:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:43 --> Total execution time: 0.2879
DEBUG - 2022-11-06 21:42:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:43 --> Total execution time: 0.0150
DEBUG - 2022-11-06 21:42:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:45 --> Total execution time: 0.0320
DEBUG - 2022-11-06 21:42:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:46 --> Total execution time: 0.0176
DEBUG - 2022-11-06 21:42:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:46 --> Total execution time: 0.0160
DEBUG - 2022-11-06 21:42:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:46 --> Total execution time: 0.0502
DEBUG - 2022-11-06 21:42:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:52 --> Total execution time: 0.0243
DEBUG - 2022-11-06 21:42:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:53 --> Total execution time: 0.0152
DEBUG - 2022-11-06 21:42:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:42:53 --> Total execution time: 0.0212
DEBUG - 2022-11-06 21:42:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:42:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:42:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:43:00 --> Total execution time: 0.3017
DEBUG - 2022-11-06 21:43:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:43:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:43:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:43:00 --> Total execution time: 0.0152
DEBUG - 2022-11-06 21:43:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:43:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:43:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:43:03 --> Total execution time: 0.2953
DEBUG - 2022-11-06 21:46:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:02 --> Total execution time: 0.3814
DEBUG - 2022-11-06 21:46:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:12 --> Total execution time: 0.0179
DEBUG - 2022-11-06 21:46:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:20 --> Total execution time: 3.1181
DEBUG - 2022-11-06 21:46:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:21 --> Total execution time: 0.2956
DEBUG - 2022-11-06 21:46:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:27 --> Total execution time: 0.0344
DEBUG - 2022-11-06 21:46:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:27 --> Total execution time: 0.0155
DEBUG - 2022-11-06 21:46:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:27 --> Total execution time: 0.0173
DEBUG - 2022-11-06 21:46:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:33 --> Total execution time: 0.0204
DEBUG - 2022-11-06 21:46:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:34 --> Total execution time: 0.0168
DEBUG - 2022-11-06 21:46:34 --> Total execution time: 0.0206
DEBUG - 2022-11-06 21:46:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:34 --> Total execution time: 0.0184
DEBUG - 2022-11-06 21:46:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:35 --> Total execution time: 0.0169
DEBUG - 2022-11-06 21:46:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:41 --> Total execution time: 1.9301
DEBUG - 2022-11-06 21:46:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:46:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:46:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:46:43 --> Total execution time: 0.0177
DEBUG - 2022-11-06 21:46:43 --> Total execution time: 0.0264
DEBUG - 2022-11-06 21:47:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:47:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:47:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:47:17 --> Total execution time: 0.0406
DEBUG - 2022-11-06 21:48:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:01 --> Total execution time: 0.3067
DEBUG - 2022-11-06 21:48:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:02 --> Total execution time: 0.0144
DEBUG - 2022-11-06 21:48:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:06 --> Total execution time: 0.0227
DEBUG - 2022-11-06 21:48:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:09 --> Total execution time: 0.2984
DEBUG - 2022-11-06 21:48:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:10 --> Total execution time: 0.0151
DEBUG - 2022-11-06 21:48:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:14 --> Total execution time: 0.0238
DEBUG - 2022-11-06 21:48:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:15 --> Total execution time: 0.0175
DEBUG - 2022-11-06 21:48:15 --> Total execution time: 0.0195
DEBUG - 2022-11-06 21:48:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:16 --> Total execution time: 0.0349
DEBUG - 2022-11-06 21:48:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:21 --> Total execution time: 0.0226
DEBUG - 2022-11-06 21:48:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:21 --> Total execution time: 0.0158
DEBUG - 2022-11-06 21:48:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:21 --> Total execution time: 0.0176
DEBUG - 2022-11-06 21:48:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:27 --> Total execution time: 0.2948
DEBUG - 2022-11-06 21:48:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:27 --> Total execution time: 0.0258
DEBUG - 2022-11-06 21:48:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:29 --> Total execution time: 0.3053
DEBUG - 2022-11-06 21:48:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:30 --> Total execution time: 0.0176
DEBUG - 2022-11-06 21:48:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:44 --> Total execution time: 3.1114
DEBUG - 2022-11-06 21:48:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:48:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:48:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:48:45 --> Total execution time: 0.2953
DEBUG - 2022-11-06 21:58:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:45 --> Total execution time: 0.0272
DEBUG - 2022-11-06 21:58:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:46 --> Total execution time: 0.0191
DEBUG - 2022-11-06 21:58:46 --> Total execution time: 0.0233
DEBUG - 2022-11-06 21:58:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:46 --> Total execution time: 0.0201
DEBUG - 2022-11-06 21:58:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:47 --> Total execution time: 0.0202
DEBUG - 2022-11-06 21:58:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:55 --> Total execution time: 1.9249
DEBUG - 2022-11-06 21:58:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:56 --> Total execution time: 0.0204
DEBUG - 2022-11-06 21:58:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:58:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:58:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:58:56 --> Total execution time: 0.0178
DEBUG - 2022-11-06 21:59:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:30 --> Total execution time: 0.0189
DEBUG - 2022-11-06 21:59:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:30 --> No URI present. Default controller set.
DEBUG - 2022-11-06 21:59:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:30 --> Total execution time: 0.0176
DEBUG - 2022-11-06 21:59:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:48 --> No URI present. Default controller set.
DEBUG - 2022-11-06 21:59:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:48 --> ssoValidateToken : {"status":true,"data":{"id_user":"275c5982-4ee4-43b4-902b-d3256ca6c716","username":"124621","nama":"WIWIT DJALU ADJI","telepon":"081315170289","email":"djalu74@gmail.com","nik":null,"nrk":"124621","passport":null},"message":""}
DEBUG - 2022-11-06 21:59:48 --> Total execution time: 0.0503
DEBUG - 2022-11-06 21:59:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:48 --> Total execution time: 0.0931
DEBUG - 2022-11-06 21:59:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:49 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 21:59:49 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 21:59:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:49 --> Total execution time: 0.0309
DEBUG - 2022-11-06 21:59:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:52 --> Total execution time: 0.0204
DEBUG - 2022-11-06 21:59:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:53 --> Total execution time: 0.0181
DEBUG - 2022-11-06 21:59:53 --> Total execution time: 0.0214
DEBUG - 2022-11-06 21:59:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:53 --> Total execution time: 0.0192
DEBUG - 2022-11-06 21:59:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 21:59:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 21:59:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 21:59:55 --> Total execution time: 0.0181
DEBUG - 2022-11-06 22:00:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:03 --> Total execution time: 2.2226
DEBUG - 2022-11-06 22:00:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:05 --> Total execution time: 0.0246
DEBUG - 2022-11-06 22:00:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:05 --> Total execution time: 0.0175
DEBUG - 2022-11-06 22:00:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:10 --> Total execution time: 0.0230
DEBUG - 2022-11-06 22:00:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:10 --> Total execution time: 0.0228
DEBUG - 2022-11-06 22:00:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:11 --> Total execution time: 0.0190
DEBUG - 2022-11-06 22:00:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:15 --> Total execution time: 0.0445
DEBUG - 2022-11-06 22:00:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:17 --> Total execution time: 0.3645
DEBUG - 2022-11-06 22:00:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:22 --> Total execution time: 0.0185
DEBUG - 2022-11-06 22:00:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:22 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:00:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:22 --> Total execution time: 0.0145
DEBUG - 2022-11-06 22:00:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:31 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:00:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:31 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 22:00:31 --> administrator
DEBUG - 2022-11-06 22:00:31 --> Total execution time: 0.0470
DEBUG - 2022-11-06 22:00:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:32 --> Total execution time: 0.2922
DEBUG - 2022-11-06 22:00:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:32 --> Total execution time: 0.0223
DEBUG - 2022-11-06 22:00:32 --> Total execution time: 0.0291
DEBUG - 2022-11-06 22:00:32 --> Total execution time: 0.1865
DEBUG - 2022-11-06 22:00:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:32 --> Total execution time: 0.0268
DEBUG - 2022-11-06 22:00:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:35 --> Total execution time: 0.3357
DEBUG - 2022-11-06 22:00:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:36 --> Total execution time: 0.0258
DEBUG - 2022-11-06 22:00:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:37 --> Total execution time: 0.3115
DEBUG - 2022-11-06 22:00:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:42 --> Total execution time: 0.0203
DEBUG - 2022-11-06 22:00:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:00:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:00:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:00:43 --> Total execution time: 0.1188
DEBUG - 2022-11-06 22:00:44 --> Total execution time: 0.3896
DEBUG - 2022-11-06 22:01:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:01:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:01:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:01:53 --> Total execution time: 2.5250
DEBUG - 2022-11-06 22:01:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:01:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:01:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:01:55 --> Total execution time: 0.2973
DEBUG - 2022-11-06 22:05:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:18 --> Total execution time: 0.3046
DEBUG - 2022-11-06 22:05:18 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:18 --> Total execution time: 0.0157
DEBUG - 2022-11-06 22:05:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:24 --> Total execution time: 0.0226
DEBUG - 2022-11-06 22:05:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:25 --> Total execution time: 0.2904
DEBUG - 2022-11-06 22:05:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:25 --> Total execution time: 0.0147
DEBUG - 2022-11-06 22:05:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:38 --> Total execution time: 0.0193
DEBUG - 2022-11-06 22:05:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:38 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:05:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:38 --> Total execution time: 0.0166
DEBUG - 2022-11-06 22:05:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:46 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:05:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:46 --> ssoValidateToken : {"status":true,"data":{"id_user":"feeb94c4-2a1c-4d05-aa68-792f93d7c8de","username":"202695","nama":"FATHIA SABILA","telepon":"081319584488","email":"fthsabila@gmail.com","nik":null,"nrk":"202695","passport":null},"message":""}
DEBUG - 2022-11-06 22:05:46 --> Total execution time: 0.0481
DEBUG - 2022-11-06 22:05:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:46 --> Total execution time: 0.0835
DEBUG - 2022-11-06 22:05:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:46 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:05:46 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 22:05:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:46 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:05:46 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 22:05:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:46 --> Total execution time: 0.0369
DEBUG - 2022-11-06 22:05:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:56 --> Total execution time: 0.0223
DEBUG - 2022-11-06 22:05:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:57 --> Total execution time: 0.0174
DEBUG - 2022-11-06 22:05:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:57 --> Total execution time: 0.0158
DEBUG - 2022-11-06 22:05:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:05:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:05:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:05:58 --> Total execution time: 0.0304
DEBUG - 2022-11-06 22:06:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:06:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:06:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:06:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:06:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:06:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:06:06 --> Total execution time: 0.0232
DEBUG - 2022-11-06 22:06:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:06:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:06:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:06:07 --> Total execution time: 0.0181
DEBUG - 2022-11-06 22:06:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:06:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:06:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:06:07 --> Total execution time: 0.0213
DEBUG - 2022-11-06 22:06:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:06:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:06:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:06:15 --> Total execution time: 0.3015
DEBUG - 2022-11-06 22:06:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:06:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:06:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:06:15 --> Total execution time: 0.0218
DEBUG - 2022-11-06 22:07:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:07:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:07:53 --> Total execution time: 0.3006
DEBUG - 2022-11-06 22:07:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:07:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:07:54 --> Total execution time: 0.0211
DEBUG - 2022-11-06 22:07:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:07:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:07:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:07:55 --> Total execution time: 0.2977
DEBUG - 2022-11-06 22:07:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:07:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:07:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:07:57 --> Total execution time: 0.0191
DEBUG - 2022-11-06 22:08:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:08:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:08:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:08:05 --> Total execution time: 3.4266
DEBUG - 2022-11-06 22:08:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:08:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:08:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:08:07 --> Total execution time: 0.3346
DEBUG - 2022-11-06 22:10:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:10:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:10:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:10:48 --> Total execution time: 0.0230
DEBUG - 2022-11-06 22:10:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:10:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:10:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:10:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:10:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:10:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:10:49 --> Total execution time: 0.0175
DEBUG - 2022-11-06 22:10:49 --> Total execution time: 0.0209
DEBUG - 2022-11-06 22:10:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:10:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:10:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:10:49 --> Total execution time: 0.0193
DEBUG - 2022-11-06 22:10:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:10:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:10:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:10:50 --> Total execution time: 0.0182
DEBUG - 2022-11-06 22:10:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:10:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:10:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:10:56 --> Total execution time: 1.9226
DEBUG - 2022-11-06 22:11:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:11:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:11:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:11:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:11:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:11:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:11:03 --> Total execution time: 0.0177
DEBUG - 2022-11-06 22:11:03 --> Total execution time: 0.0255
DEBUG - 2022-11-06 22:12:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:21 --> Total execution time: 0.0214
DEBUG - 2022-11-06 22:12:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:21 --> Total execution time: 0.0165
DEBUG - 2022-11-06 22:12:21 --> Total execution time: 0.0232
DEBUG - 2022-11-06 22:12:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:21 --> Total execution time: 0.0224
DEBUG - 2022-11-06 22:12:26 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:26 --> Total execution time: 0.0296
DEBUG - 2022-11-06 22:12:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:27 --> Total execution time: 0.0163
DEBUG - 2022-11-06 22:12:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:27 --> Total execution time: 0.0261
DEBUG - 2022-11-06 22:12:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:27 --> Total execution time: 0.0229
DEBUG - 2022-11-06 22:12:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:28 --> Total execution time: 0.0280
DEBUG - 2022-11-06 22:12:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:28 --> Total execution time: 0.0156
DEBUG - 2022-11-06 22:12:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:28 --> Total execution time: 0.0261
DEBUG - 2022-11-06 22:12:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:28 --> Total execution time: 0.0284
DEBUG - 2022-11-06 22:12:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:30 --> Total execution time: 0.0271
DEBUG - 2022-11-06 22:12:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:35 --> Total execution time: 1.8984
DEBUG - 2022-11-06 22:12:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:37 --> Total execution time: 0.0220
DEBUG - 2022-11-06 22:12:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:12:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:12:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:12:37 --> Total execution time: 0.0212
DEBUG - 2022-11-06 22:18:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:37 --> Total execution time: 0.0277
DEBUG - 2022-11-06 22:18:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:38 --> Total execution time: 0.0244
DEBUG - 2022-11-06 22:18:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:38 --> Total execution time: 0.0248
DEBUG - 2022-11-06 22:18:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:50 --> Total execution time: 0.3373
DEBUG - 2022-11-06 22:18:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:55 --> Total execution time: 0.0188
DEBUG - 2022-11-06 22:18:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:58 --> Total execution time: 0.0443
DEBUG - 2022-11-06 22:18:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:59 --> Total execution time: 0.3155
DEBUG - 2022-11-06 22:18:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:18:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:18:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:18:59 --> Total execution time: 0.0314
DEBUG - 2022-11-06 22:19:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:19:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:19:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:19:03 --> Total execution time: 0.0382
DEBUG - 2022-11-06 22:19:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:19:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:19:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:19:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:19:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:19:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:19:09 --> Total execution time: 0.0238
DEBUG - 2022-11-06 22:19:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:19:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:19:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:19:10 --> Total execution time: 0.0157
DEBUG - 2022-11-06 22:19:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:19:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:19:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:19:11 --> Total execution time: 0.0179
DEBUG - 2022-11-06 22:20:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:20:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:20:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:20:52 --> Total execution time: 0.2977
DEBUG - 2022-11-06 22:20:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:20:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:20:53 --> Total execution time: 0.0160
DEBUG - 2022-11-06 22:20:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:20:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:20:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:20:55 --> Total execution time: 0.2924
DEBUG - 2022-11-06 22:20:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:20:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:20:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:20:57 --> Total execution time: 0.0183
DEBUG - 2022-11-06 22:21:01 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:21:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:21:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:21:04 --> Total execution time: 3.1403
DEBUG - 2022-11-06 22:21:05 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:21:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:21:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:21:06 --> Total execution time: 0.2998
DEBUG - 2022-11-06 22:26:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:09 --> Total execution time: 0.0235
DEBUG - 2022-11-06 22:26:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:09 --> Total execution time: 0.0185
DEBUG - 2022-11-06 22:26:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:10 --> Total execution time: 0.0166
DEBUG - 2022-11-06 22:26:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:10 --> Total execution time: 0.0198
DEBUG - 2022-11-06 22:26:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:11 --> Total execution time: 0.0181
DEBUG - 2022-11-06 22:26:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:15 --> Total execution time: 1.9268
DEBUG - 2022-11-06 22:26:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:17 --> Total execution time: 0.0190
DEBUG - 2022-11-06 22:26:17 --> Total execution time: 0.0278
DEBUG - 2022-11-06 22:26:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:23 --> Total execution time: 0.2923
DEBUG - 2022-11-06 22:26:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:23 --> Total execution time: 0.0148
DEBUG - 2022-11-06 22:26:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:32 --> Total execution time: 0.0235
DEBUG - 2022-11-06 22:26:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:32 --> Total execution time: 0.0176
DEBUG - 2022-11-06 22:26:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:32 --> Total execution time: 0.0155
DEBUG - 2022-11-06 22:26:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:49 --> Total execution time: 0.0221
DEBUG - 2022-11-06 22:26:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:49 --> Total execution time: 0.0185
DEBUG - 2022-11-06 22:26:49 --> Total execution time: 0.0225
DEBUG - 2022-11-06 22:26:49 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:49 --> Total execution time: 0.0197
DEBUG - 2022-11-06 22:26:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:53 --> Total execution time: 0.0224
DEBUG - 2022-11-06 22:26:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:53 --> Total execution time: 0.0181
DEBUG - 2022-11-06 22:26:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:53 --> Total execution time: 0.0162
DEBUG - 2022-11-06 22:26:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:26:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:26:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:26:53 --> Total execution time: 0.0210
DEBUG - 2022-11-06 22:28:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:19 --> Total execution time: 0.0354
DEBUG - 2022-11-06 22:28:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:19 --> Total execution time: 0.0192
DEBUG - 2022-11-06 22:28:19 --> Total execution time: 0.0224
DEBUG - 2022-11-06 22:28:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:19 --> Total execution time: 0.0192
DEBUG - 2022-11-06 22:28:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:20 --> Total execution time: 0.0178
DEBUG - 2022-11-06 22:28:27 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:30 --> Total execution time: 3.1201
DEBUG - 2022-11-06 22:28:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:32 --> Total execution time: 0.0202
DEBUG - 2022-11-06 22:28:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:28:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:28:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:28:32 --> Total execution time: 0.0195
DEBUG - 2022-11-06 22:30:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:06 --> Total execution time: 0.2978
DEBUG - 2022-11-06 22:30:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:06 --> Total execution time: 0.0157
DEBUG - 2022-11-06 22:30:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:08 --> Total execution time: 0.3005
DEBUG - 2022-11-06 22:30:10 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:10 --> Total execution time: 0.0196
DEBUG - 2022-11-06 22:30:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:11 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:11 --> Total execution time: 0.1186
DEBUG - 2022-11-06 22:30:12 --> Total execution time: 0.3995
DEBUG - 2022-11-06 22:30:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:34 --> Total execution time: 2.5156
DEBUG - 2022-11-06 22:30:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:30:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:30:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:30:36 --> Total execution time: 0.3766
DEBUG - 2022-11-06 22:32:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:32:03 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:32:03 --> 404 Page Not Found: admin/Surat_keterangan/admin
DEBUG - 2022-11-06 22:32:14 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:32:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:32:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:32:14 --> Total execution time: 0.2979
DEBUG - 2022-11-06 22:35:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:35:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:35:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:35:06 --> Total execution time: 0.2987
DEBUG - 2022-11-06 22:35:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:35:09 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:35:09 --> 404 Page Not Found: admin/Surat_keterangan/admin
DEBUG - 2022-11-06 22:35:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:35:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:35:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:35:23 --> Total execution time: 0.3027
DEBUG - 2022-11-06 22:36:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:36:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:36:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:36:30 --> Total execution time: 0.0434
DEBUG - 2022-11-06 22:40:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:40:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:40:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:40:15 --> Total execution time: 0.0258
DEBUG - 2022-11-06 22:40:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:40:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:40:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:40:15 --> Total execution time: 0.0155
DEBUG - 2022-11-06 22:40:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:40:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:40:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:40:15 --> Total execution time: 0.0179
DEBUG - 2022-11-06 22:40:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:40:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:40:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:40:17 --> Total execution time: 0.0180
DEBUG - 2022-11-06 22:41:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:41:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:41:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:41:39 --> Total execution time: 0.3053
DEBUG - 2022-11-06 22:41:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:41:55 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:41:55 --> 404 Page Not Found: admin/Surat_keterangan/admin
DEBUG - 2022-11-06 22:43:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:43:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:43:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:43:02 --> Total execution time: 0.2982
DEBUG - 2022-11-06 22:43:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:43:13 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:43:13 --> 404 Page Not Found: admin/Surat_keterangan/admin
DEBUG - 2022-11-06 22:43:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:43:33 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:43:33 --> 404 Page Not Found: admin/Surat_keterangan/admin
DEBUG - 2022-11-06 22:45:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:39 --> Total execution time: 0.2908
DEBUG - 2022-11-06 22:45:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:43 --> Total execution time: 0.2954
DEBUG - 2022-11-06 22:45:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:48 --> Total execution time: 0.0306
DEBUG - 2022-11-06 22:45:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:48 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:45:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:48 --> Total execution time: 0.0158
DEBUG - 2022-11-06 22:45:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:58 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:45:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:58 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 22:45:58 --> administrator
DEBUG - 2022-11-06 22:45:58 --> Total execution time: 0.0469
DEBUG - 2022-11-06 22:45:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:58 --> Total execution time: 0.3229
DEBUG - 2022-11-06 22:45:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:45:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:45:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:45:59 --> Total execution time: 0.0275
DEBUG - 2022-11-06 22:45:59 --> Total execution time: 0.0430
DEBUG - 2022-11-06 22:45:59 --> Total execution time: 0.0415
DEBUG - 2022-11-06 22:45:59 --> Total execution time: 0.1883
DEBUG - 2022-11-06 22:46:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:46:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:46:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:46:02 --> Total execution time: 0.3024
DEBUG - 2022-11-06 22:46:02 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:46:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:46:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:46:02 --> Total execution time: 0.0156
DEBUG - 2022-11-06 22:46:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:46:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:46:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:46:04 --> Total execution time: 0.3154
DEBUG - 2022-11-06 22:46:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:46:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:46:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:46:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:46:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:46:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:46:09 --> Total execution time: 0.2917
DEBUG - 2022-11-06 22:46:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:46:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:46:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:46:35 --> Total execution time: 2.5781
DEBUG - 2022-11-06 22:46:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:46:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:46:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:46:37 --> Total execution time: 0.3003
DEBUG - 2022-11-06 22:47:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:04 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:05 --> Total execution time: 0.2929
DEBUG - 2022-11-06 22:47:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:12 --> Total execution time: 0.0320
DEBUG - 2022-11-06 22:47:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:16 --> Total execution time: 0.0216
DEBUG - 2022-11-06 22:47:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:16 --> Total execution time: 0.0152
DEBUG - 2022-11-06 22:47:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:16 --> Total execution time: 0.0179
DEBUG - 2022-11-06 22:47:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:17 --> Total execution time: 0.0183
DEBUG - 2022-11-06 22:47:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:33 --> Total execution time: 0.2990
DEBUG - 2022-11-06 22:47:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:47:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:47:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:47:33 --> Total execution time: 0.0148
DEBUG - 2022-11-06 22:48:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:48:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:48:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:48:41 --> Total execution time: 0.0189
DEBUG - 2022-11-06 22:48:41 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:48:41 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:48:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:48:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:48:41 --> Total execution time: 0.0161
DEBUG - 2022-11-06 22:51:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:16 --> Total execution time: 0.0284
DEBUG - 2022-11-06 22:51:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:16 --> Total execution time: 0.0193
DEBUG - 2022-11-06 22:51:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:16 --> Total execution time: 0.0191
DEBUG - 2022-11-06 22:51:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:23 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:51:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:23 --> Total execution time: 0.0153
DEBUG - 2022-11-06 22:51:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:24 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:51:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:24 --> Total execution time: 0.0232
DEBUG - 2022-11-06 22:51:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:34 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:51:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:34 --> ssoValidateToken : {"status":true,"data":{"id_user":"678e8ec5-b796-4cff-8a53-4807e5196aa2","username":"pusdatin","nama":"pusdatin","telepon":null,"email":"pusdatin_dummy@gmail.com","nik":null,"nrk":"pusdatin","passport":null},"message":""}
DEBUG - 2022-11-06 22:51:34 --> administrator
DEBUG - 2022-11-06 22:51:34 --> Total execution time: 0.0582
DEBUG - 2022-11-06 22:51:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:35 --> Total execution time: 0.3146
DEBUG - 2022-11-06 22:51:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:36 --> Total execution time: 0.0247
DEBUG - 2022-11-06 22:51:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:36 --> Total execution time: 0.0253
DEBUG - 2022-11-06 22:51:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:36 --> Total execution time: 0.1703
DEBUG - 2022-11-06 22:51:36 --> Total execution time: 0.1753
DEBUG - 2022-11-06 22:51:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:39 --> Total execution time: 0.2994
DEBUG - 2022-11-06 22:51:40 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:40 --> Total execution time: 0.0148
DEBUG - 2022-11-06 22:51:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:46 --> Total execution time: 0.0218
DEBUG - 2022-11-06 22:51:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:47 --> Total execution time: 0.3023
DEBUG - 2022-11-06 22:51:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:51:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:51:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:51:47 --> Total execution time: 0.0152
DEBUG - 2022-11-06 22:58:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:03 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:58:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:03 --> Total execution time: 0.0171
DEBUG - 2022-11-06 22:58:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:20 --> No URI present. Default controller set.
DEBUG - 2022-11-06 22:58:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:20 --> ssoValidateToken : {"status":true,"data":{"id_user":"ebe19b70-9e45-437c-9ce6-0b7a40730d0c","username":"184171","nama":"ROBY DWIPUTRA","telepon":"08118711766","email":"roby.dwiputra@gmail.com","nik":null,"nrk":"184171","passport":null},"message":""}
DEBUG - 2022-11-06 22:58:20 --> Total execution time: 0.0492
DEBUG - 2022-11-06 22:58:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:21 --> Total execution time: 0.0809
DEBUG - 2022-11-06 22:58:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:21 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 22:58:21 --> 404 Page Not Found: Asset/sso
DEBUG - 2022-11-06 22:58:22 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:22 --> Total execution time: 0.0577
DEBUG - 2022-11-06 22:58:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:28 --> Total execution time: 0.0186
DEBUG - 2022-11-06 22:58:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:28 --> Total execution time: 0.0184
DEBUG - 2022-11-06 22:58:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:29 --> Total execution time: 0.0274
DEBUG - 2022-11-06 22:58:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:58:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:58:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:58:35 --> Total execution time: 0.0307
DEBUG - 2022-11-06 22:59:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:59:21 --> Total execution time: 0.0194
DEBUG - 2022-11-06 22:59:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:59:21 --> Total execution time: 0.0199
DEBUG - 2022-11-06 22:59:21 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:59:22 --> Total execution time: 0.0189
DEBUG - 2022-11-06 22:59:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:59:28 --> Total execution time: 0.0208
DEBUG - 2022-11-06 22:59:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:59:28 --> Total execution time: 0.0256
DEBUG - 2022-11-06 22:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:59:46 --> Total execution time: 0.0185
DEBUG - 2022-11-06 22:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 22:59:46 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
DEBUG - 2022-11-06 22:59:46 --> Total execution time: 0.0198
DEBUG - 2022-11-06 22:59:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 22:59:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 22:59:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 22:59:46 --> Total execution time: 0.0307
DEBUG - 2022-11-06 23:00:47 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:00:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:00:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:00:47 --> Total execution time: 0.0313
DEBUG - 2022-11-06 23:01:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:37 --> Total execution time: 0.0222
DEBUG - 2022-11-06 23:01:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:37 --> Total execution time: 0.0177
DEBUG - 2022-11-06 23:01:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:39 --> Total execution time: 0.0216
DEBUG - 2022-11-06 23:01:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:39 --> Total execution time: 0.0229
DEBUG - 2022-11-06 23:01:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:48 --> Total execution time: 0.0194
DEBUG - 2022-11-06 23:01:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:48 --> Total execution time: 0.0186
DEBUG - 2022-11-06 23:01:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:48 --> Total execution time: 0.0256
DEBUG - 2022-11-06 23:01:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:55 --> Total execution time: 0.0200
DEBUG - 2022-11-06 23:01:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:01:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:01:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:01:55 --> Total execution time: 0.0154
DEBUG - 2022-11-06 23:02:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:12 --> Total execution time: 0.0208
DEBUG - 2022-11-06 23:02:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:12 --> Total execution time: 0.0183
DEBUG - 2022-11-06 23:02:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:20 --> Total execution time: 0.0365
DEBUG - 2022-11-06 23:02:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:20 --> Total execution time: 0.0344
DEBUG - 2022-11-06 23:02:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:20 --> Total execution time: 0.0294
DEBUG - 2022-11-06 23:02:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:23 --> Total execution time: 0.0423
DEBUG - 2022-11-06 23:02:23 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:23 --> Total execution time: 0.0383
DEBUG - 2022-11-06 23:02:25 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:25 --> Total execution time: 0.0337
DEBUG - 2022-11-06 23:02:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:44 --> Total execution time: 0.0207
DEBUG - 2022-11-06 23:02:44 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:44 --> Total execution time: 0.0183
DEBUG - 2022-11-06 23:02:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:45 --> Total execution time: 0.0194
DEBUG - 2022-11-06 23:02:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:45 --> Total execution time: 0.0181
DEBUG - 2022-11-06 23:02:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:45 --> Total execution time: 0.0188
DEBUG - 2022-11-06 23:02:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:48 --> Total execution time: 0.0267
DEBUG - 2022-11-06 23:02:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:57 --> Total execution time: 0.0190
DEBUG - 2022-11-06 23:02:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:57 --> Total execution time: 0.0186
DEBUG - 2022-11-06 23:02:58 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:02:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:02:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:02:58 --> Total execution time: 0.0370
DEBUG - 2022-11-06 23:03:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:12 --> Total execution time: 0.0207
DEBUG - 2022-11-06 23:03:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:12 --> Total execution time: 0.0194
DEBUG - 2022-11-06 23:03:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:17 --> Total execution time: 0.0207
DEBUG - 2022-11-06 23:03:17 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:17 --> Total execution time: 0.0163
DEBUG - 2022-11-06 23:03:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:20 --> Total execution time: 0.0180
DEBUG - 2022-11-06 23:03:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:20 --> Total execution time: 0.0179
DEBUG - 2022-11-06 23:03:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:20 --> Total execution time: 0.0256
DEBUG - 2022-11-06 23:03:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:28 --> Total execution time: 0.0186
DEBUG - 2022-11-06 23:03:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:28 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
DEBUG - 2022-11-06 23:03:28 --> Total execution time: 0.0202
DEBUG - 2022-11-06 23:03:28 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:28 --> Total execution time: 0.0410
DEBUG - 2022-11-06 23:03:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:29 --> Total execution time: 0.0180
DEBUG - 2022-11-06 23:03:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:29 --> Total execution time: 0.0175
DEBUG - 2022-11-06 23:03:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:29 --> Total execution time: 0.0269
DEBUG - 2022-11-06 23:03:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:31 --> Total execution time: 0.0221
DEBUG - 2022-11-06 23:03:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:31 --> Total execution time: 0.0250
DEBUG - 2022-11-06 23:03:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:48 --> Total execution time: 0.0257
DEBUG - 2022-11-06 23:03:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:03:48 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
DEBUG - 2022-11-06 23:03:48 --> Total execution time: 0.0212
DEBUG - 2022-11-06 23:03:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:48 --> Total execution time: 0.0314
DEBUG - 2022-11-06 23:03:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:54 --> Total execution time: 0.0189
DEBUG - 2022-11-06 23:03:54 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:03:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:03:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:03:54 --> Total execution time: 0.0197
DEBUG - 2022-11-06 23:04:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:04:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:04:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:04:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:04:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:04:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:04:39 --> Total execution time: 0.0186
DEBUG - 2022-11-06 23:04:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:04:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:04:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:04:39 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
DEBUG - 2022-11-06 23:04:39 --> Total execution time: 0.0211
DEBUG - 2022-11-06 23:04:39 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:04:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:04:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:04:39 --> Total execution time: 0.0308
DEBUG - 2022-11-06 23:05:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:06 --> Total execution time: 0.0190
DEBUG - 2022-11-06 23:05:06 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:06 --> Total execution time: 0.0287
DEBUG - 2022-11-06 23:05:07 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:07 --> Total execution time: 0.0269
DEBUG - 2022-11-06 23:05:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:08 --> Total execution time: 0.0209
DEBUG - 2022-11-06 23:05:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:08 --> Total execution time: 0.0250
DEBUG - 2022-11-06 23:05:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:12 --> Total execution time: 0.0182
DEBUG - 2022-11-06 23:05:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:05:12 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
DEBUG - 2022-11-06 23:05:12 --> Total execution time: 0.0203
DEBUG - 2022-11-06 23:05:12 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:12 --> Total execution time: 0.0168
DEBUG - 2022-11-06 23:05:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:51 --> Total execution time: 0.0223
DEBUG - 2022-11-06 23:05:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:05:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:05:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:05:51 --> Total execution time: 0.0177
DEBUG - 2022-11-06 23:07:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:07:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:07:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:07:48 --> Total execution time: 0.0218
DEBUG - 2022-11-06 23:07:48 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:07:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:07:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:07:48 --> Total execution time: 0.0237
DEBUG - 2022-11-06 23:08:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:08:13 --> Total execution time: 0.0203
DEBUG - 2022-11-06 23:08:13 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:08:13 --> Total execution time: 0.0162
DEBUG - 2022-11-06 23:08:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
ERROR - 2022-11-06 23:08:15 --> Severity: Notice --> Undefined variable: id_golongan /var/www/html/si-adik/application/views/dashboard_publik/home/pangkat.php 169
DEBUG - 2022-11-06 23:08:15 --> Total execution time: 0.0214
DEBUG - 2022-11-06 23:08:15 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:08:15 --> Total execution time: 0.0206
DEBUG - 2022-11-06 23:08:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:08:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:08:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:08:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:08:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:08:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:15:24 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:15:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:15:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:15:24 --> Total execution time: 0.0194
DEBUG - 2022-11-06 23:16:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:16:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:16:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:16:03 --> arsip tidak kosong : 70
DEBUG - 2022-11-06 23:16:03 --> do upload : SK_2_70_6145
DEBUG - 2022-11-06 23:16:03 --> file tidak kosong
DEBUG - 2022-11-06 23:16:03 --> Total execution time: 0.0279
DEBUG - 2022-11-06 23:16:03 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:16:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:16:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:16:03 --> Total execution time: 0.0295
DEBUG - 2022-11-06 23:17:29 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:17:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:17:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:17:29 --> Total execution time: 0.0190
DEBUG - 2022-11-06 23:17:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:17:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:17:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:17:56 --> arsip tidak kosong : 71
DEBUG - 2022-11-06 23:17:56 --> do upload : SK_2_71_6146
DEBUG - 2022-11-06 23:17:56 --> file tidak kosong
DEBUG - 2022-11-06 23:17:56 --> Total execution time: 0.0251
DEBUG - 2022-11-06 23:17:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:17:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:17:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:17:56 --> Total execution time: 0.0303
DEBUG - 2022-11-06 23:18:16 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:18:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:18:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:18:16 --> Total execution time: 0.0212
DEBUG - 2022-11-06 23:18:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:18:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:18:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:18:32 --> Total execution time: 0.0249
DEBUG - 2022-11-06 23:18:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:18:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:18:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:18:32 --> Total execution time: 0.0275
DEBUG - 2022-11-06 23:18:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:18:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:18:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:18:35 --> Total execution time: 0.0158
DEBUG - 2022-11-06 23:19:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:19:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:19:00 --> arsip tidak kosong : 72
DEBUG - 2022-11-06 23:19:00 --> do upload : SK_2_72_6147
DEBUG - 2022-11-06 23:19:00 --> file tidak kosong
DEBUG - 2022-11-06 23:19:00 --> Total execution time: 0.0271
DEBUG - 2022-11-06 23:19:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:19:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:19:00 --> Total execution time: 0.0324
DEBUG - 2022-11-06 23:19:33 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:19:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:19:33 --> Total execution time: 0.0284
DEBUG - 2022-11-06 23:19:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:19:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:19:36 --> Total execution time: 0.0261
DEBUG - 2022-11-06 23:19:36 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:36 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 23:19:36 --> 404 Page Not Found: Asset/upload
DEBUG - 2022-11-06 23:19:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:37 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 23:19:37 --> 404 Page Not Found: Asset/upload
DEBUG - 2022-11-06 23:19:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:37 --> Global POST, GET and COOKIE data sanitized
ERROR - 2022-11-06 23:19:37 --> 404 Page Not Found: Asset/upload
DEBUG - 2022-11-06 23:19:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:19:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:19:51 --> Total execution time: 0.0344
DEBUG - 2022-11-06 23:19:51 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:19:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:19:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:19:51 --> Total execution time: 0.0353
DEBUG - 2022-11-06 23:20:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:20:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:20:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:20:43 --> do upload : SK_2_754_6148
DEBUG - 2022-11-06 23:20:43 --> file tidak kosong
DEBUG - 2022-11-06 23:20:43 --> Total execution time: 0.0240
DEBUG - 2022-11-06 23:20:43 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:20:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:20:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:20:43 --> Total execution time: 0.0297
DEBUG - 2022-11-06 23:20:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:20:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:20:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:20:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:20:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:20:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:20:52 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:20:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:20:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:20:53 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:20:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:19 --> Total execution time: 0.0205
DEBUG - 2022-11-06 23:21:19 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:19 --> Total execution time: 0.0182
DEBUG - 2022-11-06 23:21:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:20 --> Total execution time: 0.0192
DEBUG - 2022-11-06 23:21:20 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:20 --> Total execution time: 0.0217
DEBUG - 2022-11-06 23:21:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:32 --> path : asset/upload/SK/SK_4_0_3528
DEBUG - 2022-11-06 23:21:32 --> is_dir
DEBUG - 2022-11-06 23:21:32 --> Total execution time: 0.0181
DEBUG - 2022-11-06 23:21:32 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:32 --> Total execution time: 0.0228
DEBUG - 2022-11-06 23:21:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:35 --> path : asset/upload/SK/SK_4_0_3527
DEBUG - 2022-11-06 23:21:35 --> is_dir
DEBUG - 2022-11-06 23:21:35 --> Total execution time: 0.0250
DEBUG - 2022-11-06 23:21:35 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:35 --> Total execution time: 0.0220
DEBUG - 2022-11-06 23:21:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:37 --> Total execution time: 0.0181
DEBUG - 2022-11-06 23:21:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:37 --> Total execution time: 0.0188
DEBUG - 2022-11-06 23:21:37 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:37 --> Total execution time: 0.0289
DEBUG - 2022-11-06 23:21:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:38 --> Total execution time: 0.0192
DEBUG - 2022-11-06 23:21:38 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:21:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:21:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:21:38 --> Total execution time: 0.0173
DEBUG - 2022-11-06 23:22:08 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:08 --> Total execution time: 0.0171
DEBUG - 2022-11-06 23:22:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:31 --> Total execution time: 0.0165
DEBUG - 2022-11-06 23:22:31 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:31 --> Total execution time: 0.0185
DEBUG - 2022-11-06 23:22:34 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:34 --> Total execution time: 0.0162
DEBUG - 2022-11-06 23:22:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:50 --> Total execution time: 0.0358
DEBUG - 2022-11-06 23:22:50 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:50 --> Total execution time: 0.0374
DEBUG - 2022-11-06 23:22:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:22:55 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:22:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:22:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:23:30 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:23:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:23:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:23:30 --> Total execution time: 0.0156
DEBUG - 2022-11-06 23:23:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:23:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:23:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:23:46 --> Total execution time: 0.0193
DEBUG - 2022-11-06 23:23:46 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:23:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:23:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:23:46 --> Total execution time: 0.0178
DEBUG - 2022-11-06 23:24:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:42 --> do upload : pelatihan_266_117
DEBUG - 2022-11-06 23:24:42 --> file tidak kosong
DEBUG - 2022-11-06 23:24:42 --> Total execution time: 0.0248
DEBUG - 2022-11-06 23:24:42 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:42 --> Total execution time: 0.0202
DEBUG - 2022-11-06 23:24:45 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:45 --> Total execution time: 0.0151
DEBUG - 2022-11-06 23:24:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:56 --> Total execution time: 0.0210
DEBUG - 2022-11-06 23:24:56 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:56 --> Total execution time: 0.0164
DEBUG - 2022-11-06 23:24:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:57 --> Total execution time: 0.0232
DEBUG - 2022-11-06 23:24:57 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:57 --> Total execution time: 0.0195
DEBUG - 2022-11-06 23:24:59 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:24:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:24:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:24:59 --> Total execution time: 0.0209
DEBUG - 2022-11-06 23:25:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:25:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:25:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:25:00 --> Total execution time: 0.0179
DEBUG - 2022-11-06 23:25:00 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:25:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:25:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:25:00 --> Total execution time: 0.0192
DEBUG - 2022-11-06 23:25:09 --> UTF-8 Support Enabled
DEBUG - 2022-11-06 23:25:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2022-11-06 23:25:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2022-11-06 23:25:09 --> Total execution time: 0.0800
