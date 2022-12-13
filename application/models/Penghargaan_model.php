<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Penghargaan_model extends CI_Model {



	var $table = 'tbl_data_penghargaan';

	var $column_order = array('nama_penghargaan','pemberi_penghargaan','nomor_sk','tgl_sk_penghargaan',null); //set column field database for datatable orderable

	var $column_search = array('nama_penghargaan','pemberi_penghargaan','nomor_sk','tgl_sk_penghargaan'); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id_penghargaan' => 'desc'); // default order 



	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}



	private function _get_datatables_query()

	{

		//$this->db->from('kota as k');

		$this->db->from('tbl_data_penghargaan as a');

		$this->db->join('tbl_master_penghargaan as b', 'a.id_master_penghargaan = b.id_master_penghargaan','left');



		$i = 0;

	

		foreach ($this->column_search as $item) // loop column 

		{

			if($_POST['search']['value']) // if datatable send POST for search

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

		$this->db->where('id_pegawai', $id);

		if($_POST['length'] != -1)

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



	public function get_by_id($id_penghargaan)

	{

		$this->db->from($this->table);

		$this->db->where('id_penghargaan',$id_penghargaan);

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



	public function delete_by_id($id_penghargaan)

	{

		$this->db->where('id_penghargaan', $id_penghargaan);
		$this->db->delete($this->table);

	}





	public function update_arsip($where, $data) {

		$this->db->where($where);

		$this->db->update('tbl_arsip_sk', $data);

	}



	public function get_arsip_by_id_ref($id_ref,$id_jenis_sk) {

		$this->db->from('tbl_arsip_sk');

		$this->db->where('id_ref', $id_ref);
		$this->db->where('id_jenis_sk', $id_jenis_sk);

		$q = $this->db->get();



		return $q->row();

	}



	public function get_arsip_by_id($id) {

		$this->db->from('tbl_arsip_sk');

		$this->db->where('id_arsip_sk', $id);

		$q = $this->db->get();



		return $q->row();

	}



	public function delete_arsip($id) {

		$this->db->where('id_arsip_sk', $id);

		$this->db->delete('tbl_arsip_sk');

	}

	public function getMasterPenghargaanName($id) {
		$name = '';
		$this->db->where('id_master_penghargaan', $id);
		$q = $this->db->get('tbl_master_penghargaan');
		
		if ($data = $q->row()) {
			if ($data->nama_penghargaan) {
				$name = $data->nama_penghargaan;
			}
		}
		
		return $name;
	}



}

