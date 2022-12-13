var url = getCookie('url');

jQuery(document).ready(function () {
  var tblSuratHukdis = $('#tblSuratHukdis').KTDatatable({
    // datasource definition
    data: {
      type: 'remote',
      source: {
        read: {
          url: url+'/api/surat_hukdis/list_detail',
          method: 'POST',
          params: {
            id_pegawai: $('#id_pegawai').val()
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
          var currPage = tblSuratHukdis.getCurrentPage();
          return ((currPage*20)-20)+(index+1);
        }
      },
      {
        field: 'tanggal_pengajuan',
        title: 'Tanggal&nbsp;Pengajuan',
        autoHide: false,
        width: 140,
        overflow: 'visible',
      }, 
      {
        field: 'tipe_surat',
        title: 'Tipe&nbsp;Surat',
        width: 200,
        overflow: 'visible',
      }, 
      {
        field: 'penutup',
        title: 'Keterangan',
        overflow: 'visible',
      }, 
      {
        field: 'actions',
        title: 'Aksi',
        sortable: false,
        width: 190,
        autoHide: false,
        overflow: 'visible',
        template: function(row) {
          let lihat = `
            <div class="dropdown">
              <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="flaticon-more"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-sm" style="">
                <!--begin::Nav-->
                <ul class="kt-nav">
                  <li class="kt-nav__item kt-nav__item--active">
                    <a href="javascript:;" onclick="ubahSuratHukdis(${row.id_surat_hukdis})" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-edit"></i>
                      <span class="kt-nav__link-text">Ubah</span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="javascript:;" onclick="deleteSuratHukdis(${row.id_surat_hukdis});" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-trash"></i>
                      <span class="kt-nav__link-text">Hapus</span>
                    </a>
                  </li>
                </ul>

                <!--end::Nav-->
              </div>
            </div>`;

          let content = `
            <span style="overflow: visible; position: relative; width: 110px;">
              <button type="button" class="btn btn-outline-hover-primary" onclick="cetak(${row.id_surat_hukdis},${row.id_pegawai});"><i class="flaticon-technology"></i> Cetak Surat</button>
              ${lihat}
            </span>`;

          return content;
        }
      }
    ],
  });
});

function buatSuratHukdis() {
  let frm = $('#frmSuratHukdis');
  frm.attr('action', url+'admin/surat_hukdis/add');
  frm.attr('method', 'post');
  
  frm.submit();
}

function ubahSuratHukdis(id) {
  let frm = $('#frmSuratHukdis');
  frm.attr('action', url+'admin/surat_hukdis/edit');
  frm.attr('method', 'post');
  $('#id_surat').val(id);
  $('#act').val('detail');
  
  frm.submit();
}

function backSuratHukdis(act) {
  let action = '';
  if (act == 'edit') {
    action = '/detail';
  }
  
  let frm = $('#frmSuratHukdis');
  frm.attr('action', url+'admin/surat_hukdis'+action);
  frm.attr('method', 'post');
  frm.submit();
}

function cetak(id_surat_hukdis, id_pegawai) {
  swal.fire({
    type: 'success',
    title: 'Cetak Surat Hukuman Disiplin...',
    showConfirmButton: false,
    timer: 1500 
  });
  setTimeout(function() {
    window.open(url+'admin/surat_hukdis/cetak/'+id_surat_hukdis+'/'+id_pegawai, '_blank');
  }, 1000);
}



//delete
function deleteSuratHukdis(id) {
  let param = {
      id_surat: id
  };
  
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      url: url+'admin/surat_hukdis/delete',
      data: param,
      dataType: 'json',
      method: 'POST',
      success: function(resp) {
          if (resp.status == true) {
              swal.fire({
                  type: 'success',
                  title: 'Data berhasil dihapus!',
                  showConfirmButton: false,
                  timer: 1500 
              });

              setTimeout(function() {
                  let frm = $('#frmSuratHukdis');
                  frm.attr('action', url+'admin/surat_hukdis/detail');
                  frm.attr('method', 'post');
                  frm.submit();
              }, 1000);
          }
          else {
              swal.fire({
                  type: 'error',
                  title: 'Gagal hapus data!',
                  text: resp.message,
                  showConfirmButton: false,
                  timer: 1500 
              });

              let content = '<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">';
              content += '<div class="alert-icon"><i class="flaticon-warning"></i></div>';
              content += '<div class=\"alert-text\">'+resp.message+'</div>';
              content += '<div class=\"alert-close\"><i class=\"flaticon2-cross kt-icon-sm\" data-dismiss=\"alert\"></i></div>';
              content += '</div>';

              let alert = $(content);
              let form = $('#frmSuratHukdis');

              form.find('.alert').remove();
              alert.prependTo(form);
              KTUtil.animateClass(alert[0], 'fadeIn animated');
          }
      }
  });
}