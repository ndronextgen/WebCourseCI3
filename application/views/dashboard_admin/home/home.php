<?php headAdminHtml(); ?>

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin();
	?>

	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<?php menuAdmin($menu_open); ?>

				<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
					<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						<!-- begin Subheader -->
						<?php headerTitle(); ?>
						<!-- end Subheader -->

						<!-- begin content -->
						<div class="kt-container  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet kt-portlet--mobile">

								<!-- chart -->
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="col-12">
										<div class="row" style="flex-wrap: nowrap;">
											<div class="col-md-4">
												<div class="panel panel-default">
													<div class="panel-body">
														<div class="kt-portlet__head kt-portlet__head--lg">
															<div class="kt-portlet__head-label">
																<h3 class="kt-portlet__head-title">Infografis Status Pegawai</h3>
															</div>
														</div>
														<div id="grafik_status"></div>
													</div>
												</div>
											</div><!-- /.col -->

											<div class="col-md-4">
												<div class="panel panel-default">
													<div class="panel-body">
														<div class="kt-portlet__head kt-portlet__head--lg">
															<div class="kt-portlet__head-label">
																<h3 class="kt-portlet__head-title">Infografis Kenaikan Pangkat</h3>
															</div>
														</div>
														<div id="grafik_naikpangkat"></div>
													</div>
												</div>
											</div><!-- /.col -->

											<div class="col-md-4">
												<div class="panel panel-default">
													<div class="panel-body">
														<div class="kt-portlet__head kt-portlet__head--lg">
															<div class="kt-portlet__head-label">
																<h3 class="kt-portlet__head-title">Infografis Pensiun</h3>
															</div>
														</div>
														<div id="grafik_pensiun"></div>
													</div>
												</div>
											</div><!-- /.col -->
										</div>
									</div>
								</div>
								<!-- end chart -->

								<div class="kt-portlet__head kt-portlet__head--lg kt-margin-t-20">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-list-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="dropdown dropdown-inline">
												<!--<button type="button" class="btn btn-brand btn-icon-sm">-->
												<?php
												$user_type = $this->session->userdata('stts');
												$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
												if ($user_type == "administrator") {
													if ($id_lokasi_kerja == '' || $id_lokasi_kerja == null || $id_lokasi_kerja == '0') { //admin utama
														$button = '	<a href="' . base_url() . 'pegawai/tambah" class="btn btn-brand btn-icon-sm">
																		<i class="flaticon2-plus"></i> Tambah Data Pegawai
																	</a>';
													} else { //admin lokasi
														$button = "";
													}
												} else { //public
													$button = "";
												}
												echo $button;
												?>

												<!--</button>-->
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">

									<?php
									if (validation_errors()) {
										echo '<div class="alert alert-danger fade show" role="alert">
												<div class="alert-icon"><i class="flaticon-warning"></i></div>
												<div class="alert-text">' . validation_errors() . '</div>
												<div class="alert-close">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true"><i class="la la-close"></i></span>
													</button>
												</div>
											</div>';
									}

									if ($this->session->flashdata('suksestambah')) {
										echo '<div class="alert alert-warning fade show" role="alert">
												<div class="alert-icon"><i class="flaticon-warning"></i></div>
												<div class="alert-text">' . $this->session->flashdata('suksestambah') . '</div>
												<div class="alert-close">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true"><i class="la la-close"></i></span>
													</button>
												</div>
											</div>';
									}
									if ($this->session->flashdata('deleteuser')) {
										echo '<div class="alert alert-warning fade show" role="alert">
												<div class="alert-icon"><i class="flaticon-warning"></i></div>
												<div class="alert-text">' . $this->session->flashdata('deleteuser') . '</div>
												<div class="alert-close">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true"><i class="la la-close"></i></span>
													</button>
												</div>
											</div>';
									}
									?>
									<!--begin: Search Form -->
									<div class="kt-form kt-form--label-right">
										<div class="row align-items-center">
											<div class="col-xl-8 order-2 order-xl-1">
												<div class="row align-items-center">
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-input-icon kt-input-icon--left">
															<input type="text" class="form-control" placeholder="Masukkan Kata Kunci Pencarian" id="txtSearch">
															<span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end: Search Form -->
								</div>
								<div class="kt-portlet__body kt-portlet__body--fit">
									<!--begin: Datatable -->
									<div class="kt-datatable" id="tblPegawai"></div>
									<!--end: Datatable -->
								</div>
							</div>
						</div>
						<!-- end content -->
					</div>
				</div>
				<?php footerAdmin(); ?>
			</div>
		</div>
	</div>

	<?php scrollTop(); ?>

	<!-- begin script global -->
	<script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url() ?>assets_admin/js/pages/custom/tables/pegawai.js" type="text/javascript"></script>
	<!-- end script page -->

	<!-- ChartJS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

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
		function getRandomColor() {
			var letters = '0123456789ABCDEF'.split('');
			var color = '#';
			for (var i = 0; i < 6; i++) {
				color += letters[Math.floor(Math.random() * 16)];
			}
			return color;
		}

		function grafikstatus() {
			$.ajax({
				url: "<?= site_url('Pegawai/grafik_status') ?>",
				method: "get",
				//data: { param },
				success: (data) => {
					$('#grafik_status').html(data)
				}
			});
		}

		function grafikpensiun() {
			$.ajax({
				url: "<?= site_url('Pegawai/grafik_pensiun') ?>",
				method: "get",
				//data: { param },
				success: (data) => {
					$('#grafik_pensiun').html(data)
					//alert(data);
				}
			});
		}

		function grafiknaikpangkat() {
			$.ajax({
				url: "<?= site_url('Pegawai/grafik_naikpangkat') ?>",
				method: "get",
				//data: { param },
				success: (data) => {
					$('#grafik_naikpangkat').html(data)
					//alert(data);
				}
			});
		}

		grafikstatus();
		grafikpensiun();
		grafiknaikpangkat();
	</script>
</body>