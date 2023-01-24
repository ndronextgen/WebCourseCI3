<button class='btn btn-info btn-sm' onclick='tambah_keluarga()' style='float:left;'><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Tambah Keluarga</button>
<br>
<hr>
<form id="fm_data_items">
	<input type="hidden" class="form-control form-control-sm" name="id_pegawai" id="id_pegawais" value='<?php echo $id_pegawai; ?>'>
	<input type="hidden" class="form-control form-control-sm" name="Tunjangan_id" id="Tunjangan_ids" value='<?php echo $Tunjangan_id; ?>'>

	<table class="table table-bordered" id="table_data_items" width="100%" style="font-size:11px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
		<thead>
			<tr>
				<th style="text-align: center;"><b>Action</b></th>
				<th style="text-align: center;"><b>Action</b></th>
				<th><b>Nama Anggota Keluarga</b></th>
				<th><b>Hubungan Keluarga</b></th>
				<th><b>Jenis Kelamin</b></th>
				<th style="text-align: center;"><b>Tanggal Lahir</b></th>
				<th><b>Keterangan</b></th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>

	<table class="table borderless">
		<tr>
			<td width="150px" style="vertical-align: middle;font-size: 12px;">Pindahkan yang dipilih: </td>
			<td>
				<button type="button" id="pindahkan" class="btn btn-sm btn-success btn-flat">Submit</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	tableas = $('#table_data_items').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"bDestroy": true,
		// "order": [],

		"ajax": {
			"url": "<?php echo site_url('Tunjangan/table_data_item') ?>",
			"type": "POST",
			"data": {
				id_pegawai: "<?php echo $id_pegawai; ?>",
				Tunjangan_id: "<?php echo $Tunjangan_id; ?>"
			}
		},

		"aoColumns": [{
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
			"sClass": "left"
		}],

		"columnDefs": [{
			"targets": 0,
			"checkboxes": {
				"selectRow": true
			},
			"orderable": false,
		}],

		"select": {
			'style': 'multi',
			'selector': 'tr:not(.no-select)'
		},

	});

	$(document).ready(function() {
		// Handle form submission event 
		$('#pindahkan').on('click', function(e) {
			var form = $('#fm_data_items');
			var rows_selected = tableas.column(0).checkboxes.selected();
			// Iterate over all selected checkboxes
			$.each(rows_selected, function(index, rowId) {
				// Create a hidden element 
				$(form).append(
					$('<input>')
					.attr('type', 'hidden')
					.attr('name', 'id[]')
					.val(rowId)
				);
			});

			if ($('#table_data_items input[type="checkbox"]:checked').length) { //jika ada yg checklis
				//if($('#table_data_items input[type="checkbox"]:checked').size()) { /*kalo ada yg ceklis*/
				// if (!confirm('Pindahkan Item ini ?')) return false;

				let q = 'Tambahkan ke daftar penerima tunjangan?';
				let i = 'Berhasil ditambahkan.';

				var new_selection = rows_selected.join("||");
				var string = new_selection;
				var Tunjangan_ids = $('#Tunjangan_ids').val();

				$.confirm({
					icon: 'fa fa-question',
					title: 'Konfirmasi',
					content: q,
					type: 'orange',
					buttons: {
						yes: {
							text: 'Ya',
							btnClass: 'btn-green',
							action: function() {
								$.ajax({
									type: "post",
									data: {
										string: string,
										Tunjangan_id: Tunjangan_ids
									},
									url: "<?php echo site_url('Tunjangan/pindahkan_item') ?>",
									success: function(s) {
										$.dialog({
											icon: 'fa fa-info',
											title: 'Info',
											content: i,
											type: 'green',
											backgroundDismiss: true
										});

										$('#modal_all').modal('show');
										// reload_table_item(); //buat function untuk reload table
										reload_table_item_pilihan(); //buat function untuk reload table
										$('#modal_all').modal('hide');
									}
								});
							}
						},
						no: {
							text: 'Tidak'
						}
					}
				})

			} else {
				// alert('Belum ada yg dipilih....');
				let i = 'Belum ada anggota keluarga yang dipilih.';
				$.dialog({
					icon: 'fa fa-warning',
					title: 'Info',
					content: i,
					type: 'red',
					backgroundDismiss: true
				});
			}

			// Remove added elements
			$('input[name="id\[\]"]', form).remove();
			e.preventDefault();
		});
	});

	function reload_table_item() {
		tableas.ajax.reload(null, false); //reload datatable ajax 
	}

	// ubah keluarga
	function ubah_keluarga(Id_ubah) {
		$.ajax({
			url: "<?php echo site_url('Tunjangan/content_item_keluarga'); ?>",
			data: {
				Id: '<?php echo $id_pegawai; ?>',
				Tunjangan_id: '<?php echo $Tunjangan_id; ?>'
			},
			type: "POST",
			beforeSend: function() {
				$('#modal_all').modal('hide');
				$('#modal_all .modal-dialog .modal-content .modal-body').html('');
			},
			success: function(data) {
				$('#isi_keluarga').html(data);
				var room = 'ubah_tunjangan';
				var param_1 = '<?php echo $id_pegawai; ?>';
				var param_2 = '<?php echo $Tunjangan_id; ?>';

				edit_keluarga(Id_ubah, room, param_1, param_2);
			}
		});
	}

	// tambah keluarga
	function tambah_keluarga() {
		$.ajax({
			url: "<?php echo site_url('Tunjangan/content_item_keluarga'); ?>",
			data: {
				Id: '<?php echo $id_pegawai; ?>',
				Tunjangan_id: '<?php echo $Tunjangan_id; ?>'
			},
			type: "POST",
			beforeSend: function() {
				$('#modal_all').modal('hide');
				$('#modal_all .modal-dialog .modal-content .modal-body').html('');
			},
			success: function(data) {
				$('#isi_keluarga').html(data);
				var room = 'tunjangan';
				var param_1 = '<?php echo $id_pegawai; ?>';
				var param_2 = '<?php echo $Tunjangan_id; ?>';

				add_keluarga(room, param_1, param_2);
			}
		});
	}
</script>