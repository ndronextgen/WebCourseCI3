<style type="text/css">
	.td_head {
		font-weight: bold;
		background-color: #006168;
		color: #fff !important;
		font-size: 12px;
		font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
		text-align: center;
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

<div id='ajax_content'>
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<!-- <div class="page-header">
						<h4># Data KARIS/KARSU</h4>
					</div> -->
					<button class="btn btn-success" onclick="add_kariskarsu()"><i class="glyphicon glyphicon-plus"></i>&nbsp; &nbsp;Tambah Pengajuan Surat</button>
					<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i>&nbsp; &nbsp;Reload</button>
					<hr>
					<div class='table-responsive'>
						<table id="table_kariskasru" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th width='80px' rowspan='2' style="vertical-align: middle;">Aksi</th>
									<th rowspan='2' style="vertical-align: middle;">Nama Pegawai</th>
									<th rowspan='2' style="vertical-align: middle;">Perihal</th>
									<th rowspan='2' style="vertical-align: middle; text-align: center;">Status</th>
									<th colspan='6' style="text-align: center;">File Pendukung</th>
									<th rowspan='2' style="vertical-align: middle;">Tanggal Dibuat</th>
								</tr>
								<tr>
									<th>Surat Nikah</th>
									<th>KK</th>
									<th>KTP Suami</th>
									<th>KTP Istri</th>
									<th>SK CPNS/PNS</th>
									<th>Foto</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
	<!-- </section> -->

	<script type="text/javascript">
		table_kariskasru = $('#table_kariskasru').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			responsive: false,
			"ajax": {
				"url": "<?php echo site_url('Kariskarsu/table_data_kariskarsu') ?>",
				"type": "POST"
			},
			"aoColumns": [{
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
			}],
			"columnDefs": [{
				"targets": [-1],
				"orderable": false,
			}, ],
			fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				if (aData[10] == "0") {
					/*mapping*/
					$("td:eq(0)", nRow).css('font-weight', 'bold');
					$("td:eq(1)", nRow).css('font-weight', 'bold');
					$("td:eq(2)", nRow).css('font-weight', 'bold');
					$("td:eq(9)", nRow).css('font-weight', 'bold');
					$(nRow).css('background-color', '#f7f7cd');
				}
			},

		});

		function reload_table() {
			table_kariskasru.ajax.reload(null, false); //reload datatable ajax 
			notify_kariskarsu();
		}

		function reload_table_item_pilihan() {
			table_data_item_pilih.ajax.reload(null, false); //reload datatable ajax 
		}

		function add_kariskarsu() {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Kariskarsu/add_kariskarsu'); ?>",
				beforeSend: function(f) {
					var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
					$('#ajax_content').html(percentVal);
				},
				success: function(data) {
					$('#ajax_content').html(data);
				}
			});

		}

		function edit_kariskarsu(Kariskarsu_id) {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Kariskarsu/edit_kariskarsu'); ?>",
				data: {
					Kariskarsu_id: Kariskarsu_id
				},
				beforeSend: function(f) {
					var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
					$('#ajax_content').html(percentVal);
				},
				success: function(data) {
					$('#ajax_content').html(data);
				}
			});

		}

		function ajax_simpan_kariskarsu() {

			var File_surat_nikah = $("#File_surat_nikah").val();
			var File_kk = $("#File_kk").val();
			var File_ktp_suami = $("#File_ktp_suami").val();
			var File_ktp_istri = $("#File_ktp_istri").val();
			var File_sk_pns = $("#File_sk_pns").val();
			var File_foto = $("#File_foto").val();

			if (File_surat_nikah == "") {
				// alert("File Surat Nikah Tidak Boleh Kosong!");
				$.dialog({
					icon: 'fa fa-info',
					title: 'Info',
					content: '<b style="color: red;">File Surat Nikah</b> tidak boleh kosong.',
					type: 'red',
					backgroundDismiss: true
				});
			} else if (File_kk == '') {
				// alert("File KK Tidak Boleh Kosong");
				$.dialog({
					icon: 'fa fa-info',
					title: 'Info',
					content: '<b style="color: red;">File KK</b> tidak boleh kosong.',
					type: 'red',
					backgroundDismiss: true
				});
			} else if (File_ktp_suami == '') {
				// alert("File KTP Suami Tidak Boleh Kosong");
				$.dialog({
					icon: 'fa fa-info',
					title: 'Info',
					content: '<b style="color: red;">File KTP Suami</b> tidak boleh kosong.',
					type: 'red',
					backgroundDismiss: true
				});
			} else if (File_ktp_istri == '') {
				// alert("File KTP Istri Tidak Boleh Kosong");
				$.dialog({
					icon: 'fa fa-info',
					title: 'Info',
					content: '<b style="color: red;">File KTP Istri</b> tidak boleh kosong.',
					type: 'red',
					backgroundDismiss: true
				});
			} else if (File_sk_pns == '') {
				// alert("File SK CPNS/PNS Tidak Boleh Kosong");
				$.dialog({
					icon: 'fa fa-info',
					title: 'Info',
					content: '<b style="color: red;">File SK CPNS/PNS</b> tidak boleh kosong.',
					type: 'red',
					backgroundDismiss: true
				});
			} else if (File_foto == '') {
				// alert("File Foto Tidak Boleh Kosong");
				$.dialog({
					icon: 'fa fa-info',
					title: 'Info',
					content: '<b style="color: red;">File Foto</b> tidak boleh kosong.',
					type: 'red',
					backgroundDismiss: true
				});
			} else {
				ajax_simpan();
			}
		}

		function ajax_simpan() {
			var formData = new FormData($('#form_kariskarsu')[0]);

			$.ajax({
				url: "<?php echo site_url('Kariskarsu/simpan_tambah_kariskarsu'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function() {
					$('#btn_tmb').text('Menyimpan...');
					$('#btn_tmb').attr('disabled', true);
				},
				success: function(response) {
					let arrPesan = response.split("|");

					if (arrPesan.length > 1) {
						$.dialog({
							icon: 'fa fa-warning',
							title: 'Data belum lengkap!',
							content: arrPesan[1],
							type: 'red',
							backgroundDismiss: true,
						});

						$('#btn_tmb').text('Simpan');
						$('#btn_tmb').attr('disabled', false);
						return false;
					}

					$.confirm({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Permohonan Karis Karsu berhasil disimpan.',
						type: 'green',
						buttons: {
							ok: {
								text: 'OK',
								btnClass: 'btn-green',
								action: function() {
									location.reload();
								}
							}
						}
					})

					$('#btn_tmb').text('Simpan');
					$('#btn_tmb').attr('disabled', false);
				}
			});
		}

		function ajax_update_kariskarsu() {
			var formData = new FormData($('#form_kariskarsu')[0]);

			$.ajax({
				url: "<?php echo site_url('Kariskarsu/simpan_update_kariskarsu'); ?>",
				type: "post",
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function() {
					$('#btn_tmb').text('Menyimpan...');
					$('#btn_tmb').attr('disabled', true);
				},
				success: function(response) {
					// alert(response);
					// location.reload();

					let arrPesan = response.split("|");

					if (arrPesan.length > 1) {
						$.dialog({
							icon: 'fa fa-warning',
							title: 'Data belum lengkap!',
							content: arrPesan[1],
							type: 'red',
							backgroundDismiss: true,
						});

						$('#btn_tmb').text('Simpan');
						$('#btn_tmb').attr('disabled', false);
						return false;
					}

					$.confirm({
						icon: 'fa fa-info',
						title: 'Info',
						content: 'Permohonan KARIS/KARSU berhasil disimpan.',
						type: 'green',
						buttons: {
							ok: {
								text: 'OK',
								btnClass: 'btn-green',
								action: function() {
									location.reload();
								}
							}
						}
					})

					$('#btn_tmb').text('Simpan');
					$('#btn_tmb').attr('disabled', false);
				}
			});
		}

		function delete_kariskarsu(Kariskarsu_id) {
			let q = 'Hapus data permohonan KARIS/KARSU?';
			let i = 'Data berhasil dihapus.';

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
								type: "post",
								data: "Kariskarsu_id=" + Kariskarsu_id,
								url: "<?php echo site_url('Kariskarsu/delete_kariskarsu') ?>",
								success: function(s) {
									$.dialog({
										icon: 'fa fa-info',
										title: 'Info',
										content: i,
										type: 'green',
										backgroundDismiss: true
									});

									reload_table();
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

		function view_kariskarsu(Kariskarsu_id) {
			$.ajax({
				url: "<?php echo site_url('Kariskarsu/view_kariskarsu'); ?>",
				data: {
					Kariskarsu_id: Kariskarsu_id
				},
				type: "POST",
				success: function(data) {
					$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
					reload_table();
				}
			});
			$('.modal-footer').hide(); // show bootstrap modal
			$('#modal_all').modal('show'); // show bootstrap modal
			$('.modal-title').text('Informasi Surat Permohonan KARIS/KARSU'); // Set Title to Bootstrap modal title
		}

		function batal_form() {
			$('#modal_all').modal('hide');
		}
	</script>
</div>