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


    #----------------------------------- WA EMAIL -------------------------------
    #----------------------------------------------------------------------------
    function Notifikasi_data($nomor_surat)
    {
        $CI = &get_instance();
        #Query_notif_beta
        // $Query_data2 = $CI->db->query("SELECT 
        //                                 a.email as mail_pegawai, a.telepon as tlp_pegawai, a.lokasi_kerja,  
        //                                 b.email as mail_admin_lokasi, b.telepon as tlp_admin_lokasi, 
        //                                 c.email as mail_kasubag_kepegawaian, c.telepon as tlp_kasubag_kepegawaian,
        //                                 d.email as mail_sekdis, d.telepon as tlp_sekdis,
        //                                 e.email as mail_dinas, e.telepon as tlp_dinas
        //                             FROM tbl_data_pegawai as a
        //                             LEFT JOIN (
        //                                 SELECT email, telepon, id_lokasi_kerja
        //                                 FROM tbl_user_login 
        //                                 WHERE stts='administrator'
        //                             ) as b ON b.id_lokasi_kerja = a.lokasi_kerja
        //                             LEFT JOIN (
        //                                 SELECT email, telepon, nrk
        //                                 FROM view_kasubag_kepegawaian 
        //                             ) as c ON c.nrk != ''
        //                             LEFT JOIN (
        //                                 SELECT email, telepon, nrk
        //                                 FROM view_sekdis
        //                             ) as d ON d.nrk != ''
        //                             LEFT JOIN (
        //                                 SELECT email, telepon, username
        //                                 FROM view_dinas
        //                             ) as e ON e.username != ''
        //                             WHERE a.id_pegawai = '$id_pegawai'")->row();
        $Query_data = $CI->db->query("SELECT
                                    a.id_srt, a.id_user, a.nama, 
                                    a.nip, a.nrk, a.alamat_domisili, 
                                    a.status_pegawai, a.keterangan, 
                                    a.jenis_surat, a.jenis_pengajuan_surat, 
                                    a.jenis_pengajuan_surat_lainnya, a.tgl_surat, 
                                    a.id_status_srt, a.keterangan_ditolak, 
                                    a.select_ttd, a.tgl_proses, 
                                    a.id_user_proses, a.is_download, 
                                    a.file_name, a.file_name_ori, 
                                    a.nomor_surat, a.Created_at, a.Updated_at,a.Updated_by,
                                    b.nama_surat, nama_status as `status`, sort, sort_bidang,
                                    IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
                                    list.lokasi_kerja, list.dinas,
                                    list.email as mail_pegawai, list.telepon as tlp_pegawai,
                                    f.username as uname_updated, f.nama_lengkap as nama_updated, f.email as email_updated, f.telepon as telepon_updated,
                                    g.nama_pegawai as nama_kasubag_kepegawaian, g.email as mail_kasubag_kepegawaian, g.telepon as tlp_kasubag_kepegawaian,
                                    h.nama_pegawai as nama_sekdis, h.email as mail_sekdis, h.telepon as tlp_sekdis,
                                    nama_admin_terkait, email_admin_terkait, telepon_admin_terkait
                                FROM
                                    tbl_data_srt_ket AS a
                                LEFT JOIN (
                                    SELECT id_mst_srt, nama_surat FROM tbl_master_surat
                                ) AS b ON b.id_mst_srt = a.jenis_surat
                                LEFT JOIN (
                                    SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
                                ) AS c ON c.id_status = a.id_status_srt
                                LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
                                INNER JOIN (
                                            SELECT
                                                ax.id_pegawai, ax.lokasi_kerja, bx.dinas, ax.telepon, ax.email, 
                                                cx.nama_lengkap as nama_admin_terkait, cx.email as email_admin_terkait, cx.telepon as telepon_admin_terkait
                                            FROM
                                                tbl_data_pegawai AS ax
                                            LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
                                            LEFT JOIN (
                                                    SELECT nama_lengkap, email, telepon, id_lokasi_kerja
                                                    FROM tbl_user_login 
                                                    WHERE stts='administrator'
                                                    GROUP BY id_lokasi_kerja 
                                            ) as cx ON cx.id_lokasi_kerja = ax.lokasi_kerja
                                                                                        
                                ) list ON a.id_user = list.id_pegawai
                                LEFT JOIN (
                                        SELECT id_user_login, username, nama_lengkap, email, telepon
                                        FROM tbl_user_login 
                                ) as f ON f.id_user_login = a.Updated_by
                                LEFT JOIN (
                                    SELECT nama_pegawai, email, telepon, nrk
                                    FROM view_kasubag_kepegawaian 
                                ) as g ON g.nrk != ''
                                LEFT JOIN (
                                    SELECT nama_pegawai, email, telepon, nrk
                                    FROM view_sekdis
                                ) as h ON h.nrk != ''
                                    
                                WHERE a.nomor_surat = '$nomor_surat'")->row();
        return $Query_data;
    }

    function Notifikasi_data_admin($id_surat)
    {
        $CI = &get_instance();
        #Query_notif_beta
        $Query_data = $CI->db->query("SELECT
                                    a.id_srt, a.id_user, a.nama, 
                                    a.nip, a.nrk, a.alamat_domisili, 
                                    a.status_pegawai, a.keterangan, 
                                    a.jenis_surat, a.jenis_pengajuan_surat, 
                                    a.jenis_pengajuan_surat_lainnya, a.tgl_surat, 
                                    a.id_status_srt, a.keterangan_ditolak, 
                                    a.select_ttd, a.tgl_proses, 
                                    a.id_user_proses, a.is_download, 
                                    a.file_name, a.file_name_ori, 
                                    a.nomor_surat, a.Created_at, a.Updated_at,a.Updated_by,
                                    b.nama_surat, nama_status as `status`, sort, sort_bidang,
                                    IF( a.jenis_pengajuan_surat = 'X', concat( e.keterangan, '(', a.jenis_pengajuan_surat_lainnya, ')' ), e.keterangan ) AS keterangan_pengajuan,
                                    list.lokasi_kerja, list.dinas,
                                    list.email as mail_pegawai, list.telepon as tlp_pegawai,
                                    f.username as uname_updated, f.nama_lengkap as nama_updated, f.email as email_updated, f.telepon as telepon_updated,
                                    g.nama_pegawai as nama_kasubag_kepegawaian, g.email as mail_kasubag_kepegawaian, g.telepon as tlp_kasubag_kepegawaian,
                                    h.nama_pegawai as nama_sekdis, h.email as mail_sekdis, h.telepon as tlp_sekdis,
                                    nama_admin_terkait, email_admin_terkait, telepon_admin_terkait
                                FROM
                                    tbl_data_srt_ket AS a
                                LEFT JOIN (
                                    SELECT id_mst_srt, nama_surat FROM tbl_master_surat
                                ) AS b ON b.id_mst_srt = a.jenis_surat
                                LEFT JOIN (
                                    SELECT id_status, nama_status, sort, sort_bidang FROM tbl_status_surat
                                ) AS c ON c.id_status = a.id_status_srt
                                LEFT JOIN tbl_master_jenis_pengajuan_surat e ON a.jenis_pengajuan_surat = e.kode
                                INNER JOIN (
                                            SELECT
                                                ax.id_pegawai, ax.lokasi_kerja, bx.dinas, ax.telepon, ax.email, 
                                                cx.nama_lengkap as nama_admin_terkait, cx.email as email_admin_terkait, cx.telepon as telepon_admin_terkait
                                            FROM
                                                tbl_data_pegawai AS ax
                                            LEFT JOIN tbl_master_lokasi_kerja AS bx ON ax.lokasi_kerja = bx.id_lokasi_kerja
                                            LEFT JOIN (
                                                    SELECT nama_lengkap, email, telepon, id_lokasi_kerja
                                                    FROM tbl_user_login 
                                                    WHERE stts='administrator'
                                                    GROUP BY id_lokasi_kerja 
                                            ) as cx ON cx.id_lokasi_kerja = ax.lokasi_kerja
                                ) list ON a.id_user = list.id_pegawai
                                LEFT JOIN (
                                        SELECT id_user_login, username, nama_lengkap, email, telepon
                                        FROM tbl_user_login 
                                ) as f ON f.id_user_login = a.Updated_by
                                LEFT JOIN (
                                    SELECT nama_pegawai, email, telepon, nrk
                                    FROM view_kasubag_kepegawaian 
                                ) as g ON g.nrk != ''
                                LEFT JOIN (
                                    SELECT nama_pegawai, email, telepon, nrk
                                    FROM view_sekdis
                                ) as h ON h.nrk != ''
                                    
                                WHERE a.id_srt = '$id_surat'")->row();
        return $Query_data;
    }

    function get_sapaan($param)
    {
        $time_start_pagi     = strtotime('00:00:01');
        $time_start_siang     = strtotime('10:00:00');
        $time_start_sore     = strtotime('15:00:00');
        $time_start_malam     = strtotime('18:00:00');
        $time_end             = strtotime('23:59:59');

        if ($param >= $time_start_pagi && $param < $time_start_siang) {
            $sapaan = 'Selamat Pagi, ';
        } elseif ($param >= $time_start_siang && $param < $time_start_sore) {
            $sapaan = 'Selamat Siang, ';
        } elseif ($param >= $time_start_sore && $param < $time_start_malam) {
            $sapaan = 'Selamat Sore, ';
        } elseif ($param >= $time_start_malam && $param < $time_end) {
            $sapaan = 'Selamat Malam, ';
        } else {
            $sapaan = '';
        }

        return $sapaan;
    }

    function Get_footer()
    {
        $footer_notif = "
<b>Terimakasih</b> <br/>
<br/>
Best Regards,<br/>
Pusdatin, Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta <br/>
Gedung Dinas Teknis Jatibaru Lt.2 <br/>
<br/>
Jl. Taman Jatibaru No.1, RT.17/RW.1, Cideng, Gambir, Kota Jakarta Pusat, <br/>
Daerah Khusus Ibukota Jakarta 10150
    ";

        return $footer_notif;
    }

    function notif_sk_pegawai_tambah($nomor_surat)
    {
        $CI = &get_instance();
        $CI->load->helper('send_email');
        $CI->load->helper('wa');

        // ---------------------------
        $tgl_now = date('Y-m-d H:i:s');
        $data_penerima  = $CI->func_table->Notifikasi_data($nomor_surat);
        $Hari             = $CI->func_table->gethari(date('l', strtotime($data_penerima->Updated_at)));
        $Tanggal_indo     = $Hari . ' ' . $CI->func_table->tgl_indonesia($data_penerima->Updated_at);
        $Jam            = date("H:i:s", strtotime($data_penerima->Updated_at));

        $Sapaan         = $CI->func_table->get_sapaan(strtotime(date("H:i:s", strtotime($data_penerima->Updated_at))));
        // ---- to pegawai
        $message_pegawai = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
Selamat Anda telah berhasil Tambah Surat Keterangan dalam aplikasi Si-ADiK. <br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

        $objSendWA = SendWANotif([
            'phone' => '08121835654',
            'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai)))
        ]);

        $objSendMail = sendMail([
            'subject' => 'Si-ADiK (Surat Keterangan)',
            'email' => 'wongndro@gmail.com',
            'message' => $message_pegawai
        ]);
        // ----

        // ---- to admin terkait
        $message_admin_terkait = 'Hai <b>' . $data_penerima->nama_admin_terkait . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat Surat Keterangan Pegawai baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

        $objSendWA = SendWANotif([
            'phone' => '08121835654',
            'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
        ]);

        $objSendMail = sendMail([
            'subject' => 'Si-ADiK (Surat Keterangan)',
            'email' => 'wongndro@gmail.com',
            'message' => $message_admin_terkait
        ]);
        // ----


    }

    function notif_sk_update($id_surat)
    {
        $CI = &get_instance();
        $CI->load->helper('send_email');
        $CI->load->helper('wa');
        // ---------------------------
        $tgl_now = date('Y-m-d H:i:s');
        $data_penerima  = $CI->func_table->Notifikasi_data_admin($id_surat);
        $Hari             = $CI->func_table->gethari(date('l', strtotime($data_penerima->Updated_at)));
        $Tanggal_indo     = $Hari . ' ' . $CI->func_table->tgl_indonesia($data_penerima->Updated_at);
        $Jam            = date("H:i:s", strtotime($data_penerima->Updated_at));
        $Sapaan         = $CI->func_table->get_sapaan(strtotime(date("H:i:s", strtotime($data_penerima->Updated_at))));
        // --------------------------




        #jika status update 
        if ($data_penerima->id_status_srt == '2') { //sedang proses
            #kirim notifikasi kepada pegawai & admin yang update
            // ---- to pegawai terkait
            $message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan surat keterangan anda.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_pegawai_terkait
            ]);
            // ----

            // ---- to admin update
            $message_admin_update = 'Hai <b>' . $data_penerima->nama_updated . '</b>, <br/>
Selamat Anda telah berhasil Verifikasi Surat Keterangan Pegawai dalam aplikasi Si-ADiK. <br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_update
            ]);
            // ----





        } else if ($data_penerima->id_status_srt == '21') { //Verifikasi Admin
            #kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
            // ---- to pegawai terkait #1
            $message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan surat keterangan anda.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_pegawai_terkait
            ]);
            // ----

            // ---- to admin update #2
            $message_admin_update = 'Hai <b>' . $data_penerima->nama_updated . '</b>, <br/>
