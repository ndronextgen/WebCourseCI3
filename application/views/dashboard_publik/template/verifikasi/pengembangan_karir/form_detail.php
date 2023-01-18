<style type="text/css">
    .modal-body {
        overflow-y: auto;
    }
</style>

<div class="box box-info">
    <div class="box-header">
        <div class="box-tools pull-right">
            <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
            <div id='loading'></div>
        </div>
    </div>
    <div class="box-body">
        <form id="form_verifikasi_tindak_pidana_kep" name="form_verifikasi_tindak_pidana_kep" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="hr hr-18 hr-double dotted"></div>

                    <table class='table' cellspacing='10' cellpadding='5'>
                        <tr>
                            <td width='150px'>Nama Lengkap</td>
                            <td width='1px'>:</td>
                            <td><?php echo ucwords(strtolower($Data->nama_pegawai)); ?></td>
                        </tr>
                        <tr>
                            <td>NIP / NRK</td>
                            <td>:</td>
                            <td><?php echo $Data->nip . ' / ' . $Data->nrk; ?></td>
                        </tr>
                        <tr>
                            <td>Pangkat / Golongan</td>
                            <td>:</td>
                            <td><?php echo ucwords(strtolower($Data->uraian)) . ' ( ' . $Data->golongan . ' )'; ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td><?php echo ucwords(strtolower($Data->nama_jabatan)); ?></td>
                        </tr>
                        <tr>
                            <td>Satuan Organisasi</td>
                            <td>:</td>
                            <td>
                                <?php
                                $lokasi = ucwords(strtolower($Data->nama_lokasi_kerja));
                                $lokasi = str_replace('Dan', 'dan', $lokasi);
                                $lokasi = str_replace('Dki', 'DKI', $lokasi);
                                // echo str_replace('Dan', 'dan', ucwords(strtolower($Data->nama_lokasi_kerja)));
                                echo $lokasi;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?php echo $Data_pengembangan_karir->Keterangan; ?></td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>:</td>
                            <td><?php echo $Data_pengembangan_karir->Periode_awal . ' - ' . $Data_pengembangan_karir->Periode_akhir; ?></td>
                        </tr>
                        <tr>
                            <td>Digunakan Untuk</td>
                            <td>:</td>
                            <td><?php echo $Data_pengembangan_karir->Keperluan; ?></td>
                        </tr>

                    </table>

                    <hr>
                    <h4 style="text-align: center;">Timeline Surat</h4>
                    <br>

                    <?php
                    $data1['data_history'] = $data_history;
                    $this->load->view('dashboard_publik/template/timeline/timeline_content_2', $data1);
                    ?>

                </div>
            </div>
    </div><!-- /.box-body -->

    <hr style="border: 1px solid #1c8baf; margin-bottom: 15px; ">

    <div class="control-group">
        <button type="button" style='float:right; margin-top: -5px;' class="btn btn-danger btn-sm" onclick="tutup_form_detail()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
    </div>

</div>