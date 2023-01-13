<?php

    class Func_wa_lapor {

		function tgl_indonesia($tgl){
			$tanggal = substr($tgl,8,2);
			//$bulan = tgl_indo(substr($tgl,5,2));
			$bulan = $this->getbulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
		}

        function tgl_indo($bulan){
            $CI = &get_instance();
            $q = $CI->db->query("SELECT Bulan from master_bulan where Kode = '$bulan'")->row();
            if (count($q) > 0) {
                $h = $q->Bulan;
            }
            else {
                $h = 'Not Defined(Bulan)';
            }

            return $h;
        }

        function gethari($hari){

            if ($hari == 'Monday'){
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

        function getbulan($bulan){

            if ($bulan == '01'){
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

        


#----------------------------------- WA EMAIL -------------------------------
#----------------------------------------------------------------------------
function Notifikasi_data($Id){
    $CI = &get_instance();
    #Query_notif_beta
    $Query_lapor = $CI->db->query("SELECT
                                            a.Id, a.Tanggapan_id, a.id_pegawai, 
	                                        a.id_lokasi_kerja,  a.Kategori,  a.Judul_laporan,  
                                            a.Isi_laporan,  a.File_upload,  a.Created_by,  a.Created_at,  a.Updated_at,
                                            c.nama_pegawai as nama,
                                            if(isnull(c.email) OR c.email='','wongndro@gmail.com', c.email ) as email, if(isnull(c.telepon) OR c.telepon='','08121835654', c.telepon ) as telepon
                                        FROM
                                            tr_lapor AS a
                                        LEFT JOIN (
                                                SELECT id_pegawai, nama_pegawai, email, telepon FROM tbl_data_pegawai
                                        ) AS c ON c.id_pegawai = a.id_pegawai
                                            WHERE a.Id != '' AND Id = '$Id'")->row();
    return $Query_lapor;
}

function Notifikasi_data_tanggap($Id){
    $CI = &get_instance();
    #Query_notif_beta
    $Query_lapor = $CI->db->query("SELECT
                                        a.Id, 
                                        a.Lapor_Id, 
                                        a.Username, 
                                        a.Created_at, 
                                        a.Tanggapan, 
                                        a.Updated_at,
                                        nama_lengkap,
                                        if(isnull(e.email) OR e.email='','wongndro@gmail.com', e.email ) as email_admin, if(isnull(e.telepon) OR e.telepon='','08121835654', e.telepon ) as telepon_admin
                                    FROM
                                        tr_lapor_tanggapan AS a
                                    LEFT JOIN (
                                            SELECT username, nama_lengkap, email, telepon FROM tbl_user_login
                                    ) AS e ON e.username = a.Username
                                    WHERE a.Id != '' AND Id = '$Id' limit 0,1")->row();
    return $Query_lapor;
}

function Notifikasi_admin_penerima(){
    $CI = &get_instance();
    $Query_admin = $CI->db->query("SELECT 
                                    nama_lengkap, username,
                                    if(isnull(email) OR email='','wongndro@gmail.com', email ) as email_admin, if(isnull(telepon) OR telepon='','08121835654', telepon ) as telepon_admin
                                    FROM view_dinas")->result();
    return $Query_admin;
}
function Notifikasi_admin_penerima_wilayah($lokasi_kerja){
    $CI = &get_instance();
    $Query_admin = $CI->db->query("SELECT 
                                    nama_lengkap, username,
                                    if(isnull(email) OR email='','wongndro@gmail.com', email ) as email_admin, if(isnull(telepon) OR telepon='','08121835654', telepon ) as telepon_admin
                                    FROM view_admin_wilayah WHERE id_lokasi_kerja = '$lokasi_kerja'")->result();
    return $Query_admin;
}

function get_sapaan($param){
    $time_start_pagi 	= strtotime('00:00:01');
    $time_start_siang 	= strtotime('10:00:00');
    $time_start_sore 	= strtotime('15:00:00');
    $time_start_malam 	= strtotime('18:00:00');
    $time_end 			= strtotime('23:59:59');

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

function Get_footer(){
    $footer_notif = "
<b>Terimakasih</b> <br/>
<br/>
Best Regards,<br/>
Pusdatin, Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta <br/>
Gedung Dinas Teknis Jatibaru Lt.2 <br/>
<br/>
Jl. Taman Jatibaru No.1, RT.17/RW.1, Cideng, Gambir, Kota Jakarta Pusat, <br/>
Daerah Khusus Ibukota Jakarta 10150";

    return $footer_notif;
}

function notif_lapor_tambah($Id){
    $CI = &get_instance();
    $CI->load->helper('send_email');
    $CI->load->helper('wa');
    
    // ---------------------------
    $tgl_now = date('Y-m-d H:i:s');
    $data_penerima  = $CI->func_wa_lapor->Notifikasi_data($Id);
    $Hari 			= $CI->func_wa_lapor->gethari(date('l', strtotime($data_penerima->Updated_at)));
    $Tanggal_indo 	= $Hari . ' ' . $CI->func_wa_lapor->tgl_indonesia($data_penerima->Updated_at);
    $Jam			= date("H:i:s", strtotime($data_penerima->Updated_at));

    $Sapaan 		= $CI->func_wa_lapor->get_sapaan(strtotime(date("H:i:s", strtotime($data_penerima->Updated_at))));
    $data_admin     = $CI->func_wa_lapor->Notifikasi_admin_penerima($data_penerima->Id);
    $data_wilayah   = $CI->func_wa_lapor->Notifikasi_admin_penerima_wilayah($data_penerima->id_lokasi_kerja);

// ---- to pembuat surat
    $message_pembuat = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>
    
Selamat Anda telah berhasil Tambah <b>Lapor</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pembuat)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Lapor)',
        'email' => $data_penerima->email,
        'message' => $message_pembuat
    ]);
// ----

// ---- to administrator terkait
foreach($data_admin as $key){
$message_administrator = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Aduan/Lapor</b> baru, Mohon agar ditanggapi dan atau segera ditindaklanjuti.<br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_administrator)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Lapor)',
        'email' => $key->email_admin,
        'message' => $message_administrator
    ]);
}
// ---- to admin wilayah
foreach($data_wilayah as $key){
$message_admin_wilayah = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Aduan/Lapor</b> baru, Mohon agar ditanggapi dan atau segera ditindaklanjuti.<br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';
    
        $objSendWA = SendWANotif([
            'phone' => $key->telepon_admin,
            'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_wilayah)))
        ]);
    
        $objSendMail = sendMail([
            'subject' => 'Si-ADiK (Lapor)',
            'email' => $key->email_admin,
            'message' => $message_admin_wilayah
        ]);
    }
}

function notif_lapor_tanggapi($Id, $lapor_id, $username, $user_type){
    $CI = &get_instance();
    $CI->load->helper('send_email');
    $CI->load->helper('wa');
    // ---------------------------
    $tgl_now = date('Y-m-d H:i:s');
    $data_penerima  = $CI->func_wa_lapor->Notifikasi_data($lapor_id);
    $data_tanggapan = $CI->func_wa_lapor->Notifikasi_data_tanggap($Id);
    $Hari 			= $CI->func_wa_lapor->gethari(date('l', strtotime($data_penerima->Updated_at)));
    $Tanggal_indo 	= $Hari . ' ' . $CI->func_wa_lapor->tgl_indonesia($data_penerima->Updated_at);
    $Jam			= date("H:i:s", strtotime($data_penerima->Updated_at));
    $Sapaan 		= $CI->func_wa_lapor->get_sapaan(strtotime(date("H:i:s", strtotime($data_penerima->Updated_at))));

    $data_admin     = $CI->func_wa_lapor->Notifikasi_admin_penerima($data_penerima->Id);
    $data_wilayah   = $CI->func_wa_lapor->Notifikasi_admin_penerima_wilayah($data_penerima->id_lokasi_kerja);
    // --------------------------

    #cek terlebih dahulu type user (admin/public)
    #jika admin maka beri notif kepada si pelapor, jika public maka berikan notif kepada admin utama dan wilayah
    if($user_type=='publik'){
#kirim notifikasi kepada pegawai public & admin terkait
// ---- to pegawai terkait

$message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>

Selamat Anda telah berhasil Memberi tanggapan terhadap laporan anda dalam aplikasi Si-ADiK. <br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Lapor)',
        'email' => $data_penerima->email,
        'message' => $message_pegawai_terkait
    ]);
// ----

// ---- to administrator terkait
foreach($data_admin as $key){
$message_administrator = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Tanggapan terhadap Aduan/Lapor Pegawai</b>, Mohon agar ditanggapi dan atau segera ditindaklanjuti.<br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_administrator)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Lapor)',
        'email' => $key->email_admin,
        'message' => $message_administrator
    ]);
}
// ---- to admin wilayah
foreach($data_wilayah as $key){
$message_admin_wilayah = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Tanggapan terhadap Aduan/Lapor Pegawai</b>, Mohon agar ditanggapi dan atau segera ditindaklanjuti.<br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';
    
        $objSendWA = SendWANotif([
            'phone' => $key->telepon_admin,
            'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_wilayah)))
        ]);
    
        $objSendMail = sendMail([
            'subject' => 'Si-ADiK (Lapor)',
            'email' => $key->email_admin,
            'message' => $message_admin_wilayah
        ]);
    }
// ----

    } else if($user_type=='administrator'){
#kirim notifikasi kepada pegawai, admin yang update
// ---- to admin update #1
$message_admin_update = 'Hai <b>' . $data_tanggapan->nama_lengkap . '</b>, <br/>

Selamat Anda telah berhasil Memeberi tanggapan terhadap laporan anda dalam aplikasi Si-ADiK. <br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_tanggapan->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Lapor)',
        'email' => $data_tanggapan->email_admin,
        'message' => $message_admin_update
    ]);
// -----
$message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Tanggapan terhadap Aduan/Lapor Pegawai</b>.<br/><br/>

<b>Perihal 		 : ' . $data_penerima->Kategori . '</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
'.$CI->func_wa_lapor->Get_footer().'
';
    
        $objSendWA = SendWANotif([
            'phone' => $data_penerima->telepon,
            'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
        ]);
    
        $objSendMail = sendMail([
            'subject' => 'Si-ADiK (Lapor)',
            'email' => $data_penerima->email,
            'message' => $message_pegawai_terkait
        ]);
// ----
} 
}
#----------------------------------------------------------------------------
#----------------------------------- END WA EMAIL ---------------------------
		
}
?>