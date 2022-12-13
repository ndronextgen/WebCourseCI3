var counterFrmSuratPenyesuaianIjazah = 1;
var id_surat = $('#id_surat_penyesuaian_ijazah').val();
var url = getCookie('url');

$(document).ready(async function(){
    if (id_surat != 0) {
        let surat = await getSuratPenyesuaianIjazah(id_surat);
        $('#penutup').val(surat.penutup);
        console.log(surat);
        if (surat.keterangan.indexOf('#|#') > 0) {
          let ket = surat.keterangan.split('#|#');
          let j;
          
          ket.forEach((elKet, i) => {
            $('#keterangan_'+(i+1)).val(elKet);

            if (i > 0) {
                addFrmSuratPenyesuaianIjazah(document.getElementById('btnAddSuratPenyesuaianIjazah'),elKet);
            }
          });
        }
    }
});

function getSuratPenyesuaianIjazah(id) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/surat_penyesuaian_ijazah/detail',
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

function addFrmSuratPenyesuaianIjazah(obj,val='') { 
    var content = `
    <div class="form-group" id="frmSuratPenyesuaianIjazah">
        <label>Keterangan :</label>
        <textarea rows="4" id="keterangan_${counterFrmSuratPenyesuaianIjazah}" name="keterangan[]" class="form-control">${val}</textarea>
        <br />
        <a href="javascript:;" onclick="removeFrmSuratPenyesuaianIjazah(this);" class="btn-sm btn btn-label-danger btn-bold">
            <i class="la la-trash-o"></i>
            Hapus
        </a>
    </div>
    `;

    $(obj).parents().eq(1).before(content);
    
    counterFrmSuratPenyesuaianIjazah++;
    $('#counterFrmSuratPenyesuaianIjazah').val(counterFrmSuratPenyesuaianIjazah);
}

function removeFrmSuratPenyesuaianIjazah(obj) {
    $(obj).parents().eq(0).remove();
    $('#counterFrmSuratPenyesuaianIjazah').val(counterFrmSuratPenyesuaianIjazah);
}

function backSuratPenyesuaianIjazah(act) {
    let action = '';
    if (act == 'edit') {
        action = '/detail';
    }

    console.log('action:'+action);
    
    let frm = $('#formSuratPenyesuaianIjazah');
    console.log(frm);
    frm.attr('action', url+'admin/surat_penyesuaian_ijazah'+action);
    frm.attr('method', 'post');
    frm.submit();
}
