// Class definition
var url = getCookie("url");

var KTSelect2 = (function () {
	// Private functions
	var foto = new KTAvatar("kt_edit_foto");
	var signature = new KTAvatar("kt_edit_signature");
	var Select2Pegawai = function () {
		$("#kode_provinsi").select2({
			placeholder: "Pilih Provinsi",
		});

		$("#kode_kabupaten").select2({
			placeholder: "Pilih Kabupaten/Kota",
		});

		$("#kode_kecamatan").select2({
			placeholder: "Pilih Kecamatan",
		});

		$("#kode_kelurahan").select2({
			placeholder: "Pilih Kelurahan",
		});
		$("#kode_provinsi_ktp").select2({
			placeholder: "Pilih Provinsi",
		});

		$("#kode_kabupaten_ktp").select2({
			placeholder: "Pilih Kabupaten/Kota",
		});

		$("#kode_kecamatan_ktp").select2({
			placeholder: "Pilih Kecamatan",
		});

		$("#kode_kelurahan_ktp").select2({
			placeholder: "Pilih Kelurahan",
		});

		$("#agama").select2({
			placeholder: "Pilih Agama",
		});

		$("#status_pegawai").select2({
			placeholder: "Pilih Status Pegawai",
		});

		$("#pendidikan").select2({
			placeholder: "Pilih Pendidikan Terakhir",
		});

		$("#pendidikan_bkd").select2({
			placeholder: "Pilih Pendidikan Terverifikasi BKD",
		});

		$("#id_golongan").select2({
			placeholder: "Pilih Golongan",
		});

		$("#id_eselon").select2({
			placeholder: "Pilih Eselon",
		});

		$("#id_status_jabatan").select2({
			placeholder: "Pilih Status Jabatan",
		});

		$("#id_rumpun_jabatan").select2({
			placeholder: "Pilih Rumpun Jabatan",
		});

		$("#id_jabatan").select2({
			placeholder: "Pilih Nama Jabatan",
		});

		$("#lokasi_kerja").select2({
			placeholder: "Pilih Lokasi Kerja",
		});

		$("#seksi").select2({
			placeholder: "Pilih Seksi/ Subbag/ Satlak",
		});
		/*
        $('#mdlArsip_Keluarga_jenis_kelamin').select2({
            placeholder: "Pilih Jenis Kelamin"
        });  

        $('#mdlArsip_Pangkat_id_golongan').select2({
            placeholder: "Pilih Golongan"
        });  

        $('#mdlArsip_Jabatan_id_riwayat_status_jabatan').select2({
            placeholder: "Pilih Status Jabatan"
        });  

        $('#mdlArsip_Jabatan_id_r_jabatan').select2({
            placeholder: "Pilih Nama Jabatan"
        });  

        $('#mdlArsip_Pendidikan_id_master_pendidikan').select2({
            placeholder: "Pilih Tingkat Pendidikan"
        });  */
	};

	// Public functions
	return {
		init: function () {
			Select2Pegawai();
		},
	};
})();

