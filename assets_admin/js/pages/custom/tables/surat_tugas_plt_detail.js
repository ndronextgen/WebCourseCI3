jQuery(document).ready(function () {
	let url = getCookie("url");
	// GET DATA
	$.ajax({
		url: url + "/api/surat_tugas_plt/list_detail",
		method: "POST",
		data: {
			id_pegawai: $("#id_pegawai").val(),
		},
		success: function (res) {
			res = JSON.parse(res);
			let comp = "";
			res.forEach((el, index) => {
				let lihat = `
          <div class="dropdown">
            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="flaticon-more"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm" style="">
              <!--begin::Nav-->
              <ul class="kt-nav">
                <li class="kt-nav__item kt-nav__item--active">
                  <a href="javascript:;" onclick="ubahSuratTugasPlt(${el.id_surat_tugas_plt})" class="kt-nav__link">
                    <i class="kt-nav__link-icon la la-edit"></i>
                    <span class="kt-nav__link-text">Ubah</span>
                  </a>
                </li>
                <li class="kt-nav__item">
                  <a href="${url}admin/surat_tugas_plt/delete/${el.id_surat_tugas_plt}" class="kt-nav__link">
                    <i class="kt-nav__link-icon la la-trash"></i>
                    <span class="kt-nav__link-text">Hapus</span>
                  </a>
                </li>
              </ul>

              <!--end::Nav-->
            </div>
          </div>
        `;

				// let keterangan = el.keterangan;
				// if (el.keterangan.indexOf("#|#") > 0) {
				// 	let ket = el.keterangan.split("#|#");
				// 	keterangan = "<ol>";
				// 	ket.forEach((elKet, i) => {
				// 		//if (i > 0) keterangan += '<br />';
				// 		keterangan += `<li>${elKet}</li>`;
				// 	});
				// 	keterangan += "</ol>";
				// }

				comp += `
          <tr>
            <td width="10px">${index + 1}</td>
            <td>${el.tanggal_pengajuan}</td>
            <td>${el.keterangan}</td>
            <td>
              <span style="overflow: visible; position: relative; width: 110px;">
                <a target="_blank" href="${url}admin/surat_tugas_plt/cetak/${
					el.id_surat_tugas_plt
				}/${
					el.id_pegawai
				}" class="btn btn-outline-hover-primary"><i class="flaticon-technology"></i> Cetak Surat</a>
                ${lihat}
              </span>
            </td>
          </tr>
        `;
			});
			$("#tbl tbody").html(comp);
			$("#tbl").KTDatatable({
				// datasource definition
				data: {
					saveState: {
						cookie: false,
					},
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
			});
		},
	});
});

function ubahSuratTugasPlt(id) {
	let frm = $("#frmSuratTugasPlt");
	frm.attr("action", url + "admin/surat_tugas_plt/edit");
	frm.attr("method", "post");
	$("#id_surat").val(id);
	frm.submit();
}
