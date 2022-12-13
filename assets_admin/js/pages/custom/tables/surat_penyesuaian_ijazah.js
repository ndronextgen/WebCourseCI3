jQuery(document).ready(function () {
  let url = getCookie('url');

  var tblPenyesuaianIjazah = $('#tblPenyesuaianIjazah').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/surat_penyesuaian_ijazah/list',
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
          var currPage = tblPenyesuaianIjazah.getCurrentPage();
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
        autoHide: false,
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
        width: 250,
        autoHide: false,
        overflow: 'visible',
        template: function(row) {
          let btnLihat = '';

          if (row.count_surat > 0) {
            btnLihat = `
            <button type="button" class="btn btn-outline-hover-primary" onclick="lihatSuratPenyesuaianIjazah(${row.id_pegawai})"><i class="flaticon-eye"></i> Lihat Surat</button>
            `;
          }

          let content = `
          <span style="overflow: visible; position: relative; width: 220px;">
            <button type="button" class="btn btn-outline-hover-primary" onclick="buatSuratPenyesuaianIjazah(${row.id_pegawai})"><i class="flaticon-mail"></i> Buat Surat</button>
            ${btnLihat}
          </span>`;

          return content;
        }
      }
    ],
  });
});

function buatSuratPenyesuaianIjazah(id) {
    let frm = $('#frmSuratPenyesuaianIjazah');
    frm.attr('action', url+'admin/surat_penyesuaian_ijazah/add');
    frm.attr('method', 'post');
    $('#id_pegawai').val(id);
    
    frm.submit();
}

function lihatSuratPenyesuaianIjazah(id) {
    let frm = $('#frmSuratPenyesuaianIjazah');
    frm.attr('action', url+'admin/surat_penyesuaian_ijazah/detail');
    frm.attr('method', 'post');
    $('#id_pegawai').val(id);
    
    frm.submit();
}