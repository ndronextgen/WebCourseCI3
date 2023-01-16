<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	function add_tubel() {
		$('#arsipContentTubel').remove();
		$('#arsipContentTubelTitle').remove();
		save_method = 'addtubel';
		$('#form_tubel')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_tubel').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Tugas & Izin Belajar - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
		$('.url').remove();
		$('#file_preview').html('');
	}

	function edit_tubel(id_tubel) {
		$('#arsipContentTubel').remove();
		$('#arsipContentTubelTitle').remove();
		save_method = 'update';
		$('#form_tubel')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('.url').remove();
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('tubel/tubel_edit/') ?>/" + id_tubel,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_tubel"]').val(data.id_tubel);
				$('[name="no_sk"]').val(data.no_sk);
				$('[name="tgl_sk"]').datepicker('update', data.tgl_sk);
				$('[name="tgl_mulai"]').datepicker('update', data.tgl_mulai);
				$('[name="tgl_selesai"]').datepicker('update', data.tgl_selesai);
				$('[name="sekolah"]').val(data.sekolah);
				$('[name="akreditasi"]').val(data.akreditasi);
				$('[name="jurusan"]').val(data.jurusan);
				$('[name="uraian"]').val(data.uraian);
				$('#modal_tubel').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Tugas & Izin Belajar - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title

				//arsip handle
				if (data.arsip != null) {
					genArsipTubel(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipTubel(data) {
		$('#arsipContentTubel').remove();
		$('#arsipContentTubelTitle').remove();
		$('#arsipTubel_title').val(data.title);

		// let html = '<iframe id="arsipContentTubel" src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		// html += '<span id="arsipContentTubelTitle"><br />' + data.title + ' - <a href="<?php echo site_url('tubel/download/'); ?>' + data.id_arsip_sk + '">' + data.file_name_ori + '</a><br /><br />';

		// $('#arsipPangkat_file').before(html);

		// === begin: file preview ===
		let path_file = '<?= site_url() ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name;

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

	function reload_table_tubel() {
		tabletubel.ajax.reload(null, false); //reload datatable ajax 
	}

	function savetubel() {
		$('#btnTubelSave').text('saving...'); //change button text
		$('#btnTubelSave').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		var url;

		if (save_method == 'addtubel') {
			url = "<?php echo site_url('tubel/tubel_add') ?>";
		} else {
			url = "<?php echo site_url('tubel/tubel_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_tubel").closest("form");
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
					$('#modal_tubel').modal('hide');
					reload_table_tubel();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnTubelSave').text('save'); //change button text
				$('#btnTubelSave').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnTubelSave').text('save'); //change button text
				$('#btnTubelSave').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_tubel(id_tubel) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('tubel/tubel_delete') ?>/" + id_tubel,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_tubel').modal('hide');
		// 			reload_table_tubel();
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
							url: '<?php echo site_url("tubel/tubel_delete") ?>/' + id_tubel,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_tubel').modal('hide');
								reload_table_tubel();
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

<!-- <div class="modal fade" id="modal_tubel" role="dialog"> -->
<div class="modal fade" id="modal_tubel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data tubel - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_tubel" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_tubel" />

					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Nama Status</label>
							<div class="col-md-9">
								<select name="uraian" id="uraian" data-placeholder="Nama Status" class="form-control">
									<option value="">-- Pilih Nama Status --</option>
									<option value="Tugas Belajar">Tugas Belajar</option>
									<option value="Izin Belajar">Izin Belajar</option>
								</select>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Nomor SK</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="no_sk" id="no_sk" placeholder="Nomor SK">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal SK</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tgl_sk" id="tgl_sk" placeholder="Tanggal SK">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal Mulai Pendidikan</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tgl_mulai" placeholder="yyyy-mm-dd">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggal Selesai Pendidikan</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tgl_selesai" placeholder="yyyy-mm-dd">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Sekolah</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="sekolah" id="sekolah" placeholder="Sekolah">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Akreditasi</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="akreditasi" id="akreditasi" placeholder="Akreditasi">
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
							<label class="control-label col-md-3">Upload File</label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input type="file" name="arsipTubel_file" id="arsipTubel_file" class="form-control" style="font-size: 12px; width: 332px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnTubelSave" onclick="savetubel()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->