<br>
<button class="btn btn-success" onclick="add_data_skp()"><i class="glyphicon glyphicon-plus"></i> Tambah Riwayat SKP</button>
<button class="btn btn-default" onclick="reload_table_skp()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
<!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="skp-all" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button> -->

<hr>

<table id="table_skp" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>Periode</th>
			<th>Pejabat Penilai</th>
			<th>Atasan Pejabat Penilai</th>
			<th>Nilai Prestasi Kerja</th>
			<th>Tgl. Dibuat</th>
			<th width='0px' data-priority='1'>File</th>
			<th width='0px' data-priority='1'>Aksi</th>
		</tr>
	</thead>
</table>

<script type="text/javascript">
	tableskp = $('#table_skp').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('Data_skp/table_data_skp') ?>",
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
			"sClass": "left"
		}],
	});

	function add_data_skp() {
		save_method = 'add';
		$.ajax({
			url: "<?php echo site_url('Data_skp/form_skp_add'); ?>",
			data: "act=" + 'Tambah',
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Tambah Riwayat SKP - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
	}

	function edit_data_skp(Id) {
		save_method = 'update';
		$.ajax({
			url: "<?php echo site_url('Data_skp/form_skp_update'); ?>",
			data: {
				Id: Id
			},
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Update Riwayat SKP - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
	}

	function view_data_skp(Id) {
		$.ajax({
			url: "<?php echo site_url('Data_skp/view_skp'); ?>",
			data: {
				Id: Id
			},
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('View Riwayat SKP - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
	}

	function simpan_data_skp() {
		var Periode_awal = $("#Periode_awal").val();
		var Periode_akhir = $("#Periode_akhir").val();
		var Pp = $("#Pp").val();
		var Appn = $("#Appn").val();
		var Orientasi_pelayanan = $("#Orientasi_pelayanan").val();
		var Integritas = $("#Integritas").val();
		var Inisiatif_kerja = $("#Inisiatif_kerja").val();
		var Komitmen = $("#Komitmen").val();
		var Disiplin = $("#Disiplin").val();
		var Kerjasama = $("#Kerjasama").val();
		var Kepemimpinan = $("#Kepemimpinan").val();
		var Nilai_prestasi_kerja = $("#Nilai_prestasi_kerja").val();


		var File_upload = $("#File_upload").val();
		var File_upload_lama = $("#File_upload_lama").val();

		if (Periode_awal == '') {
			// alert('Periode awal Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Periode Awal</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Periode_akhir == '') {
			// alert('Periode akhir Penilai Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Periode Akhir</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Pp == '') {
			// alert('Pejabat Penilai Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Pejabat Penilai</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Appn == '') {
			// alert('Atasan Pejabat Penilai Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Atasan Pejabat Penilai</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Orientasi_pelayanan == '') {
			// alert('Orientasi pelayanan Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Orientasi Pelayanan</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Integritas == '') {
			// alert('Integritas Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Integritas</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Inisiatif_kerja == '') {
			// alert('Inisiatif Kerja Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Inisiatif Kerja</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Komitmen == '') {
			// alert('Komitmen Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Komitmen</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Disiplin == '') {
			// alert('Disiplin Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Disiplin</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Kerjasama == '') { 
			// alert('Kerjasama Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Kerja Sama</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Kepemimpinan == '') {
			// alert('Kepemimpinan Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Kepemimpinan</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Nilai_prestasi_kerja == '') {
			// alert('Nilai_prestasi_kerja Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Nilai Prestasi Kerja</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else {
			ajax_simpan_data_skp();
		}
	}

	function ajax_simpan_data_skp() {
		var formData = new FormData($('#form_data_skp')[0]);
		var url;
		if (save_method == 'add') {
			url = "<?php echo site_url('Data_skp/simpan_add'); ?>";
		} else {
			url = "<?php echo site_url('Data_skp/simpan_update'); ?>";
		}
		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				$('#modal_all').modal('hide');
				alert(response);
				reload_table_skp();


				
			}
		});
	}

	function delete_skp(Id) {
		// var i = "Hapus ?";
		// var b = "Data Dihapus";
		// if (!confirm(i)) return false;
		// $.ajax({
		// 	type: "post",
		// 	data: "Id=" + Id,
		// 	url: "<?php echo site_url('Data_skp/delete_data_skp') ?>",
		// 	success: function(s) {
		// 		alert(s);
		// 		reload_table_skp();
		// 	}
		// });



		let q = 'Hapus data?';
		let i = 'Data berhasil dihapus.';
		let e = 'Proses hapus data bermasalah.';

		$.confirm({
			icon: 'fa fa-warning',
			title: 'Konfirmasi',
			content: q,
			type: 'red',
			buttons: {
				yes: {
					text: 'Ya',
					btnClass: 'btn-red',
					action: function() {
						$.ajax({
							url: '<?php echo site_url("Data_skp/delete_data_skp") ?>',
							type: 'post',
							data: "Id=" + Id,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								reload_table_skp();
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
</script>