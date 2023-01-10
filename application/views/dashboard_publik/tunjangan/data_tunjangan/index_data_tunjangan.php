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
							<h4># Data tunjangan Anda</h4>
						</div> -->
						<button class="btn btn-success" onclick="add_tunjangan()"><i class="glyphicon glyphicon-plus"></i>&nbsp; &nbsp;Tambah Pengajuan Surat</button>
						<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i>&nbsp; &nbsp;Reload</button>
						<hr>
						<div class='table-responsive'>
							<table id="table_tunjangan" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width='1px'>Aksi</th>
										<th>Peraturan</th>
										<th width='180px' style="text-align: center;">Status</th>
										<th>Tanggal Dibuat</th>
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
			table_tunjangan = $('#table_tunjangan').DataTable({
				"processing": true,
				"serverSide": true,
				"order": [],
				responsive: true,
				"ajax": {
					"url": "<?php echo site_url('Tunjangan/table_data_tunjangan') ?>",
					"type": "POST"
				},
				"aoColumns": [{
					"sClass": "left"
				}, {
					"sClass": "left"
				}, {
					"sClass": "center"
				}, {
					"sClass": "left"
				}],
				"columnDefs": [{
					"targets": [-1],
					"orderable": false,
				}, ],
				fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					if (aData[4] == "0") {
						/*mapping*/
						$("td:eq(0)", nRow).css('font-weight', 'bold');
						$("td:eq(1)", nRow).css('font-weight', 'bold');
						$("td:eq(2)", nRow).css('font-weight', 'bold');
						$("td:eq(3)", nRow).css('font-weight', 'bold');
						$(nRow).css('background-color', '#f7f7cd');
					}
				},

			});

			function reload_table() {
				table_tunjangan.ajax.reload(null, false); //reload datatable ajax 
				notify_tj();
			}
			function batal_form() {
				$('#modal_all').modal('hide');
			}

			function reload_table_item_pilihan() {
				table_data_item_pilih.ajax.reload(null, false); //reload datatable ajax 
			}

			function add_tunjangan() {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('Tunjangan/add_tunjangan'); ?>",
					beforeSend: function(f) {
						var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
						$('#ajax_content').html(percentVal);
					},
					success: function(data) {
						$('#ajax_content').html(data);
					}
				});

			}

			function edit_tunjangan(Tunjangan_id) {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('Tunjangan/edit_tunjangan'); ?>",
					data: {
						Tunjangan_id: Tunjangan_id
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

			function ajax_simpan_tunjangan() {
				var formData = new FormData($('#form_tunjangan')[0]);

				$.ajax({
					url: "<?php echo site_url('Tunjangan/simpan_tambah_tunjangan'); ?>",
					type: "post",
					data: formData,
					processData: false,
					contentType: false,
					beforeSend: function() {
						$('#btn_tmb').text('Menyimpan...');
						$('#btn_tmb').prop('disabled', true);
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
							content: 'Permohonan tunjangan keluarga berhasil disimpan.',
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

			function ajax_update_tunjangan() {
				var formData = new FormData($('#form_tunjangan')[0]);

				$.ajax({
					url: "<?php echo site_url('Tunjangan/simpan_update_tunjangan'); ?>",
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
							content: 'Permohonan tunjangan keluarga berhasil disimpan.',
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

			function delete_tunjangan(Tunjangan_id) {
				let q = 'Hapus data permohonan tunjangan keluarga?';
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
									data: "Tunjangan_id=" + Tunjangan_id,
									url: "<?php echo site_url('Tunjangan/delete_tunjangan') ?>",
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

			function view_tunjangan(Tunjangan_id) {
				$.ajax({
					url: "<?php echo site_url('Tunjangan/view_tunjangan'); ?>",
					data: {
						Tunjangan_id: Tunjangan_id
					},
					type: "POST",
					success: function(data) {
						$('#modal_all .modal-dialog .modal-content .modal-body').html(data);
						reload_table();
					}
				});
				$('.modal-footer').hide(); // show bootstrap modal
				$('#modal_all').modal('show'); // show bootstrap modal
				$('.modal-title').text('Informasi Surat Permohonan Tunjangan Keluarga'); // Set Title to Bootstrap modal title
			}
			
		</script>
	</div>