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
		$this->load->library('func_wa_sk');
		$this->load->model('srt_ket_model');
		date_default_timezone_set("Asia/Jakarta");
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
				} else if ($q->id_status_srt == '24') {
					$kondisi = " WHERE x.id_status in ('0','21' ,'24')";
				} else if ($q->id_status_srt == '25') {
					$kondisi = " WHERE x.id_status in ('0','21' ,'22','25')";
				} else if ($q->id_status_srt == '26') {
					$kondisi = " WHERE x.id_status in ('0','21' ,'22','23','26')";
				} else if ($q->id_status_srt == '28') {
					$kondisi = " WHERE x.id_status in ('0','21' ,'27','28')";
				} else {
					if ($q->select_ttd == 'basah') { //basah
						$kondisi = " WHERE x.id_status NOT IN ('1', '24', '25', '26', '28') ";
					} else if ($q->select_ttd == 'digital') {  //menunggu, langsung selesai
						$kondisi = " WHERE x.id_status NOT IN ('1', '24', '25', '26', '28') ";
					} else {
						$kondisi = " WHERE x.id_status NOT IN ('1', '24', '25', '26', '28') ";
					}
				}
				// $Q_Pegawai = $this->db->query("SELECT lokasi_kerja, dinas, id_pegawai FROM tbl_data_srt_ket 
				// 								LEFT JOIN (
				// 									SELECT
				// 										a.id_pegawai, a.lokasi_kerja, b.dinas
				// 									FROM
				// 										tbl_data_pegawai AS a
				// 									LEFT JOIN tbl_master_lokasi_kerja AS b ON a.lokasi_kerja = b.id_lokasi_kerja
				// 								) list ON tbl_data_srt_ket.id_user = list.id_pegawai
				// 								WHERE id_srt = '$id_surat'")->row();

				if ($q->is_dinas == '1' and $q->tgl_surat >= '2022-11-02 00:00:00') { //bidang dan sekretariat
					$kondisi_bidang = " AND x.sort_bidang != '0'";
					$kond_order = " x.sort_bidang";
				} else if ($q->is_dinas != '1' and $q->tgl_surat >= '2022-11-02 00:00:00') {
					$kondisi_bidang = " AND x.sort_sudinupt != '0'";
					$kond_order = " x.sort_sudinupt";
				} else {
					$kondisi_bidang = " AND x.sort != '0'";
					$kond_order = " x.sort";
				}

				$Query_history = $this->db->query("SELECT 
													x.id_status, x.nama_status, x.style, x.sort as urutan, x.sort_bidang as urutan_bidang,
													y.id_srt, y.id_status_srt, y.created_by, y.created_at, y.id_user, y.nama_lengkap , y.nama_pengaju
													FROM tbl_status_surat x
													LEFT JOIN (
																	SELECT a.id_srt, a.id_status_srt, a.created_by, a.created_at, a.id_user, nama_lengkap , nama_pengaju
																	FROM tbl_history_srt_ket a 
																	LEFT JOIN (
																		SELECT id_pegawai, nama_lengkap as nama_pengaju FROM tbl_user_login b where id_pegawai !='0'
																	) b ON b.id_pegawai = a.created_by
																	LEFT JOIN (
																		SELECT id_user_login, nama_lengkap FROM tbl_user_login c
																	) c ON c.id_user_login = a.created_by
																	WHERE a.id_srt='$id_surat'
																	GROUP BY a.id_srt,a.id_status_srt
													) y ON y.id_status_srt = x.id_status 
													$kondisi $kondisi_bidang
													ORDER BY $kond_order ASC")->result();
				$d['Query_history'] = $Query_history;
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
		$Q_Pegawai = $this->db->query("SELECT lokasi_kerja, dinas, id_pegawai, id_status_srt FROM tbl_data_srt_ket 
										LEFT JOIN (
											SELECT
												a.id_pegawai, 
												a.lokasi_kerja, 
												b.dinas
											FROM
												tbl_data_pegawai AS a
											LEFT JOIN tbl_master_lokasi_kerja AS b ON a.lokasi_kerja = b.id_lokasi_kerja
										) list ON tbl_data_srt_ket.id_user = list.id_pegawai
												WHERE id_srt = '$Id'")->row();

		if ($Query_data->is_dinas == '1' and ($Query_data->id_status_srt == '0' || $Query_data->id_status_srt == '25' || $Query_data->id_status_srt == '28')) { //bidang dan sekretariat
			$terima = "21";
			$tolak = "24";
		} else if ($Query_data->is_dinas == '1' and $Query_data->id_status_srt == '21') { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Query_data->is_dinas == '1' and $Query_data->id_status_srt == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else if ($Query_data->is_dinas != '1' and $Query_data->id_status_srt == '0') { //diverifikasi admin
			$terima = "21";
			$tolak = "24";
		} else if ($Query_data->is_dinas != '1' and $Query_data->id_status_srt == '21') { //diverifikasi kaksubbag terkait
			$terima = "27";
			$tolak = "28";
		} else if ($Query_data->is_dinas != '1' and ($Query_data->id_status_srt == '0' || $Query_data->id_status_srt == '25' || $Query_data->id_status_srt == '28')) { //diverifikasi admin
			$terima = "21";
			$tolak = "24";
		} else {
			$terima = "2";
			$tolak = "1";
		}

		$a['Id'] 			= $this->input->post('Id');
		$a['data'] 			= $Query_data;
		$a['qpegawai'] 		= $Q_Pegawai;
		$a['terima'] 		= $terima;
		$a['tolak'] 		= $tolak;

		$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/form_verifikasi', $a);
	}

	function form_ubah_keperluan()
	{
		$Id 	= $this->input->post('Id'); //id surat
		$id_pegawai = $this->session->userdata('id_pegawai');
		$Data = $this->db->query("SELECT
										a.id_srt, a.id_user, a.nama, 
										a.nip, a.nrk, a.alamat_domisili, 
										a.status_pegawai, a.keterangan, 
										a.jenis_surat, a.jenis_pengajuan_surat, 
										a.jenis_pengajuan_surat_lainnya, a.tgl_surat, 
										a.id_status_srt, a.keterangan_ditolak, 
										a.select_ttd, a.tgl_proses, 
										a.id_user_proses, a.is_download, 
										a.file_name, a.file_name_ori, 
										a.nomor_surat, a.Created_at, a.Updated_at, a.Updated_by,a.lokasi_kerja_pegawai,a.is_dinas,
										b.nama_surat, nama_status as `status`, sort, sort_bidang,
										IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan, d.lokasi_kerja as nama_lokasi_kerja
									FROM
										tbl_data_srt_ket AS a
									LEFT JOIN (
										SELECT id_mst_srt, nama_surat FROM tbl_master_surat
									) AS b ON b.id_mst_srt = a.jenis_surat
									LEFT JOIN (
										SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
									) AS c ON c.id_status = a.id_status_srt
									LEFT JOIN (
										SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
									) AS d ON d.id_lokasi_kerja = a.lokasi_kerja_pegawai
									LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
									WHERE a.id_srt ='$Id'")->row();
		$a['mst_jenis_pengajuan_surat'] = $this->srt_ket_model->jenis_pengajuan_surat();

		$a['Id'] 		= $Id;
		$a['Data'] 		= $Data;

		$this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/form_ubah_keperluan', $a);
	}

	public function simpan_ubah_keperluan()
	{
		$status = false;
		$message = '';

		$id_surat = $this->input->post('id_surat');
		$in['jenis_pengajuan_surat'] = $this->input->post('jenis_pengajuan_surat');
		if (strtolower($in['jenis_pengajuan_surat']) == 'x') {
			$in['jenis_pengajuan_surat_lainnya'] = $this->input->post('jenis_pengajuan_surat_lainnya');
		} else {
			$in['jenis_pengajuan_surat_lainnya'] = null;
		}

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != 0) {
			$surat = null;
			$qOldSurat = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
			foreach ($qOldSurat->result() as $s) {
				$surat = $s;
			}

			if ($surat != null) {

				if ($this->db->update('tbl_data_srt_ket', $in, ['id_srt' => $id_surat])) {
					$status = true;
					$message = 'Berhasil menyimpan data.';
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

			if ($surat != null) {
				//proses update 
				$in = array(
					'id_status_srt' => $dec,
					'keterangan_ditolak' => $ket,
					'select_ttd' => $select_ttd,
					// 'nomor_surat' => $nomor_surat,
					'tgl_proses' => date('Y-m-d H:i:s'),
					'Updated_at' => date('Y-m-d H:i:s'),
					'id_user_proses' => $this->session->userdata("id_user"),
					'Updated_by' => $this->session->userdata("id_user")
				);

				if ($this->db->update('tbl_data_srt_ket', $in, ['id_srt' => $id_surat])) {
					//insert history
					$hist_srt['id_srt'] = $id_surat;
					$hist_srt['id_user'] = $surat->id_user;
					$hist_srt['created_at'] = date("Y-m-d H:i:s");
					$hist_srt['created_by'] = $this->session->userdata("id_user");
					$hist_srt['id_status_srt'] = $dec;

					if ($this->db->insert('tbl_history_srt_ket', $hist_srt)) {
						$status = true;
						$see = $this->func_table->in_tosee_sk($surat->id_user, $id_surat, $dec, $this->session->userdata("id_user"));
						$send_notif_sk 	= $this->func_wa_sk->notif_sk_update($id_surat);
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
				//$this->load->library('m_pdf');

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
					$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($p->Updated_at);

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
							if ($p2->dinas == '1') {
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
								$d['ket_ttd'] = 'a.n. ' . $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>' . $penandatangan_new . ',';
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
											-- and a.id_eselon in (27,28) 
											and a.id_eselon in (29,30) 
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
								$d['ket_ttd'] = 'a.n. ' . $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>' . $penandatangan_new . ',';
							}
						}

						// == read notif ===
						$this->func_table->in_tosee_sk($p->id_user, $p->id_srt, $p->id_status_srt, $p->id_user);

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
				//$this->load->library('m_pdf');

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
					$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($p->Updated_at);

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
							if ($p2->dinas == '1') {
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
									"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, a.signature, d.ttd_unit, unit_satuan_kerja,kop_surat, stamp
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 2
								"
								);
								foreach ($q3->result() as $p3) {
									$d['penandatangan'] = $p3;
									if ($p3->signature != '') {

										if ($p3->signature != '') {
											// $signature =  base_url(). 'asset/foto_pegawai/signature/' . $p3->signature;
											// // $stamp =  base_url(). 'asset/foto_pegawai/signature/combine/stamp/' . $p3->stamp;
											// $Combine_image 	= $this->func_table->Combine_signature2($signature, $p3->signature);
											$d['signature'] = base_url() . 'asset/foto_pegawai/signature/' . $p3->signature;
										} else {
											$d['signature'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
										}
										$d['stamp'] =  base_url() . 'asset/foto_pegawai/signature/stamp/' . $p3->stamp;
									}
								}

								//get kadis
								$q4 = $this->db->query(
									"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, a.signature, d.ttd_unit, unit_satuan_kerja,kop_surat, stamp
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 1
								"
								);

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
								$d['ket_ttd'] = 'a.n. ' . $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>' . $penandatangan_new . ',';
								$Date_now = date('Y-m-d');
								//$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($Date_now);
							} else {
								//upt & sudin
								//yg bertanda tangan kasubag tu a.n. eselon 3

								//get penandatangan
								$q3 = $this->db->query(
									"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, a.signature  , d.ttd_unit, unit_satuan_kerja,kop_surat, stamp
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.lokasi_kerja = " . $p2->id_lokasi_kerja . "
											and a.id_jabatan = 61
								"
								);
								foreach ($q3->result() as $p3) {
									$d['penandatangan'] = $p3;
									if ($p3->signature != '') {
										if ($p3->signature != '') {
											// $signature =  base_url(). 'asset/foto_pegawai/signature/' . $p3->signature;
											// // $stamp =  base_url(). 'asset/foto_pegawai/signature/combine/stamp/' . $p3->stamp;
											// $Combine_image 	= $this->func_table->Combine_signature2($signature, $p3->signature);
											$d['signature'] = base_url() . 'asset/foto_pegawai/signature/' . $p3->signature;
										} else {
											$d['signature'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
										}
										$d['stamp'] =  base_url() . 'asset/foto_pegawai/signature/stamp/' . $p3->stamp;
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
								"
								);

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
								$d['ket_ttd'] = 'a.n. ' . $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>' . $penandatangan_new . ',';
								$Date_now = date('Y-m-d');
								//$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($Date_now); 
							}
						}
						//$d['pegawai'] = $pegawai;

						// == read notif ===
						$this->func_table->in_tosee_sk($p->id_user, $p->id_srt, $p->id_status_srt, $p->id_user);

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
						$see = $this->func_table->in_tosee_sk($surat->id_user, $id_surat, '3', $this->session->userdata("id_user"));
						$send_notif_sk 	= $this->func_wa_sk->notif_sk_update($id_surat);
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
	public function download_surat_finished_public($id_surat = 0)
	{
		if ($this->session->userdata('logged_in') != "" && $id_surat != 0) {
			//get data surat
			$q = $this->db->get_where('tbl_data_srt_ket', ['id_srt' => $id_surat]);
			foreach ($q->result() as $p) {
				$filename = './asset/kertas_kerja/surat_keterangan/' . $p->file_name;
				// Header content type
				header("Content-type: application/pdf");

				header("Content-Length: " . filesize($filename));

				// Send the file to the browser.
				readfile($filename);
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

	function show_timeline()
	{
		// ===== surat keterangan history =====
		$id_srt = $this->input->post('id_srt');

		$sSQL = "SELECT his.id_srt, his.created_by, surat.is_dinas,
					if(isnull(log.nama_lengkap), '-', log.nama_lengkap) nama_pegawai, 
					his.created_at,
					stat.id_status, stat.nama_status, stat.style, surat.keterangan_ditolak, 
					if(isnull(lok.dinas), '-', lok.dinas) dinas, 
					if(isnull(peg.lokasi_kerja), '-', peg.lokasi_kerja) lokasi_kerja_id, 
					if(isnull(lok.lokasi_kerja), '-', lok.lokasi_kerja) lokasi_kerja_desc
				from tbl_history_srt_ket his
					join tbl_data_srt_ket surat
						on surat.id_srt = his.id_srt
					join tbl_status_surat stat
						on stat.id_status = his.id_status_srt
					left join tbl_data_pegawai peg
						on peg.id_pegawai = his.created_by
					left join tbl_user_login log
						on log.id_user_login = his.created_by
					left join tbl_master_lokasi_kerja lok
						on lok.id_lokasi_kerja = peg.lokasi_kerja
				where his.id_srt = '$id_srt'
				order by his.created_at, his.id_history_srt_ket";
		$rsSQL = $this->db->query($sSQL);
		$a['data_history'] = $rsSQL;

		// $this->load->view('dashboard_admin/kertas_kerja/surat_keterangan/timeline', $a);
		$this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline', $a);
	}
}

/* End of file surat_keterangan.php */
/* Location: ./application/controllers/surat_keterangan.php */
