<?php headAdminHtml();?>
<body style="background-image: url(<?php echo base_url().'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin(); 
	?>
<?php
$lk = $this->session->userdata('lokasi_kerja');
if($lk =='0' || $lk=='' || $lk== null) {
	$de='';
} else {
	$de='avoid-clicks';
}
?>
<style>
.avoid-clicks {
  pointer-events: none;
  background-color: #dbdbdb;
  cursor: no-drop;
}
</style>
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<?php menuAdmin($menu_open); ?>

				<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
					<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						<!-- begin Subheader -->
						<?php headerTitle(); ?>
						<!-- end Subheader -->

						<!-- begin content -->
						<div class="kt-container  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="flaticon-file-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?></small>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="javascript:;" onclick="backSuratPensiun('<?php echo $act;?>');" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="col-lg-12">
										<?php 
										if($this->session->flashdata('msg')) { ?>
										<div class="alert alert-danger fade show" role="alert">
											<div class="alert-icon"><i class="flaticon-warning"></i></div>
											<div class="alert-text"><p><?php echo $this->session->flashdata('msg'); ?></p></div>

											<div class="alert-close">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true"><i class="la la-close"></i></span>
												</button>
											</div>
										</div>
										<?php 
										}
										?>

										<div class="alert alert-danger" role="alert">
											<div class="alert-icon"><i class="flaticon-warning"></i></div>
											<div class="alert-text">
												<b>
												Pegawai yang tampil adalah pegawai yang sudah mengisi lokasi kerja.
												</b>
											</div>
										</div>

										<?php echo form_open(base_url().'admin/surat_pensiun/simpan','class="form-horizontal" id="frmSuratPensiun"'); ?>
										<select class="form-control select <?php echo $de; ?>" name="lokasi_kerja" id="lokasi_kerja">
											<option valkue=''>- Pilih Lokasi Kerja -</option>
											<?php
												
												foreach ($lokasi_kerja as $d) {
													echo "<option value='$d->id_lokasi_kerja'";
													if ($d->id_lokasi_kerja== $lk) {
														echo ' selected';
													}
													echo ">$d->lokasi_kerja</option>";
												}
											?>
										</select>
										<input type="hidden" name="ids_pegawai" id="ids_pegawai" value="<?php echo $ids_pegawai;?>" />
										<div class="kt-portlet__body kt-portlet__body--fit" id="body">
											<div class="form-group">
												<label>Pilih Pegawai :</label>
												<select name="pegawai" id="pegawai" multiple>
												</select>
											</div>
										</div>

										<!-- <div class="kt-portlet__body kt-portlet__body--fit" id="body">
											<div class="form-group">
												<label>Pilih Pegawai :</label>
												<select name="pegawai" id="pegawai" multiple>
												<?php
												// if ($pegawai) {
												// 	foreach ($pegawai as $p) {
												// 	?>
												// 	<option value="<?php //echo $p['id_pegawai'];?>" <?php //echo $ids_pegawai_selected[$p['id_pegawai']];?>><?php //echo $p['nama_pegawai'];?></option>
												// 	<?php
												// 	}
												// }
												?>
												</select>
											</div>
										</div> -->

										<div class="kt-portlet__body kt-portlet__body--fit" id="body">
											<div class="form-group">
												<label>Surat keterangan ini dibuat untuk :</label>
												<textarea rows="4" id="keterangan" name="keterangan" class="form-control"></textarea>
											</div>
										</div>
										<div class="kt-portlet__foot" align="center">
											<div class="kt-form__actions kt-space-between"></div>
											<div class="row" align="center">
												<div class="col-ld-12" align="center">
													<button type="button" id="btnAddSave" class="btn btn-brand"><i class="fa fa-save"></i> Simpan</button>
													<a href="<?php echo base_url();?>admin/surat_pensiun" class="btn btn-secondary">
														Batal
													</a>
												</div>
											</div>
										</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
						</div>
						<!-- end content -->
					</div>
				</div>
				<?php footerAdmin(); ?>
			</div>
		</div>
	</div>
 
	<?php scrollTop(); ?>

	<!-- begin script global -->
	<script src="<?php echo base_url()?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/plugins/duallistbox/jquery.bootstrap-duallistbox.js" type="text/javascript"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url()?>assets_admin/js/pages/custom/form/surat_pensiun.js" type="text/javascript"></script>
	<!-- end script page -->
	<script>
	//onload
	var lokasi_kerja = $('#lokasi_kerja').val();
	$.ajax({
			type : "POST",
			url : "<?php echo site_url('admin/Surat_pensiun/filter_lk') ?>",
			data : "lokasi_kerja=" + lokasi_kerja,
			success: function(data) {
					$('select#pegawai').html(data);
					$('#pegawai').bootstrapDualListbox('refresh', true);
					$('#ids_pegawai').val('');
			}
	})
	//onchange
	$('#lokasi_kerja').change(function(){
			var lokasi_kerja = $('#lokasi_kerja').val();
			$.ajax({
					type : "POST",
					url : "<?php echo site_url('admin/Surat_pensiun/filter_lk') ?>",
					data : "lokasi_kerja=" + lokasi_kerja,
					success: function(data) {
							$('select#pegawai').html(data);
            				$('#pegawai').bootstrapDualListbox('refresh', true);
            				$('#ids_pegawai').val('');
					}
			})
	})
	</script>
</body>