var IsCheck = (function () {
	$("#alamat_ktp").prop("readonly", true);

	var initCheck = function () {
		if ($("#is_check").is(":checked")) {
			$("#kode_provinsi_ktp").prop("readonly", true);
			$("#kode_kabupaten_ktp").prop("readonly", true);
			$("#kode_kecamatan_ktp").prop("readonly", true);
			$("#kode_kelurahan_ktp").prop("readonly", true);
			$("#alamat_ktp").prop("readonly", true);
		} else {
			$("#kode_provinsi_ktp").prop("readonly", false);
			$("#kode_kabupaten_ktp").prop("readonly", false);
			$("#kode_kecamatan_ktp").prop("readonly", false);
			$("#kode_kelurahan_ktp").prop("readonly", false);
			$("#alamat_ktp").prop("readonly", false);
		}
	};

	var OnChangeCheck = function () {
		$("#is_check").click(function () {
			if ($("#is_check").is(":checked")) {
				//if copy is checked
				//$("#alamat_ktp").val($("#alamat").val());

				let sesuaikan = $("#alamat")
					.val()
					.concat(
						" Kelurahan ",
						$("#nama_kelurahan").val(),
						" Kecamatan ",
						$("#nama_kecamatan").val(),
						" ",
						$("#nama_kabupaten").val(),
						" Provinsi ",
						$("#nama_provinsi").val()
					);
				//alert(sesuaikan);
				$("#alamat_ktp").val(sesuaikan);

				//set selected value
				$("#kode_provinsi_ktp")
					.val($("#kode_provinsi").val())
					.trigger("change");
				$("#alamat_ktp").prop("readonly", true);
			} else {
				$("#kode_provinsi_ktp")[0].setAttribute(
					"onchange",
					"OnChangeKodeProvinsiKtp(this.value);"
				);
				$("#kode_provinsi_ktp").prop("readonly", false);
				$("#kode_provinsi_ktp")[0].removeAttribute("disabled");
				$("#kode_kabupaten_ktp")[0].setAttribute(
					"onchange",
					"OnChangeKodeKabupatenKtp(this.value);"
				);
				$("#kode_kabupaten_ktp").prop("readonly", false);
				$("#kode_kabupaten_ktp")[0].removeAttribute("disabled");
				$("#kode_kecamatan_ktp")[0].setAttribute(
					"onchange",
					"OnChangeKodeKecamatanKtp(this.value);"
				);
				$("#kode_kecamatan_ktp").prop("readonly", false);
				$("#kode_kecamatan_ktp")[0].removeAttribute("disabled");
				$("#kode_kelurahan_ktp")[0].setAttribute(
					"onchange",
					"OnChangeKodeKelurahanKtp(this.value);"
				);
				$("#kode_kelurahan_ktp").prop("readonly", false);
				$("#kode_kelurahan_ktp")[0].removeAttribute("disabled");
				$("#alamat_ktp").prop("readonly", false);

				$("#kode_provinsi_ktp").val("").trigger("change");
				$("#nama_provinsi_ktp").val("");
				$("#kode_kabupaten_ktp").val("").trigger("change");
				$("#kode_kabupaten_ktp").html('<option value="">Kab/ Kota</option>');
				$("#nama_kabupaten_ktp").val("");
				$("#kode_kecamatan_ktp").val("").trigger("change");
				$("#kode_kecamatan_ktp").html('<option value="">Kecamatan</option>');
				$("#nama_kecamatan_ktp").val("");
				$("#kode_kelurahan_ktp").val("").trigger("change");
				$("#kode_kelurahan_ktp").html('<option value="">Kelurahan</option>');
				$("#nama_kelurahan_ktp").val("");
				$("#alamat_ktp").val("");
			}
		});
	};

	return {
		init: function () {
			OnChangeCheck();
			initCheck();
		},
	};
})();

var LokasiKerja = (function () {
	var OnChangeLokasiKerja = function () {
		$("#lokasi_kerja").change(function () {
			var id_lokasi_kerja = $("#lokasi_kerja").val();
			$.ajax({
				url: url + "pegawai/sub_lokasi_kerja_by_lokasi_kerja",
				method: "POST",
				data: { id_lokasi_kerja: id_lokasi_kerja },
				success: function (data) {
					$("#seksi").html(data);
				},
			});
			if(id_lokasi_kerja != '52'){
				document.getElementById("sublokasi").style.display = "none";
			} else {
				document.getElementById("sublokasi").style.display = "";
			}
		});
		
	};

	return {
		init: function () {
			OnChangeLokasiKerja();
		},
	};
})();

// onload lokasi kerja
var id_lokasi_kerja = $('#lokasi_kerja').val();
if(id_lokasi_kerja != '52'){
	document.getElementById("sublokasi").style.display = "none";
} else {
	document.getElementById("sublokasi").style.display = "";
}

