<?php headAdminHtml();?>
<body style="background-image: url(<?php echo base_url().'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin(); 
	?>
	
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
											<a href="javascript:;" onclick="backSuratTugasPlt('<?php echo $act;?>');" class="btn btn-clean btn-icon-sm">
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
										<?php echo form_open(base_url().'admin/surat_tugas_plt/simpan','class="form-horizontal" id="formSuratTugasPlt"'); ?>
										<input type="hidden" name="counterFrmSuratTugasPlt" id="counterFrmSuratTugasPlt" value="1" />
										<input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo (isset($pegawai->id_pegawai) ? $pegawai->id_pegawai : 0);?>" />
										<input type="hidden" name="id_surat_tugas_plt" id="id_surat_tugas_plt" value="<?php echo (isset($surat->id_surat_tugas_plt) ? $surat->id_surat_tugas_plt : 0);?>" />

										<div class="kt-portlet__body kt-portlet__body--fit">
											
											<div class="form-group">
												<label>Alasan PLH :</label>
												<textarea rows="4" id="keterangan" name="keterangan" class="form-control"></textarea>
											</div>

											<div class="row" style='padding:20px;'>
												<div class="col-4">
													<div class="form-group">
														<label>Durasi (Hari) :</label>
														<input type='number' class="form-control" id="durasi" name='durasi'>
													</div>
												</div>

												<div class="col-4">

													<div class="form-group">
														<label>Tanggal Mulai :</label>
														<input type='text' class="form-control tgl_mulai" id="tgl_mulai" name='tgl_mulai'>
													</div>
												</div>

												<div class="col-4">
													<div class="form-group">
														<label>Tanggal Selesai :</label>
														<input type='text' class="form-control tgl_selesai" id="tgl_selesai" name='tgl_selesai'>
													</div>
												</div>
											</div>

											<div class="form-group" id="frmSuratTugasPlt">
												<label>Tembusan:</label>
												<textarea rows="4" id="tembusan_1" name="tembusan[]" class="form-control"></textarea>
											</div>
											<div class="form-group form-group-last row">
												<label class="col-lg-2 col-form-label"></label>
												<div class="col-lg-12">
													<a href="javascript:;" onclick="addFrmSuratTugasPlt(this);" class="btn btn-bold btn-sm btn-label-brand" id="btnAddSuratTugasPlt">
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
													<a href="<?php echo base_url();?>admin/surat_tugas_plt" class="btn btn-secondary">
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
	<script src="<?php echo base_url()?>assets_admin/js/pages/custom/form/surat_tugas_plt.js" type="text/javascript"></script>
	<!-- end script page -->

	<script>
		$('.tgl_mulai').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('.tgl_selesai').datepicker({
			format: 'yyyy-mm-dd'
		});
	</script>
</body>
