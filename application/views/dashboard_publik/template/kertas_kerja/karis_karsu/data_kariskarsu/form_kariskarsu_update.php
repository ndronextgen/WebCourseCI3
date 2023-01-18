<div id='ajax_content'>
    <!-- <section id="data-hukuman" class="content"> -->

    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="page-header">
                        <h4># Tambah Data Karis Karsu &nbsp;&nbsp;&nbsp;<button class='btn btn-info btn-sm' onclick='load_data()' style='float:right;'>
                                << Kembali</button> </h4> </div> 
                                <form name="form_kariskarsu" id="form_kariskarsu" method="post" enctype="multipart/form-data">
                                    <input type='hidden' value='<?php echo $Kariskarsu_id; ?>' name='Kariskarsu_id' id='Kariskarsu_id'>
                                    <?php 
                                        $select_1 = ''; $select_2 = '';
                                        if($Data_kariskarsu->Perkawinan_ke=='1'){
                                            $select_1 = 'checked';
                                        } 
                                        if($Data_kariskarsu->Perkawinan_ke=='2'){
                                            $select_2 = 'checked';
                                        } 
                                    ?>
                                    <label class="radio-inline" style='font-size:15px;font-weight:bold;color:red;'>
                                        <input type="radio" name="Perkawinan_ke" id="Perkawinan_ke" value='1' <?php echo $select_1; ?>>Perkawinan Pertama
                                    </label>
                                    <label class="radio-inline" style='font-size:15px;font-weight:bold;color:red;'>
                                        <input type="radio" name="Perkawinan_ke" id="Perkawinan_ke" value='2' <?php echo $select_2; ?>>Perkawinan Janda/Duda
                                    </label>
                                    
                                    
                                                <table class='table bordered' cellspacing='10' cellpadding='5'>
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
                                                    <tr>
                                                        <td colspan='5'>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='5'>Dengan ini memberitahukan dengan hormat, bahwa saya: <button class='btn btn-danger btn-sm btn-flat' type='button' onclick="get_item_keluarga('<?php echo $Data->id_pegawai; ?>', '<?php echo $Kariskarsu_id; ?>')">+ Pilih istri/suami dari data keluarga</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='5'>
                                                        <div id="ajax_pasangan">
                                                            <table class='table bordered' cellspacing='10' cellpadding='5'>
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
                                                                        <td colspan='5'>telah melangsungkan perkawinan  lagi dengan wanita / pria sebagai tersebut dibawah ini :</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width='1px'>&nbsp;</td>
                                                                        <td width='2px'>a.</td>
                                                                        <td width='200px'>Nama :</td>
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
                                                                        <td width='200px'>Pangkat / Golongan Ruang:</td>
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
                                                            <div class="col-xs-4">
                                                                <div class="form-group">
                                                                    <label>File Surat Nikah (Sebelumnya)</label>
                                                                    <br>
                                                                    <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_surat_nikah); ?>
                                                                    <input type='hidden' name="File_surat_nikah_lama" id="File_surat_nikah_lama" value='<?php echo $Data_kariskarsu->File_surat_nikah; ?>'>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-8">
                                                                <div class="form-group">
                                                                    <label>File Surat Nikah (Yang dilegalisir *.jpg|*.png|*.pdf)</label>
                                                                    <input type='file' name="File_surat_nikah" id="File_surat_nikah" class="form-control input-sm">
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
                                                                <div class="col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>File KK (Sebelumnya)</label>
                                                                        <br>
                                                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_kk); ?>
                                                                        <input type='hidden' name="File_kk_lama" id="File_kk_lama" value='<?php echo $Data_kariskarsu->File_kk; ?>'>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-8">
                                                                    <div class="form-group">
                                                                        <label>File KK (*.jpg|*.png|*.pdf)</label>
                                                                        <input type='file' name="File_kk" id="File_kk" class="form-control input-sm">
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
                                                                <div class="col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>File KTP Suami (Sebelumnya)</label>
                                                                        <br>
                                                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_ktp_suami); ?>
                                                                        <input type='hidden' name="File_ktp_suami_lama" id="File_ktp_suami_lama" value='<?php echo $Data_kariskarsu->File_ktp_suami; ?>'>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-8">
                                                                    <div class="form-group">
                                                                        <label>File KTP Suami (*.jpg|*.png|*.pdf)</label>
                                                                        <input type='file' name="File_ktp_suami" id="File_ktp_suami" class="form-control input-sm">
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
                                                                <div class="col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>File KTP Istri (Sebelumnya)</label>
                                                                        <br>
                                                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_ktp_istri); ?>
                                                                        <input type='hidden' name="File_ktp_istri_lama" id="File_ktp_istri_lama" value='<?php echo $Data_kariskarsu->File_ktp_istri; ?>'>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-8">
                                                                    <div class="form-group">
                                                                        <label>File KTP Istri (*.jpg|*.png|*.pdf)</label>
                                                                        <input type='file' name="File_ktp_istri" id="File_ktp_istri" class="form-control input-sm">
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
                                                                <div class="col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>File SK CPNS/PNS Terakhir (Sebelumnya)</label>
                                                                        <br>
                                                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_sk_pns); ?>
                                                                        <input type='hidden' name="File_sk_pns_lama" id="File_sk_pns_lama" value='<?php echo $Data_kariskarsu->File_sk_pns; ?>'>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-8">
                                                                    <div class="form-group">
                                                                        <label>File SK CPNS/PNS Terakhir (*.jpg|*.png|*.pdf)</label>
                                                                        <input type='file' name="File_sk_pns" id="File_sk_pns" class="form-control input-sm">
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
                                                                <div class="col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>File Foto 2 x 3 (Sebelumnya)</label>
                                                                        <br>
                                                                        <?php echo $this->func_table->get_file_kariskarsu($Data_kariskarsu->File_foto); ?>
                                                                        <input type='hidden' name="File_foto_lama" id="File_foto_lama" value='<?php echo $Data_kariskarsu->File_foto; ?>'>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-8">
                                                                    <div class="form-group">
                                                                        <label>File Foto 2 x 3 (*.jpg|*.png|*.pdf)</label>
                                                                        <input type='file' name="File_foto" id="File_foto" class="form-control input-sm">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>

                                                    <!-- <tr>
                                                        <td width='1px'>3.</td>
                                                        <td colspan='4'>Berhubung dengan itu, maka  saya mengharap agar :</td>
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
                                                
                                                <button id='btn_tmb' type='button' onclick="ajax_update_kariskarsu()" class='btn btn-block btn-success btn-lg'>Simpan Update</button>
                                            
                                    </form>

                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- </section> -->
        <div>

            <script type="text/javascript">
                var Kariskarsu_id = $("#Kariskarsu_id").val();
                get_temp_item_pilihan(Kariskarsu_id);
                function get_temp_item_pilihan(Kariskarsu_id){
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

                function get_item_keluarga(Id, Kariskarsu_id) {
                    //save_method = 'update';
                    $.ajax({
                        url: "<?php echo site_url('Kariskarsu/get_item'); ?>",
                        data: {
                            Id: Id,
                            Kariskarsu_id: Kariskarsu_id
                        },
                        type: "POST",
                        success: function(data) {
                            $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
                        }
                    });
                    $('.modal-footer').hide(); // show bootstrap modal
                    $('#modal_all').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Data Keluarga Pegawai'); // Set Title to Bootstrap modal title
                }
            </script>