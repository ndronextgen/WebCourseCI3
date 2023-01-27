<?php headAdminHtml(); ?>

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
    <?php
    headerAdmin();
    ?>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugins/font-awesome-4.3.0/css/font-awesome.min.css'); ?>" />

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_admin/datatables/dataTables.bootstrap.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_admin/datatables/jquery.dataTables.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_admin/datatables/fixedHeader.dataTables.min.css'); ?>" />

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                <?php menuAdmin($menu_open); ?>

                <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                    <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin Subheader -->
                        <?php headerTitle(); ?>
                        <!-- end Subheader -->

                        <!-- begin content -->
                        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-list-2"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            <?php echo $page_name; ?>
                                        </h3>
                                    </div>
                                </div>

                                <div class="kt-portlet__body">

                                    <div class="row" style='padding:0px;'>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Lokasi&nbsp;Kerja&nbsp;:</label>
                                                <select class="form-control bootstrap-select" id="lokasi" name="lokasi">
                                                    <option value="">Semua Lokasi Kerja</option>
                                                    <?php
                                                    foreach ($arrLokasi as $key => $ars) {
                                                        echo '<option value="' . $key . '" ' . $arrLokasiSelected[$key] . '>' . $ars . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Sub&nbsp;Lokasi&nbsp;Kerja&nbsp;:</label>
                                                <select class="form-control bootstrap-select" id="sublokasi" name="sublokasi" style="float: right;">
                                                    <option value="">Semua Sub Lokasi Kerja</option>
                                                </select>
                                                <?php $sublok = ($this->input->post('sublokasi_id') != null) ? $this->input->post('sublokasi_id') : ''; ?>
                                                <input type="hidden" id="sublokasi_id" name="sublokasi_id" value="<?= $sublok ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style='padding:0px;'>
                                        <div class="col-sm-2">
                                            <button class="btn btn-sm btn-primary" onclick="filter()">
                                                <i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div class="kt-portlet__body">
                                    <div id='ajax_table'></div>
                                </div>

                            </div>
                        </div>
                        <!-- end content -->

                    </div>
                </div>
                <?php footerAdmin(); ?>
            </div>
        </div>
    </div>

    <?php scrollTop(); ?>

    <!-- BEGIN script global -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets_admin/js/init.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js"></script>
    <!-- END script global -->

    <!-- datatable -->
    <script src="<?php echo base_url('assets_admin/datatables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('assets_admin/datatables/dataTables.bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets_admin/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets_admin/datatables/dataTables.fixedHeader.min.js'); ?>"></script>

    <!-- BEGIN script page -->
    <script type="text/javascript">
        // === definisi select box as select2 ===
        $('#lokasi').select2({});
        $('#sublokasi').select2({});

        function filter() {
            let lokasi = '';
            let sublokasi = '';

            lokasi = $('#lokasi').val();
            sublokasi = $('#sublokasi_id').val();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/laporan_advance/filter') ?>",
                data: {
                    lokasi: lokasi,
                    sublokasi: sublokasi,
                },
                beforeSend: function() {
                    var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width: 3.5em; position: fixed;">';
                    $('#ajax_table').html(percentVal);
                },
                success: function(data) {
                    $('#ajax_table').html(data);
                }
            });
        }
        filter();

        // === change lokasi ===
        $("#lokasi").change(function() {
            let lokasi = $('#lokasi').find(":selected").val();

            if (lokasi == 52) {
                $.ajax({
                    url: '<?php echo base_url("admin/laporan_advance/load_sub_dinas") ?>',
                    dataType: 'json',
                    type: 'post',
                    success: function(response) {
                        const len = response.length;
                        if (len > 0) {
                            $('#sublokasi').find('option').remove().end();
                            $('#sublokasi').append('<option value="">Semua Sub Lokasi Kerja</option>');
                            let selected = '';
                            const sublokasi_post = '<?php echo $this->input->post('sublokasi') ?>';

                            for (var i = 0; i < len; i++) {
                                if (sublokasi_post == response[i]['id_lokasi_kerja']) {
                                    selected = 'selected = selected';
                                } else {
                                    selected = '';
                                }
                                $("#sublokasi").append("<option value=" + response[i]['id_lokasi_kerja'] + " " + selected + ">" + response[i]['lokasi_kerja'] + "</option>");
                            }
                        }
                    },
                    error: function(x, e) {
                        // 
                    }

                });
            } else if (lokasi == '') {
                $('#sublokasi').find('option').remove().end();
                $('#sublokasi').append('<option value="">Semua Sub Lokasi Kerja</option>');
                $('#sublokasi_id').val('');
            } else {
                $('#sublokasi').find('option').remove().end();
                $('#sublokasi').append('<option value="">-</option>');
            }
        });
        $("#lokasi").change();

        // === change sublokasi ===
        $("#sublokasi").change(function() {
            $("#sublokasi_id").val($("#sublokasi").val());
        });
    </script>
    <!-- END script page -->
</body>