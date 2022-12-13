
var counterFrmTubel = 1;

$(document).ready(async function(){
    mst_pendidikan = await getMstPendidikanList();
});

function addFrmTubel(obj) { 
    var content = '<div class="form-group form-group-last row" id="frmTubel">'+
        '<div class="form-group row align-items-center">'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label>Nama Status :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<select name="frmTubel_uraian[]" id="frmTubel_uraian" data-placeholder="Pilih Nama Status" class="form-control">'+
                            '<option value="">-- Pilih Nama Status --</option>'+
                            '<option value="Tugas Belajar">Tugas Belajar</option>'+
                            '<option value="Izin Belajar">Izin Belajar</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3" id="grpNamaPenghargaanLainnya">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Nomor SK :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmTubel_no_sk[]" id="frmTubel_no_sk" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Tanggal SK :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" class="form-control datepicker" name="frmTubel_tgl_sk[]" id="frmTubel_tgl_sk_'+counterFrmTubel+'" placeholder="dd-mm-yyyy" readonly>'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Tanggal Mulai Pendidikan :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" class="form-control datepicker" name="frmTubel_tgl_mulai[]" id="frmTubel_tgl_mulai_'+counterFrmTubel+'" placeholder="dd-mm-yyyy" readonly>'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Tanggal Selesai Pendidikan :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" class="form-control datepicker" name="frmTubel_tgl_selesai[]" id="frmTubel_tgl_selesai_'+counterFrmTubel+'" placeholder="dd-mm-yyyy" readonly>'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Sekolah :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmTubel_sekolah[]" id="frmTubel_sekolah" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Akreditasi :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmTubel_akreditasi[]" id="frmTubel_akreditasi" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Jurusan :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmTubel_jurusan[]" id="frmTubel_jurusan" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Nama File :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmTubel_title[]" id="frmTubel_title" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Upload File :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="file" name="frmTubel_file[]" id="frmTubel_file" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<br />'+
                '<a href="javascript:;" onclick="removeFrmTubel(this);" class="btn-sm btn btn-label-danger btn-bold">'+
                    '<i class="la la-trash-o"></i>'+
                    'Hapus'+
                '</a>'+
            '</div>'+
            '<div class="col-md-12">'+
                '<br /><hr />'+
            '</div>'+
        '</div>'+
    '</div>';
    
    content += '<script>';
    content += '$(\'#frmTubel_tgl_sk_'+counterFrmTubel+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '$(\'#frmTubel_tgl_mulai_'+counterFrmTubel+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '$(\'#frmTubel_tgl_selesai_'+counterFrmTubel+'\').datepicker({';
        content += 'rtl: '+KTUtil.isRTL()+',';
        content += 'todayHighlight: true,';
        content += 'orientation: "bottom left",';
        content += 'templates: arrows,';
        content += 'format: "dd-mm-yyyy",';
        content += 'autoclose: true';
    content += '});';
    content += '</script>';

    $(obj).parents().eq(1).before(content);
    
    counterFrmTubel++;
    $('#counterFrmTubel').val(counterFrmTubel);
}

function removeFrmTubel(obj) {
    $(obj).parents().eq(2).remove();
    $('#counterFrmTubel').val(counterFrmTubel);
}
