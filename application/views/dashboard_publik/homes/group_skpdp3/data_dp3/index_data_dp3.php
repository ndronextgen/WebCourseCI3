<br>
<button class="btn btn-success" onclick="add_data_dp3()"><i class="glyphicon glyphicon-plus"></i> Tambah Riwayat DP3</button>
<button class="btn btn-default" onclick="reload_table_dp3()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
<!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal-download" data-content="skp-all" data-title="Download" title="Download"><i class="fa fa-download"></i> Download All</button> -->
<hr>
<table id="table_dp3" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No.</th>
			<th>Periode</th>
			<th>Pejabat Penilai</th>
			<th>Atasan Pejabat Penilai</th>
			<th>Nilai Rata-rata</th>
			<th>Tgl. Dibuat</th>
			<th width='0px' data-priority='1'>File</th>
			<th width='0px' data-priority='1'>Aksi</th>
		</tr>
	</thead>
</table>

<script type="text/javascript">
	tabledp3 = $('#table_dp3').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		responsive: true,
		"ajax": {
			"url": "<?php echo site_url('Data_dp3/table_data_dp3') ?>",
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

	function add_data_dp3() {
		save_method = 'add';
		$.ajax({
			url: "<?php echo site_url('Data_dp3/form_dp3_add'); ?>",
			data: "act=" + 'Tambah',
			type: "POST",
			success: function(data) {
				$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
			}
		});
		$('.modal-footer').hide(); // show bootstrap modal
		$('#modal_all').modal('show'); // show bootstrap modal
		$('.modal-title').text('Form Tambah Riwayat DP3 - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
	}

	function edit_data_dp3(Id) {
		save_method = 'update';
		$.ajax({
			url: "<?php echo site_url('Data_dp3/form_dp3_update'); ?>",
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
		$('.modal-title').text('Form Update Riwayat DP3 - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
	}

	function view_data_dp3(Id) {
		$.ajax({
			url: "<?php echo site_url('Data_dp3/view_dp3'); ?>",
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
		$('.modal-title').text('View Riwayat DP3 - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
	}

	function simpan_data_dp3() {

		var Periode_awal = $("#Periode_awal").val();
		var Periode_akhir = $("#Periode_akhir").val();
		var Pp = $("#Pp").val();
		var Appn = $("#Appn").val();
		var Kesetiaan = $("#Kesetiaan").val();
		var Prestasi_kerja = $("#Prestasi_kerja").val();
		var Tanggung_jawab = $("#Tanggung_jawab").val();
		var Ketaatan = $("#Ketaatan").val();
		var Kejujuran = $("#Kejujuran").val();
		var Kerja_sama = $("#Kerja_sama").val();
		var Prakarsa = $("#Prakarsa").val();
		var Kepemimpinan = $("#Kepemimpinan").val();
		var Jumlah = $("#Jumlah").val();
		var Nilai_rata_rata = $("#Nilai_rata_rata").val();


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
		} else if (Kesetiaan == '') {
			// alert('Kesetiaan Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Kesetiaan</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Prestasi_kerja == '') {
			// alert('Prestasi kerja Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Prestasi Kerja</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Tanggung_jawab == '') {
			// alert('Tanggung jawab Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Tanggung Jawab</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Ketaatan == '') {
			// alert('Ketaatan Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Ketaatan</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Kejujuran == '') {
			// alert('Kejujuran Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Kejujuran</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Kerja_sama == '') {
			// alert('Kerja sama Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Kerja Sama</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Prakarsa == '') {
			// alert('Prakarsa Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Prakarsa</b> tidak boleh kosong.',
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
		} else if (Jumlah == '') {
			// alert('Jumlah Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Jumlah</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else if (Nilai_rata_rata == '') {
			// alert('Nilai rata-rata Tidak Boleh Kosong');
			$.dialog({
				icon: 'fa fa-info',
				title: 'Info',
				content: '<b style="color: red;">Nilai Rata-Rata</b> tidak boleh kosong.',
				type: 'red',
				backgroundDismiss: true
			});
		} else {
			ajax_simpan_data_dp3();
		}
	}

	function ajax_simpan_data_dp3() {
		var formData = new FormData($('#form_data_dp3')[0]);
		var url;
		if (save_method == 'add') {
			url = "<?php echo site_url('Data_dp3/simpan_add'); ?>";
		} else {
			url = "<?php echo site_url('Data_dp3/simpan_update'); ?>";
		}
		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				$('#modal_all').modal('hide');
				// alert(response);
				const resp = JSON.parse(response);
				
				$.dialog({
					icon: 'fa fa-info',
					title: 'Info',
					content: resp.status,
					type: resp.tipe == 1 ? 'green' : 'red',
					backgroundDismiss: true
				});
				reload_table_dp3();


			}
		});
	}

	function delete_dp3(Id) {
		// var i = "Hapus ?";
		// var b = "Data Dihapus";
		// if (!confirm(i)) return false;
		// $.ajax({
		// 	type: "post",
		// 	data: "Id=" + Id,
		// 	url: "<?php echo site_url('Data_dp3/delete_data_dp3') ?>",
		// 	success: function(s) {
		// 		alert(s);
		// 		reload_table_dp3();
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
							url: '<?php echo site_url("Data_dp3/delete_data_dp3") ?>',
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

								reload_table_dp3();
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