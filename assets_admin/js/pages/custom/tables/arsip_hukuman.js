var tblArsipHukuman = $('#tblArsipHukuman').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/hukuman/arsip_hukuman_list/'+id,
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
    input: $('#tblArsipHukumanSearch')
  },
  // columns definition
  columns: [
    {
      field: 'no',
      title: 'No',
      autoHide: false,
      width: 20,
      type: 'number',
      template: function(row, index) {
        var currPage = tblArsipHukuman.getCurrentPage();
        return ((currPage*10)-10)+(index+1);
      }
    },
    {
      field: 'title',
      title: 'Judul',
      type: 'string',
      textAlign: 'left',
      width: 250,
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
          content = '<a href="javascript:;" onclick="lihat_file(\'Hukuman\','+row.id_arsip_hukuman+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat File">';
            content += '<i class="flaticon-folder-1"></i>';
          content += '</a>&nbsp;';
          content += '<a href="javascript:;" onclick="download_file(\'Hukuman\','+row.id_arsip_hukuman+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }
  ]
});