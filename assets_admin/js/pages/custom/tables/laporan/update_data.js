var url = getCookie("url");

var KTSelect2 = (function () {
	var Select2 = function () {
		$("#lokasi").select2({
			// placeholder: "Pilih Lokasi Kerja",
		});
		$("#sublokasi").select2({
			// placeholder: "Pilih Sub Lokasi Kerja",
		});
	};

	// Public functions
	return {
		init: function () {
			Select2();
		},
	};
})();

$jQ(document).ready(function () {
	KTSelect2.init();

	const tipe = $("#tipe").val();
	const lokasi = $("#lokasi").val();
	const sublokasi = $("#sublokasi").val();
	const startDate = $("#start_date").val();
	const endDate = $("#end_date").val();

	if (tipe == 0) {
		var tblLaporanUpdateData = $("#tblLaporanUpdateData").KTDatatable({
			// datasource definition
			data: {
				type: "remote",
				source: {
					read: {
						url: url + "api/laporan/update_data/datatable_list",
						method: "POST",
						data: {
							tipe: tipe,
							lokasi: lokasi,
							sublokasi: sublokasi,
							startDate: startDate,
							endDate: endDate,
						},
					},
				},
				pageSize: 20,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,
			pagination: true,
			search: {
				input: $("#txtSearch"),
			},

			// columns definition
			columns: [
				{
					field: "no",
					title: "No",
					autoHide: false,
					sortable: false,
					width: 20,
					overflow: "visible",
					template: function (row, index) {
						let data;
						var currPage = tblLaporanUpdateData.getCurrentPage();
						var result_number = currPage * 20 - 20 + (index + 1);

						data = "<span>" + result_number + "</span>";

						return data;
					},
				},
				{
					field: "nip",
					title: "NIP",
					autoHide: false,
					overflow: "visible",
					width: 120,
					template: function (row) {
						let data;
						data = "<span>" + row.nip + "</span>";

						return data;
					},
				},
				{
					field: "nrk",
					title: "NRK",
					autoHide: false,
					overflow: "visible",
					width: 50,
					template: function (row) {
						let data;
						data = "<span>" + row.nrk + "</span>";

						return data;
					},
				},
				{
					field: "nama_pegawai",
					title: "Nama&nbsp;Pegawai",
					autoHide: false,
					overflow: "visible",
					width: 150,
					template: function (row) {
						let data;
						data = "<span>" + row.nama_pegawai + "</span>";

						return properCase(data);
					},
				},
				{
					field: "lokasi_kerja",
					title: "Lokasi&nbsp;Kerja",
					autoHide: false,
					width: 400,
					overflow: "visible",
					template: function (row) {
						let data;
						data = properCase(row.lokasi_kerja);
						data = data.replace(" Dan ", " dan ");
						data = data.replace(" Dki ", " DKI ");

						data = "<span>" + data + "</span>";

						return data;
					},
				},
				{
					field: "menu",
					title: "Pembaruan di",
					width: 150,
					overflow: "visible",
					template: function (row) {
						let data;
						data = "<span>" + row.menu + "</span>";

						return properCase(data);
					},
				},
				{
					field: "created_at",
					title: "Tanggal Update",
					width: 150,
					overflow: "visible",
					template: function (row) {
						let data;
						data = "<span>" + row.created_at + "</span>";

						return data;
					},
				},
			],
		});

		// === PEGAWAI YANG SUDAH UPDATE ===
	} else if (tipe == 1) {
		var tblLaporanUpdateData = $("#tblLaporanUpdateData").KTDatatable({
			// datasource definition
			data: {
				type: "remote",
				source: {
					read: {
						url: url + "api/laporan/update_data/datatable_list",
						method: "POST",
						params: {
							tipe: tipe,
							lokasi: lokasi,
							sublokasi: sublokasi,
							startDate: startDate,
							endDate: endDate,
						},
					},
				},
				pageSize: 20,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,
			pagination: true,
			search: {
				input: $("#txtSearch"),
			},

			// columns definition
			columns: [
				{
					field: "no",
					title: "No",
					autoHide: false,
					sortable: false,
					width: 20,
					overflow: "visible",
					template: function (row, index) {
						let data;
						var currPage = tblLaporanUpdateData.getCurrentPage();
						var result_number = currPage * 20 - 20 + (index + 1);

						data = "<span>" + result_number + "</span>";

						return data;
					},
				},
				{
					field: "nip",
					title: "NIP",
					autoHide: false,
					overflow: "visible",
					width: 120,
					template: function (row) {
						let data;
						data = "<span>" + row.nip + "</span>";

						return data;
					},
				},
				{
					field: "nrk",
					title: "NRK",
					autoHide: false,
					overflow: "visible",
					width: 50,
					template: function (row) {
						let data;
						data = "<span>" + row.nrk + "</span>";

						return data;
					},
				},
				{
					field: "nama_pegawai",
					title: "Nama&nbsp;Pegawai",
					autoHide: false,
					overflow: "visible",
					width: 150,
					template: function (row) {
						let data;
						data = "<span>" + row.nama_pegawai + "</span>";

						return properCase(data);
					},
				},
				{
					field: "lokasi_kerja",
					title: "Lokasi&nbsp;Kerja",
					autoHide: false,
					width: 500,
					overflow: "visible",
					template: function (row) {
						let data;
						data = properCase(row.lokasi_kerja);
						data = data.replace(" Dan ", " dan ");
						data = data.replace(" Dki ", " DKI ");

						data = "<span>" + data + "</span>";

						return data;
					},
				},
				{
					field: "notif",
					title: "Jumlah Update",
					width: 150,
					overflow: "visible",
					textAlign: "right",
					template: function (row) {
						let data;
						data = "<span>" + row.notif + "</span>";

						return data;
					},
				},
			],
		});

		// === PEGAWAI YANG BELUM UPDATE ===
	} else if (tipe == 2) {
		var tblLaporanUpdateData = $("#tblLaporanUpdateData").KTDatatable({
			// datasource definition
			data: {
				type: "remote",
				source: {
					read: {
						url: url + "api/laporan/update_data/datatable_list",
						method: "POST",
						params: {
							tipe: tipe,
							lokasi: lokasi,
							sublokasi: sublokasi,
							startDate: startDate,
							endDate: endDate,
						},
					},
				},
				pageSize: 20,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,
			pagination: true,
			search: {
				input: $("#txtSearch"),
			},

			// columns definition
			columns: [
				{
					field: "no",
					title: "No",
					autoHide: false,
					sortable: false,
					width: 20,
					overflow: "visible",
					template: function (row, index) {
						let data;
						var currPage = tblLaporanUpdateData.getCurrentPage();
						var result_number = currPage * 20 - 20 + (index + 1);

						data = "<span>" + result_number + "</span>";

						return data;
					},
				},
				{
					field: "nip",
					title: "NIP",
					autoHide: false,
					overflow: "visible",
					width: 120,
					template: function (row) {
						let data;
						data = "<span>" + row.nip + "</span>";

						return data;
					},
				},
				{
					field: "nrk",
					title: "NRK",
					autoHide: false,
					overflow: "visible",
					width: 50,
					template: function (row) {
						let data;
						data = "<span>" + row.nrk + "</span>";

						return data;
					},
				},
				{
					field: "nama_pegawai",
					title: "Nama&nbsp;Pegawai",
					autoHide: false,
					overflow: "visible",
					width: 150,
					template: function (row) {
						let data;
						data = "<span>" + row.nama_pegawai + "</span>";

						return properCase(data);
					},
				},
				{
					field: "lokasi_kerja",
					title: "Lokasi&nbsp;Kerja",
					autoHide: false,
					width: 500,
					overflow: "visible",
					template: function (row) {
						let data;
						data = properCase(row.lokasi_kerja);
						data = data.replace(" Dan ", " dan ");
						data = data.replace(" Dki ", " DKI ");

						data = "<span>" + data + "</span>";

						return data;
					},
				},
				{
					field: "notif",
					title: "Jumlah Update",
					width: 150,
					overflow: "visible",
					textAlign: "right",
					template: function (row) {
						let data;
						data = "<span>" + row.notif + "</span>";

						return data;
					},
				},
			],
		});
	}
});

function search() {
	let frm = $("#frm");
	frm.attr("action", url + "admin/laporan_pegawai_update_data");
	frm.attr("method", "post");
	frm.submit();
}

function excel() {
	let frm = $("#frm");
	frm.attr("action", url + "admin/laporan_pegawai_update_data/export");
	frm.attr("method", "post");
	frm.submit();
}

function properCase(str) {
	// console.log(str);
	if (!str) {
		return "";
	} else {
		return str.replace(/\w\S*/g, function (txt) {
			txt = txt.charAt(0).toUpperCase() + txt.slice(1).toLowerCase();
			return txt;
		});
	}
}
