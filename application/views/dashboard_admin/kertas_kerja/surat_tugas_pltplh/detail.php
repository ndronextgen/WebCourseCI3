<?php headAdminHtml();?>
<body style="background-image: url(<?php echo base_url().'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
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
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-list-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											<?php echo $page_name; ?> <small>untuk <?php echo $pegawai->nama_pegawai; ?></small>
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="<?php echo base_url();?>admin/surat_tugas_pltplh" class="btn btn-clean btn-icon-sm">
												<i class="la la-long-arrow-left"></i>
												Kembali
											</a>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<!--begin: Search Form -->
									<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
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
									<?php echo form_open(base_url().'admin/surat_tugas_pltplh','class="form-horizontal" id="frmSuratTugasPlh"'); ?>
									<input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo $pegawai->id_pegawai;?>" />
									<input type="hidden" name="id_surat" id="id_surat" />
									<!--begin: Datatable -->
									<!-- <table class="kt-datatable" id="tbl" width="100%">
										<thead>
											<tr>
												<th width="10px">No</th>
												<th>Menggantikan</th>
												<th>Lokasi PLH</th>
												<th>Alasan</th>
												<th>Lama/Durasi (Hari)</th>
												<th>Tanggal Pengajuan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table> -->
									<div class="kt-portlet__body kt-portlet__body--fit">
										<div class="kt-datatable" id="tbl_lispltplh"></div>
									</div>
									<!--end: Datatable -->
									<?php echo form_close(); ?>
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
	<script src="<?php echo base_url()?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_admin/js/global/init.js" type="text/javascript"></script>

	<!-- Sweetalert -->
	<link rel="stylesheet" href="<?= base_url("assets_admin/sweetalert2/sweetalert2.min.css"); ?>">
	<script src="<?= base_url("assets_admin/sweetalert2/sweetalert2.min.js"); ?>"></script>
	<!-- end script global -->

	<!-- begin script page -->
	<script src="<?php echo base_url()?>assets_admin/js/pages/custom/tables/surat_tugas_pltplh_detail.js" type="text/javascript"></script>
	<!-- end script page -->

	<script>
		function hapus_surat_tugas_pltplh(id_surat) 
		{

			let id_pegawaipltplh = $('#id_pegawai').val();

			Swal.fire({
				title: `Konfirmasi`,
				text: `Hapus Data Surat Tugas PLTPLH?`,
				type: 'warning',
				showCancelButton : true,
				confirmButtonText : 'Ya',
				confirmButtonColor : '#3085d6',
				cancelButtonColor : '#d33',
				cancelButtonText : 'Tidak',
				reverseButtons : true
			}).then((result)=> {
				if(result.value) {
					$.ajax({
						url: "<?= site_url('admin/Surat_tugas_pltplh/delete') ?>",
						method: "POST",
						data: { id_surat },

						beforeSend: ()=> {
							Swal.fire({
								title: "Memproses",
								text: "Silahkan Tunggu, Proses Membutuhkan Waktu",
								onOpen: ()=> {
									Swal.showLoading();
								}
							})
						},
						success: (data)=> {
							Swal.fire({
								type: "success",
								title: "Berhasil!",
								text: "Hapus Surat Berhasil",
							}).then(()=> {
								window.location.assign("<?= site_url('admin/Surat_tugas_pltplh/detail/') ?>"+id_pegawaipltplh)
							});

						},
						error: ()=> {
							Swal.fire('Gagal', 'Silahkan Coba Lagi', 'error');
						}
					});
					return false;
				}
			});
		}
	</script>
</body>
