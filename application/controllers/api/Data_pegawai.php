<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db_kepegawaian = $this->load->database('db_kepegawaian', true);
		$this->load->helper('url');    /***** LOADING HELPER TO AVOID PHP ERROR ****/
	}

	public function generate_from_admin() {
		echo 'Generating data pegawai from table admin...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;
		$data = $this->db_kepegawaian->get('admin')->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir']
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}
				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir']
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_bgpd() {
		echo 'Generating data pegawai from table bgpd...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '');
		$data = $this->db_kepegawaian->get_where('bgpd', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 47
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 47
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_permet() {
		echo 'Generating data pegawai from table permet...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '');
		$data = $this->db_kepegawaian->get_where('permet', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 55
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 55
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_pimpinan() {
		echo 'Generating data pegawai from table pimpinan...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'level !=' => 0, 'nrk !=' => '');
		$data = $this->db_kepegawaian->get_where('pimpinan', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir']
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir']
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_pppr() {
		echo 'Generating data pegawai from table pppr...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '');
		$data = $this->db_kepegawaian->get_where('pppr', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 48
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 48
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_ppr() {
		echo 'Generating data pegawai from table ppr...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '');
		$data = $this->db_kepegawaian->get_where('ppr', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 49
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 49
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_ppsr() {
		echo 'Generating data pegawai from table ppsr...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '');
		$data = $this->db_kepegawaian->get_where('ppsr', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 50
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 50
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_sekretariat() {
		echo 'Generating data pegawai from table sekretariat...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000');
		$data = $this->db_kepegawaian->get_where('sekretariat', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 44
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 44
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_uptdfptd() {
		echo 'Generating data pegawai from table uptdfptd...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000');
		$data = $this->db_kepegawaian->get_where('uptdfptd', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 56
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 56
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_uptdpsi() {
		echo 'Generating data pegawai from table uptdpsi...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('uptdpsi', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 35
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 35
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_wasbang() {
		echo 'Generating data pegawai from table wasbang...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('wasbang', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 46
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 46
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_wi_kepsrb() {
		echo 'Generating data pegawai from table wi_kepsrb...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('wi_kepsrb', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 51
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 51
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_wi_sudin_brt() {
		echo 'Generating data pegawai from table wi_sudin_brt...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('wi_sudin_brt', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 41
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 41
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_wi_sudin_pst() {
		echo 'Generating data pegawai from table wi_sudin_pst...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('wi_sudin_pst', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 38
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 38
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_wi_sudin_sltn() {
		echo 'Generating data pegawai from table wi_sudin_sltn...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('wi_sudin_sltn', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 54
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 54
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_wi_sudin_tmr() {
		echo 'Generating data pegawai from table wi_sudin_tmr...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('wi_sudin_tmr', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 42
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 42
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}

	public function generate_from_wi_sudin_utr() {
		echo 'Generating data pegawai from table wi_sudin_utr...<br />';
		$inserted = 0; $updated = 0; $failed_insert = 0; $failed_update = 0; $total = 0;

		$cond = array('username !=' => '', 'username !=' => '000000', 'level !=' => 0);
		$data = $this->db_kepegawaian->get_where('wi_sudin_utr', $cond)->result_array();
		$total = count($data);
		echo 'Found: '.count($data).' data<br />';

		if ($total > 0) {
			foreach ($data as $key=>$dt) {
				$pegawai = $this->db->get_where('tbl_data_pegawai', array('nrk' => $dt['nrk']))->result_array();

				if (count($pegawai) > 0) {
					//update data pegawai

					$arr = array(
						'nip' => $dt['nip'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 43
					);

					$this->db->where('nrk', $dt['nrk']);
					if ($this->db->update('tbl_data_pegawai', $arr)) {
						$updated++;
					}
					else {
						$failed_update++;
					}

				}
				else {
					//insert data pegawai
					
					$arr = array(
						'nip' => $dt['nip'],
						'nrk' => $dt['nrk'],
						'nama_pegawai' => $dt['nama'],
						'tempat_lahir' => $dt['tmplahir'],
						'tanggal_lahir' => $dt['tgllahir'],
						'jenis_kelamin' => $dt['gender'],
						'agama' => $dt['agama'],
						'alamat' => $dt['alamat'],
						'pendidikan' => $dt['jenjang'],
						'lokasi_kerja' => 43
					);

					//get id_golongan
					$id_golongan = null;
					$golongan = $this->db->get_where('tbl_master_golongan', array('golongan' => $dt['gol']))->result_array();
					if (count($golongan) > 0) {
						$id_golongan = $golongan[0]['id_golongan'];

						$arr['id_golongan'] = $id_golongan;
					}

					if ($this->db->insert('tbl_data_pegawai', $arr)) {
						$inserted++;
					}
					else {
						$failed_insert;
					}
				}
				usleep(2);
			}
		}
		else {
			echo 'tidak ada data.';
		}
		
		echo '<br />==========================================================================================<br />';
		echo 'Total: '.$total.'<br />';
		echo 'Insert: '.$inserted.'<br />';
		echo 'Failed Insert: '.$failed_insert.'<br />';
		echo 'Update: '.$updated.'<br />';
		echo 'Failed Update: '.$failed_update.'<br />';
	}
}
?>