<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dataprofilpegawai extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function get() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->get('key');
		
		if ($apiKey == $key) {
			$status = true;

			$data = $this->db->query("SELECT 
                                            a.nama_pegawai, 
											id_jabatan,level_jabatan,
                                            nama_jabatan as jabatan, 
                                            lok.lokasi_kerja as satuan_unit_kerja 
                                        FROM tbl_data_pegawai as a 
                                        LEFT JOIN (
                                            SELECT id_nama_jabatan, level_jabatan, nama_jabatan  FROM tbl_master_nama_jabatan
                                        ) AS jab ON a.id_jabatan = jab.id_nama_jabatan
                                        
                                        LEFT JOIN (
                                            SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
                                        ) AS lok ON a.lokasi_kerja = lok.id_lokasi_kerja
                                        WHERE a.id_status_jabatan = '2' AND a.status_pegawai != '1' AND a.id_jabatan != '0'
                                        ORDER BY level_jabatan, a.id_jabatan ASC
                                    ")->result();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];

		// $json = json_encode($result, JSON_PRETTY_PRINT);
		// printf("<pre>%s</pre>", $json);
		
		echo json_encode($result);
	}

	public function getlevel() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->get('key');
		
		if ($apiKey == $key) {
			$status = true;

			$data = $this->db->query("SELECT 
                                            a.nama_pegawai, 
											id_jabatan,level_jabatan,
                                            nama_jabatan as jabatan, 
                                            lok.lokasi_kerja as satuan_unit_kerja 
                                        FROM tbl_data_pegawai as a 
                                        LEFT JOIN (
                                            SELECT id_nama_jabatan, level_jabatan, nama_jabatan  FROM tbl_master_nama_jabatan
                                        ) AS jab ON a.id_jabatan = jab.id_nama_jabatan
                                        
                                        LEFT JOIN (
                                            SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
                                        ) AS lok ON a.lokasi_kerja = lok.id_lokasi_kerja
                                        WHERE a.id_status_jabatan = '2' AND a.status_pegawai = '5' AND a.id_jabatan != '0' AND level_jabatan = '2'
                                        ORDER BY level_jabatan, a.id_jabatan ASC
                                    ")->result();
			foreach ($data as $key ) {
				$this->db->query("SELECT 
                                            a.nama_pegawai, 
											id_jabatan,level_jabatan, id_jabatan_atasan,
                                            nama_jabatan as jabatan, 
                                            lok.lokasi_kerja as satuan_unit_kerja 
                                        FROM tbl_data_pegawai as a 
                                        LEFT JOIN (
                                            SELECT id_nama_jabatan, level_jabatan, id_jabatan_atasan, nama_jabatan  FROM tbl_master_nama_jabatan
                                        ) AS jab ON a.id_jabatan = jab.id_nama_jabatan
                                        
                                        LEFT JOIN (
                                            SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
                                        ) AS lok ON a.lokasi_kerja = lok.id_lokasi_kerja
                                        WHERE a.id_status_jabatan = '2' AND a.status_pegawai = '5' AND a.id_jabatan != '0' AND level_jabatan = '3' AND id_jabatan_atasan = '$key->id_jabatan' 
                                        ORDER BY level_jabatan, a.id_jabatan ASC")->result();
			}
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];

		$json = json_encode($result, JSON_PRETTY_PRINT);
		printf("<pre>%s</pre>", $json);
		
		//echo json_encode($result);
	}



	function getPegawaiByIdJabatan($id) {
		$this->db->from('tbl_data_pegawai');
		$this->db->where('id_jabatan', $id);
		return $this->db->get()->result();
	}

	function getJabatanRecursive_l4($parent=4,  $level=4, $lokasi) {
		$array 	 = [];
		$Query_L1 = $this->db->query("SELECT 
											a.nama_pegawai, a.nip, a.nrk, id_status_jabatan, id_jabatan,level_jabatan, id_nama_jabatan,id_jabatan_atasan,a.lokasi_kerja,
											nama_jabatan as jabatan,
											lok.lokasi_kerja as satuan_unit_kerja
										FROM tbl_data_pegawai as a
										LEFT JOIN (
												SELECT id_nama_jabatan, level_jabatan, nama_jabatan,id_jabatan_atasan  FROM tbl_master_nama_jabatan
												WHERE Aktif = '1'
										) AS jab ON a.id_jabatan = jab.id_nama_jabatan

										LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
										) AS lok ON a.lokasi_kerja = lok.id_lokasi_kerja
										WHERE 
										a.id_status_jabatan = '2' AND a.status_pegawai != '1' AND a.id_jabatan != '0' AND level_jabatan = '$level' AND id_jabatan_atasan = '$parent'
										AND a.lokasi_kerja = '$lokasi' AND nama_jabatan !='Kepala Sektor Dinas Cipta Karya Tata Ruang dan Pertanahan Kecamatan'
										ORDER BY level_jabatan, a.id_jabatan ASC")->result();

		if ($Query_L1) {
			$i = 0;
			foreach ($Query_L1 as $row) {
				
				$array[$i] = [
					'id_jabatan' => $row->id_nama_jabatan,
					'jabatan' => $row->jabatan,
					'nama' => $row->nama_pegawai,
					'nip' => $row->nip,
					'nrk' => $row->nrk,
					'id_status_jabatan' => $row->id_status_jabatan,
					'level_jabatan' => $row->level_jabatan,
					'id_jabatan_atasan' => $row->id_jabatan_atasan,
					'satuan_unit_kerja' => $row->satuan_unit_kerja,
					'childs' => null
				];
				$i++;
			}
		}

		return $array;
	}


	function getJabatanRecursive_l3($parent=0,  $level=3) {
		$array 	 = [];
		$Query_L1 = $this->db->query("SELECT 
											a.nama_pegawai, a.nip, a.nrk, id_status_jabatan, id_jabatan,level_jabatan, id_nama_jabatan,id_jabatan_atasan,a.lokasi_kerja,
											nama_jabatan as jabatan_ext,
											lok.lokasi_kerja as satuan_unit_kerja,
											if(nama_jabatan='Kepala Suku Dinas', 
											 CONCAT(UCASE(LEFT(concat('Kepala ',lok.lokasi_kerja), 1)), LCASE(SUBSTRING(concat('Kepala ',lok.lokasi_kerja), 2)))
											 
											, nama_jabatan) as jabatan
										FROM tbl_data_pegawai as a
										LEFT JOIN (
												SELECT id_nama_jabatan, level_jabatan, nama_jabatan,id_jabatan_atasan  FROM tbl_master_nama_jabatan
												WHERE Aktif = '1'
										) AS jab ON a.id_jabatan = jab.id_nama_jabatan

										LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
										) AS lok ON a.lokasi_kerja = lok.id_lokasi_kerja
										WHERE 
										a.id_status_jabatan = '2' AND a.status_pegawai != '1' AND a.id_jabatan != '0' AND level_jabatan = '$level' AND id_jabatan_atasan = '$parent'
										ORDER BY level_jabatan, a.id_jabatan ASC")->result();

		if ($Query_L1) {
			$i = 0;
			foreach ($Query_L1 as $row) {
				
				$array[$i] = [
					'id_jabatan' => $row->id_nama_jabatan,
					'jabatan' => $row->jabatan,
					'nama' => $row->nama_pegawai,
					'nip' => $row->nip,
					'nrk' => $row->nrk,
					'id_status_jabatan' => $row->id_status_jabatan,
					'level_jabatan' => $row->level_jabatan,
					'id_jabatan_atasan' => $row->id_jabatan_atasan,
					'satuan_unit_kerja' => $row->satuan_unit_kerja,
					'childs' => null
				];

				//check if have child
				$this->db->from('tbl_master_nama_jabatan');
				$this->db->where('id_status_jabatan',2);
				$this->db->where('Aktif',1);
				$this->db->where('id_jabatan_atasan',$row->id_nama_jabatan);
				$this->db->where('nama_jabatan !=','-');
				$this->db->order_by('id_jabatan_atasan','asc');
				$countChild = $this->db->get()->num_rows();
				if ($countChild > 0) {
					//get child recursive
					$array[$i]['childs'] = $this->getJabatanRecursive_l4($row->id_nama_jabatan,4, $row->lokasi_kerja);
				}

				
				$i++;
			}
		}

		return $array;
	}

	function getJabatanRecursive($parent=0,  $level=2) {
		$array 	 = [];
		$Query_L1 = $this->db->query("SELECT 
											a.nama_pegawai, a.nip, a.nrk, id_status_jabatan, id_jabatan,level_jabatan, id_nama_jabatan,id_jabatan_atasan,
											nama_jabatan as jabatan,
											lok.lokasi_kerja as satuan_unit_kerja
										FROM tbl_data_pegawai as a
										LEFT JOIN (
												SELECT id_nama_jabatan, level_jabatan, nama_jabatan,id_jabatan_atasan  
												FROM tbl_master_nama_jabatan
												WHERE Aktif = '1'
										) AS jab ON a.id_jabatan = jab.id_nama_jabatan

										LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
										) AS lok ON a.lokasi_kerja = lok.id_lokasi_kerja
										WHERE 
										a.id_status_jabatan = '2' AND a.status_pegawai != '1' AND a.id_jabatan != '0' AND level_jabatan = '$level' AND id_jabatan_atasan = '$parent'
										ORDER BY level_jabatan, a.id_jabatan ASC")->result();

		if ($Query_L1) {
			$i = 0;
			foreach ($Query_L1 as $row) {
				
				$array[$i] = [
					'id_jabatan' => $row->id_nama_jabatan,
					'jabatan' => $row->jabatan,
					'nama' => $row->nama_pegawai,
					'nip' => $row->nip,
					'nrk' => $row->nrk,
					'id_status_jabatan' => $row->id_status_jabatan,
					'level_jabatan' => $row->level_jabatan,
					'id_jabatan_atasan' => $row->id_jabatan_atasan,
					'satuan_unit_kerja' => $row->satuan_unit_kerja,
					'childs' => null
				];

				//check if have child
				$this->db->from('tbl_master_nama_jabatan');
				$this->db->where('id_status_jabatan',2);
				$this->db->where('Aktif',1);
				$this->db->where('id_jabatan_atasan',$row->id_nama_jabatan);
				$this->db->where('nama_jabatan !=','-');
				$this->db->order_by('id_jabatan_atasan','asc');
				$countChild = $this->db->get()->num_rows();
				if ($countChild > 0) {
					//get child recursive
					$array[$i]['childs'] = $this->getJabatanRecursive_l3($row->id_nama_jabatan,3);
				}


				$i++;
			}
		}

		return $array;
	}

	public function getStruktur() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->get('key');
		
		if ($apiKey == $key) {
			$status = true;

			$data = $this->getJabatanRecursive(0,2);
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		$json = json_encode($result, JSON_PRETTY_PRINT);
		printf("<pre>%s</pre>", $json);
	}



}