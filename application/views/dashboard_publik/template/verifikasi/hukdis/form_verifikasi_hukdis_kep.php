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
        <form id="form_verifikasi_hukdis_kep" name="form_verifikasi_hukdis_kep" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="hr hr-18 hr-double dotted"></div>

                    <table class='table no-border' cellspacing='10' cellpadding='5'>
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
                            <td>Unit Kerja</td>
                            <td>:</td>
                            <td><?php echo str_replace('Dan', 'dan', str_replace('Dki', 'DKI', ucwords(strtolower($Data->nama_lokasi_kerja)))); ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?php echo $Data_hukdis->nama_type; ?></td>
                        </tr>
                    </table>

                    <hr>
                    <h4 style="text-align: center;">Timeline Surat</h4>
                    <br>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <?php
                                $data1['data_history'] = $data_history;
                                $this->load->view('dashboard_publik/template/timeline/timeline_content_2', $data1);
                                ?>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4 style="text-align: center;">Form Verifikasi</h4>
                    <br>

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
                                <input type='hidden' value='<?php echo $Hukdis_id; ?>' name='Hukdis_id' Id='Hukdis_id'>
                                <button id='btn_tmb' type='button' onclick="simpan_verifikasi_hukdis()" class='btn btn-block btn-success btn-md'>Verifikasi</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                            <div id="loading" style='text-align: center;'>
                            </div>
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
            </div>

        </form>
    </div><!-- /.box-body -->

</div>

<div class="control-group">
    <button type="button" style='float: right; margin-top: -20px; margin-right: 0px;' class="btn btn-danger btn-sm" onclick="tutup_form_detail()">
        <i class="fa fa-times"></i>&nbsp; Tutup
    </button>
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