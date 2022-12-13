<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

function countSuratKeterangan() {
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->get_where('tbl_data_srt_ket', ['id_status_srt' => 0])->num_rows();
}

function countSuratNaikPangkat() {
    $ci=& get_instance();
    $ci->load->database();
    return $ci->db->get_where('tbl_data_surat_naik_pangkat', ['id_status_srt' => 0])->num_rows();
}