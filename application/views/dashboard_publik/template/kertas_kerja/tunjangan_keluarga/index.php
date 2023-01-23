<div class="callout callout-info">
    <h4>Surat Permohonan Tunjangan Keluarga</h4>
    <p>Fasilitas untuk mengajukan Surat Permohonan Tunjangan Keluarga</p>
</div>

<!-- Main content -->
<div id='ajax_table_data'></div>
<div id='ajax_table_tmb'></div>
<div id='loading'></div>

<script type="text/javascript">
    notify_tj();

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
        var urls = "<?php echo site_url('Tunjangan/data_tunjangan'); ?>";
        $.ajax({
            type: "POST",
            url: urls,
            beforeSend: function(b) {
                var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
                $('#loading').html(percentVal);
                $('#ajax_table_data').html("");
            },
            success: function(s) {
                $('#ajax_table_data').html(s);
                $('#loading').html('');
            }
        });
    }
    load_data();

    function notify_tj() {
        $.ajax({
            url: "<?php echo site_url('Tunjangan/notify_tj') ?>",
            type: "POST",
            beforeSend: function(f) {
                var loading = '';
                $('span#notif_count_tunjangan').html(loading);
                $('span#ttl_kertas_kerja').html(loading);
            },
            success: function(s) {
                var obj = JSON.parse(s);
                $('span#notif_count_tunjangan').html(obj.tunjangan);
                $('span#ttl_kertas_kerja').html(obj.ttl_kertas_kerja);
            }
        });
    }

    // === begin: progress timeline ===
    function showTimeline(id) {
        $.ajax({
            url: "<?php echo site_url('tunjangan/show_timeline'); ?>",
            type: "post",
            data: {
                tunjangan_id: id
            },
            success: function(data) {
                $('#modal_timeline .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('#modal_timeline').modal('show'); // show bootstrap modal
        $('.modal-title').text('Perjalanan Pengajuan Surat Permohonan Tunjangan Keluarga'); // Set Title to Bootstrap modal title
    }
    // === end: progress timeline ===

    function tutup_form_detail() {
        $('#modal_all').modal('hide');
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