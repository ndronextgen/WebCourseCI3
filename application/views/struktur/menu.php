<!-- START PAGE SIDEBAR -->
<div class="page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide page-sidebar-fixed scroll">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation" id="me">
        <li class="xn-logo">
            <a href="<?php echo base_url(); ?>dashboard"><p style='font-family: "Goudy Old Style";'>WZ-Course</p></a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="<?php echo base_url('assets/images/kursus.png'); ?>" alt="Kursus Online"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo base_url('assets/images/kursus.png'); ?>" alt="Kursus Online"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">Selamat Datang</div>
                    <div class="profile-data-title">Website WZ Course</div>
                </div>
            </div>                                                                        
        </li>
        <li>
            <a href="<?php echo base_url(); ?>dashboard"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
        </li>
        <li>
            <a href="<?php echo base_url(); ?>kursus"><span class="fa fa-bookmark"></span> <span class="xn-text">Kursus</span></a>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-tags"></span> <span class="xn-text">Referensi</span></a>
            <ul>
                <li><a href="<?php echo base_url(); ?>modul_referensi/manage_kursus"><span class="fa fa-angle-double-right"></span> Manage Kursus</a></li>   
            </ul>
        </li>  
        <li class="xn-openable">
            <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Administrator</span></a>                        
            <ul>
                <li><a href="<?php echo base_url(); ?>modul_admin/data_anggota"><span class="fa fa-angle-double-right"></span> Data Anggota</a></li>                            
                <li><a href="<?php echo base_url(); ?>modul_admin/manage_admin"><span class="fa fa-angle-double-right"></span> Manage Admin</a></li>                            
                <li><a href="<?php echo base_url(); ?>modul_admin/manage_akses"><span class="fa fa-angle-double-right"></span> Manage Privileges</a></li>
            </ul>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>login/logout"><span class="fa fa-sign-out"></span> <span class="xn-text">Logout</span></a>
        </li> 
    </ul>
    <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->