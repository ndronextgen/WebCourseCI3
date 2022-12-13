<br>
<button class="btn btn-success" onclick="add_sk()"><i class="glyphicon glyphicon-plus"></i> Tambah Data SK Lainnya</button>
<button class="btn btn-default" onclick="reload_table_sk()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="newsk" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button>
<hr>
<table id="table_sk" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>Judul SK</th>
			<th>Jenis SK</th>
			<th>Nama File</th>
			<th width='0px'>File</th>
			<th width='0px' data-priority='1'>Aksi</th>
		</tr>
	</thead>
</table>

<script type="text/javascript">
	tablesk = $('#table_sk').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		// rowReorder: {
		// 	selector: 'td:nth-child(2)'
		// },
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('arsip_sklainnya/sk_datatables') ?>",
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
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
	});

	function detail_sklainnya(Id) {
		$.ajax({
			data: {
				Id: Id
			},
			url: "<?php echo site_url('Arsip_sklainnya/form_detail_sklainnya') ?>",
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
		$('.modal-title').text('Form Detail SK Lainnya'); // Set Title to Bootstrap modal title
	}
</script>