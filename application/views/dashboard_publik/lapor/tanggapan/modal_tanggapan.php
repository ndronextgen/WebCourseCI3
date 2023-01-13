<!-- jquery-confirm -->
<link rel="stylesheet" href="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.css'); ?>">
<script src="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.js'); ?>"></script>

<div class="box-body">
    <span>
        <small class="badge" style="font-size: 12px;padding: 5px;color:#fff;background: #32a6a8;">Nama Lengkap : <?php echo $Data->nama_pegawai; ?></small>
        <small class="badge" style="font-size: 12px;padding: 5px;color:#fff;background: #bd74fc;">NIP : <?php echo $Data->nip; ?></small>
        <small class="badge" style="font-size: 12px;padding: 5px;color:#fff;background: #e0b438;">Judul Lapor : <?php echo $Data_lapor->Isi_laporan; ?></small>

    </span>
    <div id="table_tanggapan"></div>
</div>
<br>
<!-- Info box -->
<div class="box">
    <div class="box-header">
        <div class="box-tools pull-right">
            <div class="label bg-aqua">Form Input Tanggapan</div>
        </div>
    </div>
    <div class="box-body">
        <form id="form_tanggapan">
            <input type="hidden" name="Id" id="Id" value="<?php echo $Id; ?>">
            <?php $Date_now = date('Y-m-d'); ?>
            <table class="table table-borderless">

                <tr>
                    <td width="150px">Tanggapan *</td>
                    <td width="1px">:</td>
                    <td>
                        <textarea rows="2" class='form-control input-sm' name='Tanggapan' id='Tanggapan' style=' border: 1px solid #32a6a8;'></textarea>
                    </td>
                </tr>
            </table>
        </form>

    </div><!-- /.box-body -->
    <div class="box-footer">
        <button class="btn btn-sm btn-info btn-flat" onclick="simpan_tanggapan()" id="btn_simpan">Simpan Tanggapan</button>
    </div><!-- /.box-footer-->
</div><!-- /.box -->

<script type="text/javascript">
    $('#Tanggal').datepicker({
        format: 'yyyy-mm-dd'
    });

    function table_tanggapan() {
        $.ajax({
            type: "post",
            data: {
                Id: "<?php echo $Id; ?>",
            },
            url: "<?php echo site_url('Lapor/table_tanggapan'); ?>",
            beforeSend: function(s) {
                $("#table_tanggapan").html('Memuat tanggapan...');
            },
            success: function(data) {
                reload_table();
                $('#table_tanggapan').html(data);
            }
        });
    }
    table_tanggapan();


    function simpan_tanggapan() {
        var Tanggapan = $("#Tanggapan").val();
        if (Tanggapan == "") {
            // alert("Tanggapan Tidak Boleh Kosong!");
            $.dialog({
                title: 'Info',
                content: 'Tanggapan tidak boleh kosong.',
                type: 'red',
                backgroundDismiss: true
            });
        } else {
            ajax_simpan();
        }
    }

    function ajax_simpan() {
        $.ajax({
            type: "POST",
            data: $("#form_tanggapan").serialize(),
            url: "<?php echo site_url('Lapor/simpan_tanggapan'); ?>",
            beforeSend: function(s) {
                $("#btn_simpan").text('Menyimpan...');
            },
            success: function(data) {
                // alert('Tanggapan tersimpan!');
                $("#form_tanggapan")[0].reset();
                $("#btn_simpan").text('Simpan Tanggapan');
                $("#Id").val("<?php echo $Id; ?>");
                $("#btn_batall").addClass("hidden");
                // table_tanggapan();
                // reload_table()

                $.dialog({
                    title: 'Info',
                    content: 'Tanggapan berhasil disimpan.',
                    type: 'green',
                    backgroundDismiss: true
                });
                table_tanggapan();
                reload_table()
            }
        });
    }

    function edit_tanggapan(Id) {
        $.ajax({
            type: "post",
            dataType: "JSON",
            data: {
                Id: Id,
            },
            url: "<?php echo site_url('Lapor/edit_tanggapan'); ?>",
            success: function(data) {
                $("#Id").val(data.Id);
                $("#Tanggapan").val(data.Tanggapan);

                $("#btn_simpan").text('Ubah Tanggapan');
                $("#btn_simpan").attr("onclick", "update_tanggapan()");
                document.getElementById("btn_simpan").disabled = false;
                $("#btn_batall").removeClass("hidden");
            }
        });

    }

    function update_tanggapan() {
        var Tanggal = $("#Tanggal").val();
        var Jam = $("#Jam").val();
        var Tanggapan = $("#Tanggapan").val();
        if (Tanggapan == "") {
            // alert("Tanggapan Tidak Boleh Kosong!");
            $.dialog({
                title: 'Info',
                content: 'Tanggapan tidak boleh kosong.',
                type: 'red',
                backgroundDismiss: true
            });
        } else {
            ajax_update();
        }
    }

    function ajax_update() {
        $.ajax({
            type: "post",
            data: $("#form_tanggapan").serialize(),
            url: "<?php echo site_url('Lapor/update_tanggapan'); ?>",
            beforeSend: function(s) {
                $("#btn_simpan").text('Menyimpan...');
            },
            success: function(data) {
                // alert('Tanggapan terupdate!');
                $("#form_tanggapan")[0].reset();
                $("#btn_simpan").text('Simpan Tanggapan');
                $("#btn_simpan").attr("onclick", "simpan_tanggapan()");
                document.getElementById("btn_simpan").disabled = false;
                $("#Id").val("<?php echo $Id; ?>");
                $("#btn_batall").addClass("hidden");
                // table_tanggapan();
                // reload_table()

                $.dialog({
                    title: 'Info',
                    content: 'Tanggapan berhasil diupdate.',
                    type: 'green',
                    backgroundDismiss: true
                });
                table_tanggapan();
                reload_table()
            }
        });
    }

    function batall() {
        $("#form_tanggapan")[0].reset();
        $("#btn_simpan").text('Simpan Tanggapan');
        $("#btn_simpan").attr("onclick", "simpan_tanggapan()");
        $("#Id").val("<?php echo $Id; ?>");
        $("#btn_batall").addClass("hidden");
    }

    function hapus_tanggapan(Id) {
        // if (confirm("Hapus Tanggapan?")) {
        //     $.ajax({
        //         type: "post",
        //         data: {
        //             Id: Id,
        //         },
        //         url: "<?php echo site_url('Lapor/hapus_tanggapan'); ?>",
        //         success: function(data) {
        //             table_tanggapan();
        //             reload_table()
        //         }
        //     });
        // }

        var i = "Hapus tanggapan?";
        var b = "Data berhasil dihapus";

        $.confirm({
            icon: 'fa fa-warning',
            title: 'Konfirmasi',
            content: i,
            type: 'red',
            buttons: {
                yes: {
                    text: 'Ya',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            type: "post",
                            data: {
                                Id: Id,
                            },
                            url: "<?php echo site_url('Lapor/hapus_tanggapan'); ?>",
                            success: function(s) {
                                $.dialog({
                                    title: 'Info',
                                    content: b,
                                    type: 'green',
                                    backgroundDismiss: true
                                });

                                table_tanggapan();
                                reload_table();
                            }
                        });
                    }
                },
                no: {
                    text: 'Tidak'
                }
            }
        })
    }
</script>