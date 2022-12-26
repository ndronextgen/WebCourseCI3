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
	<link href="<?php echo base_url(); ?>asset/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/datatables/js/dataTables.bootstrap.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>asset/bootstrap/js/fastclick.min.js"></script>
	<link href="<?php echo base_url(); ?>asset/css/docs.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>asset/js/application.js"></script>


	<!-- load javascript api for arcgis -->
	<link rel="stylesheet" href="https://js.arcgis.com/4.9/esri/css/main.css">
	<script src="https://js.arcgis.com/4.9/"></script>
	<script src="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.css" media="screen" />

	<!-- sso styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>sso/css/style.css" />

	<!-- jquery-confirm -->
	<link rel="stylesheet" href="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.css'); ?>">
	<script src="<?php echo base_url('asset/jquery-confirm/jquery-confirm.min.js'); ?>"></script>

	<!-- begin: progress timeline -->
	<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('asset/timeline-master/style.css'); ?>">
	<!-- end: progress timeline -->

	<style type="text/css">
		.modal-header {
			/* background-color: #1caf9a; */
			background-color: #1c8baf;
			/* padding: 16px 16px; */
			color: #FFF;
		}

		label {
			font-weight: bold;
		}

		/* Important part */
		.modal-dialog {
			overflow-y: initial !important;
		}

		.modal-body {
			overflow-y: auto;
			background-color: #f1f1f6;
		}

		.select2-selection__rendered {
			/* background-color: #ababab; */
			background-color: #defee2;
		}
	</style>

	<style type="text/css">
		.td_head {
			font-weight: bold;
			background-color: #006168;
			color: #fff !important;
			font-size: 12px;
			font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
			text-align: center;
		}

		td.right {
			text-align: right
		}

		td.left {
			text-align: left
		}

		td.center {
			text-align: center
		}
	</style>

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
						<?php echo $judul_pendek; ?></a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">

							<li><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
							<li><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
							<!-- <li class="dropdown"><a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-fire icon-white"></i> Cuti Pegawai <b class=""></b></a></li> -->

							<li class="dropdown user user-menu active">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="hidden-xs">Kertas Kerja &nbsp;<span id='ttl_kertas_kerja'></span>
										<i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<li class="active">
										<a href=" <?php echo base_url(); ?>dashboard_publik/status_surat"><i class="icon-leaf icon-white"></i>Surat Keterangan Pegawai&nbsp;
											<span id='notif_count'></span>
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
											<?php if (
													$count_see_verifikasi > 0
													or $count_see_verifikasi_tj > 0
													or $count_see_verifikasi_kaku > 0
													or $count_see_verifikasi_hukdis > 0
													or $count_see_verifikasi_tp > 0
													or $count_see_verifikasi_karir > 0
												) { ?>
												<span class="badge btn-warning btn-flat"><?php echo $count_see_verifikasi
																										+ $count_see_verifikasi_tj
																										+ $count_see_verifikasi_kaku
																										+ $count_see_verifikasi_hukdis
																										+ $count_see_verifikasi_tp
																										+ $count_see_verifikasi_karir; ?></span>
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
													<?php if ($count_see_verifikasi_hukdis > 0) { ?>
														<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_hukdis; ?></span>
													<?php } ?>
												</a>
											</li>
											<li>
												<a href="<?php echo base_url(); ?>verifikasi_tindak_pidana"><i class="icon-off"></i> Verifikasi Surat Keterangan Bebas Tindak Pidana &nbsp;
													<?php if ($count_see_verifikasi_tp > 0) { ?>
														<span class="badge btn-warning btn-flat"><?php echo '' . $count_see_verifikasi_tp; ?></span>
													<?php } ?>
												</a>
											</li>
											<li>
												<a href="<?php echo base_url(); ?>verifikasi_pengembangan_karir"><i class="icon-off"></i> Verifikasi Surat Kebutuhan Pengembangan Karir &nbsp;
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

				<!-- <section class="content-header" style="padding: 15px 0 0 0;"> -->

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
				<!-- </section> -->

				<!-- Main content -->
				<!-- <section id="data-srt_ket" class="content"> -->
				<div class="callout callout-info">
					<h4>Surat Keterangan Pegawai</h4>
					Fasilitas untuk mengajukan Surat Keterangan Pegawai.
				</div>

				<!-- begin: flash alert -->
				<?php if ($this->session->flashdata('suksestambah')) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<h4>SUKSES !!!</h4>
						<?php echo $this->session->flashdata('suksestambah'); ?>
					</div>
				<?php } ?>
				<?php if ($this->session->flashdata('gagaltambah')) { ?>
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<h4>GAGAL !!!</h4>
						<?php echo $this->session->flashdata('gagaltambah'); ?>
					</div>
				<?php } ?>
				<!-- end: flash alert -->

				<div class="row">
					<div class="col-xs-12">
						<div class="nav-tabs-custom">
							<div class="tab-content">
								<button class="btn btn-success" onclick="tambah_pengajuan_surat()"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Pengajuan Surat</button>
								<br><br>

								<table id="table_srt_ket" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Surat</th>
											<th>Tanggal Pengajuan</th>
											<th>Keperluan</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
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

			<script type="text/javascript">
				var save_method; //for save method string
				var tablesrt_ket;

				$(document).ready(function() {
					notify_me();
					//datatables
					tablesrt_ket = $('#table_srt_ket').DataTable({

						"processing": true, //Feature control the processing indicator.
						"serverSide": true, //Feature control DataTables' server-side processing mode.
						"order": [], //Initial no order.

						// Load data for the table's content from an Ajax source
						"ajax": {
							"url": "<?php echo site_url('srt_ket/srt_datatables') ?>",
							"type": "POST"
						},

						//Set column definition initialisation properties.
						"columnDefs": [{
							"targets": [-1], //last column
							"orderable": false, //set not orderable
						}],

						// set column align
						"aoColumns": [{
							"sClass": "center"
						}, {
							"sClass": "left"
						}, {
							"sClass": "left"
						}, {
							"sClass": "left"
						}, {
							"sClass": "center"
						}, {
							"sClass": "left"
						}],

						fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
							if (aData[6] == "0") {
								/*mapping*/
								$("td:eq(0)", nRow).css('font-weight', 'bold');
								$("td:eq(1)", nRow).css('font-weight', 'bold');
								$("td:eq(2)", nRow).css('font-weight', 'bold');
								$("td:eq(3)", nRow).css('font-weight', 'bold');
								$("td:eq(4)", nRow).css('font-weight', 'bold');
								$("td:eq(5)", nRow).css('font-weight', 'bold');
								$(nRow).css('background-color', '#f7f7cd');
							}
						},

					});

				});

				function edit_srt(id_srt) {
					save_method = 'update';
					$('#form_srt')[0].reset(); // reset form on modals
					$('.form-group').removeClass('has-error'); // clear error class
					$('.help-block').empty(); // clear error string

					//Ajax Load data from ajax
					$.ajax({
						url: "<?php echo site_url('srt_ket/srt_edit/') ?>/" + id_srt,
						type: "GET",
						dataType: "JSON",
						success: function(data) {
							$('[name="id_srt"]').val(data.id_srt);
							$('[name="keterangan"]').val(data.keterangan);
							$('[name="sel_jen_pengajuan_edit"]').val(data.jenis_pengajuan_surat);
							if (data.jenis_pengajuan_surat.toLowerCase() == 'x') {
								$('[name="jen_pengajuan_lain_input_edit"]').val(data.jenis_pengajuan_surat_lainnya);
								$('#jen_pengajuan_lain_input_edit').parents().eq(1).show();
							} else {
								$('#jen_pengajuan_lain_input_edit').parents().eq(1).hide();
							}

							$('#modal_srt').modal('show'); // show bootstrap modal when complete loaded
							$('.modal-title').text('Edit Data Surat'); // Set title to Bootstrap modal title
						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function view_srt(id_srt) {
					$.ajax({
						url: "<?php echo site_url('Srt_ket/srt_view') ?>",
						type: "POST",
						data: {
							id_srt: id_srt
						},
						success: function(data) {
							//alert(data);
							$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
							$('#modal_all').modal('show'); // show bootstrap modal
							$('.modal-title').text('Informasi Surat Keterangan'); // Set Title to Bootstrap modal title
							reload_table_srt();
						}
					});
				}

				function notify_me() {
					$.ajax({
						url: "<?php echo site_url('Srt_ket/notify_me') ?>",
						type: "POST",
						beforeSend: function(f) {
							var loading = '';
							$('span#notif_count').html(loading);
							$('span#ttl_kertas_kerja').html(loading);
						},
						success: function(s) {
							//$('span#notif_count').html(s);
							var obj = JSON.parse(s);
							$('span#notif_count').html(obj.surat_keterangan);
							$('span#ttl_kertas_kerja').html(obj.ttl_kertas_kerja);
						}
					});
				}

				function reload_table_srt() {
					tablesrt_ket.ajax.reload(null, false); //reload datatable ajax 
					notify_me();
				}

				function savesrt() {
					$('#btnSaveSrt').text('saving...'); //change button text
					$('#btnSaveSrt').attr('disabled', true); //set button disable 
					var url;

					if (save_method == 'update') {
						url = "<?php echo site_url('srt_ket/srt_update') ?>";
					}

					// ajax adding data to database
					$.ajax({
						url: url,
						type: "POST",
						data: $('#form_srt').serialize(),
						dataType: "JSON",
						success: function(data) {

							if (data.status) //if success close modal and reload ajax table
							{
								$('#modal_srt').modal('hide');
								reload_table_srt();
							} else {
								for (var i = 0; i < data.inputerror.length; i++) {
									$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
									$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
								}
							}
							$('#btnSaveSrt').text('save'); //change button text
							$('#btnSaveSrt').attr('disabled', false); //set button enable 


						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert('Error adding / update data');
							$('#btnSaveSrt').text('save'); //change button text
							$('#btnSaveSrt').attr('disabled', false); //set button enable 

						}
					});
				}

				function delete_srt(id_srt) {
					// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
					// 	// ajax delete data to database
					// 	$.ajax({
					// 		url: "<?php echo site_url('srt_ket/srt_delete') ?>/" + id_srt,
					// 		type: "POST",
					// 		dataType: "JSON",
					// 		success: function(data) {
					// 			reload_table_srt();
					// 		},
					// 		error: function(jqXHR, textStatus, errorThrown) {
					// 			alert('Proses delete data error');
					// 		}
					// 	});
					// }



					let q = 'Hapus data surat keterangan pegawai?';
					let i = 'Surat keterangan pegawai berhasil dihapus.';
					let e = 'Proses hapus data bermasalah.';

					$.confirm({
						icon: 'fa fa-warning',
						title: 'Konfirmasi',
						content: q,
						type: 'red',
						buttons: {
							yes: {
								text: 'Ya',
								btnClass: 'btn-red',
								action: function() {
									$.ajax({
										url: "<?php echo site_url('srt_ket/srt_delete') ?>",
										type: "post",
										data: "id_srt=" + id_srt,
										success: function() {
											$.dialog({
												icon: 'fa fa-info',
												title: 'Info',
												content: i,
												type: 'green',
												backgroundDismiss: true
											});

											reload_table_srt();
										},
										error: function(jqXHR, textStatus, errorThrown) {
											$.dialog({
												icon: 'fa fa-info',
												title: 'Info',
												content: e,
												type: 'red',
												backgroundDismiss: true
											});
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
			</script>

			<div class="modal fade" id="modal_srt" role="dialog" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><i class="fa fa-times"></i></span>
							</button>
							<h3 class="modal-title">Tambah Data Surat - <?php echo $this->session->userdata("nama_pegawai"); ?></h3>
						</div>

						<div class="modal-body form">
							<form action="#" id="form_srt" class="form-horizontal">
								<input type="hidden" value="" name="id_srt" />
								<div class="form-body">

									<div class="form-group">
										<label class="control-label col-md-4">Keperluan</label>
										<div class="col-md-8">
											<select class="select2 form-control" name="sel_jen_pengajuan_edit" id="sel_jen_pengajuan_edit" placeholder="Jenis Pengajuan Surat">
												<!-- <option value=""></option> -->
												<?php
												$mst_jenis_pengajuan_surat = $this->srt_ket_model->jenis_pengajuan_surat();

												foreach ($mst_jenis_pengajuan_surat as $data) {
													?>
													<?php
														?>
													<option value="<?= $data->kode; ?>">
														<?= $data->keterangan; ?>
													</option>
												<?php
												}
												?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group" name="grp_jen_pengajuan" id=" grp_jen_pengajuan">
										<label class="control-label col-md-4" name="jen_pengajuan_lain_label" id="jen_pengajuan_lain_label">Keperluan Lainnya</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="jen_pengajuan_lain_input_edit" id="jen_pengajuan_lain_input_edit" placeholder="Keperluan lainnya">
											<span class="help-block"></span>
										</div>
									</div>

									<!-- <div class="form-group">
										<label class="control-label col-md-4">Keterangan</label>
										<div class="col-md-8">
											<textarea class="form-control textarea" style="height: 100px; overflow:auto; resize:none" name="keterangan" id="keterangan"></textarea>
											<span class="help-block"></span>
										</div>
									</div> -->

								</div>
							</form>
						</div>

						<div class="modal-footer">
							<button type="button" id="btnSrtSave" onclick="savesrt()" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->


			<!-- <div class="modal in" id="modal_all" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" onclick="reload_table_srt()" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="largeModalHead">Large Modal</h4>
						</div>
						<div class="modal-body">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" onclick="reload_table_srt()" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div> -->



		</div>
	</div>

	<script type="text/javascript">
		function tutup_form() {
			$('#modal_all').modal('hide');
		}

		function tambah_pengajuan_surat() {
			// save_method = 'add';
			$.ajax({
				url: "<?php echo site_url('dashboard_publik/pengajuan_surat'); ?>",
				type: "POST",
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Form Pengajuan Surat'); // Set Title to Bootstrap modal title
		}

		function lihat_detail_ditolak(idSurat) {
			$.ajax({
				url: "<?php echo site_url('dashboard_publik/ket_surat_ditolak'); ?>",
				type: "POST",
				data: {
					idSurat: idSurat
				},
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Surat Keterangan Pegawai Ditolak'); // Set Title to Bootstrap modal title
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#sel_jen_pengajuan_edit').change(function() {

				if (this.value.toLowerCase() == 'x') {
					$('#jen_pengajuan_lain_input_edit').parents().eq(1).show();
				} else {
					$('#jen_pengajuan_lain_input_edit').parents().eq(1).hide();
				}

			});
		});

		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 2000);
	</script>

	<!-- SSO LIB -->
	<script type="text/javascript" src="<?php echo base_url(); ?>sso/main.js"></script>

	<script type="text/javascript">
		function ExtractHostname(url) {
			var hostname;
			//find & remove protocol (http, ftp, etc.) and get hostname

			if (url.indexOf("//") > -1) {
				hostname = url.split('/')[2];
			} else {
				hostname = url.split('/')[0];
			}

			//find & remove port number
			hostname = hostname.split(':')[0];
			//find & remove "?"
			hostname = hostname.split('?')[0];

			return hostname;
		}
		let domain = ExtractHostname('<?php echo base_url() ?>');

		if (domain == 'dcktrp.jakarta.go.id') {
			let sso = new SSO({
				// debug: true,
				// cors: true,
				sso_services_url: 'https://dcktrp.jakarta.go.id/sso/service/'
			});
			sso.initComponent('body');
			document.querySelector('#sso_floating_widget').style.zIndex = 99999;
		}
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

		// begin: progress timeline joe 2022.11.03
		function showTimeline(id_srt) {
			$.ajax({
				url: "<?php echo site_url('srt_ket/show_timeline'); ?>",
				type: "POST",
				data: {
					id_srt: id_srt
				},
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
				}
			});
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Perjalanan Pengajuan Surat Keterangan Pegawai'); // Set Title to Bootstrap modal title
		}
		// end: progress timeline joe 2022.11.03

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

<div class="modal fade" id="modal_all" data-backdrop="static" tabindex="-1">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times"></i></span>
				</button>
				<h4 class="modal-title" style="font-family: Source Sans Pro, sans-serif;">Modal Header</h4>
			</div>
			<div class="modal-body">
			</div>
			<!-- <div class="modal-footer" hidden="true">
				<button type="button" class="btn btn-success btn-flat btn-sm" onClick="simpan()">
					<span class="fa fa-ok" aria-hidden="true"></span> Simpan
				</button>
			</div> -->
		</div>
	</div>
</div>

</html>