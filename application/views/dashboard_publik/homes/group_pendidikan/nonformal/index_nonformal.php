<br>
<button class="btn btn-success" onclick="add_pelatihan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Pendidikan Non-Formal</button>
<button class="btn btn-default" onclick="reload_table_pelatihan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="pelatihan" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button>
<hr>
<table id="table_pelatihan" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama Pelatihan</th>
			<th>Lokasi</th>
			<th>Nomor Sertifikat</th>
			<th>Tanggal Sertifikat</th>
			<th>Keterangan</th>
			<th width='0px' data-priority='1'>File</th>
			<th width='0px' data-priority='1'>Aksi</th>
		</tr>
	</thead>
</table>

<script type="text/javascript">
	tablepelatihan = $('#table_pelatihan').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('pelatihan/pelatihan_datatables') ?>",
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
			"sClass": "left"
		}, {
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
	});

	function detail_pelatihan(Id) {
		$.ajax({
			data: {
				Id: Id
			},
			url: "<?php echo site_url('Pelatihan/form_detail_pelatihan') ?>",
			type: "POST",
			beforeSend: function(f) {
				//var loading = '<img src="public/assets/media/loading/loading.gif" style="width:5em;">';
				$('#modal_all_md .modal-dialog .modal-content .modal-body').html('Mohon Tunggu');
			},
			success: function(data) {
				$('#modal_all_md .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('#modal_all_md').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Detail Pendidikan Non-Formal'); // Set Title to Bootstrap modal title
	}
</script>