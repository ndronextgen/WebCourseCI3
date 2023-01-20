<div class="callout callout-info">
    <h4>Surat Keterangan Pegawai</h4>
    Fasilitas untuk mengajukan Surat Keterangan Pegawai.
</div>

<!-- begin: flash alert -->
<?php if ($this->session->flashdata('suksestambah')) { ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4>SUKSES !!!</h4>
        <?php echo $this->session->flashdata('suksestambah'); ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('gagaltambah')) { ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4>GAGAL !!!</h4>
        <?php echo $this->session->flashdata('gagaltambah'); ?>
    </div>
<?php } ?>
<!-- end: flash alert -->

<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <div class="tab-content">
                <button class="btn btn-success" onclick="tambah_pengajuan_surat()"><i class="glyphicon glyphicon-plus"></i>&nbsp; &nbsp;Tambah Pengajuan Surat</button>
                <br><br>

                <table id="table_srt_ket" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width='0px' style="text-align: center;">No</th>
                            <th width='0px' data-priority='1'>Aksi</th>
                            <th>Keperluan</th>
                            <th width='0px' data-priority='1' style="text-align: center;">Status</th>
                            <th width='0px'>Tanggal Pengajuan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

<script type="text/javascript">
    // var save_method; //for save method string
    var tablesrt_ket;

    $(document).ready(function() {
        notify_me();

        // datatables
        tablesrt_ket = $('#table_srt_ket').DataTable({

            "processing": true, // Feature control the processing indicator.
            "serverSide": true, // Feature control DataTables' server-side processing mode.
            // "order": [], // Initial no order.
            "ordering": false,
            "responsive": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('srt_ket/srt_datatables') ?>",
                "type": "POST"
            },

            // Set column definition initialisation properties.
            // "columnDefs": [{
            //     "targets": [-1], // last column
            //     "orderable": true, // set not orderable
            // }, {
            //     "bSortable": false,
            //     "aTargets": [0, 1, 2, 3]
            // }],

            // set column align
            "aoColumns": [{
                "sClass": "center"
            }, {
                "sClass": "left"
            }, {
                "sClass": "left"
            }, {
                "sClass": "center"
            }, {
                "sClass": "left"
            }],

            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData[5] == "0") {
                    /*mapping*/
                    $("td:eq(0)", nRow).css('font-weight', 'bold');
                    $("td:eq(1)", nRow).css('font-weight', 'bold');
                    $("td:eq(2)", nRow).css('font-weight', 'bold');
                    $("td:eq(3)", nRow).css('font-weight', 'bold');
                    $("td:eq(4)", nRow).css('font-weight', 'bold');
                    $(nRow).css('background-color', '#f7f7cd');
                }
            },

        });

    });

    function edit_srt(id_srt) {
        save_method = 'update';
        $('#form_srt')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('srt_ket/srt_edit/') ?>/" + id_srt,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_srt"]').val(data.id_srt);
                $('[name="keterangan"]').val(data.keterangan);
                $('[name="sel_jen_pengajuan_edit"]').val(data.jenis_pengajuan_surat);
                if (data.jenis_pengajuan_surat.toLowerCase() == 'x') {
                    $('[name="jen_pengajuan_lain_input_edit"]').val(data.jenis_pengajuan_surat_lainnya);
                    $('#jen_pengajuan_lain_input_edit').parents().eq(1).show();
                } else {
                    $('#jen_pengajuan_lain_input_edit').parents().eq(1).hide();
                }

                $('#modal_srt').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Surat'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function view_srt(id_srt) {
        $.ajax({
            url: "<?php echo site_url('Srt_ket/srt_view') ?>",
            type: "POST",
            data: {
                id_srt: id_srt
            },
            success: function(data) {
                //alert(data);
                $('#modal_all_lg .modal-dialog .modal-content .modal-body').html(data);
                $('#modal_all_lg').modal('show'); // show bootstrap modal
                $('.modal-title').text('Informasi Surat Keterangan Pegawai'); // Set Title to Bootstrap modal title
                reload_table_srt();
            }
        });
    }

    function notify_me() {
        $.ajax({
            url: "<?php echo site_url('Srt_ket/notify_me') ?>",
            type: "POST",
            beforeSend: function(f) {
                var loading = '';
                $('span#notif_count').html(loading);
                $('span#ttl_kertas_kerja').html(loading);
            },
            success: function(s) {
                //$('span#notif_count').html(s);
                var obj = JSON.parse(s);
                $('span#notif_count').html(obj.surat_keterangan);
                $('span#ttl_kertas_kerja').html(obj.ttl_kertas_kerja);
            }
        });
    }

    function reload_table_srt() {
        tablesrt_ket.ajax.reload(null, false); //reload datatable ajax 
        notify_me();
    }

    function savesrt() {
        $('#btnSaveSrt').text('saving...'); //change button text
        $('#btnSaveSrt').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'update') {
            url = "<?php echo site_url('srt_ket/srt_update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_srt').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_srt').modal('hide');
                    reload_table_srt();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSaveSrt').text('save'); //change button text
                $('#btnSaveSrt').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSaveSrt').text('save'); //change button text
                $('#btnSaveSrt').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_srt(id_srt) {
        let q = 'Hapus data surat keterangan pegawai?';
        let i = 'Surat keterangan pegawai berhasil dihapus.';
        let e = 'Proses hapus data bermasalah.';

        $.confirm({
            icon: 'fa fa-warning',
            title: 'Konfirmasi',
            content: q,
            type: 'red',
            buttons: {
                yes: {
                    text: 'Ya',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "<?php echo site_url('srt_ket/srt_delete') ?>",
                            type: "post",
                            data: "id_srt=" + id_srt,
                            success: function() {
                                $.dialog({
                                    icon: 'fa fa-info',
                                    title: 'Info',
                                    content: i,
                                    type: 'green',
                                    backgroundDismiss: true
                                });

                                reload_table_srt();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $.dialog({
                                    icon: 'fa fa-info',
                                    title: 'Info',
                                    content: e,
                                    type: 'red',
                                    backgroundDismiss: true
                                });
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

    // begin: progress timeline joe 2022.11.03
    function showTimeline(id_srt) {
        $.ajax({
            url: "<?php echo site_url('srt_ket/show_timeline'); ?>",
            type: "POST",
            data: {
                id_srt: id_srt
            },
            success: function(data) {
                $('#modal_all_lg .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('#modal_all_lg').modal('show'); // show bootstrap modal
        $('.modal-title').text('Perjalanan Pengajuan Surat Keterangan Pegawai'); // Set Title to Bootstrap modal title
    }
    // end: progress timeline joe 2022.11.03
</script>

<script type="text/javascript">
    function tambah_pengajuan_surat() {
        // save_method = 'add';
        $.ajax({
            url: "<?php echo site_url('dashboard_publik/pengajuan_surat'); ?>",
            type: "POST",
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Form Pengajuan Surat'); // Set Title to Bootstrap modal title
    }

    function lihat_detail_ditolak(idSurat) {
        $.ajax({
            url: "<?php echo site_url('dashboard_publik/ket_surat_ditolak'); ?>",
            type: "POST",
            data: {
                idSurat: idSurat
            },
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Surat Keterangan Pegawai Ditolak'); // Set Title to Bootstrap modal title
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sel_jen_pengajuan_edit').change(function() {

            if (this.value.toLowerCase() == 'x') {
                $('#jen_pengajuan_lain_input_edit').parents().eq(1).show();
            } else {
                $('#jen_pengajuan_lain_input_edit').parents().eq(1).hide();
            }

        });
    });

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2000);
</script>

<!-- ======================================================= -->
<!-- ==================== BEGIN: MODALS ==================== -->
<!-- ======================================================= -->

<div class="modal fade" id="modal_srt" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3 class="modal-title">Tambah Data Surat - <?php echo $this->session->userdata("nama_pegawai"); ?></h3>
            </div>

            <div class="modal-body form">
                <form action="#" id="form_srt" class="form-horizontal">
                    <input type="hidden" value="" name="id_srt" />
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-4">Keperluan</label>
                            <div class="col-md-8">
                                <select class="select2 form-control" name="sel_jen_pengajuan_edit" id="sel_jen_pengajuan_edit" placeholder="Jenis Pengajuan Surat">
                                    <!-- <option value=""></option> -->
                                    <?php
                                    $mst_jenis_pengajuan_surat = $this->srt_ket_model->jenis_pengajuan_surat();

                                    foreach ($mst_jenis_pengajuan_surat as $data) {
                                        ?>
                                        <?php
                                            ?>
                                        <option value="<?= $data->kode; ?>">
                                            <?= $data->keterangan; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" name="grp_jen_pengajuan" id=" grp_jen_pengajuan">
                            <label class="control-label col-md-4" name="jen_pengajuan_lain_label" id="jen_pengajuan_lain_label">Keperluan Lainnya</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="jen_pengajuan_lain_input_edit" id="jen_pengajuan_lain_input_edit" placeholder="Keperluan lainnya">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!-- <div class="form-group">
										<label class="control-label col-md-4">Keterangan</label>
										<div class="col-md-8">
											<textarea class="form-control textarea" style="height: 100px; overflow:auto; resize:none" name="keterangan" id="keterangan"></textarea>
											<span class="help-block"></span>
										</div>
									</div> -->

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSrtSave" onclick="savesrt()" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- <div class="modal in" id="modal_all" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" onclick="reload_table_srt()" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead">Large Modal</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="reload_table_srt()" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

<div class="modal fade" id="modal_all" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-md">
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
<div class="modal fade" id="modal_all_lg" data-backdrop="static" tabindex="-1">
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
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- ==================== END: MODALS ==================== -->
<!-- ===================================================== -->