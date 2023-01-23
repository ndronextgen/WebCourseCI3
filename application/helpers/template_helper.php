<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function headHtml()
{
    $obj = &get_instance();
    $judul_lengkap = $obj->config->item('nama_aplikasi_full');
    $judul_pendek = $obj->config->item('nama_aplikasi_pendek');
    $judul = $obj->config->item('nama_aplikasi_aja');
    $instansi = $obj->config->item('nama_instansi');
    $alamat = $obj->config->item('alamat_instansi');

    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>' . $judul_lengkap . ' - ' . $instansi . '</title>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<meta name="description" content="">';
    echo '<meta name="author" content="">';
    echo '<link rel="icon" href="' . base_url() . 'asset/img/icon.png" type="image/gif">';
    echo '<link href="' . base_url() . 'asset/css/bootstrap.min.css" rel="stylesheet">';
    //echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets_history/bootstrap/css/bootstrap.min.css" />';
    echo '<link href="' . base_url() . 'asset/css/bootstrap-responsive.min.css" rel="stylesheet">';

    echo '<script src="https://code.jquery.com/jquery-latest.js"></script>';
    echo '<script src="' . base_url() . 'asset/js/bootstrap.min.js"></script>';
    echo '<script src="' . base_url() . 'asset/js/application.js"></script>';
    echo '<script src="' . base_url() . 'asset/js/bootstrap-tooltip.js"></script>';
    echo '<link rel="stylesheet" href="' . base_url() . 'asset/colorbox/colorbox.css" />';

    echo '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets_history/font-awesome/css/font-awesome.min.css" />';
    echo '<link href="' . base_url() . 'asset/css/docs.css" rel="stylesheet">';

    // sso styles
    echo '<link rel="stylesheet" href="' . base_url() . 'sso/css/style.css" />';
    echo '<script type="text/javascript" src="' . base_url() . 'sso/main.js"></script>';

    echo '</head>';
}

function headAdminHtml()
{
    $obj = &get_instance();
    $judul_lengkap = $obj->config->item('nama_aplikasi_full');
    $judul_pendek = $obj->config->item('nama_aplikasi_pendek');
    $judul = $obj->config->item('nama_aplikasi_aja');
    $instansi = $obj->config->item('nama_instansi');
    $alamat = $obj->config->item('alamat_instansi');

    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>' . $judul_lengkap . ' - ' . $instansi . '</title>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<meta name="description" content="">';
    echo '<meta name="author" content="">';
    echo '<link rel="icon" href="' . base_url() . 'assets_admin/media/logos/logox24.png" type="image/gif">';
    echo '<link rel="stylesheet" href="' . base_url() . 'assets_admin/css/global/fonts.css">';
    echo '<link rel="stylesheet" href="' . base_url() . 'assets_admin/css/wizard.css">';
    echo '<link href="' . base_url() . 'assets_admin/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />';
    echo '<link href="' . base_url() . 'assets_admin/css/style.bundle.css" rel="stylesheet" type="text/css" />';
    echo '<link href="' . base_url() . 'assets_admin/plugins/duallistbox/bootstrap-duallistbox.css" rel="stylesheet" type="text/css" />';
    // echo '<script src="' . base_url() . 'asset/js/chart.js" type="text/javascript"></script>';

    // sso styles
    echo '<link rel="stylesheet" href="' . base_url() . 'sso/css/style.css" />';

    // ========== jquery-confirm ==========
    echo '<link rel="stylesheet" href="' . base_url("asset/jquery-confirm/jquery-confirm.min.css") . '">';
    echo '<script type="text/javascript" src="' . base_url("asset/jquery/jquery-2.1.3.min.js") . '"></script>';
    echo '<script type="text/javascript" src="' . base_url("asset/jquery-confirm/jquery-confirm.min.js") . '"></script>';

    // ========== dropdown notification ==========
    echo '<link href="' . base_url() . 'asset/dropdown-notif/style.css" rel="stylesheet" type="text/css" />';
    // ========== /dropdown notification ==========

    // ========== begin:progress timeline ==========
    echo '
	<!-- BEGIN: PROGRESS TIMELINE -->
	<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<!--<link rel="stylesheet" href="' . base_url("assets_admin/timeline-master/style.css") . '">-->
	<link rel="stylesheet" href="' . base_url("asset/timeline-master/style.css") . '">
	<!-- END: PROGRESS TIMELINE -->
    ';
    // ========== end:progress timeline ==========
    $obj->load->view('body/bypass_script');

    echo '</head>';
}

function headerAdmin()
{
    /* begin header */
    echo '<div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed ">';
    echo '  <div class="kt-header-mobile__logo">';
    echo '      <a href="index.html">';
    echo '          <img alt="Logo" src="' . base_url() . 'assets_admin/media/logos/logox24.png" />';
    echo '      </a>';
    echo '  </div>';
    echo '  <div class="kt-header-mobile__toolbar">';
    echo '      <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>';
    echo '      <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>';
    echo '  </div>';
    echo '</div>';
    /* end header mobile */
}

