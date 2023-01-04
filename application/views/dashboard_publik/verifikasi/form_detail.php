<style type="text/css">
    .modal-body {
        overflow-y: auto;
    }

    /* .box-body {
        padding: 0px;
    } */
</style>

<div class="box box-info">
    <div class="box-header">
        <div class="box-tools pull-right">
            <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
            <div id='loading'></div>
        </div>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-md-12">
                <div class="hr hr-18 hr-double dotted"></div>

                <table class="table">
                    <tbody>
                        <tr>
                            <td width='150px'>Nama</td>
                            <td width='2px'>:</td>
                            <td><?php echo ucwords(strtolower($Data->nama)); ?></td>
                        </tr>
                        <tr>
                            <td width='150px'>NIP</td>
                            <td width='2px'>:</td>
                            <td><?php echo $Data->nip; ?></td>
                        </tr>
                        <tr>
                            <td width='150px'>Lokasi Kerja</td>
                            <td width='2px'>:</td>
                            <td><?php
                                $lokasi = ucwords(strtolower($Data->nama_lokasi_kerja));
                                $lokasi = str_replace('Dan', 'dan', $lokasi);
                                $lokasi = str_replace('Dki', 'DKI', $lokasi);
                                echo $lokasi;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width='150px'>Jenis Surat</td>
                            <td width='2px'>:</td>
                            <td><?php echo $Data->nama_surat; ?></td>
                        </tr>
                        <tr>
                            <td width='150px'>Status Surat</td>
                            <td width='2px'>:</td>
                            <td><?php echo $Data->status; ?></td>
                        </tr>
                        <tr>
                            <td width='150px'>Tanggal Dibuat</td>
                            <td width='2px'>:</td>
                            <td><?php echo $Data->tgl_proses; ?></td>
                        </tr>
                        <tr>
                            <td width='150px'><b>Keperluan</b></td>
                            <td width='2px'><b>:</b></td>
                            <td><b><?php echo $Data->keterangan_pengajuan; ?><b></td>
                        </tr>
                        <tr>
                            <td width='150px'>Jenis Tanda Tangan</td>
                            <td width='2px'>:</td>
                            <td><?php echo $Data->select_ttd; ?></td>
                        </tr>
                </table>
                <div class="row">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        <div id="loading" style='text-align:center;'>
                        </div>
                    </div>
                    <div class="col-xs-4"></div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>

<!-- <div class="box-body"> -->

    <div class="box" style="background-color: #f1f1f6; border: 1px solid grey;">

        <legend style="border-bottom: 1px solid #1c8baf; border-top: 1px solid #1c8baf; text-align: center;">
            <h4 style="font-size: medium;">Perjalanan Pengajuan Surat Keterangan Pegawai</h4>
        </legend>

        <div class="box-body">

<div class="container" style="width: auto;">
    <div class="timeline">
        <ul class="ul-li-timeline">

        <?php
                if (isset($data_history)) {
                    $data_id_status = '';
                    $data_is_dinas = '';
                    foreach ($data_history as $data) {
                        $nama_user = ucwords(strtolower($this->func_table->removeTitleFromName($data->nama_pegawai)));
                        echo '
                <li class="ul-li-timeline">
                    <div class="content">
                        <h3>' . date_format(date_create($data->created_at), 'd M Y - H:i:s') . '</h3>';
                        echo '
                        <p>' . $data->nama_status . '';
                        if ($data->id_status == '24' or $data->id_status == '25' or $data->id_status == '26' or $data->id_status == '28') {
                            echo '<br><br>Alasan ditolak: ';
                            if ($data->keterangan_ditolak == '') {
                                echo '-';
                            } else {
                                echo $data->keterangan_ditolak;
                            }
                        }
                        echo '</p>
                    </div>
                    
                    <div class="point"></div>

                    <div class="date">
                        <h4 style="padding: 15px 0;">' . $nama_user . '</h4>
                    </div>
                </li>
                    ';

                        $data_id_status = $data->id_status;
                        $data_is_dinas = $data->is_dinas;
                    }

                    if ($data_id_status == 24 or $data_id_status == 25 or $data_id_status == 26 or $data_id_status == 28) {
                        goto exit_1;
                    }

                    // $id_srt = $data->id_srt;
                    // $sSQL = "SELECT is_dinas from tbl_data_srt_ket where id_srt = '$id_srt'";
                    // $is_dinas = $this->db->query($sSQL)->row()->is_dinas;

                    switch ($data_is_dinas) {
                        case 1:
                            if (
                                $data_id_status == '0' or  // menunggu
                                $data_id_status == '24'    // ditolak admin
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <!--<p  style="background-color: #aca9b1">Diverifikasi Admin</p>-->
                                        <p  style="background-color: ">Diverifikasi Admin</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data_id_status == '0' or  // menunggu
                                $data_id_status == '21' or // Diverifikasi admin
                                $data_id_status == '25'    // ditolak kasubbag kepegawaian
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Diverifikasi Kepala Subbagian Kepegawaian</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data_id_status == '0' or  // menunggu
                                $data_id_status == '21' or // Diverifikasi admin
                                $data_id_status == '22' or // Diverifikasi kasubbag
                                $data_id_status == '26'    // ditolak sekdis
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Diverifikasi Sekretaris Dinas</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                // $data_id_status == '0' or  // menunggu
                                // $data_id_status == '21' or // Diverifikasi admin
                                // $data_id_status == '22' or // Diverifikasi kasubbag
                                $data_id_status == '23'    // Diverifikasi sekdis
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }

                            break;

                        case 0:
                        case 2:
                            if (
                                $data_id_status == '0' or  // menunggu
                                $data_id_status == '24'    // ditolak admin
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Diverifikasi Admin</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data_id_status == '0' or  // menunggu
                                $data_id_status == '21' or // Diverifikasi admin
                                $data_id_status == '28'    // ditolak kasubbag
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Diverifikasi Kepala Subbagian</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data_id_status == '0' or  // menunggu
                                $data_id_status == '21' or // Diverifikasi admin
                                $data_id_status == '27'    // Diverifikasi kasubbag
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }

                            break;
                    }

                    exit_1:
                }
                ?>

        </ul>
    </div>
</div>

</div>

    </div>

<!-- </div> -->

<hr style="border: 1px solid #1c8baf; margin-bottom: 15px; ">

<div class="control-group">
    <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="tutup_form()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
</div>