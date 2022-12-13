<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Admin extends CI_Controller
{

	/*
		***	Controller : dashboard_admin.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_model');
		$this->load->helper('template');
		$this->load->library('func_table');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Data Pegawai DCKTRP';
			$d['menu_open'] = 'dashboard';

			$this->load->view('dashboard_admin/home/home', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function read_notif()
	{
		$ci = &get_instance();
		
		$ses_username = $this->session->userdata('username');
		$ci->func_table->ReadNotif(1, $ses_username);
	}
}

/* End of file dashboard_admin.php */
/* Location: ./application/controllers/dashboard_admin.php */
