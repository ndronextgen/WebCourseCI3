var tblPendidikan = $('#tblPendidikan').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/pendidikan/pendidikan_list/'+id,
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
    input: $('#tblPendidikanSearch')
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
        var currPage = tblPendidikan.getCurrentPage();
        return ((currPage*10)-10)+(index+1);
      }
    },
    {
      field: 'nama_pendidikan',
      title: 'Tingkat&nbsp;Pendidikan',
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
      field: 'tempat_sekolah',
      title: 'Tempat&nbsp;Pendidikan',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'kota',
      title: 'Kota',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'tanggal_lulus',
      title: 'Tanggal&nbsp;Lulus',
      type: 'date-eu',
      textAlign: 'left'
    },
    {
      field: 'aksi',
      title: 'Aksi',
      sortable: false,
      width: 110,
      template: function(row) {
        var content = '';
        
        content += '<a href="javascript:;" onclick="detail_data(\'Pendidikan\','+row.id_pendidikan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
          content += '<i class="flaticon-book"></i>';
        content += '</a>';

        if (act_list != 'detail') {
          content += '&nbsp;<a href="javascript:;" onclick="edit_data(\'Pendidikan\','+row.id_pendidikan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
            content += '<i class="flaticon-edit-1"></i>';
          content += '</a>';
          content += '&nbsp;<a href="javascript:;" onclick="delete_data(\'Pendidikan\','+row.id_pendidikan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
            content += '<i class="flaticon-delete"></i>';
          content += '</a>';
        }
        if (row.file_name != null) {
          content += '<a href="javascript:;" onclick="download_file(\'Pendidikan\','+row.id_arsip_pendidikan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }
  ]
});