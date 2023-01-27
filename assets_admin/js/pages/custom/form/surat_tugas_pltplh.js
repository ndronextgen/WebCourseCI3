var counterFrmSuratTugasPltPlh = 1;
var id_surat = $("#id_surat_tugas_pltplh").val();
var url = getCookie("url");

$(document).ready(async function () {
	if (id_surat != 0) {
		let surat = await getSuratTugasPltPlh(id_surat);
		$("#keterangan").val(surat.keterangan);
		console.log(surat);
		if (surat.tembusan.indexOf("#|#") > 0) {
			let ket = surat.tembusan.split("#|#");
			let j;

			ket.forEach((elKet, i) => {
				$("#tembusan_" + (i + 1)).val(elKet);

				if (i > 0) {
					addFrmSuratTugasPltPlh(
						document.getElementById("btnAddSuratTugasPltPlh"),
						elKet
					);
				}
			});
		}
	}
});

function getSuratTugasPltPlh(id) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			method: "POST",
			dataType: "json",
			url: url + "api/surat_tugas_pltplh/detail",
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

function addFrmSuratTugasPltPlh(obj, val = "") {
	var content = `
    <div class="form-group" id="frmSuratTugasPlh">
        <label>Tembusan :</label>
        <textarea rows="2" id="tembusan_${counterFrmSuratTugasPltPlh}" name="tembusan[]" class="form-control">${val}</textarea>
        <br />
        <a href="javascript:;" onclick="removeFrmSuratTugasPlh(this);" class="btn-sm btn btn-label-danger btn-bold">
            <i class="la la-trash-o"></i>
            Hapus
        </a>
    </div>
    `;

	$(obj).parents().eq(1).before(content);

	counterFrmSuratTugasPltPlh++;
	$("#counterFrmSuratTugasPltPlh").val(counterFrmSuratTugasPltPlh);
}

function removeFrmSuratTugasPlh(obj) {
	$(obj).parents().eq(0).remove();
	$("#counterFrmSuratTugasPltPlh").val(counterFrmSuratTugasPltPlh);
}

function backSuratTugasPlh(act) {
	let action = "";
	if (act == "edit") {
		action = "/detail";
	}

	console.log("action:" + action);

	let frm = $("#formSuratTugasPltPlh");
	console.log(frm);
	frm.attr("action", url + "admin/surat_tugas_pltplh" + action);
	frm.attr("method", "post");
	frm.submit();
}
