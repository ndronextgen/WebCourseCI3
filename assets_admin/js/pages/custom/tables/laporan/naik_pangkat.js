var url = getCookie('url');
var KTSelect2 = function() {
  var Select2 = function() {
      $('#masa_pangkat').select2({
          placeholder: "Pilih Masa Pangkat"
      });

      $('#lokasi').select2({
        placeholder: "Pilih Lokasi Kerja"
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

  var tblLaporanNaikPangkat = $('#tblLaporanNaikPangkat').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/laporan/naik_pangkat/datatable_list',
          method: 'POST',
          params: {
            masa_pangkat: $('#masa_pangkat').val(),
            lokasi: $('#lokasi').val()
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
        template: function (row, index) {
					let data;
					var currPage = tblLaporanNaikPangkat.getCurrentPage();
					var result_number = currPage * 20 - 20 + (index + 1);
					
					// if (row.kuning == 1) {
					// 	data = '<span style="color:red;">' + result_number + "</span>";
					// } else {
					// 	data = '<span>' + result_number + "</span>";
					// }

          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + result_number + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + result_number + "</span>";
					} else {
            data = '<span>' + result_number + "</span>";
          }

					return data;
				}
      },
      {
        field: 'nip',
        title: 'NIP',
        width: 150,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.nip + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.nip + "</span>";
					} else {
            data = '<span>' + row.nip + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'nrk',
        title: 'NRK',
        autoHide: false,
        width: 100,
        overflow: 'visible',
        template: function (row) {
          let data;
          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.nrk + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.nrk + "</span>";
					} else {
            data = '<span>' + row.nrk + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'nama_pegawai',
        title: 'Nama&nbsp;Pegawai',
        autoHide: false,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.nama_pegawai + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.nama_pegawai + "</span>";
					} else {
            data = '<span>' + row.nama_pegawai + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'golongan',
        title: 'Golongan',
        width: 100,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.golongan + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.golongan + "</span>";
					} else {
            data = '<span>' + row.golongan + "</span>";
          }
          

          return data;
        },
      }, 
      {
        field: 'uraian',
        title: 'Nama&nbsp;Pangkat',
        width: 150,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.uraian + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.uraian + "</span>";
					} else {
            data = '<span>' + row.uraian + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'tmt_pangkat_terakhir',
        title: 'TMT&nbsp;Pangkat&nbsp;Terakhir',
        width: 150,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.tmt_pangkat_terakhir + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.tmt_pangkat_terakhir + "</span>";
					} else {
            data = '<span>' + row.tmt_pangkat_terakhir + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'tgl_naik_pangkat',
        title: 'Tanggal&nbsp;Naik&nbsp;Pangkat',
        width: 150,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.tgl_naik_pangkat + "</span>";
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.tgl_naik_pangkat + "</span>";
					} else {
            data = '<span>' + row.tgl_naik_pangkat + "</span>";
          }

          return data;
        },
      },
      {
        field: 'detail',
        title: 'Detail',
        sortable: false,
        width: 50,
        template: function(row) {
          let data;

          if (row.kuning == 1 && row.jml != null ) {
						data = '<a href="javascript:;" onclick="detail_pegawai('+row.id_pegawai+', '+row.nrk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat Detail Pegawai">';
              data += '<i class="flaticon-folder-1"></i>';
            data += '</a>&nbsp;';
					} else if (row.kuning == 1 && row.jml == null) {
						data = '<a href="javascript:;" onclick="detail_pegawai('+row.id_pegawai+', '+row.nrk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat Detail Pegawai">';
              data += '<i class="flaticon-folder-1"></i>';
            data += '</a>&nbsp;';
					} else {
            data = '';
          }

          return data;
        }
      }
    ],
  });
});

function search() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_naik_pangkat');
  frm.attr('method', 'post');
  frm.submit();
}

function excel() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_naik_pangkat/export');
  frm.attr('method', 'post');
  frm.submit();
}	

function detail_pegawai(Id, nrk){
  $.ajax({
    type : "POST",
    url : url+'admin/laporan_pegawai_naik_pangkat/detail_pegawai',
    data : {Id:Id, nrk:nrk},
    success: function(data) {
      //window.location = data;
      window.open(data, '_blank');
    }
})
}