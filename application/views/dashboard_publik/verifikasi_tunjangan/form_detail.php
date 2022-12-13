<div class="box box-info">
    <div class="box-header">
        <div class="box-tools pull-right">
            <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
            <div id='loading'></div>
        </div>
    </div>

    <div class="box-body">
        <form id="form_verifikasi_tunjangan_kep" name="form_verifikasi_tunjangan_kep" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="hr hr-18 hr-double dotted"></div>

                    <table class='table' cellspacing='10' cellpadding='5'>
                        <tr>
                            <td width='40%'>
                                <!-- right -->
                                <table class='table' cellspacing='10' cellpadding='5'>
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
                                        <td><?php echo $Data_tunjangan->Digaji_menurut; ?></td>
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
                                        <!-- <button class="btn btn-default" onclick="reload_table_item_pilihan()"><i class="glyphicon glyphicon-refresh"></i> Reload</button> -->
                                    </span><br><br>
                                    <table class="table table-bordered" id="table_data_item_pilih" width='99%'>
                                        <thead>
                                            <tr style="background-color:#9ee6da;font-size:12px;">
                                                <th rowspan='2' style="width: 10px">#</th>
                                                <th align="center" rowspan='2'><b>NAMA ISTRI / SUAMI / ANAK TANGGUNGAN</b></th>
                                                <th align="center" rowspan='2'><b>TEMPAT LAHIR</b></th>
                                                <th align="center" colspan='2'><b>TANGGAL</b></th>
                                                <th align="center" rowspan='2'><b>PEKERJAAN / NIP / SEKOLAH</b></th>
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
                            </td>
                        </tr>
                    </table>

                </div>
            </div>

        </form>
    </div><!-- /.box-body -->

</div>

<script type="text/javascript">
    table_data_item_pilih = $('#table_data_item_pilih').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        responsive: true,
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
        }, {
            "targets": [0],
            "orderable": false,
            "visible": false,
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