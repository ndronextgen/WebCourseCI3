var counterFrmJabatan = 1;
$(document).ready(async function(){
    mst_golongan = await getMstGolonganList();
    mst_status_jabatan = await getMstStatusJabatanList();
    mst_nama_jabatan = await getMstNamaJabatanList();
});

function addFrmJabatan(obj) { 
    var content = '<div class="form-group form-group-last row" id="frmJabatan">';
        content += '<div class="form-group row align-items-center">';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label>Status Jabatan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<select name="frmJabatan_id_riwayat_status_jabatan[]" id="frmJabatan_id_riwayat_status_jabatan_'+counterFrmJabatan+'" data-placeholder="Status Jabatan" class="form-control" onchange="frmJabatanChangeStatusJabatan(this.value,'+counterFrmJabatan+')">';
                            content += '<option value="">Pilih Status Jabatan</option>';
                            $.each(mst_status_jabatan, function (k,v) {
                                content += '<option value="'+v.id_status_jabatan+'">'+v.nama_status_jabatan+'</option>';
                            });
                        content += '</select>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">Nama Jabatan :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<select name="frmJabatan_id_r_jabatan[]" id="frmJabatan_id_r_jabatan_'+counterFrmJabatan+'" data-placeholder="Jabatan" class="form-control">';
                            content += '<option value="">Pilih Nama Jabatan</option>';
                        content += '</select>';
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
                        content += '<input type="text" name="frmJabatan_lokasi[]" id="frmJabatan_lokasi" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<div class="kt-form__group--inline">';
                    content += '<div class="kt-form__label">';
                        content += '<label class="kt-label m-label--single">TMT :</label>';
                    content += '</div>';
                    content += '<div class="kt-form__control">';
                        content += '<input type="text" class="form-control datepicker" name="frmJabatan_tmt_mulai_jabatan[]" id="frmJabatan_tmt_mulai_jabatan_'+counterFrmJabatan+'" placeholder="dd-mm-yyyy" readonly>';
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
                        content += '<input type="text" name="frmJabatan_nomor_sk[]" id="frmJabatan_nomor_sk" class="form-control" />';
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
                        content += '<input type="text" class="form-control datepicker" name="frmJabatan_tgl_sk_jabatan[]" id="frmJabatan_tgl_sk_jabatan_'+counterFrmJabatan+'" placeholder="dd-mm-yyyy" readonly>';
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
                        content += '<input type="text" name="frmJabatan_title[]" id="frmJabatan_title" class="form-control" />';
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
                        content += '<input type="file" name="frmJabatan_file[]" id="frmJabatan_file" class="form-control" />';
                    content += '</div>';
                content += '</div>';
                content += '<div class="d-md-none kt-margin-b-10"></div>';
            content += '</div>';
            content += '<div class="col-md-3">';
                content += '<br />';
                content += '<a href="javascript:;" onclick="removeFrmJabatan(this);" class="btn-sm btn btn-label-danger btn-bold">';
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
    content += '$(\'#frmJabatan_tmt_mulai_jabatan_'+counterFrmJabatan+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '$(\'#frmJabatan_tgl_sk_jabatan_'+counterFrmJabatan+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '</script>';

    $(obj).parents().eq(1).before(content);
    
    counterFrmJabatan++;
    $('#counterFrmJabatan').val(counterFrmJabatan);
}

function removeFrmJabatan(obj) {
    $(obj).parents().eq(2).remove();
    $('#counterFrmJabatan').val(counterFrmJabatan);
}



function frmJabatanChangeStatusJabatan (val, counter){
    if(val != '')
    {
        $.ajax({
            url: url+"dashboard_publik/nama_jabatan",
            method:"POST",
            data:{id_status_jabatan:val},
            success:function(data)
            {
                $('#frmJabatan_id_r_jabatan_'+counter).html(data);
            }
        });
    }
    else
    {
        $('#frmJabatan_id_r_jabatan_'+counter).html('<option value="0">Pilih Nama Jabatan</option>');
    }
}