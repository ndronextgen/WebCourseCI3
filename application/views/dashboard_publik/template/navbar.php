<header class="main-header">
    <nav class="navbar navbar-fixed-top">
        <div class="container main-container">

            <a class="navbar-brand" href="<?= base_url(); ?>dashboard_publik">
                <img alt="Logo" src="<?= base_url() ?>assets_admin/media/logos/logox24.png" style="float:left; margin-right:10px;" />
                <?php echo $judul_pendek; ?>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="active"><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">Kertas Kerja &nbsp;
                                <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                <?php if ($count_see > 0 or $count_see_tj > 0 or $count_see_kaku > 0) { ?>
                                    <span class="badge btn-warning btn-flat"><?php echo $count_see + $count_see_tj + $count_see_kaku; ?></span>
                                <?php } ?>
                                <i class="caret"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href=" <?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-leaf icon-white"></i>Surat Keterangan Pegawai &nbsp;
                                    <?php if ($count_see > 0) { ?>
                                        <span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>tunjangan"><i class="icon-leaf icon-white"></i>Surat Permohonan Tunjangan Keluarga &nbsp;
                                    <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                    <?php if ($count_see_tj > 0) { ?>
                                        <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_tj; ?></span>
                                    <?php } ?>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url(); ?>kariskarsu"><i class="icon-leaf icon-white"></i>Surat Permohonan KARIS/KARSU &nbsp;
                                    <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                    <?php if ($count_see_kaku > 0) { ?>
                                        <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_kaku; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class=""><a href="<?php echo base_url(); ?>Lapor"><i class="icon-home icon-white"></i> Lapor
                            <?php if ($count_see_lapor > 0) { ?>
                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_lapor; ?></span>
                            <?php } ?>
                        </a></li>

                    <?php if ($status_user == 'true') { ?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">Verifikasi &nbsp;
                                    <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
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
                                <li>
                                    <a href="<?php echo base_url(); ?>verifikasi"><i class="icon-off"></i> Verifikasi Surat Keterangan Pegawai &nbsp;
                                        <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                        <?php if ($count_see_verifikasi > 0) { ?>
                                            <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi; ?></span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>verifikasi_tunjangan"><i class="icon-off"></i> Verifikasi Surat Permohonan Tunjangan Keluarga &nbsp;
                                        <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                        <?php if ($count_see_verifikasi_tj > 0) { ?>
                                            <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tj; ?></span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>verifikasi_kariskarsu"><i class="icon-off"></i> Verifikasi Surat Permohonan KARIS/KARSU &nbsp;
                                        <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
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
                                    <li>
                                        <a href="<?php echo base_url(); ?>verifikasi_hukdis"><i class="icon-off"></i> Verifikasi Surat Keterangan Hukuman Disiplin &nbsp;
                                            <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                            <?php if ($count_see_verifikasi_hukdis > 0) { ?>
                                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_hukdis; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>verifikasi_tindak_pidana"><i class="icon-off"></i> Verifikasi Surat Keterangan Bebas Tindak Pidana &nbsp;
                                            <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                            <?php if ($count_see_verifikasi_tp > 0) { ?>
                                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tp; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>verifikasi_pengembangan_karir"><i class="icon-off"></i> Verifikasi Surat Kebutuhan Pengembangan Karir &nbsp;
                                            <!--<small class="badge" style="font-size: 9px;padding: 5px;background: #f7e928;color:#d9351c;">Baru!</small>&nbsp;-->
                                            <?php if ($count_see_verifikasi_karir > 0) { ?>
                                                <span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_karir; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li class=''>
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
                            <!-- <li><a href="<?php //echo base_url(); 
                                                ?>app/change_password_publik"><i class="icon-wrench"></i> Pengaturan Akun</a></li> -->
                            <li><a href="<?php echo "https://dcktrp.jakarta.go.id/satuakses/app/profile" ?>" target="_blank"><i class="icon-off"></i> Profil</a></li>
                            <li><a href="<?php echo base_url(); ?>app/logout"><i class="icon-off"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>