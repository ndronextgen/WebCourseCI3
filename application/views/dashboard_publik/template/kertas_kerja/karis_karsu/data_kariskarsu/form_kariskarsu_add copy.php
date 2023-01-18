<div id='ajax_content'>
    <!-- <section id="data-hukuman" class="content"> -->

    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="page-header">
                        <h4># Tambah Data tunjangan &nbsp;&nbsp;&nbsp;<button class='btn btn-info btn-sm' onclick='load_data()' style='float:right;'>
                                << Kembali</button> </h4> </div> 
                                <form name="form_tunjangan" id="form_tunjangan" method="post" enctype="multipart/form-data">
                                    <input type='hidden' value='<?php echo $Kariskarsu_id; ?>' name='Kariskarsu' id='Kariskarsu'>
                                    <label class="radio-inline" style='font-size:15px;font-weight:bold;color:red;'>
                                        <input type="radio" name="optradio" checked>Perkawinan Pertama
                                    </label>
                                    <label class="radio-inline" style='font-size:15px;font-weight:bold;color:red;'>
                                        <input type="radio" name="optradio">Perkawinan Janda/Duda
                                    </label>
                                    
                                    
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
                                                        <td><?php echo $Data->nama_pegawai; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width='1px'>&nbsp;</td>
                                                        <td width='2px'>b.</td>
                                                        <td>NIP / NRK</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->nip . ' / ' . $Data->nrk; ?></td>
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
                                                        <td><?php echo $Data->nama_lokasi_kerja; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width='1px'>&nbsp;</td>
                                                        <td width='2px'>f.</td>
                                                        <td>Instansi</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->nama_jabatan; ?></td>
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
                                                        <td><?php echo $Data->alamat; ?></td>
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
                                                        <td width='200px' colspan='3'>Salinan sah Surat Nikah / Akta Perkawinan dalam rangkap 3 ( tiga ) yang dilegalisir;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='1px'>&nbsp;</td>
                                                        <td width='2px'>b.</td>
                                                        <td width='200px' colspan='3'>Pas foto hitam putih isteri / suami saya ukuran 2 X 3 cm sebanyak 3 ( tiga ) lembar;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='1px'>&nbsp;</td>
                                                        <td width='2px'>c.</td>
                                                        <td width='200px' colspan='3'>Fotocopy Surat Kematian / Akta Cerai / Surat Keterangan Cerai rangkap 3 ( tiga ) lembar.</td>
                                                    </tr>

                                                    <tr>
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
                                                    </tr>

                                                </table>
                                                
                                                <button id='btn_tmb' type='button' onclick="ajax_simpan_tunjangan()" class='btn btn-block btn-success btn-lg'>Simpan</button>
                                            
                                    </form>

                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- </section> -->
        <div>

            <script type="text/javascript">
                var tahun = $("#Kariskarsu_id").val();
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
                            // /alert(data);
                            //$('#ajax_pasangan').empty().append(data);
                            //var data = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
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



                function delete_tunjangan_temp_item(Id) {
                    // var i = "Kembalikan data ?";
                    // // let q = "Hapus anggota keluarga dari daftar penerima tunjangan?";
                    // // let i = "Anggota keluarga berhasil hapus.";
                    // if (!confirm(i)) return false;
                    // $.ajax({
                    //     type: "post",
                    //     data: "Id=" + Id,
                    //     url: "<?php echo site_url('Tunjangan/delete_tunjangan_temp_item'); ?>",
                    //     success: function(s) {
                    //         alert(s);
                    //         reload_table_item_pilihan();
                    //     }
                    // });



                    let q = 'Hapus anggota keluarga dari daftar penerima tunjangan?';
                    let i = 'Anggota keluarga berhasil hapus.';
                    let e = 'Proses hapus data bermasalah.';

                    $.confirm({
                        icon: 'fa fa-warning',
                        title: 'Konfirmasi',
                        content: q,
                        type: 'red',
                        buttons: {
                            yes: {
                                text: 'Ya',
                                btnClass: 'btn-red',
                                action: function() {
                                    $.ajax({
                                        url: "<?php echo site_url('Tunjangan/delete_tunjangan_temp_item'); ?>",
                                        type: "post",
                                        data: "Id=" + Id,
                                        success: function() {
                                            $.dialog({
                                                icon: 'fa fa-info',
                                                title: 'Info',
                                                content: i,
                                                type: 'green',
                                                backgroundDismiss: true
                                            });

                                            reload_table_item_pilihan();
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            $.dialog({
                                                icon: 'fa fa-info',
                                                title: 'Info',
                                                content: e,
                                                type: 'red',
                                                backgroundDismiss: true
                                            });
                                        }
                                    });
                                }
                            },
                            no: {
                                text: 'Tidak'
                            }
                        }
                    })
                }
            </script>