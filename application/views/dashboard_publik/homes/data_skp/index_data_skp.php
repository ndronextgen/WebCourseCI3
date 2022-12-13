<section id="data-dp3" class="content">
	<div class="callout callout-info">
		<h4>SKP / DP3</h4>
		<p>Berisi data riwarat SKP / DP3. Silahkan dilengkapi.</p>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="page-header">
						<h4># Riwayat SKP / DP3</h4>
					</div>
					<button class="btn btn-success" onclick="add_skp()"><i class="glyphicon glyphicon-plus"></i> Tambah Riwayat SKP / DP3</button>
					<button class="btn btn-default" onclick="reload_table_skp()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
					<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="skp" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button>
					<hr>
					<table id="table_skp" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Jenis Data</th>
								<th>Tahun</th>
								<th>Rata-rata</th>
								<th>Atasan</th>
								<th>Penilai</th>
								<th>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
	tableskp = $('#table_skp').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('skp/skp_datatables') ?>",
			"type": "POST"
		},
		"columnDefs": [{
			"targets": [-1],
			"orderable": false,
		}],
	});
</script>