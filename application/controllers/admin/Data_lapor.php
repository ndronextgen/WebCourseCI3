<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_lapor extends CI_Controller
{

	/*
		***	Controller : Data_lapor.php
	*/

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") { } else {
			header('location:' . base_url() . '');
		}

		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('template');
		$this->load->library('func_table_lapor');
		$this->load->library('func_table');
		$this->load->library('func_wa_lapor');
		$this->load->library('upload');
		$this->load->model('m_lapor', 'lapor');

		// $this->load->model('config_popup_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['page_name'] = 'Data Lapor Pegawai';
			$data['menu_open'] = 'data_lapor';

			$this->load->view('dashboard_admin/lapor/index_lapor', $data);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function filter()
	{
		$this->load->view('dashboard_admin/lapor/ajax_table');
	}

	function table_data_lapor()
	{
		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$username = $this->session->userdata('username');
		$id_pegawai = '';

		$listing 		= $this->lapor->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->lapor->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->lapor->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {

			$see = $this->func_table_lapor->see_table_admin_lapor($username, $key->id);
			$jml_c = $this->func_table->get_jml_tanggapan($key->id);

			// === begin: buttons (aksi) ===
			$tanggapan = '<button type="button" class="kt-nav__link btn-info btn-sm" onclick="gettanggapan(' . "'" . $key->id . "'" . ')"><i class="fa fa-comment"></i>&nbsp;&nbsp;<b>' . $jml_c . '</b></button';
			// === end: buttons (aksi) ===

			// === begin: file ===
			$path_file = './asset/upload/Lapor/' . $key->file_upload;
			$file = $this->func_table->get_file($path_file, "View File");
			// === end: file ===

			if ($user_type == "administrator") {
				if ($id_lokasi_kerja == '' || $id_lokasi_kerja == null || $id_lokasi_kerja == '0') { // admin utama

					$button = '';
					if ($key->user_type == 2) {
						$button .= '
									<a type="button" class="kt-nav__link btn-success btn-sm" onclick="view_lapor(' . "'" . $key->id . "'" . ')"><i class="fa fa-eye" style="color:#fff !important;"></i></a>
									<a type="button" class="kt-nav__link btn-warning btn-sm" onclick="edit_lapor(' . "'" . $key->id . "'" . ')"><i class="fa fa-edit" style="color:#fff !important;"></i></a>
									';
					}
					$button .= '
								<a type="button" class="kt-nav__link btn-danger btn-sm" onclick="delete_lapor(' . "'" . $key->id . "'" . ')"><i class="fa fa-trash" style="color:#fff !important;"></i></a>
								';
				} else { //admin lokasi
					$button = "X";
				}
			} else { //public
				$kond_lokasi = "X";
			}

			// === get nama pegawai (admin) ===
			$id_peg = $key->id_pegawai;
			$sSQL = "SELECT nama_lengkap FROM tbl_user_login WHERE id_pegawai = '$id_peg'";
			$rsSQL = $this->db->query($sSQL);
			$nama_pegawai = '';
			if ($rsSQL->num_rows() > 0) {
				$nama_pegawai = $this->func_table->propercase($rsSQL->row()->nama_lengkap);
			}

			// === begin: create row ===
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $button;
			$row[] = $file;
			$row[] = $key->kategori;
			$row[] = $key->isi_laporan;
			$row[] = $nama_pegawai;
			$row[] = $tanggapan;
			$row[] = date_format(date_create($key->created_at), 'j M Y  (H:i:s)');
			$row[] = $see;

			$data[] = $row; // rowset
			// === end: create row ===
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $jumlah_semua->jml,
			"recordsFiltered" => $jumlah_filter->jml,
			"data" => $data,
		);
		echo json_encode($output);
	}

	function notify_lapor()
	{
		$count_lapor		= $this->func_table_lapor->count_see_lapor_admin($this->session->userdata('username'));
		if ($count_lapor > 0) {
			$res_count_lapor = '<span class="kt-nav__link-badge"><span class="kt-badge kt-badge--warning">' . $count_lapor . '</span></span>';
		} else {
			$res_count_lapor = '';
		}

		$result = [
			'notify_lapor' => $res_count_lapor
		];

		echo json_encode($result);
	}

	function delete_lapor()
	{
		$Id = $this->input->post('Id');
		$path_folder = "./asset/upload/Lapor/";

		$QData = $this->db->query("SELECT File_upload FROM tr_lapor WHERE Id = '$Id'")->row();
		if ($QData->File_upload != '') {
			$path_file    = $path_folder . '/' . $QData->File_upload;
			if (file_exists($path_file)) {
				unlink($path_file);
			}
		}

		$del_lapor = $this->db->query("DELETE FROM tr_lapor WHERE Id = '$Id'");
		$del_tanggapan = $this->db->query("DELETE FROM tr_lapor_tanggapan WHERE Lapor_id = '$Id'");
		$del_tanggapan_see = $this->db->query("DELETE FROM tr_lapor_see WHERE Lapor_id = '$Id'");
		if ($del_lapor) {
			echo 'Data Dihapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	function form_lapor_add()
	{
		$id_pegawai = $this->session->userdata('id_pegawai');
		$sSQL = "SELECT
					log.id_user_login,
					log.id_pegawai,
					log.nama_lengkap AS nama_pegawai,
					log.id_lokasi_kerja AS lokasi_kerja,
					lok.nama_lokasi_kerja 
				FROM tbl_user_login AS log
					LEFT JOIN ( SELECT id_lokasi_kerja, lokasi_kerja AS nama_lokasi_kerja 
								FROM tbl_master_lokasi_kerja 
								) AS lok ON lok.id_lokasi_kerja = log.id_lokasi_kerja 
				WHERE
					log.id_pegawai = '$id_pegawai'";
		$rsSQL = $this->db->query($sSQL)->row();

		// === begin: lokasi ===
		$data['lokasi'] = $this->input->post('lokasi');

		$arrLokasi = array();
		$arrLokasiSelected = array();
		$lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => '0'))->result_array();
		if (count($lokasi) > 0) {
			foreach ($lokasi as $l) {
				$arrLokasi[$l['id_lokasi_kerja']] = $l['lokasi_kerja'];

				$arrLokasiSelected[$l['id_lokasi_kerja']] = '';
				if ($data['lokasi'] == $l['id_lokasi_kerja']) {
					$arrLokasiSelected[$l['id_lokasi_kerja']] = 'selected=selected';
				}
			}
		}

		$data['arrLokasi'] = $arrLokasi;
		$data['arrLokasiSelected'] = $arrLokasiSelected;
		$data['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');
		// === end: lokasi ===

		$data['data'] = $rsSQL;

		$this->load->view('dashboard_admin/lapor/form_lapor_add', $data);
	}

	public function load_sub_dinas()
	{
		$sub_dinas = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => 1));

		if ($sub_dinas->num_rows() > 0) {
			foreach ($sub_dinas->result() as $row) {
				$result[] = [
					'id_lokasi_kerja' => $row->id_lokasi_kerja,
					'lokasi_kerja' => $row->lokasi_kerja
				];
			}
			echo json_encode($result);
		}
	}

	public function load_pegawai_bak()
	{
		$lokasi = $this->input->post('lokasi');
		$sublokasi = $this->input->post('sublokasi');

		if ($sublokasi == '') {
			$lok = $lokasi;
			if ($lok != '') {
				$lok = "AND peg.lokasi_kerja in ($lok) ";
			}

			$sSQL = "SELECT peg.id_pegawai, peg.lokasi_kerja, peg.sublokasi_kerja, jab.level_jabatan, peg.id_status_jabatan, peg.nama_pegawai 
					FROM tbl_data_pegawai AS peg 
						LEFT JOIN tbl_master_nama_jabatan AS jab ON jab.id_status_jabatan = peg.id_status_jabatan 
						AND jab.id_nama_jabatan = peg.id_jabatan AND jab.aktif = 1
					WHERE 1 = 1 $lok 
					ORDER BY 
						CASE WHEN ISNULL(jab.level_jabatan) OR jab.level_jabatan = '0' THEN '999' ELSE jab.level_jabatan END,
						CASE WHEN ISNULL(peg.id_status_jabatan) OR peg.id_status_jabatan = '0' THEN '999' ELSE peg.id_status_jabatan END,
						CASE WHEN ISNULL(peg.lokasi_kerja) OR peg.lokasi_kerja = '0' THEN '999' ELSE peg.lokasi_kerja END,
						peg.sublokasi_kerja ";

			$pegawai = $this->db->query($sSQL);
		} else {
			$ada_dinas = strpos($lokasi, '52');
			$is_many = strpos($lokasi, ',');


			$lok = '';
			if ($ada_dinas >= 0 and $is_many >= 0) {
				$lokasi = explode(', ', $lokasi); 						// change string to array
				if (($key = array_search('52', $lokasi)) !== false) { 	// search value in array
					unset($lokasi[$key]); 								// remove value in array
					$lokasi = implode(', ', $lokasi);					// change array to string
				}
				$lok = "AND (peg.lokasi_kerja in ($lokasi) OR peg.sublokasi_kerja in ($sublokasi)) ";
			} else {
				$lok = "AND peg.sublokasi_kerja in ($sublokasi) ";
			}


			$sSQL = "SELECT peg.id_pegawai, peg.lokasi_kerja, peg.sublokasi_kerja, jab.level_jabatan, peg.id_status_jabatan, peg.nama_pegawai 
					FROM tbl_data_pegawai AS peg 
						LEFT JOIN tbl_master_nama_jabatan AS jab ON jab.id_status_jabatan = peg.id_status_jabatan 
						AND jab.id_nama_jabatan = peg.id_jabatan AND jab.aktif = 1
					WHERE 1 = 1 $lok 
					ORDER BY 
						CASE WHEN ISNULL(jab.level_jabatan) OR jab.level_jabatan = '0' THEN '99' ELSE jab.level_jabatan END,
						CASE WHEN ISNULL(peg.id_status_jabatan) OR peg.id_status_jabatan = '0' THEN '99' ELSE peg.id_status_jabatan END,
						CASE WHEN ISNULL(peg.lokasi_kerja) OR peg.lokasi_kerja = '0' THEN '99' ELSE peg.lokasi_kerja END,
						peg.sublokasi_kerja ";

			$pegawai = $this->db->query($sSQL);
		}

		$result[] = '';
		if ($pegawai->num_rows() > 0) {
			foreach ($pegawai->result() as $row) {
				$result[] = [
					'id_pegawai' => $row->id_pegawai,
					'nama_pegawai' => $row->nama_pegawai
				];
			}
		}

		echo json_encode($result);
	}

	public function load_pegawai()
	{
		$lokasi = $this->input->post('lokasi');
		$sublokasi = $this->input->post('sublokasi');

		$lok = '';
		if (isset($lokasi)) {
			$lok = implode(', ', $lokasi);	// change array to string
		}

		if (!isset($sublokasi)) {
			if ($lok != '') {
				$lok = "AND peg.lokasi_kerja in ($lok) ";
			}

			$sSQL = "SELECT peg.id_pegawai, peg.lokasi_kerja, peg.sublokasi_kerja, jab.level_jabatan, peg.id_status_jabatan, peg.nama_pegawai 
					FROM tbl_data_pegawai AS peg 
						LEFT JOIN tbl_master_nama_jabatan AS jab ON jab.id_status_jabatan = peg.id_status_jabatan 
						AND jab.id_nama_jabatan = peg.id_jabatan AND jab.aktif = 1
					WHERE 1 = 1 $lok 
					ORDER BY 
						CASE WHEN ISNULL(jab.level_jabatan) OR jab.level_jabatan = '0' THEN '999' ELSE jab.level_jabatan END,
						CASE WHEN ISNULL(peg.id_status_jabatan) OR peg.id_status_jabatan = '0' THEN '999' ELSE peg.id_status_jabatan END,
						CASE WHEN ISNULL(peg.lokasi_kerja) OR peg.lokasi_kerja = '0' THEN '999' ELSE peg.lokasi_kerja END,
						peg.sublokasi_kerja ";

			$pegawai = $this->db->query($sSQL);
		} else {
			$is_many_lok = (count($lokasi) > 1);
			$sublokasi = implode(', ', $sublokasi);	// change array to string

			$lok = '';
			if ($is_many_lok) {
				if (($key = array_search('52', $lokasi)) !== false) { 	// search value in array
					unset($lokasi[$key]); 								// remove value in array
					$lokasi = implode(', ', $lokasi);					// change array to string
				}
				$lok = "AND (peg.lokasi_kerja in ($lokasi) OR peg.sublokasi_kerja in ($sublokasi)) ";
			} else {
				$lok = "AND peg.sublokasi_kerja in ($sublokasi) ";
			}


			$sSQL = "SELECT peg.id_pegawai, peg.lokasi_kerja, peg.sublokasi_kerja, jab.level_jabatan, peg.id_status_jabatan, peg.nama_pegawai 
					FROM tbl_data_pegawai AS peg 
						LEFT JOIN tbl_master_nama_jabatan AS jab ON jab.id_status_jabatan = peg.id_status_jabatan 
						AND jab.id_nama_jabatan = peg.id_jabatan AND jab.aktif = 1
					WHERE 1 = 1 $lok 
					ORDER BY 
						CASE WHEN ISNULL(jab.level_jabatan) OR jab.level_jabatan = '0' THEN '999' ELSE jab.level_jabatan END,
						CASE WHEN ISNULL(peg.id_status_jabatan) OR peg.id_status_jabatan = '0' THEN '999' ELSE peg.id_status_jabatan END,
						CASE WHEN ISNULL(peg.lokasi_kerja) OR peg.lokasi_kerja = '0' THEN '999' ELSE peg.lokasi_kerja END,
						peg.sublokasi_kerja ";

			$pegawai = $this->db->query($sSQL);
		}

		$result[] = '';
		if ($pegawai->num_rows() > 0) {
			foreach ($pegawai->result() as $row) {
				$result[] = [
					'id_pegawai' => $row->id_pegawai,
					'nama_pegawai' => $row->nama_pegawai
				];
			}
		}

		echo json_encode($result);
	}

	function simpan_add()
	{
		// === begin: get required values ===
		$status = 0;
		$message = '';

		$id_pegawai 	= $this->session->userdata('id_pegawai');
		$created_by 	= $this->session->userdata('username');
		$date_now 		= date('Y-m-d H:i:s');

		$kategori = $this->db->query('SELECT uraian FROM tr_master_lapor WHERE id = 3')->row()->uraian;
		$isi_laporan 	= $this->input->post('isi_laporan');
		$file_upload 	= $this->input->post('file_upload');
		$lokasi 		= $this->input->post('lokasi');
		$sublokasi 		= $this->input->post('sublokasi');
		$pegawai 		= $this->input->post('pegawai');

		$lokasi_kerja = $this->session->userdata('lokasi_kerja');
		if ($lokasi_kerja == '0') {
			$lokasi_kerja = '52';
		}
		// === end: get required values ===


		// === begin: file handling ===
		$ucode_gen = $this->func_table->generateRandomString2();
		$new_name = 'I_' . $ucode_gen;

		$path_folder = "./asset/upload/Lapor/";

		if ($_FILES["file_upload"]['name'] == '') {
			$new_name_file = '';
		} else if ($_FILES["file_upload"]['name'] != '') {
			// --
			$string = $_FILES["file_upload"]['name'];
			$temp = explode(".", $string);
			$new_name_file = $new_name . '.' . end($temp);
			$new_name_file = str_replace(' ', '', $new_name_file);
			// --
			$config['file_name'] = $new_name_file;
			$config['upload_path'] = $path_folder;
			$config['allowed_types'] = '*';

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file_upload')) {
				$message = 'Gagal upload file.';
				goto exit_1;
			} else {
				$new_name_file = $this->upload->file_name;
			}
		} else {
			$new_name_file = '';
		}
		// === end: file handling ===


		$data['id_pegawai'] = $id_pegawai;
		$data['Tanggapan_id'] = '0';
		$data['id_lokasi_kerja'] = $lokasi_kerja;
		$data['Kategori'] = $kategori;
		$data['Isi_laporan'] = $isi_laporan;
		$data['file_upload'] = $new_name_file;
		$data['Created_by'] = $created_by;
		$data['Created_at'] = $date_now;
		$data['Updated_at'] = $date_now;
		$data['user_type'] = 2;
		$data['info_lokasi'] = (isset($lokasi)) ? implode(', ', $lokasi) : '';
		$data['info_sublokasi'] = (isset($sublokasi)) ? implode(', ', $sublokasi) : '';
		$data['info_pegawai'] = (isset($pegawai)) ? implode(', ', $pegawai) : '';

		// === begin: insert into tr_lapor ===
		$result_in = $this->db->insert('tr_lapor', $data);
		if ($result_in) {
			$last_id = $this->db->query("SELECT MAX(id) as id FROM tr_lapor")->row()->id;

			// === create notif ===
			// $this->func_table_lapor->in_tosee_lapor($created_by, $last_id, '0', $created_by);
			// === send wa & email ===
			// $this->func_wa_lapor->notif_lapor_tambah($last_id);

			$message = 'Berhasil simpan data info admin.';
			$status = 1;
		} else {
			$message = 'Gagal simpan data info admin.';
		}

		exit_1:
		// 
		$result = [
			'message' => $message,
			'status' => $status
		];
		echo json_encode($result);
	}

	public function form_lapor_view()
	{
		$id_lapor = $this->input->post('id');

		// === data lapor ===
		$data_lapor = $this->db->query("SELECT * FROM tr_lapor WHERE id = '$id_lapor'")->row();

		// === begin: data pegawai ===
		$sSQL = "SELECT
					log.id_user_login,
					log.id_pegawai,
					log.nama_lengkap AS nama_pegawai,
					log.id_lokasi_kerja AS lokasi_kerja,
					lok.nama_lokasi_kerja 
				FROM tbl_user_login AS log
					LEFT JOIN ( SELECT id_lokasi_kerja, lokasi_kerja AS nama_lokasi_kerja 
								FROM tbl_master_lokasi_kerja 
								) AS lok ON lok.id_lokasi_kerja = log.id_lokasi_kerja 
				WHERE
					log.id_pegawai = '$data_lapor->id_pegawai'";
		$rsPegawai = $this->db->query($sSQL)->row();
		// === end: data pegawai ===

		// === begin: data tanggapan ===
		$sSQL = "SELECT
					a.id, 
					a.lapor_id, 
					a.username, 
					a.tanggapan, 
					a.created_at, 
					a.updated_at, nama_lengkap
				FROM
					tr_lapor_tanggapan as a
				LEFT JOIN (
					SELECT nama_lengkap, username 
					FROM tbl_user_login
				) as b ON b.username =  a.username 
				WHERE a.lapor_id = '$id_lapor' ";
		$rsTanggapan = $this->db->query($sSQL)->result();
		// === end: data tanggapan ===

		// // === begin: info lokasi ===
		// $notif_lokasi = $data_lapor->info_lokasi;
		// $where = '';
		// if ($notif_lokasi != '') {
		// 	$is_many = strpos($notif_lokasi, ',');
		// 	if ($is_many) {
		// 		// $notif_lokasi = explode(', ', $notif_lokasi);					// change string to array
		// 		// if (($key = array_search('52', $notif_lokasi)) !== false) { 	// search value in array
		// 		// 	unset($notif_lokasi[$key]); 								// remove value in array
		// 		// 	$notif_lokasi = implode(', ', $notif_lokasi);				// change array to string
		// 		// }
		// 	}
		// 	$where = 'AND id_lokasi_kerja in (' . $notif_lokasi . ')';
		// }
		// $sSQL = "SELECT lokasi_kerja FROM tbl_master_lokasi_kerja WHERE 1 = 1 $where";
		// $rsNotifLokasi = $this->db->query($sSQL)->result();
		// // === end: info lokasi ===

		// // === begin: info sublokasi ===
		// $rsNotifSublokasi = '';
		// if ($data_lapor->info_sublokasi != '') {
		// 	$sSQL = "SELECT lokasi_kerja
		// 			from tbl_master_lokasi_kerja
		// 			where dinas = 1 and id_lokasi_kerja in ($data_lapor->info_sublokasi) ";
		// 	$rsNotifSublokasi = $this->db->query($sSQL)->result();
		// }
		// // === end: info sublokasi ===

		// // === begin: info pegawai ===
		// $rsNotifPegawai = '';
		// if ($data_lapor->info_pegawai != '') {
		// 	$sSQL = "SELECT peg.id_pegawai, peg.nama_pegawai, lok.lokasi_kerja
		// 			from tbl_data_pegawai as peg
		// 			left join tbl_master_lokasi_kerja as lok on 
		// 				case
		// 					when (peg.lokasi_kerja = 52 and peg.sublokasi_kerja <> 0) then lok.id_lokasi_kerja = peg.sublokasi_kerja
		// 					else lok.id_lokasi_kerja = peg.lokasi_kerja
		// 				end
		// 			LEFT JOIN tbl_master_nama_jabatan AS jab ON jab.id_status_jabatan = peg.id_status_jabatan 
		// 				AND jab.id_nama_jabatan = peg.id_jabatan AND jab.aktif = 1
		// 			where 
		// 				peg.id_pegawai in ($data_lapor->info_pegawai) 
					
		// 			ORDER BY 
		// 				CASE WHEN ISNULL(jab.level_jabatan) OR jab.level_jabatan = '0' THEN '999' ELSE jab.level_jabatan END,
		// 				CASE WHEN ISNULL(peg.id_status_jabatan) OR peg.id_status_jabatan = '0' THEN '999' ELSE peg.id_status_jabatan END,
		// 				CASE WHEN ISNULL(peg.lokasi_kerja) OR peg.lokasi_kerja = '0' THEN '999' ELSE peg.lokasi_kerja END,
		// 				peg.sublokasi_kerja ";
		// 	$rsNotifPegawai = $this->db->query($sSQL)->result();
		// }
		// // === end: info pegawai ===

		// === begin: lokasi ===
		$arrLokasi = array();
		$this->db->select('id_lokasi_kerja, lokasi_kerja');
		$lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => '0'))->result_array();
		if (count($lokasi) > 0) {
			foreach ($lokasi as $item) {
				$arrLokasi[$item['id_lokasi_kerja']] = $item['lokasi_kerja'];
			}
		}
		$data['arrLokasi'] = $arrLokasi;
		// === end: lokasi ===

		// === begin: sublokasi ===
		$arrSubLokasi = array();
		$this->db->select('id_lokasi_kerja, lokasi_kerja');
		$sublokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => '1'))->result_array();
		if (count($sublokasi) > 0) {
			foreach ($sublokasi as $item) {
				$arrSubLokasi[$item['id_lokasi_kerja']] = $item['lokasi_kerja'];
			}
		}
		$data['arrSubLokasi'] = $arrSubLokasi;
		// === end: sublokasi ===

		// === begin: pegawai ===
		$arrPegawai = array();
		$where  = '';
		if ($data_lapor->info_pegawai != '') {
			$where = 'AND peg.id_pegawai in (' . $data_lapor->info_pegawai . ')';
		}
		$sSQL = "SELECT peg.id_pegawai, peg.nama_pegawai, lok.lokasi_kerja
				from tbl_data_pegawai as peg
				left join tbl_master_lokasi_kerja as lok on 
					case
						when (peg.lokasi_kerja = 52 and peg.sublokasi_kerja <> 0) then lok.id_lokasi_kerja = peg.sublokasi_kerja
						else lok.id_lokasi_kerja = peg.lokasi_kerja
					end
				LEFT JOIN tbl_master_nama_jabatan AS jab ON jab.id_status_jabatan = peg.id_status_jabatan 
					AND jab.id_nama_jabatan = peg.id_jabatan AND jab.aktif = 1
				where 1 = 1 $where 
				ORDER BY 
					CASE WHEN ISNULL(jab.level_jabatan) OR jab.level_jabatan = '0' THEN '999' ELSE jab.level_jabatan END,
					CASE WHEN ISNULL(peg.id_status_jabatan) OR peg.id_status_jabatan = '0' THEN '999' ELSE peg.id_status_jabatan END,
					CASE WHEN ISNULL(peg.lokasi_kerja) OR peg.lokasi_kerja = '0' THEN '999' ELSE peg.lokasi_kerja END,
					peg.sublokasi_kerja ";
		$pegawai = $this->db->query($sSQL)->result_array();
		// $pegawai = $this->db->get_where('tbl_master_lokasi_kerja', array('id_pegawai' => '1'))->result_array();

		if (count($pegawai) > 0) {
			foreach ($pegawai as $item) {
				$arrPegawai[$item['id_pegawai']] = $item['nama_pegawai'];
			}
		}
		$data['arrPegawai'] = $arrPegawai;
		// === end: pegawai ===

		$data['id_lapor'] 				= $id_lapor;
		$data['data_lapor'] 			= $data_lapor;
		$data['data_pegawai'] 			= $rsPegawai;
		$data['data_tanggapan'] 		= $rsTanggapan;
		// $data['data_notif_lokasi']		= $rsNotifLokasi;
		// $data['data_notif_sublokasi']	= $rsNotifSublokasi;
		// $data['data_notif_pegawai']		= $rsNotifPegawai;

		$this->load->view('dashboard_admin/lapor/form_lapor_view', $data);
	}

	function form_lapor_edit()
	{
		$id = $this->input->post('id');

		// === data lapor ===
		$data_lapor = $this->db->query("SELECT * from tr_lapor where id = '$id'")->row();

		// === begin: data pegawai ===
		$sSQL = "SELECT
					log.id_user_login,
					log.id_pegawai,
					log.nama_lengkap AS nama_pegawai,
					log.id_lokasi_kerja AS lokasi_kerja,
					lok.nama_lokasi_kerja 
				FROM tbl_user_login AS log
					LEFT JOIN ( SELECT id_lokasi_kerja, lokasi_kerja AS nama_lokasi_kerja 
								FROM tbl_master_lokasi_kerja 
								) AS lok ON lok.id_lokasi_kerja = log.id_lokasi_kerja 
				WHERE
					log.id_pegawai = '$data_lapor->id_pegawai'";
		$rsPegawai = $this->db->query($sSQL)->row();
		// === end: data pegawai ===

		// === begin: lokasi ===
		$arrLokasi = array();
		$this->db->select('id_lokasi_kerja, lokasi_kerja');
		$lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => '0'))->result_array();
		if (count($lokasi) > 0) {
			foreach ($lokasi as $item) {
				$arrLokasi[$item['id_lokasi_kerja']] = $item['lokasi_kerja'];
			}
		}
		$data['arrLokasi'] = $arrLokasi;
		// === end: lokasi ===

		// === begin: sublokasi ===
		$arrSubLokasi = array();
		$this->db->select('id_lokasi_kerja, lokasi_kerja');
		$sublokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => '1'))->result_array();
		if (count($sublokasi) > 0) {
			foreach ($sublokasi as $item) {
				$arrSubLokasi[$item['id_lokasi_kerja']] = $item['lokasi_kerja'];
			}
		}
		$data['arrSubLokasi'] = $arrSubLokasi;
		// === end: sublokasi ===

		// === begin: pegawai ===
		$arrPegawai = array();
		$where  = '';
		if ($data_lapor->info_pegawai != '') {
			$where = 'AND peg.id_pegawai in (' . $data_lapor->info_pegawai . ')';
		}
		$sSQL = "SELECT peg.id_pegawai, peg.nama_pegawai, lok.lokasi_kerja
				from tbl_data_pegawai as peg
				left join tbl_master_lokasi_kerja as lok on 
					case
						when (peg.lokasi_kerja = 52 and peg.sublokasi_kerja <> 0) then lok.id_lokasi_kerja = peg.sublokasi_kerja
						else lok.id_lokasi_kerja = peg.lokasi_kerja
					end
				LEFT JOIN tbl_master_nama_jabatan AS jab ON jab.id_status_jabatan = peg.id_status_jabatan 
					AND jab.id_nama_jabatan = peg.id_jabatan AND jab.aktif = 1
				where 1 = 1 $where 
				ORDER BY 
					CASE WHEN ISNULL(jab.level_jabatan) OR jab.level_jabatan = '0' THEN '999' ELSE jab.level_jabatan END,
					CASE WHEN ISNULL(peg.id_status_jabatan) OR peg.id_status_jabatan = '0' THEN '999' ELSE peg.id_status_jabatan END,
					CASE WHEN ISNULL(peg.lokasi_kerja) OR peg.lokasi_kerja = '0' THEN '999' ELSE peg.lokasi_kerja END,
					peg.sublokasi_kerja ";
		$pegawai = $this->db->query($sSQL)->result_array();
		// $pegawai = $this->db->get_where('tbl_master_lokasi_kerja', array('id_pegawai' => '1'))->result_array();

		if (count($pegawai) > 0) {
			foreach ($pegawai as $item) {
				$arrPegawai[$item['id_pegawai']] = $item['nama_pegawai'];
			}
		}
		$data['arrPegawai'] = $arrPegawai;
		// === end: pegawai ===

		$data['data_lapor'] 	= $data_lapor;
		$data['data_pegawai'] 	= $rsPegawai;
		$data['id'] 			= $id;

		// $this->load->view('dashboard_publik/lapor/form_lapor_update', $a);
		$this->load->view('dashboard_admin/lapor/form_lapor_edit', $data);
	}

	function simpan_update()
	{
		$message = '';
		$status = 0;

		$id_lapor 		= $this->input->post('id_lapor');
		$isi_laporan 	= $this->input->post('isi_laporan');
		$date_now 		= date('Y-m-d H:i:s');

		$lokasi_kerja = $this->session->userdata('lokasi_kerja');
		if ($lokasi_kerja == '0') {
			$lokasi_kerja = '52';
		}

		// === begin: file upload ===

		$file_upload 		= $this->input->post('file_upload');
		$file_upload_lama 	= $this->input->post('file_upload_lama');

		$ucode_gen = $this->func_table->generateRandomString2();
		$new_name = 'I_' . $ucode_gen;
		$path_folder = "./asset/upload/Lapor/";


		if ($_FILES["file_upload"]['name'] == '' and $file_upload_lama == '') {
			$new_name_file = '';
		} else if ($_FILES["file_upload"]['name'] == '' and $file_upload_lama != '') {
			$new_name_file = $file_upload_lama;
		} else if ($_FILES["file_upload"]['name'] != '' and $file_upload_lama == '') {
			// --
			$string = $_FILES["file_upload"]['name'];
			$temp = explode(".", $string);
			$new_name_file = $new_name . '.' . end($temp);
			$new_name_file = str_replace(' ', '', $new_name_file);
			// --
			$config['file_name'] = $new_name_file;
			$config['upload_path'] = $path_folder;
			$config['allowed_types'] = '*';

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file_upload')) {
				// echo '<script>alert(Gagal....!);</script>';
				$message = 'Gagal upload file.';
				goto exit_1;
			} else {
				$new_name_file = $this->upload->file_name;
			}
		} else if ($_FILES["file_upload"]['name'] != '' and $file_upload_lama != '') {
			unlink($path_folder . $file_upload_lama);
			// --
			$string = $_FILES["file_upload"]['name'];
			$temp = explode(".", $string);
			$new_name_file = $new_name . '.' . end($temp);
			$new_name_file = str_replace(' ', '', $new_name_file);
			// --
			$config['file_name'] = $new_name_file;
			$config['upload_path'] = $path_folder;
			$config['allowed_types'] = '*';

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file_upload')) {
				// echo '<script>alert(gagal....!);</script>';
				$message = 'Gagal upload file.';
				goto exit_1;
			} else {
				$new_name_file = $this->upload->file_name;
			}
		}

		// === end: file upload ===


		$data['isi_laporan'] = $isi_laporan;
		$data['file_upload'] = $new_name_file;
		$data['updated_at'] = $date_now;

		$this->db->where('id', $id_lapor);
		$this->db->update('tr_lapor', $data);

		$message = 'Berhasil update data info admin.';
		$status = 1;

		exit_1:
		// 
		$result = [
			'message' => $message,
			'status' => $status,
		];
		echo json_encode($result);
	}
}

/* End of file Data_lapor.php */
/* Location: ./application/controllers/Data_lapor.php */
