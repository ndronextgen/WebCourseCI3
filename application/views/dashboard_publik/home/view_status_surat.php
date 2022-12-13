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
					if ($data->status == 'Selesai') {
						echo '<span class="badge bg-green">' . $data->status . '</span>';
					} else if ($data->status == 'Menunggu') {
						echo '<span class="badge bg-yellow">' . $data->status . '</span>';
					} else if ($data->status == 'Sedang Diproses') {
						echo '<span class="badge bg-blue">' . $data->status . '</span>';
					} else if ($data->status == 'Ditolak') {
						echo '<span class="badge bg-red">' . $data->status . '</span>';
					} else {
						echo '<span class="badge bg-dark">' . $data->status . '</span>';
					}
					?>
				</td>
			</tr>

			<tr>
				<td><b>Nama Admin</b></td>
				<td>:</td>
				<td>
					<?php echo $data->nama_lengkap; ?>
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
						if (isset($data_history)) {
							foreach ($data_history as $data) {
								$nama_user = ucwords(strtolower($this->func_table->removeTitleFromName($data->nama_pegawai)));
								echo '
								<li class="ul-li-timeline">
									<div class="content">
										<h3>' . date_format(date_create($data->created_at), 'd M Y - H:i:s') . '</h3>
										<p>' . $data->nama_status . '';
								if ($data->id_status == '24' or $data->id_status == '25' or $data->id_status == '26' or $data->id_status == '28') {
									echo '<br><br>Alasan ditolak: ';
									if ($data->keterangan_ditolak == '') {
										echo '-';
									} else {
										echo $data->keterangan_ditolak;
									}
								}
								echo '</p>
									</div>
									<div class="point"></div>

									<div class="date">
										<h4 style="padding: 15px 0;">' . $nama_user . '</h4>
									</div>
								</li>
								';
							}



							$id_srt = $data->id_srt;
							$sSQL = "SELECT is_dinas from tbl_data_srt_ket where id_srt = '$id_srt'";
							$is_dinas = $this->db->query($sSQL)->row()->is_dinas;

							switch ($is_dinas) {
								case 1:
									if (
										$data->id_status == '0' or  // menunggu
										$data->id_status == '24'    // ditolak admin
									) {
										echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Verifikasi Admin</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                ';
									}
									if (
										$data->id_status == '0' or  // menunggu
										$data->id_status == '21' or // verifikasi admin
										$data->id_status == '25'    // ditolak kasubbag kepegawaian
									) {
										echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Verifikasi Kepala Subbagian Kepegawaian</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                ';
									}
									if (
										$data->id_status == '0' or  // menunggu
										$data->id_status == '21' or // verifikasi admin
										$data->id_status == '22' or // verifikasi kasubbag
										$data->id_status == '26'    // ditolak sekdis
									) {
										echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Verifikasi Sekretaris Dinas</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                ';
									}
									if (
										$data->id_status == '0' or  // menunggu
										$data->id_status == '21' or // verifikasi admin
										$data->id_status == '22' or // verifikasi kasubbag
										$data->id_status == '23'    // verifikasi sekdis
									) {
										echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                ';
									}

									break;

								case 0 or 2:
									if (
										$data->id_status == '0' or  // menunggu
										$data->id_status == '24'    // ditolak admin
									) {
										echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Verifikasi Admin</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                ';
									}
									if (
										$data->id_status == '0' or  // menunggu
										$data->id_status == '21' or // verifikasi admin
										$data->id_status == '28'    // ditolak kasubbag
									) {
										echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Verifikasi Kepala Subbagian</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                ';
									}
									if (
										$data->id_status == '0' or  // menunggu
										$data->id_status == '21' or // verifikasi admin
										$data->id_status == '27'    // verifikasi kasubbag
									) {
										echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: #aca9b1">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: #aca9b1;">-</h4>
                                    </div>
                                </li>
                                ';
									}

									break;
							}


							
						}
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