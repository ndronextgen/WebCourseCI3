<!-- arsip pribadi -->
<section id="data-pribadi" class="content">
	<div class="callout callout-info">
		<h4>Arsip Digital Pribadi</h4>
		Masukkan Data Scan Dokumen Pribadi (KTP, KK, Akta Lahir, Buku Nikah dan sebagainya). Format File : gif, jpg, jpeg, png dan pdf (Max : 5 MB)
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<button class="btn btn-success" onclick="add_pribadi()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Pribadi</button>
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
<!-- end arsip pribadi -->

<br>

<script type="text/javascript">
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