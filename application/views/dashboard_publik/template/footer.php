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

<script type="text/javascript">
    function batal_form_1() {
        $('#modal_all_md').modal('hide');
    }

    function batal_form_2() {
        $('#modal_all').modal('hide');
    }
</script>

<style type="text/css">
    .info_pop {
        border: none;
        border-radius: 40px 10px;
        background: #e0e0de;
        font-size: 16px;
        font-weight: bold;
        font-family: "Arial Narrow";
        padding: 10px;
    }

    ol {
        counter-reset: item;
        list-style-type: none;
        line-height: 2.2;
        margin-left: -40px;
    }

    ol li {
        list-style-type: none;
        counter-increment: item;
    }

    ol li:before {
        content: counter(item);
        margin-right: 5px;
        font-size: 80%;
        background-color: #f9dd94;
        color: #7eb4e2;
        font-weight: bold;
        padding: 3px 8px;
        border-radius: 3px;
    }
</style>

<?php if (!empty($this->session->userdata("isUserShowPopup")) && !$this->session->userdata("alreadyOpenPopup")) { ?>
    <script type="text/javascript">
        function informasiList() {
            var html = "";
            <?php
                if (!empty($data_informasi)) :
                    foreach ($data_informasi as $pop) :
                        ?>
                    html += "<li><?= $pop->title; ?></li>";
            <?php
                    endforeach;
                endif;
                ?>
            return html;
        }
        Swal.fire({
            title: '',
            icon: 'info',
            width: 700,
            html: '<div class="info_pop">' +
                '<h3 style="font-family: Arial Narrow; color: #2c80f5; font-weight: bold;">' +
                '</h3>' +
                'Kami mengingatkan agar segera melengkapi data-data anda.<br>' +
                'Data yang diinput merupakan data yang sebenarnya dan dapat dipertanggungjawabkan.<br><br>' +
                '</div>' +
                '<hr>' +
                '<p style="font-weight: bold; color: red; font-size: 15px; font-family: Arial Narrow; text-align: left;">' +
                'Informasi Update Terbaru</p>' +
                '<ol style="text-align: left;font-size:15px;font-family: Arial Narrow;">' +

                informasiList() +

                '</ol>' +
                '<hr><p style="font-weight: bold; color: #2c80f5;font-size:15px;font-family: Arial Narrow;">Terima kasih</p>',
            customClass: {
                popup: 'format-pre'
            },
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Oke!',
            confirmButtonAriaLabel: 'Thumbs up, great!'
        }).then((result) => {
            $.ajax({
                url: "<?= base_url("dashboard_publik/Alreadyopenpopup"); ?>",
                type: "GET"
            });
        });
    </script>
<?php } ?>

<!-- SSO LIB -->
<script type="text/javascript" src="<?php echo base_url(); ?>asset/sso/js/all.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/sso/js/main.js"></script>

<script type="text/javascript">
    let sso = new SSO({
        sso_services_url: "https://dcktrp.jakarta.go.id/satuakses/service/",
    });
    sso.initComponent('#sso_widget');
    document.querySelector('#sso_floating_widget').style.zIndex = 99999;

    function under_maintenance() {
        $.dialog({
            icon: 'fa fa-info',
            title: 'Info',
            content: 'Sedang dalam pengerjaan...',
            type: 'red',
            backgroundDismiss: true
        });
    }

    // === begin: main container top menyesuikan tinggi navbar ===
    $(document).ready(function() {
        setTimeout(setPadding, 1000);
    });

    function setPadding() {
        $defaultNavbarHeight = 50;
        $navbarHeight = $('.navbar').height();
        $mainWrapperPadding = 5; //parseInt($(".content-wrapper").css("padding-top"));
        $newMainWrapperPadding = $mainWrapperPadding + $navbarHeight - $defaultNavbarHeight;

        if ($navbarHeight > $defaultNavbarHeight) {
            $(".content-wrapper").css("padding-top", $newMainWrapperPadding);
        }
    }

    $(window).resize(function() {
        setPadding();
    });
    // === end: main container top menyesuikan tinggi navbar ===
</script>