function genMapKoordinatPegawai(act,lat=0,long=0) {
    if (act == 'edit' && (lat == 0 || long == 0)) {
        if (lat == 0 || long == 0) {
            long = $('#longitude').val();
            lat = $('#latitude').val();
        }
    }
    
    var lokasibaru = [long, lat, 2000];
	var map;

	require([
        "esri/Map",
        "esri/views/MapView",
		"esri/layers/GroupLayer",
        "esri/layers/MapImageLayer",
		"esri/layers/TileLayer",
		"esri/widgets/Locate",
		"esri/tasks/Locator",
		"esri/widgets/Search",
		"esri/Graphic",
		"esri/symbols/SimpleMarkerSymbol",
		"esri/widgets/BasemapToggle",
		"esri/widgets/LayerList",
        "dojo/on",
        "dojo/domReady!"
        ],

        function(
            Map, MapView, GroupLayer, MapImageLayer, TileLayer, Locate, Locator, Search, Graphic, SimpleMarkerSymbol, BasemapToggle, LayerList, on
        ) {
            // Mengambil Layer dari Map Service Portal

            var Struktur = new MapImageLayer({
                url: "https://jakartasatu.jakarta.go.id/server/rest/services/DCKTRP/Peta_Struktur_2018/MapServer",
                visible: true,
                title: "Peta Struktur"
            });
		  
            var LidarLayer = new MapImageLayer({
                url: "https://jakartasatu.jakarta.go.id/server/rest/services/DCKTRP/CitraDKI2014Tile/MapServer",
                visible: false,
                title: "Peta Foto Udara 2014"
            });
		  
            var ZonasiLayer = new MapImageLayer({
                url: "https://jakartasatu.jakarta.go.id/server/rest/services/DCKTRP/PetaZonasi2014/MapServer",
                title: "Peta Zonasi",
                visible: false,
            });
		
            // Create GroupLayer with the two MapImageLayers created above
            // as children layers.	
            var PetaLayer = new GroupLayer({
                title: "Peta Tata Ruang",
                visible: true,
                visibilityMode: "exclusive",
                layers: [Struktur, ZonasiLayer, LidarLayer],
            });
		
            // Memanggil fungsi Map dan menentukan basemap awal serta layer
            map = new Map({
                basemap: "osm",
                layers: [PetaLayer]
            });
            
            // Memanggil fungsi Mapview
            var view = new MapView({
                container: "mapKoordinat"+act,  // Reference to the scene div created in step 5
                map: map,  // Reference to the map object created before the scene
                zoom: 12,  // Sets zoom level based on level of detail (LOD)
                center: lokasibaru  // Sets center point of view using longitude,latitude
            });
		
            var markerSymbol = {
                type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
                color: [226, 119, 40],
                outline: { // autocasts as new SimpleLineSymbol()
                color: [255, 255, 255],
                width: 2
                }
            };
                
            var pointGraphic = new Graphic({
                symbol: markerSymbol
            });
            
            var symbol = {
                type: "simple-marker",  // autocasts as new SimpleMarkerSymbol()
                style: "square",
                color: "blue",
                size: "19px",  // pixels
                outline: {  // autocasts as new SimpleLineSymbol()
                    color: [ 255, 255, 0 ],
                    width: 3  // points
                }
            };
            
            function defineActions(event) {
                // The event object contains an item property.
                // is is a ListItem referencing the associated layer
                // and other properties. You can control the visibility of the
                // item, its title, and actions using this object.

                var item = event.item;

                if (item.title === "Peta Tata Ruang") {

                    // An array of objects defining actions to place in the LayerList.
                    // By making this array two-dimensional, you can separate similar
                    // actions into separate groups with a breaking line.

                    item.actionsSections = [[
                        {
                            title: "Increase opacity",
                            className: "esri-icon-up",
                            id: "increase-opacity"
                        }, 
                        {
                            title: "Decrease opacity",
                            className: "esri-icon-down",
                            id: "decrease-opacity"
                        }
                    ]];
                }
            }
        
            view.when(function() {	
                // Create the LayerList widget with the associated actions
                // and add it to the top-right corner of the view.
                var layerList = new LayerList({
                    view: view,
                    // executes for each ListItem in the LayerList
                    listItemCreatedFunction: defineActions
                });

                // Event listener that fires each time an action is triggered
                layerList.on("trigger-action", function(event) {

                    // The layer visible in the view at the time of the trigger.
                    var visibleLayer = LidarLayer.visible ?
                        LidarLayer : ZonasiLayer;

                    // Capture the action id.
                    var id = event.action.id;

                    if (id === "full-extent") {

                        // if the full-extent action is triggered then navigate
                        // to the full extent of the visible layer
                        view.goTo(visibleLayer.fullExtent);

                    } else if (id === "information") {

                        // if the information action is triggered, then
                        // open the item details page of the service layer
                        window.open(visibleLayer.url);

                    } else if (id === "increase-opacity") {

                        // if the increase-opacity action is triggered, then
                        // increase the opacity of the GroupLayer by 0.25

                        if (PetaLayer.opacity < 1) {
                            PetaLayer.opacity += 0.25;
                        }
                    } else if (id === "decrease-opacity") {

                        // if the decrease-opacity action is triggered, then
                        // decrease the opacity of the GroupLayer by 0.25

                        if (PetaLayer.opacity > 0) {
                            PetaLayer.opacity -= 0.25;
                        }
                    }
                });

                // Add widget to the top right corner of the view
                view.ui.add(layerList, "top-right");
            });
            
            if (act == 'add' || act == 'edit') {
                view.on("click", function(event) {
                    //console.log(event.mapPoint);
                    dojo.byId("latitude").value = event.mapPoint.latitude;
                    dojo.byId("longitude").value = event.mapPoint.longitude;
                            
                    var prevLocation = view.center;

                    var point = {
                        type: "point", // autocasts as new Point()
                        longitude: event.mapPoint.longitude,
                        latitude: event.mapPoint.latitude
                    };

                    var markerSymbol = {
                        type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
                        color: [226, 119, 40],
                        outline: { // autocasts as new SimpleLineSymbol()
                        color: [255, 255, 255],
                        width: 2
                        }
                    };
                        
                    var pointGraphic = new Graphic({
                        geometry: point,
                        symbol: markerSymbol
                    });
                        
                    // console.log(pointGraphic);
                    view.graphics.add(pointGraphic);

                    //view.graphics.remove(prevLocation);
                    if (view.graphics.items.length > 1) {
                        view.graphics.remove(view.graphics.items[0]);
                    }
                });	
                
                view.when(function(evt) {
                    var locateBtn = new Locate({
                        view: view,
                        graphic: pointGraphic
                    });
                    
                    view.ui.add("locateBTN", "top-left");
                    var locateNext = document.getElementById("locateBTN");
                    locateNext.addEventListener("click", function() {
                        view.graphics.removeAll();
                        
                        locateBtn.locate().then(function(getData) {
                            dojo.byId("latitude").value = getData.coords.latitude;
                            dojo.byId("longitude").value = getData.coords.longitude;
                        }, 
            
                        function(error) {
                            console.error(error); // Logs the error message
                        });
                    
                    //enableCreatePolygon(draw, view);
                    });
                });	
                
                view.when(function(evt) {			
                    var searchWidget = new Search({
                        view: view,
                        allPlaceholder: "Cari Lokasi",
                        resultSymbol: pointGraphic
                    });
            
                    view.ui.add(searchWidget, "top-right");	
                    var searchNext = document.getElementById(searchWidget);
                    searchWidget.on("select-result", function(event){
                        var searchResult = event.result.feature.__accessor__.store._values.geometry
                            dojo.byId("longitude").value = searchResult.longitude
                            dojo.byId("latitude").value = searchResult.latitude
                            console.log(searchResult.longitude, searchResult.latitude)
                            // The results are stored in the event Object[]
                            if(view.graphics.items.length>0){
                                for(var i = 0; i < view.graphics.items.length; i++){
                                    if(i !== (view.graphics.items.length-1)){
                                    view.graphics.remove(view.graphics.items[i])
                                    }
                                }
                            }
                    });
                });
            
                $('#btnSaveLocation').on('click', function() {
                    $('#latitude').val(dojo.byId("latitude").value);
                    $('#longitude').val(dojo.byId("longitude").value);
                });
            }

            if (lat != 0 || long != 0) {
                var prevLocation = view.center;

                var point = {
                    type: "point", // autocasts as new Point()
                    longitude: long,
                    latitude: lat
                };

                var markerSymbol = {
                    type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
                    color: [226, 119, 40],
                    outline: { // autocasts as new SimpleLineSymbol()
                    color: [255, 255, 255],
                    width: 2
                    }
                };
                    
                var pointGraphic = new Graphic({
                    geometry: point,
                    symbol: markerSymbol
                });
                    
                // console.log(pointGraphic);
                view.graphics.add(pointGraphic);

                //view.graphics.remove(prevLocation);
                if (view.graphics.items.length > 1) {
                    view.graphics.remove(view.graphics.items[0]);
                }
            }
        }
    );
}