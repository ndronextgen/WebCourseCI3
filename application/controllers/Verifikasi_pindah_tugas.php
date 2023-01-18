<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi_pindah_tugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_table_lapor');
		//$this->load->library('func_wa_sk');
		$this->load->library('func_wa_pindah_tugas');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_verifikasi_pindah_tugas', 'pindah_tugas');
		$this->load->library('upload');
		//$this->load->model('srt_ket_model');
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

			// === notif count ===
			$count_see = $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			$count_see_tj = $this->func_table->count_see_tj($this->session->userdata('username'));
			$count_see_kaku	= $this->func_table->count_see_kaku($this->session->userdata('username'));
			$count_see_verifikasi = $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
			$count_see_verifikasi_tj = $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
			$count_see_verifikasi_kaku = $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));
			$count_see_verifikasi_hukdis = $this->func_table->count_see_verifikasi_hukdis($this->session->userdata('username'));
			$count_see_verifikasi_tp = $this->func_table->count_see_verifikasi_tp($this->session->userdata('username'));
			$count_see_verifikasi_karir = $this->func_table->count_see_verifikasi_karir($this->session->userdata('username'));
			$count_see_lapor = $this->func_table_lapor->count_see_lapor_public($this->session->userdata('username'));
			$count_see_verifikasi_pindah_tugas = $this->func_table->count_see_verifikasi_pindah_tugas($this->session->userdata('username'));

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

			// === notif count ===
			$d['count_see'] = $count_see;
			$d['count_see_tj'] = $count_see_tj;
			$d['count_see_kaku'] = $count_see_kaku;
			$d['count_see_verifikasi'] = $count_see_verifikasi;
			$d['count_see_verifikasi_tj'] = $count_see_verifikasi_tj;
			$d['count_see_verifikasi_kaku'] = $count_see_verifikasi_kaku;
			$d['count_see_verifikasi_hukdis'] = $count_see_verifikasi_hukdis;
			$d['count_see_verifikasi_tp'] = $count_see_verifikasi_tp;
			$d['count_see_verifikasi_karir'] = $count_see_verifikasi_karir;
			$d['count_see_lapor'] = $count_see_lapor;
			$d['count_see_verifikasi_pindah_tugas'] = $count_see_verifikasi_pindah_tugas;

			// $this->load->view('dashboard_publik/verifikasi_pindah_tugas/index_verifikasi_pindah_tugas', $d);

			$d['page'] = 'dashboard_publik/template/verifikasi/pindah_tugas/index.php';
			$d['menu'] = 'ver pindah tugas';
			$this->load->view('dashboard_publik/template/main', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function data_verifikasi_pindah_tugas()
	{
		// $this->load->view('dashboard_publik/verifikasi_pindah_tugas/ajax_table');
		$this->load->view('dashboard_publik/template/verifikasi/pindah_tugas/ajax_table');
	}

	function table_data_verifikasi_pindah_tugas()
	{
		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');

		$status_verifikasi = $this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));

		$listing 		= $this->pindah_tugas->listing($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);
		$jumlah_filter 	= $this->pindah_tugas->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);
		$jumlah_semua 	= $this->pindah_tugas->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$button = '<a type="button" class="btn btn-info btn-sm" onclick="view_detail(' . "'" . $key->Pindah_tugas_id . "'" . ')">
							<i class="fa fa-eye"></i> &nbsp;Detail
						</a>';
			# jika user adalah kasubag kepegawaian
			# maka kyang ditampilkan adalah surat yang statusnya ('21','22','23','24','25','26','3')
			# dan tombolverifikasi muncul di status 21
			# jika user adalah sekdis tombol 22


			if (($status_verifikasi == 'kepegawaian' or $status_verifikasi == 'sudinupt') and ($key->Status_progress == '21' || $key->Status_progress == '26')) {
				$button_verifikasi = '<a type="button" class="btn btn-warning btn-sm" onclick="verifikasi_pindah_tugas_kep(' . "'" . $key->Pindah_tugas_id . "'" . ')">
											<i class="fa fa-tag"></i> &nbsp;Verifikasi
										</a>';
				$data_bold = '21';
			} else if ($status_verifikasi == 'sekdis' and $key->Status_progress == '22') {
				$button_verifikasi = '<a type="button" class="btn btn-warning btn-sm" onclick="verifikasi_pindah_tugas_kep(' . "'" . $key->Pindah_tugas_id . "'" . ')">
											<i class="fa fa-tag"></i> &nbsp;Verifikasi
										</a>';
				$data_bold = '22';
			} else {
				$button_verifikasi = '';
				$data_bold = '';
			}
			if ($key->Status_progress == '3') {
				$button_download = '<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/Data_hukuman_disiplin/download_surat/' . $key->Pindah_tugas_id . '" href="javascript:void(0);">
										<button type="button" class="btn btn-danger btn-sm" title="PDF"><i class="fa fa-file-pdf-o"></i> &nbsp;Download</button>
									</a>';
			} else {
				$button_download = '';
			}

			// === begin: badge-status ===
			switch ((int) $key->Status_progress) {
				case 0:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 21:
					if ($key->is_dinas == 1) {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subkoordinator<br>Kepegawaian</span>';
					} else {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subbagian</span>';
					}
					// $status_surat = '<span class="badge btn-warning badge-status" 
					// 						onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 22:
				case 27:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
				case 23:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 3:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 24:
				case 25:
				case 28:
				case 26:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				default:
					$status_surat = '<span class="badge btn-dark badge-status" 
												onclick="showTimeline(\'' . $key->Pindah_tugas_id . '\')">' . $key->nama_status_next . '</span>';
					break;
			}
			// === end: badge-status ===

			$row[] = $no;
			$row[] = $button . ' ' . $button_verifikasi . ' ' . $button_download;
			$row[] = ucwords(strtolower($key->nama_pegawai));
			$row[] = $key->Keterangan;
			$row[] = $status_surat;
			$row[] = $key->Created_at;
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

	function form_verifikasi_pindah_tugas_kep()
	{
		$Pindah_tugas_id = $this->input->post('Pindah_tugas_id');

		$Data_pindah_tugas = $this->db->query("SELECT
											a.Id, 
											a.id_pegawai, 
											a.lokasi_kerja_pegawai, 
											a.is_dinas, 
											a.Pindah_tugas_id, 
											a.Keterangan, 
											a.Status_progress, 
											a.Notes, 
											a.Nomor_surat, 
											a.Tanggal_verifikasi, 
											a.Created_by, 
											a.Created_at, 
											a.Updated_by, 
											a.Updated_at
										FROM
											tr_pindah_tugas AS a 
										WHERE a.Pindah_tugas_id='$Pindah_tugas_id'")->row();
		$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE a.id_pegawai = '$Data_pindah_tugas->id_pegawai'")->row();

		if (($Data_pindah_tugas->Status_progress == '21' || $Data_pindah_tugas->Status_progress == '26')) { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Data_pindah_tugas->Status_progress == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else {
			$terima = "";
			$tolak = "";
		}

		$a['Data'] = $Data;
		$a['Data_pindah_tugas'] = $Data_pindah_tugas;
		$a['Pindah_tugas_id'] = $Pindah_tugas_id;
		$a['func_table'] = $this->load->library('func_table');

		$a['Data'] 		= $Data;
		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;

		// ===== surat hukuman disiplin history =====
		$sSQL = "SELECT
					his.Pindah_tugas_id,
					his.user_created, surat.is_dinas,
					if ( isnull( log.nama_lengkap ), '-', log.nama_lengkap ) nama_pegawai,
					his.created_at,
					stat.id_status,
					-- stat.nama_status, 
					if (stat.id_status = 21, 'Surat Dibuat', stat.nama_status) as nama_status,
					stat.style,
					surat.notes as keterangan_ditolak,
					if ( isnull( lok.dinas ), '-', lok.dinas ) dinas,
					if ( isnull( peg.lokasi_kerja ), '-', peg.lokasi_kerja ) lokasi_kerja_id,
					if ( isnull( lok.lokasi_kerja ), '-', lok.lokasi_kerja ) lokasi_kerja_desc 
				from
					tr_pindah_tugas_track his
					join tr_pindah_tugas surat on surat.Pindah_tugas_id = his.Pindah_tugas_id
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.Pindah_tugas_id = '$Pindah_tugas_id' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);

		$a['data_history'] = $rsSQL;
		// ===== /surat hukuman disiplin history =====

		// $this->load->view('dashboard_publik/verifikasi_pindah_tugas/form_verifikasi_pindah_tugas_kep', $a);
		$this->load->view('dashboard_publik/template/verifikasi/pindah_tugas/form_verifikasi_pindah_tugas_kep', $a);
	}

	function simpan_verifikasi_pindah_tugas_kep()
	{
		$Pindah_tugas_id 		= $this->input->post('Pindah_tugas_id'); //id surat
		$username 		= $this->session->userdata('username');
		$status_verify 	= $this->input->post('status_verify');
		$ket 			= $this->input->post('ket');
		$Updated_by 	= $this->session->userdata('username');
		$Act 			= '0';
		$Date_now 		= date('Y-m-d H:i:s');
		$message		= null;

		if ($status_verify == '24' || $status_verify == '25' || $status_verify == '26' || $status_verify == '28') {
			$alasan_ditolak = $ket;
		} else {
			$alasan_ditolak = '';
		}

		$data['Status_progress'] 	= $status_verify;
		$data['Notes'] 				= $alasan_ditolak;
		$data['Updated_at'] 		= $Date_now;
		$data['Updated_by'] 		= $this->session->userdata("username");

		$this->db->where('Pindah_tugas_id', $Pindah_tugas_id);
		$Q_update = $this->db->update('tr_pindah_tugas', $data);
		if ($Q_update) {
			$Q_select = $this->db->query("SELECT * FROM tr_pindah_tugas WHERE Pindah_tugas_id='$Pindah_tugas_id'")->row();
			$data_triger['Act'] 			= $Act;
			$data_triger['Pindah_tugas_id'] 	= $Pindah_tugas_id;
			$data_triger['Status_progress'] = $status_verify;
			$data_triger['User_created'] 	= $Updated_by;
			$data_triger['Created_at'] 		= $Date_now;

			if ($this->db->insert('tr_pindah_tugas_triger', $data_triger)) {
				$status = true;
				//$see = $this->func_table->in_tosee_tj($Q_select->Created_by, $Pindah_tugas_id, $status_verify, $this->session->userdata("username"));
				$message = '1|Berhasil menyimpan data.';
			} else {
				$message = '0|Gagal menyimpan data.';
			}

			if ($status_verify == '23' || $status_verify == '27') {
				$select_pindah_tugas = $this->db->query("SELECT lokasi_kerja_pegawai FROM tr_pindah_tugas WHERE Pindah_tugas_id = '$Pindah_tugas_id'")->row();
				$nomor_surat = $this->func_table->gen_nomor_surat_pindah_tugas($select_pindah_tugas->lokasi_kerja_pegawai);
				$Date_now = date("Y-m-d H:i:s");
				$this->db->query("UPDATE tr_pindah_tugas 
									SET Status_progress = '3', Nomor_surat = '$nomor_surat', Tanggal_verifikasi = '$Date_now'
									WHERE Pindah_tugas_id='$Pindah_tugas_id'");
				//$this->db->query("UPDATE tr_pindah_tugas SET Status_progress = '3' WHERE Pindah_tugas_id='$Pindah_tugas_id'");
				//insert history
				$data_triger2['Act'] 			= $Act;
				$data_triger2['Pindah_tugas_id'] 		= $Pindah_tugas_id;
				$data_triger2['Status_progress'] = '3';
				$data_triger2['User_created'] 	= $Updated_by;
				$data_triger2['Created_at'] 	= $Date_now;
				$this->db->insert('tr_pindah_tugas_triger', $data_triger2);

				$message = '1|Berhasil menyimpan data.';
			}
			$message = '1|Berhasil menyimpan data.';
			$send_notif_pt 	= $this->func_wa_pindah_tugas->notif_pt_update($Pindah_tugas_id);
		} else {
			$message = '0|Gagal menyimpan data.';
		}
		echo $message;
	}

	function form_detail()
	{
		$Pindah_tugas_id = $this->input->post('Pindah_tugas_id');

		$Data_pindah_tugas = $this->db->query("SELECT
											a.Id, 
											a.id_pegawai, 
											a.lokasi_kerja_pegawai, 
											a.is_dinas, 
											a.Pindah_tugas_id, 
											a.Keterangan, 
											a.Status_progress, 
											a.Notes, 
											a.Nomor_surat, 
											a.Tanggal_verifikasi, 
											a.Created_by, 
											a.Created_at, 
											a.Updated_by, 
											a.Updated_at
										FROM
											tr_pindah_tugas AS a 
										WHERE a.Pindah_tugas_id='$Pindah_tugas_id'")->row();
		$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja =  a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE a.id_pegawai = '$Data_pindah_tugas->id_pegawai'")->row();

		if ($Data_pindah_tugas->is_dinas == '1' && ($Data_pindah_tugas->Status_progress == '21' || $Data_pindah_tugas->Status_progress == '26')) { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Data_pindah_tugas->is_dinas == '1' && $Data_pindah_tugas->Status_progress == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else if ($Data_pindah_tugas->is_dinas != '1'  && $Data_pindah_tugas->Status_progress == '21') { //diverifikasi kepegawaian
			$terima = "27";
			$tolak = "28";
		} else {
			$terima = "";
			$tolak = "";
		}

		$a['Data'] = $Data;
		$a['Data_pindah_tugas'] = $Data_pindah_tugas;
		$a['Pindah_tugas_id'] = $Pindah_tugas_id;
		$a['func_table'] = $this->load->library('func_table');

		$a['Data'] 		= $Data;
		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;

		// ===== surat hukuman disiplin history =====
		$sSQL = "SELECT
					his.Pindah_tugas_id,
					his.user_created, surat.is_dinas,
					if ( isnull( log.nama_lengkap ), '-', log.nama_lengkap ) nama_pegawai,
					his.created_at,
					stat.id_status,
					-- stat.nama_status, 
					if (stat.id_status = 21, 'Surat Dibuat', stat.nama_status) as nama_status,
					stat.style,
					surat.notes as keterangan_ditolak,
					if ( isnull( lok.dinas ), '-', lok.dinas ) dinas,
					if ( isnull( peg.lokasi_kerja ), '-', peg.lokasi_kerja ) lokasi_kerja_id,
					if ( isnull( lok.lokasi_kerja ), '-', lok.lokasi_kerja ) lokasi_kerja_desc 
				from
					tr_pindah_tugas_track his
					join tr_pindah_tugas surat on surat.Pindah_tugas_id = his.Pindah_tugas_id
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.Pindah_tugas_id = '$Pindah_tugas_id' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);

		$a['data_history'] = $rsSQL;
		// ===== /surat hukuman disiplin history =====

		// $this->load->view('dashboard_publik/verifikasi_pindah_tugas/form_detail', $a);
		$this->load->view('dashboard_publik/template/verifikasi/pindah_tugas/form_detail', $a);
	}

	public function notify_verifikasi_pindah_tugas()
	{
		$count_see_verifikasi 		= $this->func_table->count_see_verifikasi($this->session->userdata('id_pegawai'));
		$count_see_verifikasi_tj 	= $this->func_table->count_see_verifikasi_tunjangan($this->session->userdata('username'));
		$count_see_verifikasi_kaku 	= $this->func_table->count_see_verifikasi_kariskarsu($this->session->userdata('username'));
		$count_see_verifikasi_hukdis 	= $this->func_table->count_see_verifikasi_hukdis($this->session->userdata('username'));
		$count_see_verifikasi_tp 	= $this->func_table->count_see_verifikasi_tp($this->session->userdata('username'));
		$count_see_verifikasi_karir 	= $this->func_table->count_see_verifikasi_karir($this->session->userdata('username'));
		$count_see_verifikasi_pindah_tugas 	= $this->func_table->count_see_verifikasi_pindah_tugas($this->session->userdata('username'));

		$total_verifikasi = $count_see_verifikasi + $count_see_verifikasi_tj + $count_see_verifikasi_kaku + $count_see_verifikasi_hukdis + $count_see_verifikasi_tp + $count_see_verifikasi_karir + $count_see_verifikasi_pindah_tugas;

		if ($count_see_verifikasi_pindah_tugas > 0) {
			// $res_count_see_verifikasi_pindah_tugas = '<span class="badge btn-warning btn-flat">' . $count_see_verifikasi_pindah_tugas . '</span>';
			$res_count_see_verifikasi_pindah_tugas = $count_see_verifikasi_pindah_tugas;
		} else {
			$res_count_see_verifikasi_pindah_tugas = '';
		}

		if ($total_verifikasi > 0) {
			// $res_total_verifikasi = '<span class="badge btn-warning btn-flat">' . $total_verifikasi . '</span>';
			$res_total_verifikasi = $total_verifikasi;
		} else {
			$res_total_verifikasi = '';
		}

		$result = [
			'verifikasi_pindah_tugas' => $res_count_see_verifikasi_pindah_tugas,
			'total_verifikasi' => $res_total_verifikasi
		];

		echo json_encode($result);
	}

	function show_timeline()
	{
		// ===== surat keterangan history =====
		$Pindah_tugas_id = $this->input->post('Pindah_tugas_id');

		$sSQL = "SELECT
					his.Pindah_tugas_id,
					his.user_created, surat.is_dinas,
					if ( isnull( log.nama_lengkap ), '-', log.nama_lengkap ) nama_pegawai,
					his.created_at,
					stat.id_status, 
					-- stat.nama_status, 
					if (stat.id_status = 21, 'Surat Dibuat', stat.nama_status) as nama_status,
					stat.style,
					surat.notes as keterangan_ditolak,
					if ( isnull( lok.dinas ), '-', lok.dinas ) dinas,
					if ( isnull( peg.lokasi_kerja ), '-', peg.lokasi_kerja ) lokasi_kerja_id,
					if ( isnull( lok.lokasi_kerja ), '-', lok.lokasi_kerja ) lokasi_kerja_desc 
				from
					tr_pindah_tugas_track his
					join tr_pindah_tugas surat on surat.Pindah_tugas_id = his.Pindah_tugas_id
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.Pindah_tugas_id = '$Pindah_tugas_id' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);
		$a['data_history'] = $rsSQL;

		// $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline', $a);
		$this->load->view('dashboard_publik/template/timeline/timeline', $a);
	}
}
