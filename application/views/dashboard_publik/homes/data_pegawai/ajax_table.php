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
                <a class="view" href='<?php echo site_url('i/modul_laporan/Jenisrawat/cetak?ctype=pdf&unite1=' . $unite1 . '&unite2=' . $unite2 . '&JenisPerawatan=' . $JenisPerawatan); ?>'>
                    <button name='download_tukinpdf' class="btn btn-sm btn-flat btn-danger"><i class="fa fa-file-pdf-o"></i> Download PDF</button>
                </a>
                <!-- <button name='download_tukinpdf' onclick="myFunction()" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-file-pdf-o"></i> Download PDF</button> -->
            </td>
            <td align="left">
                <a href='<?php echo site_url('i/modul_laporan/Jenisrawat/cetak?ctype=excel&unite1=' . $unite1 . '&unite2=' . $unite2 . '&JenisPerawatan=' . $JenisPerawatan); ?>'>
                    <button name='download_tukinexcel' class="btn btn-sm btn-flat btn-success"><i class="fa  fa-file-excel-o"></i> Download Excel</button>
                </a>
                <!-- <button name='download_tukinexcel' onclick="myFunction()" class="btn btn-sm btn-flat btn-success"><i class="fa  fa-file-excel-o"></i> Download Excel</button> -->
            </td>
        </tr>
    </table>

    <br>

    <table border="0" cellspacing="0" cellpadding="0" width="99%">
        <tr style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
            <td align="center" style="font-size: 14px;"><b>DATA PEGAWAI KLHK TERKONFIRMASI COVID+ YANG <?php echo $JenisPerawatan; ?> <br><?php echo $this->func_table->gethari(date('l', strtotime($Tanggal))) . ' ,' . $this->func_table->tgl_indonesia($Tanggal); ?></b></td>
        </tr>
    </table>

    <table border="1" class='wbo' width='99%' cellspacing="2" cellpadding="3" style="font-size: 10px; font-family: 'Arial Narrow', Arial, sans-serif;">
        <tr style='background-color:#d1d1d1; font-weight:bold; color:#000;'>
            <td rowspan="3" align='center'>x</td>
            <td rowspan="3" align='center'>Nama Unite </td>
            <td colspan="9" align='center'>Data ASN </td>
            <td rowspan="3" align='center'>Kronologis Singkat </td>
            <td rowspan="3" align='center'>Penanganan</td>
        </tr>
        <tr style='background-color:#d1d1d1; font-weight:bold; color:#000;'>
            <td rowspan="2" align='center'>Nama</td>
            <td rowspan="2" align='center'>NIP</td>
            <td rowspan="2" align='center'>Jab</td>
            <td colspan="5" align='center'>Klasifikasi Kaus </td>
            <td rowspan="2" align='center'>Meninggal</td>
        </tr>
        <tr style='background-color:#d1d1d1; font-weight:bold; color:#000;'>
            <td align='center'>Tanpa Gejala </td>
            <td align='center'>Kasus Ringan </td>
            <td align='center'>Kasus Sedang </td>
            <td align='center'>Kasus Berat </td>
            <td align='center'>Kasus Kritis </td>
        </tr>
        <tr style='font-size:10px; background-color:#e3e3e3;'>
            <td align='center'>1</td>
            <td align='center'>2</td>
            <td align='center'>3</td>
            <td align='center'>4</td>
            <td align='center'>5</td>
            <td align='center'>6</td>
            <td align='center'>7</td>
            <td align='center'>8</td>
            <td align='center'>9</td>
            <td align='center'>10</td>
            <td align='center'>11</td>
            <td align='center'>12</td>
            <td align='center'>13</td>
        </tr>
        <?php
        $no = 0;
        foreach ($data_unite1 as $key) {
            $no++
            ?>
            <tr align='center' style='background-color:#fff5bf;font-size:14; font-weight:bold;color:#000;'>
                <td align='center'><?php echo $no; ?></td>
                <td><?php echo $key->E1Akronim; ?></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo $key->jml_covid_tg; ?></td>
                <td><?php echo $key->jml_covid_tr; ?></td>
                <td><?php echo $key->jml_covid_ts; ?></td>
                <td><?php echo $key->jml_covid_tb; ?></td>
                <td><?php echo $key->jml_covid_tk; ?></td>
                <td><?php echo $key->jml_covid_meninggal; ?></td>
                <td>-</td>
                <td>-</td>
            </tr>
            <?php $ni = 0;
                //Unite e2
                if ($unite2 == "") {
                    $kond_unite2 = "";
                } else {
                    $kond_unite2 = " AND tbl_covid.Unite2 = '$unite2'";
                }

                if ($JenisPerawatan == '') {
                    $kond_JenisPerawatan = '';
                } else {
                    $kond_JenisPerawatan = " AND tbl_covid.JenisPerawatan = '$JenisPerawatan'";
                }
                $sql = $this->db->query("SELECT * FROM tbl_covid WHERE Unite1='$key->Unite1' $kond_unite2 $kond_JenisPerawatan ORDER BY Unite1 DESC, Unite2 ASC")->result();
                foreach ($sql as $row) {
                    $ni++;
                    $number = $no . '.' . $ni;
                    if ($row->JenisKasus == 'Tanpa Gejala') {
                        $tg = '√';
                    } else {
                        $tg = '';
                    }
                    if ($row->JenisKasus == 'Kasus Ringan') {
                        $kr = '√';
                    } else {
                        $kr = '';
                    }
                    if ($row->JenisKasus == 'Kasus Sedang') {
                        $ks = '√';
                    } else {
                        $ks = '';
                    }
                    if ($row->JenisKasus == 'Kasus Berat') {
                        $kb = '√';
                    } else {
                        $kb = '';
                    }
                    if ($row->JenisKasus == 'Kasus Kritis') {
                        $kk = '√';
                    } else {
                        $kk = '';
                    }
                    if ($row->StatusKondisi == 'Meninggal') {
                        $km = '√';
                    } else {
                        $km = '-';
                    }

                    ?>
                <tr align='center'>
                    <td align='left' style='padding:2px;'><?php echo $number; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $row->Unite2; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $row->NamaPegawai; ?></td>
                    <td style='padding:2px;'><?php echo $row->NIP; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $row->Jabatan; ?></td>
                    <td style='padding:2px;'><?php echo $tg; ?></td>
                    <td style='padding:2px;'><?php echo $kr; ?></td>
                    <td style='padding:2px;'><?php echo $ks; ?></td>
                    <td style='padding:2px;'><?php echo $kb; ?></td>
                    <td style='padding:2px;'><?php echo $kk; ?></td>
                    <td style='padding:2px;'><?php echo $km; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $row->Kronologis; ?></td>
                    <td align='left' style='padding:2px;'><?php echo $row->Penanganan; ?></td>
                </tr>
        <?php }
        } ?>
    </table>

</div>