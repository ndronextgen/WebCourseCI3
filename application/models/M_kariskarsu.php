<?php

class M_kariskarsu extends CI_Model
{

	function listing($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$number = $_POST['length'];
		$offset = $_POST['start'];
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (a.Perkawinan_ke LIKE '%$search%')";
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

		$query = "SELECT
						a.Id, 
						a.id_pegawai, 
						a.lokasi_kerja_pegawai, 
						a.is_dinas, 
						a.Kariskarsu_id, 
						a.Perkawinan_ke, 
						a.Status_progress, 
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
						a.Created_at, 
						a.Updated_by, 
						a.Updated_at,
						c.nama_lengkap,
						b.nama_status
					FROM
						tr_kariskarsu AS a
					LEFT JOIN (
						SELECT id_status, nama_status FROM tbl_status_surat
					) as b ON b.id_status = a.Status_progress
					LEFT JOIN (
						SELECT username, nama_lengkap FROM tbl_user_login
					) as c ON c.username = a.Created_by
						WHERE a.Id != '' $kond_lokasi $k_search order by Id desc
						limit $offset, $number";

		if ($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
		return $query;
	}

	function jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$Date_now = date('Y-m-d');
		$sQuery = "SELECT COUNT(Id) as jml FROM tr_kariskarsu where Id != '' AND id_pegawai = '$id_pegawai'";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	function jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai)
	{
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (a.Perkawinan_ke LIKE '%$search%')";
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

		$sQuery = "SELECT COUNT(a.Id) as jml FROM tr_kariskarsu as a where a.Id !='' $kond_lokasi $k_search ";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	// pilihan
	function listing_pilihan($Tunjangan_id)
	{
		$number = $_POST['length'];
		$offset = $_POST['start'];
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (b.nama_anggota_keluarga LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		// === jenis kelamin pegawai ===
		$sSQL = "SELECT jenis_kelamin FROM `tbl_data_pegawai` pegawai
				join tr_tunjangan tunjangan on tunjangan.id_pegawai = pegawai.id_pegawai
				where tunjangan.Tunjangan_id = '$Tunjangan_id'";
		$rsSQL = $this->db->query($sSQL);
		if (isset($rsSQL)) {
			$jen_kel = strtolower($rsSQL->row()->jenis_kelamin);
		} else {
			$jen_kel = '';
		}

		$query = "SELECT
						a.Id, 
						a.Tunjangan_id, 
						a.Keluarga_id, 
						b.nama_anggota_keluarga,
						b.tempat_lahir,
						date_format(b.tanggal_lahir_keluarga, '%e %b %Y') as tanggal_lahir_keluarga,
						date_format(b.tanggal_nikah, '%e %b %Y') as tanggal_nikah,
						b.pekerjaan_sekolah,
						case 
							when b.hub_keluarga = 0 then b.uraian
							when b.hub_keluarga = 1 then
								case 
									when '$jen_kel' = 'laki-laki' then 'Istri'
									when '$jen_kel' = 'perempuan' then 'Suami'
									else 'Suami / Istri'
								end
							when b.hub_keluarga = 2 then 'Anak Kandung'
						end as uraian,
						a.Created_at
					FROM
						tr_tunjangan_komponen_temp AS a
						
					LEFT JOIN (
						SELECT id_data_keluarga,id_pegawai,hub_keluarga,nama_anggota_keluarga,tempat_lahir,tanggal_lahir_keluarga,tanggal_nikah,pekerjaan_sekolah,uraian
						FROM tbl_data_keluarga
					) AS b ON b.id_data_keluarga = a.Keluarga_id
						WHERE a.Id != '' AND a.Tunjangan_id = '$Tunjangan_id' $k_search order by a.Id desc
						limit $offset, $number";

		if ($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
		return $query;
	}

	function jumlah_semua_pilihan($Tunjangan_id)
	{
		$Date_now = date('Y-m-d');
		$sQuery = "SELECT COUNT(Id) as jml FROM tr_tunjangan_komponen_temp where Id != '' AND Tunjangan_id = '$Tunjangan_id'";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	function jumlah_filter_pilihan($Tunjangan_id)
	{
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (b.nama_anggota_keluarga LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		$sQuery = "SELECT COUNT(a.Id) as jml FROM tr_tunjangan_komponen_temp as a where a.Id !='' AND Tunjangan_id = '$Tunjangan_id' $k_search ";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	// keluarga
	function listing_item($id_pegawai, $Kariskarsu_id)
	{
		$number = $_POST['length'];
		$offset = $_POST['start'];
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (a.nama_anggota_keluarga LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		// === jenis kelamin pegawai ===
		$sSQL = "SELECT jenis_kelamin FROM tbl_data_pegawai WHERE id_pegawai = '$id_pegawai'";
		$jen_kel = strtolower($this->db->query($sSQL)->row()->jenis_kelamin);

		$query = "SELECT
					a.id_data_keluarga, 
					a.id_pegawai, 
					a.hub_keluarga, 
					b.keterangan,
					a.nama_anggota_keluarga, 
					case 
						when a.jenis_kelamin = '1' then 'Laki-Laki'
						when a.jenis_kelamin = '2' then 'Perempuan'
						else ''
					end as jenis_kelamin,
					a.tempat_lahir, 
					a.tempat_nikah, 
					date_format(a.tanggal_lahir_keluarga, '%e %b %Y') as tanggal_lahir_keluarga,
					date_format(a.tanggal_nikah, '%e %b %Y') as tanggal_nikah,
					a.nik, 
					a.pekerjaan_sekolah, 
					a.uraian,
					a.status_kawin, 
					a.tanggal_cerai_meninggal,
					IF(a.agama = '0', a.agama_lainnya, c.master_agama) AS agama,
					a.alamat,
					a.alamat_sdp,
					IF(a.alamat_sdp = '0', a.alamat, d.master_alamat) AS alamat_new,
					a.pangkat_golongan 
				FROM
					tbl_data_keluarga AS a
					LEFT JOIN tbl_master_hubungan_keluarga AS b ON a.hub_keluarga = b.kode
					LEFT JOIN ( SELECT kode, agama AS master_agama FROM mt_agama ) AS c ON c.kode = a.agama 
					LEFT JOIN ( SELECT id_pegawai, alamat AS master_alamat FROM tbl_data_pegawai ) AS d ON d.id_pegawai = a.id_pegawai
				WHERE a.id_data_keluarga != ''
				AND a.id_pegawai = '$id_pegawai' 
				AND a.id_data_keluarga not in (SELECT Keluarga_id FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id') AND hub_keluarga = '1'
				$k_search order by a.id_data_keluarga desc
				limit $offset, $number";

		if ($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
		return $query;
	}

	function jumlah_semua_item($id_pegawai, $Kariskarsu_id)
	{
		$Date_now = date('Y-m-d');
		$sQuery = "SELECT COUNT(id_data_keluarga) as jml FROM tbl_data_keluarga where id_data_keluarga != '' AND id_pegawai = '$id_pegawai'
						AND id_data_keluarga not in (SELECT Keluarga_id FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id') AND hub_keluarga = '1'";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	function jumlah_filter_item($id_pegawai, $Kariskarsu_id)
	{
		$Date_now = date('Y-m-d');
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (a.nama_anggota_keluarga LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		$sQuery = "SELECT COUNT(a.id_data_keluarga) as jml FROM tbl_data_keluarga as a where a.id_data_keluarga !='' AND id_pegawai = '$id_pegawai' 
						AND a.id_data_keluarga not in (SELECT Keluarga_id FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id') AND hub_keluarga = '1' $k_search ";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}
}
