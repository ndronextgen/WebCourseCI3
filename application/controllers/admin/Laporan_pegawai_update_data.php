<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pegawai_update_data extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('template');
		$this->load->helper('date_convert');
		$this->load->library('func_table');

		if ($this->session->userdata('logged_in') == "" && $this->session->userdata('stts') != "administrator") {
			header('location:' . base_url() . '');
		}
	}

	public function index()
	{
		$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
		$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
		$d['instansi'] = $this->config->item('nama_instansi');
		$d['credit'] = $this->config->item('credit_aplikasi');
		$d['alamat'] = $this->config->item('alamat_instansi');
		$d['page_name'] = 'Laporan Pegawai - Pembaruan Data';
		$d['menu_open'] = 'laporan';

		// === lokasi kerja ===
		$lokasi_post = $this->input->post('lokasi');
		$d['lokasi'] = $lokasi_post;
		$arrLokasi = array();
		$arrLokasiSelected = array();
		$lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => 0))->result_array();
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

		// === sub lokasi kerja ===
		// if ($lokasi_post != null) {
		// 	$d['sublokasi'] = $this->input->post('sublokasi');
		// 	$arrSubLokasi = array();
		// 	$arrSubLokasiSelected = array();
		// 	$sublokasi = $this->db->get_where('tbl_master_sub_lokasi_kerja', array('id_lokasi_kerja' => $lokasi_post))->result_array();
		// 	if (count($sublokasi) > 0) {
		// 		foreach ($sublokasi as $l) {
		// 			$arrSubLokasi[$l['id_sub_lokasi_kerja']] = $l['sub_lokasi_kerja'];

		// 			$arrSubLokasiSelected[$l['id_sub_lokasi_kerja']] = '';
		// 			if ($d['sublokasi'] == $l['id_sub_lokasi_kerja']) {
		// 				$arrSubLokasiSelected[$l['id_sub_lokasi_kerja']] = 'selected=selected';
		// 			}
		// 		}
		// 	}
		// 	$d['arrSubLokasi'] = $arrSubLokasi;
		// 	$d['arrSubLokasiSelected'] = $arrSubLokasiSelected;
		// 	$d['mst_sub_lokasi_kerja'] = $this->db->get('tbl_master_sub_lokasi_kerja');
		// }

		// === report type ===
		if ($this->input->post('tipe') == null) {
			$d['tipe'] = '0';
		} else {
			$d['tipe'] = $this->input->post('tipe');
		}

		// === date range ===
		// if ($this->input->post('start_date') == null) {
		// 	$d['start_date'] = date('Y-m-d');
		// } else {
		$d['start_date'] = $this->input->post('start_date');
		// };
		// if ($this->input->post('end_date') == null) {
		// 	$d['end_date'] = date('Y-m-d');
		// } else {
		$d['end_date'] = $this->input->post('end_date');
		// };

		// === read notif ===
		$ses_username = $this->session->userdata('username');
		$this->func_table->ReadNotif(1, $ses_username);

		// === load view ===
		$this->load->view('dashboard_admin/laporan/update_data/home', $d);
	}

	public function export()
	{
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
	}

	public function load_sub_dinas()
	{
		$sub_dinas = $this->db->get_where('tbl_master_lokasi_kerja', array('sublokasi' => 1));

		if ($sub_dinas->num_rows() > 0) {
			foreach ($sub_dinas->result() as $row) {
				$result[] = [
					'id_lokasi_kerja' => $row->id_lokasi_kerja,
					'lokasi_kerja' => $row->lokasi_kerja
				];
			}
			echo json_encode($result);
		}
	}

	public function grafik_update_data()
	{
		$lokasi 	= $this->input->post('lokasi');
		$sublokasi 	= $this->input->post('sublokasi');
		$start_date = $this->input->post('start_date');
		$end_date 	= $this->input->post('end_date');

		$cond = '';
		if ($lokasi != 0 and $lokasi != '' and $lokasi != null) {
			$cond .= 'and peg.lokasi_kerja = \'' . $lokasi . '\'';
		}

		// === filter: sub lokasi ===
		$join = '';
		if ($sublokasi != null and $sublokasi != '' and $sublokasi != 0) {
			$cond .= ' and peg.sublokasi_kerja = \'' . $sublokasi . '\'';
		} elseif ($sublokasi == 0) {
			$join = 'LEFT ';
		}

		$sSQL =
			"SELECT nip
			FROM tbl_data_pegawai peg 
				JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
				" . $join . "JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
			WHERE 1=1
				" . $cond . " 
			GROUP BY id_pegawai 
			ORDER BY nrk";
		$peg_total = $this->db->query($sSQL)->num_rows();

		// === filter: date range ===
		if ($start_date != null and $end_date != null) {
			$cond .= ' and date(created_at) between \'' . $start_date . '\' and \'' . $end_date . '\'';
		}

		$sSQL =
			"SELECT nip
			FROM tbl_data_pegawai peg 
				JOIN tr_notif `not` ON created_by = nrk 
				JOIN tbl_master_lokasi_kerja lok ON lok.id_lokasi_kerja = peg.lokasi_kerja 
				" . $join . "JOIN tbl_master_lokasi_kerja sublok ON sublok.id_lokasi_kerja = peg.sublokasi_kerja 
			WHERE nrk IN (SELECT DISTINCT(created_by) created_by FROM tr_notif) 
				" . $cond . " 
			GROUP BY id_pegawai 
			ORDER BY nrk";
		$peg_update = $this->db->query($sSQL)->num_rows();

		$data['peg_total'] = $peg_total;
		$data['peg_update'] 	= $peg_update;
		$data['peg_no_update'] = $peg_total - $peg_update;

		$this->load->view('dashboard_admin/laporan/update_data/grafik/grafik_update_data', $data, FALSE);
	}
}

/* End of file laporan_pegawai_update_data.php */
/* Location: ./application/controllers/admin/laporan_pegawai_update_data.php */
