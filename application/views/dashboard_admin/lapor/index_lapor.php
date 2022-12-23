<?php headAdminHtml(); ?>

<body style="background-image: url(<?php echo base_url() . 'assets_admin/media/bg/header.jpg'; ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
	<?php
	headerAdmin();
	?>
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('asset/bootstrap/css/bootstrap.min2.css');
														?>"/> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugins/font-awesome-4.3.0/css/font-awesome.min.css'); ?>" />
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_admin/datatables/dataTables.bootstrap.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_admin/datatables/jquery.dataTables.min.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_admin/datatables/fixedHeader.dataTables.min.css'); ?>" />
	<style>
		.modal-header {
			border-bottom-color: #f4f4f4;
		}

		.modal-header {
			min-height: 16.43px;
			padding: 15px;
			border-bottom: 1px solid #e5e5e5;
			display: unset;
		}

		/* .badge {
			display: inline-block;
			min-width: 10px;
			padding: 3px 7px;
			font-size: 12px;
			font-weight: 700;
			line-height: 1;
			color: #fff;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			background-color: #777;
			border-radius: 10px;
		} */

		.modal-header .close {
			margin-top: -2px;
		}

		button.close {
			-webkit-appearance: none;
			padding: 0;
			cursor: pointer;
			background: 0 0;
			border: 0;
		}

		.close {
			float: right;
			font-size: 21px;
			font-weight: 700;
			line-height: 1;
			color: #000;
			text-shadow: 0 1px 0 #fff;
			filter: alpha(opacity=20);
			opacity: 0.2;
		}

		.btn.btn-flat {
			border-radius: 0;
			-webkit-box-shadow: none;
			-moz-box-shadow: none;
			box-shadow: none;
			border-width: 1px;
		}

		.btn-info {
			background-color: #00c0ef;
			border-color: #00acd6;
		}

		/* .btn {
			display: inline-block;
			padding: 6px 12px;
			margin-bottom: 0;
			font-size: 14px;
			font-weight: 400;
			line-height: 1.42857143;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			-ms-touch-action: manipulation;
			touch-action: manipulation;
			cursor: pointer;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			background-image: none;
			border: 1px solid transparent;
			border-radius: 4px;
		} */

		.btn-group-xs>.btn,
		.btn-xs {
			padding: 2px 2px 2px 6px;
			font-size: 12px;
			line-height: 1.5;
			border-radius: 3px;
		}

		.box {
			position: relative;
			border-radius: 3px;
			background: #ffffff;
			border-top: 3px solid #d2d6de;
			margin-bottom: 20px;
			width: 100%;
			box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
		}

		.box-header {
			color: #444;
			display: block;
			padding: 10px;
			position: relative;
		}

		.box-header>.box-tools {
			position: absolute;
			right: 10px;
			top: 5px;
		}

		.pull-right {
			float: right;
		}

		.pull-right {
			float: right !important;
		}

		.bg-aqua,
		.callout.callout-info,
		.alert-info,
		.label-info {
			background-color: #00c0ef !important;
		}

		.bg-red,
		.bg-yellow,
		.bg-aqua,
		.bg-blue,
		.bg-light-blue,
		.bg-green,
		.bg-navy,
		.bg-teal,
		.bg-olive,
		.bg-lime,
		.bg-orange,
		.bg-fuchsia,
		.bg-purple,
		.bg-maroon,
		.bg-black,
		.bg-red-active,
		.bg-yellow-active,
		.bg-aqua-active,
		.bg-blue-active,
		.bg-light-blue-active,
		.bg-green-active,
		.bg-navy-active,
		.bg-teal-active,
		.bg-olive-active,
		.bg-lime-active,
		.bg-orange-active,
		.bg-fuchsia-active,
		.bg-purple-active,
		.bg-maroon-active,
		.bg-black-active,
		.callout.callout-danger,
		.callout.callout-warning,
		.callout.callout-info,
		.callout.callout-success,
		.alert-success,
		.alert-danger,
		.alert-error,
		.alert-warning,
		.alert-info,
		.label-danger,
		.label-info,
		.label-waring,
		.label-primary,
		.label-success,
		.modal-primary .modal-header,
		.modal-warning .modal-header,
		.modal-info .modal-header,
		.modal-success .modal-header,
		.modal-danger .modal-header {
			color: #fff !important;
		}

		.label {
			display: inline;
			padding: 0.2em 0.6em 0.3em;
			font-size: 75%;
			font-weight: 700;
			line-height: 1;
			color: #fff;
			text-align: center;
			white-space: nowrap;
			vertical-align: baseline;
			border-radius: 0.25em;
		}
	</style>
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
											<?php echo $page_name; ?>
										</h3>
									</div>
								</div>

								<div class="kt-portlet__body">
									<div id='ajax_table'></div>
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

	<!-- Modal kabeh -->
	<div class="modal fade" id="modal_all" data-backdrop='static' data-keyboard='false'>
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
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

	<?php scrollTop(); ?>

	<!-- begin script global -->
	<script src="<?php echo base_url() ?>assets_admin/js/init.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets_admin/js/scripts.bundle.js" type="text/javascript"></script>
	<!-- end script global -->
	<script src="<?php echo base_url('assets_admin/datatables/jquery.dataTables.js'); ?>"></script>
	<script src="<?php echo base_url('assets_admin/datatables/dataTables.bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('assets_admin/datatables/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets_admin/datatables/dataTables.fixedHeader.min.js'); ?>"></script>
	<!-- begin script page -->
	<script>
		function load_data_lapor() {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('admin/Data_lapor/filter') ?>",
				data: {
					unite1: '0'
				},
				beforeSend: function(f) {
					var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
					$('#ajax_table').html(percentVal);
				},
				success: function(data) {
					$('#ajax_table').html(data);
				}
			});
		}
		load_data_lapor();

		function reload_table() {
			table.ajax.reload(null, false); //reload datatable ajax 
		}

		function delete_lapor(Id) {
			// var i = "Hapus ?";
			// var b = "Data Dihapus";
			// if (!confirm(i)) return false;
			// $.ajax({
			// 	type: "post",
			// 	data: "Id=" + Id,
			// 	url: "<?php echo site_url('Lapor/delete_lapor') ?>",
			// 	success: function(s) {
			// 		alert(s);
			// 		reload_table();
			// 	}
			// });



			var q = "Hapus data lapor?";
			var i = "Data berhasil dihapus";

			$jQ.confirm({
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
								type: "post",
								data: {
									Id: Id,
								},
								url: "<?php echo site_url('Lapor/delete_lapor') ?>",
								success: function(s) {
									$.dialog({
										title: 'Info',
										content: i,
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
	</script>
	<!-- end script page -->
</body>