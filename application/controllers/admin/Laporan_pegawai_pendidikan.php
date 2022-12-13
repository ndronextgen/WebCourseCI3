<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_pendidikan extends CI_Controller {

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
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Pendidikan';
			$d['menu_open'] = 'laporan';
			$d['pendidikan_bkd'] = $this->input->post('pendidikan_bkd');

			$arrPendidikanBkd = array();
			$arrPendidikanBkdSelected = array();
			$status = $this->db->get('tbl_master_pendidikan')->result_array();	
			if (count($status) > 0) {
				foreach ($status as $g) {
					$arrPendidikanBkd[$g['nama_pendidikan']] = $g['nama_pendidikan'];

					$arrPendidikanBkdSelected[$g['nama_pendidikan']] = '';
					if ($d['pendidikan_bkd'] == $g['nama_pendidikan']) {
						$arrPendidikanBkdSelected[$g['nama_pendidikan']] = 'selected=selected';
					}
				}
			}

			$d['arrPendidikanBkd'] = $arrPendidikanBkd;
			$d['arrPendidikanBkdSelected'] = $arrPendidikanBkdSelected;
			
			$this->load->view('dashboard_admin/laporan/pendidikan/home',$d);
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
				$cond .= ' and lokasi_kerja='.$this->session->userdata('lokasi_kerja');
			}

			$search = $this->input->post('pendidikan_bkd');
			if($search != "0" && $search != "")
			{
				$cond .= " and pendidikan_bkd = '".$search."'";
			}
			
			$q = "
				select nip, nrk, nama_pegawai, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, pendidikan_bkd, asal_sekolah 
				from tbl_data_pegawai 
				".$cond." 
				order by nama_pegawai asc";
				
			$d['data_pegawai'] = $this->db->query($q);
			$this->load->view('dashboard_admin/laporan/pendidikan/export',$d);
			
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}