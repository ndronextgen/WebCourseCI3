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
								</div>
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<p class="kt-portlet__head-title" style="font-size:10px;float:right;">
											<span style="background-color:red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> * Masa Pensiun 6 Bulan Kedepan;
											<span style="background-color:#b5990b;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> * Masa Pensiun 12 Bulan Kedepan
										</p>
									</div>
								</div>
								<?php echo form_open("admin/laporan_masa_pensiun",'name="frm" id="frm" method="post"'); ?>
								<div class="kt-portlet__body">
									<!--begin: Search Form -->
									<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
										<div class="row align-items-center">
											<div class="col-xl-12 order-2 order-xl-1">
												<div class="row align-items-center">
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-form__group kt-form__group--inline">
															<div class="kt-form__label">
																<label>Masa&nbsp;Pensiun&nbsp;:</label>
															</div>
															
															<div class="kt-form__control">
																<select class="form-control bootstrap-select" id="masa_pensiun" name="masa_pensiun">
																	<option value="0">Semua Masa Pensiun</option>
																	<?php
																	foreach ($arrSelection as $key=>$ars) {
																		echo '<option value="'.$key.'" '.$arrSelected[$key].' >'.$ars.'</option>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
														<button type="button" class="btn btn-primary" onclick="search();">
															<i class="fa fa-search"></i> Cari Data Laporan
														</button>
														&nbsp;
														<button type="button" class="btn btn-primary" onclick="excel();">
															<i class="fa fa-file-excel"></i> Export ke Excel
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end: Search Form -->
								</div>
								<div class="kt-portlet__body kt-portlet__body--fit">
									<!--begin: Datatable -->
									<div class="kt-datatable" id="tblLaporanMasaPensiun"></div>
									<!--end: Datatable -->
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
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url()?>assets_admin/js/pages/custom/tables/laporan/masa_pensiun.js" type="text/javascript"></script>
	<!-- end script page -->
</body>