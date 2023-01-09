<?php
$pdf = new TCPDF('P', 'cm', 'F4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pegawai->nama_pegawai);
$pdf->SetTitle('Surat Keterangan Pegawai ' . ucwords(strtolower($pegawai->nama_pegawai)));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
$pdf->SetTopMargin(1.5);
$pdf->SetFooterMargin(2.54);
$pdf->SetLeftMargin(1.6);
$pdf->SetRightMargin(1.6);
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
$kadis_lokasi = str_replace('Dinas ', '', $kadis_lokasi);

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

// create some HTML content
$html = '
<style>
	.wrapper {
		width: 100%;
		text-align: center;
		font-family: Arial;
	}
	.logo {
		width: 3.45cm;
		height: 3.27cm;
	}
	.header {
		font-size:14;
		font-weight:bold;
		font-family: Arial;
	}
	.header2 {
		font-size:12;
		font-weight:bold;
		font-family: Arial;
		line-height: 1;
	}
	.header3 {
		font-size:12;
		font-weight:normal;
		font-family: Arial;
	}
	.content {
		font-size: 12;
		font-family: Arial;
		text-align: justify;
		width: 100%;
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
		/*width: 350px;*/
		width: 52%;
	}
	.sign-right {
		text-align:center;
		/*width: 300px;*/
		width: 48%;
	}
	.sign-space {
		height: 50px;
	}
	.keterangan {
		text-align: justify;
		text-justify: inter-word;
		/*line-height: 1.6;*/
		line-height: 1.2;
	}
</style>

<div class="wrapper">
	<img src="' . K_PATH_IMAGES . 'logo-jayaraya.png" class="logo" />
	<!--<p class="header">' . $header_surat . '</p>-->
	<p class="header">DINAS ' . str_replace('PERTANAHAN ', 'PERTANAHAN<br>', strtoupper($kadis_lokasi)) . '</p>
	<p class="header2">
		SURAT PERNYATAAN
		TIDAK SEDANG MENJALANI PROSES PIDANA ATAU PERNAH DIPIDANA PENJARA
		BERDASARKAN PUTUSAN PENGADILAN YANG TELAH BERKEKUATAN HUKUM TETAP
	</p>
	<p class="header3">
	NOMOR : ' . $surat->no_surat . '
	</p>

	<div class="content">
		<p>Yang bertanda tangan di bawah ini :</p>

		<table>
			<tr>
				<td class="space"></td>
				<td class="var">Nama</td>
				<td class="sel">:</td>
				<td class="val">' . (isset($kadis->nama_pegawai) ? ucwords(strtolower($kadis->nama_pegawai)) : '') . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">NIP / NRK</td>
				<td class="sel">:</td>
				<td class="val">' . (isset($kadis->nip) ? $kadis->nip . ' / ' . $kadis->nrk : '') . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Pangkat / Golongan</td>
				<td class="sel">:</td>
				<td class="val">' . (isset($kadis->pangkat) ? ucwords(strtolower($kadis->pangkat)) . ' ( ' . $kadis->golongan . ' )' : '') . '</td>
			</tr>
			<tr>
				<td class="space"></td>
				<td class="var">Jabatan</td>
				<td class="sel">:</td>
				<td class="val">' . (isset($kadis->nama_jabatan) ? ucwords(strtolower($kadis->nama_jabatan)) : '') . ' ' . $kadis_lokasi . '</td>
			</tr>
			<!--<tr>
				<td class="space"></td>
				<td class="var">Unit Kerja</td>
				<td class="sel">:</td>
				<td class="val">' . (isset($penandatangan->lokasi_kerja) ? ucwords(strtolower($penandatangan->lokasi_kerja)) : '') . '</td>
			</tr>-->
		</table>

		<p>Dengan ini menyatakan dengan sesungguhnya, bahwa Pegawai Negeri Sipil :</p>
		
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

		<p class="keterangan">
			Tidak sedang menjalani proses pidana atau pernah dipidana penjara berdasarkan putusan 
			pengadilan yang telah berkekuatan hukum tetap karena melakukan tindak pidana kejahatan 
			jabatan atau tindak pidana kejahatan yang ada hubungannya dengan jabatan dan / pidana umum.
		</p>
		
		<p class="keterangan">
			Demikian surat keterangan ini saya buat dengan sesungguhnya dengan mengingat sumpah 
			jabatan dan apabila di kemudian hari ternyata isi surat pernyataan tidak benar yang 
			mengakibatkan kerugian Negara maka saya bersedia menanggung kerugian Negara sesuai 
			dengan ketentuan peraturan perundang-undangan dipergunakan sebagaimana mestinya.
		</p>

		<br />

		<table width="100%">
			<tr>
				<td class="sign-left"></td>
				<td class="sign-right">
					Jakarta, ' . $tanggal_surat . '<br>
					</td>
			</tr>
			<tr>
				<td class="sign-left"></td>
				<td class="sign-right">
					<!--' . $ket_ttd . '-->
					' . ucwords(strtolower($kadis->nama_jabatan)) . '<br />' . $kadis_lokasi . ',
				</td>
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
				<td class="sign-right">
					<!--' . (isset($penandatangan->nama_pegawai) ? ucwords(strtolower($penandatangan->nama_pegawai)) : '') . '<br />
					NIP : ' . (isset($penandatangan->nip) ? $penandatangan->nip : '') . '-->
					' . ucwords(strtolower($kadis->nama_pegawai)) . '<br>NIP ' . $kadis->nip . '
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
$filename = 'surat_keterangan_' . str_replace(' ', '_', strtolower($pegawai->nama_pegawai)) . '.pdf';
$pdf->Output($filename, 'I');