function menuAdmin($menuOpen = '')
{
    $count_surat = 0;
    $count_surat_dari_pegawai = 0;
    $count_laporan = 0;
    $count_surat_hukdis = 0;
    $count_surat_tp = 0;
    $count_surat_karir = 0;
    $count_pindah_tugas = 0;
    // lapor
    $count_lapor = 0;

    $count_surat_keterangan = countSuratKeterangan();
    $count_surat_tunjangan = countSuratTunjangan();
    $count_surat_kariskarsu = countSuratKariskarsu();
    $count_surat_hukdis = countSuratHukdis();
    $count_surat_tp = countSuratTp();
    $count_surat_karir = countSuratKarir();
    $count_pindah_tugas = countPindahTugas();

    // lapor
    $count_lapor = countLapor();

    $count_surat_naik_pangkat = countSuratNaikPangkat();
    $count_surat_pensiun = countSuratPensiun();
    $count_surat_pengantar = $count_surat_naik_pangkat + $count_surat_pensiun;

    $count_surat_dari_pegawai = $count_surat_keterangan + $count_surat_tunjangan + $count_surat_kariskarsu;
    //--------
    $count_surat_dari_admin = $count_surat_hukdis + $count_surat_tp + $count_surat_karir;
    $count_kebutuhan_pensiun_naikpangkat = $count_surat_hukdis + $count_surat_tp;
    //--------
    $count_surat = $count_surat_keterangan + $count_surat_pengantar + $count_surat_tunjangan + $count_surat_kariskarsu + $count_surat_hukdis + $count_surat_tp + $count_surat_karir;

    $count_laporan_update_data = countLaporanUpdateData();
    $count_laporan_pensiun = countLaporanPensiun();
    $count_laporan_naikpangkat = countLaporanNaikPangkat();

    $count_laporan = $count_laporan_update_data + $count_laporan_pensiun + $count_laporan_naikpangkat;

    switch ($menuOpen) {
        case 'dashboard':
            $activeDashboard = 'kt-menu__item--open kt-menu__item--here';
            $activeMaster = '';
            $activeKK = '';
            $activeLaporan = '';
            $activeDataLapor = '';
            break;
        case 'master':
            $activeDashboard = '';
            $activeMaster = 'kt-menu__item--open kt-menu__item--here';
            $activeKK = '';
            $activeLaporan = '';
            $activeDataLapor = '';
            break;
        case 'kk':
            $activeDashboard = '';
            $activeMaster = '';
            $activeKK = 'kt-menu__item--open kt-menu__item--here';
            $activeLaporan = '';
            $activeDataLapor = '';
            break;
        case 'laporan':
            $activeDashboard = '';
            $activeMaster = '';
            $activeKK = '';
            $activeLaporan = 'kt-menu__item--open kt-menu__item--here';
            $activeDataLapor = '';
            break;
        case 'data_lapor':
            $activeDashboard = '';
            $activeMaster = '';
            $activeKK = '';
            $activeLaporan = '';
            $activeDataLapor = 'kt-menu__item--open kt-menu__item--here';
            break;
        default:
            $activeDashboard = '';
            $activeMaster = '';
            $activeKK = '';
            $activeLaporan = '';
            $activeDataLapor = '';
            break;
    }

    echo '<div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">';
    echo '<div class="kt-container ">';

    /* begin Brand */
    echo '<div class="kt-header__brand   kt-grid__item" id="kt_header_brand">';
    // echo '<a class="kt-header__brand-logo" href="?page=index">';
    echo '<a class="kt-header__brand-logo" href="' . base_url() . '">';
    echo '<img alt="Logo" src="' . base_url() . 'assets_admin/media/logos/logox50.png" class="kt-header__brand-logo-default" />';
    echo '<img alt="Logo" src="' . base_url() . 'assets_admin/media/logos/logox50.png" class="kt-header__brand-logo-sticky" />';
    echo '</a>';
    echo '</div>';
    /* end brand */

    /* begin Header Menu */
    echo '<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>';
    echo '<div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">';
    echo '<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">';
    echo '<ul class="kt-menu__nav ">';
    echo '<li class="kt-menu__item ' . $activeDashboard . '" aria-haspopup="true">';
    echo '<a href="' . base_url() . '" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text"><i class="flaticon-home-2"></i>&nbsp;Dashboard</span>';
    echo '</a>';
    echo '</li>';



    $ci = &get_instance();
    if ($ci->session->userdata('stts') == 'administrator' and $ci->session->userdata('lokasi_kerja') == 0) {
        echo '<li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel ' . $activeMaster . '" data-ktmenu-submenu-toggle="click" aria-haspopup="true">';
        echo '<a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-web"></i>&nbsp;Master&nbsp;<i class="la la-angle-down"></i></span>';
        echo '</a>';
        echo '<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">';
        echo '<ul class="kt-menu__subnav">';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_status_pegawai" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Status Pegawai</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_golongan" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Golongan</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_eselon" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Eselon</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_bidang" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Bidang</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_jabatan" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Jabatan</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_penghargaan" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Penghargaan</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_hukuman" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Hukuman</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_lokasi_kerja" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Lokasi Kerja</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_sub_lokasi" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Seksi/ Subbag/ Satlak</span>';
        echo '</a>';
        echo '</li>';
        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_bezeting" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Bezeting</span>';
        echo '</a>';
        echo '</li>';

        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_menu" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Master Situs Menu</span>';
        echo '</a>';
        echo '</li>';

        echo '<li class="kt-menu__item " aria-haspopup="true">';
        echo '<a href="' . base_url() . 'admin/master_informasi" class="kt-menu__link ">';
        echo '<span class="kt-menu__link-text"><i class="flaticon-interface-11"></i>&nbsp;Master Informasi</span>';
        echo '</a>';
        echo '</li>';

        echo '</ul>';
        echo '</div>';
        echo '</li>';
    }



    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="https://tataruang.jakarta.go.id/portal/apps/experiencebuilder/experience/?id=3a2fe86569ce4c05a0cd722389294cd9" target="_blank" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text"><i class="flaticon-file-2"></i>&nbsp;Peta Pegawai</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel ' . $activeKK . '" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-text"><i class="flaticon-list"></i>&nbsp;Kertas Kerja&nbsp;';
    if ($count_surat > 0) {
        echo '<span class="kt-nav__link-badge">
                                            <span class="kt-badge kt-badge--warning">' . $count_surat . '</span>
                                        </span>&nbsp;&nbsp;';
    }
    echo '<i class="la la-angle-down"></i></span>
                            </a>

                            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                        <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-text"><i class="flaticon-book" style="padding-right: 5px;"></i>Pengajuan Surat dari Pegawai &nbsp; ';
    if ($count_surat_dari_pegawai > 0) {
        echo '<span class="kt-nav__link-badge">
                                                        <span class="kt-badge kt-badge--warning">' . $count_surat_dari_pegawai . '</span>
                                                    </span>';
    }
    echo '<i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></span>
                                        </a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="' . base_url() . 'admin/surat_keterangan" class="kt-menu__link ">
                                                    <span class="kt-menu__link-text"><i class="flaticon-book"></i>&nbsp;Surat Keterangan Pegawai &nbsp; ';
    if ($count_surat_keterangan > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                <span class="kt-badge kt-badge--warning">' . $count_surat_keterangan . '</span>
                                                            </span>';
    }
    echo '</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="' . base_url() . 'admin/data_tunjangan" class="kt-menu__link ">
                                                        <span class="kt-menu__link-text"><i class="flaticon-book" style="padding-right: 5px;"></i>Surat Permohonan Tunjangan Keluarga &nbsp; ';

    if ($count_surat_tunjangan > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                    <span class="kt-badge kt-badge--warning">' . $count_surat_tunjangan . '</span>
                                                                </span>';
    }
    echo '</span>
                                                    </a>
                                                </li>

                                                <li class="kt-menu__item " aria-haspopup="true">
                                                <a href="' . base_url() . 'admin/data_kariskarsu" class="kt-menu__link ">
                                                    <span class="kt-menu__link-text"><i class="flaticon-book" style="padding-right: 5px;"></i>Surat Permohonan KARIS/KARSU &nbsp; ';
    if ($count_surat_kariskarsu > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                    <span class="kt-badge kt-badge--warning">' . $count_surat_kariskarsu . '</span>
                                                                </span>';
    }
    echo '</span>
                                                </a>
                                            </ul>
                                        </div>
                                    </li>
                                    
                                    <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                        <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-text"><i class="flaticon-book" style="padding-right: 5px;"></i>Pembuatan Surat oleh Admin ';

    if ($count_surat_dari_admin > 0) {
        echo '<span class="kt-nav__link-badge">
                                                        <span class="kt-badge kt-badge--warning">' . $count_surat_dari_admin . '</span>
                                                    </span>';
    }
    echo '<i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></span>
                                        </a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a href="javascript:void(0);" class="kt-menu__link ">
                                                        <span class="kt-menu__link-text">
                                                            <div class="kt-demo-icon">
                                                                <div class="kt-demo-icon__preview">
                                                                    <i class="flaticon-book"></i>
                                                                </div>
                                                                <div class="kt-demo-icon__class">Kebutuhan Pensiun dan Naik Pangkat</div>
                                                            </div>';
    if ($count_kebutuhan_pensiun_naikpangkat > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                        <span class="kt-badge kt-badge--warning">' . $count_kebutuhan_pensiun_naikpangkat . '</span>
                                                                    </span>';
    }

    echo '</span>
                                                        <i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i>
                                                    </a>                                                    

                                                    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item " aria-haspopup="true">
                                                                <a href="' . base_url() . 'admin/Data_hukuman_disiplin" class="kt-menu__link ">
                                                                    <span class="kt-menu__link-text">
                                                                        <div class="kt-demo-icon">
                                                                            <div class="kt-demo-icon__preview">
                                                                                <i class="flaticon-book"></i>
                                                                            </div>
                                                                            <div class="kt-demo-icon__class">Surat Keterangan Hukuman Disiplin</div>
                                                                        </div>';
    if ($count_surat_hukdis > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                                    <span class="kt-badge kt-badge--warning">' . $count_surat_hukdis . '</span>
                                                                                </span>';
    }
    echo '</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-menu__item " aria-haspopup="true">
                                                                <a href="' . base_url() . 'admin/Data_tindak_pidana" class="kt-menu__link ">
                                                                    <span class="kt-menu__link-text">
                                                                        <div class="kt-demo-icon">
                                                                            <div class="kt-demo-icon__preview">
                                                                                <i class="flaticon-book"></i>
                                                                            </div>
                                                                            <div class="kt-demo-icon__class">Surat Keterangan Bebas Tindak Pidana</div>
                                                                        </div>';
    if ($count_surat_tp > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                                    <span class="kt-badge kt-badge--warning">' . $count_surat_tp . '</span>
                                                                                </span>';
    }

    echo '</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </li>
                                                <!-- <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="' . base_url() . 'admin/surat_penyesuaian_ijazah" class="kt-menu__link ">
                                                        <span class="kt-menu__link-text">
                                                            <div class="kt-demo-icon">
                                                                <div class="kt-demo-icon__preview">
                                                                    <i class="flaticon-book"></i>
                                                                </div>
                                                                <div class="kt-demo-icon__class">Surat Keterangan Penyesuaian Ijazah</div>
                                                            </div>
                                                        </span>
                                                    </a>
                                                </li>-->

                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="' . base_url() . 'admin/Data_pengembangan_karir" class="kt-menu__link ">
                                                        <span class="kt-menu__link-text">
                                                            <div class="kt-demo-icon">
                                                                <div class="kt-demo-icon__preview">
                                                                    <i class="flaticon-book"></i>
                                                                </div>
                                                                <div class="kt-demo-icon__class">Kebutuhan Pengembangan Karir (Izin/Tugas Belajar)</div>
                                                            </div>';

    if ($count_surat_karir > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                        <span class="kt-badge kt-badge--warning">' . $count_surat_karir . '</span>
                                                                    </span>';
    }

    echo '</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="' . base_url() . 'admin/Data_pindah_tugas" class="kt-menu__link ">
                                                        <span class="kt-menu__link-text">
                                                            <div class="kt-demo-icon">
                                                                <div class="kt-demo-icon__preview">
                                                                    <i class="flaticon-book"></i>
                                                                </div>
                                                                <div class="kt-demo-icon__class">Kebutuhan Pindah Tugas Antar SKPD/Instansi</div>
                                                            </div>';

    if ($count_pindah_tugas > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                            <span class="kt-badge kt-badge--warning">' . $count_pindah_tugas . '</span>
                                                                        </span>';
    }

    echo '</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="' . base_url() . 'admin/surat_tugas_pltplh" class="kt-menu__link ">
                                            <span class="kt-menu__link-text"><i class="flaticon-book"></i>&nbsp;Surat Tugas PLH/PLT&nbsp;';

    echo '</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                        <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                                            <span class="kt-menu__link-text"><i class="flaticon-book"></i>&nbsp;Surat Pengantar&nbsp;';
    if ($count_surat_pengantar > 0) {
        echo '<span class="kt-nav__link-badge">
                                                        <span class="kt-badge kt-badge--warning">' . $count_surat_pengantar . '</span>
                                                    </span>';
    }
    echo '<i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></span>
                                        </a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <!--<a href="javascript:void(0);" onclick="alert(\'Maaf Halaman Ini Untuk Sementara Dinonaktifkan!\')" class="kt-menu__link ">-->
                                                    <a href="javascript:void(0);" onclick="not_available()" class="kt-menu__link ">
                                                        <span class="kt-menu__link-text">
                                                            <div class="kt-demo-icon">
                                                                <div class="kt-demo-icon__preview">
                                                                    <i class="flaticon-book"></i>
                                                                </div>
                                                                <div class="kt-demo-icon__class">Naik&nbsp;Pangkat&nbsp;';
    if ($count_surat_naik_pangkat > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                            <span class="kt-badge kt-badge--warning">' . $count_surat_naik_pangkat . '</span>
                                                                        </span>';
    }
    echo '</div>
                                                            </div>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <!--<a href="javascript:void(0);" onclick="alert(\'Maaf Halaman Ini Untuk Sementara Dinonaktifkan!\')" class="kt-menu__link ">-->
                                                    <a href="javascript:void(0);" onclick="not_available()" class="kt-menu__link ">
                                                        <span class="kt-menu__link-text">
                                                            <div class="kt-demo-icon">
                                                                <div class="kt-demo-icon__preview">
                                                                    <i class="flaticon-book"></i>
                                                                </div>
                                                                <div class="kt-demo-icon__class">Pensiun&nbsp;';
    if ($count_surat_pensiun > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                            <span class="kt-badge kt-badge--warning">' . $count_surat_pensiun . '</span>
                                                                        </span>';
    }
    echo '</div>
                                                            </div>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>';

    // echo '<li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
    //     <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
    //         <span class="kt-menu__link-text"><i class="flaticon-book"></i>&nbsp;Surat Perintah Tugas PLT/PLH</span>
    //         <i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i>
    //     </a>
    //     <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
    //         <ul class="kt-menu__subnav">
    //             <li class="kt-menu__item " aria-haspopup="true">
    //                 <a href="'.base_url().'admin/surat_tugas_plh" class="kt-menu__link ">
    //                     <span class="kt-menu__link-text">
    //                         <div class="kt-demo-icon">
    //                             <div class="kt-demo-icon__preview">
    //                                 <i class="flaticon-book"></i>
    //                             </div>
    //                             <div class="kt-demo-icon__class">Pelaksana&nbsp;Harian&nbsp;(PLH)</div>
    //                         </div>
    //                     </span>
    //                 </a>
    //             </li>
    //             <li class="kt-menu__item " aria-haspopup="true">
    //                 <a href="'.base_url().'admin/surat_tugas_plt" class="kt-menu__link ">
    //                     <span class="kt-menu__link-text">
    //                         <div class="kt-demo-icon">
    //                             <div class="kt-demo-icon__preview">
    //                                 <i class="flaticon-book"></i>
    //                             </div>
    //                             <div class="kt-demo-icon__class">Pelaksana&nbsp;Tugas&nbsp;(PLT)</div>
    //                         </div>
    //                     </span>
    //                 </a>
    //             </li>
    //         </ul>
    //     </div>';
    // echo '</li>';
    echo '</ul>
                            </div>
                        </li>';

    echo '<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel ' . $activeLaporan . '" data-ktmenu-submenu-toggle="click" aria-haspopup="true">';
    echo '<a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">';
    echo '<span class="kt-menu__link-text"><i class="flaticon-book"></i>&nbsp;Laporan&nbsp;';

    if ($count_laporan > 0) {
        echo '<span class="kt-nav__link-badge">
                                            <span class="kt-badge kt-badge--warning">' . $count_laporan . '</span>
                                        </span>';
    }
    echo '&nbsp;<i class="la la-angle-down"></i></span>';


    echo '</a>';
    echo '<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">';
    echo '<ul class="kt-menu__subnav">';

    echo '<li class="kt-menu__item " aria-haspopup="true">';
    // echo '<a href="' . base_url() . 'admin/laporan_pegawai_update_data" class="kt-menu__link ">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_update_data" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Pembaruan Data';
    if ($count_laporan_update_data > 0) {
        echo '<span class="kt-nav__link-badge">
                <span class="kt-badge kt-badge--warning">' . $count_laporan_update_data . '</span>
            </span>';
    }
    echo '</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';

    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_masa_pensiun" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai yang Akan Pensiun';
    if ($count_laporan_pensiun > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                <span class="kt-badge kt-badge--warning">' . $count_laporan_pensiun . '</span>
                                                            </span>';
    }
    echo '</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_naik_pangkat" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai yang Akan Naik Pangkat';
    if ($count_laporan_naikpangkat > 0) {
        echo '<span class="kt-nav__link-badge">
                                                                <span class="kt-badge kt-badge--warning">' . $count_laporan_naikpangkat . '</span>
                                                            </span>';
    }
    echo '</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_penempatan_kerja" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Penempatan Kerja</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_status_golongan" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Golongan</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_status_pegawai" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Status Pegawai</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_pendidikan" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Pendidikan</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_hukuman" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Hukuman</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_jenis_kelamin" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Jenis Kelamin</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_ikut_pelatihan" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Mengikuti Pelatihan</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/laporan_pegawai_tugas_izin_belajar" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Laporan Pegawai Berdasarkan Tugas & Izin Belajar</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
    echo '</li>';

    echo '<li class="kt-menu__item ' . $activeDataLapor . '" aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/data_lapor" target="" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text"><i class="flaticon-book"></i>&nbsp;Lapor&nbsp;';
    // if ($count_lapor > 0) {
    //     echo '<span class="kt-nav__link-badge">
    //             <span class="kt-badge kt-badge--warning">' . $count_lapor . '</span>
    //         </span>';
    // }
    echo '<span id="count_lapor"></span>';
    echo '</span>';
    echo '</a>';
    echo '</li>';

    echo '<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel ' . $activeLaporan . '" data-ktmenu-submenu-toggle="click" aria-haspopup="true">';
    echo '<a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">';
    echo '<span class="kt-menu__link-text"><i class="flaticon-folder-1"></i>&nbsp;Panduan Penggunaan&nbsp;<i class="la la-angle-down"></i></span>';

    echo '</a>';
    echo '<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">';
    echo '<ul class="kt-menu__subnav">';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/manual_book/mpublic" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Download Panduan User Publik</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '<li class="kt-menu__item " aria-haspopup="true">';
    echo '<a href="' . base_url() . 'admin/manual_book/madmin" class="kt-menu__link ">';
    echo '<span class="kt-menu__link-text">';
    echo '<div class="kt-demo-icon">';
    echo '<div class="kt-demo-icon__preview">';
    echo '<i class="flaticon-notes"></i>';
    echo '</div>';
    echo '<div class="kt-demo-icon__class">Download Panduan User Admin</div>';
    echo '</div>';
    echo '</span>';
    echo '</a>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
    echo '</li>';

    echo '</ul>';
    echo '</div>';
    echo '</div>';

    topBarAdmin();

    echo '</div>';
    echo '</div>';
}

