<div id='ajax_content'>
    <!-- <section id="data-hukuman" class="content"> -->

    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="page-header">
                        <h4># Update Data tunjangan &nbsp;&nbsp;&nbsp;<button class='btn btn-info btn-sm' onclick='load_data()' style='float:right;'>
                                << Kembali</button> </h4> </div> <form name="form_tunjangan" id="form_tunjangan" method="post">
                                <button type='button' class='btn btn-success btn-sm' onclick='ubah_data_pegawai(<?php echo $Data->id_pegawai; ?>)' style='float:left;'><i class="glyphicon glyphicon-edit"></i> Ubah Data Pegawai</button>
                                    <table class='table' cellspacing='10' cellpadding='5'>
                                        <tr>
                                            <td width='40%' colspan='3'>
                                                <!-- div view pegawai -->
                                                <div id='data_pegawai'></div>
                                                <!-- end div view pegawai -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='3'>
                                                <p>Menerangkan dengan sesungguhnya bahwa saya mempunyai susunan keluarga sebagai berikut:</p>
                                                <div class="table-responsive">
                                                    <span>
                                                        <input type="hidden" value="<?php echo $Tunjangan_id; ?>" name='Tunjangan_id' id='Tunjangan_id'>
                                                        <button class='btn btn-danger btn-sm btn-flat' type='button' onclick="get_item('<?php echo $Data->id_pegawai; ?>', '<?php echo $Tunjangan_id; ?>')">+ Tambah</button>
                                                        <!-- <button class="btn btn-default" onclick="reload_table_item_pilihan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button> -->
                                                    </span><br><br>
                                                    <table class="table table-bordered" id="table_data_item_pilih" width='99%'>
                                                        <thead>
                                                            <tr style="background-color:#9ee6da;font-size:12px;">
                                                                <th rowspan='2' style="width: 10px">#</th>
                                                                <th align="center" rowspan='2'><b>NAMA ISTRI / SUAMI / ANAK TANGGUNGAN</b></th>
                                                                <th align="center" rowspan='2'><b>TEMPAT LAHIR</b></th>
                                                                <th align="center" colspan='2'><b>TANGGAL</b></th>
                                                                <th align="center" rowspan='2'><b>PEKERJAAN / NIP / NIK / SEKOLAH</b></th>
                                                                <th align="center" rowspan='2'><b>KETERANGAN (SUAMI / ISTRI / ANAK KANDUNG)</b></th>
                                                                <th align="center" rowspan='2'><b>MENDAPATKAN PEMBAYARAN TUNJANGAN( √ )</b></th>
                                                            </tr>
                                                            <tr style="font-size:12px;">
                                                                <th>LAHIR</th>
                                                                <th>PERKAWINAN</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='3'>
                                                <p>Keterangan ini saya buat dengan sesungguhnya dan apabila keterangan ini ternyata <b>tidak benar (palsu), saya bersedia dituntut dimuka pengadilan berdasarkan Undang-undang yang berlaku, dan bersedia mengembalikan semua penghasilan yang telah saya terima yang seharusnya bukan menjadi hak saya.</b></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='3'>
                                                <button id='btn_tmb_tunjangan' type='button' onclick="ajax_update_tunjangan()" class='btn btn-block btn-success btn-lg'>Simpan</button>
                                            </td>
                                        </tr>
                                    </table>
                                    </form>

                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- </section> -->
        <div>
            <script>
                table_data_item_pilih = $('#table_data_item_pilih').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ordering": false,
                    "responsive": true,
                    "ajax": {
                        "url": "<?php echo site_url('tunjangan/table_data_item_pilihan') ?>",
                        "type": "POST",
                        "data": {
                            Tunjangan_id: "<?php echo $Tunjangan_id; ?>"
                        }
                    },
                    "lengthChange": false,
                    "searching": false,
                    "columnDefs": [{
                        "targets": [-1],
                        "orderable": false,
                    }],
                    "aoColumns": [{
                        "sClass": "left"
                    }, {
                        "sClass": "left"
                    }, {
                        "sClass": "left"
                    }, {
                        "sClass": "center"
                    }, {
                        "sClass": "center"
                    }, {
                        "sClass": "left"
                    }, {
                        "sClass": "left"
                    }, {
                        "sClass": "center"
                    }],

                });

                get_view_pegawai();
                function get_view_pegawai() {
                    //save_method = 'update';
                    $.ajax({
                        url: "<?php echo site_url('Tunjangan/get_view_pegawai'); ?>",
                        data: {
                            Id: <?php echo $Data->id_pegawai; ?>
                        },
                        type: "POST",
                        success: function(data) {
                            $('#data_pegawai').html(data);
                        }
                    });
                }

                function get_item(Id, Tunjangan_id) {
                    //save_method = 'update';
                    $.ajax({
                        url: "<?php echo site_url('Tunjangan/get_item'); ?>",
                        data: {
                            Id: Id,
                            Tunjangan_id: Tunjangan_id
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

                function ubah_data_pegawai(Id) {
                    //save_method = 'update';
                    $.ajax({
                        url: "<?php echo site_url('Tunjangan/ubah_data_pegawai'); ?>",
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

                function reload_table_item_pilihan() {
                    table_data_item_pilih.ajax.reload(null, false); //reload datatable ajax 
                }

                function delete_tunjangan_temp_item(Id) {
                    // var i = "Kembalikan data ?";
                    // //var b = "Anggota Keluarga Dikembalikan";
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
                                        url: '<?php echo site_url("Tunjangan/delete_tunjangan_temp_item") ?>',
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
<div id='isi_keluarga'></div>