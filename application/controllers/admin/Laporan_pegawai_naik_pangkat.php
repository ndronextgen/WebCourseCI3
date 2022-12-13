<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_naik_pangkat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper('template');
		$this->load->helper('date_convert');
		$this->load->library('func_table');
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
			$d['page_name'] = 'Laporan Pegawai - yang Akan Naik Pangkat';
			$d['menu_open'] = 'laporan';
			$d['masa_pangkat'] = $this->input->post('masa_pangkat');
			$d['lokasi'] = $this->input->post('lokasi');

			$nextYear = (strtotime("+ 1 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
			$next2Year = (strtotime("+ 2 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
			$next3Year = (strtotime("+ 3 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
			$arrSelection = array(
				$nextYear => '1 Tahun',
				$next2Year => '2 Tahun',
				$next3Year => '3 Tahun'
			);
			
			$now_year = date('Y');
			$arrYear = array();
			for ($i=$now_year; $i<($now_year+3); $i++) {
				$arrSelection[$i] = $i;
				$arrYear[$i] = $i;
			}

			$arrSelected = array();
			foreach ($arrSelection as $key=>$arrs) {
				$arrSelected[$key] = '';
				if ($d['masa_pangkat'] == $key) $arrSelected[$key] = 'selected=selected';
			}

			$arrLokasi = array();
			$arrLokasiSelected = array();
			$lokasi = $this->db->get('tbl_master_lokasi_kerja')->result_array();
			if (count($lokasi) > 0) {
				foreach ($lokasi as $l) {
					$arrLokasi[$l['id_lokasi_kerja']] = $l['lokasi_kerja'];

					$arrLokasiSelected[$l['id_lokasi_kerja']] = '';
					if ($d['lokasi'] == $l['id_lokasi_kerja']) {
						$arrLokasiSelected[$l['id_lokasi_kerja']] = 'selected=selected';
					}
				}
			}

			$d['arrSelection'] = $arrSelection;
			$d['arrSelected'] = $arrSelected;
			$d['arrLokasi'] = $arrLokasi;
			$d['arrLokasiSelected'] = $arrLokasiSelected;

			$this->load->view('dashboard_admin/laporan/naik_pangkat/home',$d);
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
			$d['masa_pangkat'] = $this->input->post('masa_pangkat');
			$d['lokasi'] = $this->input->post('lokasi');

			$nextYear = (strtotime("+ 1 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
			$next2Year = (strtotime("+ 2 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
			$next3Year = (strtotime("+ 3 year") - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
			$arrSelection = array(
				$nextYear => '1 Tahun',
				$next2Year => '2 Tahun',
				$next3Year => '3 Tahun'
			);
			
			$now_year = date('Y');
			$arrYear = array();
			for ($i=$now_year; $i<($now_year+3); $i++) {
				$arrSelection[$i] = $i;
				$arrYear[$i] = $i;
			}

			$arrSelected = array();
			foreach ($arrSelection as $key=>$arrs) {
				$arrSelected[$key] = '';
				if ($d['masa_pangkat'] == $key) $arrSelected[$key] = 'selected=selected';
			}

			$arrLokasi = array();
			$arrLokasiSelected = array();
			$lokasi = $this->db->get('tbl_master_lokasi_kerja')->result_array();
			if (count($lokasi) > 0) {
				foreach ($lokasi as $l) {
					$arrLokasi[$l['id_lokasi_kerja']] = $l['lokasi_kerja'];

					$arrLokasiSelected[$l['id_lokasi_kerja']] = '';
					if ($d['lokasi'] == $l['id_lokasi_kerja']) {
						$arrLokasiSelected[$l['id_lokasi_kerja']] = 'selected=selected';
					}
				}
			}

			$cond = '';
			if ($d['masa_pangkat'] != '' && $d['masa_pangkat'] != '0') {
				if (array_key_exists($d['masa_pangkat'], $arrYear)) {
					$cond = "and substr(date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year),1,4) = '".$d['masa_pangkat']."'";
				}
				else {
					$cond = "and (timestampdiff(day,now(),date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) > 0 AND timestampdiff(day,now(),date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) <= '".$d['masa_pangkat']."')";
				}
			}

			$condLokasi = '';
			if ($d['lokasi'] != '' && $d['lokasi'] != '0') {
				$condLokasi .= " where b.lokasi_kerja = ".$d['lokasi'];
			}

			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$condLokasi .= ' and b.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
			}

			$d['arrSelection'] = $arrSelection;
			$d['arrSelected'] = $arrSelected;
			$d['arrLokasi'] = $arrLokasi;
			$d['arrLokasiSelected'] = $arrLokasiSelected;

			$q = "select c.*, 
					d.tanggal_sk, d.tanggal_mulai as tmt_pangkat_terakhir, 
					date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year) as tgl_naik_pangkat,
					substr(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),1,4) as tahun_naik_pangkat,
					timestampdiff(day,now(),date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) as masa_hari_naik_pangkat,
					e.golongan, e.uraian
				from 
				(
					select b.id_pegawai, b.nama_pegawai, b.nip, b.nrk,
							(
								select a.id_riwayat_pangkat
								from tbl_data_riwayat_pangkat a
								where a.id_pegawai = b.id_pegawai ".$cond." 
								order by date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year) desc 
								limit 1
							) as id_pangkat
					from tbl_data_pegawai b ".$condLokasi." 
				) c 
				left join tbl_data_riwayat_pangkat d on d.id_riwayat_pangkat = c.id_pangkat 
				left join tbl_master_golongan e on e.id_golongan = d.id_golongan
				where c.id_pangkat is not null 
				order by date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year) asc
			";
			
			$d['data'] = $this->db->query($q)->result_array();

			$this->load->helper('date_convert');
			$this->load->view('dashboard_admin/laporan/naik_pangkat/export',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function detail_pegawai(){
		$nrk = $this->input->post('nrk');
		$Id = $this->input->post('Id');
		$count_see=$this->func_table->in_tosee_naik_pangkat_admin($nrk);
		echo base_url().'pegawai/detail/'.$Id;
	}
}