var IdStatusJabatan = (function () {
	var OnChangeIdStatusJabatan = function () {
		$("#id_status_jabatan").change(function () {
			var id_status_jabatan = $("#id_status_jabatan").val();
			var val_eselon = $("#id_eselon").val();
			var val_status_jabatan = $("#id_status_jabatan").val();
			var val_nama_jabatan = $("#id_jabatan").val();
			if (id_status_jabatan != "") {
				// $.ajax({
				// 	url: url + "dashboard_publik/nama_jabatan",
				// 	method: "POST",
				// 	data: { id_status_jabatan: id_status_jabatan },
				// 	success: function (data) {
				// 		$("#id_jabatan").html(data);
				// 	},
				// });

				$.ajax({
					type: "POST",
					url: url + "dashboard_publik/nama_jabatan_new",
					data: {
						eselon: val_eselon,
						status_jabatan: val_status_jabatan,
						id_nama_jabatan: val_nama_jabatan,
					},
					success: function (data) {
						$("#id_jabatan").html(data).trigger("change");
					},
				});

				if (id_status_jabatan == 2) {
					//struktural, tampilkan eselon
					$("#grpEselon").show();
					$("#id_eselon").val("").trigger("change");
				} else {
					$("#grpEselon").hide();
					$("#id_eselon").val("").trigger("change");
				}

				if (id_status_jabatan == 6) {
					//fungsional umum, tampilkan rumpun jabatan
					$("#grpRumpunJabatan").show();
				} else {
					$("#grpRumpunJabatan").hide();
				}

				if (id_status_jabatan == 9) {
					//status jabatan = '-', hide nama jabatan
					$("#grpNamaJabatan").hide();
				} else {
					$("#grpNamaJabatan").show();
				}
			} else {
				$("#id_jabatan").html('<option value="">Pilih Nama Jabatan</option>');
				$("#grpNamajabatan").hide();
			}
		});
	};

	return {
		init: function () {
			OnChangeIdStatusJabatan(url);
		},
	};
})();

jQuery(document).ready(function () {
	KTSelect2.init();
	IsCheck.init();
	LokasiKerja.init();
	IdStatusJabatan.init();
});

$("#kode_provinsi").change(function () {
	var kode_provinsi = this.value;

	$.ajax({
		url: url + "wilayah/get_provinsi_data",
		method: "POST",
		data: { kode_provinsi: kode_provinsi },
		success: function (data) {
			let resp = JSON.parse(data);
			$("#nama_provinsi").val(resp.nama_provinsi);

			//generate kab/kota
			gen_dropdown_kabupaten(kode_provinsi);
		},
	});
});

function gen_dropdown_kabupaten(kode_provinsi) {
	$.ajax({
		url: url + "wilayah/gen_dropdown_kabupaten",
		method: "POST",
		data: { kode_provinsi: kode_provinsi },
		success: function (data) {
			$("#kode_kabupaten").html(data);
			$("#nama_kabupaten").val("");
			$("#kode_kecamatan").html("");
			$("#nama_kecamatan").val("");
			$("#kode_kelurahan").html("");
			$("#nama_kelurahan").val("");
		},
	});
}

$("#kode_kabupaten").change(function () {
	var kode_kabupaten = this.value;

	$.ajax({
		url: url + "wilayah/get_kabupaten_data",
		method: "POST",
		data: { kode_kabupaten: kode_kabupaten },
		success: function (data) {
			let resp = JSON.parse(data);
			$("#nama_kabupaten").val(resp.nama_kabupaten);

			//generate kab/kota
			gen_dropdown_kecamatan(kode_kabupaten);
		},
	});
});

function gen_dropdown_kecamatan(kode_kabupaten) {
	$.ajax({
		url: url + "wilayah/gen_dropdown_kecamatan",
		method: "POST",
		data: { kode_kabupaten: kode_kabupaten },
		success: function (data) {
			$("#kode_kecamatan").html(data);
			$("#nama_kecamatan").val("");
			$("#kode_kelurahan").html("");
			$("#nama_kelurahan").val("");
		},
	});
}

