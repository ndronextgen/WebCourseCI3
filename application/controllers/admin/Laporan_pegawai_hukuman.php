<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_hukuman extends CI_Controller {

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
			$d['page_name'] = 'Laporan Pegawai - Berdasarkan Hukuman';
			$d['menu_open'] = 'laporan';
			$d['id_master_hukuman'] = $this->input->post('id_master_hukuman');

			$arrHukuman = array();
			$arrHukumanSelected = array();
			$hukuman = $this->db->get('tbl_master_hukuman')->result_array();	
			if (count($hukuman) > 0) {
				foreach ($hukuman as $g) {
					$arrHukuman[$g['id_hukuman']] = $g['nama_hukuman'];

					$arrHukumanSelected[$g['id_hukuman']] = '';
					if ($d['id_master_hukuman'] == $g['id_hukuman']) {
						$arrHukumanSelected[$g['id_hukuman']] = 'selected=selected';
					}
				}
			}

			$d['arrHukuman'] = $arrHukuman;
			$d['arrHukumanSelected'] = $arrHukumanSelected;
			
			$this->load->view('dashboard_admin/laporan/hukuman/home',$d);
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

			$search = $this->input->post('id_master_hukuman');
			if($search != "0" && $search != "")
			{
				$cond .= " and j.id_master_hukuman = ".$search;
			}
			
			$q = "
				select * from 
				(
					select a.nip, a.nrk, a.nama_pegawai, a.tempat_lahir, a.tanggal_lahir, a.jenis_kelamin, a.agama, 
						a.usia, b.nama_status as status_pegawai, a.tanggal_pengangkatan_cpns, 
						a.alamat, a.pendidikan_bkd, c.nama_status as status_pegawai_pangkat, d.golongan, a.nomor_sk_pangkat, 
						a.tanggal_sk_pangkat, a.tanggal_mulai_pangkat,a.tanggal_selesai_pangkat, 
						e.nama_status_jabatan as nama_status_jabatan, f.nama_jabatan as nama_jabatan, a.lokasi_kerja, 
						a.nomor_sk_jabatan, a.tanggal_sk_jabatan, a.tanggal_mulai_jabatan, 
						a.tanggal_selesai_jabatan, i.nama_eselon, a.tmt_eselon, i.nama_pelatihan, i.uraian, i.nama_lokasi, 
						i.tanggal_sertifikat, i.jam_pelatihan,i.negara, k.nama_hukuman as hukuman 
					from tbl_data_pegawai a 
					left join tbl_master_status_pegawai b on a.status_pegawai=b.id_status_pegawai 
					left join tbl_master_status_pegawai c on a.status_pegawai_pangkat=c.id_status_pegawai 
					left join tbl_master_golongan d on a.id_golongan=d.id_golongan 
					left join tbl_master_status_jabatan e on a.id_status_jabatan=e.id_status_jabatan 
					left join tbl_master_jabatan f on a.id_jabatan=f.id_jabatan 
					left join tbl_master_eselon i on a.id_eselon=i.id_eselon 
					left join tbl_data_hukuman j on a.id_pegawai=j.id_pegawai 
					left join tbl_master_hukuman k on j.id_master_hukuman=k.id_hukuman 
					left join 
						(
							select x.id_pegawai, y.nama_pelatihan, x.uraian, z.nama_lokasi, x.tanggal_sertifikat, x.jam_pelatihan, 
								x.negara 
							from tbl_data_pelatihan x 
							left join tbl_master_pelatihan y on x.id_master_pelatihan=y.id_master_pelatihan 
							left join tbl_master_lokasi_pelatihan z on x.lokasi=z.id_lokasi_pelatihan
						) i on a.id_pegawai=i.id_pegawai 
					".$cond." 
					order by a.nama_pegawai asc
				) tbl 
				where tbl.hukuman is not null";

			$d['data_pegawai'] = $this->db->query($q);
			$this->load->view('dashboard_admin/laporan/hukuman/export',$d);
				
		}
		else
		{
			echo 'Request tidak valid.';
		}
	}
}
