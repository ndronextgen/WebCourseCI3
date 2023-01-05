<style type="text/css">
	.modal-header {
		/* background-color: #1caf9a; */
		background-color: #1c8baf;
		/* padding: 16px 16px; */
		color: #FFF;
	}

	label {
		font-weight: bold;
	}

	/* Important part */
	.modal-dialog {
		overflow-y: initial !important
	}

	.modal-body {
		overflow-y: auto;
		background-color: #f1f1f6;
		padding-bottom: 0px;
		padding-top: 0px;

	}

	.select2-selection__rendered {
		/* background-color: #ababab; */
		background-color: #defee2;
	}
</style>

<?php echo form_open_multipart('dashboard_publik/simpan_surat', 'class="form-horizontal form-modal"'); ?>
<!-- Main content -->
<section id="data-sk" class="content" style="padding-right: 0px; padding-left: 0px;"> 

	<!-- <div class="callout callout-info" style="margin-bottom: 0px">
		<h3>Surat Keterangan Pegawai</h3>
		Silahkan isi data sesuai Form dibawah ini :
	</div> -->


	<!-- <?php //if ($this->session->flashdata('gagalupload')) { 
			?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php //echo $this->session->flashdata('gagalupload'); 
			?>
		</div>
	<?php //} 
	?>
	<?php //if ($this->session->flashdata('gagalupload2')) { 
	?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php //echo $this->session->flashdata('gagalupload'); 
			?>
		</div>
	<?php //} 
	?>
	<?php //if ($this->session->flashdata('gagalupload3')) { 
	?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php //echo $this->session->flashdata('gagalupload3'); 
			?>
		</div>
	<?php //} 
	?>
	<?php //if ($this->session->flashdata('gagalupload4')) { 
	?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4>GAGAL !!!</h4>
			<?php //echo $this->session->flashdata('gagalupload4'); 
			?>
		</div>
	<?php //} 
	?> -->


	<div class="row">
		<div class="col-xs-12">
			<div class="nav-tabs-custom" style="margin-bottom: 0px">
				<div class="tab-content" style="padding-top: 0px">
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Nama Pegawai :</span>
											<input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="<?php echo $this->func_table->name_format($nama_pegawai); ?>" placeholder="Nama Pegawai" disabled="disabled">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">NIP :</span>
											<input type="text" class="form-control" name="nip" id="nip" value="<?php echo $nip; ?>" placeholder="NIP" disabled="disabled">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">NRK :</span>
											<input type="text" class="form-control" name="nrk" id="nrk" value="<?php echo $nrk; ?>" placeholder="NRK" disabled="disabled">
										</div><!-- /.input group -->
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Status Pegawai :</span>
											<select class="select2 form-control" name="status_pegawai" id="status_pegawai" disabled="disabled">
												<?php
												foreach ($mst_status_pegawai->result_array() as $mspg) {
													if ($status_pegawai == $mspg['id_status_pegawai']) {
														?>
														<option value=" <?php echo $mspg['id_status_pegawai']; ?>" selected="selected"><?php echo $mspg['nama_status']; ?></option>
													<?php
														} else {
															?>
														<option value="<?php echo $mspg['id_status_pegawai']; ?>"><?php echo $mspg['nama_status']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Alamat Domisili:</span>
											<textarea class="form-control textarea" style="height: 100px;overflow:auto;resize:none" name="alamat" id="alamat" placeholder="Alamat" disabled="disabled"><?php echo $alamat_pegawai; ?></textarea>
										</div><!-- /.input group -->
									</div>



									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Keperluan :</span>
											<select class="select2 form-control" name="jenis_pengajuan_surat" id="jenis_pengajuan_surat" onchange="onChangeJenisPengajuanSurat()" placeholder="Jenis Pengajuan Surat">
												<option value="">[Jenis Keperluan]</option>
												<?php
												foreach ($mst_jenis_pengajuan_surat as $data) {
													?>
													<option value="<?= $data->kode; ?>">
														<?= $data->keterangan; ?>
													</option>
												<?php
												}
												?>
											</select>
										</div>
										<!-- <div class="input-group" id="jenis_lainnya"> -->
										<!-- <span class="input-group-addon">Jenis Pengajuan Lainnya :</span> -->
										<input type="hidden" class="form-control" name="jenis_pengajuan_surat_lainnya" id="jenis_pengajuan_surat_lainnya" placeholder="Jenis keperluan lainnya" />
										<!-- </div> -->
									</div>



									<div class="form-group" style='display:none;'>
										<div class="input-group">
											<span class="input-group-addon">Keperluan:</span>
											<textarea class="form-control textarea" style="height: 100px;overflow:auto;resize:none" name="keterangan" id="keterangan"></textarea>
										</div>
									</div>



								</div>
							</div>
						</div>

						<hr>

						<div class="control-group">
							<button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="tutup_form ()"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
							<button type="submit" style='float:right;' id="btnSubmit" class="btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
						</div>
						<input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
						<input type="hidden" name="st" value="<?php echo $st; ?>">
						<input type="hidden" name="frame" value="frame">
						<?php echo form_close(); ?>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div>
</section><!-- /.content -->



<script type="text/javascript">
	var save_method; //for save method string
	var tablesk;
	$(document).ready(function() {
		//datatables
		tablesk = $('#table_sk').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('arsip_sk/sk_datatables') ?>",
				"type": "POST"
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			}, ],
		});

		$("form.form-modal").submit(function (e) {
			e.preventDefault();
			$("#btnSubmit").prop("disabled", true);
			this.submit();
		});

	});

	function onChangeJenisPengajuanSurat() {
		var kodeJenis = document.getElementById("jenis_pengajuan_surat").value;
		
		if (kodeJenis.toLowerCase() == 'x') {
			document.getElementById('jenis_pengajuan_surat_lainnya').type = 'text';
		} else {
			document.getElementById('jenis_pengajuan_surat_lainnya').type = 'hidden';
		}
	}
</script>