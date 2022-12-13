var tblPelatihan = $('#tblPelatihan').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/pelatihan/pelatihan_list/'+id,
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
    input: $('#tblPelatihanSearch')
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
        var currPage = tblPelatihan.getCurrentPage();
        return ((currPage*10)-10)+(index+1);
      }
    },
    {
      field: 'nama_pelatihan',
      title: 'Nama&nbsp;Pelatihan',
      type: 'string',
      textAlign: 'left'
    }, 
    {
      field: 'lokasi',
      title: 'Lokasi',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'no_sertifikat',
      title: 'No&nbsp;Sertifikat',
      type: 'string',
      textAlign: 'left'
    },
    {
      field: 'tanggal_sertifikat',
      title: 'Tanggal&nbsp;Sertifikat',
      type: 'date-eu',
      textAlign: 'left'
    },
    {
      field: 'uraian',
      title: 'Keterangan',
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
        
        content += '<a href="javascript:;" onclick="detail_data(\'Pelatihan\','+row.id_pelatihan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
          content += '<i class="flaticon-book"></i>';
        content += '</a>';

        if (act_list != 'detail') {
          content += '&nbsp;<a href="javascript:;" onclick="edit_data(\'Pelatihan\','+row.id_pelatihan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
            content += '<i class="flaticon-edit-1"></i>';
          content += '</a>';
          content += '&nbsp;<a href="javascript:;" onclick="delete_data(\'Pelatihan\','+row.id_pelatihan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
            content += '<i class="flaticon-delete"></i>';
          content += '</a>';
        }
        if (row.file_name != null) {
          content += '<a href="javascript:;" onclick="download_file(\'Pelatihan\','+row.id_arsip_pelatihan+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }
  ]
});