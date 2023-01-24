<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title"><a data-toggle="collapse" href="#detail_pengaduan"><i class="fa fa-angle-double-right"></i> Detail Surat Hukuman Disiplin</a></h5>
        </div>
        <div id="detail_pengaduan" class="panel-collapse expand collapse show">

            <br>
            <h4 style='text-align: center;'>
                Surat Hukuman Disiplin
            </h4>
            <input type='hidden' value='<?php echo $Hukdis_id; ?>' name='Hukdis_id' id='Hukdis_id'>
            <table class='table no-border' cellspacing='10' cellpadding='5'>
                <tr>
                    <td width='200px'>Nama Lengkap</td>
                    <td width='1px'>:</td>
                    <td><?php echo ucwords(strtolower($Data->nama_pegawai)); ?></td>
                </tr>
                <tr>
                    <td>NIP / NRK</td>
                    <td>:</td>
                    <td><?php echo $Data->nip . ' / ' . $Data->nrk; ?></td>
                </tr>
                <tr>
                    <td>Pangkat / Golongan</td>
                    <td>:</td>
                    <td><?php echo ucwords(strtolower($Data->uraian)) . ' ( ' . $Data->golongan . ' )'; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?php echo ucwords(strtolower($Data->nama_jabatan)); ?></td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td>:</td>
                    <td><?php echo str_replace('Dan', 'dan', str_replace('Dki', 'DKI', ucwords(strtolower($Data->nama_lokasi_kerja)))); ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?php echo $Data_hukdis->nama_type; ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>

<br>
<hr>
<h4 style='text-align: center;'>
    Timeline Surat
</h4>
<br>

<!-- <?php
        echo '<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="history" data-ktwizard-state="step-first">';
        echo '<div class="kt-grid__item">';
        echo '<div class="kt-wizard-v1__nav">';
        echo '<div class="kt-wizard-v1__nav-items">';
        $i = 1;
        foreach ($Query_history as $hist) {
            $active = '';
            $txt = '';
            $download_file = '';

            if ($hist->Status_progress == $Data_hukdis->Status_progress) {
                $active = 'current';
            } else {
                $active = '';
            }

            echo '  <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="' . $active . '">
                <div class="kt-wizard-v1__nav-body">
                    <div class="kt-wizard-v1__nav-icon"><i class="' . $hist->style . '"></i></div>
                    <div class="kt-wizard-v1__nav-label">' . $hist->nama_status . '</div>
                    <div class="kt-wizard-v2__nav-label-desc">' . $hist->Name_user . '<br />' . $hist->Created_at . '</div>
                </div>
            </div>';

            $i++;
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>'; ?> -->

<!-- start timeline -->
<div>
    <?php
    $data1['data_history'] = $Query_history;
    $this->load->view('dashboard_publik/template/timeline/timeline_content_2', $data1);
    ?>
</div>
<!-- end:timeline -->
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="batal_form_selesai()">Batal</button>&nbsp;&nbsp;
        </div>
    </div>
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