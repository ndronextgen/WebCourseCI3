function genMapKoordinatPegawai(
	act,
	lat = -6.176139634482833,
	long = 106.82737800062135
) {
	longitude = $("#longitude").val();
	latitude = $("#latitude").val();
	if (act == "edit" && (lat == 0 || long == 0)) {
		if (lat == 0 || long == 0) {
			long = $("#longitude").val();
			lat = $("#latitude").val();
		}
	} else if (act == "add") {
		
		if(longitude!='' || latitude !=''){
			long = longitude;
			lat = latitude;
		} else {
			lat = -6.176139634482833;
			long = 106.82737800062135;
		} 
	}

	console.log(long,lat);

	var lokasibaru = [long, lat];
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

		var zonasi = new FeatureLayer({
			//url: "https://tataruang.jakarta.go.id/server/rest/services/peta_operasional/Informasi_Rencana_Kota_DKI_Jakarta_View/MapServer",
			url: "https://tataruang.jakarta.go.id/server/rest/services/RDTR_2022/Rencana_Pola_Ruang_RDTR_2022/MapServer/0",
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
			basemap: "osm",
			layers: [demographicGroupLayer],
		});

		var view = new MapView({
			container: "mapKoordinat" + act,
			center: lokasibaru, //lonlat
			//center: [106.82737800062135, -6.176139634482833], //lonlat
			map: map,
			zoom: 11,
		});

		var point = new Point({
			longitude: long,
			latitude: lat
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
		if(longitude !='' || latitude !=''){
			view.graphics.add(pointGraphic);
		}
		

		// setting opacity dll
		function defineActions(event) {
			const item = event.item;

			if (item.title === "PETA STRUKTUR") {
				item.actionsSections = [
					[
						{
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
					[
						{
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
					const { value } = event;
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
		searchWidget.on("search-clear", function (event) {
			view.graphics.removeAll();
			$("input#longitude").val("");
			$("input#latitude").val("");
			$("input#pid").val("");
		});
		searchWidget.on("search-complete", function (result) {
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

		view.on("click", function (evt) {
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
			$("input#longitude").val(
				Math.round(evt.mapPoint.longitude * 100000) / 100000
			);
			$("input#latitude").val(
				Math.round(evt.mapPoint.latitude * 100000) / 100000
			);
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

		locateWidget.on("locate", function (evt) {
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
}
