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
		$('#tgl_sk_penghargaan').datepicker({dateFormat: 'dd MM yy'});
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
		<?php echo form_open('admin/data_penghargaan/simpan','class="form-horizontal"'); ?>
		  <div class="control-group">
		  	<legend>Tambah Data Penghargaan - <?php echo $this->session->userdata("nama_pegawai"); ?></legend>
			<label class="span3" for="id_master_penghargaan">Nama Penghargaan</label>
			<div class="controls">
			  <select name="id_master_penghargaan" id="id_master_penghargaan" data-placeholder="Nama Penghargaan" class="js-example-basic-single span6 input-lg">
			<option value=""></option>
			  	<?php
			  		foreach($mst_penghargaan->result_array() as $mp)
			  		{
			  			if($id_master_penghargaan==$mp['id_master_penghargaan'])
			  			{
			  	?>
			  		<option value="<?php echo $mp['id_master_penghargaan']; ?>" selected="selected"><?php echo $mp['nama_penghargaan']; ?></option>
			  	<?php
			  			}
			  			else
			  			{
			  	?>
			  		<option value="<?php echo $mp['id_master_penghargaan']; ?>"><?php echo $mp['nama_penghargaan']; ?></option>
			  	<?php
			  			}
			  		}
			  	?>
			  </select>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="pemberi_penghargaan">Pemberi Penghargaan</label>
			<div class="controls">
			  <input type="text" class="span6" name="pemberi_penghargaan" id="pemberi_penghargaan" value="<?php echo $pemberi_penghargaan; ?>" placeholder="Pemberi Penghargaan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="nomor_sk">Nomor SK</label>
			<div class="controls">
			  <input type="text" class="span6" name="nomor_sk" id="nomor_sk" value="<?php echo $nomor_sk; ?>" 
			  placeholder="Nomor SK">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tgl_sk_penghargaan">Tanggal SK</label>
			<div class="controls">
			  <input type="text" class="span6" name="tgl_sk_penghargaan" id="tgl_sk_penghargaan" value="<?php echo $tgl_sk_penghargaan; ?>" 
			  placeholder="Tanggal SK">
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
			  <a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $this->session->userdata('id_pegawai'); ?>#data-penghargaan" class="red btn">Cancel</a>
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
