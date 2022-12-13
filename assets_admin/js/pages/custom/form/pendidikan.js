
var counterFrmPendidikan = 1;

$(document).ready(async function(){
    mst_pendidikan = await getMstPendidikanList();
});

function addFrmPendidikan(obj) { 
    var content = '<div class="form-group form-group-last row" id="frmPendidikan">';
        content += '<div class="form-group row align-items-center">';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label>Tingkat Pendidikan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<select name="frmPendidikan_id_master_pendidikan[]" id="frmPendidikan_id_master_pendidikan" data-placeholder="Tingkat Pendidikan" class="form-control">';
                            content += '<option value="">Pilih Tingkat Pendidikan</option>';
                            $.each(mst_pendidikan, function(k,v) {
                                content += '<option value="'+v.nama_pendidikan+'">'+v.nama_pendidikan+'</option>';
                            });
                        content += '</select>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Jurusan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPendidikan_jurusan[]" id="frmPendidikan_jurusan" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Tempat Pendidikan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPendidikan_tempat_sekolah[]" id="frmPendidikan_tempat_sekolah" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Kota :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPendidikan_kota[]" id="frmPendidikan_kota" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Nomor Ijazah :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPendidikan_nomor_sttb[]" id="frmPendidikan_nomor_sttb" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Tanggal Lulus :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" class="form-control datepicker" name="frmPendidikan_tanggal_lulus[]" id="frmPendidikan_tanggal_lulus_'+counterFrmPendidikan+'" placeholder="dd-mm-yyyy" readonly>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Nama File :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPendidikan_title[]" id="frmPendidikan_title" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Upload File :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="file" name="frmPendidikan_file[]" id="frmPendidikan_file" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<br />';
                content += '<a href="javascript:;" onclick="removeFrmPendidikan(this);" class="btn-sm btn btn-label-danger btn-bold">';
                    content += '<i class="la la-trash-o"></i>';
                    content += 'Hapus';
                content += '</a>';
            content += '</div>';
            content += '<div class="col-md-12">';
                content += '<br /><hr />';
            content += '</div>';
        content += '</div>';
    content += '</div>';
    
    content += '<script>';
    content += '$(\'#frmPendidikan_tanggal_lulus_'+counterFrmPendidikan+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '</script>';

    $(obj).parents().eq(1).before(content);
    
    counterFrmPendidikan++;
    $('#counterFrmPendidikan').val(counterFrmPendidikan);
}

function removeFrmPendidikan(obj) {
    $(obj).parents().eq(2).remove();
    $('#counterFrmPendidikan').val(counterFrmPendidikan);
}
