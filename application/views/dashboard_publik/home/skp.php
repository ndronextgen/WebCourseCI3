<script type="text/javascript">
	function add_skp() {
		$('#arsipContentSkp').remove();
		$('#arsipContentSkpTitle').remove();
		save_method = 'addskp';
		$('#form_skp')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_skp').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Data SKP / DP3 - <?php echo $this->session->userdata("nama_pegawai"); ?>'); // Set Title to Bootstrap modal title
	}

	function edit_skp(id_dp3) {
		$('#arsipContentSkp').remove();
		$('#arsipContentSkpTitle').remove();
		save_method = 'update';
		$('#form_skp')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('skp/skp_edit/') ?>/" + id_dp3,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('[name="id_dp3"]').val(data.id_dp3);
				$('[name="tahun"]').val(data.tahun);
				$('[name="orientasi"]').val(data.orientasi);
				$('[name="integritas"]').val(data.integritas);
				$('[name="komitmen"]').val(data.komitmen);
				$('[name="disiplin"]').val(data.disiplin);
				$('[name="prestasi"]').val(data.prestasi);
				$('[name="tanggung_jawab"]').val(data.tanggung_jawab);
				$('[name="ketaatan"]').val(data.ketaatan);
				$('[name="kejujuran"]').val(data.kejujuran);
				$('[name="kerjasama"]').val(data.kerjasama);
				$('[name="kesetiaan"]').val(data.kesetiaan);
				$('[name="prakarsa"]').val(data.prakarsa);
				$('[name="kepemimpinan"]').val(data.kepemimpinan);
				$('[name="rata_rata"]').val(data.rata_rata);
				$('[name="atasan"]').val(data.atasan);
				$('[name="penilai"]').val(data.penilai);
				$('[name="uraian"]').val(data.uraian);
				$('#modal_skp').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Data SKP / DP3'); // Set title to Bootstrap modal title

				//arsip handle
				if (data.arsip != null) {
					genArsipSkp(data.arsip);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function genArsipSkp(data) {
		$('#arsipContentSkp').remove();
		$('#arsipContentSkpTitle').remove();
		$('#arsipTubel_title').val(data.title);

		let html = '<iframe id="arsipContentSkp" src="<?php echo base_url(); ?>asset/upload/SKP/SKP_' + data.id_dp3 + '_' + data.id_arsip_skp + '/' + data.file_name + '" frameborder="no" width="420px" height="400px"></iframe>';
		html += '<span id="arsipContentSkpTitle"><br />' + data.title + ' - <a href="<?php echo site_url('skp/download/'); ?>' + data.id_arsip_skp + '">' + data.file_name_ori + '</a><br /><br />';

		$('#arsipSkp_file').before(html);
	}

	function reload_table_skp() {
		tableskp.ajax.reload(null, false); //reload datatable ajax 
	}

	function saveskp() {
		$('#btnSkpSave').text('saving...'); //change button text
		$('#btnSkpSave').attr('disabled', true); //set button disable 
		$('.form-group').removeClass('has-error'); // clear error class
		$('.form-control').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		var url;

		if (save_method == 'addskp') {
			url = "<?php echo site_url('skp/skp_add') ?>";
		} else {
			url = "<?php echo site_url('skp/skp_update') ?>";
		}

		// ajax adding data to database
		var form = $("#form_skp").closest("form");
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
					$('#modal_skp').modal('hide');
					reload_table_skp();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSkpSave').text('save'); //change button text
				$('#btnSkpSave').attr('disabled', false); //set button enable 
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSkpSave').text('save'); //change button text
				$('#btnSkpSave').attr('disabled', false); //set button enable 
			}
		});
	}

	function delete_skp(id_dp3) {
		// if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
		// 	// ajax delete data to database
		// 	$.ajax({
		// 		url: "<?php echo site_url('skp/skp_delete') ?>/" + id_dp3,
		// 		type: "POST",
		// 		dataType: "JSON",
		// 		success: function(data) {
		// 			//if success reload ajax table
		// 			$('#modal_skp').modal('hide');
		// 			reload_table_skp();
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
							url: '<?php echo site_url("skp/skp_delete") ?>/' + id_dp3,
							success: function() {
								$.dialog({
									icon: 'fa fa-info',
									title: 'Info',
									content: i,
									type: 'green',
									backgroundDismiss: true
								});

								//if success reload ajax table
								$('#modal_skp').modal('hide');
								reload_table_skp();
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

<!-- <div class="modal fade" id="modal_skp" role="dialog"> -->
<div class="modal fade" id="modal_skp" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Tambah Data SKP / DP3 - <?php echo $this->session->userdata("nama_pegawai"); ?></h3>
			</div>

			<div class="modal-body form">
				<form action="#" id="form_skp" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_dp3" />

					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Jenis Data</label>
							<div class="col-md-9">
								<select name="uraian" id="uraian" data-placeholder="Nama Status" class="form-control">
									<option value="">-- Pilih Jenis Data --</option>
									<option value="SKP">SKP</option>
									<option value="DP3">DP3</option>
								</select>

								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tahun</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Orientasi Pelayanan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="orientasi" placeholder="Orientasi Pelayanan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Integritas</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="integritas" placeholder="Integritas">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Komitmen</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="komitmen" placeholder="Komitmen">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Disiplin</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="disiplin" placeholder="Disiplin">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Kesetiaan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="kesetiaan" id="kesetiaan" placeholder="Kesetiaan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Prestasi</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="prestasi" placeholder="Prestasi">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Tanggung Jawab</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="tanggung_jawab" placeholder="Tanggung Jawab">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Ketaatan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="ketaatan" placeholder="Ketaatan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Kejujuran</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="kejujuran" placeholder="Kejujuran">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Kerjasama</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="kerjasama" placeholder="Kerjasama">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Prakarsa</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="prakarsa" placeholder="Prakarsa">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Kepemimpinan</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="kepemimpinan" placeholder="Kepemimpinan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Rata-rata</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="rata_rata" placeholder="Rata-rata">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Atasan Penilai</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="atasan" placeholder="Atasan">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Penilai</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="penilai" placeholder="Penilai">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Upload Dokumen</label>
							<div class="col-md-9">
								<input type="file" name="arsipSkp_file" id="arsipSkp_file" class="form-control" />
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="btnSkpSave" onclick="saveskp()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->