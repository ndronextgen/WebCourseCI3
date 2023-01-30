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
	<table border="0" cellspacing="0" cellpadding="0" width="99%" class='no-print'>
		<tr class="no-print" style="font-size: 12px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">

				<td align="left" width="140px">
					<a  href='<?php echo site_url('admin/laporan_advance/cetak?ctype=pdf&lokasi='.$lokasi.'&sublokasi='.$sublokasi.'&id_golongan='.$id_golongan.'&status_pegawai='.$status_pegawai.'&jenis_kelamin='.$jenis_kelamin); ?>'>
						<button name='download_excel' class="btn btn-sm btn-flat btn-danger"><i class="fa  fa-file-pdf-o"></i> Download Pdf</button>
					</a>
				</td>
				<td align="left">
				<a  href='<?php echo site_url('admin/laporan_advance/cetak?ctype=excel&lokasi='.$lokasi.'&sublokasi='.$sublokasi.'&id_golongan='.$id_golongan.'&status_pegawai='.$status_pegawai.'&jenis_kelamin='.$jenis_kelamin); ?>'>
						<button name='download_excel' class="btn btn-sm btn-flat btn-success"><i class="fa fa-file-excel"></i> Download Excel</button>
					</a>
				</td>
		</tr>
	</table>
	<hr>
	<table id="table_laporan" class="table  table-striped table-bordered nowrap" cellspacing="0" width="100%" style='font-size:13px !important;'>
		<thead>
			<tr>
				<td class="td_head">No</td>
				<td class="td_head">NIP</td>
				<td class="td_head">NRK</td>
				<td class="td_head">Nama Pegawai</td>
				<td class="td_head">Golongan</td>
				<td class="td_head">Status Pegawai</td>
				<td class="td_head">Jenis Kelamin</td>
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
				id_golongan: '<?= $id_golongan ?>',
				status_pegawai: '<?= $status_pegawai ?>',
				jenis_kelamin: '<?= $jenis_kelamin ?>',
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
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
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