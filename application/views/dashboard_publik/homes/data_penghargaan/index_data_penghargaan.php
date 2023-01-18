<!-- <section id="data-penghargaan" class="content"> -->
<div class="callout callout-info">
	<h4>Penghargaan</h4>
	<p>Berisi data riwayat penghargaan. Silahkan dilengkapi.</p>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<div class="tab-content">
				<!-- <div class="page-header"> -->
				<!-- <h4># Riwayat Penghargaan</h4> -->
				<!-- </div> -->
				<button class="btn btn-success" onclick="add_penghargaan()"><i class="glyphicon glyphicon-plus"></i> Tambah Riwayat Penghargaan</button>
				<button class="btn btn-default" onclick="reload_table_penghargaan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="penghargaan" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button>
				<hr>
				<table id="table_penghargaan" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Penghargaan</th>
							<th>Pemberi Penghargaan</th>
							<th>Nomor SK</th>
							<th>Tanggal SK</th>
							<th width='0px' data-priority='1'>File</th>
							<th width='0px' data-priority='1'>Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- </section> -->

<script type="text/javascript">
	tablepenghargaan = $('#table_penghargaan').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('penghargaan/penghargaan_datatables') ?>",
			"type": "POST"
		},
		"columnDefs": [{
			"targets": [-1],
			"orderable": false,
		}],
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
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
	});
</script>