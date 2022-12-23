<script src="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/fancy_source/dist/jquery.fancybox.min.css" media="screen" />
<style type="text/css">
	.td_head {
		font-weight: bold;
		background-color: #7d7d7d;
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
<table id="table_laporan" class="table table-striped table-bordered" cellspacing="0" width="100%" style='font-size:13px !important;'>
	<thead>
		<tr>
			<td class="td_head">No.</td>
			<td class="td_head">Aksi</td>
			<td class="td_head">File</td>
			<td class="td_head">Kategori</td>
			<td class="td_head">Isi Laporan</td>
			<td class="td_head">Dibuat Oleh</td>
			<td class="td_head">Tanggapi</td>
			<td class="td_head">Tanggal Lapor</td>
		</tr>
	</thead>
	<tbody></tbody>
</table>
</div>
<script type="text/javascript">
	table = $('#table_laporan').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "<?php echo site_url('admin/Data_lapor/table_data_lapor') ?>",
			"type": "POST"
		},
		"aoColumns": [{
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "left"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}],
		language: {
			processing: 'Memuat...',
		},
		lengthMenu: [10, 20, 30, 40, 50, 100],
		"bSort": false,
		"bInfo": true,
		"dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>'
	});

	function gettanggapan(Id) {
		$.ajax({
			type: "post",
			data: {
				Id
			},
			url: "<?php echo site_url('Lapor/modal_tanggapan'); ?>",
			beforeSend: function(s) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html("Memuat Data...");
			},
			success: function(data) {
				$('#modal_all .modal-dialog').addClass('modalan');
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$("#modal_all .modal-title").text("Buat Tanggapan");
		$("#modal_all .modal-footer").addClass("hidden");
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('#modal_all').modal({
			backdrop: false,
			keyboard: true
		});
	}
</script>