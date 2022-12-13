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
		$('#tanggal_lahir_keluarga').datepicker({dateFormat: 'dd MM yy'});		
		$('#tanggal_cerai_meninggal').datepicker({dateFormat: 'dd MM yy'});
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
		<?php echo form_open_multipart('admin/data_keluarga/simpan','class="form-horizontal"'); ?>
		  <div class="control-group">
		  	<legend>Tambah Data Keluarga - <?php echo $this->session->userdata("nama_pegawai"); ?></legend>
			<label class="span3" for="nama_anggota_keluarga">Nama Anggota Keluarga</label>
			<div class="controls">
			  <input type="text" class="span6" name="nama_anggota_keluarga" id="nama_anggota_keluarga" value="<?php echo $nama_anggota_keluarga; ?>" 
			  placeholder="Nama Anggota Keluarga">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="hub_keluarga">Hubungan Keluarga</label>
			<div class="controls">
			  <input type="text" class="span6" name="hub_keluarga" id="hub_keluarga" value="<?php echo $hub_keluarga; ?>" 
			  placeholder="Hubungan Keluarga">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="jenis_kelamin">Jenis Kelamin</label>
			<div class="controls">
				<select data-placeholder="Jenis Kelamin" class="js-example-basic-single span6 input-lg" name="jenis_kelamin" id="jenis_kelamin">
					<?php
					$laki="";$perempuan="";$kosong1="";
					if($jenis_kelamin=="Laki-Laki"){ $laki='selected="selected"';$perempuan="";$kosong1=""; }
					else if($jenis_kelamin=="Perempuan"){ $laki='';$perempuan='selected="selected"';$kosong1=""; }
					else { $laki='';$perempuan='';$kosong1='selected="selected"'; }
					?>
          			<option value="" <?php echo $kosong1; ?>></option>
          			<option value="Laki-Laki" <?php echo $laki; ?>>Laki-Laki</option>
          			<option value="Perempuan" <?php echo $perempuan; ?>>Perempuan</option>
				</select>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tanggal_lahir">Tanggal Lahir</label>
			<div class="controls">
			  <input type="text" class="span6" name="tanggal_lahir_keluarga" id="tanggal_lahir_keluarga" value="<?php echo $tanggal_lahir_keluarga; ?>" 
			  placeholder="Tanggal Lahir">
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
			  <a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $this->session->userdata('id_pegawai'); ?>#data-keluarga" class="red btn">Cancel</a>
			</div>
		  </div>
		<?php echo form_close(); ?>
	</div>    
	
  </body>
</html>
