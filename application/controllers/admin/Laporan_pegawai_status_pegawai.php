<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_status_pegawai extends CI_Controller {
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
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Status Pegawai';
			$d['menu_open'] = 'laporan';
			$d['id_status_pegawai'] = $this->input->post('id_status_pegawai');

			$arrStatus = array();
			$arrStatusSelected = array();
			$status = $this->db->get('tbl_master_status_pegawai')->result_array();	
			if (count($status) > 0) {
				foreach ($status as $g) {
					$arrStatus[$g['id_status_pegawai']] = $g['nama_status'];

					$arrStatusSelected[$g['id_status_pegawai']] = '';
					if ($d['id_status_pegawai'] == $g['id_status_pegawai']) {
						$arrStatusSelected[$g['id_status_pegawai']] = 'selected=selected';
					}
				}
			}

			$d['arrStatus'] = $arrStatus;
			$d['arrStatusSelected'] = $arrStatusSelected;
			
			$this->load->view('dashboard_admin/laporan/status_pegawai/home',$d);
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
			$cond = 'where 1=1';
			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
			}

			$search = $this->input->post('id_status_pegawai');
			if($search != "0" && $search != "")
			{
				$cond .= " and a.status_pegawai = ".$search;
			}
			
			$q = "
				select a.nip, a.nrk, a. nama_pegawai, a.tempat_lahir, a.tanggal_lahir, a.jenis_kelamin, a.agama, a.usia, b.nama_status  
				from tbl_data_pegawai a 
				left join tbl_master_status_pegawai b on a.status_pegawai=b.id_status_pegawai 
				".$cond." 
				order by a.nama_pegawai asc";
			// echo $q;exit;
			$d['data_pegawai'] = $this->db->query($q);
			$this->load->view('dashboard_admin/laporan/status_pegawai/export',$d);
			
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}