<!-- MAIN CONTENT -->
<div id='ajax_table'></div>

<script type="text/javascript">
    notify_lapor()

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

    function load_data() {
        var urls = "<?php echo site_url('Lapor/data_lapor'); ?>";

        $.ajax({
            type: "POST",
            url: urls,
            beforeSend: function(b) {
                var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
                $('#ajax_table').html(percentVal);
            },
            success: function(s) {
                $('#ajax_table').html(s);
            }
        });
    }
    load_data();

    function notify_lapor() {
        $.ajax({
            url: "<?php echo site_url('lapor/notify_lapor') ?>",
            type: "POST",
            beforeSend: function(f) {
                var loading = '';
                $('span#notify_lapor').html(loading);
            },
            success: function(s) {
                var obj = JSON.parse(s);
                $('span#notify_lapor').html(obj.notify_lapor);
            }
        });
    }

    function reload_table() {
        tableLapor.ajax.reload(null, false); //reload datatable ajax 
        notify_lapor();
    }

    function add_lapor() {
        save_method = 'add';
        $.ajax({
            url: "<?php echo site_url('Lapor/form_lapor_add'); ?>",
            data: "act=" + 'Tambah',
            type: "POST",
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('.modal-footer').hide(); // show bootstrap modal
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Form Tambah Data Lapor Pegawai'); // Set Title to Bootstrap modal title
    }

    function simpan_lapor() {

        var Kategori = $("#Kategori").val();
        var Isi_laporan = $("#Isi_laporan").val();
        var File_upload = $("#File_upload").val();
        var File_upload_lama = $("#File_upload_lama").val();

        if (save_method == 'add') {

            if (Kategori == '') {
                // alert('Kategori Tidak Boleh Kosong');
                $.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Kategori tidak boleh kosong.',
                    type: 'red',
                    backgroundDismiss: true
                });
            } else if (Isi_laporan == '') {
                // alert('Isi Laporan Tidak Boleh Kosong');
                $.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Isi lapor tidak boleh kosong.',
                    type: 'red',
                    backgroundDismiss: true
                });
            } else if (Kategori == 'Terkait Data' && File_upload == '') {
                // alert('Kategori Terkait Data, File Tidak Boleh Kosong');
                $.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Kategori terkait data, file tidak boleh kosong.',
                    type: 'red',
                    backgroundDismiss: true
                });
            } else {
                ajax_simpan_lapor();
            }

        } else {

            if (Kategori == '') {
                // alert('Kategori Tidak Boleh Kosong');
                $.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Kategori tidak boleh kosong.',
                    type: 'red',
                    backgroundDismiss: true
                });
            } else if (Isi_laporan == '') {
                // alert('Isi Laporan Tidak Boleh Kosong');
                $.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Isi lapor tidak boleh kosong.',
                    type: 'red',
                    backgroundDismiss: true
                });
            } else if (Kategori == 'Terkait Data' && File_upload == '' && File_upload_lama == '') {
                // alert('Kategori Terkait Data, File Tidak Boleh Kosong');
                $.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Kategori terkait data, file tidak boleh kosong.',
                    type: 'red',
                    backgroundDismiss: true
                });
            } else {
                ajax_simpan_lapor();
            }
        }
    }

    function ajax_simpan_lapor() {
        var formData = new FormData($('#form_lapor')[0]);
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('Lapor/simpan_add'); ?>";
        } else {
            url = "<?php echo site_url('Lapor/simpan_update'); ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btn_tmb').text('Menyimpan...');
                $('#btn_tmb').prop('disabled', true);
            },
            success: function(response) {
                $('#modal_all').modal('hide');
                // alert(response);
                // reload_table();

                const resp = JSON.parse(response);

                $.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: resp.status,
                    type: resp.tipe == 1 ? 'green' : 'red',
                    backgroundDismiss: true
                });
                $('#btn_tmb').text('Simpan');
                $('#btn_tmb').attr('disabled', false);
                reload_table();
            }
        });
    }

    function view_lapor() {
        // alert('uder maintenance !!!');
        $.dialog({
            icon: 'fa fa-info',
            title: 'Info',
            content: 'Sedang dalam pengerjaan...',
            type: 'red',
            backgroundDismiss: true
        });
    }

    function delete_lapor(Id) {
        var i = "Hapus data lapor?";
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
                            data: "Id=" + Id,
                            url: "<?php echo site_url('Lapor/delete_lapor') ?>",
                            success: function(s) {
                                $.dialog({
                                    icon: 'fa fa-info',
                                    title: 'Info',
                                    content: b,
                                    type: 'green',
                                    backgroundDismiss: true
                                });

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

    function gettanggapan(Id) {
        $.ajax({
            type: "post",
            data: {
                Id
            },
            url: "<?php echo site_url('Lapor/modal_tanggapan'); ?>",
            beforeSend: function(s) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
            },
            success: function(data) {
                $('#modal_all .modal-dialog').addClass('modalan');
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $("#modal_all .modal-title").text("Buat Tanggapan");
        $("#modal_all .modal-footer").addClass("hidden");
        $('.modal-footer').hide(); // show bootstrap modal
        $('#modal_all').modal('show'); // show bootstrap modal
        $('#modal_all').modal({
            backdrop: false,
            keyboard: true
        });
    }
</script>

<!-- ======================================================= -->
<!-- ==================== BEGIN: MODALS ==================== -->
<!-- ======================================================= -->

<!-- Modal kabeh -->
<div class="modal fade" id="modal_all" data-backdrop='static' tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-family: 'Source Sans Pro', sans-serif;">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onClick="simpan_modal()">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal kabeh -->
<div class="modal fade" id="modal_all_md" data-backdrop='static' tabindex="-1">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-family: 'Source Sans Pro', sans-serif;">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- ==================== END: MODALS ==================== -->
<!-- ===================================================== -->