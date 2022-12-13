<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->helper('sso');
	}

	public function get() {
		$status = 'failed';
		$data = null;
		$message = '';

		$username = $this->input->get('username');
		$token = $this->input->get('token');
		$tokenCheck = 'JKGJH82309^2359%$#KBL.adfj2';

		if ($token != '' && $token == $tokenCheck) {
			$status = 'success';
			$cek = $this->db->get_where('tbl_user_login', ['username' => $username]);
			if($cek->num_rows()>0)
			{
				foreach($cek->result() as $qad)
				{
					$data['id_user'] = $qad->id_user_login;
					$data['id_pegawai'] = $qad->id_pegawai;
					$data['username'] = $qad->username;
					$data['nama'] = $qad->nama_lengkap;
					$data['stts'] = $qad->stts;
					$data['lokasi_kerja'] = $qad->id_lokasi_kerja;

					$foto = base_url().'asset/foto_pegawai/no-image/nofoto.png';
					if ($qad->id_pegawai != 0) {
						$q = $this->db->get_where("tbl_data_pegawai",$qad->id_pegawai);
						if ($q->num_rows() > 0) {
							foreach ($q->result() as $row) {
								$foto = base_url().'asset/foto_pegawai/thumb/'.$row->foto;
							}
						}
					}
					$data['foto'] = $foto;
				}
			}
		}
		else {
			$message = 'Invalid token.';
		}

		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function set() {
		$status = 'failed';
		$objUser = null;
		$objPegawai = null;
		$idUserLogin = 0;
		$existUser = false;
		$message = '';
		
		$username = $this->input->get('username');
		$token = $this->input->get('token');
		$customFields = $this->input->post('custom_field');
		$tokenCheck = 'JKGJH82309^2359%$#KBL.adfj2';
		
		if ($token != '' && $token == $tokenCheck) {
			//hit get detail user
			$objSSOUser = SSOGetUser($username);

			if ($objSSOUser['status']) {
				//collect data user
				//check existing data from siadik
				$checkUser = $this->db->get_where('tbl_user_login', ['username' => $username]);
				if($checkUser->num_rows()>0)
				{
					$existUser = true;
					foreach($checkUser->result() as $qad)
					{
						$objUser['id_pegawai'] = $qad->id_pegawai;
						$objUser['username'] = $qad->username;
						$objUser['nama_lengkap'] = $qad->nama_lengkap;
						$objUser['stts'] = $qad->stts;
						$objUser['id_lokasi_kerja'] = $qad->id_lokasi_kerja;
						$objUser['email'] = $qad->email;
						$objUser['telepon'] = $qad->telepon;
					}

					//update tbl user login
					$idUserLogin = $qad->id_user_login;
				}

				//collect data pegawai
				$ssoData = $objSSOUser['data'];
				if (isset($ssoData->siadik) && $ssoData->siadik != null) {
					$ssoSiadik = $ssoData->siadik;
					$ssoSSO = $ssoData->sso;

					if ($customFields['stts'] == 'administrator') {
						$objUser['id_pegawai'] = $ssoSiadik->id_pegawai;
						$objUser['username'] = $username;
						$objUser['nama_lengkap'] = $ssoSiadik->nama_pegawai;
						$objUser['stts'] = $customFields['stts'];
						$objUser['id_lokasi_kerja'] = $customFields['id_lokasi_kerja'];
						$objUser['email'] = $ssoSSO->email;//ambil dari sso
						$objUser['telepon'] = $ssoSSO->phone;//ambil dari sso
					}

					$objPegawai['nip'] = $ssoSiadik->nip;
					$objPegawai['nrk'] = $ssoSiadik->nrk;
					$objPegawai['nama_pegawai'] = $ssoSiadik->nama_pegawai;
					$objPegawai['email'] = $ssoSiadik->email;
					$objPegawai['telepon'] = $ssoSiadik->telepon;
					$objPegawai['tempat_lahir'] = $ssoSiadik->tempat_lahir;
					$objPegawai['tanggal_lahir'] = $ssoSiadik->tanggal_lahir;
					$objPegawai['jenis_kelamin'] = $ssoSiadik->jenis_kelamin;
					$objPegawai['agama'] = $ssoSiadik->agama;
					$objPegawai['usia'] = $ssoSiadik->agama;
					$objPegawai['status_pegawai'] = $ssoSiadik->status_pegawai;
					$objPegawai['masa_kerja'] = $ssoSiadik->status_pegawai;
					$objPegawai['tanggal_pengangkatan_cpns'] = $ssoSiadik->tanggal_pengangkatan_cpns;
					$objPegawai['alamat'] = $ssoSiadik->alamat;
					$objPegawai['kode_kelurahan'] = $ssoSiadik->kode_kelurahan;
					$objPegawai['nama_kelurahan'] = $ssoSiadik->nama_kelurahan;
					$objPegawai['kode_kecamatan'] = $ssoSiadik->kode_kecamatan;
					$objPegawai['nama_kecamatan'] = $ssoSiadik->nama_kecamatan;
					$objPegawai['kode_kabupaten'] = $ssoSiadik->kode_kabupaten;
					$objPegawai['nama_kabupaten'] = $ssoSiadik->nama_kabupaten;
					$objPegawai['kode_provinsi'] = $ssoSiadik->kode_provinsi;
					$objPegawai['nama_provinsi'] = $ssoSiadik->nama_provinsi;
					$objPegawai['alamat_ktp'] = $ssoSiadik->alamat_ktp;
					$objPegawai['kode_provinsi_ktp'] = $ssoSiadik->kode_provinsi_ktp;
					$objPegawai['nama_provinsi_ktp'] = $ssoSiadik->nama_provinsi_ktp;
					$objPegawai['kode_kabupaten_ktp'] = $ssoSiadik->kode_kabupaten_ktp;
					$objPegawai['nama_kabupaten_ktp'] = $ssoSiadik->nama_kabupaten_ktp;
					$objPegawai['kode_kecamatan_ktp'] = $ssoSiadik->kode_kecamatan_ktp;
					$objPegawai['nama_kecamatan_ktp'] = $ssoSiadik->nama_kecamatan_ktp;
					$objPegawai['kode_kelurahan_ktp'] = $ssoSiadik->kode_kelurahan_ktp;
					$objPegawai['nama_kelurahan_ktp'] = $ssoSiadik->nama_kelurahan_ktp;
					$objPegawai['is_check'] = $ssoSiadik->is_check;
					$objPegawai['longitude'] = $ssoSiadik->longitude;
					$objPegawai['latitude'] = $ssoSiadik->latitude;
					$objPegawai['pendidikan'] = $ssoSiadik->pendidikan;
					$objPegawai['pendidikan_bkd'] = $ssoSiadik->pendidikan_bkd;
					$objPegawai['asal_sekolah'] = $ssoSiadik->asal_sekolah;
					$objPegawai['tgl_lulus'] = $ssoSiadik->tgl_lulus;
					$objPegawai['status_nikah'] = $ssoSiadik->status_nikah;
					$objPegawai['status_pegawai_pangkat'] = $ssoSiadik->status_pegawai_pangkat;
					$objPegawai['id_golongan'] = $ssoSiadik->id_golongan;
					$objPegawai['nomor_sk_pangkat'] = $ssoSiadik->nomor_sk_pangkat;
					$objPegawai['tanggal_sk_pangkat'] = $ssoSiadik->tanggal_sk_pangkat;
					$objPegawai['tanggal_mulai_pangkat'] = $ssoSiadik->tanggal_mulai_pangkat;
					$objPegawai['tanggal_selesai_pangkat'] = $ssoSiadik->tanggal_selesai_pangkat;
					$objPegawai['id_status_jabatan'] = $ssoSiadik->id_status_jabatan;
					$objPegawai['id_rumpun_jabatan'] = $ssoSiadik->id_rumpun_jabatan;
					$objPegawai['id_jabatan'] = $ssoSiadik->id_jabatan;
					$objPegawai['id_bidang'] = $ssoSiadik->id_bidang;
					$objPegawai['jfu'] = $ssoSiadik->jfu;
					$objPegawai['unit_kerja'] = $ssoSiadik->unit_kerja;
					$objPegawai['id_unit_kerja'] = $ssoSiadik->id_unit_kerja;
					$objPegawai['id_satuan_kerja'] = $ssoSiadik->id_satuan_kerja;
					$objPegawai['lokasi_kerja'] = $ssoSiadik->lokasi_kerja;
					$objPegawai['seksi'] = $ssoSiadik->seksi;
					$objPegawai['id_seksi'] = $ssoSiadik->id_seksi;
					$objPegawai['nomor_sk_jabatan'] = $ssoSiadik->nomor_sk_jabatan;
					$objPegawai['tanggal_sk_jabatan'] = $ssoSiadik->tanggal_sk_jabatan;
					$objPegawai['tanggal_mulai_jabatan'] = $ssoSiadik->tanggal_mulai_jabatan;
					$objPegawai['tanggal_selesai_jabatan'] = $ssoSiadik->tanggal_selesai_jabatan;
					$objPegawai['id_eselon'] = $ssoSiadik->id_eselon;
					$objPegawai['tmt_eselon'] = $ssoSiadik->tmt_eselon;
					$objPegawai['signature'] = $ssoSiadik->signature;
					$objPegawai['foto'] = $ssoSiadik->foto;
					$objPegawai['thumb_foto'] = $ssoSiadik->thumb_foto;
					$objPegawai['golongan'] = $ssoSiadik->golongan;
					$objPegawai['eselon'] = $ssoSiadik->eselon;
					$objPegawai['nama_status_jabatan'] = $ssoSiadik->nama_status_jabatan;
					$objPegawai['jabatan'] = $ssoSiadik->jabatan;
					$objPegawai['nama_lokasi_kerja'] = $ssoSiadik->nama_lokasi_kerja;
					$objPegawai['nama_rumpun_jabatan'] = $ssoSiadik->nama_rumpun_jabatan;
					$objPegawai['nama_status_pegawai'] = $ssoSiadik->nama_status_pegawai;
				}
				else if (isset($ssoData->sso)) {
					$ssoSSO = $ssoData->sso;

					if ($customFields['stts'] == 'administrator') {
						$objUser['id_pegawai'] = 0;
						$objUser['username'] = $username;
						$objUser['nama_lengkap'] = $ssoSSO->name;
						$objUser['stts'] = $customFields['stts'];
						$objUser['id_lokasi_kerja'] = $customFields['id_lokasi_kerja'];
						$objUser['email'] = $ssoSSO->email;
						$objUser['telepon'] = $ssoSSO->phone;
					}

					$objPegawai['nrk'] = $ssoSSO->nrk;
					$objPegawai['alamat'] = $ssoSSO->address;
					$objPegawai['telepon'] = $ssoSSO->phone;
					$objPegawai['email'] = $ssoSSO->email;
					$objPegawai['nama_pegawai'] = $ssoSSO->name;
				}

				//insert / update tbl user login
				if ($existUser) {
					//update tbl user login
					$this->db->update("tbl_user_login",$objUser,['id_user_login' => $idUserLogin]);
				}
				else if ($customFields['stts'] == 'administrator') {
					//insert tbl user login
					$this->db->insert("tbl_user_login",$objUser);
				}

				//check data pegawai
				$checkPegawai = $this->db->get_where('tbl_data_pegawai', ['id_pegawai' => $objUser['id_pegawai']]);
				if ($checkPegawai->num_rows() <= 0 && $customFields['stts'] == 'publik') {
					//not exist data pegawai and publik type
					$this->db->insert("tbl_data_pegawai",$objPegawai);
				}

				$status = 'success';
				$message = 'Berhasil mengupdate user privileges.';
			}
			else {
				$message = 'Failed getting user information SSO.';
			}
		}
		else {
			$message = 'Invalid token.';
		}
		
		$result = [
			'status' => $status,
			'msg' => $message,
			'data' => $objUser
		];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function getStatus() {
		$status = 'failed';
		$data = null;
		$message = '';

		$username = $this->input->get('username');
		$token = $this->input->get('token');
		$tokenCheck = 'JKGJH82309^2359%$#KBL.adfj2';

		if ($token != '' && $token == $tokenCheck) {
			$status = 'success';

			$data['list'] = [
				['value' => 'publik', 'label' => 'Publik'],
				['value' => 'administrator', 'label' => 'Administrator']
			];

			$value = null;

			//get status
			$cek = $this->db->get_where('tbl_user_login', ['username' => $username]);
			if($cek->num_rows()>0)
			{
				foreach($cek->result() as $qad)
				{
					$value = $qad->stts;
				}
			}

			$data['value'] = $value;
		}
		else {
			$message = 'Invalid token.';
		}

		$result = [
			'status' => $status,
			'payload' => $data
		];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function getLokasiKerja() {
		$status = 'failed';
		$data = null;
		$message = '';

		$username = $this->input->get('username');
		$token = $this->input->get('token');
		$tokenCheck = 'JKGJH82309^2359%$#KBL.adfj2';

		if ($token != '' && $token == $tokenCheck) {
			$status = 'success';

			$data['list'] = null;
			$lokasiKerja = $this->db->get('tbl_master_lokasi_kerja');
			if ($lokasiKerja->num_rows() > 0) 
			{
				$data['list'][] = [
					'value' => 0,
					'label' => 'Semua Lokasi Kerja'
				];

				foreach ($lokasiKerja->result() as $l) {
					$data['list'][] = [
						'value' => $l->id_lokasi_kerja,
						'label' => $l->lokasi_kerja
					];
				}
			}

			$value = null;
			//get lokasi kerja based on username
			$cek = $this->db->get_where('tbl_user_login', ['username' => $username]);
			if($cek->num_rows()>0)
			{
				foreach($cek->result() as $qad)
				{
					$value = $qad->id_lokasi_kerja;
				}
			}

			$data['value'] = $value;
		}
		else {
			$message = 'Invalid token.';
		}

		$result = [
			'status' => $status,
			'payload' => $data
		];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
?>