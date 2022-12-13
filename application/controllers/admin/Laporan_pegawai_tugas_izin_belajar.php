<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_tugas_izin_belajar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('template');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Jenis Kelamin';
			$d['menu_open'] = 'laporan';
			$d['status_belajar'] = $this->input->post('status_belajar');

			$arrStatusBelajar = array();
			$arrStatusBelajarSelected = array();
			$statusBelajar = [
				'Tugas Belajar' => 'Tugas Belajar',
				'Izin Belajar' => 'Izin Belajar'
			];
			
			foreach ($statusBelajar as $key=>$g) {
				$arrStatusBelajar[$key] = $g;

				$arrStatusBelajarSelected[$key] = '';
				if ($d['status_belajar'] == $key) {
					$arrStatusBelajarSelected[$key] = 'selected=selected';
				}
			}
			
			$d['arrStatusBelajar'] = $arrStatusBelajar;
			$d['arrStatusBelajarSelected'] = $arrStatusBelajarSelected;
				
			$this->load->view('dashboard_admin/laporan/tugas_izin_belajar/home',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function export()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$cond = '';
			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
			}

			$search = $this->input->post('status_belajar');
			if($search != "0" && $search != "")
			{
				$cond .= " and b.uraian = '".$search."'";
			}

			$q = "
				select * from (
					select a.nip, a.nrk, a.nama_pegawai, b.id_tubel, b.uraian, b.no_sk, b.tgl_sk, b.tgl_selesai, b.sekolah, b.akreditasi 
					from tbl_data_pegawai a 
					left join tbl_data_tubel b on a.id_pegawai=b.id_pegawai 
					".$cond." 
					order by a.nama_pegawai asc
				) tbl where tbl.id_tubel is not null";

			$d['data_pegawai'] = $this->db->query($q);
			$this->load->view('dashboard_admin/laporan/tugas_izin_belajar/export',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}