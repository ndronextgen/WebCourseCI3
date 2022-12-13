jQuery(document).ready(function () {
  let url = getCookie('url');
  var tbl = $("#tbl").KTDatatable({
      // datasource definition
      data: {
          type: "remote",
          source: url + "/api/master/mst_sub_lokasi_kerja/list",
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
                  var currPage = tbl.getCurrentPage();
                  return currPage * 20 - 20 + (index + 1);
              },
          },
          {
              field: "sub_lokasi_kerja",
              title: "Nama&nbspSeksi/&nbsp;Subbag/&nbsp;Satlak",
              overflow: "visible",
          },
          {
              field: "lokasi_kerja",
              title: "Lokasi&nbsp;Kerja",
              width: 200,
              overflow: "visible",
          },
          {
              field: "actions",
              title: "Actions",
              sortable: false,
              width: 200,
              autoHide: false,
              overflow: "visible",
              template: function (row) {
                  var content = `
            <span style="overflow: visible; position: relative; width: 171px;">
              <a href="${url}admin/master_sub_lokasi/detail/${row.id_sub_lokasi_kerja}" class="btn btn-outline-hover-primary"><i class="flaticon-eye"></i> Lihat Detail</a>
              
              <div class="dropdown">
                <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="flaticon-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-sm" style="">
                  <!--begin::Nav-->
                  <ul class="kt-nav">
                    <li class="kt-nav__item kt-nav__item--active">
                      <a href="${url}admin/master_sub_lokasi/edit/${row.id_sub_lokasi_kerja}" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-edit"></i>
                        <span class="kt-nav__link-text">Ubah Data</span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a href="${url}admin/master_sub_lokasi/hapus/${row.id_sub_lokasi_kerja}" onClick="return confirm('Anda yakin..???');" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-trash"></i>
                        <span class="kt-nav__link-text">Hapus Data</span>
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