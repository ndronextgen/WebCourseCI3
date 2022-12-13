<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_tugas_plh extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');    /***** LOADING HELPER TO AVOID PHP ERROR ****/
        $this->load->helper('template');
		$this->load->library('func_table');
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
				$d['page_name'] = 'Surat Keterangan Tugas PLH';
				$d['menu_open'] = 'kk';
	
				$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/home',$d);
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
			$d['page_name'] = 'Tambah Surat Keterangan Tugas PLH';
			$d['menu_open'] = 'kk';
			$d['act'] = 'add';

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			$d['data_pegawai'] = $this->db->query("SELECT * FROM tbl_data_pegawai order by nama_pegawai ASC")->result();
			
			$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/form',$d);
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
				$d['page_name'] = 'Ubah Surat Keterangan Tugas PLH';
				$d['menu_open'] = 'kk';

				//get data pegawai
				$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $this->input->post('id_pegawai')]);
				foreach ($q->result() as $p) {
					$d['pegawai'] = $p;
				}

				$arrTembusan = $this->input->post('tembusan');
				$tembusan = ''; $i = 0;
				foreach ($arrTembusan as $ket) {
					if ($i > 0) $tembusan .= '#|#';
					$tembusan .= $ket;

					$i++;
				}
				
				if ($this->input->post('id_surat_tugas_plh') != 0) {
					//edit mode
					//get data surat Tugas PLH old
					$q = $this->db->get_where("tbl_data_surat_tugas_plh", ['id_surat_tugas_plh' => $this->input->post('id_surat_tugas_plh')]);
					foreach ($q->result() as $p) {
						$d['surat'] = $p;
						
						$arr = array();
						if (strpos($p->tembusan,'#|#') !== false) {
							$arr = explode('#|#', $p->tembusan);
						}
						else {
							$arr = [$p->tembusan];
						}

						$d['tembusan'] = $arr;
					}

					if ($d['surat'] != null) {
						$d['filter_pegawai'] = $this->input->post('filter_pegawai');
						$d['lokasi_kerja'] = $this->input->post('lokasi_kerja');
						$d['durasi'] = $this->input->post('durasi');
						$d['tgl_mulai'] = $this->input->post('tgl_mulai');
						$d['tgl_selesai'] = $this->input->post('tgl_selesai');
						$d['alasan_plh'] = $this->input->post('alasan_plh');
						$d['tembusan'] = $tembusan;
					}
					else {
						//surat tidak ditemukan
						$this->session->set_flashdata('msg', 'Surat tidak ditemukan.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/form',$d);
					}
				}

				if ($this->input->post('alasan_plh') == '') {
					$d['page_name'] = 'Ubah Surat Keterangan Tugas PLH';
					$this->session->set_flashdata('msg', 'Surat keterangan ini dibuat untuk??');
					$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/form',$d);
				}
				elseif ($d['surat'] != null) {
					$d['page_name'] = 'Ubah Surat Keterangan Tugas PLH';
					//save edit
					$in = array(
						'id_surat_tugas_plh' => $this->input->post('id_surat_tugas_plh'),
						'id_pegawai' => $this->input->post('id_pegawai'),
						'id_pegawai_berhalangan' => $this->input->post('filter_pegawai'),
						'lokasi_kerja' => $this->input->post('lokasi_kerja'),
						'alasan_plh' => $this->input->post('alasan_plh'),
						'durasi' => $this->input->post('durasi'),
						'tgl_mulai' => $this->input->post('tgl_mulai'),
						'tgl_selesai' => $this->input->post('tgl_selesai'),
						'tembusan' => $tembusan,
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'tanggal_pengajuan' => date('Y-m-d'),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->where('id_surat_tugas_plh', $this->input->post('id_surat_tugas_plh'))->update('tbl_data_surat_tugas_plh', $in)) {
						header('location:'.base_url().'admin/surat_tugas_plh');
					}
					else {
						$this->session->set_flashdata('msg', 'Gagal mengubah surat Tugas PLH.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/form',$d);
					}
				}
				else {
					$d['page_name'] = 'Tambah Surat Keterangan Tugas PLH';
					//save add
					$in = array(
						'id_surat_tugas_plh' => $this->input->post('id_surat_tugas_plh'),
						'id_pegawai' => $this->input->post('id_pegawai'),
						'id_pegawai_berhalangan' => $this->input->post('filter_pegawai'),
						'lokasi_kerja' => $this->input->post('lokasi_kerja'),
						'alasan_plh' => $this->input->post('alasan_plh'),
						'durasi' => $this->input->post('durasi'),
						'tgl_mulai' => $this->input->post('tgl_mulai'),
						'tgl_selesai' => $this->input->post('tgl_selesai'),
						'tembusan' => $tembusan,
						'id_user_created' => $this->session->userdata("id_pegawai"),
						'tanggal_pengajuan' => date('Y-m-d'),
						'date_created' => date('Y-m-d H:i:s')
					);

					if ($this->db->insert('tbl_data_surat_tugas_plh', $in)) {
						header('location:'.base_url().'admin/surat_tugas_plh');
					}
					else {
						$this->session->set_flashdata('msg', 'Gagal membuat surat Tugas PLH.');
						$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/form',$d);
					}
				}
			}
			else {
				header('location:'.base_url().'admin/surat_tugas_plh');
			}
		}
		else {
			header('location:'.base_url());
		}
	}

	public function detail() {
		//echo $this->uri->segment(4);
		$uri_param = $this->uri->segment(4);
		if($uri_param==''){
			$id_pegawai = $this->input->post('id_pegawai');	
		} else {
			$id_pegawai = $uri_param;
		}
		
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Detail Surat Keterangan Tugas PLH';
			$d['menu_open'] = 'kk';
			$d['act'] = 'detail';

			$d['pegawai'] = null;
			$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $id_pegawai]);
			foreach ($q->result() as $p) {
				$d['pegawai'] = $p;
			}

			$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/detail',$d);
		}
		else {
			header('location:'.base_url().'');
		}
	}

	public function cetak($id_surat=0,$id_pegawai=0) {
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_surat!=0) {
			$this->load->library('Pdf');

			$d['surat'] = null;
			$d['header_surat'] = '';
			$d['pegawai'] = null;
			$d['penandatangan'] = null;
			$dt['eselon3'] = null;
			$d['ket_ttd'] = '';
			$d['lokasi_kerja_ttd'] = '';

			//get data surat
			$q = $this->db->get_where('tbl_data_surat_tugas_plh', ['id_surat_tugas_plh' => $id_surat]);
			
			foreach ($q->result() as $p) {
				$d['surat'] = $p;
				if ($p->tgl_mulai =='' || $p->tgl_mulai ==NULL){
					$d['tgl_mulai'] = '';
				} else {
					$d['tgl_mulai'] = $this->func_table->tgl_indonesia($p->tgl_mulai);
				}
				if ($p->tgl_selesai =='' || $p->tgl_selesai ==NULL){
					$d['tgl_selesai'] = '';
				} else {
					$d['tgl_selesai'] = $this->func_table->tgl_indonesia($p->tgl_selesai);
				}
				// echo '<pre>'.print_r($d['surat'],true).'</pre>';exit;

				// $arrKet = ['Sampai dengan saat ini yang bersangkutan belum pernah dikenakan hukuman disiplin, baik tingkat ringan, sedang, dan berat, 
				// berdasarkan Peraturan Pemerintah Nomor 53 Tahun 2010 dan Peraturan Pemerintah Nomor 10 Tahun 1983 jo. Peraturan Pemerintah 
				// Nomor 45 Tahun 1990'];

				if ($p->tembusan!='') {
					if (strpos($p->tembusan,'#|#') !== false) {
						$arr = explode('#|#', $p->tembusan);
					}
					else {
						$arr = [$p->tembusan];
					}

					if (count($arr) > 0) {
						foreach ($arr as $key=>$k) {
							$arrKet[] = $k;
						}
					}
				}
				// echo '<pre>'.print_r($arrKet,true).'</pre>';exit;

				$i = 1; 
				$ket = '<ul>';
				foreach ($arrKet as $key=>$k) {
					if ($i >= 1 && $i < count($arrKet)) $k .= '.';
					else if ($i == count($arrKet)) $k .= '.';

					$ket .= '<li>'.$k.'</li>';
					
					$i++;
				}
				
				$ket .= '</ul>';
				$d['ket'] = $ket;

				//get data pegawai
				$d['pegawai'] = $this->db->query("
					select a.nip, a.nrk, a.nama_pegawai, a.id_status_jabatan, a.id_jabatan, a.lokasi_kerja as id_lokasi_kerja, 
						b.id_nama_jabatan, b.nama_jabatan, b.level_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, 
						d.dinas, e.sub_lokasi_kerja , d.dinas 
					from tbl_data_pegawai a
					left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
					left join tbl_master_golongan c on a.id_golongan = c.id_golongan
					left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja 
					left join tbl_master_sub_lokasi_kerja e on a.seksi = e.id_sub_lokasi_kerja 
					where a.id_pegawai = ".$p->id_pegawai
				)->row();

				$d['pegawai_berhalangan'] = $this->db->query("
					select a.nip, a.nrk, a.nama_pegawai, a.id_status_jabatan, a.id_jabatan, a.lokasi_kerja as id_lokasi_kerja, 
						b.id_nama_jabatan, b.nama_jabatan, b.level_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, 
						d.dinas, e.sub_lokasi_kerja , d.dinas 
					from tbl_data_pegawai a
					left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
					left join tbl_master_golongan c on a.id_golongan = c.id_golongan
					left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja 
					left join tbl_master_sub_lokasi_kerja e on a.seksi = e.id_sub_lokasi_kerja 
					where a.id_pegawai = ".$p->id_pegawai_berhalangan
				)->row();

				$d['ket_ttd'] = 'Kepala Dinas'.'<br />'.'Cipta Karya, Tata Ruang Dan Pertanahan Provinsi Dki Jakarta';
				// echo '<pre>'.print_r($d,true).'</pre>';exit;
				$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/export',$d);
			}
		}
		else {
			header('location:'.base_url());
		}
	}

	public function edit() {
		$id_surat = $this->input->post('id_surat');
		$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
		$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
		$d['instansi'] = $this->config->item('nama_instansi');
		$d['credit'] = $this->config->item('credit_aplikasi');
		$d['alamat'] = $this->config->item('alamat_instansi');
		$d['page_name'] = 'Ubah Surat Keterangan Tugas PLH';
		$d['menu_open'] = 'kk';
		$d['act'] = 'edit';
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_surat!=0)
		{
			$d['pegawai'] = null;
			$d['surat'] = null;
			$d['keterangan'] = null;

			$q = $this->db->get_where("tbl_data_surat_tugas_plh", ['id_surat_tugas_plh' => $id_surat]);
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
				$q = $this->db->get_where("tbl_data_pegawai",['id_pegawai' => $d['surat']->id_pegawai]);
				foreach ($q->result() as $p) {
					$d['pegawai'] = $p;
				}
			}

			//echo '<pre>'.print_r($d,true).'</pre>';exit;
			
			$this->load->view('dashboard_admin/kertas_kerja/surat_tugas_plh/form',$d);
		}
		else
		{
			header('location:'.base_url());
		}
	}

	public function delete($id_surat=0) {
		$surat = null;
		//$page_name = 'Detail Surat Tugas PLH';
		$q = $this->db->get_where("tbl_data_surat_tugas_plh", ['id_surat_tugas_plh' => $id_surat]);
		foreach ($q->result() as $p) {
			$surat = $p;
		}

		if ($surat != null) {
			$this->db->where('id_surat_tugas_plh', $id_surat)->delete('tbl_data_surat_tugas_plh');
			header('location:'.base_url().'admin/surat_tugas_plh/detail/'.$p->id_pegawai);
		}
		else {
			header('location:'.base_url().'admin/surat_tugas_plh');
		}
	}


	public function get_lokasi() {
		$filter_pegawai = $this->input->post('filter_pegawai');
		if($filter_pegawai != '0' || $filter_pegawai != '' || $filter_pegawai != NULL){
			$kond = " AND id_pegawai = '$filter_pegawai'";
		} else {
			$kond = " AND id_pegawai = 'x'";
		}
		$ak = $this->db->query("SELECT p.nama_pegawai, lk.lokasi_kerja
								FROM tbl_data_pegawai AS p
									LEFT JOIN (
										SELECT lokasi_kerja, id_lokasi_kerja FROM tbl_master_lokasi_kerja
									) AS lk ON lk.id_lokasi_kerja = p.lokasi_kerja
								WHERE p.id_pegawai != '--' $kond")->row();
		
		echo $ak->lokasi_kerja;
	}
}

/* End of file surat_tugas_plh.php */
/* Location: ./application/controllers/surat_tugas_plh.php */