<?php
if(!$this->session->userdata('ses_user') OR !$this->session->userdata('ses_id')){ 
	redirect(base_url('login'));
} else {
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>WZ-COURSE</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="<?php echo base_url('assets/images/kursus.png'); ?>" type="image/x-icon" />
        <!-- END META SECTION -->
        <script src="<?php echo base_url('assets/jquery-1.10.1.min.js');?>"></script>
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('assets/css/theme-default.css'); ?>"/>
        <!-- EOF CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css');?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/jquery.dataTables.min.css');?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/fixedHeader.dataTables.min.css');?>"/> 
        
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-select.min.css'); ?>" />
	    <script src="<?php echo base_url('assets/js/bootstrap-select.min.js');?>"></script>
        <script type="text/javascript">
            $(function() {
                var path = window.location.href; // Mengambil data URL pada Address bar
                $('ul#me li a').each(function() {
                    // Jika URL pada menu ini sama persis dengan path...
                    if (this.href == path) {
                        // Tambahkan kelas "active" pada menu ini
                        $(this).closest('li').addClass(' menu_active');
                        $(this).closest('a').addClass(' active');
                    }
                });
            });

            $(function() {
                var path = window.location.href; // Mengambil data URL pada Address bar

        $('ul#me li ul li a').each(function() {
                    // Jika URL pada menu ini sama persis dengan path...
                    if (this.href == path) {
                        // Tambahkan kelas "active" pada menu ini
                        $(this).closest('li.xn-openable').addClass('xn-openable active');
                        $(this).closest('li').addClass('menu_active');
                        $(this).closest('ul').css("display", "block");
                    }
                });
            });
        </script>
        <style>
            .center{ text-align: center; }
            .right{text-align: right}
            .left{text-align: left}
            .avoid-clicks {
                pointer-events: none;
                background-color: #dbdbdb;
                cursor: no-drop;
            }
            .menu_active {
                background-color: #000000;
            }
        </style>
    </head>
    <body style='font-size:12px !important;font-family: Arial Narrow,Arial,sans-serif;background: #e8e8e8;'>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top-fixed">
            
            <?php $this->load->view('struktur/menu'); ?>
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    
                    
                </ul>
                <!-- END PAGE CONTENT WRAPPER -->                                
                <?php $this->load->view($page); ?>
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jquery/jquery-ui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='<?php echo base_url('assets/js/plugins/icheck/icheck.min.js'); ?>'></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/scrolltotop/scrolltopcontrol.js'); ?>"></script>
        


        <script type='text/javascript' src='<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>'></script>
        <script type='text/javascript' src='<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>'></script>
        <script type='text/javascript' src='<?php echo base_url('assets/js/plugins/bootstrap/bootstrap-datepicker.js'); ?>'></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/bootstrap/bootstrap-timepicker.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/owl/owl.carousel.min.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/moment.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <!-- <script type="text/javascript" src="<?php //echo base_url('assets/js/settings.js');?>"></script> -->
        
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>        
        <script type="text/javascript" src="<?php echo base_url('assets/js/actions.js');?>"></script>
        
        <!-- datatables js -->
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js');?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js');?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.fixedHeader.min.js');?>"></script>
        <!-- check -->
        <script src="<?php echo base_url('assets/plugins/check.js');?>"></script>
        <!-- form -->
        <script src="<?php echo base_url('assets/jquery.form.js');?>"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>
<div class="modal in" id="modal_all" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true" style="display: none;"><div class="modal-backdrop  in"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="largeModalHead">Large Modal</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
            </div>  -->
        </div>
    </div>
</div>
<?php } ?>






