<ul class="pager subnav-pager" style='padding-bottom: -10px;margin-bottom: -9px;margin-top: -22px;'>
    <div class="btn-group-wrap">
        <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0);" id='pegawai' onclick="load_data('data_pegawai')"><i class="fa fa-angle-double-right"></i> <b>Data Pegawai</b></a></li>
        <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0);" id='pribadi' onclick="load_data('group_pribadi')"><i class="fa fa-angle-double-right"></i> <b>Data Pribadi</b></a></li>
        <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0);" id='skgubernur' onclick="load_data('group_sk_gubernur')"><i class="fa fa-angle-double-right"></i> <b>SK Pegawai</b></a></li>
        <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0);" id='pendidikan' onclick="load_data('group_pendidikan')"><i class="fa fa-angle-double-right"></i> <b>Pendidikan</b></a></li>
        <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0);" id='penghargaan' onclick="load_data('data_penghargaan')"><i class="fa fa-angle-double-right"></i> <b>Penghargaan</b></a></li>
        <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0);" id='tubel' onclick="load_data('data_tubel')"><i class="fa fa-angle-double-right"></i> <b>Tugas & Izin Belajar</b></a></li>
        <li><a style='background-color: #3c8dbc;border: 1px solid #fff;color:#fff;' href="javascript:void(0);" id='group_skpdp3' onclick="load_data('group_skpdp3')"><i class="fa fa-angle-double-right"></i> <b>SKP / DP3</b></a></li>
    </div>
</ul>

<!-- MAIN CONTENT -->
<div id='ajax_table'></div>

<script type="text/javascript">
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

    // ----- end date

    function load_data(type) {
        if (type == "data_pegawai") {
            var urls = "<?php echo site_url('Dashboard_publik/data_pegawai'); ?>";
            $('#pegawai').addClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').removeClass('active');
            $('#tubel').removeClass('active');
            $('#penghargaan').removeClass('active');
            $('#pendidikan').removeClass('active');
            $('#skgubernur').removeClass('active');
            $('#pribadi').removeClass('active');
        // } else if (type == "data_hukuman") {
        //     var urls = "<?php echo site_url('Dashboard_publik/data_hukuman'); ?>";
        //     $('#pegawai').removeClass('active');
        //     $('#hukuman').addClass('active');
        //     $('#group_skpdp3').removeClass('active');
        //     $('#tubel').removeClass('active');
        //     $('#penghargaan').removeClass('active');
        //     $('#pendidikan').removeClass('active');
        //     $('#skgubernur').removeClass('active');
        //     $('#pribadi').removeClass('active');
        } else if (type == "group_skpdp3") {
            var urls = "<?php echo site_url('Dashboard_publik/group_skpdp3'); ?>";
            $('#pegawai').removeClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').addClass('active');
            $('#tubel').removeClass('active');
            $('#penghargaan').removeClass('active');
            $('#pendidikan').removeClass('active');
            $('#skgubernur').removeClass('active');
            $('#pribadi').removeClass('active');
        } else if (type == "data_tubel") {
            var urls = "<?php echo site_url('Dashboard_publik/data_tubel'); ?>";
            $('#pegawai').removeClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').removeClass('active');
            $('#tubel').addClass('active');
            $('#penghargaan').removeClass('active');
            $('#pendidikan').removeClass('active');
            $('#skgubernur').removeClass('active');
            $('#pribadi').removeClass('active');
        } else if (type == "data_penghargaan") {
            var urls = "<?php echo site_url('Dashboard_publik/data_penghargaan'); ?>";
            $('#pegawai').removeClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').removeClass('active');
            $('#tubel').removeClass('active');
            $('#penghargaan').addClass('active');
            $('#pendidikan').removeClass('active');
            $('#skgubernur').removeClass('active');
            $('#pribadi').removeClass('active');
        } else if (type == "group_pendidikan") {
            var urls = "<?php echo site_url('Dashboard_publik/group_pendidikan'); ?>";
            $('#pegawai').removeClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').removeClass('active');
            $('#tubel').removeClass('active');
            $('#penghargaan').removeClass('active');
            $('#pendidikan').addClass('active');
            $('#skgubernur').removeClass('active');
            $('#pribadi').removeClass('active');
        } else if (type == "group_sk_gubernur") {
            var urls = "<?php echo site_url('Dashboard_publik/group_sk_gubernur'); ?>";
            $('#pegawai').removeClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').removeClass('active');
            $('#tubel').removeClass('active');
            $('#penghargaan').removeClass('active');
            $('#pendidikan').removeClass('active');
            $('#skgubernur').addClass('active');
            $('#pribadi').removeClass('active');
        } else if (type == "group_pribadi") {
            var urls = "<?php echo site_url('Dashboard_publik/group_pribadi'); ?>";
            $('#pegawai').removeClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').removeClass('active');
            $('#tubel').removeClass('active');
            $('#penghargaan').removeClass('active');
            $('#pendidikan').removeClass('active');
            $('#skgubernur').removeClass('active');
            $('#pribadi').addClass('active');
        } else if (type == "edit_pegawai") {
            var urls = "<?php echo site_url('Dashboard_publik/edit_pegawai'); ?>";
            $('#pegawai').addClass('active');
            $('#hukuman').removeClass('active');
            $('#group_skpdp3').removeClass('active');
            $('#tubel').removeClass('active');
            $('#penghargaan').removeClass('active');
            $('#pendidikan').removeClass('active');
            $('#skgubernur').removeClass('active');
            $('#pribadi').removeClass('active');
        }

        $.ajax({
            type: "POST",
            url: urls,
            beforeSend: function(b) {
                var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
                $('#ajax_table').html(percentVal);
            },
            success: function(s) {
                $('#ajax_table').html(s);
            }
        });
    }
    load_data('data_pegawai');
</script>

<!-- ======================================================= -->
<!-- ==================== BEGIN: MODALS ==================== -->
<!-- ======================================================= -->

<!-- Bootstrap modal -->
<div class="modal fade" id="add_koordinat" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" align="center">Koordinat Alamat Anda</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <div class="control-label">
                        <!-- <div id="viewDiv" align="center" style="height:530px;width:565px;overflow:visible;"></div> -->
                        <div id="viewDiv" style="width: 100%; height: 750px;"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" aria-label="Close"> Simpan</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal download -->
<div class="modal modal-primary fade" id="modal-download-arsip" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon ion-ios-paper"></i> Download File </h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Men-download File &nbsp;<i class="fa fa-refresh fa-spin"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bootstrap modal -->

<!-- modal download -->
<div class="modal modal-primary fade" id="modal-download" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon ion-ios-paper"></i> Download File </h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Men-download File &nbsp;<i class="fa fa-refresh fa-spin"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal kabeh -->
<div class="modal fade" id="modal_all" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-family: 'Source Sans Pro', sans-serif;">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
            <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-success" onClick="simpan_modal()">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan
                    </button>
                </div> -->
        </div>
    </div>
</div>

<!-- Modal kabeh -->
<div class="modal fade" id="modal_all_md" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-family: 'Source Sans Pro', sans-serif;">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- ==================== END: MODALS ==================== -->
<!-- ===================================================== -->