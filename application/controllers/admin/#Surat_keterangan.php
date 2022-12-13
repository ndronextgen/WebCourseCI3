<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat_keterangan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
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
			$d['page_name'] = 'Surat Keterangan Pegawai';
			$d['menu_open'] = 'kk';

			$d['nama_pegawai'] = $this->input->post('nama_pegawai');
			$d['status'] = $this->input->post('id_status_surat');

			$arrStatus = array();
			$arrStatusSelected = array();
			$status = $this->db->get('tbl_status_surat')->result_array();
			if (count($status) > 0) {
				foreach ($status as $s) {
					$arrStatus[$s['id_status']] = $s['nama_status'];

					$arrStatusSelected[$s['id_status']] = '';
					if ($d['status'] == $s['id_status']) {
						$arrStatusSelected[$s['id_status']] = 'selected=selected';
					}
				}
			}

			$d['arrStatus'] = $arrStatus;
			$d['arrStatusSelected'] = $arrStatusSelected;

			$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/home', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function detail()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$id_surat = $this->input->post('id_surat');
			if ($id_surat != 0) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Detail Surat Keterangan Pegawai';
				$d['menu_open'] = 'kk';
				$d['act'] = 'detail';

				$d['surat'] = null;
				$d['status_surat'] = null;
				$q = $this->db->query(
					"
					select a.*, b.nama_surat, c.nama_status, d.nama_status as status_surat , e.keterangan as jenis_pengajuan
					from tbl_data_srt_ket a 
					left join tbl_master_surat b on a.jenis_surat = b.id_surat 
					left join tbl_master_status_pegawai c on a.status_pegawai = c.id_status_pegawai 
					left join tbl_status_surat d on a.id_status_srt = d.id_status 
					left join tbl_master_jenis_pengajuan_surat e on a.jenis_pengajuan_surat = e.kode 
					where a.id_srt=" . $id_surat
				)->row();

				//foreach ($q->result() as $p) {
				$d['surat'] = $q;
				//}

				//history
				$history = null;

				if ($q->id_status_srt == '1') { //ditolak
					$kondisi = " WHERE x.id_status in ('0','1')";
				} else {
					if ($q->select_ttd == 'basah') { //basah
						$kondisi = " WHERE x.id_status !='1' ";
					} else if ($q->select_ttd == 'digital') {  //menunggu, langsung selesai
						$kondisi = " WHERE x.id_status in ('0','3')";
					} else {
						$kondisi = " WHERE x.id_status !='1' ";
					}
				}

				$Query_history = $this->db->query("SELECT 
													x.id_status, x.nama_status, x.style, x.sort as urutan, 
													y.id_srt, y.id_status_srt, y.created_by, y.created_at, y.id_user, y.nama_lengkap , y.nama_pengaju
													FROM tbl_status_surat x
													LEFT JOIN(
																	SELECT a.id_srt, a.id_status_srt, a.created_by, a.created_at, a.id_user, nama_lengkap , nama_pengaju
																	FROM tbl_history_srt_ket a 
																	LEFT JOIN (
																		SELECT id_pegawai, nama_lengkap as nama_pengaju FROM tbl_user_login b where id_pegawai !='0'
																	) b ON b.id_pegawai = a.created_by
																	LEFT JOIN (
																		SELECT id_pegawai, nama_lengkap FROM tbl_user_login c
																	) c ON c.id_pegawai = a.id_user
																	WHERE a.id_srt='$id_surat'
													) y ON y.id_status_srt = x.id_status 
													$kondisi
													ORDER BY x.sort ASC")->result();
				$d['Query_history'] = $Query_history;
				$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/detail', $d);
			} else {
				header('location:' . base_url());
			}
		} else {
			header('location:' . base_url());
		}
	}

	public function detail_()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$id_surat = $this->input->post('id_surat');
			if ($id_surat != 0) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Detail Surat Keterangan Pegawai';
				$d['menu_open'] = 'kk';
				$d['act'] = 'detail';

				$d['surat'] = null;
				$d['status_surat'] = null;
				$q = $this->db->query(
					"
					select a.*, b.nama_surat, c.nama_status, d.nama_status as status_surat 
					from tbl_data_srt_ket a 
					left join tbl_master_surat b on a.jenis_surat = b.id_surat 
					left join tbl_master_status_pegawai c on a.status_pegawai = c.id_status_pegawai 
					left join tbl_status_surat d on a.id_status_srt = d.id_status 
					where a.id_srt=" . $id_surat
				);

				foreach ($q->result() as $p) {
					$d['surat'] = $p;
				}

				//history
				$history[] = null;
				$q = $this->db->query(
					"
					select a.id_status_srt, a.created_at, a.id_user, b.nama_lengkap   
					from tbl_history_srt_ket a 
					left join tbl_user_login b on a.id_user = b.id_pegawai 
					where a.id_srt=" . $id_surat
				);

				$i = 0;
				foreach ($q->result() as $h) {
					$history[$h->id_status_srt]['id_status_srt'] = $h->id_status_srt;
					$history[$h->id_status_srt]['created_at'] = $h->created_at;
					$history[$h->id_status_srt]['id_user'] = $h->id_user;
					$history[$h->id_status_srt]['created_by'] = $h->nama_lengkap;
				}

				//status surat
				if ($d['surat']->id_status_srt == 1) {
					//ditolak
					$q = $this->db->query(
						"
					select id_status,nama_status as status_srt, style, '' as active, '' as created_at, '' as id_user, '' as created_by  
					from tbl_status_surat 
					where id_status != 3
					order by sort asc"
					);
				} else {
					$q = $this->db->query(
						"
					select id_status,nama_status as status_srt, style, '0' as active, '' as created_at, '' as id_user, '' as created_by 
					from tbl_status_surat 
					where id_status != 1
					order by sort asc"
					);
				}

				foreach ($q->result() as $hm) {
					if ($history != null) {
						if (array_key_exists($hm->id_status, $history)) {
							$hm->active = 1;
							$hm->created_at = $history[$hm->id_status]['created_at'];
							$hm->id_user = $history[$hm->id_status]['id_user'];
							$hm->created_by = $history[$hm->id_status]['created_by'];
						}
					}

					$d['status_surat'][] = $hm;
				}
				// echo '<pre>'.print_r($d,true).'</pre>';exit;
				$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/detail', $d);
			} else {
				header('location:' . base_url());
			}
		} else {
			header('location:' . base_url());
		}
	}

	function form_verifikasi()
	{
		$Id 				= $this->input->post('Id');
		$Query_data 		= $this->db->query("SELECT * FROM tbl_data_srt_ket WHERE id_srt='$Id'")->row();

		$a['Id'] 			= $this->input->post('Id');
		$a['data'] 			= $Query_data;

		$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/form_verifikasi', $a);
	}

	public function processSave()
	{
		$status = false;
		$message = '';

		$id_surat = $this->input->post('id_surat');
		$dec = $this->input->post('dec');
		$ket = $this->input->post('ket');
		$select_ttd = $this->input->post('select_ttd');



		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != 0) {
			$surat = null;
			$qOldSurat = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
			foreach ($qOldSurat->result() as $s) {
				$surat = $s;
			}

			// jika statud diterima dan mengguakan ttd digital maka download langsung tersedia
			if ($select_ttd == 'digital') {
				$status_surat = '3';
				$kode_lokasi = $this->db->query("SELECT lokasi_kerja FROM tbl_data_pegawai WHERE id_pegawai = '$surat->id_user'")->row();
				$nomor_surat = $this->func_table->gen_nomor_surat($kode_lokasi->lokasi_kerja);
			} else {
				$status_surat = $dec;
				$nomor_surat = '';
			}

			if ($surat != null) {
				//proses update 
				$in = array(
					'id_status_srt' => $status_surat,
					'keterangan_ditolak' => $ket,
					'select_ttd' => $select_ttd,
					'nomor_surat' => $nomor_surat,
					'tgl_proses' => date('Y-m-d H:i:s'),
					'id_user_proses' => $this->session->userdata("id_user")
				);

				if ($this->db->update('tbl_data_srt_ket', $in, ['id_srt' => $id_surat])) {
					//insert history
					$hist_srt['id_srt'] = $id_surat;
					$hist_srt['id_user'] = $surat->id_user;
					$hist_srt['created_at'] = date("Y-m-d H:i:s");
					$hist_srt['created_by'] = $this->session->userdata("id_user");
					$hist_srt['id_status_srt'] = $status_surat;

					if ($this->db->insert('tbl_history_srt_ket', $hist_srt)) {
						$status = true;
						$see = $this->func_table->in_tosee_sk($surat->id_user, $id_surat, $status_surat, $this->session->userdata("id_user"));
					} else {
						$message = 'Gagal menyimpan data.';
					}
				} else {
					$message = 'Gagal menyimpan data.';
				}
			} else {
				$message = 'Data tidak valid.';
			}
		} else {
			$message = 'Request tidak valid.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function updateDownload()
	{
		$status = false;
		$message = '';

		$id_surat = $this->input->post('id_surat');
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != 0) {
			$q = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
			foreach ($q->result() as $p) {
				//update is_download
				if ($this->db->update('tbl_data_srt_ket', ['is_download' => ((int) $p->is_download + 1)], ['id_srt' => $id_surat])) {
					$status = true;
				} else {
					$message = 'Gagal update data.';
				}
			}
		} else {
			$message = 'Request failed.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function download_surat($id_surat = 0)
	{
		//if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
		if ($this->session->userdata('logged_in') != "") {
			if ($id_surat != 0) {
				$this->load->library('Pdf');

				$d['surat'] = null;
				$d['header_surat'] = '';
				$d['pegawai'] = null;
				$d['penandatangan'] = null;
				$dt['eselon3'] = null;
				$d['ket_ttd'] = '';
				$d['lokasi_kerja_ttd'] = '';

				//get data surat
				$q = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
				foreach ($q->result() as $p) {
					$d['surat'] = $p;

					//update is_download
					if ($this->db->update('tbl_data_srt_ket', ['is_download' => ((int) $p->is_download + 1)], ['id_srt' => $id_surat])) {

						//get data pegawai
						$q2 = $this->db->query(
							"
							select a.nip, a.nrk, a.nama_pegawai, a.id_status_jabatan, a.id_jabatan, a.lokasi_kerja as id_lokasi_kerja, 
								b.id_nama_jabatan, b.nama_jabatan, b.level_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, 
								d.dinas, e.sub_lokasi_kerja , d.dinas, d.ttd_unit, unit_satuan_kerja,kop_surat 
							from tbl_data_pegawai a
							left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
							left join tbl_master_golongan c on a.id_golongan = c.id_golongan
							left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja 
							left join tbl_master_sub_lokasi_kerja e on a.seksi = e.id_sub_lokasi_kerja 
							where a.id_pegawai = " . $p->id_user
						);

						foreach ($q2->result() as $p2) {
							// echo '<pre>'.print_r($p2,true).'</pre>';exit;
							$d['pegawai'] = $p2;
							//$d['header_surat'] = strtoupper(strtolower($p2->lokasi_kerja));
							if($p2->dinas=='1'){
								$d['header_surat'] = strtoupper(strtolower('DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN<br>PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA'));
							} else {
								$d['header_surat'] = strtoupper(strtolower($p2->lokasi_kerja));
							}
							// echo '<pre>'.print_r($d['pegawai'],true).'</pre>';exit;
							//get atasan
							if ($p2->dinas == 1) {
								//dinas
								//yg bertanda tangan sekertaris, atas nama kepala dinas
								$q3 = $this->db->query("
									select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, d.ttd_unit, unit_satuan_kerja,kop_surat 
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 2
								");
								foreach ($q3->result() as $p3) {
									$d['penandatangan'] = $p3;
									// echo '<pre>'.print_r($p3,true).'</pre>';exit;
								}

								//get kadis
								$q4 = $this->db->query("
									select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, d.ttd_unit, unit_satuan_kerja,kop_surat  
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 1
								");

								foreach ($q4->result() as $p4) {
									$d['eselon3'] = $p4;
								}

								$jabatan_ttd = ucwords(strtolower($d['eselon3']->nama_jabatan));
								$filter_jabatan_ttd = trim(str_replace('Kepala', '', $jabatan_ttd));
								$lokasi_ttd = trim(ucwords(strtolower($d['eselon3']->lokasi_kerja)));
								$lokasi_ttd = trim(str_replace($filter_jabatan_ttd, '', $lokasi_ttd));
								// $d['ket_ttd'] = 'a.n. ' . $jabatan_ttd . '<br />' . $lokasi_ttd . '<br />';
								// $d['ket_ttd'] .= trim(str_replace('Dinas', '', ucwords(strtolower($d['penandatangan']->nama_jabatan)))) . ',';
								// new
								$nama_jabatan_new = isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : '';
								$ttd_unit_new = isset($d['eselon3']->ttd_unit) ? $d['eselon3']->ttd_unit : '';
								$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
								$d['ket_ttd'] = 'a.n. '.$nama_jabatan_new.'<br>'.$ttd_unit_new.'<br>'.$penandatangan_new.',';
							} else {
								//upt & sudin
								//yg bertanda tangan kasubag tu a.n. eselon 3

								//get penandatangan
								$q3 = $this->db->query("
									select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, d.ttd_unit, unit_satuan_kerja,kop_surat  
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.lokasi_kerja = " . $p2->id_lokasi_kerja . "
											and a.id_jabatan = 61
								");
								foreach ($q3->result() as $p3) {
									$d['penandatangan'] = $p3;
								}

								//get eselon3
								$q4 = $this->db->query("
									select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, d.ttd_unit, unit_satuan_kerja,kop_surat 
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.lokasi_kerja = " . $p2->id_lokasi_kerja . "
											and a.id_eselon in (27,28) 
								");

								foreach ($q4->result() as $p4) {
									$d['eselon3'] = $p4;
								}

								$jabatan_ttd = ucwords(strtolower(isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : ''));
								$filter_jabatan_ttd = trim(str_replace('Kepala', '', $jabatan_ttd));
								$lokasi_ttd = trim(ucwords(strtolower(isset($d['eselon3']->lokasi_kerja) ? $d['eselon3']->lokasi_kerja : '')));
								$lokasi_ttd = trim(str_replace($filter_jabatan_ttd, '', $lokasi_ttd));
								// $d['ket_ttd'] = 'a.n. ' . $jabatan_ttd . '<br />' . $lokasi_ttd . '<br />';
								// $d['ket_ttd'] .= ucwords(strtolower($d['penandatangan']->nama_jabatan)) . ',';

								// new
								$nama_jabatan_new = isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : '';
								$ttd_unit_new = isset($d['eselon3']->ttd_unit) ? $d['eselon3']->ttd_unit : '';
								$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
								$d['ket_ttd'] = 'a.n. '.$nama_jabatan_new.'<br>'.$ttd_unit_new.'<br>'.$penandatangan_new.',';
							}
						}

						$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/export', $d);
					} else {
						echo 'Request tidak valid.';
					}
				}
			} else {
				echo 'Request tidak valid.';
			}
		} else {
			echo 'Request tidak valid.';
		}
	}


	public function download_surat_digital($id_surat = 0)
	{
		if ($this->session->userdata('logged_in') != "") {
			if ($id_surat != 0) {
				$this->load->library('Pdf');

				$d['surat'] = null;
				$d['header_surat'] = '';
				$d['pegawai'] = null;
				$d['penandatangan'] = null;
				$dt['eselon3'] = null;
				$d['ket_ttd'] = '';
				$d['lokasi_kerja_ttd'] = '';
				$d['signature'] = '';

				//get data surat
				$q = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
				foreach ($q->result() as $p) {
					$d['surat'] = $p;

					//update is_download
					if ($this->db->update('tbl_data_srt_ket', ['is_download' => ((int) $p->is_download + 1)], ['id_srt' => $id_surat])) {

						//get data pegawai
						$q2 = $this->db->query(
							"SELECT a.nip, a.nrk, a.nama_pegawai, a.id_status_jabatan, a.id_jabatan, a.lokasi_kerja as id_lokasi_kerja, 
								b.id_nama_jabatan, b.nama_jabatan, b.level_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, 
								d.dinas, e.sub_lokasi_kerja , d.dinas, d.ttd_unit, unit_satuan_kerja,kop_surat
							from tbl_data_pegawai a
							left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
							left join tbl_master_golongan c on a.id_golongan = c.id_golongan
							left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja 
							left join tbl_master_sub_lokasi_kerja e on a.seksi = e.id_sub_lokasi_kerja 
							where a.id_pegawai = " . $p->id_user
						);

						foreach ($q2->result() as $p2) {
							// echo '<pre>'.print_r($p2,true).'</pre>';exit;
							$d['pegawai'] = $p2;
							$d['header_surat'] = strtoupper(strtolower($p2->lokasi_kerja));
							$d['header_surat'] = str_replace('PUSAT DATA DAN INFORMASI ', 'PUSAT DATA DAN INFORMASI<br>', $d['header_surat']);
							if($p2->dinas=='1'){
								$d['header_surat'] = strtoupper(strtolower('DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA'));
							} else {
								$d['header_surat'] = strtoupper(strtolower($p2->lokasi_kerja));
							}
							// echo '<pre>'.print_r($d['pegawai'],true).'</pre>';exit;
							//get atasan
							if ($p2->dinas == 1) {
								//dinas
								//yg bertanda tangan sekertaris, atas nama kepala dinas
								$q3 = $this->db->query(
									"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, a.signature, d.ttd_unit, unit_satuan_kerja,kop_surat
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 2
								");
								foreach ($q3->result() as $p3) {
									$d['penandatangan'] = $p3;
									// echo '<pre>'.print_r($p3,true).'</pre>';exit;
								}

								//get kadis
								$q4 = $this->db->query(
									"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, d.ttd_unit, unit_satuan_kerja,kop_surat
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 1
								");

								foreach ($q4->result() as $p4) {
									$d['eselon3'] = $p4;
								}

								$jabatan_ttd = ucwords(strtolower($d['eselon3']->nama_jabatan));
								$filter_jabatan_ttd = trim(str_replace('Kepala', '', $jabatan_ttd));
								$lokasi_ttd = trim(ucwords(strtolower($d['eselon3']->lokasi_kerja)));
								$lokasi_ttd = trim(str_replace($filter_jabatan_ttd, '', $lokasi_ttd));
								// $d['ket_ttd'] = 'a.n. ' . $jabatan_ttd . '<br />' . $lokasi_ttd . '<br />';
								// $d['ket_ttd'] .= trim(str_replace('Dinas', '', ucwords(strtolower($d['penandatangan']->nama_jabatan)))) . ',';
								// new
								$nama_jabatan_new = isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : '';
								$ttd_unit_new = isset($d['eselon3']->ttd_unit) ? $d['eselon3']->ttd_unit : '';
								$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
								$d['ket_ttd'] = 'a.n. '.$nama_jabatan_new.'<br>'.$ttd_unit_new.'<br>'.$penandatangan_new.',';
								$Date_now = date('Y-m-d');
								$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($Date_now);
							} else {
								//upt & sudin
								//yg bertanda tangan kasubag tu a.n. eselon 3

								//get penandatangan
								$q3 = $this->db->query(
									"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, a.signature  , d.ttd_unit, unit_satuan_kerja,kop_surat
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.lokasi_kerja = " . $p2->id_lokasi_kerja . "
											and a.id_jabatan = 61
								");
								foreach ($q3->result() as $p3) {
									$d['penandatangan'] = $p3;
									if ($p3->signature != '') {
										$d['signature'] = './asset/foto_pegawai/signature/' . $p3->signature;
									}
								}

								//get eselon3
								$q4 = $this->db->query(
									"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, d.ttd_unit, unit_satuan_kerja,kop_surat
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.lokasi_kerja = " . $p2->id_lokasi_kerja . "
											and a.id_eselon in (27,28) 
								");

								foreach ($q4->result() as $p4) {
									$d['eselon3'] = $p4;
								}

								$jabatan_ttd = ucwords(strtolower(isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : ''));
								$filter_jabatan_ttd = trim(str_replace('Kepala', '', $jabatan_ttd));
								$lokasi_ttd = trim(ucwords(strtolower(isset($d['eselon3']->lokasi_kerja) ? $d['eselon3']->lokasi_kerja : '')));
								$lokasi_ttd = trim(str_replace($filter_jabatan_ttd, '', $lokasi_ttd));
								// $d['ket_ttd'] = 'a.n. ' . $jabatan_ttd . '<br />' . $lokasi_ttd . '<br />';
								// $d['ket_ttd'] .= ucwords(strtolower($d['penandatangan']->nama_jabatan)) . ',';
								// new
								$nama_jabatan_new = isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : '';
								$ttd_unit_new = isset($d['eselon3']->ttd_unit) ? $d['eselon3']->ttd_unit : '';
								$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
								$d['ket_ttd'] = 'a.n. '.$nama_jabatan_new.'<br>'.$ttd_unit_new.'<br>'.$penandatangan_new.',';
								$Date_now = date('Y-m-d');
								$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($Date_now);
							}
						}
						//$d['pegawai'] = $pegawai;
						$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/export_digital', $d);
					} else {
						echo 'Request tidak valid.';
					}
				}
			} else {
				echo 'Request tidak valid.';
			}
		} else {
			echo 'Request tidak valid.';
		}
	}

	public function processUpload()
	{
		$status = false;
		$message = false;

		$id_surat = $this->input->post('id_surat');
		$file = $this->input->post('file');

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != 0 && $file != '') {
			$file = $this->input->post('file');
			$context = $file['context'];
			$filename_ori = $file['file_name'];
			@list($type, $file_data) = explode(';', $context);
			@list(, $file_data) = explode(',', $file_data);

			$data_type = explode('.', $filename_ori);
			$data_type = $data_type[count($data_type) - 1];
			$filename = md5(microtime()) . '.' . $data_type;
			$file_size = strlen(base64_decode($file_data));

			//get file name old
			$qOldSurat = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
			foreach ($qOldSurat->result() as $s) {
				$surat = $s;
				if ($s->file_name != '') {
					$file_old = "asset/kertas_kerja/surat_keterangan/" . $s->file_name;
					if (file_exists($file_old)) {
						unlink($file_old);
					}
				}
			}

			$path = "./asset/kertas_kerja/surat_keterangan/";
			if (file_put_contents($path . '/' . $filename, base64_decode($file_data))) {
				$upd = [
					'id_status_srt' => 3,
					'file_name' => $filename,
					'file_name_ori' => $filename_ori
				];

				if ($this->db->update('tbl_data_srt_ket', $upd, ['id_srt' => $id_surat])) {
					//insert history
					$hist_srt['id_srt'] = $id_surat;
					$hist_srt['id_user'] = $surat->id_user;
					$hist_srt['created_at'] = date("Y-m-d H:i:s");
					$hist_srt['created_by'] = $this->session->userdata("id_user");
					$hist_srt['id_status_srt'] = 3;	//selesai

					if ($this->db->insert('tbl_history_srt_ket', $hist_srt)) {
						$status = true;
					} else {
						$message = 'Gagal simpan history data.';

						$upd = [
							'id_status_srt' => $surat->id_status_srt,
							'file_name' => $surat->file_name,
							'file_name_ori' => $surat->file_name_ori
						];
						$this->db->update('tbl_data_srt_ket', $upd, ['id_srt' => $id_surat]);

						$file_old = "asset/kertas_kerja/surat_keterangan/" . $filename;
						if (file_exists($file_old)) {
							unlink($file_old);
						}
					}
				} else {
					$message = 'Gagal update data.';

					$file_old = "asset/kertas_kerja/surat_keterangan/" . $filename;
					if (file_exists($file_old)) {
						unlink($file_old);
					}
				}
			} else {
				$message = 'Gagal menyimpan file : ' . $filename_ori;
			}
		} else {
			$message = 'Request tidak valid.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function download_surat_finished($id_surat = 0)
	{
		if ($this->session->userdata('logged_in') != "" && $id_surat != 0) {
			//get data surat
			$q = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
			foreach ($q->result() as $p) {
				$path_file = file_get_contents('asset/kertas_kerja/surat_keterangan/' . $p->file_name);
				force_download($p->file_name_ori, $path_file);
			}
		} else {
			echo 'Gagal download file.';
		}
	}

	public function delete()
	{
		$status = false;
		$message = false;

		$id_surat = $this->input->post('id_surat');
		$surat = null;
		$q = $this->db->get_where("tbl_data_srt_ket", ['id_srt' => $id_surat]);
		foreach ($q->result() as $p) {
			$surat = $p;
		}

		if ($surat != null) {
			//delete history
			if ($this->db->where('id_srt', $id_surat)->delete('tbl_history_srt_ket')) {
				if ($this->db->where('id_srt', $id_surat)->delete('tbl_data_srt_ket')) {
					$status = true;

					//delete file 
					if ($surat->file_name != '') {
						$file_old = "asset/kertas_kerja/surat_keterangan/" . $surat->file_name;
						if (file_exists($file_old)) {
							unlink($file_old);
						}
					}
				} else {
					$message = 'Hapus data gagal.';
				}
			} else {
				$message = 'Hapus data gagal.';
			}
		} else {
			$message = 'Request tidak valid.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}
}

/* End of file surat_keterangan.php */
/* Location: ./application/controllers/surat_keterangan.php */
