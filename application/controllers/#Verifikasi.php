<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->library('func_table');
		$this->load->helper(array('url','download'));
		$this->load->model('m_verifikasi','verifikasi');
		$this->load->library('upload');
		// $this->load->model('arsip_hukuman_model');
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="publik")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat_instansi'] = $this->config->item('alamat_instansi');
			
			$id['id_pegawai'] = $this->session->userdata('id_pegawai');
			$this->session->set_userdata($id);
			$kode['id_pegawai'] = $this->session->userdata('id_pegawai');
			
			$q = $this->db->get_where("tbl_data_pegawai",$id);
			$set_detail = $q->row();
			$this->session->set_userdata("nama_pegawai",$set_detail->nama_pegawai);
			$count_see=$this->func_table->count_see_sk($this->session->userdata('id_pegawai'));
			foreach($q->result() as $data)
			{
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
				$signature = base_url().'asset/foto_pegawai/no-image/nosignature.png';
				if ($data->signature) {
					$signature = base_url().'asset/foto_pegawai/signature/thumb/'.$data->signature;
				}
				$d['signature'] = $signature;					
				$d['tanggal_selesai_pangkat'] = $data->tanggal_selesai_pangkat;			
				$d['id_satuan_kerja'] = $data->id_satuan_kerja;										
				$d['tanggal_selesai_jabatan'] = $data->tanggal_selesai_jabatan;					
				$d['tmt_eselon'] = $data->tmt_eselon;
			}
			$this->load->helper('url');
			//see
			$d['count_see'] = $count_see;
			$x['count_see'] = $count_see;
			$this->load->view('dashboard_publik/verifikasi/index_verifikasi', $d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	function data_verifikasi() {
		$this->load->view('dashboard_publik/verifikasi/ajax_table');
	}

	function table_data_verifikasi() {

		$user_type = $this->session->userdata('stts');
		$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
		$id_pegawai = $this->session->userdata('id_pegawai');

		$status_verifikasi=$this->func_table->status_verifikasi_user($this->session->userdata('id_pegawai'));
		
		$listing 		= $this->verifikasi->listing($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);
		$jumlah_filter 	= $this->verifikasi->jumlah_filter($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);
		$jumlah_semua 	= $this->verifikasi->jumlah_semua($user_type, $id_lokasi_kerja, $id_pegawai, $status_verifikasi);
		

		$data = array();
		$no = $_POST['start'];
		foreach ($listing as $key) {
			$no++;
			$row = array();
			$button = '<a type="button" class="btn btn-info btn-xs" onclick="view_detail('."'".$key->id_srt."'".')"><i class="fa fa-eye"></i> Lihat Detail</a>';
			# jika user adalah kasubag kepegawaian
			# maka kyang ditampilkan adalah surat yang statusnya ('21','22','23','24','25','26','3')
			# dan tombolverifikasi muncul di status 21
			# jika user adalah sekdis tombol 22

			
			if($status_verifikasi=='kepegawaian' AND $key->id_status_srt =='21' ){
				$button_verifikasi ='<a type="button" class="btn btn-warning btn-xs" onclick="verifikasi_kep('."'".$key->id_srt."'".')"><i class="fa fa-tag"></i> Lakukan Verifikasi</a>';
			} else if($status_verifikasi=='sekdis' AND $key->id_status_srt =='22' ){
				$button_verifikasi ='<a type="button" class="btn btn-warning btn-xs" onclick="verifikasi_kep('."'".$key->id_srt."'".')"><i class="fa fa-tag"></i> Lakukan Verifikasi</a>';
			} else {
				$button_verifikasi ='';

			}


			$row[] = $no;
			$row[] = $button.' '.$button_verifikasi;
			$row[] = $key->nama_surat;
			$row[] = $key->nama;
			$row[] = $key->status;
			$row[] = $key->keterangan_pengajuan;
			$row[] = $key->tgl_proses;
			
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

	function form_verifikasi_kep() {
		$Id 	= $this->input->post('Id');//id surat
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
										a.nomor_surat, a.Created_at, a.Updated_at, a.Updated_by,
										b.nama_surat, nama_status as `status`, sort, sort_bidang,
										IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
										list.lokasi_kerja, list.dinas,nama_lokasi_kerja
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
														WHERE dinas = '1'
									) list ON a.id_user = list.id_pegawai
									
									WHERE a.id_srt ='$Id'")->row();
		if ($Data->id_status_srt=='21'){ //diverifikasi admin
			$terima = "22"; $tolak = "25";
		} else if ($Data->id_status_srt=='22'){ //diverifikasi kepegawaian
			$terima = "23"; $tolak = "26";
		} else {
			$terima = ""; $tolak = "";
		}
		$a['Id'] 		= $Id;
		$a['Data'] 		= $Data;
		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;
		$a['master_lapor'] = $this->db->query("SELECT * FROM tr_master_lapor ORDER BY Id ASC")->result();

		$this->load->view('dashboard_publik/verifikasi/form_verifikasi_kep', $a);
	}

	function simpan_verifikasi_kep() {
		$Id 			= $this->input->post('Id');//id surat
		$username 		= $this->session->userdata('username');
		$status_verify 	= $this->input->post('status_verify');
		$ket 			= $this->input->post('ket');
		$Date_now 		= date('Y-m-d h:i:s');
		$message		= null;

		if($status_verify=='24' || $status_verify=='25' || $status_verify=='26'){
			$alasan_ditolak = $ket;
		} else {
			$alasan_ditolak = '';
		}

		$data['id_status_srt'] 		= $status_verify;
		$data['keterangan_ditolak'] = $alasan_ditolak;
		$data['updated_at'] 		= $Date_now;
		$data['updated_by'] 		= $this->session->userdata("id_user");

		$this->db->where('id_srt', $Id);
		$Q_update = $this->db->update('tbl_data_srt_ket', $data);
		if($Q_update){
			$Q_select = $this->db->query("SELECT * FROM tbl_data_srt_ket WHERE id_srt='$Id'")->row();
			//insert history
			$hist_srt['id_srt'] = $Id;
			$hist_srt['id_user'] = $Q_select->id_user;
			$hist_srt['created_at'] = date("Y-m-d H:i:s");
			$hist_srt['created_by'] = $this->session->userdata("id_user");
			$hist_srt['id_status_srt'] = $status_verify;
			$hist_srt['keterangan_ditolak'] = $alasan_ditolak;
			if ($this->db->insert('tbl_history_srt_ket', $hist_srt)) {
				$status = true;
				$see = $this->func_table->in_tosee_sk($Q_select->id_user, $Id, $status_verify, $this->session->userdata("id_user"));
				$message = 'Berhasil menyimpan data.';
			} else {
				$message = 'Gagal menyimpan data.';
			}

			if($Q_select->select_ttd =='digital' AND $status_verify =='23'){
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




		} else {
			$message = 'Gagal menyimpan data.';
		}
		echo $message;

	}

	function form_detail() {
		$Id 	= $this->input->post('Id');//id surat
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
										a.nomor_surat, a.Created_at, a.Updated_at, a.Updated_by,
										b.nama_surat, nama_status as `status`, sort, sort_bidang,
										IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
										list.lokasi_kerja, list.dinas,nama_lokasi_kerja
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
														WHERE dinas = '1'
									) list ON a.id_user = list.id_pegawai
									
									WHERE a.id_srt ='$Id'")->row();
		if ($Data->id_status_srt=='21'){ //diverifikasi admin
			$terima = "22"; $tolak = "25";
		} else if ($Data->id_status_srt=='22'){ //diverifikasi kepegawaian
			$terima = "23"; $tolak = "26";
		} else {
			$terima = ""; $tolak = "";
		}
		$a['Id'] 		= $Id;
		$a['Data'] 		= $Data;
		$a['terima'] 	= $terima;
		$a['tolak']  	= $tolak;
		$a['master_lapor'] = $this->db->query("SELECT * FROM tr_master_lapor ORDER BY Id ASC")->result();

		$this->load->view('dashboard_publik/verifikasi/form_detail', $a);
	}


	
	
}

