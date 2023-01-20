<?php $Date_now = date('Y-m-d'); ?>

<!-- <div class="box box-info"> -->
<!-- <div class="box-header"> -->
<div class="box-tools pull-right">
    <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
    <div id='loading'></div>
</div>
<!-- </div> -->

<div class="box-body">
    <form id="form_data_dp3" name="form_data_dp3" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="hr hr-18 hr-double dotted"></div>

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
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" value="<?php echo $Data_dp3->Periode_awal; ?>" id="Periode_awal" name="Periode_awal">
                            <div class="input-group-addon">S/D</div>
                            <input type="text" class="form-control" value="<?php echo $Data_dp3->Periode_akhir; ?>" id="Periode_akhir" name="Periode_akhir">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Pejabat Penilai</label>
                            <select data-placeholder="Pilih Pejabat Penilai" class="form-control select2" name="Pp" id="Pp" style="width:100%;" onchange="onChangePp()">
                                <option value=''>- Pilih Pejabat Penilai -</option>
                                <?php
                                if ($Data_dp3->Pp == 'X') {
                                    echo "<option value='X' selected>Lainnya</option>";
                                } else {
                                    echo "<option value='X'>Lainnya</option>";
                                }
                                ?>
                                <?php
                                foreach ($Data_list_pegawai as $d) {
                                    echo "<option value='$d->id_pegawai'";
                                    if ($d->id_pegawai == $Data_dp3->Pp) {
                                        echo ' selected';
                                    }
                                    echo ">$d->nama_pegawai</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-control input-sm" value="<?php echo $Data_dp3->Nama_pejabat_penilai; ?>" name="Npl" id="Npl">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Atasan Pejabat Penilai</label>
                            <select data-placeholder="Pilih Atasan Pejabat Penilai" class="form-control select2" name="Appn" id="Appn" style="width:100%;" onchange="onChangeAppn()">
                                <option value=''>- Pilih Atasan Pejabat Penilai -</option>
                                <?php
                                if ($Data_dp3->Appn == 'X') {
                                    echo "<option value='X' selected>Lainnya</option>";
                                } else {
                                    echo "<option value='X'>Lainnya</option>";
                                }
                                ?>
                                <?php
                                foreach ($Data_list_pegawai as $d) {
                                    echo "<option value='$d->id_pegawai'";
                                    if ($d->id_pegawai == $Data_dp3->Appn) {
                                        echo ' selected';
                                    }
                                    echo ">$d->nama_pegawai</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-control input-sm" value="<?php echo $Data_dp3->Nama_atasan_pejabat_penilai; ?>" name="Anpl" id="Anpl">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Kesetiaan</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Kesetiaan; ?>" name="Kesetiaan" id="Kesetiaan" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Prestasi Kerja</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Prestasi_kerja; ?>" name="Prestasi_kerja" id="Prestasi_kerja" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Tanggung Jawab</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Tanggung_jawab; ?>" name="Tanggung_jawab" id="Tanggung_jawab" maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Ketaatan</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Ketaatan; ?>" name="Ketaatan" id="Ketaatan" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Kejujuran</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Kejujuran; ?>" name="Kejujuran" id="Kejujuran" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Kerja Sama</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Kerja_sama; ?>" name="Kerja_sama" id="Kerja_sama" maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Prakarsa</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Prakarsa; ?>" name="Prakarsa" id="Prakarsa" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Kepemimpinan</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Kepemimpinan; ?>" name="Kepemimpinan" id="Kepemimpinan" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Jumlah; ?>" name="Jumlah" id="Jumlah" maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Nilai Rata-rata</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_dp3->Nilai_rata_rata; ?>" name="Nilai_rata_rata" id="Nilai_rata_rata" maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group"><label>File Lama</label>
                            <table class="table table-bordered table-hover" style='font-size:10px; width: 0px;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            $path_file = 'asset/upload/SKP/SKP_' . $Data_dp3->id_dp3 . '_' . $Data_dp3->id_arsip_skp . '/' . $Data_dp3->file_name;

                                            $ci = &get_instance();
                                            $ci->load->library('func_table');
                                            $file = $ci->func_table->get_file($path_file, $Data_dp3->file_name_ori);
                                            
                                            echo $file;
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-10">
                        <div class="form-group">
                            <label>Upload File</label>
                            <input type="file" class="form-control input-sm" name="File_upload" id="File_upload">
                            <label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- <div class="col-xs-8">
                    <div class="form-group">
                        <input type='hidden' value='<?php echo $Data_dp3->file_name; ?>' name='File_upload_lama' Id='File_upload_lama'>
                        <input type='hidden' value='<?php echo $Id; ?>' name='Id' Id='Id'>
                        <button id='btn_tmb' type='button' onclick="simpan_data_dp3()" class='btn btn-block btn-success'>Simpan</button>
                        <div id='loading'></div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <div id='loading'></div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row pull-right" style="padding-right: 20px;">
                            <input type='hidden' value='<?php echo $Data_dp3->file_name; ?>' name='File_upload_lama' Id='File_upload_lama'>
                            <input type='hidden' value='<?php echo $Id; ?>' name='Id' Id='Id'>
                            <button class="btn btn-sm btn-success" onclick="simpan_data_dp3()" id="btn_tmb">Simpan Riwayat DP3</button>
                            <button class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>

            </div>



        </div>

    </form>
</div><!-- /.box-body -->

</div>

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

        var Pp = document.getElementById("Pp").value;
        if (Pp == 'X') {
            document.getElementById('Npl').type = 'text';
        } else {
            document.getElementById('Npl').type = 'hidden';
        }

        var Appn = document.getElementById("Appn").value;
        if (Appn == 'X') {
            document.getElementById('Anpl').type = 'text';
        } else {
            document.getElementById('Anpl').type = 'hidden';
        }
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
        $("#Kesetiaan").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Prestasi_kerja").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Tanggung_jawab").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Ketaatan").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Kejujuran").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Kerja_sama").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Prakarsa").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Kepemimpinan").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Jumlah").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("#Nilai_rata_rata").keypress(function(e) {
            if (e.which != 8 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        // === end: numeric input only ===
    })
</script>