<div class="box-body">
    <form id="form_ubah_data_pegawai" name="form_ubah_data_pegawai" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="hr hr-18 hr-double dotted"></div>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control input-sm" name="nama_pegawai" id="nama_pegawai" value="<?php echo ucwords(strtolower($Data->nama_pegawai)); ?>">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="nip" id="nip" value="<?php echo $Data->nip; ?>">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>NRK</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="nrk" id="nrk" value="<?php echo $Data->nrk; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control input-sm" name="tempat_lahir" id="tempat_lahir" value="<?php echo $Data->tempat_lahir; ?>">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control input-sm" value="<?php echo date_format(date_create($Data->tanggal_lahir), 'j M Y'); ?>" id="tanggal_lahir" name="tanggal_lahir">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Jenis kelamin</label>
                            <select class="form-control select" name="jenis_kelamin" id="jenis_kelamin">
                                <?php
                                foreach ($jenis_kelamin as $d) {
                                    echo "<option value='$d->uraian'";
                                    if ($d->uraian == $Data->jenis_kelamin) {
                                        echo ' selected';
                                    }
                                    echo ">$d->uraian</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Agama</label>
                            <select class="form-control select" name="agama" id="agama">
                                <?php
                                foreach ($mt_agama as $d) {
                                    echo "<option value='$d->agama'";
                                    if ($d->agama == $Data->agama) {
                                        echo ' selected';
                                    }
                                    echo ">$d->agama</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Status Kepegawawian</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="nama_status" id="nama_status" value="<?php echo $Data->nama_status; ?>">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Pangkat / Golongan</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="nama_status" id="nama_status" value="<?php echo $Data->uraian . ' ' . $Data->golongan; ?>">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Masa Kerja Golongan</label>
                            <?php
                            $tmt_awal = date($Data->tanggal_mulai_pangkat);
                            $date_now = date("Y-m-d h:i:sa");
                            $datetime1 = new DateTime($tmt_awal); //start time
                            $datetime2 = new DateTime($date_now); //end time
                            $durasi = $datetime1->diff($datetime2);
                            $durasi = $durasi->format('%y Tahun %m Bulan');
                            //echo $Data->tanggal_mulai_pangkat; 
                            ?>
                            <input type="text" class="form-control input-sm avoid-clicks" name="masa_kerja" id="masa_kerja" value="<?= $durasi ?>">
                        </div>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Pada Unit Kerja</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="nama_lokasi_kerja" id="nama_lokasi_kerja" value="<?php echo $Data->nama_lokasi_kerja; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">



                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control textarea input-sm" name="alamat" id="alamat" placeholder="Alamat"><?php echo $Data->alamat; ?></textarea>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <p style="color:red;">*) Silahkan Hubungi Administrator jika ingin mengubah isian yang disable/tidak aktif</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row pull-right" style="padding-right: 20px;">
                            <input type='hidden' value='<?php echo $Data->id_pegawai; ?>' name='id_pegawai' Id='id_pegawai'>
                            <button type='button' class="btn btn-sm btn-success" id="btn_ubah_pegawai" onclick='simpan_perubahan();'>Perbaharui Data Pegawai</button>
                            <button class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div><!-- /.box-body -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#tanggal_lahir').datepicker({
            // format: 'yyyy-mm-dd'
            format: 'd M yyyy'
        });
    });

    function simpan_perubahan() {
        var formDataPegawai = new FormData($('#form_ubah_data_pegawai')[0]);

        $.ajax({
            url: "<?php echo site_url('Tunjangan/simpan_update_data_pegawai'); ?>",
            type: "post",
            data: formDataPegawai,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btn_ubah_pegawai').text('Menyimpan...');
                $('#btn_ubah_pegawai').attr('disabled', true);
            },
            success: function(res) {
                // alert(res);

                const resp = JSON.parse(res);
                $.alert({
                    type: (resp.status == 0) ? 'red' : 'green',
                    icon: (resp.status == 0) ? 'fa fa-warning' : 'fa fa-info',
                    title: (resp.status == 0) ? 'Warning' : 'Info',
                    content: resp.message
                })

                $('#btn_ubah_pegawai').text('Perbaharui Data Pegawai');
                $('#btn_ubah_pegawai').attr('disabled', false);
                get_view_pegawai();
                $('#modal_all').modal('hide');
            }
        });
    }
</script>