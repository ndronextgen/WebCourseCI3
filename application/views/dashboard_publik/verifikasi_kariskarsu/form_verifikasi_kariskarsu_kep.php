<style type="text/css">
    .modal-body {
        overflow-y: auto;
        margin-bottom: 0px;
    }
</style>

<div class="box box-info">
    <div class="box-header">
        <div class="box-tools pull-right">
            <div id='loading'></div>
        </div>
    </div>
    <div class="box-body">
        <form id="form_verifikasi_kariskarsu_kep" name="form_verifikasi_kariskarsu_kep" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="hr hr-18 hr-double dotted"></div>

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
                            <td><?php echo $Data->uraian . ' ' . $Data->golongan; ?></td>
                        </tr>
                        <tr>
                            <td width='1px'>&nbsp;</td>
                            <td width='2px'>d.</td>
                            <td>Jabatan / Pekerjaan</td>
                            <td>:</td>
                            <td><?php echo $Data->nama_jabatan; ?></td>
                        </tr>
                        <tr>
                            <td width='1px'>&nbsp;</td>
                            <td width='2px'>e.</td>
                            <td>Satuan Organisasi</td>
                            <td>:</td>
                            <td>
                                <?php
                                $lokasi = ucwords(strtolower($Data->nama_lokasi_kerja));
                                $lokasi = str_replace('Dan', 'dan', $lokasi);
                                $lokasi = str_replace('Dki', 'DKI', $lokasi);
                                echo $lokasi;
                                ?>
                            </td>
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
                            <td>Alamat / Tempat Tinggal</td>
                            <td>:</td>
                            <td><?php echo $Data->alamat; ?></td>
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
                            <td colspan='4'>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>a. File Surat Nikah</label>
                                        <br>
                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_surat_nikah); ?>
                                        <input type='hidden' name="File_surat_nikah_lama" id="File_surat_nikah_lama" value='<?php echo $Data_kariskarsu->File_surat_nikah; ?>'>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>b. File KK</label>
                                        <br>
                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_kk); ?>
                                        <input type='hidden' name="File_kk_lama" id="File_kk_lama" value='<?php echo $Data_kariskarsu->File_kk; ?>'>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>c. File KTP Suami</label>
                                        <br>
                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_ktp_suami); ?>
                                        <input type='hidden' name="File_ktp_suami_lama" id="File_ktp_suami_lama" value='<?php echo $Data_kariskarsu->File_ktp_suami; ?>'>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>d. File KTP Istri</label>
                                        <br>
                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_ktp_istri); ?>
                                        <input type='hidden' name="File_ktp_istri_lama" id="File_ktp_istri_lama" value='<?php echo $Data_kariskarsu->File_ktp_istri; ?>'>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>e. File SK CPNS/PNS Terakhir</label>
                                        <br>
                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_sk_pns); ?>
                                        <input type='hidden' name="File_sk_pns_lama" id="File_sk_pns_lama" value='<?php echo $Data_kariskarsu->File_sk_pns; ?>'>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>f. File Foto 2 x 3</label>
                                        <br>
                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_foto); ?>
                                        <input type='hidden' name="File_foto_lama" id="File_foto_lama" value='<?php echo $Data_kariskarsu->File_foto; ?>'>
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

                    <hr>
                    <h4 style="text-align: center;">Timeline Surat</h4>
                    <br>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <?php
                                $data1['data_history'] = $data_history;
                                $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline_content_2', $data1);
                                ?>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4 style="text-align: center;">Form Verifikasi</h4>
                    <br>

                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Pilih Verifikasi</label>
                                <select class="form-control input-md" name="status_verify" id="status_verify">
                                    <option value="">[ Pilih Verifikasi ]</option>
                                    <option value="<?php echo $terima; ?>">Terima</option>
                                    <option value="<?php echo $tolak; ?>">Tolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-8" id="divKet" style="display:none;">
                            <div class="form-group">
                                <label>Alasan Ditolak</label>
                                <input type='text' name="ket" id="ket" class="form-control input-md">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label></label>
                                <input type='hidden' value='<?php echo $Kariskarsu_id; ?>' name='Kariskarsu_id' Id='Kariskarsu_id'>
                                <button id='btn_verifikasi' type='button' onclick="simpan_verifikasi_kariskarsu()" class='btn btn-block btn-success btn-md' style='float:right;'>Verifikasi</button>
                                <!-- <hr style="margin-top: 20px; margin-bottom: 18px;"> -->
                                <!-- <button type="button" style='float:right; margin-top: -5px; margin-right: 15px; margin-bottom: -10px;' class="btn btn-danger btn-sm" onclick="tutup_form_detail()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button> -->

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                            <div id="loading" style='text-align: center;'>
                            </div>
                        </div>
                        <div class="col-xs-4"></div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <button type="button" style='float:right; margin-top: -5px; margin-right: 15px;' class="btn btn-danger btn-sm" onclick="tutup_form_detail()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
</div>

<script type="text/javascript">
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