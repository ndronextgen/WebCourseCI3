jQuery(document).ready(function () {
    let url = getCookie('url');
    
    AppHelper.table = $('#tbl').KTDatatable({
      // datasource definition
      data: {
        type: 'remote',
        source: url+'api/master/mst_site_menu/list',
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
          width: 30,
          overflow: 'visible',
          template: function(row, index) {
            $(`[data-row=${index}]`).attr("data-id", row.id);
            var currPage = AppHelper.table.getCurrentPage();
            return ((currPage*20)-20)+(index+1);
          }
        },
        {
          field: 'menu_name',
          title: 'Nama&nbsp;Menu',
          width: 200,
          overflow: 'visible',
        }, 
        {
          field: 'menu_parent_name',
          title: 'Induk&nbsp;Menu',
          width: 200,
          overflow: 'visible',
        },
        {
          field: 'menu_status',
          title: 'Status',
          width: 100,
          overflow: 'visible',
          template: function(row){
            return `<span class="badge badge-${row.menu_status == '1' ? 'primary':'secondary'}">${row.menu_status == '1' ? 'Aktif':'Tidak Aktif'}</span>`;
          }
        },
        {
          field: 'menu_type',
          title: 'Tipe&nbsp;Menu',
          width: 100,
          overflow: 'visible'
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
                <a href="javascript:;" data-url="${url}admin/master_menu/modal_form" title="Detail Situs Menu" data-act="ajax-modal" data-title="Detail Situs Menu" data-post-id="${row.menu_id}" class="btn btn-outline-hover-primary"><i class="flaticon-eye"></i> Lihat Detail</a>
                
                <div class="dropdown">
                  <a href="javascript:;" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="flaticon-more"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-sm" style="">
                    <!--begin::Nav-->
                    <ul class="kt-nav">
                      <li class="kt-nav__item kt-nav__item--active">
                        <a href="javascript:;" data-url="${url}admin/master_menu/modal_form" title="Ubah Situs Menu" data-act="ajax-modal" data-title="Ubah Situs Menu" data-post-id="${row.menu_id}" class="kt-nav__link">
                          <i class="kt-nav__link-icon la la-edit"></i>
                          <span class="kt-nav__link-text">Ubah Data</span>
                        </a>
                      </li>
                      <li class="kt-nav__item">
                        <a href="javascript:void(0);" data-id="${row.id}" class="kt-nav__link mn-delete">
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

    function sendOrderToServer() {
      var currentRequest = null,
          order = [];

      $('#tbl tbody tr').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      currentRequest = $.ajax({
        type: "POST", 
        dataType: "json", 
        url: url+'admin/master_informasi/update_position',
        data: {
          order:order,
        },
        cache: false,
        beforeSend: function () {
          if (currentRequest != null) {
            currentRequest.abort();
          }
        },
        success: function (res) {
          if(res.success){
            appAlert.success(res.message, {duration: 2000});
          }else{
            appAlert.error(res.message, {duration: 2000});
          }
          tbl.reload();
        },
        error: function (e) {
          appAlert.error(res.message, {duration: 2000});        
        },
      });
    }
  });