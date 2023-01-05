<script src="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.css" media="screen" />

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

<table id="table_tunjangan" class="table table-striped table-bordered" cellspacing="0" width="100%" style='font-size:13px !important;'>
	<thead>
		<tr height='50px;'>
			<td class="td_head" width='10px'>No.</td>
			<td class="td_head" width='180px'>Aksi</td>
			<td class="td_head" width='200px'>Status Terakhir</td>
			<td class="td_head">Dibuat Oleh</td>
			<td class="td_head">Tanggal Dibuat</td>
		</tr>
	</thead>
	<tbody></tbody>
</table>

<script type="text/javascript">
	table = $('#table_tunjangan').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "<?php echo site_url('admin/Data_tunjangan/table_data_tunjangan') ?>",
			"type": "POST"
		},
		"aoColumns": [{
			"sClass": "center"
		}, {
			"sClass": "left"
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
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[5] == "1") {
				/*mapping*/
				$("td:eq(0)", nRow).css('font-weight', 'bold');
				$("td:eq(1)", nRow).css('font-weight', 'bold');
				$("td:eq(2)", nRow).css('font-weight', 'bold');
				$("td:eq(3)", nRow).css('font-weight', 'bold');
				$("td:eq(4)", nRow).css('font-weight', 'bold');
				$("td:eq(5)", nRow).css('font-weight', 'bold');
				$(nRow).css('background-color', '#f7f7cd');
			}
		},
		"bSort": false,
		"bInfo": true,
		"dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>'
	});


	function proses_tunjangan(Tunjangan_id) {
		$.ajax({
			url: "<?php echo site_url('admin/Data_tunjangan/proses_tunjangan'); ?>",
			data: {
				Tunjangan_id: Tunjangan_id
			},
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Proses Verifikasi Tunjangan Keluarga'); // Set Title to Bootstrap modal title
	}
</script>