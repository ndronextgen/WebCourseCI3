<?php
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage('P', '', '', '', '', 25, 10, 10, 10, 18, 12);
//$mpdf->cacheTables = true;
$mpdf->simpleTables=true;
$mpdf->packTableData=true;
$mpdf->SetTitle($pegawai->nama_pegawai);

$mpdf->SetWatermarkText('DCKTRP');
$mpdf->showWatermarkText = false;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->showImageErrors = true;

$Qdata_pengajuan = $this->db->query("SELECT * FROM tbl_master_jenis_pengajuan_surat WHERE kode = '$surat->jenis_pengajuan_surat'")->row();

if($surat->jenis_pengajuan_surat=='A'){
  $keterangan_p_surat = $Qdata_pengajuan->keterangan;
} elseif($surat->jenis_pengajuan_surat=='X') {
  $keterangan_p_surat = $surat->jenis_pengajuan_surat_lainnya;
} else {
  $keterangan_p_surat = $Qdata_pengajuan->keterangan;
}


// - untuk format surat si pemohon, berlaku untuk 
//   - jika dia ststu jabatan = pelaksana; maka yg diambil adalah 
//     status jabatan + seksi/subag/satlak (co. Pelaksana Sektor Dinas Cipta Karya TT Ruang)
//   - jika dia ststu jabatan = Struktural; maka yg diambil adalah nama jabatan tok.
//   co. kepala subbagian umum
if($pegawai->id_status_jabatan=='6'){ //pelaksana
  $jabatan_modify = 'Pelaksana '.$pegawai->sub_lokasi_kerja;
} else {
  $jabatan_modify = $pegawai->nama_jabatan;
}

