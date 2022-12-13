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
	}

	.select2-selection__rendered {
		/* background-color: #ababab; */
		background-color: #defee2;
	}
</style>

<?php
if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "publik") { } else {
	header('location:' . base_url() . '');
}
?>

<?php echo form_open_multipart('dashboard_publik/simpan_surat', 'class="form-horizontal"'); ?>

<!-- Main content -->
<section id="data-sk" class="content" style="padding-bottom: 0px; padding-right: 15px; padding-top: 0px; padding-left: 15px;">
	<!-- <div class="callout callout-info">
		<h3>Surat Keterangan Pegawai Ditolak</h3>
	</div> -->

	<div class="row">
		<div class="col-xs-12" style="padding-right: 0px; padding-left: 0px">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Nama Pegawai : </span>
											<input type="text" class="form-control" value="<?php echo $this->func_table->name_format($data_surat->nama); ?>" placeholder="Nama Pegawai" disabled="disabled" />
										</div><!-- /.input group -->
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">NIP : </span>
											<input type="text" class="form-control" value="<?php echo $data_surat->nip; ?>" placeholder="Nama Pegawai" disabled="disabled" />
										</div><!-- /.input group -->
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">NRK : </span>
											<input type="text" class="form-control" value="<?php echo $data_surat->nrk; ?>" placeholder="Nama Pegawai" disabled="disabled" />
										</div><!-- /.input group -->
									</div>



									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Status Pegawai : </span>
											<input type="text" class="form-control" value="<?php echo $data_surat->nama_status; ?>" placeholder="Nama Pegawai" disabled="disabled" />
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Alamat Domisili : </span>
											<textarea class="form-control textarea" style="height: 100px;overflow:auto;resize:none" disabled="disabled"><?php echo $data_surat->alamat_domisili; ?></textarea>
										</div><!-- /.input group -->
									</div>

									<?php
									if (strtolower($data_surat->jenis_pengajuan_surat) == 'x') {
										$keterangan = $data_surat->jenis_pengajuan_surat_lainnya;
									} else {
										$keterangan = $data_surat->keterangan_jenis_surat;
									}
									?>

									<!-- <div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Keperluan : </span>
											<textarea class="form-control textarea" style="height: 100px;overflow:auto;resize:none" disabled="disabled"><?php echo $keterangan; ?></textarea>
										</div>
									</div> -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Keperluan : </span>
											<input type="text" class="form-control" value="<?php echo $keterangan; ?>" placeholder="Nama Pegawai" disabled="disabled" />
										</div><!-- /.input group -->
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Alasan Ditolak : </span>
											<textarea class="form-control textarea" style="height: 100px;overflow:auto;resize:none" disabled="disabled"><?php echo $data_surat->keterangan_ditolak; ?></textarea>
										</div><!-- /.input group -->
									</div>

								</div>

							</div>



						</div>
						<hr>
						<div class="control-group">
							<!-- <div class="controls" align="center">
								<a href="<?php echo base_url() ?>dashboard_publik/status_surat" class="btn btn-warning">Kembali</a>
								<br /><br />
							</div> -->
							<button type="button" style='float:right;' class="btn btn-warning btn-sm" onclick="tutup_form()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>

						</div>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
</section><!-- /.content -->