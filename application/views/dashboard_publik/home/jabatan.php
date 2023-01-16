<script type="text/javascript">
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	$(document).ready(function() {
		$('#id_riwayat_status_jabatan').change(function() {
			var id_riwayat_status_jabatan = $('#id_riwayat_status_jabatan').val();

			if (parseInt(id_riwayat_status_jabatan) == 10) {
				$('#id_r_jabatan').next(".select2-container").hide();
				$('#status_jabatan').show();
				$('#nama_jabatan').show();
			} else {
				$('#id_r_jabatan').next(".select2-container").show();
				$('#status_jabatan').hide();
				$('#nama_jabatan').hide();

				$.ajax({
					url: "<?php echo base_url(); ?>jabatan/nama_jabatan",
					method: "POST",
					data: {
						id_riwayat_status_jabatan: id_riwayat_status_jabatan
					},
					success: function(data) {
						$('#id_r_jabatan').html(data);
						$('#id_r_jabatan').select2('refresh');
					}
				});
			}
		});
	});

	function add_jabatan() {
		$('#arsipContentJabatan').remove();
		$('#arsipContentJabatanTitle').remove();

		save_method = 'addjabatan';
		$('#form_jabatan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_jabatan').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data Riwayat Jabatan - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set Title to Bootstrap modal title
		$('.url').remove();

		$('#file_preview').html('');
	}

	function edit_jabatan(id_riwayat_jabatan) {
		$('#arsipContentJabatan').remove();
		$('#arsipContentJabatanTitle').remove();
		save_method = 'update';
		$('#form_jabatan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('.url').remove();
		$('#file_preview').html('');

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('jabatan/jabatan_edit/') ?>/" + id_riwayat_jabatan,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				//console.log(data);
				$('[name="id_riwayat_jabatan"]').val(data.id_riwayat_jabatan);
				$('[name="id_riwayat_status_jabatan"]').val(data.id_riwayat_status_jabatan);
				$('[name="id_r_jabatan"]').val(data.id_r_jabatan);

				if (parseInt(data.id_riwayat_status_jabatan) == 10) {
					$('[name="status_jabatan"]').val(data.status_jabatan);
					$('[name="nama_jabatan"]').val(data.nama_jabatan);
					$('#id_r_jabatan').next(".select2-container").hide();
					$('#nama_jabatan').show();
					$('#status_jabatan').show();
				} else {
					if (data.id_r_jabatan == 999) {
						$('[name="nama_jabatan"]').val(data.nama_jabatan);
						$('#id_r_jabatan').next(".select2-container").show();
						$('#nama_jabatan').show();
						$('#status_jabatan').hide();
					} else {
						$('#id_r_jabatan').next(".select2-container").show();
						$('#nama_jabatan').hide();
						$('#status_jabatan').hide();
					}
				}

				$('[name="lokasi"]').val(data.lokasi);
				$('[name="nomor_sk"]').val(data.nomor_sk);
				$('[name="tmt_mulai_jabatan"]').datepicker('update', data.tmt_mulai_jabatan);
				$('[name="tgl_sk_jabatan"]').datepicker('update', data.tgl_sk_jabatan);

				var id_riwayat_status_jabatan = data.id_riwayat_status_jabatan;
				var id_r_jabatan = data.id_r_jabatan;

				$.ajax({
					type: "post",
					data: {
						id_riwayat_status_jabatan,
						id_r_jabatan
					},
					url: "<?php echo base_url(); ?>jabatan/nama_jabatan_edit",
					success: function(data) {
						//alert(data);
						$('#id_r_jabatan').html(data);
					}
				});


				$('#modal_jabatan').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data Riwayat Jabatan - <?php echo $this->func_table->name_format($this->session->userdata("nama_pegawai")); ?>'); // Set title to Bootstrap modal title

				//arsip handle
				if (data.arsip != null) {
					genArsipJabatan(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipJabatan(data) {
		$('#arsipContentJabatan').remove();
		$('#arsipContentJabatanTitle').remove();
		$('#arsipJabatan_title').val(data.title);

		// let html = '<iframe id="arsipContentJabatan" src="<?php echo base_url(); ?>asset/upload/SK/SK_' + data.id_jenis_sk + '_' + data.id_ref + '_' + data.id_arsip_sk + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		// html += '<span id="arsipContentJabatanTitle"><br />' + data.title + ' - <a href="<?php echo site_url('jabatan/download/'); ?>' + data.id_arsip_sk + '">' + data.file_name_ori + '</a><br /><br />';

		// $('#arsipJabatan_file').before(html);

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
					html += '<img height="30px" src="' + path_file + '" title="' + data.file_name_ori + '">';
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

	function reload_table_jabatan() {
		tablejabatan.ajax.reload(null, false); //reload datatable ajax 
	}

	function savejabatan() {
		$('#btnSaveJabatan').text('saving...'); //change button text
		$('#btnSaveJabatan').attr('disabled', true); //set button disable $('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		var url;
		if (save_method == 'addjabatan') {
			url = "<?php echo site_url('jabatan/jabatan_add') ?>";
		} else {
			url = "<?php echo site_url('jabatan/jabatan_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_jabatan").closest("form");
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
					$('#modal_jabatan').modal('hide');
					reload_table_jabatan();
					//sk_gub('jabatan');
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSaveJabatan').text('save'); //change button text
				$('#btnSaveJabatan').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSaveJabatan').text('save'); //change button text
				$('#btnSaveJabatan').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_jabatan(id_riwayat_jabatan) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('jabatan/jabatan_delete') ?>/" + id_riwayat_jabatan,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_jabatan').modal('hide');
		// 			reload_table_jabatan();
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
							url: '<?php echo site_url("jabatan/jabatan_delete") ?>/' + id_riwayat_jabatan,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_jabatan').modal('hide');
								reload_table_jabatan();
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

<!-- <div class="modal fade" id="modal_jabatan" role="dialog"> -->
<div class="modal fade" id="modal_jabatan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Riwayat Jabatan - <?php echo $this->session->userdata("nama_pegawai"); ?></h4>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_jabatan" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_riwayat_jabatan" />

					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Status Jabatan</label>
							<div class="col-md-9">
								<select name="id_riwayat_status_jabatan" id="id_riwayat_status_jabatan" class="form-control">
									<option value="">-- Pilih Status Jabatan --</option>
									<?php
									foreach ($status_jabatan as $row) {
										echo '<option value="' . $row->id_status_jabatan . '">' . $row->nama_status_jabatan . '</option>';
									}
									?>
								</select>
								<input type="text" class="form-control" name="status_jabatan" id="status_jabatan" style="display:none;" placeholder="Isi Status jabatan" />


								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Nama Jabatan</label>
							<div class="col-md-9">
								<select name="id_r_jabatan" id="id_r_jabatan" class="form-control select_2" style="width:100%;" onchange="onchange_jabatan()">
									<option value="">-- Pilih Nama Jabatan --</option>
									<option value='999'>Lainnya</option>
									<?php
									foreach ($nama_jabatan as $nm) {
										echo '<option value="' . $nm->id_nama_jabatan . '">' . $nm->nama_jabatan . '</option>';
									}
									?>
								</select>
								<input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" style="display:none;" placeholder="Isi Nama jabatan" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Lokasi Kerja</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi Kerja">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">TMT</label>
							<div class="col-md-9">
								<input type="text" class="form-control datepicker" name="tmt_mulai_jabatan" id="tmt_mulai_jabatan" placeholder="TMT">
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
								<input type="text" class="form-control datepicker" name="tgl_sk_jabatan" id="tgl_sk_jabatan" placeholder="Tanggal SK">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<fieldset>
									<legend>Lampiran
										<div style="font-size: 14px; font-style: italic;" align="left">Lampirkan file SK jabatan/mutasi/lainnya.</div>
									</legend>
								</fieldset>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Nama File</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="arsipJabatan_title" id="arsipJabatan_title" placeholder="Input nama file yang di-upload">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Upload File</label>
							<div class="col-md-9">
								<div id="file_preview" style="float: left; padding-right: 10px;"></div>
								<input type="file" name="arsipJabatan_file" id="arsipJabatan_file" class="form-control" style="font-size: 12px; width: 332px;" />
								<label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
								<span class="help-block"></span>
							</div>
						</div>

					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnJabatanSave" onclick="savejabatan()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.select_2').select2();
	});

	function onchange_jabatan() {
		var Jid = document.getElementById("id_r_jabatan").value;
		if (Jid == '999') {
			$('#nama_jabatan').show();
		} else {
			$('#nama_jabatan').hide();
		}
	}
</script>