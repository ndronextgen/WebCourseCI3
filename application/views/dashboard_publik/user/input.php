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
											<a href="<?php echo base_url(); ?>manage_user" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div>
									</div>
								</div>

								<?php echo form_open('manage_user/simpan', 'class="form-horizontal"'); ?>
								<input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
								<input type="hidden" name="default_username" value="<?php echo $username; ?>">
								<input type="hidden" name="st" value="<?php echo $st; ?>">

								<div class="kt-portlet__body">
									<div class="kt-form col-lg-8">
										<?php
										if ($this->session->flashdata('pass')) {
											echo '<div class="alert alert-warning fade show" role="alert">
												<div class="alert-icon"><i class="flaticon-warning"></i></div>
												<div class="alert-text">' . $this->session->flashdata('pass') . '</div>
												<div class="alert-close">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true"><i class="la la-close"></i></span>
													</button>
												</div>
											</div>';
										}

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
											<label class="col-3 col-form-label kt-font-bolder">Nama Pengguna</label>
											<div class="col-5">
												<input class="form-control" name="nama_lengkap" id="nama_lengkap" type="text" value="<?php echo $nama_lengkap; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Username</label>
											<div class="col-5">
												<?php
												$readonly = '';
												if ($st == 'edit') {
													$readonly = 'readonly';
												}
												?>
												<input class="form-control" name="username" id="username" type="text" value="<?php echo $username; ?>" <?php echo $readonly; ?> />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Lokasi Kerja</label>
											<div class="col-8">
												<select name="id_lokasi_kerja" id="id_lokasi_kerja" class="form-control">
													<option value="0">Pilih Lokasi Kerja</option>
													<?php
													foreach ($mst_lokasi_kerja->result_array() as $me) {
														if ($id_lokasi_kerja == $me['id_lokasi_kerja']) {
															?>
															<option value="<?php echo $me['id_lokasi_kerja']; ?>" selected="selected"><?php echo $me['lokasi_kerja']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['id_lokasi_kerja']; ?>"><?php echo $me['lokasi_kerja']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Email</label>
											<div class="col-5">
												<input class="form-control" name="email" id="email" type="text" value="<?php echo $email; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Password</label>
											<div class="col-5">
												<input class="form-control" name="password" id="password" type="password" autocomplete='off' />
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
											<button type="reset" class="btn btn-secondary"><i class="flaticon-refresh"></i> Batal</button>
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