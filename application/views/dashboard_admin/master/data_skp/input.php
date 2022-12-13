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
		<?php echo form_open('admin/data_skp_dp3/simpan','class="form-horizontal"'); ?>
		  <div class="control-group">
		  	<legend>Tambah Data DP3 / SKP - <?php echo $this->session->userdata("nama_pegawai"); ?></legend>
			<label class="span3" for="uraian">Jenis Data</label>
			<div class="controls">
				<select data-placeholder="uraian" class="js-example-basic-single span6 input-lg" name="uraian" id="uraian">
					<?php
					$dp3="";$skp="";$kosong1="";
					if($uraian=="SKP"){ $dp3='selected="selected"';$skp="";$kosong1=""; }
					else if($uraian=="DP3"){ $dp3='';$skp='selected="selected"';$kosong1=""; }
					else { $dp3='';$skp='';$kosong1='selected="selected"'; }
					?>
          			<option value="" <?php echo $kosong1; ?>></option>
          			<option value="DP3" <?php echo $skp; ?>>DP3</option>					
          			<option value="SKP" <?php echo $dp3; ?>>SKP</option>
				</select>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tahun">Tahun</label>
			<div class="controls">
			  <input type="text" class="span6" name="tahun" id="tahun" value="<?php echo $tahun; ?>" 
			  placeholder="Tahun">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="orientasi">Orientasi Pelayanan</label>
			<div class="controls">
			  <input type="text" class="span6" name="orientasi" id="orientasi" value="<?php echo $orientasi; ?>" 
			  placeholder="Orientasi Pelayanan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="integritas">Integritas</label>
			<div class="controls">
			  <input type="text" class="span6" name="integritas" id="integritas" value="<?php echo $integritas; ?>" 
			  placeholder="Integritas">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="komitmen">Komitmen</label>
			<div class="controls">
			  <input type="text" class="span6" name="komitmen" id="komitmen" value="<?php echo $komitmen; ?>" 
			  placeholder="Komitmen">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="disiplin">Disiplin</label>
			<div class="controls">
			  <input type="text" class="span6" name="disiplin" id="disiplin" value="<?php echo $disiplin; ?>" 
			  placeholder="Disiplin">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="kesetiaan">Kesetiaan</label>
			<div class="controls">
			  <input type="text" class="span6" name="kesetiaan" id="kesetiaan" value="<?php echo $kesetiaan; ?>" 
			  placeholder="Kesetiaan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="prestasi">Prestasi</label>
			<div class="controls">
			  <input type="text" class="span6" name="prestasi" id="prestasi" value="<?php echo $prestasi; ?>" 
			  placeholder="Prestasi">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="tanggung_jawab">Tanggung Jawab</label>
			<div class="controls">
			  <input type="text" class="span6" name="tanggung_jawab" id="tanggung_jawab" value="<?php echo $tanggung_jawab; ?>" 
			  placeholder="Tanggung Jawab">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="ketaatan">Ketaatan</label>
			<div class="controls">
			  <input type="text" class="span6" name="ketaatan" id="ketaatan" value="<?php echo $disiplin; ?>" 
			  placeholder="Ketaatan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="kejujuran">Kejujuran</label>
			<div class="controls">
			  <input type="text" class="span6" name="kejujuran" id="kejujuran" value="<?php echo $kejujuran; ?>" 
			  placeholder="Kejujuran">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="kerjasama">Kerjasama</label>
			<div class="controls">
			  <input type="text" class="span6" name="kerjasama" id="kerjasama" value="<?php echo $kerjasama; ?>" 
			  placeholder="Kerjasama">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="prakarsa">Prakarsa</label>
			<div class="controls">
			  <input type="text" class="span6" name="prakarsa" id="prakarsa" value="<?php echo $prakarsa; ?>" 
			  placeholder="Prakarsa">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="kepemimpinan">Kepemimpinan</label>
			<div class="controls">
			  <input type="text" class="span6" name="kepemimpinan" id="kepemimpinan" value="<?php echo $kepemimpinan; ?>" 
			  placeholder="Kepemimpinan">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="rata_rata">Rata-rata</label>
			<div class="controls">
			  <input type="text" class="span6" name="rata_rata" id="rata_rata" value="<?php echo $rata_rata; ?>" 
			  placeholder="Rata-rata">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="atasan">Atasan Penilai</label>
			<div class="controls">
			  <input type="text" class="span6" name="atasan" id="atasan" value="<?php echo $atasan; ?>" 
			  placeholder="Atasan Penilai">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="penilai">Penilai</label>
			<div class="controls">
			  <input type="text" class="span6" name="penilai" id="penilai" value="<?php echo $penilai; ?>" 
			  placeholder="Penilai">
			</div>
		  </div>
		  
		  <input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
		  <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>">
		  <input type="hidden" name="st" value="<?php echo $st; ?>">
		  <div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn btn-primary">Simpan Data</button>
			  <button type="reset" class="btn">Hapus Data</button>
			  <a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $this->session->userdata('id_pegawai'); ?>#data-skp" class="red btn">Cancel</a>
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
