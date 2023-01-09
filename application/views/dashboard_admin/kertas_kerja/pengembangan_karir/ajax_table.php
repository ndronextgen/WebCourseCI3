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
	<button type="button" class="btn btn-success active btn-sm" onclick="tambah_surat_pengembangan_karir()"><i class="fa fa-plus"></i> Tambah Surat Pengembangan Karir</button>
	<hr>
	<table id="table_pengembangan_karir" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%" style='font-size:13px !important;'>
		<thead>
			<tr>
				<th class="td_head" width='1px'>No</th>
				<th class="td_head" width='80px'>Aksi</th>
				<th class="td_head">Nama Pegawai</th>
				<th class="td_head">Keterangan</th>
				<th class="td_head">Periode</th>
				<th class="td_head">Keperluan</th>
				<th class="td_head" width='180px' style="text-align: center;">Status</th>
				<th class="td_head">Tanggal Dibuat</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<script type="text/javascript">
	table = $('#table_pengembangan_karir').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "<?php echo site_url('admin/Data_pengembangan_karir/table_data_pengembangan_karir') ?>",
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
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "center"
		}, {
			"sClass": "left"
		}],
		language: {
			processing: 'Memuat...!',
		},
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[8] == "0") {
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

	function tambah_surat_pengembangan_karir() {
		save_method = 'tambah';
		$.ajax({
			url: "<?php echo site_url('admin/Data_pengembangan_karir/tambah_pengembangan_karir'); ?>",
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Surat Pengembangan Karir Pegawai'); // Set Title to Bootstrap modal title
	}

	function edit_surat_pengembangan_karir(Pengembangan_karir_id) {
		save_method = 'edit';
		$.ajax({
			url: "<?php echo site_url('admin/Data_pengembangan_karir/edit_pengembangan_karir'); ?>",
			type: "POST",
			data: {
				Pengembangan_karir_id: Pengembangan_karir_id
			},
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Ubah Surat Pengembangan Karir Pegawai'); // Set Title to Bootstrap modal title
	}

	function proses_surat_pengembangan_karir(Pengembangan_karir_id) {
		save_method = 'verifikasi';
		$.ajax({
			url: "<?php echo site_url('admin/Data_pengembangan_karir/proses_pengembangan_karir'); ?>",
			data: {
				Pengembangan_karir_id: Pengembangan_karir_id
			},
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Detail/Proses Verifikasi Pengembangan Karir'); // Set Title to Bootstrap modal title
	}
</script>