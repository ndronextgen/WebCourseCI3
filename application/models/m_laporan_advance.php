<?php
class M_laporan_advance extends CI_Model
{
	function listing($lokasi, $sublokasi)
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

		$sSQL = "SELECT peg.nip, peg.nrk, 
					concat(' ', peg.nama_pegawai) as nama_pegawai, 
					concat(' ', lok.lokasi_kerja) as lokasi_kerja, 
					concat(' ', ifnull(sublok.lokasi_kerja, '-')) sublokasi_kerja 
				FROM tbl_data_pegawai peg 
					LEFT JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
					$join JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
				WHERE 1 = 1 $k_search $filter 
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

	function jumlah_filter($lokasi, $sublokasi)
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

		$sSQL = "SELECT COUNT(peg.id_pegawai) AS jml
				FROM tbl_data_pegawai peg 
					LEFT JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
					$join JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
				WHERE 1 = 1 $k_search $filter ";
		$rsSQL = $this->db->query($sSQL)->row();

		return $rsSQL;
	}
}
