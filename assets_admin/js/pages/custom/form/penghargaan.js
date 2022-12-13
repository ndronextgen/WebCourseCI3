
var counterFrmPenghargaan = 1;

$(document).ready(async function(){
    mst_penghargaan = await getMstPenghargaanList();
});

function addFrmPenghargaan(obj) { 
    var content = '<div class="form-group form-group-last row" id="frmPenghargaan">';
        content += '<div class="form-group row align-items-center">';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label>Nama Penghargaan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<select name="frmPenghargaan_id_master_penghargaan[]" id="frmPenghargaan_id_master_penghargaan" data-placeholder="Nama Penghargaan" class="form-control" onchange="frmPenghargaanChangeIdMasterPenghargaan(this.value, '+counterFrmPenghargaan+')">';
                            content += '<option value="">Pilih Nama Pelatihan</option>';
                            $.each(mst_penghargaan, function(k,v) {
                                content += '<option value="'+v.id_master_penghargaan+'">'+v.nama_penghargaan+'</option>';
                            });
                        content += '</select>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3" id="grpNamaPenghargaanLainnya_'+counterFrmPenghargaan+'" style="display:none;">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Nama Penghargaan Lainnya :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPenghargaan_nama_penghargaan_lainnya[]" id="frmPenghargaan_nama_penghargaan_lainnya" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Pemberi Penghargaan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" name="frmPenghargaan_pemberi_penghargaan[]" id="frmPenghargaan_pemberi_penghargaan" class="form-control" />';
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
                        content += '<input type="text" name="frmPenghargaan_nomor_sk[]" id="frmPenghargaan_nomor_sk" class="form-control" />';
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
                        content += '<input type="text" class="form-control datepicker" name="frmPenghargaan_tgl_sk_penghargaan[]" id="frmPenghargaan_tgl_sk_penghargaan_'+counterFrmPenghargaan+'" placeholder="dd-mm-yyyy" readonly>';
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
                        content += '<input type="text" name="frmPenghargaan_title[]" id="frmPenghargaan_title" class="form-control" />';
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
                        content += '<input type="file" name="frmPenghargaan_file[]" id="frmPenghargaan_file" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<br />';
                content += '<a href="javascript:;" onclick="removeFrmPenghargaan(this);" class="btn-sm btn btn-label-danger btn-bold">';
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
    content += '$(\'#frmPenghargaan_tgl_sk_penghargaan_'+counterFrmPenghargaan+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '</script>';

    $(obj).parents().eq(1).before(content);
    
    counterFrmPenghargaan++;
    $('#counterFrmPenghargaan').val(counterFrmPenghargaan);
}

function removeFrmPenghargaan(obj) {
    $(obj).parents().eq(2).remove();
    $('#counterFrmPenghargaan').val(counterFrmPenghargaan);
}

function frmPenghargaanChangeIdMasterPenghargaan(val, counter){
    if(val == 112)
    {
        $('#grpNamaPenghargaanLainnya_'+counter).show();
    }
    else
    {
        $('#grpNamaPenghargaanLainnya_'+counter).hide();
    }
}