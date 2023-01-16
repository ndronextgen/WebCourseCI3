<!-- Main content -->
<div id='ajax_table'></div>

<script type="text/javascript">
    notify_me();
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
        var urls = "<?php echo site_url('Verifikasi/data_verifikasi'); ?>";

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

    function reload_table() {
        tableVerifikasi.ajax.reload(null, false); //reload datatable ajax 
        notify_me();
    }

    function verifikasi_kep(Id) {
        save_method = 'verifikasi_kep';
        $.ajax({
            url: "<?php echo site_url('Verifikasi/form_verifikasi_kep'); ?>",
            data: {
                Id: Id
            },
            type: "POST",
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('.modal-footer').hide(); // show bootstrap modal
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Form Verifikasi Surat Pegawai'); // Set Title to Bootstrap modal title
    }

    function simpan_verifikasi() {

        var status_verify = $("#status_verify").val();

        if (status_verify == '') {
            alert('Tentukan Velrifikasi...!');
        } else {
            ajax_simpan_verifikasi();
        }
    }

    function ajax_simpan_verifikasi() {
        var formData = new FormData($('#form_verifikasi_kep')[0]);
        var url;
        if (save_method == 'verifikasi_kep') {
            url = "<?php echo site_url('Verifikasi/simpan_verifikasi_kep'); ?>";
        } else {
            url = "<?php echo site_url('Verifikasi/simpan_verifikasi_kep'); ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            before: function() {
                $('btn_tmb').attr('disabled', true);
            },
            success: function(response) {
                $('#modal_all').modal('hide');
                // alert(response);
                // reload_table();

                const result = JSON.parse(response);
                $.confirm({
                    icon: (result.status == true) ? 'fa fa-info' : 'fa fa-warning',
                    title: (result.status == true) ? 'Info' : 'Gagal',
                    content: result.message,
                    type: (result.status == true) ? 'green' : 'red',
                    buttons: {
                        ok: {
                            text: 'OK',
                            btnClass: (result.status == true) ? 'btn-green' : 'btn-red',
                            action: function() {
                                $('btn-tmb').attr('disabled', false);
                                reload_table();
                            }
                        }
                    }
                })

                reload_table();
            }
        });
    }

    function view_detail(Id) {
        $.ajax({
            url: "<?php echo site_url('Verifikasi/form_detail'); ?>",
            data: {
                Id: Id
            },
            type: "POST",
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('.modal-footer').hide(); // show bootstrap modal
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Form Detail Surat Pegawai'); // Set Title to Bootstrap modal title
    }

    function notify_me() {
        $.ajax({
            url: "<?php echo site_url('Verifikasi/notify_me') ?>",
            type: "POST",
            beforeSend: function(f) {
                var loading = '';
                $('span#notif_count_verifikasi').html(loading);
                $('span#ttl_verifikasi').html(loading);
            },
            success: function(s) {
                var obj = JSON.parse(s);
                $('span#notif_count_verifikasi').html(obj.verifikasi_keterangan);
                $('span#ttl_verifikasi').html(obj.total_verifikasi);
            }
        });
    }

    function tutup_form_detail() {
        $('#modal_all').modal('hide');
    }

    // begin: progress timeline joe 2023.01.02
    function showTimeline(id_srt) {
        $.ajax({
            url: "<?php echo site_url('verifikasi/show_timeline'); ?>",
            type: "POST",
            data: {
                id_srt: id_srt
            },
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('.modal-footer').hide(); // show bootstrap modal
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Perjalanan Pengajuan Surat Keterangan Pegawai'); // Set Title to Bootstrap modal title
    }

    function tutup_form() {
        $('#modal_all').modal('hide');
    }
    // end: progress timeline joe 2023.01.02
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