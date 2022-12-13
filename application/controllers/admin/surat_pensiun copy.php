<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_pensiun extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');    /***** LOADING HELPER TO AVOID PHP ERROR ****/
        $this->load->helper('template');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Surat Usulan Calon Penerima Pensiun';
			$d['menu_open'] = 'kk';

			$d['status'] = $this->input->post('id_status_surat');

			$arrStatus = array();
			$arrStatusSelected = array();
			$status = $this->db->get('tbl_status_surat')->result_array();
			if (count($status) > 0) {
				foreach ($status as $s) {
					$arrStatus[$s['id_status']] = $s['nama_status'];

					$arrStatusSelected[$s['id_status']] = '';
					if ($d['status'] == $s['id_status']) {
						$arrStatusSelected[$s['id_status']] = 'selected=selected';
					}
				}
			}

			$d['arrStatus'] = $arrStatus;
			$d['arrStatusSelected'] = $arrStatusSelected;

			$this->load->view('dashboard_admin/kertas_kerja/surat_pensiun/home',$d); 
		}
		else {
			header('location:'.base_url().'');
		}
	}

	public function add() {
		$act = $this->input->post('act');

		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Tambah Surat Usulan Calon Penerima Pensiun';
			$d['menu_open'] = 'kk';
			$d['act'] = $act;

			$pegawai = null;
			$ids_pegawai_selected = array();
			$cond = '';
			if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
				$cond .= ' and lokasi_kerja='.$this->session->userdata('lokasi_kerja');
			}
			$q = $this->db->query("
				select id_pegawai, nama_pegawai 
				from tbl_data_pegawai 
				where 1 ".$cond." 
				order by nama_pegawai asc
			");
			$i=0;
			foreach ($q->result() as $p) {
				$pegawai[$i]['id_pegawai'] = $p->id_pegawai;
				$pegawai[$i]['nama_pegawai'] = $p->nama_pegawai;
				$ids_pegawai_selected[$p->id_pegawai] = '';
				$i++;
			}
			$d['pegawai'] = $pegawai;

			$ids_pegawai = '';
			$d['ids_pegawai'] = $ids_pegawai;
			$d['ids_pegawai_selected'] = $ids_pegawai_selected;
			
			$this->load->view('dashboard_admin/kertas_kerja/surat_pensiun/form',$d);
		}
		else
		{
			header('location:'.base_url());
		}
	}
	
	public function detail() {
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
			$id_surat = $this->input->post('id_surat');
			
			if ($id_surat != 0) {
				$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$d['instansi'] = $this->config->item('nama_instansi');
				$d['credit'] = $this->config->item('credit_aplikasi');
				$d['alamat'] = $this->config->item('alamat_instansi');
				$d['page_name'] = 'Detail Surat Usulan Calon Penerima Pensiun';
				$d['menu_open'] = 'kk';
				$d['act'] = 'detail';

				$d['surat'] = null;
				$d['status_surat'] = null;
				$q = $this->db->query("
					select a.*, b.nama_status as status_surat 
					from tbl_data_surat_pensiun a 
					left join tbl_status_surat b on a.id_status_srt = b.id_status
					where a.id_surat_pensiun=".$id_surat."
				"
				);
				
				foreach ($q->result() as $p) {
					$d['surat'] = $p;
				}

				$pegawai = null;
				$ids_pegawai_selected = array();
				$cond = '';
				if ($this->session->userdata('lokasi_kerja') != null && $this->session->userdata('lokasi_kerja') != 0) {
					$cond .= ' and lokasi_kerja='.$this->session->userdata('lokasi_kerja');
				}
				$q = $this->db->query("
					select id_pegawai, nama_pegawai 
					from tbl_data_pegawai 
					where 1 ".$cond." 
					order by nama_pegawai asc
				");
				$i=0;
				foreach ($q->result() as $p) {
					$pegawai[$i]['id_pegawai'] = $p->id_pegawai;
					$pegawai[$i]['nama_pegawai'] = $p->nama_pegawai;
					$ids_pegawai_selected[$p->id_pegawai] = '';
					$i++;
				}
				$d['pegawai'] = $pegawai;

				$ids_pegawai = '';
				$q = $this->db->query("
					select id_pegawai 
					from tbl_data_surat_pensiun_dt 
					where id_surat_pensiun=".$id_surat."
				"
				);
				$i = 0;
				foreach ($q->result() as $p) {
					if ($i > 0) $ids_pegawai .= ',';
					$ids_pegawai .= $p->id_pegawai;
					$ids_pegawai_arr[] = $p->id_pegawai;
					$ids_pegawai_selected[$p->id_pegawai] = 'selected=selected';

					$i++;
				}
				$d['ids_pegawai'] = $ids_pegawai;
				$d['ids_pegawai_selected'] = $ids_pegawai_selected;

				//history
				$history = null;
				$q = $this->db->query("
					select a.id_status_srt, a.created_at, a.created_by, b.nama_lengkap   
					from tbl_history_surat_pensiun a 
					left join tbl_user_login b on a.created_by = b.id_user_login  
					where a.id_surat_pensiun=".$id_surat
				);
				
				$i=0;
				foreach ($q->result() as $h) {
					$history[$h->id_status_srt]['id_status_srt'] = $h->id_status_srt;
					$history[$h->id_status_srt]['created_at'] = $h->created_at;
					$history[$h->id_status_srt]['id_user'] = $h->created_by;
					$history[$h->id_status_srt]['created_by'] = $h->nama_lengkap;
				}
				
				//status surat
				if ($d['surat']->id_status_srt == 1) {
					//ditolak
					$q = $this->db->query("
					select id_status,nama_status as status_srt, style, '' as active, '' as created_at, '' as id_user, '' as created_by  
					from tbl_status_surat 
					where id_status != 3
					order by sort asc"
					);
				}
				else {
					$q = $this->db->query("
					select id_status,nama_status as status_srt, style, '0' as active, '' as created_at, '' as id_user, '' as created_by 
					from tbl_status_surat 
					where id_status != 1
					order by sort asc"
					);
				}
				
				foreach ($q->result() as $hm) {
					if ($history!=null) {
						if (array_key_exists($hm->id_status, $history)) {
							$hm->active = 1;
							$hm->created_at = $history[$hm->id_status]['created_at'];
							$hm->id_user = $history[$hm->id_status]['id_user'];
							$hm->created_by = $history[$hm->id_status]['created_by'];
						}
					}
					
					$d['status_surat'][] = $hm;
				}
				echo '<pre>'.print_r($d,true).'</pre>';exit;
				$this->load->view('dashboard_admin/kertas_kerja/surat_pensiun/detail',$d);
			}
			else {
				header('location:'.base_url());	
			}
		}
		else {
			header('location:'.base_url());
		}
	}
	
	public function formSimpan() {
		$status = false;
		$message = '';

		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
			$ids_pegawai = $this->input->post('ids_pegawai');
			$keterangan = $this->input->post('keterangan');
			
			if ($ids_pegawai != '') {
				if ($keterangan != '') {
					//save add
					$in = array(
						'tanggal_pengajuan' => date('Y-m-d'),
						'keterangan' => $keterangan,
						'is_download' => "0",
						'id_status_srt' => 3,
						'id_user_created' => $this->session->userdata("id_user"),
						'date_created' => date('Y-m-d H:i:s'),
						'tgl_proses' => date('Y-m-d H:i:s'),
						'id_user_proses' => $this->session->userdata("id_user"),
					);

					if ($this->db->insert('tbl_data_surat_pensiun', $in)) {
						$id_surat = $this->db->insert_id();
						
						//insert to detail
						if (strpos($ids_pegawai,',') !== false) {
							$ids_pegawai_arr = explode(',',$ids_pegawai);
							foreach ($ids_pegawai_arr as $id) {
								$detail['id_surat_pensiun'] = $id_surat;
								$detail['id_pegawai'] = $id;
								$detail['created_at'] = date('Y-m-d H:i:s');
								$this->db->insert('tbl_data_surat_pensiun_dt',$detail);
							}
						}
						else {
							$detail['id_surat_pensiun'] = $id_surat;
							$detail['id_pegawai'] = $ids_pegawai;
							$detail['created_at'] = date('Y-m-d H:i:s');
							$this->db->insert('tbl_data_surat_pensiun_dt',$detail);
						}

						//insert to history
						$hist['id_surat_pensiun'] = $id_surat;
						$hist['created_by'] = $this->session->userdata("id_user");
						$hist['created_at'] = date('Y-m-d H:i:s');
						$hist['id_status_srt'] = 3;

						if ($this->db->insert('tbl_history_surat_pensiun',$hist)) {
							$id_surat_history = $this->db->insert_id();

							//insert to history detail
							if (strpos(',',$ids_pegawai) !== false) {
								$ids_pegawai_arr = explode(',',$ids_pegawai);
								foreach ($ids_pegawai_arr as $id) {
									$detail_hist['id_surat_pensiun_hist'] = $id_surat_history;
									$detail_hist['id_pegawai'] = $id;
									$detail_hist['created_at'] = date('Y-m-d H:i:s');
									$this->db->insert('tbl_history_surat_pensiun_dt',$detail_hist);
								}
							}
							else {
								$detail_hist['id_surat_pensiun_hist'] = $id_surat_history;
								$detail_hist['id_pegawai'] = $ids_pegawai;
								$detail_hist['created_at'] = date('Y-m-d H:i:s');
								$this->db->insert('tbl_history_surat_pensiun_dt',$detail_hist);
							}

							$status = true;
						}
						else {
							$this->db->where('id_surat_pensiun', $id_surat)->delete('tbl_data_surat_pensiun');

							$message = 'Gagal membuat Surat Usulan Calon Penerima Pensiun.';
						}
					}
					else {
						$message = 'Gagal membuat Surat Usulan Calon Penerima Pensiun.';
					}
				}
				else {
					$message = 'Data tidak valid. Silakan masukkan Keterangan terlebih dahulu.';
				}
			}
			else {
				$message = 'Data tidak valid. Silakan pilih pegawai terlebih dahulu.';
			}
		}
		else {
			$message = 'Invalid session.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}
	public function updateDownload() {
		$status = false;
		$message = '';

		$id_surat = $this->input->post('id_surat');
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_surat != 0) {
			$q = $this->db->get_where('tbl_data_surat_pensiun', ['id_surat_pensiun' => $id_surat]);
			foreach ($q->result() as $p) {
				//update is_download
				if ($this->db->update('tbl_data_surat_pensiun',['is_download' => ((int)$p->is_download + 1)],['id_surat_pensiun' => $id_surat])) {
					$status = true;
				}
				else {
					$message = 'Gagal update data.';
				}
			}
		}
		else {
			$message = 'Request failed.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function download_surat($id_surat=0) {
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator") {
			if ($id_surat != 0) {
				$this->load->library('Pdf');
				$this->load->helper('date_convert');
				
				$d['surat'] = null;
				$d['header_surat1'] = 'PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA<br />DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN';
				$d['header_surat2'] = '';
				$d['header_surat3'] = '';
				$d['kodepos'] = '';
				$d['pegawai'] = null;
				$d['penandatangan'] = null;
				$d['ket_ttd'] = '';
				$d['lokasi_kerja_ttd'] = '';
				$d['hal'] = '';
				$d['kepada'] = 'Kepada<br />Yth. ';
				$d['signature'] = '';
				$d['nama_jabatan'] = '';

				//get data surat
				$q = $this->db->get_where('tbl_data_surat_pensiun', ['id_surat_pensiun' => $id_surat]);
				foreach ($q->result() as $p) {
					$d['surat'] = $p;

					//update is_download
					if ($this->db->update('tbl_data_surat_pensiun',['is_download' => ((int)$p->is_download + 1)],['id_surat_pensiun' => $id_surat])) {

						//get data pegawai
						$q2 = $this->db->query("
							select a.id_pegawai, b.nip, b.nrk, b.nama_pegawai, b.id_status_jabatan, b.id_jabatan, b.tempat_lahir, b.tanggal_lahir, 
								b.lokasi_kerja as id_lokasi_kerja, c.nama_jabatan, d.uraian as pangkat, d.golongan, 
								e.lokasi_kerja, e.alamat as alamat_lokasi_kerja, e.telp as telp_lokasi_kerja, e.fax as fax_lokasi_kerja, 
								e.kodepos as kodepos_lokasi_kerja, e.dinas, f.sub_lokasi_kerja 
							from tbl_data_surat_pensiun_dt a 
							left join tbl_data_pegawai b on b.id_pegawai = a.id_pegawai 
							left join tbl_master_nama_jabatan c on b.id_jabatan = c.id_nama_jabatan
							left join tbl_master_golongan d on b.id_golongan = d.id_golongan
							left join tbl_master_lokasi_kerja e on b.lokasi_kerja = e.id_lokasi_kerja 
							left join tbl_master_sub_lokasi_kerja f on b.seksi = f.id_sub_lokasi_kerja 
							where a.id_surat_pensiun = ".$id_surat." 
							order by b.nama_pegawai asc
						");

						$pegawai = array();
						$i = 0;
						foreach ($q2->result() as $p2) {
							$pegawai[$i]['nama_jabatan'] = $p2->nama_jabatan;
							$pegawai[$i]['kepada'] = '';

							if ($p2->id_status_jabatan != 2) {
								$pegawai[$i]['nama_jabatan'] = 'Staf '.ucwords(strtolower($p2->sub_lokasi_kerja));
							}
							else {
								$filter = str_replace('kepala', '', strtolower($p2->nama_jabatan));
								$pegawai[$i]['nama_jabatan'] = 'Kepala '.ucwords(str_replace($filter,'',strtolower($p2->sub_lokasi_kerja)));
							}

							$pegawai[$i]['pegawai'] = $p2;
							$pegawai[$i]['header_surat2'] = strtoupper(strtolower($p2->lokasi_kerja));
							$pegawai[$i]['header_surat3'] = $p2->alamat_lokasi_kerja.' Telp. '.$p2->telp_lokasi_kerja.' Fax. '.$p2->fax_lokasi_kerja.'<br />JAKARTA';
							$pegawai[$i]['kodepos'] = $p2->kodepos_lokasi_kerja;
							$pegawai[$i]['hal'] = 'Surat Usulan Calon Penerima Pensiun a/n. '.$p2->nama_pegawai;
							
							//get atasan 
							if ($p2->dinas == 1) {
								//dinas
								//yg bertanda tangan sekertaris, atas nama kepala dinas
								$q3 = $this->db->query("
									select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 2
								");
								foreach ($q3->result() as $p3) {
									$pegawai[$i]['penandatangan'] = $p3;
								}

								//get kadis
								$q4 = $this->db->query("
									select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja 
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.id_jabatan = 1
								");

								foreach ($q4->result() as $p4) {
									$pegawai[$i]['eselon3'] = $p4;
								}

								$jabatan_ttd = ucwords(strtolower($pegawai[$i]['penandatangan']->nama_jabatan));
								$filter_jabatan_ttd = trim(str_replace('Kepala','',$jabatan_ttd));
								$lokasi_ttd = trim(ucwords(strtolower($pegawai[$i]['eselon3']->lokasi_kerja)));
								$lokasi_ttd = trim(str_replace($filter_jabatan_ttd,'',$lokasi_ttd));
								$pegawai[$i]['ket_ttd'] = 'a.n. '.$jabatan_ttd.'<br />'.$lokasi_ttd.'<br />';
								$pegawai[$i]['ket_ttd'] .= trim(str_replace('Dinas','',ucwords(strtolower($pegawai[$i]['penandatangan']->nama_jabatan)))).',';
							}
							else {
								//upt & sudin
								//yg bertanda tangan eselon 3

								//get penandatangan
								$q3 = $this->db->query("
									select a.nip, a.nrk, a.nama_pegawai, b.nama_jabatan, c.uraian as pangkat, c.golongan, d.lokasi_kerja, a.signature 
									from tbl_data_pegawai a
									left join tbl_master_nama_jabatan b on a.id_jabatan = b.id_nama_jabatan
									left join tbl_master_golongan c on a.id_golongan = c.id_golongan
									left join tbl_master_lokasi_kerja d on a.lokasi_kerja = d.id_lokasi_kerja
									where a.lokasi_kerja = ".$p2->id_lokasi_kerja."
											and a.id_eselon in (27,28)
								");
								foreach ($q3->result() as $p3) {
									$pegawai[$i]['penandatangan'] = $p3;
									$pegawai[$i]['ket_ttd'] = trim(str_replace('Suku','',str_replace('Dinas','',ucwords(strtolower($pegawai[$i]['penandatangan']->nama_jabatan)))));
									$pegawai[$i]['ket_ttd'] .= ' '.ucwords(strtolower($pegawai[$i]['penandatangan']->lokasi_kerja));

									if ($p3->signature != '') {
										//khusus penandatangan bayu aji
										$pegawai[$i]['signature'] = base_url().'asset/signature/'.$p3->signature;
									}
								}
							}

							//get kepada
							//untuk dinas dan Upt : Kepala Badan Kepegawaian Daerah Provinsi DKI Jakarta
							//untuk sudin : Kepala Suku Badan Kepegawaian Kota Administrasi xx
							$objKepada = $this->db->query("select description from tbl_master_kepada where id_lokasi_kerja=".$p2->id_lokasi_kerja);
							foreach ($objKepada->result() as $kpd) {
								$pegawai[$i]['kepada'] .= 'Kepada Yth. '.$kpd->description.'<br />di<br />Jakarta';
							}

							$i++;
						}

						$d['pegawai'] = $pegawai;

						$this->load->view('dashboard_admin/kertas_kerja/surat_pensiun/export',$d);
					}
					else {
						echo 'Request tidak valid.';
					}
				}
			}
			else {
				echo 'Request tidak valid.';
			}
		}
		else {
			echo 'Request tidak valid.';
		}
	}

	public function processSave() {
		$status = false;
		$message = '';

		$id_surat = $this->input->post('id_surat');
		$dec = $this->input->post('dec');
		$ket = $this->input->post('ket');

		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_surat != 0) {
			$surat = null;
			$qOldSurat = $this->db->get_where('tbl_data_surat_pensiun', ['id_surat_pensiun' => $id_surat]);
			foreach ($qOldSurat->result() as $s) {
				$surat = $s;
			}

			if ($surat != null) {
				//proses update 
				$in = array(
					'id_status_srt' => $dec,
					'keterangan_ditolak' => $ket,
					'tgl_proses' => date('Y-m-d H:i:s'),
					'id_user_proses' => $this->session->userdata("id_user")
				);
				
				if ($this->db->update('tbl_data_surat_pensiun', $in, ['id_surat_pensiun' => $id_surat])) {
					//insert history
					$hist_srt['id_surat_pensiun'] = $id_surat;
					$hist_srt['created_at'] = date("Y-m-d H:i:s");
					$hist_srt['created_by'] = $this->session->userdata("id_user");
					$hist_srt['id_status_srt'] = $dec;

					if ($this->db->insert('tbl_history_surat_pensiun', $hist_srt)) {
						$id_surat_hist = $this->db->insert_id();
						//insert history detail
						$q = $this->db->query("select * from tbl_data_surat_pensiun_dt where id_surat_pensiun=".$id_surat);
						
						foreach ($q->result() as $p) {
							$detail_hist['id_surat_pensiun_hist'] = $id_surat_hist;
							$detail_hist['id_pegawai'] = $p->id_pegawai;
							$detail_hist['created_at'] = date('Y-m-d H:i:s');
							$this->db->insert('tbl_history_surat_pensiun_dt',$detail_hist);
						}

						$status = true;
					}
					else {
						$message = 'Gagal menyimpan data.';
					}
				}
				else {
					$message = 'Gagal menyimpan data.';
				}
			}
			else {
				$message = 'Data tidak valid.';
			}
		}
		else {
			$message = 'Request tidak valid.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function processUpload() {
		$status = false;
		$message = false;

		$id_surat = $this->input->post('id_surat');
		$file = $this->input->post('file');

		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator" && $id_surat!=0 && $file != '') {
			$file = $this->input->post('file');
			$context = $file['context'];
			$filename_ori = $file['file_name'];
			@list($type, $file_data) = explode(';', $context);
			@list(,$file_data) = explode(',', $file_data);

			$data_type = explode('.',$filename_ori);
			$data_type = $data_type[count($data_type) - 1];
			$filename = md5(microtime()).'.'.$data_type;
			$file_size = strlen(base64_decode($file_data));
			
			//get file name old
			$qOldSurat = $this->db->get_where('tbl_data_surat_pensiun', ['id_surat_pensiun' => $id_surat]);
			foreach ($qOldSurat->result() as $s) {
				$surat = $s;
				if ($s->file_name!='') {
					$file_old = "asset/kertas_kerja/surat_pensiun/".$s->file_name;
					if (file_exists($file_old)) {
						unlink($file_old);
					}
				}
			}

			$path = "./asset/kertas_kerja/surat_pensiun/";
			if (file_put_contents($path.'/'.$filename,base64_decode($file_data))) {
				$upd = [
					'id_status_srt' => 3,
					'file_name' => $filename,
					'file_name_ori' => $filename_ori
				];
	
				if ($this->db->update('tbl_data_surat_pensiun', $upd, ['id_surat_pensiun' => $id_surat])) {
					//insert history
					$hist_srt['id_surat_pensiun'] = $id_surat;
					$hist_srt['created_at'] = date("Y-m-d H:i:s");
					$hist_srt['created_by'] = $this->session->userdata("id_user");
					$hist_srt['id_status_srt'] = 3;	//selesai
	
					if ($this->db->insert('tbl_history_surat_pensiun', $hist_srt)) {
						$status = true;
					}
					else {
						$message = 'Gagal simpan history data.';

						$upd = [
							'id_status_srt' => $surat->id_status_srt,
							'file_name' => $surat->file_name,
							'file_name_ori' => $surat->file_name_ori
						];
						$this->db->update('tbl_data_surat_pensiun', $upd, ['id_surat_pensiun' => $id_surat]);

						$file_old = "asset/kertas_kerja/surat_pensiun/".$filename;
						if (file_exists($file_old)) {
							unlink($file_old);
						}
					}
				}
				else {
					$message = 'Gagal update data.';

					$file_old = "asset/kertas_kerja/surat_pensiun/".$filename;
					if (file_exists($file_old)) {
						unlink($file_old);
					}
				}
			}
			else {
				$message = 'Gagal menyimpan file : '.$filename_ori;
			}
		}
		else {
			$message = 'Request tidak valid.';
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		echo json_encode($result);
	}

	public function download_surat_finished($id_surat = 0) {
		if ($this->session->userdata('logged_in')!="" && $id_surat!=0) {
			//get data surat
			$q = $this->db->get_where('tbl_data_surat_pensiun', ['id_surat_pensiun' => $id_surat]);
			foreach ($q->result() as $p) {
				$path_file = file_get_contents('asset/kertas_kerja/surat_pensiun/'.$p->file_name);
				force_download($p->file_name_ori, $path_file);
			}
		}
		else {
			echo 'Gagal download file.';
		}
	}

	public function delete() {
		$status = false;
		$message = false;

		$id_surat = $this->input->post('id_surat');
		$surat = null;
		$q = $this->db->get_where("tbl_data_surat_pensiun", ['id_surat_pensiun' => $id_surat]);
		foreach ($q->result() as $p) {
			$surat = $p;
		}

		if ($surat != null) {
			//delete history
			if ($this->db->where('id_surat_pensiun', $id_surat)->delete('tbl_history_surat_pensiun')) {
				if ($this->db->where('id_surat_pensiun', $id_surat)->delete('tbl_data_surat_pensiun'))	 {
					$status = true;

					//delete file 
					if ($surat->file_name != '') {
						$file_old = "asset/kertas_kerja/surat_pensiun/".$surat->file_name;
						if (file_exists($file_old)) {
							unlink($file_old);
						}
					}
				}
				else {
					$message = 'Hapus data gagal.';
				}
			}
			else {
				$message = 'Hapus data gagal.';
			}
		}
		else {
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