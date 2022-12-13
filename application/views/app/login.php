<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $judul.' - '.$instansi; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="<?php echo base_url(); ?>assets_login/css/pages/login/login-1.css" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="<?php echo base_url(); ?>assets_login/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets_login/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="<?php echo base_url(); ?>assets_login/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets_login/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets_login/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets_login/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="icon" href="<?php echo base_url(); ?>assets_admin/media/logos/logox24.png" type="image/gif">
        
</head>

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

            <!--begin::Aside-->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(<?php echo base_url(); ?>asset/video/bcg5.png);">
                <div class="kt-grid__item">
                    <a href="#" class="kt-login__logo">
                        <img src="<?php echo base_url(); ?>assets_admin/media/logos/logox100.png">
                    </a>
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <h2 class="kt-login__title">SELAMAT DATANG</h2>
                        <h3 class="kt-login__title">SI-ADiK</h3>
                        <h4 class="kt-login__subtitle">(Sistem Informasi dan Arsip Digital Kepegawaian)</h4>
                    </div>
                </div>
            </div>

            <!--begin::Aside-->

            <!--begin::Content-->
            <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                <!--begin::Body-->
                <div class="kt-login__body">

                    <!--begin::Signin-->
                    <div class="kt-login__form">
                    <img src="<?=base_url('asset/img/original.jpg');?>" width="100%">
                        <div class="kt-login__title">
                            <div style="width:100%;margin-bottom: 0.5rem;font-weight:500;font-size:24px;line-height: 1.2;text-align:left !important;color:#ffffff;"><span>LOGIN FORM</span></div>
                            <div style="width:100%;text-align:left !important;font-size:16px;margin-top:20px;line-height: 1.6;color:#ffffff;"><span>Untuk akses SI-ADiK anda harus login.<br/> Apabila Anda belum terdaftar dapat menghubungi Bagian Kepegawaian.</span></div>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form" action="" novalidate="novalidate" id="kt_login_form" method="post">
                            <?php 
                            if ($this->session->flashdata('result_login')) {
                                echo '<div class="kt-form col-lg-8">
                                <div class="alert alert-warning fade show" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">'.$this->session->flashdata('result_login').'</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                </div>';
                            }
                            ?>
                            <div class="form-group">
                                <input class="form-control" type="text" required placeholder="NRK Anda" name="username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password Anda : default 123456" name="password" autocomplete="off">
                            </div>

                            <!--begin::Action-->
                            <div class="kt-login__actions" style="text-align:right !important;">
                                <button type="submit" class="btn btn-primary" style="border-radius:50%;padding:10px;" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="Login"><i class="fa fa-sign-in-alt"></i></button>
                            </div>

                            <!--end::Action-->
                        </form>

                        <!--end::Form-->
                    </div>

                    <!--end::Signin-->
                </div>

                <!--end::Body-->
            </div>

            <!--end::Content-->
        </div>
    </div>
</div>

<footer class="footer">
	<div class="container">
		<div class="row align-items-center flex-row-reverse">
			<div class="col-12 text-center">
            <?php echo $credit; ?>
			</div>
		</div>
	</div>
</footer>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?php echo base_url(); ?>assets_login/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets_login/js/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo base_url(); ?>assets_login/js/pages/custom/login/login-1.js" type="text/javascript"></script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>