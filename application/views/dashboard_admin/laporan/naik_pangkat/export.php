<?php
$nama_file = date('Y-m-d')."_laporan_pegawai_yang_akan_naik_pangkat.xls";    
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
<td align="center"><b>Laporan Pegawai yang akan Naik Pangkat</b></td>
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
        <th>Nama Pegawai</th>
        <th>NIP</th>
        <th>NRK</th>
        <th>Golongan</th>
        <th>Nama Pangkat</th>
        <th>TMT Pangkat Terakhir</th>
        <th>Tanggal Naik Pangkat</th>
      </tr>
      <?php
        if (count($data) > 0) {
          $no = 1;
          foreach ($data as $dp) {
          ?>
          <tr>
            <td class="str"><?php echo $no; ?></td>
            <td class="str"><?php echo $dp['nama_pegawai']; ?></td>
            <td class="str"><?php echo $dp['nip']; ?></td>
            <td class="str"><?php echo $dp['nrk']; ?></td>
            <td class="str"><?php echo $dp['golongan']; ?></td>
            <td class="str"><?php echo $dp['uraian']; ?></td>
            <td class="str"><?php echo convertDateIndoFromEn($dp['tmt_pangkat_terakhir']); ?></td>
            <td class="str"><?php echo convertDateIndo($dp['tgl_naik_pangkat']); ?></td>
          </tr>
          <?php
            $no++;
          }
        }
      ?>
  </table>
</td>
</tr>
</table>