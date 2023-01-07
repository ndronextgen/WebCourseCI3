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
        <form id="form_verifikasi_pengembangan_karir_kep" name="form_verifikasi_pengembangan_karir_kep" method="post">
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

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <?php
                                $data1['data_history'] = $data_history;
                                $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline_content_2', $data1);
                                ?>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Pilih Verifikasi</label>
                                <select class="form-control input-md" name="status_verify" id="status_verify">
                                    <option value="">[ Pilih Verifikasi ]</option>
                                    <option value="<?php echo $terima; ?>">Terima</option>
                                    <option value="<?php echo $tolak; ?>">Tolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-8" id="divKet" style="display:none;">
                            <div class="form-group">
                                <label>Alasan Ditolak</label>
                                <input type='text' name="ket" id="ket" class="form-control input-md">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label></label>
                                <input type='hidden' value='<?php echo $Pengembangan_karir_id; ?>' name='Pengembangan_karir_id' Id='Pengembangan_karir_id'>
                                <button id='btn_tmb' type='button' onclick="simpan_verifikasi_pengembangan_karir()" class='btn btn-block btn-success btn-md'>Verifikasi</button>
                            </div>
                        </div>
                    </div>
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

        </form>
    </div><!-- /.box-body -->

    <button type="button" style='float:right; margin-top: -20px; margin-right: 15px;' class="btn btn-danger btn-sm" onclick="tutup_form_detail()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>

</div>

<script type="text/javascript">
    $('#status_verify').change(function() {
        var status_verify = $('#status_verify').val();
        const targetDiv = document.getElementById("divKet");
        if (status_verify == 24 || status_verify == 25 || status_verify == 26 || status_verify == 28) {
            targetDiv.style.display = "block";
        } else {
            targetDiv.style.display = "none";
        }

    });
</script>