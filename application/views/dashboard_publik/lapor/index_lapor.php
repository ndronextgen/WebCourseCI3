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

	<style type="text/css">
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

	<!-- jquery-confirm -->
	<link rel="stylesheet" href="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.css'); ?>">
	<script src="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.js'); ?>"></script>

	<!-- new sso -->
	<link href="<?= base_url() ?>asset/sso/css/style.css" rel="stylesheet" />
	<!-- <link href="<?= base_url() ?>asset/sso/css/all.min.css.css" rel="stylesheet" /> -->

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
							<li class=""><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
							<li><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
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

							<li class="active"><a href="<?php echo base_url(); ?>lapor"><i class="icon-home icon-white"></i> Lapor</a></li>

							<?php if ($status_user == 'true') { ?>
								<li class="dropdown user user-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<span class="hidden-xs">Verifikasi &nbsp;
											<?php if ($count_see_verifikasi > 0 || $count_see_verifikasi_tj || $count_see_verifikasi_kaku || $count_see_verifikasi_hukdis || $count_see_verifikasi_tp || $count_see_verifikasi_karir) { ?>
												<span class="badge btn-warning btn-flat">
													<?php
															#hanya admin kepegawaian dan sekdis yg bisa akses ini
															$id_pegawai = $this->session->userdata('id_pegawai');
															$query_exist_view_kk = $this->db->query("SELECT COUNT(*) as jml FROM view_kasubag_kepegawaian WHERE id_pegawai = '$id_pegawai'")->row();
															$query_exist_view_sekdis = $this->db->query("SELECT COUNT(*) as jml FROM view_sekdis WHERE id_pegawai = '$id_pegawai'")->row();
															$verifikasi_surat_admin = 0;
															if ($query_exist_view_kk->jml > 0 || $query_exist_view_sekdis->jml > 0) {
																$verifikasi_surat_admin = $count_see_verifikasi_hukdis + $count_see_verifikasi_tp + $count_see_verifikasi_karir;
															}
															echo $count_see_verifikasi + $count_see_verifikasi_tj + $count_see_verifikasi_kaku + $verifikasi_surat_admin; ?></span>
											<?php } ?>
											<i class="caret"></i></span>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a href="<?php echo base_url(); ?>verifikasi"><i class="icon-off"></i> Verifikasi Surat Keterangan Pegawai &nbsp;
												<?php if ($count_see_verifikasi > 0) { ?>
													<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi; ?></span>
												<?php } ?>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url(); ?>verifikasi_tunjangan"><i class="icon-off"></i> Verifikasi Surat Permohonan Tunjangan Keluarga &nbsp;
												<?php if ($count_see_verifikasi_tj > 0) { ?>
													<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tj; ?></span>
												<?php } ?>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url(); ?>verifikasi_kariskarsu"><i class="icon-off"></i> Verifikasi Surat Permohonan KARIS/KARSU &nbsp;
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
												<a href="<?php echo base_url(); ?>verifikasi_hukdis"><i class="icon-off"></i> Verifikasi Surat Keterangan Hukuman Disiplin &nbsp;
													<!-- notif -->
													<?php if ($count_see_verifikasi_hukdis > 0) { ?>
														<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_hukdis; ?></span>
													<?php } ?>
												</a>
											</li>
											<li>
												<a href="<?php echo base_url(); ?>verifikasi_tindak_pidana"><i class="icon-off"></i> Verifikasi Surat Keterangan Bebas Tindak Pidana &nbsp;
													<!-- notif -->
													<?php if ($count_see_verifikasi_tp > 0) { ?>
														<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tp; ?></span>
													<?php } ?>
												</a>
											</li>
											<li class=''>
												<a href="<?php echo base_url(); ?>verifikasi_pengembangan_karir"><i class="icon-off"></i> Verifikasi Surat Kebutuhan Pengembangan Karir &nbsp;
													<!-- notif -->
													<?php if ($count_see_verifikasi_karir > 0) { ?>
														<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_karir; ?></span>
													<?php } ?>
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
		notify_lapor()

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
			var urls = "<?php echo site_url('Lapor/data_lapor'); ?>";

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

		function notify_lapor() {
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

		function reload_table() {
			tableLapor.ajax.reload(null, false); //reload datatable ajax 
			notify_lapor();
		}

		function add_lapor() {
			save_method = 'add';
			$.ajax({
				url: "<?php echo site_url('Lapor/form_lapor_add'); ?>",
				data: "act=" + 'Tambah',
				type: "POST",
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$('.modal-footer').hide(); // show bootstrap modal
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Form Tambah Data Lapor Pegawai'); // Set Title to Bootstrap modal title
		}

		function simpan_lapor() {

			var Kategori = $("#Kategori").val();
			var Isi_laporan = $("#Isi_laporan").val();
			var File_upload = $("#File_upload").val();
			var File_upload_lama = $("#File_upload_lama").val();

			if (save_method == 'add') {

				if (Kategori == '') {
					// alert('Kategori Tidak Boleh Kosong');
					$.dialog({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Kategori tidak boleh kosong.',
						type: 'red',
						backgroundDismiss: true
					});
				} else if (Isi_laporan == '') {
					// alert('Isi Laporan Tidak Boleh Kosong');
					$.dialog({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Isi lapor tidak boleh kosong.',
						type: 'red',
						backgroundDismiss: true
					});
				} else if (Kategori == 'Terkait Data' && File_upload == '') {
					// alert('Kategori Terkait Data, File Tidak Boleh Kosong');
					$.dialog({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Kategori terkait data, file tidak boleh kosong.',
						type: 'red',
						backgroundDismiss: true
					});
				} else {
					ajax_simpan_lapor();
				}

			} else {

				if (Kategori == '') {
					// alert('Kategori Tidak Boleh Kosong');
					$.dialog({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Kategori tidak boleh kosong.',
						type: 'red',
						backgroundDismiss: true
					});
				} else if (Isi_laporan == '') {
					// alert('Isi Laporan Tidak Boleh Kosong');
					$.dialog({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Isi lapor tidak boleh kosong.',
						type: 'red',
						backgroundDismiss: true
					});
				} else if (Kategori == 'Terkait Data' && File_upload == '' && File_upload_lama == '') {
					// alert('Kategori Terkait Data, File Tidak Boleh Kosong');
					$.dialog({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Kategori terkait data, file tidak boleh kosong.',
						type: 'red',
						backgroundDismiss: true
					});
				} else {
					ajax_simpan_lapor();
				}
			}
		}

		function ajax_simpan_lapor() {
			var formData = new FormData($('#form_lapor')[0]);
			var url;
			if (save_method == 'add') {
				url = "<?php echo site_url('Lapor/simpan_add'); ?>";
			} else {
				url = "<?php echo site_url('Lapor/simpan_update'); ?>";
			}
			$.ajax({
				url: url,
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					$('#modal_all').modal('hide');
					// alert(response);
					// reload_table();

					const resp = JSON.parse(response);

					$.dialog({
						icon: 'fa fa-info',
						title: 'Info',
						content: resp.status,
						type: resp.tipe == 1 ? 'green' : 'red',
						backgroundDismiss: true
					});

					reload_table();
				}
			});
		}

		function view_lapor() {
			// alert('uder maintenance !!!');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: 'Sedang dalam pengerjaan...',
				type: 'red',
				backgroundDismiss: true
			});
		}

		function delete_lapor(Id) {
			var i = "Hapus data lapor?";
			var b = "Data berhasil dihapus";

			// if (!confirm(i)) return false;
			// $.ajax({
			// 	type: "post",
			// 	data: "Id=" + Id,
			// 	url: "<?php //echo site_url('Lapor/delete_lapor') 
							?>",
			// 	success: function(s) {
			// 		alert(s);
			// 		reload_table();
			// 	}
			// });



			$.confirm({
				icon: 'fa fa-warning',
				title: 'Konfirmasi',
				content: i,
				type: 'red',
				buttons: {
					yes: {
						text: 'Ya',
						btnClass: 'btn-red',
						action: function() {
							$.ajax({
								type: "post",
								data: "Id=" + Id,
								url: "<?php echo site_url('Lapor/delete_lapor') ?>",
								success: function(s) {
									$.dialog({
										icon: 'fa fa-info',
										title: 'Info',
										content: b,
										type: 'green',
										backgroundDismiss: true
									});

									reload_table();
								}
							});
						}
					},
					no: {
						text: 'Tidak'
					}
				}
			})
		}

		function gettanggapan(Id) {
			$.ajax({
				type: "post",
				data: {
					Id
				},
				url: "<?php echo site_url('Lapor/modal_tanggapan'); ?>",
				beforeSend: function(s) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
				},
				success: function(data) {
					$('#modal_all .modal-dialog').addClass('modalan');
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$("#modal_all .modal-title").text("Buat Tanggapan");
			$("#modal_all .modal-footer").addClass("hidden");
			$('.modal-footer').hide(); // show bootstrap modal
			$('#modal_all').modal('show'); // show bootstrap modal
			$('#modal_all').modal({
				backdrop: false,
				keyboard: true
			});
		}
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
				icon: 'fa fa-warning',
				title: 'Info',
				content: 'Sedang dalam pengerjaan...',
				type: 'red',
				backgroundDismiss: true
			});
		}

		// === begin: main container top menyesuikan tinggi navbar ===
		$(document).ready(function() {
			setTimeout(setPadding, 1000);
		});

		function setPadding() {
			$defaultNavbarHeight = 50;
			$navbarHeight = $('.navbar').height();
			$mainWrapperPadding = 5; //parseInt($(".content-wrapper").css("padding-top"));
			$newMainWrapperPadding = $mainWrapperPadding + $navbarHeight - $defaultNavbarHeight;
			console.log($navbarHeight);
			console.log($newMainWrapperPadding);

			if ($navbarHeight > $defaultNavbarHeight) {
				$(".content-wrapper").css("padding-top", $newMainWrapperPadding);
			}
		}

		$(window).resize(function() {
			setPadding();
		});
		// === end: main container top menyesuikan tinggi navbar ===
	</script>

</body>

</html>