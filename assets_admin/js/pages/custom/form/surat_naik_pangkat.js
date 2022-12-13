var id_surat = $('#id_surat_naik_pangkat').val();
var url = getCookie('url');

//dual list box pegawai
var pegawai = $('#pegawai').bootstrapDualListbox({
    nonSelectedListLabel: 'Non-selected',
    selectedListLabel: 'Selected',
    preserveSelectionOnMove: 'moved',
    moveOnSelect: false,
    moveAllLabel: 'Move all',
    removeAllLabel: 'Remove all',
    moveALabel: 'Move',
    removeLabel: 'Remove'
});

$(function() {
    var customSettings = $('select[name="pegawai"]').bootstrapDualListbox('getContainer');
    customSettings.find('.moveall i').removeClass().addClass('fa fa-angle-double-right').next().remove();
    customSettings.find('.removeall i').removeClass().addClass('fa fa-angle-double-left').next().remove();
    customSettings.find('.move i').removeClass().addClass('fa fa-angle-right').next().remove();
    customSettings.find('.remove i').removeClass().addClass('fa fa-angle-left').next().remove();
});

//set action when pegawai change
$('#pegawai').change(function() {
    var ids_pegawai = $('#pegawai').val()
    $('#ids_pegawai').val(ids_pegawai); //set pegawai ids for hidden text
});

$('#btnAddSave').click(function() {
    let param = {
        ids_pegawai: $('#ids_pegawai').val(),
        keterangan: $('#keterangan').val()
    };
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        url: url+'admin/surat_naik_pangkat/formSimpan',
        data: param,
        dataType: 'json',
        method: 'POST',
        success: function(resp) {
            if (resp.status == true) {
                swal.fire({
                    type: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 1500 
                });

                setTimeout(function() {
                    let frm = $('#frmSuratNaikPangkat');
                    frm.attr('action', url+'admin/surat_naik_pangkat');
                    frm.attr('method', 'post');

                    frm.submit();
                }, 1000);
            }
            else {
                swal.fire({
                    type: 'error',
                    title: 'Gagal menyimpan!',
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
                let form = $('#frmSuratNaikPangkat');

                form.find('.alert').remove();
                alert.prependTo(form);
                KTUtil.animateClass(alert[0], 'fadeIn animated');
            }
        }
    });
});

function getSuratNaikPangkat(id) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/surat_naik_pangkat/detail',
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

function backSuratNaikPangkat(act='') {
    let frm = $('#frmSuratNaikPangkat');
    frm.attr('action', url+'admin/surat_naik_pangkat/'+act);
    frm.attr('method', 'post');
    frm.submit();
}
