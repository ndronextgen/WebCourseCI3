<?php
	
	class M_data_skp extends CI_Model {

		function listing($id_pegawai) {
			$number = $_POST['length'];
			$offset = $_POST['start'];
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (pegawai_dinilai LIKE '%$search%' OR pejabat_penilai LIKE '%$search%' OR atasan_pejabat_penilai LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}

			$query = "SELECT
							a.Id, a.Skp_id, 
							a.Periode_awal, 
							a.Periode_akhir, 
							a.Pyd, -- pegawai yg dinilai
							a.Pp, -- pejabat penilai
							a.Appn, -- atasan pejabat penilai
							a.Nama_pejabat_penilai, 
							a.Nama_atasan_pejabat_penilai, 
							a.Orientasi_pelayanan, 
							a.Integritas,
							a.Inisiatif_kerja, 
							a.Komitmen, 
							a.Disiplin, 
							a.Kerjasama, 
							a.Kepemimpinan, 
							a.Nilai_prestasi_kerja, 
							a.File_upload, 
							a.Created_at, 
							a.Updated_at,
							pegawai_dinilai, pejabat_penilai, atasan_pejabat_penilai,
							e.file_name,e.id_arsip_skp
						FROM
							tr_skp AS a
						LEFT JOIN (
							SELECT nama_pegawai as pegawai_dinilai, id_pegawai FROM tbl_data_pegawai
						) as b ON b.id_pegawai =  a.Pyd

						LEFT JOIN (
							SELECT nama_pegawai as pejabat_penilai, id_pegawai FROM tbl_data_pegawai
						) as c ON c.id_pegawai =  a.Pp

						LEFT JOIN (
							SELECT nama_pegawai as atasan_pejabat_penilai, id_pegawai FROM tbl_data_pegawai
						) as d ON d.id_pegawai =  a.Appn

						LEFT JOIN tbl_arsip_skp AS e ON a.Skp_id = e.id_dp3
						WHERE a.Id != '' AND a.Pyd = '$id_pegawai' $k_search  order by Id desc
						limit $offset, $number";

			if($_POST['length'] != -1)
			$query = $this->db->query($query)->result();
			return $query;	
		}

		function jumlah_semua($id_pegawai) {
			$Date_now = date('Y-m-d');
			$sQuery = "SELECT COUNT(Id) as jml FROM tr_skp where Id != '' AND Pyd = '$id_pegawai'";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}

		function jumlah_filter($id_pegawai) {
			$Date_now = date('Y-m-d');
			if($_POST['search']['value']) {
				$search = $_POST['search']['value'];
				$k_search = " AND (pegawai_dinilai LIKE '%$search%' OR pejabat_penilai LIKE '%$search%' OR pejabat_penilai LIKE '%$search%')";
			}
			else {
				$k_search = "";
			}
			
			$sQuery = "SELECT COUNT(DATA.Id) as jml FROM 
			(
				SELECT
							a.Id, 
							a.Periode_awal, 
							a.Periode_akhir, 
							a.Pyd, -- pegawai yg dinilai
							a.Pp, -- pejabat penilai
							a.Appn, -- atasan pejabat penilai
							a.Nama_pejabat_penilai, 
							a.Nama_atasan_pejabat_penilai,
							a.Orientasi_pelayanan, 
							a.Integritas,
							a.Inisiatif_kerja, 
							a.Komitmen, 
							a.Disiplin, 
							a.Kerjasama, 
							a.Kepemimpinan, 
							a.Nilai_prestasi_kerja, 
							a.File_upload, 
							a.Created_at, 
							a.Updated_at,
							pegawai_dinilai, pejabat_penilai, atasan_pejabat_penilai
						FROM
							tr_skp AS a
						LEFT JOIN (
							SELECT nama_pegawai as pegawai_dinilai, id_pegawai FROM tbl_data_pegawai
						) as b ON b.id_pegawai =  a.Pyd

						LEFT JOIN (
							SELECT nama_pegawai as pejabat_penilai, id_pegawai FROM tbl_data_pegawai
						) as c ON c.id_pegawai =  a.Pp

						LEFT JOIN (
							SELECT nama_pegawai as atasan_pejabat_penilai, id_pegawai FROM tbl_data_pegawai
						) as d ON d.id_pegawai =  a.Appn
						WHERE a.Id != '' AND a.Pyd = '$id_pegawai' $k_search  order by Id desc
			) DATA
			";
			$query = $this->db->query($sQuery)->row();
			return $query;	
		}
		
		function view_skp($Id) {

			$query = "SELECT
							a.Id, 
							a.Skp_id, 
							a.Periode_awal, 
							a.Periode_akhir, 
							a.Pyd, -- pegawai yg dinilai
							a.Pp, -- pejabat penilai
							a.Appn, -- atasan pejabat penilai
							a.Nama_pejabat_penilai, 
							a.Nama_atasan_pejabat_penilai,
							a.Orientasi_pelayanan, 
							a.Integritas,
							a.Inisiatif_kerja, 
							a.Komitmen, 
							a.Disiplin, 
							a.Kerjasama, 
							a.Kepemimpinan, 
							a.Nilai_prestasi_kerja, 
							a.File_upload, 
							a.Created_at, 
							a.Updated_at,
							pegawai_dinilai, pejabat_penilai, atasan_pejabat_penilai,
							id_arsip_skp, id_dp3, title, file_name_ori, `file_name`
						FROM
							tr_skp AS a
						LEFT JOIN (
							SELECT nama_pegawai as pegawai_dinilai, id_pegawai FROM tbl_data_pegawai
						) as b ON b.id_pegawai =  a.Pyd
	
						LEFT JOIN (
							SELECT nama_pegawai as pejabat_penilai, id_pegawai FROM tbl_data_pegawai
						) as c ON c.id_pegawai =  a.Pp
	
						LEFT JOIN (
							SELECT nama_pegawai as atasan_pejabat_penilai, id_pegawai FROM tbl_data_pegawai
						) as d ON d.id_pegawai =  a.Appn
						LEFT JOIN (
							SELECT id_arsip_skp, id_dp3, title, file_name_ori, `file_name` FROM tbl_arsip_skp
						) as e ON e.id_dp3 =  a.Skp_id
						WHERE a.Id != '' AND a.Id = '$Id'";
			$query = $this->db->query($query)->row();
			return $query;
		}
	}

	

?>