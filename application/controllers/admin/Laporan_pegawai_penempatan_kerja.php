<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_penempatan_kerja extends CI_Controller
{

	/*
		***	Controller : laporan_pegawai_penempatan_kerja.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('template');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Penempatan Kerja';
			$d['menu_open'] = 'laporan';
			$d['lokasi'] = $this->input->post('lokasi');

			$arrLokasi = array();
			$arrLokasiSelected = array();
			$lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => '0'))->result_array();
			if (count($lokasi) > 0) {
				foreach ($lokasi as $l) {
					$arrLokasi[$l['id_lokasi_kerja']] = $l['lokasi_kerja'];

					$arrLokasiSelected[$l['id_lokasi_kerja']] = '';
					if ($d['lokasi'] == $l['id_lokasi_kerja']) {
						$arrLokasiSelected[$l['id_lokasi_kerja']] = 'selected=selected';
					}
				}
			}

			$d['arrLokasi'] = $arrLokasi;
			$d['arrLokasiSelected'] = $arrLokasiSelected;
			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');

			$this->load->view('dashboard_admin/laporan/penempatan_kerja/home', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function export()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$cond = 'where 1=1';
			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$cond .= ' and a.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
			}

			$d['lokasi'] = $this->input->post('lokasi');
			if ($d['lokasi'] != "0") {
				$cond .= " and a.lokasi_kerja = " . $d['lokasi'];
			}

			$q = "
				select a.nip, a.nrk, a. nama_pegawai, a.tempat_lahir, a.tanggal_lahir, a.jenis_kelamin, a.agama, a.usia, b.lokasi_kerja 
				from tbl_data_pegawai a 
				left join tbl_master_lokasi_kerja b on a.lokasi_kerja=b.id_lokasi_kerja 
				" . $cond . " 
				order by a.nama_pegawai asc";

			$d['data_pegawai'] = $this->db->query($q)->result_array();

			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
			$this->load->view('dashboard_admin/laporan/penempatan_kerja/export', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}
}

/* End of file laporan_pegawai_penempatan_kerja.php */
/* Location: ./application/controllers/laporan_pegawai_penempatan_kerja.php */
