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
											<?php echo $page_name; ?> <small>untuk <?php echo $surat->nama; ?></small>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="javascript:;" onclick="backSuratKeterangan('');" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div>
									</div>
								</div>
								<?php echo form_open_multipart("admin/surat_keterangan/simpan", 'name="frmSuratKeterangan" id="frmSuratKeterangan" method="post"'); ?>
								<input type="hidden" name="id_surat" id="id_surat" value="<?php echo (isset($surat->id_srt) ? $surat->id_srt : 0); ?>" />
								<input type="hidden" name="id_user" id="id_user" value="<?php echo (isset($surat->id_user) ? $surat->id_user : 0); ?>" />

								<div class="kt-portlet__body">
									<div class="row">
										<div class="col-lg-12">
											<div class="kt-form">
												<div class="kt-portlet__body">
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">Nama Pegawai</label>
														<div class="col-9">
															<span class="form-control-plaintext"><?php echo $surat->nama; ?></span>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">NIP</label>
														<div class="col-9">
															<span class="form-control-plaintext"><?php echo $surat->nip; ?></span>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">NRK</label>
														<div class="col-9">
															<span class="form-control-plaintext"><?php echo $surat->nrk; ?></span>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">Status Pegawai</label>
														<div class="col-9">
															<span class="form-control-plaintext"><?php echo $surat->nama_status; ?></span>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">Alamat Domisili</label>
														<div class="col-9">
															<span class="form-control-plaintext"><?php echo $surat->alamat_domisili; ?></span>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">Keperluan</label>
														<div class="col-9">
															<span class="form-control-plaintext">
																<?php
																echo $surat->jenis_pengajuan;
																if ($surat->jenis_pengajuan_surat == 'X') {
																	echo " (" . $surat->jenis_pengajuan_surat_lainnya . ")";
																}
																?>
															</span>
															<a href="javascript:;" onclick="ubah_keperluan('<?php echo $surat->id_srt; ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah Keperluan</a>
														</div>
													</div>
													<div class="form-group form-group-xs row">
														<label class="col-3 col-form-label kt-font-bolder">Status Surat</label>
														<div class="col-9">
															<span class="form-control-plaintext"><?php echo $surat->status_surat; ?></span>
														</div>
													</div>
													<?php
													//jika ditolak, maka tampilkan alasan ditolak
													if ($surat->id_status_srt == 1 || $surat->id_status_srt == 24 || $surat->id_status_srt == 25 || $surat->id_status_srt == 26 || $surat->id_status_srt == 28) {
														?>
														<div class="form-group form-group-xs row">
															<label class="col-3 col-form-label kt-font-bolder">Alasan Ditolak</label>
															<div class="col-9">
																<span class="form-control-plaintext"><?php echo $surat->keterangan_ditolak; ?></span>
															</div>
														</div>
														<?php
														} else {
															// jika diterima basah
															if ($surat->select_ttd == 'basah') {

																if ($surat->id_status_srt == 2 || $surat->id_status_srt == 3 || $surat->id_status_srt == 23 || $surat->id_status_srt == 27) {
																	//sudah pernah download
																	?>
																<div class="form-group form-group-xs row">
																	<label class="col-3 col-form-label kt-font-bolder">File</label>
																	<div class="col-9">
																		<span class="form-control-plaintext">
																			<?php
																						if ($surat->file_name == '' || $surat->file_name == null) {
																							echo '<input type="file" name="srt" id="srt" class="form-control" />';
																						} else {
																							// echo '<a href="javascript:;" onclick="download_surat_finished('.$surat->id_srt.')">'.$surat->file_name_ori.' <i class="flaticon-download"></i></a>';
																							echo '<input type="file" name="srt" id="srt" class="form-control" />';
																						}
																						?>
																		</span>
																	</div>
																</div>
															<?php } ?>
														<?php } else { ?>

															<?php if ($surat->id_status_srt == 3 || $surat->id_status_srt == 23) { ?>

																<div class="form-group form-group-xs row">
																	<label class="col-3 col-form-label kt-font-bolder">File</label>
																	<div class="col-9">
																		<span class="form-control-plaintext">
																			<?php
																						echo '<a href="javascript:;" onclick="download_surat_digital(' . $surat->id_srt . ')" class="btn btn-danger btn-sm"><i class="flaticon-download"></i> Download Surat</a>';
																						?>
																		</span>
																	</div>
																</div>
															<?php } ?>

														<?php } ?>
														<!-- end jika basah -->
													<?php } ?>
													<!-- end jika basah -->
													<!-- start timeline -->
													<?php
													echo '<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="history" data-ktwizard-state="step-first">';
													echo '<div class="kt-grid__item">';
													echo '<div class="kt-wizard-v1__nav">';
													//echo '<div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">';
													echo '<div class="kt-wizard-v1__nav-items">';
													$i = 1;
													foreach ($Query_history as $hist) {
														$active = '';
														$txt = '';
														$download_file = '';

														if ($hist->id_status_srt == $surat->id_status_srt) {
															$active = 'current';
														} else {
															$active = '';
														}
														// if($hist->id_status_srt=='2' || $hist->id_status_srt=='23'){ //sedang diproses
														// 	$download_file .= '<a href="javascript:;" onclick="download_surat('.$surat->id_srt.')" class="btn btn-danger btn-sm"><i class="flaticon-download"></i> Download Surat</a>&nbsp;&nbsp;';
														// }

														// if($hist->id_status_srt=='3' AND $surat->select_ttd=='digital'){ //sedang diproses
														// 	$download_file .= '';
														// }

														if ($surat->select_ttd == 'basah') {

															if ($hist->id_status_srt == '2' || $hist->id_status_srt == '23' || $hist->id_status_srt == '27') { //sedang diproses
																$download_file .= '<a href="javascript:;" onclick="download_surat(' . $surat->id_srt . ')" class="btn btn-danger btn-sm"><i class="flaticon-download"></i> Download Surat</a>&nbsp;&nbsp;';
															}

															if ($hist->id_status_srt == '3') { //sedang diproses
																$download_file .= '<a href="javascript:;" onclick="download_surat_finished(' . $surat->id_srt . ')">Download Surat Final <i class="flaticon-download"></i></a>';
															}
														} else {

															if ($hist->id_status_srt == '3' and $surat->select_ttd == 'digital') { //sedang diproses
																$download_file .= '';
															}
														}


														echo '<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
																		<div class="kt-wizard-v1__nav-body">
																			<div class="kt-wizard-v1__nav-icon"><i class="' . $hist->style . '"></i></div>
																			<div class="kt-wizard-v1__nav-label">' . $hist->nama_status . '</div>
																			<div class="kt-wizard-v2__nav-label-desc">' . $hist->nama_lengkap . '<br />' . $hist->created_at . '</div><br>' . $download_file . '
																		</div>
																	</div>';

														$i++;
													}

													echo '</div>';
													echo '</div>';
													echo '</div>';
													echo '</div>';

													?>
													<!-- end:timeline -->
												</div>

												<div class="kt-portlet__foot" align="center">
													<div class="kt-form__actions kt-space-between"></div>
													<div class="row" align="center">
														<div class="col-lg-12" align="center">
															<?php
															if ($surat->id_status_srt == 0 || $surat->id_status_srt == 25 || $surat->id_status_srt == 28) {
																//menunggu
																//echo '<button type="button" id="btnProses" class="btn btn-brand"><i class="flaticon-notes"></i> Proses</button>&nbsp;&nbsp;';
																echo '<a href="javascript:;" onclick="proses_data(' . $surat->id_srt . ')" class="btn btn-brand"><i class="flaticon-notes"></i> Proses Data</a>&nbsp;&nbsp;';
															} else if ($surat->id_status_srt == 2 || $surat->id_status_srt == 3 || $surat->id_status_srt == 23 || $surat->id_status_srt == 27) {
																if ($surat->select_ttd == 'basah') {
																	echo '<button type="button" id="btnProsesUpload" class="btn btn-brand"><i class="flaticon-upload-1"></i> Simpan Upload</button>&nbsp;&nbsp;';
																} else {
																	echo '';
																}
															}

															?>
															<a href="javascript:;" onclick="backSuratKeterangan('');" class="btn btn-clean"><i class="flaticon2-cross"></i>Batal<a>
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
	<script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/surat_keterangan_detail.js" type="text/javascript"></script>
	<!-- end script page -->

