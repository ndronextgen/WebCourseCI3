<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
	<style>
		body{
			margin:20px;
			}
	</style>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/application.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap-tooltip.js"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/sunny/jquery-ui.css" type="text/css" rel="stylesheet"/>	
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.ui.i18n.all.min.js"></script>
	<!-- Datepicker -->
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<script type="text/javascript">
	$(function(){
		$.datepicker.setDefaults($.datepicker.regional['id']);
		$('#tanggal_sertifikat').datepicker({dateFormat: 'dd MM yy'});
	});
	</script>
  </head>

  <body>
	<div class="well">
	<?php if(validation_errors()) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  	<h4>Terjadi Kesalahan!</h4>
		<?php echo validation_errors(); ?>
	</div>
	<?php } ?>
		<?php echo form_open('admin/data_pelatihan/simpan','class="form-horizontal"'); ?>
		  <div class="control-group">
		  	<legend>Tambah Data Pelatihan - <?php echo $this->session->userdata("nama_pegawai"); ?></legend>
			<label class="span3" for="nama_pelatihan">Nama Pelatihan</label>
			<div class="controls">
			  <input type="text" class="span6" name="nama_pelatihan" id="nama_pelatihan" value="<?php echo $nama_pelatihan; ?>" placeholder="Nama Pelatihan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tempat_pelatihan">Tempat Pelatihan</label>
			<div class="controls">
			  <input type="text" class="span6" name="lokasi" id="lokasi" value="<?php echo $lokasi; ?>" placeholder="Lokasi Pelatihan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="kota">Kota</label>
			<div class="controls">
			  <input type="text" class="span6" name="kota" id="kota" value="<?php echo $kota; ?>" 
			  placeholder="Kota">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="no_sertifikat">Nomor Sertifikat</label>
			<div class="controls">
			  <input type="text" class="span6" name="no_sertifikat" id="no_sertifikat" value="<?php echo $no_sertifikat; ?>" 
			  placeholder="Nomor Sertifikat">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tanggal_sertifikat">Tanggal Sertifikat</label>
			<div class="controls">
			  <input type="text" class="span6" name="tanggal_sertifikat" id="tanggal_sertifikat" value="<?php echo $tanggal_sertifikat; ?>" 
			  placeholder="Tanggal Sertifikat">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="uraian">Keterangan</label>
			<div class="controls">
			  <textarea type="text" class="span6" name="uraian" id="uraian"
			  placeholder="Uraian"><?php echo $uraian; ?></textarea>
			</div>
		  </div>
		  
		  <input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
		  <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>">
		  <input type="hidden" name="st" value="<?php echo $st; ?>">
		  <div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn btn-primary">Simpan Data</button>
			  <button type="reset" class="btn">Hapus Data</button>
			  <a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $this->session->userdata('id_pegawai'); ?>#data-pelatihan" class="red btn">Cancel</a>
			</div>
		  </div>
		  <script src="http://localhost/sgmc/asset/js/chosen.jquery.js" type="text/javascript"></script>
			<script type="text/javascript"> 
				$(".chzn-select").chosen();
			</script>
		<?php echo form_close(); ?>
	</div>    
	
  </body>
</html>
