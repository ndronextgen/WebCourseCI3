<?php

//extend from this model to execute basic db operations
class Informasi_model extends CI_Model
{

    private $table;

    function __construct($table = null)
    {
        $this->use_table($table);

        $this->db->query("SET sql_mode = ''");
    }

    protected function use_table($table)
    {
        $this->table = "tbl_master_informasi";
    }

    function get_one($id = 0)
    {
        return $this->get_one_where(array('id' => $id));
    }

    function get_one_where($where = array())
    {
        $result = $this->db->get_where($this->table, $where, 1);
        if ($result->num_rows()) {
            return $result->row();
        } else {
            $db_fields = $this->db->list_fields($this->table);
            $fields = new stdClass();
            foreach ($db_fields as $field) {
                $fields->$field = "";
            }
            return $fields;
        }
    }

    function get_all($include_deleted = false)
    {
        $where = array("deleted" => 0);
        if ($include_deleted) {
            $where = array();
        }
        return $this->get_all_where($where);
    }

    function get_all_where($where = array(), $limit = 1000000, $offset = 0, $sort_by_field = null)
    {
        $where_in = get_array_value($where, "where_in");
        if ($where_in) {
            foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
            unset($where["where_in"]);
        }

        if ($sort_by_field) {
            $this->db->order_by($sort_by_field, 'ASC');
        }

        return $this->db->get_where($this->table, $where, $limit, $offset);
    }

    function get_where_in($table = "", $key = "", $where_in = array(), $where = array())
    {
        if (!$where_in) $where_in = [0];
        $this->db->where_in($key, $where_in);
        $list_data = $this->db->get_where($table, $where);
        if ($list_data->num_rows()) :
            return $list_data->result();
        endif;
        return FALSE;
    }

    function save(&$data = array(), $id = 0)
    {
        if ($id) {
            //update
            $where = array("id" => $id);
            return $this->update_where($data, $where);
        } else {
            //insert
            if ($this->db->insert($this->table, $data)) {
                $insert_id = $this->db->insert_id();
                return $insert_id;
            }
        }
    }

    function update_where($data = array(), $where = array())
    {
        if (count($where)) {
            if ($this->db->update($this->table, $data, $where)) {
                $id = get_array_value($where, "id");
                if ($id) {
                    return $id;
                } else {
                    return true;
                }
            }
        }
    }

    function delete($id = 0, $undo = false)
    {
        $data = array('deleted' => 1);
        if ($undo === true) {
            $data = array('deleted' => 0);
        }
        $this->db->where("id", $id);
        return $this->db->update($this->table, $data);
    }

    function get_dropdown_list($option_fields = array(), $key = "id", $where = array())
    {
        $where["deleted"] = 0;
        $list_data = $this->get_all_where($where, 0, 0, $option_fields[0])->result();
        $result = array();
        foreach ($list_data as $data) {
            $text = "";
            foreach ($option_fields as $option) {
                $text .= $data->$option . " ";
            }
            $result[$data->$key] = $text;
        }
        return $result;
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
