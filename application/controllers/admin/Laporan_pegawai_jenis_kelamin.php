<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_jenis_kelamin extends CI_Controller
{

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
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Jenis Kelamin';
			$d['menu_open'] = 'laporan';
			$d['jenis_kelamin'] = $this->input->post('jenis_kelamin');

			$arrJenisKelamin = array();
			$arrJenisKelaminSelected = array();
			$jenisKelamin = [
				'Laki-Laki' => 'Laki-Laki',
				'Perempuan' => 'Perempuan'
			];

			foreach ($jenisKelamin as $key => $g) {
				$arrJenisKelamin[$key] = $g;

				$arrJenisKelaminSelected[$key] = '';
				if ($d['jenis_kelamin'] == $key) {
					$arrJenisKelaminSelected[$key] = 'selected=selected';
				}
			}

			$d['arrJenisKelamin'] = $arrJenisKelamin;
			$d['arrJenisKelaminSelected'] = $arrJenisKelaminSelected;

			$this->load->view('dashboard_admin/laporan/jenis_kelamin/home', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function export()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$cond = 'where 1=1';
			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$cond .= ' and lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
			}

			$search = $this->input->post('jenis_kelamin');
			if ($search != "0" && $search != "") {
				$cond .= " and lower(jenis_kelamin) = '" . strtolower($search) . "'";
			}

			$q = "
				select nip, nrk, nama_pegawai, tempat_lahir, tanggal_lahir, jenis_kelamin, agama 
				from tbl_data_pegawai 
				" . $cond . " 
				order by nama_pegawai asc";

			$d['data_pegawai'] = $this->db->query($q);
			$this->load->view('dashboard_admin/laporan/jenis_kelamin/export', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}
}
