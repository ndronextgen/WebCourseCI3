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
											<i class="kt-font-brand flaticon2-list-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?>
										</h3>
									</div>
								</div>

								<!--begin: Search Form -->
								<?php echo form_open("admin/laporan_pegawai_update_data", 'name="frm" id="frm" method="post"'); ?>
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<p class="kt-portlet__head-title" style="font-size:10px;float:right;">
											<!-- <span style="background-color:red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> * Masa Pensiun 6 Bulan Kedepan;
											<span style="background-color:#b5990b;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> * Masa Pensiun 12 Bulan Kedepan -->

											<?php
											$satu = "";
											$dua = "";
											$tiga = "";
											if (strtolower($tipe) == '0') {
												$satu = 'checked="checked"';
											} else if (strtolower($tipe) == '1') {
												$dua = 'checked="checked"';
											} else if (strtolower($tipe) == '2') {
												$tiga = 'checked="checked"';
											}
											?>

											<div class="form-check form-check-inline">
												<input class="form-check-input report_type_class" type="radio" name="report_type" id="report_type_1" value="0" <?= $satu ?>>
												<label class="form-check-label" for="report_type_1">Pembaruan data pegawai</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input report_type_class" type="radio" name="report_type" id="report_type_2" value="1" <?= $dua ?>>
												<label class="form-check-label" for="report_type_2">Pegawai yang sudah update</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input report_type_class" type="radio" name="report_type" id="report_type_3" value="2" <?= $tiga ?>>
												<label class="form-check-label" for="report_type_3">Pegawai yang belum update</label>
											</div>
											<input type="hidden" name="tipe" id="tipe" value="<?= $tipe ?>">
										</p>
									</div>
								</div>

								<div class="kt-portlet__body">
									<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
										<div class="row align-items-center">

											<div class="col-xl-12 order-2 order-xl-1">
												<div class="row align-items-center kt-form__group--inline">

													<div class="col-md-5 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-form__group kt-form__group--inline">
															<div class="kt-form__label">
																<label>Lokasi&nbsp;Kerja&nbsp;:</label>
															</div>
															<div class="kt-form__control">
																<select class="form-control bootstrap-select" id="lokasi" name="lokasi">
																	@csrf
																	<option value="0">Semua Lokasi Kerja</option>
																	<?php
																	foreach ($arrLokasi as $key => $ars) {
																		echo '<option value="' . $key . '" ' . $arrLokasiSelected[$key] . '>' . $ars . '</option>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
														<!-- <div class="kt-form__group kt-form__group--inline"> -->
														<div class="kt-input-icon kt-input-icon--left">
															<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="txtSearch">
															<span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
														</div>
														<!-- </div> -->
													</div>

													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<!-- <div class="kt-form__group kt-form__group--inline"> -->
														<button type="button" class="btn btn-primary" onclick="search();">
															<i class="fa fa-search"></i> Cari Data Laporan
														</button>
														&nbsp;
														<button type="button" class="btn btn-primary" onclick="excel();">
															<i class="fa fa-file-excel"></i> Export ke Excel
														</button>
														<!-- </div> -->
													</div>

												</div>
											</div>

										</div>
									</div>

								</div>
								<?php echo form_close(); ?>
								<!--end: Search Form -->

								<div class="kt-portlet__body kt-portlet__body--fit">
									<!--begin: Datatable -->
									<div class="kt-datatable" id="tblLaporanUpdateData"></div>
									<!--end: Datatable -->
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
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/laporan/update_data.js" type="text/javascript"></script>
	<!-- end script page -->

	<script type="text/javascript">
		// === change radio button selection ===
		$(".report_type_class").change(function() {
			if (document.getElementById('report_type_1').checked == true) {
				document.getElementById('tipe').value = '0';
			} else if (document.getElementById('report_type_2').checked == true) {
				document.getElementById('tipe').value = '1';
			} else if (document.getElementById('report_type_3').checked == true) {
				document.getElementById('tipe').value = '2';
			}
		})
	</script>
</body>