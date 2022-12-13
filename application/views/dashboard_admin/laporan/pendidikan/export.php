<?php
$nama_file = date('Y-m-d')."_laporan_pegawai_pendidikan.xls";    
header("Pragma: public");   
header("Expires: 0");   
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");     
header("Content-Type: application/force-download");     
header("Content-Type: application/octet-stream");   
header("Content-Type: application/download");   
header("Content-Disposition: attachment;filename=".$nama_file."");  
header("Content-Transfer-Encoding: binary ");
?>
<style> .str{ mso-number-format:\@; } </style>
<table>
<tr>
<td></td>
<td align="center"><b>Laporan Pegawai Berdasarkan Pendidikan Terakhir Yang Terverifikasi BKD</b></td>
</tr>
<tr>
<td></td>
<td>
  <table cellpadding="8" style="border-collapse:collapse;" border="1">
      <tr height="40" style="background-color:#EA7D57;">
        <td>Nomor</td>
        <td>NIP</td>
        <td>NRK</td>
        <td>Nama Pegawai</td>
        <td>Tempat / Tanggal Lahir</td>
        <td>Jenis Kelamin</td>
        <td>Agama</td>
        <td>Pendidikan</td>
        <td>Asal Sekolah</td>
      </tr>
	<?php
		$no=1;
		foreach($data_pegawai->result_array() as $dp)
		{
	?>
      <tr height="35">
        <td class="str"><?php echo $no; ?></td>
        <td class="str"><?php echo $dp['nip']; ?></td>
        <td class="str"><?php echo $dp['nrk']; ?></td>
        <td class="str"><?php echo $dp['nama_pegawai']; ?></td>
        <td class="str"><?php echo ($dp['tempat_lahir'] != '' ? $dp['tempat_lahir'].', ' : "").$dp['tanggal_lahir']; ?></td>
        <td class="str"><?php echo $dp['jenis_kelamin']; ?></td>
        <td class="str"><?php echo $dp['agama']; ?></td>
        <td class="str"><?php echo $dp['pendidikan_bkd']; ?></td>
        <td class="str"><?php echo $dp['asal_sekolah']; ?></td>
      </tr>
	 <?php
	 		$no++;
	 	}
	 ?>
  </table>
</td>
</tr>
</table>