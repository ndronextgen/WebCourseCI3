<!-- Main content -->

<!-- data pegawai -->
<!-- <section id="data-pegawai" class="content"> -->
<style>
            .signature-pad {
                position: relative;
                left: 0;
                top: 0;
                width: 100%;
                height: 200px;
                background-color: white;
            }
</style>
<div class="callout callout-info">
	<h4>Edit Data Pegawai</h4>
	<p>Silahkan Lengkapi data utama pegawai, foto serta data-data arsip digital Dan lain-lain.</p>
</div>
<?php //echo form_open_multipart('dashboard_publik/simpan', 'id="form_simpan_data_pegawai"'); 
?>
<form id="form_simpan_data_pegawai" name="form_simpan_data_pegawai" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#dtpegawai" data-toggle="tab">Edit Data Pegawai</a></li>
					<!-- <li><a href="#dtfoto" data-toggle="tab">Foto Pegawai</a></li>
						<li><a href="#dtDigitalSignature" data-toggle="tab">Tanda Tangan Digital</a></li> -->
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="dtpegawai">
						<div class="box-body table-responsive">
							<div class="box-body">

								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<!-- foto -->

											<div class="row">
												<div class="col-xs-3">
													<?php
													$ft = $foto;
													if ($ft == "") {
														$ft = "nofoto.png";
													}
													?>
													<div class="control-group">
														<div class="span6">
															<?php
															$ft = $foto;
															if ($ft == "") {
																$ft = "nofoto.png";
																?>
																<p><img src="<?php echo base_url(); ?>asset/foto_pegawai/no-image/<?php echo $ft; ?>" border="5" class="user-foto"></p>
															<?php
															} else {
																?>
																<p><img src="<?php echo base_url(); ?>asset/foto_pegawai/thumb/<?php echo $ft; ?>" border="5" class="user-foto"></p>
															<?php
															}
															?>
														</div>
													</div>
												</div>

												<div class="col-xs-9">
													<label class="span3">Upload Foto (Max 3MB)</label>
													<div class="input-group">
														<span class="input-group-addon"><input type="file" name="foto" id="foto" placeholder="Upload Foto"></span>
														<input type="hidden" name="old_file" value="<?php echo $ft; ?>" />
													</div>


												</div>
											</div>



											<!-- end foto -->
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Nama Pegawai:</span>
												<input type="text" readonly="readonly" class="form-control" name="nama_pegawai" id="nama_pegawai" value="<?php echo $nama_pegawai; ?>" placeholder="Nama Pegawai">
											</div><!-- /.input group -->
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Gelar:</span>
												<input type="text" class="form-control" name="gelar" id="gelar" value="<?php echo $gelar; ?>" placeholder="Gelar">
											</div><!-- /.input group -->
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">NIP :</span>
												<input type="text" readonly="readonly" class="form-control" name="nip" id="nip" value="<?php echo $nip; ?>" placeholder="NIP">
											</div><!-- /.input group -->
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">NRK :</span>
												<input type="text" readonly="readonly" class="form-control" name="nrk" id="nrk" value="<?php echo $nrk; ?>" placeholder="NRK">
											</div><!-- /.input group -->
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Email :</span>
												<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email">
											</div><!-- /.input group -->
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Telepon :</span>
												<input type="text" class="form-control" name="telepon" id="telepon" value="<?php echo $telepon; ?>" placeholder="Nomor Telepon">
											</div><!-- /.input group -->
										</div>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Jenis Kelamin :</span>
												<select data-placeholder="Jenis Kelamin" class="select2 form-control input-lg" tabindex="2" name="jenis_kelamin">
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
												<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $tempat_lahir; ?>" placeholder="Tempat Lahir">
											</div><!-- /.input group -->
										</div>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Tanggal Lahir :</span>
												<input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo (isset($tanggal_lahir) ? date_format(date_create($tanggal_lahir), 'd M Y') : ''); ?>" placeholder="Tanggal Lahir">
											</div><!-- /.input group -->
										</div>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Agama :</span>
												<select data-placeholder="Agama" class="select2 form-control input-lg" tabindex="2" name="agama">
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
												<select data-placeholder="Status Nikah" class="select2 form-control input-lg" tabindex="2" name="status_nikah">
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
												<select data-placeholder="Pendidikan" class="select2 form-control input-lg" tabindex="2" name="pendidikan">
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
												<select data-placeholder="Pendidikan BKD" class="select2 form-control input-lg" tabindex="2" name="pendidikan_bkd">
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
											<!-- signature -->

											<div class="row">
												<div class="col-xs-3">
													<?php
													$digitalSignature = $signature;
													if ($digitalSignature == "") {
														$signature_path = base_url() . 'asset/foto_pegawai/no-image/nosignature.png';
													} else {
														$signature_path = base_url() . 'asset/foto_pegawai/signature/thumb/' . $digitalSignature;
													}
													?>
													<div class="control-group">
														<div class="span6" id="signature_pic" style="background-image: url('<?php echo $signature_path; ?>');background-size: 100% 100%;width:100px;height:100px;"></div>
													</div>
												</div>

												<div class="col-xs-9">
													<label class="span3">Upload Tanda Tangan (Max 3MB, *.png)</label>
													<div class="input-group">
														<span class="input-group-addon"><input type="file" accept=".png" name="signature" id="signature" placeholder="Upload Digital Signature"></span>
														<input type="hidden" name="old_signature" value="<?php echo $signature; ?>" />
														<input type="hidden" id="old_signature_path" name='old_signature_path' value="<?php echo $signature_path; ?>" />
													</div>
													<div class="input-group"><br>
														<button id="btnCollapse" class="btn btn-sm btn-default" type="button"><i class="fa fa-edit"></i> Buat Tanda Tangan</button>
													</div>
												</div>



												<!-- <div class="col-xs-4">
														<label class="span3">Buat Tanda Tangan</label>
														<div class="input-group">
															<span class="input-group-addon">
																<input type='hidden' id='dig_signature' name='dig_signature' value=''>
																<button title="signature" class="btn btn-success btn-sm" id="signature" type="button" onclick="getsignature('788')"><i class="flaticon-list-1"></i></button>
															</span>
																<input type="hidden" name="old_signature" value="<?php echo $signature; ?>"/>
																<input type="hidden" id="old_signature_path" name = 'old_signature_path' value="<?php echo $signature_path; ?>"/>
														</div>
													</div> -->
												<!-- <br>
													<p> -->

												<!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Button with data-target
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div> -->

												<div class="col-xs-3">
													<label class="span3"></label>
												</div>

												<div class="col-xs-9">
													<div class="card card-navy">
														<div class="card-body">
															<div class="collapse" id="collapseExample">
																<div id="signArea">
																	<!-- <ul class="sigNav">
																	<li class="clearButton"><a href="#clear">Clear</a></li>
																</ul> -->
																	<div class="sig sigWrapper" style="height:auto;position:relative;overflow:hidden">
																		<div class="typed"></div>
																		<canvas id="signature-pad" class="signature-pad" width="270" height="180" style="touch-action: none; user-select: none;border: 1px solid #d1d1d1;margin-bottom: 10px;"></canvas>
																		<!-- <canvas class="sign-pad" id="sign-pad" width="280" height="210"></canvas> -->
																	</div>
																	<button type='button' class='btn btn-sm btn-primary' id="sign_btn" onclick="save_sign()">Simpan</button>
																	<a id="clearButton" type='button' class='btn btn-sm btn-warning clearButton' href="#clear">Hapus</a>
																	<button type='button' class='btn btn-sm btn-danger' id="cancel_btn" onclick="cancel_sign()">Batal</button>
																</div>
															</div>

														</div>

													</div>
												</div>

											</div>
											<!-- end signature -->
										</div>



									</div>

									<div class="col-xs-6">

										<fieldset>
											<legend>Alamat Domisili :</legend>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Provinsi:</span>
													<select data-placeholder="Provinsi" class="select2 form-control input-lg" tabindex="2" name="kode_provinsi" id="kode_provinsi">
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
													<select data-placeholder="Kab/ Kota" class="select2 form-control input-lg" tabindex="2" name="kode_kabupaten" id="kode_kabupaten">
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
													<select data-placeholder="Kecamatan" class="select2 form-control input-lg" tabindex="2" name="kode_kecamatan" id="kode_kecamatan">
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
													<select data-placeholder="Kelurahan" class="select2 form-control input-lg" tabindex="2" name="kode_kelurahan" id="kode_kelurahan">
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
													<textarea class="form-control textarea input-sm" style="height: 100px;overflow:auto;resize:none" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat_pegawai; ?></textarea>
												</div>
											</div>
										</fieldset>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Tentukan Koordinat Alamat Domisili:<br /><strong>(Longitude & Latitude)</strong></span>
												<span class="input-group-addon"><a href="" class="btn btn-info" data-toggle="modal" data-target="#add_koordinat">Lihat Peta</a></span>
												<input type="hidden" id="pid" name="pid" placeholder="pid">
												<input type="text" readonly="readonly" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>">
												<input type="text" readonly="readonly" class="form-control" name="latitude" id="latitude" placeholder="latitude" value="<?php echo $latitude; ?>">
											</div><!-- /.input group -->
										</div>

										<fieldset>
											<legend>Alamat KTP : <input id="is_check" name="is_check" type="checkbox" value="1" <?php echo $is_check; ?>>
												<font size="1">Ceklist jika sama dengan alamat domisili </font>
											</legend>
											<div class="form-group" style='display: none;'>
												<div class="input-group">
													<span class="input-group-addon">Provinsi:</span>
													<select data-placeholder="Provinsi" class="select2 form-control input-lg" tabindex="2" name="kode_provinsi_ktp" id="kode_provinsi_ktp" <?php echo $onchangeProvinsiKtp; ?>>
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
													<select data-placeholder="Kab/ Kota" class="select2 form-control input-lg" tabindex="2" name="kode_kabupaten_ktp" id="kode_kabupaten_ktp" <?php echo $onchangeKabupatenKtp; ?>>
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
													<select data-placeholder="Kecamatan" class="select2 form-control input-lg" tabindex="2" name="kode_kecamatan_ktp" id="kode_kecamatan_ktp" <?php echo $onchangeKecamatanKtp; ?>>
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
													<select data-placeholder="Kelurahan" class="select2 form-control input-lg" tabindex="2" name="kode_kelurahan_ktp" id="kode_kelurahan_ktp" <?php echo $onchangeKelurahanKtp; ?>>
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
													<textarea class="form-control textarea input-sm" style="height: 100px;overflow:auto;resize:none" name="alamat_ktp" id="alamat_ktp" placeholder="Alamat"><?php echo $alamat_ktp; ?></textarea>
												</div>
											</div>
										</fieldset>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Status Pegawai :</span>
												<select class="select2 form-control input-lg" name="status_pegawai">
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
												<select class="select2 form-control input-lg" name="id_golongan">
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
												<input type="text" class="form-control datepicker" name="tanggal_mulai_pangkat" id="tanggal_mulai_pangkat" value="<?php echo (isset($tanggal_mulai_pangkat) ? date_format(date_create($tanggal_mulai_pangkat), 'd M Y') : ''); ?>" placeholder="TMT Pangkat">
											</div><!-- /.input group -->
										</div>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Status Jabatan :</span>
												<select name="id_status_jabatan_view" id="id_status_jabatan_view" class="select2 form-control input-lg">
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
												<input type="hidden" name="id_status_jabatan" id="id_status_jabatan" value="<?php echo $id_status_jabatan; ?>" />

											</div>
										</div>

										<div id="grpEselon">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Eselon :</span>
													<select class="select2 form-control" name="id_eselon" id='id_eselon'>
														<option value="">Pilih Eselon</option>
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
													<select name="id_rumpun_jabatan_view" id="id_rumpun_jabatan_view" class="select2 form-control">
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
												<select name="id_jabatan_view" id="id_jabatan_view" class="select2 form-control">
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
												<select data-placeholder="Lokasi Kerja" class="select2 form-control input-sm" tabindex="2" name="lokasi_kerja" id="lokasi_kerja">
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
												<select data-placeholder="Sub unit/Satker" class="select2 form-control input-sm" tabindex="2" name="sublokasi_kerja" id="sublokasi_kerja">
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
													<span class="input-group-addon">Seksi / Subbag / Satlak:</span>
													<select data-placeholder="Seksi / Subbag / Satlak" class="select2 form-control input-sm" tabindex="2" name="seksi" id="seksi">
														<option value=""></option>
														<?php
														foreach ($mst_sub_lokasi_kerja->result_array() as $me) {
															if ($seksi == $me['id_sub_lokasi_kerja']) {
																?>
																<option value="<?php echo $me['id_sub_lokasi_kerja']; ?>" selected="selected"><?php echo $me['sub_lokasi_kerja']; ?></option>
															<?php
																} else {
																	?>
																<option value="<?php echo $me['id_sub_lokasi_kerja']; ?>"><?php echo $me['sub_lokasi_kerja']; ?></option>
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

					<!-- <div class="tab-pane" id="dtfoto">
						<div class="row">
							<div class="col-xs-3">
								<?php
								// $ft = $foto;
								// if ($ft == "") {
								// 	$ft = "nofoto.png";
								// }
								?>
								<div class="control-group">
									<label class="span3">Upload Foto (Max 3MB)</label>
									<div class="input-group">
										<span class="input-group-addon"><input type="file" name="foto" id="foto" placeholder="Upload Foto"></span>
										<input type="hidden" name="old_file" value="<?php //echo $ft; 
																					?>" />
									</div><br />
									<div class="span6">
										<?php
										// $ft = $foto;
										// if ($ft == "") {
										// 	$ft = "nofoto.png";
										// 	
										?>
										// 	<p><img src="<?php // echo base_url(); 
															?>asset/foto_pegawai/no-image/<?php //echo $ft; 
																							?>" border="5" class="user-foto"></p>
										// <?php
											// } else {
											// 	
											?>
										// 	<p><img src="<? php // echo base_url(); 
															?>asset/foto_pegawai/thumb/<?php //echo $ft; 
																						?>" border="5" class="user-foto"></p>
										// <?php
											// }
											?>
									</div>
								</div>
							</div>
						</div>
					</div>-->
					<!-- /.tab-pane -->

					<div class="tab-pane" id="dtDigitalSignature">
						<div class="row">

							<!-- <div class="col-xs-9">
									<div class="card card-navy">
										<div class="card-body">
											<div id="signArea" >
												<ul class="sigNav">
													<li class="clearButton"><a href="#clear">Clear</a></li>
												</ul>
												<div class="sig sigWrapper" style="height:auto;">
													<div class="typed"></div>
														<canvas class="sign-pad" id="sign-pad" width="250" height="150"></canvas>
												</div>
												<button type='button' id="sign_btn" onclick ="save_sign()">Save Signature</button>
												<button type='button' id="cancel_btn" onclick ="cancel_sign()">Cancel Signature</button>
											</div>
											
										</div>
									</div>
								</div> -->

						</div>
					</div><!-- /.tab-pane -->

					<hr>


					<input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
					<input type="hidden" name="st" value="<?php echo $st; ?>">
					<input type="hidden" name="frame" value="frame">
					<?php //echo form_close(); 
					?>
					<div class="control-group">
						<div class="controls" align="center">
							<input type='hidden' id='dig_signature' name='dig_signature' value=''>
							<button type="button" id="simpan_pegawai" onclick="simpan_data()" class="btn btn-primary">Simpan Data</button>

							<!-- <input type="submit" class="btn btn-primary" value="Simpan Data"> -->
							<a href="<?php echo base_url() ?>" class="btn btn-warning">Batal Edit</a>
							<span id="ajax_loading"></span>
						</div>

					</div>
					<br>

				</div><!-- /.tab-content -->
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</form>
<?php //echo form_close(); 
?>
<!-- </section> -->



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script type="text/javascript">
	function simpan_data() {
		var formData = new FormData($('#form_simpan_data_pegawai')[0]);
		$.ajax({
			url: "<?php echo site_url('dashboard_publik/simpan'); ?>",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function(b) {
				var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" width="80px">';
				$('#ajax_loading').html(percentVal);
				$("#simpan_pegawai").attr("disabled", true);
			},
			success: function(response) {

				if (response == 'success') {
					//execute_gisapi();
					load_data('data_pegawai');
				} else {
					load_data('data_pegawai');
				}
				$("#simpan_pegawai").attr("disabled", false);
				// location.reload();
				// load_data('data_pegawai');
				// $('#javascript_gis').html(response);
				// execute_gisapi();
				// load_data('data_pegawai');

				$('html,body').scrollTop(0);
			}
		});
	}


	function execute_gisapi() {
		var nrk = $('#nrk').val();
		var longitude = $('#longitude').val();
		var latitude = $('#latitude').val();
		var nama_pegawai = $('#nama_pegawai').val();
		var nip = $('#nip').val();
		var email = $('#email').val();
		var alamat = $('#alamat').val();
		var nama_provinsi = $('#nama_provinsi').val();
		var nama_kabupaten = $('#nama_kabupaten').val();
		var nama_kecamatan = $('#nama_kecamatan').val();
		var nama_kelurahan = $('#nama_kelurahan').val();

		var url = "https://tataruang.jakarta.go.id/server/rest/services/SIADIK/PegawaiSiadik/FeatureServer/0/query?where=nrk=%27" + nrk + "%27&outFields=objectid&f=json";
		//alert(nama_provinsi);
		$.ajax({
			method: "GET",
			url: url,
			dataType: "json",
			processData: true,
			success: function(response) {
				//console.log(response);
				console.log(response.features[0]);
				var isexist = response.features[0];
				var url_ui = "https://tataruang.jakarta.go.id/server/rest/services/SIADIK/PegawaiSiadik/FeatureServer/0/applyEdits";

				//jika tidak ada tambahkan
				if (isexist == null) {
					var attributes = [{
						geometry: {
							x: longitude,
							y: latitude
						},
						attributes: {
							namapegawai: nama_pegawai,
							nip: nip,
							nrk: nrk,
							email: email,
							alamat: alamat,
							provinsi: nama_provinsi,
							kota: nama_kabupaten,
							kecamatan: nama_kecamatan,
							kelurahan: nama_kelurahan,
						},
					}, ];

					var data = {
						f: "json",
						adds: JSON.stringify(attributes),
					};
					//jika ada update
				} else {
					var objectid = response.features[0].attributes.objectid;
					var attributes = [{
						geometry: {
							x: longitude,
							y: latitude
						},
						attributes: {
							objectid: objectid,
							namapegawai: nama_pegawai,
							nip: nip,
							nrk: nrk,
							email: email,
							alamat: alamat,
							provinsi: nama_provinsi,
							kota: nama_kabupaten,
							kecamatan: nama_kecamatan,
							kelurahan: nama_kelurahan,
						},
					}, ];
					var data = {
						f: "json",
						updates: JSON.stringify(attributes),
					};
				}
				$.ajax({
					method: "POST",
					url: url_ui,
					data: data,
					dataType: "json",
					processData: true,
					success: function(response) {
						console.log(response);
						load_data('data_pegawai');

					}
				});
			}
		});
	}

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
	//onchange
	$('#id_status_jabatan_view').change(function() {
		var y = $('#id_status_jabatan_view').val();
		var val_eselon = $('#id_eselon').val();
		var val_status_jabatan = $('#id_status_jabatan_view').val();
		var val_nama_jabatan = $('#id_jabatan_view').val();

		$('#id_status_jabatan').val(val_status_jabatan);


		//alert(y);
		if (y == 2) {
			$('#grpEselon').show(); //$('#id_eselon').val('').trigger('change');
			$('#grpRumpun').hide();
			$('#id_rumpun_jabatan_view').val('').trigger('change');
		} else {
			$('#grpEselon').hide();
			$('#id_eselon').val('').trigger('change');
			$('#grpRumpun').show(); //$('#id_rumpun_jabatan_view').val('').trigger('change');
		}
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>dashboard_publik/nama_jabatan_new",
			data: {
				eselon: val_eselon,
				status_jabatan: val_status_jabatan,
				id_nama_jabatan: val_nama_jabatan
			},
			success: function(data) {
				$('#id_jabatan_view').html(data).trigger("change");;
			}
		})
	});

	$('#id_eselon').change(function() {
		var val_eselon = $('#id_eselon').val();
		var val_status_jabatan = $('#id_status_jabatan_view').val();
		var val_nama_jabatan = $('#id_jabatan_view').val();
		//alert(x);
		const targetDiv = document.getElementById("grpseksi");
		if (val_eselon === '23' || val_eselon === '24' || val_eselon === '25' || val_eselon === '26' || val_eselon === '27' || val_eselon === '28') {
			targetDiv.style.display = "none";
		} else {
			targetDiv.style.display = "block";
		}
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>dashboard_publik/nama_jabatan_new",
			data: {
				eselon: val_eselon,
				status_jabatan: val_status_jabatan,
				id_nama_jabatan: val_nama_jabatan
			},
			success: function(data) {
				$('#id_jabatan_view').html(data).trigger("change");;
			}
		})
	});

	$(document).ready(function() {

		//datepicker
		$('.datepicker').datepicker({
			autoclose: true,
			format: "dd M yyyy",
			todayHighlight: true,
			orientation: "top auto",
			todayBtn: true,
			todayHighlight: true,
			clearBtn: true
		});

		//copy text
		$('#is_check').click(function() {
			if ($('#is_check').is(':checked')) {
				console.log('checked');
				//if copy is checked
				var sesuaikan = $('#alamat').val().concat(" Kelurahan ", $('#nama_kelurahan').val(), " Kecamatan ", $('#nama_kecamatan').val(), " ", $('#nama_kabupaten').val(), " Provinsi ", $('#nama_provinsi').val());
				$('#alamat_ktp').val(sesuaikan);

				//set selected value
				$('#kode_provinsi_ktp').val($('#kode_provinsi').val()).trigger('change');
			} else {
				console.log('unchecked');

				$("#kode_provinsi_ktp")[0].setAttribute("onchange", "changeProvinsiKtp(this.value)");
				$("#kode_provinsi_ktp")[0].removeAttribute("disabled");
				$("#kode_kabupaten_ktp")[0].setAttribute("onchange", "changeKabupatenKtp(this.value)");
				$("#kode_kabupaten_ktp")[0].removeAttribute("disabled");
				$("#kode_kecamatan_ktp")[0].setAttribute("onchange", "changeKecamatanKtp(this.value)");
				$("#kode_kecamatan_ktp")[0].removeAttribute("disabled");
				$("#kode_kelurahan_ktp")[0].setAttribute("onchange", "changeKelurahanKtp(this.value)");
				$("#kode_kelurahan_ktp")[0].removeAttribute("disabled");

				$('#kode_provinsi_ktp').val('').trigger('change');
				$('#nama_provinsi_ktp').val('');
				$('#kode_kabupaten_ktp').val('').trigger('change');
				$('#kode_kabupaten_ktp').html('<option value="">Kab/ Kota</option>');
				$('#nama_kabupaten_ktp').val('');
				$('#kode_kecamatan_ktp').val('').trigger('change');
				$('#kode_kecamatan_ktp').html('<option value="">Kecamatan</option>');
				$('#nama_kecamatan_ktp').val('');
				$('#kode_kelurahan_ktp').val('').trigger('change');
				$('#kode_kelurahan_ktp').html('<option value="">Kelurahan</option>');
				$('#nama_kelurahan_ktp').val('');

			}
		});

	});
