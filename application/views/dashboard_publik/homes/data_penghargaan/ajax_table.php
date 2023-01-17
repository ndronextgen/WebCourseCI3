<style type="text/css">
    table.wbo {
        border-collapse: collapse;
        border: 1px solid #595959;
        margin: 0 auto;
        padding: 10px;
        font-size: 10px;
        font-family: 'Arial Narrow', Arial, sans-serif;
    }
</style>

<div class="box-body table-responsive">
    <table border="0" cellspacing="0" cellpadding="0" width="99%" class='no-print'>
        <tr class="no-print" style="font-size: 12px; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
            <td align="left" width="5%">
                <a class="view" href='<?php echo site_url('i/modul_laporan/Kasusbaru/cetak?ctype=pdf&unite1=' . $unite1 . '&unite2=' . $unite2 . '&Tanggal=' . $Tanggal); ?>'>
                    <button name='download_tukinpdf' class="btn btn-sm btn-flat btn-danger"><i class="fa fa-file-pdf-o"></i> Download PDF</button>
                </a>
            </td>
            <td align="left">
                <a href='<?php echo site_url('i/modul_laporan/Kasusbaru/cetak?ctype=excel&unite1=' . $unite1 . '&unite2=' . $unite2 . '&Tanggal=' . $Tanggal); ?>'>
                    <button name='download_tukinexcel' class="btn btn-sm btn-flat btn-success"><i class="fa  fa-file-excel-o"></i> Download Excel</button>
                </a>
            </td>
        </tr>
    </table>
    <br>
    <table border="0" cellspacing="0" cellpadding="0" width="99%">
        <tr style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
            <td align="center" style="font-size: 14px;" colspan='12'><b>Temuan Baru Harian<br><?php echo $this->func_table->gethari(date('l', strtotime($Tanggal))) . ' ,' . $this->func_table->tgl_indonesia($Tanggal); ?></b></td>
        </tr>
    </table>
    <table border="1" class='wbo' width='99%' cellspacing="2" cellpadding="3" style="font-size: 10px; font-family: 'Arial Narrow', Arial, sans-serif;">
        <thead>
            <tr style='background-color:#d1d1d1; font-weight:bold; color:#000;height:30px;'>
                <td align='center'>x</td>
                <td align='center'>Nama</td>
                <td align='center'>Usia</td>
                <td align='center'>Jabatan</td>
                <td align='center'>Unit Kerja</td>
                <td align='center'>Terkena Tanggal</td>
                <td align='center'>Diperkirakan Terkena Penularan Dari</td>
                <td align='center'>Isoman/RS</td>
                <td align='center'>Gejala</td>
                <td align='center'>Penyakit Bawaan</td>
                <td align='center'>Langkah Unit Kerja</td>
                <td align='center'>Langkah keluarga</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            foreach ($data_unite1 as $key) {
                $no++;
                ?>
                <tr>
                    <td align='left' style='padding:2px;'><?php echo $no; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $key->NamaPegawai; ?></td>
                    <td align='center' style='padding:2px;'><?php echo $key->umur; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $key->Jabatan; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $key->Unite1 . '-' . $key->Unite2; ?></td>
                    <td align='center' style='padding:2px;'><?php echo $this->func_table->gethari(date('l', strtotime($key->Terkena_tgl))) . ' ,' . $this->func_table->tgl_indonesia($key->Terkena_tgl); ?></td>
                    <td align='center' style='padding:2px;'><?php echo $key->Penularan_dari; ?></td>
                    <td align='center' style='padding:2px;'><?php echo $key->JenisPerawatan; ?></td>
                    <td align='center' style='padding:2px;'><?php echo $key->Gejala; ?></td>
                    <td align='center' style='padding:2px;'><?php echo $key->Penyakit_bawaan; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $key->Langkah_unitkerja; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $key->Langkah_keluarga; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>