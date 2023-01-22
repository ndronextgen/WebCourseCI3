<button class='btn btn-info btn-sm' onclick='tambah_keluarga()' style='float:left;'><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Tambah Keluarga</button>
<br>
<hr>
<!-- <form id="fm_data_items"> -->
<input type="hidden" class="form-control form-control-sm" name="id_pegawai" id="id_pegawais" value='<?php echo $id_pegawai; ?>'>
<input type="hidden" class="form-control form-control-sm" name="Kariskarsu_id" id="Kariskarsu_ids" value='<?php echo $Kariskarsu_id; ?>'>

<table class="table table-bordered" id="table_data_items" width="100%" style="font-size:11px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
	<thead>
		<tr>
			<th align="center" width='80px'><b>Action</b></th>
			<th align="center"><b>Nama Anggota Keluarga</b></th>
			<th align="center"><b>Tempat dan Tanggal Nikah</b></th>
			<th align="center"><b>NIP / Nomor Identitas</b></th>
			<th align="center"><b>Pangkat / Golongan Ruang</b></th>
			<th align="center"><b>Jabatan / Pekerjaan</b></th>
			<th align="center"><b>Tempat Tanggal Lahir</b></th>
			<th align="center"><b>Agama</b></th>
			<th align="center"><b>Alamat</b></th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

<script type="text/javascript">
	tableas = $('#table_data_items').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		// "order": [],
		"responsive": true,
		"ajax": {
			"url": "<?php echo site_url('Kariskarsu/table_data_item') ?>",
			"type": "POST",
			"data": {
				id_pegawai: "<?php echo $id_pegawai; ?>",
				Kariskarsu_id: "<?php echo $Kariskarsu_id; ?>"
			}
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
		}, {
			"sClass": "left"
		}, {
			"sClass": "left"
		}, {
			"sClass": "left"
		}],

	});

	function usulkan_data(Keluarga_id, Kariskarsu_id) {
		let q = 'Pilih data ini?';
		let i = 'Data berhasil dipilih.';
		let e = 'Proses pilih data bermasalah.';

		$.confirm({
			icon: 'fa fa-warning',
			title: 'Konfirmasi',
			content: q,
			type: 'orange',
			buttons: {
				yes: {
					text: 'Ya',
					btnClass: 'btn-green',
					action: function() {
						$.ajax({
							url: '<?php echo site_url('kariskarsu/pindahkan_item') ?>',
							type: "post",
							data: {
								Kariskarsu_id: Kariskarsu_id,
								Keluarga_id: Keluarga_id,
							},
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_form .modal-dialog .modal-content .modal-body').html('');
								$('#modal_form').modal('hide'); // hide bootstrap modal
								get_temp_item_pilihan(Kariskarsu_id);
								batal_form();
							},
							error: function(jqXHR, textStatus, errorThrown) {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: e,
									type: 'red',
									backgroundDismiss: true
								});
							}
						});
					}
				},
				no: {
					text: 'Tidak'
				}
			}
		})
	}

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
				var Kariskarsu_ids = $('#Kariskarsu_ids').val();

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
										Kariskarsu_id: Kariskarsu_ids
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
			url: "<?php echo site_url('Kariskarsu/content_item_keluarga'); ?>",
			data: {
				Id: '<?php echo $id_pegawai; ?>',
				Kariskarsu_id: '<?php echo $Kariskarsu_id; ?>'
			},
			type: "POST",
			beforeSend: function() {
				$('#modal_all').modal('hide');
				$('#modal_all .modal-dialog .modal-content .modal-body').html('');
			},
			success: function(data) {
				$('#isi_keluarga').html(data);
				var room = 'ubah_kariskarsu';
				var param_1 = '<?php echo $id_pegawai; ?>';
				var param_2 = '<?php echo $Kariskarsu_id; ?>';

				edit_keluarga(Id_ubah, room, param_1, param_2);
			}
		});
	}

	// tambah keluarga
	function tambah_keluarga() {
		$.ajax({
			url: "<?php echo site_url('Kariskarsu/content_item_keluarga'); ?>",
			data: {
				Id: '<?php echo $id_pegawai; ?>',
				Kariskarsu_id: '<?php echo $Kariskarsu_id; ?>'
			},
			type: "POST",
			beforeSend: function() {
				$('#modal_all').modal('hide');
				$('#modal_all .modal-dialog .modal-content .modal-body').html('');
			},
			success: function(data) {
				$('#isi_keluarga').html(data);
				var room = 'kariskarsu';
				var param_1 = '<?php echo $id_pegawai; ?>';
				var param_2 = '<?php echo $Kariskarsu_id; ?>';

				add_keluarga(room, param_1, param_2);
			}
		});
	}
</script>