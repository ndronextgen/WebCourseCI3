<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller
{

	/*
		***	Controller : app.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('template');
		$this->load->library('func_table');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == "") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul'] = $this->config->item('nama_aplikasi_aja');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('app/login', $d);
			} else {
				$dt['username'] = $this->input->post('username');
				$dt['password'] = $this->input->post('password');

				setcookie('url', base_url());

				$this->app_login_model->getLoginData($dt);

				// BEGIN JOE - 7 JUL 2022
				// db log user setelah berhasil login
				$this->load->model('Visitor_model');
				$this->Visitor_model->visitor_login();
				// END JOE - 7 JUL 2022
			}
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			header('location:' . base_url() . 'admin/dashboard_admin');
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik" && $this->session->userdata('password') == md5('123456AppSimpeg32')) {
			//$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
			header('location:' . base_url() . 'dashboard_publik');
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			//$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
			header('location:' . base_url() . 'dashboard_publik');
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "executive") {
			header('location:' . base_url() . 'dashboard_publik');
		}
	}

	public function change_password()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Pengaturan Akun';
			$d['menu_open'] = '';

			$this->load->view('dashboard_admin/user/bg_change_password', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function change_password_publik()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

			if ($data_pegawai->num_rows() > 0) {
				$q = $this->db->get_where("tbl_data_pegawai", $id);
				foreach ($q->result() as $data) {
					$d['foto'] = $data->foto;
				}
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul'] = $this->config->item('nama_aplikasi_aja');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');

				//$this->load->view('dashboard_publik/header/header',$d);

				// see
				$count_see = $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
				$count_see_verifikasi = $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));

				$d['count_see'] = $count_see;
				$d['count_see_verifikasi'] = $count_see_verifikasi;
				$x['count_see'] = $count_see;

				$this->load->view('dashboard_publik/user/change_password', $d);
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function save_pass()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$this->form_validation->set_rules('pass_lama', 'Password Lama', 'trim|required');
			$this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required');
			$this->form_validation->set_rules('ulangi_pass_baru', 'Ulangi Password Baru', 'trim|required');

			$id['username'] = $this->input->post("username");
			$pass_lama = $this->input->post("pass_lama");
			$pass_baru = $this->input->post("pass_baru");
			$ulangi_pass_baru = $this->input->post("ulangi_pass_baru");

			$set['navPassword'] = "active";
			$set['navPengguna'] = "";
			$set['tabPassword'] = "show active";
			$set['tabPengguna'] = "";
			$this->session->set_userdata($set);

			if ($this->form_validation->run() == FALSE) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Pengaturan Akun';
				$d['menu_open'] = '';

				$this->load->view('dashboard_admin/user/bg_change_password', $d);
			} else {
				$login['username'] = $id['username'];
				$login['password'] = md5($pass_lama . 'AppSimpeg32');

				$cek = $this->db->get_where('tbl_user_login', $login);
				if ($cek->num_rows() > 0) {
					if ($pass_baru == $ulangi_pass_baru) {
						$upd['password'] = md5($pass_baru . 'AppSimpeg32');
						$this->db->update("tbl_user_login", $upd, $id);
						$this->session->set_flashdata('pass', 'Berhasil mengubah password...');
						header('location:' . base_url() . 'app/change_password');
					} else {
						$this->session->set_flashdata('pass', 'Password Baru tidak sama...');
						header('location:' . base_url() . 'app/change_password');
					}
				} else {
					$this->session->set_flashdata('pass', 'Password Lama salah...');
					header('location:' . base_url() . 'app/change_password');
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function save_pass_publik()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$data_pegawai = $this->db->get_where("tbl_data_pegawai", $id);

			if ($data_pegawai->num_rows() > 0) {
				$q = $this->db->get_where("tbl_data_pegawai", $id);
				foreach ($q->result() as $data) {
					$d['foto'] = $data->foto;
				}
			} else {
				header('location:' . base_url() . '');
			}

			$this->form_validation->set_rules('pass_lama', 'Password Lama', 'trim|required');
			$this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required');
			$this->form_validation->set_rules('ulangi_pass_baru', 'Ulangi Password Baru', 'trim|required');

			$id['username'] = $this->input->post("username");
			$pass_lama = $this->input->post("pass_lama");
			$pass_baru = $this->input->post("pass_baru");
			$ulangi_pass_baru = $this->input->post("ulangi_pass_baru");

			if ($this->form_validation->run() == FALSE) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul'] = $this->config->item('nama_aplikasi_aja');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');

				//$this->load->view('dashboard_publik/user/header',$d);
				$this->load->view('dashboard_publik/user/change_password', $d);
			} else {
				$login['username'] = $id['username'];
				$login['password'] = md5($pass_lama . 'AppSimpeg32');
				$cek = $this->db->get_where('tbl_user_login', $login);
				if ($cek->num_rows() > 0) {
					if ($pass_baru == $ulangi_pass_baru) {
						$upd['password'] = md5($pass_baru . 'AppSimpeg32');
						$this->db->update("tbl_user_login", $upd, $id);
						$this->session->set_flashdata('pass_sukses', 'Berhasil mengubah password...');
						header('location:' . base_url() . 'app/change_password_publik');
					} else {
						$this->session->set_flashdata('pass_gagal', 'Password Baru tidak sama...');
						header('location:' . base_url() . 'app/change_password_publik');
					}
				} else {
					$this->session->set_flashdata('pass_gagal', 'Password Lama salah...');
					header('location:' . base_url() . 'app/change_password_publik');
				}
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function save_name()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$this->form_validation->set_rules('nama_lengkap', 'Nama Pengguna', 'trim|required');

			$id['username'] = $this->input->post("usernname");
			$nama = $this->input->post("nama_lengkap");

			$set['navPassword'] = "";
			$set['navPengguna'] = "active";
			$set['tabPassword'] = "";
			$set['tabPengguna'] = "show active";
			$this->session->set_userdata($set);

			if ($this->form_validation->run() == FALSE) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Pengaturan Akun';
				$d['menu_open'] = '';

				$this->load->view('dashboard_admin/user/bg_change_password');
			} else {
				$upd['nama_lengkap'] = $nama;
				$this->db->update("tbl_user_login", $upd, $id);
				$this->session->set_flashdata('pass', 'Berhasil mengubah nama pengguna...');
				$set_new['nama'] = $upd['nama_lengkap'];
				$this->session->set_userdata($set_new);
				header('location:' . base_url() . 'app/change_password');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		setcookie('url', '', time() - 3600);
		setcookie('lokasi_kerja', '', time() - 3600);
		setcookie('id_pegawai', '', time() - 3600);
		setcookie('act_list', '', time() - 3600);

		header('location:' . base_url() . '');
	}

	function set_notif_to_admin()
	{
		$ses_username = $this->session->userdata('username');
		$lokasi = $this->session->userdata('lokasi_kerja');
		
		$sSQL = "SELECT username FROM tbl_user_login WHERE id_lokasi_kerja = '" . $lokasi . "' AND stts = 'administrator' ";
		$user_admin = $this->db->query($sSQL)->row()->username;

		$page = $this->input->post('page');
		$module = $this->input->post('module');
		$admin = $user_admin;
		$created_by = $ses_username;

		$this->func_table->SetNotif($page, $module, $lokasi, $admin, $created_by);
	}
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */
