<table class='table bordered' cellspacing='10' cellpadding='5'>
    <tr>
        <td width='1px'>1.</td>
        <td colspan='4'>Yang bertandatangan dibawah ini:
        </td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>a.</td>
        <td width='200px'>Nama Lengkap</td>
        <td width='1px'>:</td>
        <td><?php echo ucwords(strtolower($Data->nama_pegawai)); ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>b.</td>
        <td>NIP / Nomor Identitas</td>
        <td>:</td>
        <td><?php echo $Data->nip; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>c.</td>
        <td>Pangkat / Golongan Ruang</td>
        <td>:</td>
        <td><?php echo ucwords(strtolower($Data->uraian)) . ' ' . $Data->golongan; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>d.</td>
        <td>Jabatan / Pekerjaan</td>
        <td>:</td>
        <td><?php echo ucwords(strtolower($Data->nama_jabatan)); ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>e.</td>
        <td>Satuan Organisasi</td>
        <td>:</td>
        <td><?php echo str_replace('Dan','dan',ucwords(strtolower($Data->nama_lokasi_kerja))); ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>f.</td>
        <td>Instansi</td>
        <td>:</td>
        <td>Pemerintah Provinsi DKI Jakarta</td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>g.</td>
        <td>Tempat / Tanggal Lahir</td>
        <td>:</td>
        <td><?php echo $Data->tempat_lahir . ' / ' . $this->func_table->tgl_indonesia($Data->tanggal_lahir); ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>h.</td>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td><?php echo $Data->jenis_kelamin; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>i.</td>
        <td>Agama</td>
        <td>:</td>
        <td><?php echo $Data->agama; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>j.</td>
        <td>Alamat / tempat tinggal</td>
        <td>:</td>
        <td><?php echo ucwords(strtolower($Data->alamat)); ?></td>
    </tr>
</table>