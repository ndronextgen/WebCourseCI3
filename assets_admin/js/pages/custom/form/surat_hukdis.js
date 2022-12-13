var url = getCookie('url');

var KTSelect2 = function() {
    var Select2 = function() {
        $('#id_tipe_surat_hukdis').select2({
            placeholder: "Pilih Tipe Surat"
        });
    }
    
    // Public functions
    return {
        init: function() {
            Select2();
		}
	};
}();

var KTSweetAlert = function() {
    var initBtn = function() {
        //save
        $('#btnSave').click(async function() {
            var param = {
                id_pegawai: $('#id_pegawai').val(),
                id_surat_hukdis: $('#id_surat_hukdis').val(),
                id_tipe_surat_hukdis: $('#id_tipe_surat_hukdis').val(),
                penutup: $('#penutup').val()
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: url+'admin/surat_hukdis/simpan',
                data: param,
                dataType: 'json',
                method: 'POST',
                success: function(resp) {
                    if (resp.status == true) {
                            swal.fire({
                            type: 'success',
                            title: 'Berhasil disimpan!',
                            showConfirmButton: false,
                            timer: 1500 
                        });
                        setTimeout(function() {
                            let frm = $('#formSuratHukdis');
                            frm.attr('action', url+'admin/surat_hukdis/detail');
                            frm.attr('method', 'post');

                            frm.submit();
                        }, 1000);
                    }
                    else {
                        swal.fire({
                            type: 'error',
                            title: 'Gagal Simpan!',
                            text: resp.message,
                            showConfirmButton: false,
                            timer: 1500 
                        });
                    }
                }
            });
        
        });
    };
  
    return {
        // Init
        init: function() {
            initBtn();
        }
    };
}();

jQuery(document).ready( async function() {
    if ($('#id_surat_hukdis').val() != 0) {
        let surat = await getSuratHukdis($('#id_surat_hukdis').val());
        $('#penutup').val(surat.penutup);
    }

    KTSelect2.init();
    KTSweetAlert.init();
});

function getSuratHukdis(id) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/surat_hukdis/detail',
            data: {id_surat:id},
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

function backSuratHukdis(act) {
    let action = '';
    if (act == 'edit') {
        action = '/detail';
    }
    
    let frm = $('#formSuratHukdis');
    frm.attr('action', url+'admin/surat_hukdis'+action);
    frm.attr('method', 'post');
    frm.submit();
}
