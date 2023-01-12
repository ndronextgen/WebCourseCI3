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
		$this->load->helper('sso');
		$this->load->library('func_table');
	}

	// === sso ===
	public function index_sso()
	{
		if (isset($_COOKIE['sso_dcktrp']) && strlen($_COOKIE['sso_dcktrp']) > 0) {
			// validate token then create session
			$ssoValidateToken = SSOValidateToken($_COOKIE['sso_dcktrp']);
			log_message('debug', 'ssoValidateToken : ' . json_encode($ssoValidateToken));
			if ($ssoValidateToken['status']) {
				//get detail user
				$detailUser = $this->app_login_model->GetDetailUser($ssoValidateToken['data']->username);
				if ($detailUser['status']) {
					$sess_data['logged_in'] = 'yesGetMeLoginBaby';
					$sess_data['id_user'] = $detailUser['data']['id_user'];
					$sess_data['id_pegawai'] = $detailUser['data']['id_pegawai'];
					$sess_data['username'] = $detailUser['data']['username'];
					$sess_data['password'] = $detailUser['data']['password'];
					$sess_data['email'] = $detailUser['data']['email'];
					$sess_data['telepon'] = $detailUser['data']['telepon'];
					$sess_data['nama'] = $detailUser['data']['nama'];
					$sess_data['stts'] = $detailUser['data']['stts'];
					$sess_data['lokasi_kerja'] = $detailUser['data']['lokasi_kerja'];
					$sess_data['foto'] = $detailUser['data']['foto'];

					//set si-adik cookie
					$this->session->set_userdata($sess_data);
					// BEGIN YUDI - 6 JAN 2023
					setcookie('url', base_url());
					// setcookie('url', base_url(), time() + (60 * 30));
					// END YUDI - 6 JAN 2023

					//set cookie sso
					//setcookie('sso_dcktrp', $_COOKIE['sso_dcktrp'], null, '/', 'jakarta.go.id');
					setcookie('sso_dcktrp', $_COOKIE['sso_dcktrp'], time() + (60 * 30), '/', 'jakarta.go.id');

					// BEGIN JOE - 7 JUL 2022
					// db log user setelah berhasil login
					$this->load->model('Visitor_model');
					$this->Visitor_model->visitor_login();
					// END JOE - 7 JUL 2022

					if ($sess_data['stts'] == "administrator") {
						log_message('debug', 'administrator');
						header('location:' . base_url() . 'admin/dashboard_admin');
					} else if ($sess_data['stts'] == "publik" && $sess_data['password'] == md5('123456AppSimpeg32')) {
						//$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
						//header('location:'.base_url().'app/change_password_publik');
						header('location:' . base_url() . 'dashboard_publik');
					} else if ($sess_data['stts'] == "publik") {
						//$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
						header('location:' . base_url() . 'dashboard_publik');
					} else if ($sess_data['stts'] == "executive") {
						header('location:' . base_url() . 'dashboard_publik');
					}
				} else {
					$this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami.");
					header('location:' . base_url() . '');
				}
			} else {
				//not login sso
				header('location:' . $this->config->item('sso_url') . 'login?redirect=' . $this->config->item('base_url'));
			}
		} else if ($this->session->userdata('logged_in') == "") {
			$d['url'] = $this->config->item('sso_url') . 'login?redirect=' . $this->config->item('base_url');
			$this->load->view('app/landing_page', $d);

			// $d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			// $d['judul'] = $this->config->item('nama_aplikasi_aja');
			// $d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			// $d['instansi'] = $this->config->item('nama_instansi');
			// $d['credit'] = $this->config->item('credit_aplikasi');

			// $this->form_validation->set_rules('username', 'Username', 'trim|required');
			// $this->form_validation->set_rules('password', 'Password', 'trim|required');

			// if ($this->form_validation->run() == FALSE)
			// {
			// 	$this->load->view('app/login',$d);
			// }
			// else
			// {
			// 	$dt['username'] = $this->input->post('username');
			// 	$dt['password'] = $this->input->post('password');

			// 	setcookie('url', base_url());

			// 	$this->app_login_model->GetLoginData($dt);
			// }

			// BEGIN YUDI - 6 JAN 2023
			setcookie('url', base_url());
			// setcookie('url', base_url(), time() + (60 * 30));
			// END YUDI - 6 JAN 2023
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			header('location:' . base_url() . 'admin/dashboard_admin');
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik" && $this->session->userdata('password') == md5('123456AppSimpeg32')) {
			//$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
			//header('location:'.base_url().'app/change_password_publik');
			header('location:' . base_url() . 'dashboard_publik');
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			//$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
			header('location:' . base_url() . 'dashboard_publik');
		} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "executive") {
			header('location:' . base_url() . 'dashboard_publik');
		}
	}

	// === local ===
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
			header('location:' . base_url());
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

				$this->load->view('dashboard_publik/user/change_password', $d);
			} else {
				header('location:' . base_url());
			}
		} else {
			header('location:' . base_url());
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
			header('location:' . base_url());
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
				header('location:' . base_url());
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

				$this->load->view('dashboard_publik/user/change_password', $d);
			} else {
				$login['username'] = $id['username'];
				$login['password'] = md5($pass_lama . 'AppSimpeg32');

				//echo $login['password'];
				if ($pass_baru == $ulangi_pass_baru) {

					$this->load->helper('sso_user');
					// -- 
					$auth   = $this->input->cookie('sso_dcktrp');
					$verify = SSOVerifyLogin($auth);

					//echo json_encode($result, true);
					if ($verify['status'] == true) { //jika valid, lanjutkan untuk ubah password


						//$auth   = $this->input->cookie('sso_dcktrp');
						$id_user =  $verify['data'];
						$result  = SSOChangePassword($auth, $id_user, $pass_baru);
						var_dump($result);
					} else {
						$this->session->set_flashdata('pass_gagal', 'Token Tidak Valid...');
						header('location:' . base_url() . 'app/change_password_publik');
					}
				} else {

					$this->session->set_flashdata('pass_gagal', 'Password Baru tidak sama...');
					header('location:' . base_url() . 'app/change_password_publik');
				}
			}
		} else {
			header('location:' . base_url());
		}
	}


	public function save_pass_publik_old()
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
				header('location:' . base_url());
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

				$this->load->view('dashboard_publik/user/change_password', $d);
			} else {
				$login['username'] = $id['username'];
				$login['password'] = md5($pass_lama . 'AppSimpeg32');
				$cek = $this->db->get_where('tbl_user_login', $login);
				if ($cek->num_rows() > 0) {
					if ($pass_baru == $ulangi_pass_baru) {
						//update terlebih dahulu di sso
						$this->load->helper('sso_user');
						// -- 
						$auth   = $this->input->cookie('sso_dcktrp');
						$result = SSOVerifyLogin($auth);

						var_dump($result);

						// $upd['password'] = md5($pass_baru.'AppSimpeg32');
						// $this->db->update("tbl_user_login",$upd,$id);

						// $this->session->set_flashdata('pass_sukses', 'Berhasil mengubah password...');
						// header('location:'.base_url().'app/change_password_publik');
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
			header('location:' . base_url());
		}
	}

	public function save_name()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$this->form_validation->set_rules('nama_lengkap', 'Nama Pengguna', 'trim|required');

			$id['username'] = $this->session->userdata('username');
			$id['email'] = $this->input->post('email');
			$id['telepon'] = $this->input->post('telepon');
			$nama = $this->input->post("nama_lengkap");
			log_message('debug', 'username : ' . $this->input->post("usernname"));
			log_message('debug', 'nama : ' . $nama);

			$set['navPassword'] = "";
			$set['navPengguna'] = "active";
			$set['tabPassword'] = "";
			$set['tabPengguna'] = "show active";
			$this->session->set_userdata($set);

			if ($this->form_validation->run() == FALSE) {
				log_message('debug', 'error validasi');
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
				$set_new['nama'] = $nama;
				$this->session->set_userdata($set_new);
				header('location:' . base_url() . 'app/change_password');
			}
		} else {
			header('location:' . base_url());
		}
	}

	function logout()
	{
		// BEGIN JOE - 7 JUL 2022
		// Visitor Logout
		$this->load->model('Visitor_model');
		$this->Visitor_model->visitor_logout();
		// END JOE - 7 JUL 2022

		$this->session->sess_destroy();
		setcookie('url', '', time() - 3600);
		setcookie('lokasi_kerja', '', time() - 3600);
		setcookie('id_pegawai', '', time() - 3600);
		setcookie('act_list', '', time() - 3600);
		setcookie('sso_dcktrp', '', time() - 3600, '/', 'jakarta.go.id');

		header('location:' . base_url());
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