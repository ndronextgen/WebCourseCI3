<!-- <div class="box box-info"> -->
<!-- <div class="box-header"> -->
<div class="box-tools pull-right">
    <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
    <div id='loading'></div>
</div>
<!-- </div> -->
<div class="box-body">
    <form id="form_lapor" name="form_lapor" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="hr hr-18 hr-double dotted"></div> -->

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="NamaPegawai" class="form-control input-sm avoid-clicks" name="NamaPegawai" id="NamaPegawai" value="<?php echo $Data->nama_pegawai; ?>">

                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control input-sm avoid-clicks" name="NIP" id="NIP" value="<?php echo $Data->nip; ?>">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm avoid-clicks" name="Lahir_tgl" id="Lahir_tgl" value="<?php echo $Data->tanggal_lahir; ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Lokasi Kerja</label>
                            <textarea class="form-control input-sm avoid-clicks" name="lokasi_kerja" id="lokasi_kerja"><?php echo $Data->nama_lokasi_kerja; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Kategori Lapor</label>
                            <select class="form-control select" name="Kategori" id="Kategori">
                                <?php
                                foreach ($master_lapor as $d) {
                                    echo "<option value='$d->Uraian'";
                                    if ($d->Uraian == $Data_lapor->Kategori) {
                                        echo ' selected';
                                    }
                                    echo ">$d->Uraian</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Judul Lapor</label>
                                    <input type="text" class="form-control input-sm" name="Judul_laporan" id="Judul_laporan" value='<?php echo $Data_lapor->Judul_laporan; ?>'>
                                </div>
                            </div>
                        </div> -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Isi Lapor</label>
                            <textarea class="form-control input-sm" name="Isi_laporan" id="Isi_laporan"><?php echo $Data_lapor->Isi_laporan; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group"><label>File Lama</label>
                            <table class="table table-bordered table-hover" style='font-size:10px; width: 0px;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            $path_file = './asset/upload/Lapor/' . $Data_lapor->File_upload;
                                            
                                            $ci = &get_instance();
                                            $ci->load->library('func_table');
                                            $file = $ci->func_table->get_file($path_file, $Data_lapor->File_upload);

                                            echo $file;
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-10">
                        <div class="form-group">
                            <label>Upload File</label>
                            <input type="file" class="form-control input-sm" name="File_upload" id="File_upload">
                            <label style="font-size: 12px; font-style: italic;">*Format file berupa PDF, JPG, atau PNG.</label>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- <div class="row">
                    <div class="col-xs-8">
                        <div class="form-group">
                            <input type='hidden' value='<?php echo $Data_lapor->File_upload; ?>' name='File_upload_lama' Id='File_upload_lama'>
                            <input type='hidden' value='<?php echo $Id; ?>' name='Id' Id='Id'>

                            <button id='btn_tmb' type='button' onclick="simpan_lapor()" class='btn btn-block btn-success'>Simpan</button>
                            <div id='loading'></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <div id='loading'></div>
                        </div>
                    </div>
                </div> -->

                <div class="row pull-right" style="padding-right: 20px;">
                    <input type='hidden' value='<?php echo $Data_lapor->File_upload; ?>' name='File_upload_lama' Id='File_upload_lama'>
                    <input type='hidden' value='<?php echo $Id; ?>' name='Id' Id='Id'>
                    <button class="btn btn-sm btn-success btn-flat" onclick="simpan_lapor()" id="btn_tmb">Simpan Data Lapor</button>
                    <button class="btn btn-sm btn-danger btn-flat" data-dismiss="modal">Tutup</button>
                </div>


            </div>
        </div>

    </form>
</div><!-- /.box-body -->

<!-- </div> -->