<?php
$pdf = new TCPDF('P', 'cm', 'F4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pegawai->nama_pegawai);
$pdf->SetTitle('Surat Keterangan Pegawai '.ucwords(strtolower($pegawai->nama_pegawai)));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
// $pdf->SetTopMargin(0.3);
// $pdf->SetFooterMargin(0.1929134);
// $pdf->SetLeftMargin(0.71);
// $pdf->SetRightMargin(0.71);
$pdf->SetCellPadding(0);
$pdf->SetMargins(1.8034, 0.762, 1.8034, 0.762);

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
    line-height: 1.6;
  }
  .logo {
    width: 2cm;
    height: 2cm;
  }
  .header {
    font-size:14;
    font-weight:bold;
    font-family: Arial;
  }
  .header2 {
    font-size:11;
  }
  .header3 {
    font-size:11;
    font-weight:normal;
  }
  .content {
    font-size: 12;
    text-align: justify;
    width: 100%;
    line-height: 1.6;
  }
  table {
    width: 100%;
    border-spacing: 5px;
    padding: 0;
    font-size: 12;
    margin:0;
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
    width: 300px;
  }
  .val2 {
    text-align: justify;
    float: left;
    width: 465px;
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
  .keterangan {
    text-align: justify;
    text-justify: inter-word;
    line-height: 1.6;
  }
</style>
<div class="wrapper">
  <img src="'.K_PATH_IMAGES.'logo-jayaraya.png" height="70px" />
  <p class="header">'.$header_surat.'</p>
  <p class="header2">
    SURAT PERINTAH TUGAS<br />
    NOMOR : . . . . . . . . . <br>
    TENTANG PELAKSANA HARIAN KEPALA SUKU DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN KOTA ADMINISTRASI JAKARTA PUSAT
  </p>
  <div class="content">
  &nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan Saudara '.(isset($penandatangan->nama_pegawai) ? ucwords(strtolower($penandatangan->nama_pegawai)) : '').' NIP/NRK '.(isset($penandatangan->nip) ? $penandatangan->nip.' / '.$penandatangan->nrk : '').' Jabatan '.(isset($penandatangan->nama_jabatan) ? ucwords(strtolower($penandatangan->nama_jabatan)) : '').' Cipta Karya, Tata Ruang dan Pertanahan Kota Administrasi Jakarta Pusat menjalankan cuti tahunan selama 7 (tujuh) hari kerja, untuk kelancaran tugas kedinasan dengan ini Kepala Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi Daerah Khusus Ibukota Jakarta :
    
    <p align="center">MEMERINTAHKAN </p>
    <table>
      <tr>
        <td width="110px;">Kepada</td>
        <td width="13px;">:</td>
        <td class="var">Nama</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($pegawai->nama_pegawai)).'</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td class="var">NIP / NRK</td>
        <td class="sel">:</td>
        <td class="val">'.$pegawai->nip.' / '.$pegawai->nrk.'</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td class="var">Pangkat / Golongan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($pegawai->pangkat)).' ( '.$pegawai->golongan.' )</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td class="var">Jabatan</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($pegawai->nama_jabatan)).' '.ucwords(strtolower($pegawai->lokasi_kerja)).'</td>
      </tr>
      <tr><td colspan="5">&nbsp;</td></tr>
      <tr>
        <td width="110px;">Untuk</td>
        <td width="13px;">:</td>
        <td colspan="3" class="val2"><ol style="text-align: justify;">
                        <li>Melaksanakan tugas sebagai Pelaksana Harian Kepala Suku Dinas Cipta Karya, Tata Ruang dan Pertanahan Kabupaten Administrasi Kepualaun Seribu disamping tugas pokoknya sebagai Kepala Seksi Penindakan Suku Dinas Cipta Karya, Tata Ruang dan Pertanahan Kota Administrasi Jakarta Pusat, terhitung mulai tanggal '.$tgl_mulai.' sampai dengan tanggal '.$tgl_selesai.'.</li>
                        <li>Dalam melaksanakan tugas tersebut, Pelaksana Harian tidak memiliki kewenangan untuk mengambil atau menetapkan keputusan-keputusan penting yang mengikat, seperti : Pembuatan Penilaian Prestasi Kerja PNS, penetapan surat keputusan, penjatuhan hukuman disiplin atau keputusan yang berupa kebijakan strategis.</li>
                        </ol>
                        </td>
      </tr>
    </table>
    <p class="keterangan">Surat Perintah Tugas ini untuk dilaksanakan sebaik-baiknya dan penuh tanggung jawab.</p>
    <br />
    <table width="100%">
      <tr>
        <td class="sign-left"></td>
        <td class="sign-right">
        <span style="float:right">Ditetapkan di Jakarta<br>
        Jakarta,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date('Y').'</span></td>
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
    <p class="keterangan">
      Tembusan : '.$ket.'</p>
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