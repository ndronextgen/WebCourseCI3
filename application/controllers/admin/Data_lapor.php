<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_lapor extends CI_Controller
{

	/*
		***	Controller : datalapor.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('template');
		$this->load->library('func_table');
		$this->load->library('func_table_lapor');
		$this->load->model('m_lapor', 'lapor');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Data Lapor Pegawai';
			$d['menu_open'] = 'data_lapor';

			$this->load->view('dashboard_admin/lapor/index_lapor', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function filter()
	{
		$this->load->view('dashboard_admin/lapor/ajax_table');
	}

	function table_data_lapor()
	{
		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$username = $this->session->userdata('username');
		$id_pegawai = '';

		$listing 		= $this->lapor->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->lapor->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->lapor->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {

			$see = $this->func_table_lapor->see_table_admin_lapor($username, $key->Id);
			$jml_c = $this->func_table->get_jml_tanggapan($key->Id);

			
			$button_ = '
					<a type="button" class="kt-nav__link btn-success btn-sm" onclick="view_lapor(' . "'" . $key->Id . "'" . ')"><i class="fa fa-eye"></i></a>
					<a type="button" class="kt-nav__link btn-warning btn-sm" onclick="edit_lapor(' . "'" . $key->Id . "'" . ')"><i class="fa fa-edit"></i></a>
					<a type="button" class="kt-nav__link btn-danger btn-sm" onclick="delete_lapor(' . "'" . $key->Id . "'" . ')"><i class="fa fa-trash"></i></a>
					';
			$tanggapan = '<button type="button" class="kt-nav__link btn-info btn-sm" onclick="gettanggapan(' . "'" . $key->Id . "'" . ')"><i class="fa fa-comment"></i>&nbsp;&nbsp;<b>' . $jml_c . '</b></button';

			// === begin: file ===
			$path_file = './asset/upload/Lapor/' . $key->File_upload;
			$file = $this->func_table->get_file($path_file, "View File");
			// === end: file ===

			if ($user_type == "administrator") {
				if ($id_lokasi_kerja == '' || $id_lokasi_kerja == null || $id_lokasi_kerja == '0') { //admin utama
					$button = '<a type="button" class="kt-nav__link btn-danger btn-sm" onclick="delete_lapor(' . "'" . $key->Id . "'" . ')"><i class="fa fa-trash" style="color:#fff !important;"></i></a>';
				} else { //admin lokasi
					$button = "X";
				}
			} else { //public
				$kond_lokasi = "X";
			}

			// === begin: create row ===
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $button;
			$row[] = $file;
			$row[] = $key->Kategori;
			$row[] = $key->Isi_laporan;
			$row[] = $key->nama_pegawai;
			$row[] = $tanggapan;
			$row[] = date_format(date_create($key->Created_at), 'j M Y  (H:i:s)');
			$row[] = $see;

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

	function notify_lapor()
	{

		$count_lapor		= $this->func_table_lapor->count_see_lapor_admin($this->session->userdata('username'));
		if ($count_lapor > 0) {
			$res_count_lapor = '<span class="kt-nav__link-badge"><span class="kt-badge kt-badge--warning">' . $count_lapor . '</span></span>';
		} else {
			$res_count_lapor = '';
		}

		$result = [
			'notify_lapor' => $res_count_lapor
		];

		echo json_encode($result);
	}
}

/* End of file data_riwayat_jabatan.php */
/* Location: ./application/controllers/data_riwayat_jabatan.php */
