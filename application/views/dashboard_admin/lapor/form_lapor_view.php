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

    .disabled-element {
        pointer-events: none;
        background-color: #dbdbdb;
        cursor: no-drop;
    }
</style>

<script type="text/javascript">

</script>

<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table" style="padding: 10px;">
                <tbody>
                    <tr>
                        <td class="td-title">Nama Pegawai</td>
                        <td class="td-colon">:</td>
                        <td><?php echo $data_pegawai->nama_pegawai; ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">Lokasi Kerja</td>
                        <td class="td-colon">:</td>
                        <?php
                        if ($data_pegawai->id_pegawai == 0) {
                            $this->db->select('lokasi_kerja');
                            $lokasi = $this->db->get_where('tbl_master_lokasi_kerja', array('id_lokasi_kerja' => '52'))->row()->lokasi_kerja;
                        } else {
                            $lokasi = $data_pegawai->nama_lokasi_kerja;
                        }
                        ?>
                        <td><?php echo $lokasi; ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">Isi Laporan</td>
                        <td class="td-colon">:</td>
                        <td><?php echo $data_lapor->Isi_laporan; ?></td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            <h5><i class="flaticon-file-1"></i> File</h5>
                            <table class="table table-bordered table-hover" style='font-size:10px; width: 0px;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            $path_file = './asset/upload/Lapor/' . $data_lapor->File_upload;

                                            $ci = &get_instance();
                                            $ci->load->library('func_table');
                                            $file = $ci->func_table->get_file($path_file, "View File");

                                            echo $file;
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <h5>Ditujukan ke:</h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-title">Pegawai di Lokasi Kerja</td>
                        <td class="td-colon">:</td>
                        <td>
                            <?php
                            if ($data_lapor->info_lokasi == '') {
                                echo 'Semua Sub Lokasi Kerja';
                            } else {
                                $is_many = strpos($data_lapor->info_lokasi, ',');
                                foreach ($data_notif_lokasi as $item) {
                                    if ($is_many) {
                                        echo '- ' . $this->func_table->propercase_lokasi($item->lokasi_kerja) . '<br>';
                                    } else {
                                        echo $this->func_table->propercase_lokasi($item->lokasi_kerja) . '<br>';
                                    }
                                }
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="td-title">Pegawai di Sub Dinas</td>
                        <td class="td-colon">:</td>
                        <td>
                            <?php
                            if ($data_lapor->info_sublokasi == '') {
                                echo 'Semua Sub Dinas';
                            } else {
                                $is_many = strpos($data_lapor->info_sublokasi, ',');
                                foreach ($data_notif_sublokasi as $item) {
                                    if ($is_many) {
                                        echo '- ' . $this->func_table->propercase_lokasi($item->lokasi_kerja) . '<br>';
                                    } else {
                                        echo $this->func_table->propercase_lokasi($item->lokasi_kerja) . '<br>';
                                    }
                                }
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="td-title">Pegawai</td>
                        <td class="td-colon">:</td>
                        <td>
                            <?php
                            if ($data_lapor->info_pegawai == '') {
                                echo 'Semua Pegawai';
                            } else {
                                $is_many = strpos($data_lapor->info_pegawai, ',');
                                foreach ($data_notif_pegawai as $item) {
                                    if ($is_many) {
                                        echo '- ' . $this->func_table->propercase($item->nama_pegawai) . '<br>';
                                    } else {
                                        echo $this->func_table->propercase($item->nama_pegawai) . '<br>';
                                    }
                                }
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr>
            <div class="row pull-right" style="padding-right: 10px;">
                <!-- <button type="button" class="btn btn-sm btn-success btn-flat" onclick="simpan_lapor()" id="btn_tmb">Simpan Data Lapor</button> -->
                <button class="btn btn-sm btn-danger btn-flat" data-dismiss="modal" style="margin-left: 5px;">Tutup</button>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        // 
    });

    // === definisi select box as select2 ===
    // $('#lokasi').select2({
    //     placeholder: "Semua Lokasi Kerja"
    // });
    // $('#sublokasi').select2({
    //     placeholder: "Semua Sub Dinas"
    // });
    // $('#pegawai').select2({
    //     placeholder: "Semua Pegawai"
    // });

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
                            const sublokasi_post = '<?php echo $this->input->post('sublokasi') ?>';

                            let selected = '';
                            for (var i = 0; i < len; i++) {
                                if (sublokasi_post == response[i]['id_lokasi_kerja']) {
                                    selected = 'selected = selected';
                                } else {
                                    selected = '';
                                }

                                // === begin: propercase lokasi ===
                                let lokasi;
                                lokasi = properCase(response[i]['lokasi_kerja']);
                                lokasi = lokasi.replace(" Dan ", " dan ");
                                lokasi = lokasi.replace(" Dki ", " DKI ");
                                // === end: propercase lokasi ===

                                $("#sublokasi").append("<option value=" + response[i]['id_lokasi_kerja'] + " " + selected + ">" + lokasi + "</option>");
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

            // } else if (lokasi == '') {
            //     $('#sublokasi').find('option').remove().end();
            //     $('#sublokasi').append('<option value="">Semua Sub Lokasi Kerja</option>');
            //     $('#grp_sublokasi').hide();

        } else {
            $('#sublokasi').find('option').remove().end();
            $('#sublokasi').append('<option value="">-</option>');
            $('#grp_sublokasi').hide();

            $("#sublokasi").change();

        }

        get_pegawai();
    });
    $("#lokasi").change();

    // === change sublokasi ===
    $("#sublokasi").change(function() {
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

        get_pegawai();
    });

    // === get pegawai ===
    function get_pegawai() {
        // === begin: get string from array value on select option ===
        const selLokasi = $('#lokasi').val();
        const selSubLokasi = $('#sublokasi').val();

        // let txt = '';
        // let txtLokasi = '';
        // let txtSubLokasi = '';

        // function funcArray(item) {
        //     if (txt == '') {
        //         txt = item;
        //     } else {
        //         txt += ', ' + item;
        //     }
        // }
        // selLokasi.forEach(funcArray);
        // txtLokasi = txt;
        // txt = '';
        // selSubLokasi.forEach(funcArray);
        // txtSubLokasi = txt;
        // === end: get string from array value on select option ===

        $.ajax({
            url: '<?php echo base_url("admin/data_lapor/load_pegawai") ?>',
            dataType: 'json',
            type: 'post',
            data: {
                // lokasi: txtLokasi,
                // sublokasi: txtSubLokasi
                lokasi: selLokasi,
                sublokasi: selSubLokasi
            },
            success: function(response) {
                const len = response.length;
                // alert(len);
                if (len > 0) {
                    $('#pegawai').find('option').remove().end();
                    $('#pegawai').append('<option value="">Semua Pegawai</option>');

                    for (var i = 1; i < len; i++) {
                        // === begin: propercase pegawai ===
                        let pegawai;
                        pegawai = properCase(response[i]['nama_pegawai']);
                        // === end: propercase pegawai ===

                        $("#pegawai").append("<option value=" + response[i]['id_pegawai'] + ">" + pegawai + "</option>");
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