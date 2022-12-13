<script type="text/javascript">
	var save_method; //for save method string
	var base_url = '<?php echo base_url(); ?>';

	function add_sk() {
		$('#label-photo').text('Upload File');
		$('#frame_sk').remove();
		save_method = 'addsk';
		$('#form_sk')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_sk').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data SK - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title

		$('#file_preview').html('');
	}

	function edit_sk(id_sk) {
		$('#label-photo').text('Upload File');
		$('#frame_sk').remove();
		save_method = 'update';
		$('#form_sk')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('arsip_sk/sk_edit/') ?>/" + id_sk,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_sk"]').val(data.id_arsip_sk);
				$('[name="title_sk"]').val(data.title);
				$('#modal_sk').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data SK - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title
				if (data.file_name) {
					$('#label-photo').text('Upload File');
					// $('#file_sk').before('<iframe id="frame_sk" src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>');

					let path_file = '<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name;

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
				} else {
					$('#label-photo').text('Upload File');
					$('#frame_sk').remove();
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function lihat_file(id) {
		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('arsip_sk/sk_lihat/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#lihat_file').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Lihat Data sk'); // Set title to Bootstrap modal title

				$('#photo-preview').show(); // show photo preview modal
				if (data.file_name) {
					$('#MyModalBody div').html('<iframe src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="550px" height="400px"></iframe>');
				} else {
					$('#MyModalBody div').text('(No File)');
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_sk() {
		tablesk.ajax.reload(null, false); //reload datatable ajax 
	}

	function savesk() {
		$('#btnskSave').text('saving...'); //change button text
		$('#btnskSave').attr('disabled', true); //set button disable 
		var url;
		if (save_method == 'addsk') {
			url = "<?php echo site_url('arsip_sk/sk_add') ?>";
		} else {
			url = "<?php echo site_url('arsip_sk/sk_update') ?>";
		}
		// ajax adding data to database
		var form = $("#form_sk").closest("form");
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
					$('#modal_sk').modal('hide');
					reload_table_sk();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}
				$('#btnskSave').text('save'); //change button text
				$('#btnskSave').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnskSave').text('save'); //change button text
				$('#btnskSave').attr('disabled', false); //set button enable 
			}

		});
	}

	function delete_sk(id_sk) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('arsip_sk/sk_delete') ?>/" + id_sk,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_sk').modal('hide');
		// 			reload_table_sk();
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
							url: '<?php echo site_url("arsip_sk/sk_delete") ?>/' + id_sk,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_sk').modal('hide');
								reload_table_sk();
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
<div class="modal modal-primary fade" id="modal-download-sk" data-backdrop="static">
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
<div class="modal fade" id="modal_sk" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data sk - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
				<div style="font-size: 14px; font-style: italic;" align="left">Lampirkan file SK.</div>
			</div>
			<div class="modal-body form">
				<form action="#" id="form_sk" class="form-horizontal" enctype='multipart/form-data' method="post">
					<input type="hidden" value="" name="id_sk" />
					<div class="form-body">

						<div class="form-group">
							<label class="control-label col-md-3">Nama File</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="title_sk" id="judulsk" placeholder="Input nama file yang di-upload">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3" id="label-photo">Upload File </label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input id="file_sk" name="file_sk" type="file" class="form-control" style="font-size: 12px; width: 310px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnskSave" onclick="savesk()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#modal-download-sk').on('show.bs.modal', function(e) {
			var button = $(e.relatedTarget);
			var id = button.data('id');
			var modal = $(this);
			//e.preventDefault();  //stop the browser from following
			setTimeout(function() {
				window.open("<?= base_url('arsip_sk/download_file/" + id + "') ?>", "_blank");
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