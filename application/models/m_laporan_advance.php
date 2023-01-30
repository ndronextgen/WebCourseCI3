<?php
class M_laporan_advance extends CI_Model
{
	function listing($lokasi, $sublokasi, $id_golongan, $status_pegawai, $jenis_kelamin)
	{
		// $Date_now = date('Y-m-d');

		$number = $_POST['length'];
		$offset = $_POST['start'];

		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (nip LIKE '%$search%' OR 
								nrk LIKE '%$search%' OR 
								nama_pegawai LIKE '%$search%' OR 
								email LIKE '%$search%' OR 
								telepon LIKE '%$search%' OR 
								tempat_lahir LIKE '%$search%' OR 
								tanggal_lahir LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		$filter = '';

		// === filter: lokasi ===
		if ($lokasi != '') {
			$filter .= 'and peg.lokasi_kerja = \'' . $lokasi . '\'';
		}

		// === filter: sub lokasi ===
		$join = '';
		if ($sublokasi != '') {
			$filter .= ' and peg.sublokasi_kerja = \'' . $sublokasi . '\'';
		} else {
			$join = 'LEFT';
		}
		// ---
		if($id_golongan !=''){
			$kond_golongan = " AND peg.id_golongan = '$id_golongan'";
		} else {
			$kond_golongan = "";
		}
		if($status_pegawai !=''){
			$kond_status_pegawai = " AND peg.status_pegawai = '$status_pegawai'";
		} else {
			$kond_status_pegawai = "";
		}
		if($jenis_kelamin !=''){
			$kond_jenis_kelamin = " AND peg.jenis_kelamin = '$jenis_kelamin'";
		} else {
			$kond_jenis_kelamin = "";
		}
		// ---
		$this->db->query("SET GLOBAL max_allowed_packet = 8280000000");
		$sSQL = "SELECT peg.nip, peg.nrk, peg.status_pegawai, peg.id_golongan, peg.jenis_kelamin, gol.golongan,sp.nama_status, 
					concat(' ', peg.nama_pegawai) as nama_pegawai, 
					concat(' ', lok.lokasi_kerja) as lokasi_kerja, 
					concat(' ', ifnull(sublok.lokasi_kerja, '-')) sublokasi_kerja 
				FROM tbl_data_pegawai peg 
					LEFT JOIN tbl_master_golongan gol ON gol.id_golongan = peg.id_golongan 
					LEFT JOIN tbl_master_status_pegawai sp ON sp.id_status_pegawai = peg.status_pegawai
					LEFT JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
					$join JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
				WHERE 1 = 1 $k_search $filter $kond_golongan $kond_status_pegawai $kond_jenis_kelamin
				ORDER BY peg.lokasi_kerja, sublok.lokasi_kerja, peg.nama_pegawai 
				LIMIT $offset, $number";
		$rsSQL = $this->db->query($sSQL);

		if ($_POST['length'] != -1)
			$rsSQL = $this->db->query($sSQL)->result();

		return $rsSQL;
	}

	function jumlah_semua()
	{
		$sQuery = "SELECT COUNT(id_pegawai) AS jml FROM tbl_data_pegawai WHERE id_pegawai != ''";
		$query = $this->db->query($sQuery)->row();
		return $query;
	}

	function jumlah_filter($lokasi, $sublokasi, $id_golongan, $status_pegawai, $jenis_kelamin)
	{
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (nip LIKE '%$search%' OR 
								nrk LIKE '%$search%' OR 
								nama_pegawai LIKE '%$search%' OR 
								email LIKE '%$search%' OR 
								telepon LIKE '%$search%' OR 
								tempat_lahir LIKE '%$search%' OR 
								tanggal_lahir LIKE '%$search%')";
		} else {
			$k_search = "";
		}

		$filter = '';

		// === filter: lokasi ===
		if ($lokasi != '') {
			$filter .= 'and peg.lokasi_kerja = \'' . $lokasi . '\'';
		}

		// === filter: sub lokasi ===
		$join = '';
		if ($sublokasi != '') {
			$filter .= ' and peg.sublokasi_kerja = \'' . $sublokasi . '\'';
		} else {
			$join = 'LEFT';
		}

		// ---
		if($id_golongan !=''){
			$kond_golongan = " AND peg.id_golongan = '$id_golongan'";
		} else {
			$kond_golongan = "";
		}
		if($status_pegawai !=''){
			$kond_status_pegawai = " AND peg.status_pegawai = '$status_pegawai'";
		} else {
			$kond_status_pegawai = "";
		}
		if($jenis_kelamin !=''){
			$kond_jenis_kelamin = " AND peg.jenis_kelamin = '$jenis_kelamin'";
		} else {
			$kond_jenis_kelamin = "";
		}
		// ---

		$sSQL = "SELECT COUNT(peg.id_pegawai) AS jml
				FROM tbl_data_pegawai peg 
					LEFT JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
					$join JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
				WHERE 1 = 1 $k_search $filter $kond_golongan $kond_status_pegawai $kond_jenis_kelamin";
		$rsSQL = $this->db->query($sSQL)->row();

		return $rsSQL;
	}

