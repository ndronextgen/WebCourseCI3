<div id='ajax_content'>
    <!-- <section id="data-hukuman" class="content"> -->

    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="page-header">
                        <h4># Tambah Data tunjangan &nbsp;&nbsp;&nbsp;<button class='btn btn-info btn-sm' onclick='load_data()' style='float:right;'>
                                << Kembali</button> </h4> </div> <form name="form_tunjangan" id="form_tunjangan" method="post" enctype="multipart/form-data">
                                    <table class='table' cellspacing='10' cellpadding='5'>
                                        <tr>
                                            <td width='40%'>
                                                <!-- right -->
                                                <table class='table' cellspacing='10' cellpadding='5'>
                                                    <tr>
                                                        <td width='200px'>Nama Lengkap</td>
                                                        <td width='1px'>:</td>
                                                        <td><?php echo $Data->nama_pegawai; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIP / NRK</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->nip . ' / ' . $Data->nrk; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat / Tanggal Lahir</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->tempat_lahir . ' / ' . $this->func_table->tgl_indonesia($Data->tanggal_lahir); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->jenis_kelamin; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agama</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->agama; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Kepegawaian</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->nama_status; ?></td>
                                                    </tr>

                                                </table>
                                                <!-- end right -->
                                            </td>
                                            <td width='2%'></td>
                                            <td width='58%'>
                                                <!-- left -->
                                                <table class='table ' cellspacing='10' cellpadding='5'>
                                                    <tr>
                                                        <td>Jabatan Struktural</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->nama_jabatan; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Pangkat / Golongan</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->uraian . ' ' . $Data->golongan; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pada Unit Kerja</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->nama_lokasi_kerja; ?></td>
                                                    </tr>
                                                    <tr>
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
                                                        <td>Alamat / tempat tinggal</td>
                                                        <td>:</td>
                                                        <td><?php echo $Data->alamat; ?></td>
                                                    </tr>
                                                </table>
                                                <!-- end left -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='3'>
                                                <p>Menerangkan dengan sesungguhnya bahwa saya mempunyai susunan keluarga sebagai berikut:</p>
                                                <div class="table-responsive">
                                                    <span>
                                                        <input type="hidden" value="<?php echo $Tunjangan_id; ?>" name='Tunjangan_id' id='Tunjangan_id'>
                                                        <button class='btn btn-danger btn-sm btn-flat' type='button' onclick="get_item('<?php echo $Data->id_pegawai; ?>', '<?php echo $Tunjangan_id; ?>')">+ Tambah</button>
                                                        <!-- <button class="btn btn-default" onclick="reload_table_item_pilihan();"><i class="glyphicon glyphicon-refresh"></i> Reload</button> -->
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
                                                <button id='btn_tmb' type='button' onclick="ajax_simpan_tunjangan()" class='btn btn-block btn-success btn-lg'>Simpan</button>
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

            <script type="text/javascript">
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