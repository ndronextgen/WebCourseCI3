

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
                                    <td width='200px'>Nama</td>
                                    <td width='2px'>:</td>
                                    <td><?php echo $Data->nama; ?></td>
                                </tr>
                                <tr>
                                    <td  width='200px'>NIP</td>
                                    <td width='2px'>:</td>
                                    <td><?php echo $Data->nip; ?></td>
                                </tr>
                                <tr>
                                    <td width='200px'>Lokasi Kerja</td>
                                    <td width='2px'>:</td>
                                    <td><?php echo $Data->nama_lokasi_kerja; ?></td>
                                </tr>
                                <tr>
                                    <td width='200px'>Jenis Surat</td>
                                    <td width='2px'>:</td>
                                    <td><?php echo $Data->nama_surat; ?></td>
                                </tr>
                                <tr>
                                    <td width='200px'>Status Surat</td>
                                    <td width='2px'>:</td>
                                    <td><?php echo $Data->status; ?></td>
                                </tr>
                                <tr>
                                    <td width='200px'>Tanggal Dibuat</td>
                                    <td width='2px'>:</td>
                                    <td><?php echo $Data->tgl_proses; ?></td>
                                </tr>
                                <tr>
                                    <td width='200px'><b>Keperluan</b></td>
                                    <td width='2px'><b>:</b></td>
                                    <td><b><?php echo $Data->keterangan_pengajuan; ?><b></td>
                                </tr>
                                <tr>
                                    <td width='200px'>Jenis Tanda Tangan</td>
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