var url = getCookie('url');
var KTSelect2 = function() {
  var Select2 = function() {
      $('#pendidikan_bkd').select2({
          placeholder: "Pilih Pendidikan"
      });
  }
  
  // Public functions
  return {
      init: function() {
          Select2();
  }
};
}();

jQuery(document).ready(function () {
  KTSelect2.init();

  var tblLaporanPendidikan = $('#tblLaporanPendidikan').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/laporan/pendidikan/datatable_list',
          method: 'POST',
          params: {
            pendidikan_bkd: $('#pendidikan_bkd').val()
          }
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
          var currPage = tblLaporanPendidikan.getCurrentPage();
          return ((currPage*20)-20)+(index+1);
        }
      },
      {
        field: 'nip',
        title: 'NIP',
        width: 150,
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
        autoHide: false,
        overflow: 'visible',
      }, 
      {
        field: 'ttl',
        title: 'Tempat/Tanggal&nbsp;Lahir',
        width: 150,
        overflow: 'visible',
      }, 
      {
        field: 'jenis_kelamin',
        title: 'Jenis&nbsp;Kelamin',
        width: 150,
        overflow: 'visible',
      }, 
      {
        field: 'agama',
        title: 'Agama',
        width: 100,
        overflow: 'visible',
      }, 
      {
        field: 'pendidikan_bkd',
        title: 'Pendidikan',
        width: 150,
        overflow: 'visible',
      }, 
      {
        field: 'asal_sekolah',
        title: 'Asal&nbsp;Sekolah',
        width: 150,
        overflow: 'visible',
      }
    ],
  });
});

function search() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_pendidikan');
  frm.attr('method', 'post');
  frm.submit();
}

function excel() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_pendidikan/export');
  frm.attr('method', 'post');
  frm.submit();
}	