<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Riwayat_jabatan_model extends CI_Model
{
	var $table = 'tbl_data_riwayat_jabatan';
	var $table2 = 'tbl_master_status_jabatan';
	var $table3 = 'tbl_master_nama_jabatan';
	var $column_order = array('nama_status_jabatan', 'a.nama_jabatan', 'lokasi', 'tmt_mulai_jabatan', 'tgl_sk_jabatan', 'nomor_sk', null); //set column field database for datatable orderable
	var $column_search = array('nama_status_jabatan', 'a.nama_jabatan', 'lokasi', 'tmt_mulai_jabatan', 'tgl_sk_jabatan', 'nomor_sk'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_riwayat_jabatan' => 'desc'); // default order 
	var $table_arsip = 'tbl_arsip_sk';
	var $column_order_arsip = array(null, 'title', 'file_name_ori', null); //set column field database for datatable orderable
	var $column_search_arsip = array('title', 'file_name_ori'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order_arsip = array('id_arsip_sk' => 'desc'); // default order arsip
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->select('
			a.id_riwayat_jabatan, a.id_status_jabatan, a.id_jabatan, a.id_pegawai, a.status, 
			a.penempatan, a.id_riwayat_status_jabatan, a.id_r_jabatan, a.id_unit_kerja, a.uraian, 
			a.id_eselon, a.tmt_eselon, a.nomor_sk, a.tgl_sk_jabatan, a.tmt_mulai_jabatan, a.tanggal_selesai, 
			a.lokasi, 
			b.nama_status_jabatan,
			if ((a.id_riwayat_status_jabatan = 10 OR a.id_r_jabatan = 999), a.nama_jabatan,c.nama_jabatan) as nama_jabatan
		');
		$this->db->from('tbl_data_riwayat_jabatan as a');
		$this->db->join('tbl_master_status_jabatan as b', 'a.id_riwayat_status_jabatan = b.id_status_jabatan', 'left');
		$this->db->join('tbl_master_nama_jabatan as c', 'a.id_r_jabatan = c.id_nama_jabatan', 'left');
		$i = 0;
		foreach ($this->column_search as $item) // loop column 
		{
			if (isset($_POST['search']['value'])) // if datatable send POST for search
			{
				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables($id)
	{
		$this->_get_datatables_query();
		$this->db->where('a.id_pegawai', $id);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered($id)
	{
		$this->_get_datatables_query();
		$this->db->where('id_pegawai', $id);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_all($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_pegawai', $id);
		return $this->db->count_all_results();
	}
	public function get_by_id($id_riwayat_jabatan)
	{
		$this->db->from($this->table);
		$this->db->select('
			tbl_data_riwayat_jabatan.*,
			if ((tbl_data_riwayat_jabatan.id_riwayat_status_jabatan = 10 OR tbl_data_riwayat_jabatan.id_r_jabatan=999), tbl_data_riwayat_jabatan.nama_jabatan,tbl_master_nama_jabatan.nama_jabatan) as nama_jabatan
		');
		$this->db->join('tbl_master_nama_jabatan', 'tbl_master_nama_jabatan.id_nama_jabatan = tbl_data_riwayat_jabatan.id_r_jabatan', 'left');
		$this->db->where('tbl_data_riwayat_jabatan.id_riwayat_jabatan', $id_riwayat_jabatan);
		$query = $this->db->get();
		return $query->row();
	}
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id_riwayat_jabatan)
	{
		$this->db->where('id_riwayat_jabatan', $id_riwayat_jabatan);
		$this->db->delete($this->table);
	}
	public function status_jabatan()
	{
		$this->db->order_by("id_status_jabatan", "ASC");
		$this->db->from($this->table2);
		$query = $this->db->get();
		return $query->result();
	}
	public function nama_jabatann()
	{
		$this->db->order_by("id_nama_jabatan", "ASC");
		$this->db->from($this->table3);
		$query = $this->db->get();
		return $query->result();
	}
	function nama_jabatan($id)
	{
		$this->db->where('id_status_jabatan', $id);
		$this->db->order_by('nama_jabatan', 'ASC');
		$query = $this->db->get('tbl_master_nama_jabatan');
		$output = '<option value="">-- Pilih Nama Jabatan --</option><option value="999">Lainnya</option>';
		foreach ($query->result() as $row) {
			$output .= '<option value="' . $row->id_nama_jabatan . '">' . $row->nama_jabatan . '</option>';
		}
		return $output;
	}
	public function update_arsip($where, $data)
	{
		$this->db->where($where);
		$this->db->update('tbl_arsip_sk', $data);
	}
	public function get_arsip_by_id_ref($id_ref, $id_jenis_sk)
	{
		$this->db->from('tbl_arsip_sk');
		$this->db->where('id_ref', $id_ref);
		$this->db->where('id_jenis_sk', $id_jenis_sk);
		$q = $this->db->get();
		return $q->row();
	}
	public function get_arsip_by_id($id)
	{
		$this->db->from('tbl_arsip_sk');
		$this->db->where('id_arsip_sk', $id);
		$q = $this->db->get();
		return $q->row();
	}
	public function delete_arsip($id)
	{
		$this->db->where('id_arsip_sk', $id);
		$this->db->delete('tbl_arsip_sk');
	}
}
