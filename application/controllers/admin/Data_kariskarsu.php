<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_kariskarsu extends CI_Controller
{

	/*
		***	Controller : data_kariskarsu.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('template');
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_wa_kariskarsu');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_kariskarsu', 'kariskarsu');
		$this->load->library('upload');
		date_default_timezone_set('Asia/Bangkok');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Data KARIS/KARSU';
			$d['menu_open'] = 'data_kariskarsu';

			$this->load->view('dashboard_admin/kertas_kerja/kariskarsu/index_kariskarsu', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function filter()
	{
		$this->load->view('dashboard_admin/kertas_kerja/kariskarsu/ajax_table');
	}

	function table_data_kariskarsu()
	{

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');

		$listing 		= $this->kariskarsu->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->kariskarsu->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->kariskarsu->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$button_view = '<a type="button" class="kt-nav__link btn-info btn-sm" onclick="proses_kariskarsu(' . "'" . $key->Kariskarsu_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-eye" style="color:#fff !important;"></i> &nbsp;Detail
							</a>';
			$button_edit = '<a type="button" class="kt-nav__link btn-warning btn-sm" onclick="edit_kariskarsu(' . "'" . $key->Kariskarsu_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-edit" style="color:#fff !important;"></i> &nbsp;Edit
							</a>';
			$button_delete = '<a type="button" class="kt-nav__link btn-danger btn-sm" onclick="delete_kariskarsu(' . "'" . $key->Kariskarsu_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-trash" style="color:#fff !important;"></i> &nbsp;Hapus
							</a>';
			$button_download = '<a type="button" class="kt-nav__link btn-danger btn-sm" data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/Data_kariskarsu/download_surat/' . $key->Kariskarsu_id . '" href="javascript:void(0);">
							<i class="fa fa-file"></i> Download
					</a>';
			if ($key->Status_progress == '0') {
				$button = $button_view . ' ' . $button_delete;
			} elseif($key->Status_progress == '3') {
				$button = $button_view . ' '.$button_download;
			} else {
				$button = $button_view;
			}
			if ($key->Status_progress == '0') {
				$see = '1';
			} else {
				$see = '0';
			}

			if ($key->Perkawinan_ke == '1') {
				$data_perkawinan = 'Perkawinan Pertama';
			} else {
				$data_perkawinan = 'Perkawinan Janda/Duda';
			}

			// === nama pegawai ===
			$this->db->select('nama_pegawai');
			$nama_pegawai = $this->db->get_where('tbl_data_pegawai', array('id_pegawai' => $key->id_pegawai))->row()->nama_pegawai;
			$nama_pegawai = $this->func_table->name_format($nama_pegawai);

			// === begin: badge-status ===
			switch ((int) $key->Status_progress) {
				case 0:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 21:
					if ($key->is_dinas == 1) {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subkoordinator<br>Kepegawaian</span>';
					} else {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subbagian</span>';
					}
					// $status_surat = '<span class="badge btn-warning badge-status" 
					// 						onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 22:
				case 27:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
				case 23:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 3:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 24:
				case 25:
				case 28:
				case 26:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				default:
					$status_surat = '<span class="badge btn-dark badge-status" 
												onclick="showTimeline(\'' . $key->Kariskarsu_id . '\')">' . $key->nama_status_next . '</span>';
					break;
			}
			// === end: badge-status ===

			$row[] = $no;
			$row[] = $button;
			$row[] = $nama_pegawai;
			$row[] = $data_perkawinan;
			// $row[] = $key->nama_status;
			$row[] = $status_surat;
			$row[] = $this->func_table->get_file_kariskarsu($key->File_surat_nikah);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_kk);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_ktp_suami);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_ktp_istri);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_sk_pns);
			$row[] = $this->func_table->get_file_kariskarsu($key->File_foto);
			$row[] = $key->Created_at;
			$row[] = $see;

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

	// view kariskarsu
	function proses_kariskarsu()
	{
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');
		$username 	= $this->session->userdata('username');

		// delete dulu yang di temp 
		$delete_temp = $this->db->query("DELETE FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id'");
		if ($delete_temp) {
			// isert temp dari real
			$this->db->query("INSERT INTO tr_kariskarsu_komponen_temp (
									Kariskarsu_id, 
									Keluarga_id, 
									Nama_anggota, 
									Nip_nik, 
									Pangkat_gol_ruang, 
									Tempat_lahir, 
									Tanggal_lahir, 
									Tempat_nikah, 
									Tanggal_nikah, 
									Pekerjaan_sekolah, 
									Agama, 
									Alamat, 
									Created_at
								)
								SELECT
									Kariskarsu_id, 
									Keluarga_id, 
									Nama_anggota, 
									Nip_nik, 
									Pangkat_gol_ruang, 
									Tempat_lahir, 
									Tanggal_lahir, 
									Tempat_nikah, 
									Tanggal_nikah, 
									Pekerjaan_sekolah, 
									Agama, 
									Alamat, 
									Created_at
								FROM
									tr_kariskarsu_komponen
								WHERE tr_kariskarsu_komponen.Kariskarsu_id = '$Kariskarsu_id'");
		}
		$Data_kariskarsu = $this->db->query("SELECT * FROM tr_kariskarsu WHERE Kariskarsu_id='$Kariskarsu_id'")->row();
		$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja = a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE id_pegawai = '$Data_kariskarsu->id_pegawai'")->row();



		if ($Data_kariskarsu->is_dinas == '1' and ($Data_kariskarsu->Status_progress == '0' || $Data_kariskarsu->Status_progress == '25' || $Data_kariskarsu->Status_progress == '28')) { //bidang dan sekretariat
			$terima = "21";
			$tolak = "24";
		} else if ($Data_kariskarsu->is_dinas == '1' and $Data_kariskarsu->Status_progress == '21') { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Data_kariskarsu->is_dinas == '1' and $Data_kariskarsu->Status_progress == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else if ($Data_kariskarsu->is_dinas != '1' and $Data_kariskarsu->Status_progress == '0') { //diverifikasi admin
			$terima = "21";
			$tolak = "24";
		} else if ($Data_kariskarsu->is_dinas != '1' and $Data_kariskarsu->Status_progress == '21') { //diverifikasi kaksubbag terkait
			$terima = "27";
			$tolak = "28";
		} else if ($Data_kariskarsu->is_dinas != '1' and ($Data_kariskarsu->Status_progress == '0' || $Data_kariskarsu->Status_progress == '25' || $Data_kariskarsu->Status_progress == '28')) { //diverifikasi admin
			$terima = "21";
			$tolak = "24";
		} else {
			$terima = "2";
			$tolak = "1";
		}

		$a['Data'] = $Data;
		$a['Data_kariskarsu'] = $Data_kariskarsu;
		$a['Kariskarsu_id'] = $Kariskarsu_id;

		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;
		$a['func_table'] = $this->load->library('func_table');

		//history
		$history = null;

		if ($Data_kariskarsu->Status_progress == '1') { //ditolak
			$kondisi = " WHERE x.id_status in ('0','1')";
		} else if ($Data_kariskarsu->Status_progress == '24') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'24')";
		} else if ($Data_kariskarsu->Status_progress == '25') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'22','25')";
		} else if ($Data_kariskarsu->Status_progress == '26') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'22','23','26')";
		} else if ($Data_kariskarsu->Status_progress == '28') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'27','28')";
		} else {
			$kondisi = " WHERE x.id_status NOT IN ('1', '24', '25', '26', '28') ";
		}

		if ($Data_kariskarsu->is_dinas == '1') { //bidang dan sekretariat
			$kondisi_bidang = " AND x.sort_bidang != '0'";
			$kond_order = " x.sort_bidang";
		} else if ($Data_kariskarsu->is_dinas != '1') {
			$kondisi_bidang = " AND x.sort_sudinupt != '0'";
			$kond_order = " x.sort_sudinupt";
		} else {
			$kondisi_bidang = " AND x.sort != '0'";
			$kond_order = " x.sort";
		}

		$Query_history = $this->db->query("SELECT 
											x.id_status, x.nama_status, x.style, x.sort as urutan, x.sort_bidang as urutan_bidang,
											y.Kariskarsu_id, y.Status_progress, y.Status_name, y.Notes, y.User_created, y.Name_user, y.Created_at
											FROM tbl_status_surat x
											LEFT JOIN (
															SELECT
																a.Kariskarsu_id, 
																a.Status_progress, 
																a.Status_name, 
																a.Notes, 
																a.User_created, 
																a.Name_user, 
																a.Created_at
															FROM
																tr_kariskarsu_track AS a
															WHERE a.Kariskarsu_id='$Kariskarsu_id'
															GROUP BY a.Kariskarsu_id,a.Status_progress
											) y ON y.Status_progress = x.id_status 
											$kondisi $kondisi_bidang
											ORDER BY $kond_order ASC")->result();
		$a['Query_history'] = $Query_history;

		$this->load->view('dashboard_admin/kertas_kerja/kariskarsu/proses_kariskarsu', $a);
	}

	public function processSave()
	{
		$status = false;
		$message = '';

		$Kariskarsu_id = $this->input->post('Kariskarsu_id');
		$status_verify = $this->input->post('status_verify');
		$ket = $this->input->post('ket');
		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '0';
		$Date_now 			= date('Y-m-d H:i:s');

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$surat = null;
			$qOldSurat = $this->db->get_where('tr_kariskarsu', ['Kariskarsu_id' => $Kariskarsu_id]);
			foreach ($qOldSurat->result() as $s) {
				$surat = $s;
			}

			if ($surat != null) {
				//proses update 
				$in = array(
					'Status_progress' => $status_verify,
					'Notes' => $ket,
					'Updated_at' => $Date_now,
					'Updated_by' => $this->session->userdata("username")
				);

				if ($this->db->update('tr_kariskarsu', $in, ['Kariskarsu_id' => $Kariskarsu_id])) {
					$data_triger['Act'] 			= $Act;
					$data_triger['Kariskarsu_id'] 	= $Kariskarsu_id;
					$data_triger['Status_progress'] = $status_verify;
					$data_triger['User_created'] 	= $Updated_by;
					$data_triger['Created_at'] 		= $Date_now;
					//$this->db->insert('tr_triger_tunjangan', $data_triger);

					//$status = true;

					if ($this->db->insert('tr_kariskarsu_triger', $data_triger)) {
						$status = true;
						$see = $this->func_table->in_tosee_kaku($surat->Created_by, $Kariskarsu_id, $status_verify, $this->session->userdata("username"));
						$send_notif_kaku = $this->func_wa_kariskarsu->notif_kaku_update($Kariskarsu_id);
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

	public function download_surat($Kariskarsu_id)
	{
		if ($this->session->userdata('logged_in') != "") {
			if ($Kariskarsu_id != '0') {
				$d['surat'] = null;
				$d['header_surat'] = '';
				$d['pegawai'] = null;
				$d['penandatangan'] = null;
				$dt['eselon3'] = null;
				$d['ket_ttd'] = '';
				$d['lokasi_kerja_ttd'] = '';
				$d['signature'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
				$d['stamp'] = '';

				$Data_kariskarsu = $this->db->query("SELECT * FROM tr_kariskarsu WHERE Kariskarsu_id='$Kariskarsu_id'")->row();
				$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat, a.signature as signature_pegawai,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan
									FROM tbl_data_pegawai as a
									LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
											) as b ON b.id_lokasi_kerja = a.lokasi_kerja
									LEFT JOIN (
										SELECT id_status_pegawai, nama_status FROM tbl_master_status_pegawai
									) as c ON c.id_status_pegawai =  a.status_pegawai
									LEFT JOIN (
										SELECT id_golongan, golongan, uraian FROM tbl_master_golongan
									) as d ON d.id_golongan =  a.id_golongan
									LEFT JOIN (
										SELECT id_nama_jabatan, nama_jabatan FROM tbl_master_nama_jabatan
									) as e ON e.id_nama_jabatan =  a.id_jabatan
									WHERE id_pegawai = '$Data_kariskarsu->id_pegawai'")->row();
				$Data_kariskarsu_komp = $this->db->query("SELECT
															a.Kariskarsu_id, 
															a.Keluarga_id, 
															b.nama_anggota_keluarga,
															b.nik,
															b.tempat_lahir, 
															b.tanggal_lahir_keluarga,
															b.tempat_nikah,
															b.tanggal_nikah,
															b.pekerjaan_sekolah,
															b.agama, b.alamat_new,b.pangkat_golongan,
															a.Created_at
														FROM
															tr_kariskarsu_komponen_temp AS a
														LEFT JOIN (
															SELECT
															k.id_data_keluarga, 
															k.id_pegawai, 
															k.nama_anggota_keluarga, 
															k.tempat_lahir,  
															k.tanggal_lahir_keluarga, 
															k.jenis_kelamin, 
															k.hub_keluarga, 
															k.nik, 
															k.status_kawin, 
															k.tempat_nikah, 
															k.tanggal_nikah, 
															k.uraian, 
															k.tanggal_cerai_meninggal, 
															IF(k.agama = '0', k.agama_lainnya, c.master_agama) AS agama,
															IF(k.alamat_sdp = '0', k.alamat, d.master_alamat) AS alamat_new,
															k.pangkat_golongan, 
															k.pekerjaan_sekolah
														FROM
															tbl_data_keluarga AS k
															LEFT JOIN ( SELECT kode, agama AS master_agama FROM mt_agama ) AS c ON c.kode = k.agama 
															LEFT JOIN ( SELECT id_pegawai, alamat AS master_alamat FROM tbl_data_pegawai ) AS d ON d.id_pegawai = k.id_pegawai
														) as b ON b.id_data_keluarga = a.Keluarga_id
														WHERE a.Kariskarsu_id = '$Kariskarsu_id'")->row();
				$d['Data'] = $Data;
				$d['Data_kariskarsu'] = $Data_kariskarsu;
				$d['Data_kariskarsu_komp'] = $Data_kariskarsu_komp;
				$d['Kariskarsu_id'] = $Kariskarsu_id;
				$d['func_table'] = $this->load->library('func_table');
				if ($Data->signature_pegawai != '') {
					$signature_pegawai =  './asset/foto_pegawai/signature/' . $Data->signature_pegawai;
					if (file_exists($signature_pegawai)) {
						$d['signature_pegawai'] = base_url() . 'asset/foto_pegawai/signature/' . $Data->signature_pegawai;
					} else {
						$d['signature_pegawai'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
					}
				} else {
					$d['signature_pegawai'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
				}

				//get data surat
				$q = $this->db->get_where('tr_kariskarsu', ['Kariskarsu_id' => $Kariskarsu_id]);
				foreach ($q->result() as $p) {
					$d['surat'] = $p;
					$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($p->Tanggal_verifikasi);

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
						where a.id_pegawai = " . $p->id_pegawai
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
									$signature =  './asset/foto_pegawai/signature/' . $p3->signature;
									// $stamp =  base_url(). 'asset/foto_pegawai/signature/combine/stamp/' . $p3->stamp;
									//$Combine_image 	= $this->func_table->Combine_signature($signature, $p3->signature, $stamp);
									if (file_exists($signature)) {
										$d['signature'] = base_url() . 'asset/foto_pegawai/signature/' . $p3->signature;
									} else {
										$d['signature'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
									}
								}
								$d['stamp'] =  base_url() . 'asset/foto_pegawai/signature/stamp/' . $p3->stamp;
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
									$signature =  './asset/foto_pegawai/signature/' . $p3->signature;
									if (file_exists($signature)) {
										$d['signature'] = base_url() . 'asset/foto_pegawai/signature/' . $p3->signature;
									} else {
										$d['signature'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
									}
									
								}
								$d['stamp'] =  base_url() . 'asset/foto_pegawai/signature/stamp/' . $p3->stamp;
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
							// new
							$nama_jabatan_new = isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : '';
							$ttd_unit_new = isset($d['eselon3']->ttd_unit) ? $d['eselon3']->ttd_unit : '';
							$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
							$d['ket_ttd'] = 'a.n. ' . $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>' . $penandatangan_new . ',';
							$Date_now = date('Y-m-d');
						}
					}
					$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [215.9, 332]]); //F4
					$html = $this->load->view('dashboard_admin/kertas_kerja/kariskarsu/export_digital', $d, true);
					$mpdf->AddPage('P', '', '', '', '', 10, 10, 10, 10, 18, 12);
					$mpdf->simpleTables = true;
					$mpdf->packTableData = true;
					$mpdf->SetTitle($p2->nama_pegawai);



					$mpdf->WriteHTML($html);
					$mpdf->Output($p2->nama_pegawai . '.pdf', 'I');

					//$this->load->view('dashboard_admin/kertas_kerja/kariskarsu/export_digital', $d, true);

					// === read notif ===
					$username = $this->session->userdata('username');
					$see = $this->func_table->in_tosee_kaku($p->Created_by, $Kariskarsu_id, $p->Status_progress, $username);
				}
			} else {
				echo 'Request tidak valid.1';
			}
		} else {
			echo 'Request tidak valid.2';
		}
	}

	function delete_kariskarsu()
	{
		$Kariskarsu_id = $this->input->post('Kariskarsu_id');
		$Qdata = $this->db->query("SELECT * FROM tr_kariskarsu WHERE Kariskarsu_id = '$Kariskarsu_id'")->row();

		$Path_folder = "./asset/upload/kariskarsu/";
		$Path_file_sn = $Path_folder . $Qdata->File_surat_nikah;
		if (file_exists($Path_file_sn)) {
			unlink($Path_file_sn);
		}
		$Path_file_kk = $Path_folder . $Qdata->File_kk;
		if (file_exists($Path_file_kk)) {
			unlink($Path_file_kk);
		}
		$Path_file_ktps = $Path_folder . $Qdata->File_ktp_suami;
		if (file_exists($Path_file_ktps)) {
			unlink($Path_file_ktps);
		}

		$Path_file_ktpi = $Path_folder . $Qdata->File_ktp_istri;
		if (file_exists($Path_file_ktpi)) {
			unlink($Path_file_ktpi);
		}

		$Path_file_skpns = $Path_folder . $Qdata->File_sk_pns;
		if (file_exists($Path_file_skpns)) {
			unlink($Path_file_skpns);
		}

		$Path_file_foto = $Path_folder . $Qdata->File_foto;
		if (file_exists($Path_file_foto)) {
			unlink($Path_file_foto);
		}

		$del = $this->db->query("DELETE FROM tr_kariskarsu WHERE Kariskarsu_id = '$Kariskarsu_id'");
		$del_komp = $this->db->query("DELETE FROM tr_kariskarsu_komponen WHERE Kariskarsu_id = '$Kariskarsu_id'");
		$del_temp = $this->db->query("DELETE FROM tr_kariskarsu_komponen_temp WHERE Kariskarsu_id = '$Kariskarsu_id'");
		if ($del) {
			echo 'Berhasil Hapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	function show_timeline()
	{
		// ===== surat karis/karsu history =====
		$kariskarsu_id = $this->input->post('kariskarsu_id');

		$sSQL = "SELECT
					his.kariskarsu_id,
					his.user_created, surat.is_dinas,
					if ( isnull( log.nama_lengkap ), '-', log.nama_lengkap ) nama_pegawai,
					his.created_at,
					stat.id_status,
					stat.nama_status, stat.style,
					surat.notes as keterangan_ditolak,
					if ( isnull( lok.dinas ), '-', lok.dinas ) dinas,
					if ( isnull( peg.lokasi_kerja ), '-', peg.lokasi_kerja ) lokasi_kerja_id,
					if ( isnull( lok.lokasi_kerja ), '-', lok.lokasi_kerja ) lokasi_kerja_desc 
				from
					tr_kariskarsu_track his
					join tr_kariskarsu surat on surat.kariskarsu_id = his.kariskarsu_id
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.kariskarsu_id = '$kariskarsu_id' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);
		$a['data_history'] = $rsSQL;

		$this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline', $a);
	}
}

/* End of file data_kariskarsu.php */
/* Location: ./application/controllers/data_kariskarsu.php */
