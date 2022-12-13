<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_status_golongan extends CI_Controller {

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
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Golongan';
			$d['menu_open'] = 'laporan';
			$d['id_golongan'] = $this->input->post('id_golongan');

			$arrGolongan = array();
			$arrGolonganSelected = array();
			$golongan = $this->db->get('tbl_master_golongan')->result_array();	
			if (count($golongan) > 0) {
				foreach ($golongan as $g) {
					$arrGolongan[$g['id_golongan']] = $g['golongan'];

					$arrGolonganSelected[$g['id_golongan']] = '';
					if ($d['id_golongan'] == $g['id_golongan']) {
						$arrGolonganSelected[$g['id_golongan']] = 'selected=selected';
					}
				}
			}

			$d['arrGolongan'] = $arrGolongan;
			$d['arrGolonganSelected'] = $arrGolonganSelected;
			
			$this->load->view('dashboard_admin/laporan/status_golongan/home',$d);
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

			$search = $this->input->post('id_golongan');
			if($search != "0" && $search != "")
			{
				$cond .= " and a.id_golongan = ".$search;
			}
			
			$q = "
				select a.nip, a.nrk, a. nama_pegawai, a.tempat_lahir, a.tanggal_lahir, a.jenis_kelamin, a.agama, a.usia, b.golongan 
				from tbl_data_pegawai a 
				left join tbl_master_golongan b on a.id_golongan=b.id_golongan 
				".$cond." 
				order by a.nama_pegawai asc";
			// echo $q;exit;
			$d['data_pegawai'] = $this->db->query($q);
			$this->load->view('dashboard_admin/laporan/status_golongan/export',$d);
			
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file laporan_pegawai_status_golongan.php */
/* Location: ./application/controllers/laporan_pegawai_status_golongan.php */