<?php
$kalimat ="<p>Bahwa pegawai tersebut diatas saat ini tidak sedang menjalani tugas belajar dan ikatan dinas dari Badan Pengembangan Sumber Daya Manusia Provinsi DKI Jakarta.</p>
<p>Demikian surat keterangan ini dibuat untuk kelengkapan berkas permohonan pindah tugas ke ".$Data_pindah_tugas->Keterangan."</p>";



echo $html = '
<style>
  .wrapper {
    width: 100%;
    text-align: center;
    font-family: Arial;
  }
  .logo {
		width: 1.99cm;
		height: 1.88cm;
  }
  .header {
    font-size:16;
    font-weight:bold;
    font-family: Times New Roman;
  }
  .header2 {
    font-size:12;
    font-weight:bold;
    margin-bottom: 30px;
  }
  .header3 {
    font-size:12;
    font-weight:normal;
  }
  .content {
    font-size: 12;
    text-align: left;
    width: 100%;
    font-family: Arial;
    text-align: justify;
  }
  table {
    width: 100%;
    border-spacing: 1px;
    padding: 0;
    font-size: 12;
    font-family: Arial;
    text-align: justify;
  }
  .var {
    width: 150px;
  }
  .sel {
    width: 15px;
  }
  .val {
    text-align: justify;
    float: left;
    width: 383px;
    line-height:1.8;
  }
  .space {
    width: 20px;
  }
  .list {
    padding-left: 0;
  }
  .list-content {
    width: 560px;
    text-align: justify;
  }
  .number {
    width: 15px;
  }
  .sign-left {
    width: 300px;
  }
  .sign-right {
    text-align:center;
    width: 300px;
  }
  .sign-space {
    height: 50px;
  }
  .image1 {
    position: absolute;
    z-index: 0;
    margin-bottom:150px;
    margin-top:-130px;
    margin-left:-140px;
    margin-right:20px;
    width:125px;
    height:125px;
    /* border:1px solid #000; */
  }
  .image_sign {
    position: relative;
    z-index: 0 !important;
    /* margin-bottom:-180px; */
    /* margin-top:150px; */
    margin-left:10px;
    margin-right:-10px;
    width:auto;
    height:120px !important;
  
    /* border:1px solid #000; */
  }
  .image_sign_pegawai {
    position: relative;
    z-index: 0 !important;
    margin-left:10px;
    margin-right:-10px;
    width:auto;
    height:130px !important;
  
    /* border:1px solid #000; */
  }
  * {
    box-sizing: border-box;
  }
  
  .column {
    float: left;
    width: 30%;
    height: 100px; 
    text-align: center;
    position: relative;
    border:1px #000 solid;
  }
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
</style>
<div class="wrapper">
<img src="'.K_PATH_IMAGES.'logo-jayaraya.png" class="logo" />
  <p class="header">'.str_replace('PERTANAHAN ','PERTANAHAN<br>',strtoupper($kadis->lokasi_kerja)).'</p>
  <p class="header2">
    SURAT KETERANGAN<br />
    TIDAK SEDANG MENJALANI TUGAS BELAJAR DAN IKATAN DINAS
    <br />
    <span class="header3">
    NOMOR : '.$Data_pindah_tugas->Nomor_surat.'
    </span>
  </p>
  <div class="content">
    <p>Yang bertanda tangan di bawah ini :</p>
    <table>
      <tr>
        <td class="space"></td>
        <td class="var">Nama</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($kadis->nama_pegawai)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">NIP / NRK</td>
        <td class="sel">:</td>
        <td class="val">'.$kadis->nip.' / '.$kadis->nrk.'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Pangkat / Golongan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($kadis->pangkat)).' ( '.$kadis->golongan.' )</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Jabatan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($kadis->nama_jabatan)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var" valign="top">Unit Kerja</td>
        <td class="sel" valign="top">:</td>
        <td class="val" valign="top">'.str_replace('Dan','dan',str_replace('Dki','DKI',ucwords(strtolower($kadis->lokasi_kerja)))).'</td>
      </tr>
    </table>
    <p>Dengan ini menyatakan dengan sesungguhnya, bahwa : </p>
    <table>
      <tr>
        <td class="space"></td>
        <td class="var">Nama</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($Data->nama_pegawai)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">NIP / NRK</td>
        <td class="sel">:</td>
        <td class="val">'.$Data->nip.' / '.$Data->nrk.'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Pangkat / Golongan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($Data->uraian)).' ( '.$Data->golongan.' )</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Jabatan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($Data->nama_jabatan)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var" valign="top">Unit Kerja</td>
        <td class="sel" valign="top">:</td>
        <td class="val" valign="top">'.str_replace('Dan','dan',str_replace('Dki','DKI',ucwords(strtolower($Data->nama_lokasi_kerja)))).'</td>
      </tr>
    </table>
    '.trim($kalimat).'
    <br /><br />

  ';


echo $html ='<div class="row">
    <div class="column" style="width:40%;">
      
    </div>
    <div class="column" style="width:15%;"></div>
    <div class="column" style="width:40%;">
    <img class="image_sign" src="'.$signature.'">
      <p style="position:absulute;z-index:21 !important;margin-top:-150px;">
        Jakarta,&nbsp;'.$Tanggal_indo.'<br>
        '.$ket_ttd.'<br><br><br><br>
        
        '.(isset($penandatangan->nama_pegawai) ? ucwords(strtolower($penandatangan->nama_pegawai)) : '').'<br>
        NIP. '.(isset($penandatangan->nip) ? $penandatangan->nip : '').'<br><br>
        <img class="image1" src="'.$stamp.'"><br>
        
      </p>
      
    </div>
  </div>
  
  </div>
</div>';
  ?>