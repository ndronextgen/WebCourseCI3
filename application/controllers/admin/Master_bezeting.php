<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_bezeting extends CI_Controller {

	/*
		***	Controller : master_bezeting.php
	*/

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('template');
		$this->load->model('bezeting_model');
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
			$d['page_name'] = 'Master Bezeting';
			$d['menu_open'] = 'master';
			$d['list'] = null;

			// get bezeting data
			$masterBezeting = null;
			$objMasterBezeting = $this->bezeting_model->get_list_bezeting();
			if (count($objMasterBezeting) > 0) {
				foreach ($objMasterBezeting as $k=>$dt) {
					$masterBezeting[$dt['id_status_jabatan']]['id_status_jabatan'] = $dt['id_status_jabatan'];
					$masterBezeting[$dt['id_status_jabatan']]['status_jabatan'] = $dt['status_jabatan'];
					$masterBezeting[$dt['id_status_jabatan']]['data_jabatan'][] = [
						'id_jabatan' => $dt['id_jabatan'],
						'nama_jabatan' => $dt['nama_jabatan'],
						'existing' => $dt['existing'],
						'abk' => $dt['abk'],
						'selisih' => $dt['selisih'],
						'ket' => $dt['ket']
					];
				}
			}

			// get master status jabatan
			$existingBezeting = null;
			$objStatusJabatan = $this->bezeting_model->get_list_status_jabatan();
			if (count($objStatusJabatan) > 0) {
				foreach ($objStatusJabatan as $k=>$sj) {
					$dataJabatan = null;
					$objJabatan = $this->bezeting_model->get_jabatan_by_status_jabatan($sj['id_status_jabatan']);

					if (count($objJabatan) > 0) {
						// struktural
						if ($sj['id_status_jabatan'] == 2) {
							foreach ($objJabatan as $kj=>$dj) {
								$dataJabatan[$kj]['id_jabatan'] = $kj;
								$dataJabatan[$kj]['nama_jabatan'] = $dj['nama_jabatan'];
								$existing = $this->bezeting_model->get_count_pegawai_eselon($dj['nama_jabatan']);
								$abk = 0;
								$selisih = $existing - $abk;

								$dataJabatan[$kj]['existing'] = $existing;
								$dataJabatan[$kj]['abk'] = $abk;
								$dataJabatan[$kj]['selisih'] = $selisih;
								$dataJabatan[$kj]['ket'] = '';
							}
						}
						else {
							foreach ($objJabatan as $kj=>$dj) {
								$dataJabatan[$kj]['id_jabatan'] = $dj['id_nama_jabatan'];
								$dataJabatan[$kj]['nama_jabatan'] = $dj['nama_jabatan'];
								$existing = $this->bezeting_model->get_count_pegawai($dj['id_nama_jabatan']);
								$abk = 0;
								$selisih = $existing - $abk;

								$dataJabatan[$kj]['existing'] = $existing;
								$dataJabatan[$kj]['abk'] = $abk;
								$dataJabatan[$kj]['selisih'] = $selisih;
								$dataJabatan[$kj]['ket'] = '';
							}
						}
					}

					$existingBezeting[$sj['id_status_jabatan']] = [
						'id_status_jabatan' => $sj['id_status_jabatan'],
						'status_jabatan' => $sj['nama_status_jabatan'],
						'data_jabatan' => $dataJabatan
					];
				}
			}

			if ($masterBezeting != null) {
				$cleanBezeting = null;
				if (count($existingBezeting) > 0) {
					foreach ($existingBezeting as $k=>$d1) {
						$cleanBezeting[$d1['id_status_jabatan']]['id_status_jabatan'] = $d1['id_status_jabatan'];
						$cleanBezeting[$d1['id_status_jabatan']]['status_jabatan'] = $d1['status_jabatan'];
						$cleanBezeting[$d1['id_status_jabatan']]['data_jabatan'] = null;

						if (count($d1['data_jabatan']) > 0) {
							foreach ($d1['data_jabatan'] as $d2) {
								$existing = $d2['existing'];
								$abk = 0;
								$selisih = $existing - $abk;
								$ket = '';
								
								$dataJabatanMaster = $masterBezeting[$d1['id_status_jabatan']]['data_jabatan'];
								if (count($dataJabatanMaster) > 0) {
									foreach ($dataJabatanMaster as $jm) {
										if ($jm['id_jabatan'] == $d2['id_jabatan']) {
											$existing = $jm['existing'];
											$abk = $jm['abk'];
											$selisih = $existing - $abk;
											$ket = $jm['ket'];
											break;
										}
									}
								}

								$cleanBezeting[$d1['id_status_jabatan']]['data_jabatan'][] = [
									'id_jabatan' => $d2['id_jabatan'],
									'nama_jabatan' => $d2['nama_jabatan'],
									'existing' => $existing,
									'abk' => $abk,
									'selisih' => $selisih,
									'ket' => $ket
								];
							}
						}
					}

					// insert or update table bezeting
					$this->bezeting_model->insert_update($cleanBezeting);
					$d['list'] = $cleanBezeting;
				}
			}
			else {
				// insert first
				$this->bezeting_model->insert_update($existingBezeting,1);
				$d['list'] = $existingBezeting;
			}
			
			// echo 'master bezeting:';
			// echo '<pre>'.print_r($masterBezeting,true).'</pre>';
			// echo 'existing bezeting:';
			// echo '<pre>'.print_r($existingBezeting,true).'</pre>';
			// echo 'list:';
			// echo '<pre>'.print_r($d['list'],true).'</pre>';
			// echo '<pre>'.print_r($d,true).'</pre>';
			// exit;

			$this->load->view('dashboard_admin/master_bezeting/home',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function edit()
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Master Bezeting';
			$d['menu_open'] = 'master';
			$d['list'] = null;

			// get bezeting data
			$masterBezeting = null;
			$objMasterBezeting = $this->bezeting_model->get_list_bezeting();
			if (count($objMasterBezeting) > 0) {
				foreach ($objMasterBezeting as $k=>$dt) {
					$masterBezeting[$dt['id_status_jabatan']]['id_status_jabatan'] = $dt['id_status_jabatan'];
					$masterBezeting[$dt['id_status_jabatan']]['status_jabatan'] = $dt['status_jabatan'];
					$masterBezeting[$dt['id_status_jabatan']]['data_jabatan'][] = [
						'id_jabatan' => $dt['id_jabatan'],
						'nama_jabatan' => $dt['nama_jabatan'],
						'existing' => $dt['existing'],
						'abk' => $dt['abk'],
						'selisih' => $dt['selisih'],
						'ket' => $dt['ket']
					];
				}
			}

			// get master status jabatan
			$existingBezeting = null;
			$objStatusJabatan = $this->bezeting_model->get_list_status_jabatan();
			if (count($objStatusJabatan) > 0) {
				foreach ($objStatusJabatan as $k=>$sj) {
					$dataJabatan = null;
					$objJabatan = $this->bezeting_model->get_jabatan_by_status_jabatan($sj['id_status_jabatan']);

					if (count($objJabatan) > 0) {
						// struktural
						if ($sj['id_status_jabatan'] == 2) {
							foreach ($objJabatan as $kj=>$dj) {
								$dataJabatan[$kj]['id_jabatan'] = $kj;
								$dataJabatan[$kj]['nama_jabatan'] = $dj['nama_jabatan'];
								$existing = $this->bezeting_model->get_count_pegawai_eselon($dj['nama_jabatan']);
								$abk = 0;
								$selisih = $existing - $abk;

								$dataJabatan[$kj]['existing'] = $existing;
								$dataJabatan[$kj]['abk'] = $abk;
								$dataJabatan[$kj]['selisih'] = $selisih;
								$dataJabatan[$kj]['ket'] = '';
							}
						}
						else {
							foreach ($objJabatan as $kj=>$dj) {
								$dataJabatan[$kj]['id_jabatan'] = $dj['id_nama_jabatan'];
								$dataJabatan[$kj]['nama_jabatan'] = $dj['nama_jabatan'];
								$existing = $this->bezeting_model->get_count_pegawai($dj['id_nama_jabatan']);
								$abk = 0;
								$selisih = $existing - $abk;

								$dataJabatan[$kj]['existing'] = $existing;
								$dataJabatan[$kj]['abk'] = $abk;
								$dataJabatan[$kj]['selisih'] = $selisih;
								$dataJabatan[$kj]['ket'] = '';
							}
						}
					}

					$existingBezeting[$sj['id_status_jabatan']] = [
						'id_status_jabatan' => $sj['id_status_jabatan'],
						'status_jabatan' => $sj['nama_status_jabatan'],
						'data_jabatan' => $dataJabatan
					];
				}
			}

			if ($masterBezeting != null) {
				$cleanBezeting = null;
				if (count($existingBezeting) > 0) {
					foreach ($existingBezeting as $k=>$d1) {
						$cleanBezeting[$d1['id_status_jabatan']]['id_status_jabatan'] = $d1['id_status_jabatan'];
						$cleanBezeting[$d1['id_status_jabatan']]['status_jabatan'] = $d1['status_jabatan'];
						$cleanBezeting[$d1['id_status_jabatan']]['data_jabatan'] = null;

						if (count($d1['data_jabatan']) > 0) {
							foreach ($d1['data_jabatan'] as $d2) {
								$existing = $d2['existing'];
								$abk = 0;
								$selisih = $existing - $abk;
								$ket = '';
								
								$dataJabatanMaster = $masterBezeting[$d1['id_status_jabatan']]['data_jabatan'];
								if (count($dataJabatanMaster) > 0) {
									foreach ($dataJabatanMaster as $jm) {
										if ($jm['id_jabatan'] == $d2['id_jabatan']) {
											$existing = $jm['existing'];
											$abk = $jm['abk'];
											$selisih = $existing - $abk;
											$ket = $jm['ket'];
											break;
										}
									}
								}

								$cleanBezeting[$d1['id_status_jabatan']]['data_jabatan'][] = [
									'id_jabatan' => $d2['id_jabatan'],
									'nama_jabatan' => $d2['nama_jabatan'],
									'existing' => $existing,
									'abk' => $abk,
									'selisih' => $selisih,
									'ket' => $ket
								];
							}
						}
					}

					// insert or update table bezeting
					$this->bezeting_model->insert_update($cleanBezeting);
					$d['list'] = $cleanBezeting;
				}
			}
			else {
				// insert first
				$this->bezeting_model->insert_update($existingBezeting,1);
				$d['list'] = $existingBezeting;
			}

			$this->load->view('dashboard_admin/master_bezeting/edit',$d);
		}
		else
		{
			header('location:'.base_url().'');
		}
	}

	public function simpan() 
	{
		if($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$d['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$d['instansi'] = $this->config->item('nama_instansi');
			$d['credit'] = $this->config->item('credit_aplikasi');
			$d['alamat'] = $this->config->item('alamat_instansi');
			$d['page_name'] = 'Master Bezeting';
			$d['menu_open'] = 'master';
			$d['list'] = null;

			$objUpdBezeting = null;
			$objBezeting = $this->bezeting_model->get_list_bezeting();
			// echo '<pre>'.print_r($objBezeting,true).'</pre>';
			if (count($objBezeting) > 0) {
				foreach ($objBezeting as $bezeting) {
					$abk = $this->input->post("abk-".$bezeting['id_status_jabatan']."-".$bezeting['id_jabatan']);
					$ket = $this->input->post("ket-".$bezeting['id_status_jabatan']."-".$bezeting['id_jabatan']);
					$selisih = $bezeting['existing'] - (int)$abk;
					$updBezeting = $bezeting;
					$updBezeting['abk'] = $abk;
					$updBezeting['selisih'] = $selisih;

					$objUpdBezeting[$bezeting['id_status_jabatan']]['id_status_jabatan'] = $bezeting['id_status_jabatan'];
					$objUpdBezeting[$bezeting['id_status_jabatan']]['status_jabatan'] = $bezeting['status_jabatan'];
					$objUpdBezeting[$bezeting['id_status_jabatan']]['data_jabatan'][] = [
						'id_jabatan' => $bezeting['id_jabatan'],
						'nama_jabatan' => $bezeting['nama_jabatan'],
						'existing' => $bezeting['existing'],
						'abk' => $abk,
						'selisih' => $selisih,
						'ket' => $ket
					];
				}
			}

			// echo '<pre>'.print_r($objUpdBezeting,true).'</pre>';exit;
			if ($objUpdBezeting != null) {
				$this->bezeting_model->insert_update($objUpdBezeting);
			}
			else {
				//gagal simpan bezeting
			}
			// echo '<pre>'.print_r($objBezeting,true).'</pre>';exit;

			redirect('admin/master_bezeting');
		}
		else
		{
			header('location:'.base_url().'');
		}
	}
}

/* End of file master_bezeting.php */
/* Location: ./application/controllers/master_bezeting.php */