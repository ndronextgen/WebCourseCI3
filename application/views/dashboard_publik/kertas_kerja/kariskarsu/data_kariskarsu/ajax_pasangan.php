<table class='table no-border' cellspacing='10' cellpadding='5'>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>a.</td>
        <td width='200px'>Pada Tanggal</td>
        <td width='1px'>:</td>
        <td><?php echo $this->func_table->tgl_indonesia($pasangan_temp->tanggal_nikah); ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>b.</td>
        <td>di</td>
        <td>:</td>
        <td><?php echo $pasangan_temp->tempat_nikah; ?></td>
    </tr>

    <tr>
        <td colspan='5'>telah melangsungkan perkawinan  lagi dengan wanita / pria sebagai tersebut dibawah ini :</td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>a.</td>
        <td width='200px'>Nama</td>
        <td width='1px'>:</td>
        <td><?php echo $pasangan_temp->nama_anggota_keluarga; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>b.</td>
        <td>NIP / Nomor Identitas</td>
        <td>:</td>
        <td><?php echo $pasangan_temp->nik; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>c.</td>
        <td width='200px'>Pangkat / Golongan Ruang</td>
        <td width='1px'>:</td>
        <td><?php echo $pasangan_temp->pangkat_golongan; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>d.</td>
        <td>Jabatan / Pekerjaan</td>
        <td>:</td>
        <td><?php echo $pasangan_temp->pekerjaan_sekolah; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>e.</td>
        <td>Tempat / Tanggal Lahir</td>
        <td width='1px'>:</td>
        <td><?php echo $pasangan_temp->tempat_lahir. ' / ' .$this->func_table->tgl_indonesia($pasangan_temp->tanggal_lahir_keluarga); ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>f.</td>
        <td>Agama</td>
        <td>:</td>
        <td><?php echo $pasangan_temp->agama; ?></td>
    </tr>
    <tr>
        <td width='1px'>&nbsp;</td>
        <td width='2px'>g.</td>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $pasangan_temp->alamat_new; ?></td>
    </tr>
</table>