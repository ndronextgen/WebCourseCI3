<style type="text/css">
	label {
		font-weight: bold;
	}
</style>

<br>

<div class="table-responsive">
	<button class="btn btn-success" onclick="add_keluarga()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Keluarga</button>
	<button class="btn btn-default" onclick="reload_table_keluarga()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="newkeluarga" data-title="Download" title="Download">
		<i class="fa fa-download"></i> Download All
	</button>

	<hr>

	<table id="table_keluarga" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>No.</th>
				<th>Hubungan Keluarga</th>
				<th>Nama Keluarga</th>
				<th>Jenis Kelamin</th>
				<th>Tanggal Lahir</th>
				<th>Keterangan</th>
				<th width='0px'>File</th>
				<th width='0px' data-priority='1'>Aksi</th>
			</tr>
		</thead>
	</table>

</div>

<script type="text/javascript">
	tablekeluarga = $('#table_keluarga').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('keluarga/keluarga_datatables') ?>",
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

	function detail_keluarga(Id) {
		$.ajax({
			data: {
				Id: Id
			},
			url: "<?php echo site_url('Keluarga/form_detail_keluarga') ?>",
			type: "POST",
			beforeSend: function(f) {
				//var loading = '<img src="public/assets/media/loading/loading.gif" style="width:5em;">';
				$('#modal_all .modal-dialog .modal-content .modal-body').html('Mohon Tunggu');
			},
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Detail Keluarga'); // Set Title to Bootstrap modal title
	}
</script>