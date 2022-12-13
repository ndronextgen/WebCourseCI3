<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/sunny/jquery-ui.css" type="text/css" rel="stylesheet"/>	
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.ui.i18n.all.min.js"></script>
	<!-- Datepicker -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$.datepicker.setDefaults($.datepicker.regional['id']);
		$('#tanggal_lulus').datepicker({dateFormat: 'dd MM yy'});
	});
	
	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
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
		<?php echo form_open('admin/data_pendidikan/simpan','class="form-horizontal"'); ?>
		  <div class="control-group">
		  	<legend>Tambah Data Pendidikan - <?php echo $this->session->userdata("nama_pegawai"); ?></legend>
			<label class="span3" for="id_master_pendidikan">Tingkat Pendidikan</label>
			
			<div class="controls">
			  <select name="id_master_pendidikan" id="id_master_pendidikan" data-placeholder="Tingkat Pendidikan" class="js-example-basic-single span6 input-lg">
			<option value=""></option>
			  	<?php
			  		foreach($mst_pendidikan->result_array() as $mp)
			  		{
			  			if($id_master_pendidikan==$mp['id_master_pendidikan'])
			  			{
			  	?>
			  		<option value="<?php echo $mp['id_master_pendidikan']; ?>" selected="selected"><?php echo $mp['nama_pendidikan']; ?></option>
			  	<?php
			  			}
			  			else
			  			{
			  	?>
			  		<option value="<?php echo $mp['id_master_pendidikan']; ?>"><?php echo $mp['nama_pendidikan']; ?></option>
			  	<?php
			  			}
			  		}
			  	?>
			  </select>
			</div> 
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="jurusan">Jurusan</label>
			<div class="controls">
			  <input type="text" class="span6" name="jurusan" id="jurusan" value="<?php echo $jurusan; ?>" 
			  placeholder="Jurusan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tempat_sekolah">Tempat Pendidikan</label>
			<div class="controls">
			  <input type="text" class="span6" name="tempat_sekolah" id="tempat_sekolah" value="<?php echo $tempat_sekolah; ?>" 
			  placeholder="Tempat Pendidikan">
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
			<label class="span3" for="nomor_sttb">Nomor Ijazah</label>
			<div class="controls">
			  <input type="text" class="span6" name="nomor_sttb" id="nomor_sttb" value="<?php echo $nomor_sttb; ?>" 
			  placeholder="Nomor STTB">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tanggal_lulus">Tanggal Lulus</label>
			<div class="controls">
			  <input type="text" class="span6" name="tanggal_lulus" id="tanggal_lulus" value="<?php echo $tanggal_lulus; ?>" 
			  placeholder="Tanggal Lulus">
			</div>
		  </div>
		  
		  <input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
		  <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>">
		  <input type="hidden" name="st" value="<?php echo $st; ?>">
		  <div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn btn-primary">Simpan Data</button>
			  <button type="reset" class="btn">Hapus Data</button>
			  <a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $this->session->userdata('id_pegawai'); ?>#data-pendidikan" class="red btn">Cancel</a>
			</div>
		  </div>
		<?php echo form_close(); ?>
	</div>    
	
  </body>
</html>
