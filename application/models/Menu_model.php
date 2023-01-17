<?php

//extend from this model to execute basic db operations
class Menu_model extends CI_Model
{

    private $table;

    function __construct($table = null)
    {
        $this->use_table($table);

        $this->db->query("SET sql_mode = ''");
    }

    protected function use_table($table)
    {
        $this->table = "site_menus";
    }

    public function getParentIdBy($where = [])
    {
        $date = date("Y-m-d");
        $this->db->select("site_menus.*, IF(tmi.id IS NULL, 0, 1) as isInfo");
        $this->db->from('site_menus');
        $this->db->join("tbl_master_informasi as tmi", "
            tmi.site_menu = site_menus.menu_id
            AND tmi.tgl_mulai <= '$date' AND tmi.tgl_akhir >= '$date'
        ", "LEFT");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    function get_one($id = 0)
    {
        return $this->get_one_where(array('menu_id' => $id));
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
            $where = array("menu_id" => $id);
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
}
