function lihat_file(content,id)
{
    var title = 'Title';
    var url = getCookie('url');
    var urlAjax = url;
    var urlFile = url;
    switch(content) {
        case 'Keluarga':
            title = 'Data Keluarga';
            urlAjax += 'arsip_pribadi/pribadi_lihat/'+id;
            break;
        case 'Pangkat':
            title = 'Data Pangkat';
            urlAjax += 'arsip_sk/sk_lihat/'+id;
            break;
        case 'Jabatan':
            title = 'Data Jabatan';
            urlAjax += 'arsip_sk/sk_lihat/'+id;
            break;
        case 'Pendidikan':
            title = 'Data Pendidikan';
            urlAjax += 'arsip_pendidikan/pendidikan_lihat/'+id;
            break;
        case 'Pelatihan':
            title = 'Data Pelatihan';
            urlAjax += 'arsip_pelatihan/pelatihan_lihat/'+id;
            break;
        case 'Penghargaan':
            title = 'Data Penghargaan';
            urlAjax += 'arsip_sk/sk_lihat/'+id;
            break;
        case 'Tubel':
            title = 'Data Tugas & Izin Belajar';
            urlAjax += 'arsip_sk/sk_lihat/'+id;
            break;
        case 'SKP':
            title = 'Data SKP / DP3';
            urlAjax += 'arsip_skp/skp_lihat/'+id;
            break;
        case 'Hukuman':
            title = 'Data Hukuman';
            urlAjax += 'arsip_hukuman/hukuman_lihat/'+id;
            break;
    }
    
    $.ajax({
        url : urlAjax,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#modalLihatFile').modal('show');
            $('#modalLihatFileTitle').html(title+' : '+data.title);
            $('#modalLihatFileBody').html('');
            
            if(data.file_name != null)
            {
                switch(content) {
                    case 'Keluarga':
                        urlFile += 'asset/upload/pribadi/pribadi_'+data.id_data_keluarga+'_'+data.id_arsip_pribadi+'/'+data.file_name;
                        break;
                    case 'Pangkat':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        break;
                    case 'Jabatan':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        break;
                    case 'Pendidikan':
                        urlFile += 'asset/upload/pendidikan/pendidikan_'+data.id_tipe_pendidikan+'_'+data.id_pendidikan+'_'+data.id_arsip_pendidikan+'/'+data.file_name;
                        break;
                    case 'Pelatihan':
                        urlFile += 'asset/upload/pelatihan/pelatihan_'+data.id_pelatihan+"_"+data.id_arsip_pelatihan+'/'+data.file_name;
                        break;
                    case 'Penghargaan':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        break;
                    case 'Tubel':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        break;
                    case 'SKP':
                        urlFile += 'asset/upload/SKP/SKP_'+data.id_dp3+'_'+data.id_arsip_skp+'/'+data.file_name;
                        break;
                    case 'Hukuman':
                        urlFile += 'asset/upload/Hukuman/Hukuman_'+data.id_hukuman+'_'+data.id_arsip_hukuman+'/'+data.file_name;
                        break;
                }
            
                $('#modalLihatFileBody').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="400px"></iframe>');
            }
            else
            {
                $('#modalLihatFileBody').html('(No File)');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function download_file(content,id) {
    var title = 'Title';
    var url = getCookie('url');
    var urlAjax = url
    switch(content) {
        case 'Keluarga':
            title = 'Data Keluarga';
            urlAjax += 'arsip_pribadi/download_file/'+id;
            break;
        case 'PribadiLainnya':
            title = 'Data Pribadilainnya';
            urlAjax += 'arsip_pribadi/download_file/'+id;
            break;
        case 'Pangkat':
            title = 'Data Pangkat';
            urlAjax += 'arsip_sk/download_file/'+id;
            break;
        case 'Jabatan':
            title = 'Data Jabatan';
            urlAjax += 'arsip_sk/download_file/'+id;
            break;
        case 'SkLainnya':
            title = 'Data SkLainnya';
            urlAjax += 'arsip_sk/download_file/'+id;
            break;
        case 'Pendidikan':
            title = 'Data Pendidikan';
            urlAjax += 'arsip_pendidikan/download_file/'+id;
            break;
        case 'Pelatihan':
            title = 'Data Pelatihan';
            urlAjax += 'arsip_pelatihan/download_file/'+id;
            break;
        case 'Penghargaan':
            title = 'Data Penghargaan';
            urlAjax += 'arsip_sk/download_file/'+id;
            break;
        case 'Tubel':
            title = 'Data Tugas & Izin Belajan';
            urlAjax += 'arsip_sk/download_file/'+id;
            break;
        case 'SKP':
            title = 'Data SKP / DP3';
            urlAjax += 'arsip_skp/download_file/'+id;
            break;
        case 'Hukuman':
            title = 'Data Hukuman';
            urlAjax += 'arsip_hukuman/download_file/'+id;
            break;
    }

    swal.fire({
        title: 'Downloading File',
        timer: 2000,
        onOpen: function() {
            window.location.href = urlAjax;
            swal.showLoading();
        }
    });
}

function delete_data(content,id)
{
    var urlAjax = url;
    var dataTableName = '';
    switch(content) {
        case 'Keluarga':
            urlAjax += 'keluarga/keluarga_delete/'+id;
            dataTableName = tblKeluarga;
            break;
        case 'Pangkat':
            urlAjax += 'pangkat/pangkat_delete/'+id;
            dataTableName = tblPangkat;
            break;
        case 'Jabatan':
            urlAjax += 'jabatan/jabatan_delete/'+id;
            dataTableName = tblJabatan;
            break;
        case 'Pendidikan':
            urlAjax += 'pendidikan/pendidikan_delete/'+id;
            dataTableName = tblPendidikan;
            break;
        case 'Pelatihan':
            urlAjax += 'pelatihan/pelatihan_delete/'+id;
            dataTableName = tblPelatihan;
            break;
        case 'Penghargaan':
            urlAjax += 'penghargaan/penghargaan_delete/'+id;
            dataTableName = tblPenghargaan;
            break;
        case 'Tubel':
            urlAjax += 'tubel/tubel_delete/'+id;
            dataTableName = tblTubel;
            break;
        case 'SKP':
            urlAjax += 'skp/skp_delete/'+id;
            dataTableName = tblSKP;
            break;
        case 'Hukuman':
            urlAjax += 'hukuman/hukuman_delete/'+id;
            dataTableName = tblHukuman;
            break;
    }
    
    $.ajax({
        url : urlAjax,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if (data.status == true) {
                //reload datatable
                dataTableName.reload();
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error hapus data from ajax');
        }
    });
}

function delete_file(content,id,id_arsip)
{
    var urlAjax = url;
    var dataTableName = '';
    switch(content) {
        case 'Keluarga':
            urlAjax += 'keluarga/keluarga_delete_arsip/'+id+'/'+id_arsip;
            dataTableName = tblKeluarga;
            break;
        case 'Pangkat':
            urlAjax += 'pangkat/pangkat_delete_arsip/'+id+'/'+id_arsip;
            dataTableName = tblPangkat;
            break;
        case 'Jabatan':
            urlAjax += 'jabatan/jabatan_delete_arsip/'+id+'/'+id_arsip;
            dataTableName = tblJabatan;
            break;
        case 'Pendidikan':
            urlAjax += 'pendidikan/pendidikan_delete_arsip/'+id+'/'+id_arsip;
            dataTableName = tblPendidikan;
            break;
        case 'Pelatihan':
            urlAjax += 'pelatihan/pelatihan_delete/'+id;
            dataTableName = tblPelatihan;
            break;
        case 'Penghargaan':
            urlAjax += 'penghargaan/penghargaan_delete/'+id;
            dataTableName = tblPenghargaan;
            break;
        case 'Tubel':
            urlAjax += 'tubel/tubel_delete/'+id;
            dataTableName = tblTubel;
            break;
        case 'SKP':
            urlAjax += 'skp/skp_delete/'+id;
            dataTableName = tblSKP;
            break;
        case 'Hukuman':
            urlAjax += 'hukuman/hukuman_delete/'+id;
            dataTableName = tblSKP;
            break;
    }
    
    $.ajax({
        url : urlAjax,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if (data.status == true) {
                //reload datatable
                dataTableName.reload();
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error hapus data from ajax');
        }
    });
}

function add_arsip(content)
{
    var title = 'Title';
    var modalName = '';
    var formName = '';

    switch(content) {
        case 'Keluarga':
            title = 'Data Keluarga';
            modalName = 'modalAddKeluarga';
            formName = 'mdlArsip_Keluarga_frm';
            $('#mdlArsip_Keluarga_id').val('0');
            $('#divMdlArsip_Keluarga_lampiran').hide();
            $('#mdlArsip_Keluarga_lampiran').html('');
        break;
        case 'Pangkat':
            title = 'Data Pangkat';
            modalName = 'modalAddPangkat';
            formName = 'mdlArsip_Pangkat_frm';
            $('#mdlArsip_Pangkat_id').val('0');
            $('#divMdlArsip_Pangkat_lampiran').hide();
            $('#mdlArsip_Pangkat_lampiran').html('');
        break;
        case 'Jabatan':
            title = 'Data Jabatan';
            modalName = 'modalAddJabatan';
            formName = 'mdlArsip_Jabatan_frm';
            $('#mdlArsip_Jabatan_id').val('0');
            $('#divMdlArsip_Jabatan_lampiran').hide();
            $('#mdlArsip_Jabatan_lampiran').html('');
        break;
        case 'Pendidikan':
            title = 'Data Pendidikan';
            modalName = 'modalAddPendidikan';
            formName = 'mdlArsip_Pendidikan_frm';
            $('#mdlArsip_Pendidikan_id').val('0');
            $('#divMdlArsip_Pendidikan_lampiran').hide();
            $('#mdlArsip_Pendidikan_lampiran').html('');
        break;
        case 'Pelatihan':
            title = 'Data Pelatihan';
            modalName = 'modalAddPelatihan';
            formName = 'mdlArsip_Pelatihan_frm';
            $('#mdlArsip_Pelatihan_id').val('0');
            $('#divMdlArsip_Pelatihan_lampiran').hide();
            $('#mdlArsip_Pelatihan_lampiran').html('');
        break;
        case 'Penghargaan':
            title = 'Data Penghargaan';
            modalName = 'modalAddPenghargaan';
            formName = 'mdlArsip_Penghargaan_frm';
            $('#mdlArsip_Penghargaan_id').val('0');
            $('#divMdlArsip_Penghargaan_lampiran').hide();
            $('#mdlArsip_Penghargaan_lampiran').html('');
        break;
        case 'Tubel':
            title = 'Data Tugas & Izin Belajar';
            modalName = 'modalAddTubel';
            formName = 'mdlArsip_Tubel_frm';
            $('#mdlArsip_Tubel_id').val('0');
            $('#divMdlArsip_Tubel_lampiran').hide();
            $('#mdlArsip_Tubel_lampiran').html('');
        break;
        case 'SKP':
            title = 'Data SKP / DP3';
            modalName = 'modalAddSKP';
            formName = 'mdlArsip_SKP_frm';
            $('#mdlArsip_SKP_id').val('0');
            $('#divMdlArsip_SKP_lampiran').hide();
            $('#mdlArsip_SKP_lampiran').html('');
        break;
        case 'Hukuman':
            title = 'Data Hukuman';
            modalName = 'modalAddHukuman';
            formName = 'mdlArsip_Hukuman_frm';
            $('#mdlArsip_Hukuman_id').val('0');
            $('#divMdlArsip_Hukuman_lampiran').hide();
            $('#mdlArsip_Hukuman_lampiran').html('');
        break;
    }

    $('#'+formName).trigger("reset");
    $('#'+modalName).modal('show');
    $('#'+modalName+'Title').html('Tambah ' + title);
}

function detail_data(content,id)
{
    var title = 'Title';
    var url = getCookie('url');
    var urlAjax = url;
    var urlFile = url;
    var mdlName = 'modalDetail';
    switch(content) {
        case 'Keluarga':
            title = 'Lihat Data Keluarga';
            urlAjax += 'keluarga/keluarga_detail/'+id;
            break;
        case 'Pangkat':
            title = 'Lihat Data Pangkat';
            urlAjax += 'pangkat/pangkat_detail/'+id;
            break;
        case 'Jabatan':
            title = 'Lihat Data Jabatan';
            urlAjax += 'jabatan/jabatan_detail/'+id;
            break;
        case 'Pendidikan':
            title = 'Lihat Data Pendidikan';
            urlAjax += 'pendidikan/pendidikan_detail/'+id;
            break;
        case 'Pelatihan':
            title = 'Lihat Data Pelatihan';
            urlAjax += 'pelatihan/pelatihan_detail/'+id;
            break;
        case 'Penghargaan':
            title = 'Lihat Data Penghargaan';
            urlAjax += 'penghargaan/penghargaan_detail/'+id;
            break;
        case 'Tubel':
            title = 'Lihat Data Tugas & Izin Belajar';
            urlAjax += 'tubel/tubel_detail/'+id;
            break;
        case 'SKP':
            title = 'Lihat Data SKP / DP3';
            urlAjax += 'skp/skp_detail/'+id;
            break;
        case 'Hukuman':
            title = 'Lihat Data Hukuman';
            urlAjax += 'hukuman/hukuman_detail/'+id;
            break;
    }
    
    $.ajax({
        url : urlAjax,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
            $('#'+mdlName).modal('show');
            $('#'+mdlName+'Title').html(title);
            $('#'+mdlName+'Body').html('');
            
            if(data != null)
            {
                let text = '';
                switch(content) {
                    case 'Keluarga':
                        urlFile += 'asset/upload/pribadi/pribadi_'+data.id_data_keluarga+'_'+data.id_arsip_pribadi+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nama Anggota Keluarga</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nama_anggota_keluarga}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Hubungan Keluarga</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.hub_keluarga}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Jenis Kelamin</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.jenis_kelamin}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Lahir</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tanggal_lahir_keluarga}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Keterangan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" disabled="disabled">${data.uraian}</textarea>
                                </div>
                            </div>`;
                        
                            if (data.file_name_ori != null) {
                                text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                            `;
                            }
                            else {
                                text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                            }
                        break;
                    case 'Pangkat':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Golongan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.golongan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Lokasi Kerja</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.lokasi_kerja}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nomor_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tanggal_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">TMT</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" disabled="disabled">${data.tanggal_mulai}</textarea>
                                </div>
                            </div>`;
                        
                            if (data.file_name_ori != null) {
                                text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                            `;
                            }
                            else {
                                text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                            }
                        break;
                    case 'Jabatan':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Status Jabatan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nama_status_jabatan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nama Jabatan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nama_jabatan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Lokasi Kerja</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.lokasi}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">TMT</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tmt_mulai_jabatan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                                <div class="col-md-8">
                                <input type="text" class="form-control" disabled="disabled" value="${data.nomor_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                                <div class="col-md-8">
                                <input type="text" class="form-control" disabled="disabled" value="${data.tgl_sk_jabatan}" />
                                </div>
                            </div>
                            <br /><br />`;
                        
                        if (data.file_name_ori != null) {
                            text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                        `;
                        }
                        else {
                            text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                        }
                        break;
                    case 'Pendidikan':
                        urlFile += 'asset/upload/pendidikan/pendidikan_'+data.id_tipe_pendidikan+'_'+data.id_pendidikan+'_'+data.id_arsip_pendidikan+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tingkat Pendidikan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nama_pendidikan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Jurusan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.jurusan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tempat Pendidikan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tempat_sekolah}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Kota</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.kota}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nomor Ijazah</label>
                                <div class="col-md-8">
                                <input type="text" class="form-control" disabled="disabled" value="${data.nomor_sttb}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Lulus</label>
                                <div class="col-md-8">
                                <input type="text" class="form-control" disabled="disabled" value="${data.tanggal_lulus}" />
                                </div>
                            </div>
                            <br /><br />`;
                        
                        if (data.file_name_ori != null) {
                            text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                        `;
                        }
                        else {
                            text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                        }
                        break;
                    case 'Pelatihan':
                        urlFile += 'asset/upload/pelatihan/pelatihan_'+data.id_pelatihan+"_"+data.id_arsip_pelatihan+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nama Pelatihan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nama_pelatihan}" />
                                </div>
                            </div>`;

                            if (data.id_pelatihan == 90) {
                                text += `
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label kt-font-bolder">Nama Pelatihan Lainnya</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" disabled="disabled" value="${data.nama_pelatihan_lainnya}" />
                                    </div>
                                </div>`;
                            }
                            
                            text += `<div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.lokasi}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nomor Sertifikat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.no_sertifikat}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Sertifikat</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tanggal_sertifikat}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Keterangan</label>
                                <div class="col-md-8">
                                <input type="text" class="form-control" disabled="disabled" value="${data.uraian}" />
                                </div>
                            </div>
                            <br /><br />`;
                        
                        if (data.file_name_ori != null) {
                            text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                        `;
                        }
                        else {
                            text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                        }
                        break;
                    case 'Penghargaan':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nama Penghargaan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nama_penghargaan}" />
                                </div>
                            </div>`;

                            if (data.id_penghargaan == 112) {
                                text += `
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label kt-font-bolder">Nama Penghargaan Lainnya</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" disabled="disabled" value="${data.nama_penghargaan_lainnya}" />
                                    </div>
                                </div>`;
                            }
                            
                            text += `<div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Pemberi Penghargaan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.pemberi_penghargaan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nomor_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tgl_sk_penghargaan}" />
                                </div>
                            </div>
                            <br /><br />`;
                        
                        if (data.file_name_ori != null) {
                            text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                        `;
                        }
                        else {
                            text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                        }
                        break;
                    case 'Tubel':
                        urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nama Status</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.uraian}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.no_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tgl_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Mulai Pendidikan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tgl_mulai}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Selesai Pendidikan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tgl_selesai}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Sekolah</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.sekolah}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Akreditasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.akreditasi}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Jurusan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.jurusan}" />
                                </div>
                            </div>
                            <br /><br />`;
                        
                        if (data.file_name_ori != null) {
                            text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                        `;
                        }
                        else {
                            text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                        }
                        break;
                    case 'SKP':
                        urlFile += 'asset/upload/SKP/SKP_'+data.id_dp3+'_'+data.id_arsip_skp+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Jenis Data</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.uraian}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tahun</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tahun}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Orientasi Pelayanan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.orientasi}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Integritas</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.integritas}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Komitmen</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.komitmen}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Disiplin</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.disiplin}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Kesetiaan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.kesetiaan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Prestasi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.prestasi}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggung Jawab</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tanggung_jawab}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Ketaatan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.ketaatan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Kejujuran</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.kejujuran}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Kerjasama</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.kerjasama}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Prakarsa</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.prakarsa}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Kepemimpinan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.kepemimpinan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Rata-rata</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.rata_rata}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Atasan Penilai</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.atasan}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Penilai</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.penilai}" />
                                </div>
                            </div>
                            <br /><br />`;
                        
                        if (data.file_name_ori != null) {
                            text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                        `;
                        }
                        else {
                            text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                        }
                        break;
                    case 'Hukuman':
                        urlFile += 'asset/upload/Hukuman/Hukuman_'+data.id_hukuman+'_'+data.id_arsip_hukuman+'/'+data.file_name;
                        text = `
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Jenis Hukuman</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.jenis_hukuman}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Uraian</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.uraian}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Nomor SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.nomor_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal SK</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tanggal_sk}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Masa Berlaku</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.masa_berlaku}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Mulai</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tanggal_mulai}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label kt-font-bolder">Tanggal Selesai</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="disabled" value="${data.tanggal_selesai}" />
                                </div>
                            </div>
                            <br /><br />`;
                        
                        if (data.file_name_ori != null) {
                            text += `<h3 class="kt-section__title">Dokumen : ${data.file_name_ori}</h3>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <iframe src="${urlFile}" frameborder="no" width="100%" height="400px"></iframe>
                        `;
                        }
                        else {
                            text += `<h3 class="kt-section__title">Dokumen : (kosong)</h3>`;
                        }
                        break;
                }

                $('#'+mdlName+'Body').html(text);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