function bell_notif_admin()
{
    $ci = &get_instance();
    $ci->load->library('func_table');

    $ses_username       = $ci->session->userdata('username');

    $new_notif          = $ci->func_table->dropdownNotif(1, $ses_username, 1);
    $new_notif_count    = (isset($new_notif) ? count($new_notif) : 0);

    $notif              = $ci->func_table->dropdownNotif(1, $ses_username, 0);
    $notif_count        = (isset($notif) ? count($notif) : 0);

    echo '
    <div class="kt-header__topbar kt-grid__item">
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">

                <div class="nav-item dropdown notification-ui show" style="padding-top: 22px; color: yellow;">
                    <a class="nav-link notification-ui_icon" href="javascript:void(0);" onclick="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"">
                        <i class="fa fa-bell" style="font-size: 20px; float: left; color: orange" data-toggle="kt-tooltip" data-original-title="Lihat Notifikasi"></i>';
    if ($new_notif_count > 0) {
        echo '          <span class="badge badge-danger" style="position: relative; top: -30px; left: 10px;">' . $new_notif_count . '</span>';
    } else {
        echo '          <span class="badge" style="position: relative; top: -30px; left: 10px;">' . ' ' . '</span>';
    }
    echo '
                    </a>

                    <div class="dropdown-menu notification-ui_dd" aria-labelledby="navbarDropdown">
                        <div class="notification-ui_dd-header" style="background-color: #84a6f7; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            <h5 class="text-center">Notifikasi</h5>
                        </div>

                        <div class="notification-ui_dd-content">';
    if ($notif_count > 0) {
        foreach ($notif as $row) {
            $d1 = new DateTime($row['time']);
            $d2 = new DateTime(date("Y-m-d H:i:s"));
            $diff = $ci->func_table->timeDiff($d1, $d2);

            // begin: tanggal & jam notifikasi
            $tanggal_indo   = $ci->func_table->tgl_indo_pendek($row['time']);
            $hari           = $ci->func_table->getHariPendek(date('l', strtotime($row['time'])));
            $notif_created = $hari . ', ' . $tanggal_indo . ', ' . date('H:i', strtotime($row['time']));
            // end: tanggal & jam notifikasi

            $unread_background = "";
            if ($row['data_status'] == 1) {
                $unread_background = "style='background-color: #ffff0044;'";
            }

            echo '
                                <div class="notification-list text-dark btn btn-light" data-toggle="tooltip" data-placement="top" ' . $unread_background . ' onclick="location.href=\'' . base_url('admin/laporan_pegawai_update_data') . '\'">
                                    <div class="notification-list_detail" data-toggle="kt-tooltip" data-original-title="' . $row['notif_message'] . '">
                                        <p class="text-left">
                                            <b>' . $row['notif_module'] . '</b><br>' . $notif_created . '
                                        </p>
                                        <p class="nt-link text-truncate">' . $row['notif_message'] . '</p>
                                    </div>
                                    <p><small>' . $diff . '</small></p>
                                </div>
            ';
        }
    } else {
        echo '
                            <div class="notification-list text-dark">
                                <div class="notification-list_detail no-notif">
                                    <p style="padding-left: 110px;">
                                    TIDAK ADA NOTIFIKASI
                                    </p>
                                </div>
                            </div>';
    }
    echo '



                        </div>

                        <div class="notification-ui_dd-footer">
                            <div class="notification-list_detail" style="background-color: #84a6f7; border-top: 2px solid #19e063; height: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <center>&nbsp;</center>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    ';
}

