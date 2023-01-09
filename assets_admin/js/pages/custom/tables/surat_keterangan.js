var url = getCookie("url");

var KTSelect2 = (function () {
    // Private functions
    var SelectStatus = function () {
        $("#id_status_surat").select2({
            placeholder: "Semua Status",
        });
    };

    // Public functions
    return {
        init: function () {
            SelectStatus();
        },
    };
})();

jQuery(document).ready(function () { 
    KTSelect2.init();

    var tblSuratKeterangan = $("#tblSuratKeterangan").KTDatatable({
        // datasource definition
        data: {
            type: "remote",
            source: {
                read: {
                    url: url + "/api/surat_keterangan/datatable",
                    method: "POST",
                    params: {
                        nama_pegawai: $("#nama_pegawai").val(),
                        id_status_surat: $("#id_status_surat").val(),
                    },
                },
            },
            pageSize: 20,
        },
        // layout definition
        layout: {
            scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
            footer: false, // display/hide footer
        },
        // column sorting
        sortable: true,
        pagination: true,
        search: {
            input: $("#txtSearch"),
        },
        // columns definition
        columns: [
            {
                field: "no",
                title: "No",
                autoHide: false,
                sortable: false,
                width: 20,
                overflow: "visible",
                template: function (row, index) {
                    let data;
                    var currPage = tblSuratKeterangan.getCurrentPage();
                    var result_number = currPage * 20 - 20 + (index + 1);

                    if (row.jml <= 0) {
                        data =
                            '<span style="font-weight:bold;">' +
                            result_number +
                            "</span>";
                    } else {
                        data =
                            '<span style="font-weight:italic;">' +
                            result_number +
                            "</span>";
                    }

                    return data;
                },
            },
            {
                field: "jenis_surat",
                title: "Jenis&nbsp;Surat",
                width: 140,
                overflow: "visible",
                template: function (row) {
                    let data;
                    if (row.jml <= 0) {
                        data =
                            '<span style="font-weight:bold;">' +
                            row.jenis_surat +
                            "</span>";
                    } else {
                        data =
                            '<span style="font-weight:italic;">' +
                            row.jenis_surat +
                            "</span>";
                    }

                    return data;
                },
            },
            {
                field: "nama",
                title: "Nama&nbsp;Pegawai",
                autoHide: false,
                width: 200,
                overflow: "visible",
                template: function (row) {
                    let data;
                    if (row.jml <= 0) {
                        data =
                            '<span style="font-weight:bold;">' +
                            row.nama +
                            "</span>";
                    } else {
                        data =
                            '<span style="font-weight:italic;">' +
                            row.nama +
                            "</span>";
                    }

                    return data;
                },
            },
            {
                field: "tgl_surat",
                width: 100,
                title: "Tanggal&nbsp;Surat",
                template: function (row) {
                    let data;
                    if (row.jml <= 0) {
                        data =
                            '<span style="font-weight:bold;">' +
                            row.tgl_surat +
                            "</span>";
                    } else {
                        data =
                            '<span style="font-weight:italic;">' +
                            row.tgl_surat +
                            "</span>";
                    }

                    return data;
                },
            },
            {
                field: "keterangan_pengajuan",
                title: "Keterangan",
                overflow: "visible",
                template: function (row) {
                    let data;
                    if (row.jml <= 0) {
                        data =
                            '<span style="font-weight:bold;">' +
                            row.keterangan_pengajuan +
                            "</span>";
                    } else {
                        data =
                            '<span style="font-weight:italic;">' +
                            row.keterangan_pengajuan +
                            "</span>";
                    }

                    return data;
                },
            },
            {
                field: "status",
                title: "Status",
                width: 120,
                overflow: "visible",
                template: function (row) { 
                    let data;
                    if (row.status == "Selesai") {
                        data =
                            '<span class="badge badge-success" onclick="showTimeline(\'' + row.id_srt + '\')" style="cursor: pointer;">Selesai</span>';
                    } else if (row.status == "Menunggu") {
                        data =
                            '<span class="badge badge-warning" onclick="showTimeline(\'' + row.id_srt + '\')" style="cursor: pointer;">Menunggu</span>';
                    } else if (row.status == "Sedang Diproses") {
                        data =
                            '<span class="badge badge-primary" onclick="showTimeline(\'' + row.id_srt + '\')" style="cursor: pointer;">Sedang Diproses</span>';
                    } else if (row.status == "Ditolak") {
                        data =
                            '<span class="badge badge-danger" onclick="showTimeline(\'' + row.id_srt + '\')" style="cursor: pointer;">Ditolak</span>';
                    } else {
                        data =
                            '<span class="badge badge-dark" style="overflow-wrap: break-word;word-wrap: break-word;hyphens: auto;white-space: normal; cursor: pointer;" onclick="showTimeline(\'' + row.id_srt + '\')">'+ row.status +'</span>';
                    }

                    return data;
                },
            },
            {
                field: "actions",
                title: "Aksi",
                sortable: false,
                width: 120,
                autoHide: false,
                overflow: "visible",
                template: function (row) {
                    let edit = "";
                    edit += `<button type="button" class="btn btn-outline-hover-primary" onclick="deleteSuratKeterangan(${row.id_srt});"><i class="flaticon-delete"></i> Hapus</button>`;
                    let content = `
          <span style="overflow: visible; position: relative; width: 110px;">
            <button type="button" class="btn btn-outline-hover-primary" onclick="lihatSuratKeterangan(${row.id_srt})"><i class="flaticon-folder-1"></i> Proses</button>${edit}
          </span>`;

                    return content;
                },
            },
        ],
    });
});

