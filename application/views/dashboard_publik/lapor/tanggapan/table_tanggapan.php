<div class="box-body table-responsive">
	<table class="table table-bordered" width="100%" id="table_tanggapans" style="font-size: 12px;">
		<thead>
			<tr style='background-color:#90dfe0;color:#000;font-weight:bold;'>
				<td align='center'>Dibuat Oleh</td>
				<td align='center'>Tanggapan</td>
				<td align='center'>Tanggal Dibuat</td>
				<td align='center'>Action</td>
			</tr>
		</thead>

		<tbody>
			<?php
			if (empty($data)) { } else {
				$no = 1;
				foreach ($data as $d) {

					$username = $this->session->userdata('username');
					$user_type = $this->session->userdata('stts');
					$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
					$id_pegawai = $this->session->userdata('id_pegawai');


					?>

					<tr>
						<td style="font-size: 14px;"><?php echo $d->nama_lengkap; ?></td>
						<td style="font-size: 14px;"><?php echo $d->Tanggapan; ?></td>
						<td style="font-size: 14px;"><?php echo $d->Created_at; ?></td>
						<td align='center'>

							<?php
									if ($username == $d->Username) {
										?>

								<button class="btn btn-xs btn-info btn-flat" title="Edit" onclick="edit_tanggapan('<?php echo $d->Id; ?>')"><i class="fa fa-edit"></i></button>
								<button class="btn btn-xs btn-danger btn-flat" title="Hapus" onclick="hapus_tanggapan('<?php echo $d->Id; ?>')"><i class="fa fa-trash"></i></button>
							<?php } else {
										echo 'X';
									} ?>
						</td>
					</tr>

			<?php
					$no++;
				}
			}
			?>
		</tbody>
	</table>
</div>
<style type="text/css">
	.selected {
		background-color: #dff0d8;
	}
</style>

<script type="text/javascript">
	var tableca = $('#table_tanggapans').DataTable({
		"pageLength": 5,
		"searching": false,
		"lengthChange": false,
		order: [
			[2, 'desc']
		]
	});

	$('#table_tanggapans tbody').on('click', 'tr', function() {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
		} else {
			tableca.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
</script>