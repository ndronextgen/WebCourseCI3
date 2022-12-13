
var counterFrmSkp = 1;

function addFrmSkp(obj) { 
    var content = '<div class="form-group form-group-last row" id="frmSkp">'+
        '<div class="form-group row align-items-center">'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Jenis Data :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<select name="frmSkp_uraian[]" id="frmSkp_uraian" data-placeholder="Pilih Jenis Data" class="form-control">'+
                            '<option value="">Pilih Jenis Data</option>'+
                            '<option value="SKP">SKP</option>'+
                            '<option value="DP3">DP3</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Tahun :</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_tahun[]" id="frmSkp_tahun" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Orientasi Pelayanan</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_orientasi[]" id="frmSkp_orientasi" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Integritas</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_integritas[]" id="frmSkp_integritas" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Komitmen</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_komitmen[]" id="frmSkp_komitmen" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Disiplin</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_disiplin[]" id="frmSkp_disiplin" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Kesetiaan</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_kesetiaan[]" id="frmSkp_kesetiaan" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Prestasi</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_prestasi[]" id="frmSkp_prestasi" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Tanggung Jawab</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_tanggung_jawab[]" id="frmSkp_tanggung_jawab" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Ketaatan</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_ketaatan[]" id="frmSkp_ketaatan" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Kejujuran</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_kejujuran[]" id="frmSkp_kejujuran" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Kerjasama</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_kerjasama[]" id="frmSkp_kerjasama" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Prakarsa</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_prakarsa[]" id="frmSkp_prakarsa" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Kepemimpinan</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_kepemimpinan[]" id="frmSkp_kepemimpinan" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Rata-rata</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_rata_rata[]" id="frmSkp_rata_rata" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Atasan Penilai</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_atasan[]" id="frmSkp_atasan" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="kt-form__group--inline">'+
                    '<div class="kt-form__label">'+
                        '<label class="kt-label m-label--single">Penilai</label>'+
                    '</div>'+
                    '<div class="kt-form__control">'+
                        '<input type="text" name="frmSkp_penilai[]" id="frmSkp_penilai" class="form-control" />'+
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
                        '<input type="text" name="frmSkp_title[]" id="frmSkp_title" class="form-control" />'+
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
                        '<input type="file" name="frmSkp_file[]" id="frmSkp_file" class="form-control" />'+
                    '</div>'+
                '</div>'+
                '<div class="d-md-none kt-margin-b-10"></div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<br />'+
                '<a href="javascript:;" onclick="removeFrmSkp(this);" class="btn-sm btn btn-label-danger btn-bold">'+
                    '<i class="la la-trash-o"></i>'+
                    'Hapus'+
                '</a>'+
            '</div>'+
            '<div class="col-md-12">'+
                '<br /><hr />'+
            '</div>'+
        '</div>'+
    '</div>';

    $(obj).parents().eq(1).before(content);
    
    counterFrmSkp++;
    $('#counterFrmSkp').val(counterFrmSkp);
}

function removeFrmSkp(obj) {
    $(obj).parents().eq(2).remove();
    $('#counterFrmSkp').val(counterFrmSkp);
}
