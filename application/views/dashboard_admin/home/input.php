<?php headAdminHtml(); ?>

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin();
	?>

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
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="row">
										<div class="col-lg-12">
											<?php
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

											if ($this->session->flashdata('suksestambah')) {
												echo '<div class="alert alert-warning fade show" role="alert">
													<div class="alert-icon"><i class="flaticon-warning"></i></div>
													<div class="alert-text">' . $this->session->flashdata('suksestambah') . '</div>
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
												<div class="kt-portlet__head kt-portlet__head--lg">
													<div class="kt-portlet__head-toolbar">
														<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
															<li class="nav-item">
																<a class="nav-link active" data-toggle="tab" href="#tabs_data_pegawai" role="tab"><i class="flaticon-list-1"></i> Form Data Pegawai</a>
															</li>
															<!-- <li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_keluarga" role="tab"><i class="flaticon-folder"></i> Keluarga</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_pangkat" role="tab"><i class="flaticon-folder"></i> Pangkat</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_jabatan" role="tab"><i class="flaticon-folder"></i> Jabatan</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_pendidikan" role="tab"><i class="flaticon-folder"></i> Pendidikan</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_pelatihan" role="tab"><i class="flaticon-folder"></i> Pelatihan </a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_penghargaan" role="tab"><i class="flaticon-folder"></i> Penghargaan </a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_tubel" role="tab"><i class="flaticon-folder"></i> Tugas & Izin Belajar </a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#tabs_data_skp" role="tab"><i class="flaticon-folder"></i> SKP / DP3 </a>
															</li> -->
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
																			<div class="form-group row" style="display:none;">
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
																					<input class="form-control" name="nama_pegawai" id="nama_pegawai" type="text" value="" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Gelar</label>
																				<div class="col-8">
																					<input class="form-control" name="gelar" id="gelar" type="text" value="" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">NIP</label>
																				<div class="col-8">
																					<input class="form-control" name="nip" id="nip" type="text" value="" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">NRK</label>
																				<div class="col-8">
																					<input class="form-control" name="nrk" id="nrk" type="text" value="" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Email</label>
																				<div class="col-8">
																					<input class="form-control" name="email" id="email" type="text" value="" />
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Telepon</label>
																				<div class="col-8">
																					<input class="form-control" name="telepon" id="telepon" type="text" value="" />
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Jenis Kelamin</label>
																				<div class="col-8">
																					<div class="kt-radio-inline">
																						<label class="kt-radio">
																							<input type="radio" name="jenis_kelamin" value="Laki-Laki" /> Laki-Laki
																							<span></span>
																						</label>
																						<label class="kt-radio">
																							<input type="radio" name="jenis_kelamin" value="Perempuan" /> Perempuan
																							<span></span>
																						</label>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Tempat Lahir</label>
																				<div class="col-8">
																					<input class="form-control" name="tempat_lahir" id="tempat_lahir" type="text" value="" />
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Tanggal Lahir</label>
																				<div class="col-8">
																					<div class="input-group date">
																						<input type="text" class="form-control" readonly id="tanggal_lahir" name="tanggal_lahir" value="" placeholder="dd-mm-yyyy" />
																					</div>
																				</div>
																			</div>

																			<div class="kt-heading kt-heading--md" style="display:none;">Alamat Domisili :</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Provinsi</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_provinsi" id="kode_provinsi" placeholder="Pilih Provinsi">
																							<option value="">Pilih Provinsi</option>
																							<?php
																							foreach ($mst_provinsi->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['kode_provinsi']; ?>"><?php echo $me['nama_provinsi']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_provinsi" id="nama_provinsi" value="">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Kab/ Kota</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kabupaten" id="kode_kabupaten">
																							<option value="">Pilih Kab/ Kota</option>
																							<?php
																							foreach ($mst_kabupaten->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['kode_kabupaten']; ?>"><?php echo $me['nama_kabupaten']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kabupaten" id="nama_kabupaten" value="">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Kecamatan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kecamatan" id="kode_kecamatan">
																							<option value="">Pilih Kecamatan</option>
																							<?php
																							foreach ($mst_kecamatan->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['kode_kecamatan']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kecamatan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kecamatan" id="nama_kecamatan" value="">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Kelurahan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kelurahan" id="kode_kelurahan">
																							<option value="">Pilih Kelurahan</option>
																							<?php
																							foreach ($mst_kelurahan->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['kode_kelurahan']; ?>" <?php echo $selected; ?>><?php echo $me['nama_kelurahan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kelurahan" id="nama_kelurahan" value="">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Alamat</label>
																				<div class="col-8">
																					<textarea class="form-control" rows="3" name="alamat" id="alamat"></textarea>
																				</div>
																			</div>
																			<div class="form-group row" style="display:none;">
																				<label class="col-4 col-form-label kt-font-bolder">Koordinat Alamat Domisili (Latitude & Longitude)</label>
																				<div class="input-group col-8">
																					<div class="row align-items-center col-lg-12">
																						<div class="col-sm-7">
																							<input type="hidden" id="pid" name="pid" placeholder="pid">
																							<input type="text" class="form-control form-control-sm" id="latitude" name="latitude" placeholder="latitude" value="" readonly>
																							<input type="text" class="form-control form-control-sm" id="longitude" name="longitude" placeholder="longitude" value="" readonly>
																						</div>
																						<div class="col-sm-5">
																							<button type="button" class="btn btn-primary btn-sm" onclick="add_coordinate();"><i class="flaticon-placeholder" style="color:#ffffff;"></i> Lihat Peta</button>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-6" style="display:none;">
																	<div class="kt-form kt-form--label-right">
																		<div class="kt-portlet__body">
																			<div class="kt-heading kt-heading--md">
																				Alamat KTP :
																				<input id="is_check" name="is_check" type="checkbox" value="1" />
																				<font size="1">Ceklist jika sama dengan alamat domisili </font>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Provinsi</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_provinsi_ktp" id="kode_provinsi_ktp" <?php echo $onchangeProvinsiKtp; ?>>
																							<option value="">Pilih Provinsi</option>
																							<?php
																							foreach ($mst_provinsi->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['kode_provinsi']; ?>"><?php echo $me['nama_provinsi']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_provinsi_ktp" id="nama_provinsi_ktp" value="">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Kab/ Kota</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kabupaten_ktp" id="kode_kabupaten_ktp" <?php echo $onchangeKabupatenKtp; ?>>
																							<option value="">Pilih Kab/ Kota</option>
																							<?php
																							foreach ($mst_kabupaten_ktp->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['kode_kabupaten']; ?>"><?php echo $me['nama_kabupaten']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kabupaten_ktp" id="nama_kabupaten_ktp" value="">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Kecamatan</label>
																				<div class="col-8">
																					<select class="form-control kt-select2" name="kode_kecamatan_ktp" id="kode_kecamatan_ktp" <?php echo $onchangeKecamatanKtp; ?>>
																						<option value="">Pilih Kecamatan</option>
																						<?php
																						foreach ($mst_kecamatan_ktp->result_array() as $me) {
																							?>
																							<option value="<?php echo $me['kode_kecamatan']; ?>"><?php echo $me['nama_kecamatan']; ?></option>
																						<?php
																						}
																						?>
																					</select>
																					<input type="hidden" class="form-control" name="nama_kecamatan_ktp" id="nama_kecamatan_ktp" value="">
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Kelurahan</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="kode_kelurahan_ktp" id="kode_kelurahan_ktp" <?php echo $onchangeKelurahanKtp; ?>>
																							<option value="">Pilih Kelurahan</option>
																							<?php
																							foreach ($mst_kelurahan_ktp->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['kode_kelurahan']; ?>"><?php echo $me['nama_kelurahan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																						<input type="hidden" class="form-control" name="nama_kelurahan_ktp" id="nama_kelurahan_ktp" value="">
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Alamat</label>
																				<div class="col-8">
																					<textarea class="form-control" cols="3" name="alamat_ktp" id="alamat_ktp"></textarea>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Agama</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="agama" id="agama">
																							<option value="">Pilih Agama</option>
																							<option value="Islam">Islam</option>
																							<option value="Hindu">Hindu</option>
																							<option value="Budha">Budha</option>
																							<option value="Kristen">Kristen</option>
																							<option value="Kristen Protestan">Kristen Protestan</option>
																							<option value="Kristen Katolik">Kristen Katolik</option>
																							<option value="Konghucu">Konghucu</option>
																							<option value="Lainnya">Lainnya</option>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Status Nikah</label>
																				<div class="col-8">
																					<div class="kt-radio-inline">
																						<label class="kt-radio">
																							<input type="radio" name="status_nikah" value="Belum Nikah" /> Belum Nikah
																							<span></span>
																						</label>
																						<label class="kt-radio">
																							<input type="radio" name="status_nikah" value="Sudah Nikah" /> Sudah Nikah
																							<span></span>
																						</label>
																					</div>
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
																								?>
																								<option value="<?php echo $mspg['id_status_pegawai']; ?>"><?php echo $mspg['nama_status']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Pendidikan Terakhir</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="pendidikan" id="pendidikan">
																							<option value="">Pilih Pendidikan Terakhir</option>
																							<?php
																							foreach ($mst_pendidikan->result_array() as $mp) {
																								?>
																								<option value="<?php echo $mp['nama_pendidikan']; ?>"><?php echo $mp['nama_pendidikan']; ?></option>
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
																								?>
																								<option value="<?php echo $mp['nama_pendidikan']; ?>"><?php echo $mp['nama_pendidikan']; ?></option>
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
																							<option value="">Pilih Golongan</option>
																							<?php
																							foreach ($mst_golongan->result_array() as $mg) {
																								?>
																								<option value="<?php echo $mg['id_golongan']; ?>"><?php echo $mg['golongan']; ?></option>
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
																						<input type="text" class="form-control" readonly id="tanggal_mulai_pangkat" name="tanggal_mulai_pangkat" value="" placeholder="dd-mm-yyyy" />
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
																							foreach ($mst_status_jabatan->result_array() as $mstsj) {
																								?>
																								<option value="<?php echo $mstsj['id_status_jabatan']; ?>"><?php echo $mstsj['nama_status_jabatan']; ?></option>
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
																						<select class="form-control kt-select2" name="id_eselon" id="id_eselon" placeholder="Pilih Eselon">
																							<option value="0">Pilih Eselon</option>
																							<?php
																							foreach ($mst_eselon->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['id_eselon']; ?>"><?php echo $me['nama_eselon']; ?></option>
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
																								?>
																								<option value="<?php echo $rj['id_rumpun_jabatan']; ?>"><?php echo $rj['nama_rumpun_jabatan']; ?></option>
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
																								?>
																								<option value="<?php echo $mj['id_nama_jabatan']; ?>"><?php echo $mj['nama_jabatan']; ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-4 col-form-label kt-font-bolder">Lokasi Kerja</label>
																				<div class="col-8">
																					<div class="input-group flex-nowrap">
																						<select class="form-control kt-select2" name="lokasi_kerja" id="lokasi_kerja">
																							<option value="">Pilih Lokasi Kerja</option>
																							<?php
																							foreach ($mst_lokasi_kerja->result_array() as $me) {
																								?>
																								<option value="<?php echo $me['id_lokasi_kerja']; ?>"><?php echo $me['lokasi_kerja']; ?></option>
																							<?php
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
																								<option value="">Pilih Seksi / Subbag / Satlak</option>
																								<?php
																								foreach ($mst_sub_lokasi_kerja->result_array() as $me) {
																									?>
																									<option value="<?php echo $me['id_sub_lokasi_kerja']; ?>"><?php echo $me['sub_lokasi_kerja']; ?></option>
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

														</div>
														<div class="tab-pane" id="tabs_data_keluarga" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmKeluarga">
																		<input type="hidden" name="counterFrmKeluarga" id="counterFrmKeluarga" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Nama Anggota Keluarga :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" id="frmKeluarga_nama_anggota_keluarga" name="frmKeluarga_nama_anggota_keluarga[]" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Hubungan Keluarga :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmKeluarga_hub_keluarga[]" id="frmKeluarga_hub_keluarga" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Jenis Kelamin :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmKeluarga_jenis_kelamin[]" id="frmKeluarga_jenis_kelamin" data-placeholder="Jenis Kelamin" class="form-control">
																							<option value="">-- Pilih Jenis Kelamin --</option>
																							<option value="Laki-Laki">Laki-Laki</option>
																							<option value="Perempuan">Perempuan</option>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal Lahir :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmKeluarga_tanggal_lahir[]" id="frmKeluarga_tanggal_lahir_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Keterangan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control" name="frmKeluarga_keterangan[]" id="frmKeluarga_keterangan" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control" name="frmKeluarga_title[]" id="frmKeluarga_title" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmKeluarga_file[]" id="frmKeluarga_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmKeluarga(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_pangkat" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmPangkat">
																		<input type="hidden" name="counterFrmPangkat" id="counterFrmPangkat" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Golongan :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmPangkat_id_golongan[]" id="frmPangkat_id_golongan" data-placeholder="Golongan" class="form-control">
																							<option value="">Pilih Golongan</option>
																							<?php
																							foreach ($mst_golongan->result_array() as $mg) {
																								echo '<option value="' . $mg['id_golongan'] . '">' . $mg['golongan'] . '</option>';
																							}
																							?>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Lokasi Kerja :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPangkat_lokasi_kerja[]" id="frmPangkat_lokasi_kerja" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nomor SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPangkat_nomor_sk[]" id="frmPangkat_nomor_sk" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmPangkat_tanggal_sk[]" id="frmPangkat_tanggal_sk_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal Mulai :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmPangkat_tanggal_mulai[]" id="frmPangkat_tanggal_mulai_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload Dokumen :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmPangkat_file[]" id="frmPangkat_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmPangkat(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_jabatan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmJabatan">
																		<input type="hidden" name="counterFrmJabatan" id="counterFrmJabatan" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Status Jabatan :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmJabatan_id_riwayat_status_jabatan[]" id="frmJabatan_id_riwayat_status_jabatan_0" data-placeholder="Status jabatan" class="form-control" onchange="frmJabatanChangeStatusJabatan(this.value,0)">
																							<option value="">Pilih Status Jabatan</option>
																							<?php
																							foreach ($mst_status_jabatan->result_array() as $sj) {
																								echo '<option value="' . $sj['id_status_jabatan'] . '">' . $sj['nama_status_jabatan'] . '</option>';
																							}
																							?>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Nama Jabatan :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmJabatan_id_r_jabatan[]" id="frmJabatan_id_r_jabatan_0" data-placeholder="Nama Jabatan" class="form-control">
																							<option value="">Pilih Nama Jabatan</option>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Lokasi :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmJabatan_lokasi[]" id="frmJabatan_lokasi" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">TMT :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmJabatan_tmt_mulai_jabatan[]" id="frmJabatan_tmt_mulai_jabatan_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nomor SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmJabatan_nomor_sk[]" id="frmJabatan_nomor_sk" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmJabatan_tgl_sk_jabatan[]" id="frmJabatan_tgl_sk_jabatan_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmJabatan_title[]" id="frmJabatan_title" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmJabatan_file[]" id="frmJabatan_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmJabatan(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_pendidikan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmPendidikan">
																		<input type="hidden" name="counterFrmPendidikan" id="counterFrmPendidikan" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Tingkat Pendidikan :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmPendidikan_id_master_pendidikan[]" id="frmPendidikan_id_master_pendidikan" data-placeholder="Tingkat Pendidikan" class="form-control">
																							<option value="">Pilih Tingkat Pendidikan</option>
																							<?php
																							foreach ($mst_pendidikan->result_array() as $mp) {
																								echo '<option value="' . $mp['nama_pendidikan'] . '">' . $mp['nama_pendidikan'] . '</option>';
																							}
																							?>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Jurusan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPendidikan_jurusan[]" id="frmPendidikan_jurusan" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tempat Pendidikan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPendidikan_tempat_sekolah[]" id="frmPendidikan_tempat_sekolah" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Kota :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPendidikan_kota[]" id="frmPendidikan_kota" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nomor Ijazah :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPendidikan_nomor_sttb[]" id="frmPendidikan_nomor_sttb" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal Lulus :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmPendidikan_tanggal_lulus[]" id="frmPendidikan_tanggal_lulus_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPendidikan_title[]" id="frmPendidikan_title" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmPendidikan_file[]" id="frmPendidikan_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmPendidikan(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_pelatihan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmPelatihan">
																		<input type="hidden" name="counterFrmPelatihan" id="counterFrmPelatihan" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Nama Pelatihan :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmPelatihan_id_master_pelatihan[]" id="frmPelatihan_id_master_pelatihan" data-placeholder="Nama Pelatihan" class="form-control" onchange="frmPelatihanChangeIdMasterPelatihan (this.value, 0)">
																							<option value="">Pilih Nama Pelatihan</option>
																							<?php
																							foreach ($mst_pelatihan->result_array() as $mp) {
																								echo '<option value="' . $mp['id_master_pelatihan'] . '">' . $mp['nama_pelatihan'] . '</option>';
																							}
																							?>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3" id="grpNamaPelatihanLainnya_0" style="display:none;">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama Pelatihan Lainnya :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPelatihan_nama_pelatihan_lainnya[]" id="frmPelatihan_nama_pelatihan_lainnya" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Lokasi :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPelatihan_lokasi[]" id="frmPelatihan_lokasi" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nomor Sertifikat :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPelatihan_no_sertifikat[]" id="frmPelatihan_no_sertifikat" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal Sertifikat :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmPelatihan_tanggal_sertifikat[]" id="frmPelatihan_tanggal_sertifikat_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Kota :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPelatihan_kota[]" id="frmPelatihan_kota" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Keterangan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPelatihan_uraian[]" id="frmPelatihan_uraian" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPelatihan_title[]" id="frmPelatihan_title" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmPelatihan_file[]" id="frmPelatihan_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmPelatihan(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_penghargaan" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmPenghargaan">
																		<input type="hidden" name="counterFrmPenghargaan" id="counterFrmPenghargaan" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Nama Penghargaan :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmPenghargaan_id_master_penghargaan[]" id="frmPenghargaan_id_master_penghargaan" data-placeholder="Nama Penghargaan" class="form-control" onchange="frmPenghargaanChangeIdMasterPenghargaan(this.value, 0)">
																							<option value="">Pilih Nama Penghargaan</option>
																							<?php
																							foreach ($mst_penghargaan->result_array() as $mp) {
																								echo '<option value="' . $mp['id_master_penghargaan'] . '">' . $mp['nama_penghargaan'] . '</option>';
																							}
																							?>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3" id="grpNamaPenghargaanLainnya_0" style="display:none;">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama Penghargaan Lainnya :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPenghargaan_nama_penghargaan_lainnya[]" id="frmPenghargaan_nama_penghargaan_lainnya" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Pemberi Penghargaan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPenghargaan_pemberi_penghargaan[]" id="frmPenghargaan_pemberi_penghargaan" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nomor SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPenghargaan_nomor_sk[]" id="frmPenghargaan_nomor_sk" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmPenghargaan_tgl_sk_penghargaan[]" id="frmPenghargaan_tgl_sk_penghargaan_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmPenghargaan_title[]" id="frmPenghargaan_title" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmPenghargaan_file[]" id="frmPenghargaan_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmPenghargaan(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_tubel" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmTubel">
																		<input type="hidden" name="counterFrmTubel" id="counterFrmTubel" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label>Nama Status :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmTubel_uraian[]" id="frmTubel_uraian" data-placeholder="Pilih Nama Status" class="form-control">
																							<option value="">-- Pilih Nama Status --</option>
																							<option value="Tugas Belajar">Tugas Belajar</option>
																							<option value="Izin Belajar">Izin Belajar</option>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3" id="grpNamaPenghargaanLainnya_0">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nomor SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmTubel_no_sk[]" id="frmTubel_no_sk" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal SK :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmTubel_tgl_sk[]" id="frmTubel_tgl_sk_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal Mulai Pendidikan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmTubel_tgl_mulai[]" id="frmTubel_tgl_mulai_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggal Selesai Pendidikan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" class="form-control datepicker" name="frmTubel_tgl_selesai[]" id="frmTubel_tgl_selesai_0" placeholder="dd-mm-yyyy" readonly>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Sekolah :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmTubel_sekolah[]" id="frmTubel_sekolah" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Akreditasi :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmTubel_akreditasi[]" id="frmTubel_akreditasi" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Jurusan :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmTubel_jurusan[]" id="frmTubel_jurusan" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmTubel_title[]" id="frmTubel_title" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmTubel_file[]" id="frmTubel_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmTubel(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
														<div class="tab-pane" id="tabs_data_skp" role="tabpanel">
															<div class="kt-portlet__body kt-portlet__body--fit">
																<!--begin: form -->
																<div>
																	<div class="form-group form-group-last row" id="frmSkp">
																		<input type="hidden" name="counterFrmSkp" id="counterFrmSkp" value="1" />
																		<div class="form-group row align-items-center">
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Jenis Data :</label>
																					</div>
																					<div class="kt-form__control">
																						<select name="frmSkp_uraian[]" id="frmSkp_uraian" data-placeholder="Pilih Jenis Data" class="form-control">
																							<option value="">Pilih Jenis Data</option>
																							<option value="SKP">SKP</option>
																							<option value="DP3">DP3</option>
																						</select>
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tahun :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_tahun[]" id="frmSkp_tahun" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Orientasi Pelayanan</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_orientasi[]" id="frmSkp_orientasi" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Integritas</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_integritas[]" id="frmSkp_integritas" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Komitmen</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_komitmen[]" id="frmSkp_komitmen" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Disiplin</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_disiplin[]" id="frmSkp_disiplin" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Kesetiaan</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_kesetiaan[]" id="frmSkp_kesetiaan" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Prestasi</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_prestasi[]" id="frmSkp_prestasi" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Tanggung Jawab</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_tanggung_jawab[]" id="frmSkp_tanggung_jawab" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Ketaatan</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_ketaatan[]" id="frmSkp_ketaatan" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Kejujuran</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_kejujuran[]" id="frmSkp_kejujuran" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Kerjasama</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_kerjasama[]" id="frmSkp_kerjasama" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Prakarsa</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_prakarsa[]" id="frmSkp_prakarsa" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Kepemimpinan</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_kepemimpinan[]" id="frmSkp_kepemimpinan" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Rata-rata</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_rata_rata[]" id="frmSkp_rata_rata" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Atasan Penilai</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_atasan[]" id="frmSkp_atasan" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Penilai</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_penilai[]" id="frmSkp_penilai" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Nama File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="text" name="frmSkp_title[]" id="frmSkp_title" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-3">
																				<div class="kt-form__group--inline">
																					<div class="kt-form__label">
																						<label class="kt-label m-label--single">Upload File :</label>
																					</div>
																					<div class="kt-form__control">
																						<input type="file" name="frmSkp_file[]" id="frmSkp_file" class="form-control" />
																					</div>
																				</div>
																				<div class="d-md-none kt-margin-b-10"></div>
																			</div>
																			<div class="col-md-12">
																				<br />
																				<hr />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-last row">
																		<label class="col-lg-2 col-form-label"></label>
																		<div class="col-lg-12">
																			<a href="javascript:;" onclick="addFrmSkp(this);" class="btn btn-bold btn-sm btn-label-brand">
																				<i class="la la-plus"></i> Tambah
																			</a>
																		</div>
																	</div>
																</div>
																<!--end: form -->
															</div>
														</div>
													</div>

												</div>

												<div class="kt-portlet__foot" align="center">
													<div class="kt-form__actions kt-space-between"></div>
													<div class="row" align="center">
														<div class="col-ld-12" align="center">
															<button type="submit" class="btn btn-brand"><i class="fa fa-save"></i> Simpan Data</button>
															<a href="<?php echo base_url(); ?>admin/dashboard_admin" class="btn btn-secondary">
																Batal
															</a>
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
	<!-- <link rel="stylesheet" href="https://js.arcgis.com/4.9/esri/css/main.css">
	<script src="https://js.arcgis.com/4.9/"></script> -->
	<link rel="stylesheet" href="https://js.arcgis.com/4.21/esri/themes/light/main.css">
	<script src="https://js.arcgis.com/4.21/"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url() ?>assets_admin/js/global/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/keluarga.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/pangkat.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/jabatan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/pendidikan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/pelatihan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/penghargaan.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/tubel.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/form/skp.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/map/mapKoordinatPegawai.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/global/modal.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/date_picker/date_picker_pegawai.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/select2/select2_pegawai.js" type="text/javascript"></script>
	<!-- end script page -->
</body>