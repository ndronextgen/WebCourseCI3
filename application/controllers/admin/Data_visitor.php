<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_visitor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('template');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {

			date_default_timezone_set("Asia/Jakarta");

			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Data Pengunjung';
			$d['menu_open'] = 'laporan';

			$this->load->view('dashboard_admin/visitor/index_visitor', $d);
		} else {

			header('location:' . base_url() . '');
		}
	}

	public function func_menu1()
	{
		$cond = '';
		if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
			$cond .= ' and a.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
		}

		date_default_timezone_set("Asia/Jakarta");
		$date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
		// $today = $this->db->query(
		// 	"SELECT username 
		// 	FROM tbl_visitor 
		//     WHERE tanggal='" . $date . "' 
		// 	GROUP BY tanggal, username"
		// )->num_rows();
		// $a['visitor_today'] = $today;

		// $total = $this->db->query(
		// 	"SELECT username FROM tbl_visitor
		// 	GROUP BY tanggal, username"
		// )->num_rows();
		// $a['visitor_total'] = $total;

		// $online = $this->db->query(
		// 	"SELECT username 
		// 	FROM tbl_visitor
		// 	WHERE online_stat=1
		// 	GROUP BY username"
		// )->num_rows();
		// $a['visitor_online'] = $online;

		$monthly = $this->db->query(
			"SELECT
				DATE_FORMAT( vis.tanggal, '%e %M %Y' ) AS tanggal,
				DATE_FORMAT( vis.tanggal, '%e' ) AS tgl,
				DATE_FORMAT( vis.tanggal, '%m' ) AS bln,
				DATE_FORMAT( vis.tanggal, '%Y' ) AS thn,
				COUNT( DISTINCT vis.username ) AS harian,
				(
				SELECT
					COUNT( DISTINCT vis1.tanggal, vis1.username ) 
				FROM
					tbl_visitor AS vis1 
				WHERE
					vis1.tanggal <= DATE_FORMAT( vis.tanggal, '%Y-%m-%d' ) 
					AND MONTH ( vis1.tanggal ) = MONTH ( vis.tanggal ) 
				) AS total 
			FROM
				tbl_visitor AS vis 
			WHERE
				MONTH ( vis.tanggal )= MONTH ('" . $date . "') 
			GROUP BY
				vis.tanggal"
		)->result();
		$a['monthly'] = $monthly;

		// load file "Func_table.php" untuk mengguakan fungsi di VIEW
		$a['functions'] = $this->load->library('func_table');

		$this->load->view('dashboard_admin/visitor/menu_1_grafik', $a);
	}

	public function func_menu2()
	{
		date_default_timezone_set("Asia/Jakarta");
		$date  = date("Y-m-d"); // Mendapatkan tanggal sekarang

		$rs = $this->db->query(
			"SELECT
				vis.tanggal,
				log.nama_lengkap AS nama,
				DATE_FORMAT( vis.time_visit, '%H:%i:%s' ) AS waktu_login 
			FROM
				tbl_visitor AS vis
				INNER JOIN tbl_user_login AS log ON vis.username = log.username 
			WHERE
				MONTH ( vis.tanggal )= MONTH ('" . $date . "') 
			GROUP BY
				vis.tanggal,
				vis.username"
		)->result();
		$a['data_visitor'] = $rs;
		$a['sub_title'] = "Judul Menu 2";

		$this->load->view('dashboard_admin/visitor/menu_2_tabel', $a);
	}

	public function func_menu3()
	{
		$a['sub_title'] = "Judul Menu 3";



		$this->load->view('dashboard_admin/visitor/menu_3_', $a);
	}
}
