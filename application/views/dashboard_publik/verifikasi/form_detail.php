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
                            <td>
                                <?php
                                if ((int) $Data->id_status_srt == 21) {
                                    if ($Data->is_dinas == 1) {
                                        echo 'Menunggu Verifikasi Kepala Subkoordinator Kepegawaian';
                                    } else {
                                        echo 'Menunggu Verifikasi Kepala Subbagian';
                                    }
                                } else {
                                    echo str_replace('<br>', ' ', $Data->nama_status_next);
                                }
                                ?>
                            </td>
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


<h4 style="text-align: center;">Timeline Surat</h4>
<br>

<!-- <div class="box-body"> -->

<!-- <div class="box" style="background-color: #f1f1f6; border: 1px solid grey;"> -->

<!-- <legend style="border-bottom: 1px solid #1c8baf; border-top: 1px solid #1c8baf; text-align: center;"> -->
<!-- <h4 style="font-size: medium;">Perjalanan Pengajuan Surat Keterangan Pegawai</h4> -->
<!-- </legend> -->

<div class="box-body">

    <!-- <div class="container" style="width: auto;"> -->
    <!-- <div class="timeline"> -->
    <!-- <ul class="ul-li-timeline"> -->

    <?php
    $data1['data_history'] = $data_history;
    $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline_content_2', $data1);
    ?>

    <!-- </ul> -->
    <!-- </div> -->
    <!-- </div> -->

</div>

<!-- </div> -->

<!-- </div> -->

<hr style="border: 1px solid #1c8baf; margin-bottom: 15px; ">

<!-- <div class="control-group"> -->
<button id='' type='button' onclick="tutup_form_detail()" class='btn btn-danger btn-sm' style='float:right; margin-top: 0px; margin-right: 0px;'><i class="fa fa-times"></i>&nbsp; Tutup</button>
<!-- </div> -->