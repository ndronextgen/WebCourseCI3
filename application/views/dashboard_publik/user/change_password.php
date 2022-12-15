<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php echo $judul_lengkap . ' - ' . $instansi; ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- show icon -->
	<link rel="icon" href="<?php echo base_url(); ?>assets_admin/media/logos/logox24.png" type="image/gif">
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
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>asset/bootstrap/js/fastclick.min.js"></script>
	<link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/js/application.js"></script>

	<!-- sso styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>sso/css/style.css" />
</head>

<?php
$user_id_pegawai = $this->session->userdata("id_pegawai");
$cek_kepegawaian = $this->db->query("SELECT count(*) as jml_kepegawaian
                                    FROM view_kasubag_kepegawaian WHERE id_pegawai = '$user_id_pegawai'")->row();
$cek_sekdis      = $this->db->query("SELECT count(*) as jml_sekdis
                                    FROM view_sekdis WHERE id_pegawai = '$user_id_pegawai'")->row();

if ($cek_kepegawaian->jml_kepegawaian > 0) {
	$status_user = 'true';
} else if ($cek_sekdis->jml_sekdis > 0) {
	$status_user = 'true';
} else {
	$status_user = 'false';
}
?>

<body class="skin-blue layout-top-nav">
	<div class="wrapper navbar-inverse">
		<header class="main-header">
			<nav class="navbar navbar-fixed-top">
				<div class="container">
					<!-- <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a> -->

					<a class="navbar-brand" href="<?= base_url(); ?>dashboard_publik">
						<img alt="Logo" src="<?= base_url() ?>assets_admin/media/logos/logox24.png" style="float:left; margin-right:10px;" />
						<?php echo $judul_pendek; ?>
					</a>

					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">

							<li class="active"><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
							<li><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
							<!-- <li class="dropdown"><a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-fire icon-white"></i> Cuti Pegawai <b class=""></b></a></li> -->


							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="hidden-xs">Kertas Kerja &nbsp;
										<?php if ($count_see > 0) { ?>
											<span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span>
										<?php } ?>
										<i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href=" <?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-leaf icon-white"></i>Surat Keterangan Pegawai&nbsp;
											<?php if ($count_see > 0) { ?>
												<span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span>
											<?php } ?></a></li>
									<li><a href="<?php echo base_url(); ?>tunjangan"><i class="icon-leaf icon-white"></i>Surat Permohonan Tunjangan Keluarga&nbsp;
											<?php if ($count_see_tj > 0) { ?>
												<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_tj; ?></span>
											<?php } ?>
										</a></li>
									<li><a href="<?php echo base_url(); ?>kariskarsu"><i class="icon-leaf icon-white"></i>Surat Permohonan KARIS/KARSU</a></li>
								</ul>
							</li>


							<li class=""><a href="<?php echo base_url(); ?>Lapor"><i class="icon-home icon-white"></i> Lapor</a></li>

							<?php if ($status_user == 'true') { ?>
								<li class="dropdown user user-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<span class="hidden-xs">Verifikasi &nbsp;
											<?php if ($count_see_verifikasi > 0) { ?>
												<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi; ?></span>
											<?php } ?>
											<i class="caret"></i></span>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a href="<?php echo base_url(); ?>verifikasi"><i class="icon-off"></i> Verifikasi Surat Pegawai&nbsp;
												<?php if ($count_see_verifikasi > 0) { ?>
													<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi; ?></span>
												<?php } ?>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url(); ?>verifikasi_tunjangan"><i class="icon-off"></i> Verifikasi Surat Tunjangan Keluarga&nbsp;
												<span id='notif_count_verifikasi_tj'></span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url(); ?>verifikasi_kariskarsu"><i class="icon-off"></i> Verifikasi Surat KARIS/KARSU&nbsp;
												<span id='notif_count_verifikasi_kaku'></span>
											</a>
										</li>
									</ul>
								</li>
							<?php } ?>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Panduan<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_manualbook" target=""><i class="icon-fire"></i> Panduan Penggunaan</a></li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Pedoman<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_1" target=""><i class="icon-fire"></i> Permendikbud RI Nomor 50 Tahun 2015</a></li>
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_pedoman_2" target=""><i class="icon-fire"></i> Pergub DKI Jakarta Nomor 99 Tahun 2021</a></li>
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
									<span class="hidden-xs"><?php echo $this->func_table->name_format($this->session->userdata('nama')); ?> <i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<!-- <li><a href="<?php //echo base_url(); 
														?>app/change_password_publik"><i class="icon-wrench"></i> Pengaturan Akun</a></li> -->
									<li><a href="<?php echo "https://dcktrp.jakarta.go.id/satuakses/app/profile" ?>" target="_blank"><i class="icon-off"></i> Profil</a></li>
									<li><a href="<?php echo base_url(); ?>app/logout"><i class="icon-off"></i> Log Out</a></li>
								</ul>
							</li>

						</ul>
					</div>
				</div>
			</nav>
		</header>

		<div class="content-wrapper" style="padding-top: 0.5rem;">
			<div class="container">
				<!-- <section class="content-header"> -->
				<div class="nav-tabs-custom" style="margin-bottom:5px; background-image: url(<?php echo base_url('asset/media/bg/header-publik-3.jpg') ?>); background-size: 100% 200px">
					<div class="row">

						<div class="">
							<h3>
								<center style="color:#103452; font-weight:bold;"><?php echo $judul_lengkap . '<br/> ' . $instansi; ?>
							</h3>
						</div>
						<div class="span">
							<p>
								<center style="color:#103452; font-weight:bold;"><?php echo $alamat; ?>
							</p>
						</div>

					</div>
					<br>
				</div>

				<?php echo form_open_multipart('app/save_pass_publik'); ?>

				<!-- </section> -->

				<!-- Main content -->
				<!-- <section id="data-pegawai" class="content"> -->
				<div class="callout callout-info">
					<h4>Pengelolaan Akun</h4>
					<p>Untuk Keamanan Data Anda, Silahkan Lakukan Perubahan Password Secara Berkala</p>
				</div>

				<?php if (validation_errors()) { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<h4>Terjadi Kesalahan!</h4>
						<?php echo validation_errors(); ?>
					</div>
				<?php } ?>

				<?php if ($this->session->flashdata('pass_sukses')) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<h4>SUKSES !!!</h4>
						<?php echo $this->session->flashdata('pass_sukses'); ?>
					</div>
				<?php } ?>

				<?php if ($this->session->flashdata('pass_gagal')) { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<h4>GAGAL !!!</h4>
						<?php echo $this->session->flashdata('pass_gagal'); ?>
					</div>
				<?php } ?>

				<div class="row">
					<div class="col-xs-12">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#akun" data-toggle="tab">Ganti Password</a></li>
								<li><a href="<?php echo base_url(); ?>app/logout"><b>LOG OUT</b></a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="akun">
									<div class="box-body table-responsive">
										<div class="box-body">
											<?php echo form_open('app/save_pass_publik'); ?>
											<div class="row">
												<div class="col-xs-6">
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon">Nama Lengkap :</span>
															<input type="text" readonly="readonly" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?php echo $this->session->userdata('nama'); ?>">
														</div><!-- /.input group -->
													</div>
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon">Username :</span>
															<input type="text" readonly="readonly" class="form-control" name="username" id="username" value="<?php echo $this->session->userdata('username'); ?>">
														</div><!-- /.input group -->
													</div>
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon">Password Lama :</span>
															<input type="password" class="form-control" name="pass_lama" id="pass_lama" placeholder="Password Lama">
														</div><!-- /.input group -->
													</div>
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon">Password Baru :</span>
															<input type="password" class="form-control" name="pass_baru" id="pass_baru" placeholder="Password Baru">
														</div><!-- /.input group -->
													</div>
													<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon">Ulangi Password Baru :</span>
															<input type="password" class="form-control" name="ulangi_pass_baru" id="ulangi_pass_baru" placeholder="Ulangi Password Baru">
														</div><!-- /.input group -->
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- /.tab-pane -->

								<div class="box-body table-responsive">
									<div class="box-body">
										<div class="control-group">
											<div class="controls">
												<button type="submit" class="btn btn-primary" style="float: left; margin-right: 5px;">Simpan Data</button>
												<p><?php //echo $this->input->cookie('sso_dcktrp'); 
													?></p>
												<a href="<?php echo base_url() ?>" class="btn btn-warning">Cancel</a>
											</div>
										</div>
									</div>
								</div>

								<?php echo form_close(); ?>
							</div><!-- /.tab-content -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
				<!-- </section> -->

				<footer class="main-header">
					<nav class="navbar navbar-bottom">
						<div class="container">
							<!-- <p><?php echo $credit; ?></p> -->

							<div style="float: left;">
								<p><?php echo $credit; ?></p>
							</div>
							<div style="float: right; padding: 10px 30px;">
								<?php
								$app = &get_instance();
								$app->load->view("dashboard_admin/visitor/footer");
								?>
							</div>

						</div>
					</nav>
				</footer>

			</div>
</body>

</html>