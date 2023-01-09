<?php
class Config_popup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "config_popup";
    }

    function getAllby($where = array())
    {
        $result = $this->db->get_where($this->table, $where);
        if ($result->num_rows()) :
            return $result->result();
        endif;
        return FALSE;
    }

    function getRowby($where = array())
    {
        $result = $this->db->get_where($this->table, $where);
        if ($result->num_rows()) :
            return $result->row();
        endif;
        return FALSE;
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data, $where)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table);
        if ($this->db->affected_rows()) {
            return TRUE;
        }
        return FALSE;
    }

    function get_where_in($table = "", $key = "", $where_in = array(), $where = array())
    {
        $this->db->where_in($key, $where_in);
        $list_data = $this->db->get_where($table, $where);
        if ($list_data->num_rows()) :
            return $list_data->result();
        endif;
        return FALSE;
    }

    function get_list_pegawai($selected = [], $where = array())
    {
        $list_data = $this->db->get_where("tbl_data_pegawai", $where)->result();
        $result = [];
        if (!empty($list_data)) :
            foreach ($list_data as $data) :
                $var["id"]   = $data->id_pegawai;
                $var["text"] = $data->id_pegawai . " - " . $data->nama_pegawai;
                $result[] = $var;
            endforeach;
        endif;
        return $result;
    }

    function get_list_lokasi_kerja($select = [], $where = array())
    {
        $list_data = $this->db->get_where("tbl_master_lokasi_kerja", $where)->result();
        $result = [];
        if (!empty($list_data)) :
            foreach ($list_data as $data) :
                $selected = FALSE;
                if (array_search($data->id_lokasi_kerja, $select)) {
                    $selected = TRUE;
                }
                $var["id"]          = $data->id_lokasi_kerja;
                $var["text"]        = $data->id_lokasi_kerja . " - " . $data->lokasi_kerja;
                $var["selected"]    = $selected;
                $result[] = $var;
            endforeach;
        endif;
        return $result;
    }

    function get_list_sub_lokasi_kerja($select = [], $where = array())
    {
        $list_data = $this->db->get_where("tbl_master_sub_lokasi_kerja", $where)->result();
        $result = [];
        if (!empty($list_data)) :
            foreach ($list_data as $data) :
                $selected = FALSE;
                if (array_search($data->id_sub_lokasi_kerja, $select)) {
                    $selected = TRUE;
                }
                $var["id"]          = $data->id_sub_lokasi_kerja;
                $var["text"]        = $data->id_sub_lokasi_kerja . " - " . $data->sub_lokasi_kerja;
                $var["selected"]    = $selected;
                $result[] = $var;
            endforeach;
        endif;
        return $result;
    }
}
