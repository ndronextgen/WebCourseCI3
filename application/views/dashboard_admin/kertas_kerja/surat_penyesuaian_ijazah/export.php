<?php
$pdf = new TCPDF('P', 'cm', 'F4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pegawai->nama_pegawai);
$pdf->SetTitle('Surat Keterangan Pegawai '.ucwords(strtolower($pegawai->nama_pegawai)));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
$pdf->SetTopMargin(1);
$pdf->SetFooterMargin(1);
$pdf->SetLeftMargin(1);
$pdf->SetRightMargin(1);
$pdf->SetCellPadding(0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0.5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();

// create some HTML content
$html = '
<style>
  .wrapper {
    width: 100%;
    text-align: center;
    font-family: Arial;
  }
  .logo {
    width: 2cm;
    height: 2cm;
  }
  .header {
    font-size:14;
    font-weight:bold;
    font-family: Times New Roman;
  }
  .header2 {
    font-size:12;
    font-weight:bold;
  }
  .header3 {
    font-size:12;
    font-weight:normal;
  }
  .content {
    font-size: 12;
    text-align: left;
    width: 100%;
  }
  table {
    width: 100%;
    border-spacing: 5px;
    padding: 0;
    font-size: 12;
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
    width: 640px;
    text-align: justify;
  }
  .number {
    width: 15px;
  }
  .sign-left {
    width: 350px;
  }
  .sign-right {
    text-align:center;
    width: 300px;
  }
  .sign-space {
    height: 50px;
  }
</style>
<div class="wrapper">
  <img src="'.K_PATH_IMAGES.'logo-jayaraya.png" height="70px" />
  <p class="header">'.$header_surat.'</p>
  <p class="header2">
    SURAT KETERANGAN<br />
    UNTUK MENGIKUTI UJIAN PENYESUAIAN IJASAH DAN PENINGKATAN PENDIDIKAN
  </p>
  <div class="content">
    <p>Yang bertanda tangan di bawah ini :</p>
    <table>
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
        <td class="var">Unit Kerja</td>
        <td class="sel">:</td>
        <td class="val">'.(isset($penandatangan->lokasi_kerja) ? ucwords(strtolower($penandatangan->lokasi_kerja)) : '').'</td>
      </tr>
    </table>
    <p>Dengan ini menerangkan bahwa : </p>
    <table>
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
        <td class="val">'.ucwords(strtolower($pegawai->nama_jabatan)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Unit Kerja</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($pegawai->lokasi_kerja)).'</td>
      </tr>
    </table>
    <p>Dengan ini menyatakan bahwa yang bersangkutan :</p>
    '.$ket.'
    <p>Demikian surat keterangan ini dibuat, untuk persyaratan '.$surat->penutup.'.</p>
    <br />
    <table width="100%">
      <tr>
        <td class="sign-left"></td>
        <td class="sign-right">Jakarta,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date('Y').'</td>
      </tr>
      <tr>
        <td class="sign-left"></td>
        <td class="sign-right">
          '.$ket_ttd.'
        </td>
      </tr>
      <tr><td colspan="2" class="sign-space">&nbsp;</td></tr>
      <tr>
        <td class="sign-left"></td>
        <td class="sign-right">
          '.(isset($penandatangan->nama_pegawai) ? ucwords(strtolower($penandatangan->nama_pegawai)) : '').'<br />
          NIP : '.(isset($penandatangan->nip) ? $penandatangan->nip : '').'
        </td>
      </tr>
    </table>
  </div>
</div>
';
// echo $html;
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$filename = 'surat_keterangan_'.str_replace(' ','_',strtolower($pegawai->nama_pegawai)).'.pdf';
$pdf->Output($filename, 'I');
?>