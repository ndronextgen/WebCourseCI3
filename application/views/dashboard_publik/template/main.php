<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $this->load->view('dashboard_publik/template/header');
    ?>
</head>

<body class="skin-blue layout-top-nav">
    <div class="wrapper navbar-inverse">
        <?php
        $this->load->view('dashboard_publik/template/navbar');
        ?>

        <div class="content-wrapper" style="padding-top: 5px;">
            <div class="container">
                
                <div class="nav-tabs-custom" style="margin-bottom:5px; background-image: url(<?php echo base_url('asset/media/bg/header-publik-3.jpg') ?>); background-size: 100% 200px">
                    <div class="row">

                        <div class="">
                            <h3>
                                <center style="color:#103452; font-weight:bold;"><?php echo $judul_lengkap . '<br/> ' . $instansi; ?>
                            </h3>
                        </div>
                        <div class="span">
                            <p>
                                <center style="color:#103452; font-weight:bold;"><?php echo $alamat_instansi; ?>
                            </p>
                        </div>

                    </div>
                    <br>
                </div>

                <!-- MAIN CONTENT -->
                <?php
                $this->load->view($page);
                ?>

                <!-- SSO MENU -->
                <div id="sso_widget"></div>

                <!-- FOOTER -->
                <footer class="main-header">
                    <nav class="navbar navbar-bottom">
                        <div class="container">
                            <!-- <p><?php echo $credit; ?></p> -->

                            <div style="float: left;">
                                <p><?php echo $credit; ?></p>
                            </div>
                            <div style="float: right; padding: 10px 30px;">
                                <?php
                                $app = &get_instance();
                                $app->load->view("dashboard_admin/visitor/footer");
                                ?>
                            </div>

                        </div>
                    </nav>
                </footer>

            </div>
        </div>

    </div>

    <?php
    $this->load->view('dashboard_publik/template/footer');
    ?>
</body>

</html>