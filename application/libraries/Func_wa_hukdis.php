<?php

    class Func_wa_hukdis {

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
function Notifikasi_data($Hukdis_id){
    $CI = &get_instance();
    #Query_notif_beta
    $Query_data_surat = $CI->db->query("SELECT
                                            a.Id, 
                                            a.id_pegawai, a.lokasi_kerja_pegawai, a.is_dinas, 
                                            a.Hukdis_id, a.Type_surat, a.Status_progress,
                                            a.Notes, a.Created_by, a.Created_at,a.Updated_by, a.Updated_at,
                                            REPLACE(nama_status_next, '<br>', ' ') as `status`, sort, sort_bidang,
                                            c.nama_pegawai as nama, d.nama_type, e.nama_lengkap,
                                            -- 'wongndro@gmail.com' as email, '08121835654' as telepon
                                            if(isnull(e.email) OR e.email='','wongndro@gmail.com', e.email ) as email, if(isnull(e.telepon) OR e.telepon='','08121835654', e.telepon ) as telepon
                                        FROM
                                            tr_hukdis AS a
                                        LEFT JOIN (
                                            SELECT id_status, nama_status_next, sort, sort_bidang FROM tbl_status_surat
                                        ) as b ON b.id_status = a.Status_progress
                                        LEFT JOIN (
                                                SELECT id_pegawai, nama_pegawai FROM tbl_data_pegawai
                                        ) AS c ON c.id_pegawai = a.id_pegawai
                                        LEFT JOIN (
											SELECT id_tipe_surat_hukdis, name as nama_type FROM tbl_master_tipe_surat_hukdis
										) as d ON d.id_tipe_surat_hukdis = a.Type_surat
                                        LEFT JOIN (
                                                SELECT username, nama_lengkap, email, telepon FROM tbl_user_login
                                        ) AS e ON e.username = a.Created_by
                                            WHERE a.Id != '' AND Hukdis_id = '$Hukdis_id'")->row();
    return $Query_data_surat;
}

function Notifikasi_admin_penerima($Hukdis_id){
    $CI = &get_instance();
    # Query_notif_beta
    # Admin lokasi jika bidang dan sekretariat maka langsung administrator utama
    
    $Query_admin = $CI->db->query("SELECT 
                                    nama_lengkap, username,
                                    -- 'wongndro@gmail.com' as email_admin, '08121835654' as telepon_admin
                                    -- email as email_admin, telepon as telepon_admin
                                    if(isnull(email) OR email='','wongndro@gmail.com', email ) as email_admin, if(isnull(telepon) OR telepon='','08121835654', telepon ) as telepon_admin
                                    
                                    FROM view_dinas")->result();
    
    return $Query_admin;
}

function Notifikasi_kasubag(){
    $CI = &get_instance();
    # Query_notif_beta
    $Query_admin = $CI->db->query("SELECT 
                                        nama_pegawai, nrk,
                                        -- 'wongndro@gmail.com' as email_kasubag, '08121835654' as telepon_kasubag
                                        email as email_kasubag, telepon as telepon_kasubag
                                    FROM view_kasubag_kepegawaian")->row();
    
    return $Query_admin;
}
function Notifikasi_sekdis(){
    $CI = &get_instance();
    # Query_notif_beta
    $Query_admin = $CI->db->query("SELECT 
                                        nama_pegawai, nrk,
                                        -- 'wongndro@gmail.com' as email_sekdis, '08121835654' as telepon_sekdis
                                        email as email_sekdis, telepon as telepon_sekdis
                                    FROM view_sekdis")->row();
    
    return $Query_admin;
}

function Notifikasi_kasubag_sudinupt($id_lokasi){
    $CI = &get_instance();
    # Query_notif_beta
    $Query_admin = $CI->db->query("SELECT 
                                        nama_pegawai, nrk,
                                        -- 'wongndro@gmail.com' as email_sudinupt, '08121835654' as telepon_sudinupt
                                        email as email_sudinupt, telepon as telepon_sudinupt
                                    FROM view_kasubag WHERE id_lokasi_kerja = '$id_lokasi'")->result();
    
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
Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta <br/>
Gedung Dinas Teknis Jatibaru Lt.2 <br/>
<br/>
Jl. Taman Jatibaru No.1, RT.17/RW.1, Cideng, Gambir, Kota Jakarta Pusat, <br/>
Daerah Khusus Ibukota Jakarta 10150";

    return $footer_notif;
}

function notif_hd_admin_tambah($Hukdis_id){
    $CI = &get_instance();
    $CI->load->helper('send_email');
    $CI->load->helper('wa');
    
    // ---------------------------
    $tgl_now = date('Y-m-d H:i:s');
    $data_penerima  = $CI->func_wa_hukdis->Notifikasi_data($Hukdis_id);
    $Hari 			= $CI->func_wa_hukdis->gethari(date('l', strtotime($data_penerima->Updated_at)));
    $Tanggal_indo 	= $Hari . ' ' . $CI->func_wa_hukdis->tgl_indonesia($data_penerima->Updated_at);
    $Jam			= date("H:i:s", strtotime($data_penerima->Updated_at));

    $Sapaan 		= $CI->func_wa_hukdis->get_sapaan(strtotime(date("H:i:s", strtotime($data_penerima->Updated_at))));
    $data_admin     = $CI->func_wa_hukdis->Notifikasi_admin_penerima($data_penerima->Hukdis_id);
    $data_kasubag   = $CI->func_wa_hukdis->Notifikasi_kasubag();
    $data_sekdis    = $CI->func_wa_hukdis->Notifikasi_sekdis();


// ---- to pembuat surat
    $message_pembuat = 'Hai <b>' . $data_penerima->nama_lengkap . '</b>, <br/>
    
Selamat Anda telah berhasil Tambah <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pembuat)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_pembuat
    ]);
// ----

    if($data_penerima->Status_progress=='0'){ //yang bikin admin wilayah

// ---- to admin terkait
foreach($data_admin as $key){
$message_admin_terkait = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $key->email_admin,
        'message' => $message_admin_terkait
    ]);
}
// ----

    } elseif($data_penerima->Status_progress=='21'){ //yang bikin admin dinas

// ---- to kasubag kepegawaian #3 jika dinas
$message_kepegawaian = 'Hai <b>' . $data_kasubag->nama_pegawai . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_kasubag->telepon_kasubag,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_kepegawaian)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_kasubag->email_kasubag,
        'message' => $message_kepegawaian
    ]);
