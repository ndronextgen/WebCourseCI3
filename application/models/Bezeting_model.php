<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bezeting_model extends CI_Model {
	var $tableBezeting = 'tbl_master_bezeting';
	var $tableStatusJabatan = 'tbl_master_status_jabatan';
	var $tableMasterJabatan = 'tbl_master_nama_jabatan';
	var $tableMasterEselon = 'tbl_master_eselon';
	var $tablePegawai = 'tbl_data_pegawai';
	var $tableBezetingHist = 'tbl_master_bezeting_hist';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_list_bezeting() {
		$this->db->from($this->tableBezeting);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_list_status_jabatan() {
		$this->db->from($this->tableStatusJabatan);
		$this->db->order_by('urut','asc');
		$this->db->where_in('id_status_jabatan',[2,6,8]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_jabatan_by_status_jabatan($id) {
		// khusus struktural, ambil by eselon
		if ($id == 2) {
			$this->db->from($this->tableMasterEselon);
			$this->db->select('eselon as nama_jabatan');
			$this->db->group_by('eselon');
			// $this->db->where('nama_eselon !=', '-');
			$this->db->where_not_in('eselon', ['Eselon I','Eselon V','-']);
		}
		else {
			$this->db->from($this->tableMasterJabatan);
			$this->db->where('id_status_jabatan',$id);
			$this->db->where('nama_jabatan !=','-');
			$this->db->order_by('nama_jabatan','asc');
		}
		
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_count_pegawai($id) {
		$this->db->from($this->tablePegawai);
		$this->db->where('id_jabatan',$id);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_count_pegawai_eselon($kodeEselon) {
		$idEselons = null;
		// get id eselon
		$this->db->from($this->tableMasterEselon);
		$this->db->where('eselon',$kodeEselon);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result_array() as $es) {
				$idEselons[] = $es['id_eselon'];
			}
		}

		$this->db->from($this->tablePegawai);
		$this->db->where_in('id_eselon',$idEselons);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function insert_update($obj,$act=0) {
		$ci=& get_instance();

		if (count($obj) > 0) {
			foreach ($obj as $k=>$d) {
				if (count($d['data_jabatan']) > 0) {
					foreach ($d['data_jabatan'] as $k2=>$d2) {
						$ins = [
							'id_status_jabatan' => $d['id_status_jabatan'],
							'status_jabatan' => $d['status_jabatan'],
							'id_jabatan' => $d2['id_jabatan'],
							'nama_jabatan' => $d2['nama_jabatan'],
							'existing' => $d2['existing'],
							'abk' => $d2['abk'],
							'selisih' => $d2['selisih'],
							'ket' => $d2['ket'],
							'created_by' => $ci->session->userdata('id_user'),
							'created_at' => date('Y-m-d H:i:s')
						];

						// insert ke history
						if ($act == 1) {
							$this->db->insert($this->tableBezetingHist, $ins);
						}
					}
				}
			}

			// truncate table bezeting
			if ($this->db->truncate($this->tableBezeting)) {
				foreach ($obj as $k=>$d) {
					if (count($d['data_jabatan']) > 0) {
						foreach ($d['data_jabatan'] as $k2=>$d2) {
							$ins = [
								'id_status_jabatan' => $d['id_status_jabatan'],
								'status_jabatan' => $d['status_jabatan'],
								'id_jabatan' => $d2['id_jabatan'],
								'nama_jabatan' => $d2['nama_jabatan'],
								'existing' => $d2['existing'],
								'abk' => $d2['abk'],
								'selisih' => $d2['selisih'],
								'ket' => $d2['ket'],
								'created_by' => $ci->session->userdata('id_user'),
								'created_at' => date('Y-m-d H:i:s')
							];
	
							// insert ke tabel master bezeting
							$this->db->insert($this->tableBezeting, $ins);
						}
					}
				}
			}
		}
	}

}