async function edit_data(content, id)
{
    var title = 'Title';
    var modalName = '';
    var formName = '';
    var urlAjax = url;
    var urlFile = url;

    switch(content) {
        case 'Keluarga':
            title = 'Data Keluarga';
            modalName = 'modalAddKeluarga';
            formName = 'mdlArsip_Keluarga_frm';
            $('#mdlArsip_Keluarga_id').val(id);
            urlAjax += 'keluarga/keluarga_detail/'+id;
            break;
        case 'Pangkat':
            title = 'Data Pangkat';
            modalName = 'modalAddPangkat';
            formName = 'mdlArsip_Pangkat_frm';
            $('#mdlArsip_Pangkat_id').val(id);
            urlAjax += 'pangkat/pangkat_detail/'+id;
            break;
        case 'Jabatan':
            title = 'Data Jabatan';
            modalName = 'modalAddJabatan';
            formName = 'mdlArsip_Jabatan_frm';
            $('#mdlArsip_Jabatan_id').val(id);
            urlAjax += 'jabatan/jabatan_detail/'+id;
            break;
        case 'Pendidikan':
            title = 'Data Pendidikan';
            modalName = 'modalAddPendidikan';
            formName = 'mdlArsip_Pendidikan_frm';
            $('#mdlArsip_Pendidikan_id').val(id);
            urlAjax += 'pendidikan/pendidikan_detail/'+id;
            break;
        case 'Pelatihan':
            title = 'Data Pelatihan';
            modalName = 'modalAddPelatihan';
            formName = 'mdlArsip_Pelatihan_frm';
            $('#mdlArsip_Pelatihan_id').val(id);
            urlAjax += 'pelatihan/pelatihan_detail/'+id;
            break;
        case 'Penghargaan':
            title = 'Data Penghargaan';
            modalName = 'modalAddPenghargaan';
            formName = 'mdlArsip_Penghargaan_frm';
            $('#mdlArsip_Penghargaan_id').val(id);
            urlAjax += 'penghargaan/penghargaan_detail/'+id;
            break;
        case 'Tubel':
            title = 'Data Tugas & Izin Belajar';
            modalName = 'modalAddTubel';
            formName = 'mdlArsip_Tubel_frm';
            $('#mdlArsip_Tubel_id').val(id);
            urlAjax += 'tubel/tubel_detail/'+id;
            break;
        case 'SKP':
            title = 'Data SKP / DP3';
            modalName = 'modalAddSKP';
            formName = 'mdlArsip_SKP_frm';
            $('#mdlArsip_SKP_id').val(id);
            urlAjax += 'skp/skp_detail/'+id;
            break;
        case 'Hukuman':
            title = 'Data Hukuman';
            modalName = 'modalAddHukuman';
            formName = 'mdlArsip_Hukuman_frm';
            $('#mdlArsip_Hukuman_id').val(id);
            urlAjax += 'hukuman/hukuman_detail/'+id;
            break;
    }

    $('#'+formName).trigger("reset");
    $('#'+modalName).modal('show');
    $('#'+modalName+'Title').html('Ubah ' + title);

    // get data arsip
    var data = await getDataArsip(urlAjax);
    console.log(data);
    if (data != null) {
        switch(content) {
            case 'Keluarga':
                // set default value form
                $('#mdlArsip_Keluarga_id').val(data.id_data_keluarga);
                $('#mdlArsip_Keluarga_id_arsip').val(data.id_arsip_pribadi);
                $('#mdlArsip_Keluarga_id_pegawai').val(data.id_pegawai);
                $('#mdlArsip_Keluarga_nama_anggota_keluarga').val(data.nama_anggota_keluarga);
                $('#mdlArsip_Keluarga_hub_keluarga').val(data.hub_keluarga);
                $('#mdlArsip_Keluarga_jenis_kelamin').val(data.jenis_kelamin);
                $('#mdlArsip_Keluarga_tanggal_lahir_keluarga').val(data.tanggal_lahir_keluarga);
                $('#mdlArsip_Keluarga_uraian').val(data.uraian);
                $('#mdlArsip_Keluarga_title').val(data.title);
                $('#divMdlArsip_Keluarga_lampiran').hide();
                $('#mdlArsip_Keluarga_lampiran').html('');

                if (data.file_name != null) {
                    urlFile += 'asset/upload/pribadi/pribadi_'+data.id_data_keluarga+'_'+data.id_arsip_pribadi+'/'+data.file_name;
                    $('#divMdlArsip_Keluarga_lampiran').show();
                    $('#mdlArsip_Keluarga_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'Pangkat':
                // set default value form
                $('#mdlArsip_Pangkat_id').val(data.id_riwayat_pangkat);
                $('#mdlArsip_Pangkat_id_arsip').val(data.id_arsip_sk);
                $('#mdlArsip_Pangkat_id_golongan').val(data.id_golongan);
                $('#mdlArsip_Pangkat_lokasi_kerja').val(data.lokasi_kerja);
                $('#mdlArsip_Pangkat_nomor_sk').val(data.nomor_sk);
                $('#mdlArsip_Pangkat_tanggal_sk').val(data.tanggal_sk);
                $('#mdlArsip_Pangkat_tanggal_mulai').val(data.tanggal_mulai);
                $('#divMdlArsip_Pangkat_lampiran').hide();
                $('#mdlArsip_Pangkat_lampiran').html('');
                
                if (data.file_name != null) {
                    urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                    $('#divMdlArsip_Pangkat_lampiran').show();
                    $('#mdlArsip_Pangkat_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'Jabatan':
                // set default value form
                $('#mdlArsip_Jabatan_id').val(data.id_riwayat_jabatan);
                $('#mdlArsip_Jabatan_id_arsip').val(data.id_arsip_sk);
                $('#mdlArsip_Jabatan_id_riwayat_status_jabatan').val(data.id_riwayat_status_jabatan);
                $('#mdlArsip_Jabatan_id_r_jabatan').val(data.id_r_jabatan);
                $('#mdlArsip_Jabatan_nama_jabatan').val(data.nama_jabatan);
                $('#mdlArsip_Jabatan_lokasi').val(data.lokasi);
                $('#mdlArsip_Jabatan_tmt_mulai_jabatan').val(data.tmt_mulai_jabatan);
                $('#mdlArsip_Jabatan_nomor_sk').val(data.nomor_sk);
                $('#mdlArsip_Jabatan_tgl_sk_jabatan').val(data.tgl_sk_jabatan);
                $('#mdlArsip_Jabatan_title').val(data.title);
                $('#divMdlArsip_Jabatan_lampiran').hide();
                $('#mdlArsip_Jabatan_lampiran').html('');

                if (parseInt(data.id_riwayat_status_jabatan) == 10) {
                    $('#mdlArsip_Jabatan_id_r_jabatan').hide();
                    $('#mdlArsip_Jabatan_nama_jabatan').show();
                }
                else {
                    $('#mdlArsip_Jabatan_id_r_jabatan').show();
                    $('#mdlArsip_Jabatan_nama_jabatan').hide();
                }

                if (data.file_name != null) {
                    urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                    $('#divMdlArsip_Jabatan_lampiran').show();
                    $('#mdlArsip_Jabatan_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'Pendidikan':
                // set default value form
                $('#mdlArsip_Pendidikan_id').val(data.id_pendidikan);
                $('#mdlArsip_Pendidikan_id_arsip').val(data.id_arsip_pendidikan);
                $('#mdlArsip_Pendidikan_id_master_pendidikan').val(data.id_master_pendidikan);
                $('#mdlArsip_Pendidikan_jurusan').val(data.jurusan);
                $('#mdlArsip_Pendidikan_tempat_sekolah').val(data.tempat_sekolah);
                $('#mdlArsip_Pendidikan_kota').val(data.kota);
                $('#mdlArsip_Pendidikan_nomor_sttb').val(data.nomor_sttb);
                $('#mdlArsip_Pendidikan_tanggal_lulus').val(data.tanggal_lulus);
                $('#mdlArsip_Pendidikan_title').val(data.title);
                $('#divMdlArsip_Pendidikan_lampiran').hide();
                $('#mdlArsip_Pendidikan_lampiran').html('');

                if (data.file_name != null) {
                    urlFile += 'asset/upload/pendidikan/pendidikan_'+data.id_tipe_pendidikan+'_'+data.id_pendidikan+'_'+data.id_arsip_pendidikan+'/'+data.file_name;
                    $('#divMdlArsip_Pendidikan_lampiran').show();
                    $('#mdlArsip_Pendidikan_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'Pelatihan':
                // set default value form
                $('#mdlArsip_Pelatihan_id').val(data.id_pelatihan);
                $('#mdlArsip_Pelatihan_id_arsip').val(data.id_arsip_pelatihan);
                $('#mdlArsip_Pelatihan_id_master_pelatihan').val(data.id_master_pelatihan);
                $('#mdlArsip_Pelatihan_nama_pelatihan_lainnya').val(data.nama_pelatihan_lainnya);
                $('#mdlArsip_Pelatihan_lokasi').val(data.lokasi);
                $('#mdlArsip_Pelatihan_no_sertifikat').val(data.no_sertifikat);
                $('#mdlArsip_Pelatihan_tanggal_sertifikat').val(data.tanggal_sertifikat);
                $('#mdlArsip_Pelatihan_kota').val(data.kota);
                $('#mdlArsip_Pelatihan_uraian').val(data.uraian);
                $('#mdlArsip_Pelatihan_title').val(data.title);
                $('#divMdlArsip_Pelatihan_lampiran').hide();
                $('#mdlArsip_Pelatihan_lampiran').html('');

                if (parseInt($('#mdlArsip_Pelatihan_id_master_pelatihan').val()) == 394) {
                    $('#grpNamaPelatihanLainnya').show();
                }
                else {
                    $('#grpNamaPelatihanLainnya').hide();
                }

                if (data.file_name != null) {
                    urlFile += 'asset/upload/pelatihan/pelatihan_'+data.id_pelatihan+"_"+data.id_arsip_pelatihan+'/'+data.file_name;
                    $('#divMdlArsip_Pelatihan_lampiran').show();
                    $('#mdlArsip_Pelatihan_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'Penghargaan':
                // set default value form
                $('#mdlArsip_Penghargaan_id').val(data.id_penghargaan);
                $('#mdlArsip_Penghargaan_id_arsip').val(data.id_arsip_sk);
                $('#mdlArsip_Penghargaan_id_master_penghargaan').val(data.id_master_penghargaan);
                $('#mdlArsip_Penghargaan_nama_penghargaan_lainnya').val(data.nama_penghargaan_lainnya);
                $('#mdlArsip_Penghargaan_pemberi_penghargaan').val(data.pemberi_penghargaan);
                $('#mdlArsip_Penghargaan_nomor_sk').val(data.nomor_sk);
                $('#mdlArsip_Penghargaan_tgl_sk_penghargaan').val(data.tgl_sk_penghargaan);
                $('#mdlArsip_Penghargaan_title').val(data.title);
                $('#divMdlArsip_Penghargaan_lampiran').hide();
                $('#mdlArsip_Penghargaan_lampiran').html('');

                if (parseInt($('#mdlArsip_Pelatihan_id_master_penghargaan').val()) == 112) {
                    $('#grpNamaPenghargaanLainnya').show();
                }
                else {
                    $('#grpNamaPenghargaanLainnya').hide();
                }
                if (data.file_name != null) {
                    urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                    $('#divMdlArsip_Penghargaan_lampiran').show();
                    $('#mdlArsip_Penghargaan_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'Tubel':
                // set default value form
                $('#mdlArsip_Tubel_id').val(data.id_tubel);
                $('#mdlArsip_Tubel_id_arsip').val(data.id_arsip_sk);
                $('#mdlArsip_Tubel_uraian').val(data.uraian);
                $('#mdlArsip_Tubel_no_sk').val(data.no_sk);
                $('#mdlArsip_Tubel_tgl_sk').val(data.tgl_sk);
                $('#mdlArsip_Tubel_tgl_mulai').val(data.tgl_mulai);
                $('#mdlArsip_Tubel_tgl_selesai').val(data.tgl_selesai);
                $('#mdlArsip_Tubel_sekolah').val(data.sekolah);
                $('#mdlArsip_Tubel_akreditasi').val(data.akreditasi);
                $('#mdlArsip_Tubel_jurusan').val(data.jurusan);
                $('#mdlArsip_Tubel_title').val(data.title);
                $('#divMdlArsip_Tubel_lampiran').hide();
                $('#mdlArsip_Tubel_lampiran').html('');

                if (parseInt($('#mdlArsip_Pelatihan_id_master_penghargaan').val()) == 112) {
                    $('#grpNamaPenghargaanLainnya').show();
                }
                else {
                    $('#grpNamaPenghargaanLainnya').hide();
                }
                if (data.file_name != null) {
                    urlFile += 'asset/upload/SK/SK_'+data.id_jenis_sk+'_'+data.id_ref+'_'+data.id_arsip_sk+'/'+data.file_name;
                    $('#divMdlArsip_Tubel_lampiran').show();
                    $('#mdlArsip_Tubel_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'SKP':
                // set default value form
                $('#mdlArsip_SKP_id').val(data.id_dp3);
                $('#mdlArsip_SKP_id_arsip').val(data.id_arsip_skp);
                $('#mdlArsip_SKP_uraian').val(data.uraian);
                $('#mdlArsip_SKP_tahun').val(data.tahun);
                $('#mdlArsip_SKP_orientasi').val(data.orientasi);
                $('#mdlArsip_SKP_integritas').val(data.integritas);
                $('#mdlArsip_SKP_komitmen').val(data.komitmen);
                $('#mdlArsip_SKP_disiplin').val(data.disiplin);
                $('#mdlArsip_SKP_kesetiaan').val(data.kesetiaan);
                $('#mdlArsip_SKP_prestasi').val(data.prestasi);
                $('#mdlArsip_SKP_tanggung_jawab').val(data.tanggung_jawab);
                $('#mdlArsip_SKP_ketaatan').val(data.ketaatan);
                $('#mdlArsip_SKP_kejujuran').val(data.kejujuran);
                $('#mdlArsip_SKP_kerjasama').val(data.kerjasama);
                $('#mdlArsip_SKP_prakarsa').val(data.prakarsa);
                $('#mdlArsip_SKP_kepemimpinan').val(data.kepemimpinan);
                $('#mdlArsip_SKP_rata_rata').val(data.rata_rata);
                $('#mdlArsip_SKP_atasan').val(data.atasan);
                $('#mdlArsip_SKP_penilai').val(data.penilai);
                $('#mdlArsip_SKP_title').val(data.title);
                $('#divMdlArsip_SKP_lampiran').hide();
                $('#mdlArsip_SKP_lampiran').html('');
                if (data.file_name != null) {
                    urlFile += 'asset/upload/SKP/SKP_'+data.id_dp3+'_'+data.id_arsip_skp+'/'+data.file_name;
                    $('#divMdlArsip_SKP_lampiran').show();
                    $('#mdlArsip_SKP_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
            case 'Hukuman':
                // set default value form
                $('#mdlArsip_Hukuman_id').val(data.id_hukuman);
                $('#mdlArsip_Hukuman_id_arsip').val(data.id_arsip_hukuman);
                $('#mdlArsip_Hukuman_id_master_hukuman').val(data.id_master_hukuman);
                $('#mdlArsip_Hukuman_uraian').val(data.uraian);
                $('#mdlArsip_Hukuman_nomor_sk').val(data.nomor_sk);
                $('#mdlArsip_Hukuman_tanggal_sk').val(data.tanggal_sk);
                $('#mdlArsip_Hukuman_tanggal_mulai').val(data.tanggal_mulai);
                $('#mdlArsip_Hukuman_tanggal_selesai').val(data.tanggal_selesai);
                $('#mdlArsip_Hukuman_masa_berlaku').val(data.masa_berlaku);
                $('#mdlArsip_Hukuman_pejabat_menetapkan').val(data.pejabat_menetapkan);
                $('#mdlArsip_Hukuman_title').val(data.title);
                $('#divMdlArsip_Hukuman_lampiran').hide();
                $('#mdlArsip_Hukuman_lampiran').html('');

                if (data.file_name != null) {
                    urlFile += 'asset/upload/Hukuman/Hukuman_'+data.id_hukuman+"_"+data.id_arsip_hukuman+'/'+data.file_name;
                    $('#divMdlArsip_Hukuman_lampiran').show();
                    $('#mdlArsip_Hukuman_lampiran').html('<iframe src="'+urlFile+'" frameborder="no" width="100%" height="200px"></iframe>');
                }
                break;
        }
    }
}

function view_coordinate(lat,long) {
    $('#modalViewKoordinat').modal('show');
    genMapKoordinatPegawai('view',lat,long);
}

function add_coordinate() {
    $('#modalAddKoordinat').modal('show');
    genMapKoordinatPegawai('add');
}

function getDataArsip(url) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url,
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

$('#mdlArsip_Keluarga_btnSave').on('click', function() {
    $('#mdlArsip_Keluarga_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Keluarga_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Keluarga_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_keluarga/keluarga_edit';
    }
    else {
        urlAjax += 'admin/admin_keluarga/keluarga_add';
    }

    var form = $("#mdlArsip_Keluarga_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddKeluarga').modal('hide');
                tblKeluarga.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Keluarga_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Keluarga_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Keluarga_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Keluarga_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_Pangkat_btnSave').on('click', function() {
    $('#mdlArsip_Pangkat_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Pangkat_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Pangkat_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_pangkat/pangkat_edit';
    }
    else {
        urlAjax += 'admin/admin_pangkat/pangkat_add';
    }

    var form = $("#mdlArsip_Pangkat_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddPangkat').modal('hide');
                tblPangkat.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Pangkat_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Pangkat_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Pangkat_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Pangkat_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_Jabatan_btnSave').on('click', function() {
    $('#mdlArsip_Jabatan_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Jabatan_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Jabatan_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_jabatan/jabatan_edit';
    }
    else {
        urlAjax += 'admin/admin_jabatan/jabatan_add';
    }

    var form = $("#mdlArsip_Jabatan_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddJabatan').modal('hide');
                tblJabatan.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Jabatan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Jabatan_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Jabatan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Jabatan_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_Pendidikan_btnSave').on('click', function() {
    $('#mdlArsip_Pendidikan_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Pendidikan_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Pendidikan_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_pendidikan/pendidikan_edit';
    }
    else {
        urlAjax += 'admin/admin_pendidikan/pendidikan_add';
    }

    var form = $("#mdlArsip_Pendidikan_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddPendidikan').modal('hide');
                tblPendidikan.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Pendidikan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Pendidikan_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Pendidikan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Pendidikan_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_Pelatihan_btnSave').on('click', function() {
    $('#mdlArsip_Pelatihan_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Pelatihan_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Pelatihan_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_pelatihan/pelatihan_edit';
    }
    else {
        urlAjax += 'admin/admin_pelatihan/pelatihan_add';
    }

    var form = $("#mdlArsip_Pelatihan_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddPelatihan').modal('hide');
                tblPelatihan.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Pelatihan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Pelatihan_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Pelatihan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Pelatihan_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_Penghargaan_btnSave').on('click', function() {
    $('#mdlArsip_Penghargaan_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Penghargaan_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Penghargaan_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_penghargaan/penghargaan_edit';
    }
    else {
        urlAjax += 'admin/admin_penghargaan/penghargaan_add';
    }

    var form = $("#mdlArsip_Penghargaan_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddPenghargaan').modal('hide');
                tblPenghargaan.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Penghargaan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Penghargaan_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Penghargaan_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Penghargaan_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_Tubel_btnSave').on('click', function() {
    $('#mdlArsip_Tubel_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Tubel_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Tubel_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_tubel/tubel_edit';
    }
    else {
        urlAjax += 'admin/admin_tubel/tubel_add';
    }

    var form = $("#mdlArsip_Tubel_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddTubel').modal('hide');
                tblTubel.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Tubel_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Tubel_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Tubel_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Tubel_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_SKP_btnSave').on('click', function() {
    $('#mdlArsip_SKP_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_SKP_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_SKP_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_skp/skp_edit';
    }
    else {
        urlAjax += 'admin/admin_skp/skp_add';
    }

    var form = $("#mdlArsip_SKP_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddSKP').modal('hide');
                tblSKP.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_SKP_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_SKP_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_SKP_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_SKP_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$('#mdlArsip_Hukuman_btnSave').on('click', function() {
    $('#mdlArsip_Hukuman_btnSave').text('simpan...'); //change button text
    $('#mdlArsip_Hukuman_btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.form-control').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    let urlAjax = url;
    let id = parseInt($('#mdlArsip_Hukuman_id').val());
    if (id != 0) {
        urlAjax += 'admin/admin_hukuman/hukuman_edit';
    }
    else {
        urlAjax += 'admin/admin_hukuman/hukuman_add';
    }

    var form = $("#mdlArsip_Hukuman_frm").closest("form");
    var frmData = new FormData(form[0]);
    $.ajax({
        url : urlAjax,
        type: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalAddHukuman').modal('hide');
                tblHukuman.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#mdlArsip_Hukuman_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Hukuman_btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#mdlArsip_Hukuman_btnSave').text('Simpan'); //change button text
            $('#mdlArsip_Hukuman_btnSave').attr('disabled',false); //set button enable 
        }
    });
});

$("#mdlArsip_Jabatan_id_riwayat_status_jabatan").change(function() {
    if (parseInt($(this).val()) == 10) {
        $("#mdlArsip_Jabatan_id_r_jabatan").hide();
        $("#mdlArsip_Jabatan_nama_jabatan").show();
    }
    else {
        $("#mdlArsip_Jabatan_id_r_jabatan").show();
        $("#mdlArsip_Jabatan_nama_jabatan").hide();
    }
});