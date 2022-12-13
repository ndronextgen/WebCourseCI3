var counterFrmSuratTugasPlh = 1;
var id_surat = $("#id_surat_tugas_plh").val();
var url = getCookie("url");

$(document).ready(async function () {
	if (id_surat != 0) {
		let surat = await getSuratTugasPlh(id_surat);
		$("#keterangan").val(surat.keterangan);
		console.log(surat);
		if (surat.tembusan.indexOf("#|#") > 0) {
			let ket = surat.tembusan.split("#|#");
			let j;

			ket.forEach((elKet, i) => {
				$("#tembusan_" + (i + 1)).val(elKet);

				if (i > 0) {
					addFrmSuratTugasPlh(
						document.getElementById("btnAddSuratTugasPlh"),
						elKet
					);
				}
			});
		}
	}
});

function getSuratTugasPlh(id) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			method: "POST",
			dataType: "json",
			url: url + "api/surat_tugas_plh/detail",
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

function addFrmSuratTugasPlh(obj, val = "") {
	var content = `
    <div class="form-group" id="frmSuratTugasPlh">
        <label>Tembusan :</label>
        <textarea rows="4" id="tembusan_${counterFrmSuratTugasPlh}" name="tembusan[]" class="form-control">${val}</textarea>
        <br />
        <a href="javascript:;" onclick="removeFrmSuratTugasPlh(this);" class="btn-sm btn btn-label-danger btn-bold">
            <i class="la la-trash-o"></i>
            Hapus
        </a>
    </div>
    `;

	$(obj).parents().eq(1).before(content);

	counterFrmSuratTugasPlh++;
	$("#counterFrmSuratTugasPlh").val(counterFrmSuratTugasPlh);
}

function removeFrmSuratTugasPlh(obj) {
	$(obj).parents().eq(0).remove();
	$("#counterFrmSuratTugasPlh").val(counterFrmSuratTugasPlh);
}

function backSuratTugasPlh(act) {
	let action = "";
	if (act == "edit") {
		action = "/detail";
	}

	console.log("action:" + action);

	let frm = $("#formSuratTugasPlh");
	console.log(frm);
	frm.attr("action", url + "admin/surat_tugas_plh" + action);
	frm.attr("method", "post");
	frm.submit();
}
