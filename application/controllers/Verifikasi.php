<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
	
	/*
		***	Controller : Verifikasi.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_wa_sk');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_verifikasi', 'verifikasi');
		$this->load->library('upload');
		$this->load->model('srt_ket_model');
		// $this->load->model('arsip_hukuman_model');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat_instansi'] = $this->config->item('alamat_instansi');

			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');

			$q = $this->db->get_where("tbl_data_pegawai", $id);
			$set_detail = $q->row();
			$this->session->set_userdata("nama_pegawai", $set_detail->nama_pegawai);

			$count_see = $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj = $this->func_table->count_see_tj($this->session->userdata('username'));
			$count_see_kaku	= $this->func_table->count_see_kaku($this->session->userdata('username'));
			$count_see_verifikasi = $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
			$count_see_verifikasi_tj = $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
			$count_see_verifikasi_kaku = $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));
			$count_see_verifikasi_hukdis = $this->func_table->count_see_verifikasi_hukdis($this->session->userdata('username'));
			$count_see_verifikasi_tp = $this->func_table->count_see_verifikasi_tp($this->session->userdata('username'));
			$count_see_verifikasi_karir = $this->func_table->count_see_verifikasi_karir($this->session->userdata('username'));

			$status_verifikasi = $this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));
			if ($status_verifikasi == 'kepegawaian' || $status_verifikasi == 'sekdis' || $status_verifikasi == 'sudinupt') {
				$d['status_user'] = 'true';
			} else {
				$d['status_user'] = 'false';
			}
			foreach ($q->result() as $data) {
				$d['id_param'] = $data->id_pegawai;
				$d['nip'] = $data->nip;
				$d['nrk'] = $data->nrk;
				$d['email'] = $data->email;
				$d['telepon'] = $data->telepon;
				$d['nama_pegawai'] = $data->nama_pegawai;
				$d['status_pegawai'] = $data->status_pegawai;
				$d['id_jabatan'] = $data->id_jabatan;
				$d['id_bidang'] = $data->id_bidang;
				$d['lokasi_kerja'] = $data->lokasi_kerja;
				$d['seksi'] = $data->seksi;
				$d['masa_kerja'] = $data->masa_kerja;
				$d['usia'] =  $data->usia;
				$d['jenis_kelamin'] = $data->jenis_kelamin;
				$d['tempat_lahir'] =  $data->tempat_lahir;
				$d['tanggal_lahir'] = $data->tanggal_lahir;
				$d['agama'] = $data->agama;
				$d['status_nikah'] = $data->status_nikah;
				$d['alamat'] =  $data->alamat;
				$d['kode_kelurahan'] =  $data->kode_kelurahan;
				$d['nama_kelurahan'] =  $data->nama_kelurahan;
				$d['kode_kecamatan'] =  $data->kode_kecamatan;
				$d['nama_kecamatan'] =  $data->nama_kecamatan;
				$d['kode_kabupaten'] =  $data->kode_kabupaten;
				$d['nama_kabupaten'] =  $data->nama_kabupaten;
				$d['kode_provinsi'] =  $data->kode_provinsi;
				$d['nama_provinsi'] =  $data->nama_provinsi;
				$d['alamat_ktp'] =  $data->alamat_ktp;
				$d['kode_kelurahan_ktp'] =  $data->kode_kelurahan_ktp;
				$d['nama_kelurahan_ktp'] =  $data->nama_kelurahan_ktp;
				$d['kode_kecamatan_ktp'] =  $data->kode_kecamatan_ktp;
				$d['nama_kecamatan_ktp'] =  $data->nama_kecamatan_ktp;
				$d['kode_kabupaten_ktp'] =  $data->kode_kabupaten_ktp;
				$d['nama_kabupaten_ktp'] =  $data->nama_kabupaten_ktp;
				$d['kode_provinsi_ktp'] =  $data->kode_provinsi_ktp;
				$d['nama_provinsi_ktp'] =  $data->nama_provinsi_ktp;
				$d['longitude'] = $data->longitude;
				$d['latitude'] = $data->latitude;
				$d['pendidikan'] = $data->pendidikan;
				$d['pendidikan_bkd'] = $data->pendidikan_bkd;
				$d['asal_sekolah'] = $data->asal_sekolah;
				$d['tgl_lulus'] = $data->tgl_lulus;
				$d['id_golongan'] = $data->id_golongan;
				$d['id_eselon'] = $data->id_eselon;
				$d['nomor_sk_pangkat'] = $data->nomor_sk_pangkat;
				$d['tanggal_sk_pangkat'] = $data->tanggal_sk_pangkat;
				$d['tanggal_mulai_pangkat'] = $data->tanggal_mulai_pangkat;
				$d['tanggal_pengangkatan_cpns'] = $data->tanggal_pengangkatan_cpns;
				$d['id_status_jabatan'] = $data->id_status_jabatan;
				$d['status_pegawai_pangkat'] = $data->status_pegawai_pangkat;
				$d['nomor_sk_jabatan'] = $data->nomor_sk_jabatan;
				$d['tanggal_sk_jabatan'] = $data->tanggal_sk_jabatan;
				$d['tanggal_mulai_jabatan'] = $data->tanggal_mulai_jabatan;
				$d['foto'] = $data->foto;
				$signature = base_url() . 'asset/foto_pegawai/no-image/nosignature.png';
				if ($data->signature) {
					$signature = base_url() . 'asset/foto_pegawai/signature/thumb/' . $data->signature;
				}
				$d['signature'] = $signature;
				$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;
				$d['id_satuan_kerja'] = $data->id_satuan_kerja;
				$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;
				$d['tmt_eselon'] = $data->tmt_eselon;
			}
			$this->load->helper('url');
			$x['count_see'] = $count_see;

			//see
			$d['count_see'] = $count_see;
			$d['count_see_tj'] = $count_see_tj;
			$d['count_see_kaku'] = $count_see_kaku;
			$d['count_see_verifikasi'] = $count_see_verifikasi;
			$d['count_see_verifikasi_tj'] = $count_see_verifikasi_tj;
			$d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;
			$d['count_see_verifikasi_hukdis'] = $count_see_verifikasi_hukdis;
			$d['count_see_verifikasi_tp'] = $count_see_verifikasi_tp;
			$d['count_see_verifikasi_karir'] = $count_see_verifikasi_karir;

			$this->load->view('dashboard_publik/verifikasi/index_verifikasi', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function data_verifikasi()
	{
		$this->load->view('dashboard_publik/verifikasi/ajax_table');
	}

	function table_data_verifikasi()
	{

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');

		$status_verifikasi = $this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));

		$listing 		= $this->verifikasi->listing($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);
		$jumlah_filter 	= $this->verifikasi->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);
		$jumlah_semua 	= $this->verifikasi->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);


		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			$no++;
			$row = array();

			$button = '	<a type="button" class="btn btn-info btn-sm" onclick="view_detail(' . "'" . $key->id_srt . "'" . ')">
							<i class="fa fa-eye"></i> &nbsp;Detail
						</a>';

			# jika user adalah kasubag kepegawaian
			# maka yang ditampilkan adalah surat yang statusnya ('21','22','23','24','25','26','3')
			# dan tombol verifikasi muncul di status 21
			# jika user adalah sekdis tombol 22

			if ($status_verifikasi == 'kepegawaian' and ($key->id_status_srt == '21' || $key->id_status_srt == '26')) {
				$button_verifikasi = '	<a type="button" class="btn btn-warning btn-sm" onclick="verifikasi_kep(' . "'" . $key->id_srt . "'" . ')">
											<i class="fa fa-tag"></i> &nbsp;Verifikasi
										</a>';
				$data_bold = '21';
			} else if ($status_verifikasi == 'sekdis' and $key->id_status_srt == '22') {
				$button_verifikasi = '	<a type="button" class="btn btn-warning btn-sm" onclick="verifikasi_kep(' . "'" . $key->id_srt . "'" . ')">
											<i class="fa fa-tag"></i> &nbsp;Verifikasi
										</a>';
				$data_bold = '22';
			} else if ($status_verifikasi == 'sudinupt' and $key->id_status_srt == '21') {
				$button_verifikasi = '	<a type="button" class="btn btn-warning btn-sm" onclick="verifikasi_kep(' . "'" . $key->id_srt . "'" . ')">
											<i class="fa fa-tag"></i> &nbsp;Verifikasi
										</a>';
				$data_bold = '21';
			} else {
				$button_verifikasi = '';
				$data_bold = '';
			}
			if ($key->id_status_srt == '3') {
				if ($key->select_ttd == 'basah') {
					//selesai
					//$button_download = '<a class="btn btn-sm btn-danger" target="_blank" href="'.base_url().'admin/surat_keterangan/download_surat_finished/'.$key->id_srt.'" title="Download"><i class="fa fa-file-pdf-o"></i> Download</a>';
					$button_download = '<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/surat_keterangan/download_surat_finished_public/' . $key->id_srt . '" href="javascript:(0);">
											<button type="button" class="btn btn-danger btn-sm" title="PDF"><i class="fa fa-file-o"></i> &nbsp;Download</button>
										</a>';
				} else {
					//selesai
					$button_download = '<a class="btn btn-sm btn-danger" target="_blank" href="' . base_url() . 'admin/surat_keterangan/download_surat_digital/' . $key->id_srt . '" title="Download">
											<i class="fa fa-file-pdf-o"></i> &nbsp;Download
										</a>';
					// $button_download = '<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/surat_keterangan/download_surat_digital/' . $key->id_srt . '" href="javascript:;">
					// 	<button type="button" class="btn btn-danger btn-sm" title="PDF"><i class="fa fa-file-o"></i>Download</button>
					// </a>';
				}
			} else {
				$button_download = '';
			}

			// === begin: badge-status ===
			switch ((int) $key->id_status_srt) {
				case 0:
					$status_surat = '<span class="badge btn-light btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 21:
					if ($key->is_dinas == 1) {
						$status_surat = '<span class="badge btn-warning btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subkoordinator Kepegawaian</span>';
					} else {
						$status_surat = '<span class="badge btn-warning btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subbagian</span>';
					}
					// $status_surat = '<span class="badge btn-warning btn-flat badge-status" 
					// 						onclick="showTimeline(' . $key->id_srt . ')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 22:
				case 27:
					$status_surat = '<span class="badge btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
				case 23:
					$status_surat = '<span class="badge btn-info btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 3:
					$status_surat = '<span class="badge btn-success btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')" style="background-color; #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 24:
				case 25:
				case 28:
				case 26:
					$status_surat = '<span class="badge btn-danger btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				default:
					$status_surat = '<span class="badge btn-dark btn-flat badge-status" 
									onclick="showTimeline(' . $key->id_srt . ')">' . $key->nama_status_next . '</span>';
					break;
			}
			// === end: badge-status ===

			$row[] = $no;
			$row[] = $button . ' ' . $button_verifikasi . ' ' . $button_download;
			$row[] = $key->nama_surat;
			$row[] = $this->func_table->name_format($key->nama);
			// $row[] = $key->status;
			$row[] = $status_surat;
			$row[] = $key->keterangan_pengajuan;
			$row[] = $key->tgl_proses;
			$row[] = $data_bold;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $jumlah_semua->jml,
			"recordsFiltered" => $jumlah_filter->jml,
			"data" => $data,
		);
		echo json_encode($output);
	}

	function form_verifikasi_kep()
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

		if ($Data->is_dinas == '1' && ($Data->id_status_srt == '21' || $Data->id_status_srt == '26')) { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Data->is_dinas == '1' && $Data->id_status_srt == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else if ($Data->is_dinas != '1'  && $Data->id_status_srt == '21') { //diverifikasi kepegawaian
			$terima = "27";
			$tolak = "28";
		} else {
			$terima = "";
			$tolak = "";
		}
		$a['Id'] 		= $Id;
		$a['Data'] 		= $Data;
		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;

		$this->load->view('dashboard_publik/verifikasi/form_verifikasi_kep', $a);
	}

	function simpan_verifikasi_kep()
	{
		$status = false;
		$message = '';

		$Id 			= $this->input->post('Id'); //id surat
		$username 		= $this->session->userdata('username');
		$status_verify 	= $this->input->post('status_verify');
		$ket 			= $this->input->post('ket');
		$Date_now 		= date('Y-m-d H:i:s');
		$message		= null;

		if ($status_verify == '24' || $status_verify == '25' || $status_verify == '26' || $status_verify == '28') {
			$alasan_ditolak = $ket;
		} else {
			$alasan_ditolak = '';
		}

		$data['id_status_srt'] 		= $status_verify;
		$data['keterangan_ditolak'] = $alasan_ditolak;
		$data['Updated_at'] 		= $Date_now;
		$data['Updated_by'] 		= $this->session->userdata("id_user");

		$this->db->where('id_srt', $Id);
		$Q_update = $this->db->update('tbl_data_srt_ket', $data);
		if ($Q_update) {
			$Q_select = $this->db->query("SELECT * FROM tbl_data_srt_ket WHERE id_srt='$Id'")->row();
			//insert history
			$hist_srt['id_srt'] = $Id;
			$hist_srt['id_user'] = $Q_select->id_user;
			$hist_srt['created_at'] = date("Y-m-d H:i:s");
			$hist_srt['created_by'] = $this->session->userdata("id_user");
			$hist_srt['id_status_srt'] = $status_verify;
			$hist_srt['keterangan_ditolak'] = $alasan_ditolak;
			if ($this->db->insert('tbl_history_srt_ket', $hist_srt)) {
				$see = $this->func_table->in_tosee_sk($Q_select->id_user, $Id, $status_verify, $this->session->userdata("id_user"));
				$status = true;
				$message = 'Berhasil verifikasi.';
			} else {
				$message = 'Gagal verifikasi.';
			}

			if ($Q_select->select_ttd == 'digital' and ($status_verify == '23' || $status_verify == '27')) {
				//insert history
				$hist_srt_digital['id_srt'] = $Id;
				$hist_srt_digital['id_user'] = $Q_select->id_user;
				$hist_srt_digital['created_at'] = date("Y-m-d H:i:s");
				$hist_srt_digital['created_by'] = $this->session->userdata("id_user");
				$hist_srt_digital['id_status_srt'] = 3;
				$hist_srt_digital['keterangan_ditolak'] = $alasan_ditolak;
				$this->db->insert('tbl_history_srt_ket', $hist_srt_digital);
				$this->db->query("UPDATE tbl_data_srt_ket SET id_status_srt = '3' WHERE id_srt='$Id'");
			}
			$send_notif_sk 	= $this->func_wa_sk->notif_sk_update($Id);
		} else {
			$message = 'Gagal verifikasi.';
		}
		// echo $message;

		$result = [
			'status' => $status,
			'message' => $message
		];
		echo json_encode($result);
	}

	function form_detail()
	{
		$Id 	= $this->input->post('Id'); //id surat
		$id_pegawai = $this->session->userdata('id_pegawai');
		$Data = $this->db->query(
			"SELECT
				a.id_srt, a.id_user, a.nama, 
				a.nip, a.nrk, a.alamat_domisili, 
				a.status_pegawai, a.keterangan, 
				a.jenis_surat, a.jenis_pengajuan_surat, 
				a.jenis_pengajuan_surat_lainnya, a.tgl_surat, 
				a.id_status_srt, a.keterangan_ditolak, 
				a.select_ttd, a.tgl_proses, 
				a.id_user_proses, a.is_download, 
				a.file_name, a.file_name_ori, 
				a.nomor_surat, a.Created_at, a.Updated_at, a.Updated_by,
				b.nama_surat, nama_status as `status`, sort, sort_bidang,
				IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
				list.lokasi_kerja, list.dinas, list.nama_lokasi_kerja
			FROM
				tbl_data_srt_ket AS a
			LEFT JOIN (
				SELECT id_mst_srt, nama_surat FROM tbl_master_surat
			) AS b ON b.id_mst_srt = a.jenis_surat
			LEFT JOIN (
				SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
			) AS c ON c.id_status = a.id_status_srt
			LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
			LEFT JOIN (
				SELECT
					ax.id_pegawai, ax.lokasi_kerja, bx.dinas, bx.lokasi_kerja as nama_lokasi_kerja
				FROM
					tbl_data_pegawai AS ax
				LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
				-- WHERE dinas = '1'
			) list ON a.id_user = list.id_pegawai
			
			WHERE a.id_srt ='$Id'"
		)->row();
		if ($Data->id_status_srt == '21') { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Data->id_status_srt == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else {
			$terima = "";
			$tolak = "";
		}
		$a['Id'] 		= $Id;
		$a['Data'] 		= $Data;
		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;
		$a['master_lapor'] = $this->db->query("SELECT * FROM tr_master_lapor ORDER BY Id ASC")->result();

		// ===== surat keterangan history =====
		$id_srt = $Id;

		$sSQL = "SELECT his.id_srt, his.created_by, surat.is_dinas,
					if(isnull(log.nama_lengkap), '-', log.nama_lengkap) nama_pegawai, 
					his.created_at,
					stat.id_status, stat.nama_status, surat.keterangan_ditolak, 
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
		$rsSQL = $this->db->query($sSQL)->result();
		$a['data_history'] = $rsSQL;
		// ===== /surat keterangan history =====

		$this->load->view('dashboard_publik/verifikasi/form_detail', $a);
	}

	public function notify_me()
	{
		$count_see_verifikasi 		= $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
		$count_see_verifikasi_tj 	= $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
		$count_see_verifikasi_kaku 	= $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));
		$count_see_verifikasi_hukdis 	= $this->func_table->count_see_verifikasi_hukdis($this->session->userdata('username'));
		$count_see_verifikasi_tp 	= $this->func_table->count_see_verifikasi_tp($this->session->userdata('username'));
		$count_see_verifikasi_karir 	= $this->func_table->count_see_verifikasi_karir($this->session->userdata('username'));

		$total_verifikasi = $count_see_verifikasi + $count_see_verifikasi_tj + $count_see_verifikasi_kaku + $count_see_verifikasi_hukdis + $count_see_verifikasi_tp + $count_see_verifikasi_karir;

		if ($count_see_verifikasi > 0) {
			$res_count_see_verifikasi = '<span class="badge btn-warning btn-flat">' . $count_see_verifikasi . '</span>';
		} else {
			$res_count_see_verifikasi = '';
		}

		if ($total_verifikasi > 0) {
			$res_total_verifikasi = '<span class="badge btn-warning btn-flat">' . $total_verifikasi . '</span>';
		} else {
			$res_total_verifikasi = '';
		}

		$result = [
			'verifikasi_keterangan' => $res_count_see_verifikasi,
			'total_verifikasi' => $res_total_verifikasi
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
					stat.id_status, stat.nama_status, surat.keterangan_ditolak, 
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
		$rsSQL = $this->db->query($sSQL)->result();
		$a['data_history'] = $rsSQL;

		$this->load->view('dashboard_publik/verifikasi/timeline', $a);
	}
}
// End of file Verifikasi.php
// Location: ./application/controllers/Verifikasi.php
