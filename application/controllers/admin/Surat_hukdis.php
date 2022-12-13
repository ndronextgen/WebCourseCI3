<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat_hukdis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		/***** LOADING HELPER TO AVOID PHP ERROR ****/
		$this->load->helper('template');
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
			$d['page_name'] = 'Surat Keterangan Belum Pernah Terkena Hukuman Disiplin';
			$d['menu_open'] = 'kk';

			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/home', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function add()
	{
		$id_pegawai = $this->input->post('id_pegawai');
		$act = $this->input->post('act');

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_pegawai != 0) {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Tambah Surat Keterangan Belum Pernah Terkena Hukuman Disiplin';
			$d['menu_open'] = 'kk';
			$d['act'] = $act;

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			$d['id_tipe_surat_hukdis'] = 0;

			$arrTipe = array();
			$arrTipeSelected = array();
			$tipe = $this->db->get('tbl_master_tipe_surat_hukdis')->result_array();
			if (count($tipe) > 0) {
				foreach ($tipe as $t) {
					$arrTipe[$t['id_tipe_surat_hukdis']] = $t['name'];

					$arrTipeSelected[$t['id_tipe_surat_hukdis']] = '';
					if ($d['id_tipe_surat_hukdis'] == $t['id_tipe_surat_hukdis']) {
						$arrTipeSelected[$t['id_tipe_surat_hukdis']] = 'selected=selected';
					}
				}
			}

			$d['arrTipe'] = $arrTipe;
			$d['arrTipeSelected'] = $arrTipeSelected;

			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form', $d);
		} else {
			header('location:' . base_url());
		}
	}

	public function simpan()
	{
		$status = false;
		$message = '';

		$id_pegawai = $this->input->post('id_pegawai');
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_pegawai != 0) {
			//get data pegawai
			$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			// echo $this->input->post('penutup').' || '.$this->input->post('id_tipe_surat_hukdis');
			$surat = null;
			if ($this->input->post('id_surat_hukdis') != 0) {
				//edit mode
				//get data surat hukdis old
				$q = $this->db->get_where("tbl_data_surat_hukdis", ['id_surat_hukdis' => $this->input->post('id_surat_hukdis')]);
				foreach ($q->result() as $p) {
					$surat = $p;
				}

				if ($surat == null) {
					$message = 'Surat tidak ditemukan.';
				}
			} else if ($this->input->post('penutup') == '' || $this->input->post('id_tipe_surat_hukdis') == '0') {
				$message = 'Harap lengkapi data.';
			}

			if ($message == '') {
				if ($surat != null) {
					//save edit
					$in = array(
						'id_surat_hukdis' => $this->input->post('id_surat_hukdis'),
						'id_pegawai' => $this->input->post('id_pegawai'),
						'tanggal_pengajuan' => date('Y-m-d'),
						'id_tipe_surat_hukdis' => $this->input->post('id_tipe_surat_hukdis'),
						'penutup' => $this->input->post('penutup'),
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->where('id_surat_hukdis', $this->input->post('id_surat_hukdis'))->update('tbl_data_surat_hukdis', $in)) {
						$status = true;
					} else {
						$message = 'Gagal mengubah surat hukuman disiplin.';
					}
				} else {
					// === begin: buat nomor surat ===
					// $this->db->select('no_urut_terakhir')->from('tr_no_surat')->where(['jenis_surat' => 1])->order_by('no_urut_terakhir', 'desc');
					$sSQL = "SELECT cast(substring_index(no_surat, '/', 1) as int) as no_urut 
							from tbl_data_surat_hukdis 
							where not isnull(no_surat) and trim(no_surat) <> '' 
							order by cast(substring_index(no_surat, '/', 1) as int) desc 
							limit 0, 1";
					$rsSQL = $this->db->query($sSQL);

					if ($rsSQL->num_rows() > 0) {
						$no_urut = $rsSQL->row()->no_urut + 1;
					} else {
						$no_urut = 1;
					}
					$no_surat = $no_urut . '/KG.11.04/HD/D';
					// === end: buat nomor surat ===

					//save add
					$in = array(
						'no_surat' => $no_surat,
						'id_pegawai' => $this->input->post('id_pegawai'),
						'tanggal_pengajuan' => date('Y-m-d'),
						'id_tipe_surat_hukdis' => $this->input->post('id_tipe_surat_hukdis'),
						'penutup' => $this->input->post('penutup'),
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->insert('tbl_data_surat_hukdis', $in)) {
						$status = true;
					} else {
						$message = 'Gagal membuat surat hukuman disiplin.';
					}
				}
			}
		} else {
			$message = 'Request tidak valid.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function detail()
	{
		$id_pegawai = $this->input->post('id_pegawai');
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Detail Surat Keterangan Belum Pernah Terkena Hukuman Disiplin';
			$d['menu_open'] = 'kk';
			$d['act'] = 'detail';

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/detail', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function cetak($id_surat = 0, $id_pegawai = 0)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_pegawai != 0 && $id_surat != 0) {
			$this->load->library('Pdf');

			// get data pegawai
			$d['pegawai'] = null;
			$q = $this->db->query(
				"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
				from tbl_data_pegawai a
				left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
				left join tbl_master_golongan c on a.id_golongan = c.id_golongan
				left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
				where a.id_pegawai = " . $id_pegawai
			);

			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			// get data kadis
			$d['kadis'] = null;
			$q = $this->db->query(
				"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
				from tbl_data_pegawai a
				left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
				left join tbl_master_golongan c on a.id_golongan = c.id_golongan
				left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
				where a.id_jabatan = 1"
			);

			foreach ($q->result() as $p) {
				$d['kadis'] = $p;
			}

			// === begin: nomor surat ===
			// $this->db->select('no_urut_terakhir')->from('tr_no_surat')->where(['jenis_surat' => 1])->order_by('no_urut_terakhir', 'desc');
			// $rsSQL = $this->db->get();
			// if ($rsSQL->num_rows() > 0) {
			// 	$no_surat = $rsSQL->row()->no_urut_terakhir . '/KG.11.04/HD/D';
			// } else {
			// 	$no_surat = '';
			// }
			// $d['no_surat'] = $no_surat;
			// === end: nomor surat ===

			// tanda tangan kadis
			$sign_url = 'https://dcktrp.jakarta.go.id/si-adik/asset/foto_pegawai/signature/';
			$d['sign1url'] 	= str_replace("\\", "", str_replace('"', '', $this->func_table->SSOGetUserFunc($d['kadis']->nrk)['signature']));

			$d['surat'] = null;
			$q = $this->db->get_where('tbl_data_surat_hukdis', ['id_surat_hukdis' => $id_surat]);
			foreach ($q->result() as $p) {
				$d['surat'] = $p;
			}

			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/export', $d);
		} else {
			echo 'Request tidak valid.';
		}
	}

	public function edit()
	{
		$id_surat = $this->input->post('id_surat');
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != '') {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Ubah Surat Keterangan Belum Pernah Terkena Hukuman Disiplin';
			$d['menu_open'] = 'kk';
			$d['act'] = 'edit';
			$d['id_tipe_surat_hukdis'] = 0;

			$q = $this->db->get_where("tbl_data_surat_hukdis", ['id_surat_hukdis' => $id_surat]);
			foreach ($q->result() as $p) {
				$d['surat'] = $p;
				$d['id_tipe_surat_hukdis'] = $p->id_tipe_surat_hukdis;
			}

			if (isset($d['surat']->id_pegawai)) {
				$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $d['surat']->id_pegawai]);
				foreach ($q->result() as $p) {
					$d['pegawai'] = $p;
				}
			}

			$arrTipe = array();
			$arrTipeSelected = array();
			$tipe = $this->db->get('tbl_master_tipe_surat_hukdis')->result_array();
			if (count($tipe) > 0) {
				foreach ($tipe as $t) {
					$arrTipe[$t['id_tipe_surat_hukdis']] = $t['name'];

					$arrTipeSelected[$t['id_tipe_surat_hukdis']] = '';
					if ($d['id_tipe_surat_hukdis'] == $t['id_tipe_surat_hukdis']) {
						$arrTipeSelected[$t['id_tipe_surat_hukdis']] = 'selected=selected';
					}
				}
			}

			$d['arrTipe'] = $arrTipe;
			$d['arrTipeSelected'] = $arrTipeSelected;

			// echo '<pre>'.print_r($d,true).'</pre>';exit;
			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function delete()
	{
		$status = false;
		$message = '';

		$id_surat = $this->input->post('id_surat');

		$surat = null;
		$q = $this->db->get_where("tbl_data_surat_hukdis", ['id_surat_hukdis' => $id_surat]);
		foreach ($q->result() as $p) {
			$surat = $p;
		}

		if ($surat != null) {
			if ($this->db->where('id_surat_hukdis', $id_surat)->delete('tbl_data_surat_hukdis')) {
				$status = true;
			} else {
				$message = 'Hapus Data Gagal.';
			}
		} else {
			$message = 'Request tidak valid.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}
}

/* End of file surat_hukdis.php */
/* Location: ./application/controllers/surat_hukdis.php */
