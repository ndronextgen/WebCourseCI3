<?php
if ($ctype == 'excel') {
	ob_start();
	//$string = preg_replace('/\s+/', '', $wilayah);
	$new_file  = "Data_absensi.xls";
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=$new_file");
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Expires: 0");
} else { }
?>

<style type="text/css">
	table.wbo {
		border-collapse: collapse;
		border: 1px solid #595959;
		margin: 0 auto;
		padding: 10px;
		font-size: 10px;
		font-family: Arial Narrow, Arial, sans-serif;
	}
</style>

<style type="text/css">
	td {
		mso-number-format: \@;
	}
</style>

<table width="99%" border="0" cellspacing="0" cellpadding="0" style="font-weight: bold; font-size: 9px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
	<tr>
		<td width="90px">NAMA</td>
		<?php if ($ctype == 'pdf') { ?>
			<td width="10px">:</td>
		<?php } ?>
		<td><?php echo $data_pegawai->NamaPegawai; ?></td>
		<td width="50%"></td>
	</tr>
	<tr>
		<td>NIP</td>
		<?php if ($ctype == 'pdf') { ?>
			<td>:</td>
		<?php } ?>
		<td><?php echo $data_pegawai->NIP; ?></td>
		<td width="50%"></td>
	</tr>
	<tr>
		<td>UNIT KERJA</td>
		<?php if ($ctype == 'pdf') { ?>
			<td>:</td>
		<?php } ?>
		<td><?php echo $data_pegawai->Unite2; ?></td>
		<td width="50%"></td>
	</tr>

</table>
<br>
<table border="1" class='wbo' style="font-size: 12px; font-family:'Century Gothic';">
	<thead style="background: #333;color:#f1f1f1;">
		<tr align="center">
			<td><b>Refresh</b></td>
			<td><b>Kehadiran</b></td>
			<td><b>Keterlambatan</b></td>
			<td><b>CT.Digunakan/ CT.Ditangguhkan/ Jatah.CT</b></td>
			<td><b>CT.DitangguhkanTahunSblmnya/ Sisa.CT</b></td>
			<td><b>Cuti Alasan Penting Tahunan</b></td>
			<td><b>Potongan Harian %</b></td>
			<td><b>Potongan Kinerja</b></td>
			<td><b>Pengurangan CB</b></td>
			<?php if ($bulan == '01') { ?>
				<td><b>Potongan Bulan Desember</b></td>
			<?php } ?>
			<td><b>Tukin Netto</b></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><button class="btn btn-xs btn-danger" id="refresh" onclick="reload_atas()"><i class="fa fa-refresh"></i> </button></td>
			<td align="center"><?php echo $jml_tukin->jml_kehadiran; ?></td>
			<td align="center"><?php echo $jml_tukin->TTm; ?></td>
			<td align="center">
				<?php
				foreach ($list_cuti as $key) {
					if ($key->T_Tahun == $tahun) {
						echo '<span style="color:#eb4034;">' . $key->jumlah_cuti_digunakan . '</span>/<span style="color:#eb4034;">' . $key->ditangguhkan_tahun_ini . '</span>/' . $key->jatah_cutitahunan;
					} else {
						echo '';
					}
				}
				?>
			</td>
			<td align="center"><?php echo $key->ditangguhkan_tahun_sebelumnya . '/<b>' . $key->sisa_cuti_tahunan_ini . '</b>'; ?></td>
			<td align="center"><?php echo $list_cutialasanpenting->ttl_cuti; ?></td>
			<td align="center"><?php echo $jml_tukin->TPotongan; ?></td>
			<td align="center"><?php echo number_format($kinerja, 0, ",", "."); ?></td>
			<td align="center"><?php echo number_format($pengurangan_cb, 0, ",", "."); ?></td>
			<?php if ($bulan == '01') { ?>
				<td align="right">
					<?php echo number_format($faktor_pengurang, 0, ",", "."); ?>
				</td>
			<?php } ?>
			<td align="center"><?php echo number_format($hasil_total_jumlah_netto, 0, ",", "."); ?></td>
		</tr>
	</tbody>
</table>
<br>
<table id="table_data_absensi" border="1" class='wbo' cellspacing="0" width="100%" style='font-size:12px !important;'>
	<thead style="background: #333;color:#f1f1f1;">
		<tr>
			<td align="center" colspan="4"><b>Jadwal Kerja</b></td>
			<td align="center" rowspan="2" width="80px"><b>Jam Masuk</b></td>
			<td align="center" rowspan="2" width="80px"><b>Jam Keluar</b></td>
			<td align="center" rowspan="2" width="80px"><b>TM</b></td>
			<td align="center" rowspan="2" width="80px"><b>PC</b></td>
			<td align="center" colspan="2"><b>Status</b></td>
			<td align="center" colspan="4"><b>Faktor Pengurangan</b></td>
			<td align="center" rowspan="2"><b>Keterangan</b></td>

		</tr>
		<tr>
			<td align="center"><b>Tanggal</b></td>
			<td align="center"><b>Hari-Jadwal</b></td>
			<td align="center"><b>Masuk</b></td>
			<td align="center"><b>Pulang</b></td>
			<td align="center"><b>TM</b></td>
			<td align="center"><b>PC</b></td>
			<td align="center"><b>%TM</b></td>
			<td align="center"><b>%PC</b></td>
			<td align="center"><b>Lain</b></td>
			<td align="center"><b>JML</b></td>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 0;
		foreach ($listing as $rows) {
			$no++;
			if ($rows->JamPulang == '') {
				$color_p = 'background: #fffb35 !important;';
			} else {
				$color_p = '';
			}
			if ($rows->JamMasuk == '') {
				$color_m = 'background: #fffb35 !important;';
			} else {
				$color_m = '';
			}
			?>
			<tr>
				<td style="padding:2px;" align="center"><?php echo date("d/m/Y", strtotime($rows->Tanggal)); ?></td>
				<td style="padding:2px;" align="center"><?php echo $this->func_table->gethari($rows->Hari) . '-' . $rows->KodeWfh; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->AturanMasuk; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->AturanPulang; ?></td>
				<?php
					if ($rows->Lainnya == 'DL') {
						$Jm = '';
						$Jp = '';
					} else {
						$Jm = $rows->JamMasuk;
						$Jp = $rows->JamPulang;
					}
					if ($key->Tm == '00:00:00') {
						$Tm = '0';
					} else {
						$Tm = $key->Tm;
					}
					if ($key->Pc == '00:00:00') {
						$Pc = '0';
					} else {
						$Pc = $key->Pc;
					}
					?>
				<td style="padding:2px; <?php echo $color_m; ?>" align="center"><?php echo $Jm; ?></td>
				<td style="padding:2px; <?php echo $color_p; ?>" align="center"><?php echo $Jp; ?></td>
				<td style="padding:2px;" align="center"><?php echo $Tm; ?></td>
				<td style="padding:2px;" align="center"><?php echo $Pc; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->xSTm; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->xSPc; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->xPTm; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->xPPc; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->Lainnya; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->xPPc +  $rows->xPTm + $rows->xPPl; ?></td>
				<td style="padding:2px;" align="center"><?php echo $rows->Keterangan; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>