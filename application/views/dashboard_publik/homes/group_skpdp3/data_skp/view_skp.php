<!-- <div class="box box-info"> -->
<!-- <div class="box-header"> -->
<div class="box-tools pull-right">
    <!-- <div class="label bg-aqua">Form Sisa Cuti Pegawai</div> -->
    <div id='loading'></div>
</div>
<!-- </div> -->

<!-- view -->
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tbody>
                    <tr>
                        <td width='200px'>Pegawai Yang Dinilai</td>
                        <td width='2px'>:</td>
                        <td colspan="4"><?php echo $Data->nama_pegawai; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>NIP</td>
                        <td width='2px'>:</td>
                        <td colspan="4"><?php echo $Data->nip; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Lokasi Kerja</td>
                        <td width='2px'>:</td>
                        <td colspan="4"><?php echo $Data->nama_lokasi_kerja; ?></td>
                    </tr>

                    <tr>
                        <td width='200px'>Pejabat Penilai</td>
                        <td width='2px'>:</td>
                        <td colspan="4"><?php echo $Data_skp->Nama_pejabat_penilai; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Atasan Pejabat Penilai</td>
                        <td width='2px'>:</td>
                        <td colspan="4"><?php echo $Data_skp->Nama_atasan_pejabat_penilai; ?></td>
                    </tr>


                    <tr>
                        <td width='200px'>Orientasi Pelayanan</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Orientasi_pelayanan; ?></td>
                        <td width='200px'>Disiplin</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Disiplin; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Integritas</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Integritas; ?></td>
                        <td width='200px'>Kerjasama</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Kerjasama; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Inisiatif Kerja</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Inisiatif_kerja; ?></td>
                        <td width='200px'>Kerjasama</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Kerjasama; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Komitmen</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Komitmen; ?></td>
                        <td width='200px'>Nilai_prestasi_kerja</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Nilai_prestasi_kerja; ?></td>
                    </tr>


                    <!-- <tr>
                        <td width='200px'>Disiplin</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Disiplin; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Kerjasama</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Kerjasama; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Kerjasama</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Kerjasama; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Nilai_prestasi_kerja</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_skp->Nilai_prestasi_kerja; ?></td>
                    </tr> -->

                    <tr>
                        <td colspan='6'>
                            <h5><i class="flaticon-file-1"></i> File Lampiran</h5>
                            <table class="table table-bordered table-hover" style='font-size:10px; width: 0px;'>

                                <tbody>

                                    <tr>
                                        <td>
                                            <?php
                                            $path_file = 'asset/upload/SKP/SKP_' . $Data_skp->id_dp3 . '_' . $Data_skp->id_arsip_skp . '/' . $Data_skp->file_name;

                                            $ci = &get_instance();
                                            $ci->load->library('func_table');
                                            $file = $ci->func_table->get_file($path_file, $Data_skp->file_name_ori);
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

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="button" data-toggle="tooltip" title="Close/Tutup Form Detail" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form_2()">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.box-body -->
<!-- end view -->

<!-- </div> -->