<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_srt_ket_model extends CI_Model {

	var $table = 'tbl_history_srt_ket';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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

	public function delete($id)
	{
		$this->db->where('id_history_srt_ket', $id);
		$this->db->delete($this->table);
	}

	public function delete_by_parent($id)
	{
		$this->db->where('id_srt', $id);
		$this->db->delete($this->table);
	}
}