</script>

<script type="text/javascript">
	$(document).on('click', '.add-more', function(e) {
		e.preventDefault();

		var controlForm = $('.form-control1:first'),
			currentEntry = $(this).parents('.entry:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

		newEntry.find('input').val('');
		controlForm.find('.entry:not(:last) .add-more')
			.removeClass('add-more').addClass('btn-remove')
			.removeClass('btn btn-primary').addClass('btn')
			.html('Hapus Unggahan');
	}).on('click', '.btn-remove', function(e) {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});

	$(document).on('click', '.add-more2', function(e) {
		e.preventDefault();

		var controlForm = $('.form-control2:first'),
			currentEntry = $(this).parents('.entry:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

		newEntry.find('input').val('');
		controlForm.find('.entry:not(:last) .add-more2')
			.removeClass('add-more2').addClass('btn-remove')
			.removeClass('btn btn-primary').addClass('btn')
			.html('Hapus Unggahan');
	}).on('click', '.btn-remove', function(e) {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});

	$(document).on('click', '.add-more3', function(e) {
		e.preventDefault();

		var controlForm = $('.form-control3:first'),
			currentEntry = $(this).parents('.entry:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

		newEntry.find('input').val('');
		controlForm.find('.entry:not(:last) .add-more3')
			.removeClass('add-more3').addClass('btn-remove')
			.removeClass('btn btn-primary').addClass('btn')
			.html('Hapus Unggahan');
	}).on('click', '.btn-remove', function(e) {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});

	$(document).on('click', '.add-more4', function(e) {
		e.preventDefault();

		var controlForm = $('.form-control4:first'),
			currentEntry = $(this).parents('.entry:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

		newEntry.find('input').val('');
		controlForm.find('.entry:not(:last) .add-more4')
			.removeClass('add-more4').addClass('btn-remove')
			.removeClass('btn btn-primary').addClass('btn')
			.html('Hapus Unggahan');
	}).on('click', '.btn-remove', function(e) {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});

	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
		//Initialize Select2 Elements
		$('.select2').select2();
	});

	// $(document).ready(function(){
	//  $('#id_status_jabatan_view').change(function(){
	//   var id_status_jabatan = $('#id_status_jabatan_view').val();
	//   if(id_status_jabatan != '')
	//   {
	//    $.ajax({
	// 	url:"<?php //echo base_url(); 
				?>dashboard_publik/nama_jabatan",
	// 	method:"POST",
	// 	data:{id_status_jabatan:id_status_jabatan},
	// 	success:function(data)
	// 	{
	// 	 $('#id_jabatan_view').html(data);
	// 	}
	//    });
	//   }
	//   else
	//   {
	//    $('#nama_jabatan').html('<option value="">Pilih Nama Jabatan</option>');
	//   }
	//  });
	// });

	$('#lokasi_kerja').change(function() {
		var id_lokasi_kerja = $('#lokasi_kerja').val();

		{
			$.ajax({
				url: "<?php echo base_url(); ?>pegawai/sub_lokasi_kerja_by_lokasi_kerja",
				method: "POST",
				data: {
					id_lokasi_kerja: id_lokasi_kerja
				},
				success: function(data) {
					$('#seksi').html(data);
				}
			});
		}

		if (id_lokasi_kerja != '52') {
			document.getElementById("sublokasi").style.display = "none";
		} else {
			document.getElementById("sublokasi").style.display = "block";
		}

	});

	// onload lokasi kerja
	var id_lokasi_kerja = $('#lokasi_kerja').val();
	if (id_lokasi_kerja != '52') {
		document.getElementById("sublokasi").style.display = "none";
	} else {
		document.getElementById("sublokasi").style.display = "block";
	}

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
	//

	$('#kode_provinsi').change(function() {
		var kode_provinsi = this.value;

		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_provinsi_data",
			method: "POST",
			data: {
				kode_provinsi: kode_provinsi
			},
			success: function(data) {
				let resp = JSON.parse(data);
				$('#nama_provinsi').val(resp.nama_provinsi);

				//generate kab/kota
				gen_dropdown_kabupaten(kode_provinsi);
			}
		});

	});

	function gen_dropdown_kabupaten(kode_provinsi) {
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/gen_dropdown_kabupaten",
			method: "POST",
			data: {
				kode_provinsi: kode_provinsi
			},
			success: function(data) {
				$('#kode_kabupaten').html(data);
				$('#nama_kabupaten').val('');
				$('#kode_kecamatan').html('');
				$('#nama_kecamatan').val('');
				$('#kode_kelurahan').html('');
				$('#nama_kelurahan').val('');
			}
		});
	}


	$('#kode_kabupaten').change(function() {
		var kode_kabupaten = this.value;

		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_kabupaten_data",
			method: "POST",
			data: {
				kode_kabupaten: kode_kabupaten
			},
			success: function(data) {
				let resp = JSON.parse(data);
				$('#nama_kabupaten').val(resp.nama_kabupaten);

				//generate kab/kota
				gen_dropdown_kecamatan(kode_kabupaten);
			}
		});

	});

	function gen_dropdown_kecamatan(kode_kabupaten) {
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/gen_dropdown_kecamatan",
			method: "POST",
			data: {
				kode_kabupaten: kode_kabupaten
			},
			success: function(data) {
				$('#kode_kecamatan').html(data);
				$('#nama_kecamatan').val('');
				$('#kode_kelurahan').html('');
				$('#nama_kelurahan').val('');
			}
		});
	}

	$('#kode_kecamatan').change(function() {
		var kode_kecamatan = this.value;

		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_kecamatan_data",
			method: "POST",
			data: {
				kode_kecamatan: kode_kecamatan
			},
			success: function(data) {
				let resp = JSON.parse(data);
				$('#nama_kecamatan').val(resp.nama_kecamatan);

				//generate kab/kota
				gen_dropdown_kelurahan(kode_kecamatan);
			}
		});

	});

	function gen_dropdown_kelurahan(kode_kecamatan) {
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/gen_dropdown_kelurahan",
			method: "POST",
			data: {
				kode_kecamatan: kode_kecamatan
			},
			success: function(data) {
				$('#nama_kelurahan').val('');
				$('#kode_kelurahan').html(data);
			}
		});
	}

	$('#kode_kelurahan').change(function() {
		var kode_kelurahan = this.value;

		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_kelurahan_data",
			method: "POST",
			data: {
				kode_kelurahan: kode_kelurahan
			},
			success: function(data) {
				let resp = JSON.parse(data);
				$('#nama_kelurahan').val(resp.nama_kelurahan);
			}
		});

	});

	function changeProvinsiKtp(kode_provinsi) {
		console.log('changeProvinsiKtp');
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_provinsi_data",
			method: "POST",
			data: {
				kode_provinsi: kode_provinsi
			},
			success: function(data) {
				let resp = JSON.parse(data);

				if (resp != null) {
					$('#nama_provinsi_ktp').val(resp.nama_provinsi);

					//generate kab/kota
					gen_dropdown_kabupaten_ktp(kode_provinsi);
				}
			}
		});
	}

	function gen_dropdown_kabupaten_ktp(kode_provinsi) {
		console.log('gen_dropdown kab ktp');
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/gen_dropdown_kabupaten",
			method: "POST",
			data: {
				kode_provinsi: kode_provinsi
			},
			success: function(data) {
				$('#nama_kabupaten_ktp').val('');
				$('#kode_kecamatan_ktp').html('');
				$('#nama_kecamatan_ktp').val('');
				$('#kode_kelurahan_ktp').html('');
				$('#nama_kelurahan_ktp').val('');
				$('#kode_kabupaten_ktp').html(data);

				if ($('#is_check').is(':checked')) {
					//set default selected
					$('#kode_kabupaten_ktp').val($('#kode_kabupaten').val()).trigger('change');
				}
			}
		});
	}

	function changeKabupatenKtp(kode_kabupaten) {
		console.log('change kab ktp');
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_kabupaten_data",
			method: "POST",
			data: {
				kode_kabupaten: kode_kabupaten
			},
			success: function(data) {
				let resp = JSON.parse(data);
				if (resp != null) {
					$('#nama_kabupaten_ktp').val(resp.nama_kabupaten);

					//generate kab/kota
					gen_dropdown_kecamatan_ktp(kode_kabupaten);
				}
			}
		});
	}

	function gen_dropdown_kecamatan_ktp(kode_kabupaten) {
		console.log('gen drop kec ktp:');
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/gen_dropdown_kecamatan",
			method: "POST",
			data: {
				kode_kabupaten: kode_kabupaten
			},
			success: function(data) {
				$('#nama_kecamatan_ktp').val('');
				$('#kode_kelurahan_ktp').html('');
				$('#nama_kelurahan_ktp').val('');
				$('#kode_kecamatan_ktp').html(data);

				if ($('#is_check').is(':checked')) {
					//set default selected
					$('#kode_kecamatan_ktp').val($('#kode_kecamatan').val()).trigger('change');
				}
			}
		});
	}

	function changeKecamatanKtp(kode_kecamatan) {
		console.log('change kec ktp');
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_kecamatan_data",
			method: "POST",
			data: {
				kode_kecamatan: kode_kecamatan
			},
			success: function(data) {
				let resp = JSON.parse(data);
				if (resp != null) {
					$('#nama_kecamatan_ktp').val(resp.nama_kecamatan);

					//generate kab/kota
					gen_dropdown_kelurahan_ktp(kode_kecamatan);
				}
			}
		});

	}

	function gen_dropdown_kelurahan_ktp(kode_kecamatan) {
		console.log('gen kel ktp');
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/gen_dropdown_kelurahan",
			method: "POST",
			data: {
				kode_kecamatan: kode_kecamatan
			},
			success: function(data) {
				$('#nama_kelurahan_ktp').val('');
				$('#kode_kelurahan_ktp').html(data);

				if ($('#is_check').is(':checked')) {
					//set default selected
					$('#kode_kelurahan_ktp').val($('#kode_kelurahan').val()).trigger('change');
				}
			}
		});
	}

	function changeKelurahanKtp(kode_kelurahan) {
		console.log('change kel ktp');
		$.ajax({
			url: "<?php echo base_url(); ?>wilayah/get_kelurahan_data",
			method: "POST",
			data: {
				kode_kelurahan: kode_kelurahan
			},
			success: function(data) {
				let resp = JSON.parse(data);
				if (resp != null) {
					$('#nama_kelurahan_ktp').val(resp.nama_kelurahan);

					if ($('#is_check').is(':checked')) {
						//set default selected
						$('#kode_provinsi_ktp')[0].removeAttribute('onchange');
						$('#kode_kabupaten_ktp')[0].removeAttribute('onchange');
						$('#kode_kecamatan_ktp')[0].removeAttribute('onchange');
						$('#kode_kelurahan_ktp')[0].removeAttribute('onchange');

						$('#kode_provinsi_ktp')[0].setAttribute('disabled', true);
						$('#kode_kabupaten_ktp')[0].setAttribute('disabled', true);
						$('#kode_kecamatan_ktp')[0].setAttribute('disabled', true);
						$('#kode_kelurahan_ktp')[0].setAttribute('disabled', true);

					}
				}
			}
		});
	}