function lihatSuratKeterangan(id) {
    let frm = $("#frmSuratKeterangan");
    frm.attr("action", url + "admin/surat_keterangan/detail");
    frm.attr("method", "post");
    $("#id_surat").val(id);
    frm.submit();
}

function search() {
    let frm = $("#frmSuratKeterangan");
    frm.attr("action", url + "admin/surat_keterangan");
    frm.attr("method", "post");
    frm.submit();
}

//delete
function deleteSuratKeterangan(id) {
    // if (confirm("Apakah kamu yakin mau menghapus data ini?")) {
    //     let url = getCookie("url");
    //     let param = {
    //         id_surat: id,
            
    //     };

    //     $.ajax({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
    //         },
    //         url: url + "admin/surat_keterangan/delete",
    //         data: param,
    //         dataType: "json",
    //         method: "POST",
    //         success: function (resp) {
    //             //alert(resp);
    //             if (resp.status == true) {
    //                 swal.fire({
    //                     type: "success",
    //                     title: "Data berhasil dihapus!",
    //                     showConfirmButton: false,
    //                     timer: 1500,
    //                 });

    //                 setTimeout(function () {
    //                     let frm = $("#frmSuratKeterangan");
    //                     frm.attr("action", url + "admin/surat_keterangan");
    //                     frm.attr("method", "post");

    //                     frm.submit();
    //                 }, 1000);
    //             } else {
    //                 swal.fire({
    //                     type: "error",
    //                     title: "Gagal hapus data!",
    //                     text: resp.message,
    //                     showConfirmButton: false,
    //                     timer: 1500,
    //                 });

    //                 let content =
    //                     '<div class="alert alert-warning alert-dismissible" role="alert">';
    //                 content +=
    //                     '<div class="alert-icon"><i class="flaticon-warning"></i></div>';
    //                 content +=
    //                     '<div class="alert-text">' + resp.message + "</div>";
    //                 content +=
    //                     '<div class="alert-close"><i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i></div>';
    //                 content += "</div>";

    //                 let alert = $(content);
    //                 let form = $("#frmSuratKeterangan");

    //                 form.find(".alert").remove();
    //                 alert.prependTo(form);
    //                 KTUtil.animateClass(alert[0], "fadeIn animated");
    //             }
    //         },
    //     });
    // }

            var q = "Hapus surat keterangan?";
			var i = "Surat berhasil dihapus";
            let url = getCookie("url");

			$jQ.confirm({
				icon: 'fa fa-warning',
				title: 'Konfirmasi',
				content: q,
				type: 'red',
				buttons: {
					yes: {
						text: 'Ya',
						btnClass: 'btn-red',
						action: function() {
							let url = getCookie("url");
        let param = {
            id_surat: id,
            
        };

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
            url: url + "admin/surat_keterangan/delete",
            data: param,
            dataType: "json",
            method: "POST",
            success: function (resp) {
                //alert(resp);
                if (resp.status == true) {
                    swal.fire({
                        type: "success",
                        title: "Data berhasil dihapus!",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    setTimeout(function () {
                        let frm = $("#frmSuratKeterangan");
                        frm.attr("action", url + "admin/surat_keterangan");
                        frm.attr("method", "post");

                        frm.submit();
                    }, 1000);
                } else {
                    swal.fire({
                        type: "error",
                        title: "Gagal hapus data!",
                        text: resp.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    let content =
                        '<div class="alert alert-warning alert-dismissible" role="alert">';
                    content +=
                        '<div class="alert-icon"><i class="flaticon-warning"></i></div>';
                    content +=
                        '<div class="alert-text">' + resp.message + "</div>";
                    content +=
                        '<div class="alert-close"><i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i></div>';
                    content += "</div>";

                    let alert = $(content);
                    let form = $("#frmSuratKeterangan");

                    form.find(".alert").remove();
                    alert.prependTo(form);
                    KTUtil.animateClass(alert[0], "fadeIn animated");
                }
            },
        });
						}
					},
					no: {
						text: 'Tidak'
					}
				}
			})
}

/*var KTSelect2 = function() {
  // Private functions
  var SelectStatus = function() {
      $('#id_status_pegawai').select2({
          placeholder: "Semua Status"
      });
  }
  
  // Public functions
  return {
      init: function() {
        SelectStatus();
  }
};
}();

jQuery(document).ready(function () {
  KTSelect2.init();
  let url = getCookie('url');
  
  // GET DATA
  $.ajax({
    url: url+'/api/surat_keterangan/list',
    method: 'POST',
    data: {
      nama_pegawai: $('#nama_pegawai').val(),
      id_status_pegawai: $('#id_status_pegawai').val()
    },
    success: function(res){
      res = JSON.parse(res);
      let comp = '';
      res.forEach((el, index) => {
        comp += `
          <tr>
            <td>${index+1}A</td>
            <td>${el.jenis_surat}</td>
            <td>${el.nama}</td>
            <td>${el.tgl_surat}</td>
            <td>${el.keterangan}</td>
            <td>${el.status}</td>
            <td>
              <span style="overflow: visible; position: relative; width: 110px;">
                <button type="button" class="btn btn-outline-hover-primary" onclick="lihatSuratKeterangan(${el.id_srt})"><i class="flaticon-eye"></i> Lihat Detail</button>
              </span>
            </td>
          </tr>
        `;
      });
      $("#tbl tbody").html(comp);
      $('#tbl').KTDatatable({
        // datasource definition
        data: {
          saveState: {
            cookie: false
          }
        },
        // layout definition
        layout: {
          scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
          footer: false // display/hide footer
        },
        // column sorting
        sortable: true,
        pagination: true
      });
    }
  });
});

function lihatSuratKeterangan(id) {
    let url = getCookie('url');
    let frm = $('#frm');
    frm.attr('action', url+'admin/surat_keterangan/detail');
    frm.attr('method', 'post');
    $('#id_srt').val(id);
    frm.submit();
}

function search() {
  var frm = document.getElementById('frm');
  frm.action = 'surat_keterangan';
  frm.submit();
}
*/
