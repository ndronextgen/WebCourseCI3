<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	
	public function get() {
		$status = false;
		$message = '';
		$data = [];

		$nrk = $this->input->post('nrk');
		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->post('key');
		
		if ($apiKey == $key) {
			$status = true;
			$cond = '';
			
			if ($nrk != '') {
				$cond = "where a.nrk='".$nrk."'";
			}

			$q_old = "
				select 	a.id_pegawai,a.nip,a.nrk,a.nama_pegawai,a.email,a.telepon,a.tempat_lahir,
					a.tanggal_lahir,a.jenis_kelamin,a.agama,a.usia,a.status_pegawai,a.masa_kerja,
					a.tanggal_pengangkatan_cpns,a.alamat,a.kode_kelurahan,a.nama_kelurahan,
					a.kode_kecamatan,a.nama_kecamatan,a.kode_kabupaten,a.nama_kabupaten,a.kode_provinsi,
					a.nama_provinsi,a.alamat_ktp,a.kode_kelurahan_ktp,a.nama_kelurahan_ktp,
					a.kode_kecamatan_ktp,a.nama_kecamatan_ktp,a.kode_kabupaten_ktp,a.nama_kabupaten_ktp,
					a.kode_provinsi_ktp,a.nama_provinsi_ktp,a.is_check,a.longitude,a.latitude,
					a.pendidikan,a.pendidikan_bkd,a.asal_sekolah,a.tgl_lulus,a.status_nikah,
					a.status_pegawai_pangkat,a.id_golongan,a.nomor_sk_pangkat,a.tanggal_sk_pangkat,
					a.tanggal_mulai_pangkat,a.tanggal_selesai_pangkat,a.id_status_jabatan,
					a.id_rumpun_jabatan,a.id_jabatan,a.id_bidang,a.jfu,a.unit_kerja,a.id_unit_kerja,
					a.id_satuan_kerja,a.lokasi_kerja,a.seksi,a.id_seksi,a.nomor_sk_jabatan,
					a.tanggal_sk_jabatan,a.tanggal_mulai_jabatan,a.tanggal_selesai_jabatan,a.id_eselon,
					a.tmt_eselon,a.signature, 
					if (a.foto != '', concat('".base_url()."','asset/foto_pegawai/',a.foto), '".base_url()."asset/foto_pegawai/no-image/nofoto.png') as foto,
					if (a.foto != '', concat('".base_url()."','asset/foto_pegawai/thumb/',a.foto), '".base_url()."asset/foto_pegawai/no-image/nofoto.png') as thumb_foto, 
					b.golongan, c.nama_eselon as eselon, d.nama_status_jabatan, e.nama_jabatan as jabatan, 
					f.lokasi_kerja as nama_lokasi_kerja, g.sub_lokasi_kerja, h.nama_rumpun_jabatan, 
					i.nama_status as nama_status_pegawai 
				from tbl_data_pegawai a 
				left join tbl_master_golongan b on a.id_golongan = b.id_golongan 
				left join tbl_master_eselon c on a.id_eselon = c.id_eselon 
				left join tbl_master_status_jabatan d on a.id_status_jabatan = d.id_status_jabatan 
				left join tbl_master_nama_jabatan e on a.id_jabatan = e.id_nama_jabatan 
				left join tbl_master_lokasi_kerja f on a.lokasi_kerja = f.id_lokasi_kerja 
				left join tbl_master_sub_lokasi_kerja g on a.id_seksi = g.id_sub_lokasi_kerja 
				left join tbl_master_rumpun_jabatan h on a.id_rumpun_jabatan = h.id_rumpun_jabatan 
				left join tbl_master_status_pegawai i on a.status_pegawai = i.id_status_pegawai $cond 
			";

			$q_old2 = "SELECT * FROM (
						select 	a.id_pegawai,a.nip,a.nrk,a.nama_pegawai,a.email,a.telepon,a.tempat_lahir,
											a.tanggal_lahir,a.jenis_kelamin,a.agama,a.usia,a.status_pegawai,a.masa_kerja,
											a.tanggal_pengangkatan_cpns,a.alamat,a.kode_kelurahan,a.nama_kelurahan,
											a.kode_kecamatan,a.nama_kecamatan,a.kode_kabupaten,a.nama_kabupaten,a.kode_provinsi,
											a.nama_provinsi,a.alamat_ktp,a.kode_kelurahan_ktp,a.nama_kelurahan_ktp,
											a.kode_kecamatan_ktp,a.nama_kecamatan_ktp,a.kode_kabupaten_ktp,a.nama_kabupaten_ktp,
											a.kode_provinsi_ktp,a.nama_provinsi_ktp,a.is_check,a.longitude,a.latitude,
											a.pendidikan,a.pendidikan_bkd,a.asal_sekolah,a.tgl_lulus,a.status_nikah,
											a.status_pegawai_pangkat,a.id_golongan,a.nomor_sk_pangkat,a.tanggal_sk_pangkat,
											a.tanggal_mulai_pangkat,a.tanggal_selesai_pangkat,a.id_status_jabatan,
											a.id_rumpun_jabatan,a.id_jabatan,a.id_bidang,a.jfu,a.unit_kerja,a.id_unit_kerja,
											a.id_satuan_kerja,a.lokasi_kerja,a.seksi,a.id_seksi,a.nomor_sk_jabatan,
											a.tanggal_sk_jabatan,a.tanggal_mulai_jabatan,a.tanggal_selesai_jabatan,a.id_eselon,
											a.tmt_eselon,a.signature, 
											if (a.foto != '', concat('".base_url()."','asset/foto_pegawai/',a.foto), '".base_url()."asset/foto_pegawai/no-image/nofoto.png') as foto,
											if (a.foto != '', concat('".base_url()."','asset/foto_pegawai/thumb/',a.foto), '".base_url()."asset/foto_pegawai/no-image/nofoto.png') as thumb_foto, 
											b.golongan, c.nama_eselon as eselon, d.nama_status_jabatan, e.nama_jabatan as jabatan, 
											f.lokasi_kerja as nama_lokasi_kerja, g.sub_lokasi_kerja, h.nama_rumpun_jabatan, 
											i.nama_status as nama_status_pegawai 
										from tbl_data_pegawai a 
										left join tbl_master_golongan b on a.id_golongan = b.id_golongan 
										left join tbl_master_eselon c on a.id_eselon = c.id_eselon 
										left join tbl_master_status_jabatan d on a.id_status_jabatan = d.id_status_jabatan 
										left join tbl_master_nama_jabatan e on a.id_jabatan = e.id_nama_jabatan 
										left join tbl_master_lokasi_kerja f on a.lokasi_kerja = f.id_lokasi_kerja 
										left join tbl_master_sub_lokasi_kerja g on a.id_seksi = g.id_sub_lokasi_kerja 
										left join tbl_master_rumpun_jabatan h on a.id_rumpun_jabatan = h.id_rumpun_jabatan 
										left join tbl_master_status_pegawai i on a.status_pegawai = i.id_status_pegawai 
										union
										SELECT
									    log.id_pegawai,
									    '' as nip,
									    log.username as nrk,
									    log.nama_lengkap as nama_pegawai,
									    log.email,
									    log.telepon,
									    '' as tempat_lahir, '' as tanggal_lahir, '' as jenis_kelamin, '' as agama, '' as usia, '' as status_pegawai, 
									    '' as masa_kerja, '' as tanggal_pengangkatan_cpns, '' as alamat, '' as kode_kelurahan, '' as nama_kelurahan,
									    '' as kode_kecamatan,'' as nama_kecamatan,'' as kode_kabupaten,'' as nama_kabupaten,'' as kode_provinsi,
									    '' as nama_provinsi,'' as alamat_ktp,'' as kode_kelurahan_ktp,'' as nama_kelurahan_ktp,
									    '' as kode_kecamatan_ktp,'' as nama_kecamatan_ktp,'' as kode_kabupaten_ktp,'' as nama_kabupaten_ktp,
									    '' as kode_provinsi_ktp,'' as nama_provinsi_ktp,'' as is_check,'' as longitude,'' as latitude,
									    '' as pendidikan,'' as pendidikan_bkd,'' as asal_sekolah,'' as tgl_lulus,'' as status_nikah,
									    '' as status_pegawai_pangkat,'' as id_golongan,'' as nomor_sk_pangkat,'' as tanggal_sk_pangkat,
									    '' as tanggal_mulai_pangkat,'' as tanggal_selesai_pangkat,'' as id_status_jabatan,
									    '' as id_rumpun_jabatan,'' as id_jabatan,'' as id_bidang,'' as jfu,'' as unit_kerja,'' as id_unit_kerja,
									    '' as id_satuan_kerja, log.id_lokasi_kerja as lokasi_kerja,'' as seksi,'' as id_seksi,'' as nomor_sk_jabatan,
									    '' as tanggal_sk_jabatan,'' as tanggal_mulai_jabatan,'' as tanggal_selesai_jabatan,'' as id_eselon,
									    '' as tmt_eselon, '' as `signature`, '' as foto, '' as thumb_foto, 
									    '' as golongan, '' as eselon, '' as nama_status_jabatan, '' as jabatan, 
									    '' as nama_lokasi_kerja, '' as sub_lokasi_kerja, '' as nama_rumpun_jabatan, '' as nama_status_pegawai

									FROM
									tbl_user_login AS log
									WHERE
									log.username not in (
										select nrk from tbl_data_pegawai
									)
									) as a $cond ";

					$q = "SELECT * FROM (
								select 	a.id_pegawai,a.nip,a.nrk,a.nama_pegawai,a.email,a.telepon,a.tempat_lahir,
									a.tanggal_lahir,a.jenis_kelamin,a.agama,a.usia,a.status_pegawai,a.masa_kerja,
									a.tanggal_pengangkatan_cpns,a.alamat,a.kode_kelurahan,a.nama_kelurahan,
									a.kode_kecamatan,a.nama_kecamatan,a.kode_kabupaten,a.nama_kabupaten,a.kode_provinsi,
									a.nama_provinsi,a.alamat_ktp,a.kode_kelurahan_ktp,a.nama_kelurahan_ktp,
									a.kode_kecamatan_ktp,a.nama_kecamatan_ktp,a.kode_kabupaten_ktp,a.nama_kabupaten_ktp,
									a.kode_provinsi_ktp,a.nama_provinsi_ktp,a.is_check,a.longitude,a.latitude,
									a.pendidikan,a.pendidikan_bkd,a.asal_sekolah,a.tgl_lulus,a.status_nikah,
									a.status_pegawai_pangkat,a.id_golongan,a.nomor_sk_pangkat,a.tanggal_sk_pangkat,
									a.tanggal_mulai_pangkat,a.tanggal_selesai_pangkat,a.id_status_jabatan,
									a.id_rumpun_jabatan,a.id_jabatan,a.id_bidang,a.jfu,a.unit_kerja,a.id_unit_kerja,
									a.id_satuan_kerja,a.lokasi_kerja,a.sublokasi_kerja,a.seksi,a.id_seksi,a.nomor_sk_jabatan,
									a.tanggal_sk_jabatan,a.tanggal_mulai_jabatan,a.tanggal_selesai_jabatan,a.id_eselon,
									a.tmt_eselon,
									if(a.signature != '', concat('".base_url()."','asset/foto_pegawai/signature/thumb/',a.signature), '".base_url()."asset/foto_pegawai/no-image/no-sign.png') as signature,
									if (a.foto != '', concat('".base_url()."','asset/foto_pegawai/',a.foto), '".base_url()."asset/foto_pegawai/no-image/nofoto.png') as foto,
									if (a.foto != '', concat('".base_url()."','asset/foto_pegawai/thumb/',a.foto), '".base_url()."asset/foto_pegawai/no-image/nofoto.png') as thumb_foto, 
									b.golongan, c.nama_eselon as eselon, d.nama_status_jabatan, e.nama_jabatan as jabatan, 
									f.lokasi_kerja as nama_lokasi_kerja, g.sub_lokasi_kerja, 
									lingkup_tugas, REPLACE(sub_lingkup_tugas, ' DINAS CIPTA KARYA TATA RUANG DAN PERTANAHAN', '') as sub_lingkup_tugas,
									h.nama_rumpun_jabatan, i.nama_status as nama_status_pegawai
								from tbl_data_pegawai a 
								left join tbl_master_golongan b on a.id_golongan = b.id_golongan 
								left join tbl_master_eselon c on a.id_eselon = c.id_eselon 
								left join tbl_master_status_jabatan d on a.id_status_jabatan = d.id_status_jabatan 
								left join tbl_master_nama_jabatan e on a.id_jabatan = e.id_nama_jabatan 
								left join tbl_master_lokasi_kerja f on a.lokasi_kerja = f.id_lokasi_kerja 
								left join tbl_master_sub_lokasi_kerja g on a.seksi = g.id_sub_lokasi_kerja 
								left join tbl_master_rumpun_jabatan h on a.id_rumpun_jabatan = h.id_rumpun_jabatan 
								left join tbl_master_status_pegawai i on a.status_pegawai = i.id_status_pegawai
								LEFT JOIN (
											SELECT
												x.id_lokasi_kerja,
												x.lokasi_kerja,
												x.dinas,
												x.kodepos,
												CASE dinas
														WHEN 0 THEN 'SUDIN'
														WHEN 1 THEN 'DINAS'
														WHEN 2 THEN 'UPT'
														ELSE ''
												END lingkup_tugas
											FROM
												tbl_master_lokasi_kerja as x
										) AS xy ON xy.id_lokasi_kerja = a.lokasi_kerja
										
										LEFT JOIN (
											SELECT 
												y.id_sub_lokasi_kerja,
												y.id_lokasi_kerja,
												y.sub_lokasi_kerja as sub_lingkup_tugas
											FROM
												tbl_master_sub_lokasi_kerja as y
										) as yz ON yz.id_lokasi_kerja = a.lokasi_kerja AND yz.id_sub_lokasi_kerja = a.seksi
								union
								SELECT
								log.id_pegawai,
								'' as nip,
								log.username as nrk,
								log.nama_lengkap as nama_pegawai,
								log.email,
								log.telepon,
								'' as tempat_lahir, '' as tanggal_lahir, '' as jenis_kelamin, '' as agama, '' as usia, '' as status_pegawai, 
								'' as masa_kerja, '' as tanggal_pengangkatan_cpns, '' as alamat, '' as kode_kelurahan, '' as nama_kelurahan,
								'' as kode_kecamatan,'' as nama_kecamatan,'' as kode_kabupaten,'' as nama_kabupaten,'' as kode_provinsi,
								'' as nama_provinsi,'' as alamat_ktp,'' as kode_kelurahan_ktp,'' as nama_kelurahan_ktp,
								'' as kode_kecamatan_ktp,'' as nama_kecamatan_ktp,'' as kode_kabupaten_ktp,'' as nama_kabupaten_ktp,
								'' as kode_provinsi_ktp,'' as nama_provinsi_ktp,'' as is_check,'' as longitude,'' as latitude,
								'' as pendidikan,'' as pendidikan_bkd,'' as asal_sekolah,'' as tgl_lulus,'' as status_nikah,
								'' as status_pegawai_pangkat,'' as id_golongan,'' as nomor_sk_pangkat,'' as tanggal_sk_pangkat,
								'' as tanggal_mulai_pangkat,'' as tanggal_selesai_pangkat,'' as id_status_jabatan,
								'' as id_rumpun_jabatan,'' as id_jabatan,'' as id_bidang,'' as jfu,'' as unit_kerja,'' as id_unit_kerja,
								'' as id_satuan_kerja, log.id_lokasi_kerja as lokasi_kerja,'' as sublokasi_kerja,'' as seksi,'' as id_seksi,'' as nomor_sk_jabatan,
								'' as tanggal_sk_jabatan,'' as tanggal_mulai_jabatan,'' as tanggal_selesai_jabatan,'' as id_eselon,
								'' as tmt_eselon, '' as `signature`, '' as foto, '' as thumb_foto, 
								'' as golongan, '' as eselon, '' as nama_status_jabatan, '' as jabatan, 
								'' as nama_lokasi_kerja, '' as sub_lokasi_kerja, '' as lingkup_tugas, '' as sub_lingkup_tugas, '' as nama_rumpun_jabatan, '' as nama_status_pegawai

							FROM
							tbl_user_login AS log
							WHERE
							log.username not in (
								select nrk from tbl_data_pegawai
							)
							) as a $cond ";
			
			$data = $this->db->query($q)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}



	public function get_signature() {
		$status = false;
		$message = '';
		$data = [];

		$nrk = $this->input->get('nrk');
		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->get('app-key');
		
		if ($apiKey == $key) {
			$status = true;
			$cond = '';
			
			if ($nrk != '') {
				$cond = " where a.nrk='".$nrk."'";
			}

			$q = "SELECT 
					a.signature, 
					if(a.signature != '', concat('".base_url()."','asset/foto_pegawai/signature/thumb/',a.signature), '".base_url()."asset/foto_pegawai/no-image/no-sign.png') as thumb_signature
				FROM tbl_data_pegawai a $cond ";
			$data = $this->db->query($q)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}

	public function get_pegawai_nrk() {
		$status = false;
		$message = '';
		$data = [];

		$nrk = $this->input->get('nrk');
		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->get('app-key');
		
		if ($apiKey == $key) {
			$status = true;
			$cond = '';
			
			if ($nrk != '') {
				$cond = " AND nrk ='$nrk'";
			} else {
				$cond = " AND nrk = 'XXX'";
			}

			$q = $this->db->query("SELECT * FROM tbl_data_pegawai WHERE id_pegawai !='' $cond ")->row();
			//$data = $this->db->query($q)->row();
			if($q != null OR $q != ''){
				$data = $this->db->query("SELECT * FROM tbl_data_pegawai WHERE 
													id_jabatan in (
														SELECT id_nama_jabatan
														FROM tbl_master_nama_jabatan 
														WHERE id_jabatan_atasan = '$q->id_jabatan')")->result();
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
		
		echo json_encode($result);
	}


	public function get_bawahan() {
		$status = false;
		$message = '';
		$data = [];

		$param = $this->input->get('param');
		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->get('app-key');
		
		if ($apiKey == $key) {
			$status = true;
			$cond = '';
			
			if ($param != '') {
				$cond = $param;
			}

			$q = "SELECT * FROM tbl_data_pegawai WHERE 
					id_jabatan in (
						select group_concat(id_nama_jabatan)
						from tbl_master_nama_jabatan 
						where id_jabatan_atasan = '$cond'
					)";
			$data = $this->db->query($q)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}

	function getPegawaiByIdJabatan($id) {
		$this->db->from('tbl_data_pegawai');
		$this->db->where('id_jabatan', $id);
		return $this->db->get()->result();
	}

	function getJabatanRecursive_l4($parent=4,  $level=4, $lokasi, $sublokasi) {
		$array 	 = [];
		if($sublokasi == null or $sublokasi == ''){
			$kond_sub = " AND isnull(a.sublokasi_kerja)";
		} else {
			$kond_sub = " AND a.sublokasi_kerja = '$sublokasi'";
		}
		$Query_L1 = $this->db->query("SELECT No_urut,
											a.nama_pegawai, a.nip, a.nrk, id_status_jabatan, id_jabatan,level_jabatan, id_nama_jabatan,id_jabatan_atasan,a.lokasi_kerja,a.sublokasi_kerja,
											nama_jabatan as jabatan,
											lok.lokasi_kerja as satuan_unit_kerja
										FROM tbl_data_pegawai as a
										LEFT JOIN (
												SELECT id_nama_jabatan, level_jabatan, nama_jabatan,id_jabatan_atasan, No_urut  FROM tbl_master_nama_jabatan
												WHERE Aktif = '1'
										) AS jab ON a.id_jabatan = jab.id_nama_jabatan

										LEFT JOIN (
												SELECT id_lokasi_kerja, lokasi_kerja FROM tbl_master_lokasi_kerja
										) AS lok ON a.lokasi_kerja = lok.id_lokasi_kerja
										WHERE 
										a.id_status_jabatan = '2' AND a.status_pegawai = '5' AND a.id_jabatan != '0' AND level_jabatan = '$level' 
										-- AND id_jabatan_atasan = '$parent'
										AND a.lokasi_kerja = '$lokasi' $kond_sub AND nama_jabatan !='Kepala Sektor Dinas Cipta Karya Tata Ruang dan Pertanahan Kecamatan'
										ORDER BY No_urut ASC")->result();

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
											a.nama_pegawai, a.nip, a.nrk, id_status_jabatan, id_jabatan,level_jabatan, id_nama_jabatan,id_jabatan_atasan,a.lokasi_kerja,a.sublokasi_kerja,
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
										a.id_status_jabatan = '2' AND a.status_pegawai = '5' AND a.id_jabatan != '0' AND level_jabatan = '$level' AND id_jabatan_atasan = '$parent'
										group by a.lokasi_kerja, a.sublokasi_kerja ORDER BY level_jabatan, a.id_jabatan ASC")->result();

		if ($Query_L1) {
			$i = 0;
			foreach ($Query_L1 as $row) {
				
				$array[$i] = [
					'id_jabatan' => $row->id_nama_jabatan,
					'jabatan' => ucwords($row->jabatan),
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
					$array[$i]['childs'] = $this->getJabatanRecursive_l4($row->id_nama_jabatan,4, $row->lokasi_kerja, $row->sublokasi_kerja);
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
										a.id_status_jabatan = '2' AND a.status_pegawai = '5' AND a.id_jabatan != '0' AND level_jabatan = '$level' AND id_jabatan_atasan = '$parent'  AND a.lokasi_kerja = '52'
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
		
		echo json_encode($result);
	}

	public function getMasterJabatan() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->post('key');
		
		if ($apiKey == $key) {
			$status = true;

			$Qdata = "SELECT
				a.id_nama_jabatan, 
				a.id_status_jabatan, 
				a.nama_jabatan, 
				a.id_jabatan_atasan, 
				a.level_jabatan
			FROM
				tbl_master_nama_jabatan AS a";
			$data = $this->db->query($Qdata)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}

	public function getLokasiKerja() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->post('key');
		
		if ($apiKey == $key) {
			$status = true;

			$Qdata = "SELECT
						a.id_lokasi_kerja, 
						a.lokasi_kerja, 
						a.dinas, 
						a.kota, 
						a.alamat, 
						a.telp, 
						a.fax, 
						a.kodepos
					FROM
						tbl_master_lokasi_kerja AS a";
			$data = $this->db->query($Qdata)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}

	public function getSubLokasiKerja() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->post('key');
		
		if ($apiKey == $key) {
			$status = true;

			$Qdata = "SELECT
						a.id_sub_lokasi_kerja, 
						a.id_lokasi_kerja, 
						a.sub_lokasi_kerja
					FROM
						tbl_master_sub_lokasi_kerja AS a";
			$data = $this->db->query($Qdata)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}

	public function getPltPlh() {
		$status = false;
		$message = '';
		$data = [];

		$apiKey = hash_pbkdf2('sha512', $this->config->item('api_key'), $this->config->item('api_salt'), $this->config->item('api_iterations'), $this->config->item('api_length'));
		$key = $this->input->post('key');
		
		if ($apiKey == $key) {
			$status = true;

			$Qdata = "SELECT 
							a.id_surat_tugas_pltplh, 
							a.type_surat,
							a.id_pegawai, 
							c.lokasi_kerja_pegawai, c.nama_pegawai,c.nrk, c.nip,
							a.id_pegawai_berhalangan, 
							e.lokasi_kerja_pegawai_berhalangan, e.nama_pegawai_berhalangan,e.nrk_berhalangan, e.nip_berhalangan,
							a.alasan_pltplh, 
							a.tgl_mulai, 
							a.tgl_selesai
						FROM
							tbl_data_surat_tugas_pltplh AS a
						LEFT JOIN (
							SELECT b.id_pegawai, b.nrk, b.nip, b.lokasi_kerja as lokasi_kerja_pegawai, b.sublokasi_kerja, b.nama_pegawai
							FROM tbl_data_pegawai as b
							LEFT JOIN tbl_master_lokasi_kerja ba on b.lokasi_kerja = ba.id_lokasi_kerja 
						) AS c ON c.id_pegawai = a.id_pegawai
						
						LEFT JOIN (
							SELECT d.id_pegawai as id_pegawai_berhalangan, d.nrk as nrk_berhalangan, d.nip as nip_berhalangan, d.lokasi_kerja as lokasi_kerja_pegawai_berhalangan, 
											d.sublokasi_kerja, d.nama_pegawai as nama_pegawai_berhalangan
							FROM tbl_data_pegawai as d
							LEFT JOIN tbl_master_lokasi_kerja da on d.lokasi_kerja = da.id_lokasi_kerja 
						) AS e ON e.id_pegawai_berhalangan = a.id_pegawai_berhalangan
						WHERE a.id_surat_tugas_pltplh != '' AND a.tgl_selesai >= CURRENT_DATE()";
			$data = $this->db->query($Qdata)->result_array();
		}
		else {
			$message = 'Authentication failed.';
		}
		
		$result = [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
		
		echo json_encode($result);
	}

}