function topBarAdmin()
{
    $ci = &get_instance();

    bell_notif_admin();

    echo '<div class="kt-header__topbar kt-grid__item">';
    echo '<div class="kt-header__topbar-item kt-header__topbar-item--user">';
    echo '<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">';
    echo '<span class="kt-header__topbar-welcome">Hi,</span>';
    echo '<span class="kt-header__topbar-username">' . ucwords($ci->session->userdata('nama')) . '</span>';
    echo '<span class="kt-header__topbar-icon"><b><img src="' . $ci->session->userdata('foto') . '" /></b></span>';
    echo '<img alt="Pic" src="' . base_url() . 'assets_admin/media/bg/300_25.jpg" class="kt-hidden" />';

    echo '&nbsp;<div class="kt-demo-icon2">
                    <div class="kt-demo-icon__preview">
                        <i class="flaticon2-down"></i>
                    </div>
                </div>';
    echo '</div>';
    echo '<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">';

    echo '<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(' . base_url() . 'assets_admin/media/bg/bg-1.jpg)">';
    echo '<div class="kt-user-card__avatar">';
    echo '<img class="kt-hidden" alt="Pic" src="' . base_url() . 'assets_admin/media/bg/300_25.jpg" />';
    echo '<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-warning"><img src="' . $ci->session->userdata('foto') . '" />';
    echo '</span>';
    echo '</div>';
    echo '<div class="kt-user-card__name">' . ucwords($ci->session->userdata('nama')) . '</div>';
    echo '</div>';

    echo '<!--end: Head -->';

    echo '<!--begin: Navigation -->';
    echo '<div class="kt-notification">';
    echo '<a href="' . base_url() . 'app/change_password" class="kt-notification__item">';
    echo '<div class="kt-notification__item-icon">';
    echo '<i class="flaticon-settings"></i>';
    echo '</div>';
    echo '<div class="kt-notification__item-details">';
    echo '<div class="kt-notification__item-title kt-font-bold"></div>';
    echo '<div class="kt-notification__item-time">Pengaturan Akun</div>';
    echo '</div>';
    echo '</a>';
    echo '<a href="' . base_url() . 'manage_user" class="kt-notification__item">';
    echo '<div class="kt-notification__item-icon">';
    echo '<i class="flaticon-users"></i>';
    echo '</div>';
    echo '<div class="kt-notification__item-details">';
    echo '<div class="kt-notification__item-title kt-font-bold"></div>';
    echo '<div class="kt-notification__item-time">Manajemen User</div>';
    echo '</div>';
    echo '</a>';
    echo '<div class="kt-notification__custom kt-space-between">';
    echo '<a href="' . base_url() . 'app/logout" class="btn btn-label btn-label-brand btn-sm btn-bold"><i class="flaticon-logout"></i>Log Out</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

function footerHtml()
{
    echo '</body>';
    echo '</html>';
}

function footerAdmin()
{
    echo '<div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer" style="background-image: url(\'' . base_url() . 'assets_admin/media/bg/bg-2.jpg\');">';
    echo '  <div class="kt-footer__bottom">';
    echo '      <div class="kt-container ">';
    echo '          <div class="kt-footer__wrapper">';

    // BEGIN JOE - 14 JULI 2022
    echo '<div class="col-12">';
    echo '  <div class="row justify-content-between align-items-center">';
    echo '      <div class="col-md-auto">';
    // END JOE - 14 JULI 2022

    echo '              <div class="kt-footer__logo">';
    echo '                  <a class="kt-header__brand-logo" href="?page=index">'; //href="?page=index&amp;demo=demo2"
    echo '                      <img alt="Logo" src="' . base_url() . 'assets_admin/media/logos/logox24.png" class="kt-header__brand-logo-sticky">';
    echo '                  </a>';
    echo '                  <div class="kt-footer__copyright">';
    echo '                      2022&nbsp;&copy;&nbsp;Dinas Cipta Karya, Tata Ruang dan Pertanahan - Pemerintah Provinsi DKI Jakarta (v1)<br><b>Powered by - Pusdatin CKTRP</b>';
    echo '                  </div>';
    echo '              </div>';

    // BEGIN JOE - 14 JULI 2022
    echo '      </div>';
    echo '      <div class="col-md-auto">';
    $app = &get_instance();
    $app->load->view("dashboard_admin/visitor/footer");
    echo '      </div>';
    echo '  </div>';
    echo '</div>';
    // END JOE - 14 JULI 2022

    echo '          </div>';
    echo '      </div>';
    echo '  </div>';
    echo '</div>';

    echo '
    <script type="text/javascript">
        const $jQ = $.noConflict();

        function not_available() {
            // alert("Maaf, halaman ini untuk sementara dinonaktifkan...");
			$jQ.dialog({
                icon: \'fa fa-info\',
				title: \'Info\',
				content: \'Maaf, untuk sementara halaman ini dinonaktifkan...\',
				type: \'red\',
				backgroundDismiss: true
			});
		}
    </script>
    ';
}

function scrollTop()
{
    echo '<div id="kt_scrolltop" class="kt-scrolltop"><i class="fa fa-arrow-up"></i></div>';
}

function judulPage()
{
    $obj = &get_instance();
    $judul_lengkap = $obj->config->item('nama_aplikasi_full');
    $instansi = $obj->config->item('nama_instansi');
    $alamat = $obj->config->item('alamat_instansi');

    echo '<div class="well">';
    echo '<div class="row">';
    echo '<div class=""><h3><center>' . $judul_lengkap . '<br/> ' . $instansi . '</h3></div>';
    echo '<div class="span"><p><center>' . $alamat . '</p></div>';
    echo '</div>';
    echo '</div>';
}

function footerPage()
{
    $obj = &get_instance();
    $credit = $obj->config->item('credit_aplikasi');

    echo '<footer class="well">';
    echo '<p>' . $credit . '</p>';
    echo '</footer>';
}

function countSuratKeterangan()
{
    $ci = &get_instance();
    $ci->load->database();
    return $ci->db->get_where('tbl_data_srt_ket', ['id_status_srt' => 0])->num_rows();
}

function countSuratTunjangan()
{
    $ci = &get_instance();
    $ci->load->database();
    return $ci->db->get_where('tr_tunjangan', ['Status_progress' => 0])->num_rows();
}

function countSuratKariskarsu()
{
    $ci = &get_instance();
    $ci->load->database();
    return $ci->db->get_where('tr_kariskarsu', ['Status_progress' => 0])->num_rows();
}

function countSuratHukdis()
{
    $CI = &get_instance();
    $CI->load->database();
    $username_id = $CI->session->userdata('username');
    $lokasi_kerja_id = $CI->session->userdata('lokasi_kerja');
    $cek_admin_utama = $CI->db->query("SELECT count(*) as jml_admin_utama FROM view_dinas WHERE username = '$username_id'")->row();
    $cek_admin_wilayah = $CI->db->query("SELECT count(*) as jml_admin_wilayah, id_lokasi_kerja FROM view_admin_wilayah 
                                            WHERE username = '$username_id' AND id_lokasi_kerja = '$lokasi_kerja_id'")->row();

    #admin utama menerima notifikasi ketika
    # status (0,25)
    if ($cek_admin_utama->jml_admin_utama > 0) {
        $kondisi = " AND (a.Status_progress = '0' OR a.Status_progress = '3' OR a.Status_progress='25')";
        #admin wilayah
        # status (21,22,23,24,25,26,3)
    } else if ($cek_admin_wilayah->jml_admin_wilayah > 0) {
        $kondisi = " AND a.Status_progress in ('3') AND a.lokasi_kerja_pegawai = '$cek_admin_wilayah->id_lokasi_kerja'";
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
                                        WHERE id_view = '$username_id'
                                        GROUP BY id_view, id_srt, id_status_srt 
                                ) AS see ON see.id_srt = a.Hukdis_id AND see.id_status_srt = a.Status_progress 
                                WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
    return $Query->jumlah;
}

function countSuratTp()
{
    $CI = &get_instance();
    $CI->load->database();
    $username_id = $CI->session->userdata('username');
    $lokasi_kerja_id = $CI->session->userdata('lokasi_kerja');
    $cek_admin_utama = $CI->db->query("SELECT count(*) as jml_admin_utama FROM view_dinas WHERE username = '$username_id'")->row();
    $cek_admin_wilayah = $CI->db->query("SELECT count(*) as jml_admin_wilayah, id_lokasi_kerja FROM view_admin_wilayah 
                                            WHERE username = '$username_id' AND id_lokasi_kerja = '$lokasi_kerja_id'")->row();

    #admin utama menerima notifikasi ketika
    # status (0,25)
    if ($cek_admin_utama->jml_admin_utama > 0) {
        $kondisi = " AND (a.Status_progress = '0' OR a.Status_progress = '3' OR a.Status_progress='25')";
        #admin wilayah
        # status (21,22,23,24,25,26,3)
    } else if ($cek_admin_wilayah->jml_admin_wilayah > 0) {
        $kondisi = " AND a.Status_progress in ('3') AND a.lokasi_kerja_pegawai = '$cek_admin_wilayah->id_lokasi_kerja'";
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
                                        WHERE id_view = '$username_id'
                                        GROUP BY id_view, id_srt, id_status_srt 
                                ) AS see ON see.id_srt = a.Tindak_pidana_id AND see.id_status_srt = a.Status_progress 
                                WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
    return $Query->jumlah;
}

function countSuratKarir()
{
    $CI = &get_instance();
    $CI->load->database();
    $username_id = $CI->session->userdata('username');
    $lokasi_kerja_id = $CI->session->userdata('lokasi_kerja');
    $cek_admin_utama = $CI->db->query("SELECT count(*) as jml_admin_utama FROM view_dinas WHERE username = '$username_id'")->row();
    $cek_admin_wilayah = $CI->db->query("SELECT count(*) as jml_admin_wilayah, id_lokasi_kerja FROM view_admin_wilayah 
                                            WHERE username = '$username_id' AND id_lokasi_kerja = '$lokasi_kerja_id'")->row();

    #admin utama menerima notifikasi ketika
    # status (0,25)
    if ($cek_admin_utama->jml_admin_utama > 0) {
        $kondisi = " AND (a.Status_progress = '0' OR a.Status_progress = '3' OR a.Status_progress='25')";
        #admin wilayah
        # status (21,22,23,24,25,26,3)
    } else if ($cek_admin_wilayah->jml_admin_wilayah > 0) {
        $kondisi = " AND a.Status_progress in ('3') AND a.lokasi_kerja_pegawai = '$cek_admin_wilayah->id_lokasi_kerja'";
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
                                        WHERE id_view = '$username_id'
                                        GROUP BY id_view, id_srt, id_status_srt 
                                ) AS see ON see.id_srt = a.Pengembangan_karir_id AND see.id_status_srt = a.Status_progress 
                                WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
    return $Query->jumlah;
}

function countPindahTugas()
{
    $CI = &get_instance();
    $CI->load->database();
    $username_id = $CI->session->userdata('username');
    $lokasi_kerja_id = $CI->session->userdata('lokasi_kerja');
    $cek_admin_utama = $CI->db->query("SELECT count(*) as jml_admin_utama FROM view_dinas WHERE username = '$username_id'")->row();
    $cek_admin_wilayah = $CI->db->query("SELECT count(*) as jml_admin_wilayah, id_lokasi_kerja FROM view_admin_wilayah 
                                            WHERE username = '$username_id' AND id_lokasi_kerja = '$lokasi_kerja_id'")->row();

    #admin utama menerima notifikasi ketika
    # status (0,25)
    if ($cek_admin_utama->jml_admin_utama > 0) {
        $kondisi = " AND (a.Status_progress = '0' OR a.Status_progress = '3' OR a.Status_progress='25')";
        #admin wilayah
        # status (21,22,23,24,25,26,3)
    } else if ($cek_admin_wilayah->jml_admin_wilayah > 0) {
        $kondisi = " AND a.Status_progress in ('3') AND a.lokasi_kerja_pegawai = '$cek_admin_wilayah->id_lokasi_kerja'";
    } else {
        $kondisi = " AND a.Status_progress = 'XX'";
    }
    $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM
                                (
                                    SELECT
                                        a.Pindah_tugas_id, a.Created_by, a.Status_progress, jml, id_view
                                    FROM
                                        tr_pindah_tugas AS a
                                    LEFT JOIN ( 
                                        SELECT count(*) AS jml, id_view, id_srt, id_status_srt FROM tr_pindah_tugas_see 
                                        WHERE id_view = '$username_id'
                                        GROUP BY id_view, id_srt, id_status_srt 
                                ) AS see ON see.id_srt = a.Pindah_tugas_id AND see.id_status_srt = a.Status_progress 
                                WHERE a.Id !='' AND isnull(id_view) $kondisi ) AS DATA")->row();
    return $Query->jumlah;
}

// lapor
function countLapor()
{
    $CI = &get_instance();
    $CI->load->database();
    $username_id = $CI->session->userdata('username');
    $lokasi_kerja_id = $CI->session->userdata('lokasi_kerja');
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

    $Query = $CI->db->query("SELECT COUNT(*) as jumlah FROM (
                                SELECT if(isnull(DATA.user_create) AND DATA.counter_notif = '0',0,1) as status_view 
                                FROM
                                (
                                    SELECT
                                        fa.User_create,
                                        a.Id, a.Created_by, a.Updated_at, a.Tanggapan_id,
                                        (
                                            CASE 
                                                    WHEN a.Tanggapan_id != '0' AND date_add(a.Updated_at,interval 30 DAY) > now() THEN '0'
                                                    WHEN a.Tanggapan_id != '0' AND date_add(a.Updated_at,interval 30 DAY) < now() THEN '1'
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
                                        WHERE b.Id_view = '$username_id' 
                                    ) AS fa ON fa.Lapor_id = a.Id AND fa.Tanggapan_id = a.Tanggapan_id
                                    WHERE isnull(fa.User_create) $kondisi
                                ) AS DATA
                            ) AS LIST WHERE LIST.status_view ='0'")->row();
    return $Query->jumlah;
}

function countSuratNaikPangkat()
{
    $CI = &get_instance();
    $cond = '';
    $user_view = $CI->session->userdata('username');
    if ($CI->session->userdata('lokasi_kerja') != null && $CI->session->userdata('lokasi_kerja') != 0) {
        $cond = ' AND lk=' . $CI->session->userdata('lokasi_kerja');
    }

    $q = $CI->db->query("SELECT count(*) as jumlah FROM
                        (
                        SELECT a.*, b.nama_lengkap as user_created, c.nama_status as status_surat, group_nama, group_dinas, lk, jml
                                        FROM tbl_data_surat_naik_pangkat a 
                                        LEFT JOIN tbl_user_login b on a.id_user_created = b.id_user_login
                                        LEFT JOIN tbl_status_surat c on a.id_status_srt = c.id_status 
                                        LEFT JOIN(
                                            SELECT count(*) as jml, user_view, id_surat_naik_pangkat 
                                            FROM tbl_data_surat_naik_pangkat_see WHERE user_view='$user_view'
                                            GROUP BY user_view, id_surat_naik_pangkat
                                        ) as see ON see.id_surat_naik_pangkat = a.id_surat_naik_pangkat
                                        LEFT JOIN (
                                                    SELECT 
                                                        DATA.id_surat_naik_pangkat, DATA.id_surat_naik_pangkat_dt, 
                                                        DATA.gid_pegawai, DATA.created_at,
                                                        GROUP_CONCAT(nama_pegawai) as group_nama,
                                                        dinas as group_dinas, lk
                                                    FROM 
                                                    (
                                                        SELECT
                                                        n.id_surat_naik_pangkat_dt,
                                                        n.id_surat_naik_pangkat,
                                                        GROUP_CONCAT(n.id_pegawai) as gid_pegawai,
                                                        n.created_at    
                                                        FROM
                                                        tbl_data_surat_naik_pangkat_dt as n
                                                        GROUP BY n.id_surat_naik_pangkat
                                                    ) DATA 
                                                    LEFT JOIN(
                                                        SELECT nama_pegawai, id_pegawai, lokasi_kerja as lk, dinas
                                                        FROM tbl_data_pegawai
                                                        LEFT JOIN (
                                                            SELECT id_lokasi_kerja, dinas FROM tbl_master_lokasi_kerja
                                                        ) AS jj ON jj.id_lokasi_kerja =  tbl_data_pegawai.lokasi_kerja
                                                    ) as nf ON FIND_IN_SET (nf.id_pegawai,DATA.gid_pegawai) > 0 
                                                    GROUP BY DATA.id_surat_naik_pangkat
                                        ) as tomi ON tomi.id_surat_naik_pangkat = a.id_surat_naik_pangkat
                                        where 1=1
                                        $cond 
                                        order by a.id_surat_naik_pangkat desc
                        ) as LIST WHERE isnull(LIST.jml)")->row();
    return $q->jumlah;
}

function countSuratPensiun()
{
    $CI = &get_instance();
    $cond = '';
    $user_view = $CI->session->userdata('username');
    if ($CI->session->userdata('lokasi_kerja') != null && $CI->session->userdata('lokasi_kerja') != 0) {
        $cond = ' AND lk=' . $CI->session->userdata('lokasi_kerja');
    }

    $q = $CI->db->query("SELECT count(*) as jumlah FROM
                        (
                        SELECT a.*, b.nama_lengkap as user_created, c.nama_status as status_surat, group_nama, group_dinas, lk, jml
                                        FROM tbl_data_surat_pensiun a 
                                        LEFT JOIN tbl_user_login b on a.id_user_created = b.id_user_login
                                        LEFT JOIN tbl_status_surat c on a.id_status_srt = c.id_status 
                                        LEFT JOIN(
                                            SELECT count(*) as jml, user_view, id_surat_pensiun 
                                            FROM tbl_data_surat_pensiun_see WHERE user_view='$user_view'
                                            GROUP BY user_view, id_surat_pensiun
                                        ) as see ON see.id_surat_pensiun = a.id_surat_pensiun
                                        LEFT JOIN (
                                                    SELECT 
                                                        DATA.id_surat_pensiun, DATA.id_surat_pensiun_dt, 
                                                        DATA.gid_pegawai, DATA.created_at,
                                                        GROUP_CONCAT(nama_pegawai) as group_nama,
                                                        dinas as group_dinas, lk
                                                    FROM 
                                                    (
                                                        SELECT
                                                        n.id_surat_pensiun_dt,
                                                        n.id_surat_pensiun,
                                                        GROUP_CONCAT(n.id_pegawai) as gid_pegawai,
                                                        n.created_at    
                                                        FROM
                                                        tbl_data_surat_pensiun_dt as n
                                                        GROUP BY n.id_surat_pensiun
                                                    ) DATA 
                                                    LEFT JOIN(
                                                        SELECT nama_pegawai, id_pegawai, lokasi_kerja as lk, dinas
                                                        FROM tbl_data_pegawai
                                                        LEFT JOIN (
                                                            SELECT id_lokasi_kerja, dinas FROM tbl_master_lokasi_kerja
                                                        ) AS jj ON jj.id_lokasi_kerja =  tbl_data_pegawai.lokasi_kerja
                                                    ) as nf ON FIND_IN_SET (nf.id_pegawai,DATA.gid_pegawai) > 0 
                                                    GROUP BY DATA.id_surat_pensiun
                                        ) as tomi ON tomi.id_surat_pensiun = a.id_surat_pensiun
                                        where 1=1
                                        $cond 
                                        order by a.id_surat_pensiun desc
                        ) as LIST WHERE isnull(LIST.jml)")->row();
    return $q->jumlah;
}

function countSuratNaikPangkat_old()
{
    $ci = &get_instance();
    $ci->load->database();
    return $ci->db->get_where('tbl_data_surat_naik_pangkat', ['id_status_srt' => 0])->num_rows();
}

function countSuratPensiun_old()
{
    $ci = &get_instance();
    $ci->load->database();
    return $ci->db->get_where('tbl_data_surat_pensiun', ['id_status_srt' => 0])->num_rows();
}

function countLaporanUpdateData()
{
    $ci = &get_instance();
    $ci->load->library('func_table');

    $ses_username = $ci->session->userdata('username');
    $new_notif          = $ci->func_table->dropdownNotif(1, $ses_username, 1);
    $new_notif_count    = (isset($new_notif) ? count($new_notif) : 0);

    return $new_notif_count;
}

function countLaporanPensiun()
{
    $CI = &get_instance();
    $cond = '';
    $user_view = $CI->session->userdata('username');
    // if ($CI->session->userdata('lokasi_kerja') != null && $CI->session->userdata('lokasi_kerja') != 0) {
    //     $cond = ' AND lk='.$CI->session->userdata('lokasi_kerja');
    // }

    if ($CI->session->userdata('lokasi_kerja') != null && $CI->session->userdata('lokasi_kerja') != 0) {
        $cond .= ' and a.lokasi_kerja=' . $CI->session->userdata('lokasi_kerja');
    }

    $q = $CI->db->query("SELECT count(*) as jumlah FROM (
                        select a.* from (
                        select nip, nrk, jml, nama_pegawai, tanggal_lahir as str_tgl_lahir, 
                                str_to_date(substring(nip,1,8), '%Y%m%d') as date_tgl_lahir,
                                id_jabatan, timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) as usia, 
                                if (id_jabatan = 2351, ((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now())) * 1), 
                                    ((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) * 1))
                                ) as masa_pensiun,
                                if (id_jabatan = 2351, 
                                    (timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))), 
                                    (timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))) 
                                ) as masa_pensiun_bln,
                                if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
                                    (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
                                ) as tgl_pensiun,
                                
                                DATE_SUB(
                                    if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
                                        (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
                                    )
                                    , INTERVAL 6 MONTH) as warning_6b,
                                if(DATE_SUB(
                                    if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
                                        (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
                                    )
                                    , INTERVAL 6 MONTH) <= CURRENT_DATE(),'1', '0') as kuning,
                                lokasi_kerja 
                        from tbl_data_pegawai
                        LEFT JOIN(
                                SELECT count(*) as jml, user_view, nrk as nomor_rk
                                FROM masa_pensiun_see WHERE user_view='$user_view'
                                GROUP BY user_view, nrk
                            ) as see ON see.nomor_rk = tbl_data_pegawai.nrk
                        ) a 
                        where a.masa_pensiun > 0 AND isnull(jml) $cond) DATA
                        WHERE DATA.kuning ='1'")->row();
    return $q->jumlah;
}