Selamat Anda telah berhasil Verifikasi Surat Keterangan Pegawai dalam aplikasi Si-ADiK. <br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_update
            ]);
            // ----
            // ---- to kasubag kepegawaian #3
            $message_kepegawaian = 'Hai <b>' . $data_penerima->nama_kasubag_kepegawaian . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat Surat Keterangan Pegawai baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_kepegawaian)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_kepegawaian
            ]);
            // ----




        } else if ($data_penerima->id_status_srt == '22') { //Verifikasi kasubag
            #kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
            // ---- to pegawai terkait #1
            $message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan surat keterangan anda.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_pegawai_terkait
            ]);
            // ----

            // ---- to admin update #2
            $message_admin_update = 'Hai <b>' . $data_penerima->nama_updated . '</b>, <br/>
Selamat Anda telah berhasil Verifikasi Surat Keterangan Pegawai dalam aplikasi Si-ADiK. <br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_update
            ]);
            // ----
            // ---- to sekdis #3
            $message_sekdis = 'Hai <b>' . $data_penerima->nama_sekdis . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat Surat Keterangan Pegawai baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_sekdis)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_sekdis
            ]);
            // ----
        } else if ($data_penerima->id_status_srt == '23') { //Verifikasi sekdis
            #kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
            // ---- to pegawai terkait #1
            $message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan surat keterangan anda.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_pegawai_terkait
            ]);
            // ----

            // ---- to admin update #2
            $message_admin_update = 'Hai <b>' . $data_penerima->nama_updated . '</b>, <br/>
