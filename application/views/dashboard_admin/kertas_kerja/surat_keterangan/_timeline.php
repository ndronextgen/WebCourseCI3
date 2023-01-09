<style type="text/css">
    .modal-content {
        width: fit-content;
    }

    .modal-header {
        background-color: #1c8baf;
        padding: 16px 16px;
        color: #FFF;
    }

    .modal-title {
        color: antiquewhite;
    }

    label {
        font-weight: bold;
    }

    .modal-body {
        width: 600px;
    }

    .content {
        min-height: auto;
    }
</style>

<div class="box-body">

    <div class="container" style="width: auto;">
        <div class="timeline">
            <ul class="ul-li-timeline">

                <?php
                $data1['data_history'] = $data_history;
                $this->load->view('dashboard_publik/kertas_kerja/keterangan_pegawai/timeline_content', $data1);
                ?>

            </ul>
        </div>
    </div>

</div>

<br>
<hr style="border: 1px solid #1c8baf; margin-bottom: 15px; ">

<div class="control-group">
    <button type="button" style='float:right;' class="btn btn-danger btn-sm" onclick="tutup_form()"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
</div>