<!-- Main content -->
<div id='ajax_table'></div>

<script type="text/javascript">
    notify_verifikasi_kaku();

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
        var urls = "<?php echo site_url('Verifikasi_kariskarsu/data_verifikasi_kariskarsu'); ?>";

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
        notify_verifikasi_kaku();
    }

    function verifikasi_kariskarsu_kep(Kariskarsu_id) {
        save_method = 'verifikasi_kariskarsu_kep';
        $.ajax({
            url: "<?php echo site_url('Verifikasi_kariskarsu/form_verifikasi_kariskarsu_kep'); ?>",
            data: {
                Kariskarsu_id: Kariskarsu_id
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

    function simpan_verifikasi_kariskarsu() {

        var status_verify = $("#status_verify").val();

        if (status_verify == '') {
            alert('Tentukan Verifikasi...!');
        } else {
            ajax_simpan_verifikasi_kariskarsu();
        }
    }

    function ajax_simpan_verifikasi_kariskarsu() {
        var formData = new FormData($('#form_verifikasi_kariskarsu_kep')[0]);
        var url;
        if (save_method == 'verifikasi_kariskarsu_kep') {
            url = "<?php echo site_url('Verifikasi_kariskarsu/simpan_verifikasi_kariskarsu_kep'); ?>";
        } else {
            url = "<?php echo site_url('Verifikasi_kariskarsu/simpan_verifikasi_kariskarsu_kep'); ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btn_verifikasi').text('Menyimpan...');
                $('#btn_verifikasi').attr('disabled', true);
            },
            success: function(response) {
                // $('#modal_all').modal('hide');
                // alert(response);
                // reload_table();

                let arrPesan = response.split("|");

                if (arrPesan.length > 1) {
                    $.confirm({
                        icon: 'fa fa-info',
                        title: 'Info',
                        content: arrPesan[1],
                        type: (arrPesan[0] == '0') ? 'red' : 'green',
                        buttons: {
                            ok: {
                                text: 'OK',
                                // btnClass: 'btn-green',
                                action: function() {
                                    $('#modal_all').modal('hide');
                                    //alert(response);
                                    reload_table();
                                }
                            }
                        }
                    })
                }
                $('#btn_verifikasi').text('Simpan');
                $('#btn_verifikasi').attr('disabled', false);
            }
        });
    }

    function view_detail(Kariskarsu_id) {
        $.ajax({
            url: "<?php echo site_url('Verifikasi_kariskarsu/form_detail'); ?>",
            data: {
                Kariskarsu_id: Kariskarsu_id
            },
            type: "POST",
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('.modal-footer').hide(); // show bootstrap modal
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Form Detail Verifikasi Surat Permohonan KARIS/KARSU'); // Set Title to Bootstrap modal title
    }

    function notify_verifikasi_kaku() {
        $.ajax({
            url: "<?php echo site_url('Verifikasi_kariskarsu/notify_verifikasi_kariskarsu') ?>",
            type: "POST",
            beforeSend: function(f) {
                var loading = '';
                $('span#notif_count_verifikasi_kaku').html(loading);
                $('span#ttl_verifikasi').html(loading);
            },
            success: function(s) {
                //console.log(s);
                var obj = JSON.parse(s);
                $('span#notif_count_verifikasi_kaku').html(obj.verifikasi_kariskarsu);
                $('span#ttl_verifikasi').html(obj.total_verifikasi);
            }
        });
    }

    function tutup_form_detail() {
        $('#modal_all').modal('hide');
    }

    // === begin: progress timeline ===
    function showTimeline(id) {
        $.ajax({
            url: "<?php echo site_url('verifikasi_kariskarsu/show_timeline'); ?>",
            type: "post",
            data: {
                kariskarsu_id: id
            },
            success: function(data) {
                $('#modal_timeline .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('#modal_timeline').modal('show'); // show bootstrap modal
        $('.modal-title').text('Perjalanan Pengajuan Surat Permohonan KARIS/KARSU'); // Set Title to Bootstrap modal title
    }

    function tutup_form() {
        $('#modal_timeline').modal('hide');
    }
    // === end: progress timeline ===
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
<div class="modal fade" id="modal_all_md" data-backdrop='static' data-keyboard='false'>
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

<!-- modal timeline -->
<div class="modal fade" id="modal_timeline" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h4 class="modal-title" style="font-family: Source Sans Pro, sans-serif;">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
            <!-- <div class="modal-footer" hidden="true">
				<button type="button" class="btn btn-success btn-flat btn-sm" onClick="simpan()">
					<span class="fa fa-ok" aria-hidden="true"></span> Simpan
				</button>
			</div> -->
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- ==================== END: MODALS ==================== -->
<!-- ===================================================== -->