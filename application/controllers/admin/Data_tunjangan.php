<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_tunjangan extends CI_Controller
{

	/*
		***	Controller : data_tunjangan.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('template');
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_wa_tunjangan');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_tunjangan', 'tunjangan');
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
			$d['page_name'] = 'Data Tunjangan Keluarga';
			$d['menu_open'] = 'data_tunjangan';

			$this->load->view('dashboard_admin/tunjangan/index_tunjangan', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function filter()
	{
		$this->load->view('dashboard_admin/tunjangan/ajax_table');
	}

	function table_data_tunjangan()
	{

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');

		$listing 		= $this->tunjangan->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->tunjangan->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->tunjangan->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$button_download = '<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/Data_tunjangan/download_surat/' . $key->Tunjangan_id . '" href="javascript:void(0);">
									<button type="button" class="btn btn-danger btn-sm" title="PDF">
										<i class="fa fa-file"></i> Download
									</button>
								</a>';
			$button_view = '<a type="button" class="kt-nav__link btn-info btn-sm" onclick="proses_tunjangan(' . "'" . $key->Tunjangan_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-eye" style="color:#fff !important;"></i> &nbsp;Detail
							</a>';
			$button_edit = '<a type="button" class="kt-nav__link btn-warning btn-sm" onclick="edit_tunjangan(' . "'" . $key->Tunjangan_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-edit" style="color:#fff !important;"></i> &nbsp;Edit
							</a>';
			$button_delete = '<a type="button" class="kt-nav__link btn-danger btn-sm" onclick="delete_tunjangan(' . "'" . $key->Tunjangan_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-trash" style="color:#fff !important;"></i> &nbsp;Hapus
							</a>';
			if ($key->Status_progress == '0') {
				$button = $button_view . ' ' . $button_delete;
			} elseif ($key->Status_progress == '3') {
				$button = $button_view . ' ' . $button_download;
			} else {
				$button = $button_view;
			}
			if ($key->Status_progress == '0') {
				$see = '1';
			} else {
				$see = '0';
			}

			// === begin: badge-status ===
			switch ((int) $key->Status_progress) {
				case 0:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 21:
					if ($key->is_dinas == 1) {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subkoordinator<br>Kepegawaian</span>';
					} else {
						$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subbagian</span>';
					}
					// $status_surat = '<span class="badge btn-warning badge-status" 
					// 						onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 22:
				case 27:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
				case 23:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 3:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				case 24:
				case 25:
				case 28:
				case 26:
					$status_surat = '<span class="badge badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')" style="background-color: #' . $key->backcolor . '; color: #' . $key->fontcolor . ';">' . $key->nama_status_next . '</span>';
					break;
				default:
					$status_surat = '<span class="badge btn-dark badge-status" 
												onclick="showTimeline(\'' . $key->Tunjangan_id . '\')">' . $key->nama_status_next . '</span>';
					break;
			}
			// === end: badge-status ===

			$row[] = $no;
			$row[] = $button;
			// $row[] = $key->nama_status;
			$row[] = $status_surat;
			$row[] = $this->func_table->name_format($key->nama_lengkap);
			$row[] = date_format(date_create($key->Created_at), 'j M Y (H:i:s)');
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

	// view tunjangan
	function proses_tunjangan()
	{
		$Tunjangan_id = $this->input->post('Tunjangan_id');
		// delete dulu yang di temp 
		$delete_temp = $this->db->query("DELETE FROM tr_tunjangan_komponen_temp WHERE Tunjangan_id = '$Tunjangan_id'");
		if ($delete_temp) {
			// isert temp dari real
			$this->db->query("INSERT INTO tr_tunjangan_komponen_temp (
									tr_tunjangan_komponen_temp.Tunjangan_id, 
									tr_tunjangan_komponen_temp.Keluarga_id, 
									tr_tunjangan_komponen_temp.Nama_anggota, 
									tr_tunjangan_komponen_temp.Tempat_lahir, 
									tr_tunjangan_komponen_temp.Tanggal_lahir, 
									tr_tunjangan_komponen_temp.Tanggal_nikah, 
									tr_tunjangan_komponen_temp.Pekerjaan_sekolah, 
									tr_tunjangan_komponen_temp.Keterangan, 
									tr_tunjangan_komponen_temp.Created_at
								)
								SELECT
									tr_tunjangan_komponen.Tunjangan_id, 
									tr_tunjangan_komponen.Keluarga_id, 
									tr_tunjangan_komponen.Nama_anggota, 
									tr_tunjangan_komponen.Tempat_lahir, 
									tr_tunjangan_komponen.Tanggal_lahir, 
									tr_tunjangan_komponen.Tanggal_nikah, 
									tr_tunjangan_komponen.Pekerjaan_sekolah, 
									tr_tunjangan_komponen.Keterangan, 
									tr_tunjangan_komponen.Created_at
								FROM
									tr_tunjangan_komponen
								WHERE tr_tunjangan_komponen.Tunjangan_id = '$Tunjangan_id'");
		}
		$Data_tunjangan = $this->db->query("SELECT * FROM tr_tunjangan WHERE Tunjangan_id='$Tunjangan_id'")->row();
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
									WHERE id_pegawai = '$Data_tunjangan->id_pegawai'")->row();

		if ($Data_tunjangan->is_dinas == '1' and ($Data_tunjangan->Status_progress == '0' || $Data_tunjangan->Status_progress == '25' || $Data_tunjangan->Status_progress == '28')) { //bidang dan sekretariat
			$terima = "21";
			$tolak = "24";
		} else if ($Data_tunjangan->is_dinas == '1' and $Data_tunjangan->Status_progress == '21') { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Data_tunjangan->is_dinas == '1' and $Data_tunjangan->Status_progress == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else if ($Data_tunjangan->is_dinas != '1' and $Data_tunjangan->Status_progress == '0') { //diverifikasi admin
			$terima = "21";
			$tolak = "24";
		} else if ($Data_tunjangan->is_dinas != '1' and $Data_tunjangan->Status_progress == '21') { //diverifikasi kaksubbag terkait
			$terima = "27";
			$tolak = "28";
		} else if ($Data_tunjangan->is_dinas != '1' and ($Data_tunjangan->Status_progress == '0' || $Data_tunjangan->Status_progress == '25' || $Data_tunjangan->Status_progress == '28')) { //diverifikasi admin
			$terima = "21";
			$tolak = "24";
		} else {
			$terima = "2";
			$tolak = "1";
		}

		$a['peraturan'] = $this->db->query("SELECT * FROM tbl_master_peraturan WHERE status_aktif='1' AND jenis_peraturan = 'Permohonan Tunjangan Keluarga'")->result();
		$a['Data'] = $Data;
		$a['Data_tunjangan'] = $Data_tunjangan;
		$a['Tunjangan_id'] = $Tunjangan_id;
		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;
		$a['func_table'] = $this->load->library('func_table');

		//history
		$history = null;

		if ($Data_tunjangan->Status_progress == '1') { //ditolak
			$kondisi = " WHERE x.id_status in ('0','1')";
		} else if ($Data_tunjangan->Status_progress == '24') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'24')";
		} else if ($Data_tunjangan->Status_progress == '25') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'22','25')";
		} else if ($Data_tunjangan->Status_progress == '26') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'22','23','26')";
		} else if ($Data_tunjangan->Status_progress == '28') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'27','28')";
		} else {
			$kondisi = " WHERE x.id_status NOT IN ('1', '24', '25', '26', '28') ";
		}

		if ($Data_tunjangan->is_dinas == '1') { //bidang dan sekretariat
			$kondisi_bidang = " AND x.sort_bidang != '0'";
			$kond_order = " x.sort_bidang";
		} else if ($Data_tunjangan->is_dinas != '1') {
			$kondisi_bidang = " AND x.sort_sudinupt != '0'";
			$kond_order = " x.sort_sudinupt";
		} else {
			$kondisi_bidang = " AND x.sort != '0'";
			$kond_order = " x.sort";
		}

		$Query_history = $this->db->query("SELECT 
											x.id_status, x.nama_status, x.style, x.sort as urutan, x.sort_bidang as urutan_bidang,
											y.Tunjangan_id, y.Status_progress, y.Status_name, y.Notes, y.User_created, y.Name_user, y.Created_at
											FROM tbl_status_surat x
											LEFT JOIN (
															SELECT
																a.Tunjangan_id, 
																a.Status_progress, 
																a.Status_name, 
																a.Notes, 
																a.User_created, 
																a.Name_user, 
																a.Created_at
															FROM
																tr_tunjangan_track AS a
															WHERE a.Tunjangan_id='$Tunjangan_id'
															GROUP BY a.Tunjangan_id,a.Status_progress
											) y ON y.Status_progress = x.id_status 
											$kondisi $kondisi_bidang
											ORDER BY $kond_order ASC")->result();
		$a['Query_history'] = $Query_history;

		$this->load->view('dashboard_admin/tunjangan/proses_tunjangan', $a);
	}

	public function processSave()
	{
		$status = false;
		$message = '';

		$Tunjangan_id = $this->input->post('Tunjangan_id');
		$status_verify = $this->input->post('status_verify');
		$ket = $this->input->post('ket');
		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '0';
		$Date_now 			= date('Y-m-d H:i:s');

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$surat = null;
			$qOldSurat = $this->db->get_where('tr_tunjangan', ['Tunjangan_id' => $Tunjangan_id]);
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

				if ($this->db->update('tr_tunjangan', $in, ['Tunjangan_id' => $Tunjangan_id])) {
					$data_triger['Act'] 			= $Act;
					$data_triger['Tunjangan_id'] 	= $Tunjangan_id;
					$data_triger['Status_progress'] = $status_verify;
					$data_triger['User_created'] 	= $Updated_by;
					$data_triger['Created_at'] 		= $Date_now;
					//$this->db->insert('tr_triger_tunjangan', $data_triger);

					//$status = true;

					if ($this->db->insert('tr_triger_tunjangan', $data_triger)) {
						$status = true;
						$see = $this->func_table->in_tosee_tj($surat->Created_by, $Tunjangan_id, $status_verify, $this->session->userdata("username"));
						$send_notif_tj 	= $this->func_wa_tunjangan->notif_tj_update($Tunjangan_id);
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

	public function download_surat($Tunjangan_id)
	{
		if ($this->session->userdata('logged_in') != "") {
			if ($Tunjangan_id != '0') {
				$d['surat'] = null;
				$d['header_surat'] = '';
				$d['pegawai'] = null;
				$d['penandatangan'] = null;
				$dt['eselon3'] = null;
				$d['ket_ttd'] = '';
				$d['lokasi_kerja_ttd'] = '';
				$d['signature'] = '';

				$Data_tunjangan = $this->db->query("SELECT * FROM tr_tunjangan WHERE Tunjangan_id='$Tunjangan_id'")->row();
				$Data = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
										a.jenis_kelamin, a.agama,a.alamat,a.tanggal_mulai_pangkat,
										a.lokasi_kerja, a.nip, a.tanggal_lahir, nama_lokasi_kerja, nama_status,
										golongan, uraian, nama_jabatan,
										a.signature as signature_pegawai
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
									WHERE id_pegawai = '$Data_tunjangan->id_pegawai'")->row();
				$Data_tunjangan_komp = $this->db->query("SELECT
															a.Id, 
															a.Tunjangan_id, 
															a.Keluarga_id, 
															b.nama_anggota_keluarga,
															b.tempat_lahir,
															b.tanggal_lahir_keluarga,
															b.tanggal_nikah,
															b.pekerjaan_sekolah,
															b.uraian,
															a.Created_at
														FROM
															tr_tunjangan_komponen_temp AS a
															
														LEFT JOIN (
															SELECT id_data_keluarga,nama_anggota_keluarga,tempat_lahir,tanggal_lahir_keluarga,tanggal_nikah,pekerjaan_sekolah,uraian
															FROM tbl_data_keluarga
														) AS b ON b.id_data_keluarga = a.Keluarga_id
															WHERE a.Id != '' AND a.Tunjangan_id = '$Tunjangan_id' order by a.Id desc")->result();
				$d['Data'] = $Data;
				$d['Data_tunjangan'] = $Data_tunjangan;
				$d['Data_tunjangan_komp'] = $Data_tunjangan_komp;
				$d['Tunjangan_id'] = $Tunjangan_id;
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
				$q = $this->db->get_where('tr_tunjangan', ['Tunjangan_id' => $Tunjangan_id]);
				foreach ($q->result() as $p) {
					$d['surat'] = $p;
					$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($p->Updated_at);

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
									//$d['signature'] = base_url(). 'asset/foto_pegawai/signature/' . $p3->signature;
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
									//$d['signature'] = base_url(). 'asset/foto_pegawai/signature/' . $p3->signature;
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
							// new
							$nama_jabatan_new = isset($d['eselon3']->nama_jabatan) ? $d['eselon3']->nama_jabatan : '';
							$ttd_unit_new = isset($d['eselon3']->ttd_unit) ? $d['eselon3']->ttd_unit : '';
							$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
							$d['ket_ttd'] = 'a.n. ' . $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>' . $penandatangan_new . ',';
							$Date_now = date('Y-m-d');
						}
					}
					$mpdf = new \Mpdf\Mpdf();
					$html = $this->load->view('dashboard_admin/tunjangan/export_digital', $d, true);
					$mpdf->AddPage('P', '', '', '', '', 10, 10, 10, 10, 18, 12);
					$mpdf->simpleTables = true;
					$mpdf->packTableData = true;
					$mpdf->SetTitle($p2->nama_pegawai);



					$mpdf->WriteHTML($html);
					$mpdf->Output($p2->nama_pegawai . '.pdf', 'I');

					// === read notif ===
					$username = $this->session->userdata('username');
					$this->func_table->in_tosee_tj($p->Created_by, $Tunjangan_id, $p->Status_progress, $username);
				}
			} else {
				echo 'Request tidak valid.1';
			}
		} else {
			echo 'Request tidak valid.2';
		}
	}

	function delete_tunjangan()
	{
		$Tunjangan_id = $this->input->post('Tunjangan_id');

		$delete = $this->db->delete('tr_tunjangan', array('tunjangan_id' => $Tunjangan_id));
		if ($delete) {
			$message =  'Data berhasil dihapus';
			$status = true;
		} else {
			$message = 'Data gagal dihapus';
			$status = false;
		}
		$result = [
			'message' => $message,
			'status' => $status
		];

		echo json_encode($result);
	}
}

// End of file Data_tunjangan.php
// Location: ./application/controllers/admin/Data_tunjangan.php
