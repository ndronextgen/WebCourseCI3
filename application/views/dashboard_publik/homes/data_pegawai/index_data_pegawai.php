<!-- Main content -->
<?php echo form_open_multipart('dashboard_publik/simpan', 'class=""'); ?>
<!-- <section id="data-pegawai" class="content"> -->

<div class="callout callout-info">
	<h4>Data Pegawai</h4>
	<p>Berisi data utama pegawai, foto, serta data-data arsip digital. Silahkan dilengkapi.</p>
</div>

<!-- begin: flash alert -->
<?php if ($this->session->flashdata('suksesedit')) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<h4>SUKSES !!!</h4>
		<?php echo $this->session->flashdata('suksesedit'); ?>
	</div>
<?php } ?>

<?php if ($this->session->flashdata('gagaledit')) { ?>
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<h4>GAGAL !!!</h4>
		<?php echo $this->session->flashdata('gagaledit'); ?>
	</div>
<?php } ?>

<?php if ($this->session->flashdata('pict_failed')) { ?>
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<h4>GAGAL !!!</h4>
		<?php echo $this->session->flashdata('pict_failed'); ?>
	</div>
<?php } ?>

<?php if ($this->session->flashdata('sign_failed')) { ?>
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<h4>GAGAL !!!</h4>
		<?php echo $this->session->flashdata('sign_failed'); ?>
	</div>
<?php } ?>
<!-- end: flash alert -->