$("#kode_kecamatan").change(function () {
	var kode_kecamatan = this.value;

	$.ajax({
		url: url + "wilayah/get_kecamatan_data",
		method: "POST",
		data: { kode_kecamatan: kode_kecamatan },
		success: function (data) {
			let resp = JSON.parse(data);
			$("#nama_kecamatan").val(resp.nama_kecamatan);

			//generate kab/kota
			gen_dropdown_kelurahan(kode_kecamatan);
		},
	});
});

function gen_dropdown_kelurahan(kode_kecamatan) {
	$.ajax({
		url: url + "wilayah/gen_dropdown_kelurahan",
		method: "POST",
		data: { kode_kecamatan: kode_kecamatan },
		success: function (data) {
			$("#nama_kelurahan").val("");
			$("#kode_kelurahan").html(data);
		},
	});
}

$("#kode_kelurahan").change(function () {
	var kode_kelurahan = this.value;

	$.ajax({
		url: url + "wilayah/get_kelurahan_data",
		method: "POST",
		data: { kode_kelurahan: kode_kelurahan },
		success: function (data) {
			let resp = JSON.parse(data);
			$("#nama_kelurahan").val(resp.nama_kelurahan);
		},
	});
});

function OnChangeKodeProvinsiKtp(kode_provinsi) {
	$.ajax({
		url: url + "wilayah/get_provinsi_data",
		method: "POST",
		data: { kode_provinsi: kode_provinsi },
		success: function (data) {
			let resp = JSON.parse(data);

			if (resp != null) {
				$("#nama_provinsi_ktp").val(resp.nama_provinsi);

				//generate kab/kota
				gen_dropdown_kabupaten_ktp(kode_provinsi);
			}
		},
	});
}

function gen_dropdown_kabupaten_ktp(kode_provinsi) {
	$.ajax({
		url: url + "wilayah/gen_dropdown_kabupaten",
		method: "POST",
		data: { kode_provinsi: kode_provinsi },
		success: function (data) {
			$("#nama_kabupaten_ktp").val("");
			$("#kode_kecamatan_ktp").html("");
			$("#nama_kecamatan_ktp").val("");
			$("#kode_kelurahan_ktp").html("");
			$("#nama_kelurahan_ktp").val("");
			$("#kode_kabupaten_ktp").html(data);

			if ($("#is_check").is(":checked")) {
				//set default selected
				$("#kode_kabupaten_ktp")
					.val($("#kode_kabupaten").val())
					.trigger("change");
			}
		},
	});
}

function OnChangeKodeKabupatenKtp(kode_kabupaten) {
	$.ajax({
		url: url + "wilayah/get_kabupaten_data",
		method: "POST",
		data: { kode_kabupaten: kode_kabupaten },
		success: function (data) {
			let resp = JSON.parse(data);
			if (resp != null) {
				$("#nama_kabupaten_ktp").val(resp.nama_kabupaten);

				//generate kab/kota
				gen_dropdown_kecamatan_ktp(kode_kabupaten);
			}
		},
	});
}

function gen_dropdown_kecamatan_ktp(kode_kabupaten) {
	$.ajax({
		url: url + "wilayah/gen_dropdown_kecamatan",
		method: "POST",
		data: { kode_kabupaten: kode_kabupaten },
		success: function (data) {
			$("#nama_kecamatan_ktp").val("");
			$("#kode_kelurahan_ktp").html("");
			$("#nama_kelurahan_ktp").val("");
			$("#kode_kecamatan_ktp").html(data);

			if ($("#is_check").is(":checked")) {
				//set default selected
				$("#kode_kecamatan_ktp")
					.val($("#kode_kecamatan").val())
					.trigger("change");
			}
		},
	});
}