function countLaporanNaikPangkat()
{
    $CI = &get_instance();
    $cond = '';
    $user_view = $CI->session->userdata('username');
    $condLokasi = 'where 1=1';
    if ($CI->session->userdata('lokasi_kerja') != null && $CI->session->userdata('lokasi_kerja') != 0) {
        $condLokasi .= ' and b.lokasi_kerja=' . $CI->session->userdata('lokasi_kerja');
    }

    $q = $CI->db->query("SELECT count(*) as jumlah FROM (
                        select c.*, 
                            d.tanggal_sk, d.tanggal_mulai as tmt_pangkat_terakhir, 
                            date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year) as tgl_naik_pangkat,
                            if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 6 MONTH)<= CURRENT_DATE(),'1', '0') as kuning,
                            substr(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),1,4) as tahun_naik_pangkat,
                            timestampdiff(day,now(),date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) as masa_hari_naik_pangkat,
                            e.golongan, e.uraian
                        from 
                        (
                            select b.id_pegawai, b.nama_pegawai, b.nip, b.nrk,jml,
                                    (
                                        select a.id_riwayat_pangkat
                                        from tbl_data_riwayat_pangkat a
                                        where a.id_pegawai = b.id_pegawai " . $cond . " 
                                        order by date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year) desc 
                                        limit 1
                                    ) as id_pangkat
                            from tbl_data_pegawai b 
                            LEFT JOIN(
                                SELECT count(*) as jml, user_view, nrk as nomor_rk
                                FROM naik_pangkat_see WHERE user_view='$user_view'
                                GROUP BY user_view, nrk
                            ) as see ON see.nomor_rk = b.nrk
                            " . $condLokasi . " 
                        ) c 
                        left join tbl_data_riwayat_pangkat d on d.id_riwayat_pangkat = c.id_pangkat 
                        left join tbl_master_golongan e on e.id_golongan = d.id_golongan
                        where c.id_pangkat is not null AND isnull(jml)
                        order by kuning DESC) DATA
                                WHERE DATA.kuning ='1'")->row();
    return $q->jumlah;
}



