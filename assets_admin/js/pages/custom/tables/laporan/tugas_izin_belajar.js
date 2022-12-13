var url = getCookie('url');
var KTSelect2 = function() {
  var Select2 = function() {
      $('#status_belajar').select2({
          placeholder: "Pilih Status Belajar"
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

  var tblLaporanTubel = $('#tblLaporanTubel').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/laporan/tugas_izin_belajar/datatable_list',
          method: 'POST',
          params: {
            status_belajar: $('#status_belajar').val()
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
          var currPage = tblLaporanTubel.getCurrentPage();
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
        field: 'uraian',
        title: 'Status&nbsp;Belajar',
        width: 150,
        overflow: 'visible',
      }, 
      {
        field: 'no_sk',
        title: 'Nomor&nbsp;SK',
        width: 150,
        overflow: 'visible',
      }, 
      {
        field: 'tgl_sk',
        title: 'Tanggal&nbsp;SK',
        width: 100,
        overflow: 'visible',
      }, 
      {
        field: 'sekolah',
        title: 'Sekolah',
        width: 200,
        overflow: 'visible',
      }, 
      {
        field: 'nama_status',
        title: 'Akreditasi',
        width: 150,
        overflow: 'visible',
      }
    ],
  });
});

function search() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_tugas_izin_belajar');
  frm.attr('method', 'post');
  frm.submit();
}

function excel() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_tugas_izin_belajar/export');
  frm.attr('method', 'post');
  frm.submit();
}	