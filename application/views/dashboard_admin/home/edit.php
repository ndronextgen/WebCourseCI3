<?php headAdminHtml(); ?>

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

		.avoid-clicks {
			pointer-events: none;
			/* background-color: #dbdbdb !important; */
			cursor: no-drop;
			border: 1px #858585 solid;
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
										<!-- <div class="kt-portlet__head-wrapper">
											<a href="<?php //echo base_url();
														?>admin/dashboard_admin" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div> -->
										<div class="kt-portlet__head-wrapper">
											<a href="<?php echo base_url(); ?>pegawai/detail/<?php echo $id_param; ?>" class="btn btn-clean btn-icon-sm">
												<i class="flaticon-user"></i>
												Detail Pegawai
											</a>
										</div>
										<div class="kt-portlet__head-wrapper">
											<a href="<?php echo base_url(); ?>admin/dashboard_admin" class="btn btn-clean btn-icon-sm">
												<i class="flaticon-home-2"></i>
												Home
											</a>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="row">
										<div class="col-lg-12">
											<?php
											if ($this->session->flashdata('msg')) {
												echo '<div class="alert alert-warning fade show" role="alert">
													<div class="alert-icon"><i class="flaticon-warning"></i></div>
													<div class="alert-text">' . $this->session->flashdata('msg') . '</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="la la-close"></i></span>
														</button>
													</div>
												</div>';
											}

											if ($this->session->flashdata('suksesedit')) {
												echo '<div class="alert alert-warning fade show" role="alert">
													<div class="alert-icon"><i class="flaticon-warning"></i></div>
													<div class="alert-text">' . $this->session->flashdata('suksesedit') . '</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="la la-close"></i></span>
														</button>
													</div>
												</div>';
											}

											if (validation_errors()) {
												echo '<div class="alert alert-danger fade show" role="alert">
													<div class="alert-icon"><i class="flaticon-warning"></i></div>
													<div class="alert-text">' . validation_errors() . '</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="la la-close"></i></span>
														</button>
													</div>
												</div>';
											}

											if ($this->session->flashdata('gagalupload')) {
												echo '<div class="alert alert-danger fade show" role="alert">
													<div class="alert-icon"><i class="flaticon-warning"></i></div>
													<div class="alert-text">' . $this->session->flashdata('gagalupload') . '</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="la la-close"></i></span>
														</button>
													</div>
												</div>';
											}

											if ($this->session->flashdata('gagalupload2')) {
												echo '<div class="alert alert-danger fade show" role="alert">
													<div class="alert-icon"><i class="flaticon-warning"></i></div>
													<div class="alert-text">' . $this->session->flashdata('gagalupload2') . '</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="la la-close"></i></span>
														</button>
													</div>
												</div>';
											}

											if ($this->session->flashdata('gagalupload4')) {
												echo '<div class="alert alert-danger fade show" role="alert">
													<div class="alert-icon"><i class="flaticon-warning"></i></div>
													<div class="alert-text">' . $this->session->flashdata('gagalupload4') . '</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="la la-close"></i></span>
														</button>
													</div>
												</div>';
											}
											?>
											<!--begin::Portlet-->
											<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
												<?php echo form_open_multipart(base_url() . 'pegawai/simpan', 'class="form-horizontal"'); ?>
												<input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
												<input type="hidden" name="st" value="<?php echo $st; ?>">
												<input type="hidden" name="old_file" value="<?php echo $old_foto; ?>">
												<input type="hidden" name="old_signature" value="<?php echo $old_signature; ?>">
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
															<div class="row" id="frmPegawai">
																<div class="col-md-6">
																	<div class="kt-form kt-form--label-right">
																		<div class="kt-portlet__body">
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Foto</label>
																				<div class="col-8">
																					<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_edit_foto">
																						<div class="kt-avatar__holder" style="background-image: url('<?php echo $foto; ?>');"></div>
																						<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ubah Foto">
																							<i class="fa fa-pen"></i>
																							<input type="file" name="foto" id="foto" accept=".png, .jpg, .jpeg, 'gif">
																						</label>
																						<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Batal">
																							<i class="fa fa-times"></i>
																						</span>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Nama Pegawai</label>
																				<div class="col-8">
																					<input class="form-control" name="nama_pegawai" id="nama_pegawai" type="text" placeholder="Nama pegawai" value="<?php echo $nama_pegawai; ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Gelar</label>
																				<div class="col-8">
																					<input class="form-control" name="gelar" id="gelar" type="text" placeholder="Gelar" value="<?php echo $gelar; ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">NIP</label>
																				<div class="col-8">
																					<input class="form-control" name="nip" id="nip" type="text" placeholder="NIP" value="<?php echo $nip; ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">NRK</label>
																				<div class="col-8">
																					<input class="form-control" name="nrk" id="nrk" type="text" placeholder="NRK" value="<?php echo $nrk; ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Email</label>
																				<div class="col-8">
																					<input class="form-control" name="email" id="email" type="text" placeholder="Email" value="<?php echo $email; ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Telepon</label>
																				<div class="col-8">
																					<input class="form-control" name="telepon" id="telepon" type="text" placeholder="Telepon" value="<?php echo $telepon; ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Jenis Kelamin</label>
																				<div class="col-8">
																					<?php
																					$laki = "";
																					$perempuan = "";
																					if (strtolower($jenis_kelamin) == "laki-laki") {
																						$laki = 'checked="checked"';
																						$perempuan = "";
																					} else if (strtolower($jenis_kelamin) == "perempuan") {
																						$laki = '';
																						$perempuan = 'checked="checked"';
																					}
																					?>
																					<div class="kt-radio-inline">
																						<label class="kt-radio">
																							<input type="radio" name="jenis_kelamin" value="Laki-Laki" <?php echo $laki; ?> /> Laki-Laki
																							<span></span>
																						</label>
																						<label class="kt-radio">
																							<input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo $perempuan; ?> /> Perempuan
																							<span></span>
																						</label>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Tempat Lahir</label>
																				<div class="col-8">
																					<input class="form-control" name="tempat_lahir" id="tempat_lahir" type="text" placeholder="Tempat lahir" value="<?php echo $tempat_lahir; ?>" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Tanggal Lahir</label>
																				<div class="col-8">
																					<div class="input-group date">
																						<input type="text" class="form-control" readonly placeholder="Pilih tanggal lahir" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo date_format(date_create($tanggal_lahir), 'd M Y'); ?>" placeholder="dd-mm-yyyy" />
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Agama</label>
																				<div class="col-8">
																					<?php
																					$islam = "";
																					$hindu = "";
																					$budha = "";
																					$protestan = "";
																					$katolik = "";
																					$konghucu = "";
																					$lainnya = "";
																					$kristen = "";
																					if ($agama == "Hindu") {
																						$islam = '';
																						$hindu = 'selected="selected"';
																						$budha = '';
																						$protestan = '';
																						$katolik = '';
																						$konghucu = '';
																						$lainnya = '';
																						$kristen = "";
																					} else if ($agama == "Budha") {
																						$islam = '';
																						$hindu = '';
																						$budha = 'selected="selected"';
																						$protestan = '';
																						$katolik = '';
																						$konghucu = '';
																						$lainnya = '';
																						$kristen = "";
																					} else if ($agama == "Kristen") {
																						$islam = '';
																						$hindu = '';
																						$budha = '';
																						$protestan = '';
																						$katolik = '';
																						$konghucu = '';
																						$lainnya = '';
																						$kristen = 'selected="selected"';
																					} else if ($agama == "Kristen Protestan") {
																						$islam = '';
																						$hindu = '';
																						$budha = '';
																						$protestan = 'selected="selected"';
																						$katolik = '';
																						$konghucu = '';
																						$kristen = "";
																						$lainnya = '';
																					} else if ($agama == "Kristen Katolik") {
																						$islam = '';
																						$hindu = '';
																						$budha = '';
																						$protestan = '';
																						$katolik = 'selected="selected"';
																						$konghucu = '';
																						$kristen = "";
																						$lainnya = '';
																					} else if ($agama == "Konghucu") {
																						$islam = '';
																						$hindu = '';
																						$budha = '';
																						$protestan = '';
																						$katolik = '';
																						$konghucu = 'selected="selected"';
																						$lainnya = '';
																						$kristen = "";
																					} else if ($agama == "Lainnya") {
																						$islam = '';
																						$hindu = '';
																						$budha = '';
																						$protestan = '';
																						$katolik = '';
																						$konghucu = '';
																						$lainnya = 'selected="selected"';
																						$kristen = "";
																					} else if ($agama == "Islam") {
																						$islam = 'selected="selected"';
																						$hindu = '';
																						$budha = '';
																						$protestan = '';
																						$katolik = '';
																						$konghucu = '';
																						$lainnya = '';
																						$kristen = "";
																					}
																					?>
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="agama" id="agama">
																							<option value="">Pilih Agama</option>
																							<option value="Islam" <?php echo $islam; ?>>Islam</option>
																							<option value="Hindu" <?php echo $hindu; ?>>Hindu</option>
																							<option value="Budha" <?php echo $budha; ?>>Budha</option>
																							<option value="Kristen" <?php echo $kristen; ?>>Kristen</option>
																							<option value="Kristen Protestan" <?php echo $protestan; ?>>Kristen Protestan</option>
																							<option value="Kristen Katolik" <?php echo $katolik; ?>>Kristen Katolik</option>
																							<option value="Konghucu" <?php echo $konghucu; ?>>Konghucu</option>
																							<option value="Lainnya" <?php echo $lainnya; ?>>Lainnya</option>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Status Nikah</label>
																				<div class="col-8">
																					<?php
																					$belum_nikah = "";
																					$sudah_nikah = "";
																					$duda_janda = '';
																					if ($status_nikah == "Belum Menikah") {
																						$belum_nikah = 'checked="checked"';
																						$sudah_nikah = "";
																						$duda_janda = '';
																					} else if ($status_nikah == "Sudah Menikah") {
																						$belum_nikah = '';
																						$sudah_nikah = 'checked="checked"';
																						$duda_janda = '';
																					} else if ($status_nikah == "Duda/Janda") {
																						$belum_nikah = '';
																						$sudah_nikah = '';
																						$duda_janda = 'checked="checked"';
																					}
																					?>
																					<div class="kt-radio-inline">
																						<label class="kt-radio">
																							<input type="radio" name="status_nikah" value="Belum Menikah" <?php echo $belum_nikah; ?> /> Belum Menikah
																							<span></span>
																						</label>
																						<label class="kt-radio">
																							<input type="radio" name="status_nikah" value="Sudah Menikah" <?php echo $sudah_nikah; ?> /> Sudah Menikah
																							<span></span>
																						</label>
																						<label class="kt-radio">
																							<input type="radio" name="status_nikah" value="Duda/Janda" <?php echo $duda_janda; ?> /> Duda/Janda
																							<span></span>
																						</label>
																					</div>
																				</div>
																			</div>

																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Pendidikan Terakhir</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="pendidikan" id="pendidikan">
																							<option value="">Pilih Pendidikan</option>
																							<?php
																							foreach ($mst_pendidikan->result_array() as $mp) {
																								$selected = '';
																								if ($mp['nama_pendidikan'] == $pendidikan) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $mp['nama_pendidikan']; ?>" <?php echo $selected; ?>><?php echo $mp['nama_pendidikan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Pendidikan Terverifikasi BKD</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="pendidikan_bkd" id="pendidikan_bkd">
																							<option value="">Pilih Pendidikan Terverifikasi BKD</option>
																							<?php
																							foreach ($mst_pendidikan->result_array() as $mp) {
																								$selected = '';
																								if ($mp['nama_pendidikan'] == $pendidikan_bkd) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $mp['nama_pendidikan']; ?>" <?php echo $selected; ?>><?php echo $mp['nama_pendidikan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Tanda Tangan Digital(*.png)</label>
																				<div class="col-6">
																					<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_edit_signature">
																						<div class="kt-avatar__holder" id='signature_pic' style="background-image: url('<?php echo $signature; ?>'); width:250px; height:150px; background-size: 100% 100%;"></div>
																						<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ubah Tanda Tangan Digital">
																							<i class="fa fa-pen"></i>
																							<input type="file" name="signature" id="signature" accept=".png">
																						</label>
																						<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Batal">
																							<i class="fa fa-times"></i>
																						</span>
																					</div>
																				</div>
																				<!-- <div class="col-1">
																					<input type='hidden' id='dig_signature' name='dig_signature' value=''>
																					<button title="signature" class="btn btn-success btn-sm" id="signature" type="button" onclick="getsignature('<?php //echo $id_param; 
																																																	?>')"><i class="flaticon-list-1"></i></button>
																				</div> -->
																			</div>


																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="kt-form kt-form--label-right">
																		<div class="kt-portlet__body">

																			<div class="kt-heading kt-heading--md">Alamat Domisili :</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Provinsi</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_provinsi" id="kode_provinsi">
																							<option value="">Pilih Provinsi</option>
																							<?php
																							foreach ($mst_provinsi->result_array() as $me) {
																								$selected = '';
																								if ($kode_provinsi == $me['kode_provinsi'])
																									$selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['kode_provinsi']; ?>" <?php echo $selected; ?>><?php echo $me['nama_provinsi']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_provinsi" id="nama_provinsi" value="<?php echo $nama_provinsi; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Kab/ Kota</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kabupaten" id="kode_kabupaten">
																							<option value="">Pilih Kab/ Kota</option>
																							<?php
																							foreach ($mst_kabupaten->result_array() as $me) {
																								$selected = '';
																								if ($kode_kabupaten == $me['kode_kabupaten'])
																									$selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['kode_kabupaten']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kabupaten']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kabupaten" id="nama_kabupaten" value="<?php echo $nama_kabupaten; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Kecamatan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kecamatan" id="kode_kecamatan">
																							<option value="">Kecamatan</option>
																							<?php
																							foreach ($mst_kecamatan->result_array() as $me) {
																								$selected = '';
																								if ($kode_kecamatan == $me['kode_kecamatan'])
																									$selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['kode_kecamatan']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kecamatan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kecamatan" id="nama_kecamatan" value="<?php echo $nama_kecamatan; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Kelurahan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kelurahan" id="kode_kelurahan">
																							<option value="">Pilih Kelurahan</option>
																							<?php
																							foreach ($mst_kelurahan->result_array() as $me) {
																								$selected = '';
																								if ($kode_kelurahan == $me['kode_kelurahan'])
																									$selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['kode_kelurahan']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kelurahan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kelurahan" id="nama_kelurahan" value="<?php echo $nama_kelurahan; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Alamat</label>
																				<div class="col-8">
																					<textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Koordinat Alamat Domisili (Latitude & Longitude)</label>
																				<div class="input-group col-8">
																					<div class="row align-items-center col-lg-12">
																						<div class="col-sm-7">
																							<input type="hidden" id="pid" name="pid" placeholder="pid">
																							<input type="text" class="form-control form-control-sm" id="latitude" name="latitude" placeholder="latitude" value="<?php echo $latitude; ?>" readonly>
																							<input type="text" class="form-control form-control-sm" id="longitude" name="longitude" placeholder="longitude" value="<?php echo $longitude; ?>" readonly>
																						</div>
																						<div class="col-sm-5">
																							<button type="button" class="btn btn-primary btn-sm" onclick="add_coordinate();"><i class="flaticon-placeholder" style="color:#ffffff;"></i> Lihat Peta</button>
																						</div>
																					</div>
																				</div>
																			</div>




																			<div class="kt-heading kt-heading--md">
																				Alamat KTP :
																				<input id="is_check" name="is_check" type="checkbox" value="1" <?php echo $is_check; ?>>
																				<font size="1">Ceklist jika sama dengan alamat domisili </font>
																			</div>
																			<div class="form-group row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Provinsi</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_provinsi_ktp" id="kode_provinsi_ktp" <?php echo $onchangeProvinsiKtp; ?>>
																							<option value="">Pilih Provinsi</option>
																							<?php
																							foreach ($mst_provinsi->result_array() as $me) {
																								$selected = '';
																								if ($kode_provinsi_ktp == $me['kode_provinsi'])
																									$selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['kode_provinsi']; ?>" <?php echo $selected; ?>><?php echo $me['nama_provinsi']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_provinsi_ktp" id="nama_provinsi_ktp" value="<?php echo $nama_provinsi_ktp; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Kab/ Kota</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kabupaten_ktp" id="kode_kabupaten_ktp" <?php echo $onchangeKabupatenKtp; ?>>
																							<option value="">Pilih Kab/ Kota</option>
																							<?php
																							foreach ($mst_kabupaten_ktp->result_array() as $me) {
																								$selected = '';
																								if ($kode_kabupaten_ktp == $me['kode_kabupaten'])
																									$selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['kode_kabupaten']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kabupaten']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kabupaten_ktp" id="nama_kabupaten_ktp" value="<?php echo $nama_kabupaten_ktp; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Kecamatan</label>
																				<div class="col-8">
																					<select class="form-control kt-select2" name="kode_kecamatan_ktp" id="kode_kecamatan_ktp" <?php echo $onchangeKecamatanKtp; ?>>
																						<option value="">Pilih Kecamatan</option>
																						<?php
																						foreach ($mst_kecamatan_ktp->result_array() as $me) {
																							$selected = '';
																							if ($kode_kecamatan_ktp == $me['kode_kecamatan'])
																								$selected = 'selected="selected"';
																							?>
																							<option value="<?php echo $me['kode_kecamatan']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kecamatan']; ?></option>
																						<?php
																						}
																						?>
																					</select>
																					<input type="hidden" class="form-control" name="nama_kecamatan_ktp" id="nama_kecamatan_ktp" value="<?php echo $nama_kecamatan_ktp; ?>">
																				</div>
																			</div>
																			<div class="form-group row" style='display:none;'>
																				<label class="col-4 col-form-label kt-font-bolder">Kelurahan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kelurahan_ktp" id="kode_kelurahan_ktp" <?php echo $onchangeKelurahanKtp; ?>>
																							<option value="">Kelurahan</option>
																							<?php
																							foreach ($mst_kelurahan_ktp->result_array() as $me) {
																								$selected = '';
																								if ($kode_kelurahan_ktp == $me['kode_kelurahan'])
																									$selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['kode_kelurahan']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kelurahan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kelurahan_ktp" id="nama_kelurahan_ktp" value="<?php echo $nama_kelurahan_ktp; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Alamat</label>
																				<div class="col-8">
																					<textarea class="form-control" cols="3" name="alamat_ktp" id="alamat_ktp" placeholder="Alamat"><?php echo $alamat_ktp; ?></textarea>
																				</div>
																			</div>

																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Status Pegawai</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="status_pegawai" id="status_pegawai">
																							<option value="">Pilih Status Pegawai</option>
																							<?php
																							foreach ($mst_status_pegawai->result_array() as $mspg) {
																								$selected = '';
																								if ($status_pegawai == $mspg['id_status_pegawai']) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $mspg['id_status_pegawai']; ?>" <?php echo $selected; ?>><?php echo $mspg['nama_status']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Golongan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="id_golongan" id="id_golongan">
																							<option value="0">Pilih Golongan</option>
																							<?php
																							foreach ($mst_golongan->result_array() as $mg) {
																								$selected = '';
																								if ($id_golongan == $mg['id_golongan']) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $mg['id_golongan']; ?>" <?php echo $selected; ?>><?php echo $mg['golongan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">TMT Pangkat Terakhir</label>
																				<div class="col-8">
																					<div class="input-group date">
																						<input type="text" class="form-control" readonly placeholder="Pilih tanggal TMT" id="tanggal_mulai_pangkat" name="tanggal_mulai_pangkat" value="<?php echo date_format(date_create($tanggal_mulai_pangkat), 'd M Y'); ?>" placeholder="dd-mm-yyyy" />
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Status Jabatan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="id_status_jabatan" id="id_status_jabatan">
																							<option value="0">Pilih Status Jabatan</option>
																							<?php
																							foreach ($mst_status_jabatan as $mstsj) {
																								$selected = '';
																								if ($id_status_jabatan == $mstsj->id_status_jabatan) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $mstsj->id_status_jabatan; ?>" <?php echo $selected; ?>><?php echo $mstsj->nama_status_jabatan; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" id="grpEselon" <?php echo $show_eselon; ?>>
																				<label class="col-4 col-form-label kt-font-bolder">Eselon</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="id_eselon" id="id_eselon" placeholder="Eselon">
																							<option value="0">Pilih Eselon</option>
																							<?php
																							foreach ($mst_eselon->result_array() as $me) {
																								$selected = '';
																								if ($id_eselon == $me['id_eselon']) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $me['id_eselon']; ?>" <?php echo $selected; ?>><?php echo $me['nama_eselon']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" id="grpRumpunJabatan" <?php echo $show_rumpun_jabatan; ?>>
																				<label class="col-4 col-form-label kt-font-bolder">Rumpun Jabatan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="id_rumpun_jabatan" id="id_rumpun_jabatan">
																							<option value="0">Pilih Rumpun Jabatan</option>
																							<?php
																							foreach ($mst_rumpun_jabatan->result_array() as $rj) {
																								$selected = '';
																								if ($id_rumpun_jabatan == $rj['id_rumpun_jabatan']) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $rj['id_rumpun_jabatan']; ?>" <?php echo $selected; ?>><?php echo $rj['nama_rumpun_jabatan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" id="grpNamaJabatan" <?php echo $show_nama_jabatan; ?>>
																				<label class="col-4 col-form-label kt-font-bolder">Nama Jabatan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="id_jabatan" id="id_jabatan">
																							<option value="0">Pilih Nama Jabatan</option>
																							<?php
																							foreach ($mst_jabatan->result_array() as $mj) {
																								$selected = '';
																								if ($id_jabatan == $mj['id_nama_jabatan']) $selected = 'selected="selected"';
																								?>
																								<option value="<?php echo $mj['id_nama_jabatan']; ?>" <?php echo $selected; ?>><?php echo $mj['nama_jabatan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Unit/Satuan Kerja :</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="lokasi_kerja" id="lokasi_kerja">
																							<option value="0">Pilih Lokasi Kerja</option>
																							<?php
																							foreach ($master_lokasi_kerja as $d) {
																								echo "<option value='$d->id_lokasi_kerja'";
																								if ($d->id_lokasi_kerja == $lokasi_kerja) {
																									echo ' selected';
																								}
																								echo ">$d->lokasi_kerja</option>";
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" id="sublokasi">
																				<label class="col-4 col-form-label kt-font-bolder">(Sub) Unit/Satker :</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="sublokasi_kerja" id="sublokasi_kerja">
																							<option value="0">Pilih Sub Unit/Satuan Kerja</option>
																							<?php
																							foreach ($master_sublokasi_kerja as $d) {
																								echo "<option value='$d->id_lokasi_kerja'";
																								if ($d->id_lokasi_kerja == $sublokasi_kerja) {
																									echo ' selected';
																								}
																								echo ">$d->lokasi_kerja</option>";
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div id='grpseksi'>
																				<div class="form-group row">
																					<label class="col-4 col-form-label kt-font-bolder">Seksi / Subbag / Satlak</label>
																					<div class="col-8">
																						<div class="input-group flex-nowrap">
																							<select class="form-control kt-select2" name="seksi" id="seksi">
																								<option value="0">Pilih Seksi / Subbag / Satlak</option>
																								<?php
																								foreach ($mst_sub_lokasi_kerja->result_array() as $me) {
																									$selected = '';
																									if ($seksi == $me['id_sub_lokasi_kerja']) $selected = 'selected="selected"';
																									?>
																									<option value="<?php echo $me['id_sub_lokasi_kerja']; ?>" <?php echo $selected; ?>><?php echo $me['sub_lokasi_kerja']; ?></option>
																								<?php
																								}
																								?>
																							</select>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<div class="kt-form__actions kt-space-between"></div>
															<div class="row" align="center">
																<div class="col-lg-12" align="center">
																	<button type="submit" class="btn btn-brand"><i class="fa fa-save"></i> Simpan Data</button>
																	<a href="<?php echo base_url(); ?>admin/dashboard_admin" class="btn btn-secondary">
																		Batal
																	</a>
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
																					<a href="javascript:;" onclick="add_arsip('Keluarga');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Keluarga</a>
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
																					<a href="javascript:;" onclick="add_arsip_next('PribadiLainnya', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Dokumen Pribadi Lainnya</a>
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
																					<h6># Data Pangkat</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('Pangkat');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Pangkat</a>
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
																					<h6># Data Jabatan</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('Jabatan');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Jabatan</a>
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
																					<a href="javascript:;" onclick="add_sk_next('SkLainnya', '<?php echo $id_param; ?>');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Dokumen SK Lainnya</a>
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
																					<h6># Data Pendidikan</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('Pendidikan');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Pendidikan Formal</a>
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
																					<h6># Data Pendidikan Non-Formal</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('Pelatihan');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Pendidikan Non-Formal</a>
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
																	<a href="javascript:;" onclick="add_arsip('Pangkat');" class="btn btn-bold btn-sm btn-primary">
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
																					<h6># Data Penghargaan</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('Penghargaan');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Penghargaan</a>
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
																					<h6># Data Tugas & Izin Belajar</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('Tubel');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Tugas & Izin Belajar</a>
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
																					<h6># Data SKP / DP3</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('SKP');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data SKP / DP3</a>
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
																					<h6># Data Hukuman</h6>
																				</div>
																				<div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
																					<a href="javascript:;" onclick="add_arsip('Hukuman');" class="btn btn-bold btn-sm btn-primary"><i class="la la-plus"></i> Tambah Data Hukuman</a>
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

												<!-- <div class="kt-portlet__foot" align="center">
													<div class="kt-form__actions kt-space-between"></div>
													<div class="row" align="center">
														<div class="col-lg-12" align="center">
															<button type="submit" class="btn btn-brand"><i class="fa fa-save"></i> Simpan Data</button>
															<a href="<?php //echo base_url();
																		?>admin/dashboard_admin" class="btn btn-secondary">
																Batal
															</a>
														</div>
													</div>
												</div> -->
												<?php echo form_close(); ?>
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
				modalPegawai($id_pegawai);
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
	<!-- <link rel="stylesheet" href="https://js.arcgis.com/4.9/esri/css/main.css">
	<script src="https://js.arcgis.com/4.9/"></script> -->
	<link rel="stylesheet" href="https://js.arcgis.com/4.21/esri/themes/light/main.css">
	<script src="https://js.arcgis.com/4.21/"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url() ?>assets_admin/js/global/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pribadilainnya.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/sklainnya.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/keluarga.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pangkat.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/jabatan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pendidikan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pelatihan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/penghargaan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/tubel.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/skp.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/hukuman.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/map/mapKoordinatPegawai.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/global/modal.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/date_picker/date_picker_pegawai.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/select2/select2_pegawai.js" type="text/javascript"></script>
	<!-- end script page -->
	<script src="<?= base_url() ?>asset/signature/main_style/numeric-1.2.6.min.js"></script>
	<script src="<?= base_url() ?>asset/signature/main_style/bezier.js"></script>
	<script src="<?= base_url() ?>asset/signature/main_style/jquery.signaturepad.js"></script>
	<script>
		function getsignature(Id) {
			$.ajax({
				type: "post",
				data: {
					Id: Id
				},
				url: "<?php echo site_url('/Pegawai/modal_signature'); ?>",
				beforeSend: function(s) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
				},
				success: function(response) {
					$('#modal_all .modal-dialog').addClass('modalan');
					$('#modal_all .modal-dialog .modal-content .modal-body').html(response);
				}
			});
			$("#modal_all .modal-title").text("Update Kelengkapan TT Digital");
			$("#modal_all .modal-footer").addClass("hidden");

			$('#modal_all').modal('show'); // show bootstrap modal
			$('#modal_all').modal({
				backdrop: false,
				keyboard: true
			});
		}

		function add_arsip_next(type, Id) {
			save_method = 'add';
			$.ajax({
				type: "post",
				data: {
					Id: Id
				},
				url: "<?php echo site_url('/Arsip_pribadi/modal_arsip_pribadi'); ?>",
				beforeSend: function(s) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
				},
				success: function(response) {
					//alert(response);
					$('#modal_all .modal-dialog').addClass('modalan');
					$('#modal_all .modal-dialog .modal-content .modal-body').html(response);
					$("#modal_all .modal-title").text("");
					$("#modal_all .modal-footer").addClass("hidden");
					$('#modal_all').modal('show'); // show bootstrap modal
				}

			});
		}

		function edit_arsip_next(type, Id) {
			save_method = 'update';
			$.ajax({
				type: "post",
				data: {
					Id: Id
				},
				url: "<?php echo site_url('/Arsip_pribadi/modal_arsip_pribadi_edit'); ?>",
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

		function simpan_pribadilainnya() {
			var formData = new FormData($('#frmPribadiLainnya')[0]);
			var url;
			if (save_method == 'add') {
				url = "<?php echo site_url('/Arsip_pribadi/arsip_pribadi_add'); ?>";
			} else {
				url = "<?php echo site_url('/Arsip_pribadi/arsip_pribadi_update'); ?>";
			}
			$.ajax({
				url: url,
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					$('#modal_all').modal('hide');
					alert(response);
					tblPribadiLainnya.reload();
				}
			});
		}

		function delete_arsip_next(type, Id) {
			var i = "Hapus ?";
			var b = "Data Dihapus";
			if (!confirm(i)) return false;
			$.ajax({
				type: "post",
				data: "Id=" + Id,
				url: "<?php echo site_url('/Arsip_pribadi/arsip_pribadi_delete') ?>",
				success: function(s) {
					//alert(b);
					tblPribadiLainnya.reload();
				}
			});
		}
		// ----
		function add_sk_next(type, Id) {
			save_method = 'add';
			$.ajax({
				type: "post",
				data: {
					Id: Id
				},
				url: "<?php echo site_url('/Arsip_sk/modal_arsip_sk'); ?>",
				beforeSend: function(s) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
				},
				success: function(response) {
					//alert(response);
					$('#modal_all .modal-dialog').addClass('modalan');
					$('#modal_all .modal-dialog .modal-content .modal-body').html(response);
					$("#modal_all .modal-title").text("");
					$("#modal_all .modal-footer").addClass("hidden");
					$('#modal_all').modal('show'); // show bootstrap modal
				}

			});
		}

		function edit_sk_next(type, Id) {
			save_method = 'update';
			$.ajax({
				type: "post",
				data: {
					Id: Id
				},
				url: "<?php echo site_url('/Arsip_sk/modal_arsip_sk_edit'); ?>",
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

		function simpan_sklainnya() {
			var formData = new FormData($('#frmSkLainnya')[0]);
			var url;
			if (save_method == 'add') {
				url = "<?php echo site_url('/Arsip_sk/arsip_sk_add'); ?>";
			} else {
				url = "<?php echo site_url('/Arsip_sk/arsip_sk_update'); ?>";
			}
			$.ajax({
				url: url,
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					$('#modal_all').modal('hide');
					alert(response);
					tblSkLainnya.reload();
				}
			});
		}

		function delete_sk_next(type, Id) {
			var i = "Hapus ?";
			var b = "Data Dihapus";
			if (!confirm(i)) return false;
			$.ajax({
				type: "post",
				data: "Id=" + Id,
				url: "<?php echo site_url('/Arsip_sk/arsip_sk_delete') ?>",
				success: function(s) {
					//alert(b);
					tblSkLainnya.reload();
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

		//onchange
		// var yy = $("#status_pegawai").val();
		// alert(yy);
		$("#status_pegawai").change(function() {
			var speg = $("#status_pegawai").val();
			if (speg === "1" || speg === "10") {
				// $("#id_golongan").val('0');
				$("#id_golongan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_status_jabatan").val('0');
				$("#id_status_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_rumpun_jabatan").val('0');
				$("#id_rumpun_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_jabatan").val('0');
				$("#id_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#lokasi_kerja").val('0');
				$("#lokasi_kerja").selectpicker('refresh').trigger('change').attr('disabled', true);
				$("#sublokasi_kerja").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#seksi").val('0');
				$("#seksi").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_eselon").val('0');
				$("#id_eselon").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_jabatan").val('0');
				$("#id_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#tanggal_mulai_pangkat").val('');
				$("#tanggal_mulai_pangkat").addClass("avoid-clicks");
			} else {
				$("#id_golongan").val('0');
				$("#id_golongan").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#id_status_jabatan").val('0');
				$("#id_status_jabatan").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#id_rumpun_jabatan").val('0');
				$("#id_rumpun_jabatan").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#id_jabatan").val('0');
				$("#id_jabatan").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#lokasi_kerja").val('0');
				$("#lokasi_kerja").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#seksi").val('0');
				$("#seksi").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#id_eselon").val('0');
				$("#id_eselon").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#id_jabatan").val('0');
				$("#id_jabatan").selectpicker('refresh').trigger('change').attr('disabled', false);
				$("#tanggal_mulai_pangkat").val('');
				$("#tanggal_mulai_pangkat").removeClass("avoid-clicks");
			}
		});
		$(document).ready(function() {
			//onload
			var speg = $("#status_pegawai").val();
			//alert(speg);
			if (speg === "1" || speg === "10") {
				// $("#id_golongan").val('0');
				$("#id_golongan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_status_jabatan").val('0');
				$("#id_status_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_rumpun_jabatan").val('0');
				$("#id_rumpun_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_jabatan").val('0');
				$("#id_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#lokasi_kerja").val('0');
				$("#lokasi_kerja").selectpicker('refresh').trigger('change').attr('disabled', true);
				$("#sublokasi_kerja").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#seksi").val('0');
				$("#seksi").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_eselon").val('0');
				$("#id_eselon").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#id_jabatan").val('0');
				$("#id_jabatan").selectpicker('refresh').trigger('change').attr('disabled', true);
				// $("#tanggal_mulai_pangkat").val('');
				$("#tanggal_mulai_pangkat").addClass("avoid-clicks");
			}
		});

		$('#sublokasi_kerja').change(function() {
			var id_sublokasi_kerja = $('#sublokasi_kerja').val();

			$.ajax({
				url: "<?php echo base_url(); ?>pegawai/sub_lokasi_kerja_by_lokasi_kerja",
				method: "POST",
				data: {
					id_lokasi_kerja: id_sublokasi_kerja
				},
				success: function(data) {
					$('#seksi').html(data);
				}
			});
		});
	</script>

</body>