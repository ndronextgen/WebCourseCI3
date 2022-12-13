//riwayat pribadi
var tblSkLainnya = $("#tblSkLainnya").KTDatatable({
	// datasource definition
	data: {
		type: "remote",
		source: url + "/sklainnya/sklainnya_list/" + id,
		pageSize: 10,
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
		input: $("#tblSkLainnyaSearch"),
	},
	// columns definition
	columns: [
		{
			field: "no",
			title: "No",
			autoHide: false,
			sortable: false,
			width: 20,
			type: "number",
			template: function (row, index) {
				var currPage = tblSkLainnya.getCurrentPage();
				return currPage * 10 - 10 + (index + 1);
			},
		},
		{
			field: "title",
			title: "Judul Dokumen",
			width: 200,
			type: "string",
			textAlign: "left",
		},
		{
			field: "created_at",
			title: "Dibuat",
			width: 210,
			type: "string",
			textAlign: "left",
		},
		{
			field: "aksi",
			title: "Aksi",
			sortable: false,
			width: 110,
			textAlign: "center",
			template: function (row) {
				var content = "";
				content +=
					'<a href="javascript:;" onclick="detail_data_sk_next(\'sklainnya\',' +
					row.id_arsip_sk +
					');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
				content += '<i class="flaticon-book"></i>';
				content += "</a>";

				if (act_list != "detail") {
					content +=
						'&nbsp;<a href="javascript:;" onclick="edit_sk_next(\'sklainnya\',' +
						row.id_arsip_sk +
						');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
					content += '<i class="flaticon-edit-1"></i>';
					content += "</a>";
					content +=
						'&nbsp;<a href="javascript:;" onclick="delete_sk_next(\'sklainnya\',' +
						row.id_arsip_sk +
						');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
					content += '<i class="flaticon-delete"></i>';
					content += "</a>";
				}
				if (row.file_name != null) {
		          content += '<a href="javascript:;" onclick="download_file(\'Pangkat\','+row.id_arsip_sk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
		            content += '<i class="flaticon-download"></i>';
		          content += '</a>&nbsp;';
		        }

				return content;
			},
		},
	],
});
