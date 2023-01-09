<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title"><a data-toggle="collapse" href="#detail_pengaduan"><i class="fa fa-angle-double-right"></i> Detail Surat Tunjangan</a></h5>
        </div>
        <div id="detail_pengaduan" class="panel-collapse expand collapse show">

            <br>
            <h4 style='text-align: center;'>
                <?php
                if ($Data_kariskarsu->Perkawinan_ke == '1') {
                    echo 'LAPORAN PERKAWINAN PERTAMA';
                } else {
                    echo 'LAPORAN PERKAWINAN JANDA / DUDA';
                }
                ?>
            </h4>
            <input type='hidden' value='<?php echo $Kariskarsu_id; ?>' name='Kariskarsu_id' id='Kariskarsu_id'>
            <table class='table no-border' cellspacing='10' cellpadding='5'>
                <tr>
                    <td width='1px'>1.</td>
                    <td colspan='4'>Yang bertandatangan dibawah ini:</td>
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
                    <td><?php echo str_replace('Dan', 'dan', ucwords(strtolower($Data->nama_lokasi_kerja))); ?></td>
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
                <tr>
                    <td colspan='5'>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan='5'>Dengan ini memberitahukan dengan hormat, bahwa saya: </td>
                </tr>
                <tr>
                    <td colspan='5'>
                        <div id="ajax_pasangan">
                            <table class='table no-border' cellspacing='10' cellpadding='5'>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>a.</td>
                                    <td width='200px'>Pada Tanggal</td>
                                    <td width='1px'>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>b.</td>
                                    <td>di</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td colspan='5'>telah melangsungkan perkawinan lagi dengan wanita / pria sebagai tersebut dibawah ini :</td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>a.</td>
                                    <td width='200px'>Nama</td>
                                    <td width='1px'>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>b.</td>
                                    <td>NIP / Nomor Identitas</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>c.</td>
                                    <td width='200px'>Pangkat / Golongan Ruang</td>
                                    <td width='1px'>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>d.</td>
                                    <td>Jabatan / Pekerjaan</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>e.</td>
                                    <td>Tempat / Tanggal Lahir</td>
                                    <td width='1px'>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>f.</td>
                                    <td>Agama</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width='1px'>&nbsp;</td>
                                    <td width='2px'>g.</td>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width='1px'>2.</td>
                    <td colspan='4'>Sebagai bukti bersama ini kami lampirkan :</td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>a.</td>
                    <td width='200px' colspan='3'>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>File Surat Nikah</label>
                                    <br>
                                    <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_surat_nikah); ?>
                                    <input type='hidden' name="File_surat_nikah_lama" id="File_surat_nikah_lama" value='<?php echo $Data_kariskarsu->File_surat_nikah; ?>'>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>b.</td>
                    <td width='200px' colspan='3'>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>File KK</label>
                                    <br>
                                    <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_kk); ?>
                                    <input type='hidden' name="File_kk_lama" id="File_kk_lama" value='<?php echo $Data_kariskarsu->File_kk; ?>'>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>c.</td>
                    <td width='200px' colspan='3'>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>File KTP Suami</label>
                                    <br>
                                    <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_ktp_suami); ?>
                                    <input type='hidden' name="File_ktp_suami_lama" id="File_ktp_suami_lama" value='<?php echo $Data_kariskarsu->File_ktp_suami; ?>'>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>d.</td>
                    <td width='200px' colspan='3'>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>File KTP Istri</label>
                                    <br>
                                    <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_ktp_istri); ?>
                                    <input type='hidden' name="File_ktp_istri_lama" id="File_ktp_istri_lama" value='<?php echo $Data_kariskarsu->File_ktp_istri; ?>'>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>e.</td>
                    <td width='200px' colspan='3'>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>File SK CPNS/PNS Terakhir</label>
                                    <br>
                                    <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_sk_pns); ?>
                                    <input type='hidden' name="File_sk_pns_lama" id="File_sk_pns_lama" value='<?php echo $Data_kariskarsu->File_sk_pns; ?>'>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>f.</td>
                    <td width='200px' colspan='3'>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>File Foto 2 x 3</label>
                                    <br>
                                    <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_foto); ?>
                                    <input type='hidden' name="File_foto_lama" id="File_foto_lama" value='<?php echo $Data_kariskarsu->File_foto; ?>'>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- <tr>
                    <td width='1px'>3.</td>
                    <td colspan='4'>Berhubung dengan itu, maka saya mengharap agar :</td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>a.</td>
                    <td width='200px' colspan='3'>Dicatat perkawinan tersebut dalam Daftar Keluarga saya;</td>
                </tr>
                <tr>
                    <td width='1px'>&nbsp;</td>
                    <td width='2px'>b.</td>
                    <td width='200px' colspan='3'>Diselesaikan KARIS / KARSU bagi isteri / suami saya</td>
                </tr>

                <tr>
                    <td width='1px'>4.</td>
                    <td colspan='4'>Demikian laporan ini saya buat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.</td>
                </tr> -->

            </table>
        </div>
    </div>
</div>

<hr>
<h4 style='text-align: center;'>
    Timeline Surat
</h4>
<hr>

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

    if ($hist->Status_progress == $Data_kariskarsu->Status_progress) {
        $active = 'current';
    } else {
        $active = '';
    }

    echo '  <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
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

<?php if ($Data_kariskarsu->Status_progress == '0' || $Data_kariskarsu->Status_progress == '25' || $Data_kariskarsu->Status_progress == '28') { ?>

    <h4 style='text-align: center;'>
        Form Verifikasi
    </h4>
    <hr>

    <form id="form_verifikasi_kariskarsu" name="form_verifikasi_kariskarsu" method="post" enctype="multipart/form-data">
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
                    <input type='hidden' name='Kariskarsu_id' value='<?php echo $Kariskarsu_id; ?>'>
                    <button type="button" id='btn_verifikasi' style='float:right;' class="btn btn-success  btn-sm" onclick="simpan_verifikasi_kariskarsu()"><i class="fa fa-save"></i> Simpan Verifikasi Pengajuan Surat KARIS/KARSU</button>&nbsp;&nbsp;
                    <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form()">Batal</button>&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </form>
<?php } else { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form()">Batal</button>&nbsp;&nbsp;
            </div>
        </div>
    </div>
<?php } ?>

<script>
    var Kariskarsu_id = $("#Kariskarsu_id").val();
    get_temp_item_pilihan(Kariskarsu_id);

    function get_temp_item_pilihan(Kariskarsu_id) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Kariskarsu/get_temp_item_pilihan'); ?>",
            data: {
                Kariskarsu_id: Kariskarsu_id
            },
            beforeSend: function(f) {
                var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
                $('#ajax_pasangan').html(percentVal);
            },
            success: function(data) {
                $('#ajax_pasangan').html(data);
            }
        });
    }
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