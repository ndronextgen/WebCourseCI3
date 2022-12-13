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

	<!-- <section id="data-hukuman" class="content"> -->
	<div class="callout callout-info">
		<h4>KARIS/KARSU</h4>
		<p>Fasilitas untuk mengajukan Surat Permohonan KARIS/KARSU</p>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="page-header">
						<h4># Data KARIS/KARSU Anda</h4>
					</div>
					<button class="btn btn-success" onclick="add_tunjangan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Tunjangan</button>
					<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
					<hr>
					<div class='table-responsive'>
						<table id="table_tunjangan" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Aksi</th>
									<th>Kategori</th>
									<th>Tanggal Dibuat</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
	<!-- </section> -->

	<script type="text/javascript">
		tableLapor = $('#table_tunjangan').DataTable({

				"processing": true,
				"serverSide": true,
				"order": [],
				responsive: true,
				"ajax": {
					"url": "<?php echo site_url('tunjangan/table_data_tunjangan') ?>",
					"type": "POST"
				}

				,
				"columnDefs": [{
						"targets": [-1],
						"orderable": false,
					}

					,
				],

			}

		);

		function edit_tunjangan(Id) {
			save_method = 'update';

			$.ajax({

					url: "<?php echo site_url('Tunjangan/form_tunjangan_update'); ?>",
					data: {
						Id: Id
					}

					,
					type: "POST",
					success: function(data) {
						$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
					}
				}

			);
			$('.modal-footer').hide(); // show bootstrap modal
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Form Update Data Lapor Pegawai'); // Set Title to Bootstrap modal title
		}
	</script>