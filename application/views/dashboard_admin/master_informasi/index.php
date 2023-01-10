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
                                            <i class="kt-font-brand flaticon-users"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            <?php echo $page_name; ?>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="dropdown dropdown-inline">
                                                <!--<button type="button" class="btn btn-brand btn-icon-sm">-->
                                                <a href="<?php echo base_url(); ?>admin/master_informasi/form" class="btn btn-brand btn-icon-sm">
                                                    <i class="flaticon2-plus"></i> Tambah Informasi
                                                </a>
                                                <!--</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <?php
                                    if ($this->session->flashdata('success')) {
                                        echo '<div class="alert alert-success fade show" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">' . $this->session->flashdata('success') . '</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>';
                                    }
                                    if ($this->session->flashdata('error')) {
                                        echo '<div class="alert alert-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">' . $this->session->flashdata('error') . '</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>';
                                    }
                                    ?>
                                    <!--begin: Search Form -->
                                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                        <div class="row align-items-center">
                                            <div class="col-xl-8 order-2 order-xl-1">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-input-icon kt-input-icon--left">
                                                            <input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="txtSearch">
                                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                <span><i class="la la-search"></i></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end: Search Form -->
                                </div>

                                <div class="kt-portlet__body kt-portlet__body--fit">
                                    <!--begin: Datatable -->
                                    <table class="kt-datatable" id="tbl" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="10px">No</th>
                                                <th>Judul Informasi</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Akhir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <!--end: Datatable -->
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

    <!-- begin script global -->
    <script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
    <!-- end script global -->

    <!-- begin script page -->
    <script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/master_informasi.js" type="text/javascript"></script>
    <!-- end script page -->
</body>