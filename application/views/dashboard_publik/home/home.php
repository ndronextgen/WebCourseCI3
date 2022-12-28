<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php echo $judul_lengkap . ' - ' . $instansi; ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- show icon -->
	<link rel="icon" href="<?php echo base_url(); ?>asset/img/icon.png" type="image/gif">
	<!-- jquery -->
	<script src="<?php echo base_url(); ?>asset/jquery/jquery-2.1.3.min.js"></script>
	<!-- Bootstrap 3.3.2 -->
	<link href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap.min2.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min3.js"></script>
	<!-- Font Awesome Icons -->
	<link href="<?php echo base_url(); ?>asset/plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="<?php echo base_url(); ?>asset/plugins/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>asset/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?>asset/dist/js/adminlte.min.js"></script>
	<!-- Select2 -->
	<link href="<?php echo base_url(); ?>asset/select2/css/select2.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/select2/js/select2.full.min.js"></script>
	<!-- Datepicker -->
	<link href="<?php echo base_url(); ?>asset/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<!-- Datatables -->
	<!-- <link href="<?php //echo base_url(); 
						?>asset/datatables/css/dataTables.bootstrap.css" rel="stylesheet"> -->
	<script src="<?php echo base_url(); ?>asset/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/datatables/js/dataTables.bootstrap.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>asset/bootstrap/js/fastclick.min.js"></script>
	<link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/js/application.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


	<!-- load javascript api for arcgis -->
	<!-- <link rel="stylesheet" href="https://js.arcgis.com/4.9/esri/css/main.css">
	<script src="https://js.arcgis.com/4.9/"></script> -->
	<link rel="stylesheet" href="https://js.arcgis.com/4.21/esri/themes/light/main.css">
	<script src="https://js.arcgis.com/4.21/"></script>

	<!-- sso styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>sso/css/style.css" />

	<style type="text/css">
		.modal-dialog {
			width: 90% !important;
		}

		#viewDiv {
			padding: 0;
			margin: 0;
			height: 100%;
			width: 100%;
		}
	</style>
</head>

