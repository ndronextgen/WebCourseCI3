<section id="data-hukuman" class="content">
	<div class="callout callout-info">
		<h4>Hukuman</h4>
		<p>Berisi data riwarat Hukuman. Silahkan dilengkapi.</p>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="page-header">
						<h4># Riwayat Hukuman</h4>
					</div>
					<button class="btn btn-success" onclick="add_hukuman()"><i class="glyphicon glyphicon-plus"></i> Tambah Riwayat Hukuman</button>
					<button class="btn btn-default" onclick="reload_table_hukuman()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
					<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="hukuman" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button>
					<hr>
					<div class='table-responsive'>
						<table id="table_hukuman" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Jenis Hukuman</th>
									<th>Uraian</th>
									<th>Nomor SK</th>
									<th>Tanggal SK</th>
									<th>File</th>
									<th>Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
	tableHukuman = $('#table_hukuman').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('hukuman/hukuman_datatables') ?>",
			"type": "POST"
		},
		"columnDefs": [{
			"targets": [-1],
			"orderable": false,
		}],

	});
</script>