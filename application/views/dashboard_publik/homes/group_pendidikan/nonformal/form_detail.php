<style type="text/css">
    label {
        font-weight: bold;
    }

    /* Important part */
    .modal-dialog {
        overflow-y: initial !important;
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
                <table class="table">
                    <tbody>
                        <tr>
                            <td width='200px'>Nama Pelatihan</td>
                            <td width='2px'>:</td>
                            <td><?php echo $data->nama_pelatihan; ?></td>
                        </tr>
                        <tr>
                            <td width='200px'>Lokasi</td>
                            <td width='2px'>:</td>
                            <td><?php echo $data->lokasi; ?></td>
                        </tr>
                        <tr>
                            <td width='200px'>Nomor Sertifikat</td>
                            <td width='2px'>:</td>
                            <td><?php echo $data->no_sertifikat; ?></td>
                        </tr>
                        <tr>
                            <td width='200px'>Tanggal Sertrifikat</td>
                            <td width='2px'>:</td>
                            <td><?php echo date_format(date_create($data->tanggal_sertifikat), 'j M Y'); ?></td>
                        </tr>
                        <tr>
                            <td width='200px'>Keterangan</td>
                            <td width='2px'>:</td>
                            <td><?php echo $data->uraian; ?></td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <h5><i class="flaticon-file-1"></i> File</h5>
                                <table class="table table-bordered table-hover" style='font-size:10px; width: 0px;'>

                                    <tbody>

                                        <tr>
                                            <td>
                                                <?php
                                                $path_file = $path_file . '/' . $data->file_name;

                                                $ci = &get_instance();
                                                $ci->load->library('func_table');
                                                $file = $ci->func_table->get_file($path_file, $data->file_name_ori);
                                                echo $file;
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="button" data-toggle="tooltip" title="Close/Tutup Form Detail" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form_1()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>