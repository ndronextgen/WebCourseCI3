<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_ikut_pelatihan extends CI_Controller {

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
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Mengikuti Pelatihan';
			$d['menu_open'] = 'laporan';
			$d['id_master_pelatihan'] = $this->input->post('id_master_pelatihan');

			$arrPelatihan = array();
			$arrPelatihanSelected = array();
			$pelatihan = $this->db->get('tbl_master_pelatihan')->result_array();	
			if (count($pelatihan) > 0) {
				foreach ($pelatihan as $g) {
					$arrPelatihan[$g['id_master_pelatihan']] = $g['nama_pelatihan'];

					$arrPelatihanSelected[$g['id_master_pelatihan']] = '';
					if ($d['id_master_pelatihan'] == $g['id_master_pelatihan']) {
						$arrPelatihanSelected[$g['id_master_pelatihan']] = 'selected=selected';
					}
				}
			}

			$d['arrPelatihan'] = $arrPelatihan;
			$d['arrPelatihanSelected'] = $arrPelatihanSelected;
			
			$this->load->view('dashboard_admin/laporan/ikut_pelatihan/home',$d);
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

			$search = $this->input->post('id_master_pelatihan');
			if($search != "0" && $search != "")
			{
				$cond .= " and c.id_master_pelatihan = ".$search;
			}
			
			$q = "select a.nip, a.nrk, a.nama_pegawai, b.uraian, b.tanggal_sertifikat, c.nama_pelatihan, b.nama_pelatihan_lainnya,
					c.id_master_pelatihan, d.nama_lokasi 
					from tbl_data_pegawai a 
					left join tbl_data_pelatihan b on a.id_pegawai=b.id_pegawai 
					left join tbl_master_pelatihan c on b.id_master_pelatihan=c.id_master_pelatihan 
					left join tbl_master_lokasi_pelatihan d on b.lokasi=d.id_lokasi_pelatihan 
					where a.id_pegawai=b.id_pegawai"
					.$cond." order by a.nama_pegawai asc";
			
			$d['data_pegawai'] = $this->db->query($q);
			$this->load->view('dashboard_admin/laporan/ikut_pelatihan/export',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}
