<?php headAdminHtml(); ?>

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
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
											<i class="kt-font-brand flaticon-users"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="<?php echo base_url(); ?>admin/master_jabatan" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div>
									</div>
								</div>

								<?php echo form_open('admin/master_jabatan/simpan', 'class="form-horizontal"'); ?>
								<input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
								<input type="hidden" name="st" value="<?php echo $st; ?>">

								<div class="kt-portlet__body">
									<div class="kt-form col-lg-8">
										<?php
										if (validation_errors()) {
											echo '<div class="alert alert-warning fade show" role="alert">
												<div class="alert-icon"><i class="flaticon-warning"></i></div>
												<div class="alert-text">' . validation_errors() . '</div>
												<div class="alert-close">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true"><i class="la la-close"></i></span>
													</button>
												</div>
											</div>';
										}
										?>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Status Jabatan</label>
											<div class="col-7">
												<select name="id_status_jabatan" id="id_status_jabatan" class="form-control">
													<option value="0">Pilih Status Jabatan</option>
													<?php
													foreach ($mst_status_jabatan->result_array() as $me) {
														if ($id_status_jabatan == $me['id_status_jabatan']) {
													?>
															<option value="<?php echo $me['id_status_jabatan']; ?>" selected="selected"><?php echo $me['nama_status_jabatan']; ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $me['id_status_jabatan']; ?>"><?php echo $me['nama_status_jabatan']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Nama Jabatan</label>
											<div class="col-5">
												<input class="form-control" name="nama_jabatan" id="nama_jabatan" type="text" value="<?php echo $nama_jabatan; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Nama Jabatan Atasan</label>
											<div class="col-7">
												<select name="id_jabatan_atasan" id="id_jabatan_atasan" class="form-control">
													<option value="0">Pilih Nama Jabatan Atasan</option>
													<?php
													foreach ($mst_jabatan_atasan->result_array() as $me) {
														if ($id_jabatan_atasan == $me['id_nama_jabatan']) {
													?>
															<option value="<?php echo $me['id_nama_jabatan']; ?>" selected="selected"><?php echo $me['nama_jabatan']; ?></option>
														<?php
														} else {
														?>
															<option value="<?php echo $me['id_nama_jabatan']; ?>"><?php echo $me['nama_jabatan']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Level Jabatan</label>
											<div class="col-5">
												<input class="form-control" name="level_jabatan" id="level_jabatan" type="text" value="<?php echo $level_jabatan; ?>" />
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__foot" align="center">
									<div class="kt-form__actions kt-space-between"></div>
									<div class="row" align="center">
										<div class="col-lg-12" align="center">
											<button type="submit" class="btn btn-brand"><i class="fa fa-save"></i> Simpan Data</button>
											&nbsp;
											<a href="<?php echo base_url(); ?>admin/master_jabatan" class="btn btn-clean btn-icon-sm">
												<i class="flaticon2-cross"></i>
												Batal
											</a>
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
	<script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/global/init.js" type="text/javascript"></script>
	<!-- end script global -->

	<!-- begin script page -->

	<!-- end script page -->
</body>