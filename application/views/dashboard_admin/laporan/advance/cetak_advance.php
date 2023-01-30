
<?php
if ($ctype =='excel'){
	ob_start();
	//$string = preg_replace('/\s+/', '', $wilayah);
	$new_file  = "rekap_pegawai.xls";
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=$new_file");
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Expires: 0");
} else {
}
?>
<style>
table.wbo {
  border-collapse: collapse;
  border: 1px solid #595959;
  margin: 0 auto;
  padding:10px;
  font-size:10px;
  font-family: Arial Narrow,Arial,sans-serif;
}
</style>
<style> td{ mso-number-format:\@; } </style>
<table border="0" cellspacing="0" cellpadding="0" width="99%">
    <tr style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
        <td align="center" style="font-size: 14px;" colspan='8'><b>LAPORAN PEGAWAI</b></td>
    </tr>
</table>
<br>
<!-- <table width="99%" border="0" cellspacing="0" cellpadding="0" style="font-weight: bold;font-size: 11px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
  <tr>
    <td width="90px">Lokasi Kerja</td>
    <td width="10px">:</td>
    <td><?php //echo $lokasi; ?></td>
  </tr>
  <tr>
    <td width="90px">Sublokasi Kerja</td>
    <td width="10px">:</td>
    <td><?php //echo $sublokasi; ?></td>
  </tr>
  <tr>
    <td width="90px">Golongan</td>
    <td width="10px">:</td>
    <td><?php //echo $id_golongan; ?></td>
  </tr>
  <tr>
    <td width="90px">Status Pegawai</td>
    <td width="10px">:</td>
    <td><?php //echo $status_pegawai; ?></td>
  </tr>
  <tr>
    <td width="90px">Jenis Kelamin</td>
    <td width="10px">:</td>
    <td><?php //echo $jenis_kelamin; ?></td>
  </tr>
</table> -->

<table border="1" class='wbo' width='99%' cellspacing="0" cellpadding="0px" style="font-size: 9px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
<thead style="background-color: #63eb47 !important;">
  <tr align="center" height='32px' style="background-color: #63eb47 !important;">
    <td style="padding:3px;" align='center'>No</td>
    <td style="padding:3px;" align='center'>Nama</td>
    <td style="padding:3px;" align='center'>NIP</td>
    <td style="padding:3px;" align='center'>NRK</td>
    <td style="padding:3px;" align='center'>Jenis Kelamin</td>
    <td style="padding:3px;" align='center'>Status Pegawai</td>
    <td style="padding:3px;" align='center'>Golongan</td>
    <td style="padding:3px;" align='center'>Lokasi Kerja</td>
    <td style="padding:3px;" align='center'>Sub Lokasi Kerja</td>
  </tr>
  </thead>
  <tbody>
<?php
$no = 0;
  foreach ($cetak as $rows) { $no++; 

?> 
    <tr>
    <td style="padding:3px;" align="center"><?php echo $no; ?></td>
    <td style="padding:3px;" align="left"><?php echo $rows->nama_pegawai; ?></td>
    <td style="padding:3px;" align="center"><?php echo $rows->nip; ?></td>
    <td style="padding:3px;" align="center"><?php echo $rows->nrk; ?></td>
    <td style="padding:3px;" align="center"><?php echo $rows->jenis_kelamin; ?></td>
    <td style="padding:3px;" align="center"><?php echo $rows->nama_status; ?></td>
    <td style="padding:3px;" align="center"><?php echo $rows->golongan; ?></td>
    <td style="padding:3px;" align="center"><?php echo $rows->lokasi_kerja; ?></td>
    <td style="padding:3px;" align="center"><?php echo $rows->sublokasi_kerja; ?></td>
  </tr>
  <?php } ?>
  </tbody>
</table>
