<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class='active'><a href="#arsip1" data-toggle="tab" id='arsip_pribadi' onclick="load_arsip('arsip_pribadi')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL PRIBADI</b></a></li>
                <li><a href="#arsip2" data-toggle="tab" id='arsip_sk' onclick="load_arsip('arsip_sk')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL SK</b></a></li>
                <li><a href="#arsip3" data-toggle="tab" id='arsip_pendidikan' onclick="load_arsip('arsip_pendidikan')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL PENDIDIKAN</b></a></li>
                <li><a href="#arsip4" data-toggle="tab" id='arsip_pelatihan' onclick="load_arsip('arsip_pelatihan')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL PELATIHAN</b></a></li>
                <li><a href="#arsip5" data-toggle="tab" id='arsip_skp' onclick="load_arsip('arsip_skp')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL SKP / DP3</b></a></li>
            </ul>

            <!-- MAIN CONTENT -->
            <div class="tab-content">
                <div id="ajax_table" class="tab-pane active"></div>
            </div>

        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

<script type="text/javascript">
    notify_arsip_digital();

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });
    // ----- end date

    function load_arsip(type) {
        if (type == "arsip_pribadi") {
            var urls = "<?php echo site_url('Dashboard_publik/arsip_pribadi'); ?>";
        } else if (type == "arsip_sk") {
            var urls = "<?php echo site_url('Dashboard_publik/arsip_sk'); ?>";
        } else if (type == "arsip_pendidikan") {
            var urls = "<?php echo site_url('Dashboard_publik/arsip_pendidikan'); ?>";
        } else if (type == "arsip_pelatihan") {
            var urls = "<?php echo site_url('Dashboard_publik/arsip_pelatihan'); ?>";
        } else if (type == "arsip_skp") {
            var urls = "<?php echo site_url('Dashboard_publik/arsip_skp'); ?>";
        }

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
    load_arsip('arsip_pribadi');

    function notify_arsip_digital() {
        $.ajax({
            url: "<?php echo site_url('lapor/notify_lapor') ?>",
            type: "POST",
            beforeSend: function(f) {
                var loading = '';
                // $('span#notif_count_kariskarsu').html(loading);
                $('span#ttl_kertas_kerja').html(loading);
            },
            success: function(s) {
                var obj = JSON.parse(s);
                // $('span#notif_count_kariskarsu').html(obj.kariskarsu);
                $('span#ttl_kertas_kerja').html(obj.ttl_kertas_kerja);
            }
        });
    }

    $(document).ready(function() {
        function add_sk() {
            $('#label-photo').text('Upload File');
            $('#frame_sk').remove();
            save_method = 'addsk';

            $('#form_sk')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_sk').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Data SK Lainnya - <?php echo $this->session->userdata("nama_pegawai"); ?>'); // Set Title to Bootstrap modal title
        }

        function edit_sk(id_sk) {
            $('#label-photo').text('Upload File');
            $('#frame_sk').remove();
            save_method = 'update';

            $('#form_sk')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('arsip_sk/sk_edit/') ?>/" + id_sk,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_sk"]').val(data.id_arsip_sk);
                    $('[name="title_sk"]').val(data.title);
                    $('#modal_sk').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Data sk'); // Set title to Bootstrap modal title

                    if (data.file_name) {
                        $('#label-photo').text('Upload File');
                        $('#file_sk').before('<iframe id="frame_sk" src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>');
                    } else {
                        $('#label-photo').text('Upload File');
                        $('#frame_sk').remove();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function lihat_file(id) {
            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('arsip_sk/sk_lihat/') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#lihat_file').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Lihat Data sk'); // Set title to Bootstrap modal title
                    $('#photo-preview').show(); // show photo preview modal

                    if (data.file_name) {
                        $('#MyModalBody div').html('<iframe src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="550px" height="400px"></iframe>');
                    } else {
                        $('#MyModalBody div').text('(No File)');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table_sk() {
            tablesk.ajax.reload(null, false); //reload datatable ajax 
            notify_arsip_digital();
        }

        function savesk() {
            $('#btnskSave').text('saving...'); //change button text
            $('#btnskSave').attr('disabled', true); //set button disable 

            var url;

            if (save_method == 'addsk') {
                url = "<?php echo site_url('arsip_sk/sk_add') ?>";
            } else {
                url = "<?php echo site_url('arsip_sk/sk_update') ?>";
            }

            // ajax adding data to database
            var form = $("#form_sk").closest("form");
            var frmData = new FormData(form[0]);

            $.ajax({
                url: url,
                type: "POST",
                data: frmData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_sk').modal('hide');
                        reload_table_sk();
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }

                    $('#btnskSave').text('save'); //change button text
                    $('#btnskSave').attr('disabled', false); //set button enable 
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnskSave').text('save'); //change button text
                    $('#btnskSave').attr('disabled', false); //set button enable 
                }
            });
        }

        function delete_sk(id_sk) {
            if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('arsip_sk/sk_delete') ?>/" + id_sk,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        //if success reload ajax table
                        $('#modal_sk').modal('hide');
                        reload_table_sk();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Proses delete data error');
                    }
                });
            }
        }

        $('#modal-download').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var content = button.data('content');
            var modal = $(this);
            var url = '';

            switch (content) {
                case 'pribadi':
                    url = "<?= base_url('arsip_pribadi/download_all'); ?>";
                    break;
                case 'sk':
                    url = "<?= base_url('arsip_sk/download_all'); ?>";
                    break;
                case 'pendidikan':
                    url = "<?= base_url('arsip_pendidikan/download_all'); ?>";
                    break;
                case 'pelatihan':
                    url = "<?= base_url('arsip_pelatihan/download_all'); ?>";
                    break;
                case 'skp':
                    url = "<?= base_url('arsip_skp/download_all'); ?>";
                    break;
            }

            setTimeout(function() {
                window.location.href = url;
            }, 2500);
            setTimeout(function() {
                modal.modal('hide');
            }, 2500);
        });
    });
</script>


<!-- ======================================================= -->
<!-- ==================== BEGIN: MODALS ==================== -->
<!-- ======================================================= -->

<!-- Bootstrap modal -->
<div class="modal fade" id="add_koordinat" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" align="center">Koordinat Alamat Anda</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <div class="control-label">
                        <!-- <div id="viewDiv" align="center" style="height:530px;width:565px;overflow:visible;"></div> -->
                        <div id="viewDiv" style="width: 100%; height: 750px;"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" aria-label="Close"> Simpan</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal download -->
<div class="modal modal-primary fade" id="modal-download-arsip" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon ion-ios-paper"></i> Download File </h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Men-download File &nbsp;<i class="fa fa-refresh fa-spin"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bootstrap modal -->

<!-- modal download -->
<div class="modal modal-primary fade" id="modal-download" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon ion-ios-paper"></i> Download File </h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Men-download File &nbsp;<i class="fa fa-refresh fa-spin"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal kabeh -->
<div class="modal fade" id="modal_all" data-backdrop='static' data-keyboard='false'>
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

<!-- ===================================================== -->
<!-- ==================== END: MODALS ==================== -->
<!-- ===================================================== -->