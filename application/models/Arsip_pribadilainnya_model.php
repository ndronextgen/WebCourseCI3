<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Arsip_pribadilainnya_model extends CI_Model {



	var $table = 'tbl_arsip_pribadi';

	var $column_order = array(null,'title','file_name_ori',null,null); //set column field database for datatable orderable

	var $column_search = array('title','file_name_ori'); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id_arsip_pribadi' => 'desc'); // default order 



	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}



	private function _get_datatables_query()

	{	

		$this->db->from($this->table);



		$i = 0;

	

		foreach ($this->column_search as $item) // loop column 

		{

			if(isset($_POST['search']['value'])) // if datatable send POST for search

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

		$number = $_POST['length'];
		$offset = $_POST['start'];
		if($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND tbl_arsip_pribadi.title LIKE '%$search%'";
		}
		else {
			$k_search = "";
		}
		if(isset($_POST['length']))
		$this->db->limit($_POST['length'], $_POST['start']);
		$sQuery = "SELECT * FROM tbl_arsip_pribadi WHERE id_data_keluarga NOT IN (
							SELECT id_data_keluarga FROM tbl_data_keluarga
						) AND tbl_arsip_pribadi.created_id  = '$id' $k_search
						ORDER BY tbl_arsip_pribadi.created_at DESC
						limit $offset, $number";
		if($_POST['length'] != -1)
		$query = $this->db->query($sQuery)->result();
		return $query;	

	}



	function count_filtered($id)

	{

		if($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$k_search = " AND (tbl_arsip_pribadi.title LIKE '%$search%')";
		}
		else {
			$k_search = "";
		}
		
		$sQuery = "SELECT COUNT(*) as jml FROM tbl_arsip_pribadi WHERE id_data_keluarga NOT IN (
						SELECT id_data_keluarga FROM tbl_data_keluarga
					) AND tbl_arsip_pribadi.created_id  = '$id' $k_search
					ORDER BY tbl_arsip_pribadi.created_at DESC";
		$query = $this->db->query($sQuery)->row();
		return $query->jml;

	}



	public function count_all($id)

	{

		$sQuery = "SELECT COUNT(*) as jml FROM tbl_arsip_pribadi WHERE id_data_keluarga NOT IN (
			SELECT id_data_keluarga FROM tbl_data_keluarga
		) AND tbl_arsip_pribadi.created_id  = '$id'";
		$query = $this->db->query($sQuery)->row();
		return $query->jml;	

	}



	public function get_by_id($id)

	{

		$this->db->from($this->table);

		$this->db->where('id_arsip_pribadi',$id);

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

		$this->db->where('id_arsip_pribadi', $id);

		$this->db->delete($this->table);

	}
	
	public function get_by_keluarga($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_data_keluarga',$id);

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

