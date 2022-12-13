<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	function add_hukuman() {
		$('#arsipContentHukuman').remove();
		$('#arsipContentHukumanTitle').remove();
		save_method = 'addHukuman';
		$('#form_hukuman')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_hukuman').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Hukuman - <?php echo $this->session->userdata("nama_pegawai"); ?>'); // Set Title to Bootstrap modal title
	}

	function edit_hukuman(id_hukuman) {
		$('#arsipContentHukuman').remove();
		$('#arsipContentHukumanTitle').remove();
		save_method = 'update';
		$('#form_hukuman')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('hukuman/hukuman_edit/') ?>/" + id_hukuman,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_hukuman"]').val(data.id_hukuman);
				$('[name="id_master_hukuman"]').val(data.id_master_hukuman);
				$('[name="uraian"]').val(data.uraian);
				$('[name="nomor_sk"]').val(data.nomor_sk);
				$('[name="tanggal_sk"]').val(data.tanggal_sk);
				$('[name="tanggal_mulai"]').val(data.tanggal_mulai);
				$('[name="tanggal_selesai"]').val(data.tanggal_selesai);
				$('[name="masa_berlaku"]').val(data.masa_berlaku);
				$('[name="pejabat_menetapkan"]').val(data.pejabat_menetapkan);
				$('#modal_hukuman').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data hukuman'); // Set title to Bootstrap modal title

				//arsip handle
				if (data.arsip != null) {
					genArsipHukuman(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipHukuman(data) {
		$('#arsipContentHukuman').remove();
		$('#arsipContentHukumanTitle').remove();

		let html = '<iframe id="arsipContentHukuman" src="<?php echo base_url(); ?>asset/upload/Hukuman/Hukuman_' + data.id_hukuman + '_' + data.id_arsip_hukuman + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		html += '<span id="arsipContentHukumanTitle"><br />' + data.title + ' - <a href="<?php echo site_url('hukuman/download/'); ?>' + data.id_arsip_hukuman + '">' + data.file_name_ori + '</a><br /><br />';

		$('#arsipHukuman_file').before(html);
	}

	function reload_table_hukuman() {
		tableHukuman.ajax.reload(null, false); //reload datatable ajax 
	}

	function saveHukuman() {
		$('#btnSaveHukuman').text('saving...'); //change button text
		$('#btnSaveHukuman').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		var url;

		if (save_method == 'addHukuman') {
			url = "<?php echo site_url('hukuman/hukuman_add') ?>";
		} else {
			url = "<?php echo site_url('hukuman/hukuman_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_hukuman").closest("form");
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
					$('#modal_hukuman').modal('hide');
					reload_table_hukuman();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSaveHukuman').text('save'); //change button text
				$('#btnSaveHukuman').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSaveHukuman').text('save'); //change button text
				$('#btnSaveHukuman').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_hukuman(id_hukuman) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('hukuman/hukuman_delete') ?>/" + id_hukuman,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_hukuman').modal('hide');
		// 			reload_table_hukuman();
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
							url: '<?php echo site_url("hukuman/hukuman_delete") ?>/' + id_hukuman,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_hukuman').modal('hide');
								reload_table_hukuman();
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

<!-- <div class="modal fade" id="modal_hukuman" role="dialog"> -->
<div class="modal fade" id="modal_hukuman" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Tambah Data Hukuman - <?php echo $this->session->userdata("nama_pegawai"); ?></h3>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_hukuman" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_hukuman" />

					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Jenis Hukuman</label>
							<div class="col-md-9">
								<select name="id_master_hukuman" id="id_master_hukuman" class="form-control" onchange="changeHukuman(this.value);">
									<option value="">-- Pilih Jenis Hukuman --</option>
									<?php
									foreach ($mst_hukuman->result_array() as $mp) {
										?>
										<option value="<?php echo $mp['id_hukuman']; ?>"><?php echo $mp['nama_hukuman']; ?></option>
									<?php
									}
									?>
								</select>

								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Uraian</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="uraian" id="uraian">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Nomor SK</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nomor_sk" id="nomor_sk">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal SK</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="tanggal_sk" id="tanggal_sk">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal Mulai</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal Selesai</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="tanggal_selesai" id="tanggal_selesai">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Masa Berlaku</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="masa_berlaku" id="masa_berlaku">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Pejabat Menetapkan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="pejabat_menetapkan" id="pejabat_menetapkan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Upload Dokumen</label>
							<div class="col-md-9">
								<input type="file" name="arsipHukuman_file" id="arsipHukuman_file" class="form-control" />
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnHukumanSave" onclick="saveHukuman()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->