<?php
class Jabatan_model extends CI_Model
{

    function status_jabatan()
    {
        $this->db->order_by("id_status_jabatan", "DSC");
        $query = $this->db->get("tbl_master_status_jabatan");
        return $query->result();
    }

    function nama_jabatan($id_status_jabatan)
    {
        $this->db->where('id_status_jabatan', $id_status_jabatan);
        $this->db->order_by('nama_jabatan', 'ASC');
        $query = $this->db->get('tbl_master_nama_jabatan');
        $output = '<option value="">Pilih Nama Jabatan</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id_nama_jabatan . '">' . $row->nama_jabatan . '</option>';
        }
        return $output;
    }

    function rumpun_jabatan()
    {
        $this->db->order_by('nama_rumpun_jabatan', 'ASC');
        $query = $this->db->get('tbl_master_rumpun_jabatan');
        $output = '<option value="">Pilih Rumpun Jabatan</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id_rumpun_jabatan . '">' . $row->nama_rumpun_jabatan . '</option>';
        }
        return $output;
    }
}
