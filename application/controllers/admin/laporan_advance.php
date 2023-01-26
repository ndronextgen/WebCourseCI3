<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class laporan_advance extends CI_Controller
{

	/*
		***	Controller : laporan_advance.php
	*/

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('template');
		$this->load->model('m_laporan_advance', 'laporan_advance');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] 	= $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] 		= $this->config->item('nama_instansi');
			$d['credit'] 		= $this->config->item('credit_aplikasi');
			$d['alamat'] 		= $this->config->item('alamat_instansi');
			$d['page_name'] 	= 'Laporan Pegawai - Lanjutan';
			$d['menu_open'] 	= 'laporan';
			$d['lokasi'] 		= $this->input->post('lokasi');

			// === begin: lokasi ===
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
			// === end: lokasi ===

			$this->load->view('dashboard_admin/laporan/advance/index', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function filter()
	{
		$data = [
			'lokasi' => $this->input->post('lokasi'),
			'sublokasi' => $this->input->post('sublokasi')
		];

		$this->load->view('dashboard_admin/laporan/advance/ajax_table', $data);
	}

	function table_data_laporan()
	{
		$lokasi = $this->input->post('lokasi');
		$sublokasi = $this->input->post('sublokasi');

		$listing 		= $this->laporan_advance->listing($lokasi, $sublokasi);
		$jumlah_filter 	= $this->laporan_advance->jumlah_filter($lokasi, $sublokasi);
		$jumlah_semua 	= $this->laporan_advance->jumlah_semua();

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			// === begin: create row ===
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $key->nip;
			$row[] = $key->nrk;
			$row[] = $key->nama_pegawai;
			$row[] = $key->lokasi_kerja;
			$row[] = $key->sublokasi_kerja;

			$data[] = $row; // rowset
			// === end: create row ===
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $jumlah_semua->jml,
			"recordsFiltered" => $jumlah_filter->jml,
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function load_sub_dinas()
	{
		$sub_dinas = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => 1));

		if ($sub_dinas->num_rows() > 0) {
			foreach ($sub_dinas->result() as $row) {
				$result[] = [
					'id_lokasi_kerja' => $row->id_lokasi_kerja,
					'lokasi_kerja' => $row->lokasi_kerja
				];
			}
			echo json_encode($result);
		}
	}
}

/* End of file laporan_advance.php.php */
/* Location: ./application/controllers/admin/laporan_advance.php.php */
