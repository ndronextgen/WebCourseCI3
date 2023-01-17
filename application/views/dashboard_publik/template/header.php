<meta charset="UTF-8">
<title><?php echo $judul_lengkap . ' - ' . $instansi; ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="description" content="">
<meta name="author" content="">
<!-- show icon -->
<link rel="icon" href="<?php echo base_url(); ?>assets_admin/media/logos/logox24.png" type="image/gif">
<!-- jquery -->
<script src="<?php echo base_url(); ?>asset/jquery/jquery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 -->
<link href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap.min2.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min3.js"></script>
<!-- Font Awesome Icons -->

<script type="text/javascript" src="https://szimek.github.io/signature_pad/js/signature_pad.umd.js"></script>

<link href="<?php echo base_url(); ?>asset/plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="<?php echo base_url(); ?>asset/plugins/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<link href="<?php echo base_url(); ?>asset/select2/css/select2.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/select2/js/select2.full.min.js"></script>
<!-- Datepicker -->
<link href="<?php echo base_url(); ?>asset/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Datatables -->
<script src="<?php echo base_url(); ?>asset/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/datatables/js/dataTables.bootstrap.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>asset/bootstrap/js/fastclick.min.js"></script>
<link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/application.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('asset/bootstrap/check.js');?>"></script>

<!-- load javascript api for arcgis -->
<link rel="stylesheet" href="https://js.arcgis.com/4.21/esri/themes/light/main.css">
<script src="https://js.arcgis.com/4.21/"></script>

<script src="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.css" media="screen" />

<!-- sso styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>sso/css/style.css" />

<style type="text/css">
    .modal-body {
        overflow-y: auto;
    }

    #viewDiv {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
    }

    .pager li a.active {
        background-color: #103452 !important;
        color: #fff;
        border: 1px solid #103452;
    }

    #signArea {
        width: 280px;
        /* margin: 15px auto; */
    }

    .sign-container {
        width: 99%;
        margin: auto;
    }

    .sign-preview {
        width: 280px;
        height: 150px;
        border: solid 1px #CFCFCF;
        margin: 10px 5px;
    }

    .tag-ingo {
        font-family: cursive;
        font-size: 12px;
        text-align: left;
        font-style: oblique;
    }

    .center-text {
        text-align: center;
    }

    .tag-info {
        font-family: cursive;
        font-size: 12px;
        text-align: left;
        font-style: oblique;
    }

    .content {
        padding-top: 0px !important;
    }

    .avoid-clicks {
        pointer-events: none;
        background-color: #dbdbdb;
        cursor: no-drop;
    }
</style>

<script src="<?= base_url() ?>asset/signature/main_style/numeric-1.2.6.min.js"></script>

<!-- new sso -->
<link href="<?= base_url() ?>asset/sso/css/style.css" rel="stylesheet" />

<!-- jquery-confirm -->
<link rel="stylesheet" href="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.css'); ?>">
<script src="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.js'); ?>"></script>

<!-- css badge status -->
<style type="text/css">
    .badge-status {
        cursor: pointer;
        padding: 5px 20px;
        font-weight: normal;
    }
</style>

<!-- modal v-scroll -->
<style type="text/css">
    .modal-body {
        overflow-y: auto;
    }
</style>

<!-- horizontal timeline -->
<link rel="stylesheet" href="<?= base_url() ?>assets_admin/css/global/fonts.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_admin/css/wizard.css">
<link rel="stylesheet" href="<?= base_url() ?>assets_admin/plugins/global/plugins.bundle.css">

<!-- horizontal timeline -->
<style type="text/css">
    .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item .kt-wizard-v1__nav-body .kt-wizard-v1__nav-label {
        font-size: 14px;
        font-weight: bold;
    }
</style>

<!-- ajax table -->
<style type="text/css">
    td.right {
        text-align: right
    }

    td.left {
        text-align: left
    }

    td.center {
        text-align: center
    }
</style>