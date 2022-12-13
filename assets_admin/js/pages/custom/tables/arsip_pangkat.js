var tblArsipPangkat = $('#tblArsipPangkat').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/pangkat/arsip_pangkat_list/'+id,
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
    input: $('#tblArsipPangkatSearch')
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
        var currPage = tblArsipPangkat.getCurrentPage();
        return ((currPage*10)-10)+(index+1);
      }
    },
    {
      field: 'title',
      title: 'Judul',
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
      field: 'opsi',
      title: 'Opsi',
      sortable: false,
      width: 110,
      template: function(row) {
        var content = '';
        if (row.file_name != null) {
          content = '<a href="javascript:;" onclick="lihat_file(\'Pangkat\','+row.id_arsip_sk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat File">';
            content += '<i class="flaticon-folder-1"></i>';
          content += '</a>&nbsp;';
          content += '<a href="javascript:;" onclick="download_file(\'Pangkat\','+row.id_arsip_sk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }, 
    {
      field: 'aksi',
      title: 'Aksi',
      sortable: false,
      width: 110,
      template: function(row) {
        var content = '';
        if (act_list != 'detail') {
          content = '<a href="javascript:;" onclick="edit_file(\'Pangkat\','+row.id_pangkat+','+row.id_arsip_sk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat File">';
            content += '<i class="flaticon-folder-1"></i>';
          content += '</a>&nbsp;';
          content += '<a href="javascript:;" onclick="delete_file(\'Pangkat\','+row.id_pangkat+','+row.id_arsip_sk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus File">';
            content += '<i class="flaticon-delete"></i>';
          content += '</a>';
        }

        return content;
      }
    }
  ]
});