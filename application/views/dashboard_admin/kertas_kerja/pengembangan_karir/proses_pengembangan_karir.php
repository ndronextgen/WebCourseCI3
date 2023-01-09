<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title"><a data-toggle="collapse" href="#detail_pengaduan"><i class="fa fa-angle-double-right"></i> Detail Surat Pengembangan Karir</a></h5>
        </div>
        <div id="detail_pengaduan" class="panel-collapse expand collapse show">



            <br>
            <h4 style='text-align: center;'>
                Surat Pengembangan Karir
            </h4>
            <input type='hidden' value='<?php echo $Pengembangan_karir_id; ?>' name='Pengembangan_karir_id' id='Pengembangan_karir_id'>
            <table class='table no-border' cellspacing='10' cellpadding='5'>
                <tr>
                    <td width='200px'>Nama Lengkap</td>
                    <td width='1px'>:</td>
                    <td><?php echo ucwords(strtolower($Data->nama_pegawai)); ?></td>
                </tr>
                <tr>
                    <td>NIP / NRK</td>
                    <td>:</td>
                    <td><?php echo $Data->nip . ' / ' . $Data->nrk; ?></td>
                </tr>
                <tr>
                    <td>Pangkat / Golongan</td>
                    <td>:</td>
                    <td><?php echo ucwords(strtolower($Data->uraian)) . ' ( ' . $Data->golongan . ' )'; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?php echo ucwords(strtolower($Data->nama_jabatan)); ?></td>
                </tr>
                <tr>
                    <td>Satuan Organisasi</td>
                    <td>:</td>
                    <td>
                        <?php
                        $lokasi = $Data->nama_lokasi_kerja;
                        $lokasi = str_replace('Dan', 'dan', ucwords(strtolower($lokasi)));
                        $lokasi = str_replace('Dki', 'DKI', ucwords(strtolower($lokasi)));
                        echo $lokasi;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?php echo $Data_pengembangan_karir->Keterangan; ?></td>
                </tr>
                <tr>
                    <td>Periode</td>
                    <td>:</td>
                    <td><?php echo $Data_pengembangan_karir->Periode_awal . ' - ' . $Data_pengembangan_karir->Periode_akhir; ?></td>
                </tr>
                <tr>
                    <td>Digunakan Untuk</td>
                    <td>:</td>
                    <td><?php echo $Data_pengembangan_karir->Keperluan; ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>

<br>
<hr>
<h4 style='text-align: center;'>
    Timeline Surat
</h4>
<br>

<?php
echo '<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="history" data-ktwizard-state="step-first">';
echo '<div class="kt-grid__item">';
echo '<div class="kt-wizard-v1__nav">';
echo '<div class="kt-wizard-v1__nav-items">';
$i = 1;

foreach ($Query_history as $hist) {
    $active = '';
    $txt = '';
    $download_file = '';

    if ($hist->Status_progress == $Data_pengembangan_karir->Status_progress) {
        $active = 'current';
    } else {
        $active = '';
    }

    echo '<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
																		<div class="kt-wizard-v1__nav-body">
																			<div class="kt-wizard-v1__nav-icon"><i class="' . $hist->style . '"></i></div>
																			<div class="kt-wizard-v1__nav-label">' . $hist->nama_status . '</div>
																			<div class="kt-wizard-v2__nav-label-desc">' . $hist->Name_user . '<br />' . $hist->Created_at . '</div>
																		</div>
																	</div>';

    $i++;
}

echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>'; ?>

<hr>

<?php
#jika bukan administrator utama
$user_type = $this->session->userdata('stts');
$id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
if (($id_lokasi_kerja == '0' || $id_lokasi_kerja == '' || $id_lokasi_kerja == '52')) { //admin-utama
    ?>
    <?php if ($Data_pengembangan_karir->Status_progress == '0' || $Data_pengembangan_karir->Status_progress == '25' || $Data_pengembangan_karir->Status_progress == '28') { ?>

        <h4 style='text-align: center;'>
            Form Verifikasi
        </h4>
        <br>

        <form id="form_verifikasi_pengembangan_karir" name="form_verifikasi_pengembangan_karir" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tentukan Verifikasi</label>
                        <select class="form-control input-md" name="status_verify" id="status_verify" style='border:2px solid green;'>
                            <option value="">[ Pilih Verifikasi ]</option>
                            <option value="<?php echo $terima; ?>">Terima</option>
                            <option value="<?php echo $tolak; ?>">Tolak</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8" id="divKet" style="display:none;">
                    <label>Alasan Ditolak</label>
                    <div class="form-group">

                        <input type='text' name="ket" id="ket" class="form-control input-sm" style='border:2px solid green;'>
                    </div>
                </div>
            </div>

            <br>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type='hidden' name='Pengembangan_karir_id' value='<?php echo $Pengembangan_karir_id; ?>'>
                        <button type="button" id='btn_verifikasi' style='float:right;' class="btn btn-success  btn-sm" onclick="simpan_verifikasi_pengembangan_karir()"><i class="fa fa-save"></i> Simpan & Kirim Ketahap Selanjutnya</button>&nbsp;&nbsp;
                        <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form()">Batal</button>&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </form>
    <?php } elseif ($Data_pengembangan_karir->Status_progress == '3') { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form_selesai()">Batal</button>&nbsp;&nbsp;
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form()">Batal</button>&nbsp;&nbsp;
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form_selesai()">Batal</button>&nbsp;&nbsp;
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $('#status_verify').change(function() {
        var status_verify = $('#status_verify').val();
        const targetDiv = document.getElementById("divKet");
        if (status_verify == 24 || status_verify == 25 || status_verify == 26 || status_verify == 28) {
            targetDiv.style.display = "block";
        } else {
            targetDiv.style.display = "none";
        }

    });
</script>