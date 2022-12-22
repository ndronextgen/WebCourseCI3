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

	<!-- <link rel="stylesheet" href="<?php //echo base_url(); 
										?>asset/plugins/datatables/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php //echo base_url(); 
									?>asset/plugins/datatables/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="<?php //echo base_url(); 
									?>asset/plugins/datatables/responsive.dataTables.min.css"> -->
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<!-- <script src="<?php //echo base_url(); 
						?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php //echo base_url(); 
					?>asset/plugins/datatables/dataTables.rowReorder.min.js"></script>
	<script src="<?php //echo base_url(); 
					?>asset/plugins/datatables/dataTables.responsive.min.js"></script> -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
										<?php if ($count_see > 0 or $count_see_tj > 0 or $count_see_kaku > 0) { ?>
											<span class="badge btn-warning btn-flat"><?php echo $count_see + $count_see_tj + $count_see_kaku; ?></span>
										<?php } ?>
										<i class="caret"></i>
									</span>
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
											if ($query_exist_view_kk->jml > 0 || $query_exist_view_sekdis->jml > 0) {
												?>
											<li>
												<a href="<?php echo base_url(); ?>verifikasi_hukdis"><i class="icon-off"></i> Verifikasi Surat Hukuman Disiplin&nbsp;
													<!-- notif -->
												</a>
											</li>
											<li>
												<a href="<?php echo base_url(); ?>verifikasi_tindak_pidana"><i class="icon-off"></i> Verifikasi Tindak Pidana&nbsp;
													<!-- notif -->
												</a>
											</li>
											<li>
												<a href="<?php echo base_url(); ?>verifikasi_pengembangan_karir"><i class="icon-off"></i> Verifikasi Pengembangan Karir&nbsp;
													<!-- notif -->
												</a>
											</li>
										<?php } ?>
									</ul>
								</li>
							<?php } ?>

							<!-- <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment icon-white"></i> Panduan<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>dashboard_publik/download_manualbook" target=""><i class="icon-fire"></i> Panduan Penggunaan</a></li>
								</ul>
							</li> -->

							<li class=""><a href="<?php echo base_url(); ?>dashboard_publik/download_manualbook" title="Download Panduan Penggunaan"><i class="icon-home icon-white"></i> Panduan Penggunaan</a></li>

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

				<ul class="pager subnav-pager" style='padding-bottom: -10px;margin-bottom: -9px;margin-top: -22px;'>
					<div class="btn-group-wrap">
						<li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='pegawai' onclick="load_data('data_pegawai')"><i class="fa fa-angle-double-right"></i> <b>Data Pegawai</b></a></li>
						<li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='pribadi' onclick="load_data('group_pribadi')"><i class="fa fa-angle-double-right"></i> <b>Data Pribadi</b></a></li>
						<li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='skgubernur' onclick="load_data('group_sk_gubernur')"><i class="fa fa-angle-double-right"></i> <b>SK Pegawai</b></a></li>
						<li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='pendidikan' onclick="load_data('group_pendidikan')"><i class="fa fa-angle-double-right"></i> <b>Pendidikan</b></a></li>
						<li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='penghargaan' onclick="load_data('data_penghargaan')"><i class="fa fa-angle-double-right"></i> <b>Penghargaan</b></a></li>
						<li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='tubel' onclick="load_data('data_tubel')"><i class="fa fa-angle-double-right"></i> <b>Tugas & Izin Belajar</b></a></li>
						<li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='group_skpdp3' onclick="load_data('group_skpdp3')"><i class="fa fa-angle-double-right"></i> <b>SKP / DP3</b></a></li>
						<!-- <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='skp' onclick="load_data('data_skp')"><i class="fa fa-angle-double-right"></i> <b>SKP / DP3</b></a></li> -->
						<!-- <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0)" id='hukuman' onclick="load_data('data_hukuman')"><i class="fa fa-angle-double-right"></i> <b>Hukuman</b></a></li> -->
					</div>
				</ul>

				<!-- </section> -->

				<!-- Main content -->
				<div id='ajax_table'></div>
				<div id="sso_widget"></div>

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
					<div class="modal-dialog modal-lg">
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
				<div class="modal modal-primary fade" id="modal-download-arsip" data-backdrop="static">
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
				<div class="modal modal-primary fade" id="modal-download" data-backdrop="static">
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
				<div class="modal fade" id="modal_all" data-backdrop="static" tabindex="-1">
					<div class="modal-dialog modal-lg">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" style="font-family: 'Source Sans Pro', sans-serif;">Modal Header</h4>
							</div>
							<div class="modal-body">
							</div>
							<!-- <div class="modal-footer">
								<button type="button" class="btn btn-success" onClick="simpan_modal()">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan
								</button>
							</div> -->
						</div>
					</div>
				</div>

				<!-- Modal kabeh -->
				<div class="modal fade" id="modal_all_md" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
			"esri/layers/GraphicsLayer",
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
			GraphicsLayer,
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

			// var zonasi = new MapImageLayer({
			// 	//url: "https://tataruang.jakarta.go.id/server/rest/services/peta_operasional/Informasi_Rencana_Kota_DKI_Jakarta_View/MapServer",
			// 	url: "https://tataruang.jakarta.go.id/server/rest/services/RDTR_2022/Rencana_Pola_Ruang_RDTR_2022/MapServer",
			// 	title: "Zonasi",
			// });

			var zonasi = new FeatureLayer({
				//url: "https://tataruang.jakarta.go.id/server/rest/services/peta_operasional/Informasi_Rencana_Kota_DKI_Jakarta_View/MapServer",
				url: "https://tataruang.jakarta.go.id/server/rest/services/RDTR_2022/Rencana_Pola_Ruang_RDTR_2022/MapServer",
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

		function load_data(type) {
			if (type == "data_pegawai") {
				var urls = "<?php echo site_url('Dashboard_publik/data_pegawai'); ?>";
				$('#pegawai').addClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').removeClass('active');
			} else if (type == "data_hukuman") {
				var urls = "<?php echo site_url('Dashboard_publik/data_hukuman'); ?>";
				$('#pegawai').removeClass('active');
				$('#hukuman').addClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').removeClass('active');
			} else if (type == "group_skpdp3") {
				var urls = "<?php echo site_url('Dashboard_publik/group_skpdp3'); ?>";
				$('#pegawai').removeClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').addClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').removeClass('active');
			} else if (type == "data_tubel") {
				var urls = "<?php echo site_url('Dashboard_publik/data_tubel'); ?>";
				$('#pegawai').removeClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').addClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').removeClass('active');
			} else if (type == "data_penghargaan") {
				var urls = "<?php echo site_url('Dashboard_publik/data_penghargaan'); ?>";
				$('#pegawai').removeClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').addClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').removeClass('active');
			} else if (type == "group_pendidikan") {
				var urls = "<?php echo site_url('Dashboard_publik/group_pendidikan'); ?>";
				$('#pegawai').removeClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').addClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').removeClass('active');
			} else if (type == "group_sk_gubernur") {
				var urls = "<?php echo site_url('Dashboard_publik/group_sk_gubernur'); ?>";
				$('#pegawai').removeClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').addClass('active');
				$('#pribadi').removeClass('active');
			} else if (type == "group_pribadi") {
				var urls = "<?php echo site_url('Dashboard_publik/group_pribadi'); ?>";
				$('#pegawai').removeClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').addClass('active');
			} else if (type == "edit_pegawai") {
				var urls = "<?php echo site_url('Dashboard_publik/edit_pegawai'); ?>";
				$('#pegawai').addClass('active');
				$('#hukuman').removeClass('active');
				$('#group_skpdp3').removeClass('active');
				$('#tubel').removeClass('active');
				$('#penghargaan').removeClass('active');
				$('#pendidikan').removeClass('active');
				$('#skgubernur').removeClass('active');
				$('#pribadi').removeClass('active');
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
		load_data('data_pegawai');

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
					case 'data_skp':
						url = "<?= base_url('Data_skp/download/') ?>";
						break;
					case 'data_dp3':
						url = "<?= base_url('Data_dp3/download/') ?>";
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
					case 'newarsip':
						url = "<?= base_url('arsip_pribadi/download_all_dp_arsip'); ?>";
						break;
					case 'newkeluarga':
						url = "<?= base_url('arsip_pribadi/download_all_dp_keluarga'); ?>";
						break;

					case 'newsk':
						url = "<?= base_url('arsip_sklainnya/download_all_sk'); ?>";
						break;
					case 'newpangkat':
						url = "<?= base_url('arsip_sklainnya/download_all_pangkat'); ?>";
						break;
					case 'newjabatan':
						url = "<?= base_url('arsip_sklainnya/download_all_jabatan'); ?>";
						break;
					case 'penghargaan':
						url = "<?= base_url('penghargaan/download_all'); ?>";
						break;
					case 'tubel':
						url = "<?= base_url('tubel/download_all'); ?>";
						break;
					case 'hukuman':
						url = "<?= base_url('arsip_hukuman/download_all'); ?>";
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

		function batal_form_1() {
			$('#modal_all_md').modal('hide');
		}

		function batal_form_2() {
			$('#modal_all').modal('hide');
		}
	</script>

<script type="text/javascript">

Swal.fire({
	title: '<h5>Selamat Datang Di Aplikasi SIADIK DCKTRP</h5>',
	// icon: 'info',
	imageUrl: '<?php echo base_url('asset/img/sign.png');?>',
	imageWidth: 200,
	imageHeight: 75,
	width: 500,
	html:
	'<h6><b>Kami Mengingatkan Agar Segera Melengkapi Data Data Anda</b><h6> ' +
	'<hr>' +
	'<h5 style="font-weight:bold;color:red;">Informasi Update Terbaru</h5><hr>' +
	'<ul style="text-align:left;font-weight:bold;">' +
	'<li>Kertas Kerja Surat Permohonan Tunjangan Keluarga</li>' +
	'<li>Kertas Kerja Surat Permohonan KARIS/KARSU</li>' +
	'<li>Verifkikasi Surat Permohonan Tunjangan Keluarga</li>' +
	'<li>Verifkikasi Surat Permohonan KARIS/KARSU</li>' +
	'<li>Verifkikasi Surat Hukuman Disiplin</li>' +
	'<li>Verifkikasi Surat Tindak Pidana</li>' +
	'</ul>' +
	'Terimakasih',
	customClass: {
    	popup: 'format-pre'
  	},
	showCloseButton: false,
	showCancelButton: false,
	focusConfirm: true,
	confirmButtonText:
	'<i class="fa fa-thumbs-up"></i> Oke!',
	confirmButtonAriaLabel: 'Thumbs up, great!'
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

		function under_maintenance() {
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: 'Sedang dalam pengerjaan...',
				type: 'red',
				backgroundDismiss: true
			});
		}
	</script>

</body>

</html>