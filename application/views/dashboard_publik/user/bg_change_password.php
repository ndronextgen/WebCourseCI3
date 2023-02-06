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
											<i class="kt-font-brand flaticon-settings"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?>
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="kt-infobox">
										<div class="kt-infobox__body">
											<div class="row">
												<?php
												if ($this->session->userdata("navPassword") == "" && $this->session->userdata("navPengguna") == "") {
													$set['navPassword'] = "active";
													$set['tabPassword'] = "show active";
													$this->session->set_userdata($set);
												}
												$navPassword = $this->session->userdata("navPassword");
												$tabPassword = $this->session->userdata("tabPassword");
												$navPengguna = $this->session->userdata("navPengguna");
												$tabPengguna = $this->session->userdata("tabPengguna");
												?>
												<div class="col-lg-3">
													<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
														<a class="nav-link <?php echo $navPassword; ?>" id="v-pills-home-tab" data-toggle="pill" href="#pengaturan_password" role="tab" aria-controls="pengaturan_password" aria-selected="true"><i class="flaticon-lock"></i> Pengaturan Password</a>
														<a class="nav-link <?php echo $navPengguna; ?>" id="v-pills-profile-tab" data-toggle="pill" href="#pengaturan_pengguna" role="tab" aria-controls="pengaturan_pengguna" aria-selected="false"><i class="flaticon-user-settings"></i> Pengaturan Pengguna</a>
														<a class="nav-link" href="<?php echo base_url(); ?>app/logout"><i class="flaticon-logout"></i> Log Out</a>
													</div>
												</div>
												<div class="col-lg-9">
													<div class="tab-content">
														<div class="tab-pane fade <?php echo $tabPassword; ?>" id="pengaturan_password" role="tabpanel" aria-labelledby="pengaturan_password">
															<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
																<?php echo form_open(base_url() . 'app/save_pass', 'class="form-horizontal"'); ?>
																<div class="kt-portlet__head kt-portlet__head--lg">
																	<div class="kt-portlet__head-label">
																		<h3 class="kt-portlet__head-title">Pengaturan Password</h3>
																	</div>
																</div>
																<div class="kt-portlet__body">
																	<?php
																	if ($navPassword == "active") {
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
																	}
																	?>
																	<div class="kt-form">
																		<div class="form-group row">
																			<label class="col-4 col-form-label kt-font-bolder">Username</label>
																			<div class="col-8">
																				<input class="form-control" name="username" id="username" type="text" value="<?php echo $this->session->userdata('username'); ?>" readonly />
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-4 col-form-label kt-font-bolder">Password Lama</label>
																			<div class="col-8">
																				<input class="form-control" name="pass_lama" id="pass_lama" type="password" autocomplete="off" />
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-4 col-form-label kt-font-bolder">Password baru</label>
																			<div class="col-8">
																				<input class="form-control" name="pass_baru" id="pass_baru" type="password" autocomplete="off" />
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-4 col-form-label kt-font-bolder">Ulangi Password Baru</label>
																			<div class="col-8">
																				<input class="form-control" name="ulangi_pass_baru" id="ulangi_pass_baru" type="password" autocomplete="off" />
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
														<div class="tab-pane fade <?php echo $tabPengguna; ?>" id="pengaturan_pengguna" role="tabpanel" aria-labelledby="pengaturan_pengguna">
															<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
																<?php echo form_open(base_url() . 'app/save_name', 'class="form-horizontal"'); ?>
																<div class="kt-portlet__head kt-portlet__head--lg">
																	<div class="kt-portlet__head-label">
																		<h3 class="kt-portlet__head-title">Pengaturan Pengguna</h3>
																	</div>
																</div>
																<div class="kt-portlet__body">
																	<?php
																	if ($navPengguna == "active") {
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
																	}
																	?>
																	<div class="kt-form">
																		<div class="form-group row">
																			<label class="col-4 col-form-label kt-font-bolder">Nama Pengguna</label>
																			<div class="col-8">
																				<input class="form-control" name="nama_lengkap" id="nama_lengkap" type="text" value="<?php echo $this->session->userdata('nama'); ?>" />
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
													</div>
												</div>
											</div>
										</div>
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
	<script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<!-- <script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pegawai.js" type="text/javascript"></script> -->
	<!-- end script page -->
