<?php

class Func_table_lapor
{

    function Notifikasi_administrator(){
        $CI = &get_instance();
        $Query_admin = $CI->db->query("SELECT username FROM view_dinas")->result();
        return $Query_admin;
    }
    function Notifikasi_admin_wilayah($lokasi_kerja){
        $CI = &get_instance();
        $Query_admin = $CI->db->query("SELECT username FROM view_admin_wilayah where id_lokasi_kerja = '$lokasi_kerja'")->result();
        return $Query_admin;
    }
    
    //public
    function in_tosee_lapor($created_by, $lapor_id, $tanggapan_id, $id_view)
    {
        $CI = &get_instance();
        $tgl_now = date('Y-m-d H:i:s');
        #cek apakah admin/public 
        #jika public maka tidak perlu insert admin terkait notifikaksi
        $is_admin = $CI->session->userdata("stts"); //administrator/public
        $get_lapor = $CI->db->query("SELECT id_lokasi_kerja FROM tr_lapor WHERE Id='$lapor_id'")->row();
        if($is_admin=='administrator'){
            $data_administrator = $CI->func_table_lapor->Notifikasi_administrator();
            $data_admin_wilayah = $CI->func_table_lapor->Notifikasi_admin_wilayah($get_lapor->id_lokasi_kerja);
            foreach($data_administrator as $key){
                $cek = $CI->db->query("SELECT count(*) as jml FROM tr_lapor_see 
                                                WHERE Lapor_id='$lapor_id' AND User_create = '$created_by' AND Tanggapan_id = '$tanggapan_id' AND Id_view = '$key->username'")->row();
                if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
                    $Query = $CI->db->query("INSERT INTO tr_lapor_see 
                                        SET 
                                        User_create     = '$created_by',
                                        Lapor_id        = '$lapor_id',
                                        Tanggapan_id    = '$tanggapan_id',
                                        Id_view         = '$key->username',
                                        Tgl_view        = '$tgl_now',
                                        Tgl_update      = '$tgl_now'");
                } else {
                    $Query = $CI->db->query("UPDATE tr_lapor_see 
                                        SET tgl_update = '$tgl_now'
                                        WHERE Lapor_id='$lapor_id' AND User_create = '$created_by' AND Tanggapan_id = '$tanggapan_id' AND Id_view = '$key->username'");
                }
            }
            #lakukan insert kepada wilayah
            foreach($data_admin_wilayah as $key){
                $cek = $CI->db->query("SELECT count(*) as jml FROM tr_lapor_see 
                                                WHERE Lapor_id='$lapor_id' AND User_create = '$created_by' AND Tanggapan_id = '$tanggapan_id' AND Id_view = '$key->username'")->row();
                if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
                    $Query = $CI->db->query("INSERT INTO tr_lapor_see 
                                        SET 
                                        User_create     = '$created_by',
                                        Lapor_id        = '$lapor_id',
                                        Tanggapan_id    = '$tanggapan_id',
                                        Id_view         = '$key->username',
                                        Tgl_view        = '$tgl_now',
                                        Tgl_update      = '$tgl_now'");
                } else {
                    $Query = $CI->db->query("UPDATE tr_lapor_see 
                                        SET tgl_update = '$tgl_now'
                                        WHERE Lapor_id='$lapor_id' AND User_create = '$created_by' AND Tanggapan_id = '$tanggapan_id' AND Id_view = '$key->username'");
                }
            }
        } else { //public
            $cek = $CI->db->query("SELECT count(*) as jml FROM tr_lapor_see 
                                            WHERE Lapor_id='$lapor_id' AND User_create = '$created_by' AND Tanggapan_id = '$tanggapan_id' AND Id_view = '$id_view'")->row();
            if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
                $Query = $CI->db->query("INSERT INTO tr_lapor_see 
                                    SET 
                                    User_create     = '$created_by',
                                    Lapor_id        = '$lapor_id',
                                    Tanggapan_id    = '$tanggapan_id',
                                    Id_view         = '$id_view',
                                    Tgl_view        = '$tgl_now',
                                    Tgl_update      = '$tgl_now'");
            } else {
                $Query = $CI->db->query("UPDATE tr_lapor_see 
                                    SET tgl_update = '$tgl_now'
                                    WHERE Lapor_id='$lapor_id' AND User_create = '$created_by' AND Tanggapan_id = '$tanggapan_id' AND Id_view = '$id_view'");
            }
        }
        return $Query;
    }

    function count_see_lapor_public($id)
    {
        $CI = &get_instance();
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                (
                                    SELECT
                                        fa.user_create,
                                        a.Id, a.Created_by
                                    FROM
                                        tr_lapor as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.User_create, b.Lapor_id, b.Tanggapan_id, b.Id_view,
                                            b.Tgl_view, b.tgl_update
                                        FROM
                                            tr_lapor_see as b
                                        WHERE b.Id_view = '$id'
                                    ) AS fa ON fa.Lapor_id = a.Id AND fa.Tanggapan_id = a.Tanggapan_id
                                    WHERE a.Created_by = '$id' AND isnull(fa.User_create) AND a.Tanggapan_id != '0' AND date_add(a.Updated_at,interval 1 day) > now()
                                ) AS DATA")->row();
        return $Query->jumlah;
    }

    function see_table_public_lapor($id, $lapor_id)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT
                                        if(isnull(fa.user_create),0,1) as status_view
                                    FROM
                                        tr_lapor as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.User_create, b.Lapor_id, b.Tanggapan_id, b.Id_view,
                                            b.Tgl_view, b.tgl_update
                                        FROM
                                            tr_lapor_see as b
                                        WHERE b.Id_view = '$id' and b.Lapor_id = '$lapor_id'
                                    ) AS fa ON fa.Lapor_id = a.Id AND fa.Tanggapan_id = a.Tanggapan_id
                                    WHERE a.Created_by = '$id' AND a.Id = '$lapor_id' AND isnull(fa.User_create) 
                                            AND a.Tanggapan_id != '0' AND date_add(a.Updated_at,interval 5 minute) > now()")->row();

        return isset($Query->status_view) ? $Query->status_view : '1';
    }

    function see_table_admin_lapor($id, $lapor_id)
    {

        $CI = &get_instance();
        $lokasi_kerja_id=$CI->session->userdata('lokasi_kerja');
        $username_id=$CI->session->userdata('username');
        $cek_admin_utama = $CI->db->query("SELECT count(*) as jml_admin_utama FROM view_dinas WHERE username = '$username_id'")->row();
        $cek_admin_wilayah = $CI->db->query("SELECT count(*) as jml_admin_wilayah, id_lokasi_kerja FROM view_admin_wilayah 
                                                WHERE username = '$username_id' AND id_lokasi_kerja = '$lokasi_kerja_id'")->row();
        
        # administrator
        if ($cek_admin_utama->jml_admin_utama > 0) { 
            $kondisi = " ";
        #admun wilayah
        } else if ($cek_admin_wilayah->jml_admin_wilayah > 0) {
            $kondisi = " AND a.id_lokasi_kerja = '$lokasi_kerja_id'";
        } else {
            $kondisi = " AND a.id_lokasi_kerja = 'XX'";
        }
        $Query = $CI->db->query("SELECT if(isnull(DATA.user_create) AND DATA.counter_notif = '0',0,1) as status_view 
                                    FROM
                                    (
                                        SELECT
                                                        fa.User_create,
                                                        a.Id, a.Created_by, a.Updated_at, a.Tanggapan_id,
                                                        (
                                                            CASE 
                                                                    WHEN a.Tanggapan_id != '0' AND date_add(a.Updated_at,interval 5 minute) < now() THEN '0'
                                                                    WHEN a.Tanggapan_id != '0' AND date_add(a.Updated_at,interval 5 minute) > now() THEN '1'
                                                                    WHEN a.Tanggapan_id = '0' THEN '0'
                                                                    ELSE '0'
                                                            END
                                                        ) AS counter_notif
                                                        
                                        FROM
                                                        tr_lapor as a
                                        LEFT JOIN (
                                                        SELECT
                                                                        b.Id, b.User_create, b.Lapor_id, b.Tanggapan_id, b.Id_view,
                                                                        b.Tgl_view, b.tgl_update
                                                        FROM
                                                                        tr_lapor_see as b
                                                        WHERE b.Id_view = '$id' and b.Lapor_id = '$lapor_id'
                                        ) AS fa ON fa.Lapor_id = a.Id AND fa.Tanggapan_id = a.Tanggapan_id
                                        WHERE isnull(fa.User_create)  AND a.Id = '$lapor_id'   
                                    ) AS DATA")->row();

        return isset($Query->status_view) ? $Query->status_view : '1';
    }
    
}
// End of file Func_table_lapor.php
// Location: ./application/libraries/Func_table_lapor.php
