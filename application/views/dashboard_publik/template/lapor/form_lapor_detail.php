<style type="text/css">
    label {
        font-weight: bold;
    }

    /* Important part */
    .modal-dialog {
        overflow-y: initial !important;
    }

    .td-title {
        width: 150px;
    }

    .td-colon {
        width: 0px;
    }
</style>


<div class="box">
    <div class="box-header">
        <div class="box-tools pull-right">
            <div id='loading'></div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table" style="padding: 10px;">
                    <tbody>
                        <tr>
                            <td class="td-title">Nama Pegawai</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $Data->nama_pegawai; ?></td>
                        </tr>
                        <tr>
                            <td class="td-title">NIP</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $Data->nip; ?></td>
                        </tr>
                        <tr>
                            <td class="td-title">Tanggal Lahir</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $Data->tanggal_lahir; ?></td>
                        </tr>
                        <tr>
                            <td class="td-title">lokasi Kerja</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $Data->nama_lokasi_kerja; ?></td>
                        </tr>
                        <tr>
                            <td class="td-title">Isi Lapor</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $Data_lapor->Kategori; ?></td>
                        </tr>
                        <tr>
                            <td class="td-title">Kategori Lapor</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $Data_lapor->Isi_laporan; ?></td>
                        </tr>
                        <tr>
                            <td colspan='6'>
                                <h5><i class="flaticon-file-1"></i> File</h5>
                                <table class="table table-bordered table-hover" style='font-size: 10px; width: 0px;'>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php if ($Data_lapor->File_upload == '') { ?>
                                                    -
                                                <?php } else { ?>
                                                    <a data-fancybox="images" href="<?php echo base_url('asset/upload/Lapor/' . $Data_lapor->File_upload . ''); ?>" target="_blank">
                                                        <img height="55px" width="55px" src="<?php echo base_url('asset/upload/Lapor/' . $Data_lapor->File_upload . ''); ?>">
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="box-body table-responsive">
                    <tr>
                        <td class="td-title"><label>Tanggapan Lapor </label></td>
                        <td class="td-colon"></td>
                        <td></td>
                    </tr>
                    <table class="table table-bordered" width="100%" id="table_tanggapans" style="font-size: 12px;">
                        <thead>
                            <tr style='background-color:#3c8dbc;color:#fff;font-size:14px;'>
                                <td align='center'>Dibuat Oleh</td>
                                <td align='center'>Tanggapan</td>
                                <td align='center'>Tanggal Dibuat</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (empty($Data_tanggapan)) { } else {
                                $no = 1;
                                foreach ($Data_tanggapan as $d) {

                                    $username = $this->session->userdata('username');
                                    $user_type = $this->session->userdata('stts');
                                    $id_lokasi_kerja = $this->session->userdata('lokasi_kerja');
                                    $id_pegawai = $this->session->userdata('id_pegawai');
                                    ?>
                                    <tr>
                                        <td style="font-size: 14px;"><?php echo $d->nama_lengkap; ?></td>
                                        <td style="font-size: 14px;"><?php echo $d->Tanggapan; ?></td>
                                        <td align='center' style="font-size: 14px;"><?php echo $d->Created_at; ?></td>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>


                </div>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-sm btn-danger" data-dismiss="modal" style='float:right;'>
                                    &nbsp;&nbsp;&nbsp;Tutup&nbsp;&nbsp;&nbsp;
                                </button>
                            </div>
                        </div>
                    </div>
                </td>

            </div>
        </div>
    </div>
</div>