// create some HTML content
$html = '
<style>
p {
  font-family: Arial;
  font-size:12px;
}
  .wrapper {
    width: 100%;
    text-align: center;
    font-family: Arial;
  }
  .logo {
    width: 2.5cm;
  }
  .header1 {
    font-size:12;
    font-weight:bold;
    font-family: Arial;
    text-align:center;
    width:100%;
  }
  .header2 {
    font-size:14;
    font-weight:bold;
    font-family: Arial;
    margin-bottom: 30px;
    text-align:center;
    width:100%;
  }
  .header3 {
    font-size:11;
    font-family: Arial;
    font-weight:normal;
    text-align:center;
    width:100%;
  }
  .hr-single {
    border-top: 3px solid #000000;
  }
  .kodepos {
    font-size:9;
    font-family: Arial;
    font-weight:normal;
    text-align:right;
    border-bottom: 1px solid #000000;
  }
  .date {
    text-align:right;
  }
  .content {
    font-size: 12px;
    text-align: left;
    width: 100%;
  }
  .table-main {
    width: 150mm;
    border-spacing: 5px;
    padding: 0;
    font-size: 12px;
    text-align: justify;
  }
  .var_hal {
    width: 20mm;
    vertical-align: top;
  }
  .val_hal {
    width: 60mm;
    vertical-align: top;
  }
  .val_kepada {
    width: 80mm;
    text-align: center;
  }
  .sel_hal {
    width: 3mm;
    vertical-align: top;
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
    width: 70mm;
  }
  .sign-right {
    text-align:center;
    width: 110mm;
  }
  .sign-space {
    height: 50px;
  }
  .table-inner {
    border-spacing: 3px;
    width: 280mm;
  }
  .cell-no {
    width: 10mm;
    vertical-align: top;
  }
  .cell-name {
    width: 40mm;
    vertical-align: top;
  }
  .cell-space {
    width: 3mm;
    vertical-align: top;
  }
  .cell-val {
    text-align: justify;
    vertical-align: top;
  }
  table.wbo {
    margin: 0 auto;
    padding:10px;
    font-size:12px;
    font-family: Arial;
  }
  table.wbo2 {
    border-collapse: collapse;
    border: 1px solid #595959;
    margin: 0 auto;
    padding:10px;
    font-size:12px;
    font-family: Arial;
  }
  .parent {
    position: relative;
    top: 0;
    left: 0;
  }
  .image1 {
    position: absolute;
    z-index: 0;
    margin-bottom:150px;
    margin-top:-130px;
    margin-left:-40px;
    margin-right:100px;
    width:125px;
    height:125px;
    /* border:1px solid #000; */
  }
  .image2 {
    position: absolute;
    z-index: 0 !important;
    margin-bottom:-200px;
    margin-top:20px;
    margin-left:10px;
    margin-right:-10px;
    width:200px;
    height:150px;
  
    /* border:1px solid #000; */
  }
  * {
    box-sizing: border-box;
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
  
  .column {
    float: left;
    width: 30%;
    height: 300px; 
    text-align: center;
    position: relative;
  }
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
</style>
<div class="wrapper">
<img src="'.K_PATH_IMAGES.'logo-jayaraya.png" height="70px" />
  <p class="header2">'.$pegawai->kop_surat.'</p>
  <p class="header2">
    SURAT KETERANGAN<br />
    <span class="header3">NOMOR : '.$surat->nomor_surat.'</span>
  </p>
  <div class="content">
    <p>Yang bertanda tangan di bawah ini :</p>
    <table style="font-size:12px; font-family:Arial;">
      <tr>
        <td class="space"></td>
        <td class="var">Nama</td>
        <td class="sel">:</td>
        <td class="val">'.(isset($penandatangan->nama_pegawai) ? ucwords(strtolower($penandatangan->nama_pegawai)) : '').'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">NIP / NRK</td>
        <td class="sel">:</td>
        <td class="val">'.(isset($penandatangan->nip) ? $penandatangan->nip.' / '.$penandatangan->nrk : '').'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Pangkat / Golongan</td>
        <td class="sel">:</td>
        <td class="val">'.(isset($penandatangan->pangkat) ? ucwords(strtolower($penandatangan->pangkat)).' ( '.$penandatangan->golongan.' )' : '').'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Jabatan</td>
        <td class="sel">:</td>
        <td class="val">'.(isset($penandatangan->nama_jabatan) ? ucwords(strtolower($penandatangan->nama_jabatan)) : '').'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var" valign="top">Unit / Satuan Kerja</td>
        <td class="sel" valign="top">:</td>
        <td class="val" valign="top">'.(isset($penandatangan->unit_satuan_kerja) ? $penandatangan->unit_satuan_kerja : '').'</td>
      </tr>
    </table>
    <p>Menerangkan bahwa pegawai tersebut di bawah ini : </p>
    <table style="font-size:12px; font-family:Arial;">
      <tr>
        <td class="space"></td>
        <td class="var">Nama</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($pegawai->nama_pegawai)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">NIP / NRK</td>
        <td class="sel">:</td>
        <td class="val">'.$pegawai->nip.' / '.$pegawai->nrk.'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Pangkat / Golongan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($pegawai->pangkat)).' ( '.$pegawai->golongan.' )</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Jabatan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($jabatan_modify)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var" valign="top">Unit / Satuan Kerja</td>
        <td class="sel" valign="top">:</td>
        <td class="val" valign="top">'.$pegawai->unit_satuan_kerja.'</td>
      </tr>
    </table>
    <p>Adalah benar Pegawai Negeri Sipil '.str_replace("<br>"," ",$pegawai->unit_satuan_kerja).'.</p>
    <p>Demikian surat keterangan ini dibuat, untuk persyaratan '.ucwords(strtolower($keterangan_p_surat)).'.</p><br><br><br>';


    $html .='<div class="row">
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
  </div>';

  $html .='</div>
</div>
';

//generate the PDF from the given html
$mpdf->WriteHTML($html);
$mpdf->Output($pegawai->nama_pegawai.'.pdf', 'I');
?>
