<?php
    if ($data_history->num_rows() > 0) {
        $rows = $data_history->num_rows();
        $row = 0;
        $data_id_status = '';
        $data_is_dinas = '';

        $status_start = 'flaticon-background';
        $status_proses = 'flaticon-interface-4';
        $status_warning = 'flaticon-exclamation';
        $status_finish = 'flaticon-interface-10';



        echo '<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" data-ktwizard-state="step-first" style="width: 100%;">';
        echo '<div class="kt-grid__item">';
        echo '<div class="kt-wizard-v1__nav">';
        echo '<div class="kt-wizard-v1__nav-items">';

        foreach ($data_history->result() as $data) {
            $row++;
            $active = '';
            $download_file = '';

            $active = ($row < $rows) ? '' : 'current';

            echo '
            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                <div class="kt-wizard-v1__nav-body">
                    <div class="kt-wizard-v1__nav-icon"><i class="' . $data->style . '"></i></div>
                    <div class="kt-wizard-v1__nav-label">' . $data->nama_status . '</div>
                    <div class="kt-wizard-v2__nav-label-desc">' . ucwords(strtolower($data->nama_pegawai)) . '<br />' . $data->created_at . '</div><br>' . $download_file . '
                </div>
            </div>
            ';

            $data_id_status = $data->id_status;
            $data_is_dinas = $data->is_dinas;
        }

        $active = '';

        if ($data_id_status == 24 or $data_id_status == 25 or $data_id_status == 26 or $data_id_status == 28) {
            goto exit_1;
        }

        switch ((int) $data_is_dinas) {
            case 1:
                if (
                    $data_id_status == '0' or  // menunggu
                    $data_id_status == '24'    // ditolak admin
                ) {
                    echo '
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_proses . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Diverifikasi Admin</div>
                    </div>
                </div>
                ';
                }
                if (
                    $data_id_status == '0' or  // menunggu
                    $data_id_status == '21' or // diverifikasi admin
                    $data_id_status == '25'    // ditolak subkoordinator kepegawaian
                ) {
                    echo '
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_proses . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Diverifikasi Kepala Subkoordinator Kepegawaian</div>
                    </div>
                </div>
                ';
                }
                if (
                    $data_id_status == '0' or  // menunggu
                    $data_id_status == '21' or // diverifikasi admin
                    $data_id_status == '22' or // diverifikasi subkoordinator kepegawaian
                    $data_id_status == '26'    // ditolak sekdis
                ) {
                    echo '                            
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_proses . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Diverifikasi Sekretaris Dinas</div>
                    </div>
                </div>
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_finish . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Selesai</div>
                    </div>
                </div>
                ';
                }
                if (
                    // $data_id_status == '0' or  // menunggu
                    // $data_id_status == '21' or // diverifikasi admin
                    // $data_id_status == '22' or // diverifikasi subkoordinator kepegawaian
                    $data_id_status == '23'    // diverifikasi sekdis
                ) {
                    echo '
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_finish . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Selesai</div>
                    </div>
                </div>
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
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_proses . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Diverifikasi Admin</div>
                    </div>
                </div>
                ';
                }
                if (
                    $data_id_status == '0' or  // menunggu
                    $data_id_status == '21' or // diverifikasi admin
                    $data_id_status == '28'    // ditolak kasubbag
                ) {
                    echo '
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_proses . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Diverifikasi Kepala Subbagian</div>
                    </div>
                </div>
                    ';
                }
                if (
                    $data_id_status == '0' or  // menunggu
                    $data_id_status == '21' or // diverifikasi admin
                    $data_id_status == '27'    // diverifikasi kasubbag
                ) {
                    echo '
                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                    <div class="kt-wizard-v1__nav-body">
                        <div class="kt-wizard-v1__nav-icon"><i class="' . $status_finish . '"></i></div>
                        <div class="kt-wizard-v1__nav-label">Selesai</div>
                    </div>
                </div>
                ';
                }

                break;
        }

        exit_1: 
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
