<?php
$aktif_beranda = '';
$aktif_arsip_digital = '';
$aktif_kertas_kerja = '';
$aktif_kertas_kerja_1 = ''; // keterangan pegawai
$aktif_kertas_kerja_2 = ''; // tunjangan keluarga
$aktif_kertas_kerja_3 = ''; // karis/karsu
$aktif_lapor = '';
$aktif_verifikasi = '';
$aktif_verifikasi_1 = ''; // ver keterangan pegawai
$aktif_verifikasi_2 = ''; // ver tunjangan keluarga
$aktif_verifikasi_3 = ''; // ver karis/karsu
$aktif_verifikasi_4 = ''; // ver hukuman disiplin
$aktif_verifikasi_5 = ''; // ver tindak pidana
$aktif_verifikasi_6 = ''; // ver pengembangan karir
$aktif_verifikasi_7 = ''; // ver pindah tugas

if ($menu == 'beranda') {
    $aktif_beranda = 'active';
} elseif ($menu == 'arsip digital') {
    $aktif_arsip_digital = 'active';
} elseif ($menu == 'keterangan pegawai') {
    $aktif_kertas_kerja = 'active';
    $aktif_kertas_kerja_1 = 'active';
} elseif ($menu == 'tunjangan keluarga') {
    $aktif_kertas_kerja = 'active';
    $aktif_kertas_kerja_2 = 'active';
} elseif ($menu == 'karis/karsu') {
    $aktif_kertas_kerja = 'active';
    $aktif_kertas_kerja_3 = 'active';
} elseif ($menu == 'lapor') {
    $aktif_lapor = 'active';
} elseif ($menu == 'ver keterangan pegawai') {
    $aktif_verifikasi = 'active';
    $aktif_verifikasi_1 = 'active';
} elseif ($menu == 'ver tunjangan keluarga') {
    $aktif_verifikasi = 'active';
    $aktif_verifikasi_2 = 'active';
} elseif ($menu == 'ver karis/karsu') {
    $aktif_verifikasi = 'active';
    $aktif_verifikasi_3 = 'active';
} elseif ($menu == 'ver hukuman disiplin') {
    $aktif_verifikasi = 'active';
    $aktif_verifikasi_4 = 'active';
} elseif ($menu == 'ver tindak pidana') {
    $aktif_verifikasi = 'active';
    $aktif_verifikasi_5 = 'active';
} elseif ($menu == 'ver pengembangan karir') {
    $aktif_verifikasi = 'active';
    $aktif_verifikasi_6 = 'active';
} elseif ($menu == 'ver pindah tugas') {
    $aktif_verifikasi = 'active';
    $aktif_verifikasi_7 = 'active';
}
?>

