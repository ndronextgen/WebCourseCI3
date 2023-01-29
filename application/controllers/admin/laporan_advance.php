<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_advance extends CI_Controller
{

	/*
		***	Controller : Laporan_advance.php
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
			
			// === begin: lokasi ===
			$d['lokasi'] 		= $this->input->post('lokasi');
			
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
			// -----
			$d['golongan'] 			= $this->db->query("SELECT * FROM tbl_master_golongan ORDER BY id_golongan ASC")->result();
			$d['jenis_kelamin']	 	= $this->db->query("SELECT * FROM tbl_master_jenis_kelamin ORDER BY Id ASC")->result();
			$d['status_pegawai'] 	= $this->db->query("SELECT * FROM tbl_master_status_pegawai ORDER BY no_urut ASC")->result();
			// -----

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
			'sublokasi' => $this->input->post('sublokasi'),
			'id_golongan' => $this->input->post('id_golongan'),
			'status_pegawai' => $this->input->post('status_pegawai'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin')
		];

		$this->load->view('dashboard_admin/laporan/advance/ajax_table', $data);
	}

	function table_data_laporan()
	{
		$lokasi = $this->input->post('lokasi');
		$sublokasi = $this->input->post('sublokasi');
		$id_golongan = $this->input->post('id_golongan');
		$status_pegawai = $this->input->post('status_pegawai');
		$jenis_kelamin = $this->input->post('jenis_kelamin');

		$listing 		= $this->laporan_advance->listing($lokasi, $sublokasi, $id_golongan, $status_pegawai, $jenis_kelamin);
		$jumlah_filter 	= $this->laporan_advance->jumlah_filter($lokasi, $sublokasi, $id_golongan, $status_pegawai, $jenis_kelamin);
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
			$row[] = $key->golongan;
			$row[] = $key->nama_status;
			$row[] = $key->jenis_kelamin;
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

	public function cetak() {
		//	sama dengan yg di fungsi filter
		$lokasi = $this->input->get('lokasi');
		$sublokasi = $this->input->get('sublokasi');
		$id_golongan = $this->input->get('id_golongan');
		$status_pegawai = $this->input->get('status_pegawai');
		$jenis_kelamin = $this->input->get('jenis_kelamin');

		$ctype		= $this->input->get('ctype');
		$Tahun_Now  = date('Y');
		$Bulan_Now  = date('m');
		//
		$a['lokasi'] 		= $this->input->get('lokasi');
		$a['sublokasi'] 	= $this->input->get('sublokasi');
		$a['id_golongan'] 	= $this->input->get('id_golongan');
		$a['status_pegawai'] = $this->input->get('status_pegawai');
		$a['jenis_kelamin'] = $this->input->get('jenis_kelamin');
		$a['ctype'] 		= $this->input->get('ctype');

		$a['cetak']	= $this->laporan_advance->get_cetak($lokasi, $sublokasi, $id_golongan, $status_pegawai, $jenis_kelamin);
		//var_dump($cetak); die;
		$a['fungsi'] = $this->load->library('func_table');
//				------ 
		$pdfFilePath = "Rekap_pegawai";
		
		if($ctype=='excel'){
			$this->load->view('dashboard_admin/laporan/advance/cetak_advance', $a);
		} else {
			ini_set("pcre.backtrack_limit", "100000000");
			$mpdf = new \Mpdf\Mpdf();
			//$html = $this->load->view('dashboard_admin/tunjangan/export_digital', $d, true);
			$html = $this->load->view('dashboard_admin/laporan/advance/cetak_advance', $a, true);
			$mpdf->AddPage('L', '', '', '', '', 10, 10, 10, 10, 18, 12);
			$mpdf->simpleTables = true;
			$mpdf->packTableData = true;
			$mpdf->SetTitle($pdfFilePath);



			$mpdf->WriteHTML($html);
			$mpdf->Output($pdfFilePath . '.pdf', 'I');
		}
		
	} #end function cetak
}

/* End of file laporan_advance.php.php */
/* Location: ./application/controllers/admin/laporan_advance.php.php */
