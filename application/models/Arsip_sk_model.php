<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip_sk_model extends CI_Model {
	var $table = 'tbl_arsip_sk';
	var $column_order = array(null,'tbl_arsip_sk.title','tbl_master_jenis_sk.jenis_sk','tbl_arsip_sk.file_name_ori',null,null); //set column field database for datatable orderable
	var $column_search = array('tbl_arsip_sk.title','tbl_arsip_sk.file_name_ori','tbl_master_jenis_sk.jenis_sk'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('tbl_arsip_sk.id_arsip_sk' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _get_datatables_query()
	{	
		$this->db->select($this->table.".*,tbl_master_jenis_sk.jenis_sk, '' as opsi, '' as aksi");
		$this->db->from($this->table);
		$this->db->join('tbl_master_jenis_sk', $this->table.'.id_jenis_sk = tbl_master_jenis_sk.id_jenis_sk', 'left join');
		$i = 0;
		
		foreach ($this->column_search as $item) // loop column 
		{
			if(isset($_POST['search'])) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				
				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}

			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function get_datatables($id)
	{
		$this->_get_datatables_query();
		$this->db->where('created_id', $id);

		if(isset($_POST['length']))
		$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		return $query->result();
	}
	
	function count_filtered($id)
	{
		$this->_get_datatables_query();
		$this->db->where('created_id', $id);

		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function count_all($id)
	{
		$this->db->from($this->table);
		$this->db->where('created_id', $id);
		return $this->db->count_all_results();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_arsip_sk',$id);
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
	
	public function delete_by_id($id)
	{
		$this->db->where('id_arsip_sk', $id);
		$this->db->delete($this->table);
	}
	
	public function get_by_id_ref($id, $jenis_sk)
	{
		$this->db->from($this->table);
		$this->db->where('id_ref',$id);
		$this->db->where('id_jenis_sk',$jenis_sk);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_by_id_input($id)
	{
		$this->db->from($this->table);
		$this->db->where('created_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}

