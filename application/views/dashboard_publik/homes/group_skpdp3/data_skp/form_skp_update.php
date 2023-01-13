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
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" value="<?php echo $Data_skp->Periode_awal; ?>" id="Periode_awal" name="Periode_awal">
                            <div class="input-group-addon">S/D</div>
                            <input type="text" class="form-control" value="<?php echo $Data_skp->Periode_akhir; ?>" id="Periode_akhir" name="Periode_akhir">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Pejabat Penilai</label>
                            <select data-placeholder="Pilih Pejabat Penilai" class="form-control select2" name="Pp" id="Pp" style="width:100%;" onchange="onChangePp()">
                                <option value=''>- Pilih Pejabat Penilai -</option>
                                <?php
                                if ($Data_skp->Pp == 'X') {
                                    echo "<option value='X' selected>Lainnya</option>";
                                } else {
                                    echo "<option value='X'>Lainnya</option>";
                                }
                                ?>
                                <?php
                                foreach ($Data_list_pegawai as $d) {
                                    echo "<option value='$d->id_pegawai'";
                                    if ($d->id_pegawai == $Data_skp->Pp) {
                                        echo ' selected';
                                    }
                                    echo ">$d->nama_pegawai</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-control input-sm" value="<?php echo $Data_skp->Nama_pejabat_penilai; ?>" name="Npl" id="Npl">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Atasan Pejabat Penilai</label>
                            <select data-placeholder="Pilih Atasan Pejabat Penilai" class="form-control select2" name="Appn" id="Appn" style="width:100%;" onchange="onChangeAppn()">
                                <option value=''>- Pilih Atasan Pejabat Penilai -</option>
                                <?php
                                if ($Data_skp->Appn == 'X') {
                                    echo "<option value='X' selected>Lainnya</option>";
                                } else {
                                    echo "<option value='X'>Lainnya</option>";
                                }
                                ?>
                                <?php
                                foreach ($Data_list_pegawai as $d) {
                                    echo "<option value='$d->id_pegawai'";
                                    if ($d->id_pegawai == $Data_skp->Appn) {
                                        echo ' selected';
                                    }
                                    echo ">$d->nama_pegawai</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-control input-sm" value="<?php echo $Data_skp->Nama_atasan_pejabat_penilai; ?>" name="Anpl" id="Anpl">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Orientasi Pelayanan</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Orientasi_pelayanan; ?>" name="Orientasi_pelayanan" id="Orientasi_pelayanan" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Integritas</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Integritas; ?>" name="Integritas" id="Integritas" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Inisiatif Kerja</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Inisiatif_kerja; ?>" name="Inisiatif_kerja" id="Inisiatif_kerja" placeholder="Jika tidak ada kosongkan saja." maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Komitmen</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Komitmen; ?>" name="Komitmen" id="Komitmen" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Disiplin</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Disiplin; ?>" name="Disiplin" id="Disiplin" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Kerja Sama</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Kerjasama; ?>" name="Kerjasama" id="Kerjasama" maxlength="6">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Kepemimpinan</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Kepemimpinan; ?>" name="Kepemimpinan" id="Kepemimpinan" maxlength="6">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Nilai Prestasi Kerja</label>
                            <input type="text" class="form-control input-sm" value="<?php echo $Data_skp->Nilai_prestasi_kerja; ?>" name="Nilai_prestasi_kerja" id="Nilai_prestasi_kerja" maxlength="6">
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
                                            $path_file = 'asset/upload/SKP/SKP_' . $Data_skp->id_dp3 . '_' . $Data_skp->id_arsip_skp . '/' . $Data_skp->file_name;

                                            $ci = &get_instance();
                                            $ci->load->library('func_table');
                                            $file = $ci->func_table->get_file($path_file, $Data_skp->file_name_ori);
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

                <div class="col-xs-8">
                    <div class="form-group">
                        <!-- <label></label> -->
                        <input type='hidden' value='<?php echo $Data_skp->file_name; ?>' name='File_upload_lama' Id='File_upload_lama'>
                        <input type='hidden' value='<?php echo $Id; ?>' name='Id' Id='Id'>
                        <button id='btn_tmb' type='button' onclick="simpan_data_skp()" class='btn btn-block btn-success'>Simpan</button>
                        <div id='loading'></div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <!-- <label></label> -->
                        <div id='loading'></div>
                    </div>
                </div>
            </div>


        </div>

    </form>
</div>
</div>

<script>
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
</script>