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
            overflow: "visible",
            template: function (row, index) {
                var currPage = tblKeluarga.getCurrentPage();
                return currPage * 10 - 10 + (index + 1);
            },
        },
        {
            field: "keterangan",
            title: "Hubungan&nbsp;Keluarga",
            width: 160,
            overflow: "visible",
            type: "string",
            textAlign: "center",
            template: function (row) {
                let data;
                if (row.hub_keluarga != 1) {
                    data = row.keterangan;
                } else {
                    if (row.jk == 'Laki-Laki') {
                        data = 'Istri';
                    } else if (row.jk == 'Perempuan') {
                        data = 'Suami';
                    } else {
                        data = '-';
                    }
                }
                return data;
            },
        },
        {
            field: "nama_anggota_keluarga",
            title: "Nama&nbsp;Keluarga",
            width: 160,
            overflow: "visible",
            type: "string",
            textAlign: "center",
        },
        {
            field: "jenis_kelamin",
            title: "Jenis&nbsp;Kelamin",
            type: "string",
            overflow: "visible",
            textAlign: "center",
            template: function (row) {
                let data;
                if (row.jenis_kelamin == 1) {
                    data = 'Laki-Laki';
                } else if (row.jenis_kelamin == 'L') {
                    data = 'Laki-Laki';
                } else if (row.jenis_kelamin == 2) {
                    data = 'Perempuan';
                } else if (row.jenis_kelamin == 'P') {
                    data = 'Perempuan';
                } else {
                    data = '-';
                }
                return data;
            },
        },
        {
            field: "tanggal_lahir_keluarga",
            title: "Tanggal&nbsp;Lahir",
            overflow: "visible",
            textAlign: "center",
        },
        {
            field: "uraian",
            title: "Keterangan",
            type: "string",
            overflow: "visible",
            textAlign: "center",
        },
        {
            field: "file_name_ori",
            title: "File",
            overflow: "visible",
            textAlign: "center",
            template: function (row) {
                var urlFile = 'asset/upload/pribadi/pribadi_' + row.id_data_keluarga + '_' + row.id_arsip_pribadi + '/' + row.file_name_ori;
                var data;

                if (row.file_name_ori != null) {
                    if (row.file_name_ori.split('.').pop() == 'pdf') {
                        data = `<a data-fancybox data-type="iframe" data-src="` + url + urlFile + `" href="javascript:void(0);">
                            <button type="button" class="btn btn-sm btn-danger" ><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;PDF</button></a>`;
                    } else {
                        data = '<a data-fancybox data-src="' + url + urlFile + '"><img src="' + url + urlFile + '" height="30px"/></a>';
                    }
                } else {
                    data = '-';
                }

                return data;

            }
            // template: function (row) {
            //     var urlFile = 'asset/upload/pribadi/pribadi_' + data.id_data_keluarga + '_' + data.id_arsip_pribadi + '/' + data.file_name;
            //     let data;
            //     if (row.file_name_ori != null) {
            //         text = `<a data-fancybox data-src="${urlFile}">
            //             <img src="${urlFile}" width="200" height="150" />
            //         </a>`;
            //     } else {
            //         data = '-'
            //     }
            //     return data;
            // },
        },
        {
            field: "aksi",
            title: "Aksi",
            overflow: "visible",
            textAlign: "center",
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
