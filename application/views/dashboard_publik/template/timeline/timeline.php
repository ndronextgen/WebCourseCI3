<style type="text/css">
    .modal-header {
        background-color: #1c8baf;
        padding: 16px 16px;
        color: #FFF;
    }

    label {
        font-weight: bold;
    }

    .modal-body {
        overflow-y: auto;
        /* overflow-x: scroll */
    }

    .content {
        min-height: auto;
    }

    .box-body {
        /* min-width: max-content; */
    }
</style>

<div class="box-body">

    <!-- <div class="container" style="width: auto;"> -->
    <!-- <div class="timeline"> -->
    <!-- <ul class="ul-li-timeline"> -->
    <?php
    $data1['data_history'] = $data_history;
    $this->load->view('dashboard_publik/template/timeline/timeline_content_2', $data1);
    ?>
    <!-- </ul> -->
    <!-- </div> -->
    <!-- </div> -->



    <hr style="border: 1px solid #1c8baf; margin-bottom: 15px; ">

    <div class="control-group">
        <button type="button" style='float:right;' class="btn btn-danger btn-sm" data-dismiss="modal"><i class=" fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
    </div>

</div>