</body>


<?php
/*
<section id="data-keluarga">
  <div class="well">
  	<?php echo $this->session->flashdata('pass'); ?>
    <?php if(validation_errors()) { ?>
	<div class="alert alert-block">
	  <button type="button" class="close" data-dismiss="alert">�</button>
	  	<h4>Terjadi Kesalahan!</h4>
		<?php echo validation_errors(); ?>
	</div>
	<?php } ?>
	<div class="tabbable tabs-left">
	<?php
		if($this->session->userdata("tab_a")=="" && $this->session->userdata("tab_b")=="")
		{
			$set['tab_a'] = "active";
			$this->session->set_userdata($set);
		}
		$a = $this->session->userdata("tab_a");
		$b = $this->session->userdata("tab_b");
	?>
	  <ul class="nav nav-tabs">
		<li class="<?php echo $a; ?>"><a href="#lA" data-toggle="tab">Pengaturan Password</a></li>
		<li class="<?php echo $b; ?>"><a href="#lB" data-toggle="tab">Pengaturan Nama Pengguna</a></li>
		<li><a href="<?php echo base_url(); ?>app/logout">Log Out</a></li>
	  </ul>
	  <div class="tab-content">
		<div class="tab-pane <?php echo $a; ?>" id="lA">
		  <h4>Pengaturan Password</h4>
			<?php echo form_open('app/save_pass'); ?>
				<div class="control-group">
					<label class="control-label" for="pass_lama">Username</label>
					<div class="controls">
					  <input type="text" value="<?php echo $this->session->userdata('username'); ?>" 
					  class="span4" name="username" id="username" placeholder="Username" readonly="true">
					</div>
					<label class="control-label" for="pass_lama">Password Lama</label>
					<div class="controls">
					  <input type="password" class="span4" name="pass_lama" id="pass_lama" placeholder="Password Lama">
					</div>
					<label class="control-label" for="pass_lama">Password Baru</label>
					<div class="controls">
					  <input type="password" class="span4" name="pass_baru" id="pass_baru" placeholder="Password Baru">
					</div>
					<label class="control-label" for="pass_lama">Ulangi Password Baru</label>
					<div class="controls">
					  <input type="password" class="span4" name="ulangi_pass_baru" id="ulangi_pass_baru" placeholder="Ulangi Password Baru">
					</div>
			  	</div>
				<div class="control-group">
			<div class="controls">
			  <button type="submit" class="btn btn-primary">Simpan Data</button>
			  <button type="reset" class="btn">Hapus Data</button>
			</div>
		  </div>
			<?php echo form_close(); ?>
		</div>
		<div class="tab-pane <?php echo $b; ?>" id="lB">
		  <h4>Pengaturan Nama Pengguna</h4>
			  <?php echo form_open('app/save_name'); ?>
					<div class="control-group">
						<label class="control-label" for="pass_lama">Nama Pengguna</label>
						<div class="controls">
						  <input type="text" value="<?php echo $this->session->userdata('nama'); ?>" 
						  class="span4" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Pengguna">
						</div>
					</div>
					<div class="control-group">
				<div class="controls">
				  <button type="submit" class="btn btn-primary">Simpan Data</button>
				  <button type="reset" class="btn">Hapus Data</button>
				</div>
			  </div>
			<?php echo form_close(); ?>
		</div>
	  </div>
	</div> <!-- /tabbable -->
  </div>
</section>


      <footer class="well">
        <p><?php echo $credit; ?></p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
*/