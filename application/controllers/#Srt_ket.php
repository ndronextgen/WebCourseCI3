<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Srt_ket extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('srt_ket_model', 'tbl_data_srt_ket');
		$this->load->library('func_table');
	}
	public function srt_datatables()
	{
		// Datatables Variables
		$id = $this->session->userdata('id_pegawai');
		$list = $this->tbl_data_srt_ket->get_datatables($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r) {
			if ($r->nama_status == "Selesai") {
				$status_surat = '<span class="badge btn-success btn-flat">Selesai</span>';
			} else if ($r->nama_status == "Menunggu") {
				$status_surat = '<span class="badge btn-warning btn-flat">Menunggu</span>';
			} else if ($r->nama_status == "Sedang Diproses") {
				$status_surat = '<span class="badge btn-primary btn-flat">Sedang Diproses</span>';
			} else if ($r->nama_status == "Ditolak") {
				$status_surat = '<span class="badge btn-danger btn-flat">Ditolak</span>';
			} else {
				$status_surat = '<span class="badge btn-dark btn-flat">Unknown Status</span>';
			}
			$see = $this->func_table->see_public($id, $r->id_srt);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->nama_surat;
			$row[] = $r->tgl_surat;
			// begin: change by joe 2022.10.14
			// $row[] = $r->keterangan;
			if (strtolower($r->jenis_pengajuan_surat) == 'x') {
				$row[] = $r->jenis_pengajuan_surat_lainnya;
			} else {
				$row[] = $r->keterangan;
			}
			// $row[] = $r->jenis_pengajuan_surat;
			// end: change by joe 2022.10.14
			$row[] = $status_surat;
			$button = '';
			switch ($r->id_status_srt) {
				case 1:
					//ditolak
					$button = '
					<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Lihat Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
					<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat Detail Ditolak" onclick="lihat_detail_ditolak(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-list-alt"></i></a>
					<!--<a class="btn btn-sm btn-primary" href="' . base_url() . 'dashboard_publik/pengajuan_surat_detail/' . $r->id_srt . '" title="Lihat"><i class="glyphicon glyphicon-list-alt"></i> Lihat</a>-->';
					$button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
					break;

				case 2:
					//proses
					$button = '
					<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Lihat Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
					<a class="btn btn-sm btn-default" target="_blank" href="' . base_url() . 'admin/surat_keterangan/download_surat/' . $r->id_srt . '" title="Download"><i class="fa fa-download"></i></a>';
					break;

				case 3:
					if ($r->select_ttd == 'basah') {
						//selesai
						$button = '
						<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Lihat Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						<a class="btn btn-sm btn-default" target="_blank" href="' . base_url() . 'admin/surat_keterangan/download_surat_finished/' . $r->id_srt . '" title="Download"><i class="fa fa-download"></i></a>';
						break;
					} else {
						//selesai
						$button = '
						<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Lihat Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
						<a class="btn btn-sm btn-default" target="_blank" href="' . base_url() . 'admin/surat_keterangan/download_surat_digital/' . $r->id_srt . '" title="Download"><i class="fa fa-download"></i></a>';
						break;
					}

				case 0:
					//menunggu
					$button = '
					<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Lihat Detail" onclick="view_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
					<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_srt(' . "'" . $r->id_srt . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
					break;
			}

			$row[] = $button;
			$row[] = $see;
			$data[] = $row;
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
			"SELECT a.*, b.nama_surat as jenis_surat, c.nama_status as status, e.nama_lengkap, f.keterangan as pengajuan_surat_lain
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
		$see = $this->func_table->in_tosee_sk($data->id_user, $data->id_srt, $data->id_status_srt, $data->id_user);
		$this->load->view('dashboard_publik/home/view_status_surat', $a);
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
	public function srt_delete($id_srt)
	{
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
		$count_see = $this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
		if ($count_see > 0) {
			echo '<span class="badge btn-warning btn-flat">' . $count_see . '</span>';
		} else {
			echo '';
		}
	}
}
