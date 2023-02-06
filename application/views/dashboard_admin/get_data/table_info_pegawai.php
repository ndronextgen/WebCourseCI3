<table class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%" style='font-size:13px !important;'>
	<tr>
		<td width='30%'>Nama</td>
		<td width='1%'>:</td>
		<td><?php echo ucwords(strtolower($Data->nama_pegawai)); ?></td>
	</tr>
	<tr>
		<td>NIP / NRK</td>
		<td>:</td>
		<td><?php echo $Data->nip . ' / ' . $Data->nrk; ?></td>
	</tr>
	<tr>
		<td>Pangkat / Golongan</td>
		<td>:</td>
		<td><?php echo ucwords(strtolower($Data->uraian)) . ' ( ' . $Data->golongan . ' )'; ?></td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>:</td>
		<td><?php echo ucwords(strtolower($Data->nama_jabatan)); ?></td>
	</tr>
	<tr>
		<td>Satuan Organisasi</td>
		<td>:</td>
		<td>
			<?php
			$lokasi = $Data->nama_lokasi_kerja;
			$lokasi = str_replace('Dan', 'dan', ucwords(strtolower($lokasi)));
			$lokasi = str_replace('Dki', 'DKI', ucwords(strtolower($lokasi)));
			echo $lokasi;
			?>
		</td>
	</tr>
</table>
<hr>