<?php headAdminHtml(); ?>

<!-- css badge status -->
<style type="text/css">
		.badge-status {
			cursor: pointer;
			padding: 5px 20px;
			font-weight: normal;
		}
	</style>

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
								<?php echo form_open("admin/surat_keterangan", 'name="frmSuratKeterangan" id="frmSuratKeterangan" method="post"'); ?>
								<input type="hidden" name="id_surat" id="id_surat" />
								<div class="kt-portlet__body">
									<!--begin: Search Form -->
									<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
										<div class="row align-items-center">
											<div class="col-xl-12 order-2 order-xl-1">
												<div class="row align-items-center">
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-form__group kt-form__group--inline">
															<div class="kt-form__label">
																<label>Nama&nbsp;Pegawai&nbsp;:</label>
															</div>
															<div class="kt-form__control">
																<input class="form-control" type="text" name="nama_pegawai" id="nama_pegawai" placeholder="Masukkan nama pegawai" value="<?php echo $nama_pegawai; ?>" />
															</div>
														</div>
													</div>
													<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-form__group kt-form__group--inline">
															<div class="kt-form__label">
																<label>Status&nbsp;:</label>
															</div>
															<div class="kt-form__control">
																<select class="form-control bootstrap-select" name="id_status_surat" id="id_status_surat">
																	<option value="x">Semua Status</option>
																	<?php
																	foreach ($arrStatus as $key => $ars) {
																		echo '<option value="' . $key . '" ' . $arrStatusSelected[$key] . '>' . $ars . '</option>';
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-5 kt-margin-b-20-tablet-and-mobile">
														<button type="button" class="btn btn-primary" onclick="search();">
															<i class="fa fa-search"></i> Cari
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
									<div class="kt-datatable" id="tblSuratKeterangan"></div>
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
	<script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/surat_keterangan.js" type="text/javascript"></script>
	<!-- end script page -->

	<script type="text/javascript">
		function tutup_form() {
			$('#modal_all').modal('hide');
		}

		// begin: progress timeline joe 2022.11.17
		function showTimeline(id_srt) {
			$.ajax({
				url: "<?php echo site_url('admin/surat_keterangan/show_timeline'); ?>",
				type: "POST",
				data: {
					id_srt: id_srt
				},
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Perjalanan Pengajuan Surat Keterangan Pegawai'); // Set Title to Bootstrap modal title
		}
		// end: progress timeline joe 2022.11.17
	</script>

</body>

<div class="modal fade" id="modal_all" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="font-family: Source Sans Pro, sans-serif;font-family: system-ui;color: antiquewhite;">
					Modal Header
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<!-- <span aria-hidden="true"><i class="fa fa-times"></i></span> -->
				</button>
			</div>
			<div class="modal-body">
			</div>
			<!-- <div class="modal-footer" hidden="true">
				<button type="button" class="btn btn-success btn-flat btn-sm" onClick="simpan()">
					<span class="fa fa-ok" aria-hidden="true"></span> Simpan
				</button>
			</div> -->
		</div>
	</div>
</div>