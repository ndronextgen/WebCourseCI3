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
				$sess_data['isUserShowPopup'] = 0;
				if ($qad->id_pegawai != 0) {
					$q = $this->db->get_where("tbl_data_pegawai", ["id_pegawai" => $qad->id_pegawai]);
					if ($q->num_rows() > 0) {
						$row = $q->row();
						if (!empty($row->foto)) {
							$foto = base_url() . 'asset/foto_pegawai/thumb/' . $row->foto;
						}

						$row->sub_lokasi_kerja = $row->sublokasi_kerja;
						$data_informasi = $this->get_informasi($row);

						if (!empty($data_informasi)) :
							$sess_data['data_informasi'] = $data_informasi;
							$sess_data['isUserShowPopup'] = 1;
						endif;
						// $config_popup = $this->db->get_where('config_popup');
						// if ($config_popup->num_rows() > 0) {
						// 	foreach ($config_popup->result() as $pop) :
						// 		$type = $pop->type == "pegawai" ? "id_" . $pop->type : $pop->type;
						// 		if (in_array($row->{$type}, explode(",", $pop->value))) :
						// 			$sess_data['isUserShowPopup'][] = 1;
						// 		endif;
						// 	endforeach;
						// }
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

	private function get_informasi($users)
	{
		$date = date("Y-m-d");
		$where["tgl_mulai <= '$date'"] = NULL;
		$where["tgl_akhir >= '$date'"] = NULL;
		$result = [];
		$info = $this->db->order_by('position', 'ASC')->get_where("tbl_master_informasi", $where);
		if ($info->num_rows() > 0) :
			foreach ($info->result() as $val) :
				$permission = unserialize($val->permission);
				foreach ($permission as $key => $pers) :
					if (empty($pers)) {
						continue;
					}
					$type = $key == "pegawai" ? "id_" . $key : $key;
					if (in_array($users->{$type}, $pers)) :
						$result[] = $val;
					endif;
				endforeach;
			endforeach;
		endif;

		return $result;
	}

}

/* End of file app_login_model.php */
/* Location: ./application/models/app_login_model.php */
