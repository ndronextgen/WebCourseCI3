<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_pltplh extends CI_Controller
{

	/*
		***	Controller : data_pltplh.php
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('template');
		$this->load->helper('file');
		$this->load->library('func_table');
		//$this->load->library('func_wa_pltplh');
		$this->load->helper(array('url', 'download'));
		$this->load->model('m_pltplh', 'pltplh');
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
			$d['page_name'] = 'Data PLT/PLH';
			$d['menu_open'] = 'data_pltplh';

			$this->load->view('dashboard_admin/kertas_kerja/pltplh/index_pltplh', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	function filter()
	{
		$this->load->view('dashboard_admin/kertas_kerja/pltplh/ajax_table');
	}

	function table_data_pltplh()
	{

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');
		$username = $this->session->userdata('username');

		$listing 		= $this->pltplh->listing($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_filter 	= $this->pltplh->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai);
		$jumlah_semua 	= $this->pltplh->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai);

		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {

			// === begin: buttons (aksi) ===
			$button_download = '<a type="button" class="kt-nav__link btn-light border btn-sm" style="border: 1px solid red" data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/data_pltplh/cetak/' . $key->id_surat_tugas_pltplh . '" href="javascript:void(0);">
										<i class="fa fa-file-pdf-o"></i> Pdf
								</a>';
			$button_detail = '<a type="button" class="kt-nav__link btn-info btn-sm" onclick="view_pltplh(' . "'" . $key->id_surat_tugas_pltplh . "'" . ')" style="color:#fff !important;">
								<i class="fa fa-eye" style="color:#fff !important;"></i>
							</a>';
			$button_edit = '<a type="button" class="kt-nav__link btn-warning btn-sm" onclick="edit_pltplh(' . "'" . $key->id_surat_tugas_pltplh . "'" . ')" style="color:#fff !important;">
							<i class="fa fa-edit" style="color:#fff !important;"></i>
						</a>';
			$button_delete = '<a type="button" class="kt-nav__link btn-danger btn-sm" onclick="delete_pltplh(' . "'" . $key->id_surat_tugas_pltplh . "'" . ')" style="color:#fff !important;">
							<i class="fa fa-trash" style="color:#fff !important;"></i>
						</a>';
			// if($key->type_surat=='PLT'){
			// 	$type = "<span class'badge badge-warning' style='background-color: #d7ff36; color: #000;padding:5px 15px;font-weight:normal;border-radius:20px;'>PLT</span>";
			// } else {
			// 	$type = "<span class'badge badge-info' style='background-color: #03fc90; color: #1f2d3;padding:5px;'>PLT</span>";
			// }
			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $button_edit . ' ' . $button_delete . ' ' . $button_download;
			$row[] = $key->type_surat;
			$row[] = ucwords(strtolower($key->nama_pegawai));
			$row[] = ucwords(strtolower($key->nama_pegawai_berhalangan));
			// $row[] = $key->lokasi_kerja_berhalangan;
			$row[] = $key->alasan_pltplh;
			$row[] = $key->durasi . ' Hari Kerja';
			$row[] = date_format(date_create($key->tgl_mulai), 'j M Y ');
			$row[] = date_format(date_create($key->tgl_selesai), 'j M Y ');
			$row[] = date_format(date_create($key->tanggal_pengajuan), 'j M Y ');
			$row[] = '1';

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

	// tambah pltplh
	function tambah_pltplh()
	{

		$id_pegawai='0';
		$a['data_pegawai'] = $this->db->query("SELECT * FROM tbl_data_pegawai WHERE id_eselon NOT IN ('0','31', '32') ORDER BY nama_pegawai ASC")->result();
		$a['lokasi_kerja'] 	= $this->db->query("SELECT * FROM tbl_master_lokasi_kerja where sublokasi = '0' order by id_lokasi_kerja ASC")->result();

		$a['func_table'] = $this->load->library('func_table');
		$Date_now 			= date('Y-m-d');
		$a['Date_now'] = $Date_now;
		$a['pegawai'] = null;
		$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $id_pegawai]);
		foreach ($q->result() as $p) {
			$a['pegawai'] = $p;
		}


		$this->load->view('dashboard_admin/kertas_kerja/pltplh/form_pltplh_tambah', $a);
	}

	public function get_lokasi()
	{
		$filter_pegawai = $this->input->post('param');
		if ($filter_pegawai != '0' || $filter_pegawai != '' || $filter_pegawai != NULL) {
			$kond = " AND id_pegawai = '$filter_pegawai'";
		} else {
			$kond = " AND id_pegawai = 'x'";
		}
		$ak = $this->db->query("SELECT p.nama_pegawai, lk.lokasi_kerja
								FROM tbl_data_pegawai AS p
									LEFT JOIN (
										SELECT lokasi_kerja, id_lokasi_kerja FROM tbl_master_lokasi_kerja
									) AS lk ON lk.id_lokasi_kerja = p.lokasi_kerja
								WHERE p.id_pegawai != '--' $kond")->row();

		echo $ak->lokasi_kerja;
	}

	public function get_selisih()
	{
		$tgl_mulai = $this->input->post('tgl_mulai');
		$tgl_selesai = $this->input->post('tgl_selesai');

		$selisih = $this->db->query("SELECT 
									COUNT(kd.Tanggal) as jml_hari
									FROM kalender_kerja as kd
									WHERE kd.StatusHari = 'HK' AND kd.Tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'")->row();

		$result = isset($selisih->jml_hari) ? $selisih->jml_hari : '0';
		echo $result;
	}
	// ----------

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

		//echo $ak->lokasi_kerja;
	}



	public function simpan_validasi()
	{
		$status = false;
		$message = '';

		$type_surat 	 			= $this->input->post('type_surat');
		$id_pegawai 	 			= $this->input->post('filter_pegawai');
		$id_pegawai_berhalangan 	= $this->input->post('filter_pegawai_berhalangan');
		$alasan_pltplh 	 			= $this->input->post('alasan_pltplh');
		$tgl_mulai 	 	 			= $this->input->post('tgl_mulai');
		$tgl_selesai 	 			= $this->input->post('tgl_selesai');

		if($id_pegawai!=''){
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
											WHERE id_pegawai = '$id_pegawai'")->row();
			if ($data_pegawai->nama_pegawai == '' || $data_pegawai->nip == '' || $data_pegawai->nrk == '' || $data_pegawai->uraian == '' || $data_pegawai->golongan == '' || $data_pegawai->nama_jabatan == '' || $data_pegawai->nama_lokasi_kerja == '') {
				$message = "Lengkapi data pegawai yang akan diajukan sebagai PLT/PLH terlebih dahulu!";
			} else {
				if($id_pegawai_berhalangan!=''){
					$data_pegawai_berhalangan = $this->db->query("SELECT a.id_pegawai,a.nama_pegawai, a.id_pegawai, a.nrk,a.tempat_lahir,
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
											WHERE id_pegawai = '$id_pegawai_berhalangan'")->row();
					if($data_pegawai_berhalangan->nama_pegawai == '' || $data_pegawai_berhalangan->nip == '' || $data_pegawai_berhalangan->nrk == '' || $data_pegawai_berhalangan->uraian == '' || $data_pegawai_berhalangan->golongan == '' || $data_pegawai_berhalangan->nama_jabatan == '' || $data_pegawai_berhalangan->nama_lokasi_kerja == ''){
						$message = "Lengkapi data pegawai yang berhalangan terlebih dahulu!";
					}  else {
						if($type_surat==''){
							$message = "Tipe Surat Harus diisi";
						} else if ($alasan_pltplh == '') {
							$message = "Alasan PLT/PLH Tidak Boleh kosong!";
						} else if ($tgl_mulai == '') {
							$message = "Tanggal Mulai Tidak Boleh kosong!";
						} else if ($tgl_selesai == '') {
							$message = "Tanggal Selesai Tidak Boleh kosong!";
						} else {
							$status = true;
							$message = "OK";
						}
					}
				} else {
					$message = "Pilih data pegawai yang Berhalangan Tugas terlebih dahulu!";
				}
			}
		} else {
			$message = "Pilih data pegawai yang akan diajukan sebagai PLT/PLH terlebih dahulu!";
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

		$type_surat 	 			= $this->input->post('type_surat');
		$id_pegawai 	 			= $this->input->post('filter_pegawai');
		$id_pegawai_berhalangan 	= $this->input->post('filter_pegawai_berhalangan');
		$alasan_pltplh 	 			= $this->input->post('alasan_pltplh');
		$tgl_mulai 	 	 			= $this->input->post('tgl_mulai');
		$tgl_selesai 	 			= $this->input->post('tgl_selesai');


		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '0';
		$Date_now 			= date('Y-m-d H:i:s');

		$Created_by 		= $this->session->userdata('username');
		$Updated_by 		= $this->session->userdata('username');
		$arrTembusan = $this->input->post('tembusan');
		$tembusan = '';
		$i = 0;
		foreach ($arrTembusan as $ket) {
			if ($i > 0 and $ket != '') $tembusan .= '#|#';
			$tembusan .= $ket;

			$i++;
		}
		$data_pegawai = $this->db->query("SELECT nama_lokasi_kerja
											FROM tbl_data_pegawai as a
											LEFT JOIN (
														SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
													) as b ON b.id_lokasi_kerja = a.lokasi_kerja
											WHERE a.id_pegawai = '$id_pegawai'")->row();
		$data_pegawai_berhalangan = $this->db->query("SELECT nama_lokasi_kerja
											FROM tbl_data_pegawai as a
											LEFT JOIN (
														SELECT id_lokasi_kerja, lokasi_kerja as nama_lokasi_kerja FROM tbl_master_lokasi_kerja
													) as b ON b.id_lokasi_kerja = a.lokasi_kerja
											WHERE a.id_pegawai = '$id_pegawai_berhalangan'")->row();
		$result_lokasi_pltplh = isset($data_pegawai->nama_lokasi_kerja) ? $data_pegawai->nama_lokasi_kerja : '';
		$result_lokasi_pltplh_berhalangan = isset($data_pegawai_berhalangan->nama_lokasi_kerja) ? $data_pegawai_berhalangan->nama_lokasi_kerja : '';
		$in = array(
			'id_pegawai' => $this->input->post('filter_pegawai'),
			'id_pegawai_berhalangan' => $this->input->post('filter_pegawai_berhalangan'),
			'lokasi_kerja_pltplh' => $result_lokasi_pltplh,
			'lokasi_kerja_berhalangan' => $result_lokasi_pltplh_berhalangan,
			'alasan_pltplh' => $this->input->post('alasan_pltplh'),
			'durasi' => $this->input->post('durasi'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'type_surat' => $this->input->post('type_surat'),
			'tembusan' => $tembusan,
			'id_user_created' => $this->session->userdata("username"),
			'tanggal_pengajuan' => $Date_now,
			'date_created' => $Date_now
		);

		$in_pltplh = $this->db->insert('tbl_data_surat_tugas_pltplh', $in);
		if ($in_pltplh) {
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

	function edit_pltplh()
	{
		$id_surat_tugas_pltplh = $this->input->post('id_surat_tugas_pltplh');
		$a['user_type'] = $this->session->userdata('stts');
		$a['id_lokasi_kerja'] = $this->session->userdata('lokasi_kerja');

		$Data 				= $this->db->query("SELECT * FROM tbl_data_surat_tugas_pltplh WHERE id_surat_tugas_pltplh = '$id_surat_tugas_pltplh'")->row();
		$a['Data'] 			= $Data;
		$a['data_pegawai'] 	= $this->db->query("SELECT * FROM tbl_data_pegawai order by nama_pegawai ASC")->result();
		$a['lokasi_kerja'] 	= $this->db->query("SELECT * FROM tbl_master_lokasi_kerja where sublokasi = '0' order by id_lokasi_kerja ASC")->result();
		$a['id_surat_tugas_pltplh'] = $id_surat_tugas_pltplh;

		$a['pegawai'] = null;
		$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $Data->id_pegawai]);
		foreach ($q->result() as $p) {
			$a['pegawai'] = $p;
		}

		$a['func_table'] = $this->load->library('func_table');

		$this->load->view('dashboard_admin/kertas_kerja/pltplh/form_pltplh_edit', $a);
	}

	public function simpan_edit()
	{
		$status = false;
		$message = '';

		$Updated_by 		= $this->session->userdata('username');
		$Act 				= '0';
		$Date_now 			= date('Y-m-d H:i:s');

		$id_surat_tugas_pltplh 		= $this->input->post('id_surat_tugas_pltplh');
		$type_surat 	 			= $this->input->post('type_surat');
		$id_pegawai 	 			= $this->input->post('filter_pegawai');
		$lokasi_kerja_pltplh 		= $this->input->post('lokasi_kerja_pltplh');
		$id_pegawai_berhalangan 	= $this->input->post('filter_pegawai_berhalangan');
		$lokasi_kerja_berhalangan 	= $this->input->post('lokasi_kerja_berhalangan');
		$alasan_pltplh 	 			= $this->input->post('alasan_pltplh');
		$tgl_mulai 	 	 			= $this->input->post('tgl_mulai');
		$tgl_selesai 	 			= $this->input->post('tgl_selesai');
		$durasi 	 				= $this->input->post('durasi');
		$Date_now 					= date('Y-m-d H:i:s');

		$arrTembusan = $this->input->post('tembusan');
		$tembusan = '';
		$i = 0;
		foreach ($arrTembusan as $ket) {
			if ($i > 0 and $ket != '') $tembusan .= '#|#';
			$tembusan .= $ket;

			$i++;
		}


		$data['id_pegawai'] 				= $id_pegawai;
		$data['id_pegawai_berhalangan'] 	= $id_pegawai_berhalangan;
		$data['lokasi_kerja_pltplh'] 		= $lokasi_kerja_pltplh;
		$data['lokasi_kerja_berhalangan'] 	= $lokasi_kerja_berhalangan;
		$data['alasan_pltplh'] 				= $alasan_pltplh;
		$data['durasi'] 					= $durasi;
		$data['tgl_mulai'] 					= $tgl_mulai;
		$data['tgl_selesai'] 				= $tgl_selesai;
		$data['type_surat'] 				= $type_surat;
		$data['tembusan'] 					= $tembusan;

		$this->db->where('id_surat_tugas_pltplh', $id_surat_tugas_pltplh);
		$in_pltplh = $this->db->update('tbl_data_surat_tugas_pltplh', $data);

		if ($in_pltplh) {

			$status = true;
			$message = 'Data Berhasil Diupdate';
		} else {
			$message = 'Gagal';
		}
		$result = [
			'status' => $status,
			'message' => $message
		];
		echo json_encode($result);
	}

	function delete_pltplh()
	{
		$id_surat_tugas_pltplh = $this->input->post('id_surat_tugas_pltplh');
		$del = $this->db->query("DELETE FROM tbl_data_surat_tugas_pltplh WHERE id_surat_tugas_pltplh = '$id_surat_tugas_pltplh'");
		if ($del) {
			echo 'Berhasil Hapus';
		} else {
			echo 'Gagal Hapus';
		}
	}

	public function cetak($id_surat = 0, $id_pegawai = 0)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != 0) {
			$this->load->library('Pdf');

			$d['surat'] = null;
			$d['header_surat'] = '';
			$d['pegawai'] = null;
			$d['penandatangan'] = null;
			$dt['eselon3'] = null;
			$d['ket_ttd'] = '';
			$d['lokasi_kerja_ttd'] = '';
			$d['ket'] = '';
			$d['tembusan'] = '';

			//get data surat
			$q = $this->db->get_where('tbl_data_surat_tugas_pltplh', ['id_surat_tugas_pltplh' => $id_surat]);

			foreach ($q->result() as $p) {
				$d['surat'] = $p;
				if ($p->tgl_mulai == '' || $p->tgl_mulai == NULL) {
					$d['tgl_mulai'] = '';
				} else {
					$d['tgl_mulai'] = $this->func_table->tgl_indonesia($p->tgl_mulai);
				}
				if ($p->tgl_selesai == '' || $p->tgl_selesai == NULL) {
					$d['tgl_selesai'] = '';
				} else {
					$d['tgl_selesai'] = $this->func_table->tgl_indonesia($p->tgl_selesai);
				}

				$d['jml_terbilang'] = $this->func_table->terbilang($p->durasi);

				if ($p->type_surat == 'PLT') {
					$d['type_surat'] = 'Pelaksana Tugas';
				} else if ($p->type_surat == 'PLH') {
					$d['type_surat'] = 'Pelaksana Harian';
				} else {
					$d['type_surat'] = 'Pelaksana';
				}

				// echo '<pre>'.print_r($d['surat'],true).'</pre>';exit;

				// $arrKet = ['Sampai dengan saat ini yang bersangkutan belum pernah dikenakan hukuman disiplin, baik tingkat ringan, sedang, dan berat, 
				// berdasarkan Peraturan Pemerintah Nomor 53 Tahun 2010 dan Peraturan Pemerintah Nomor 10 Tahun 1983 jo. Peraturan Pemerintah 
				// Nomor 45 Tahun 1990'];

				if ($p->tembusan != '') {
					if (strpos($p->tembusan, '#|#') !== false) {
						$arr = explode('#|#', $p->tembusan);
					} else {
						$arr = [$p->tembusan];
					}

					if (count($arr) > 0) {
						foreach ($arr as $key => $k) {
							$arrKet[] = $k;
						}
					}

					// echo '<pre>'.print_r($arrKet,true).'</pre>';exit;

					$i = 1;
					if (count($arrKet) > 1) { #kalo lebih dari satu

						foreach ($arrKet as $key => $k) {
							if ($i >= 1 && $i < count($arrKet)) $k .= '.';
							else if ($i == count($arrKet)) $k .= '.';

							$ket .= '<p class="listtembusan">&nbsp;&nbsp;' . $i . '. ' . $k . '</p>';

							$i++;
						}
						$d['tembusan'] = 'Tembusan: ';
						$d['ket'] = $ket;
					} elseif (count($arrKet) == 1) {
						foreach ($arrKet as $key => $k) {
							if ($i >= 1 && $i < count($arrKet)) $k .= '.';
							else if ($i == count($arrKet)) $k .= '.';

							$ket .= '<p class="listtembusan">&nbsp;&nbsp;' . $k . '</p>';

							$i++;
						}
						$d['tembusan'] = 'Tembusan: ';
						$d['ket'] = $ket;
					} else {
						$ket .= '';
						$d['tembusan'] = '';
						$d['ket'] = $ket;
					}
				}

				//get data pegawai
				$d['pegawai'] = $this->db->query(
					"
					select a.nip, a.nrk, a.nama_pegawai, a.id_status_jabatan, a.id_jabatan, a.lokasi_kerja as id_lokasi_kerja, 
						b.id_nama_jabatan, b.nama_jabatan, b.level_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, 
						d.dinas, e.sub_lokasi_kerja , d.dinas 
					from tbl_data_pegawai a
					left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
					left join tbl_master_golongan c on a.id_golongan = c.id_golongan
					left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja 
					left join tbl_master_sub_lokasi_kerja e on a.seksi = e.id_sub_lokasi_kerja 
					where a.id_pegawai = " . $p->id_pegawai
				)->row();

				$d['pegawai_berhalangan'] = $this->db->query(
					"
					select a.nip, a.nrk, a.nama_pegawai, a.id_status_jabatan, a.id_jabatan, a.lokasi_kerja as id_lokasi_kerja, 
						b.id_nama_jabatan, b.nama_jabatan, b.level_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, 
						d.dinas, e.sub_lokasi_kerja , d.dinas 
					from tbl_data_pegawai a
					left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
					left join tbl_master_golongan c on a.id_golongan = c.id_golongan
					left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja 
					left join tbl_master_sub_lokasi_kerja e on a.seksi = e.id_sub_lokasi_kerja 
					where a.id_pegawai = " . $p->id_pegawai_berhalangan
				)->row();

				$d['ket_ttd'] = 'Kepala Dinas <br />Cipta Karya, Tata Ruang dan Pertanahan' . '<br />' . 'Provinsi DKI Jakarta,';
				// echo '<pre>'.print_r($d,true).'</pre>';exit;
				if ($p->type_surat == 'PLT') {
					$this->load->view('dashboard_admin/kertas_kerja/pltplh/export_plt', $d);
				} else if ($p->type_surat == 'PLH') {
					$this->load->view('dashboard_admin/kertas_kerja/pltplh/export', $d);
				} else {
					$this->load->view('dashboard_admin/kertas_kerja/pltplh/export', $d);
				}
			}
		} else {
			header('location:' . base_url());
		}
	}

	public function download_surat($id_surat_tugas_pltplh)
	{
		if ($this->session->userdata('logged_in') != "") {
			if ($id_surat_tugas_pltplh != '0') {
				$this->load->library('Pdf');
				$d['surat'] = null;
				$d['header_surat'] = '';
				$d['pegawai'] = null;
				$d['penandatangan'] = null;
				$dt['eselon3'] = null;
				$d['ket_ttd'] = '';
				$d['lokasi_kerja_ttd'] = '';
				$d['signature'] = base_url() . 'asset/foto_pegawai/signature/empty.png';
				$d['stamp'] = '';

				$Data_pindah_tugas = $this->db->query("SELECT
											a.Id, 
											a.id_pegawai, 
											a.lokasi_kerja_pegawai, 
											a.is_dinas, 
											a.id_surat_tugas_pltplh, 
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
										WHERE a.id_surat_tugas_pltplh='$id_surat_tugas_pltplh'")->row();
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
											WHERE id_pegawai = '$Data_pindah_tugas->id_pegawai'")->row();

				$d['Data'] = $Data;
				$d['Data_pindah_tugas'] = $Data_pindah_tugas;
				$d['id_surat_tugas_pltplh'] = $id_surat_tugas_pltplh;
				$d['func_table'] = $this->load->library('func_table');
				$d['Tanggal_indo'] 	= $this->func_table->tgl_indonesia($Data_pindah_tugas->Tanggal_verifikasi);

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
					}
					$d['stamp'] =  base_url() . 'asset/foto_pegawai/signature/stamp/' . $p->stamp;
				}
				$nama_jabatan_new = isset($d['kadis']->nama_jabatan) ? $d['kadis']->nama_jabatan : '';
				$ttd_unit_new = isset($d['kadis']->ttd_unit) ? $d['kadis']->ttd_unit : '';
				$penandatangan_new = isset($d['penandatangan']->nama_jabatan) ? $d['penandatangan']->nama_jabatan : '';
				$d['ket_ttd'] = $nama_jabatan_new . '<br>' . $ttd_unit_new . '<br>';
				$Date_now = date('Y-m-d');

				$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [215.9, 332]]); //F4
				$html = $this->load->view('dashboard_admin/kertas_kerja/pindah_tugas/export_digital', $d, true);
				$mpdf->AddPage('P', '', '', '', '', 20, 20, 16, 25, 18, 12);
				$mpdf->simpleTables = true;
				$mpdf->packTableData = true;
				$mpdf->SetTitle($Data->nama_pegawai);



				$mpdf->WriteHTML($html);
				$mpdf->Output($Data->nama_pegawai . '.pdf', 'I');

				// === read notif ===
				$username = $this->session->userdata('username');
				$this->func_table->in_tosee_pindah_tugas($p->Created_by, $id_surat_tugas_pltplh, $p->Status_progress, $username);
			} else {
				echo 'Request tidak valid.1';
			}
		} else {
			echo 'Request tidak valid.2';
		}
	}

	function show_timeline()
	{
		// ===== surat hukuman disiplin history =====
		$id_surat_tugas_pltplh = $this->input->post('id_surat_tugas_pltplh');

		$sSQL = "SELECT
					his.id_surat_tugas_pltplh,
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
					join tr_pindah_tugas surat on surat.id_surat_tugas_pltplh = his.id_surat_tugas_pltplh
					join tbl_status_surat stat on stat.id_status = his.status_progress
					left join tbl_data_pegawai peg on peg.nrk = his.user_created
					left join tbl_user_login log on log.username = his.user_created
					left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
				where
					his.id_surat_tugas_pltplh = '$id_surat_tugas_pltplh' 
				order by
					his.created_at, his.status_progress";
		$rsSQL = $this->db->query($sSQL);
		$a['data_history'] = $rsSQL;

		// $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline', $a);
		$this->load->view('dashboard_publik/template/timeline/timeline', $a);
	}
}

// End of file data_pindah_tugas.php
// Location: ./application/controllers/admin/data_pindah_tugas.php
