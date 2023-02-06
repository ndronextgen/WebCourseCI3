<style type="text/css">
    .modal-header {
        background-color: #1c8baf;
    }

    .modal-header .close {
        padding-top: 0px;
    }

    .modal-title {
        color: #fff !important;
    }
</style>

<div class="box-body">
    <form id="form_lapor" name="form_lapor" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-sm-4 kt-margin-b-20-tablet-and-mobile">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control input-sm" readonly name="nama_pegawai" id="nama_pegawai" value="<?php echo $this->func_table->propercase($data->nama_pegawai); ?>" style="background-color: #dbdbdb;">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8 kt-margin-b-20-tablet-and-mobile">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="form-group">
                                <label>Lokasi Kerja</label>
                                <?php
                                if ($data->id_pegawai == 0) {
                                    $this->db->select('lokasi_kerja');
                                    $lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('id_lokasi_kerja' => '52'))->row()->lokasi_kerja;
                                } else {
                                    $lokasi = $data->nama_lokasi_kerja;
                                }
                                ?>
                                <input type="text" class="form-control input-sm" readonly name="lokasi_kerja" id="lokasi_kerja" value="<?php echo $this->func_table->propercase_lokasi($lokasi); ?>" style="background-color: #dbdbdb;"></input>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 kt-margin-b-20-tablet-and-mobile">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="form-group">
                                <label>Isi Laporan</label>
                                <textarea class="form-control input-sm" name="isi_laporan" id="isi_laporan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 kt-margin-b-20-tablet-and-mobile">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="form-group">
                                <label>Upload File</label>
                                <input type="file" class="form-control input-sm" name="file_upload" id="file_upload" style="font-size: smaller; height: 39px;">
                                <label style="font-size: 10px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================= -->
                <!-- ========== BEGIN: TUJUAN NOTIF ========== -->
                <!-- ========================================= -->

                <hr>
                <div style="font-size: medium; font-weight: bold; padding-left: 20px; height: 25px; text-align: left;">Ditujukan ke :</div>

                <div class="row" style="margin-top: 20px;">

                    <div class="col-sm-12 kt-margin-b-20-tablet-and-mobile">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="form-group">
                                <label>Pegawai di Lokasi Kerja</label>
                                <select class="form-control bootstrap-select input-sm" id="lokasi" name="lokasi[]" multiple data-width="100%">
                                    <option value="">Semua Lokasi Kerja</option>
                                    <?php
                                    foreach ($arrLokasi as $key => $ars) {
                                        echo '<option value="' . $key . '" ' . $arrLokasiSelected[$key] . '>' . $this->func_table->propercase_lokasi($ars) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 kt-margin-b-20-tablet-and-mobile" id="grp_sublokasi">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="form-group">
                                <label>Pegawai di Sub Dinas</label>
                                <select class="form-control bootstrap-select input-sm" id="sublokasi" name="sublokasi[]" multiple data-width="100%">
                                    <option value="">Semua Sub Dinas</option>
                                </select>
                                <!-- <?php $sublok = ($this->input->post('sublokasi_id') != null) ? $this->input->post('sublokasi_id') : ''; ?> -->
                                <!-- <input type="hidden" id="sublokasi_id" name="sublokasi_id" value="<?= $sublok ?>"> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 kt-margin-b-20-tablet-and-mobile">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="form-group">
                                <label>Pegawai</label>
                                <select class="form-control bootstrap-select input-sm" id="pegawai" name="pegawai[]" multiple data-width="100%">
                                    <option value="">Semua Pegawai</option>
                                </select>
                                <!-- <?php $peg_id = ($this->input->post('pegawai_id') != null) ? $this->input->post('pegawai_id') : ''; ?> -->
                                <!-- <input type="hidden" id="pegawai_id" name="pegawai_id" value="<?= $peg_id ?>"> -->
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ======================================= -->
                <!-- ========== END: TUJUAN NOTIF ========== -->
                <!-- ======================================= -->

                <hr>
                <div class="row pull-right" style="padding-right: 10px;">
                    <button type="button" class="btn btn-sm btn-success btn-flat" onclick="simpan_lapor()" id="btn_tmb">Simpan</button>
                    <button class="btn btn-sm btn-danger btn-flat" data-dismiss="modal" style="margin-left: 5px;">Tutup</button>
                </div>

            </div>

        </div>

    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        get_pegawai();
    });

    // === definisi select box as select2 ===
    $('#lokasi').select2({
        placeholder: "Semua Lokasi Kerja"
    });
    $('#sublokasi').select2({
        placeholder: "Semua Sub Dinas"
    });
    $('#pegawai').select2({
        placeholder: "Semua Pegawai"
    });

    // === change lokasi ===
    $("#lokasi").change(function() {
        // let lokasi = $('#lokasi').find(":selected").val();

        // === begin: change array to string ===
        const selLokasi = $('#lokasi').val();
        let txtLokasi = '';

        function fLokasi(item) {
            if (txtLokasi == '') {
                txtLokasi = item;
            } else {
                txtLokasi += ', ' + item;
            }
        }
        selLokasi.forEach(fLokasi);
        // === end: change array to string ===

        dinas = txtLokasi.indexOf('52');

        if (dinas >= 0) {
            $.ajax({
                url: '<?php echo base_url("admin/laporan_advance/load_sub_dinas") ?>',
                dataType: 'json',
                type: 'post',
                success: function(response) {
                    if ($('#sublokasi').is(":visible")) {} else {

                        const len = response.length;
                        if (len > 0) {
                            $('#sublokasi').find('option').remove().end();
                            $('#sublokasi').append('<option value="">Semua Sub Dinas</option>');

                            for (var i = 0; i < len; i++) {
                                // === begin: propercase lokasi ===
                                let lokasi;
                                lokasi = properCase(response[i]['lokasi_kerja']);
                                lokasi = lokasi.replace(" Dan ", " dan ");
                                lokasi = lokasi.replace(" Dki ", " DKI ");
                                // === end: propercase lokasi ===

                                $("#sublokasi").append("<option value=" + response[i]['id_lokasi_kerja'] + ">" + lokasi + "</option>");
                            }

                            $('#grp_sublokasi').show();
                        }
                    }
                },
                error: function(x, e) {
                    // 
                }

            });
            $("#sublokasi").change();

        } else {
            $('#sublokasi').find('option').remove().end();
            $('#sublokasi').append('<option value="">-</option>');
            $('#grp_sublokasi').hide();

            $("#sublokasi").change();

        }

        // get_pegawai();
    }).change();

    // === change sublokasi ===
    $("#sublokasi").change(function() {
        if ($('#sublokasi').is(":visible")) {
            const selSubLokasi = $('#sublokasi').val();
            let txtSubLokasi = '';

            function fSubLokasi(item) {
                if (txtSubLokasi == '') {
                    txtSubLokasi = item;
                } else {
                    txtSubLokasi += ', ' + item;
                }
            }
            selSubLokasi.forEach(fSubLokasi);
            $("#sublokasi_id").val(txtSubLokasi);

            // get_pegawai();
        }
    });

    $('#lokasi').on('select2:close', function(e) {
        get_pegawai();
    });

    $('#sublokasi').on('select2:close', function(e) {
        get_pegawai();
    });

    // === get pegawai ===
    function get_pegawai() {
        const selLokasi = $('#lokasi').val();
        const selSubLokasi = $('#sublokasi').val();
        const selPegawai = $('#pegawai').val();

        $.ajax({
            url: '<?php echo base_url("admin/data_lapor/load_pegawai") ?>',
            dataType: 'json',
            type: 'post',
            data: {
                lokasi: selLokasi,
                sublokasi: selSubLokasi
            },
            success: function(response) {
                const len = response.length;

                if (len > 0) {
                    $('#pegawai').find('option').remove().end();
                    $('#pegawai').append('<option value="">Semua Pegawai</option>');

                    selected = '';
                    for (var i = 1; i < len; i++) {
                        for (var j = 0; j < selPegawai.length; j++) {
                            if (selPegawai[j] == response[i]['id_pegawai']) {
                                selected = 'selected = selected';
                                break;
                            } else {
                                selected = '';
                            }
                        }

                        let pegawai;
                        pegawai = properCase(response[i]['nama_pegawai']);

                        $("#pegawai").append("<option value=" + response[i]['id_pegawai'] + " " + selected + ">" + pegawai + "</option>");
                    }
                }
            },
            error: function(x, e) {
                // 
            }

        });
    }

    function properCase(str) {
        if (!str) {
            return "";
        } else {
            return str.replace(/\w\S*/g, function(txt) {
                txt = txt.charAt(0).toUpperCase() + txt.slice(1).toLowerCase();
                return txt;
            });
        }
    }
</script>