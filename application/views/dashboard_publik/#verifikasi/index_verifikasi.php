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
	<script src="<?php echo base_url(); ?>asset/jquery/jquery-2.1.4.min.js"></script>
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
			/* height: 95%;
			width: 95%; */
		}

		.modal-body {
			/* 100% = dialog height, 120px = header + footer */
			/* max-height: calc(100% - 120px); */
			overflow-y: scroll;
		}

		#viewDiv {
			padding: 0;
			margin: 0;
			height: 100%;
			width: 100%;
		}

		.pager li a.active {
			background-color: #103452 !important;
			color: #fff;
			border: 1px solid #103452;
		}

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

		.content {
			padding-top: 0px !important;
		}
	</style>
	<style>
		.center {
			text-align: center;
		}

		.right {
			text-align: right
		}

		.left {
			text-align: left
		}

		.avoid-clicks {
			pointer-events: none;
			background-color: #dbdbdb;
			cursor: no-drop;
		}
	</style>
	<script src="<?= base_url() ?>asset/signature/main_style/numeric-1.2.6.min.js"></script>
	<script src="<?= base_url() ?>asset/signature/main_style/bezier.js"></script>
	<script src="<?= base_url() ?>asset/signature/main_style/jquery.signaturepad.js"></script>
	<link href="<?= base_url() ?>asset/signature/main_style/assets/jquery.signaturepad.css" rel="stylesheet" />
	<script type='text/javascript' src="<?= base_url() ?>asset/signature/main_style/html2canvas.js"></script>
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
					<a class="navbar-brand" href="<?= base_url(); ?>dashboard_publik">
						<img alt="Logo" src="<?= base_url() ?>assets_admin/media/logos/logox24.png" style="float:left; margin-right:10px;" />
						<?php echo $judul_pendek; ?>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class=""><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
							<li><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
							<li class="dropdown"><a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-fire icon-white"></i> Cuti Pegawai <b class=""></b></a></li>
							<!-- <li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="hidden-xs">Kertas Kerja &nbsp;&nbsp;&nbsp;
										<?php if ($count_see > 0) { ?>
											<span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span>
										<?php } ?>
										<i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/pengajuan_surat"><i class="icon-leaf icon-white"></i> Pengajuan Surat </a></li>
									<li><a href="<?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-off"></i> Status Surat&nbsp;&nbsp;&nbsp;

											<?php if ($count_see > 0) { ?>
												<span class="badge btn-warning btn-flat"><?php echo $count_see; ?></span>
											<?php } ?>
										</a></li>
								</ul>
							</li> -->
							<li class=""><a href="<?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-off"></i> Kertas Kerja&nbsp;&nbsp;&nbsp;
									<?php if ($count_see > 0) { ?>
										<span class="badge btn-warning btn-flat"><?php echo '' . $count_see; ?></span>
									<?php } ?>
								</a>
							</li>
							<li class=""><a href="<?php echo base_url(); ?>lapor"><i class="icon-home icon-white"></i> lapor</a></li>
							<li class="active"><a href="<?php echo base_url(); ?>verifikasi"><i class="icon-home icon-white"></i> Verifikasi</a></li>
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

		<div class="content-wrapper">
			<div class="container">
				<section class="content-header">
					<div class="nav-tabs-custom" style='margin-bottom:5px;'>
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
						<br>

					</div>
				</section>

				<!-- Main content -->
				<div id='ajax_table'></div>


				<br /><br />
				<footer class="main-header">
					<nav class="navbar navbar-fixed-bottom">
						<div class="container">
							<p><?php echo $credit; ?></p>
						</div>
					</nav>
				</footer>

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

				<!-- Modal kabeh -->
				<div class="modal fade" id="modal_all_md" data-backdrop='static' data-keyboard='false'>
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" style="font-family: 'Source Sans Pro', sans-serif;">Modal Header</h4>
							</div>
							<div class="modal-body">
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>


	<script type="text/javascript">
		//datepicker
		$('.datepicker').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			orientation: "top auto",
			todayBtn: true,
			todayHighlight: true,
		});

		function load_data() {
			var urls = "<?php echo site_url('Verifikasi/data_verifikasi'); ?>";

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
		load_data();

		function reload_table() {
			tableVerifikasi.ajax.reload(null, false); //reload datatable ajax 
		}

		function verifikasi_kep(Id) {
			save_method = 'verifikasi_kep';
			$.ajax({
				url: "<?php echo site_url('Verifikasi/form_verifikasi_kep'); ?>",
				data: {Id:Id},
				type: "POST",
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$('.modal-footer').hide(); // show bootstrap modal
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Form Verifikasi Surat Pegawai'); // Set Title to Bootstrap modal title
		}

		function simpan_verifikasi() {

			var status_verify = $("#status_verify").val();

				if (status_verify == '') {
					alert('Tentukan Velrifikasi...!');
				} else {
					ajax_simpan_verifikasi();
				}
		}

		function ajax_simpan_verifikasi() {
			var formData = new FormData($('#form_verifikasi_kep')[0]);
			var url;
			if (save_method == 'verifikasi_kep') {
				url = "<?php echo site_url('Verifikasi/simpan_verifikasi_kep'); ?>";
			} else {
				url = "<?php echo site_url('Verifikasi/simpan_verifikasi_kep'); ?>";
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
					reload_table();
				}
			});
		}

		function view_detail(Id) {
			$.ajax({
				url: "<?php echo site_url('Verifikasi/form_detail'); ?>",
				data: {Id:Id},
				type: "POST",
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$('.modal-footer').hide(); // show bootstrap modal
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Form Detail Surat Pegawai'); // Set Title to Bootstrap modal title
		}

	</script>

</body>

</html>