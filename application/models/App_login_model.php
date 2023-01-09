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

						$sess_data['alreadyOpenPopup'] = $qad->is_show_popup;
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

	function reupdate_is_show_popup($id, $value = 0)
	{
		$this->db->update("tbl_data_pegawai", [
			"is_show_popup"  => $value,
			"tgl_show_popup" => date("Y-m-d"),
		], ["id_pegawai" => $id]);
		return $this->db->affected_rows();
	}
}

/* End of file app_login_model.php */
/* Location: ./application/models/app_login_model.php */
