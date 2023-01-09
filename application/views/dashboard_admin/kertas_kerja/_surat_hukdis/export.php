<?php
$pdf = new TCPDF('P', 'cm', 'F4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pegawai->nama_pegawai);
$pdf->SetTitle('Surat Keterangan Hukuman Disiplin ' . ucwords(strtolower($pegawai->nama_pegawai)));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
$pdf->SetTopMargin(1.52);
$pdf->SetFooterMargin(6.75);
$pdf->SetLeftMargin(2.54);
$pdf->SetRightMargin(2.54);
$pdf->SetCellPadding(0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0.5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
	require_once(dirname(__FILE__) . '/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();

// === format lokasi kerja kadis ===
$kadis_lokasi = ucwords(strtolower($kadis->lokasi_kerja));
$kadis_lokasi = str_replace('Dan', 'dan', $kadis_lokasi);
$kadis_lokasi = str_replace('Dki', 'DKI', $kadis_lokasi);

// === format lokasi kerja pegawai ===
$pegawai_lokasi = ucwords(strtolower($pegawai->lokasi_kerja));
$pegawai_lokasi = str_replace('Dan', 'dan', $pegawai_lokasi);
$pegawai_lokasi = str_replace('Dki', 'DKI', $pegawai_lokasi);

// === format tanggal ===
$ci = &get_instance();
$ci->load->library('func_table');
$tgl_surat = date_format(date_create($surat->tanggal_pengajuan), 'd');
$bln_surat = date_format(date_create($surat->tanggal_pengajuan), 'm');
$bln_surat = $ci->func_table->getBulan($bln_surat);
$thn_surat = date_format(date_create($surat->tanggal_pengajuan), 'Y');
$tanggal_surat = $tgl_surat . ' ' . $bln_surat . ' ' . $thn_surat;

// === penutup ===
switch ($surat->id_tipe_surat_hukdis) {
	case 1:
		$penutup = 'kenaikan pangkat.';
		break;
	case 2:
		$penutup = 'pensiun.';
		break;
	case 3:
		$penutup = 'penghargaan.';
		break;
	default:
		$penutup = '';
		break;
}

// create some HTML content
$html = '
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
		font-size: 16;
		font-weight: bold;
		font-family: Times New Roman;
	}
	.header2 {
		font-size: 12;
		font-weight: bold;
		font-family: Arial;
		/*margin-bottom: 30px;*/
	}
	.header3 {
		font-size: 12;
		font-weight: normal;
		font-family: Arial;
	}
	.content {
		font-size: 12;
		text-align: justify;
		font-family: Arial;
		width: 100%;
		line-height: 1.2;
	}
	p {
		line-height: 1.2;
	}
	table {
		width: 100%;
		border-spacing: 1px;
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
		width: 1px;
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
		/*width: 300px;*/
		width: 48%;
	}
	.sign-right {
		text-align: center;
		/*width: 300px;*/
		width: 52%;
	}
	.sign-space {
		height: 50px;
	}
</style>

<div class="wrapper">
	<img src="' . K_PATH_IMAGES . 'logo-jayaraya.png" class="logo" />
	<div class="header">' . strtoupper(strtolower($kadis->lokasi_kerja)) . '</div>
	<div class="header2">
		SURAT KETERANGAN<br />
		BELUM PERNAH DIKENAKAN HUKUMAN DISIPLIN
		<br />
		<span class="header3">
			Nomor : ' . $surat->no_surat . '
		</span>
	</div>

	<div class="content">
	
		<p>Yang bertanda tangan di bawah ini :</p>

		<table>
			<tr>
				<td class="space"></td>
				<td class="var">Nama</td>
				<td class="sel">:</td>
				<td class="val">' . ucwords(strtolower($kadis->nama_pegawai)) . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">NIP / NRK</td>
				<td class="sel">:</td>
				<td class="val">' . $kadis->nip . ' / ' . $kadis->nrk . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Pangkat / Golongan</td>
				<td class="sel">:</td>
				<td class="val">' . ucwords(strtolower($kadis->pangkat)) . ' ( ' . $kadis->golongan . ' )</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Jabatan</td>
				<td class="sel">:</td>
				<td class="val">' . ucwords(strtolower($kadis->nama_jabatan)) . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Unit Kerja</td>
				<td class="sel">:</td>
				<td class="val">' . $kadis_lokasi . '</td>
			</tr>
		</table>



		<p>Dengan ini menerangkan :</p>



		<table>
			<tr>
				<td class="space"></td>
				<td class="var">Nama</td>
				<td class="sel">:</td>
				<td class="val">' . ucwords(strtolower($pegawai->nama_pegawai)) . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">NIP / NRK</td>
				<td class="sel">:</td>
				<td class="val">' . $pegawai->nip . ' / ' . $pegawai->nrk . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Pangkat / Golongan</td>
				<td class="sel">:</td>
				<td class="val">' . ucwords(strtolower($pegawai->pangkat)) . ' ( ' . $pegawai->golongan . ' )</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Jabatan</td>
				<td class="sel">:</td>
				<td class="val">' . ucwords(strtolower($pegawai->nama_jabatan)) . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Unit Kerja</td>
				<td class="sel">:</td>
				<td class="val">' . $pegawai_lokasi . '</td>
			</tr>
		</table>

		<!--<p>
			Sampai dengan saat ini yang bersangkutan belum pernah dikenakan hukuman disiplin, 
			baik tingkat ringan, sedang, dan berat, berdasarkan Peraturan Pemerintah Nomor 53 Tahun 2010 
			dan Peraturan Pemerintah Nomor 10 Tahun 1983 jo. Peraturan Pemerintah Nomor 45 Tahun 1990.
		</p>-->
		<p>
			Sampai dengan saat ini yang bersangkutan belum pernah dikenakan hukuman disiplin baik 
			tingkat ringan/sedang/berat berdasarkan Peraturan Pemerintah Nomor 94 Tahun 2021 tentang 
			Disiplin Pegawai Negeri Sipil.
		</p>

		<!--<p>Surat keterangan ini dibuat untuk memenuhi persyaratan permohonan ' . trim($surat->penutup) . '.</p>-->
		<p>Surat keterangan ini dibuat untuk memenuhi persyaratan permohonan ' . $penutup . '</p>
		<br /><br />

		<table>
			<tr>
				<td class="sign-left"></td>
				<td class="sign-right">
					Jakarta, ' . $tanggal_surat . '<br>' .
	'</td>
			</tr>
			<tr>
				<td class="sign-left"></td>
				<td class="sign-right">' . ucwords(strtolower($kadis->nama_jabatan)) . '<br />' . str_replace('Dinas ', '', $kadis_lokasi) . '</td>
			</tr>
			<!--<tr><td colspan="2" class="sign-space">&nbsp;</td></tr>-->
			<tr>
				<td class="sign-left"></td>
				<td align="center">
                    <img src="' . $sign1url . '" height="80">
				</td>
			</tr>
			<tr>
				<td class="sign-left"></td>
				<td class="sign-right">' . ucwords(strtolower($kadis->nama_pegawai)) . '<br />NIP ' . $kadis->nip . '
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
$filename = 'surat_hukuman_disiplin_' . str_replace(' ', '_', strtolower($pegawai->nama_pegawai)) . '.pdf';
$pdf->Output($filename, 'I');
