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
                        <td colspan="4"><?php echo $Data_dp3->Nama_pejabat_penilai; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Atasan Pejabat Penilai</td>
                        <td width='2px'>:</td>
                        <td colspan="4"><?php echo $Data_dp3->Nama_atasan_pejabat_penilai; ?></td>
                    </tr>



                    <tr>
                        <td width='200px'>Kesetiaan</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Kesetiaan; ?></td>
                        <td width='200px'>Kerja_sama</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Kerja_sama; ?></td>
                    </tr>

                    <tr>
                        <td width='200px'>Prestasi_kerja</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Prestasi_kerja; ?></td>
                        <td width='200px'>Prakarsa</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Prakarsa; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Tanggung_jawab</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Tanggung_jawab; ?></td>
                        <td width='200px'>Kepemimpinan</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Kepemimpinan; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Ketaatan</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Ketaatan; ?></td>
                        <td width='200px'>Jumlah</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Jumlah; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Kejujuran</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Kejujuran; ?></td>
                        <td width='200px'>Nilai_rata_rata</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Nilai_rata_rata; ?></td>
                    </tr>



                    <!-- <tr>
                        <td width='200px'>Kerja_sama</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Kerja_sama; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Prakarsa</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Prakarsa; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Kepemimpinan</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Kepemimpinan; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Jumlah</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Jumlah; ?></td>
                    </tr>
                    <tr>
                        <td width='200px'>Nilai_rata_rata</td>
                        <td width='2px'>:</td>
                        <td><?php echo $Data_dp3->Nilai_rata_rata; ?></td>
                    </tr> -->

                    <tr>
                        <td colspan='6'>
                            <h5><i class="flaticon-file-1"></i> File Lampiran</h5>
                            <table class="table table-bordered table-hover" style='font-size:10px; width: 0px;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            $path_file = 'asset/upload/SKP/SKP_' . $Data_dp3->id_dp3 . '_' . $Data_dp3->id_arsip_skp . '/' . $Data_dp3->file_name;

                                            $ci = &get_instance();
                                            $ci->load->library('func_table');
                                            $file = $ci->func_table->get_file($path_file, $Data_dp3->file_name_ori);
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
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style='float:right;'>Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.box-body -->
<!-- end view -->

<!-- </div> -->