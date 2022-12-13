<?php
ob_start();
$pdf = new TCPDF('P', 'cm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pegawai[0]['pegawai']->nama_pegawai);

$namaFile = ucwords(strtolower($pegawai[0]['pegawai']->nama_pegawai));
$title = ucwords(strtolower($pegawai[0]['pegawai']->nama_pegawai));
$hal = $pegawai[0]['hal'];
if (count($pegawai) > 1) {
	$title .= ', Cs';
	$hal .= ', Cs';
	$namaFile .= '_Cs';
}

$pdf->SetTitle('Surat Pengantar Naik Pangkat ' . $title);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
$pdf->SetTopMargin(1);
$pdf->SetFooterMargin(2.54);
$pdf->SetLeftMargin(1.54);
$pdf->SetRightMargin(2.54);
$pdf->SetCellPadding(0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set auto page breaks
// $autoBreak = 4.5;
// if (count($pegawai) >= 3) {
// 	$autoBreak = 3.6;
// } else {
// 	$autoBreak = 1;
// }
// $pdf->SetAutoPageBreak(TRUE, $autoBreak);
$pdf->SetAutoPageBreak(TRUE, 0.5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
	require_once(dirname(__FILE__) . '/lang/eng.php');
	$pdf->setLanguageArray($l);
}

//
if ($pegawai[0]['header_surat2'] == '') {
	$row_x = '2'; // mengatur gambar rowspan
	$class_x = 'header_x';
	$header2 = '';
} else {
	$row_x = '3'; // mengatur gambar rowspan
	$class_x = 'header1';
	$header2 = '<tr>
        <td class="header2">' . $pegawai[0]['header_surat2'] . '</td>
      </tr>';
}
//

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
  .header_x {
    font-size:13;
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
    width: 100mm;
  }
  .sign-right {
    text-align:center;
    width: 70mm;
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
  <div class="content">

    <table class="table-main">
      <tr>
        <td rowspan="' . $row_x . '" class="logo"><img src="' . K_PATH_IMAGES . 'logo-jayaraya.png" height="100px" /></td>
        <td class="' . $class_x . '">' . $header_surat1 . '</td>
      </tr>
      ' . $header2 . '
      <tr>
        <td class="header3">' . $pegawai[0]['header_surat3'] . '</td>
      </tr>
      <tr>
        <td colspan="2" class="kodepos">Kode Pos ' . $pegawai[0]['kodepos'] . '</td>
      </tr>
      <tr><td colspan="2" class="hr-single"></td></tr>
      <tr><td colspan="2" class="date">' . convertMonthIndo(date('m')) . ' ' . date('Y') . '<br /></td></tr>
    </table>

    <table class="table-main">
      <tr>
        <td class="var_hal">Nomor</td>
        <td class="sel_hal">:</td>
        <td class="val_hal" width="200"></td>
		<td width="20"></td>
        <td align="left" rowspan="3" class="val_kepada">' . $pegawai[0]['kepada'] . '</td>
      </tr>
      <tr>
        <td class="var_hal">Lampiran</td>
        <td class="sel_hal">:</td>
        <td class="val_hal" width="200"></td>
      </tr>
      <tr>
        <td class="var_hal">Hal</td>
        <td class="sel_hal">:</td>
        <td class="val_hal" width="200">' . $hal . '</td>
      </tr>
      <tr><td colspan="5">&nbsp;</td></tr>
      <tr>
        <td colspan="5">Yang bertanda tangan di bawah ini, ' . str_replace('Informasi<br>', 'Informasi ', $pegawai[0]['ket_ttd']) . ' menerangkan bahwa :</td>
      </tr>
      <tr>
        <td colspan="5">
          <table class="table-inner">';
$i = 1;
if (count($pegawai) > 1) {
	foreach ($pegawai as $p) {
		$html .= '
              <tr>
			  	<td width="20"></td>
                <td class="cell-no">' . $i . '.</td>
                <td class="cell-name">Nama</td>
                <td class="cell-space">:</td>
                <td class="cell-val" width="360">' . ucwords(strtolower($p['pegawai']->nama_pegawai)) . '</td>
              </tr>
              <tr>
			  	<td width="20"></td>
                <td class="cell-no"></td>
                <td class="cell-name">NIP / NRK</td>
                <td class="cell-space">:</td>
                <td class="cell-val">' . $p['pegawai']->nip . ' / ' . $p['pegawai']->nrk . '</td>
              </tr>
              <tr>
			  	<td width="20"></td>
                <td class="cell-no"></td>
                <td class="cell-name">Tempat / Tgl. Lahir</td>
                <td class="cell-space">:</td>
                <td class="cell-val">' . ucwords(strtolower($p['pegawai']->tempat_lahir)) . ', ' . $p['pegawai']->tanggal_lahir . '</td>
              </tr>
              <tr>
			  	<td width="20"></td>
                <td class="cell-no"></td>
                <td class="cell-name">Pangkat / Golongan</td>
                <td class="cell-space">:</td>
                <td class="cell-val">' . ucwords(strtolower($p['pegawai']->pangkat)) . ' / ' . $p['pegawai']->golongan . '</td>
              </tr>
              <tr>
			  	<td width="20"></td>
                <td class="cell-no"></td>
                <td class="cell-name">Jabatan</td>
                <td class="cell-space">:</td>
                <td class="cell-val">' . $p['nama_jabatan'] . '</td>
              </tr>
              <tr>
			  	<td width="20"></td>
                <td class="cell-no"></td>
                <td class="cell-name">Unit Kerja</td>
                <td class="cell-space">:</td>
                <td class="cell-val">' . ucwords(strtolower($p['pegawai']->lokasi_kerja)) . '</td>
              </tr>
              <tr><td colspan="5">&nbsp;</td></tr>
              ';

		$i++;
	}
} else {
	$html .= '
            <tr>
			  	<td width="20"></td>
				<td></td>
				<td class="cell-name">Nama</td>
				<td class="cell-space">:</td>
				<td class="cell-val" width="360">' . ucwords(strtolower($pegawai[0]['pegawai']->nama_pegawai)) . '</td>
            </tr>
            <tr>
			  	<td width="20"></td>
				<td></td>
				<td class="cell-name">NIP / NRK</td>
				<td class="cell-space">:</td>
				<td class="cell-val">' . $pegawai[0]['pegawai']->nip . ' / ' . $pegawai[0]['pegawai']->nrk . '</td>
            </tr>
            <tr>
			  	<td width="20"></td>
				<td></td>
				<td class="cell-name">Tempat / Tgl. Lahir</td>
				<td class="cell-space">:</td>
				<td class="cell-val">' . ucwords(strtolower($pegawai[0]['pegawai']->tempat_lahir)) . ', ' . $pegawai[0]['pegawai']->tanggal_lahir . '</td>
            </tr>
            <tr>
			  	<td width="20"></td>
				<td></td>
				<td class="cell-name">Pangkat / Golongan</td>
				<td class="cell-space">:</td>
				<td class="cell-val">' . ucwords(strtolower($pegawai[0]['pegawai']->pangkat)) . ' / ' . $pegawai[0]['pegawai']->golongan . '</td>
            </tr>
            <tr>
			  	<td width="20"></td>
				<td></td>
				<td class="cell-name">Jabatan</td>
				<td class="cell-space">:</td>
				<td class="cell-val">' . $pegawai[0]['nama_jabatan'] . '</td>
            </tr>
            <tr>
			  	<td width="20"></td>
				<td></td>
				<td class="cell-name">Unit Kerja</td>
				<td class="cell-space">:</td>
				<td class="cell-val">' . ucwords(strtolower($pegawai[0]['pegawai']->lokasi_kerja)) . '</td>
            </tr>
            ';
}

$html .= '</table>
        </td>
      </tr>
      <tr>
        <td colspan="5">Nama tersebut adalah benar sebagai Staf di ' . ucwords(strtolower($pegawai[0]['pegawai']->lokasi_kerja)) . '.</td>
      </tr>';



// if ($pdf->getAliasNumPage() < $pdf->getAliasNbPages()) {
// 	$html .= '
// 			</table>
// 		</div>
// 	</div>
// 	';

// 	// echo $html
// 	$pdf->writeHTML($html, true, false, true, false, '');

// 	$html = '
// 	<div class="wrapper">
//   		<div class="content">
//   			<table class="table-main">
// 				<!--<tr>
// 					<td class="var_hal"></td>
// 					<td class="sel_hal"></td>
// 					<td class="val_hal" width="200"></td>
// 					<td width="20"></td>
// 					<td class="val_kepada"></td>
// 				</tr>-->

// 	  ';
// 	// page break
// 	$pdf->AddPage();
// }



$html .= '<tr>
        <td colspan="5">Demikian surat keterangan ini dibuat dengan sebenarnya dan digunakan untuk ' . $surat->keterangan . '.</td>
      </tr>
    </table>

    <br /><br />

    <table class="table-main">
      <tr>
        <td class="sign-left" width="300"></td>
        <td align="center" class="sign-right" width="300">
          ' . $pegawai[0]['ket_ttd'] . '
        </td>
      </tr>';

if ($pegawai[0]['signature'] != '') {
	$html .= '<tr><td colspan="2" class="sign-space-signature">&nbsp;</td></tr>';
	$html .= '	<tr>
					<td class="sign-left" width="300"></td>
					<td align="center" class="sign-right" width="300">
						<img src="' . $pegawai[0]['signature'] . '" height="70px" />
					</td>
				</tr>';
} else {
	$html .= '<tr><td colspan="2" class="sign-space">&nbsp;</td></tr>';
}

$nama_peg = explode(',', $pegawai[0]['penandatangan']->nama_pegawai);
$nama = count($nama_peg) > 1 ? $nama_peg[0] : $nama_peg;
$gelar = count($nama_peg) > 1 ? ', ' . $nama_peg[1] : '';

$html .= '
			<tr>
				<td class="sign-left" width="300"></td>
				<td align="center" class="sign-right" width="300">
					' . ucwords(strtolower($nama)) . $gelar . '<br />
					NIP : ' . $pegawai[0]['penandatangan']->nip . '
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
$filename = 'surat_naik_pangkat_' . str_replace(' ', '_', $namaFile) . '.pdf';
ob_end_clean();
$pdf->Output($filename, 'I');
