<div id='ajax_content'>
    <!-- <section id="data-hukuman" class="content"> -->

    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="page-header">
                        <h4># Tambah Karis / Karsu
                            <button class='btn btn-info btn-sm' onclick='load_data()' style='float: right; font-size: small;'>
                                <i class="glyphicon glyphicon-chevron-left"></i> &nbsp; Kembali
                            </button>
                        </h4>
                    </div>
                    <form name="form_kariskarsu" id="form_kariskarsu" method="post" enctype="multipart/form-data">
                        <input type='hidden' value='<?php echo $Kariskarsu_id; ?>' name='Kariskarsu_id' id='Kariskarsu_id'>
                        <label class="radio-inline" style='font-size:15px;font-weight:bold;color:red;'>
                            <input type="radio" name="Perkawinan_ke" id="Perkawinan_ke" value='1' checked>Perkawinan Pertama
                        </label>
                        <label class="radio-inline" style='font-size:15px;font-weight:bold;color:red;'>
                            <input type="radio" name="Perkawinan_ke" id="Perkawinan_ke" value='2'>Perkawinan Janda/Duda
                        </label>
                        <button type='button' class='btn btn-success btn-sm' onclick='ubah_data_pegawai(<?php echo $id_pegawai; ?>)' style='float:right;'><i class="glyphicon glyphicon-edit"></i> &nbsp; Ubah Data Pegawai</button>


                        <table class='table bordered' cellspacing='10' cellpadding='5'>
                            <tr>
                                <td colspan='5'>
                                    <div id='data_pegawai'></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='5'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan='5'>Dengan ini memberitahukan dengan hormat, bahwa saya : &nbsp;
                                    <button class='btn btn-danger btn-sm btn-flat' type='button' onclick="get_item_keluarga('<?php echo $Data->id_pegawai; ?>', '<?php echo $Kariskarsu_id; ?>')">
                                        <i class="glyphicon glyphicon-plus"></i> &nbsp; Pilih istri / suami dari data keluarga</button>
                                    <button class='btn btn-warning btn-sm btn-flat' type='button' onclick="clear_item('<?php echo $Kariskarsu_id; ?>')">
                                        <i class="glyphicon glyphicon-refresh"></i> &nbsp; Clear / Reset Data
                                    </button>
                                </td>
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
                                    <div class="form-group">
                                        <label>File Surat Nikah (Yang dilegalisir *.jpg|*.png|*.pdf)</label>
                                        <input type='file' name="File_surat_nikah" id="File_surat_nikah" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>b.</td>
                                <td width='200px' colspan='3'>
                                    <div class="form-group">
                                        <label>File KK (*.jpg|*.png|*.pdf)</label>
                                        <input type='file' name="File_kk" id="File_kk" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>c.</td>
                                <td width='200px' colspan='3'>
                                    <div class="form-group">
                                        <label>File KTP Suami (*.jpg|*.png|*.pdf)</label>
                                        <input type='file' name="File_ktp_suami" id="File_ktp_suami" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>d.</td>
                                <td width='200px' colspan='3'>
                                    <div class="form-group">
                                        <label>File KTP Istri (*.jpg|*.png|*.pdf)</label>
                                        <input type='file' name="File_ktp_istri" id="File_ktp_istri" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>e.</td>
                                <td width='200px' colspan='3'>
                                    <div class="form-group">
                                        <label>File SK CPNS/PNS Terakhir (*.jpg|*.png|*.pdf)</label>
                                        <input type='file' name="File_sk_pns" id="File_sk_pns" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width='1px'>&nbsp;</td>
                                <td width='2px'>f.</td>
                                <td width='200px' colspan='3'>
                                    <div class="form-group">
                                        <label>File Foto 2 x 3 (*.jpg|*.png|*.pdf)</label>
                                        <input type='file' name="File_foto" id="File_foto" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>

                            <tr>
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
                            </tr>

                        </table>

                        <button id='btn_tmb' type='button' onclick="ajax_simpan_kariskarsu()" class='btn btn-block btn-success btn-lg'>Simpan</button>

                    </form>

                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <!-- </section> -->
</div>

<script type="text/javascript">
    // var Kariskarsu_id = $("#Kariskarsu_id").val();
    // get_temp_item_pilihan(Kariskarsu_id);
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
                // /alert(data);
                //$('#ajax_pasangan').empty().append(data);
                //var data = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
                $('#ajax_pasangan').html(data);
            }
        });
    }

    get_view_pegawai();

    function get_view_pegawai() {
        $.ajax({
            url: "<?php echo site_url('Kariskarsu/get_view_pegawai'); ?>",
            data: {
                Id: <?php echo $id_pegawai; ?>
            },
            type: "POST",
            success: function(data) {
                $('#data_pegawai').html(data);
            }
        });
    }

    function ubah_data_pegawai(Id) {
        $.ajax({
            url: "<?php echo site_url('Kariskarsu/ubah_data_pegawai'); ?>",
            data: {
                Id: Id
            },
            type: "POST",
            success: function(data) {
                $('#modal_all .modal-dialog .modal-content .modal-body').html(data);
            }
        });
        $('.modal-footer').hide(); // show bootstrap modal
        $('#modal_all').modal('show'); // show bootstrap modal
        $('.modal-title').text('Data Pegawai'); // Set Title to Bootstrap modal title
    }

    function get_item_keluarga(Id, Kariskarsu_id) {
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

    function clear_item(Kariskarsu_id) {
        $.ajax({
            url: "<?php echo site_url('Kariskarsu/clear_item'); ?>",
            data: {
                Kariskarsu_id: Kariskarsu_id
            },
            type: "POST",
            success: function(data) {
                const resp = JSON.parse(data);
                $.alert({
                    type: (resp.status == 0) ? 'red' : 'green',
                    icon: (resp.status == 0) ? 'fa fa-warning' : 'fa fa-info',
                    title: (resp.status == 0) ? 'Warning' : 'Info',
                    content: resp.message
                })
                get_temp_item_pilihan(Kariskarsu_id);
            }
        });
    }
</script>
<div id='isi_keluarga'></div>