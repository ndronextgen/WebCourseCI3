<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	function add_pangkat() {
		$('#arsipContentPangkat').remove();
		$('#arsipContentPangkatTitle').remove();

		save_method = 'add';
		$('#form_pangkat')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_pangkat').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Riwayat Pangkat - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title

		$('.url').remove();
		$('#file_preview').html('');
	}

	function edit_pangkat(id_riwayat_pangkat) {
		$('#arsipContentPangkat').remove();
		$('#arsipContentPangkatTitle').remove();
		save_method = 'update';
		$('#form_pangkat')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('.url').remove();
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('pangkat/pangkat_edit/') ?>/" + id_riwayat_pangkat,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_riwayat_pangkat"]').val(data.id_riwayat_pangkat);
				$('[name="id_golongan"]').val(data.id_golongan);
				$('[name="lokasi_kerja"]').val(data.lokasi_kerja);
				$('[name="nomor_sk"]').val(data.nomor_sk);
				$('[name="tanggal_sk"]').datepicker('update', data.tanggal_sk);
				$('[name="tanggal_mulai"]').datepicker('update', data.tanggal_mulai);
				$('#modal_pangkat').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Riwayat Pangkat - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title

				//arsip handle
				if (data.arsip != null) {
					genArsipPangkat(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipPangkat(data) {
		$('#arsipContentPangkat').remove();
		$('#arsipContentPangkatTitle').remove();
		$('#arsipPangkat_title').val(data.title);

		// === begin: file preview ===
		let path_file = '<?= site_url("asset/upload/SK/SK_") ?>' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name;

		$.get(path_file)
			.done(function() {
				console.log('exist');

				let html = '';
				html = '<table class="table table-bordered table-hover" style="font-size:10px; width: 10px;">';
				html += '<tbody>';
				html += '<tr>';
				html += '<td>';

				let file_ext = data.file_name.split('.').pop();

				if (file_ext.toLowerCase() == 'pdf') {
					html += '<a data-fancybox data-type="iframe" data-src="' + path_file + '" href="javascript:void();">';
					html += '<button type="button" class="btn btn-sm btn-danger" title="' + data.file_name_ori + '"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>';
				} else {
					html += '<a data-fancybox="images" href="' + path_file + '" target="_blank">';
					html += '<img height="30px" width="30px" src="' + path_file + '" title="' + data.file_name_ori + '">';
				}
				html += '</a>';
				html += '</td>';
				html += '</tr>';
				html += '</tbody>';
				html += '</table>';

				$('#file_preview').html(html);

			}).fail(function() {
				console.log('not exist');
			})
		// === end: file preview ===
	}

	function reload_table_pangkat() {
		tablepangkat.ajax.reload(null, false); //reload datatable ajax 
	}

	function savepangkat() {
		$('#btnSavePangkat').text('saving...'); //change button text
		$('#btnSavePangkat').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		var url;

		if (save_method == 'add') {
			url = "<?php echo site_url('pangkat/pangkat_add') ?>";
		} else {
			url = "<?php echo site_url('pangkat/pangkat_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_pangkat").closest("form");
		var data = new FormData(form[0]);

		// ajax adding data to database
		$.ajax({
			url: url,
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "JSON",
			success: function(data) {

				if (data.status) //if success close modal and reload ajax table
				{
					$('#modal_pangkat').modal('hide');
					reload_table_pangkat();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSavePangkat').text('save'); //change button text
				$('#btnSavePangkat').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSavePangkat').text('save'); //change button text
				$('#btnSavePangkat').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_pangkat(id_riwayat_pangkat) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('pangkat/pangkat_delete') ?>/" + id_riwayat_pangkat,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_pangkat').modal('hide');
		// 			reload_table_pangkat();
		// 		},
		// 		error: function(jqXHR, textStatus, errorThrown) {
		// 			alert('Proses delete data error');
		// 		}
		// 	});
		// }



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
							url: '<?php echo site_url("pangkat/pangkat_delete") ?>/' + id_riwayat_pangkat,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_pangkat').modal('hide');
								reload_table_pangkat();
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

<!-- <div class="modal fade" id="modal_pangkat" role="dialog"> -->
<div class="modal fade" id="modal_pangkat" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Riwayat Pangkat - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_pangkat" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_riwayat_pangkat" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Golongan</label>
							<div class="col-md-9">
								<select name="id_golongan" class="form-control">
									<option value="">-- Pilih Nama Golongan --</option>
									<?php
									foreach ($mst_golongan->result_array() as $mg) {
										if ($id_golongan == $mg['id_golongan']) {
											?>
											<option value="<?php echo $mg['id_golongan']; ?>" selected="selected"><?php echo $mg['golongan']; ?></option>
										<?php
											} else {
												?>
											<option value="<?php echo $mg['id_golongan']; ?>"><?php echo $mg['golongan']; ?></option>
									<?php
										}
									}
									?>
								</select>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Lokasi Kerja</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="lokasi_kerja" id="lokasi_kerja" placeholder="Lokasi Kerja">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Nomor SK</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nomor_sk" id="nomor_sk" placeholder="Nomor SK">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal SK</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tanggal_sk" id="tanggal_sk" placeholder="Tanggal SK">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">TMT</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tanggal_mulai" id="tanggal_mulai" placeholder="Tanggal Mulai">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Upload File</label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input type="file" name="arsipPangkat_file" id="arsipPangkat_file" class="form-control" style="font-size: 12px; width: 310px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnPangkatSave" onclick="savepangkat()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->