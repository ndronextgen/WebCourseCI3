<style type="text/css">
    .modal-body {
        overflow-y: auto;
    }
</style>

<div class="box box-info">
    <div class="box-header">
        <div class="box-tools pull-right">
            <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
            <div id='loading'></div>
        </div>
    </div>
    <div class="box-body">
        <form id="form_verifikasi_kep" name="form_verifikasi_kep" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="hr hr-18 hr-double dotted"></div>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td width='150px'>Nama</td>
                                <td width='2px'>:</td>
                                <td><?php echo $this->func_table->name_format($Data->nama); ?></td>
                            </tr>
                            <tr>
                                <td width='150px'>NIP</td>
                                <td width='2px'>:</td>
                                <td><?php echo $Data->nip; ?></td>
                            </tr>
                            <tr>
                                <td width='150px'>Lokasi Kerja</td>
                                <td width='2px'>:</td>
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
                                <td width='150px'>Jenis Surat</td>
                                <td width='2px'>:</td>
                                <td><?php echo $Data->nama_surat; ?></td>
                            </tr>
                            <tr>
                                <td width='150px'>Status Surat</td>
                                <td width='2px'>:</td>
                                <td>
                                    <?php
                                    if ((int) $Data->id_status_srt == 21) {
                                        if ($Data->is_dinas == 1) {
                                            echo 'Menunggu Verifikasi Kepala Subkoordinator Kepegawaian';
                                        } else {
                                            echo 'Menunggu Verifikasi Kepala Subbagian';
                                        }
                                    } else {
                                        echo str_replace('<br>', ' ', $Data->nama_status_next);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width='150px'>Tanggal Dibuat</td>
                                <td width='2px'>:</td>
                                <td><?php echo $Data->tgl_proses; ?></td>
                            </tr>
                            <tr>
                                <td width='150px'><b>Keperluan</b></td>
                                <td width='2px'><b>:</b></td>
                                <td><b><?php echo $Data->keterangan_pengajuan; ?><b></td>
                            </tr>
                            <tr>
                                <td width='150px'>Jenis Tanda Tangan</td>
                                <td width='2px'>:</td>
                                <td><?php echo $Data->select_ttd; ?></td>
                            </tr>
                    </table>
                    <hr>
                    <!-- <table class="table">
<tr>
	<td>Tahapan Proses</td>
	<td>Nama Tahapan Proses</td>
	<td>User Verifikator</td>
</tr>
<?php
// $no = 1;
// $Query = $this->db->query("SELECT * FROM tbl_status_surat WHERE sort_bidang !='0' ORDER BY sort_bidang ASC")->result(); 
// foreach($Query as $row){ $no++;
?>

<tr>
	<td><?php //echo $no; 
        ?></td>
	<td><?php //echo $row->nama_status; 
        ?></td>
	<td><?php //echo $row->nama_status; 
        ?></td>
</tr>
<?php //} 
?>
</table> -->
                    <p>* Pilih Verifikasi Surat keterangan pegawai diterima/ditolak, <br>
                        * Jika diterima maka akan dilanjutkan ketahap selanjutnya <br>
                        * Jika ditolak maka akan dikembalikan kepada pegawai bersangkutan dan berikan alasannya
                    </p>

                    <hr>

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
                                <input type='hidden' value='<?php echo $Id; ?>' name='Id' Id='Id'>
                                <button id='btn_tmb' type='button' onclick="simpan_verifikasi()" class='btn btn-block btn-success btn-md'>Verifikasi</button>
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
    </div><!-- /.box-body -->

    <button type='button' onclick="tutup_form_detail()" class='btn btn-danger btn-sm' style='float:right; margin-top: -20px; margin-right: 15px;'><i class="fa fa-times"></i>&nbsp; Tutup</button>

</div>


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