function modalPegawai($id_pegawai = 0)
{
    $ci = &get_instance();
    $ci->load->database();

    $mst_golongan = $ci->db->get('tbl_master_golongan');
    $mst_nama_jabatan = $ci->db->get('tbl_master_nama_jabatan');
    $mst_status_jabatan = $ci->db->get('tbl_master_status_jabatan');
    $mst_pendidikan = $ci->db->get('tbl_master_pendidikan');
    $mst_pelatihan = $ci->db->get('tbl_master_pelatihan');
    $mst_penghargaan = $ci->db->get('tbl_master_penghargaan');
    $mst_hukuman = $ci->db->get('tbl_master_hukuman');

    echo '<div class="modal fade" id="modalLihatFile" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">';
    echo '<div class="modal-dialog modal-dialog-centered" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="modalLihatFileTitle">Modal title</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body" id="modalLihatFileBody"><div></div></div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="modal fade" id="modalViewKoordinat" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">';
    echo '<div class="modal-dialog modal-xl modal-dialog-centered" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="modalKoordinatTitle">Masukkan Koordinat Alamat Anda</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body"><div id="mapKoordinatview" style="height:600px;width:100%;overflow:visible;"></div></div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="modal fade" id="modalAddKoordinat" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">';
    echo '<div class="modal-dialog modal-xl modal-dialog-centered" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="modalKoordinatTitle">Masukkan Koordinat Alamat Anda</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body"><div id="mapKoordinatadd" style="height:600px;width:100%;overflow:visible;"></div></div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" id="btnSaveLocation" class="btn btn-primary" data-dismiss="modal">Simpan Lokasi</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="modal fade" id="modalAddKeluarga" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddKeluargaTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Keluarga_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Keluarga_id" id="mdlArsip_Keluarga_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Keluarga_id_arsip" id="mdlArsip_Keluarga_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Keluarga_id_pegawai" id="mdlArsip_Keluarga_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama Anggota Keluarga</label>
                        <div class="col-md-8">
                            <input class="form-control" name="mdlArsip_Keluarga_nama_anggota_keluarga" id="mdlArsip_Keluarga_nama_anggota_keluarga" type="text" placeholder="Nama Anggota Keluarga" />
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Hubungan Keluarga</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Keluarga_hub_keluarga" id="mdlArsip_Keluarga_hub_keluarga" placeholder="Hubungan Keluarga">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Keluarga_jenis_kelamin" id="mdlArsip_Keluarga_jenis_kelamin" data-placeholder="Jenis Kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Lahir</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="mdlArsip_Keluarga_tanggal_lahir_keluarga" id="mdlArsip_Keluarga_tanggal_lahir_keluarga" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Keterangan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Keluarga_uraian" id="mdlArsip_Keluarga_uraian" placeholder="Keterangan">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend>Lampiran</legend>
                            </fieldset>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Keluarga_title" id="mdlArsip_Keluarga_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Keluarga_file" id="mdlArsip_Keluarga_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Keluarga_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Keluarga_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Keluarga_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddPangkat" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPangkatTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Pangkat_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Pangkat_id" id="mdlArsip_Pangkat_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Pangkat_id_arsip" id="mdlArsip_Pangkat_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Pangkat_id_pegawai" id="mdlArsip_Pangkat_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Golongan</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Pangkat_id_golongan" id="mdlArsip_Pangkat_id_golongan" data-placeholder="Pilih Golongan" class="form-control">
                                <option value="">Pilih Golongan</option>';
    foreach ($mst_golongan->result_array() as $mg) {
        echo '<option value="' . $mg['id_golongan'] . '">' . $mg['golongan'] . '</option>';
    }

    echo '</select>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Lokasi Kerja</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pangkat_lokasi_kerja" id="mdlArsip_Pangkat_lokasi_kerja" placeholder="Lokasi Kerja">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pangkat_nomor_sk" id="mdlArsip_Pangkat_nomor_sk" placeholder="Nomor SK">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="mdlArsip_Pangkat_tanggal_sk" id="mdlArsip_Pangkat_tanggal_sk" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Mulai</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="mdlArsip_Pangkat_tanggal_mulai" id="mdlArsip_Pangkat_tanggal_mulai" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload Dokumen</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Pangkat_file" id="mdlArsip_Pangkat_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Pangkat_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Pangkat_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Pangkat_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddJabatan" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddJabatanTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Jabatan_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Jabatan_id" id="mdlArsip_Jabatan_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Jabatan_id_arsip" id="mdlArsip_Jabatan_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Jabatan_id_pegawai" id="mdlArsip_Jabatan_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Status Jabatan</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Jabatan_id_riwayat_status_jabatan" id="mdlArsip_Jabatan_id_riwayat_status_jabatan" data-placeholder="Pilih Status Jabatan" class="form-control">
                                <option value="">Pilih Status Jabatan</option>';
    foreach ($mst_status_jabatan->result_array() as $sj) {
        echo '<option value="' . $sj['id_status_jabatan'] . '">' . $sj['nama_status_jabatan'] . '</option>';
    }

    echo '</select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama Jabatan</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Jabatan_id_r_jabatan" id="mdlArsip_Jabatan_id_r_jabatan" data-placeholder="Pilih Nama Jabatan" class="form-control">
                                <option value="">Pilih Nama Jabatan</option>';
    foreach ($mst_nama_jabatan->result_array() as $nj) {
        echo '<option value="' . $nj['id_nama_jabatan'] . '">' . $nj['nama_jabatan'] . '</option>';
    }

    echo '</select>
                            <input type="text" class="form-control" name="mdlArsip_Jabatan_nama_jabatan" id="mdlArsip_Jabatan_nama_jabatan" style="display:none;" />
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Lokasi</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Jabatan_lokasi" id="mdlArsip_Jabatan_lokasi" placeholder="Lokasi">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">TMT</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Jabatan_tmt_mulai_jabatan" id="mdlArsip_Jabatan_tmt_mulai_jabatan" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="mdlArsip_Jabatan_nomor_sk" id="mdlArsip_Jabatan_nomor_sk" placeholder="Nomor SK">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="mdlArsip_Jabatan_tgl_sk_jabatan" id="mdlArsip_Jabatan_tgl_sk_jabatan" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Jabatan_title" id="mdlArsip_Jabatan_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Jabatan_file" id="mdlArsip_Jabatan_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Jabatan_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Jabatan_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Jabatan_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddPendidikan" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPendidikanTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Pendidikan_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Pendidikan_id" id="mdlArsip_Pendidikan_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Pendidikan_id_arsip" id="mdlArsip_Pendidikan_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Pendidikan_id_pegawai" id="mdlArsip_Pendidikan_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tingkat Pendidikan</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Pendidikan_id_master_pendidikan" id="mdlArsip_Pendidikan_id_master_pendidikan" data-placeholder="Pilih Tingkat Pendidikan" class="form-control">
                                <option value="">Pilih Tingkat Pendidikan</option>';
    foreach ($mst_pendidikan->result_array() as $mp) {
        echo '<option value="' . $mp['id_master_pendidikan'] . '">' . $mp['nama_pendidikan'] . '</option>';
    }

    echo '</select>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Jurusan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pendidikan_jurusan" id="mdlArsip_Pendidikan_jurusan" placeholder="Jurusan">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tempat Pendidikan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pendidikan_tempat_sekolah" id="mdlArsip_Pendidikan_tempat_sekolah" placeholder="Tempat Pendidikan">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Kota</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pendidikan_kota" id="mdlArsip_Pendidikan_kota" placeholder="Kota">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nomor Ijazah</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pendidikan_nomor_sttb" id="mdlArsip_Pendidikan_nomor_sttb" placeholder="Nomor Ijazah">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Lulus</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pendidikan_tanggal_lulus" id="mdlArsip_Pendidikan_tanggal_lulus" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pendidikan_title" id="mdlArsip_Pendidikan_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Pendidikan_file" id="mdlArsip_Pendidikan_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Pendidikan_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Pendidikan_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Pendidikan_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddPelatihan" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPelatihanTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Pelatihan_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Pelatihan_id" id="mdlArsip_Pelatihan_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Pelatihan_id_arsip" id="mdlArsip_Pelatihan_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Pelatihan_id_pegawai" id="mdlArsip_Pelatihan_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama Pelatihan</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Pelatihan_id_master_pelatihan" id="mdlArsip_Pelatihan_id_master_pelatihan" data-placeholder="Pilih Nama Pelatihan" class="form-control">
                                <option value="">Pilih Nama Pelatihan</option>';
    foreach ($mst_pelatihan->result_array() as $mp) {
        echo '<option value="' . $mp['id_master_pelatihan'] . '">' . $mp['nama_pelatihan'] . '</option>';
    }

    echo '</select>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row" id="grpNamaPelatihanLainnya" style="display:none">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama Pelatihan Lainnya</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pelatihan_nama_pelatihan_lainnya" id="mdlArsip_Pelatihan_nama_pelatihan_lainnya" placeholder="Nama Pelatihan Lainnya">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Lokasi</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pelatihan_lokasi" id="mdlArsip_Pelatihan_lokasi" placeholder="Lokasi">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nomor Sertifikat</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pelatihan_no_sertifikat" id="mdlArsip_Pelatihan_no_sertifikat" placeholder="Nomor Sertifikat">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Sertifikat</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pelatihan_tanggal_sertifikat" id="mdlArsip_Pelatihan_tanggal_sertifikat" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Kota</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pelatihan_kota" id="mdlArsip_Pelatihan_kota" placeholder="Kota">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Keterangan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pelatihan_uraian" id="mdlArsip_Pelatihan_uraian" placeholder="Keterangan">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Pelatihan_title" id="mdlArsip_Pelatihan_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Pelatihan_file" id="mdlArsip_Pelatihan_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Pelatihan_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Pelatihan_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Pelatihan_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddPenghargaan" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPenghargaanTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Penghargaan_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Penghargaan_id" id="mdlArsip_Penghargaan_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Penghargaan_id_arsip" id="mdlArsip_Penghargaan_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Penghargaan_id_pegawai" id="mdlArsip_Penghargaan_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama Penghargaan</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Penghargaan_id_master_penghargaan" id="mdlArsip_Penghargaan_id_master_penghargaan" data-placeholder="Pilih Nama Penghargaan" class="form-control">
                                <option value="">Pilih Nama Penghargaan</option>';
    foreach ($mst_penghargaan->result_array() as $mp) {
        echo '<option value="' . $mp['id_master_penghargaan'] . '">' . $mp['nama_penghargaan'] . '</option>';
    }

    echo '</select>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row" id="grpNamaPenghargaanLainnya" style="display:none">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama Penghargaan Lainnya</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Penghargaan_nama_penghargaan_lainnya" id="mdlArsip_Penghargaan_nama_penghargaan_lainnya" placeholder="Nama Penghargaan Lainnya">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Pemberi Penghargaan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Penghargaan_pemberi_penghargaan" id="mdlArsip_Penghargaan_pemberi_penghargaan" placeholder="Pemberi Penghargaan">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Penghargaan_nomor_sk" id="mdlArsip_Penghargaan_nomor_sk" placeholder="Nomor SK">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Penghargaan_tgl_sk_penghargaan" id="mdlArsip_Penghargaan_tgl_sk_penghargaan" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Penghargaan_title" id="mdlArsip_Penghargaan_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Penghargaan_file" id="mdlArsip_Penghargaan_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Penghargaan_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Penghargaan_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Penghargaan_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddTubel" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTubelTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Tubel_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Tubel_id" id="mdlArsip_Tubel_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Tubel_id_arsip" id="mdlArsip_Tubel_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Tubel_id_pegawai" id="mdlArsip_Tubel_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama Status</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Tubel_uraian" id="mdlArsip_Tubel_uraian" data-placeholder="Pilih Nama Status" class="form-control">
                                <option value="">Pilih Nama Status</option>
                                <option value="Tugas Belajar">Tugas Belajar</option>
                                <option value="Izin Belajar">Izin Belajar</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_no_sk" id="mdlArsip_Tubel_no_sk" placeholder="Nomor SK">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_tgl_sk" id="mdlArsip_Tubel_tgl_sk" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Mulai Pendidikan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_tgl_mulai" id="mdlArsip_Tubel_tgl_mulai" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Selesai Pendidikan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_tgl_selesai" id="mdlArsip_Tubel_tgl_selesai" placeholder="dd-mm-yyyy" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Sekolah</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_sekolah" id="mdlArsip_Tubel_sekolah" placeholder="Sekolah">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Akreditasi</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_akreditasi" id="mdlArsip_Tubel_akreditasi" placeholder="Akreditasi">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Jurusan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_jurusan" id="mdlArsip_Tubel_jurusan" placeholder="Jurusan">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Tubel_title" id="mdlArsip_Tubel_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Tubel_file" id="mdlArsip_Tubel_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Tubel_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Tubel_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Tubel_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddSKP" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddSKPTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_SKP_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_SKP_id" id="mdlArsip_SKP_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_SKP_id_arsip" id="mdlArsip_SKP_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_SKP_id_pegawai" id="mdlArsip_SKP_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Jenis Data</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_SKP_uraian" id="mdlArsip_SKP_uraian" data-placeholder="Pilih Jenis Data" class="form-control">
                                <option value="">Pilih Jenis Data</option>
                                    <option value="SKP">SKP</option>
									<option value="DP3">DP3</option>
                                </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tahun</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_tahun" id="mdlArsip_SKP_tahun" placeholder="Tahun">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Orientasi Pelayanan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_orientasi" id="mdlArsip_SKP_orientasi" placeholder="Orientasi Pelayanan">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Integritas</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_integritas" id="mdlArsip_SKP_integritas" placeholder="Integritas">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Komitmen</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_komitmen" id="mdlArsip_SKP_komitmen" placeholder="Komitmen">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Disiplin</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_disiplin" id="mdlArsip_SKP_disiplin" placeholder="Disiplin">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Kesetiaan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_kesetiaan" id="mdlArsip_SKP_kesetiaan" placeholder="Kesetiaan">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Prestasi</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_prestasi" id="mdlArsip_SKP_prestasi" placeholder="Prestasi">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggung Jawab</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_tanggung_jawab" id="mdlArsip_SKP_tanggung_jawab" placeholder="Tanggung Jawab">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Ketaatan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_ketaatan" id="mdlArsip_SKP_ketaatan" placeholder="Ketaatan">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Kejujuran</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_kejujuran" id="mdlArsip_SKP_kejujuran" placeholder="Kejujuran">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Kerjasama</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_kerjasama" id="mdlArsip_SKP_kerjasama" placeholder="Kerjasama">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Prakarsa</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_prakarsa" id="mdlArsip_SKP_prakarsa" placeholder="Prakarsa">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Kepemimpinan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_kepemimpinan" id="mdlArsip_SKP_kepemimpinan" placeholder="Kepemimpinan">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Rata-rata</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_rata_rata" id="mdlArsip_SKP_rata_rata" placeholder="Rata-rata">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Atasan Penilai</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_atasan" id="mdlArsip_SKP_atasan" placeholder="Atasan Penilai">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Penilai</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_penilai" id="mdlArsip_SKP_penilai" placeholder="Penilai">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_SKP_title" id="mdlArsip_SKP_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_SKP_file" id="mdlArsip_SKP_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_SKP_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_SKP_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_SKP_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalAddHukuman" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddHukumanTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">';

    echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal" id="mdlArsip_Hukuman_frm"');
    echo '<input type="hidden" class="form-control" name="mdlArsip_Hukuman_id" id="mdlArsip_Hukuman_id" />';
    echo '<input type="hidden" class="form-control" name="mdlArsip_Hukuman_id_arsip" id="mdlArsip_Hukuman_id_arsip" />';
    echo '<input type="hidden" name="mdlArsip_Hukuman_id_pegawai" id="mdlArsip_Hukuman_id_pegawai" value="' . $id_pegawai . '" />';
    echo '<div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Jenis Hukuman</label>
                        <div class="col-md-8">
                            <select name="mdlArsip_Hukuman_id_master_hukuman" id="mdlArsip_Hukuman_id_master_hukuman" data-placeholder="Pilih Nama Pelatihan" class="form-control">
                                <option value="">Pilih Jenis Hukuman</option>';
    foreach ($mst_hukuman->result_array() as $mp) {
        echo '<option value="' . $mp['id_hukuman'] . '">' . $mp['nama_hukuman'] . '</option>';
    }

    echo '</select>
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Uraian</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_uraian" id="mdlArsip_Hukuman_uraian" placeholder="Uraian">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_nomor_sk" id="mdlArsip_Hukuman_nomor_sk" placeholder="Nomor SK">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_tanggal_sk" id="mdlArsip_Hukuman_tanggal_sk">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Mulai</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_tanggal_mulai" id="mdlArsip_Hukuman_tanggal_mulai">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Selesai</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_tanggal_selesai" id="mdlArsip_Hukuman_tanggal_selesai">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Masa Berlaku</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_masa_berlaku" id="mdlArsip_Hukuman_masa_berlaku">
                            <span class="help-block"></span>
                        </div>
                    </div>
						
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Pejabat Menetapkan</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_pejabat_menetapkan" id="mdlArsip_Hukuman_pejabat_menetapkan">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Nama File</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mdlArsip_Hukuman_title" id="mdlArsip_Hukuman_title" placeholder="Nama File">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label kt-font-bolder">Upload File</label>
                        <div class="col-md-8">
                            <input type="file" name="mdlArsip_Hukuman_file" id="mdlArsip_Hukuman_file" class="form-control" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row" id="divMdlArsip_Hukuman_lampiran" style="display:none;">
                        <label class="col-md-4 col-form-label kt-font-bolder"></label>
                        <div class="col-md-8">
                            <div id="mdlArsip_Hukuman_lampiran"></div>
                        </div>
                    </div>';
    echo form_close();

    echo '</div>
                <div class="modal-footer">
                    <button type="button" id="mdlArsip_Hukuman_btnSave" class="btn btn-primary" data-dismiss="modal">Simpan</button>&nbsp;
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    echo '<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalLihatFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modalDetailBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-brand" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>';

    //modal kabeh
    echo '<div class="modal fade" id="modal_all" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-family: Source Sans Pro, sans-serif;">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer" hidden="true">
                    <button type="button" class="btn btn-success btn-flat btn-sm" onClick="simpan()" >
                        <span class="fa fa-ok" aria-hidden="true"></span> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>';
}

