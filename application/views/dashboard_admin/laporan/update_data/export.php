<?php
$nama_file = date('Y-m-d') . "_laporan_pegawai_update_data.xls";
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=" . $nama_file . "");
header("Content-Transfer-Encoding: binary ");
?>

<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>

<table>
	<tr>
		<td></td>
		<td align="center"><b>Laporan Pegawai - Pembaruan Data</b></td>
	</tr>

	<tr>
		<td></td>
	</tr>

	<tr>
		<td></td>
		<td>

			<?php
			$tipe = $this->input->post('tipe');

			if ($tipe == 0) {
				?>

				<table cellpadding="8" style="border-collapse:collapse;" border="1">
					<tr height="40" style="background-color:#EA7D57;">
						<th>No.</th>
						<th>NIP</th>
						<th>NRK</th>
						<th>Nama Pegawai</th>
						<th>Lokasi Kerja</th>
						<th>Pembaruan di</th>
						<th>Tanggal Update</th>
					</tr>
					<?php
						$no = 1;
						foreach ($data->result_array() as $dp) {
							?>
						<tr valign="top">
							<td class="str"><?php echo $no; ?></td>
							<td class="str"><?php echo $dp['nip']; ?> </td>
							<td class="str"><?php echo $dp['nrk']; ?> </td>
							<td class="str"><?php echo ucwords(strtolower($dp['nama_pegawai'])); ?> </td>
							<td class="str"><?php echo str_replace('Dki', 'DKI', str_replace('Dan', 'dan', ucwords(strtolower($dp['lokasi_kerja'])))); ?> </td>
							<td class="str"><?php echo ucwords(strtolower($dp['menu'])); ?> </td>
							<td class="str"><?php echo $dp['created_at']; ?> </td>
						</tr>
					<?php
							$no++;
						}
						?>
				</table>

			<?php
			} elseif ($tipe == 1) {
				?>

				<table cellpadding="8" style="border-collapse:collapse;" border="1">
					<tr height="40" style="background-color:#EA7D57;">
						<th>No.</th>
						<th>NIP</th>
						<th>NRK</th>
						<th>Nama Pegawai</th>
						<th>Lokasi Kerja</th>
						<th>Jumlah Update</th>
					</tr>
					<?php
						$no = 1;
						foreach ($data->result_array() as $dp) {
							?>
						<tr valign="top">
							<td class="str"><?php echo $no; ?></td>
							<td class="str"><?php echo $dp['nip']; ?> </td>
							<td class="str"><?php echo $dp['nrk']; ?> </td>
							<td class="str"><?php echo ucwords(strtolower($dp['nama_pegawai'])); ?> </td>
							<td class="str"><?php echo str_replace('Dki', 'DKI', str_replace('Dan', 'dan', ucwords(strtolower($dp['lokasi_kerja'])))); ?> </td>
							<td class="str" style="text-align: right;"><?php echo ucwords(strtolower($dp['notif'])); ?> </td>
						</tr>
					<?php
							$no++;
						}
						?>
				</table>

			<?php
			} elseif ($tipe == 2) {
				?>

				<table cellpadding="8" style="border-collapse:collapse;" border="1">
					<tr height="40" style="background-color:#EA7D57;">
						<th>No.</th>
						<th>NIP</th>
						<th>NRK</th>
						<th>Nama Pegawai</th>
						<th>Lokasi Kerja</th>
						<th>Jumlah Update</th>
					</tr>
					<?php
						$no = 1;
						foreach ($data->result_array() as $dp) {
							?>
						<tr valign="top">
							<td class="str"><?php echo $no; ?></td>
							<td class="str"><?php echo $dp['nip']; ?> </td>
							<td class="str"><?php echo $dp['nrk']; ?> </td>
							<td class="str"><?php echo ucwords(strtolower($dp['nama_pegawai'])); ?> </td>
							<td class="str"><?php echo str_replace('Dki', 'DKI', str_replace('Dan', 'dan', ucwords(strtolower($dp['lokasi_kerja'])))); ?> </td>
							<td class="str" style="text-align: right;"><?php echo ucwords(strtolower($dp['notif'])); ?> </td>
						</tr>
					<?php
							$no++;
						}
						?>
				</table>

			<?php
			}
			?>

		</td>
	</tr>
</table>