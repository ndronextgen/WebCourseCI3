<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_Login_Model extends CI_Model
{

	/*
		***	Model : app_login_model.php
	*/

	public function getLoginData($data)
	{
		$login['username'] = $data['username'];
		$login['password'] = md5($data['password'] . 'AppSimpeg32');
		$cek = $this->db->get_where('tbl_user_login', $login);
		if ($cek->num_rows() > 0) {
			foreach ($cek->result() as $qad) {
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['id_user'] = $qad->id_user_login;
				$sess_data['id_pegawai'] = $qad->id_pegawai;
				$sess_data['username'] = $qad->username;
				$sess_data['password'] = $qad->password;
				$sess_data['email'] = $qad->email;
				$sess_data['telepon'] = $qad->telepon;
				$sess_data['nama'] = $qad->nama_lengkap;
				$sess_data['stts'] = $qad->stts;
				$sess_data['lokasi_kerja'] = $qad->id_lokasi_kerja;

				$foto = base_url() . 'asset/foto_pegawai/no-image/nofoto.png';
				$sess_data['isUserShowPopup'] = [];
				if ($qad->id_pegawai != 0) {
					$q = $this->db->get_where("tbl_data_pegawai", ["id_pegawai" => $qad->id_pegawai]);
					if ($q->num_rows() > 0) {
						$row = $q->row();
						if (!empty($row->foto)) {
							$foto = base_url() . 'asset/foto_pegawai/thumb/' . $row->foto;
						}

						$sess_data['alreadyOpenPopup'] = $row->is_show_popup;
						if (date("d") >= "01" && date("Y-m-d", strtotime($row->tgl_show_popup)) > date("Y-m-d")) {
							$this->reupdate_is_show_popup($qad->id_pegawai);
							$sess_data['alreadyOpenPopup'] = 0;
						}

						$config_popup = $this->db->get_where('config_popup');
						if ($config_popup->num_rows() > 0) {
							foreach ($config_popup->result() as $pop) :
								$type = $pop->type == "pegawai" ? "id_" . $pop->type : $pop->type;
								if (in_array($row->{$type}, explode(",", $pop->value))) :
									$sess_data['isUserShowPopup'][] = 1;
								endif;
							endforeach;
						}
					}
				}
				$sess_data['foto'] = $foto;

				$this->session->set_userdata($sess_data);
				setcookie('lokasi_kerja', $qad->id_lokasi_kerja);
			}
			$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
			header('location:' . base_url() . '');
		} else {
			$this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami.");
			header('location:' . base_url() . '');
		}
	}

	public function GetLoginDataSSO($data)
	{
		$this->load->helper('sso');
		log_message('debug', 'GetLoginData');

		//get token from sso
		$ssoToken = SSOGetToken($data['username'], $data['password']);
		log_message('debug', 'ssoToken : ' . json_encode($ssoToken));
		if ($ssoToken['status']) {
			$ssoUser = SSOLogin($ssoToken['token']);
			log_message('debug', 'ssoUser : ' . json_encode($ssoUser));
			if ($ssoUser['status']) {
				//get detail user
				$detailUser = $this->GetDetailUser($data['username']);
				log_message('debug', 'detailUser : ' . json_encode($detailUser));
				if ($detailUser['status']) {
					$sess_data['logged_in'] = 'yesGetMeLoginBaby';
					$sess_data['id_user'] = $detailUser['data']['id_user'];
					$sess_data['id_pegawai'] = $detailUser['data']['id_pegawai'];
					$sess_data['username'] = $detailUser['data']['username'];
					$sess_data['password'] = $detailUser['data']['password'];
					$sess_data['nama'] = $detailUser['data']['nama'];
					$sess_data['stts'] = $detailUser['data']['stts'];
					$sess_data['email'] = $detailUser['data']['email'];
					$sess_data['telepon'] = $detailUser['data']['telepon'];
					$sess_data['lokasi_kerja'] = $detailUser['data']['lokasi_kerja'];
					$sess_data['foto'] = $detailUser['data']['foto'];

					//set si-adik cookie
					$this->session->set_userdata($sess_data);

					//set cookie sso
					setcookie('sso_dcktrp', $ssoToken['token'], null, '/', 'jakarta.go.id');

					if ($sess_data['stts'] == "administrator") {
						log_message('debug', 'administrator');
						header('location:' . base_url() . 'admin/dashboard_admin');
					} else if ($sess_data['stts'] == "publik" && $sess_data['password'] == md5('123456AppSimpeg32')) {
						//$this->session->set_flashdata('welcome', 'Silahkan Lakukan Update Data Anda Secara Lengkap dan Sesuai');
						header('location:' . base_url() . 'app/change_password_publik');
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
				$this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami.");
				header('location:' . base_url() . '');
			}
		} else {
			$this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami.");
			header('location:' . base_url() . '');
		}
	}

	function reupdate_is_show_popup($id, $value = 0)
	{
		$this->db->update("tbl_data_pegawai", [
			"is_show_popup"  => $value,
			"tgl_show_popup" => date("Y-m-d"),
		], ["id_pegawai" => $id]);
		return $this->db->affected_rows();
	}

	public function GetDetailUser($username)
	{
		$status = false;
		$data = null;
		$message = '';

		//get detail user
		$objUser = $this->db->get_where('tbl_user_login', ['username' => $username]);
		if ($objUser->num_rows() > 0) {
			$status = true;

			foreach ($objUser->result() as $qad) {
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$data['id_user'] = $qad->id_user_login;
				$data['id_pegawai'] = $qad->id_pegawai;
				$data['username'] = $qad->username;
				$data['password'] = $qad->password;
				$data['nama'] = $qad->nama_lengkap;
				$data['stts'] = $qad->stts;
				$data['email'] = $qad->email;
				$data['telepon'] = $qad->telepon;
				$data['lokasi_kerja'] = $qad->id_lokasi_kerja;

				$foto = base_url() . 'asset/foto_pegawai/no-image/nofoto.png';
				if ($qad->id_pegawai != 0) {
					$q = $this->db->get_where("tbl_data_pegawai", $qad->id_pegawai);
					if ($q->num_rows() > 0) {
						foreach ($q->result() as $row) {
							$foto = base_url() . 'asset/foto_pegawai/thumb/' . $row->foto;
						}
					}
				}
				$data['foto'] = $foto;
			}
		} else {
			$message = 'Failed get user detail.';
		}

		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];

		return $result;
	}
}

/* End of file app_login_model.php */
/* Location: ./application/models/app_login_model.php */
