<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class surat_hukdis_old extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');    /***** LOADING HELPER TO AVOID PHP ERROR ****/
        $this->load->helper('template');
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Surat Keterangan Hukuman Disiplin';
				$d['menu_open'] = 'kk';
	
				$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/home',$d);
			}
			else {
				header('location:'.base_url().'');
			}
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function add() {
		$id_pegawai = $this->input->post('id_pegawai');

		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_pegawai!=0)
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Tambah Surat Keterangan Hukuman Disiplin';
			$d['menu_open'] = 'kk';
			$d['act'] = 'add';

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}
			
			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form',$d);
		}
		else
		{
			header('location:'.base_url());
		}
	}

	public function simpan() {
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
			if ($this->input->post('id_pegawai') != 0) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['menu_open'] = 'kk';
				$d['pegawai'] = null;
				$d['surat'] = null;
				$d['keterangan'] = null;

				//get data pegawai
				$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $this->input->post('id_pegawai')]);
				foreach ($q->result() as $p) {
					$d['pegawai'] = $p;
				}

				$arrKeterangan = $this->input->post('keterangan');
				$keterangan = ''; $i = 0;
				foreach ($arrKeterangan as $ket) {
					if ($i > 0) $keterangan .= '#|#';
					$keterangan .= $ket;

					$i++;
				}
				
				if ($this->input->post('id_surat_hukdis') != 0) {
					//edit mode
					//get data surat hukdis old
					$q = $this->db->get_where("tbl_data_surat_hukdis", ['id_surat_hukdis' => $this->input->post('id_surat_hukdis')]);
					foreach ($q->result() as $p) {
						$d['surat'] = $p;
						
						$arr = array();
						if (strpos($p->keterangan,'#|#') !== false) {
							$arr = explode('#|#', $p->keterangan);
						}
						else {
							$arr = [$p->keterangan];
						}

						$d['keterangan'] = $arr;
					}

					if ($d['surat'] != null) {
						$d['keterangan'] = $keterangan;
						$d['penutup'] = $this->input->post('penutup');
					}
					else {
						//surat tidak ditemukan
						$this->session->set_flashdata('msg', 'Surat tidak ditemukan.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form',$d);
					}
				}

				if ($this->input->post('penutup') == '') {
					$d['page_name'] = 'Ubah Surat Keterangan Hukuman Disiplin';
					$this->session->set_flashdata('msg', 'Surat keterangan ini dibuat untuk??');
					$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form',$d);
				}
				elseif ($d['surat'] != null) {
					$d['page_name'] = 'Ubah Surat Keterangan Hukuman Disiplin';
					//save edit
					$in = array(
						'id_surat_hukdis' => $this->input->post('id_surat_hukdis'),
						'id_pegawai' => $this->input->post('id_pegawai'),
						'tanggal_pengajuan' => date('Y-m-d'),
						'keterangan' => $keterangan,
						'penutup' => $this->input->post('penutup'),
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->where('id_surat_hukdis', $this->input->post('id_surat_hukdis'))->update('tbl_data_surat_hukdis', $in)) {
						header('location:'.base_url().'admin/surat_hukdis');
					}
					else {
						$this->session->set_flashdata('msg', 'Gagal mengubah surat hukuman disiplin.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form',$d);
					}
				}
				else {
					$d['page_name'] = 'Tambah Surat Keterangan Hukuman Disiplin';
					//save add
					$in = array(
						'id_pegawai' => $this->input->post('id_pegawai'),
						'tanggal_pengajuan' => date('Y-m-d'),
						'keterangan' => $keterangan,
						'penutup' => $this->input->post('penutup'),
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->insert('tbl_data_surat_hukdis', $in)) {
						header('location:'.base_url().'admin/surat_hukdis');
					}
					else {
						$this->session->set_flashdata('msg', 'Gagal membuat surat hukuman disiplin.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form',$d);
					}
				}
			}
			else {
				header('location:'.base_url().'admin/surat_hukdis');
			}
		}
		else {
			header('location:'.base_url());
		}
	}

	public function detail() {
		$id_pegawai = $this->input->post('id_pegawai');
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Detail Surat Keterangan Hukuman Disiplin';
			$d['menu_open'] = 'kk';
			$d['act'] = 'detail';

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/detail',$d);
		}
		else {
			header('location:'.base_url().'');
		}
	}

	public function cetak($id_surat=0,$id_pegawai=0) {
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_pegawai!=0) {
			$this->load->library('Pdf');
			
			//get data pegawai
			$d['pegawai'] = null;
			$q = $this->db->query("
				select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
				from tbl_data_pegawai a
				left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
				left join tbl_master_golongan c on a.id_golongan = c.id_golongan
				left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
				where a.id_pegawai = ".$id_pegawai
			);
			
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			//get data kadis
			$d['kadis'] = null;
			$q = $this->db->query("
				select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
				from tbl_data_pegawai a
				left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
				left join tbl_master_golongan c on a.id_golongan = c.id_golongan
				left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
				where a.id_jabatan = 1
			");
			
			foreach ($q->result() as $p) {
				$d['kadis'] = $p;
			}

			$d['surat'] = null;
			$q = $this->db->get_where('tbl_data_surat_hukdis', ['id_surat_hukdis' => $id_surat]);
			foreach ($q->result() as $p) {
				$ket = '<br /><br /><table class="list">';

				$arrKet = ['Sampai dengan saat ini yang bersangkutan belum pernah dikenakan hukuman disiplin, baik tingkat ringan, sedang, dan berat, 
				berdasarkan Peraturan Pemerintah Nomor 53 Tahun 2010 dan Peraturan Pemerintah Nomor 10 Tahun 1983 jo. Peraturan Pemerintah 
				Nomor 45 Tahun 1990'];

				if ($p->keterangan!='') {
					if (strpos($p->keterangan,'#|#') !== false) {
						$arr = explode('#|#', $p->keterangan);
					}
					else {
						$arr = [$p->keterangan];
					}

					if (count($arr) > 0) {
						foreach ($arr as $key=>$k) {
							$arrKet[] = $k;
						}
					}
				}

				$i = 1;
				foreach ($arrKet as $key=>$k) {
					if ($i >= 1 && $i < count($arrKet)) $k .= ';';
					else if ($i == count($arrKet)) $k .= '.';

					$ket .= '<tr>
							<td class="number">'.$i.'.</td>
							<td class="list-content">'.$k.'</td>
						</tr>';
					
					$i++;
				}
				
				$ket .= '</table>';
				$d['ket'] = $ket;
				$d['surat'] = $p;
			}
			
			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/export',$d);
		}
		else {
			header('location:'.base_url());
		}
	}

	public function edit() {
		$id_surat = $this->input->post('id_surat');
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_surat != '') {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Ubah Surat Keterangan Hukuman Disiplin';
			$d['menu_open'] = 'kk';
			$d['act'] = 'edit';

			$q = $this->db->get_where("tbl_data_surat_hukdis", ['id_surat_hukdis' => $id_surat]);
			foreach ($q->result() as $p) {
				$d['surat'] = $p;
				
				$arr = array();
				if (strpos($p->keterangan,'#|#') !== false) {
					$arr = explode('#|#', $p->keterangan);
				}
				else {
					$arr = [$p->keterangan];
				}

				$d['keterangan'] = $arr;
			}
			
			if (isset($d['surat']->id_pegawai)) {
				$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $d['surat']->id_pegawai]);
				foreach ($q->result() as $p) {
					$d['pegawai'] = $p;
				}
			}
			// echo '<pre>'.print_r($d,true).'</pre>';exit;
			$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form',$d);
		}
		else {
			header('location:'.base_url().'');
		}

		// if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_surat!=0)
		// {
		// 	$d['pegawai'] = null;
		// 	$d['surat'] = null;
		// 	$d['keterangan'] = null;

		// 	$q = $this->db->get_where("tbl_data_surat_hukdis", ['id_surat_hukdis' => $id_surat]);
		// 	foreach ($q->result() as $p) {
		// 		$d['surat'] = $p;
				
		// 		$arr = array();
		// 		if (strpos($p->keterangan,'#|#') !== false) {
		// 			$arr = explode('#|#', $p->keterangan);
		// 		}
		// 		else {
		// 			$arr = [$p->keterangan];
		// 		}

		// 		$d['keterangan'] = $arr;
		// 	}
			
		// 	if (isset($d['surat']->id_pegawai)) {
		// 		$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $d['surat']->id_pegawai]);
		// 		foreach ($q->result() as $p) {
		// 			$d['pegawai'] = $p;
		// 		}
		// 	}

		// 	//echo '<pre>'.print_r($d,true).'</pre>';exit;
			
		// 	$this->load->view('dashboard_admin/kertas_kerja/surat_hukdis/form',$d);
		// }
		// else
		// {
		// 	header('location:'.base_url());
		// }
	}

	public function delete($id_surat=0) {
		$surat = null;
		$q = $this->db->get_where("tbl_data_surat_hukdis", ['id_surat_hukdis' => $id_surat]);
		foreach ($q->result() as $p) {
			$surat = $p;
		}

		if ($surat != null) {
			$this->db->where('id_surat_hukdis', $id_surat)->delete('tbl_data_surat_hukdis');
			header('location:'.base_url().'admin/surat_hukdis/detail/'.$p->id_pegawai);
		}
		else {
			header('location:'.base_url().'admin/surat_hukdis');
		}
	}
}

/* End of file surat_hukdis.php */
/* Location: ./application/controllers/surat_hukdis.php */