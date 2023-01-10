jQuery(document).ready(function () {
    let url = getCookie('url');
    var tbl = $('#tbl').KTDatatable({
      // datasource definition
      data: {
        type: 'remote',
        source: url+'/api/master/mst_informasi/list',
        pageSize: 20,
      },
      // layout definition
      layout: {
        scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
        footer: false // display/hide footer
      },
      // column sorting
      sortable: true,
      pagination: true,
      search: {
        input: $('#txtSearch')
      },
      // columns definition
      columns: [
        {
          field: 'no',
          title: 'No',
          autoHide: false,
          sortable: false,
          width: 20,
          overflow: 'visible',
          template: function(row, index) {
            var currPage = tbl.getCurrentPage();
            return ((currPage*20)-20)+(index+1);
          }
        },
        {
          field: 'title',
          title: 'Judul&nbsp;Informasi',
          overflow: 'visible',
        }, 
        {
          field: 'tgl_awal',
          title: 'Tanggal&nbsp;Mulai',
          autoHide: false,
          width: 200,
          overflow: 'visible',
        }, 
        {
          field: 'tgl_akhir',
          title: 'Tanggal&nbsp;Akhir',
          width: 200,
          overflow: 'visible',
        }, 
        {
          field: 'actions',
          title: 'Actions',
          sortable: false,
          width: 200,
          autoHide: false,
          overflow: 'visible',
          template: function(row) {
            var content = `
              <span style="overflow: visible; position: relative; width: 171px;">
                <a href="${url}admin/master_informasi/detail/${row.id}" class="btn btn-outline-hover-primary"><i class="flaticon-eye"></i> Lihat Detail</a>
                
                <div class="dropdown">
                  <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="flaticon-more"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-sm" style="">
                    <!--begin::Nav-->
                    <ul class="kt-nav">
                      <li class="kt-nav__item kt-nav__item--active">
                        <a href="${url}admin/master_informasi/form/${row.id}" class="kt-nav__link">
                          <i class="kt-nav__link-icon la la-edit"></i>
                          <span class="kt-nav__link-text">Ubah Data</span>
                        </a>
                      </li>
                      <li class="kt-nav__item">
                        <a href="${url}admin/master_informasi/hapus/${row.id}" onClick="return confirm('Anda yakin..???');" class="kt-nav__link">
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
          }
        }
      ],
    });
  });