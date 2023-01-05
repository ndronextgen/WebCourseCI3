<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_tindak_pidana extends CI_Controller
{

	/*
		***	Controller : Data_tindak_pidana.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('template');
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->library('func_wa_tindak_pidana');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_tindak_pidana', 'tindak_pidana');
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
			$d['page_name'] = 'Data Tindak Pidana';
			$d['menu_open'] = 'data_tindak_pidana';

			$this->load->view('dashboard_admin/kertas_kerja/tindak_pidana/index_tindak_pidana', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function filter()
	{
		$this->load->view('dashboard_admin/kertas_kerja/tindak_pidana/ajax_table');
	}

	function table_data_tindak_pidana()
	{

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');
		$username = $this->session->userdata('username');

		$listing 		= $this->tindak_pidana->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->tindak_pidana->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->tindak_pidana->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$see = $this->func_table->see_admin_tp($username, $key->Tindak_pidana_id);
			$button_download = '<a type="button" class="kt-nav__link btn-danger btn-sm" data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/Data_tindak_pidana/download_surat/' . $key->Tindak_pidana_id . '" href="javascript:void(0);">
										<i class="fa fa-file"></i> Download
								</a>';
			// $button_download = '<a type="button" class="kt-nav__link btn-danger btn-sm" href="' . base_url() . 'admin/Data_tindak_pidana/download_surat/' . $key->Tindak_pidana_id . '" target="_blank">
			// 							<i class="fa fa-file"></i> Download
			// 					</a>';

			if ($see == '0' and ($key->Status_progress == '0' or $key->Status_progress == '25' or $key->Status_progress == '28')) {
				$button_view = '<a type="button" class="kt-nav__link btn-primary btn-sm" onclick="proses_surat_tindak_pidana(' . "'" . $key->Tindak_pidana_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-bookmark" style="color:#fff !important;"></i> &nbsp;Proses
							</a>';
			} else {

				$button_view = '<a type="button" class="kt-nav__link btn-info btn-sm" onclick="proses_surat_tindak_pidana(' . "'" . $key->Tindak_pidana_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-eye" style="color:#fff !important;"></i> &nbsp;Detail
							</a>';
			}
			$button_edit = '<a type="button" class="kt-nav__link btn-warning btn-sm" onclick="edit_surat_tindak_pidana(' . "'" . $key->Tindak_pidana_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-edit" style="color:#fff !important;"></i> &nbsp;Edit
							</a>';
			$button_delete = '<a type="button" class="kt-nav__link btn-danger btn-sm" onclick="delete_surat_tindak_pidana(' . "'" . $key->Tindak_pidana_id . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-trash" style="color:#fff !important;"></i> &nbsp;Hapus
							</a>';
			if ($key->Status_progress == '0') {
				$button = $button_view . ' ' . $button_edit . ' ' . $button_delete;
			} elseif ($key->Status_progress == '21' and $user_type == 'administrator' and ($id_lokasi_kerja == '0' || $id_lokasi_kerja == '' || $id_lokasi_kerja == '52')) {
				$button = $button_view . ' ' . $button_edit . ' ' . $button_delete;
			} elseif ($key->Status_progress == '3') {
				$button = $button_view . ' ' . $button_download;
			} else {
				$button = $button_view;
			}


			$row[] = $no;
			$row[] = $button;
			$row[] = ucwords(strtolower($key->nama_pegawai));
			$row[] = $key->nama_status;
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

	// tambah tunjangan
	function tambah_tindak_pidana()
	{
		$Tindak_pidana_id = $this->func_table->generateRandomString();
		$a['user_type'] = $this->session->userdata('stts');
		$a['id_lokasi_kerja'] = $this->session->userdata('lokasi_kerja');

		$a['data_pegawai'] 	= $this->db->query("SELECT * FROM tbl_data_pegawai order by nama_pegawai ASC")->result();
		$a['lokasi_kerja'] 	= $this->db->query("SELECT * FROM tbl_master_lokasi_kerja where sublokasi = '0' order by id_lokasi_kerja ASC")->result();
		$a['Tindak_pidana_id'] = $Tindak_pidana_id;

		$a['func_table'] = $this->load->library('func_table');

		$this->load->view('dashboard_admin/kertas_kerja/tindak_pidana/form_tindak_pidana_tambah', $a);
	}

	public function get_pegawai()
	{
		//$id_pegawai = '';
		$data = '';
		$lokasi_kerja = $this->input->post('lokasi_kerja');
		$id_pegawai = $this->input->post('id_pegawai');
		$data_id_pegawai = isset($id_pegawai) ? $id_pegawai : '';
		if ($lokasi_kerja != '') {
			$kond = " AND p.lokasi_kerja = '$lokasi_kerja'";
		} else {
			$kond = " AND p.lokasi_kerja = 'x'";
		}
		$pegawai = $this->db->query("SELECT p.nama_pegawai, p.id_pegawai, lk.lokasi_kerja
								FROM tbl_data_pegawai AS p
									LEFT JOIN (
										SELECT lokasi_kerja, id_lokasi_kerja FROM tbl_master_lokasi_kerja
									) AS lk ON lk.id_lokasi_kerja = p.lokasi_kerja
								WHERE p.id_pegawai != '--' $kond")->result();

		$data .= "<option value=''>- Pilih Pegawai -</option>";
		foreach ($pegawai as $o) {
			if ($o->id_pegawai == $data_id_pegawai) {
				$cek = " selected";
			} else {
				$cek = "";
			}
			$data .= "<option value='$o->id_pegawai' $cek>$o->nama_pegawai</option>";
		}
		echo $data;
	}

	public function get_elm_pegawai()
	{
		$filter_pegawai = $this->input->post('filter_pegawai');
		$data_id_pegawai = isset($filter_pegawai) ? $filter_pegawai : '';
		if ($data_id_pegawai != '') {
			$kond = " AND a.id_pegawai = '$data_id_pegawai'";
		} else {
			$kond = " AND a.id_pegawai = 'x'";
		}
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
									WHERE nrk != '' $kond")->row();
		$Data = isset($Data) ? $Data : '';
		$a['Data'] = $Data;

		if ($Data != '') {
			$this->load->view('dashboard_admin/kertas_kerja/tindak_pidana/table_info.php', $a);
		}
	}

	public function simpan_validasi()
	{
		$status = false;
		$message = '';

		$Tindak_pidana_id 	= $this->input->post('Tindak_pidana_id');
		$id_pegawai 		= $this->input->post('filter_pegawai');

		if ($id_pegawai != '') {

			$data_pegawai = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
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
											WHERE a.id_pegawai = '$id_pegawai'")->row();
			if ($data_pegawai->nama_pegawai == '' || $data_pegawai->nip == '' || $data_pegawai->nrk == '' || $data_pegawai->uraian == '' || $data_pegawai->golongan == '' || $data_pegawai->nama_jabatan == '' || $data_pegawai->nama_lokasi_kerja == '') {
				$message = "Lengkapi data pegawai yang akan diajukan terlebih dahulu!";
			} else {
				$status = True;
				$message = "OK";
			}
		} else {
			
			$message = "Pilih Pegawai!";
		}

		$result = [
			'status' => $status,
			'message' => $message
		];
		echo json_encode($result);
	}

	public function simpan_tambah()
	{
		$status = false;
		$message = '';

		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '0';
		$Date_now 			= date('Y-m-d H:i:s');

		$Created_by 		= $this->session->userdata('username');
		$Updated_by 		= $this->session->userdata('username');
		$Tindak_pidana_id 	= $this->input->post('Tindak_pidana_id');
		$id_pegawai 		= $this->input->post('filter_pegawai');

		#lokasi admin menentukan kstatus progress 
		#jika admin lokasi maka status 0 
		#jika admin utama maka status 21 //verifikasi admin
		$lokasi_admin 		= $this->input->post('lokasi_admin');
		if ($lokasi_admin == '0' || $lokasi_admin == '' || $lokasi_admin == null || $lokasi_admin == '52') {
			$Status_progress 	= '21'; //verifikasi admin
		} else {
			$Status_progress 	= '0'; //menunggu
		}
		$Act 				= '0'; //harus ada track
		$Notes				= '';
		$Date_now 			= date('Y-m-d H:i:s');

		$data_pegawai = $this->db->query(
			"SELECT
				if(isnull(b.dinas),'1',b.dinas) as dinas, 
				a.id_pegawai, 
				a.lokasi_kerja, 
				a.status_pegawai
			FROM
				tbl_data_pegawai AS a
			LEFT JOIN tbl_master_lokasi_kerja AS b ON a.lokasi_kerja = b.id_lokasi_kerja
			WHERE id_pegawai = '$id_pegawai'"
		)->row();

		$lokasi_kerja_pegawai	= $data_pegawai->lokasi_kerja;
		$is_dinas				= $data_pegawai->dinas;

		$data['id_pegawai'] 			= $id_pegawai;
		$data['lokasi_kerja_pegawai'] 	= $lokasi_kerja_pegawai;
		$data['is_dinas'] 				= $is_dinas;
		$data['Tindak_pidana_id'] 		= $Tindak_pidana_id;
		$data['Status_progress'] 		= $Status_progress;
		$data['Created_by'] 			= $Created_by;
		$data['Created_at'] 			= $Date_now;
		$data['Updated_by'] 			= $Updated_by;
		$data['Updated_at'] 			= $Date_now;

		$in_tindak_pidana = $this->db->insert('tr_tindak_pidana', $data);
		if ($in_tindak_pidana) {
			$data_triger['Act'] 				= $Act;
			$data_triger['Tindak_pidana_id'] 	= $Tindak_pidana_id;
			$data_triger['Status_progress'] 	= $Status_progress;
			$data_triger['Notes'] 				= $Notes;
			$data_triger['User_created'] 		= $Updated_by;
			$data_triger['Created_at'] 			= $Date_now;
			$Q_insert = $this->db->insert('tr_tindak_pidana_triger', $data_triger);

			//$see = $this->func_table->in_tosee_tj($Created_by, $Tunjangan_id, '0', $Created_by);
			#wa/email
			if ($Q_insert) {
				#wa/email to pegawai
				#wa/email to admin bersangkutan
				$send_notif_tp_pegawai 	= $this->func_wa_tindak_pidana->notif_tp_admin_tambah($Tindak_pidana_id);
			}
			#end wa/email
			$status = true;
			$message = 'Berhasil';
		} else {
			$message = 'Gagal';
		}
		$result = [
			'status' => $status,
			'message' => $message
		];
		echo json_encode($result);
	}

	function edit_tindak_pidana()
	{
		$Tindak_pidana_id = $this->input->post('Tindak_pidana_id');
		$a['user_type'] = $this->session->userdata('stts');
		$a['id_lokasi_kerja'] = $this->session->userdata('lokasi_kerja');

		$a['Data'] 			= $this->db->query("SELECT * FROM tr_tindak_pidana WHERE Tindak_pidana_id = '$Tindak_pidana_id'")->row();
		$a['tipe_surat'] 	= $this->db->query("SELECT * FROM tbl_master_tipe_surat_hukdis ORDER BY id_tipe_surat_hukdis")->result();
		$a['data_pegawai'] 	= $this->db->query("SELECT * FROM tbl_data_pegawai order by nama_pegawai ASC")->result();
		$a['lokasi_kerja'] 	= $this->db->query("SELECT * FROM tbl_master_lokasi_kerja where sublokasi = '0' order by id_lokasi_kerja ASC")->result();
		$a['Tindak_pidana_id'] = $Tindak_pidana_id;

		$a['func_table'] = $this->load->library('func_table');

		$this->load->view('dashboard_admin/kertas_kerja/tindak_pidana/form_tindak_pidana_edit', $a);
	}

	public function simpan_edit()
	{
		$status = false;
		$message = '';

		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '0';
		$Date_now 			= date('Y-m-d H:i:s');

		$Tindak_pidana_id 	= $this->input->post('Tindak_pidana_id');
		$Type_surat 		= $this->input->post('Type_surat');
		$lokasi_kerja 		= $this->input->post('lokasi_kerja');
		$id_pegawai 		= $this->input->post('filter_pegawai');

		#lokasi admin menentukan kstatus progress 
		#jika admin lokasi maka status 0 
		#jika admin utama maka status 21 //verifikasi admin
		$lokasi_admin 		= $this->input->post('lokasi_admin');
		if ($lokasi_admin == '0' || $lokasi_admin == '' || $lokasi_admin == null || $lokasi_admin == '52') {
			$Status_progress 	= '21'; //verifikasi admin
		} else {
			$Status_progress 	= '0'; //menunggu
		}
		$Act 				= '0'; //harus ada track
		$Notes				= '';
		$Date_now 			= date('Y-m-d H:i:s');

		$data_pegawai = $this->db->query(
			"SELECT
				if(isnull(b.dinas),'1',b.dinas) as dinas, 
				a.id_pegawai, 
				a.lokasi_kerja, 
				a.status_pegawai
			FROM
				tbl_data_pegawai AS a
			LEFT JOIN tbl_master_lokasi_kerja AS b ON a.lokasi_kerja = b.id_lokasi_kerja
			WHERE id_pegawai = '$id_pegawai'"
		)->row();

		$lokasi_kerja_pegawai	= $data_pegawai->lokasi_kerja;
		$is_dinas				= $data_pegawai->dinas;

		$data['id_pegawai'] 			= $id_pegawai;
		$data['lokasi_kerja_pegawai'] 	= $lokasi_kerja_pegawai;
		$data['is_dinas'] 				= $is_dinas;
		$data['Updated_by'] 			= $Updated_by;
		$data['Updated_at'] 			= $Date_now;

		$this->db->where('Tindak_pidana_id', $Tindak_pidana_id);
		$in_tindak_pidana = $this->db->update('tr_tindak_pidana', $data);

		if ($in_tindak_pidana) {
			// $data_triger['Act'] 			= $Act;
			// $data_triger['Tunjangan_id'] 	= $Tunjangan_id;
			// $data_triger['Status_progress'] = $Status_progress;
			// $data_triger['Notes'] 			= $Notes;
			// $data_triger['User_created'] 	= $Updated_by;
			// $data_triger['Created_at'] 		= $Date_now;
			// $Q_insert = $this->db->insert('tr_triger_tunjangan', $data_triger);

			//$see = $this->func_table->in_tosee_tj($Created_by, $Tunjangan_id, '0', $Created_by);
			#wa/email
			// if ($Q_insert) {
			// 	#wa/email to pegawai
			// 	#wa/email to admin bersangkutan
			// 	//$send_notif_sk_pegawai 	= $this->func_wa_tunjangan->notif_tj_pegawai_tambah($Tunjangan_id);
			// }
			#end wa/email
			$status = true;
			$message = 'Berhasil';
		} else {
			$message = 'Gagal';
		}
		$result = [
			'status' => $status,
			'message' => $message
		];
		echo json_encode($result);
	}

	function delete_tindak_pidana()
	{
		$Tindak_pidana_id = $this->input->post('Tindak_pidana_id');
		$del = $this->db->query("DELETE FROM tr_tindak_pidana WHERE Tindak_pidana_id = '$Tindak_pidana_id'");
		if ($del) {
			echo 'Berhasil Hapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	function proses_tindak_pidana()
	{
		$Tindak_pidana_id = $this->input->post('Tindak_pidana_id');
		$username 	= $this->session->userdata('username');

		$Data_tindak_pidana = $this->db->query("SELECT
											a.Id, 
											a.id_pegawai, 
											a.lokasi_kerja_pegawai, 
											a.is_dinas, 
											a.Tindak_pidana_id, 
											a.Status_progress, 
											a.Notes, 
											a.Nomor_surat, 
											a.Tanggal_verifikasi, 
											a.Created_by, 
											a.Created_at, 
											a.Updated_by, 
											a.Updated_at
										FROM
											tr_tindak_pidana AS a 
										WHERE a.Tindak_pidana_id='$Tindak_pidana_id'")->row();
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
									WHERE id_pegawai = '$Data_tindak_pidana->id_pegawai'")->row();



		if (($Data_tindak_pidana->Status_progress == '0' || $Data_tindak_pidana->Status_progress == '25' || $Data_tindak_pidana->Status_progress == '28')) { //bidang dan sekretariat
			$terima = "21";
			$tolak = "24";
		} else if ($Data_tindak_pidana->Status_progress == '21') { //diverifikasi admin
			$terima = "22";
			$tolak = "25";
		} else if ($Data_tindak_pidana->Status_progress == '22') { //diverifikasi kepegawaian
			$terima = "23";
			$tolak = "26";
		} else if ($Data_tindak_pidana->Status_progress == '0') { //diverifikasi admin
			$terima = "21";
			$tolak = "24";
		} else if ($Data_tindak_pidana->Status_progress == '3') { //selesai hanya view aja
			$terima = "3";
			$tolak = "3";
			$this->func_table->in_tosee_tp($Data_tindak_pidana->Created_by, $Tindak_pidana_id, $Data_tindak_pidana->Status_progress, $username);
		} else {
			$terima = "2";
			$tolak = "1";
		}

		$a['Data'] = $Data;
		$a['Data_tindak_pidana'] = $Data_tindak_pidana;
		$a['Tindak_pidana_id'] = $Tindak_pidana_id;

		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;
		$a['func_table'] = $this->load->library('func_table');

		//history
		$history = null;

		if ($Data_tindak_pidana->Status_progress == '1') { //ditolak
			$kondisi = " WHERE x.id_status in ('0','1')";
		} else if ($Data_tindak_pidana->Status_progress == '24') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'24')";
		} else if ($Data_tindak_pidana->Status_progress == '25') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'22','25')";
		} else if ($Data_tindak_pidana->Status_progress == '26') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'22','23','26')";
		} else if ($Data_tindak_pidana->Status_progress == '28') {
			$kondisi = " WHERE x.id_status in ('0','21' ,'27','28')";
		} else {
			$kondisi = " WHERE x.id_status NOT IN ('1', '24', '25', '26', '28') ";
		}

		if ($Data_tindak_pidana->is_dinas == '1') { //bidang dan sekretariat
			$kondisi_bidang = " AND x.sort_bidang != '0'";
			$kond_order = " x.sort_bidang";
		} else if ($Data_tindak_pidana->is_dinas != '1') {
			$kondisi_bidang = " AND x.sort_bidang != '0'";
			$kond_order = " x.sort_bidang";
		} else {
			$kondisi_bidang = " AND x.sort_bidang != '0'";
			$kond_order = " x.sort_bidang";
		}

		$Query_history = $this->db->query("SELECT 
											x.id_status, x.nama_status, x.style, x.sort as urutan, x.sort_bidang as urutan_bidang,
											y.Tindak_pidana_id, y.Status_progress, y.Status_name, y.Notes, y.User_created, y.Name_user, y.Created_at
											FROM tbl_status_surat x
											LEFT JOIN (
															SELECT
																a.Tindak_pidana_id, 
																a.Status_progress, 
																a.Status_name, 
																a.Notes, 
																a.User_created, 
																a.Name_user, 
																a.Created_at
															FROM
																tr_tindak_pidana_track AS a
															WHERE a.Tindak_pidana_id='$Tindak_pidana_id'
															GROUP BY a.Tindak_pidana_id,a.Status_progress
											) y ON y.Status_progress = x.id_status 
											$kondisi $kondisi_bidang
											ORDER BY $kond_order ASC")->result();
		$a['Query_history'] = $Query_history;

		$this->load->view('dashboard_admin/kertas_kerja/tindak_pidana/proses_tindak_pidana', $a);
	}

	public function processSave()
	{
		$status = false;
		$message = '';

		$Tindak_pidana_id = $this->input->post('Tindak_pidana_id');
		$status_verify = $this->input->post('status_verify');
		$ket = $this->input->post('ket');
		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '0';
		$Date_now 			= date('Y-m-d H:i:s');

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$surat = null;
			$qOldSurat = $this->db->get_where('tr_tindak_pidana', ['Tindak_pidana_id' => $Tindak_pidana_id]);
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

				if ($this->db->update('tr_tindak_pidana', $in, ['Tindak_pidana_id' => $Tindak_pidana_id])) {
					$data_triger['Act'] 			= $Act;
					$data_triger['Tindak_pidana_id'] 	= $Tindak_pidana_id;
					$data_triger['Status_progress'] = $status_verify;
					$data_triger['User_created'] 	= $Updated_by;
					$data_triger['Created_at'] 		= $Date_now;

					if ($this->db->insert('tr_tindak_pidana_triger', $data_triger)) {
						$status = true;
						//$see = $this->func_table->in_tosee_kaku($surat->Created_by, $Kariskarsu_id, $status_verify, $this->session->userdata("username"));
						$send_notif_tp = $this->func_wa_tindak_pidana->notif_tp_update($Tindak_pidana_id);
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


	public function download_surat($Tindak_pidana_id)
	{
		if ($this->session->userdata('logged_in') != "") {
			if ($Tindak_pidana_id != '0') {
				$this->load->library('Pdf');
				$d['surat'] = null;
				$d['header_surat'] = '';
				$d['pegawai'] = null;
				$d['penandatangan'] = null;
				$dt['eselon3'] = null;
				$d['ket_ttd'] = '';
				$d['lokasi_kerja_ttd'] = '';
				$d['signature'] = '';

				$Data_tindak_pidana = $this->db->query("SELECT
											a.Id, 
											a.id_pegawai, 
											a.lokasi_kerja_pegawai, 
											a.is_dinas, 
											a.Tindak_pidana_id, 
											a.Status_progress, 
											a.Notes, 
											a.Nomor_surat, 
											a.Tanggal_verifikasi, 
											a.Created_by, 
											a.Created_at, 
											a.Updated_by, 
											a.Updated_at
										FROM
											tr_tindak_pidana AS a 
										WHERE a.Tindak_pidana_id='$Tindak_pidana_id'")->row();
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
											WHERE id_pegawai = '$Data_tindak_pidana->id_pegawai'")->row();

				$d['Data'] = $Data;
				$d['Data_tindak_pidana'] = $Data_tindak_pidana;
				$d['Tindak_pidana_id'] = $Tindak_pidana_id;
				$d['func_table'] = $this->load->library('func_table');
				$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($Data_tindak_pidana->Tanggal_verifikasi);

				//get data kadis
				$d['kadis'] = null;
				$q = $this->db->query("
					SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, a.signature, d.ttd_unit, unit_satuan_kerja,kop_surat, stamp
					from tbl_data_pegawai a
					left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
					left join tbl_master_golongan c on a.id_golongan = c.id_golongan
					left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
					where a.id_jabatan = 1
				");

				foreach ($q->result() as $p) {
					$d['kadis'] = $p;
					$d['penandatangan'] = $p;
					if ($p->signature != '') {
						$signature =  './asset/foto_pegawai/signature/' . $p->signature;
						// $stamp =  base_url(). 'asset/foto_pegawai/signature/combine/stamp/' . $p->stamp;
						//$Combine_image 	= $this->func_table->Combine_signature($signature, $p->signature, $stamp);
						if (file_exists($signature)) {
							$d['signature'] = base_url() . 'asset/foto_pegawai/signature/' . $p->signature;
						} else {
							$d['signature'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
						}
						//$d['signature'] = base_url(). 'asset/foto_pegawai/signature/' . $p->signature;
						$d['stamp'] =  base_url() . 'asset/foto_pegawai/signature/stamp/' . $p->stamp;
					}
				}
				$nama_jabatan_new = isset($d['kadis']->nama_jabatan) ? $d['kadis']->nama_jabatan : '';
				$ttd_unit_new = isset($d['kadis']->ttd_unit) ? $d['kadis']->ttd_unit : '';
				$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
				$d['ket_ttd'] = $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>';
				$Date_now = date('Y-m-d');



				$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [215.9, 332]]); //F4
				$html = $this->load->view('dashboard_admin/kertas_kerja/tindak_pidana/export_digital', $d, true);
				$mpdf->AddPage('P', '', '', '', '', 20, 20, 16, 25, 18, 12);
				$mpdf->simpleTables = true;
				$mpdf->packTableData = true;
				$mpdf->SetTitle($Data->nama_pegawai);



				$mpdf->WriteHTML($html);
				$mpdf->Output($Data->nama_pegawai . '.pdf', 'I');

				// === read notif ===
				$username = $this->session->userdata('username');
				$this->func_table->in_tosee_hukdis($p->Created_by, $Tindak_pidana_id, $p->Status_progress, $username);
			} else {
				echo 'Request tidak valid.1';
			}
		} else {
			echo 'Request tidak valid.2';
		}
	}
}

// End of file Data_tindak_pidana.php
// Location: ./application/controllers/admin/Data_tindak_pidana.php
