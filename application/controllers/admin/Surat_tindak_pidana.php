<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat_tindak_pidana extends CI_Controller
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
			if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Surat Keterangan Bebas Tindak Pidana';
				$d['menu_open'] = 'kk';

				$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/home', $d);
			} else {
				header('location:' . base_url() . '');
			}
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function add()
	{
		$id_pegawai = $this->input->post('id_pegawai');

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_pegawai != 0) {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Tambah Surat Keterangan Bebas Tindak Pidana';
			$d['menu_open'] = 'kk';
			$d['act'] = 'add';

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/form', $d);
		} else {
			header('location:' . base_url());
		}
	}

	public function simpan()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			if ($this->input->post('id_pegawai') != 0) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Ubah Surat Keterangan Bebas Tindak Pidana';
				$d['menu_open'] = 'kk';
				$d['pegawai'] = null;
				$d['surat'] = null;
				$d['keterangan'] = null;

				//get data pegawai
				$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $this->input->post('id_pegawai')]);
				foreach ($q->result() as $p) {
					$d['pegawai'] = $p;
				}

				// $arrKeterangan = $this->input->post('keterangan');
				// $keterangan = ''; $i = 0;
				// foreach ($arrKeterangan as $ket) {
				// 	if ($i > 0) $keterangan .= '#|#';
				// 	$keterangan .= $ket;

				// 	$i++;
				// }

				if ($this->input->post('id_surat_tindak_pidana') != 0) {
					//edit mode
					//get data surat Bebas Tindak Pidana old
					$q = $this->db->get_where("tbl_data_surat_tindak_pidana", ['id_surat_tindak_pidana' => $this->input->post('id_surat_tindak_pidana')]);
					foreach ($q->result() as $p) {
						$d['surat'] = $p;

						// $arr = array();
						// if (strpos($p->keterangan,'#|#') !== false) {
						// 	$arr = explode('#|#', $p->keterangan);
						// }
						// else {
						// 	$arr = [$p->keterangan];
						// }

						// $d['keterangan'] = $arr;
					}

					if ($d['surat'] != null) {
						$d['keterangan'] = $this->input->post('keterangan');
						//$d['penutup'] = $this->input->post('penutup');
					} else {
						//surat tidak ditemukan
						$this->session->set_flashdata('msg', 'Surat tidak ditemukan.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/form', $d);
					}
				}

				if ($this->input->post('keterangan') == '') {
					$d['page_name'] = 'Ubah Surat Keterangan Bebas Tindak Pidana';
					$this->session->set_flashdata('msg', 'Surat keterangan ini dibuat untuk??');
					$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/form', $d);
				} elseif ($d['surat'] != null) {
					$d['page_name'] = 'Ubah Surat Keterangan Bebas Tindak Pidana';
					//save edit
					$in = array(
						'id_surat_tindak_pidana' => $this->input->post('id_surat_tindak_pidana'),
						'id_pegawai' => $this->input->post('id_pegawai'),
						'tanggal_pengajuan' => date('Y-m-d'),
						'keterangan' => $this->input->post('keterangan'),
						'penutup' => '',
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->where('id_surat_tindak_pidana', $this->input->post('id_surat_tindak_pidana'))->update('tbl_data_surat_tindak_pidana', $in)) {
						header('location:' . base_url() . 'admin/surat_tindak_pidana');
					} else {
						$this->session->set_flashdata('msg', 'Gagal mengubah surat Bebas Tindak Pidana.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/form', $d);
					}
				} else {
					$d['page_name'] = 'Tambah Surat Keterangan Bebas Tindak Pidana';

					// === begin: buat nomor surat ===
					// $this->db->select('no_urut_terakhir')->from('tr_no_surat')->where(['jenis_surat' => 2])->order_by('no_urut_terakhir', 'desc');
					$sSQL = "SELECT cast(substring_index(no_surat, '/', 1) as int) as no_urut 
							from tbl_data_surat_tindak_pidana 
							where not isnull(no_surat) and trim(no_surat) <> '' 
							order by cast(substring_index(no_surat, '/', 1) as int) desc 
							limit 0, 1";
					$rsSQL = $this->db->query($sSQL);

					if ($rsSQL->num_rows() > 0) {
						$no_urut = $rsSQL->row()->no_urut + 1;
					} else {
						$no_urut = 1;
					}
					$no_surat = $no_urut . '/KG.8.00/D';
					// === end: buat nomor surat ===

					//save add
					$in = array(
						'no_surat' => $no_surat,
						'id_pegawai' => $this->input->post('id_pegawai'),
						'tanggal_pengajuan' => date('Y-m-d'),
						'keterangan' => $this->input->post('keterangan'),
						'penutup' => '',
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->insert('tbl_data_surat_tindak_pidana', $in)) {
						header('location:' . base_url() . 'admin/surat_tindak_pidana');
					} else {
						$this->session->set_flashdata('msg', 'Gagal membuat surat Bebas Tindak Pidana.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/form', $d);
					}
				}
			} else {
				header('location:' . base_url() . 'admin/surat_tindak_pidana');
			}
		} else {
			header('location:' . base_url());
		}
	}

	public function detail()
	{
		$uri_param = $this->uri->segment(4);
		if ($uri_param == '') {
			$id_pegawai = $this->input->post('id_pegawai');
		} else {
			$id_pegawai = $uri_param;
		}
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Detail Surat Keterangan Bebas Tindak Pidana';
			$d['menu_open'] = 'kk';
			$d['act'] = 'detail';

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/detail', $d);
		} else {
			header('location:' . base_url() . '');
		}
	}

	public function cetak($id_surat = 0, $id_pegawai = 0)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != 0) {
			$this->load->library('Pdf');

			$d['surat'] = null;
			$d['header_surat'] = '';
			$d['pegawai'] = null;
			$d['penandatangan'] = null;
			$dt['eselon3'] = null;
			$d['ket_ttd'] = '';
			$d['lokasi_kerja_ttd'] = '';

			// get data surat
			$q = $this->db->get_where('tbl_data_surat_tindak_pidana', ['id_surat_tindak_pidana' => $id_surat]);
			foreach ($q->result() as $p) {
				$d['surat'] = $p;
				// echo '<pre>'.print_r($d['surat'],true).'</pre>';exit;

				$arrKet = ['Sampai dengan saat ini yang bersangkutan belum pernah dikenakan hukuman disiplin, baik tingkat ringan, sedang, dan berat, 
				berdasarkan Peraturan Pemerintah Nomor 53 Tahun 2010 dan Peraturan Pemerintah Nomor 10 Tahun 1983 jo. Peraturan Pemerintah 
				Nomor 45 Tahun 1990'];

				if ($p->keterangan != '') {
					if (strpos($p->keterangan, '#|#') !== false) {
						$arr = explode('#|#', $p->keterangan);
					} else {
						$arr = [$p->keterangan];
					}

					if (count($arr) > 0) {
						foreach ($arr as $key => $k) {
							$arrKet[] = $k;
						}
					}
				}
				// echo '<pre>'.print_r($arrKet,true).'</pre>';exit;

				$i = 1;
				$ket = '<table class="list">';
				foreach ($arrKet as $key => $k) {
					if ($i >= 1 && $i < count($arrKet)) $k .= ';';
					else if ($i == count($arrKet)) $k .= '.';

					$ket .= '<tr>
							<td class="number">' . $i . '.</td>
							<td class="list-content">' . $k . '</td>
						</tr>';

					$i++;
				}

				$ket .= '</table>';
				$d['ket'] = $ket;

				// === begin: get data kadis ===
				$d['kadis'] = null;
				$q = $this->db->query(
					"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
					from tbl_data_pegawai a
					left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
					left join tbl_master_golongan c on a.id_golongan = c.id_golongan
					left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
					where a.id_jabatan = 1"
				);
				$d['kadis'] = $q->row();

				// tanda tangan
				$sign_url = 'https://dcktrp.jakarta.go.id/si-adik/asset/foto_pegawai/signature/';
				$d['sign1url'] 	= str_replace("\\", "", str_replace('"', '', $this->func_table->SSOGetUserFunc($d['kadis']->nrk)['signature']));

				// === end: get data kadis ===

				// === begin: nomor surat ===
				// $this->db->select('no_urut_terakhir')->from('tr_no_surat')->where(['jenis_surat' => 2])->order_by('no_urut_terakhir', 'desc');
				// $rsSQL = $this->db->get();
				// if ($rsSQL->num_rows() > 0) {
				// 	$no_surat = $rsSQL->row()->no_urut_terakhir . '/KG.11.04/TP/D';
				// } else {
				// 	$no_surat = '';
				// }
				// $d['no_surat'] = $no_surat;
				// === end: nomor surat ===

				// get data pegawai
				$q2 = $this->db->query(
					"SELECT a.nip, a.nrk, a.nama_pegawai, a.id_status_jabatan, a.id_jabatan, a.lokasi_kerja as id_lokasi_kerja, 
						b.id_nama_jabatan, b.nama_jabatan, b.level_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, 
						d.dinas, e.sub_lokasi_kerja , d.dinas 
					from tbl_data_pegawai a
					left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
					left join tbl_master_golongan c on a.id_golongan = c.id_golongan
					left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja 
					left join tbl_master_sub_lokasi_kerja e on a.seksi = e.id_sub_lokasi_kerja 
					where a.id_pegawai = " . $p->id_pegawai
				);

				foreach ($q2->result() as $p2) {
					// echo '<pre>'.print_r($p2,true).'</pre>';exit;
					$d['pegawai'] = $p2;
					$d['header_surat'] = strtoupper(strtolower($p2->lokasi_kerja));

					//yg bertanda tangan eselon3
					$q3 = $this->db->query(
						"SELECT a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
						from tbl_data_pegawai a
						left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
						left join tbl_master_golongan c on a.id_golongan = c.id_golongan
						left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
						where a.lokasi_kerja = " . $p2->id_lokasi_kerja . "
							and a.id_eselon in (27,28) "
					);
					foreach ($q3->result() as $p3) {
						$d['penandatangan'] = $p3;
						// echo '<pre>'.print_r($p3,true).'</pre>';exit;
					}

					$jabatan_ttd = ucwords(strtolower($d['penandatangan']->nama_jabatan));
					$filter_jabatan_ttd = trim(str_replace('Kepala', '', $jabatan_ttd));
					$lokasi_ttd = trim(ucwords(strtolower($d['penandatangan']->lokasi_kerja)));
					$lokasi_ttd = trim(str_replace($filter_jabatan_ttd, '', $lokasi_ttd));
					$d['ket_ttd'] = $jabatan_ttd . '<br />' . $lokasi_ttd;
				}
				// echo '<pre>'.print_r($d,true).'</pre>';exit;
				$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/export', $d);
			}
		} else {
			header('location:' . base_url());
		}
	}

	public function edit()
	{
		$id_surat = $this->input->post('id_surat');
		$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
		$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
		$d['instansi'] = $this->config->item('nama_instansi');
		$d['credit'] = $this->config->item('credit_aplikasi');
		$d['alamat'] = $this->config->item('alamat_instansi');
		$d['page_name'] = 'Ubah Surat Keterangan Bebas Tindak Pidana';
		$d['menu_open'] = 'kk';
		$d['act'] = 'edit';
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator" && $id_surat != 0) {
			$d['pegawai'] = null;
			$d['surat'] = null;
			$d['keterangan'] = null;

			$q = $this->db->get_where("tbl_data_surat_tindak_pidana", ['id_surat_tindak_pidana' => $id_surat]);
			foreach ($q->result() as $p) {
				$d['surat'] = $p;

				// $arr = array();
				// if (strpos($p->keterangan,'#|#') !== false) {
				// 	$arr = explode('#|#', $p->keterangan);
				// }
				// else {
				// 	$arr = [$p->keterangan];
				// }

				// $d['keterangan'] = $arr;
			}

			if (isset($d['surat']->id_pegawai)) {
				$q = $this->db->get_where("tbl_data_pegawai", ['id_pegawai' => $d['surat']->id_pegawai]);
				foreach ($q->result() as $p) {
					$d['pegawai'] = $p;
				}
			}

			//echo '<pre>'.print_r($d,true).'</pre>';exit;

			$this->load->view('dashboard_admin/kertas_kerja/surat_tindak_pidana/form', $d);
		} else {
			header('location:' . base_url());
		}
	}

	public function delete($id_surat = 0)
	{
		$surat = null;
		$q = $this->db->get_where("tbl_data_surat_tindak_pidana", ['id_surat_tindak_pidana' => $id_surat]);
		foreach ($q->result() as $p) {
			$surat = $p;
		}

		if ($surat != null) {
			$this->db->where('id_surat_tindak_pidana', $id_surat)->delete('tbl_data_surat_tindak_pidana');
			header('location:' . base_url() . 'admin/surat_tindak_pidana/detail/' . $p->id_pegawai);
		} else {
			header('location:' . base_url() . 'admin/surat_tindak_pidana');
		}
	}
}

/* End of file surat_tindak_pidana.php */
/* Location: ./application/controllers/surat_tindak_pidana.php */
