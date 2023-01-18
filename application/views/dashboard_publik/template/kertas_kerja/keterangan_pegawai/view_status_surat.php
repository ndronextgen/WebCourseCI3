<style type="text/css">
	.modal-header {
		background-color: #1c8baf;
		color: #FFF;
	}

	label {
		font-weight: bold;
	}

	/* Important part */
	.modal-dialog {
		overflow-y: initial !important;
	}

	.modal-body {
		overflow-y: auto;
	}

	.content {
		min-height: auto;
	}

	.select2-selection__rendered {
		background-color: #defee2;
	}
</style>

<div class="modal-body" style="padding-right: 0px; padding-bottom: 0px; padding-left: 0px; padding-top: 0px;">
	<table class="table no-border" style="border: 2px solid #d8d8d8; margin-bottom: 10px;">
		<tbody>
			<tr>
				<td width='150px'><b>Nama</b></td>
				<td width='1px'>:</td>
				<td>
					<?php echo $this->func_table->name_format($data->nama); ?>
				</td>
			</tr>
			<tr>
				<td><b>NIP</b></td>
				<td>:</td>
				<td>
					<?php echo $data->nip; ?>
				</td>
			</tr>
			<tr>
				<td><b>Keperluan</b></td>
				<td>:</td>
				<td>
					<?php
					// echo $data->keterangan;
					if (strtolower($data->jenis_pengajuan_surat) == 'x') {
						echo $data->jenis_pengajuan_surat_lainnya;
					} else {
						echo $data->pengajuan_surat_lain;
					}
					?>
				</td>
			</tr>
			<tr>
				<td><b>Status</b></td>
				<td>:</td>
				<td>
					<?php
					if ((int) $data->id_status_srt == 21) {
						if ($data->is_dinas == 1) {
							echo 'Menunggu Verifikasi Kepala Subkoordinator Kepegawaian';
						} else {
							echo 'Menunggu Verifikasi Kepala Subbagian';
						}
					} else {
						echo str_replace('<br>', ' ', $data->nama_status_next);
					}
					?>
				</td>
			</tr>

			<tr>
				<td><b>Nama Admin</b></td>
				<td>:</td>
				<td>
					<?php echo $this->func_table->name_format($data->nama_lengkap); ?>
				</td>
			</tr>

			<?php
			if ($data->id_status_srt == 1 or $data->id_status_srt == 24 or $data->id_status_srt == 25 or $data->id_status_srt == 26) {
				?>
				<tr>
					<td><b>Alasan Ditolak</b></td>
					<td>:</td>
					<td>
						<?php echo $data->keterangan_ditolak; ?>
					</td>
				</tr>
			<?php
			}
			?>

		</tbody>
	</table>

	<hr>
	<h4 style="text-align: center;">
		Timeline Surat
	</h4>
	<br>

	<!-- <div class="box" style="background-color: #f1f1f6; border: 1px solid grey;"> -->

	<!-- <legend style="border-bottom: 1px solid #1c8baf; border-top: 1px solid #1c8baf; text-align: center;"> -->
	<!-- <h4 style="font-size: medium;">Perjalanan Pengajuan Surat Keterangan Pegawai</h4> -->
	<!-- </legend> -->

	<div class="box-body">

		<!-- <div class="container" style="width:auto; padding-bottom: 25px;"> -->
		<!-- <div class="timeline"> -->
		<!-- <ul class="ul-li-timeline"> -->

		<?php
		$data1['data_history'] = $data_history;
		$this->load->view('dashboard_publik/template/timeline/timeline_content_2', $data1);
		?>

		<!-- </ul> -->
		<!-- </div> -->
		<!-- </div> -->

	</div>
	<!-- </div> -->

	<hr style="border: 1px solid #1c8baf; margin-bottom: 15px; ">

	<div class="control-group">
		<button type="button" style='float:right;' class="btn btn-danger btn-sm" data-dismiss="modal""><i class=" fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
	</div>
</div>