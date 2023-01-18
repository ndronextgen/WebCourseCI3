<!-- arsip pelatihan -->
<section id="data-pelatihan" class="content">
	<div class="callout callout-info">
		<h4>Arsip Pelatihan</h4>
		Masukkan Data Scan Dokumen Pelatihan. Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<button class="btn btn-success" onclick="add_pelatihan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Pelatihan</button>
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
								<th width='80px'>File</th>
								<th width='120px'>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
<!-- end arsip pelatihan -->

<br>

<script type="text/javascript">
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
		}],
		"aoColumns": [{
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}],
	});
</script>