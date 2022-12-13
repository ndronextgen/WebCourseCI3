var tblTubel = $('#tblTubel').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/tubel/tubel_list/'+id,
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
    input: $('#tblTubel')
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
        var currPage = tblTubel.getCurrentPage();
        return ((currPage*10)-10)+(index+1);
      }
    },
    {
      field: 'uraian',
      title: 'Nama&nbsp;Status&nbsp;Belajar',
      type: 'string',
      textAlign: 'left'
    }, 
    {
      field: 'no_sk',
      title: 'Nomor&nbsp;SK',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'tgl_sk',
      title: 'Tanggal&nbsp;SK',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'sekolah',
      title: 'Sekolah',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'akreditasi',
      title: 'Akreditasi',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'jurusan',
      title: 'Jurusan',
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

        content += '<a href="javascript:;" onclick="detail_data(\'Tubel\','+row.id_tubel+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
          content += '<i class="flaticon-book"></i>';
        content += '</a>';

        if (act_list != 'detail') {
          content += '&nbsp;<a href="javascript:;" onclick="edit_data(\'Tubel\','+row.id_tubel+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
            content += '<i class="flaticon-edit-1"></i>';
          content += '</a>';
          content += '&nbsp;<a href="javascript:;" onclick="delete_data(\'Tubel\','+row.id_tubel+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
            content += '<i class="flaticon-delete"></i>';
          content += '</a>';
        }

        if (row.file_name != null) {
          content += '<a href="javascript:;" onclick="download_file(\'Tubel\','+row.id_arsip_sk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }
  ]
});