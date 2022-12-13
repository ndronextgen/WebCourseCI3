var tblPenghargaan = $('#tblPenghargaan').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/penghargaan/penghargaan_list/'+id,
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
    input: $('#tblPenghargaan')
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
        var currPage = tblPenghargaan.getCurrentPage();
        return ((currPage*10)-10)+(index+1);
      }
    },
    {
      field: 'nama_penghargaan',
      title: 'Nama&nbsp;Penghargaan',
      type: 'string',
      textAlign: 'left'
    }, 
    {
      field: 'pemberi_penghargaan',
      title: 'Pemberi&nbsp;Penghargaan',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'nomor_sk',
      title: 'Nomor&nbsp;SK',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'tgl_sk_penghargaan',
      title: 'Tanggal&nbsp;SK',
      type: 'date-eu',
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
        
        content += '<a href="javascript:;" onclick="detail_data(\'Penghargaan\','+row.id_penghargaan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
          content += '<i class="flaticon-book"></i>';
        content += '</a>';

        if (act_list != 'detail') {
          content += '&nbsp;<a href="javascript:;" onclick="edit_data(\'Penghargaan\','+row.id_penghargaan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
            content += '<i class="flaticon-edit-1"></i>';
          content += '</a>';
          content += '&nbsp;<a href="javascript:;" onclick="delete_data(\'Penghargaan\','+row.id_penghargaan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
            content += '<i class="flaticon-delete"></i>';
          content += '</a>';
        }

        if (row.file_name != null) {
          content += '<a href="javascript:;" onclick="download_file(\'Penghargaan\','+row.id_arsip_sk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }
  ]
});