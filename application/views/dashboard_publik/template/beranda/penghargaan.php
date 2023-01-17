<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	function add_penghargaan() {
		$('#arsipContentPenghargaan').remove();
		$('#arsipContentPenghargaanTitle').remove();
		save_method = 'addpenghargaan';
		$('#form_penghargaan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_penghargaan').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Penghargaan - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title

		$('#file_preview').html('');
	}

	function edit_penghargaan(id_penghargaan) {
		$('#arsipContentPenghargaan').remove();
		$('#arsipContentPenghargaanTitle').remove();
		save_method = 'update';
		$('#form_penghargaan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('penghargaan/penghargaan_edit/') ?>/" + id_penghargaan,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_penghargaan"]').val(data.id_penghargaan);
				$('[name="id_master_penghargaan"]').val(data.id_master_penghargaan);
				$('[name="pemberi_penghargaan"]').val(data.pemberi_penghargaan);
				$('[name="nomor_sk"]').val(data.nomor_sk);
				$('[name="tgl_sk_penghargaan"]').datepicker('update', data.tgl_sk_penghargaan);
				$('#modal_penghargaan').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Penghargaan - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title

				changePenghargaan(data.id_master_penghargaan);
				$('[name="nama_penghargaan_lainnya"]').val(data.nama_penghargaan_lainnya);

				//arsip handle
				if (data.arsip != null) {
					genArsipPenghargaan(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipPenghargaan(data) {
		$('#arsipContentPenghargaan').remove();
		$('#arsipContentPenghargaanTitle').remove();

		// let html = '<iframe id="arsipContentPenghargaan" src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		// html += '<span id="arsipContentPenghargaanTitle"><br />' + data.title + ' - <a href="<?php echo site_url('penghargaan/download/'); ?>' + data.id_arsip_sk + '">' + data.file_name_ori + '</a><br /><br />';

		// $('#arsipPenghargaan_file').before(html);

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

	function reload_table_penghargaan() {
		tablepenghargaan.ajax.reload(null, false); //reload datatable ajax 
	}

	function savepenghargaan() {
		$('#btnSavePenghargaan').text('saving...'); //change button text
		$('#btnSavePenghargaan').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		var url;

		if (save_method == 'addpenghargaan') {
			url = "<?php echo site_url('penghargaan/penghargaan_add') ?>";
		} else {
			url = "<?php echo site_url('penghargaan/penghargaan_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_penghargaan").closest("form");
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
					$('#modal_penghargaan').modal('hide');
					reload_table_penghargaan();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSavePenghargaan').text('save'); //change button text
				$('#btnSavePenghargaan').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSavePenghargaan').text('save'); //change button text
				$('#btnSavePenghargaan').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_penghargaan(id_penghargaan) {
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
							url: '<?php echo site_url("penghargaan/penghargaan_delete") ?>/' + id_penghargaan,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_penghargaan').modal('hide');
								reload_table_penghargaan();
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

	function changePenghargaan(id) {
		$('#divLainnya').remove();

		if (id == 112) {
			//lainnya
			let html = '<div class="form-group" id="divLainnya">';
			html += '<label class="control-label col-md-3">Nama Penghargaan Lainnya</label>';
			html += '<div class="col-md-9">';
			html += '<textarea class="form-control textarea" name="nama_penghargaan_lainnya" id="nama_penghargaan_lainnya" placeholder="Nama Pelatihan Lainnya"></textarea>';
			html += '<span class="help-block"></span>';
			html += '</div>';
			html += '</div>';

			$('#divMasterPenghargaan').after(html);
		}
	}
</script>

<!-- <div class="modal fade" id="modal_penghargaan" role="dialog"> -->
<div class="modal fade" id="modal_penghargaan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data penghargaan - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_penghargaan" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_penghargaan" />
					<div class="form-body">
						<div class="form-group" id="divMasterPenghargaan">
							<label class="control-label col-md-3">Nama Penghargaan</label>
							<div class="col-md-9">
								<select name="id_master_penghargaan" class="form-control" onchange="changePenghargaan(this.value);">
									<option value="">-- Pilih Nama penghargaan --</option>
									<?php
									foreach ($mst_penghargaan->result_array() as $mp) {
										?>
										<option value="<?php echo $mp['id_master_penghargaan']; ?>"><?php echo $mp['nama_penghargaan']; ?></option>
									<?php
									}
									?>
								</select>

								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Pemberi Penghargaan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="pemberi_penghargaan" id="pemberi_penghargaan" placeholder="Pemberi Penghargaan">
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
								<input type="text" class="form-control datepicker" name="tgl_sk_penghargaan" id="tgl_sk_penghargaan" placeholder="Tanggal SK">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Upload File</label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input type="file" name="arsipPenghargaan_file" id="arsipPenghargaan_file" class="form-control" style="font-size: 12px; width: 332px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnPenghargaanSave" onclick="savepenghargaan()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->