<?php
$pdf = new TCPDF('P', 'cm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pegawai->nama_pegawai);
$pdf->SetTitle('Surat Keterangan Pegawai '.ucwords(strtolower($pegawai->nama_pegawai)));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
// $pdf->SetTopMargin(1.54);
// $pdf->SetFooterMargin(2.54);
// $pdf->SetLeftMargin(2.54);
// $pdf->SetRightMargin(2.54);
// $pdf->SetCellPadding(0);

$pdf->SetTopMargin(1.27);
$pdf->SetFooterMargin(2.54);
$pdf->SetLeftMargin(2.31);
$pdf->SetRightMargin(2.31);
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

$Qdata_pengajuan = $this->db->query("SELECT * FROM tbl_master_jenis_pengajuan_surat WHERE kode = '$surat->jenis_pengajuan_surat'")->row();

if($surat->jenis_pengajuan_surat=='A'){
  $keterangan_p_surat = $Qdata_pengajuan->keterangan;
} elseif($surat->jenis_pengajuan_surat=='X') {
  $keterangan_p_surat = $surat->jenis_pengajuan_surat_lainnya;
} else {
  $keterangan_p_surat = $Qdata_pengajuan->keterangan;
}
if($pegawai->dinas=='1'){
  $adalahpns = strtoupper(strtolower('DINAS CIPTA KARYA, TATA RUANG DAN PERTANAHAN PROVINSI DKI JAKARTA'));
} else {
  $adalahpns = strtoupper(strtolower($pegawai->lokasi_kerja));
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
    width: 2.5cm;
  }
  .header1 {
    font-size:10;
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
    font-size: 12;
    text-align: left;
    width: 100%;
  }
  .table-main {
    width: 150mm;
    border-spacing: 5px;
    padding: 0;
    font-size: 12;
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
</style>
<div class="wrapper">
<img src="'.K_PATH_IMAGES.'logo-jayaraya.png" height="70px" />
  <p class="header2">'.$pegawai->kop_surat.'</p>
  <p class="header2">
    SURAT KETERANGAN<br />
    <span class="header3">&nbsp;&nbsp;&nbsp;NOMOR : '.$surat->nomor_surat.'</span>
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
        <td class="var">Unit / Satuan Kerja</td>
        <td class="sel">:</td>
        <td class="val">'.(isset($penandatangan->unit_satuan_kerja) ? $penandatangan->unit_satuan_kerja : '').'</td>
      </tr>
    </table>
    <p>Menerangkan bahwa pegawai tersebut di bawah ini : </p>
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
        <td class="val">'.ucwords(strtolower($jabatan_modify)).'</td>
      </tr>
      <tr>
        <td class="space"></td>
        <td class="var">Unit / Satuan Kerja</td>
        <td class="sel">:</td>
        <td class="val">'.$pegawai->unit_satuan_kerja.'</td>
      </tr>
    </table>
    <p>Adalah benar Pegawai Negeri Sipil '.str_replace("<br>"," ",$pegawai->unit_satuan_kerja).'.</p>
    <p>Demikian surat keterangan ini dibuat, untuk persyaratan '.ucwords(strtolower($keterangan_p_surat)).'.</p>
    <br /><br />



    <table>
      <tr>
        <td class="sign-left" width="280"></td>
        <td class="sign-right" width="280">Jakarta,&nbsp;'.$Tanggal_indo.'</td>
      </tr>
      <tr>
        <td class="sign-left" width="280"></td>
        <td class="sign-right" width="280">
          '.$ket_ttd.'<br />
        </td>
      </tr>';

      if ($signature != '') {
        //$pdf->SetLineWidth( 1 );
        //$html .= '<tr><td colspan="2" class="sign-space-signature">&nbsp;</td></tr>';
        //pdf->Image('images/image_demo.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
        $html .= '<!--<tr><td colspan="2" class="sign-space-signature">&nbsp;</td></tr>-->';
        $html .= '	<tr>
                    	<td class="sign-left" width="280">
                  	</td>
					<td class="sign-right" width="280">
                    	<img src="'.$signature.'" height="70px" />
					</td>
				</tr>';
      }
      else {
        $html .= '<tr><td colspan="2" class="sign-space">&nbsp;</td></tr>';
      }

      $html .= '<tr><td colspan="2" class="sign-space" height="0">&nbsp;</td></tr>
      <tr>
        <td class="sign-left" width="280"></td>
        <td class="sign-right" width="280">
          '.(isset($penandatangan->nama_pegawai) ? ucwords(strtolower($penandatangan->nama_pegawai)) : '').'<br />
          NIP. '.(isset($penandatangan->nip) ? $penandatangan->nip : '').'
        </td>
      </tr>
    </table>
  </div>
</div>
';

$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$filename = 'surat_keterangan_'.str_replace(' ','_',strtolower($pegawai->nama_pegawai)).'.pdf';
$pdf->Output($filename, 'I');
