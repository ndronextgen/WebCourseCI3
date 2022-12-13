var url = getCookie('url');
var KTSelect2 = function() {
  var Select2 = function() {
      $('#id_master_pelatihan').select2({
          placeholder: "Pilih Pelatihan"
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

  var tblLaporanPelatihan = $('#tblLaporanPelatihan').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/laporan/pelatihan/datatable_list',
          method: 'POST',
          params: {
            id_master_pelatihan: $('#id_master_pelatihan').val()
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
          var currPage = tblLaporanPelatihan.getCurrentPage();
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
        field: 'nama_pelatihan',
        title: 'Nama&nbsp;Pelatihan',
        width: 150,
        overflow: 'visible',
        template: function(row) {
          let pelatihan = '';
          if (row.id_master_pelatihan == 394) {
            pelatihan = row.nama_pelatihan+' : '+row.nama_pelatihan_lainnya;
          }
          else {
            pelatihan = row.nama_pelatihan;
          }

          return pelatihan;
        }
      }, 
      {
        field: 'uraian',
        title: 'Uraian',
        width: 250,
        overflow: 'visible',
      }, 
      {
        field: 'nama_lokasi',
        title: 'Lokasi&nbsp;Pelatihan',
        overflow: 'visible',
      }, 
      {
        field: 'tanggal_sertifikat',
        title: 'Tanggal&nbsp;Sertifikat',
        overflow: 'visible',
      }
    ],
  });
});

function search() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_ikut_pelatihan');
  frm.attr('method', 'post');
  frm.submit();
}

function excel() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_ikut_pelatihan/export');
  frm.attr('method', 'post');
  frm.submit();
}	