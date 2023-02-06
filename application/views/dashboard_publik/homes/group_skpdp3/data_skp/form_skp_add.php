<style type="text/css">
    .error {
        border: solid 2px #FF0000;
    }
</style>

<?php $Date_now = date('Y-m-d'); ?>

<!-- <div class="box box-info"> -->
<!-- <div class="box-header"> -->
<div class="box-tools pull-right">
    <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
    <div id='loading'></div>
</div>
<!-- </div> -->

<div class="box-body">
    <form id="form_data_skp" name="form_data_skp" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="hr hr-18 hr-double dotted"></div> -->

                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="NamaPegawai" class="form-control input-sm avoid-clicks" name="NamaPegawai" id="NamaPegawai" value="<?php echo $Data->nama_pegawai; ?>">

                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="NIP" id="NIP" value="<?php echo $Data->nip; ?>">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Lokasi Kerja</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="Lokasi" id="Lokasi" value="<?php echo $Data->nama_lokasi_kerja; ?>">
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-xs-4">
                        <label>Periode</label>
                        <!-- <div class="form-group">
                                    <label>Periode</label>
                                    <input type="text" class="form-control input-sm datepicker" name="Periode" id="Periode" value="">
                                </div> -->
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" value="<?php echo $Date_now; ?>" id="Periode_awal" name="Periode_awal">
                            <div class="input-group-addon">S/D</div>
                            <input type="text" class="form-control" value="<?php echo $Date_now; ?>" id="Periode_akhir" name="Periode_akhir">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Pejabat Penilai</label>
                            <select data-placeholder="Pilih Pejabat Penilai" class="form-control select2" name="Pp" id="Pp" style="width:100%;" onchange="onChangePp()">
                                <option value=''>- Pilih Pejabat Penilai -</option>
                                <option value='X'>Lainnya</option>
                                <?php
                                foreach ($Data_list_pegawai as $d) {
                                    echo "<option value='$d->id_pegawai'";
                                    echo ">$d->nama_pegawai</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-control input-sm" value="" name="Npl" id="Npl">
                        </div>

                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Atasan Pejabat Penilai</label>
                            <select data-placeholder="Pilih Atasan Pejabat Penilai" class="form-control select2" name="Appn" id="Appn" style="width:100%;" onchange="onChangeAppn()">
                                <option value=''>- Pilih Atasan Pejabat Penilai -</option>
                                <option value='X'>Lainnya</option>
                                <?php
                                foreach ($Data_list_pegawai as $d) {
                                    echo "<option value='$d->id_pegawai'";
                                    echo ">$d->nama_pegawai</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-control input-sm" value="" name="Anpl" id="Anpl">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Orientasi Pelayanan</label>
                            <input type="text" class="form-control input-sm" name="Orientasi_pelayanan" id="Orientasi_pelayanan" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Integritas</label>
                            <input type="text" class="form-control input-sm" name="Integritas" id="Integritas" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Inisiatif Kerja</label>
                            <input type="text" class="form-control input-sm" name="Inisiatif_kerja" id="Inisiatif_kerja" placeholder="Jika tidak ada kosongkan saja." maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Komitmen</label>
                            <input type="text" class="form-control input-sm" name="Komitmen" id="Komitmen" maxlength="6">
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Disiplin</label>
                            <input type="text" class="form-control input-sm" name="Disiplin" id="Disiplin" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Kerja Sama</label>
                            <input type="text" class="form-control input-sm" name="Kerjasama" id="Kerjasama" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Kepemimpinan</label>
                            <input type="text" class="form-control input-sm" name="Kepemimpinan" id="Kepemimpinan" maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Nilai Prestasi Kerja</label>
                            <input type="text" class="form-control input-sm" name="Nilai_prestasi_kerja" id="Nilai_prestasi_kerja" maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Upload File</label>
                            <input type="file" class="form-control input-sm" name="File_upload" id="File_upload">
                            <label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- <div class="row">
                    <div class="col-xs-8">
                        <div class="form-group">
                            <button id='btn_tmb' type='button' onclick="simpan_data_skp()" class='btn btn-block btn-success'>Simpan</button>
                            <div id='loading'></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <div id='loading'></div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row pull-right" style="padding-right: 20px;">
                            <button class="btn btn-sm btn-success" onclick="simpan_data_skp()" id="btn_tmb">Simpan Riwayat SKP</button>
                            <button class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </form>
</div><!-- /.box-body -->

<!-- </div> -->

<script type="text/javascript">
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#Periode_awal').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#Periode_akhir').datepicker({
            format: 'yyyy-mm-dd'
        });
    });

    function onChangePp() {
        var Pp = document.getElementById("Pp").value;
        if (Pp == 'X') {
            document.getElementById('Npl').type = 'text';
        } else {
            document.getElementById('Npl').type = 'hidden';
        }
    }

    function onChangeAppn() {
        var Appn = document.getElementById("Appn").value;
        if (Appn == 'X') {
            document.getElementById('Anpl').type = 'text';
        } else {
            document.getElementById('Anpl').type = 'hidden';
        }
    }

    $(function() {
        // === begin: numeric input only ===
        $("#Orientasi_pelayanan").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Integritas").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Inisiatif_kerja").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Komitmen").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Disiplin").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Kerjasama").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Kepemimpinan").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Nilai_prestasi_kerja").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        // === end: numeric input only === 
    })

    // $('#Orientasi_pelayanan').blur(function() {
    //     if ($.isNumeric($('#Orientasi_pelayanan').val())) {
    //         if ($('#Orientasi_pelayanan').val() > 100) {
    //             alert('Nilai tidak bisa lebih dari 100');
    //             $('#Orientasi_pelayanan').addClass("error");
    //         } else {
    //             $('#Orientasi_pelayanan').removeClass("error");
    //         }
    //     } else {
    //         alert('Silahkan input angka.');
    //         $('#Orientasi_pelayanan').addClass("error");
    //     }
    // });
</script>