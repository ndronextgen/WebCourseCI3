
var counterFrmPangkat = 1;

$(document).ready(async function(){
    mst_golongan = await getMstGolonganList();
    mst_nama_jabatan = await getMstNamaJabatanList();
    mst_status_jabatan = await getMstStatusJabatanList();
});

function addFrmPangkat(obj) { 
    var content = '<div class="form-group form-group-last row" id="frmPangkat">';
        content += '<div class="form-group row align-items-center">';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label>Golongan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<select name="frmPangkat_id_golongan[]" id="frmPangkat_id_golongan" data-placeholder="Golongan" class="form-control">';
                            content += '<option value="">Pilih Golongan</option>';
                            $.each(mst_golongan, function (k,v) {
                                content += '<option value="'+v.id_golongan+'">'+v.golongan+'</option>';
                            });
                        content += '</select>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Lokasi Kerja :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPangkat_lokasi_kerja[]" id="frmPangkat_lokasi_kerja" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Nomor SK :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPangkat_nomor_sk[]" id="frmPangkat_nomor_sk" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Tanggal SK :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" class="form-control datepicker" name="frmPangkat_tanggal_sk[]" id="frmPangkat_tanggal_sk_'+counterFrmPangkat+'" placeholder="dd-mm-yyyy" readonly>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Tanggal Mulai :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" class="form-control datepicker" name="frmPangkat_tanggal_mulai[]" id="frmPangkat_tanggal_mulai_'+counterFrmPangkat+'" placeholder="dd-mm-yyyy" readonly>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Upload Dokumen :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="file" name="frmPangkat_file[]" id="frmPangkat_file" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<br />';
                content += '<a href="javascript:;" onclick="removeFrmPangkat(this);" class="btn-sm btn btn-label-danger btn-bold">';
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
    content += '$(\'#frmPangkat_tanggal_sk_'+counterFrmPangkat+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '$(\'#frmPangkat_tanggal_mulai_'+counterFrmPangkat+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '</script>';

    $(obj).parents().eq(1).before(content);
    
    counterFrmPangkat++;
    $('#counterFrmPangkat').val(counterFrmPangkat);
}

function removeFrmPangkat(obj) {
    $(obj).parents().eq(2).remove();
    $('#counterFrmPangkat').val(counterFrmPangkat);
}
