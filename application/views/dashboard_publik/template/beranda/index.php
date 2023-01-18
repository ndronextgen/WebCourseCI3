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
<!-- ==================== BEGIN: ARCGIS ==================== -->
<!-- ======================================================= -->

<?php
//106.8456 -6.20876


if ($longitude == "") {
    $long = 106.798;
} else {
    $long = $longitude;
}
if ($latitude == "") {
    $lat = -6.176;
} else {
    $lat = $latitude;
}
?>

<!-- Coding javascript api for arcgis untuk menampilkan peta -->
<script type="text/javascript">
    var lokasibaru = [<?php echo $long; ?>, <?php echo $lat; ?>, 2000];
    var map;

    require([
        "esri/Map",
        "esri/views/MapView",
        "esri/layers/FeatureLayer",
        "esri/layers/VectorTileLayer",
        "esri/Basemap",
        "esri/widgets/LayerList",
        "esri/layers/GroupLayer",
        "esri/layers/MapImageLayer",
        "esri/widgets/Sketch",
        "esri/widgets/Slider",
        "esri/Graphic",
        "esri/layers/GraphicsLayer",
        "esri/geometry/Point",
        "esri/symbols/SimpleMarkerSymbol",
        "esri/widgets/Search",
        "esri/widgets/Locate",
    ], (
        Map,
        MapView,
        FeatureLayer,
        VectorTileLayer,
        Basemap,
        LayerList,
        GroupLayer,
        MapImageLayer,
        Sketch,
        Slider,
        Graphic,
        GraphicsLayer,
        Point,
        SimpleMarkerSymbol,
        Search,
        Locate
    ) => {
        let vtlLayer = new VectorTileLayer({
            url: "https://jakartasatu.jakarta.go.id/server/rest/services/Hosted/peta_dasar_update_2019_vt/VectorTileServer",
        });

        var petsstruktur = new MapImageLayer({
            url: "https://jakartasatu.jakarta.go.id/server/rest/services/DCKTRP/Peta_Struktur_Jakarta_2018_Garis/MapServer/",
            title: "Peta Struktur",
        });

        // var zonasi = new MapImageLayer({
        // 	//url: "https://tataruang.jakarta.go.id/server/rest/services/peta_operasional/Informasi_Rencana_Kota_DKI_Jakarta_View/MapServer",
        // 	url: "https://tataruang.jakarta.go.id/server/rest/services/RDTR_2022/Rencana_Pola_Ruang_RDTR_2022/MapServer",
        // 	title: "Zonasi",
        // });

        var zonasi = new FeatureLayer({
            //url: "https://tataruang.jakarta.go.id/server/rest/services/peta_operasional/Informasi_Rencana_Kota_DKI_Jakarta_View/MapServer",
            url: "https://tataruang.jakarta.go.id/server/rest/services/RDTR_2022/Rencana_Pola_Ruang_RDTR_2022/MapServer",
            title: "Zonasi",
        });

        var citraDKI = new MapImageLayer({
            url: "https://jakartasatu.jakarta.go.id/imageserver/rest/services/Citra/CitraDKI2020_EditMask/MapServer",
            title: "Citra DKI",
        });

        // var batasadministrasi = new FeatureLayer({
        //     url: "https://tataruang.jakarta.go.id/server/rest/services/Batas_Administrasi_Update/Batas_Administrasi_DKI_Jakarta_Update_View/MapServer/",
        //     visible: false,
        // });

        const demographicGroupLayer = new GroupLayer({
            title: "PETA STRUKTUR",
            visible: true,
            //visibilityMode: "independent",
            visibilityMode: "exclusive",
            layers: [zonasi, citraDKI, petsstruktur],
            //opacity: 0.75
        });

        let basemapDKI = new Basemap({
            baseLayers: [vtlLayer],
        });

        var map = new Map({
            basemap: 'osm',
            layers: [demographicGroupLayer],
        });

        var view = new MapView({
            container: "viewDiv",
            center: lokasibaru, //lonlat
            //center: [106.82737800062135, -6.176139634482833], //lonlat
            map: map,
            zoom: 17,
        });

        var point = new Point({
            longitude: <?php echo $long; ?>,
            latitude: <?php echo $lat; ?>
        });

        // Create a symbol for drawing the point
        var markerSymbol = new SimpleMarkerSymbol({
            color: [226, 119, 40],
            outline: {
                color: [255, 255, 255],
                width: 1
            }
        });

        // Create a graphic and add the geometry and symbol to it
        var pointGraphic = new Graphic({
            geometry: point,
            symbol: markerSymbol
        });

        // Add the graphic to the view
        view.graphics.add(pointGraphic);

        // setting opacity dll
        function defineActions(event) {
            const item = event.item;

            if (item.title === "PETA STRUKTUR") {
                item.actionsSections = [
                    [{
                            title: "Go to full extent",
                            className: "esri-icon-zoom-out-fixed",
                            id: "full-extent",
                        },
                        {
                            title: "Layer information",
                            className: "esri-icon-description",
                            id: "information",
                        },
                    ],
                    [{
                            title: "Increase opacity",
                            className: "esri-icon-up",
                            id: "increase-opacity",
                        },
                        {
                            title: "Decrease opacity",
                            className: "esri-icon-down",
                            id: "decrease-opacity",
                        },
                    ],
                ];
            }

            // Adds a slider for updating a group layer's opacity
            if (item.children.length > 1 && item.parent) {
                const slider = new Slider({
                    min: 0,
                    max: 1,
                    precision: 2,
                    values: [1],
                    visibleElements: {
                        labels: true,
                        rangeLabels: true,
                    },
                });

                item.panel = {
                    content: slider,
                    className: "esri-icon-sliders-horizontal",
                    title: "Change layer opacity",
                };

                slider.on("thumb-drag", (event) => {
                    const {
                        value
                    } = event;
                    item.layer.opacity = value;
                });
            }
        }
        // end ,defineActions

        view.when(() => {
            const layerList = new LayerList({
                view: view,
                listItemCreatedFunction: defineActions,
            });

            layerList.on("trigger-action", (event) => {
                const visibleLayer = zonasi.visible ? zonasi : citraDKI;

                const id = event.action.id;

                if (id === "full-extent") {
                    view.goTo(visibleLayer.fullExtent).catch((error) => {
                        if (error.name != "AbortError") {
                            console.error(error);
                        }
                    });
                } else if (id === "information") {
                    window.open(visibleLayer.url);
                } else if (id === "increase-opacity") {
                    if (demographicGroupLayer.opacity < 1) {
                        demographicGroupLayer.opacity += 0.25;
                    }
                } else if (id === "decrease-opacity") {
                    if (demographicGroupLayer.opacity > 0) {
                        demographicGroupLayer.opacity -= 0.25;
                    }
                }
            });
            view.ui.add(layerList, "top-right");
        });

        const searchWidget = new Search({
            view: view,
            popupEnabled: false,
        });
        searchWidget.on("search-clear", function(event) {
            view.graphics.removeAll();
            $("input#longitude").val("");
            $("input#latitude").val("");
            $("input#pid").val("");
        });
        searchWidget.on("search-complete", function(result) {
            if (
                result.results &&
                result.results.length > 0 &&
                result.results[0].results &&
                result.results[0].results.length > 0
            ) {
                var geom = result.results[0].results[0].feature.geometry;
                console.info(geom);
                $("input#longitude").val(Math.round(geom.longitude * 100000) / 100000);
                $("input#latitude").val(Math.round(geom.latitude * 100000) / 100000);

                let point = {
                    type: "point", // autocasts as new Point()
                    longitude: Math.round(geom.longitude * 100000) / 100000,
                    latitude: Math.round(geom.latitude * 100000) / 100000,
                };

                // Create a symbol for drawing the point
                let markerSymbol = {
                    type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
                    color: [21, 73, 158],
                };

                // Create a graphic and add the geometry and symbol to it
                let pointGraphic = new Graphic({
                    geometry: point,
                    symbol: markerSymbol,
                });
                var pid = $("input#pid").val();
                if (pid == "") {
                    $("input#pid").val("");
                    view.graphics.removeAll();
                    view.graphics.add(pointGraphic);
                } else {
                    $("input#pid").val("");
                }
            } else {
                $("input#longitude").val("");
                $("input#latitude").val("");
                $("input#pid").val("");
            }
        });

        //search.defaultSource.withinViewEnabled = false; // Limit search to visible map area only
        view.ui.add(searchWidget, "top-right"); // Add to the map

        view.on("click", function(evt) {
            // Create a graphic and add the geometry and symbol to it
            var graphic = new Graphic({
                geometry: {
                    type: "point",
                    latitude: evt.mapPoint.latitude,
                    longitude: evt.mapPoint.longitude,
                    spatialReference: view.spatialReference,
                },
                symbol: {
                    type: "simple-marker", // autocasts as new SimpleFillSymbol
                    color: [21, 73, 158],
                    outline: {
                        // autocasts as new SimpleLineSymbol()
                        color: [19, 20, 23],
                        width: 2,
                    },
                },
            });
            view.graphics.removeAll();
            view.graphics.add(graphic);

            searchWidget.search(evt.mapPoint);
            searchWidget.resultGraphicEnabled = false;

            $("input#pid").val("1");
            $("input#longitude").val(Math.round(evt.mapPoint.longitude * 100000) / 100000);
            $("input#latitude").val(Math.round(evt.mapPoint.latitude * 100000) / 100000);
        });

        //     locateBtn.on('locate', function(pos){
        //   console.info(pos.position.coords.latitude, pos.position.coords.longitude);
        // });‍‍‍

        const locateWidget = new Locate({
            view: view,
            scale: 5000,
            useHeadingEnabled: false,
            graphic: new Graphic({
                symbol: {
                    type: "simple-marker",
                    color: [21, 73, 158],
                    outline: {
                        color: [19, 20, 23],
                        width: 2,
                    },
                },
            }),
        });
        view.ui.add(locateWidget, "top-left");

        //locateWidget.locate();

        locateWidget.on("locate", function(evt) {
            $("input#longitude").val(
                Math.round(evt.position.coords.longitude * 100000) / 100000
            );
            $("input#latitude").val(
                Math.round(evt.position.coords.latitude * 100000) / 100000
            );
            //--
            let point = {
                type: "point", // autocasts as new Point()
                longitude: Math.round(evt.position.coords.longitude * 100000) / 100000,
                latitude: Math.round(evt.position.coords.latitude * 100000) / 100000,
            };

            // Create a symbol for drawing the point
            let markerSymbol = {
                type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
                color: [21, 73, 158],
            };

            // Create a graphic and add the geometry and symbol to it
            let pointGraphic = new Graphic({
                geometry: point,
                symbol: markerSymbol,
            });
            var pid = $("input#pid").val();
            if (pid == "") {
                $("input#pid").val("");
                view.graphics.removeAll();
                view.graphics.add(pointGraphic);
            } else {
                $("input#pid").val("");
            }
        });
    });
</script>

<!-- ===================================================== -->
<!-- ==================== END: ARCGIS ==================== -->
<!-- ===================================================== -->

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