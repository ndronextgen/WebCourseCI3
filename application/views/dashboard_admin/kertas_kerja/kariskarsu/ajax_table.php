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

<div class="table-responsive">
	<table id="table_kariskasru" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%" style='font-size:13px !important;'>
		<thead>
			<tr>
				<th class="td_head" width='1px' rowspan='2'>No</th>
				<th class="td_head" width='80px' rowspan='2'>Aksi</th>
				<th class="td_head" rowspan='2'>Nama Pegawai</th>
				<th class="td_head" rowspan='2'>Perihal</th>
				<th class="td_head" rowspan='2'style="text-align: center;">Status</th>
				<th class="td_head" colspan='6' style="text-align: center;">File Pendukung</th>
				<th class="td_head" rowspan='2'>Tanggal Dibuat</th>
			</tr>
			<tr>
				<th class="td_head">Surat Nikah</th>
				<th class="td_head" style="text-align: center;">KK</th>
				<th class="td_head">KTP Suami</th>
				<th class="td_head">KTP Istri</th>
				<th class="td_head">SK CPNS/PNS</th>
				<th class="td_head" style="text-align: center;">Foto</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<script type="text/javascript">
	table = $('#table_kariskasru').DataTable({
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('admin/Data_kariskarsu/table_data_kariskarsu') ?>",
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
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
		language: {
			processing: 'Memuat...',
		},
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[11] == "1") {
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
		lengthMenu: [10, 20, 30, 40, 50, 100],

		"bSort": false,
		"bInfo": true,
		"dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>'
	});


	function proses_kariskarsu(Kariskarsu_id) {
		$.ajax({
			url: "<?php echo site_url('admin/Data_kariskarsu/proses_kariskarsu'); ?>",
			data: {
				Kariskarsu_id: Kariskarsu_id
			},
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Proses Verifikasi Kariskarsu Pegawai'); // Set Title to Bootstrap modal title
	}
</script>