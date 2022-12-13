<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title"><a data-toggle="collapse" href="#detail_pengaduan"><i class="fa fa-angle-double-right"></i> Detail Surat Tunjangan</a></h5>
        </div>
        <div id="detail_pengaduan" class="panel-collapse expand collapse show">



            <form name="form_tunjangan" id="form_tunjangan" method="post" enctype="multipart/form-data">
                <table class='table' cellspacing='10' cellpadding='5'>
                    <tr>
                        <td width='40%'>
                            <!-- right -->
                            <table class='table' cellspacing='10' cellpadding='5'>
                                <tr>
                                    <td width='200px'>Nama Lengkap</td>
                                    <td width='1px'>:</td>
                                    <td><?php echo $this->func_table->name_format($Data->nama_pegawai); ?></td>
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
                                            <th rowspan='2' style="width: 10px">NO</th>
                                            <th align="center" rowspan='2'>NAMA ISTRI / SUAMI / ANAK TANGGUNGAN</th>
                                            <th align="center" rowspan='2'>TEMPAT LAHIR</th>
                                            <th align="center" colspan='2'>TANGGAL</th>
                                            <th align="center" rowspan='2'>PEKERJAAN / NIP / NIK / SEKOLAH</th>
                                            <th align="center" rowspan='2'>KETERANGAN (SUAMI / ISTRI / ANAK KANDUNG)</th>
                                            <th align="center" rowspan='2'>MENDAPATKAN PEMBAYARAN TUNJANGAN( √ )</th>
                                        </tr>
                                        <tr style="background-color:#9ee6da;font-size:12px;">
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
            </form>
        </div>
    </div>
</div>

<h2 style='text-align:center;color:black;'>Timeline Surat</h2>

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

    if ($hist->Status_progress == $Data_tunjangan->Status_progress) {
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

<?php if ($Data_tunjangan->Status_progress == '0' || $Data_tunjangan->Status_progress == '25' || $Data_tunjangan->Status_progress == '28') { ?>
    <hr>
    <h2 style='text-align:center;color:black;'>Form Verifikasi</h2>
    <form id="form_pengajuan" name="form_pengajuan" method="post" enctype="multipart/form-data">
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
                    <input type='hidden' name='Tunjangan_id' value='<?php echo $Tunjangan_id; ?>'>
                    <button type="button" style='float:right;' class="btn btn-success  btn-sm" onclick="simpan_verifikasi_tunjangan()"><i class="fa fa-save"></i> Simpan Verifikasi Pengajuan Surat Tunjangan</button>&nbsp;&nbsp;
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

    function reload_table_item_pilihan() {
        table_data_item_pilih.ajax.reload(null, false); //reload datatable ajax 
    }

    function delete_tunjangan_temp_item(Id) {
        var i = "Kembalikan data ?";
        //var b = "Anggota Keluarga Dikembalikan";
        if (!confirm(i)) return false;
        $.ajax({
            type: "post",
            data: "Id=" + Id,
            url: "<?php echo site_url('Tunjangan/delete_tunjangan_temp_item'); ?>",
            success: function(s) {
                alert(s);
                reload_table_item_pilihan();
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