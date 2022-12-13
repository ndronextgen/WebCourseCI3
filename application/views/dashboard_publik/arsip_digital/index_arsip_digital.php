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

	<script src="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.css" media="screen" />

	<!-- sso styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>sso/css/style.css" />
	<style type="text/css">
		.modal-dialog,
		.modal-content {
			/* 80% of window height */
			/* height: 95%; */
			/* width: 95%; */
		}

		.modal-body {
			/* 100% = dialog height, 120px = header + footer */
			max-height: calc(100% - 120px);
			overflow-y: scroll;
		}

		#viewDiv {
			padding: 0;
			margin: 0;
			height: 100%;
			width: 100%;
		}

		.pager li a.active {
			background-color: #008096;
			color: #fff;
			border: 1px solid #008096;
		}

		/* #sign_btn {
			color: #fff;
			background: #2b62ba;
			padding: 5px;
			border: none;
			border-radius: 5px;
			font-size: 10px;
			margin-top: 10px;
		}
		#cancel_btn {
			color: #fff;
			background: #f04f41;
			padding: 5px;
			border: none;
			border-radius: 5px;
			font-size: 10px;
			margin-top: 10px;
		} */
		#signArea {
			width: 280px;
			/* margin: 15px auto; */
		}

		.sign-container {
			width: 99%;
			margin: auto;
		}

		.sign-preview {
			width: 280px;
			height: 150px;
			border: solid 1px #CFCFCF;
			margin: 10px 5px;
		}

		.tag-ingo {
			font-family: cursive;
			font-size: 12px;
			text-align: left;
			font-style: oblique;
		}

		.center-text {
			text-align: center;
		}

		.tag-info {
			font-family: cursive;
			font-size: 12px;
			text-align: left;
			font-style: oblique;
		}

		.right {
			text-align: right;
		}

		.center {
			text-align: center;
		}

		.left {
			text-align: left;
		}
	</style>
	<script src="<?= base_url() ?>asset/signature/main_style/numeric-1.2.6.min.js"></script>
	<script src="<?= base_url() ?>asset/signature/main_style/bezier.js"></script>
	<script src="<?= base_url() ?>asset/signature/main_style/jquery.signaturepad.js"></script>
	<link href="<?= base_url() ?>asset/signature/main_style/assets/jquery.signaturepad.css" rel="stylesheet" />
	<script type='text/javascript' src="<?= base_url() ?>asset/signature/main_style/html2canvas.js"></script>

	<!-- new sso -->
	<link href="<?= base_url() ?>asset/sso/css/style.css" rel="stylesheet" />
	<!-- <link href="<?= base_url() ?>asset/sso/css/all.min.css.css" rel="stylesheet" /> -->

	<!-- jquery-confirm -->
	<link rel="stylesheet" href="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.css'); ?>">
	<script src="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.js'); ?>"></script>