	function get_cetak($lokasi, $sublokasi, $id_golongan, $status_pegawai, $jenis_kelamin)
	{


		$filter = '';

		// === filter: lokasi ===
		if ($lokasi != '') {
			$filter .= 'and peg.lokasi_kerja = \'' . $lokasi . '\'';
		}

		// === filter: sub lokasi ===
		$join = '';
		if ($sublokasi != '') {
			$filter .= ' and peg.sublokasi_kerja = \'' . $sublokasi . '\'';
		} else {
			$join = 'LEFT';
		}
		// ---
		if($id_golongan !=''){
			$kond_golongan = " AND peg.id_golongan = '$id_golongan'";
		} else {
			$kond_golongan = "";
		}
		if($status_pegawai !=''){
			$kond_status_pegawai = " AND peg.status_pegawai = '$status_pegawai'";
		} else {
			$kond_status_pegawai = "";
		}
		if($jenis_kelamin !=''){
			$kond_jenis_kelamin = " AND peg.jenis_kelamin = '$jenis_kelamin'";
		} else {
			$kond_jenis_kelamin = "";
		}
		// ---
		$this->db->query("SET GLOBAL max_allowed_packet = 8280000000");
		$sSQL = $this->db->query("SELECT peg.nip, peg.nrk, peg.status_pegawai, peg.id_golongan, peg.jenis_kelamin, gol.golongan,sp.nama_status, 
					concat(' ', peg.nama_pegawai) as nama_pegawai, 
					concat(' ', lok.lokasi_kerja) as lokasi_kerja, 
					concat(' ', ifnull(sublok.lokasi_kerja, '-')) sublokasi_kerja 
				FROM tbl_data_pegawai peg 
					LEFT JOIN tbl_master_golongan gol ON gol.id_golongan = peg.id_golongan 
					LEFT JOIN tbl_master_status_pegawai sp ON sp.id_status_pegawai = peg.status_pegawai 
					LEFT JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
					LEFT JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
				WHERE 1 = 1 $filter $kond_golongan $kond_status_pegawai $kond_jenis_kelamin
				ORDER BY peg.lokasi_kerja, sublok.lokasi_kerja, peg.nama_pegawai")->result();
		//$rsSQL = $this->db->query($sSQL)->result();
		
		//$s = $this->db->query("SELECT * FROM tbl_data_pegawai")->result();

		// if($rsSQL->num_rows() > 0){
		// 	$rsSQL = $this->db->query($sSQL)->result();
		// }

		// if ($_POST['length'] != -1)
		// 	$rsSQL = $this->db->query($sSQL)->result();

		return $sSQL;
	}
}
