<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Srt_ket_model extends CI_Model
{

	var $table = 'tbl_data_srt_ket';
	var $column_order = array('jenis_surat', null); //set column field database for datatable orderable
	var $column_search = array('jenis_surat'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_srt' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from('tbl_data_srt_ket as a');
		$this->db->join('tbl_master_surat as b', 'a.jenis_surat = b.id_surat', 'left');
		$this->db->join('tbl_status_surat as c', 'a.id_status_srt = c.id_status', 'left');
		$this->db->join('tbl_master_jenis_pengajuan_surat as d', 'a.jenis_pengajuan_surat = d.kode', 'left');

		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
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
		$this->db->where('id_user', $id);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		
		return $query->result();
	}

	function count_filtered($id)
	{
		$this->_get_datatables_query();
		$this->db->where('id_user', $id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_user', $id);
		return $this->db->count_all_results();
	}

	public function get_by_id($id_srt)
	{
		$this->db->from($this->table);
		$this->db->where('id_srt', $id_srt);
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

	public function delete_by_id($id_srt)
	{
		$this->db->where('id_srt', $id_srt);
		$this->db->delete($this->table);
	}

	function jenis_pengajuan_surat()
	{
		$this->db->order_by("no_urut", "asc");
		$query = $this->db->get("tbl_master_jenis_pengajuan_surat");
		return $query->result();
	}
}