<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#dtpegawai" data-toggle="tab">Data Pegawai</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="dtpegawai">
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">
									<div class="controls" align="right">
										<a href="javascript:void(0);" onclick="load_data('edit_pegawai', '<?php echo $id_param; ?>', '<?php echo $st; ?>' )" class="btn btn-warning"><i class="fa fa-edit"></i> Edit Data Pegawai</a>
									</div>
								</div>

							</div>
							<!-- ---- -->
							<div class="row">
								<div class="col-xs-6">

									<div class="form-group">
										<div class="input-group">
											<?php
											$ft = $foto;
											if ($ft == "") {
												$ft = "nofoto.png";
												?>
												<p><img src="<?php echo base_url(); ?>asset/foto_pegawai/no-image/<?php echo $ft; ?>" border="5" class="user-foto"></p>
											<?php
											} else {
												?>
												<p>
													<a data-fancybox="images" href="<?php echo base_url(); ?>asset/foto_pegawai/<?php echo $ft; ?>" target="_blank">
														<img class="user-foto" border="5" src="<?php echo base_url(); ?>asset/foto_pegawai/thumb/<?php echo $ft; ?>">
													</a>
												</p>
											<?php } ?>
										</div>
										<br />
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Nama Pegawai :</span>
											<input type="text" disabled="disabled" class="form-control" name="nama_pegawai" id="nama_pegawai" value="<?php echo $nama_pegawai; ?>" placeholder="Nama Pegawai">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Gelar :</span>
											<input type="text" disabled="disabled" class="form-control" name="gelar" id="gelar" value="<?php echo $gelar; ?>" placeholder="Gelar">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">NIP :</span>
											<input type="text" disabled="disabled" class="form-control" name="nip" id="nip" value="<?php echo $nip; ?>" placeholder="NIP">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">NRK :</span>
											<input type="text" disabled="disabled" class="form-control" name="nrk" id="nrk" value="<?php echo $nrk; ?>" placeholder="NRK">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Email :</span>
											<input type="text" disabled="disabled" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Telepon :</span>
											<input type="text" disabled="disabled" class="form-control" name="telepon" id="telepon" value="<?php echo $telepon; ?>" placeholder="Nomor Telepon">
										</div><!-- /.input group -->
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Jenis Kelamin :</span>
											<select data-placeholder="Jenis Kelamin" disabled="disabled" class="select2 form-control input-sm" tabindex="2" name="jenis_kelamin">
												<?php
												$laki = "";
												$perempuan = "";
												$kosong1 = "";
												if ($jenis_kelamin == "Laki-Laki") {
													$laki = 'selected="selected"';
													$perempuan = "";
													$kosong1 = "";
												} else if ($jenis_kelamin == "Perempuan") {
													$laki = '';
													$perempuan = 'selected="selected"';
													$kosong1 = "";
												} else {
													$laki = '';
													$perempuan = '';
													$kosong1 = 'selected="selected"';
												}
												?>
												<option value="" <?php echo $kosong1; ?>></option>
												<option value="Laki-Laki" <?php echo $laki; ?>>Laki-Laki</option>
												<option value="Perempuan" <?php echo $perempuan; ?>>Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Tempat Lahir :</span>
											<input type="text" disabled="disabled" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $tempat_lahir; ?>" placeholder="Tempat Lahir">
										</div><!-- /.input group -->
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Tanggal Lahir :</span>
											<input type="text" disabled="disabled" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo (isset($tanggal_lahir) ? date_format(date_create($tanggal_lahir), 'j M Y') : ''); ?>" placeholder="Tanggal Lahir">
										</div><!-- /.input group -->
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Agama :</span>
											<select data-placeholder="Agama" disabled="disabled" class="select2 form-control input-sm" tabindex="2" name="agama">
												<?php
												$islam = "";
												$hindu = "";
												$budha = "";
												$protestan = "";
												$katolik = "";
												$konghucu = "";
												$lainnya = "";
												$kosong = "";
												$kristen = "";
												if ($agama == "") {
													$islam = '';
													$hindu = '';
													$budha = '';
													$protestan = '';
													$katolik = '';
													$konghucu = '';
													$lainnya = '';
													$kosong = 'selected="selected"';
													$kristen = "";
												} else if ($agama == "Hindu") {
													$islam = '';
													$hindu = 'selected="selected"';
													$budha = '';
													$protestan = '';
													$katolik = '';
													$konghucu = '';
													$lainnya = '';
													$kristen = "";
													$kosong = "";
												} else if ($agama == "Budha") {
													$islam = '';
													$hindu = '';
													$budha = 'selected="selected"';
													$protestan = '';
													$katolik = '';
													$konghucu = '';
													$lainnya = '';
													$kristen = "";
													$kosong = "";
												} else if ($agama == "Kristen") {
													$islam = '';
													$hindu = '';
													$budha = '';
													$protestan = '';
													$katolik = '';
													$konghucu = '';
													$lainnya = '';
													$kosong = "";
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
													$kosong = "";
												} else if ($agama == "Kristen Katolik") {
													$islam = '';
													$hindu = '';
													$budha = '';
													$protestan = '';
													$katolik = 'selected="selected"';
													$konghucu = '';
													$kristen = "";
													$lainnya = '';
													$kosong = "";
												} else if ($agama == "Konghucu") {
													$islam = '';
													$hindu = '';
													$budha = '';
													$protestan = '';
													$katolik = '';
													$konghucu = 'selected="selected"';
													$lainnya = '';
													$kristen = "";
													$kosong = "";
												} else if ($agama == "Lainnya") {
													$islam = '';
													$hindu = '';
													$budha = '';
													$protestan = '';
													$katolik = '';
													$konghucu = '';
													$lainnya = 'selected="selected"';
													$kristen = "";
													$kosong = "";
												} else if ($agama == "Islam") {
													$islam = 'selected="selected"';
													$hindu = '';
													$budha = '';
													$protestan = '';
													$katolik = '';
													$konghucu = '';
													$lainnya = '';
													$kristen = "";
													$kosong = "";
												}
												?>
												<option value="" <?php echo $kosong; ?>></option>
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

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Status Nikah :</span>
											<select data-placeholder="Status Nikah" disabled="disabled" class="select2 form-control input-sm" tabindex="2" name="status_nikah">
												<?php
												$belum_nikah = "";
												$sudah_nikah = "";
												$duda_janda = "";
												$kosong1 = "";
												if ($status_nikah == "Belum Menikah") {
													$belum_nikah = 'selected="selected"';
													$sudah_nikah = "";
													$duda_janda = "";
													$kosong1 = "";
												} else if ($status_nikah == "Sudah Menikah") {
													$belum_nikah = '';
													$sudah_nikah = 'selected="selected"';
													$duda_janda = "";
													$kosong1 = "";
												} else if ($status_nikah == "Duda/Janda") {
													$belum_nikah = '';
													$sudah_nikah = '';
													$duda_janda = 'selected="selected"';
													$kosong1 = "";
												} else {
													$belum_nikah = '';
													$sudah_nikah = '';
													$duda_janda = "";
													$kosong1 = 'selected="selected"';
												}
												?>
												<option value="" <?php echo $kosong1; ?>></option>
												<option value="Belum Menikah" <?php echo $belum_nikah; ?>>Belum Menikah</option>
												<option value="Sudah Menikah" <?php echo $sudah_nikah; ?>>Sudah Menikah</option>
												<option value="Duda/Janda" <?php echo $duda_janda; ?>>Duda/Janda</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Pendidikan Terakhir :</span>
											<select data-placeholder="Pendidikan" disabled="disabled" class="select2 form-control input-sm" tabindex="2" name="pendidikan">
												<option value=""></option>
												<?php
												foreach ($mst_pendidikan->result_array() as $mp) {
													if ($mp['nama_pendidikan'] == $pendidikan) {
														?>
														<option value="<?php echo $mp['nama_pendidikan']; ?>" selected="selected"><?php echo $mp['nama_pendidikan']; ?></option>
													<?php
														} else {
															?>
														<option value="<?php echo $mp['nama_pendidikan']; ?>"><?php echo $mp['nama_pendidikan']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Pendidikan Terverifikasi BKD :</span>
											<select data-placeholder="Pendidikan BKD" disabled="disabled" class="select2 form-control input-sm" tabindex="2" name="pendidikan_bkd">
												<option value=""></option>
												<?php
												foreach ($mst_pendidikan->result_array() as $mp) {
													if ($mp['nama_pendidikan'] == $pendidikan_bkd) {
														?>
														<option value="<?php echo $mp['nama_pendidikan']; ?>" selected="selected"><?php echo $mp['nama_pendidikan']; ?></option>
													<?php
														} else {
															?>
														<option value="<?php echo $mp['nama_pendidikan']; ?>"><?php echo $mp['nama_pendidikan']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Tanda Tangan Digital :</span>
											<img src="<?php echo $signature; ?>" height='80px' style='background-size: 100% 100%; border: 1px solid #ccc !important;'>
										</div><!-- /.input group -->
									</div>



								</div>

								<div class="col-xs-6">

									<fieldset>
										<legend>Alamat Domisili :</legend>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Provinsi:</span>
												<select data-placeholder="Provinsi" class="select2 form-control input-sm" tabindex="2" name="kode_provinsi" id="kode_provinsi" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_provinsi->result_array() as $me) {
														if ($kode_provinsi == $me['kode_provinsi']) {
															?>
															<option value="<?php echo $me['kode_provinsi']; ?>" selected="selected"><?php echo $me['nama_provinsi']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_provinsi']; ?>"><?php echo $me['nama_provinsi']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_provinsi" id="nama_provinsi" value="<?php echo $nama_provinsi; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Kab/ Kota:</span>
												<select data-placeholder="Kab/ Kota" class="select2 form-control input-sm" tabindex="2" name="kode_kabupaten" id="kode_kabupaten" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_kabupaten->result_array() as $me) {
														if ($kode_kabupaten == $me['kode_kabupaten']) {
															?>
															<option value="<?php echo $me['kode_kabupaten']; ?>" selected="selected"><?php echo $me['nama_kabupaten']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_kabupaten']; ?>"><?php echo $me['nama_kabupaten']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_kabupaten" id="nama_kabupaten" value="<?php echo $nama_kabupaten; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Kecamatan:</span>
												<select data-placeholder="Kecamatan" class="select2 form-control input-sm" tabindex="2" name="kode_kecamatan" id="kode_kecamatan" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_kecamatan->result_array() as $me) {
														if ($kode_kecamatan == $me['kode_kecamatan']) {
															?>
															<option value="<?php echo $me['kode_kecamatan']; ?>" selected="selected"><?php echo $me['nama_kecamatan']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_kecamatan']; ?>"><?php echo $me['nama_kecamatan']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_kecamatan" id="nama_kecamatan" value="<?php echo $nama_kecamatan; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Kelurahan:</span>
												<select data-placeholder="Kelurahan" class="select2 form-control input-sm" tabindex="2" name="kode_kelurahan" id="kode_kelurahan" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_kelurahan->result_array() as $me) {
														if ($kode_kelurahan == $me['kode_kelurahan']) {
															?>
															<option value="<?php echo $me['kode_kelurahan']; ?>" selected="selected"><?php echo $me['nama_kelurahan']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_kelurahan']; ?>"><?php echo $me['nama_kelurahan']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_kelurahan" id="nama_kelurahan" value="<?php echo $nama_kelurahan; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Alamat:</span>
												<textarea class="form-control textarea input-sm" style="height: 100px;overflow:auto;resize:none" name="alamat" id="alamat" placeholder="Alamat" readonly="readonly"><?php echo $alamat; ?></textarea>
											</div>
										</div>
									</fieldset>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Koordinat Alamat Domisili:<br /><strong>(Longitude & Latitude)</strong></span>
											<input type="hidden" id="pid" name="pid" placeholder="pid">
											<input type="text" readonly="readonly" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>">
											<input type="text" readonly="readonly" class="form-control" name="latitude" id="latitude" placeholder="latitude" value="<?php echo $latitude; ?>">
											<span class="input-group-addon"><a href="" class="btn btn-info" data-toggle="modal" data-target="#add_koordinat">Lihat Peta</a></span>
										</div><!-- /.input group -->
									</div>

									<fieldset>
										<legend>Alamat KTP : </legend>
										<div class="form-group" style='display: none;'>
											<div class="input-group">
												<span class="input-group-addon">Provinsi:</span>
												<select data-placeholder="Provinsi" class="select2 form-control input-sm" tabindex="2" name="kode_provinsi_ktp" id="kode_provinsi_ktp" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_provinsi->result_array() as $me) {
														if ($kode_provinsi_ktp == $me['kode_provinsi']) {
															?>
															<option value="<?php echo $me['kode_provinsi']; ?>" selected="selected"><?php echo $me['nama_provinsi']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_provinsi']; ?>"><?php echo $me['nama_provinsi']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_provinsi_ktp" id="nama_provinsi_ktp" value="<?php echo $nama_provinsi_ktp; ?>">
											</div>
										</div>
										<div class="form-group" style='display: none;'>
											<div class="input-group">
												<span class="input-group-addon">Kab/ Kota:</span>
												<select data-placeholder="Kab/ Kota" class="select2 form-control input-sm" tabindex="2" name="kode_kabupaten_ktp" id="kode_kabupaten_ktp" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_kabupaten_ktp->result_array() as $me) {
														if ($kode_kabupaten_ktp == $me['kode_kabupaten']) {
															?>
															<option value="<?php echo $me['kode_kabupaten']; ?>" selected="selected"><?php echo $me['nama_kabupaten']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_kabupaten']; ?>"><?php echo $me['nama_kabupaten']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_kabupaten_ktp" id="nama_kabupaten_ktp" value="<?php echo $nama_kabupaten_ktp; ?>">
											</div>
										</div>
										<div class="form-group" style='display: none;'>
											<div class="input-group">
												<span class="input-group-addon">Kecamatan:</span>
												<select data-placeholder="Kecamatan" class="select2 form-control input-sm" tabindex="2" name="kode_kecamatan_ktp" id="kode_kecamatan_ktp" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_kecamatan_ktp->result_array() as $me) {
														if ($kode_kecamatan_ktp == $me['kode_kecamatan']) {
															?>
															<option value="<?php echo $me['kode_kecamatan']; ?>" selected="selected"><?php echo $me['nama_kecamatan']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_kecamatan']; ?>"><?php echo $me['nama_kecamatan']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_kecamatan_ktp" id="nama_kecamatan_ktp" value="<?php echo $nama_kecamatan_ktp; ?>">
											</div>
										</div>
										<div class="form-group" style='display: none;'>
											<div class="input-group">
												<span class="input-group-addon">Kelurahan:</span>
												<select data-placeholder="Kelurahan" class="select2 form-control input-sm" tabindex="2" name="kode_kelurahan_ktp" id="kode_kelurahan_ktp" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_kelurahan_ktp->result_array() as $me) {
														if ($kode_kelurahan_ktp == $me['kode_kelurahan']) {
															?>
															<option value="<?php echo $me['kode_kelurahan']; ?>" selected="selected"><?php echo $me['nama_kelurahan']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['kode_kelurahan']; ?>"><?php echo $me['nama_kelurahan']; ?></option>
													<?php
														}
													}
													?>
												</select>
												<input type="hidden" class="form-control" name="nama_kelurahan_ktp" id="nama_kelurahan_ktp" value="<?php echo $nama_kelurahan_ktp; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Alamat:</span>
												<textarea class="form-control textarea input-sm" style="height: 100px;overflow:auto;resize:none" name="alamat_ktp" id="alamat_ktp" placeholder="Alamat" readonly="readonly"><?php echo $alamat_ktp; ?></textarea>
											</div>
										</div>
									</fieldset>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Status Pegawai :</span>
											<select class="select2 form-control input-sm" disabled="disabled" name="status_pegawai">
												<option value=""></option>
												<?php
												foreach ($mst_status_pegawai->result_array() as $mspg) {
													if ($status_pegawai == $mspg['id_status_pegawai']) {
														?>
														<option value="<?php echo $mspg['id_status_pegawai']; ?>" selected="selected"><?php echo $mspg['nama_status']; ?></option>
													<?php
														} else {
															?>
														<option value="<?php echo $mspg['id_status_pegawai']; ?>"><?php echo $mspg['nama_status']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Golongan:</span>
											<select class="select2 form-control input-sm" disabled="disabled" name="id_golongan">
												<option value=""></option>
												<?php
												foreach ($mst_golongan->result_array() as $mg) {
													if ($id_golongan == $mg['id_golongan']) {
														?>
														<option value="<?php echo $mg['id_golongan']; ?>" selected="selected"><?php echo $mg['golongan']; ?></option>
													<?php
														} else {
															?>
														<option value="<?php echo $mg['id_golongan']; ?>"><?php echo $mg['golongan']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">TMT Pangkat Terakhir :</span>
											<input type="text" disabled="disabled" class="form-control datepicker" name="tanggal_mulai_pangkat" id="tanggal_mulai_pangkat" value="<?php echo (isset($tanggal_mulai_pangkat) ? date_format(date_create($tanggal_mulai_pangkat), 'd M Y') : ''); ?>" placeholder="TMT Pangkat">
										</div><!-- /.input group -->
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Status Jabatan :</span>
											<select name="id_status_jabatan" id="id_status_jabatan" disabled="disabled" class="select2 form-control input-sm">
												<option value="">Pilih Status Jabatan</option>
												<?php
												foreach ($mst_status_jabatan as $mstsj) { {
														if ($id_status_jabatan == $mstsj->id_status_jabatan) {
															echo '<option value="' . $mstsj->id_status_jabatan . '" selected="selected">' . $mstsj->nama_status_jabatan . '</option>';
														} else {
															echo '<option value="' . $mstsj->id_status_jabatan . '">' . $mstsj->nama_status_jabatan . '</option>';
														}
													}
												}
												?>
											</select>
										</div>
									</div>

									<div id="grpEselon">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Eselon :</span>
												<select class="select2 form-control input-sm" disabled="disabled" name="id_eselon" disabled="disabled">
													<option value=""></option>
													<?php
													foreach ($mst_eselon->result_array() as $me) {
														if ($id_eselon == $me['id_eselon']) {
															?>
															<option value="<?php echo $me['id_eselon']; ?>" selected="selected"><?php echo $me['nama_eselon']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $me['id_eselon']; ?>"><?php echo $me['nama_eselon']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>

									<div id="grpRumpun">
										<div class="form-group" <?php echo $show_rumpun_jabatan; ?>>
											<div class="input-group">
												<span class="input-group-addon">Rumpun Jabatan :</span>
												<select name="id_rumpun_jabatan_view" id="id_rumpun_jabatan_view" class="select2 form-control input-sm" disabled="disabled">
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
												<input type="hidden" name="id_rumpun_jabatan" id="id_rumpun_jabatan" value="<?php echo $id_rumpun_jabatan; ?>" />
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Nama Jabatan :</span>
											<select name="id_jabatan" id="id_jabatan" disabled="disabled" class="select2 form-control input-sm">
												<option value="">Pilih Nama Jabatan</option>
												<?php
												foreach ($mst_jabatan->result_array() as $mj) {
													if ($id_jabatan == $mj['id_nama_jabatan']) {
														?>
														<option value="<?php echo $mj['id_nama_jabatan']; ?>" selected="selected"><?php echo $mj['nama_jabatan']; ?></option>
													<?php
														} else {
															?>
														<option value="<?php echo $mj['id_nama_jabatan']; ?>"><?php echo $mj['nama_jabatan']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Unit / Satuan Kerja :</span>
											<select data-placeholder="Lokasi Kerja" class="select2 form-control input-sm" tabindex="2" name="lokasi_kerja" id="lokasi_kerja" disabled="disabled">
												<option value=""></option>
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

									<div class="form-group" id='sublokasi'>
										<div class="input-group">
											<span class="input-group-addon">(Sub) Unit / Satuan Kerja :</span>
											<select data-placeholder="Sub unit/Satker" class="select2 form-control input-sm" tabindex="2" name="sublokasi_kerja" id="sublokasi_kerja" disabled="disabled">
												<option value=""></option>
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

									<div id='grpseksi'>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Seksi / Subbag / Satlak :</span>
												<select data-placeholder="Seksi / Subbag / Satlak" disabled="disabled" class="select2 form-control input-sm" tabindex="2" name="seksi" id="seksi">
													<option value=""></option>
													<?php
													foreach ($mst_sub_lokasi_kerja->result_array() as $sl) {
														if ($seksi == $sl['id_sub_lokasi_kerja']) {
															?>
															<option value="<?php echo $sl['id_sub_lokasi_kerja']; ?>" selected="selected"><?php echo $sl['sub_lokasi_kerja']; ?></option>
														<?php
															} else {
																?>
															<option value="<?php echo $sl['id_sub_lokasi_kerja']; ?>"><?php echo $sl['sub_lokasi_kerja']; ?></option>
													<?php
														}
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
				</div><!-- /.tab-pane -->

				<!-- <div class="control-group">
									<div class="controls" align="center">
										<a  href="javascript:void(0);" onclick="load_data('edit_pegawai', '<?php //echo $id_param; 
																											?>', '<?php //echo $st; 
																													?>' )" class="btn btn-danger">Edit Data Pegawai</a>
									</div>							
								</div> -->

				<input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
				<input type="hidden" name="st" value="<?php echo $st; ?>">
				<input type="hidden" name="frame" value="frame">

			</div><!-- /.tab-content -->
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- </section> -->

<?php echo form_close(); ?>

<script type="text/javascript">
	//onload
	var status_jabatan = $('#id_status_jabatan_view').val();
	if (status_jabatan == 2) {
		$('#grpEselon').show(); //$('#id_eselon').val('').trigger('change');
		$('#grpRumpun').hide();
		$('#id_rumpun_jabatan_view').val('').trigger('change');
	} else {
		$('#grpEselon').hide();
		$('#id_eselon').val('').trigger('change');
		$('#grpRumpun').show(); //$('#id_rumpun_jabatan_view').val('').trigger('change');
	}

	var x = $('#id_eselon').val(); //alert(x);
	const targetDiv = document.getElementById("grpseksi");
	if (x === '23' || x === '24' || x === '25' || x === '26' || x === '27' || x === '28') {
		targetDiv.style.display = "none";
	} else {
		targetDiv.style.display = "block";
	}
	var id_lokasi_kerja = $('#lokasi_kerja').val();
	if (id_lokasi_kerja != '52') {
		document.getElementById("sublokasi").style.display = "none";
	} else {
		document.getElementById("sublokasi").style.display = "block";
	}
</script>

<script type="text/javascript">
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 2000);
</script>