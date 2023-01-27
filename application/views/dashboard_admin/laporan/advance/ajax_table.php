<style type="text/css">
	.td_head {
		font-weight: bold;
		background-color: #366cf3;
		color: #fff !important;
		font-size: 12px;
	}

	td.right {
		text-align: right
	}

	td.left {
		text-align: left
	}

	td.center {
		text-align: center
	}
</style>

<div class="table-responsive">
	<table id="table_laporan" class="table  table-striped table-bordered nowrap" cellspacing="0" width="100%" style='font-size:13px !important;'>
		<thead>
			<tr>
				<td class="td_head">No</td>
				<td class="td_head">NIP</td>
				<td class="td_head">NRK</td>
				<td class="td_head">Nama Pegawai</td>
				<td class="td_head">Lokasi Kerja</td>
				<td class="td_head">Sub Lokasi Kerja</td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<script type="text/javascript">
	tableLaporan = $('#table_laporan').DataTable({
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('admin/laporan_advance/table_data_laporan') ?>",
			"type": "POST",
			data: {
				lokasi: '<?= $lokasi ?>',
				sublokasi: '<?= $sublokasi ?>',
			},
		},
		"aoColumns": [{
			"sClass": "center"
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
		}],
		language: {
			processing: 'Memuat...',
		},
		lengthMenu: [10, 20, 30, 40, 50, 100],
		"bSort": false,
		"bInfo": true,
		"dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>'
	});
</script>