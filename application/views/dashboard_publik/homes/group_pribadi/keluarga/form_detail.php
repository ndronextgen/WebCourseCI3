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
                            <td class="td-title">Hubungan Keluarga</td>
                            <td class="td-colon">:</td>
                            <td style="width: 200px;">
                                <?php
                                if ($data->hub_keluarga !== '1') {
                                    $hub_kel_desc = $this->db->select('keterangan')->get_where('tbl_master_hubungan_keluarga', array('kode' => $data->hub_keluarga))->row()->keterangan;
                                    echo $hub_kel_desc;
                                } else {
                                    // === gender ===
                                    $nrk = $this->session->userdata('username');
                                    $jen_kel = $this->db->select('jenis_kelamin')->get_where('tbl_data_pegawai', array('nrk' => $nrk))->row()->jenis_kelamin;
                                    $jen_kel = strtolower($jen_kel);

                                    if ($jen_kel == 'laki-laki') {
                                        echo 'Istri';
                                    } elseif ($jen_kel == 'perempuan') {
                                        echo 'Suami';
                                    } else {
                                        echo 'Istri / Suami';
                                    }
                                };
                                ?>
                            </td>

                            <td class="td-title">Alamat</td>
                            <td class="td-colon">:</td>
                            <td><?php echo ($data->alamat_sdp == 1) ? '(Sama dengan pegawai)<br>' . $data->alamat : $data->alamat; ?></td>
                        </tr>
                        <tr>
                            <td class="td-title">Keterangan</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $data->uraian; ?></td>

                            <?php if ($data->hub_keluarga == 1) { ?>
                                <td class="td-title">Tempat Pernikahan</td>
                                <td class="td-colon">:</td>
                                <td><?php echo $data->tempat_nikah; ?></td>
                            <?php } else if ($data->hub_keluarga == 2) { ?>
                                <td class="td-title">NIK</td>
                                <td class="td-colon">:</td>
                                <td><?php echo $data->nik; ?></td>
                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="td-title">Nama Keluarga</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $data->nama_anggota_keluarga; ?></td>

                            <?php if ($data->hub_keluarga == 1) { ?>
                                <td class="td-title">Tanggal Pernikahan</td>
                                <td class="td-colon">:</td>
                                <td><?= ($data->tanggal_nikah == null) ? '' : date_format(date_create($data->tanggal_nikah), 'j M Y'); ?></td>
                            <?php } else if ($data->hub_keluarga == 2) { ?>
                                <td class="td-title">Pekerjaan / Sekolah</td>
                                <td class="td-colon">:</td>
                                <td><?php echo $data->pekerjaan_sekolah; ?></td>
                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="td-title">Jenis Kelamin</td>
                            <td class="td-colon">:</td>
                            <td>
                                <?php
                                // echo $data->jenis_kelamin; 
                                if ($data->jenis_kelamin == '1') {
                                    echo 'Laki-Laki';
                                } elseif ($data->jenis_kelamin == '2') {
                                    echo 'Perempuan';
                                }
                                ?>
                            </td>

                            <?php if ($data->hub_keluarga == 1) { ?>
                                <td class="td-title">PNS / Non-PNS</td>
                                <td class="td-colon">:</td>
                                <td><?php echo ($data->pns_nonpns == 1) ? 'PNS' : 'Non-PNS'; ?></td>
                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="td-title">Tempat Lahir</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $data->tempat_lahir; ?></td>

                            <?php if ($data->hub_keluarga == 1) { ?>
                                <td class="td-title">NIK</td>
                                <td class="td-colon">:</td>
                                <td><?php echo $data->nik; ?></td>
                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td class="td-title">Tanggal Lahir</td>
                            <td class="td-colon">:</td>
                            <td><?= date_format(date_create($data->tanggal_lahir_keluarga), 'j M Y'); ?></td>

                            <?php if ($data->hub_keluarga == 1) { ?>
                                <td class="td-title">Pekerjaan / Sekolah</td>
                                <td class="td-colon">:</td>
                                <td><?php echo $data->pekerjaan_sekolah; ?></td>
                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>

                        <?php
                        if ($data->agama == 0) {
                            $agama = $data->agama_lainnya;
                        } else {
                            $agama = $this->db->select('agama')->get_where('mt_agama', array('kode' => $data->agama))->row()->agama;
                        }
                        ?>
                        <tr>
                            <td class="td-title">Agama</td>
                            <td class="td-colon">:</td>
                            <td><?php echo $agama; ?></td>

                            <?php
                            if ($data->pns_nonpns == 1) {
                                ?>
                                <td class="td-title">Pangkat / Golongan Ruang</td>
                                <td class="td-colon">:</td>
                                <td><?php echo $data->pangkat_golongan; ?></td>
                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>

                        <tr>
                            <td colspan='6'>
                                <h5><i class="flaticon-file-1"></i> File</h5>
                                <table class="table table-bordered table-hover" style='font-size: 10px; width: 0px;'>

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
                            <button type="button" data-toggle="tooltip" title="Tutup" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form_2()">
                                &nbsp;&nbsp;&nbsp;Tutup&nbsp;&nbsp;&nbsp;
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>