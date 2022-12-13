<?php
$nama_file = date('Y-m-d')."_laporan_pegawai_ikut_pelatihan.xls";    
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
<td align="center"><b>Laporan Pegawai Yang  Pernah Tugas / Izin Belajar</b></td>
</tr>

<tr>
<td></td>
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
        <td>Status Belajar</td>
		    <td>Nomor SK</td>
        <td>Tanggal SK</td>
        <td>Sekolah</td>
        <td>Akreditasi</td>
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
        <td class="str"><?php echo $dp['uraian']; ?></td>
        <td class="str"><?php echo $dp['no_sk']; ?></td>
		    <td class="str"><?php echo $dp['tgl_sk']; ?></td>
		    <td class="str"><?php echo $dp['sekolah']; ?></td>
        <td class="str"><?php echo $dp['akreditasi']; ?></td>
      </tr>
	 <?php
	 		$no++;
	 	}
	 ?>
  </table>
</td>
</tr>
</table>