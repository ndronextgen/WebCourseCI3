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
	<button type="button" class="btn btn-success active btn-sm" onclick="tambah_surat_pltplh()"><i class="fa fa-plus"></i> Tambah Surat PLT/PLH</button>
	<hr>
	<table id="table_pltplh" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%" style='font-size:13px !important;'>
		<thead>
			<tr>
				<th class="td_head" rowspan='2' style="text-align: center;" width='0px'>No</th>
				<th class="td_head" rowspan='2' width='0px'>Aksi</th>
				<th class="td_head" rowspan='2'>Type Surat</th>
				<th class="td_head" rowspan='2' align='center'>Pegawai PLT/PLH</th>
				<th class="td_head" colspan='5' style="text-align: center;">Pegawai Berhalangan</th>
				<th class="td_head" rowspan='2' width='0px'>Tanggal Dibuat</th>
			</tr>
			<tr>
				<th class="td_head">Nama Pegawawi</th>
				<!-- <th class="td_head">Lokasi Kerja</th> -->
				<th class="td_head">Keterangan</th>
				<th class="td_head">Durasi(Hari)</th>
				<th class="td_head">Tgl Mulai</th>
				<th class="td_head">Tgl Selesai</th>
				
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<script type="text/javascript">
	tablepltplh = $('#table_pltplh').DataTable({
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('admin/Data_pltplh/table_data_pltplh') ?>",
			"type": "POST"
		},
		// "columnDefs": [{
		// 	"targets": [-1],
		// 	"orderable": false,
		// }],
		"aoColumns": [{
			"sClass": "center"
		}, {
			"sClass": "center"
		}, {
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
		}],
		language: {
			processing: 'Memuat...!',
		},
		fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[6] == "0") {
				/*mapping*/
				$("td:eq(0)", nRow).css('font-weight', 'bold');
				$("td:eq(2)", nRow).css('font-weight', 'bold');
				$("td:eq(3)", nRow).css('font-weight', 'bold');
				$("td:eq(5)", nRow).css('font-weight', 'bold');
				$(nRow).css('background-color', '#f7f7cd');
			}
		},
		lengthMenu: [10, 20, 30, 40, 50, 100],

		"bSort": false,
		"bInfo": true,
		"dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>'
	});

	function tambah_surat_pltplh() {
		save_method = 'tambah';
		$.ajax({
			url: "<?php echo site_url('admin/Data_pltplh/tambah_pltplh'); ?>",
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Surat PLT/PLH Pegawai'); // Set Title to Bootstrap modal title
	}

	function edit_pltplh(id_surat_tugas_pltplh) {
		save_method = 'edit';
		$.ajax({
			url: "<?php echo site_url('admin/Data_pltplh/edit_pltplh'); ?>",
			type: "POST",
			data: {
				id_surat_tugas_pltplh: id_surat_tugas_pltplh
			},
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Ubah Surat PLT/PLH Pegawai'); // Set Title to Bootstrap modal title
	}


	function proses_surat_pindah_tugas(id_surat_tugas_pltplh) {
		save_method = 'verifikasi';
		$.ajax({
			url: "<?php echo site_url('admin/Data_pltplh/proses_pindah_tugas'); ?>",
			data: {
				id_surat_tugas_pltplh: id_surat_tugas_pltplh
			},
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Detail/Proses Verifikasi PLT/PLH'); // Set Title to Bootstrap modal title
	}
</script>