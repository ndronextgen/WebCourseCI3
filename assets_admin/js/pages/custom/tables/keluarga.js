//riwayat keluarga
var tblKeluarga = $("#tblKeluarga").KTDatatable({
    // datasource definition
    data: {
        type: "remote",
        source: url + "/keluarga/keluarga_list/" + id,
        pageSize: 10,
    },
    // layout definition
    layout: {
        scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
        footer: false, // display/hide footer
    },
    // column sorting
    sortable: true,
    pagination: true,
    search: {
        input: $("#tblKeluargaSearch"),
    },
    // columns definition
    columns: [
        {
            field: "no",
            title: "No",
            autoHide: false,
            sortable: false,
            type: "number",
            width: 20,
            template: function (row, index) {
                var currPage = tblKeluarga.getCurrentPage();
                return currPage * 10 - 10 + (index + 1);
            },
        },
        {
            field: "nama_anggota_keluarga",
            title: "Nama&nbsp;Anggota&nbsp;Keluarga",
            width: 200,
            type: "string",
            textAlign: "left",
        },
        {
            field: "hub_keluarga",
            title: "Hubungan&nbsp;Keluarga",
            width: 180,
            type: "string",
            textAlign: "left",
        },
        {
            field: "jenis_kelamin",
            title: "Jenis&nbsp;Kelamin",
            type: "string",
            textAlign: "left",
        },
        {
            field: "tanggal_lahir_keluarga",
            title: "Tanggal&nbsp;Lahir",
            type: "date-eu",
            textAlign: "left",
        },
        {
            field: "uraian",
            title: "Keterangan",
            type: "string",
            textAlign: "left",
        },
        {
            field: "aksi",
            title: "Aksi",
            sortable: false,
            width: 110,
            template: function (row) {
                var content = "";
                // if (row.file_name != null) {
                //   content = '<a href="javascript:;" onclick="lihat_file(\'Keluarga\','+row.id_arsip_pribadi+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat File">';
                //     content += '<i class="flaticon-folder-1"></i>';
                //   content += '</a>&nbsp;';
                //   content += '<a href="javascript:;" onclick="download_file(\'Keluarga\','+row.id_arsip_pribadi+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
                //     content += '<i class="flaticon-download"></i>';
                //   content += '</a>&nbsp;';
                // }
                content +=
                    '<a href="javascript:;" onclick="detail_data(\'Keluarga\',' +
                    row.id_data_keluarga +
                    ');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
                content += '<i class="flaticon-book"></i>';
                content += "</a>";

                if (act_list != "detail") {
                    content +=
                        '&nbsp;<a href="javascript:;" onclick="edit_data(\'Keluarga\',' +
                        row.id_data_keluarga +
                        ');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
                    content += '<i class="flaticon-edit-1"></i>';
                    content += "</a>";
                    content +=
                        '&nbsp;<a href="javascript:;" onclick="delete_data(\'Keluarga\',' +
                        row.id_data_keluarga +
                        ');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
                    content += '<i class="flaticon-delete"></i>';
                    content += "</a>";
                }
                if (row.file_name != null) {
                    content +=
                        '<a href="javascript:;" onclick="download_file(\'Keluarga\',' +
                        row.id_arsip_pribadi +
                        ');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
                    content += '<i class="flaticon-download"></i>';
                    content += "</a>&nbsp;";
                }

                return content;
            },
        },
    ],
});
