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
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-list-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="javascript:;" onclick="backSuratPensiun();" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div>
									</div>
								</div>
								<?php echo form_open_multipart("admin/surat_keterangan/simpan",'name="frmSuratPensiun" id="frmSuratPensiun" method="post"'); ?>
								<input type="hidden" name="id_surat" id="id_surat" value="<?php echo (isset($surat->id_surat_pensiun) ? $surat->id_surat_pensiun : 0);?>" />
								<input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo (isset($surat->id_pegawai) ? $surat->id_pegawai : 0);?>" />

								<div class="kt-portlet__body">
									<div class="row">
										<div class="col-lg-12">
											<div class="kt-form">
												<div class="kt-portlet__body">
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">Pegawai</label>
														<div class="col-9">
															<?php
															if ($pegawai) {
																echo '<div class="kt-notification kt-notification--fit">';
																foreach ($pegawai as $k=>$p) {
																?>
																	<a href="javascript:;" class="kt-notification__item">
																		<div class="kt-notification__item-icon"><?php echo ($k+1);?>.</div>
																		<div class="kt-notification__item-details">
																			<div class="kt-notification__item-title">
																				<?php echo $p['nama_pegawai'];?>
																			</div>
																		</div>
																	</a>
																<?php
																}
																echo "</div>";
															}
															?>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">Keperluan</label>
														<div class="col-9">
															<span class="form-control-plaintext"><?php echo $surat->keterangan;?></span>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">&nbsp;</label>
														<div class="col-9">
															<a href="javascript:;" onclick="download_surat('<?php echo $surat->id_surat_pensiun;?>')"> Download Surat <i class="flaticon-download"></i></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php echo form_close(); ?>
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
	<script src="<?php echo base_url()?>assets_admin/js/pages/custom/form/surat_pensiun_detail.js" type="text/javascript"></script>
	<!-- end script page -->
</body>