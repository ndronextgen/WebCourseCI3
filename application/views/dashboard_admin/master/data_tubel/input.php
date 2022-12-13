<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/sunny/jquery-ui.css" type="text/css" rel="stylesheet"/>	
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
		$('#tgl_sk').datepicker({dateFormat: 'dd MM yy'});
		$('#tgl_mulai').datepicker({dateFormat: 'dd MM yy'});
		$('#tgl_selesai').datepicker({dateFormat: 'dd MM yy'});
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
		<?php echo form_open('admin/data_tubel/simpan','class="form-horizontal"'); ?>
		  <div class="control-group">
		  	<legend>Tambah Data Tugas & Izin Belajar - <?php echo $this->session->userdata("nama_pegawai"); ?></legend>
			<label class="span3" for="uraian">Nama Status</label>
			<div class="controls">
				<select data-placeholder="Status Belajar" class="js-example-basic-single span6 input-lg" name="uraian" id="uraian">
					<?php
					$tugas_belajar="";$izin_belajar="";$kosong1="";
					if($uraian=="Tugas Belajar"){ $tugas_belajar='selected="selected"';$izin_belajar="";$kosong1=""; }
					else if($uraian=="Izin Belajar"){ $tugas_belajar='';$izin_belajar='selected="selected"';$kosong1=""; }
					else { $tugas_belajar='';$izin_belajar='';$kosong1='selected="selected"'; }
					?>
          			<option value="" <?php echo $kosong1; ?>></option>
          			<option value="Tugas Belajar" <?php echo $tugas_belajar; ?>>Tugas Belajar</option>
          			<option value="Izin Belajar" <?php echo $izin_belajar; ?>>Izin Belajar</option>
				</select>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="nomor_sk">Nomor SK</label>
			<div class="controls">
			  <input type="text" class="span6" name="no_sk" id="no_sk" value="<?php echo $no_sk; ?>" 
			  placeholder="Nomor SK">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tgl_sk">Tanggal SK</label>
			<div class="controls">
			  <input type="text" class="span6" name="tgl_sk" id="tgl_sk" value="<?php echo $tgl_sk; ?>" 
			  placeholder="Tanggal SK">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tgl_mulai">Tanggal Mulai</label>
			<div class="controls">
			  <input type="text" class="span6" name="tgl_mulai" id="tgl_mulai" value="<?php echo $tgl_mulai; ?>" 
			  placeholder="Tanggal Mulai">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tgl_selesai">Tanggal Selesai</label>
			<div class="controls">
			  <input type="text" class="span6" name="tgl_selesai" id="tgl_selesai" value="<?php echo $tgl_selesai; ?>" 
			  placeholder="Tanggal Selesai">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="sekolah">Sekolah</label>
			<div class="controls">
			  <input type="text" class="span6" name="sekolah" id="sekolah" value="<?php echo $sekolah; ?>" 
			  placeholder="Sekolah">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="akreditasi">Akreditasi</label>
			<div class="controls">
			  <input type="text" class="span6" name="akreditasi" id="akreditasi" value="<?php echo $akreditasi; ?>" 
			  placeholder="Akreditasi">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="jurusan">Jurusan</label>
			<div class="controls">
			  <input type="text" class="span6" name="jurusan" id="jurusan" value="<?php echo $jurusan; ?>" 
			  placeholder="Jurusan">
			</div>
		  </div>
		  
		  <input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
		  <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>">
		  <input type="hidden" name="st" value="<?php echo $st; ?>">
		  <div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn btn-primary">Simpan Data</button>
			  <button type="reset" class="btn">Hapus Data</button>
			  <a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $this->session->userdata('id_pegawai'); ?>#data-tubel" class="red btn">Cancel</a>
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
