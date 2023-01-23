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
											<?php echo $page_name ?>
										</h3>
									</div>
								</div>

								<!-- begin: CHART -->
								<div class="kt-portlet__head kt-portlet__head--lg" style="padding-bottom: 50px;">
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body">
												<div class="kt-portlet__head kt-portlet__head--lg">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">Infografis Update Data Pegawai</h3>
													</div>
												</div>
												<div id="grafik_update_data"></div>
											</div>
										</div>
									</div>
								</div>
								<!-- end: CHART -->

								<!--begin: Search Form -->
								<?php echo form_open("admin/laporan_pegawai_update_data", 'name="frm" id="frm" method="post"'); ?>
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<p class="kt-portlet__head-title"">

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

									<div class=" col-xl-12 order-2 order-xl-1">
											<div class="row align-items-center kt-form__group--inline">

												<!-- <div class="col-md-6 kt-margin-b-20-tablet-and-mobile"> -->
												<div class="form-check form-check-inline">
													<input class="form-check-input report_type_class" type="radio" name="report_type" id="report_type_1" value="0" <?= $satu ?> style="cursor: pointer;">
													<label class="form-check-label" for="report_type_1" style="cursor: pointer; font-size: 14px;">Pembaruan&nbsp;data&nbsp;pegawai</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input report_type_class" type="radio" name="report_type" id="report_type_2" value="1" <?= $dua ?> style="cursor: pointer;">
													<label class="form-check-label" for="report_type_2" style="cursor: pointer; font-size: 14px;">Pegawai&nbsp;yang&nbsp;sudah&nbsp;update</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input report_type_class" type="radio" name="report_type" id="report_type_3" value="2" <?= $tiga ?> style="cursor: pointer;">
													<label class="form-check-label" for="report_type_3" style="cursor: pointer; font-size: 14px;">Pegawai&nbsp;yang&nbsp;belum&nbsp;update</label>
												</div>
												<input type="hidden" name="tipe" id="tipe" value="<?= $tipe ?>">
												<!-- </div> -->

											</div>
									</div>

									</p>
								</div>
							</div>

							<div class="kt-portlet__body">
								<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
									<div class="row align-items-center">

										<div class="col-xl-12 order-2 order-xl-1">
											<div class="row align-items-center kt-form__group--inline">

												<div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
													<div class="kt-form__group kt-form__group--inline">
														<div class="kt-form__label">
															<label>Lokasi&nbsp;Kerja&nbsp;:</label>
														</div>
														<div class="kt-form__control">
															<select class="form-control bootstrap-select" id="lokasi" name="lokasi">
																<!-- @csrf -->
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

												<div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
													<div class="kt-form__group kt-form__group--inline">
														<div class="kt-form__label">
															<label>Sub&nbsp;Lokasi&nbsp;Kerja&nbsp;:</label>
														</div>
														<div class="kt-form__control">
															<select class="form-control bootstrap-select" id="sublokasi" name="sublokasi">
																<!-- <?php
																		$lokasi_post = $this->input->post('lokasi');

																		if ($lokasi_post == 52 or $lokasi_post == 0) { ?>
																		<option value="0">Semua Lokasi Kerja</option>
																	<?php } else { ?>
																		<option value="">-</option>
																	<?php } ?> -->
															</select>
															<?php $sublok = ($this->input->post('sublokasi_id') != null) ? $this->input->post('sublokasi_id') : ''; ?>
															<input type="hidden" id="sublokasi_id" name="sublokasi_id" value="<?= $sublok ?>">
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>

								<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
									<div class="row align-items-center">

										<div class="col-xl-12 order-2 order-xl-1">
											<div class="row align-items-center kt-form__group--inline">

												<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
													<div class="kt-form__group kt-form__group--inline">
														<div class="kt-form__label">
															<label>Periode:</label>
														</div>
														<div class="kt-form__control">
															<?php

															$date_1 = ($start_date == null) ? '' : date_format(date_create($start_date), 'j M Y');
															$date_2 = ($end_date == null) ? '' : date_format(date_create($end_date), 'j M Y');
															if ($date_1 != '' or $date_2 != '') {
																$date = $date_1 . "   s.d.   " . $date_2;
															} else {
																$date = '';
															}
															?>
															<input type="text" id="tanggal" name="dates" placeholder="Masukan Range Tanggal" class="form-control input-sm" autocomplete="off" style="text-align: center;" value="<?php echo $date ?>">
															<input type="hidden" id="start_date" name="start_date" value="<?= $start_date ?>">
															<input type="hidden" id="end_date" name="end_date" value="<?= $end_date ?>">
														</div>
													</div>
												</div>

												<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
													<!-- <div class="kt-form__group kt-form__group--inline"> -->
													<button type="button" class="btn btn-primary col-md-5" onclick="search();">
														<i class="fa fa-search"></i> Cari Data Laporan
													</button>
													&nbsp;
													<button type="button" class="btn btn-primary col-md-5" onclick="excel();">
														<i class="fa fa-file-excel"></i> Export ke Excel
													</button>
													<!-- </div> -->
												</div>

												<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
													<!-- search box -->
													<div class="kt-input-icon kt-input-icon--left">
														<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="txtSearch">
														<span class="kt-input-icon__icon kt-input-icon__icon--left">
															<span><i class="la la-search"></i></span>
														</span>
													</div>
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

						<div class="kt-portlet kt-portlet--mobile">

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
		$(document).ready(function() {
			$(function() {
				$('input[name="dates"]').daterangepicker({
					autoUpdateInput: false,
					locale: {
						cancelLabel: 'Clear'
					}
				});
				$('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
					$(this).val(picker.startDate.format('D MMM YYYY') + '   s.d.   ' + picker.endDate.format('D MMM YYYY'));
					$('#start_date').val(picker.startDate.format('YYYY-MM-DD'));
					$('#end_date').val(picker.endDate.format('YYYY-MM-DD'));
				});

				$('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
					$(this).val('');
					$('#start_date').val(null);
					$('#end_date').val(null);
				});
			});
		});

		// === change radio button selection ===
		$(".report_type_class").change(function() {
			if (document.getElementById('report_type_1').checked == true) {
				document.getElementById('tipe').value = '0';
			} else if (document.getElementById('report_type_2').checked == true) {
				document.getElementById('tipe').value = '1';
			} else if (document.getElementById('report_type_3').checked == true) {
				document.getElementById('tipe').value = '2';
			}
		});

		// === change lokasi ===
		$("#lokasi").change(function() {
			let lokasi = $('#lokasi').find(":selected").val();

			if (lokasi == 52) {
				$.ajax({
					url: '<?php echo base_url("admin/laporan_pegawai_update_data/load_sub_dinas") ?>',
					dataType: 'json',
					type: 'post',
					success: function(response) {
						const len = response.length;
						if (len > 0) {
							$('#sublokasi').find('option').remove().end();
							$('#sublokasi').append('<option value="0">Semua Sub Lokasi Kerja</option>');
							let selected = '';
							const sublokasi_post = "<?php echo $this->input->post('sublokasi') ?>";

							for (var i = 0; i < len; i++) {
								if (sublokasi_post == response[i]['id_lokasi_kerja']) {
									selected = 'selected = selected';
								} else {
									selected = '';
								}
								$("#sublokasi").append("<option value=" + response[i]['id_lokasi_kerja'] + " " + selected + ">" + response[i]['lokasi_kerja'] + "</option>");
							}
							// $('#sublokasi').val(0);
						}
					},
					error: function(x, e) {
						// 
					}

				});
			} else if (lokasi == 0) {
				$('#sublokasi').find('option').remove().end();
				$('#sublokasi').append('<option value="0">Semua Sub Lokasi Kerja</option>');
				// $('#sublokasi').val(0);
			} else {
				$('#sublokasi').find('option').remove().end();
				$('#sublokasi').append('<option value="">-</option>');
				// $('#sublokasi').val('');
			}
		});
		$("#lokasi").change();

		// === change sublokasi ===
		$("#sublokasi").change(function() {
			$("#sublokasi_id").val($("#sublokasi").val());
		});

		function grafikUpdateData() {
			// console.log('<?= $this->input->post('lokasi') ?>');
			// console.log('<?= $this->input->post('sublokasi') ?>');
			// console.log('<?= $this->input->post('start_date') ?>');
			// console.log('<?= $this->input->post('end_date') ?>');
			$.ajax({
				url: "<?= site_url('admin/laporan_pegawai_update_data/grafik_update_data') ?>",
				method: "post",
				data: {
					lokasi: '<?= $this->input->post('lokasi') ?>',
					sublokasi: '<?= $this->input->post('sublokasi') ?>',
					start_date: '<?= $this->input->post('start_date') ?>',
					end_date: '<?= $this->input->post('end_date') ?>',
				},
				success: (data) => {
					$('#grafik_update_data').html(data);
				}
			});
		}
		grafikUpdateData();
	</script>
</body>