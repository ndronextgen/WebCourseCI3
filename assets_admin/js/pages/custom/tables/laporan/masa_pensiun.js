var url = getCookie('url');
var KTSelect2 = function() {
  var Select2 = function() {
      $('#masa_pensiun').select2({
          placeholder: "Pilih Masa Pensiun"
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

  var tblLaporanMasaPensiun = $('#tblLaporanMasaPensiun').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/laporan/masa_pensiun/datatable_list',
          method: 'POST',
          params: {
            masa_pensiun: $('#masa_pensiun').val()
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
					var currPage = tblLaporanMasaPensiun.getCurrentPage();
					var result_number = currPage * 20 - 20 + (index + 1);
					

          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + result_number + "</span>";
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + result_number + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '<span style="color:#b5990b;">' + result_number + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:#b5990b;">' + result_number + "</span>";
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

          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.nip + "</span>";
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.nip + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '<span style="color:#b5990b;">' + row.nip + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:#b5990b;">' + row.nip + "</span>";
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

          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.nrk + "</span>";
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.nrk + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '<span style="color:#b5990b;">' + row.nrk + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:#b5990b;">' + row.nrk + "</span>";
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
        width: 150,
        template: function (row) {
          let data;
          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.nama_pegawai + "</span>";
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.nama_pegawai + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '<span style="color:#b5990b;">' + row.nama_pegawai + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:#b5990b;">' + row.nama_pegawai + "</span>";
					} else {
            data = '<span>' + row.nama_pegawai + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'str_tgl_lahir',
        title: 'Tanggal&nbsp;Lahir',
        width: 100,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.str_tgl_lahir + "</span>";
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.str_tgl_lahir + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '<span style="color:#b5990b;">' + row.str_tgl_lahir + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:#b5990b;">' + row.str_tgl_lahir + "</span>";
					} else {
            data = '<span>' + row.str_tgl_lahir + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'usia',
        title: 'Usia',
        width: 50,
        overflow: 'visible',
        template: function (row) {
          let data;
          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.usia + "</span>";
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.usia + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '<span style="color:#b5990b;">' + row.usia + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:#b5990b;">' + row.usia + "</span>";
					} else {
            data = '<span>' + row.usia + "</span>";
          }

          return data;
        },
      }, 
      {
        field: 'tgl_pensiun',
        title: 'Tanggal&nbsp;Pensiun',
        width: 120,
        overflow: 'visible',
        template: function (row) {
          let data;

          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<span style="color:red;">' + row.tgl_pensiun + "</span>";
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:red;font-weight:bold;">' + row.tgl_pensiun + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '<span style="color:#b5990b;">' + row.tgl_pensiun + "</span>";
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '<span style="color:#b5990b;">' + row.tgl_pensiun + "</span>";
					} else {
            data = '<span>' + row.tgl_pensiun + "</span>";
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

          if (row.kuning == 1 && row.kuning12 == 1 && row.jml != null ) {
						data = '<a href="javascript:;" onclick="detail_pegawai('+row.id_pegawai+', '+row.nrk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat Detail Pegawai">';
              data += '<i class="flaticon-folder-1"></i>';
            data += '</a>&nbsp;';
					} else if (row.kuning == 1 && row.kuning12 == 1 && row.jml == null) {
						data = '<a href="javascript:;" onclick="detail_pegawai('+row.id_pegawai+', '+row.nrk+');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Lihat Detail Pegawai">';
              data += '<i class="flaticon-folder-1"></i>';
            data += '</a>&nbsp;';
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml != null) {
						data = '';
					} else if (row.kuning == 0 && row.kuning12 == 1 && row.jml == null) {
						data = '';
					} else {
            data = '';
          }

          return data;
        }
      }
      // {
      //   field: 'warning_6b',
      //   title: 'tgl_warning',
      //   width: 120,
      //   overflow: 'visible',
      // },
      // {
      //   field: 'kuning',
      //   title: 'tgl_warning',
      //   width: 120,
      //   overflow: 'visible',
      //   template: function (row) {
      //     let data;
      //     if (row.kuning == "1") {
      //       data = '<span class="badge badge-success">Selesai</span>';
      //     } else {
      //       data = '<span class="badge badge-dark">Unknow Status</span>';
      //     }

      //     return data;
      //   },
      // }
    ],
  });
});

function search() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_masa_pensiun');
  frm.attr('method', 'post');
  frm.submit();
}

function excel() {
  let frm = $('#frm');
  frm.attr('action', url+'admin/laporan_pegawai_masa_pensiun/export');
  frm.attr('method', 'post');
  frm.submit();
}	

function detail_pegawai(Id, nrk){
  $.ajax({
    type : "POST",
    url : url+'admin/laporan_pegawai_masa_pensiun/detail_pegawai',
    data : {Id:Id, nrk:nrk},
    success: function(data) {
      //window.location = data;
      window.open(data, '_blank');
    }
})
}
