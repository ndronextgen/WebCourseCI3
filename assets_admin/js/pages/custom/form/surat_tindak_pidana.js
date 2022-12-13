var counterFrmSuratTindakPidana = 1;
var id_surat = $("#id_surat_tindak_pidana").val();
var url = getCookie("url");

$(document).ready(async function () {
	if (id_surat != 0) {
		let surat = await getSuratTindakPidana(id_surat);
		$("#keterangan").val(surat.keterangan);
		console.log(surat);
		// if (surat.keterangan.indexOf("#|#") > 0) {
		// 	let ket = surat.keterangan.split("#|#");
		// 	let j;

		// 	ket.forEach((elKet, i) => {
		// 		$("#keterangan_" + (i + 1)).val(elKet);

		// 		if (i > 0) {
		// 			addFrmSuratTindakPidana(
		// 				document.getElementById("btnAddSuratTindakPidana"),
		// 				elKet
		// 			);
		// 		}
		// 	});
		// }
	}
});

function getSuratTindakPidana(id) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			method: "POST",
			dataType: "json",
			url: url + "api/surat_tindak_pidana/detail",
			data: { id_surat: id },
			success: function (resp) {
				resolve(resp);
			},
			error: function () {
				reject(false);
			},
		});
	});
}

function addFrmSuratTindakPidana(obj, val = "") {
	var content = `
    <div class="form-group" id="frmSuratTindakPidana">
        <label>Keterangan :</label>
        <textarea rows="4" id="keterangan_${counterFrmSuratTindakPidana}" name="keterangan[]" class="form-control">${val}</textarea>
        <br />
        <a href="javascript:;" onclick="removeFrmSuratTindakPidana(this);" class="btn-sm btn btn-label-danger btn-bold">
            <i class="la la-trash-o"></i>
            Hapus
        </a>
    </div>
    `;

	$(obj).parents().eq(1).before(content);

	counterFrmSuratTindakPidana++;
	$("#counterFrmSuratTindakPidana").val(counterFrmSuratTindakPidana);
}

function removeFrmSuratTindakPidana(obj) {
	$(obj).parents().eq(0).remove();
	$("#counterFrmSuratTindakPidana").val(counterFrmSuratTindakPidana);
}

function backSuratTindakPidana(act) {
	let action = "";
	if (act == "edit") {
		action = "/detail";
	}

	console.log("action:" + action);

	let frm = $("#formSuratTindakPidana");
	console.log(frm);
	frm.attr("action", url + "admin/surat_tindak_pidana" + action);
	frm.attr("method", "post");
	frm.submit();
}
