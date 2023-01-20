<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	function add_pelatihan() {
		$('#arsipContentPelatihan').remove();
		$('#arsipContentPelatihanTitle').remove();

		save_method = 'addpelatihan';
		$('#form_pelatihan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_pelatihan').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Pendidikan Non-Formal - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title

		$('#file_preview').html('');
	}

	function edit_pelatihan(id_pelatihan) {
		$('#arsipContentPelatihan').remove();
		$('#arsipContentPelatihanTitle').remove();
		save_method = 'update';
		$('#form_pelatihan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('pelatihan/pelatihan_edit/') ?>/" + id_pelatihan,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_pelatihan"]').val(data.id_pelatihan);
				$('[name="id_master_pelatihan"]').val(data.id_master_pelatihan);
				$('[name="lokasi"]').val(data.lokasi);
				$('[name="no_sertifikat"]').val(data.no_sertifikat);
				$('[name="tanggal_sertifikat"]').datepicker('update', data.tanggal_sertifikat);
				$('[name="uraian"]').val(data.uraian);
				$('#modal_pelatihan').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data pelatihan - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title

				changePelatihan(data.id_master_pelatihan);
				$('[name="nama_pelatihan_lainnya"]').val(data.nama_pelatihan_lainnya);

				//arsip handle
				if (data.arsip != null) {
					genArsipPelatihan(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipPelatihan(data) {
		$('#arsipContentPelatihan').remove();
		$('#arsipContentPelatihanTitle').remove();

		// let html = '<iframe id="arsipContentPelatihan" src="<?php echo base_url(); ?>asset/upload/pelatihan/pelatihan_' + data.id_pelatihan + '_' + data.id_arsip_pelatihan + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		// html += '<span id="arsipContentPelatihanTitle"><br />' + data.title + ' - <a href="<?php echo site_url('pelatihan/download/'); ?>' + data.id_arsip_pelatihan + '">' + data.file_name_ori + '</a><br /><br />';

		// $('#arsipPelatihan_file').before(html);

		// === begin: file preview ===
		let path_file = '<?= site_url() ?>asset/upload/pelatihan/pelatihan_' + data.id_pelatihan + '_' + data.id_arsip_pelatihan + '/' + data.file_name;

		$.get(path_file)
			.done(function() {
				console.log('exist');

				let html = '';
				html = '<table class="table table-bordered table-hover" style="font-size:10px; width: 0px;">';
				html += '<tbody>';
				html += '<tr>';
				html += '<td>';

				let file_ext = data.file_name.split('.').pop();

				if (file_ext.toLowerCase() == 'pdf') {
					html += '<a data-fancybox data-type="iframe" data-src="' + path_file + '" href="javascript:void();">';
					html += '<button type="button" class="btn btn-sm btn-danger" title="' + data.file_name_ori + '"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button>';
				} else {
					html += '<a data-fancybox="images" href="' + path_file + '" target="_blank">';
					html += '<img height="30px" src="' + path_file + '" title="' + data.file_name_ori + '">';
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

	function reload_table_pelatihan() {
		tablepelatihan.ajax.reload(null, false); //reload datatable ajax 
	}

	function savepelatihan() {
		$('#btnSavePelatihan').text('saving...'); //change button text
		$('#btnSavePelatihan').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		var url;

		if (save_method == 'addpelatihan') {
			url = "<?php echo site_url('pelatihan/pelatihan_add') ?>";
		} else {
			url = "<?php echo site_url('pelatihan/pelatihan_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_pelatihan").closest("form");
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
					$('#modal_pelatihan').modal('hide');
					swal.fire({
						icon: 'success',
						title: 'Data berhasil disimpan!',
						showConfirmButton: false,
						timer: 1500
					});
					$('#btn_verifikasi').text('Simpan');
					$('#btn_verifikasi').attr('disabled', false);
					reload_table_pelatihan();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSavePelatihan').text('save'); //change button text
				$('#btnSavePelatihan').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSavePelatihan').text('save'); //change button text
				$('#btnSavePelatihan').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_pelatihan(id_pelatihan) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('pelatihan/pelatihan_delete') ?>/" + id_pelatihan,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_pelatihan').modal('hide');
		// 			reload_table_pelatihan();
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
							url: '<?php echo site_url("pelatihan/pelatihan_delete") ?>/' + id_pelatihan,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_pelatihan').modal('hide');
								reload_table_pelatihan();
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

	function changePelatihan(id) {
		$('#divLainnya').remove();

		if (id == 394) {
			//lainnya
			let html = '<div class="form-group" id="divLainnya">';
			html += '<label class="control-label col-md-3">Nama Pelatihan Lainnya</label>';
			html += '<div class="col-md-9">';
			html += '<textarea class="form-control textarea" name="nama_pelatihan_lainnya" id="nama_pelatihan_lainnya" placeholder="Nama Pelatihan Lainnya"></textarea>';
			html += '<span class="help-block"></span>';
			html += '</div>';
			html += '</div>';

			$('#divMasterPelatihan').after(html);
		}
	}
</script>

<!-- <div class="modal fade" id="modal_pelatihan" role="dialog"> -->
<div class="modal fade" id="modal_pelatihan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Pelatihan - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_pelatihan" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_pelatihan" />

					<div class="form-body">
						<div class="form-group" id="divMasterPelatihan">
							<label class="control-label col-md-3">Nama Pelatihan</label>
							<div class="col-md-9">
								<select name="id_master_pelatihan" id="id_master_pelatihan" class="form-control" onchange="changePelatihan(this.value);">
									<option value="">-- Pilih Nama Pelatihan --</option>
									<?php
									foreach ($mst_pelatihan->result_array() as $mp) {
										?>
										<option value="<?php echo $mp['id_master_pelatihan']; ?>"><?php echo $mp['nama_pelatihan']; ?></option>
									<?php
									}
									?>
								</select>

								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Lokasi</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Nomor Sertifikat</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat" placeholder="Nomor Sertifikat">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal Sertrifikat</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tanggal_sertifikat" id="tanggal_sertifikat" placeholder="Tanggal Sertifikat">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Keterangan</label>
							<div class="col-md-9">
								<textarea class="form-control textarea" name="uraian" id="uraian" placeholder="Keterangan Pelatihan lain"></textarea>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Upload File</label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input type="file" name="arsipPelatihan_file" id="arsipPelatihan_file" class="form-control" style="font-size: 12px; width: 332px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnPelatihanSave" onclick="savepelatihan()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->