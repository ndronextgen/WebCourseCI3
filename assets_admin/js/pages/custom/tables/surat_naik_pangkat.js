var KTSelect2 = (function () {
	var Select2 = function () {
		$("#id_status_surat").select2({
			placeholder: "Pilih Status Surat",
		});
	};

	// Public functions
	return {
		init: function () {
			Select2();
		},
	};
})();

jQuery(document).ready(function () {
	KTSelect2.init();
	let url = getCookie("url");

	var tblNaikPangkat = $("#tblNaikPangkat").KTDatatable({
		// datasource definition
		data: {
			type: "remote",
			source: {
				read: {
					url: url + "/api/surat_naik_pangkat/datatable",
					method: "POST",
					params: {
						id_pegawai: $("#id_pegawai").val(),
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
		sortable: false,
		//order: [[ 1, "desc" ]],
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
					var currPage = tblNaikPangkat.getCurrentPage();
					var result_number = currPage * 20 - 20 + (index + 1);
					
					if (row.jml <= 0) {
						data =
							'<span style="font-weight:bold;">' + result_number + "</span>";
					} else {
						data =
							'<span style="font-weight:italic;">' + result_number + "</span>";
					}

					return data;
				},
			},
			{
				field: "group_nama",
				title: "Nama Pegawai",
				autoHide: false,
				width: 140,
				overflow: "visible",
				template: function (row) {
					let data;
					if (row.jml <= 0) {
						data =
							'<span style="font-weight:bold;">' + row.group_nama + "</span>";
					} else {
						data =
							'<span style="font-weight:italic;">' + row.group_nama + "</span>";
					}

					return data;
				},
			},
			{
				field: "tanggal_pengajuan",
				title: "Tanggal&nbsp;Pengajuan",
				autoHide: false,
				width: 140,
				overflow: "visible",
				template: function (row) {
					let data;
					if (row.jml <= 0) {
						data =
							'<span style="font-weight:bold;">' + row.tanggal_pengajuan + "</span>";
					} else {
						data =
							'<span style="font-weight:italic;">' + row.tanggal_pengajuan + "</span>";
					}

					return data;
				},
			},
			{
				field: "keterangan",
				title: "Keterangan",
				overflow: "visible",
				template: function (row) {
					let data;
					if (row.jml <= 0) {
						data =
							'<span style="font-weight:bold;">' + row.keterangan + "</span>";
					} else {
						data =
							'<span style="font-weight:italic;">' + row.keterangan + "</span>";
					}

					return data;
				},
			},
			{
				field: "status_surat",
				title: "Status",
				width: 120,
				overflow: "visible",
				template: function (row) {
					let data;
					if (row.status_surat == "Selesai") {
						data = '<span class="badge badge-success">Selesai</span>';
					} else if (row.status_surat == "Menunggu") {
						data = '<span class="badge badge-warning">Menunggu</span>';
					} else if (row.status_surat == "Sedang Diproses") {
						data = '<span class="badge badge-primary">Sedang Diproses</span>';
					} else if (row.status_surat == "Ditolak") {
						data = '<span class="badge badge-danger">Ditolak</span>';
					} else {
						data = '<span class="badge badge-dark">Unknow Status</span>';
					}

					return data;
				},
			},
			{
				field: "actions",
				title: "Aksi",
				sortable: false,
				width: 430,
				autoHide: false,
				overflow: "visible",
				template: function (row) {
					let edit = "";
					if (row.id_status_srt == 0) {
						edit += `<button type="button" class="btn btn-outline-hover-primary" onclick="deleteSuratNaikPangkat(${row.id_surat_naik_pangkat});"><i class="flaticon-delete"></i> Hapus</button>`;
					}
					if (row.id_status_srt == 3 && row.group_dinas == 2) {
						edit += `<button type="button" class="btn btn-outline-hover-primary" onclick="download_surat(${row.id_surat_naik_pangkat});"><i class="flaticon-download"></i> UPT to Dinas</button><button type="button" class="btn btn-outline-hover-primary" onclick="download_surat2(${row.id_surat_naik_pangkat});"><i class="flaticon-download"></i> Dinas to BKD</button>`;
						if(row.admin_lk=='' || row.admin_lk==null || row.admin_lk=='0'){
						edit += `<button type="button" class="btn btn-outline-hover-primary" onclick="deleteSuratNaikPangkat(${row.id_surat_naik_pangkat});"><i class="flaticon-delete"></i> Hapus</button>`;
						}
					} else {
						edit += `<button type="button" class="btn btn-outline-hover-primary" onclick="download_surat(${row.id_surat_naik_pangkat});"><i class="flaticon-download"></i> Download</button>`;
						if(row.admin_lk=='' || row.admin_lk==null || row.admin_lk=='0'){
						edit += `<button type="button" class="btn btn-outline-hover-primary" onclick="deleteSuratNaikPangkat(${row.id_surat_naik_pangkat});"><i class="flaticon-delete"></i> Hapus</button>`;
						}
					}

					let content = `
          <span style="overflow: visible; position: relative; width: 220px;">
            <button type="button" class="btn btn-outline-hover-primary" onclick="detailSuratNaikPangkat(${row.id_surat_naik_pangkat});"><i class="flaticon-folder-1"></i> Lihat Detail</button>
            ${edit}
          </span>`;

					return content;
				},
			},
		],
	});
});

function search() {
	let url = getCookie("url");
	let frm = $("#frmSuratNaikPangkat");
	frm.attr("action", url + "admin/surat_naik_pangkat");
	frm.attr("method", "post");
	frm.submit();
}

function buatSuratNaikPangkat() {
	let url = getCookie("url");
	let frm = $("#frmSuratNaikPangkat");
	frm.attr("action", url + "admin/surat_naik_pangkat/add");
	frm.attr("method", "post");

	frm.submit();
}

function detailSuratNaikPangkat(id) {
	let url = getCookie("url");
	let frm = $("#frmSuratNaikPangkat");
	frm.attr("action", url + "admin/surat_naik_pangkat/detail");
	frm.attr("method", "post");
	$("#id_surat").val(id);
	frm.submit();
}

function ubahSuratNaikPangkat(id) {
	let url = getCookie("url");
	let frm = $("#frmSuratNaikPangkat");
	frm.attr("action", url + "admin/surat_naik_pangkat/edit");
	frm.attr("method", "post");
	$("#id_surat").val(id);
	frm.submit();
}

//download surat
function download_surat_finished(id) {
	let url = getCookie("url");

	swal.fire({
		type: "success",
		title: "Downloading...",
		showConfirmButton: false,
		timer: 1500,
	});
	setTimeout(function () {
		url += "admin/surat_naik_pangkat/download_surat_finished/" + id;
		window.open(url, "_blank");
	}, 1000);
}

function download_surat(id) {
	let url = getCookie("url");
	url += "admin/surat_naik_pangkat/download_surat/" + id;
	window.open(url, "_blank");
	window.focus();
}

function download_surat2(id) {
	let url = getCookie("url");
	url += "admin/surat_naik_pangkat/download_surat2/" + id;
	window.open(url, "_blank");
	window.focus();
}

//delete
function deleteSuratNaikPangkat(id) {
	let url = getCookie("url");
	let param = {
		id_surat: id,
	};

	$.ajax({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
		},
		url: url + "admin/surat_naik_pangkat/delete",
		data: param,
		dataType: "json",
		method: "POST",
		success: function (resp) {
			if (resp.status == true) {
				swal.fire({
					type: "success",
					title: "Data berhasil dihapus!",
					showConfirmButton: false,
					timer: 1500,
				});

				setTimeout(function () {
					let frm = $("#frmSuratNaikPangkat");
					frm.attr("action", url + "admin/surat_naik_pangkat");
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
				content += '<div class="alert-text">' + resp.message + "</div>";
				content +=
					'<div class="alert-close"><i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i></div>';
				content += "</div>";

				let alert = $(content);
				let form = $("#frmSuratNaikPangkat");

				form.find(".alert").remove();
				alert.prependTo(form);
				KTUtil.animateClass(alert[0], "fadeIn animated");
			}
		},
	});
}