Selamat Anda telah berhasil Verifikasi Surat Keterangan Pegawai dalam aplikasi Si-ADiK. <br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_update
            ]);
            // ----
            // ---- to admin terkait #3
            $message_admin_terkait = 'Hai <b>' . $data_penerima->nama_admin_terkait . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat Surat Keterangan Pegawai baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_terkait
            ]);
            // ----



            // DITOLAKKKKKK
        } else if ($data_penerima->id_status_srt == '1' || $data_penerima->id_status_srt == '24' || $data_penerima->id_status_srt == '25' || $data_penerima->id_status_srt == '26') { //Diltolak
            #kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
            // ---- to pegawai terkait #1
            $message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan surat keterangan anda.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_pegawai_terkait
            ]);
            // ----

            // ---- to admin update #2
            $message_admin_update = 'Hai <b>' . $data_penerima->nama_updated . '</b>, <br/>
Selamat Anda telah berhasil Verifikasi Surat Keterangan Pegawai dalam aplikasi Si-ADiK. <br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_update
            ]);
            // ----
            // ---- to admin terkait #3
            $message_admin_terkait = 'Hai <b>' . $data_penerima->nama_admin_terkait . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Surat Keterangan Pegawai.<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_terkait
            ]);
            // ----

        } else if ($data_penerima->id_status_srt == '3') { //Selesai
            #kirim notifikasi kepada pegawai, admin yang update
            // ---- to pegawai terkait #1
            $message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan surat keterangan anda, Surat keterangan sudah dapat diunduh<br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_pegawai_terkait
            ]);
            // ----

            // ---- to admin update #2
            $message_admin_update = 'Hai <b>' . $data_penerima->nama_updated . '</b>, <br/>
Selamat Anda telah berhasil Verifikasi Surat Keterangan Pegawai dalam aplikasi Si-ADiK. <br/>
<b>Isi Surat 		 : ' . $data_penerima->keterangan_pengajuan . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Surat Dari	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
' . $CI->func_table->Get_footer() . '
';

            $objSendWA = SendWANotif([
                'phone' => '08121835654',
                'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
            ]);

            $objSendMail = sendMail([
                'subject' => 'Si-ADiK (Surat Keterangan)',
                'email' => 'wongndro@gmail.com',
                'message' => $message_admin_update
            ]);
            // ----

        }
    }



    #----------------------------------------------------------------------------
    #----------------------------------- END WA EMAIL ---------------------------

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
                                <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>
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
                                <button type="button" class="btn btn-danger btn-sm" title="' . $file_name_ori . '"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>
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
