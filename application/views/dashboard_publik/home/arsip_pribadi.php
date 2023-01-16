<script type="text/javascript">
	var save_method; //for save method string
	var base_url = '<?php echo base_url(); ?>';

	function add_pribadi() {
		$('#label-photo').text('Upload File');
		$('#frame_pribadi').remove();
		save_method = 'addpribadi';
		$('#form_pribadi')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_pribadi').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Pribadi - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title

		$('#file_preview').html('');
	}

	function edit_pribadi(id) {
		$('#label-photo').text('Upload File');
		$('#frame_pribadi').remove();
		save_method = 'update';
		$('#form_pribadi')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('arsip_pribadi/pribadi_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_pribadi"]').val(data.id_arsip_pribadi);
				$('[name="title_pribadi"]').val(data.title);
				$('#modal_pribadi').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Pribadi - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title
				if (data.file_name) {
					$('#label-photo').text('Upload File');
					// $('#file_pribadi').before('<iframe id="frame_pribadi" src="<?php echo base_url(); ?>asset/upload/pribadi/pribadi_' + data.id_data_keluarga + '_' + data.id_arsip_pribadi + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>');

					// === begin: file preview ===
					let file_ext = data.file_name.split('.').pop();
					let path_file = '<?php echo base_url(); ?>asset/upload/pribadi/pribadi_' + data.id_data_keluarga + '_' + data.id_arsip_pribadi + '/' + data.file_name;

					$.get(path_file)
						.done(function() {
							// console.log('exist');

							let html = '';
							html = '<table class="table table-bordered table-hover" style="font-size:10px; width: 10px;">';
							html += '<tbody>';
							html += '<tr>';
							html += '<td>';
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
							// console.log('not exist');
						})
					// === end: file preview ===
				} else {
					$('#label-photo').text('Upload File');
					$('#frame_pribadi').remove();
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function lihat_file_pribadi(id) {
		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('arsip_pribadi/pribadi_lihat/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#lihat_file').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Lihat Data Pribadi'); // Set title to Bootstrap modal title

				$('#photo-preview').show(); // show photo preview modal
				if (data.file_name) {
					if (data.id_data_keluarga == null) {
						data.id_data_keluarga = 0;
					}

					$('#MyModalBody div').html('<iframe src="<?php echo base_url(); ?>asset/upload/pribadi/pribadi_' + data.id_data_keluarga + '_' + data.id_arsip_pribadi + '/' + data.file_name + '" frameborder="no" width="550px" height="400px"></iframe>');
				} else {
					$('#MyModalBody div').text('(No File)');
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_pribadi() {
		tablepribadi.ajax.reload(null, false); //reload datatable ajax 
	}

	function savepribadi() {
		$('#btnpribadiSave').text('saving...'); //change button text
		$('#btnpribadiSave').attr('disabled', true); //set button disable 
		var url;
		if (save_method == 'addpribadi') {
			url = "<?php echo site_url('arsip_pribadi/pribadi_add') ?>";
		} else {
			url = "<?php echo site_url('arsip_pribadi/pribadi_update') ?>";
		}
		// ajax adding data to database
		var form = $("#form_pribadi").closest("form");
		var frmData = new FormData(form[0]);

		$.ajax({
			url: url,
			type: "POST",
			data: frmData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data) {
				if (data.status) //if success close modal and reload ajax table
				{
					$('#btnpribadiSave').text('save'); //change button text
					$('#btnpribadiSave').attr('disabled', false); //set button enable 
					$('#modal_pribadi').modal('hide');
					reload_table_pribadi();
					set_notif_to_admin('1668732896');
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
					$('#btnpribadiSave').text('save'); //change button text
					$('#btnpribadiSave').attr('disabled', false); //set button enable 
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnpribadiSave').text('save'); //change button text
				$('#btnpribadiSave').attr('disabled', false); //set button enable 
			}

		});
	}

	function delete_pribadi(id) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('arsip_pribadi/pribadi_delete') ?>/" + id,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_pribadi').modal('hide');
		// 			reload_table_pribadi();
		// 			set_notif_to_admin('1668732896');
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
							url: '<?php echo site_url("arsip_pribadi/pribadi_delete") ?>/' + id,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_pribadi').modal('hide');
								reload_table_pribadi();
								set_notif_to_admin('1668732896');
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

<!-- Bootstrap modal -->
<div class="modal fade" id="lihat_file" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" align="center">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="form-group" id="MyModalBody">
					<div class="col-md-9">
						(No File)
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Modal Download Koran -->
<div class="modal modal-primary fade" id="modal-download-pribadi" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="icon ion-ios-paper"></i> Download File </h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<p>Men-download File &nbsp;<i class="fa fa-refresh fa-spin"></i></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Download Koran -->

<!-- <div class="modal fade" id="modal_pribadi" role="dialog"> -->
<div class="modal fade" id="modal_pribadi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data sk - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
				<div style="font-size: 14px; font-style: italic;" align="left">Lampirkan file SIM/NPWP/BPJS atau lainnya.</div>
			</div>
			<div class="modal-body form">
				<form action="#" id="form_pribadi" class="form-horizontal" enctype='multipart/form-data' method="post">
					<input type="hidden" value="" name="id_pribadi" />
					<div class="form-body">

						<div class="form-group">
							<label class="control-label col-md-3">Nama File</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="title_pribadi" id="title_pribadi" placeholder="Input nama file yang di-upload.">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3" id="label-photo">Masukkan Lampiran Pribadi </label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input id="file_pribadi" name="file_pribadi" type="file" class="form-control" style="font-size: 12px; width: 332px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnpribadiSave" onclick="savepribadi()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#modal-download-pribadi').on('show.bs.modal', function(e) {
			var button = $(e.relatedTarget);
			var id = button.data('id');
			var modal = $(this);
			//e.preventDefault();  //stop the browser from following
			setTimeout(function() {
				window.location.href = "<?= base_url('arsip_pribadi/download/') ?>" + id;
			}, 2500);
			setTimeout(function() {
				modal.modal('hide');
			}, 2500);
			setTimeout(function() {
				tablesk.ajax.reload(null, false);
			}, 2500);
		});
	});
</script>