// ----
    }
}

function notif_hd_update($id_surat){
    $CI = &get_instance();
    $CI->load->helper('send_email');
    $CI->load->helper('wa');
    // ---------------------------
    $tgl_now = date('Y-m-d H:i:s');
    $data_penerima  = $CI->func_wa_hukdis->Notifikasi_data($id_surat);
    $Hari 			= $CI->func_wa_hukdis->gethari(date('l', strtotime($data_penerima->Updated_at)));
    $Tanggal_indo 	= $Hari . ' ' . $CI->func_wa_hukdis->tgl_indonesia($data_penerima->Updated_at);
    $Jam			= date("H:i:s", strtotime($data_penerima->Updated_at));
    $Sapaan 		= $CI->func_wa_hukdis->get_sapaan(strtotime(date("H:i:s", strtotime($data_penerima->Updated_at))));
    $data_admin     = $CI->func_wa_hukdis->Notifikasi_admin_penerima($data_penerima->Hukdis_id);
    $data_kasubag   = $CI->func_wa_hukdis->Notifikasi_kasubag();
    $data_sekdis    = $CI->func_wa_hukdis->Notifikasi_sekdis();
    $data_sudinupt  = $CI->func_wa_hukdis->Notifikasi_kasubag_sudinupt($data_penerima->lokasi_kerja_pegawai);
    // --------------------------


    #jika status update 
    if($data_penerima->Status_progress=='2'){ //sedang proses
#kirim notifikasi kepada pegawai & admin yang update
// ---- to pegawai terkait
$message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_pegawai_terkait
    ]);
// ----

// ---- to admin update
foreach($data_admin as $key){
$message_admin_update = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_email,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $key->email_admin,
        'message' => $message_admin_update
    ]);
}
// ----


    } else if($data_penerima->Status_progress=='21'){ //Verifikasi Admin
#kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
// ---- to admin terkait #1
$message_admin_terkait = 'Hai <b>' . $data_penerima->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_admin_terkait
    ]);
// ----

// ---- to admin update #2
foreach($data_admin as $key){
$message_admin_update = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $key->email_admin,
        'message' => $message_admin_update
    ]);
}
// ----

// ---- to kasubag kepegawaian #3 jika dinas
$message_kepegawaian = 'Hai <b>' . $data_kasubag->nama_pegawai . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_kasubag->telepon_kasubag,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_kepegawaian)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_kasubag->email_kasubag,
        'message' => $message_kepegawaian
    ]);
// ----

} else if($data_penerima->Status_progress=='22'){ //Verifikasi kasubag
#kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
// ---- to pegawai terkait #1
$message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_pegawai_terkait
    ]);
// ----

// ---- to kasubag update #2
$message_admin_update = 'Hai <b>' . $data_kasubag->nama_pegawai . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_kasubag->telepon_kasubag,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_kasubag->email_kasubag,
        'message' => $message_admin_update
    ]);
// ----
// ---- to sekdis #3
$message_sekdis = 'Hai <b>' . $data_sekdis->nama_pegawai . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_sekdis->telepon_sekdis,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_sekdis)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_sekdis->email_sekdis,
        'message' => $message_sekdis
    ]);
