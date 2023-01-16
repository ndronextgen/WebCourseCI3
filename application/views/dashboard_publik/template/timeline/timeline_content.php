<?php
if ($data_history->num_rows() > 0) {
    $rows = $data_history->num_rows();
    $row = 0;
    $data_id_status = '';
    $data_is_dinas = '';
    foreach ($data_history->result() as $data) {
        $row++;
        $state = ($row < $rows) ? 'past' : 'current';

        $nama_user = ucwords(strtolower($this->func_table->removeTitleFromName($data->nama_pegawai)));
        echo '
            <li class="ul-li-timeline">
                <div class="content">
                    <h3 class="item-' . $state . '-h3">' . date_format(date_create($data->created_at), 'd M Y - H:i:s') . '</h3>';
        echo '
            <p class="item-' . $state . '-p">' . $data->nama_status . '';
        if ($data->id_status == '24' or $data->id_status == '25' or $data->id_status == '26' or $data->id_status == '28') {
            echo '<br><br>Alasan ditolak: ';
            if ($data->keterangan_ditolak == '') {
                echo '-';
            } else {
                echo $data->keterangan_ditolak;
            }
        }
        echo '
            </p>
                </div>
                
                <div class="point"></div>

                <div class="date">
                    <h4 class="item-' . $state . '-h4" style="padding: 15px 0px;">' . $nama_user . '</h4>
                </div>
            </li>
                ';

        $data_id_status = $data->id_status;
        $data_is_dinas = $data->is_dinas;
    }

    if ($data_id_status == 24 or $data_id_status == 25 or $data_id_status == 26 or $data_id_status == 28) {
        goto exit_1;
    }

    // $id_srt = $data->id_srt;
    // $sSQL = "SELECT is_dinas from tbl_data_srt_ket where id_srt = '$id_srt'";
    // $is_dinas = $this->db->query($sSQL)->row()->is_dinas;

    switch ((int) $data_is_dinas) {
        case 1:
            if (
                $data_id_status == '0' or  // menunggu
                $data_id_status == '24'    // ditolak admin
            ) {
                echo '
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <!--<p  style="background-color: #aca9b1">Diverifikasi Admin</p>-->
                            <p class="item-future-p">Diverifikasi Admin</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    ';
            }
            if (
                $data_id_status == '0' or  // menunggu
                $data_id_status == '21' or // diverifikasi admin
                $data_id_status == '25'    // ditolak subkoordinator kepegawaian
            ) {
                echo '
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <p class="item-future-p">Diverifikasi Kepala Subkoordinator Kepegawaian</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    ';
            }
            if (
                $data_id_status == '0' or  // menunggu
                $data_id_status == '21' or // diverifikasi admin
                $data_id_status == '22' or // diverifikasi subkoordinator kepegawaian
                $data_id_status == '26'    // ditolak sekdis
            ) {
                echo '
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <p class="item-future-p">Diverifikasi Sekretaris Dinas</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <p class="item-future-p">Selesai</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    ';
            }
            if (
                // $data_id_status == '0' or  // menunggu
                // $data_id_status == '21' or // diverifikasi admin
                // $data_id_status == '22' or // diverifikasi subkoordinator kepegawaian
                $data_id_status == '23'    // diverifikasi sekdis
            ) {
                echo '
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <p class="item-future-p">Selesai</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    ';
            }

            break;

        case 0:
        case 2:
            if (
                $data_id_status == '0' or  // menunggu
                $data_id_status == '24'    // ditolak admin
            ) {
                echo '
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <p class="item-future-p">Diverifikasi Admin</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    ';
            }
            if (
                $data_id_status == '0' or  // menunggu
                $data_id_status == '21' or // diverifikasi admin
                $data_id_status == '28'    // ditolak kasubbag
            ) {
                echo '
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <p class="item-future-p">Diverifikasi Kepala Subbagian</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    ';
            }
            if (
                $data_id_status == '0' or  // menunggu
                $data_id_status == '21' or // diverifikasi admin
                $data_id_status == '27'    // diverifikasi kasubbag
            ) {
                echo '
                    <li class="ul-li-timeline">
                        <div class="content">
                            <h3 class="item-future-h3">-</h3>
                            <p class="item-future-p">Selesai</p>
                        </div>
                        
                        <div class="point"></div>

                        <div class="date">
                            <h4 class="item-future-h4" style="padding: 15px 0px;">-</h4>
                        </div>
                    </li>
                    ';
            }

            break;
    }

    exit_1:
}
