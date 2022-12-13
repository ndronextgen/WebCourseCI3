<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_masa_pensiun extends CI_Controller {

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
			$d['page_name'] = 'Laporan Pegawai - Masa Pensiun';
			$d['menu_open'] = 'laporan';

			$masa_pensiun = $this->input->post('masa_pensiun');
			
			$arrSelection = array(
				1=>'1 Tahun',
				2=>'2 Tahun',
				3=>'3 Tahun'
			);

			$now_year = date('Y');
			$arrYear = array();
			$j = 4;
			for ($i=$now_year; $i<($now_year+3); $i++) {
				$arrSelection[$i] = $i;
				$j++;
			}

			$arrSelected = array();
			foreach ($arrSelection as $key=>$arrs) {
				$arrSelected[$key] = '';
				if ($masa_pensiun == $key) $arrSelected[$key] = 'selected=selected';
			}

			$d['masa_pensiun'] = $masa_pensiun;
			$d['arrSelection'] = $arrSelection;
			$d['arrSelected'] = $arrSelected;

			$this->load->view('dashboard_admin/laporan/masa_pensiun/home',$d);
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
			$d['masa_pensiun'] = $this->input->post('masa_pensiun');
			$cond = '';
			if ($d['masa_pensiun'] != '0' && $d['masa_pensiun'] != '') {
				if ($d['masa_pensiun'] > 3) {
					$cond = "and substring(a.tgl_pensiun,1,4) = '".$d['masa_pensiun']."'";
				}
				else {
					$cond = 'and a.masa_pensiun = '.$d['masa_pensiun'];
				}
			}

			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$cond .= ' and a.lokasi_kerja='.$this->session->userdata('lokasi_kerja');
			}
			
			$d['data'] = $this->db->query("
				select a.* from (
					select nip, nrk, nama_pegawai, lokasi_kerja, tanggal_lahir as str_tgl_lahir, 
							str_to_date(substring(nip,1,8), '%Y%m%d') as date_tgl_lahir,
							id_jabatan, timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) as usia, 
							if (id_jabatan = 2351, (58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now())), 
								(58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()))
							) as masa_pensiun,
							if (id_jabatan = 2351, 
								(timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))), 
								(timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))) 
							) as masa_pensiun_bln,
							if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
								(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
							) as tgl_pensiun,
							DATE_SUB(
								if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
									(date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
								)
								, INTERVAL 6 MONTH) as warning_6b
					from tbl_data_pegawai) a 
					where a.masa_pensiun > 0 $cond 
					order by a.tgl_pensiun asc
			");

			$this->load->helper('date_convert');
			$this->load->view('dashboard_admin/laporan/masa_pensiun/export',$d);
		}
		else
		{
			echo 'Request tidak valid.';
		}
	}

	public function detail_pegawai(){
		$nrk = $this->input->post('nrk');
		$Id = $this->input->post('Id');
		$count_see=$this->func_table->in_tosee_masa_pensiun_admin($nrk);
		echo base_url().'pegawai/detail/'.$Id;
	}
}

/* End of file laporan_pegawai_tugas_izin_belajar.php */
/* Location: ./application/controllers/laporan_pegawai_tugas_izin_belajar.php */