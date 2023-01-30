<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Get_data extends CI_Controller
{

	/*
		***	Controller : Get_data.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		date_default_timezone_set('Asia/Bangkok');
	}

	public function get_elm_pegawai()
	{
		$filter_pegawai = $this->input->post('filter_pegawai');
		$data_id_pegawai = isset($filter_pegawai) ? $filter_pegawai : '';
		if ($data_id_pegawai != '') {
			$kond = " AND a.id_pegawai = '$data_id_pegawai'";
		} else {
			$kond = " AND a.id_pegawai = 'x'";
		}
		$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja = a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE nrk != '' $kond")->row();
		$Data = isset($Data) ? $Data : '';
		$a['Data'] = $Data;

		if ($Data != '') {
			$this->load->view('dashboard_admin/get_data/table_info_pegawai.php', $a);
		}
	}

	
}

// End of file Get_data.php
// Location: ./application/controllers/Get_data.php
