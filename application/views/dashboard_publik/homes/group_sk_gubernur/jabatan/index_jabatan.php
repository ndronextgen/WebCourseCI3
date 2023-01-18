<br>
<button class="btn btn-success" onclick="add_jabatan()"><i class="glyphicon glyphicon-plus"></i> Tambah Data Jabatan</button>
<button class="btn btn-default" onclick="reload_table_jabatan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
<button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="newjabatan" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button>
<hr>
<table id="table_jabatan" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>Status Jabatan</th>
			<th>Nama Jabatan</th>
			<th>Lokasi</th>
			<th>TMT</th>
			<th>Tgl. SK</th>
			<th>No. SK</th>
			<th width='0px' data-priority='1'>File</th>
			<th width='0px' data-priority='1'>Aksi</th>
		</tr>
	</thead>
</table>

<script type="text/javascript">
	tablejabatan = $('#table_jabatan').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('jabatan/jabatan_datatables') ?>",
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
		}, {
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
	});

	function detail_jabatan(Id) {
		$.ajax({
			url: "<?php echo site_url('Jabatan/form_detail_Jabatan') ?>",
			type: "POST",
			data: {
				Id: Id
			},
			beforeSend: function(f) {
				//var loading = '<img src="public/assets/media/loading/loading.gif" style="width:5em;">';
				$('#modal_all_md .modal-dialog .modal-content .modal-body').html('Mohon Tunggu');
			},
			success: function(data) {
				$('#modal_all_md .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('#modal_all_md').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Detail Jabatan'); // Set Title to Bootstrap modal title
	}
</script>