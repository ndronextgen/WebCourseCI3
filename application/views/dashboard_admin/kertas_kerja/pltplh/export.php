<?php
$pdf = new TCPDF('P', 'cm', 'F4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pegawai_berhalangan->nama_pegawai);
$pdf->SetTitle('Surat Keterangan Pegawai '.ucwords(strtolower($pegawai_berhalangan->nama_pegawai)));

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

$filter_lokasi_kerja = trim(str_replace('SUKU DINAS','',$pegawai_berhalangan->lokasi_kerja));
//$filter_jabatan_berhalangan = left(str_replace('TEKNIK TATA BANGUNAN DAN PERUMAHAN AHLI MUDA SELAKU',' ',$pegawai_berhalangan->nama_jabatan));

// add a page
$pdf->AddPage();

// create some HTML content
$html = '
<style>
  .wrapper {
    width: 100%;
    text-align: center;
    font-family: Arial;
    line-height: 1.0;
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
    font-size: 11;
    text-align: justify;
    text-justify: inter-word;
    line-height: 1.0;
    text-indent: 50px;
  }
  table {
    width: 100%;
    border-spacing: 5px;
    padding: 0;
    font-size: 11;
    margin:0;
  }

  .var {
    width: 130px;
    text-align:left;
    text-indent: 27px;
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
    text-indent: 60px;
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
    width: 300px;
  }
  .sign-right {
    text-align:center;
    width: 260px;
  }
  .sign-space {
    height: 80px;
  }
  .keterangan {
    text-align: justify;
    text-justify: inter-word;
    line-height: 1.0;
  }
  .tembusan {
    text-align: justify;
    text-justify: inter-word;
    line-height: 0.1;
  }
  .listtembusan {
    text-align: justify;
    text-justify: inter-word;
    line-height: 0.3;
  }
</style>
<div class="wrapper">
  <img src="'.K_PATH_IMAGES.'logo-jayaraya.png" height="70px" />
  <p class="header">DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN <br>PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA</p>
  <p class="header2">
    SURAT PERINTAH TUGAS<br />
    NOMOR : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br><br>
    TENTANG<br>
    '.strtoupper($type_surat). ' '.strtoupper($pegawai_berhalangan->jabatan_potong).'  '.strtoupper($filter_lokasi_kerja).'
  </p>
  <div class="content">Sehubungan dengan Saudara '.(isset($pegawai_berhalangan->nama_pegawai) ? ucwords(strtolower($pegawai_berhalangan->nama_pegawai)) : '').'
  NIP/NRK '.(isset($pegawai_berhalangan->nip) ? $pegawai_berhalangan->nip.' / '.$pegawai_berhalangan->nrk : '').'
  Pangkat/Golongan '.(isset($pegawai_berhalangan->pangkat) ? ucwords(strtolower($pegawai_berhalangan->pangkat))
  .$pegawai_berhalangan->golongan:'').'
  Jabatan '.(isset($pegawai_berhalangan->nama_jabatan) ? str_replace('Dan','dan',ucwords(strtolower($pegawai_berhalangan->nama_jabatan))) : '').' '. $surat->alasan_pltplh .' 
  selama '.$surat->durasi.' ('.$jml_terbilang.') hari kerja, untuk kelancaran tugas kedinasan dengan ini Kepala Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi Daerah Khusus Ibukota Jakarta :</div>

    <p align="center">MEMERINTAHKAN :</p>
    <table border="">
      <tr>
        <td width="70px", align="left">Kepada</td>
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
        <td class="var">Pangkat / Gol</td>
        <td class="sel">:</td>
        <td class="val">'.ucwords(strtolower($pegawai->pangkat)).' ( '.$pegawai->golongan.' )</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td class="var">Jabatan</td>
        <td class="sel">:</td>
        <td class="val">'.str_replace('Dan','dan',ucwords(strtolower($pegawai->nama_jabatan))).' '
                         .str_replace('Dan','dan', str_replace('Dki','DKI',ucwords(strtolower($pegawai->lokasi_kerja)))).'</td>
      </tr>
      <tr><td colspan="5">&nbsp;</td></tr>
      <tr>
        <td width="70px;", align="left">Untuk</td>
        <td width="13px;">:</td>
        <td colspan="11" class="val2">
                        <ol style="text-align: justify;">
                        <li>Melaksanakan tugas sebagai '.$type_surat.' ' .ucwords(strtolower($pegawai_berhalangan->nama_jabatan)).' '.str_replace('Dan','dan',ucwords(strtolower($filter_lokasi_kerja))) .' disamping tugas pokoknya sebagai '.str_replace('Dan','dan',ucwords(strtolower($pegawai->nama_jabatan))).' '.str_replace('Dan','dan', str_replace('Dki', 'DKI' ,ucwords(strtolower($pegawai->lokasi_kerja)))).', terhitung mulai tanggal '.$tgl_mulai.' sampai dengan tanggal '.$tgl_selesai.'.</li><br>
                        <li>Dalam melaksanakan tugas tersebut, '.$type_surat.' tidak memiliki kewenangan untuk mengambil atau menetapkan keputusan-keputusan penting yang mengikat, seperti : Pembuatan Penilaian Prestasi Kerja PNS, penetapan surat keputusan, penjatuhan hukuman disiplin atau keputusan yang berupa kebijakan strategis.</li>
                        <br>
                        </ol>
                        </td>
      </tr>
    </table>
    <div class="content">Surat Perintah Tugas ini untuk dilaksanakan sebaik-baiknya dan penuh tanggung jawab.</div>
    <br />
    <table cellpadding="2px">
      <tr>
        <td class="sign-left"></td>
        <td align="left">
        Ditetapkan di Jakarta<br>
        Pada tanggal :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date('Y').'</td>
      </tr>
      <tr>
        <td class="sign-left"></td>
        <td align="center">
          '.$ket_ttd.'
        </td>
      </tr>
      <tr><td colspan="" class="sign-space">&nbsp;</td></tr>
      <tr>
        <td class="sign-left"></td>
        <td align = "center">
          Heru Hermawanto<br />
          NIP 196803121998031010
        </td>
      </tr>
    </table>
    <p class="tembusan">'.$tembusan.'</p>
    '.$ket.'
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