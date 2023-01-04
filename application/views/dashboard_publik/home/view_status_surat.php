<style type="text/css">
	.modal-header {
		background-color: #1c8baf;
		/* padding: 16px 16px; */
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
		/* background-color: #f1f1f6; */
	}

	.content {
		min-height: auto;
	}

	.select2-selection__rendered {
		/* background-color: #ababab; */
		background-color: #defee2;
	}
</style>



<div class="modal-body" style="padding-right: 0px; padding-bottom: 0px; padding-left: 0px; padding-top: 0px;">
	<table class="table table-bordered" style="border: 2px solid #d8d8d8; margin-bottom: 10px;">
		<tbody>
			<tr>
				<td><b>Nama</b></td>
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
					// if ($data->status == 'Selesai') {
					// 	echo '<span class="badge bg-green">' . $data->status . '</span>';
					// } else if ($data->status == 'Menunggu') {
					// 	echo '<span class="badge bg-yellow">' . $data->status . '</span>';
					// } else if ($data->status == 'Sedang Diproses') {
					// 	echo '<span class="badge bg-blue">' . $data->status . '</span>';
					// } else if ($data->status == 'Ditolak') {
					// 	echo '<span class="badge bg-red">' . $data->status . '</span>';
					// } else {
					// 	echo '<span class="badge bg-dark">' . $data->status . '</span>';
					// }
					echo str_replace('<br>', ' ', $data->nama_status_next);
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

	<div></div>

	<div class="box" style="background-color: #f1f1f6; border: 1px solid grey;">

		<legend style="border-bottom: 1px solid #1c8baf; border-top: 1px solid #1c8baf; text-align: center;">
			<h4 style="font-size: medium;">Perjalanan Pengajuan Surat Keterangan Pegawai</h4>
		</legend>

		<div class="box-body">

			<div class="container" style="width:auto; padding-bottom: 25px;">
				<div class="timeline">
					<ul class="ul-li-timeline">

						<?php
						$data1['data_history'] = $data_history;
						$this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline_content', $data1);
						?>

					</ul>
				</div>
			</div>

		</div>
	</div>

	<div class="control-group">
		<button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="tutup_form()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
	</div>
</div>