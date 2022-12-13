<?php headAdminHtml();?>
<body style="background-image: url(<?php echo base_url().'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin(); 
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
											<?php echo $page_name; ?> <small>untuk <?php echo $pegawai->nama_pegawai; ?></small>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="javascript:;" onclick="backSuratTugasPlh('<?php echo $act;?>');" class="btn btn-clean btn-icon-sm">
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
											<div class="alert alert-block">
											<button type="button" class="close" data-dismiss="alert">×</button>
												<h4>ERROR !!!</h4>
												<?php echo $this->session->flashdata('msg'); ?>
											</div>
										<?php 
										}
										?>
										<?php echo form_open(base_url().'admin/surat_tugas_plh/simpan','class="form-horizontal" id="formSuratTugasPlh"'); ?>
										<input type="hidden" name="counterFrmSuratTugasPlh" id="counterFrmSuratTugasPlh" value="1" />
										<input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo (isset($pegawai->id_pegawai) ? $pegawai->id_pegawai : 0);?>" />
										<input type="hidden" name="id_surat_tugas_plh" id="id_surat_tugas_plh" value="<?php echo (isset($surat->id_surat_tugas_plh) ? $surat->id_surat_tugas_plh : 0);?>" />

										<div class="kt-portlet__body kt-portlet__body--fit">

										<div class="row" style='padding:0px;'>
											<div class="col-5">
												<div class="form-group">
													<label>Pegawai Yang Berhalangan Tugas</label>
												<select id="filter_pegawai" name="filter_pegawai" class="selectpicker form-control input-sm" data-style="btn btn-primary btn-sm" data-show-subtext='true' data-live-search='true' style="padding: 0px 0px !important;"> 
													<option valkue=''>- Pilih Pegawai -</option>
													<?php
														foreach ($data_pegawai as $d) {
															echo "<option value='$d->id_pegawai'";
															
															echo ">$d->nama_pegawai</option>";
														}
													?>
												</select>
												</div>
											</div>

											<div class="col-7">
												<div class="form-group">
													<label>Lokasi Kerja Pegawai Yang Berhalangan Tugas</label>
													<input type='text' id="lokasi_kerja" name="lokasi_kerja" class="form-control avoid-clicks">
												</div>
											</div>

										</div>
										<div class="row" style='padding:0px;'>
											<div class="col-6">
												<div class="form-group">
													<label>Alasan Pegawai Berhalangan Tugas :</label>
													<textarea rows="2" id="alasan_plh" name="alasan_plh" class="form-control"></textarea>
												</div>
											</div>
											<div class="col-2">
												<div class="form-group">
													<label>Lama/Durasi (Hari) :</label>
													<input type='number' class="form-control" id="durasi" name='durasi'>
												</div>
											</div>
											<div class="col-2">
												<div class="form-group">
													<label>Tanggal Mulai :</label>
													<input type='text' class="form-control tgl_mulai" id="tgl_mulai" name='tgl_mulai'>
												</div>
											</div>

											<div class="col-2">
												<div class="form-group">
													<label>Tanggal Selesai :</label>
													<input type='text' class="form-control tgl_selesai" id="tgl_selesai" name='tgl_selesai'>
												</div>
											</div>
										</div>

											<div class="form-group" id="frmSuratTugasPlh">
												<label>Tembusan:</label>
												<textarea rows="2" id="tembusan" name="tembusan[]" class="form-control"></textarea>
											</div>
											<div class="form-group form-group-last row">
												<label class="col-lg-2 col-form-label"></label>
												<div class="col-lg-12">
													<a href="javascript:;" onclick="addFrmSuratTugasPlh(this);" class="btn btn-bold btn-sm btn-label-brand" id="btnAddSuratTugasPlh">
														<i class="la la-plus"></i> Tambah
													</a>
												</div>
											</div>
											<div class="form-group">
												<hr />
											</div>
										</div>
										<div class="kt-portlet__foot" align="center">
											<div class="kt-form__actions kt-space-between"></div>
											<div class="row" align="center">
												<div class="col-ld-12" align="center">
													<button type="submit" class="btn btn-brand"><i class="fa fa-save"></i> Simpan</button>
													<a href="<?php echo base_url();?>admin/surat_tugas_plh" class="btn btn-secondary">
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
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url()?>assets_admin/js/pages/custom/form/surat_tugas_plh.js" type="text/javascript"></script>
	<!-- end script page -->

	<script>
		$('.tgl_mulai').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('.tgl_selesai').datepicker({
			format: 'yyyy-mm-dd'
		});
	//onchange
	$('#filter_pegawai').change(function() {
	var filter_pegawai = $('#filter_pegawai').val();
	//alert(filter_pegawai);
	$.ajax({
			type : "POST",
			url : "<?php echo site_url('admin/Surat_tugas_plh/get_lokasi') ?>",
			data : {filter_pegawai:filter_pegawai},
			success: function(data) {
				//alert(data);
					$('#lokasi_kerja').val(data);
			}
	})
});
	</script>
</body>

