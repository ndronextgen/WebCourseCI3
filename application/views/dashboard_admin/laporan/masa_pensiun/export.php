<?php
$nama_file = date('Y-m-d')."_laporan_pegawai_masa_pensiun.xls";    
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
<td align="center"><b>Laporan Pegawai Masa Pensiun</b></td>
</tr>

<tr>
<td></td>
</tr>

<tr>
<td></td>
<td>
  <table cellpadding="8" style="border-collapse:collapse;" border="1">
      <tr height="40" style="background-color:#EA7D57;">
        <th>No.</th>
        <th>NRK</th>
        <th>NIP</th>
        <th>Nama Pegawai</th>
        <th>Tanggal Lahir</th>
        <th>Usia</th>
        <th>Tanggal Pensiun</th>
      </tr>
	<?php
    $no=1;
		foreach($data->result_array() as $dp)
		{
			if ($dp['masa_pensiun_bln'] <= 6) {
				$rowstyle = 'style="background-color:red;"';
			}
			else {
				$rowstyle = '';
			}
	?>
      <tr <?php echo $rowstyle; ?>>
        <td class="str"><?php echo $no; ?></td>
        <td class="str"><?php echo $dp['nip']; ?> </td>
        <td class="str"><?php echo $dp['nrk']; ?> </td>
        <td class="str"><?php echo $dp['nama_pegawai']; ?></td>
        <td class="str"><?php echo convertDateIndo($dp['str_tgl_lahir']); ?></td>
        <td class="str"><?php echo $dp['usia']; ?> Tahun</td>
        <td class="str"><?php echo convertDateIndo($dp['tgl_pensiun']); ?></td>
      </tr>
	 <?php
	 		$no++;
	 	}
	 ?>
  </table>
</td>
</tr>
</table>