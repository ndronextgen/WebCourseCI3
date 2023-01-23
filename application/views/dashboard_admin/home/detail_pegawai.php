<?php headAdminHtml(); ?>

<script src="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.css" media="screen" />

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin();
	?>
	<style type="text/css">
		.modal-dialogs {
			margin: 0;
			/* position: absolute; */
			/* left: 50%;
			top: 50%; */
			/* transform: translate(-50%, -50%); */

		}

		.modal-dialog,
		.modal-content {
			/* 80% of window height */
			height: 95%;
			width: 98% !important;
		}

		.modal-body {
			/* 100% = dialog height, 120px = header + footer */
			max-height: calc(100% - 120px);
			overflow-y: scroll;
		}

		#mapKoordinatadd {
			padding: 0;
			margin: 0;
			height: 100%;
			width: 100%;
		}

		#mapKoordinatview {
			padding: 0;
			margin: 0;
			height: 100%;
			width: 100%;
		}

		h6 {
			text-decoration: underline;
		}
	</style>
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<?php menuAdmin(); ?>

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
											<a href="<?php echo base_url(); ?>admin/dashboard_admin" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
											&nbsp;
											<a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $id_param; ?>" class="btn btn-brand btn-icon-sm">
												<i class="flaticon-edit-1"></i> Ubah Data
											</a>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="row">
										<div class="col-lg-12">

											<!--begin::Portlet-->
											<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
												<div class="kt-portlet__head kt-portlet__head--lg">
													<div class="kt-portlet__head-toolbar">
														<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
															<li class="nav-item">
																<a class="nav-link active" data-toggle="tab" href="#tabs_data_pegawai" role="tab"><i class="flaticon-list-1"></i> Data Pegawai</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_dokumen_pribadi" role="tab"><i class="flaticon-folder"></i> Dokumen Pribadi</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_sk_gubernur" role="tab"><i class="flaticon-folder"></i> Dokumen SK Pribadi</a>
															</li>

															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_group_pendidikan" role="tab"><i class="flaticon-folder"></i> Dokumen Pendidikan</a>
															</li>

															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_skp" role="tab"><i class="flaticon-folder"></i> Dokumen SKP / DP3 </a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_penghargaan" role="tab"><i class="flaticon-folder"></i> Penghargaan </a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_tubel" role="tab"><i class="flaticon-folder"></i> Tugas & Izin Belajar </a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_hukuman" role="tab"><i class="flaticon-folder"></i> Hukuman </a>
															</li>
														</ul>
													</div>
												</div>

												<div class="kt-portlet__body">
													<div class="tab-content">
														<div class="tab-pane active" id="tabs_data_pegawai" role="tabpanel">
															<div class="row">
																<div class="col-md-6">
																	<div class="kt-avatar kt-avatar--outline" id="kt_contacts_add_avatar">
																		<!-- <div class="kt-avatar__holder" style="background-image: url('<?php echo $foto; ?>')"></div> -->
																		<a data-fancybox="images" href="<?php echo str_replace('thumb', '', $foto); ?>" target="_blank">
																			<img width="100px" src="<?php echo $foto; ?>">
																		</a>
																	</div>

																	<div class="kt-form kt-form--label-right">
																		<div class="kt-portlet__body">
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Nama Pegawai</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_pegawai; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Gelar</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $gelar; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">NIP</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nip; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">NRK</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nrk; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Email</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $email; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Telepon</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $telepon; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Jenis Kelamin</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $jenis_kelamin; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Tempat Lahir</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $tempat_lahir; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Tanggal Lahir</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo date_format(date_create($tanggal_lahir), 'd M Y'); ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Agama</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $agama; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Status Nikah</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $status_nikah; ?></span>
																				</div>
																			</div>

																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Pendidikan Terakhir</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $pendidikan; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Pendidikan Terverifikasi BKD</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $pendidikan_bkd; ?></span>
																				</div>
																			</div>

																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Tanda Tangan Digital</label>
																				<div class="col-8">
																					<div class="kt-avatar kt-avatar--outline" id="kt_contacts_add_avatar">
																						<div class="kt-avatar__holder" style="background-image: url('<?php echo $signature; ?>'); background-size: 100% 100%; "></div>
																					</div>
																				</div>
																			</div>


																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="kt-form kt-form--label-right">
																		<div class="kt-portlet__body">
																			<div class="kt-heading kt-heading--md">Alamat Domisili :</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Provinsi</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_provinsi; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Kab/ Kota</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_kabupaten; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Kecamatan</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_kecamatan; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Kelurahan</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_kelurahan; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Alamat</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $alamat; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Koordinat Alamat Domisili (Latitude & Longitude)</label>
																				<div class="input-group col-8">
																					<div class="row align-items-center col-lg-12">
																						<div class="col-sm-7">
																							<span class="form-control-plaintext"><?php echo ($latitude != '' ? $latitude . '<br />' . $longitude : ''); ?></span>
																						</div>
																						<div class="col-sm-5">
																							<?php
																							if ($latitude != '' && $longitude != '') {
																								?>
																								<button type="button" class="btn btn-primary btn-sm" onclick="view_coordinate(<?php echo $latitude; ?>,<?php echo $longitude; ?>);"><i class="flaticon-placeholder" style="color:#ffffff;"></i> Lihat Peta</button>
																							<?php
																							}
																							?>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="kt-heading kt-heading--md">Alamat KTP :</div>
																			<div class="form-group form-group-xs row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Provinsi</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_provinsi_ktp; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Kab/ Kota</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_kabupaten_ktp; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Kecamatan</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_kecamatan_ktp; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Kelurahan</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_kelurahan_ktp; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Alamat</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $alamat_ktp; ?></span>
																				</div>
																			</div>

																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Status Pegawai</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_status_pegawai; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Golongan</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $golongan; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">TMT Pangkat Terakhir</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo date_format(date_create($tanggal_mulai_pangkat), 'd M Y'); ?></span>
																				</div>
																			</div>

																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Status Jabatan</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $status_jabatan; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Eselon</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $eselon; ?></span>
																				</div>
																			</div>
																			<?php
																			if ($id_status_jabatan == 6) {
																				?>
																				<div class="form-group form-group-xs row">
																					<label class="col-4 col-form-label kt-font-bolder">Rumpun Jabatan</label>
																					<div class="col-8">
																						<span class="form-control-plaintext"><?php echo $nama_rumpun_jabatan; ?></span>
																					</div>
																				</div>
																			<?php
																			}
																			?>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Nama Jabatan</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $jabatan; ?></span>
																				</div>
																			</div>
																			<div class="form-group form-group-xs row">
																				<label class="col-4 col-form-label kt-font-bolder">Unit/Satuan Kerja</label>
																				<div class="col-8">
																					<span class="form-control-plaintext"><?php echo $nama_lokasi_kerja; ?></span>
																				</div>
																			</div>
																			<?php if ($lokasi_kerja == '52') { ?>
																				<div class="form-group form-group-xs row">
																					<label class="col-4 col-form-label kt-font-bolder">Sub Unit/Satuan Kerja</label>
																					<div class="col-8">
																						<span class="form-control-plaintext"><?php echo $nama_sublokasi_kerja; ?></span>
																					</div>
																				</div>
																			<?php } ?>
																			<?php if ($id_eselon > 28 or $id_status_jabatan != '2') { ?>
																				<div class="form-group form-group-xs row">
																					<label class="col-4 col-form-label kt-font-bolder">Seksi / Subbag / Satlak</label>
																					<div class="col-8">
																						<span class="form-control-plaintext"><?php echo $sub_lokasi_kerja; ?></span>
																					</div>
																				</div>
																			<?php } ?>
																		</div>
																	</div>
																</div>
															</div>

															<div class="kt-portlet__foot">
																<div class="kt-form__actions kt-space-between">
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tabs_dokumen_pribadi" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Keluarga</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Keluarga', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Keluarga</a>

																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPribadiSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblKeluarga"></div>
																<!--end: Datatable -->

																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Pribadi Lainnya</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('ArsipLainnya', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Dokumen Pribadi Lainnya</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPribadiLainnyaSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPribadiLainnya"></div>
																<!--end: Datatable -->


															</div>
														</div>

														<div class="tab-pane" id="tabs_sk_gubernur" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Pangkat</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dpangkat', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Pangkat</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPangkatSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPangkat"></div>
																<!--end: Datatable -->

																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Jabatan</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Djabatan', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Jabatan</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblJabatanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblJabatan"></div>
																<!--end: Datatable -->

																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen SK Lainnya</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dsklainnya', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Dokumen SK Lainnya</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblSkLainnyaSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblSkLainnya"></div>
																<!--end: Datatable -->
															</div>
														</div>

														<div class="tab-pane" id="tabs_group_pendidikan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Pendidikan Formal</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dpendidikan', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Pendidikan</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPendidikanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPendidikan"></div>
																<!--end: Datatable -->

																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Pendidikan Non-Formal</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dpelatihan', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Pendidikan Non-Formal</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPelatihanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPelatihan"></div>
																<!--end: Datatable -->


															</div>
														</div>

														<div class="tab-pane" id="tabs_data_pangkat" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-8 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPangkatSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPangkat"></div>
																<!--end: Datatable -->

																<div class="row kt-margin-t-40 kt-margin-b-20" id="frmMorePangkat">
																	<a href="javascript:;" onclick="add_arsip('Pangkat');" class="btn btn-bold btn-sm btn-label-brand">
																		<i class="la la-plus"></i> Tambah Data Pangkat
																	</a>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_jabatan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-8 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblJabatanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblJabatan"></div>
																<!--end: Datatable -->

																<div class="row kt-margin-t-40 kt-margin-b-20" id="frmMorePangkat">
																	<a href="javascript:;" onclick="add_arsip('Jabatan');" class="btn btn-bold btn-sm btn-label-brand">
																		<i class="la la-plus"></i> Tambah Data Jabatan
																	</a>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_pendidikan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-8 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPendidikanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPendidikan"></div>
																<!--end: Datatable -->

																<div class="row kt-margin-t-40 kt-margin-b-20" id="frmMorePendidikan">
																	<a href="javascript:;" onclick="add_arsip('Pendidikan');" class="btn btn-bold btn-sm btn-label-brand">
																		<i class="la la-plus"></i> Tambah Data Pendidikan
																	</a>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_pelatihan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-8 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPelatihanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPelatihan"></div>
																<!--end: Datatable -->

																<div class="row kt-margin-t-40 kt-margin-b-20" id="frmMorePelatihan">
																	<a href="javascript:;" onclick="add_arsip('Pelatihan');" class="btn btn-bold btn-sm btn-label-brand">
																		<i class="la la-plus"></i> Tambah Data Pelatihan
																	</a>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_penghargaan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Penghargaan</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dpenghargaan', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Penghargaan</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblPenghargaanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblPenghargaan"></div>
																<!--end: Datatable -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_tubel" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Tugas & Izin Belajar</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dtubel', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Tugas & Izin Belajar</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblTubelSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblTubel"></div>
																<!--end: Datatable -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_skp" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen SKP / DP3</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dskp', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data SKP / DP3</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblSKPSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblSKP"></div>
																<!--end: Datatable -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_hukuman" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: Search Form -->
																<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
																	<div class="row align-items-center">
																		<div class="col-xl-12 order-2 order-xl-1">
																			<div class="row align-items-center">
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<h6># Dokumen Hukuman</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="download_all('Dhukuman', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-danger"><i class="la la-download"></i> Download Semua Data Hukuman</a>
																				</div>
																				<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
																					<div class="kt-input-icon kt-input-icon--left">
																						<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="tblHukumanSearch">
																						<span class="kt-input-icon__icon kt-input-icon__icon--left">
																							<span><i class="la la-search"></i></span>
																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end: Search Form -->
																<!--begin: Datatable -->
																<div class="kt-datatable" id="tblHukuman"></div>
																<!--end: Datatable -->
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
				<?php
				modalPegawai();
				footerAdmin();
				?>
			</div>
		</div>
	</div>

	<?php scrollTop(); ?>

	<!-- begin script global -->
	<script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<link rel="stylesheet" href="https://js.arcgis.com/4.21/esri/themes/light/main.css">
	<script src="https://js.arcgis.com/4.21/"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url() ?>assets_admin/js/global/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pribadilainnya.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/sklainnya.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/keluarga.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_keluarga.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pangkat.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_pangkat.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/jabatan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_jabatan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pendidikan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_pendidikan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pelatihan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_pelatihan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/penghargaan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_penghargaan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/tubel.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_tubel.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/skp.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_skp.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/hukuman.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/arsip_hukuman.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/map/mapKoordinatPegawai.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/global/modal.js" type="text/javascript"></script>
	<!-- end script page -->

	<script>
		function detail_data_arsip_next(type, Id) {
			save_method = 'update';
			$.ajax({
				type: "post",
				data: {
					Id: Id
				},
				url: "<?php echo site_url('/Arsip_pribadi/modal_arsip_pribadi_detail'); ?>",
				beforeSend: function(s) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
				},
				success: function(response) {
					$('#modal_all .modal-dialog').addClass('modalan');
					$('#modal_all .modal-dialog .modal-content .modal-body').html(response);
					$("#modal_all .modal-title").text("");
					$("#modal_all .modal-footer").addClass("hidden");
					$('#modal_all').modal('show'); // show bootstrap modal
				}

			});
		}

		function detail_data_sk_next(type, Id) {
			save_method = 'update';
			$.ajax({
				type: "post",
				data: {
					Id: Id
				},
				url: "<?php echo site_url('/Arsip_sk/modal_arsip_sk_detail'); ?>",
				beforeSend: function(s) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
				},
				success: function(response) {
					$('#modal_all .modal-dialog').addClass('modalan');
					$('#modal_all .modal-dialog .modal-content .modal-body').html(response);
					$("#modal_all .modal-title").text("");
					$("#modal_all .modal-footer").addClass("hidden");
					$('#modal_all').modal('show'); // show bootstrap modal
				}

			});
		}

		function download_all(param, Id) {

			if (param == "Keluarga") {
				var url = "<?php echo site_url('/Arsip_pribadi/download_all_adm_kel'); ?>/" + Id;
			} else if (param == "ArsipLainnya") {
				var url = "<?php echo site_url('/Arsip_pribadi/download_all_adm_arsip_pribadi'); ?>/" + Id;
			} else if (param == "Dpangkat") {
				var url = "<?php echo site_url('/Arsip_sklainnya/download_all_adm_pangkat'); ?>/" + Id;
			} else if (param == "Djabatan") {
				var url = "<?php echo site_url('/Arsip_sklainnya/download_all_adm_jabatan'); ?>/" + Id;
			} else if (param == "Dsklainnya") {
				var url = "<?php echo site_url('/Arsip_sklainnya/download_all_adm_sklainnya'); ?>/" + Id;
			} else if (param == "Dpendidikan") {
				var url = "<?php echo site_url('/Arsip_pendidikan/download_all_adm_pendidikan'); ?>/" + Id;
			} else if (param == "Dpelatihan") {
				var url = "<?php echo site_url('/Arsip_pelatihan/download_all_adm_pelatihan'); ?>/" + Id;
			} else if (param == "Dskp") {
				var url = "<?php echo site_url('/Arsip_skp/download_all_adm_skp'); ?>/" + Id;
			} else if (param == "Dtubel") {
				var url = "<?php echo site_url('/Tubel/download_all_adm_tubel'); ?>/" + Id;
			} else if (param == "Dpenghargaan") {
				var url = "<?php echo site_url('/Penghargaan/download_all_adm_penghargaan'); ?>/" + Id;
			} else if (param == "Dhukuman") {
				var url = "<?php echo site_url('/Arsip_hukuman/download_all_adm_hukuman'); ?>/" + Id;
			}

			$.ajax({
				type: "GET",
				url: url,
				success: function(s) {
					window.location.href = url;
				}
			});
		}
	</script>
</body>