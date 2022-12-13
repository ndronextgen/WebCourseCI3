var counterFrmPelatihan = 1;
$(document).ready(async function(){
    mst_pelatihan = await getMstPelatihanList();
});

function addFrmPelatihan(obj) { 
    var content = '<div class="form-group form-group-last row" id="frmPelatihan">';
        content += '<div class="form-group row align-items-center">';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label>Nama Pelatihan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<select name="frmPelatihan_id_master_pelatihan[]" id="frmPelatihan_id_master_pelatihan" data-placeholder="Nama Pelatihan" class="form-control" onchange="frmPelatihanChangeIdMasterPelatihan (this.value, '+counterFrmPelatihan+')">';
                            content += '<option value="">Pilih Nama Pelatihan</option>';
                            $.each(mst_pelatihan, function(k,v) {
                                content += '<option value="'+v.id_master_pelatihan+'">'+v.nama_pelatihan+'</option>';
                            });
                        content += '</select>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3" id="grpNamaPelatihanLainnya_'+counterFrmPelatihan+'" style="display:none;">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Nama Pelatihan Lainnya :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPelatihan_nama_pelatihan_lainnya[]" id="frmPelatihan_nama_pelatihan_lainnya" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Lokasi :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPelatihan_lokasi[]" id="frmPelatihan_lokasi" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Nomor Sertifikat :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPelatihan_no_sertifikat[]" id="frmPelatihan_no_sertifikat" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Tanggal Sertifikat :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" class="form-control datepicker" name="frmPelatihan_tanggal_sertifikat[]" id="frmPelatihan_tanggal_sertifikat_'+counterFrmPelatihan+'" placeholder="dd-mm-yyyy" readonly>';
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
                        content += '<input type="text" name="frmPelatihan_kota[]" id="frmPelatihan_kota" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Keterangan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPelatihan_uraian[]" id="frmPelatihan_uraian" class="form-control" />';
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
                        content += '<input type="text" name="frmPelatihan_title[]" id="frmPelatihan_title" class="form-control" />';
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
                        content += '<input type="file" name="frmPelatihan_file[]" id="frmPelatihan_file" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<br />';
                content += '<a href="javascript:;" onclick="removeFrmPelatihan(this);" class="btn-sm btn btn-label-danger btn-bold">';
                    content += '<i class="la la-trash-o"></i>';
                    content += 'Hapus';
                content += '</a>';
            content += '</div>';
            content += '<div class="col-md-12">';
                content += '<br /><hr />';
            content += '</div>';
        content += '</div>';
    content += '</div>';
    
    content += '<script>'+
        '$(\'#frmPelatihan_tanggal_sertifikat_'+counterFrmPelatihan+'\').datepicker({'+
        'rtl: '+KTUtil.isRTL()+','+
        'todayHighlight: true,'+
        'orientation: "bottom left",'+
        'templates: arrows,'+
        'format: "dd-mm-yyyy",'+
        'autoclose: true'+
        '});'+
    '</script>';

    $(obj).parents().eq(1).before(content);
    
    counterFrmPelatihan++;
    $('#counterFrmPelatihan').val(counterFrmPelatihan);
}

function removeFrmPelatihan(obj) {
    $(obj).parents().eq(2).remove();
    $('#counterFrmPelatihan').val(counterFrmPelatihan);
}

function frmPelatihanChangeIdMasterPelatihan (val, counter){
    if(val == 394)
    {
        $('#grpNamaPelatihanLainnya_'+counter).show();
    }
    else
    {
        $('#grpNamaPelatihanLainnya_'+counter).hide();
    }
}