</script>

<script type="text/javascript">
	function getsignature(Id) {
		$.ajax({
			type: "post",
			data: {
				Id: Id
			},
			url: "<?php echo site_url('/Dashboard_publik/modal_signature'); ?>",
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
	$(document).ready(function() {
		//var canvas = document.getElementById('signature-pad');
		//canvas.getContext("2d");
		// $('#signArea').signaturePad({
		// 	drawOnly: true,
		// 	drawBezierCurves: true,
		// 	lineTop: 0,
		// 	penCap: 'butt',
		// });

	});

	var canvas = document.getElementById('signature-pad');
	document.getElementById('btnCollapse').addEventListener('click', function () {
		$("#collapseExample").collapse();
		signaturePad.clear();
		var ratio =  Math.max(window.devicePixelRatio || 1, 1);
		console.log(ratio);
		canvas.width = canvas.offsetWidth * ratio;
		canvas.height = canvas.offsetHeight * ratio;
		canvas.getContext("2d").scale(ratio, ratio);
	});

	var signaturePad = new SignaturePad(canvas, {
		backgroundColor: 'rgb(255, 255, 255)', // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
		minWidth: 1.7,
		maxWidth: 1.7,
		penColor: "rgb(4, 117, 217)"
	});

	var cel = document.getElementById('clearButton');
	if(cel){
		cel.addEventListener('click', function () {
			signaturePad.clear();
		});
	}

	function save_sign() {
		//$('#signature_pic').focus();
		//document.getElementById('#signature_pic').focus();
		//$('#signature_pic').focus();
		// $('html, body').animate({
		// 	scrollTop: $('#tanggal_lahir').offset().top
		// }, 'fast');
		// html2canvas([document.getElementById('sign-pad')], {
		// 	onrendered: function(canvas) {
		// 		var ctx = canvas.getContext("2d");
		// 		ctx.fillStyle = "#0000";
    	// 		ctx.clearRect(0, 0, canvas.width, canvas.height);
    	// 		ctx.fillRect(0, 0, canvas.width, canvas.height);

		// 		var canvas_img_data = canvas.toDataURL('image/png');
		// 		var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
		// 		var element = document.getElementById('signature_pic');
		// 		element.style = '';
		// 		document.getElementById("signature_pic").style.backgroundImage = "url('data:image/(png|jpg);base64," + img_data + "')";
		// 		//document.getElementById("kt_edit_signature").classList.add("kt-avatar--changed");
		// 		document.getElementById("signature_pic").style.backgroundSize = "100% 100%";
		// 		document.getElementById("signature_pic").style.width = "100px";
		// 		document.getElementById("signature_pic").style.height = "100px";
		// 		document.getElementById("dig_signature").value = img_data;
		// 	}
		// });
		// -----------
		// Rizki 
		// -----------
		// var data = signaturePad.toDataURL('image/svg+xml');
		// console.log(encodeURIComponent(data));
		// document.getElementById("dig_signature").value = encodeURIComponent(data);
		// var element = document.getElementById('signature_pic');
		// element.style = '';
		// document.getElementById("signature_pic").style.backgroundImage = `url(${data})`;
		// document.getElementById("signature_pic").style.backgroundSize = "100% 100%";
		// document.getElementById("signature_pic").style.width = "100px";
		// document.getElementById("signature_pic").style.height = "100px";
		// -----------
		// END Rizki 
		// -----------
		// set image to png
		var data = signaturePad.toDataURL('image/png');
		console.log(encodeURIComponent(data));
		document.getElementById("dig_signature").value = encodeURIComponent(data);
		var element = document.getElementById('signature_pic');
		element.style = '';
		document.getElementById("signature_pic").style.backgroundImage = `url(${data})`;
		document.getElementById("signature_pic").style.backgroundSize = "100% 100%";
		document.getElementById("signature_pic").style.width = "100px";
		document.getElementById("signature_pic").style.height = "100px";
	}

	function cancel_sign() {
		// var old_sign = $('#old_signature_path').val();
		// //alert(old_sign);
		// document.getElementById("signature_pic").style.backgroundImage = "url('" + old_sign + "')";
		document.getElementById("signature_pic").style.backgroundRepeat = "no-repeat";
		document.getElementById("dig_signature").value = '';
		signaturePad.clear();
	}

	// === prevent keypress on specified control ===
	$(function() {
		$('#tanggal_lahir').keypress(function(event) {
			event.preventDefault();
			return false;
		});
		$('#tanggal_mulai_pangkat').keypress(function(event) {
			event.preventDefault();
			return false;
		});
	});

</script>

<script type="text/javascript">
    
    var el = document.getElementById('save-ttd');
	if(el) {
		el.addEventListener('click', function () {
			if (signaturePad.isEmpty()) {
				return alert("Please provide a signature first.");
			}
			const form = document.getElementById("ttdForm");
			
			form.submit();
		});
	}
</script>