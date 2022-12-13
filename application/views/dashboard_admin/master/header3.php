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

