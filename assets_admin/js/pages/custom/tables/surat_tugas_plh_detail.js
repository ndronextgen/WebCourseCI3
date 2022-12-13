jQuery(document).ready(function () {
	let url = getCookie("url");

	var tblTugasPlh = $("#tbl_lisplh").KTDatatable({
		// datasource definition
		data: {
			type: "remote",
			source: {
				read: {
					url: url + "/api/surat_tugas_plh/list_detail",
					method: "POST",
					data: { id_pegawai: $("#id_pegawai").val(),},
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
					var currPage = tblTugasPlh.getCurrentPage();
					return currPage * 20 - 20 + (index + 1);
				},
			},
			{
				field: "nm_peg2",
				title: "Menggantikan",
				autoHide: false,
				width: 140,
				overflow: "visible",
			},
			{
				field: "lokasi_kerja",
				title: "Lokaksi PLH",
				autoHide: false,
				width: 300,
				overflow: "visible",
			},
			{
				field: "alasan_plh",
				title: "Alasan",
				overflow: "visible",
			},
			{
				field: "durasi",
				title: "Lama (Hari)",
				overflow: "visible",
			},
			{
				field: "tanggal_pengajuan",
				title: "Tanggal Dibuat",
				overflow: "visible",
			},
			{
				field: "actions",
				title: "Aksi",
				sortable: false,
				width: 250,
				autoHide: false,
				overflow: "visible",
				template: function (row) {
					let content = `<a target="_blank" href="${url}admin/surat_tugas_plh/cetak/${row.id_surat_tugas_plh}/${											row.id_pegawai}" class="btn btn-outline-hover-primary"><i class="flaticon-technology"></i> Cetak</a>
					<a href="${url}admin/surat_tugas_plh/delete/${row.id_surat_tugas_plh}" class="btn btn-outline-hover-danger">
					<i class="kt-nav__link-icon la la-trash"></i>
					Hapus
				  </a>`;

					return content;
				},
			},
		],
	});
});













// 	// GET DATA
// 	$.ajax({
// 		url: url + "/api/surat_tugas_plh/list_detail",
// 		method: "POST",
// 		data: {
// 			id_pegawai: $("#id_pegawai").val(),
// 		},
// 		success: function (res) {
// 			res = JSON.parse(res);
// 			let comp = "";
// 			res.forEach((el, index) => {
// 				let lihat = `
//           <div class="dropdown">
//             <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
//               <i class="flaticon-more"></i>
//             </a>
//             <div class="dropdown-menu dropdown-menu-sm" style="">
//               <!--begin::Nav-->
//               <ul class="kt-nav">
                
//                 <li class="kt-nav__item">
//                   <a href="${url}admin/surat_tugas_plh/delete/${el.id_surat_tugas_plh}" class="kt-nav__link">
//                     <i class="kt-nav__link-icon la la-trash"></i>
//                     <span class="kt-nav__link-text">Hapus</span>
//                   </a>
//                 </li>
//               </ul>

//               <!--end::Nav-->
//             </div>
//           </div>
//         `;

// 				// let tembusan = el.tembusan;
// 				// if (el.tembusan.indexOf("#|#") > 0) {
// 				// 	let ket = el.tembusan.split("#|#");
// 				// 	tembusan = "<ol>";
// 				// 	ket.forEach((elKet, i) => {
// 				// 		//if (i > 0) tembusan += '<br />';
// 				// 		tembusan += `<li>${elKet}</li>`;
// 				// 	});
// 				// 	tembusan += "</ol>";
// 				// }

// 				comp += `
//           <tr>
//             <td width="10px">${index + 1}</td>
//             <td>${el.nm_peg2}</td>
//             <td>${el.lokasi_kerja}</td>
//             <td>${el.alasan_plh}</td>
//             <td>${el.durasi}</td>
//             <td>${el.tanggal_pengajuan}</td>
//             <td>
//               <span style="overflow: visible; position: relative; width: 110px;">
//                 <a target="_blank" href="${url}admin/surat_tugas_plh/cetak/${
// 					el.id_surat_tugas_plh
// 				}/${
// 					el.id_pegawai
// 				}" class="btn btn-outline-hover-primary"><i class="flaticon-technology"></i> Cetak Surat</a>
//                 ${lihat}
//               </span>
//             </td>
//           </tr>
//         `;
// 			});
// 			$("#tbl tbody").html(comp);
// 			$("#tbl").KTDatatable({
// 				// datasource definition
// 				data: {
// 					saveState: {
// 						cookie: false,
// 					},
// 				},
// 				rows: {
// 					autoHide: false
// 				  },
// 				// layout definition
// 				layout: {
// 					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
// 					footer: false, // display/hide footer
// 				},
// 				// column sorting
// 				sortable: true,
// 				pagination: true,
// 				search: {
// 					input: $("#txtSearch"),
// 				},
// 				columns: [
// 					{
// 						field: "no",
// 						title: "No",
// 						autoHide: false,
// 						sortable: false,
// 						width: 2,
// 						overflow: "visible",
// 					},
// 				],
				
// 			});
// 		},
// 	});
// });

function ubahSuratTugasPlh(id) {
	let frm = $("#frmSuratTugasPlh");
	frm.attr("action", url + "admin/surat_tugas_plh/edit");
	frm.attr("method", "post");
	$("#id_surat").val(id);
	frm.submit();
}
