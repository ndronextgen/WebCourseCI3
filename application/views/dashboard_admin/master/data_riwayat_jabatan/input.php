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
	  $( function() {
			$.datepicker.setDefaults($.datepicker.regional['id']);
			$('#tgl_sk_jabatan').datepicker({dateFormat: 'dd MM yy'});
			$('#tmt_mulai_jabatan').datepicker({dateFormat: 'dd MM yy'});
	  } );
	    
	$(document).ready(function(){
	 $('#id_riwayat_status_jabatan').change(function(){
	  var id_status_jabatan = $('#id_riwayat_status_jabatan').val();
	  if(id_status_jabatan != '')
	  {
	   $.ajax({
		url:"<?php echo base_url(); ?>dashboard_publik/nama_jabatan",
		method:"POST",
		data:{id_status_jabatan:id_status_jabatan},
		success:function(data)
		{
		 $('#id_r_jabatan').html(data);
		}
	   });
	  }
	  else
	  {
	   $('#nama_jabatan').html('<option value="">Pilih Nama Jabatan</option>');
	  }
	 });
	});
	
	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>
  </head>

  <body>
	<div class="well">
		<?php echo form_open_multipart('admin/data_riwayat_jabatan/simpan','class="form-horizontal"'); ?>
		<?php if(validation_errors()) { ?>
		<div class="alert alert-block">
		  <button type="button" class="close" data-dismiss="alert">×</button>
			<h4>Terjadi Kesalahan!</h4>
			<?php echo validation_errors(); ?>
		</div>
		<?php } ?>
		  <div class="control-group">
					<div class="span3"><strong>Status Jabatan</strong></div>
						<div class="span">:</div>
							<div class="span6">
								<select data-placeholder="Status Jabatan" name="id_riwayat_status_jabatan" id="id_riwayat_status_jabatan" class="js-example-basic-single span6">
									<option value="">Pilih Status Jabatan</option>
									<?php
									foreach($mst_status_jabatan as $mstsj)
									{
										{
										if($id_riwayat_status_jabatan==$mstsj->id_status_jabatan)
											{
											echo '<option value="'.$mstsj->id_status_jabatan.'" selected="selected">'.$mstsj->nama_status_jabatan.'</option>';
											}
											else
											{
											echo '<option value="'.$mstsj->id_status_jabatan.'">'.$mstsj->nama_status_jabatan.'</option>';
											}
										}
									}
									?>
								</select>
							</div>
				</div>

				<div class="control-group">
					<div class="span3"><strong>Nama Jabatan</strong></div>
						<div class="span">:</div>
							<div class="span6">
								<select name="id_r_jabatan" id="id_r_jabatan" class="js-example-basic-single span6 input-lg">
									<option value="">Pilih Nama Jabatan</option>
									<?php
									foreach($mst_jabatan->result_array() as $mj)
									{
										if($id_r_jabatan==$mj['id_nama_jabatan'])
											{
									?>
									<option value="<?php echo $mj['id_nama_jabatan']; ?>" selected="selected"><?php echo $mj['nama_jabatan']; ?></option>
									<?php
										}
									else
										{
									?>
									<option value="<?php echo $mj['id_nama_jabatan']; ?>"><?php echo $mj['nama_jabatan']; ?></option>
									<?php
											}
									}
									?>
								</select>
							</div>
				</div>
		  
		  <div class="control-group">
			<label class="span3" for="lokasi"><strong>Lokasi</strong></label>
			<div class="span">:</div>
			<div class="span6">
			  <input type="text" class="span6" name="lokasi" id="lokasi" value="<?php echo $lokasi; ?>" 
			  placeholder="lokasi">
			</div>
		  </div>
	
		  <div class="control-group">
			<label class="span3" for="tmt_mulai_jabatan"><strong>TMT</strong></label>
			<div class="span">:</div>
			<div class="span6">
			  <input type="text" class="span6" name="tmt_mulai_jabatan" id="tmt_mulai_jabatan" value="<?php echo $tmt_mulai_jabatan; ?>" 
			  placeholder="TMT">
			</div>
		  </div>
			
			<div class="control-group">
			<label class="span3" for="tgl_sk_jabatan"><strong>Tanggal SK</strong></label>
			<div class="span">:</div>
			<div class="span6">
			  <input type="text" class="span6" name="tgl_sk_jabatan" id="tgl_sk_jabatan" value="<?php echo $tgl_sk_jabatan; ?>" 
			  placeholder="Tanggal SK">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="span3" for="nomor_sk"><strong>Nomor SK</strong></label>
			<div class="span">:</div>
			<div class="span6">
			  <input type="text" class="span6" name="nomor_sk" id="nomor_sk" value="<?php echo $nomor_sk; ?>" 
			  placeholder="Nomor SK">
			</div>
		  </div>
		  
		  <input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
		  <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>">
		  <input type="hidden" name="st" value="<?php echo $st; ?>">
		  <div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn btn-primary">Simpan Data</button>
			  <button type="reset" class="btn">Hapus Data</button>
			  <a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $this->session->userdata('id_pegawai'); ?>#data-jabatan" class="red btn">Cancel</a>
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