function OnChangeKodeKecamatanKtp(kode_kecamatan) {
	$.ajax({
		url: url + "wilayah/get_kecamatan_data",
		method: "POST",
		data: { kode_kecamatan: kode_kecamatan },
		success: function (data) {
			let resp = JSON.parse(data);
			if (resp != null) {
				$("#nama_kecamatan_ktp").val(resp.nama_kecamatan);

				//generate kab/kota
				gen_dropdown_kelurahan_ktp(kode_kecamatan);
			}
		},
	});
}

function gen_dropdown_kelurahan_ktp(kode_kecamatan) {
	$.ajax({
		url: url + "wilayah/gen_dropdown_kelurahan",
		method: "POST",
		data: { kode_kecamatan: kode_kecamatan },
		success: function (data) {
			$("#nama_kelurahan_ktp").val("");
			$("#kode_kelurahan_ktp").html(data);

			if ($("#is_check").is(":checked")) {
				//set default selected
				$("#kode_kelurahan_ktp")
					.val($("#kode_kelurahan").val())
					.trigger("change");
			}
		},
	});
}

function OnChangeKodeKelurahanKtp(kode_kelurahan) {
	$.ajax({
		url: url + "wilayah/get_kelurahan_data",
		method: "POST",
		data: { kode_kelurahan: kode_kelurahan },
		success: function (data) {
			let resp = JSON.parse(data);
			if (resp != null) {
				$("#nama_kelurahan_ktp").val(resp.nama_kelurahan);

				if ($("#is_check").is(":checked")) {
					//set default selected
					$("#kode_provinsi_ktp")[0].removeAttribute("onchange");
					$("#kode_kabupaten_ktp")[0].removeAttribute("onchange");
					$("#kode_kecamatan_ktp")[0].removeAttribute("onchange");
					$("#kode_kelurahan_ktp")[0].removeAttribute("onchange");

					$("#kode_provinsi_ktp").prop("readonly", true);
					$("#kode_kabupaten_ktp").prop("readonly", true);
					$("#kode_kecamatan_ktp").prop("readonly", true);
					$("#kode_kelurahan_ktp").prop("readonly", true);
				}
			}
		},
	});
}

$("#mdlArsip_Pelatihan_id_master_pelatihan").change(function () {
	var id_master_pelatihan = this.value;
	if (this.value == 394) {
		$("#grpNamaPelatihanLainnya").show();
	} else {
		$("#grpNamaPelatihanLainnya").hide();
	}
});

$("#mdlArsip_Penghargaan_id_master_penghargaan").change(function () {
	var id_master_pelatihan = this.value;
	if (this.value == 112) {
		$("#grpNamaPenghargaanLainnya").show();
	} else {
		$("#grpNamaPenghargaanLainnya").hide();
	}
});
//onload
var x = $("#id_eselon").val();
const targetDiv = document.getElementById("grpseksi");
if (
	x === "23" ||
	x === "24" ||
	x === "25" ||
	x === "26" ||
	x === "27" ||
	x === "28"
) {
	targetDiv.style.display = "none";
} else {
	targetDiv.style.display = "block";
}
//onchange
$("#id_eselon").change(function () {
	var x = $("#id_eselon").val();
	var val_eselon = $("#id_eselon").val();
	var val_status_jabatan = $("#id_status_jabatan").val();
	var val_nama_jabatan = $("#id_jabatan").val();
	const targetDiv = document.getElementById("grpseksi");
	if (
		x === "23" ||
		x === "24" ||
		x === "25" ||
		x === "26" ||
		x === "27" ||
		x === "28"
	) {
		targetDiv.style.display = "none";
	} else {
		targetDiv.style.display = "block";
	}

	$.ajax({
		type: "POST",
		url: url + "dashboard_publik/nama_jabatan_new",
		data: {
			eselon: val_eselon,
			status_jabatan: val_status_jabatan,
			id_nama_jabatan: val_nama_jabatan,
		},
		success: function (data) {
			$("#id_jabatan").html(data).trigger("change");
		},
	});
});
