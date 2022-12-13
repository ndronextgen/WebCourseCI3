var tblHukuman = $('#tblHukuman').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/hukuman/hukuman_list/'+id,
    pageSize: 10
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
    input: $('#tblHukumanSearch')
  },
  // columns definition
  columns: [
    {
      field: 'no',
      title: 'No',
      autoHide: false,
      sortable: false,
      width: 20,
      type: 'number',
      template: function(row, index) {
        var currPage = tblSKP.getCurrentPage();
        return ((currPage*10)-10)+(index+1);
      }
    },
    {
      field: 'jenis_hukuman',
      title: 'Jenis&nbsp;Hukuman',
      type: 'string',
      textAlign: 'left'
    }, 
    {
      field: 'uraian',
      title: 'Uraian',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'nomor_sk',
      title: 'Nomor&nbsp;SK',
      type: 'number',
      textAlign: 'left'
    },
    {
      field: 'tanggal_sk',
      title: 'Tanggal&nbsp;SK',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'file_name_ori',
      title: 'Nama&nbsp;File',
      type: 'string',
      textAlign: 'left'
    }, 
    {
      field: 'aksi',
      title: 'Aksi',
      sortable: false,
      width: 110,
      template: function(row) {
        var content = '';

        content += '<a href="javascript:;" onclick="detail_data(\'Hukuman\','+row.id_hukuman+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
          content += '<i class="flaticon-book"></i>';
        content += '</a>';

        if (act_list != 'detail') {
          content += '&nbsp;<a href="javascript:;" onclick="edit_data(\'Hukuman\','+row.id_hukuman+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
            content += '<i class="flaticon-edit-1"></i>';
          content += '</a>';
          content += '&nbsp;<a href="javascript:;" onclick="delete_data(\'Hukuman\','+row.id_hukuman+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
            content += '<i class="flaticon-delete"></i>';
          content += '</a>';
        }

        if (row.file_name != null) {
          content += '<a href="javascript:;" onclick="download_file(\'Hukuman\','+row.id_arsip_hukuman+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }
  ]
});