<body class="skin-blue layout-top-nav">
	<div class="wrapper navbar-inverse">
		<header class="main-header">
			<nav class="navbar navbar-fixed-top">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="navbar-brand" href="<?php echo base_url(); ?>dashboard_publik"><?php echo $judul_pendek; ?></a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="active"><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
							<li><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
							<li class="dropdown"><a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-fire icon-white"></i> Cuti Pegawai <b class=""></b></a></li>
							<!-- <li class="dropdown user user-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<span class="hidden-xs">Kertas Kerja <i class="caret"></i></span>
									</a>
									<ul class="dropdown-menu">
											<li><a href="<?php //echo base_url(); 
															?>dashboard_publik/pengajuan_surat"><i class="icon-leaf icon-white"></i> Pengajuan Surat</a></li>
											<li><a href="<?php //echo base_url(); 
															?>dashboard_publik/status_surat"><i class="icon-off"></i> Status Surat</a></li>
									</ul>			
								</li> -->

							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="hidden-xs">Kertas Kerja &nbsp;&nbsp;&nbsp;<span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span><i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/pengajuan_surat"><i class="icon-leaf icon-white"></i> Pengajuan Surat </a></li>
									<li><a href="<?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-off"></i> Status Surat&nbsp;&nbsp;&nbsp;<span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span></a></li>
								</ul>
							</li>

							<!-- <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Panduan<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_manualbook" target=""><i class="icon-fire"></i> Panduan Penggunaan</a></li>
								</ul>
							</li> -->

							<li class=""><a href="<?php echo base_url(); ?>dashboard_publik/download_manualbook" title="Download Panduan Penggunaan"><i class="icon-home icon-white"></i> Panduan</a></li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Pedoman<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_3" target=""><i class="icon-fire"></i> SK Kepala Dinas Update Data SI-ADiK</a></li>
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_1" target=""><i class="icon-fire"></i> Permendikbud RI No. 50 Tahun 2015</a></li>
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_2" target=""><i class="icon-fire"></i> Pergub DKI Jakarta No. 99 Tahun 2021</a></li>
								</ul>
							</li>

							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?php
									$ft = $foto;
									if ($ft == "") {
										$ft = "nofoto.png";
										?>
										<img src="<?php echo base_url(); ?>asset/foto_pegawai/no-image/<?php echo $ft; ?>" class="user-image" alt="User Image" />
									<?php
									} else {
										?>
										<img src="<?php echo base_url(); ?>asset/foto_pegawai/thumb/<?php echo $ft; ?>" class="user-image" alt="User Image" />
									<?php
									}
									?>
									<span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?> <i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>app/change_password_publik"><i class="icon-wrench"></i> Pengaturan Akun</a></li>
									<li><a href="<?php echo base_url(); ?>app/logout"><i class="icon-off"></i> Log Out</a></li>
								</ul>
							</li>
							<ul />
					</div>
				</div>
			</nav>
		</header>

		<div class="content-wrapper">
			<div class="container">
				<section class="content-header">
					<div class="nav-tabs-custom">
						<div class="row">
							<div class="">
								<h3>
									<center><?php echo $judul_lengkap . '<br/> ' . $instansi; ?>
								</h3>
							</div>
							<div class="span">
								<p>
									<center><?php echo $alamat_instansi; ?>
								</p>
							</div>
						</div>
					</div>

					<?php echo form_open_multipart('dashboard_publik/simpan', 'class="form-horizontal"'); ?>

					<div class="navbar subnav" role="navigation">
						<div class="navbar-inner">
							<div class="box-body">
								<ul class="pager subnav-pager">
									<div class="btn-group-wrap">
										<li><a href="#data-pegawai"><strong>Pegawai</strong></a></li>
										<li><a href="#data-keluarga"><strong>Keluarga</strong></a></li>
										<li><a href="#data-pangkat"><strong>Pangkat</strong></a></li>
										<li><a href="#data-jabatan"><strong>Jabatan</strong></a></li>
										<li><a href="#data-pendidikan"><strong>Pendidikan</strong></a></li>
										<li><a href="#data-pelatihan"><strong>Pelatihan</strong></a></li>
										<li><a href="#data-penghargaan"><strong>Penghargaan</strong></a></li>
										<li><a href="#data-tubel"><strong>Tugas & Izin Belajar</strong></a></li>
										<li><a href="#data-dp3"><strong>SPK / DP3</strong></a></li>
										<li><a href="#data-hukuman"><strong>Hukuman</strong></a></li>
									</div>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<!-- Main content -->
				<section id="data-pegawai" class="content">

					<div class="callout callout-info">
						<h4>Data Pegawai</h4>
						<p>Berisi data utama pegawai, foto, serta data-data arsip digital. Silahkan dilengkapi.</p>
					</div>

					<?php if ($this->session->flashdata('suksesedit')) { ?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<h4>SUKSES !!!</h4>
							<?php echo $this->session->flashdata('suksesedit'); ?>
						</div>
					<?php } ?>

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
																	<p><img src="<?php echo base_url(); ?>asset/foto_pegawai/thumb/<?php echo $ft; ?>" border="5" class="user-foto"></p>
																<?php
																}
																?>
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
																<select data-placeholder="Jenis Kelamin" disabled="disabled" class="select2 form-control input-lg" tabindex="2" name="jenis_kelamin">
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
																<input type="text" disabled="disabled" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" placeholder="Tanggal Lahir">
															</div><!-- /.input group -->
														</div>

														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon">Tanda Tangan Digital :</span>
																<img src="<?php echo $signature; ?>" border="5" class="user-foto">
															</div><!-- /.input group -->
														</div>

														<fieldset>
															<legend>Alamat Domisili :</legend>
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon">Provinsi:</span>
																	<select data-placeholder="Provinsi" class="select2 form-control input-lg" tabindex="2" name="kode_provinsi" id="kode_provinsi" disabled="disabled">
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
																	<select data-placeholder="Kab/ Kota" class="select2 form-control input-lg" tabindex="2" name="kode_kabupaten" id="kode_kabupaten" disabled="disabled">
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
																	<select data-placeholder="Kecamatan" class="select2 form-control input-lg" tabindex="2" name="kode_kecamatan" id="kode_kecamatan" disabled="disabled">
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
																	<select data-placeholder="Kelurahan" class="select2 form-control input-lg" tabindex="2" name="kode_kelurahan" id="kode_kelurahan" disabled="disabled">
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
																	<textarea class="form-control textarea" style="height: 100px;overflow:auto;resize:none" name="alamat" id="alamat" placeholder="Alamat" readonly="readonly"><?php echo $alamat; ?></textarea>
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

													</div>

													<div class="col-xs-6">

														<fieldset>
															<legend>Alamat KTP : </legend>
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon">Provinsi:</span>
																	<select data-placeholder="Provinsi" class="select2 form-control input-lg" tabindex="2" name="kode_provinsi_ktp" id="kode_provinsi_ktp" disabled="disabled">
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
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon">Kab/ Kota:</span>
																	<select data-placeholder="Kab/ Kota" class="select2 form-control input-lg" tabindex="2" name="kode_kabupaten_ktp" id="kode_kabupaten_ktp" disabled="disabled">
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
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon">Kecamatan:</span>
																	<select data-placeholder="Kecamatan" class="select2 form-control input-lg" tabindex="2" name="kode_kecamatan_ktp" id="kode_kecamatan_ktp" disabled="disabled">
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
															<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon">Kelurahan:</span>
																	<select data-placeholder="Kelurahan" class="select2 form-control input-lg" tabindex="2" name="kode_kelurahan_ktp" id="kode_kelurahan_ktp" disabled="disabled">
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
																	<textarea class="form-control textarea" style="height: 100px;overflow:auto;resize:none" name="alamat_ktp" id="alamat_ktp" placeholder="Alamat" readonly="readonly"><?php echo $alamat_ktp; ?></textarea>
																</div>
															</div>
														</fieldset>

														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon">Agama :</span>
																<select data-placeholder="Agama" disabled="disabled" class="select2 form-control input-lg" tabindex="2" name="agama">
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
																<select data-placeholder="Status Nikah" disabled="disabled" class="select2 form-control input-lg" tabindex="2" name="status_nikah">
																	<?php
																	$belum_nikah = "";
																	$sudah_nikah = "";
																	$kosong1 = "";
																	if ($status_nikah == "Belum Nikah") {
																		$belum_nikah = 'selected="selected"';
																		$sudah_nikah = "";
																		$kosong1 = "";
																	} else if ($status_nikah == "Sudah Nikah") {
																		$belum_nikah = '';
																		$sudah_nikah = 'selected="selected"';
																		$kosong1 = "";
																	} else {
																		$belum_nikah = '';
																		$sudah_nikah = '';
																		$kosong1 = 'selected="selected"';
																	}
																	?>
																	<option value="" <?php echo $kosong1; ?>></option>
																	<option value="Belum Nikah" <?php echo $belum_nikah; ?>>Belum Nikah</option>
																	<option value="Sudah Nikah" <?php echo $sudah_nikah; ?>>Sudah Nikah</option>
																</select>
															</div>
														</div>


														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon">Status Pegawai :</span>
																<select class="select2 form-control input-lg" disabled="disabled" name="status_pegawai">
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
																<span class="input-group-addon">Pendidikan Terakhir :</span>
																<select data-placeholder="Pendidikan" disabled="disabled" class="select2 form-control input-lg" tabindex="2" name="pendidikan">
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
																<select data-placeholder="Pendidikan BKD" disabled="disabled" class="select2 form-control input-lg" tabindex="2" name="pendidikan_bkd">
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
																<span class="input-group-addon">Golongan:</span>
																<select class="select2 form-control input-lg" disabled="disabled" name="id_golongan">
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
																<input type="text" disabled="disabled" class="form-control datepicker" name="tanggal_mulai_pangkat" id="tanggal_mulai_pangkat" value="<?php echo $tanggal_mulai_pangkat; ?>" placeholder="TMT Pangkat">
															</div><!-- /.input group -->
														</div>

														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon">Eselon :</span>
																<select class="select2 form-control input-lg" disabled="disabled" name="id_eselon">
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

														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon">Status Jabatan :</span>
																<select name="id_status_jabatan" id="id_status_jabatan" disabled="disabled" class="select2 form-control input-lg">
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

														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon">Nama Jabatan :</span>
																<select name="id_jabatan" id="id_jabatan" disabled="disabled" class="select2 form-control input-lg">
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
																<span class="input-group-addon">Lokasi Kerja :</span>
																<select data-placeholder="Lokasi Kerja" disabled="disabled" class="select2 form-control" tabindex="2" name="lokasi_kerja" id="lokasi_kerja">
																	<option value=""></option>
																	<?php
																	foreach ($mst_lokasi_kerja->result_array() as $me) {
																		if ($lokasi_kerja == $me['id_lokasi_kerja']) {
																			?>
																			<option value="<?php echo $me['id_lokasi_kerja']; ?>" selected="selected"><?php echo $me['lokasi_kerja']; ?></option>
																		<?php
																			} else {
																				?>
																			<option value="<?php echo $me['id_lokasi_kerja']; ?>"><?php echo $me['lokasi_kerja']; ?></option>
																	<?php
																		}
																	}
																	?>
																</select>
															</div>
														</div>

														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon">Seksi / Subbag / Satlak :</span>
																<select data-placeholder="Seksi / Subbag / Satlak" disabled="disabled" class="select2 form-control" tabindex="2" name="seksi" id="seksi">
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
									</div><!-- /.tab-pane -->

									<div class="control-group">
										<div class="controls" align="center">
											<a href="<?php echo base_url(); ?>dashboard_publik/edit" class="btn btn-danger">Edit Data Pegawai</a>
										</div>
									</div>

									<input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
									<input type="hidden" name="st" value="<?php echo $st; ?>">
									<input type="hidden" name="frame" value="frame">
									<?php echo form_close(); ?>
								</div><!-- /.tab-content -->
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<!-- Main content -->
				<section id="data-keluarga" class="content">
					<div class="callout callout-info">
						<h4>Data-Data Riwayat</h4>
						<p>Berisi data-data riwayat diri maupun kepegawaian. Silahkan dilengkapi.</p>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Keluarga</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_keluarga()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Keluarga</button>
									<button class="btn btn-default" onclick="reload_table_keluarga()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_keluarga" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Keluarga</th>
												<th>Hubungan Keluarga</th>
												<th>Jenis Kelamin</th>
												<th>Tanggal Lahir</th>
												<th>Keterangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-pangkat" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Riwayat Pangkat</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_pangkat()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Pangkat</button>
									<button class="btn btn-default" onclick="reload_table_pangkat()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_pangkat" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Golongan</th>
												<th>Lokasi Kerja</th>
												<th>Nomor SK</th>
												<th>Tanggal SK</th>
												<th>TMT</th>
												<th style="width:125px;">Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-jabatan" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Riwayat Jabatan</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_jabatan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Jabatan</button>
									<button class="btn btn-default" onclick="reload_table_jabatan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_jabatan" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Status Jabatan</th>
												<th>Nama Jabatan</th>
												<th>Lokasi</th>
												<th>TMT</th>
												<th>Tgl. SK</th>
												<th>No. SK</th>
												<th style="width:125px;">Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-pendidikan" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Riwayat Pendidikan</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_pendidikan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Pendidikan</button>
									<button class="btn btn-default" onclick="reload_table_pendidikan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_pendidikan" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Tingkat Pendidikan</th>
												<th>Jurusan</th>
												<th>Tempat Pendidikan</th>
												<th>Kota</th>
												<th>Tanggal Lulus</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-pelatihan" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Riwayat Pelatihan</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_pelatihan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Pelatihan</button>
									<button class="btn btn-default" onclick="reload_table_pelatihan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_pelatihan" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Pelatihan</th>
												<th>Lokasi</th>
												<th>Nomor Sertifikat</th>
												<th>Tanggal Sertifikat</th>
												<th>Keterangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-penghargaan" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Riwayat Penghargaan</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_penghargaan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Penghargaan</button>
									<button class="btn btn-default" onclick="reload_table_penghargaan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_penghargaan" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Penghargaan</th>
												<th>Pemberi Penghargaan</th>
												<th>Nomor SK</th>
												<th>Tanggal SK</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-tubel" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Tugas & Izin Belajar</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_tubel()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Tugas & Izin Belajar</button>
									<button class="btn btn-default" onclick="reload_table_tubel()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_tubel" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Status Belajar</th>
												<th>Nomor SK</th>
												<th>Tanggal SK</th>
												<th>Sekolah</th>
												<th>Akreditasi</th>
												<th>Jurusan</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-dp3" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data SKP / DP3</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_skp()"><i class="glyphicon glyphicon-plus"></i> Tambah Data SKP / DP3</button>
									<button class="btn btn-default" onclick="reload_table_skp()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<table id="table_skp" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Jenis Data</th>
												<th>Tahun</th>
												<th>Rata-rata</th>
												<th>Atasan Penilai</th>
												<th>Penilai</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

				<section id="data-hukuman" class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<div class="page-header">
										<h1>Data Hukuman</h1>
									</div>
									<br />
									<button class="btn btn-success" onclick="add_hukuman()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Hukuman</button>
									<button class="btn btn-default" onclick="reload_table_hukuman()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<br />
									<br />
									<div class='table-responsive'>
										<table id="table_hukuman" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>No.</th>
													<th>Jenis Hukuman</th>
													<th>Uraian</th>
													<th>Nomor SK</th>
													<th>Tanggal SK</th>
													<th>File</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
				<br /><br />
				<footer class="main-header">
					<nav class="navbar navbar-fixed-bottom">
						<div class="container">
							<p><?php echo $credit; ?></p>
						</div>
					</nav>
				</footer>

				<!-- Bootstrap modal -->
				<div class="modal fade" id="add_koordinat" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h3 class="modal-title" align="center">Koordinat Alamat Anda</h3>
							</div>
							<div class="modal-body">
								<div class="control-group">
									<div class="control-label">
										<!-- <div id="viewDiv" align="center" style="height:530px;width:565px;overflow:visible;"></div> -->
										<div id="viewDiv" style="width: 100%; height: 450px;"></div>
									</div>
								</div>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- modal download -->
				<div class="modal modal-primary fade" id="modal-download-arsip" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title"><i class="icon ion-ios-paper"></i> Download File </h4>
							</div>
							<div class="modal-body">
								<div class="box-body">
									<div class="row">
										<div class="col-md-12">
											<p>Men-download File &nbsp;<i class="fa fa-refresh fa-spin"></i></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Bootstrap modal -->
			</div>
		</div>
	</div>


	<?php
	//106.8456 -6.20876


	if ($longitude == "") {
		$long = 106.798;
	} else {
		$long = $longitude;
	}
	if ($latitude == "") {
		$lat = -6.176;
	} else {
		$lat = $latitude;
	}
	?>

	<!-- Coding javascript api for arcgis untuk menampilkan peta -->
	<script type="text/javascript">
		var lokasibaru = [<?php echo $long; ?>, <?php echo $lat; ?>, 2000];
		var map;

		require([
			"esri/Map",
			"esri/views/MapView",
			"esri/layers/FeatureLayer",
			"esri/layers/VectorTileLayer",
			"esri/Basemap",
			"esri/widgets/LayerList",
			"esri/layers/GroupLayer",
			"esri/layers/MapImageLayer",
			"esri/widgets/Sketch",
			"esri/widgets/Slider",
			"esri/Graphic",
			"esri/geometry/Point",
			"esri/symbols/SimpleMarkerSymbol",
			"esri/widgets/Search",
			"esri/widgets/Locate",
		], (
			Map,
			MapView,
			FeatureLayer,
			VectorTileLayer,
			Basemap,
			LayerList,
			GroupLayer,
			MapImageLayer,
			Sketch,
			Slider,
			Graphic,
			Point,
			SimpleMarkerSymbol,
			Search,
			Locate
		) => {
			let vtlLayer = new VectorTileLayer({
				url: "https://jakartasatu.jakarta.go.id/server/rest/services/Hosted/peta_dasar_update_2019_vt/VectorTileServer",
			});

			var petsstruktur = new MapImageLayer({
				url: "https://jakartasatu.jakarta.go.id/server/rest/services/DCKTRP/Peta_Struktur_Jakarta_2018_Garis/MapServer/",
				title: "Peta Struktur",
			});

			var zonasi = new MapImageLayer({
				url: "https://tataruang.jakarta.go.id/server/rest/services/peta_operasional/Informasi_Rencana_Kota_DKI_Jakarta_View/MapServer",
				title: "Zonasi",
			});

			var citraDKI = new MapImageLayer({
				url: "https://jakartasatu.jakarta.go.id/imageserver/rest/services/Citra/CitraDKI2020_EditMask/MapServer",
				title: "Citra DKI",
			});

			// var batasadministrasi = new FeatureLayer({
			//     url: "https://tataruang.jakarta.go.id/server/rest/services/Batas_Administrasi_Update/Batas_Administrasi_DKI_Jakarta_Update_View/MapServer/",
			//     visible: false,
			// });

			const demographicGroupLayer = new GroupLayer({
				title: "PETA STRUKTUR",
				visible: true,
				//visibilityMode: "independent",
				visibilityMode: "exclusive",
				layers: [zonasi, citraDKI, petsstruktur],
				//opacity: 0.75
			});

			let basemapDKI = new Basemap({
				baseLayers: [vtlLayer],
			});

			var map = new Map({
				basemap: 'osm',
				layers: [demographicGroupLayer],
			});

			var view = new MapView({
				container: "viewDiv",
				center: lokasibaru, //lonlat
				//center: [106.82737800062135, -6.176139634482833], //lonlat
				map: map,
				zoom: 17,
			});

			var point = new Point({
				longitude: <?php echo $long; ?>,
				latitude: <?php echo $lat; ?>
			});

			// Create a symbol for drawing the point
			var markerSymbol = new SimpleMarkerSymbol({
				color: [226, 119, 40],
				outline: {
					color: [255, 255, 255],
					width: 1
				}
			});

			// Create a graphic and add the geometry and symbol to it
			var pointGraphic = new Graphic({
				geometry: point,
				symbol: markerSymbol
			});

			// Add the graphic to the view
			view.graphics.add(pointGraphic);

			// setting opacity dll
			function defineActions(event) {
				const item = event.item;

				if (item.title === "PETA STRUKTUR") {
					item.actionsSections = [
						[{
								title: "Go to full extent",
								className: "esri-icon-zoom-out-fixed",
								id: "full-extent",
							},
							{
								title: "Layer information",
								className: "esri-icon-description",
								id: "information",
							},
						],
						[{
								title: "Increase opacity",
								className: "esri-icon-up",
								id: "increase-opacity",
							},
							{
								title: "Decrease opacity",
								className: "esri-icon-down",
								id: "decrease-opacity",
							},
						],
					];
				}

				// Adds a slider for updating a group layer's opacity
				if (item.children.length > 1 && item.parent) {
					const slider = new Slider({
						min: 0,
						max: 1,
						precision: 2,
						values: [1],
						visibleElements: {
							labels: true,
							rangeLabels: true,
						},
					});

					item.panel = {
						content: slider,
						className: "esri-icon-sliders-horizontal",
						title: "Change layer opacity",
					};

					slider.on("thumb-drag", (event) => {
						const {
							value
						} = event;
						item.layer.opacity = value;
					});
				}
			}
			// end ,defineActions

			view.when(() => {
				const layerList = new LayerList({
					view: view,
					listItemCreatedFunction: defineActions,
				});

				layerList.on("trigger-action", (event) => {
					const visibleLayer = zonasi.visible ? zonasi : citraDKI;

					const id = event.action.id;

					if (id === "full-extent") {
						view.goTo(visibleLayer.fullExtent).catch((error) => {
							if (error.name != "AbortError") {
								console.error(error);
							}
						});
					} else if (id === "information") {
						window.open(visibleLayer.url);
					} else if (id === "increase-opacity") {
						if (demographicGroupLayer.opacity < 1) {
							demographicGroupLayer.opacity += 0.25;
						}
					} else if (id === "decrease-opacity") {
						if (demographicGroupLayer.opacity > 0) {
							demographicGroupLayer.opacity -= 0.25;
						}
					}
				});
				view.ui.add(layerList, "top-right");
			});

			const searchWidget = new Search({
				view: view,
				popupEnabled: false,
			});
			searchWidget.on("search-clear", function(event) {
				view.graphics.removeAll();
				$("input#longitude").val("");
				$("input#latitude").val("");
				$("input#pid").val("");
			});
			searchWidget.on("search-complete", function(result) {
				if (
					result.results &&
					result.results.length > 0 &&
					result.results[0].results &&
					result.results[0].results.length > 0
				) {
					var geom = result.results[0].results[0].feature.geometry;
					console.info(geom);
					$("input#longitude").val(Math.round(geom.longitude * 100000) / 100000);
					$("input#latitude").val(Math.round(geom.latitude * 100000) / 100000);

					let point = {
						type: "point", // autocasts as new Point()
						longitude: Math.round(geom.longitude * 100000) / 100000,
						latitude: Math.round(geom.latitude * 100000) / 100000,
					};

					// Create a symbol for drawing the point
					let markerSymbol = {
						type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
						color: [21, 73, 158],
					};

					// Create a graphic and add the geometry and symbol to it
					let pointGraphic = new Graphic({
						geometry: point,
						symbol: markerSymbol,
					});
					var pid = $("input#pid").val();
					if (pid == "") {
						$("input#pid").val("");
						view.graphics.removeAll();
						view.graphics.add(pointGraphic);
					} else {
						$("input#pid").val("");
					}
				} else {
					$("input#longitude").val("");
					$("input#latitude").val("");
					$("input#pid").val("");
				}
			});

			//search.defaultSource.withinViewEnabled = false; // Limit search to visible map area only
			view.ui.add(searchWidget, "top-right"); // Add to the map

			view.on("click", function(evt) {
				// Create a graphic and add the geometry and symbol to it
				var graphic = new Graphic({
					geometry: {
						type: "point",
						latitude: evt.mapPoint.latitude,
						longitude: evt.mapPoint.longitude,
						spatialReference: view.spatialReference,
					},
					symbol: {
						type: "simple-marker", // autocasts as new SimpleFillSymbol
						color: [21, 73, 158],
						outline: {
							// autocasts as new SimpleLineSymbol()
							color: [19, 20, 23],
							width: 2,
						},
					},
				});
				view.graphics.removeAll();
				view.graphics.add(graphic);

				searchWidget.search(evt.mapPoint);
				searchWidget.resultGraphicEnabled = false;

				$("input#pid").val("1");
				$("input#longitude").val(Math.round(evt.mapPoint.longitude * 100000) / 100000);
				$("input#latitude").val(Math.round(evt.mapPoint.latitude * 100000) / 100000);
			});

			//     locateBtn.on('locate', function(pos){
			//   console.info(pos.position.coords.latitude, pos.position.coords.longitude);
			// });‍‍‍

			const locateWidget = new Locate({
				view: view,
				scale: 5000,
				useHeadingEnabled: false,
				graphic: new Graphic({
					symbol: {
						type: "simple-marker",
						color: [21, 73, 158],
						outline: {
							color: [19, 20, 23],
							width: 2,
						},
					},
				}),
			});
			view.ui.add(locateWidget, "top-left");

			//locateWidget.locate();

			locateWidget.on("locate", function(evt) {
				$("input#longitude").val(
					Math.round(evt.position.coords.longitude * 100000) / 100000
				);
				$("input#latitude").val(
					Math.round(evt.position.coords.latitude * 100000) / 100000
				);
				//--
				let point = {
					type: "point", // autocasts as new Point()
					longitude: Math.round(evt.position.coords.longitude * 100000) / 100000,
					latitude: Math.round(evt.position.coords.latitude * 100000) / 100000,
				};

				// Create a symbol for drawing the point
				let markerSymbol = {
					type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
					color: [21, 73, 158],
				};

				// Create a graphic and add the geometry and symbol to it
				let pointGraphic = new Graphic({
					geometry: point,
					symbol: markerSymbol,
				});
				var pid = $("input#pid").val();
				if (pid == "") {
					$("input#pid").val("");
					view.graphics.removeAll();
					view.graphics.add(pointGraphic);
				} else {
					$("input#pid").val("");
				}
			});
		});
	</script>

	<script type="text/javascript">
		var save_method; //for save method string
		var tablekeluarga;
		var tablearsipkeluarga;
		var tablepangkat;
		var tablejabatan;
		var tablependidikan;
		var tablepelatihan;
		var tablepenghargaan;
		var tabletubel;
		var tableskp;
		var tableHukuman;
		var counterArsipPribadi = 0;
		var counterArsipPangkat = 0;
		var counterArsipJabatan = 0;
		var counterArsipPendidikan = 0;
		var counterArsipPelatihan = 0;
		var counterArsipPenghargaan = 0;
		var counterArsipTubel = 0;
		var counterArsipSkp = 0;
		var counterArsipHukuman = 0;

		$(document).ready(function() {
			//datatables
			tablekeluarga = $('#table_keluarga').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('keluarga/keluarga_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tablepangkat = $('#table_pangkat').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('pangkat/pangkat_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tablejabatan = $('#table_jabatan').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('jabatan/jabatan_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tablependidikan = $('#table_pendidikan').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('pendidikan/pendidikan_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tablepelatihan = $('#table_pelatihan').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('pelatihan/pelatihan_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tablepenghargaan = $('#table_penghargaan').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('penghargaan/penghargaan_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tabletubel = $('#table_tubel').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('tubel/tubel_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tableskp = $('#table_skp').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('skp/skp_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			tableHukuman = $('#table_hukuman').DataTable({

				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				rowReorder: {
					selector: 'td:nth-child(2)'
				},
				responsive: true,

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('hukuman/hukuman_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],

			});

			//datepicker
			$('.datepicker').datepicker({
				autoclose: true,
				format: "dd-mm-yyyy",
				todayHighlight: true,
				orientation: "top auto",
				todayBtn: true,
				todayHighlight: true,
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

		$(document).ready(function() {
			$('#id_status_jabatan').change(function() {
				var id_status_jabatan = $('#id_status_jabatan').val();
				if (id_status_jabatan != '') {
					$.ajax({
						url: "<?php echo base_url(); ?>dashboard_publik/nama_jabatan",
						method: "POST",
						data: {
							id_status_jabatan: id_status_jabatan
						},
						success: function(data) {
							$('#id_jabatan').html(data);
						}
					});
				} else {
					$('#nama_jabatan').html('<option value="">Pilih Nama Jabatan</option>');
				}
			});
		});

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

		});

		/* function arsip */
		function clearArsipInput(context, counter) {
			if (counter > 0) {
				for (let i = counter; i > 0; i--) {
					$('#div' + context + i).remove();
				}
			}

			let name = 'counter' + context;
			let str = name + ' = 0';
			eval(str);
		}

		function remove(context, counter) {
			$('#div' + context + counter).remove();
		}

		function tambah(context, val = '') {
			let counterold, name = 'counter' + context;
			let file = '',
				title = '',
				url_download = '';

			if (eval(name) > 0) {
				counterold = eval(name);
				$('[id^=div' + context + ']').each(function(k, v) {
					counterold = parseInt($(v).attr('id').replace('div' + context, ''));
				});
			} else {
				counterold = 0;
			}

			if (val != '') {
				file = val.file_name_ori;
				title = val.title;
				url_download = val.url_download;
			}

			let str = name + ' = ' + 'counterold + 1';
			eval(str);

			let html = '<div class="form-group" id="div' + context + eval(name) + '">';
			html += '<div class="col-md-12" id="div' + context + eval(name) + '">';
			html += '<input type="text" name="' + context + '_title[]" id="' + context + '_title' + eval(name) + '" class="form-control" placeholder="Title" value="' + title + '" />';
			html += '<span class="help-block"></span>';
			html += '<input type="file" name="' + context + '_file[]" id="' + context + '_file' + eval(name) + '" class="form-control" />';
			html += '<span class="help-block"></span>';

			if (file != '') {
				html += '<span class="url"><a href="' + url_download + '">' + file + '</a></span><br class="url" />';
			}

			html += '<br />';
			html += '<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="tambah(\'' + context + '\');" ><i class="glyphicon glyphicon-plus"></i> Tambah Arsip</a>';
			html += '&nbsp;';
			html += '<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="remove(\'' + context + '\',\'' + eval(name) + '\');" ><i class="glyphicon glyphicon-minus"></i> Hapus Arsip</a>';
			html += '</div>';
			html += '</div>';
			html += '</div>';

			$('#div' + context + counterold).after(html);
		}

		function deleteArsip(context, id) {
			if (confirm('Apakah kamu yakin mau menghapus arsip ini?')) {
				let modalName = '',
					tblArsip = '',
					editName = '';
				switch (context) {
					case 'ArsipPribadi':
						url = '<?php echo site_url('keluarga/delete_arsip'); ?>/' + id;
						modalName = 'modal_keluarga';
						break;
					case 'ArsipPangkat':
						url = '<?php echo site_url('pangkat/delete_arsip'); ?>/' + id;
						modalName = 'modal_pangkat';
						tblArsip = 'reload_table_arsip_pangkat()';
						break;
				}

				$.ajax({
					url: url,
					type: "GET",
					processData: true,
					contentType: false,
					cache: false,
					dataType: "JSON",
					success: function(data) {
						if (data.status) //if success close modal and reload ajax table
						{
							$('#' + modalName).modal('hide');
						} else {
							alert('Hapus arsip error');
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Hapus arsip error');
					}
				});
			}
		}

		$(document).ready(function() {
			$('#modal-download-arsip').on('show.bs.modal', function(e) {
				var button = $(e.relatedTarget);
				var id = button.data('id');
				var key = button.data('key');
				var url = '';

				switch (key) {
					case 'keluarga':
						url = "<?= base_url('arsip_pribadi/download/') ?>";
						break;
					case 'pendidikan':
						url = "<?= base_url('arsip_pendidikan/download/') ?>";
						break;
					case 'pelatihan':
						url = "<?= base_url('arsip_pelatihan/download/') ?>";
						break;
					case 'skp':
						url = "<?= base_url('arsip_skp/download/') ?>";
						break;
					case 'hukuman':
						url = "<?= base_url('arsip_hukuman/download/') ?>";
						break;
					default:
						url = "<?= base_url('arsip_sk/download_file/') ?>";
						break;
				}

				url += id;

				var modal = $(this);
				setTimeout(function() {
					window.location.href = url;
				}, 2500);
				setTimeout(function() {
					modal.modal('hide');
				}, 2500);
			});
		});
		/* end function arsip */
	</script>

</body>

</html>