// ----
    } else if($data_penerima->Status_progress=='23'){ //Verifikasi sekdis
#kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
// ---- to pegawai terkait #1
$message_admin_terkait = 'Hai <b>' . $data_penerima->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_admin_terkait
    ]);
// ----

// ---- to sekdis update #2
$message_admin_update = 'Hai <b>' . $data_sekdis->nama_pegawai . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_sekdis->telepon_sekdis,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_sekdis->email_sekdis,
        'message' => $message_admin_update
    ]);
// ----
// ---- to admin terkait #3
foreach($data_admin as $key){
$message_admin_terkait = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK Terdapat <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> baru, Mohon agar dilakukan verifikasi ketahap selanjutnya.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $key->email_admin,
        'message' => $message_admin_terkait
    ]);
}
#DITOLAKKKK
} else if($data_penerima->Status_progress=='1' || $data_penerima->Status_progress=='24'){ //Diltolak admin
#kirim notifikasi kepada pegawai, admin yang update, kasubag kepegawaian
// ---- to pegawai terkait #1
$message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_pegawai_terkait
    ]);
// ----

// ---- to admin update #2
foreach($data_admin as $key){
$message_admin_update = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $key->email_admin,
        'message' => $message_admin_update
    ]);
}
// ----
    } else if($data_penerima->Status_progress=='25' ){ //ditolak kasubag

// ---- to pegawai terkait #1
$message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_pegawai_terkait
    ]);
// ----

// ---- to kasubag update #2
$message_admin_update = 'Hai <b>' . $data_kasubag->nama_pegawai . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_kasubag->telepon_kasubag,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_kasubag->email_kasubag,
        'message' => $message_admin_update
    ]);
// ----

// ---- to admin update #3
foreach($data_admin as $key){
$message_admin_update = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b>.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $key->email_admin,
        'message' => $message_admin_update
    ]);
}
// ----

} else if($data_penerima->Status_progress=='26' ){ //ditolak sekdis

// ---- to pegawai terkait #1
$message_admin_terkait = 'Hai <b>' . $data_penerima->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_admin_terkait
    ]);
// ----

// ---- to admin update #2
$message_admin_update = 'Hai <b>' . $data_sekdis->nama_pegawai . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_sekdis->telepon_sekdis,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_sekdis->email_sekdis,
        'message' => $message_admin_update
    ]);
// ----

// ---- to kasubag update #3
$message_admin_update = 'Hai <b>' . $data_kasubag->nama_pegawai . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b>.<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
<b>Alasan	 	 : ' . $data_penerima->keterangan_ditolak . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_kasubag->telepon_kasubag,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_kasubag->email_kasubag,
        'message' => $message_admin_update
    ]);
// ----

} else if($data_penerima->Status_progress=='3' ){ //Selesai
#kirim notifikasi kepada pegawai, admin yang update
// ---- to pegawai terkait #1
$message_pegawai_terkait = 'Hai <b>' . $data_penerima->nama_lengkap . '</b>, <br/>

' . $Sapaan . ' Pemberitahuan Aplikasi Si-ADiK terhadap usulan <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> anda, Surat keterangan sudah dapat diunduh<br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $data_penerima->telepon,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_pegawai_terkait)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $data_penerima->email,
        'message' => $message_pegawai_terkait
    ]);
// ----

// ---- to admin update #2
foreach($data_admin as $key){
$message_admin_update = 'Hai <b>' . $key->nama_lengkap . '</b>, <br/>

Selamat Anda telah berhasil Verifikasi <b>Surat Keterangan Belum Pernah Dikenakan Hukuman Disiplin</b> dalam aplikasi Si-ADiK. <br/><br/>

<b>Tipe Surat 	 : '.$data_penerima->nama_type.'</b> <br/>
<b>Tanggal 		 : ' . $Tanggal_indo . ' ' . $Jam . ' WIB</b> <br/>
<b>Pegawai  	 : ' . $data_penerima->nama . '</b><br/>
<b>Url 		 	 : https://dcktrp.jakarta.go.id/si-adik</b> <br/>
<b>Status	 	 : ' . $data_penerima->status . '</b> <br/>
'.$CI->func_wa_hukdis->Get_footer().'
';

    $objSendWA = SendWANotif([
        'phone' => $key->telepon_admin,
        'message' => str_replace('</b>', '*', str_replace('<b>', '*', str_replace('<br/>', '', $message_admin_update)))
    ]);

    $objSendMail = sendMail([
        'subject' => 'Si-ADiK (Surat Bebas Hukuman Disiplin)',
        'email' => $key->email_admin,
        'message' => $message_admin_update
    ]);
}
// ----

}

}

#----------------------------------------------------------------------------
#----------------------------------- END WA EMAIL ---------------------------
		
}
?>