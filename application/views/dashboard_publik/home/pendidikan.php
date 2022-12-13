<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	function add_pendidikan() {
		$('#arsipContentPendidikan').remove();
		$('#arsipContentPendidikanTitle').remove();
		save_method = 'addpendidikan';
		$('#form_pendidikan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_pendidikan').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Pendidikan Formal - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title

		$('#file_preview').html('');
	}

	function edit_pendidikan(id_pendidikan) {
		$('#arsipContentPendidikan').remove();
		$('#arsipContentPendidikanTitle').remove();
		save_method = 'update';
		$('#form_pendidikan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('pendidikan/pendidikan_edit/') ?>/" + id_pendidikan,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_pendidikan"]').val(data.id_pendidikan);
				$('[name="id_master_pendidikan"]').val(data.id_master_pendidikan);
				$('[name="jurusan"]').val(data.jurusan);
				$('[name="tempat_sekolah"]').val(data.tempat_sekolah);
				$('[name="kota"]').val(data.kota);
				$('[name="nomor_sttb"]').val(data.nomor_sttb);
				$('[name="tanggal_lulus"]').datepicker('update', data.tanggal_lulus);
				$('#modal_pendidikan').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Pendidikan - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title

				//arsip handle
				if (data.arsip != null) {
					genArsipPendidikan(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipPendidikan(data) {
		$('#arsipContentPendidikan').remove();
		$('#arsipContentPendidikanTitle').remove();

		// let html = '<iframe id="arsipContentPendidikan" src="<?php echo base_url(); ?>asset/upload/pendidikan/pendidikan_' + data.id_tipe_pendidikan + '_' + data.id_pendidikan + '_' + data.id_arsip_pendidikan + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		// html += '<span id="arsipContentPendidikanTitle"><br />' + data.title + ' - <a href="<?php echo site_url('jabatan/download/'); ?>' + data.id_arsip_pendidikan + '">' + data.file_name_ori + '</a><br /><br />';

		// $('#arsipPendidikan_file').before(html);

		let path_file = '<?php echo base_url(); ?>asset/upload/pendidikan/pendidikan_' + data.id_tipe_pendidikan + '_' + data.id_pendidikan + '_' + data.id_arsip_pendidikan + '/' + data.file_name;

		$.get(path_file)
			.done(function() {
				// console.log('exist');

				// === begin: file preview ===
				let file_ext = data.file_name.split('.').pop();
				let html = '';

				html = '<table class="table table-bordered table-hover" style="font-size:10px; width: 0px;">';
				html += '<tbody>';
				html += '<tr>';
				html += '<td>';
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
				// === end: file preview ===

			}).fail(function() {
				// console.log('not exist');
				$('#file_preview').html('');
			})
	}

	function reload_table_pendidikan() {
		tablependidikan.ajax.reload(null, false); //reload datatable ajax 
	}

	function savependidikan() {
		$('#btnSavePendidikan').text('saving...'); //change button text
		$('#btnSavePendidikan').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		var url;

		if (save_method == 'addpendidikan') {
			url = "<?php echo site_url('pendidikan/pendidikan_add') ?>";
		} else {
			url = "<?php echo site_url('pendidikan/pendidikan_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_pendidikan").closest("form");
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
					$('#modal_pendidikan').modal('hide');
					reload_table_pendidikan();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSavePendidikan').text('save'); //change button text
				$('#btnSavePendidikan').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSavePendidikan').text('save'); //change button text
				$('#btnSavePendidikan').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_pendidikan(id_pendidikan) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('pendidikan/pendidikan_delete') ?>/" + id_pendidikan,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_pendidikan').modal('hide');
		// 			reload_table_pendidikan();
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
							url: '<?php echo site_url("pendidikan/pendidikan_delete") ?>/' + id_pendidikan,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_pendidikan').modal('hide');
								reload_table_pendidikan();
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

<!-- <div class="modal fade" id="modal_pendidikan" role="dialog"> -->
<div class="modal fade" id="modal_pendidikan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Pendidikan - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_pendidikan" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_pendidikan" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Tingkat Pendidikan</label>
							<div class="col-md-9">
								<select name="id_master_pendidikan" class="form-control">
									<option value="">-- Pilih Tingkat Pendidikan --</option>
									<?php
									foreach ($mst_pendidikan->result_array() as $mp) {
										?>
										<option value="<?php echo $mp['id_master_pendidikan']; ?>"><?php echo $mp['nama_pendidikan']; ?></option>
									<?php
									}
									?>
								</select>

								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Jurusan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tempat Pendidikan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="tempat_sekolah" id="tempat_sekolah" placeholder="Tempat Pendidikan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Kota</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="kota" id="kota" placeholder="Kota">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Nomor Ijazah</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nomor_sttb" id="nomor_sttb" placeholder="Nomor Ijazah">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal Lulus</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tanggal_lulus" id="tanggal_lulus" placeholder="Tanggal Lulus">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Upload File</label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input type="file" name="arsipPendidikan_file" id="arsipPendidikan_file" class="form-control" style="font-size: 12px; width: 310px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnPendidikanSave" onclick="savependidikan()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->