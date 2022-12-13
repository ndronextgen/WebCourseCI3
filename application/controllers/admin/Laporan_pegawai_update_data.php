<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_update_data extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('template');
		$this->load->helper('date_convert');
		$this->load->library('func_table');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Laporan Pegawai - Pembaruan Data';
			$d['menu_open'] = 'laporan';

			// === lokasi kerja ===
			$d['lokasi'] = $this->input->post('lokasi');
			$arrLokasi = array();
			$arrLokasiSelected = array();
			// $lokasi = $this->db->get('tbl_master_lokasi_kerja')->result_array();
			$lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => '0'))->result_array();
			if (count($lokasi) > 0) {
				foreach ($lokasi as $l) {
					$arrLokasi[$l['id_lokasi_kerja']] = $l['lokasi_kerja'];

					$arrLokasiSelected[$l['id_lokasi_kerja']] = '';
					if ($d['lokasi'] == $l['id_lokasi_kerja']) {
						$arrLokasiSelected[$l['id_lokasi_kerja']] = 'selected=selected';
					}
				}
			}

			$d['arrLokasi'] = $arrLokasi;
			$d['arrLokasiSelected'] = $arrLokasiSelected;
			$d['mst_lokasi_kerja'] = $this->db->get('tbl_master_lokasi_kerja');

			// === report type ===
			if ($this->input->post('tipe') == null) {
				$d['tipe'] = '0';
			} else {
				$d['tipe'] = $this->input->post('tipe');
			}

			$this->load->view('dashboard_admin/laporan/update_data/home', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function export()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['tipe'] = $this->input->post('tipe');
			$d['lokasi'] = $this->input->post('lokasi');

			$cond = '';
			if ($d['lokasi'] !== '0') {
				$cond .= 'and peg.lokasi_kerja = ' . $d['lokasi'] . ' ';
			}

			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$cond .= ' and a.lokasi_kerja=' . $this->session->userdata('lokasi_kerja');
			}

			// === list update ===
			if ($d['tipe'] == 0) {
				$sSQL = "SELECT peg.nrk, peg.nip, 
						concat(' ', peg.nama_pegawai) as nama_pegawai, 
						concat(' ', ifnull(lok.lokasi_kerja, '-')) as lokasi_kerja, 
						substring_index(`mod`.module_path,'>',-1) as menu, 
						date_format(`not`.created_at, '%e %b %Y - %H:%i:%s') as created_at 
					FROM tr_notif `not` 
						JOIN tbl_data_pegawai peg ON peg.nrk = `not`.created_by 
						JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
						JOIN mt_notif_modul `mod` ON `mod`.module_id = `not`.module_id 
					WHERE 1=1 " . $cond . " 
					ORDER BY created_at DESC";
				$d['data'] = $this->db->query($sSQL);

				// === pegawai yang pernah udpate ===
			} elseif ($d['tipe'] == 1) {
				$sSQL = "SELECT nip, nrk, 
							concat(' ', nama_pegawai) nama_pegawai, 
							concat(' ', ifnull(lok.lokasi_kerja, '-')) lokasi_kerja, 
							count(notif_id) `notif` 
						from tbl_data_pegawai peg 
							left join tr_notif `not` on created_by = nrk 
							left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
						where nrk in (select distinct(created_by) created_by from tr_notif) 
							" . $cond . " 
						group by id_pegawai 
						order by nrk";
				$d['data'] = $this->db->query($sSQL);

				// === pegawai yang belum pernah udpate ===
			} elseif ($d['tipe'] == 2) {
				$sSQL = "SELECT nip, nrk, 
							concat(' ', nama_pegawai) nama_pegawai, 
							concat(' ', ifnull(lok.lokasi_kerja, '-')) lokasi_kerja, 
							count(notif_id) `notif` 
						from tbl_data_pegawai peg 
							left join tr_notif `not` on created_by = nrk 
							left join tbl_master_lokasi_kerja lok on lok.id_lokasi_kerja = peg.lokasi_kerja 
						where nrk not in (select distinct(created_by) created_by from tr_notif) 
							" . $cond . " 
						group by id_pegawai 
						order by nrk";
				$d['data'] = $this->db->query($sSQL);
			}

			$this->load->helper('date_convert');
			$this->load->view('dashboard_admin/laporan/update_data/export', $d);
		} else {
			echo 'Request tidak valid.';
		}
	}
}

/* End of file laporan_pegawai_update_data.php */
/* Location: ./application/controllers/admin/laporan_pegawai_update_data.php */
