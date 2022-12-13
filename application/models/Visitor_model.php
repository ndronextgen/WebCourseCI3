<?php

// JOE - 5 Jul 2022
// Login pengunjung, hitung pengunjung, dan logout pengunjung

class Visitor_model extends CI_Model
{

    function visitor_login()
    {
        $username = $this->session->userdata('username');

        if ($username != "") {

            date_default_timezone_set("Asia/Jakarta");
            $date       = date("Y-m-d"); // Mendapatkan tanggal sekarang
            $timevisit  = date("Y-m-d H:i:s"); // Mendapatkan tanggal & jam sekarang
            $ip         = $this->input->ip_address(); // Mendapatkan IP user

            // Cek berdasarkan tanggal dan username, apakah user sudah pernah mengakses hari ini
            $sSQL = "SELECT username 
                    FROM tbl_visitor 
                    WHERE tanggal='" . $date . "' AND username='" . $username . "' AND ip='" . $ip . "' ";
            $s = $this->db->query($sSQL)->num_rows();
            $ss = isset($s) ? ($s) : 0;

            // Kalau belum ada, simpan data user tersebut ke database
            if ($ss == 0) {
                $this->db->query(
                    "INSERT INTO tbl_visitor(tanggal, username, ip, hits, time_visit, online_stat) 
                    VALUES('" . $date . "','" . $username . "','" . $ip . "','1','" . $timevisit . "', '1') "
                );
            }

            // Jika sudah ada, update
            else {
                $this->db->query(
                    "UPDATE tbl_visitor 
                    SET hits=hits+1, time_visit='" . $timevisit . "', online_stat='1' 
                    WHERE tanggal='" . $date . "' AND username='" . $username . "' AND ip='" . $ip . "' "
                );
            }

            // JOE 11 JUL 2022
            // set online_stat=0 where tanggal < now
            $this->db->query(
                "UPDATE tbl_visitor 
                SET online_stat='0' 
                WHERE tanggal < '" . $date . "' AND online_stat='1' "
            );

            // BEGIN JOE - 6 Jul 2022
            // set online_stat=0 untuk record dengan time_visit lebih dari 0.5 jam yang lalu (sesuai durasi session di SSO)
            // JOE - 11 Jul 2022 (REM)
            // $this->db->query("
            //     UPDATE tbl_visitor 
            //     SET online_stat='0' 
            //     WHERE time_visit < ('" . $timevisit . "' - INTERVAL '30' MINUTE) AND online_stat='1'
            //     ");
            // END JOE - 6 Jul 2022

            return $username;
        }
    }

    function visitor_login_count()
    {
        date_default_timezone_set("Asia/Jakarta");
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang

        $today  = $this->db->query(
            "SELECT username 
            FROM tbl_visitor 
            WHERE tanggal='" . $date . "' 
            GROUP BY username"
        )->num_rows(); // Hitung jumlah pengunjung
        $total = $this->db->query(
            "SELECT username 
            FROM tbl_visitor 
            GROUP BY tanggal, username"
        )->num_rows();
        $online  = $this->db->query(
            "SELECT username 
            FROM tbl_visitor 
            WHERE online_stat='1'"
        )->num_rows(); // hitung pengunjung online

        $data['visitor_today'] = $today;
        $data['visitor_total'] = $total;
        $data['visitor_online'] = $online;

        return $data;
    }

    function visitor_logout()
    {
        date_default_timezone_set("Asia/Jakarta");
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $username = $this->session->userdata('username');
        $ip = $this->input->ip_address(); // Mendapatkan IP user

        $this->db->query(
            "UPDATE tbl_visitor 
            SET online_stat='0' 
            WHERE tanggal='" . $date . "' AND username='" . $username . "' AND ip='" . $ip . "' "
        );
    }
}
