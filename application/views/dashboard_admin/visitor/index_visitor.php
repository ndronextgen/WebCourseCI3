<?php headAdminHtml(); ?>

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
    <?php
    headerAdmin();
    ?>

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


                                <!-- BEGIN: PENGUNJUNG -->
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="col-12">
                                        <div class="row" style="flex-wrap: nowrap;">


                                            <!-- SIDEBAR -->
                                            <div class="col-md-3">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div>
                                                            <?php $this->load->view('dashboard_admin/visitor/sidebar'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CONTENT -->
                                            <div class="col-md-8">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <!-- JUDUL SUB KONTEN -->
                                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                                            <div class="kt-portlet__head-label">
                                                                <h3 class="kt-portlet__head-title">
                                                                    <div id="judul_konten"></div>
                                                                </h3>
                                                            </div>
                                                        </div>

                                                        <!-- ISI SUB KONTEN -->
                                                        <div id="isi_konten"></div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- END: PENGUNJUNG -->


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

    <!-- begin script global -->
    <script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
    <!-- end script global -->

    <!-- begin script page -->

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2" type="text/javascript"></script>

    <!-- LOAD KONTEN -->
    <script>
        load_content('menu2')
        setTimeout(function() { load_content('menu1'); }, 100);
    </script>

</body>