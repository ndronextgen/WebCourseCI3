var url = getCookie('url');

jQuery(document).ready(function () {
  var tblSuratHukdis = $('#tblSuratHukdis').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/surat_hukdis/list',
          method: 'POST'
        }
      },
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
          var currPage = tblSuratHukdis.getCurrentPage();
          return ((currPage*20)-20)+(index+1);
        }
      },
      {
        field: 'nip',
        title: 'NIP',
        autoHide: false,
        width: 140,
        overflow: 'visible',
      }, 
      {
        field: 'nrk',
        title: 'NRK',
        width: 100,
        overflow: 'visible',
      }, 
      {
        field: 'nama_pegawai',
        title: 'Nama&nbsp;Pegawai',
        overflow: 'visible',
      }, 
      {
        field: 'actions',
        title: 'Aksi',
        sortable: false,
        width: 240,
        autoHide: false,
        overflow: 'visible',
        template: function(row) {
          let lihat = '';
          if (row.count_surat > 0) {
            lihat = `
            <button type="button" class="btn btn-outline-hover-primary" onclick="lihatSuratHukdis(${row.id_pegawai})"><i class="flaticon-folder-1"></i> Lihat Surat</button>
            `;
          }

          let content = `
          <span style="overflow: visible; position: relative; width: 220px;">
          <button type="button" class="btn btn-outline-hover-primary" onclick="buatSuratHukdis(${row.id_pegawai})"><i class="flaticon-file-1"></i> Buat Surat</button>
            ${lihat}
          </span>`;

          return content;
        }
      }
    ],
  });
});

function buatSuratHukdis(id) {
    let frm = $('#frmSuratHukdis');
    frm.attr('action', url+'admin/surat_hukdis/add');
    frm.attr('method', 'post');
    $('#id_pegawai').val(id);
    
    frm.submit();
}

function lihatSuratHukdis(id) {
    let frm = $('#frmSuratHukdis');
    frm.attr('action', url+'admin/surat_hukdis/detail');
    frm.attr('method', 'post');
    $('#id_pegawai').val(id);
    
    frm.submit();
}