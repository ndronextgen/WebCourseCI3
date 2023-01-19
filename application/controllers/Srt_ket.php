<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Srt_ket extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") { } else {
			header('location:' . base_url() . '');
		}

		$this->load->model('srt_ket_model', 'tbl_data_srt_ket');
		$this->load->library('func_table');
		date_default_timezone_set('Asia/Bangkok');
	}

	public function srt_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_srt_ket->get_datatables($id);

		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $r) {
			// === begin: badge-status ===
			switch ((int) $r->id_status) {
				case 0:
					$status_surat = '<span class="badge btn-light btn-flat badge-status" 
									onclick="showTimeline(' . $r->id_srt . ')" style="background-color: #' . $r->backcolor . '; color: #' . $r->fontcolor . ';">' . $r->nama_status_next . '</span>';
					break;
				case 21:
					if ($r->is_dinas == 1) {
						$status_surat = '<span class="badge btn-warning btn-flat badge-status" 
										onclick="showTimeline(' . $r->id_srt . ')" style="background-color: #' . $r->backcolor . '; color: #' . $r->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subkoordinator<br>Kepegawaian</span>';
					} else {
						$status_surat = '<span class="badge btn-warning btn-flat badge-status" 
										onclick="showTimeline(' . $r->id_srt . ')" style="background-color: #' . $r->backcolor . '; color: #' . $r->fontcolor . ';">Menunggu Verifikasi<br>Kepala Subbagian</span>';
					}
					break;
				case 22:
				case 27:
					$status_surat = '<span class="badge btn-flat badge-status" 
									onclick="showTimeline(' . $r->id_srt . ')" style="background-color: #' . $r->backcolor . '; color: #' . $r->fontcolor . ';">' . $r->nama_status_next . '</span>';
				case 23:
					$status_surat = '<span class="badge btn-info btn-flat badge-status" 
									onclick="showTimeline(' . $r->id_srt . ')" style="background-color: #' . $r->backcolor . '; color: #' . $r->fontcolor . ';">' . $r->nama_status_next . '</span>';
					break;
				case 3:
					$status_surat = '<span class="badge btn-success btn-flat badge-status" 
									onclick="showTimeline(' . $r->id_srt . ')" style="background-color: #' . $r->backcolor . '; color: #' . $r->fontcolor . ';">' . $r->nama_status_next . '</span>';
					break;
				case 24:
				case 25:
				case 28:
				case 26:
					$status_surat = '<span class="badge btn-danger btn-flat badge-status" 
									onclick="showTimeline(' . $r->id_srt . ')" style="background-color: #' . $r->backcolor . '; color: #' . $r->fontcolor . ';">' . $r->nama_status_next . '</span>';
					break;
				default:
					$status_surat = '<span class="badge btn-dark btn-flat badge-status" 
									onclick="showTimeline(' . $r->id_srt . ')">' . $r->nama_status_next . '</span>';
					break;
			}
			// === end: badge-status ===

			$see = $this->func_table->see_public($id, $r->id_srt);

			// === begin: buttons (aksi) ===
			$button = '';
			switch ($r->id_status_srt) {
				case 1:
				case 24:
				case 25:
				case 26:
					//ditolak
					$button = '	<a class="btn btn-sm btn-info" href="javascript:void(0);" title="Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; Detail</a>
					<!--		<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Detail" onclick="lihat_detail_ditolak(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-list-alt"></i>&nbsp; Detail</a>-->
					<!--		<a class="btn btn-sm btn-primary" href="' . base_url() . 'dashboard_publik/pengajuan_surat_detail/' . $r->id_srt . '" title="Detail"><i class="glyphicon glyphicon-list-alt"></i>&nbsp; Detail</a>-->';
					$button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</a>';
					break;

				case 2:
					// $button_download = '<a data-fancybox data-type="iframe" data-src="'.base_url().'admin/surat_keterangan/download_surat_digital/'.$key->id_srt.'" href="javascript:void(0);">
					// 		<button type="button" class="btn btn-danger btn-sm" title="PDF"><i class="fa fa-file-o"></i> Download</button>
					// 	</a>';
					// 	$button_download = '<a data-fancybox data-type="iframe" data-src="'.base_url().'admin/surat_keterangan/download_surat_finished_public/'.$key->id_srt.'" href="javascript:void(0);">
					// 		<button type="button" class="btn btn-danger btn-sm" title="PDF"><i class="fa fa-file-o"></i> Download</button>
					// 	</a>';
					//proses
					$button = '	<a class="btn btn-sm btn-info" href="javascript:void(0);" title="Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; Detail</a>
								<a class="btn btn-sm btn-primary" target="_blank" href="' . base_url() . 'admin/surat_keterangan/download_surat/' . $r->id_srt . '" title="Download">
									<i class="glyphicon glyphicon-download"></i>&nbsp; Download
								</a>';
					break;

				case 3:
					if ($r->select_ttd == 'basah') {
						//selesai
						$button = '	<a class="btn btn-sm btn-info" href="javascript:void(0);" title="Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; Detail</a>
									<a href="' . base_url() . 'admin/surat_keterangan/download_surat_finished_public/' . $r->id_srt . '" target="_blank">
										<button type="button" class="btn btn-danger btn-sm" title="PDF"><i class="glyphicon glyphicon-download"></i>&nbsp; Download</button>
									</a>';
						break;
					} else {
						//selesai
						$button = '<a class="btn btn-sm btn-info" href="javascript:void(0);" title="Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; Detail</a>
									<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/surat_keterangan/download_surat_digital/' . $r->id_srt . '" href="javascript:void(0);">
										<button type="button" class="btn btn-danger btn-sm" title="Download">
											<i class="glyphicon glyphicon-download"></i>&nbsp; Download
										</button>
									</a>';
						break;
					}

				case 0:
					//menunggu
					$button = '	<a class="btn btn-sm btn-info" href="javascript:void(0);" title="Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; Detail</a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0);" title="Edit" onclick="edit_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit</a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Hapus" onclick="delete_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</a>';
					break;
				case 21:
				case 22:
					//proses
					$button = '<a class="btn btn-sm btn-info" href="javascript:void(0);" title="Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; Detail</a>';
					break;
				case 23:
				case 27:
					//proses
					$button = '	<a class="btn btn-sm btn-info" href="javascript:void(0);" title="Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i>&nbsp; Detail</a>
								<a data-fancybox data-type="iframe" data-src="' . base_url() . 'admin/surat_keterangan/download_surat/' . $r->id_srt . '" href="javascript:void(0);">
									<button type="button" class="btn btn-warning btn-sm" title="Download">
										<i class="glyphicon glyphicon-download"></i>&nbsp; Download (-)
										</button>
								</a>';
					break;
			}
			// === end: buttons (aksi) ===

			// === begin: create row ===
			$row = array();
			$no++;

			$row[] = $no;
			$row[] = $button;
			if (strtolower($r->jenis_pengajuan_surat) == 'x') {
				$row[] = $r->jenis_pengajuan_surat_lainnya;
			} else {
				$row[] = $r->keterangan;
			}
			$row[] = $status_surat;
			$row[] = date_format(date_create($r->tgl_surat), 'j M Y' . ' (' . 'H:i:s' . ') ');
			$row[] = $see;

			$data[] = $row; // rowset
			// === end: create row ===
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tbl_data_srt_ket->count_all($id),
			"recordsFiltered" => $this->tbl_data_srt_ket->count_filtered($id),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function srt_edit($id_srt)
	{
		$data = $this->tbl_data_srt_ket->get_by_id($id_srt);
		echo json_encode($data);
	}

	public function srt_view()
	{
		$Id = $this->input->post('id_srt');
		$data = $this->db->query(
			"SELECT a.*, b.nama_surat as jenis_surat, c.nama_status as status, c.nama_status_next, e.nama_lengkap, 
				f.keterangan as pengajuan_surat_lain
			from tbl_data_srt_ket a 
			left join tbl_master_surat b on a.jenis_surat = b.id_mst_srt 
			left join tbl_status_surat c on a.id_status_srt = c.id_status 
			left join tbl_data_pegawai d on d.id_pegawai = a.id_user 
			left join tbl_user_login e on e.id_user_login = a.id_user_proses 
			left join tbl_master_jenis_pengajuan_surat f on a.jenis_pengajuan_surat = f.kode 
			where a.id_srt='$Id'"
		)->row();
		$a['Id'] 	= $Id;
		$a['data'] 	= $data;

		// === see notif ===
		$see = $this->func_table->in_tosee_sk($data->id_user, $data->id_srt, $data->id_status_srt, $data->id_user);

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
				order by his.created_at, his.id_status_srt";
		$rsSQL = $this->db->query($sSQL);

		$a['data_history'] = $rsSQL;
		// ===== /surat keterangan history =====

		// $this->load->view('dashboard_publik/home/view_status_surat', $a);

		$this->load->view('dashboard_publik/template/kertas_kerja/keterangan_pegawai/view_status_surat', $a);
	}

	public function srt_update()
	{
		$this->_validate_srt();
		if (strtolower($this->input->post('sel_jen_pengajuan_edit')) == 'x') {
			$data = array(
				// 'keterangan' => $this->input->post('keterangan'),
				'jenis_pengajuan_surat' => $this->input->post('sel_jen_pengajuan_edit'),
				'jenis_pengajuan_surat_lainnya' => $this->input->post('jen_pengajuan_lain_input_edit'),
				//'nama_lampiran' => $this->input->post('nama_lampiran'),
				'id_user' => $this->session->userdata('id_pegawai'),
			);
		} else {
			$data = array(
				// 'keterangan' => $this->input->post('keterangan'),
				'jenis_pengajuan_surat' => $this->input->post('sel_jen_pengajuan_edit'),
				'jenis_pengajuan_surat_lainnya' => null,
				//'nama_lampiran' => $this->input->post('nama_lampiran'),
				'id_user' => $this->session->userdata('id_pegawai'),
			);
		}
		$insert_id = $data['id_user'];
		$this->tbl_data_srt_ket->update(array('id_srt' => $this->input->post('id_srt')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function srt_delete()
	{
		$id_srt = $this->input->post('id_srt');

		$data = $this->tbl_data_srt_ket->get_by_id($id_srt);
		$id_user = $data->id_user;
		$this->tbl_data_srt_ket->delete_by_id($id_srt);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate_srt()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		// validasi keterangan
		// if ($this->input->post('keterangan') == '') {
		// 	$data['inputerror'][] = 'keterangan';
		// 	$data['error_string'][] = 'Keterangan wajib di isi';
		// 	$data['status'] = FALSE;
		// }
		// if ($data['status'] === FALSE) {
		// 	echo json_encode($data);
		// 	exit();
		// 

		// validasi keperluan lain
		if (strtolower($this->input->post('sel_jen_pengajuan_edit')) == 'x') {
			if ($this->input->post('jen_pengajuan_lain_input_edit') == '') {
				$data['inputerror'][] = 'jen_pengajuan_lain_input_edit';
				$data['error_string'][] = 'Jenis keperluan lain wajib diisi';
				$data['status'] = FALSE;
			}
		}

		// validate
		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	public function notify_me()
	{
		$count_see 			= $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
		$count_see_tj 		= $this->func_table->count_see_tj($this->session->userdata('username'));
		$count_see_kaku		= $this->func_table->count_see_kaku($this->session->userdata('username'));

		$total = $count_see + $count_see_tj + $count_see_kaku;

		if ($count_see > 0) {
			// $res_count_see = '<span class="badge btn-warning btn-flat">' . $count_see . '</span>';
			$res_count_see = $count_see;
		} else {
			$res_count_see = '';
		}

		if ($total > 0) {
			// $res_total = '<span class="badge btn-warning btn-flat">' . $total . '</span>';
			$res_total = $total;
		} else {
			$res_total = '';
		}

		$result = [
			'surat_keterangan' => $res_count_see,
			'ttl_kertas_kerja' => $res_total
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
					stat.id_status, stat.nama_status, stat.style, 
					surat.keterangan_ditolak, 
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
				order by his.created_at, his.id_status_srt";
		$rsSQL = $this->db->query($sSQL);
		$a['data_history'] = $rsSQL;

		// $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline', $a);
		$this->load->view('dashboard_publik/template/timeline/timeline', $a);
	}
}
