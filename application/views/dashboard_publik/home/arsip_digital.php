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

	<!-- sso styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>sso/css/style.css" />
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
							<li><a href="<?php echo base_url(); ?>dashboard_publik"><i class="icon-home icon-white"></i> Beranda</a></li>
							<li class="active"><a href="<?php echo base_url(); ?>dashboard_publik/arsip_digital"><i class="icon-leaf icon-white"></i> Arsip Digital</a></li>
							<li class="dropdown"><a href="http://dcktrp.jakarta.go.id/e-cuti/" target="_blank" class="" data-toggle=""><i class="icon-fire icon-white"></i> Cuti Pegawai <b class=""></b></a></li>
							<li class="dropdown user user-menu">
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
							</li>

							<li class=""><a href="<?php echo base_url(); ?>lapor"><i class="icon-home icon-white"></i> lapor</a></li>

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
									<span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?> <i class="caret"></i></span>
								</a>
								<ul class="dropdown-menu">
									<!-- <li><a href="<?php //echo base_url(); 
														?>app/change_password_publik"><i class="icon-wrench"></i> Pengaturan Akun</a></li> -->
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
									<center><?php echo $alamat; ?>
								</p>
							</div>
						</div>
					</div>
				</section>

				<!-- Main content -->
				<!-- arsip pribadi -->
				<section id="data-pribadi" class="content">
					<div class="callout callout-info">
						<h3>Arsip Digital Pribadi</h3>
						Masukkan Data Scan Dokumen Pribadi (KTP, KK, Akta Lahir, Buku Nikah dan sebagainya). Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<button class="btn btn-success" onclick="add_pribadi()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
									<button class="btn btn-default" onclick="reload_table_pribadi()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="pribadi" data-title="Download" title="Download">
										<i class="fa fa-download"></i> Download All
									</button>
									<br /><br />

									<table id="table_pribadi" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Judul Data Pribadi</th>
												<th>Nama File</th>
												<th>Opsi</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
				<!-- end arsip pribadi -->

				<!-- arsip sk -->
				<section id="data-sk" class="content">
					<div class="callout callout-info">
						<h3>Arsip Digital SK</h3>
						Masukkan Data Scan Dokumen SK (SK Gubernur, Surat Tugas, SKP dan data yang berkaitan dengan kepegawaian). Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
					</div>

					<?php if ($this->session->flashdata('gagalupload')) { ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<h4>GAGAL !!!</h4>
							<?php echo $this->session->flashdata('gagalupload'); ?>
						</div>
					<?php } ?>

					<?php if ($this->session->flashdata('gagalupload2')) { ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<h4>GAGAL !!!</h4>
							<?php echo $this->session->flashdata('gagalupload'); ?>
						</div>
					<?php } ?>

					<?php if ($this->session->flashdata('gagalupload3')) { ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<h4>GAGAL !!!</h4>
							<?php echo $this->session->flashdata('gagalupload3'); ?>
						</div>
					<?php } ?>

					<?php if ($this->session->flashdata('gagalupload4')) { ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<h4>GAGAL !!!</h4>
							<?php echo $this->session->flashdata('gagalupload4'); ?>
						</div>
					<?php } ?>

					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<button class="btn btn-success" onclick="add_sk()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
									<button class="btn btn-default" onclick="reload_table_sk()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="sk" data-title="Download" title="Download">
										<i class="fa fa-download"></i> Download All
									</button>
									<br /><br />

									<table id="table_sk" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Judul SK</th>
												<th>Jenis SK</th>
												<th>Nama File</th>
												<th>Opsi</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
				<!-- end arsip sk -->

				<!-- arsip pendidikan -->
				<section id="data-pendidikan" class="content">
					<div class="callout callout-info">
						<h3>Arsip Digital Pendidikan</h3>
						Masukkan Data Scan Dokumen Pendidikan (Ijasah, Sertifikat Pelatihan dan sebagainya). Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<button class="btn btn-success" onclick="add_pendidikan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
									<button class="btn btn-default" onclick="reload_table_pendidikan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="pendidikan" data-title="Download" title="Download">
										<i class="fa fa-download"></i> Download All
									</button>
									<br /><br />

									<table id="table_pendidikan" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Judul Data Pendidikan</th>
												<th>Tipe Pendidikan</th>
												<th>Nama File</th>
												<th>Opsi</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
				<!-- end arsip pendidikan -->

				<!-- arsip pelatihan -->
				<section id="data-pelatihan" class="content">
					<div class="callout callout-info">
						<h3>Arsip Pelatihan</h3>
						Masukkan Data Scan Dokumen Pelatihan. Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<button class="btn btn-success" onclick="add_pelatihan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
									<button class="btn btn-default" onclick="reload_table_pelatihan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="pelatihan" data-title="Download" title="Download">
										<i class="fa fa-download"></i> Download All
									</button>
									<br /><br />

									<table id="table_pelatihan" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Judul Pelatihan</th>
												<th>Nama File</th>
												<th>Opsi</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
				<!-- end arsip pelatihan -->

				<section id="data-skp" class="content">
					<div class="callout callout-info">
						<h3>Arsip Digital SKP / DP3</h3>
						Masukkan Data Scan Dokumen SKP / DP3. Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="nav-tabs-custom">
								<div class="tab-content">
									<button class="btn btn-success" onclick="add_skp()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
									<button class="btn btn-default" onclick="reload_table_skp()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="skp" data-title="Download" title="Download">
										<i class="fa fa-download"></i> Download All
									</button>
									<br />
									<br />
									<table id="table_skp" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Judul Data SKP / DP3</th>
												<th>Nama File</th>
												<th>Opsi</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
				<br /><br /><br />


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

								<h3 class="modal-title" align="center">Masukkan Koordinat Alamat Anda</h3>

							</div>

							<div class="modal-body">

								<div class="control-group">

									<div class="control-label">

										<div id="viewDiv" align="center" style="height:280px;width:520px;overflow:visible;"></div>

									</div>

								</div>

							</div>

							<div class="modal-footer">

								<button type="button" class="btn btn-primary" data-dismiss="modal">Simpan Lokasi</button>

							</div>

							<div id="locateBTN" class="esri-widget--button" title="Cek Lokasi Anda">

								<span class="esri-icon-default-action"></span>

							</div>

						</div><!-- /.modal-content -->

					</div><!-- /.modal-dialog -->

				</div><!-- /.modal -->

				<!-- modal lihat file -->
				<div class="modal fade" id="lihat_file" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content" align="center">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div class="form-group" id="MyModalBody">
									<div class="col-md-9">
										(No File)
										<span class="help-block"></span>
									</div>
								</div>
							</div>
							<div class="modal-footer">
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->

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

				<!-- modal sk -->
				<div class="modal fade" id="modal_sk" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h3 class="modal-title">Tambah Data sk - <?php echo $this->session->userdata("nama_pegawai"); ?></h3>
							</div>
							<div class="modal-body form">
								<form action="#" id="form_sk" class="form-horizontal" enctype='multipart/form-data' method="post">
									<input type="hidden" value="" name="id_sk" />
									<div class="form-body">
										<div class="form-group">
											<label class="control-label col-md-3">Judul SK</label>
											<div class="col-md-9">
												<input type="text" class="form-control" name="title_sk" id="judulsk" placeholder="Judul SK">
												<span class="help-block"></span>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-md-3" id="label-photo">Masukkan Lampiran SK </label>
											<div class="col-md-9">
												<input id="file_sk" name="file_sk" type="file" class="form-control" />
												<span class="help-block"></span>
											</div>
										</div>
									</div>
								</form>
							</div>

							<div class="modal-footer">
								<button type="button" id="btnskSave" onclick="savesk()" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->

				<!-- End Bootstrap modal -->

			</div>
		</div>
	</div>

	<script type="text/javascript">
		var save_method; //for save method string
		var tablesk;
		var tablepribadi;
		var tablependidikan;
		var tableskp;
		var tablePelatihan;
		var save_method; //for save method string
		var base_url = '<?php echo base_url(); ?>';

		$(document).ready(function() {

			//datatables

			tablesk = $('#table_sk').DataTable({



				"processing": true, //Feature control the processing indicator.

				"serverSide": true, //Feature control DataTables' server-side processing mode.

				"order": [], //Initial no order.



				// Load data for the table's content from an Ajax source

				"ajax": {

					"url": "<?php echo site_url('arsip_sk/sk_datatables') ?>",

					"type": "POST"

				},



				//Set column definition initialisation properties.

				"columnDefs": [

					{

						"targets": [-1], //last column

						"orderable": false, //set not orderable

					},

				],



			});



			tablepribadi = $('#table_pribadi').DataTable({



				"processing": true, //Feature control the processing indicator.

				"serverSide": true, //Feature control DataTables' server-side processing mode.

				"order": [], //Initial no order.



				// Load data for the table's content from an Ajax source

				"ajax": {

					"url": "<?php echo site_url('arsip_pribadi/pribadi_datatables') ?>",

					"type": "POST"

				},



				//Set column definition initialisation properties.

				"columnDefs": [

					{

						"targets": [-1], //last column

						"orderable": false, //set not orderable

					},

				],



			});



			tablependidikan = $('#table_pendidikan').DataTable({



				"processing": true, //Feature control the processing indicator.

				"serverSide": true, //Feature control DataTables' server-side processing mode.

				"order": [], //Initial no order.



				// Load data for the table's content from an Ajax source

				"ajax": {

					"url": "<?php echo site_url('arsip_pendidikan/pendidikan_datatables') ?>",

					"type": "POST"

				},



				//Set column definition initialisation properties.

				"columnDefs": [

					{

						"targets": [-1], //last column

						"orderable": false, //set not orderable

					},

				],



			});



			tableskp = $('#table_skp').DataTable({



				"processing": true, //Feature control the processing indicator.

				"serverSide": true, //Feature control DataTables' server-side processing mode.

				"order": [], //Initial no order.



				// Load data for the table's content from an Ajax source

				"ajax": {

					"url": "<?php echo site_url('arsip_skp/skp_datatables') ?>",

					"type": "POST"

				},



				//Set column definition initialisation properties.

				"columnDefs": [

					{

						"targets": [-1], //last column

						"orderable": false, //set not orderable

					},

				],



			});

			tablePelatihan = $('#table_pelatihan').DataTable({
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('arsip_pelatihan/pelatihan_datatables') ?>",
					"type": "POST"
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [-1], //last column
					"orderable": false, //set not orderable
				}, ],
			});

			function add_sk() {
				$('#label-photo').text('Masukkan Lampiran SK');
				$('#frame_sk').remove();
				save_method = 'addsk';

				$('#form_sk')[0].reset(); // reset form on modals
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string
				$('#modal_sk').modal('show'); // show bootstrap modal
				$('.modal-title').text('Tambah Data sk - <?php echo $this->session->userdata("nama_pegawai"); ?>'); // Set Title to Bootstrap modal title
			}

			function edit_sk(id_sk) {
				$('#label-photo').text('Masukkan Lampiran SK');
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
							$('#label-photo').text('Ubah Lampiran SK');
							$('#file_sk').before('<iframe id="frame_sk" src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>');
						} else {
							$('#label-photo').text('Masukkan Lampiran SK');
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
				// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
				// 	// ajax delete data to database
				// 	$.ajax({
				// 		url: "<?php echo site_url('arsip_sk/sk_delete') ?>/" + id_sk,
				// 		type: "POST",
				// 		dataType: "JSON",
				// 		success: function(data) {
				// 			//if success reload ajax table
				// 			$('#modal_sk').modal('hide');
				// 			reload_table_sk();
				// 		},
				// 		error: function(jqXHR, textStatus, errorThrown) {
				// 			alert('Proses delete data error');
				// 		}
				// 	});
				// }



				let q = 'Hapus data?';
				let i = 'Data berhasil dihapus.';
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
									url: '<?php echo site_url("arsip_sk/sk_delete") ?>/' + id_sk,
									success: function() {
										$.dialog({
											icon: 'fa fa-info',
											title: 'Info',
											content: i,
											type: 'green',
											backgroundDismiss: true
										});

										//if success reload ajax table
										$('#modal_sk').modal('hide');
										reload_table_sk();
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



</body>

</html>