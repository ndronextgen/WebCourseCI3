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

    function Combine_signature($path_signature, $name_signature, $stamp)
    {
        #jadikan png transparent

        $file_parts = pathinfo($path_signature);
        $file_name = 'Indra.png';

        switch ($file_parts['extension']) {
            case "jpg":
            case "jpeg":
            case "JPG":
            case "JPEG":
                $image = imagecreatefromjpeg($path_signature);
                imagealphablending($image, true);
                $transparentcolour = imagecolorallocate($image, 255, 255, 255);
                imagecolortransparent($image, $transparentcolour);
                imagepng($image, './asset/foto_pegawai/signature/transparent/' . $name_signature . '.png');
                break;
            case "png":
                $image = imagecreatefrompng($path_signature);
                $white = imagecolorallocate($image, 255, 255, 255);
                imagecolortransparent($image, $white);
                imagepng($image, './asset/foto_pegawai/signature/transparent/' . $name_signature . '');
                break;

            case "": // Handle file extension for files ending in '.'
            case NULL: // Handle no file extension
                break;
        }

        //$image = imagecreatefrompng($path_signature); //or another loading function you need


        $path_signature_new = base_url() . 'asset/foto_pegawai/signature/transparent/' . $name_signature;
        $path_layer_empty   = base_url() . 'asset/foto_pegawai/signature/combine/stamp/empty_image.png';
        //$stamp = imagecreatefrompng($stamp);

        // ----------
        $x = 450;
        $y = 250;
        // header('Content-Type: image/png');
        // $targetPath = './asset/foto_pegawai/signature/combine/';
        //$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

        $img1 = $path_layer_empty; //layer kosong
        $img2 = $stamp;
        $img3 = $path_signature_new;

        $outputImage = imagecreatetruecolor(450, 250);

        // set background to white
        $white = imagecolorallocate($outputImage, 255, 255, 255);
        imagefill($outputImage, 0, 0, $white);

        $first = imagecreatefrompng($img1);
        $second = imagecreatefrompng($img2);
        $third = imagecreatefrompng($img3);

        //imagecopyresized ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
        imagecopyresized($outputImage, $first, 0, 0, 0, 0, $x, $y, $x, $y);
        imagecopyresized($outputImage, $second, 10, 20, 0, 0, 200, 200, 200, 200);
        imagecopyresized($outputImage, $third, 120, 60, 0, 0, 250, 250, 250, 190);

        // Add the text
        //imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
        //$white = imagecolorallocate($im, 255, 255, 255);
        $text = '';
        $font = '';
        //imagettftext($outputImage, 32, 0, 150, 150, $white, $font, $text);

        //$filename =$targetPath .round(microtime(true)).'.png';
        // Permission Configuration
        //chmod($source, 0777);
        imagepng($outputImage, './asset/foto_pegawai/signature/combine/' . $name_signature . '');
        // ----------
        //transparentkan
        $path_signature_combine = base_url() . 'asset/foto_pegawai/signature/combine/' . $name_signature;
        $image2 = imagecreatefrompng($path_signature_combine); //or another loading function you need
        $white2 = imagecolorallocate($image2, 255, 255, 255);
        imagecolortransparent($image2, $white2);
        imagepng($image2, './asset/foto_pegawai/signature/combine/' . $name_signature . '');
        //return $name_signature;
        // } else {

        // }
    }

    function Combine_signature2($path_signature, $name_signature)
    {
        #jadikan png transparent
        $file_parts = pathinfo($path_signature);
        switch ($file_parts['extension']) {
            case "jpg":
            case "jpeg":
            case "JPG":
            case "JPEG":
                copy($path_signature, './asset/foto_pegawai/signature/transparent/' . $name_signature . '');
                break;
            case "png":
                // $dimensions = getimagesize($path_signature);
                // $newwidth = 250;
                // $newheight = 150;
                $image = imagecreatefrompng($path_signature);
                $white = imagecolorallocate($image, 255, 255, 255);
                imagecolortransparent($image, $white);
                imagepng($image, './asset/foto_pegawai/signature/transparent/' . $name_signature . '');
                break;

            case "": // Handle file extension for files ending in '.'
            case NULL: // Handle no file extension
                break;
        }
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

    // === verifikasi surat keterangan pegawai ===
    function count_see_verifikasi($id)
    {
        $CI = &get_instance();
        $cek_kepegawaian = $CI->db->query("SELECT count(*) as jml_kepegawaian
                                            FROM view_kasubag_kepegawaian WHERE id_pegawai = '$id'")->row();

        $cek_sekdis      = $CI->db->query("SELECT count(*) as jml_sekdis
                                            FROM view_sekdis WHERE id_pegawai = '$id'")->row();

        $cek_kasubag     = $CI->db->query("SELECT count(*) as jml_sudinupt, id_lokasi_kerja
                                            FROM view_kasubag WHERE id_pegawai = '$id'")->row();

        if ($cek_kepegawaian->jml_kepegawaian > 0) {
            $kondisi = " AND a.id_status_srt = '21' AND a.is_dinas = '1'";
        } else if ($cek_sekdis->jml_sekdis > 0) {
            $kondisi = " AND a.id_status_srt = '22'";
        } else if ($cek_kasubag->jml_sudinupt > 0) {
            $kondisi = " AND a.id_status_srt = '21' AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$cek_kasubag->id_lokasi_kerja'";
        } else {
            $kondisi = " AND a.id_status_srt = 'XX'";
        }
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
        (
            SELECT
                                        a.id_srt, a.id_user, a.nama, a.id_status_srt , jml, id_view
                                    FROM
                                        tbl_data_srt_ket AS a
                                    LEFT JOIN ( 
                                        SELECT count(*) AS jml, id_view, id_srt FROM tbl_data_srt_ket_see 
                                        WHERE id_view = '$id'
                                        GROUP BY id_view, id_srt 
                                    ) AS see ON see.id_srt = a.id_srt 
                                    WHERE a.id_srt !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
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


    // tunjangan see
    function count_see_tj($id)
    {
        $CI = &get_instance();
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                (
                                    SELECT
                                        fa.user_create,
                                        a.Id, a.Created_by,
                                        a.Status_progress
                                    FROM
                                        tr_tunjangan as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_tunjangan_see as b
                                        WHERE b.id_view = '$id'
                                    ) AS fa ON fa.id_srt = a.Tunjangan_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Created_by = '$id' AND isnull(fa.user_create)
                                ) AS DATA")->row();
        return $Query->jumlah;
    }
    function see_public_tj($id, $id_surat)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT
                                        if(isnull(fa.user_create),0,1) as status_view
                                    FROM
                                        tr_tunjangan as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_tunjangan_see as b
                                        WHERE b.id_view = '$id' AND b.id_srt='$id_surat'
                                    ) AS fa ON fa.id_srt = a.Tunjangan_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Created_by = '$id' AND a.Tunjangan_id='$id_surat'")->row();

        return $Query->status_view;
    }

    function in_tosee_tj($id, $id_surat, $status_surat, $id_view)
    {

        $CI = &get_instance();

        //$user_view = $CI->session->userdata("username");
        $tgl_now = date('Y-m-d H:i:s');
        //$Query = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();

        $cek = $CI->db->query("SELECT count(*) as jml FROM tr_tunjangan_see 
                                        WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tr_tunjangan_see 
                                SET 
                                user_create = $id,
                                id_srt =  '$id_surat',
                                id_view =  '$id_view',
                                tgl_view = '$tgl_now',
                                id_status_srt = '$status_surat',
                                tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tr_tunjangan_see 
                                SET tgl_update = '$tgl_now'
                                WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'");
        }
        return $Query;
    }

    // verifikasi tunjangan
    function count_see_verifikasi_tunjangan($id)
    {

        $CI = &get_instance();
        $cek_kepegawaian = $CI->db->query("SELECT count(*) as jml_kepegawaian
                                            FROM view_kasubag_kepegawaian WHERE nrk = '$id'")->row();

        $cek_sekdis      = $CI->db->query("SELECT count(*) as jml_sekdis
                                            FROM view_sekdis WHERE nrk = '$id'")->row();

        $cek_kasubag     = $CI->db->query("SELECT count(*) as jml_sudinupt, id_lokasi_kerja
                                            FROM view_kasubag WHERE nrk = '$id'")->row();

        if ($cek_kepegawaian->jml_kepegawaian > 0) {
            $kondisi = " AND (a.Status_progress = '21' OR a.Status_progress='26') AND a.is_dinas = '1'";
        } else if ($cek_sekdis->jml_sekdis > 0) {
            $kondisi = " AND a.Status_progress = '22'";
        } else if ($cek_kasubag->jml_sudinupt > 0) {
            $kondisi = " AND a.Status_progress = '21' AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$cek_kasubag->id_lokasi_kerja'";
        } else {
            $kondisi = " AND a.Status_progress = 'XX'";
        }
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
        (
            SELECT
                                        a.Tunjangan_id, a.Created_by, a.Status_progress, jml, id_view
                                    FROM
                                        tr_tunjangan AS a
                                    LEFT JOIN ( 
                                        SELECT count(*) AS jml, id_view, id_srt, id_status_srt FROM tr_tunjangan_see 
                                        WHERE id_view = '$id'
                                        GROUP BY id_view, id_srt 
                                    ) AS see ON see.id_srt = a.Tunjangan_id AND see.id_status_srt = a.Status_progress 
                                    WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
        return $Query->jumlah;
    }

    // end tunjangan see

    // kariskarsu see
    function count_see_kaku($id)
    {
        $CI = &get_instance();
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                (
                                    SELECT
                                        fa.user_create,
                                        a.Id, a.Created_by,
                                        a.Status_progress
                                    FROM
                                        tr_kariskarsu as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_kariskarsu_see as b
                                        WHERE b.id_view = '$id'
                                    ) AS fa ON fa.id_srt = a.Kariskarsu_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Created_by = '$id' AND isnull(fa.user_create)
                                ) AS DATA")->row();
        return $Query->jumlah;
    }
    function see_public_kaku($id, $id_surat)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT
                                        if(isnull(fa.user_create),0,1) as status_view
                                    FROM
                                        tr_kariskarsu as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_kariskarsu_see as b
                                        WHERE b.id_view = '$id' AND b.id_srt='$id_surat'
                                    ) AS fa ON fa.id_srt = a.Kariskarsu_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Created_by = '$id' AND a.Kariskarsu_id='$id_surat'")->row();

        return $Query->status_view;
    }

    function in_tosee_kaku($id, $id_surat, $status_surat, $id_view)
    {

        $CI = &get_instance();

        //$user_view = $CI->session->userdata("username");
        $tgl_now = date('Y-m-d H:i:s');
        //$Query = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();

        $cek = $CI->db->query("SELECT count(*) as jml FROM tr_kariskarsu_see 
                                        WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tr_kariskarsu_see 
                                SET 
                                user_create = $id,
                                id_srt =  '$id_surat',
                                id_view =  '$id_view',
                                tgl_view = '$tgl_now',
                                id_status_srt = '$status_surat',
                                tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tr_kariskarsu_see 
                                SET tgl_update = '$tgl_now'
                                WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'");
        }
        return $Query;
    }

    // verifikasi kariskarsu
    function count_see_verifikasi_kariskarsu($id)
    {

        $CI = &get_instance();
        $cek_kepegawaian = $CI->db->query("SELECT count(*) as jml_kepegawaian
                                            FROM view_kasubag_kepegawaian WHERE nrk = '$id'")->row();

        $cek_sekdis      = $CI->db->query("SELECT count(*) as jml_sekdis
                                            FROM view_sekdis WHERE nrk = '$id'")->row();

        $cek_kasubag     = $CI->db->query("SELECT count(*) as jml_sudinupt, id_lokasi_kerja
                                            FROM view_kasubag WHERE nrk = '$id'")->row();

        if ($cek_kepegawaian->jml_kepegawaian > 0) {
            $kondisi = " AND (a.Status_progress = '21' OR a.Status_progress='26') AND a.is_dinas = '1'";
        } else if ($cek_sekdis->jml_sekdis > 0) {
            $kondisi = " AND a.Status_progress = '22'";
        } else if ($cek_kasubag->jml_sudinupt > 0) {
            $kondisi = " AND a.Status_progress = '21' AND a.is_dinas != '1' AND a.lokasi_kerja_pegawai = '$cek_kasubag->id_lokasi_kerja'";
        } else {
            $kondisi = " AND a.Status_progress = 'XX'";
        }
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
        (
            SELECT
                                        a.Kariskarsu_id, a.Created_by, a.Status_progress, jml, id_view
                                    FROM
                                        tr_kariskarsu AS a
                                    LEFT JOIN ( 
                                        SELECT count(*) AS jml, id_view, id_srt, id_status_srt FROM tr_kariskarsu_see 
                                        WHERE id_view = '$id'
                                        GROUP BY id_view, id_srt 
                                        ) AS see ON see.id_srt = a.Kariskarsu_id AND see.id_status_srt = a.Status_progress 
                                    WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
        return $Query->jumlah;
    }

    // end kariskarsu see


    // hukdis see
    function count_see_hukdis($id)
    {
        $CI = &get_instance();
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                (
                                    SELECT
                                        fa.user_create,
                                        a.Id, a.Created_by,
                                        a.Status_progress
                                    FROM
                                        tr_hukdis as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_hukdis_see as b
                                        WHERE b.id_view = '$id'
                                    ) AS fa ON fa.id_srt = a.Hukdis_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Created_by = '$id' AND isnull(fa.user_create)
                                ) AS DATA")->row();
        return $Query->jumlah;
    }
    #digunakan untuk warna kuning higlight pada tr table, yang artinya berkaitan dengan view/detail
    function see_admin_hukdis($id, $id_surat)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT
                                        if(isnull(fa.user_create),0,1) as status_view
                                    FROM
                                        tr_hukdis as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_hukdis_see as b
                                        WHERE b.id_view = '$id' AND b.id_srt='$id_surat'
                                    ) AS fa ON fa.id_srt = a.Hukdis_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Hukdis_id='$id_surat'")->row();

        return $Query->status_view;
    }

    function in_tosee_hukdis($id, $id_surat, $status_surat, $id_view)
    {

        $CI = &get_instance();
        $tgl_now = date('Y-m-d H:i:s');
        $cek = $CI->db->query("SELECT count(*) as jml FROM tr_hukdis_see 
                                        WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tr_hukdis_see 
                                SET 
                                user_create = '$id',
                                id_srt =  '$id_surat',
                                id_view =  '$id_view',
                                tgl_view = '$tgl_now',
                                id_status_srt = '$status_surat',
                                tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tr_hukdis_see 
                                SET tgl_update = '$tgl_now'
                                WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'");
        }
        return $Query;
    }

    // verifikasi hukdis
    function count_see_verifikasi_hukdis($id)
    {

        $CI = &get_instance();
        $cek_kepegawaian = $CI->db->query("SELECT count(*) as jml_kepegawaian
                                            FROM view_kasubag_kepegawaian WHERE nrk = '$id'")->row();

        $cek_sekdis      = $CI->db->query("SELECT count(*) as jml_sekdis
                                            FROM view_sekdis WHERE nrk = '$id'")->row();

        if ($cek_kepegawaian->jml_kepegawaian > 0) {
            $kondisi = " AND (a.Status_progress = '21' OR a.Status_progress='26')";
        } else if ($cek_sekdis->jml_sekdis > 0) {
            $kondisi = " AND a.Status_progress = '22'";
        } else {
            $kondisi = " AND a.Status_progress = 'XX'";
        }
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
        (
            SELECT
                                        a.Hukdis_id, a.Created_by, a.Status_progress, jml, id_view
                                    FROM
                                        tr_hukdis AS a
                                    LEFT JOIN ( 
                                        SELECT count(*) AS jml, id_view, id_srt, id_status_srt FROM tr_hukdis_see 
                                        WHERE id_view = '$id'
                                        GROUP BY id_view, id_srt 
                                        ) AS see ON see.id_srt = a.Hukdis_id AND see.id_status_srt = a.Status_progress 
                                    WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
        return $Query->jumlah;
    }

    // end hukdis see

    // Tindak Pidana see
    function count_see_tp($id)
    {
        $CI = &get_instance();
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                (
                                    SELECT
                                        fa.user_create,
                                        a.Id, a.Created_by,
                                        a.Status_progress
                                    FROM
                                        tr_tindak_pidana as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_tindak_pidana_see as b
                                        WHERE b.id_view = '$id'
                                    ) AS fa ON fa.id_srt = a.Tindak_pidana_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Created_by = '$id' AND isnull(fa.user_create)
                                ) AS DATA")->row();
        return $Query->jumlah;
    }
    #digunakan untuk warna kuning higlight pada tr table, yang artinya berkaitan dengan view/detail
    function see_admin_tp($id, $id_surat)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT
                                        if(isnull(fa.user_create),0,1) as status_view
                                    FROM
                                        tr_tindak_pidana as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_tindak_pidana_see as b
                                        WHERE b.id_view = '$id' AND b.id_srt='$id_surat'
                                    ) AS fa ON fa.id_srt = a.Tindak_pidana_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Tindak_pidana_id='$id_surat'")->row();

        return $Query->status_view;
    }

    function in_tosee_tp($id, $id_surat, $status_surat, $id_view)
    {

        $CI = &get_instance();
        $tgl_now = date('Y-m-d H:i:s');
        $cek = $CI->db->query("SELECT count(*) as jml FROM tr_tindak_pidana_see 
                                        WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tr_tindak_pidana_see 
                                SET 
                                user_create = '$id',
                                id_srt =  '$id_surat',
                                id_view =  '$id_view',
                                tgl_view = '$tgl_now',
                                id_status_srt = '$status_surat',
                                tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tr_tindak_pidana_see 
                                SET tgl_update = '$tgl_now'
                                WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'");
        }
        return $Query;
    }

    // verifikasi TIndak Pidana
    function count_see_verifikasi_tp($id)
    {

        $CI = &get_instance();
        $cek_kepegawaian = $CI->db->query("SELECT count(*) as jml_kepegawaian
                                            FROM view_kasubag_kepegawaian WHERE nrk = '$id'")->row();

        $cek_sekdis      = $CI->db->query("SELECT count(*) as jml_sekdis
                                            FROM view_sekdis WHERE nrk = '$id'")->row();

        if ($cek_kepegawaian->jml_kepegawaian > 0) {
            $kondisi = " AND (a.Status_progress = '21' OR a.Status_progress='26')";
        } else if ($cek_sekdis->jml_sekdis > 0) {
            $kondisi = " AND a.Status_progress = '22'";
        } else {
            $kondisi = " AND a.Status_progress = 'XX'";
        }
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
        (
            SELECT
                                        a.Tindak_pidana_id, a.Created_by, a.Status_progress, jml, id_view
                                    FROM
                                        tr_tindak_pidana AS a
                                    LEFT JOIN ( 
                                        SELECT count(*) AS jml, id_view, id_srt, id_status_srt FROM tr_tindak_pidana_see 
                                        WHERE id_view = '$id'
                                        GROUP BY id_view, id_srt 
                                        ) AS see ON see.id_srt = a.Tindak_pidana_id AND see.id_status_srt = a.Status_progress 
                                    WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
        return $Query->jumlah;
    }

    // end Tindak Pidana see

    // Pengebangan Karir see
    function count_see_karir($id)
    {
        $CI = &get_instance();
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                (
                                    SELECT
                                        fa.user_create,
                                        a.Id, a.Created_by,
                                        a.Status_progress
                                    FROM
                                        tr_pengembangan_karir as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_pengembangan_karir_see as b
                                        WHERE b.id_view = '$id'
                                    ) AS fa ON fa.id_srt = a.Pengembangan_karir_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Created_by = '$id' AND isnull(fa.user_create)
                                ) AS DATA")->row();
        return $Query->jumlah;
    }
    #digunakan untuk warna kuning higlight pada tr table, yang artinya berkaitan dengan view/detail
    function see_admin_karir($id, $id_surat)
    {

        $CI = &get_instance();
        $Query = $CI->db->query("SELECT
                                        if(isnull(fa.user_create),0,1) as status_view
                                    FROM
                                        tr_pengembangan_karir as a
                                    LEFT JOIN (
                                        SELECT
                                            b.Id, b.user_create, b.id_srt, b.id_view,
                                            b.tgl_view, b.id_status_srt, b.tgl_update
                                        FROM
                                            tr_pengembangan_karir_see as b
                                        WHERE b.id_view = '$id' AND b.id_srt='$id_surat'
                                    ) AS fa ON fa.id_srt = a.Pengembangan_karir_id AND fa.id_status_srt = a.Status_progress
                                    WHERE a.Pengembangan_karir_id='$id_surat'")->row();

        return $Query->status_view;
    }

    function in_tosee_karir($id, $id_surat, $status_surat, $id_view)
    {

        $CI = &get_instance();
        $tgl_now = date('Y-m-d H:i:s');
        $cek = $CI->db->query("SELECT count(*) as jml FROM tr_pengembangan_karir_see 
                                        WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'")->row();
        if ($cek->jml == 0 || $cek->jml == '' || $cek->jml == NULL) {
            $Query = $CI->db->query("INSERT INTO tr_pengembangan_karir_see 
                                SET 
                                user_create = '$id',
                                id_srt =  '$id_surat',
                                id_view =  '$id_view',
                                tgl_view = '$tgl_now',
                                id_status_srt = '$status_surat',
                                tgl_update = '$tgl_now'");
        } else {
            $Query = $CI->db->query("UPDATE tr_pengembangan_karir_see 
                                SET tgl_update = '$tgl_now'
                                WHERE id_srt='$id_surat' AND user_create = '$id' AND id_status_srt = '$status_surat' AND id_view = '$id_view'");
        }
        return $Query;
    }

    // verifikasi Pengebangan Karir
    function count_see_verifikasi_karir($id)
    {

        $CI = &get_instance();
        $cek_kepegawaian = $CI->db->query("SELECT count(*) as jml_kepegawaian
                                            FROM view_kasubag_kepegawaian WHERE nrk = '$id'")->row();

        $cek_sekdis      = $CI->db->query("SELECT count(*) as jml_sekdis
                                            FROM view_sekdis WHERE nrk = '$id'")->row();

        if ($cek_kepegawaian->jml_kepegawaian > 0) {
            $kondisi = " AND (a.Status_progress = '21' OR a.Status_progress='26')";
        } else if ($cek_sekdis->jml_sekdis > 0) {
            $kondisi = " AND a.Status_progress = '22'";
        } else {
            $kondisi = " AND a.Status_progress = 'XX'";
        }
        $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
        (
            SELECT
                                        a.Pengembangan_karir_id, a.Created_by, a.Status_progress, jml, id_view
                                    FROM
                                        tr_pengembangan_karir AS a
                                    LEFT JOIN ( 
                                        SELECT count(*) AS jml, id_view, id_srt, id_status_srt FROM tr_pengembangan_karir_see 
                                        WHERE id_view = '$id'
                                        GROUP BY id_view, id_srt 
                                        ) AS see ON see.id_srt = a.Pengembangan_karir_id AND see.id_status_srt = a.Status_progress 
                                    WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
        return $Query->jumlah;
    }

    // end Pengebangan Karir see

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
        $Query = $CI->db->query("SELECT Nomor_terakhir FROM tbl_master_nomor_surat LIMIT 1")->row();
        $result_max = isset($Query->Nomor_terakhir) ? $Query->Nomor_terakhir : '0';
        // -----
        $Query_lokasi = $CI->db->query("SELECT acronim FROM tbl_master_lokasi_kerja WHERE id_lokasi_kerja = '$kode_lokasi'")->row();
        $result_lokasi = isset($Query_lokasi->acronim) ? $Query_lokasi->acronim : 'NL';

        $Nur = $result_max + 1;

        $kode =  sprintf("%04s", $Nur);
        //[nomor_urut]/KG.11.04/D
        $nomorbaru = $kode . "/KG.11.04/" . $result_lokasi;

        $Query_update = $CI->db->query("UPDATE tbl_master_nomor_surat SET Nomor_terakhir = Nomor_terakhir + 1");

        return $nomorbaru;
    }

    function gen_nomor_surat_kariskarsu()
    {
        $CI = &get_instance();

        $Tahun  = date('Y');
        // -----
        $Query = $CI->db->query("SELECT Nomor_terakhir_kariskarsu FROM tbl_master_nomor_surat LIMIT 1")->row();
        $result_max = isset($Query->Nomor_terakhir_kariskarsu) ? $Query->Nomor_terakhir_kariskarsu : '0';
        // -----

        $Nur = $result_max + 1;

        $kode =  sprintf("%04s", $Nur);
        //[nomor_urut]/KG.11.04/D
        $nomorbaru = $Nur . "/SE/" . $Tahun;

        $Query_update = $CI->db->query("UPDATE tbl_master_nomor_surat SET Nomor_terakhir_kariskarsu = Nomor_terakhir_kariskarsu + 1");

        return $nomorbaru;
    }

    function gen_nomor_surat_hukdis($kode_lokasi)
    {
        $CI = &get_instance();

        $Tahun  = date('Y');
        // -----
        $Query = $CI->db->query("SELECT Nomor_terakhir_hukdis FROM tbl_master_nomor_surat LIMIT 1")->row();
        $result_max = isset($Query->Nomor_terakhir_hukdis) ? $Query->Nomor_terakhir_hukdis : '0';
        // -----
        $Query_lokasi = $CI->db->query("SELECT acronim FROM tbl_master_lokasi_kerja WHERE id_lokasi_kerja = '$kode_lokasi'")->row();
        $result_lokasi = isset($Query_lokasi->acronim) ? $Query_lokasi->acronim : 'NL';

        $Nur = $result_max + 1;

        $kode =  sprintf("%04s", $Nur);
        //[nomor_urut]/KG.11.04/D
        //$nomorbaru = $Nur . "/SE/" . $Tahun;
        $nomorbaru = $Nur . "/KG.6.01/D";

        $Query_update = $CI->db->query("UPDATE tbl_master_nomor_surat SET Nomor_terakhir_hukdis = Nomor_terakhir_hukdis + 1");

        return $nomorbaru;
    }

    function gen_nomor_surat_tindak_pidana($kode_lokasi)
    {
        $CI = &get_instance();

        $Tahun  = date('Y');
        // -----
        $Query = $CI->db->query("SELECT Nomor_terakhir_tindak_pidana FROM tbl_master_nomor_surat LIMIT 1")->row();
        $result_max = isset($Query->Nomor_terakhir_tindak_pidana) ? $Query->Nomor_terakhir_tindak_pidana : '0';
        // -----
        $Query_lokasi = $CI->db->query("SELECT acronim FROM tbl_master_lokasi_kerja WHERE id_lokasi_kerja = '$kode_lokasi'")->row();
        $result_lokasi = isset($Query_lokasi->acronim) ? $Query_lokasi->acronim : 'NL';

        $Nur = $result_max + 1;

        $kode =  sprintf("%04s", $Nur);
        //[nomor_urut]/KG.11.04/D
        //$nomorbaru = $Nur . "/SE/" . $Tahun;
        $nomorbaru = $Nur . "/KG.8.00/D";

        $Query_update = $CI->db->query("UPDATE tbl_master_nomor_surat SET Nomor_terakhir_tindak_pidana = Nomor_terakhir_tindak_pidana + 1");

        return $nomorbaru;
    }

    function gen_nomor_surat_pengembangan_karir($kode_lokasi)
    {
        $CI = &get_instance();

        $Tahun  = date('Y');
        // -----
        $Query = $CI->db->query("SELECT Nomor_terakhir_pengembangan_karir FROM tbl_master_nomor_surat LIMIT 1")->row();
        $result_max = isset($Query->Nomor_terakhir_pengembangan_karir) ? $Query->Nomor_terakhir_pengembangan_karir : '0';
        // -----
        $Query_lokasi = $CI->db->query("SELECT acronim FROM tbl_master_lokasi_kerja WHERE id_lokasi_kerja = '$kode_lokasi'")->row();
        $result_lokasi = isset($Query_lokasi->acronim) ? $Query_lokasi->acronim : 'NL';

        $Nur = $result_max + 1;

        $kode =  sprintf("%04s", $Nur);
        //[nomor_urut]/KG.11.04/D
        //$nomorbaru = $Nur . "/SE/" . $Tahun;
        $nomorbaru = $Nur . "/KG.9.00/D";

        $Query_update = $CI->db->query("UPDATE tbl_master_nomor_surat SET Nomor_terakhir_pengembangan_karir = Nomor_terakhir_pengembangan_karir + 1");

        return $nomorbaru;
    }

    function status_verifikasi_user($id_pegawai)
    {
        $CI = &get_instance();
        #cek apakah session id_pegawai dengan view id_pegawai exist
        $user_id_pegawai = $CI->session->userdata("id_pegawai");
        $cek_kepegawaian = $CI->db->query("SELECT count(*) as jml_kepegawaian
                                            FROM view_kasubag_kepegawaian WHERE id_pegawai = '$user_id_pegawai'")->row();
        $cek_sekdis      = $CI->db->query("SELECT count(*) as jml_sekdis
                                            FROM view_sekdis WHERE id_pegawai = '$user_id_pegawai'")->row();
        $cek_kasubag     = $CI->db->query("SELECT count(*) as jml_sudinupt
                                                FROM view_kasubag WHERE id_pegawai = '$user_id_pegawai'")->row();

        if ($cek_kepegawaian->jml_kepegawaian > 0) {
            $status_user = 'kepegawaian';
        } else if ($cek_sekdis->jml_sekdis > 0) {
            $status_user = 'sekdis';
        } else if ($cek_kasubag->jml_sudinupt > 0) {
            $status_user = 'sudinupt';
        } else {
            $status_user = 'none';
        }
        return $status_user;
    }

    function SetNotif($notifPage, $notifModul, $notifLokasi, $notifUser, $userID)
    {
        $ci = &get_instance();

        date_default_timezone_set("Asia/Jakarta");
        $dateTimeNow = date('Y-m-d H:i:s');

        // update status data record yang lama
        // $sSQL = "UPDATE tr_notif
        // 		SET data_status = 0 
        // 		WHERE notif_page = $notifPage
        //             AND notif_user = '$notifUser'
        //             AND data_status = 1 ";
        // $ci->db->query($sSQL);

        // buat record baru - untuk admin wilayah (lokasi kerja)
        $sSQL = "INSERT INTO tr_notif
                SET 
                    notif_id = UNIX_TIMESTAMP(NOW()),
                    notif_page = '$notifPage',
                    notif_lokasi = '$notifLokasi',
                    notif_user = '$notifUser',
                    module_id = '$notifModul',
                    created_by = '$userID',
                    created_at = '$dateTimeNow',
                    data_status = '1' ";
        $ci->db->query($sSQL);
    }

    function ReadNotif($notifPage, $notifUser)
    {
        $ci = &get_instance();

        $lokasi = $ci->session->userdata('lokasi_kerja');
        if ($lokasi == 0) {
            $filter = "";
        } else {
            $filter = "AND notif_user = '" . $notifUser . "' ";
        }

        $sSQL = "UPDATE tr_notif
        		SET data_status = '0' 
        		WHERE notif_page = '$notifPage'
                    " . $filter . "
                    AND data_status = '1' ";
        $ci->db->query($sSQL);
    }

    function GetNotif($notifPage, $notifUser)
    {
        $ci = &get_instance();

        $sSQL = "SELECT notif_id
                FROM tr_notif
				WHERE notif_page = '$notifPage'
                    AND notif_user = '$notifUser'
					AND data_status = '1' ";
        $notif_count = $ci->db->query($sSQL)->numrows();

        return $notif_count;
    }

    function notifMessage($userCreate, $moduleID)
    {
        $ci = &get_instance();

        $sSQL = "SELECT nama_lengkap FROM tbl_user_login WHERE username = '$userCreate'";
        $rsSQL = $ci->db->query($sSQL);

        if ($rsSQL->num_rows() > 0) {
            // $nama_lengkap = $ci->func_table->name_format('Siadik');
            $nama_lengkap = $ci->func_table->name_format($rsSQL->row()->nama_lengkap);

            if ($rsSQL->num_rows() > 0) {
                $notif_message = $nama_lengkap . ' melakukan perubahan ' . $ci->func_table->name_format($this->module_name($moduleID) . '.');
            } else {
                $notif_message = $nama_lengkap . ' melakukan perubahan data.';
            }
        } else {
            $notif_message = '[tidak dikenal] melakukan perubahan data.';
        }

        return $notif_message;
    }

    function module_name($moduleID)
    {
        $ci = &get_instance();

        $sSQL = "SELECT SUBSTRING_INDEX(module_path, ' > ', -1) module_name FROM `mt_notif_modul` WHERE module_id = '$moduleID' ";
        $rsSQL = $ci->db->query($sSQL);

        if (isset($rsSQL)) {
            $module_name = $rsSQL->row()->module_name;
        } else {
            $module_name = '[menu tidak dikenal]';
        }

        return $module_name;
    }

    function dropdownNotif($notifPage, $userID, $isNew)
    {
        $ci = &get_instance();

        $lokasi_kerja = $ci->session->userdata('lokasi_kerja');

        $filter = "";
        if ($isNew == 1) {
            $filter = "AND data_status = 1 ";
        }

        if ($lokasi_kerja == 0) {
            $sSQL = "SELECT * FROM tr_notif 
                    WHERE notif_page = '$notifPage' 
                        " . $filter . "
                    ORDER BY created_at DESC ";
            // var_dump($sSQL);
            // die;
        } else {
            $sSQL = "SELECT * FROM tr_notif 
                    WHERE notif_page = '$notifPage' AND notif_user = '" . $userID . "'
                        " . $filter . "
                    ORDER BY created_at DESC ";
            // var_dump($sSQL);
            // die;
        }
        $rsSQL = $ci->db->query($sSQL);

        if ($rsSQL->num_rows() > 0) {
            foreach ($rsSQL->result() as $row) {
                $notif_data[] = [
                    'notif_module' => $ci->func_table->name_format($this->module_name($row->module_id)),
                    'notif_message' => $this->notifMessage($row->created_by, $row->module_id),
                    'time' => $row->created_at,

                    'notif_id' => $row->notif_id,
                    'data_status' => $row->data_status
                ];
            }
            return $notif_data;
        }
    }

    function timeDiff($timeOld, $timeNew)
    {
        //get Date diff as intervals 
        $interval = $timeOld->diff($timeNew);
        $diffInSeconds = $interval->s; //45
        $diffInMinutes = $interval->i; //23
        $diffInHours   = $interval->h; //8
        $diffInDays    = $interval->d; //21
        $diffInMonths  = $interval->m; //4
        $diffInYears   = $interval->y; //1

        $diff = '';
        if ($diffInYears > 0) {
            $diff .= $diffInYears . ' tahun ';
        } elseif ($diffInMonths > 0) {
            $diff .= $diffInMonths . ' bulan ';
        } elseif ($diffInDays > 0) {
            $diff .= $diffInDays . ' hari ';
        } elseif ($diffInHours > 0) {
            $diff .= $diffInHours . ' jam ';
        } elseif ($diffInMinutes > 0) {
            $diff .= $diffInMinutes . ' menit ';
        } elseif ($diffInSeconds > 0) {
            $diff .= $diffInSeconds . ' detik ';
        }
        $diff .= 'yang lalu';

        return $diff;
    }

    function getHariPendek($hari)
    {

        if ($hari == 'Monday') {
            $namahari = "Sen";
        } else if ($hari == 'Tuesday') {
            $namahari = "Sel";
        } else if ($hari == 'Wednesday') {
            $namahari = "Rab";
        } else if ($hari == 'Thursday') {
            $namahari = "Kam";
        } else if ($hari == 'Friday') {
            $namahari = "Jum";
        } else if ($hari == 'Saturday') {
            $namahari = "Sab";
        } else if ($hari == 'Sunday') {
            $namahari = "Min";
        } else {
            $namahari = "";
        }
        return $namahari;
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

    function tgl_indo_pendek($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = $this->getBulanPendek(substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

    function get_file_kariskarsu($file_kariskarsu)
    {
        $path_folder = 'asset/upload/kariskarsu';
        $path_file    = $path_folder . '/' . $file_kariskarsu;
        if (file_exists($path_file)) {
            $ext = pathinfo($path_file, PATHINFO_EXTENSION);

            if (strtolower($ext) == 'pdf') {
                $file = '	<a data-fancybox data-type="iframe" data-src="' . base_url($path_file) . '" href="javascript:void(0);">
                                <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i>PDF &nbsp;</button>
                            </a>';
            } else {
                $file = '	<a data-fancybox="images" href="' . base_url($path_file) . '" target="_blank">
                                <img height="30px" width="30px" src="' . base_url($path_file) . '">
                            </a>';
            }
        } else {
            $file = '-';
        }
        return $file;
    }

    function get_file($path_file, $file_name_ori)
    {
        if (file_exists($path_file)) {
            $ext = pathinfo($path_file, PATHINFO_EXTENSION);

            if (strtolower($ext) == 'pdf') {
                $file = '	<a data-fancybox data-type="iframe" data-src="' . base_url($path_file) . '" href="javascript:void(0);">
                                <button type="button" class="btn btn-danger btn-sm" title="' . $file_name_ori . '"><i class="fa fa-file"></i> &nbsp; PDF</button>
                            </a>';
            } else {
                $file = '	<a data-fancybox="images" href="' . base_url($path_file) . '" target="_blank">
                                <img height="30px" width="30px" src="' . base_url($path_file) . '" title="' . $file_name_ori . '">
                            </a>';
            }
        } else {
            $file = '-';
        }
        return $file;
    }

    function cek_kelengkapan_keluarga($keluarga_id)
    {
        // next aja 
        // masa sih??
    }

    function SSOGetUserFunc($username)
    {
        $ci = &get_instance();
        $ci->load->database();

        $status = false;
        $data = null;
        $msg = '';

        $appKey = '8ff009e7-556f-447a-8eb4-983a3984c6bf';
        $url = 'https://dcktrp.jakarta.go.id/satuakses/service/user?username=' . $username;
        $curl = curl_init();

        $headers = [
            'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
            'app-key: ' . $appKey
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $headers
        ));

        $resp = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            $msg = 'Error';
        } else {
            $resp = json_decode($resp);
            if ($resp->status == 'success') {
                $status = true;
                $data = $resp->data;
            } else {
                $msg = $resp->msg;
            }
        }

        curl_close($curl);

        // $response = [
        //     'status' => $status,
        //     'data' => $data,
        //     'message' => $msg
        // ];

        if ($resp->status == 'success') {

            $result = [
                'telepon' => $resp->data->siadik->telepon,
                'nip' => $resp->data->siadik->nip,
                'foto' => $resp->data->siadik->foto,
                'thumb_foto' => $resp->data->siadik->thumb_foto,
                'signature' => $resp->data->siadik->signature
            ];
        } else {

            $result = [
                'telepon' => '',
                'nip' => '',
                'foto' => base_url('assets\media\foto_pegawai\no-image\nofoto.png'),
                'thumb_foto' => base_url('assets\media\foto_pegawai\no-image\nofoto.png'),
                'signature' => base_url('asset\img\white-blank.png')
            ];
        }

        return $result;
    }
}