</head>

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

					<a class="navbar-brand" href="<?php echo base_url(); ?>dashboard_publik">
						<img alt="Logo" src="<?= base_url() ?>assets_admin/media/logos/logox24.png" style="float:left; margin-right:10px;" />
						<?php echo $judul_pendek; ?>
					</a>

					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
							<li class="active"><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
							<!-- <li class="dropdown"><a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-fire icon-white"></i> Cuti Pegawai <b class=""></b></a></li> -->

							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="hidden-xs">Kertas Kerja &nbsp;<span id='ttl_kertas_kerja'></span>
										<i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href=" <?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-leaf icon-white"></i>Surat Keterangan Pegawai&nbsp;
											<?php if ($count_see > 0) { ?>
												<span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span>
											<?php } ?>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>tunjangan"><i class="icon-leaf icon-white"></i>Surat Permohonan Tunjangan Keluarga&nbsp;
											<?php if ($count_see_tj > 0) { ?>
												<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_tj; ?></span>
											<?php } ?>
										</a>
									</li>

									<li>
										<a href="<?php echo base_url(); ?>kariskarsu"><i class="icon-leaf icon-white"></i>Surat Permohonan KARIS/KARSU&nbsp;
											<?php if ($count_see_kaku > 0) { ?>
												<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_kaku; ?></span>
											<?php } ?>
										</a>
									</li>
								</ul>
							</li>

							<li class=""><a href="<?php echo base_url(); ?>Lapor"><i class="icon-home icon-white"></i> Lapor</a></li>

							<?php if ($status_user == 'true') { ?>
								<li class="dropdown user user-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<span class="hidden-xs">Verifikasi &nbsp;
											<?php if ($count_see_verifikasi > 0 or $count_see_verifikasi_tj > 0 or $count_see_verifikasi_kaku) { ?>
												<span class="badge btn-warning btn-flat"><?php echo $count_see_verifikasi + $count_see_verifikasi_tj + $count_see_verifikasi_kaku; ?></span>
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
												<?php if ($count_see_verifikasi_tj > 0) { ?>
													<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tj; ?></span>
												<?php } ?>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url(); ?>verifikasi_kariskarsu"><i class="icon-off"></i> Verifikasi Surat KARIS/KARSU&nbsp;
												<?php if ($count_see_verifikasi_kaku > 0) { ?>
													<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_kaku; ?></span>
												<?php } ?>
											</a>
										</li>
										<?php 
											#hanya admin kepegawaian dan sekdis yg bisa akses ini
											$id_pegawai = $this->session->userdata('id_pegawai');
											$query_exist_view_kk = $this->db->query("SELECT COUNT(*) as jml FROM view_kasubag_kepegawaian WHERE id_pegawai = '$id_pegawai'")->row();
											$query_exist_view_sekdis = $this->db->query("SELECT COUNT(*) as jml FROM view_sekdis WHERE id_pegawai = '$id_pegawai'")->row();
											if($query_exist_view_kk->jml >0 || $query_exist_view_sekdis->jml >0){
										?>
											<li>
												<a href="<?php echo base_url(); ?>verifikasi_hukdis"><i class="icon-off"></i> Verifikasi Surat Hukuman Disiplin&nbsp;
												<!-- notif -->
												</a>
											</li>
										<?php } ?>
									</ul>
								</li>
							<?php } ?>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Panduan Penggunaan<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_manualbook" target=""><i class="icon-fire"></i> Download Panduan</a></li>
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
								<center style="color:#103452; font-weight:bold;"><?php echo $alamat_instansi; ?>
							</p>
						</div>
					</div>
					<br>
				</div>

				<!-- <ul class="pager subnav-pager">
						<div class="btn-group-wrap">
							<li><a href="javascript:void(0)" id='arsip_pribadi' onclick="load_arsip('arsip_pribadi')"><i class="fa fa-angle-double-right"></i> <b>Arsip Digital Pribadi</b></a></li>
							<li><a href="javascript:void(0)" id='arsip_sk' onclick="load_arsip('arsip_sk')"><i class="fa fa-angle-double-right"></i> <b>Arsip Digital SK</b></a></li>
							<li><a href="javascript:void(0)" id='arsip_pendidikan' onclick="load_arsip('arsip_pendidikan')"><i class="fa fa-angle-double-right"></i> <b>Arsip Digital Pendidikan</b></a></li>
							<li><a href="javascript:void(0)" id='arsip_pelatihan' onclick="load_arsip('arsip_pelatihan')"><i class="fa fa-angle-double-right"></i> <b>Arsip Digital Pelatihan</b></a></li>
							<li><a href="javascript:void(0)" id='arsip_skp' onclick="load_arsip('arsip_skp')"><i class="fa fa-angle-double-right"></i> <b>Arsip Digital SKP / DP3</b></a></li>
						</div>
					</ul> -->

				<div class="row">
					<div class="col-xs-12">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class='active'><a href="#arsip1" data-toggle="tab" id='arsip_pribadi' onclick="load_arsip('arsip_pribadi')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL PRIBADI</b></a></li>
								<li><a href="#arsip2" data-toggle="tab" id='arsip_sk' onclick="load_arsip('arsip_sk')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL SK</b></a></li>
								<li><a href="#arsip3" data-toggle="tab" id='arsip_pendidikan' onclick="load_arsip('arsip_pendidikan')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL PENDIDIKAN</b></a></li>
								<li><a href="#arsip4" data-toggle="tab" id='arsip_pelatihan' onclick="load_arsip('arsip_pelatihan')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL PELATIHAN</b></a></li>
								<li><a href="#arsip5" data-toggle="tab" id='arsip_skp' onclick="load_arsip('arsip_skp')"><i class="fa fa-angle-double-right"></i> <b>ARSIP DIGITAL SKP / DP3</b></a></li>


								<!-- <li class='active'><a href="#arsip1" data-toggle="tab" id='arsip_pribadi' onclick="load_arsip('arsip_pribadi')"><i class="fa fa-angle-double-right"></i> Arsip Digital Pribadi</a></li>
								<li><a href="#arsip2" data-toggle="tab" id='arsip_sk' onclick="load_arsip('arsip_sk')"><i class="fa fa-angle-double-right"></i> Arsip Digital SK</a></li>
								<li><a href="#arsip3" data-toggle="tab" id='arsip_pendidikan' onclick="load_arsip('arsip_pendidikan')"><i class="fa fa-angle-double-right"></i> Arsip Digital Pendidikan</a></li>
								<li><a href="#arsip4" data-toggle="tab" id='arsip_pelatihan' onclick="load_arsip('arsip_pelatihan')"><i class="fa fa-angle-double-right"></i> Arsip Digital Pelatihan</a></li>
								<li><a href="#arsip5" data-toggle="tab" id='arsip_skp' onclick="load_arsip('arsip_skp')"><i class="fa fa-angle-double-right"></i> Arsip Digital SKP / DP3</a></li> -->

							</ul>
							<!-- ----- -->
							<div class="tab-content">
								<div id="ajax_table" class="tab-pane active"></div>
							</div>
							<!-- ------ -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
				<div id="sso_widget"></div>

				<!-- </section> -->

				<!-- Main content -->
				<!-- <div id='ajax_table'></div> -->

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
										<div id="viewDiv" style="width: 100%; height: 750px;"></div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-success" data-dismiss="modal" aria-label="Close"> Simpan</button>
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

				<!-- modal download -->
				<div class="modal modal-primary fade" id="modal-download" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
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

				<!-- Modal kabeh -->
				<div class="modal fade" id="modal_all" data-backdrop='static' data-keyboard='false'>
					<div class="modal-dialog modal-lg">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" style="font-family: 'Source Sans Pro', sans-serif;">Modal Header</h4>
							</div>
							<div class="modal-body">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" onClick="simpan_modal()">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan
								</button>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>



	<script type="text/javascript">
		notify_arsip_digital();

		//datepicker
		$('.datepicker').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			orientation: "top auto",
			todayBtn: true,
			todayHighlight: true,
		});
		// ----- end date

		function load_arsip(type) {
			if (type == "arsip_pribadi") {
				var urls = "<?php echo site_url('Dashboard_publik/arsip_pribadi'); ?>";
			} else if (type == "arsip_sk") {
				var urls = "<?php echo site_url('Dashboard_publik/arsip_sk'); ?>";
			} else if (type == "arsip_pendidikan") {
				var urls = "<?php echo site_url('Dashboard_publik/arsip_pendidikan'); ?>";
			} else if (type == "arsip_pelatihan") {
				var urls = "<?php echo site_url('Dashboard_publik/arsip_pelatihan'); ?>";
			} else if (type == "arsip_skp") {
				var urls = "<?php echo site_url('Dashboard_publik/arsip_skp'); ?>";
			}

			$.ajax({
				type: "POST",
				url: urls,
				beforeSend: function(b) {
					var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
					$('#ajax_table').html(percentVal);
				},
				success: function(s) {
					$('#ajax_table').html(s);
				}
			});
		}
		load_arsip('arsip_pribadi');

		function notify_arsip_digital() {
			$.ajax({
				url: "<?php echo site_url('lapor/notify_lapor') ?>",
				type: "POST",
				beforeSend: function(f) {
					var loading = '';
					// $('span#notif_count_kariskarsu').html(loading);
					$('span#ttl_kertas_kerja').html(loading);
				},
				success: function(s) {
					var obj = JSON.parse(s);
					// $('span#notif_count_kariskarsu').html(obj.kariskarsu);
					$('span#ttl_kertas_kerja').html(obj.ttl_kertas_kerja);
				}
			});
		}

		$(document).ready(function() {
			function add_sk() {
				$('#label-photo').text('Upload File');
				$('#frame_sk').remove();
				save_method = 'addsk';

				$('#form_sk')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string
				$('#modal_sk').modal('show'); // show bootstrap modal
				$('.modal-title').text('Tambah Data SK Lainnya - <?php echo $this->session->userdata("nama_pegawai"); ?>'); // Set Title to Bootstrap modal title
			}

			function edit_sk(id_sk) {
				$('#label-photo').text('Upload File');
				$('#frame_sk').remove();
				save_method = 'update';

				$('#form_sk')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string

				//Ajax Load data from ajax
				$.ajax({
					url: "<?php echo site_url('arsip_sk/sk_edit/') ?>/" + id_sk,
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						$('[name="id_sk"]').val(data.id_arsip_sk);
						$('[name="title_sk"]').val(data.title);
						$('#modal_sk').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title').text('Edit Data sk'); // Set title to Bootstrap modal title

						if (data.file_name) {
							$('#label-photo').text('Upload File');
							$('#file_sk').before('<iframe id="frame_sk" src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>');
						} else {
							$('#label-photo').text('Upload File');
							$('#frame_sk').remove();
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error get data from ajax');
					}
				});
			}

			function lihat_file(id) {
				//Ajax Load data from ajax
				$.ajax({
					url: "<?php echo site_url('arsip_sk/sk_lihat/') ?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						$('#lihat_file').modal('show'); // show bootstrap modal when complete loaded
						$('.modal-title').text('Lihat Data sk'); // Set title to Bootstrap modal title
						$('#photo-preview').show(); // show photo preview modal

						if (data.file_name) {
							$('#MyModalBody div').html('<iframe src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="550px" height="400px"></iframe>');
						} else {
							$('#MyModalBody div').text('(No File)');
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error get data from ajax');
					}
				});
			}

			function reload_table_sk() {
				tablesk.ajax.reload(null, false); //reload datatable ajax 
				notify_arsip_digital();
			}

			function savesk() {
				$('#btnskSave').text('saving...'); //change button text
				$('#btnskSave').attr('disabled', true); //set button disable 

				var url;

				if (save_method == 'addsk') {
					url = "<?php echo site_url('arsip_sk/sk_add') ?>";
				} else {
					url = "<?php echo site_url('arsip_sk/sk_update') ?>";
				}

				// ajax adding data to database
				var form = $("#form_sk").closest("form");
				var frmData = new FormData(form[0]);

				$.ajax({
					url: url,
					type: "POST",
					data: frmData,
					contentType: false,
					processData: false,
					dataType: "JSON",
					success: function(data) {
						if (data.status) //if success close modal and reload ajax table
						{
							$('#modal_sk').modal('hide');
							reload_table_sk();
						} else {
							for (var i = 0; i < data.inputerror.length; i++) {
								$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
								$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
							}
						}

						$('#btnskSave').text('save'); //change button text
						$('#btnskSave').attr('disabled', false); //set button enable 
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error adding / update data');
						$('#btnskSave').text('save'); //change button text
						$('#btnskSave').attr('disabled', false); //set button enable 
					}
				});
			}

			function delete_sk(id_sk) {
				if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
					// ajax delete data to database
					$.ajax({
						url: "<?php echo site_url('arsip_sk/sk_delete') ?>/" + id_sk,
						type: "POST",
						dataType: "JSON",
						success: function(data) {
							//if success reload ajax table
							$('#modal_sk').modal('hide');
							reload_table_sk();
						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert('Proses delete data error');
						}
					});
				}
			}

			$('#modal-download').on('show.bs.modal', function(e) {
				var button = $(e.relatedTarget);
				var content = button.data('content');
				var modal = $(this);
				var url = '';

				switch (content) {
					case 'pribadi':
						url = "<?= base_url('arsip_pribadi/download_all'); ?>";
						break;
					case 'sk':
						url = "<?= base_url('arsip_sk/download_all'); ?>";
						break;
					case 'pendidikan':
						url = "<?= base_url('arsip_pendidikan/download_all'); ?>";
						break;
					case 'pelatihan':
						url = "<?= base_url('arsip_pelatihan/download_all'); ?>";
						break;
					case 'skp':
						url = "<?= base_url('arsip_skp/download_all'); ?>";
						break;
				}

				setTimeout(function() {
					window.location.href = url;
				}, 2500);
				setTimeout(function() {
					modal.modal('hide');
				}, 2500);
			});
		});
	</script>

	<!-- SSO LIB -->
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/sso/js/all.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/sso/js/main.js"></script>

	<script type="text/javascript">
		let sso = new SSO({
			sso_services_url: "https://dcktrp.jakarta.go.id/satuakses/service/",
		});
		sso.initComponent('#sso_widget');
		document.querySelector('#sso_floating_widget').style.zIndex = 99999;
	</script>

	<script type="text/javascript">
		function under_maintenance() {
			$.dialog({
				title: 'Info',
				content: 'Sedang dalam pengerjaan...',
				type: 'red',
				backgroundDismiss: true
			});
		}
	</script>

</body>

</html>