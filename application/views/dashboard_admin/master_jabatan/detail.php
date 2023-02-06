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
											<i class="kt-font-brand flaticon-users"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="<?php echo base_url();?>admin/master_jabatan" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="kt-form col-lg-8">
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Status Jabatan</label>
											<div class="col-5">
												<input class="form-control" name="status_jabatan" id="status_jabatan" type="text" value="<?php echo $nama_status_jabatan; ?>" disabled />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Nama Jabatan</label>
											<div class="col-5">
												<input class="form-control" name="nama_jabatan" id="nama_jabatan" type="text" value="<?php echo $nama_jabatan; ?>" disabled />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Nama Jabatan Atasan</label>
											<div class="col-5">
												<input class="form-control" name="nama_jabatan_atasan" id="nama_jabatan_atasan" type="text" value="<?php echo $nama_jabatan_atasan; ?>" disabled />
											</div>
										</div>
										<div class="form-group row">
											<label class="col-3 col-form-label kt-font-bolder">Level Jabatan</label>
											<div class="col-5">
												<input class="form-control" name="level_jabatan" id="level_jabatan" type="text" value="<?php echo $level_jabatan; ?>" disabled />
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
	<script src="<?php echo base_url()?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<!-- end script global -->
</body>