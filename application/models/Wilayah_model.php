<?php
class Wilayah_model extends CI_Model
{
	function data_provinsi($kode_provinsi)
    {
        $this->db->select('kode_provinsi,nama_provinsi')->where('kode_provinsi', $kode_provinsi);
        $query = $this->db->limit(1)->get('tbl_master_wilayah');

        $result = null;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $dt) {
                $result = $dt;
            }
        }
        
        return $result;
    }

	function kabupaten_list($kode_provinsi)
    {
        $query = $this->db->select('kode_kabupaten,nama_kabupaten')
                    ->where('kode_provinsi', $kode_provinsi)
                    ->group_by('kode_kabupaten,nama_kabupaten')
                    ->get('tbl_master_wilayah');
        $output = '<option value="">Kab/ Kota</option>';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $dt) {
                $output .= '<option value="'.$dt['kode_kabupaten'].'">'.$dt['nama_kabupaten'].'</option>';
            }
        }
        
        return $output;
    }

    function data_kabupaten($kode_kabupaten)
    {
        $this->db->select('kode_kabupaten,nama_kabupaten')->where('kode_kabupaten', $kode_kabupaten);
        $query = $this->db->limit(1)->get('tbl_master_wilayah');

        $result = null;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $dt) {
                $result = $dt;
            }
        }
        
        return $result;
    }

	function kecamatan_list($kode_kabupaten)
    {
        $query = $this->db->select('kode_kecamatan,nama_kecamatan')
                    ->where('kode_kabupaten', $kode_kabupaten)
                    ->group_by('kode_kecamatan,nama_kecamatan')
                    ->get('tbl_master_wilayah');
        $output = '<option value="">Kecamatan</option>';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $dt) {
                $output .= '<option value="'.$dt['kode_kecamatan'].'">'.$dt['nama_kecamatan'].'</option>';
            }
        }
        
        return $output;
    }

    function data_kecamatan($kode_kecamatan)
    {
        $this->db->select('kode_kecamatan,nama_kecamatan')->where('kode_kecamatan', $kode_kecamatan);
        $query = $this->db->limit(1)->get('tbl_master_wilayah');

        $result = null;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $dt) {
                $result = $dt;
            }
        }
        
        return $result;
    }

	function kelurahan_list($kode_kecamatan)
    {
        $query = $this->db->select('kode_kelurahan,nama_kelurahan')
                    ->where('kode_kecamatan', $kode_kecamatan)
                    ->group_by('kode_kelurahan,nama_kelurahan')
                    ->get('tbl_master_wilayah');
        $output = '<option value="">Kelurahan</option>';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $dt) {
                $output .= '<option value="'.$dt['kode_kelurahan'].'">'.$dt['nama_kelurahan'].'</option>';
            }
        }
        
        return $output;
    }

    function data_kelurahan($kode_kelurahan)
    {
        $this->db->select('kode_kelurahan,nama_kelurahan')->where('kode_kelurahan', $kode_kelurahan);
        $query = $this->db->limit(1)->get('tbl_master_wilayah');

        $result = null;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $dt) {
                $result = $dt;
            }
        }
        
        return $result;
    }
 
}

?>