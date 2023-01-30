<?php

class M_pltplh extends CI_Model
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
						a.id_surat_tugas_pltplh, 
						a.type_surat,
						a.id_pegawai, 
						c.lokasi_kerja_pegawai, c.nama_pegawai,c.nrk, c.nip,
						a.id_pegawai_berhalangan, 
						e.lokasi_kerja_pegawai_berhalangan, e.nama_pegawai_berhalangan,e.nrk_berhalangan, e.nip_berhalangan,
						a.alasan_pltplh, 
						a.tgl_mulai, 
						a.tgl_selesai,
						a.durasi,
						a.lokasi_kerja_berhalangan,
						a.tanggal_pengajuan
					FROM
						tbl_data_surat_tugas_pltplh AS a
					LEFT JOIN (
						SELECT b.id_pegawai, b.nrk, b.nip, b.lokasi_kerja as lokasi_kerja_pegawai, b.sublokasi_kerja, b.nama_pegawai
						FROM tbl_data_pegawai as b
						LEFT JOIN tbl_master_lokasi_kerja ba on b.lokasi_kerja = ba.id_lokasi_kerja 
					) AS c ON c.id_pegawai = a.id_pegawai
					
					LEFT JOIN (
						SELECT d.id_pegawai as id_pegawai_berhalangan, d.nrk as nrk_berhalangan, d.nip as nip_berhalangan, d.lokasi_kerja as lokasi_kerja_pegawai_berhalangan, 
										d.sublokasi_kerja, d.nama_pegawai as nama_pegawai_berhalangan
						FROM tbl_data_pegawai as d
						LEFT JOIN tbl_master_lokasi_kerja da on d.lokasi_kerja = da.id_lokasi_kerja 
					) AS e ON e.id_pegawai_berhalangan = a.id_pegawai_berhalangan
					WHERE a.id_surat_tugas_pltplh != '' $kond_lokasi $k_search order by id_surat_tugas_pltplh desc
						limit $offset, $number";

		if ($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
		return $query;
	}

	function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$Date_now = date('Y-m-d');
		$sQuery = "SELECT COUNT(id_surat_tugas_pltplh) as jml FROM tbl_data_surat_tugas_pltplh where id_surat_tugas_pltplh != ''";
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
						a.id_surat_tugas_pltplh, 
						a.type_surat,
						a.id_pegawai, 
						c.lokasi_kerja_pegawai, c.nama_pegawai,c.nrk, c.nip,
						a.id_pegawai_berhalangan, 
						e.lokasi_kerja_pegawai_berhalangan, e.nama_pegawai_berhalangan,e.nrk_berhalangan, e.nip_berhalangan,
						a.alasan_pltplh, 
						a.tgl_mulai, 
						a.tgl_selesai,
						a.tanggal_pengajuan
					FROM
						tbl_data_surat_tugas_pltplh AS a
					LEFT JOIN (
						SELECT b.id_pegawai, b.nrk, b.nip, b.lokasi_kerja as lokasi_kerja_pegawai, b.sublokasi_kerja, b.nama_pegawai
						FROM tbl_data_pegawai as b
						LEFT JOIN tbl_master_lokasi_kerja ba on b.lokasi_kerja = ba.id_lokasi_kerja 
					) AS c ON c.id_pegawai = a.id_pegawai
					
					LEFT JOIN (
						SELECT d.id_pegawai as id_pegawai_berhalangan, d.nrk as nrk_berhalangan, d.nip as nip_berhalangan, d.lokasi_kerja as lokasi_kerja_pegawai_berhalangan, 
										d.sublokasi_kerja, d.nama_pegawai as nama_pegawai_berhalangan
						FROM tbl_data_pegawai as d
						LEFT JOIN tbl_master_lokasi_kerja da on d.lokasi_kerja = da.id_lokasi_kerja 
					) AS e ON e.id_pegawai_berhalangan = a.id_pegawai_berhalangan
					WHERE a.id_surat_tugas_pltplh != ''  $kond_lokasi $k_search) DATA ";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	
}