// function headerTitle() {
//     $obj=& get_instance();
//     echo '<div class="kt-subheader kt-grid__item" id="kt_subheader">
//         <div class="kt-container ">
//             <div class="kt-subheader__main">

//                 <div class="alert alert-box" style="width:100%" role="alert">
//                     <div class="alert-text">
//                         <span class="header-title">'.$obj->config->item('nama_aplikasi_full').'</span>
//                         <br />
//                         <span class="header-title">'.$obj->config->item('nama_instansi').'</span>
//                         <br />
//                         <span class="header-title-small">'.$obj->config->item('alamat_instansi').'</span>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>';
// }
function headerTitle()
{
    $obj = &get_instance();
    $CI = &get_instance();
    $cond = '';
    $user_view = $CI->session->userdata('username');

    if ($CI->session->userdata('lokasi_kerja') != null && $CI->session->userdata('lokasi_kerja') != 0) {
        $cond .= ' and a.lokasi_kerja=' . $CI->session->userdata('lokasi_kerja');
    }

    $condLokasi = 'where 1=1';
    if ($CI->session->userdata('lokasi_kerja') != null && $CI->session->userdata('lokasi_kerja') != 0) {
        $condLokasi .= ' and b.lokasi_kerja=' . $CI->session->userdata('lokasi_kerja');
    }

    $q = $CI->db->query("SELECT group_concat(DATA.nama_pegawai,', ') as pegawai_topensiun
    FROM (select a.* from (
        select nip, nrk, nama_pegawai, tanggal_lahir as str_tgl_lahir, 
                str_to_date(substring(nip,1,8), '%Y%m%d') as date_tgl_lahir,
                id_jabatan, timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) as usia, 
                if (id_jabatan = 2351, ((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now())) * 1), 
                    ((58 - timestampdiff(year, str_to_date(substring(nip,1,8), '%Y%m%d'), now()) * 1))
                ) as masa_pensiun,
                if (id_jabatan = 2351, 
                    (timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))), 
                    (timestampdiff(month,now(),date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))) 
                ) as masa_pensiun_bln,
                if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
                    (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
                ) as tgl_pensiun,
                
                DATE_SUB(
                    if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
                        (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
                    )
                    , INTERVAL 12 MONTH) as warning_6b,
                if(DATE_SUB(
                    if (id_jabatan = 2351, (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year)), 
                        (date_add(str_to_date(substring(nip,1,8), '%Y%m%d'), interval 58 year))
                    )
                    , INTERVAL 12 MONTH) <= CURRENT_DATE(),'1', '0') as kuning,
                lokasi_kerja, status_pegawai 
        from tbl_data_pegawai) a 
        where a.masa_pensiun > 0 AND a.status_pegawai NOT IN (1 ,10)  $cond
        order by a.tgl_pensiun asc) DATA
        WHERE DATA.kuning = '1'")->row();

    $q2 = $CI->db->query("SELECT group_concat(DATA.nama_pegawai,', ') as pegawai_tonaikpangkat FROM (
    select c.*, 
        d.tanggal_sk, d.tanggal_mulai as tmt_pangkat_terakhir, 
        date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year) as tgl_naik_pangkat,
        if(DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 0 MONTH) >= CURRENT_DATE() AND DATE_SUB(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),INTERVAL 6 MONTH)<= CURRENT_DATE(),'1', '0') as kuning,
        substr(date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year),1,4) as tahun_naik_pangkat,
        timestampdiff(day,now(),date_add(str_to_date(d.tanggal_mulai, '%d-%m-%Y'), interval 4 year)) as masa_hari_naik_pangkat,
        e.golongan, e.uraian
    from 
    (
        select b.id_pegawai, b.nama_pegawai, b.nip, b.nrk,jml,
                (
                    select a.id_riwayat_pangkat
                    from tbl_data_riwayat_pangkat a
                    where a.id_pegawai = b.id_pegawai " . $cond . " 
                    order by date_add(str_to_date(a.tanggal_mulai, '%d-%m-%Y'), interval 4 year) desc 
                    limit 1
                ) as id_pangkat
        from tbl_data_pegawai b 
        LEFT JOIN(
            SELECT count(*) as jml, user_view, nrk as nomor_rk
            FROM naik_pangkat_see WHERE user_view='$user_view'
            GROUP BY user_view, nrk
        ) as see ON see.nomor_rk = b.nrk
        " . $condLokasi . " 
    ) c 
    left join tbl_data_riwayat_pangkat d on d.id_riwayat_pangkat = c.id_pangkat 
    left join tbl_master_golongan e on e.id_golongan = d.id_golongan
    where c.id_pangkat is not null 
    order by kuning DESC) DATA
            WHERE DATA.kuning ='1'")->row();

    //return $q->jumlah;
    echo '<div class="kt-subheader kt-grid__item" id="kt_subheader" style="margin-bottom: 35px;">
        <div class="kt-container ">
            <div class="kt-subheader__main">

                <div class="alert alert-box" style="width:100%" role="alert">
                    <div class="alert-text">
                        <span class="header-title">' . $obj->config->item('nama_aplikasi_full') . '</span>
                        <br />
                        <span class="header-title">' . $obj->config->item('nama_instansi') . '</span>
                        <br />
                        <span class="header-title-small">' . $obj->config->item('alamat_instansi') . '</span>

                        <br /><br />
                        <span class="header-title-small" style="font-size:12px;color:#fff;">
                        
                        <div class="col-12">
                            <div class="row" style="flex-wrap: nowrap;">
                            <p style="white-space: nowrap; font-weight:bold;">Pegawai Yang Akan Pensiun 6 Bulan Mendatang :</p>
                            <div class="col-3">';
    //echo '<marquee scrolldelay="120"> '.$q->pegawai_topensiun.'</marquee>';
    echo '<marquee scrolldelay="200"><a style="font-size:12px;color:#fff;" href="' . base_url() . 'admin/laporan_pegawai_masa_pensiun" class="kt-menu__link ">' . $q->pegawai_topensiun . '</a></marquee>
                            </div>
                            <p style="white-space: nowrap; font-weight:bold">Pegawai Yang Akan Naik Pangkat 6 Bulan Mendatang :</p>
                            <div class="col-3">';
    //echo '<marquee scrolldelay="120">'.$q2->pegawai_tonaikpangkat.'</marquee>';
    echo '<marquee scrolldelay="200"><a style="font-size:12px;color:#fff;" href="' . base_url() . 'admin/laporan_pegawai_naik_pangkat" class="kt-menu__link ">' . $q2->pegawai_tonaikpangkat . '</a></marquee>
                            </div>
                        </div>
                        </div>
                          
                        </span>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}

if (!function_exists('get_array_value')) {

    function get_array_value(array $array, $key)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
    }
}

if (!function_exists('modal_anchor')) {

    function modal_anchor($url, $title = '', $attributes = [])
    {
        $attributes["data-act"] = "ajax-modal";
        if (get_array_value($attributes, "data-modal-title")) {
            $attributes["data-title"] = get_array_value($attributes, "data-modal-title");
        } else {
            $attributes["data-title"] = get_array_value($attributes, "title");
        }
        $attributes["data-url"] = $url;

        return js_anchor($title, $attributes);
    }
}

if (!function_exists('js_anchor')) {

    function js_anchor($title = '', $attributes = array())
    {
        $title = (string) $title;
        $html_attributes = "";

        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                $html_attributes .= ' ' . $key . '="' . $value . '"';
            }
        }

        return '<a href="javascript:;"' . $html_attributes . '>' . $title . '</a>';
    }
}
