<style type="text/css">
    .modal-header {
        background-color: #1c8baf;
        padding: 16px 16px;
        color: #FFF;
    }

    label {
        font-weight: bold;
    }

    /* Important part */
    .modal-dialog {
        /* overflow-y: initial !important */
    }

    .content {
        min-height: auto;
    }
</style>


<div class="box-body">

    <div class="container" style="width:auto;">
        <div class="timeline">
            <ul class="ul-li-timeline">

                <?php
                if (isset($data_history)) {
                    foreach ($data_history as $data) {
                        $nama_user = ucwords(strtolower($this->func_table->removeTitleFromName($data->nama_pegawai)));
                        echo '
                <li class="ul-li-timeline">
                    <div class="content">
                        <h3>' . date_format(date_create($data->created_at), 'd M Y - H:i:s') . '</h3>
                        <p>' . $data->nama_status . '';
                        if ($data->id_status == '24' or $data->id_status == '25' or $data->id_status == '26' or $data->id_status == '28') {
                            echo '<br><br>Alasan ditolak: ';
                            if ($data->keterangan_ditolak == '') {
                                echo '-';
                            } else {
                                echo $data->keterangan_ditolak;
                            }
                        }
                        echo '</p>
                    </div>
                    
                    <div class="point"></div>

                    <div class="date">
                        <h4 style="padding: 15px 0;">' . $nama_user . '</h4>
                    </div>
                </li>
                    ';
                    }



                    $tunjangan_id = $data->tunjangan_id;
                    $this->db->select('is_dinas');
                    $is_dinas = $this->db->get_where('tr_tunjangan', array('tunjangan_id' => $tunjangan_id))->row()->is_dinas;

                    switch ($is_dinas) {
                        case 1:
                            if (
                                $data->id_status == '0' or  // menunggu
                                $data->id_status == '24'    // ditolak admin
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Verifikasi Admin</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data->id_status == '0' or  // menunggu
                                $data->id_status == '21' or // verifikasi admin
                                $data->id_status == '25'    // ditolak kasubbag kepegawaian
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Verifikasi Kepala Subbagian Kepegawaian</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data->id_status == '0' or  // menunggu
                                $data->id_status == '21' or // verifikasi admin
                                $data->id_status == '22' or // verifikasi kasubbag
                                $data->id_status == '26'    // ditolak sekdis
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Verifikasi Sekretaris Dinas</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data->id_status == '0' or  // menunggu
                                $data->id_status == '21' or // verifikasi admin
                                $data->id_status == '22' or // verifikasi kasubbag
                                $data->id_status == '23'    // verifikasi sekdis
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }

                            break;

                        case 0:
                        case 2:
                            if (
                                $data->id_status == '0' or  // menunggu
                                $data->id_status == '24'    // ditolak admin
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Verifikasi Admin</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data->id_status == '0' or  // menunggu
                                $data->id_status == '21' or // verifikasi admin
                                $data->id_status == '28'    // ditolak kasubbag
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Verifikasi Kepala Subbagian</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }
                            if (
                                $data->id_status == '0' or  // menunggu
                                $data->id_status == '21' or // verifikasi admin
                                $data->id_status == '27'    // verifikasi kasubbag
                            ) {
                                echo '
                                <li class="ul-li-timeline">
                                    <div class="content">
                                        <h3>-</h3>
                                        <p  style="background-color: ">Selesai</p>
                                    </div>
                                    
                                    <div class="point"></div>

                                    <div class="date">
                                        <h4 style="padding: 15px 0; background-color: ;">-</h4>
                                    </div>
                                </li>
                                ';
                            }

                            break;
                    }
                }
                ?>

            </ul>
        </div>
    </div>

</div>

<hr style="border: 1px solid #1c8baf; margin-bottom: 15px; ">

<div class="control-group">
    <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="tutup_form()">
        <i class="fa fa-times"></i>&nbsp;&nbsp;Tutup
    </button>
</div>