<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul_lengkap.' - '.$instansi; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
	
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/application.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap-tooltip.js"></script>
	<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/colorbox/colorbox.css" />
	<script src="<?php echo base_url(); ?>asset/colorbox/jquery.colorbox.js"></script>
	<script>
		  $(document).ready(function(){
			  //Examples of how to assign the ColorBox event to elements
			  $(".medium-box").colorbox({rel:'group', iframe:true, width:"900px", height:"90%"});
	
		  });
	</script>
  </head>
	
  <body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </a>
				  <a class="brand" href="<?php echo base_url(); ?>"><?php echo $judul_pendek; ?></a>
				  <div class="nav-collapse collapse">
					<ul class="nav">
					  <li class="active"><a href="<?php echo base_url(); ?>"><i class="icon-home icon-white"></i> Beranda</a></li>
					  <li><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
					  <li class="dropdown">
						<a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-fire icon-white"></i> Cuti Pegawai <b class=""></b></a>
					  </li>
					  <!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Panduan <b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="<?php echo base_url(); ?>panduan_administrator"><i class="icon-fire"></i> Administrator</a></li>
						  <li><a href="<?php echo base_url(); ?>panduan_operator"><i class="icon-asterisk"></i> Operator</a></li>
						  <li><a href="<?php echo base_url(); ?>panduan_executive"><i class="icon-leaf"></i> Executive</a></li>
						</ul>
					  </li> -->
					</ul>
					<div class="btn-group pull-right">
					  <button class="btn btn-primary"><i class="icon-user icon-white"></i> <?php echo $this->session->userdata('nama'); ?></button>
					  <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>app/change_password_publik"><i class="icon-wrench"></i> Pengaturan Akun</a></li>
						<li><a href="<?php echo base_url(); ?>app/logout"><i class="icon-off"></i> Log Out</a></li>
					  </ul>
					</div>
				  </div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
    <div class="container">
	
	<div class="well">
	  <div class="row">
		<div class="">
		  <h3><center><?php echo $judul_lengkap.'<br/> '.$instansi; ?></h3>
		</div>
		<div class="span">
		  <p><center><?php echo $alamat; ?></p>
		</div>
	  </div>
	</div>
	
	<header class="jumbotron subhead" id="overview">
	  <div class="subnav">
		<ul class="nav nav-pills">
		  <li><a href="<?php echo base_url(); ?>#data-pegawai"><strong>Pegawai</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-keluarga"><strong>Keluarga</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-pangkat"><strong>Pangkat</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-jabatan"><strong>Jabatan</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-pendidikan"><strong>Pendidikan</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-pelatihan"><strong>Pelatihan</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-penghargaan"><strong>Penghargaan</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-gaji"><strong>Gaji Pokok</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-hukuman"><strong>Hukuman</strong></a></li>
		  <li><a href="<?php echo base_url(); ?>#data-tubel"><strong>Tugas & Izin Belajar</strong></a></li>
		  <!--<li><a href="<?php echo base_url(); ?>data_dp3/index/<?php echo $this->session->userdata("kode_pegawai"); ?>">DP3</a></li>-->
		</ul>
	  </div>
	</header>

