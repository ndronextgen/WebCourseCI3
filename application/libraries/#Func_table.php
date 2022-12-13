<?php

class Func_table
{

    function get_jml_tanggapan($Id)
    {
        $CI    = &get_instance();
        $query = $CI->db->query("SELECT count(*) as jml FROM tr_lapor_tanggapan WHERE Lapor_id = '$Id' ")->row();

        return $query->jml;
    }
    function generateRandomString($length = 6)
    {
        $characters = '023456789abcdefghjklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateRandomString2($length = 8)
    {
        $characters = '023456789abcdefghjklmnpqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function tgl_indonesia($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        //$bulan = tgl_indo(substr($tgl,5,2));
        $bulan = $this->getbulan(substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

    function tgl_indo($bulan)
    {
        $CI = &get_instance();
        $q = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();
        if (count($q) > 0) {
            $h = $q->Bulan;
        } else {
            $h = 'Not Defined(Bulan)';
        }

        return $h;
    }

    function gethari($hari)
    {

        if ($hari == 'Monday') {
            $namahari = "Senin";
        } else if ($hari == 'Tuesday') {
            $namahari = "Selasa";
        } else if ($hari == 'Wednesday') {
            $namahari = "Rabu";
        } else if ($hari == 'Thursday') {
            $namahari = "Kamis";
        } else if ($hari == 'Friday') {
            $namahari = "Jumat";
        } else if ($hari == 'Saturday') {
            $namahari = "Sabtu";
        } else if ($hari == 'Sunday') {
            $namahari = "Minggu";
        } else {
            $namahari = "";
        }
        return $namahari;
    }

    function getbulan($bulan)
    {

        if ($bulan == '01') {
            $namabulan = "Januari";
        } else if ($bulan == '02') {
            $namabulan = "Februari";
        } else if ($bulan == '03') {
            $namabulan = "Maret";
        } else if ($bulan == '04') {
            $namabulan = "April";
        } else if ($bulan == '05') {
            $namabulan = "Mei";
        } else if ($bulan == '06') {
            $namabulan = "Juni";
        } else if ($bulan == '07') {
            $namabulan = "Juli";
        } else if ($bulan == '08') {
            $namabulan = "Agustus";
        } else if ($bulan == '09') {
            $namabulan = "September";
        } else if ($bulan == '10') {
            $namabulan = "Oktober";
        } else if ($bulan == '11') {
            $namabulan = "November";
        } else if ($bulan == '12') {
            $namabulan = "Desember";
        } else {
            $namabulan = "";
        }
        return $namabulan;
    }

    function getBulanPendek($bulan)
    {

        if ($bulan == '01') {
            $namabulan = "Jan";
        } else if ($bulan == '02') {
            $namabulan = "Feb";
        } else if ($bulan == '03') {
            $namabulan = "Mar";
        } else if ($bulan == '04') {
            $namabulan = "Apr";
        } else if ($bulan == '05') {
            $namabulan = "Mei";
        } else if ($bulan == '06') {
            $namabulan = "Jun";
        } else if ($bulan == '07') {
            $namabulan = "Jul";
        } else if ($bulan == '08') {
            $namabulan = "Agt";
        } else if ($bulan == '09') {
            $namabulan = "Sep";
        } else if ($bulan == '10') {
            $namabulan = "Okt";
        } else if ($bulan == '11') {
            $namabulan = "Nov";
        } else if ($bulan == '12') {
            $namabulan = "Des";
        } else {
            $namabulan = "";
        }
        return $namabulan;
    }

    function in_tosee_pangkat($id_surat)
    {

        $CI = &get_instance();

        $user_view = $CI->session->userdata("username");
        $tgl_now = date('Y-m-d H:i:s');
        //$Query = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();

        $cek = $CI->db->query("SELECT count(*) as jml FROM tbl_data_surat_naik_pangkat_see 
											WHERE id_surat_naik_pangkat='$id_surat' AND user_view = '$user_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tbl_data_surat_naik_pangkat_see 
									SET 
									id_surat_naik_pangkat = $id_surat,
									user_view =  '$user_view',
									tgl_view = '$tgl_now',
									tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tbl_data_surat_naik_pangkat_see 
									SET tgl_update = '$tgl_now'
									WHERE id_surat_naik_pangkat='$id_surat' AND user_view = '$user_view' ");
        }
        return $Query;
    }

    function in_tosee_pensiun($id_surat)
    {

        $CI = &get_instance();

        $user_view = $CI->session->userdata("username");
        $tgl_now = date('Y-m-d H:i:s');
        //$Query = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();

        $cek = $CI->db->query("SELECT count(*) as jml FROM tbl_data_surat_pensiun_see 
											WHERE id_surat_pensiun='$id_surat' AND user_view = '$user_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tbl_data_surat_pensiun_see 
									SET 
									id_surat_pensiun = $id_surat,
									user_view =  '$user_view',
									tgl_view = '$tgl_now',
									tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tbl_data_surat_pensiun_see 
									SET tgl_update = '$tgl_now'
									WHERE id_surat_pensiun='$id_surat' AND user_view = '$user_view' ");
        }
        return $Query;
    }

    //public
    function in_tosee_sk($id, $id_surat, $status_surat, $id_view)
    {

        $CI = &get_instance();

        //$user_view = $CI->session->userdata("username");
        $tgl_now = date('Y-m-d H:i:s');
        //$Query = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();

        $cek = $CI->db->query("SELECT count(*) as jml FROM tbl_data_srt_ket_see 
											WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tbl_data_srt_ket_see 
									SET 
									user_create = $id,
									id_srt =  '$id_surat',
									id_view =  '$id_view',
									tgl_view = '$tgl_now',
                                    id_status_srt = '$status_surat',
									tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tbl_data_srt_ket_see 
									SET tgl_update = '$tgl_now'
									WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'");
        }
        return $Query;
    }

    function count_see_sk($id)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                    (
                                        SELECT
                                            fa.user_create,
                                            a.id_srt, a.id_user,
                                            a.nama, a.nip, a.nrk,
                                            a.alamat_domisili, a.status_pegawai, a.keterangan,
                                            a.jenis_surat, a.tgl_surat, a.id_status_srt,
                                            a.keterangan_ditolak, a.tgl_proses, a.id_user_proses,
                                            a.is_download
                                        FROM
                                            tbl_data_srt_ket as a
                                        LEFT JOIN (
                                            SELECT
                                                b.Id, b.user_create, b.id_srt, b.id_view,
                                                b.tgl_view, b.id_status_srt, b.tgl_update
                                            FROM
                                                tbl_data_srt_ket_see as b
                                            WHERE b.id_view = '$id'
                                        ) AS fa ON fa.id_srt = a.id_srt AND fa.id_status_srt = a.id_status_srt
                                        WHERE a.id_user = '$id' AND isnull(fa.user_create)
                                    ) AS DATA")->row();
        return $Query->jumlah;
    }

    function see_public($id, $id_surat)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT
                                            if(isnull(fa.user_create),0,1) as status_view
                                        FROM
                                            tbl_data_srt_ket as a
                                        LEFT JOIN (
                                            SELECT
                                                b.Id, b.user_create, b.id_srt, b.id_view,
                                                b.tgl_view, b.id_status_srt, b.tgl_update
                                            FROM
                                                tbl_data_srt_ket_see as b
                                            WHERE b.id_view = '$id' AND b.id_srt='$id_surat'
                                        ) AS fa ON fa.id_srt = a.id_srt AND fa.id_status_srt = a.id_status_srt
                                        WHERE a.id_user = '$id' AND a.id_srt='$id_surat'")->row();

        return $Query->status_view;
    }

    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " Belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10) . " Puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " Ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " Ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " Juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " Milyar" . $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai / 1000000000000) . " Trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "Minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }


    function in_tosee_masa_pensiun_admin($nrk)
    {

        $CI = &get_instance();

        $user_view = $CI->session->userdata("username");
        $tgl_now = date('Y-m-d H:i:s');
        //$Query = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();

        $cek = $CI->db->query("SELECT count(*) as jml FROM masa_pensiun_see 
											WHERE nrk='$nrk' AND user_view = '$user_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO masa_pensiun_see 
									SET 
									nrk = $nrk,
									user_view =  '$user_view',
									tgl_view = '$tgl_now',
									tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE masa_pensiun_see 
									SET tgl_update = '$tgl_now'
									WHERE nrk='$nrk' AND user_view = '$user_view' ");
        }
        return $Query;
    }

    function in_tosee_naik_pangkat_admin($nrk)
    {

        $CI = &get_instance();

        $user_view = $CI->session->userdata("username");
        $tgl_now = date('Y-m-d H:i:s');
        //$Query = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();

        $cek = $CI->db->query("SELECT count(*) as jml FROM naik_pangkat_see 
											WHERE nrk='$nrk' AND user_view = '$user_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO naik_pangkat_see 
									SET 
									nrk = $nrk,
									user_view =  '$user_view',
									tgl_view = '$tgl_now',
									tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE naik_pangkat_see 
									SET tgl_update = '$tgl_now'
									WHERE nrk='$nrk' AND user_view = '$user_view' ");
        }
        return $Query;
    }

    function removeTitleFromName($name)
    {
        $result = explode(',', $name);
        $result = count($result) > 1 ? $result[0] : $name;

        return $result;
    }

    function name_format($nama_lengkap)
    {
        $ci = &get_instance();
        $nama = $ci->func_table->removeTitleFromName($nama_lengkap);
        $nama = ucwords(strtolower($nama));
        return $nama;
    }

    function getRomawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

    function gen_nomor_surat($kode_lokasi)
    {
        $CI = &get_instance();

        $Bulan  = date('n');
        $Romawi = $this->getRomawi($Bulan);
        $Tahun  = date('Y');
        // -----
        $Query = $CI->db->query("SELECT nomor_surat FROM tbl_data_srt_ket WHERE nomor_surat != '' ORDER BY id_srt DESC LIMIT 1")->row();
        $result_max = isset($Query->nomor_surat) ? $Query->nomor_surat : '0';
        $ex_max = explode('/', $result_max);
        $Nur = $ex_max['0'] + 1;

        $kode =  sprintf("%04s", $Nur);
        $nomorbaru = $kode . '/' . $kode_lokasi . '/' . $Romawi . '/' . $Tahun;

        return $nomorbaru;
    }

    function set_tracking($id_surat, $id_status)
    {
        $ci = &get_instance();

        date_default_timezone_set("Asia/Jakarta");
        $date_now = date('Y-m-d H:i:s');
        $ses_username = $ci->session->userdata("username");

        $sSQL = "INSERT INTO `tbl_data_srt_ket_tracking` 
                SET id_srt = $id_surat, 
                    id_status_srt = $id_status, 
                    id_user_proses = '$ses_username', 
                    tgl_proses = '$date_now' ";
        $ci->db->query($sSQL);
    }
}
