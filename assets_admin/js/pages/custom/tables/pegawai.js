jQuery(document).ready(function () {
    let url = getCookie("url");
    var tblPegawai = $("#tblPegawai").KTDatatable({
        // datasource definition
        data: {
            type: "remote",
            source: url + "/api/datatable_pegawai/listing",
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
                    var currPage = tblPegawai.getCurrentPage();
                    return currPage * 20 - 20 + (index + 1);
                },
            },
            {
                field: "nip",
                title: "NIP",
                autoHide: false,
                width: 140,
                overflow: "visible",
                template: function (row) {
                    let data;
                    data =
                        '<div style="font-size:13px;color:#000;">' +
                        row.nip +
                        "</div>";

                    return data;
                },
            },
            {
                field: "nrk",
                title: "NRK",
                width: 50,
                template: function (row) {
                    let data;
                    data =
                        '<div style="font-size:13px;color:#000;">' +
                        row.nrk +
                        "</div>";

                    return data;
                },
            },
            {
                field: "nama_pegawai",
                title: "Nama Pegawai",
                template: function (row) {
                    let data;
                    data =
                        '<div style="font-size:13px;color:#000;">' +
                        row.nama_pegawai +
                        "</div>";

                    return data;
                },
            },
            {
                field: "golongan",
                title: "Golongan",
                width: 70,
                template: function (row) {
                    let data;
                    data =
                        '<div style="font-size:13px;color:#000;">' +
                        row.golongan +
                        "</div>";

                    return data;
                },
            },
            {
                field: "jabatan",
                title: "Jabatan",
                template: function (row) {
                    let data;
                    data =
                        '<div style="font-size:13px;color:#000;">' +
                        row.jabatan +
                        "</div>";

                    return data;
                },
            },
            {
                field: "lokasi_group",
                title: "Lokasi Kerja",
                width: 250,
                template: function (row) {
                    let data;
                    data =
                        '<div style="font-size:13px;color:#000;">' +
                        row.lokasi_group +
                        "</div>";

                    return data;
                },
            },
            {
                field: "nama_status",
                title: "Status",
                width: 100,
                template: function (row) {
                    let data;
                    data =
                        '<div style="font-size:13px;color:#000;">' +
                        row.nama_status +
                        "</div>";

                    return data;
                },
            },
            {
                field: "actions",
                title: "Aksi",
                sortable: false,
                width: 200,
                autoHide: false,
                overflow: "visible",
                template: function (row) {
                    let content = `
            <span style="overflow: visible; position: relative; width: 110px;">
              <a href="${url}pegawai/detail/${row.id_pegawai}" class="btn btn-outline-hover-primary"><i class="flaticon-eye"></i> Lihat Detail</a>
              <div class="dropdown">
                <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="flaticon-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-sm" style="">
                  <!--begin::Nav-->
                  <ul class="kt-nav">
                    <li class="kt-nav__item kt-nav__item--active">
                      <a href="${url}pegawai/edit/${row.id_pegawai}" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-edit"></i>
                        <span class="kt-nav__link-text">Ubah</span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a href="${url}pegawai/hapus/${row.id_pegawai}" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-trash"></i>
                        <span class="kt-nav__link-text">Hapus</span>
                      </a>
                    </li>
                  </ul>

                  <!--end::Nav-->
                </div>
              </div>
            </span>
          `;

                    return content;
                },
            },
        ],
    });
});
