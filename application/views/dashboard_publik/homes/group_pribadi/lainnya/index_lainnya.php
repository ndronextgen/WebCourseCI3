<br>
<button class="btn btn-success" onclick="add_pribadi()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Pribadi Lainnya</button>
<button class="btn btn-default" onclick="reload_table_pribadi()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="newarsip" data-title="Download" title="Download">
	<i class="fa fa-download"></i> Download All
</button>

<hr>

<table id="table_pribadi" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>Judul Data Pribadi</th>
			<th>Nama File</th>
			<th width='0px'>File</th>
			<th width='0px' data-priority='1'>Aksi</th>
		</tr>
	</thead>
</table>

<script type="text/javascript">
	tablepribadi = $('#table_pribadi').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		// rowReorder: {
		// 	selector: 'td:nth-child(2)'
		// },
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('arsip_pribadilainnya/pribadi_datatables') ?>",
			"type": "POST"
		},
		"columnDefs": [{
			"targets": [-1],
			"orderable": false,
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
			"sClass": "left"
		}],
	});
</script>