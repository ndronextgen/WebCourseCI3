<table class='table' cellspacing='10' cellpadding='5'>
    <tr>
        <td width='180px'>Nama Lengkap</td>
        <td width='1px'>:</td>
        <td><?php echo $Data->nama_pegawai; ?></td>
        <td width='1px'>&nbsp;</td>
        <td>Jabatan Struktural</td>
        <td>:</td>
        <td><?php echo $Data->nama_jabatan; ?></td>
    </tr>
    <tr>
        <td>NIP / NRK</td>
        <td>:</td>
        <td><?php echo $Data->nip . ' / ' . $Data->nrk; ?></td>
        <td width='1px'>&nbsp;</td>
        <td>Pangkat / Golongan</td>
        <td>:</td>
        <td><?php echo $Data->uraian . ' ' . $Data->golongan; ?></td>
    </tr>
    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>:</td>
        <td><?php echo $Data->tempat_lahir . ' / ' . $this->func_table->tgl_indonesia($Data->tanggal_lahir); ?></td>
        <td width='1px'>&nbsp;</td>
        <td>Pada Unit Kerja</td>
        <td>:</td>
        <td><?php echo $Data->nama_lokasi_kerja; ?></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td><?php echo $Data->jenis_kelamin; ?></td>
        <td width='1px'>&nbsp;</td>
        <td>Masa kerja golongan</td>
        <td>:</td>
        <td>
            <?php
            $tmt_awal = date($Data->tanggal_mulai_pangkat);
            $date_now = date("Y-m-d h:i:sa");
            $datetime1 = new DateTime($tmt_awal); //start time
            $datetime2 = new DateTime($date_now); //end time
            $durasi = $datetime1->diff($datetime2);
            echo $durasi->format('%y Tahun %m Bulan');
            //echo $Data->tanggal_mulai_pangkat; 
            ?>
        </td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>:</td>
        <td><?php echo $Data->agama; ?></td>
        <td width='1px'>&nbsp;</td>
        <td>Digaji menurut</td>
        <td>:</td>
        <td>
            <select class="form-control select" name="Digaji_menurut" id="Digaji_menurut">
                <?php
                foreach ($peraturan as $d) {
                    echo "<option value='$d->nomor'";
                    echo ">$d->nomor</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Status Kepegawaian</td>
        <td>:</td>
        <td><?php echo $Data->nama_status; ?></td>
        <td width='1px'>&nbsp;</td>
        <td>Alamat / tempat tinggal</td>
        <td>:</td>
        <td><?php echo $Data->alamat; ?></td>
    </tr>

</table>