</body>
<script>
	// prosesdata surat keterangan
	function proses_data(Id) {
		save_method = 'verifikasi';
		$.ajax({
			url: "<?php echo site_url('admin/Surat_keterangan/form_verifikasi'); ?>",
			type: "POST",
			data: {
				Id: Id
			},
			success: function(data) {
				$('#modal_all_small .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('#modal_all_small').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Varifikasi Pengajuan Surat'); // Set Title to Bootstrap modal title
		//alert('a');
	}

	function batal_form() {
		$('#modal_all_small').modal('hide');
	}

	function batal_form_md() {
		$('#modal_all_medium').modal('hide');
	}

	function simpan_pengajuan() {
		var formData = new FormData($('#form_pengajuan')[0]);
		var url;
		url = "<?php echo site_url('admin/Surat_keterangan/processSave'); ?>";

		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				let url_cook = getCookie('url');
				$('#modal_all_small').modal('hide');
				const result = JSON.parse(response);
				if (result.status == true) {
					swal.fire({
						type: 'success',
						title: 'Data berhasil disimpan!',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(function() {
						let frm = $('#frmSuratKeterangan');
						frm.attr('action', url_cook + 'admin/Surat_keterangan/detail');
						frm.attr('method', 'post');

						frm.submit();
					}, 1000);
				} else {
					alert('Gagal');
				}
			}
		});
	}

	function simpan_perubahan_keperluan() {
		var formData = new FormData($('#form_ubah_keperluan')[0]);
		var url;
		url = "<?php echo site_url('admin/Surat_keterangan/simpan_ubah_keperluan'); ?>";

		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				let url_cook = getCookie('url');
				$('#modal_all_medium').modal('hide');
				const result = JSON.parse(response);
				if (result.status == true) {
					swal.fire({
						type: 'success',
						title: 'Data berhasil disimpan!',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(function() {
						let frm = $('#frmSuratKeterangan');
						frm.attr('action', url_cook + 'admin/Surat_keterangan/detail');
						frm.attr('method', 'post');

						frm.submit();
					}, 1000);
				} else {
					alert('Gagal');
				}
			}
		});
	}

	function ubah_keperluan(Id) {
		save_method = 'ubah_keperluan';
		$.ajax({
			url: "<?php echo site_url('admin/Surat_keterangan/form_ubah_keperluan'); ?>",
			type: "POST",
			data: {
				Id: Id
			},
			success: function(data) {
				$('#modal_all_medium .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('#modal_all_medium').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Ubah Keperluan'); // Set Title to Bootstrap modal title
		//alert('a');
	}
</script>

<div class="modal fade" id="modal_all_small" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="font-family: Source Sans Pro, sans-serif;">Modal Header</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer" hidden="true">
				<button type="button" class="btn btn-success btn-flat btn-sm" onClick="simpan()">
					<span class="fa fa-ok" aria-hidden="true"></span> Simpan
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_all_medium" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="font-family: Source Sans Pro, sans-serif;">Modal Header</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer" hidden="true">
				<button type="button" class="btn btn-success btn-flat btn-sm" onClick="simpan()">
					<span class="fa fa-ok" aria-hidden="true"></span> Simpan
				</button>
			</div>
		</div>
	</div>
</div>