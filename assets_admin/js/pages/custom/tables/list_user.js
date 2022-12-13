jQuery(document).ready(function () {
  let url = getCookie('url');
  // GET DATA
  $.ajax({
    url: url+'/api/user/list',
    method: 'POST',
    data: {
      stts: $('#stts').val()
    },
    success: function(res){
      res = JSON.parse(res);
      let comp = '';
      res.forEach((el, index) => {
        let ttl = '';

        comp += `
          <tr>
            <td width="10px">${index+1}</td>
            <td>${el.username}</td>
            <td>${el.nama_lengkap}</td>
            <td>${el.email}</td>
            <td>${el.stts}</td>
            <td>${el.nama_lokasi_kerja}</td>
            <td>
            <span style="overflow: visible; position: relative; width: 171px;">
              <a href="${url}manage_user/detail/${el.id_user_login}" class="btn btn-outline-hover-primary"><i class="flaticon-eye"></i> Lihat Detail</a>
              
              <div class="dropdown">
                <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="flaticon-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-sm" style="">
                  <!--begin::Nav-->
                  <ul class="kt-nav">
                    <li class="kt-nav__item kt-nav__item--active">
                      <a href="${url}manage_user/edit/${el.id_user_login}" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-edit"></i>
                        <span class="kt-nav__link-text">Ubah Data</span>
                      </a>
                    </li>
                    <li class="kt-nav__item">
                      <a href="${url}manage_user/hapus/${el.id_user_login}" onClick="return confirm('Anda yakin..???');" class="kt-nav__link">
                        <i class="kt-nav__link-icon la la-trash"></i>
                        <span class="kt-nav__link-text">Hapus Data</span>
                      </a>
                    </li>
                  </ul>

                  <!--end::Nav-->
                </div>
              </div>
      
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
        sortable: false,
        pagination: true,
        
      });
    }
  });
});

function search() {
  var frm = document.getElementById('frm');
  frm.action = 'manage_user';
  frm.submit();
}