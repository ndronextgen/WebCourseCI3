var tblSKP = $('#tblSKP').KTDatatable({
  // datasource definition
  data: {
    type: 'remote',
    source: url+'/skp/skp_list/'+id,
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
    input: $('#tblSKPSearch')
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
      field: 'Periode_awal',
      title: 'Tahun',
      type: 'number',
      textAlign: 'center'
    },
    {
      field: 'Nilai_prestasi_kerja',
      title: 'Nilai Prestasi Kerja',
      type: 'number',
      textAlign: 'center'
    },
    {
      field: 'Nama_atasan_pejabat_penilai',
      title: 'Atasan&nbsp;Penilai',
      type: 'string',
      textAlign: 'center'
    },
    {
      field: 'Nama_pejabat_penilai',
      title: 'Penilai',
      type: 'string',
      textAlign: 'center'
    },
    {
      field: 'file_name_ori',
      title: 'Nama&nbsp;File',
      type: 'string',
      textAlign: 'center'
    }, 
    {
      field: 'aksi',
      title: 'Aksi',
      sortable: false,
      width: 110,
      template: function(row) {
        var content = '';

        content += '<a href="javascript:;" onclick="detail_data(\'SKP\','+row.Skp_id+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Detail Data">';
          content += '<i class="flaticon-book"></i>';
        content += '</a>';

        if (act_list != 'detail') {
          content += '&nbsp;<a href="javascript:;" onclick="edit_data(\'SKP\','+row.Skp_id+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Ubah Data">';
            content += '<i class="flaticon-edit-1"></i>';
          content += '</a>';
          content += '&nbsp;<a href="javascript:;" onclick="delete_data(\'SKP\','+row.Skp_id+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Hapus Data">';
            content += '<i class="flaticon-delete"></i>';
          content += '</a>';
        }

        if (row.file_name != null) {
          content += '<a href="javascript:;" onclick="download_file(\'SKP\','+row.id_arsip_skp+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download File">';
            content += '<i class="flaticon-download"></i>';
          content += '</a>&nbsp;';
        }

        return content;
      }
    }
  ]
});