<header class="main-header">
    <nav class="navbar navbar-fixed-top">
        <div class="container main-container">

            <a class="navbar-brand" href="<?= base_url(); ?>dashboard_publik">
                <img alt="Logo" src="<?= base_url() ?>assets_admin/media/logos/logox24.png" style="float:left; margin-right:10px;" />
                <?php echo $judul_pendek ?>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="<?= $aktif_beranda ?>"><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
                    <li class="<?= $aktif_arsip_digital ?>"><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>

                    <li class="dropdown user user-menu <?= $aktif_kertas_kerja ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">Kertas Kerja &nbsp;
                                <?php if ($count_see > 0 or $count_see_tj > 0 or $count_see_kaku > 0) { ?>
                                    <span class="badge btn-warning btn-flat"><?php echo $count_see + $count_see_tj + $count_see_kaku; ?></span>
                                <?php } ?>
                                <i class="caret"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="<?= $aktif_kertas_kerja_1 ?>">
                                <a href=" <?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-leaf icon-white"></i>Surat Keterangan Pegawai &nbsp;
                                    <?php if ($count_see > 0) { ?>
                                        <span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li class="<?= $aktif_kertas_kerja_2 ?>">
                                <a href="<?php echo base_url(); ?>tunjangan"><i class="icon-leaf icon-white"></i>Surat Permohonan Tunjangan Keluarga &nbsp;
                                    <?php if ($count_see_tj > 0) { ?>
                                        <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_tj; ?></span>
                                    <?php } ?>
                                </a>
                            </li>

                            <li class="<?= $aktif_kertas_kerja_3 ?>">
                                <a href="<?php echo base_url(); ?>kariskarsu"><i class="icon-leaf icon-white"></i>Surat Permohonan KARIS/KARSU &nbsp;
                                    <?php if ($count_see_kaku > 0) { ?>
                                        <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_kaku; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="<?= $aktif_lapor ?>">
                        <a href="<?php echo base_url(); ?>Lapor"><i class="icon-home icon-white"></i> Lapor
                            <?php if ($count_see_lapor > 0) { ?>
                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_lapor; ?></span>
                            <?php } ?>
                        </a>
                    </li>

                    <?php if ($status_user == 'true') { ?>
                        <li class="dropdown user user-menu <?= $aktif_verifikasi ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">Verifikasi &nbsp;
                                    <?php if (
                                            $count_see_verifikasi > 0
                                            or $count_see_verifikasi_tj > 0
                                            or $count_see_verifikasi_kaku > 0
                                            or $count_see_verifikasi_hukdis > 0
                                            or $count_see_verifikasi_tp > 0
                                            or $count_see_verifikasi_karir > 0
                                            or $count_see_verifikasi_pindah_tugas > 0
                                        ) { ?>
                                        <span class="badge btn-warning btn-flat"><?php echo $count_see_verifikasi
                                                                                                + $count_see_verifikasi_tj
                                                                                                + $count_see_verifikasi_kaku
                                                                                                + $count_see_verifikasi_hukdis
                                                                                                + $count_see_verifikasi_tp
                                                                                                + $count_see_verifikasi_karir
                                                                                                + $count_see_verifikasi_pindah_tugas; ?></span>
                                    <?php } ?>
                                    <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="<?= $aktif_verifikasi_1 ?>">
                                    <a href="<?php echo base_url(); ?>verifikasi"><i class="icon-off"></i> Verifikasi Surat Keterangan Pegawai &nbsp;
                                        <?php if ($count_see_verifikasi > 0) { ?>
                                            <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi; ?></span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <li class="<?= $aktif_verifikasi_2 ?>">
                                    <a href="<?php echo base_url(); ?>verifikasi_tunjangan"><i class="icon-off"></i> Verifikasi Surat Permohonan Tunjangan Keluarga &nbsp;
                                        <?php if ($count_see_verifikasi_tj > 0) { ?>
                                            <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tj; ?></span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <li class="<?= $aktif_verifikasi_3 ?>">
                                    <a href="<?php echo base_url(); ?>verifikasi_kariskarsu"><i class="icon-off"></i> Verifikasi Surat Permohonan KARIS/KARSU &nbsp;
                                        <?php if ($count_see_verifikasi_kaku > 0) { ?>
                                            <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_kaku; ?></span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <?php
                                    #hanya admin kepegawaian dan sekdis yg bisa akses ini
                                    $id_pegawai = $this->session->userdata('id_pegawai');
                                    $query_exist_view_kk = $this->db->query("SELECT COUNT(*) as jml FROM view_kasubag_kepegawaian WHERE id_pegawai = '$id_pegawai'")->row();
                                    $query_exist_view_sekdis = $this->db->query("SELECT COUNT(*) as jml FROM view_sekdis WHERE id_pegawai = '$id_pegawai'")->row();
                                    if ($query_exist_view_kk->jml > 0 || $query_exist_view_sekdis->jml > 0) {
                                        ?>
                                    <li class="<?= $aktif_verifikasi_4 ?>">
                                        <a href="<?php echo base_url(); ?>verifikasi_hukdis"><i class="icon-off"></i> Verifikasi Surat Keterangan Hukuman Disiplin &nbsp;
                                            <?php if ($count_see_verifikasi_hukdis > 0) { ?>
                                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_hukdis; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class="<?= $aktif_verifikasi_5 ?>">
                                        <a href="<?php echo base_url(); ?>verifikasi_tindak_pidana"><i class="icon-off"></i> Verifikasi Surat Keterangan Bebas Tindak Pidana &nbsp;
                                            <?php if ($count_see_verifikasi_tp > 0) { ?>
                                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tp; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class="<?= $aktif_verifikasi_6 ?>">
                                        <a href="<?php echo base_url(); ?>verifikasi_pengembangan_karir"><i class="icon-off"></i> Verifikasi Surat Kebutuhan Pengembangan Karir &nbsp;
                                            <?php if ($count_see_verifikasi_karir > 0) { ?>
                                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_karir; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class="<?= $aktif_verifikasi_7 ?>">
                                        <a href="<?php echo base_url(); ?>verifikasi_pindah_tugas"><i class="icon-off"></i> Verifikasi Surat Kebutuhan Pindah Tugas &nbsp;
                                            <?php if ($count_see_verifikasi_pindah_tugas > 0) { ?>
                                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_pindah_tugas; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <li class=""><a href="<?php echo base_url(); ?>dashboard_publik/download_manualbook" title="Download Panduan Penggunaan"><i class="icon-home icon-white"></i> Panduan</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Pedoman<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_3" target=""><i class="icon-fire"></i> SK Kepala Dinas Update Data SI-ADiK</a></li>
                            <li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_1" target=""><i class="icon-fire"></i> Permendikbud RI No. 50 Tahun 2015</a></li>
                            <li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_2" target=""><i class="icon-fire"></i> Pergub DKI Jakarta No. 99 Tahun 2021</a></li>
                        </ul>
                    </li>

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php
                            $ft = $foto;
                            if ($ft == "") {
                                $ft = "nofoto.png";
                                ?>
                                <img src="<?php echo base_url(); ?>asset/foto_pegawai/no-image/<?php echo $ft; ?>" class="user-image" alt="User Image" style="" />
                            <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url(); ?>asset/foto_pegawai/thumb/<?php echo $ft; ?>" class="user-image" alt="User Image" style="" />
                            <?php
                            }

                            $nama = str_replace("&nbsp;", " ", $this->func_table->name_format($this->session->userdata('nama')));
                            ?>
                            <span class="hidden-xs"><?php echo $nama; ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo "https://dcktrp.jakarta.go.id/satuakses/app/profile" ?>" target="_blank"><i class="icon-off"></i> Profil</a></li>
                            <li><a href="<?php echo base_url(); ?>app/logout"><i class="icon-off"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <?php // echo menuHtml(); ?>

        </div>
    </nav>
</header>