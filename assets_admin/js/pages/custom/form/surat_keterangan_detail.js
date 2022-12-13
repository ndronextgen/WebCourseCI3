var url = getCookie('url');

// Class definition
var KTWizard1 = function () {
  // Base elements
  var wizardEl;
  var formEl;
  var validator;
  var wizard;
  
  // Private functions
  var initWizard = function () {
    // Initialize form wizard
    wizard = new KTWizard('history', {
      // startStep: 1, // initial active step number
      clickableSteps: false  // allow step clicking
    });
  }
  
  return {
    // public functions
    init: function() {
      wizardEl = KTUtil.get('history');
      formEl = $('#frm');
      // initWizard();
    } 
  };
}();

var KTSweetAlert = function() {
  var initBtn = function() {
    
    $('#btnProses').click(function(e) {
      let content = `
        
        <div class="kt-section kt-section--first">
          <div class="form-group">
            <label><br /><br /></label>
            <div class="kt-radio-inline">
              <label class="kt-radio kt-radio--bold kt-radio--brand">
                <input type="radio" name="dec" value="2" onclick="changeStatus(2);"> Diterima
                <span></span>
              </label>
              <label class="kt-radio kt-radio--bold kt-radio--brand">
              <input type="radio" name="dec" value="1" onclick="changeStatus(1);"> Ditolak
                <span></span>
              </label>
            </div>
          </div>
          <div class="form-group" id="divttd" style="display:none;">
            <div class="col-md-12">
            <select class="form-control" name="select_ttd" id="select_ttd">
              <option value="basah">Tanda Tangan Basah</option>
              <option value="digital">Tanda Tangan Digital</option>
            </select>
            </div>
          </div>
          <div class="form-group" id="divKet" style="display:none;">
            <div class="col-md-12">
              <textarea class="form-control" rows="3" id="ket" name="ket" placeholder="Alasan ditolak"></textarea>
            </div>
          </div>
        </div>
      `;

      swal.fire({
        html: content,
        title: 'Proses Surat',
        confirmButtonText: "<i class='la la-save'></i> Simpan",
        confirmButtonClass: "btn btn-brand",
        showCancelButton: true,
        cancelButtonText: "<i class='la la-close'></i> Batal",
        cancelButtonClass: "btn btn-clean",
        inputValidator: function(result) {
          return new Promise(function(resolve, reject) {
            if (result) {
              resolve();
            } else {
              reject('Anda Belum Memilih Status!');
            }
          });
        }
      })
      .then(name => {
        if (!name) {
          swal.fire({
            title: 'Anda belum memilih status!',
            timer: 500,
            onOpen: function() {
              swal.showLoading()
            }
          });
          null;
        }
        
        var param = {
          dec: $("input[name=dec]:checked").val(),
          id_surat: $('#id_surat').val(),
          ket: $('#ket').val(),
          select_ttd: $('#select_ttd').val()
        };
        
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          },
          url: url+'admin/surat_keterangan/processSave',
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
                let frm = $('#frmSuratKeterangan');
                frm.attr('action', url+'admin/surat_keterangan/detail');
                frm.attr('method', 'post');
                
                frm.submit();
              }, 1000);
            }
            else {
              let errTxt = '';
              let i = 0;
              $.each (resp.message, function(k,v) {
                $.each(v, function(k2, v2) {
                  if (i > 0) errTxt += '\n';
                  errTxt += v2;
                  
                  i++;
                });
              });

              swal.fire({
                position: 'top-center',
                type: 'error',
                title: 'Gagal menyimpan!',
                text: errTxt,
                showConfirmButton: false,
                timer: 1500 
              });
            }
          }
        });
      })
      .catch(err => {
        console.log('catch error');
        console.log(err);
        if (err) {
          swal.fire("Gagal!", "Proses simpan gagal!", "error");
        } else {
          swal.stopLoading();
          swal.close();
        }
      });
    });
  
    //upload surat
    $('#btnProsesUpload').click(async function() {
      let id_surat = $('#id_surat').val();
      let file = $('#srt').val();
      
      if (file == '') {
        swal.fire({
          type: 'error',
          title: 'Gagal Upload!',
          text: 'Silakan pilih file pdf yang akan diupload!',
          showConfirmButton: false,
          timer: 1500 
        });
      }
      else if (file.match(/pdf.*/)||file.match(/PDF.*/)){
        let file = $('#srt');
        let doc = '';
        if (file.length > 0){
          for (let i = 0;i < file.length; i++){
            if ($('#srt')[i] != undefined) {
              if ($('#srt')[i].files[0] != undefined) {
                doc = await toBase64($('#srt')[i]);
              }
            }
          }

          if (doc != '') {
            var param = {
              file: doc,
              id_surat: $('#id_surat').val()
            };
            
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              url: url+'admin/surat_keterangan/processUpload',
              data: param,
              dataType: 'json',
              method: 'POST',
              success: function(resp) {
                if (resp.status == true) {
                  swal.fire({
                    type: 'success',
                    title: 'File berhasil diupload!',
                    showConfirmButton: false,
                    timer: 1500 
                  });
                  setTimeout(function() {
                    let frm = $('#frmSuratKeterangan');
                    frm.attr('action', url+'admin/surat_keterangan/detail');
                    frm.attr('method', 'post');
                    
                    frm.submit();
                  }, 1000);
                }
                else {
                  swal.fire({
                    type: 'error',
                    title: 'Gagal Upload File!',
                    text: resp.message,
                    showConfirmButton: false,
                    timer: 1500 
                  });
                }
              }
            });
          }
          else {
            swal.fire({
              type: 'error',
              title: 'Gagal Upload!',
              text: 'Gagal membaca file pdf!',
              showConfirmButton: false,
              timer: 1500 
            });
          }
        }
      }
      else {
        swal.fire({
          type: 'error',
          title: 'Gagal Upload!',
          text: 'File yang diupload harus berformat pdf!',
          showConfirmButton: false,
          timer: 1500 
        });
      }
      
    });
  };
  
  return {
    // Init
    init: function() {
      initBtn();
    }
  };
}();

jQuery(document).ready(function() {
  KTWizard1.init();
  KTSweetAlert.init();
});

//change status
function changeStatus(val) {
  if (val == 1) {
    $('#divKet').show();
    $('#divttd').hide();
  }
  else {
    $('#divKet').hide();
    $('#divttd').show();
  }
}

function backSuratKeterangan(act) {
  let frm = $('#frmSuratKeterangan');
  frm.attr('action', url+'admin/surat_keterangan/'+act);
  frm.attr('method', 'post');
  
  frm.submit();
}

//download surat
function download_surat() {
  let param = {
    id_surat: $('#id_surat').val()
  };
  //alert($('#id_surat').val());
  
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: url+'admin/surat_keterangan/updateDownload',
    data: param,
    dataType: 'json',
    method: 'POST',
    success: function(resp) {
      if (resp.status == true) {
        swal.fire({
          type: 'success',
          title: 'Downloading...',
          showConfirmButton: false,
          timer: 1500 
        });
        setTimeout(function() {
          url += 'admin/surat_keterangan/download_surat/'+$('#id_surat').val();
          window.open(url, '_blank');
          window.focus();
          location.reload();
        }, 1000);
      }
      else {
        swal.fire({
          type: 'error',
          title: 'Gagal download!',
          text: resp.message,
          showConfirmButton: false,
          timer: 1500 
        });
      }
    }
  });
}

//download surat
function download_surat_finished(id) {
  swal.fire({
    type: 'success',
    title: 'Downloading...',
    showConfirmButton: false,
    timer: 1500 
  });
  url += 'admin/surat_keterangan/download_surat_finished/'+id;
  // window.open(url, '_blank');
  window.location.href = url;

  setTimeout(function() {
    location.reload();
  }, 1000);
}

function download_surat_digital() {
  let param = {
    id_surat: $('#id_surat').val()
  };
  //alert($('#id_surat').val());
  
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url: url+'admin/surat_keterangan/updateDownload',
    data: param,
    dataType: 'json',
    method: 'POST',
    success: function(resp) {
      if (resp.status == true) {
        swal.fire({
          type: 'success',
          title: 'Downloading...',
          showConfirmButton: false,
          timer: 1500 
        });
        setTimeout(function() {
          url += 'admin/surat_keterangan/download_surat_digital/'+$('#id_surat').val();
          window.open(url, '_blank');
          window.focus();
          location.reload();
        }, 1000);
      }
      else {
        swal.fire({
          type: 'error',
          title: 'Gagal download!',
          text: resp.message,
          showConfirmButton: false,
          timer: 1500 
        });
      }
    }
  });
}







/*var url = getCookie('url');

// Class definition
var KTWizard1 = function () {
  // Base elements
  var wizardEl;
  var formEl;
  var validator;
  var wizard;
  
  // Private functions
  var initWizard = function () {
    // Initialize form wizard
    wizard = new KTWizard('history', {
      // startStep: 1, // initial active step number
      clickableSteps: false  // allow step clicking
    });
  }
  
  return {
    // public functions
    init: function() {
      wizardEl = KTUtil.get('history');
      formEl = $('#frm');
      // initWizard();
    } 
  };
}();

var KTSweetAlert = function() {
  var initBtn = function() {
    $('#btnProses').click(function(e) {
      let content = `
        <form id="frmProses" name="frmProses" class="kt-form">
        <div class="kt-section kt-section--first">
          <div class="form-group">
            <label><br /><br /></label>
            <div class="kt-radio-inline">
              <label class="kt-radio kt-radio--bold kt-radio--brand">
                <input type="radio" name="dec" value="2" onclick="changeStatus(2);"> Diterima
                <span></span>
              </label>
              <label class="kt-radio kt-radio--bold kt-radio--brand">
              <input type="radio" name="dec" value="1" onclick="changeStatus(1);"> Ditolak
                <span></span>
              </label>
            </div>
          </div>
          <div class="form-group" id="divKet" style="display:none;">
            <div class="col-md-12">
              <textarea class="form-control" rows="3" id="ket" name="ket" placeholder="Alasan ditolak"></textarea>
            </div>
          </div>
        </div>
        </form>
      `;

      swal.fire({
        html: content,
        title: 'Proses Surat Keterangan',
        confirmButtonText: "<i class='la la-save'></i> Simpan",
        confirmButtonClass: "btn btn-brand",
        showCancelButton: true,
        cancelButtonText: "<i class='la la-close'></i> Batal",
        cancelButtonClass: "btn btn-clean",
        inputValidator: function(result) {
          return new Promise(function(resolve, reject) {
            if (result) {
              resolve();
            } else {
              reject('Anda Belum Memilih Status!');
            }
          });
        }
      })
      .then(name => {
        if (!name) {
          swal.fire({
            title: 'Anda belum memilih status!',
            timer: 500,
            onOpen: function() {
              swal.showLoading()
            }
          });
          null;
        }
        
        var param = {
          dec: $("input[name=dec]:checked").val(),
          act: 'PROSES',
          id_surat: $('#id_surat').val(),
          ket: $('#ket').val()
        };
        // return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          },
          url: url+'admin/surat_keterangan/simpan',
          data: param,
          dataType: 'json',
          method: 'POST',
          success: function(resp) {
            console.log(resp);
            if (resp.status == true) {
              swal.fire({
                type: 'success',
                title: 'Data berhasil disimpan!',
                showConfirmButton: false,
                timer: 1500 
              });
              setTimeout(function() {
                window.location.href = url+'admin/surat_keterangan';
              }, 1000);
            }
            else {
              let errTxt = '';
              let i = 0;
              $.each (resp.message, function(k,v) {
                $.each(v, function(k2, v2) {
                  if (i > 0) errTxt += '\n';
                  errTxt += v2;
                  
                  i++;
                });
              });

              swal.fire({
                position: 'top-center',
                type: 'error',
                title: 'Gagal menyimpan!',
                text: errTxt,
                showConfirmButton: false,
                timer: 1500 
              });
            }
          }
        });
      })
      .catch(err => {
        console.log('catch error');
        console.log(err);
        if (err) {
          swal.fire("Gagal!", "Proses simpan gagal!", "error");
        } else {
          swal.stopLoading();
          swal.close();
        }
      });
      // .then(function(result) {
      //   if (result.value) {
      //     swal.fire({
      //       title: 'Menyimpan',
      //       timer: 1500,
      //       onOpen: function() {
      //         swal.showLoading()
      //       }
      //     });
      //   }
      //   else if (result.dismiss === 'cancel') {
      //     swal.fire({
      //       title: 'Batal',
      //       timer: 500,
      //       onOpen: function() {
      //         swal.showLoading()
      //       }
      //     });
      //   }
      // });
    });
  };
  
  return {
    // Init
    init: function() {
      initBtn();
    }
  };
}();

jQuery(document).ready(function() {
  KTWizard1.init();
  KTSweetAlert.init();
});

//change status
function changeStatus(val) {
  if (val == 1) {
    $('#divKet').show();
  }
  else {
    $('#divKet').hide();
  }
}

$('#btnProses').click(function() {
  let id_surat = $('#id_surat').val();
  $('#frm')[0].reset(); // reset form on modals
  $('#modal_srt').modal('show');
  $('#mdl_id_surat').val(id_surat);

  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string
});

//upload surat
$('#btnProsesUpload').click(function() {
  let id_surat = $('#id_surat').val();
  let file = $('#srt').val();
  
  if (file == '') {
    alert('Silakan pilih file pdf yang akan diupload!');
  }
  else if (file.match(/pdf.)||file.match(/PDF.)){
    $('#frm').submit();
  }
  else {
    alert('File yang diupload harus berformat pdf!');
  }
  
});

//download surat
function download_surat_finished(id) {
  swal.fire({
    type: 'success',
    title: 'Downloading...',
    showConfirmButton: false,
    timer: 1500 
  });
  url += 'admin/surat_pensiun/download_surat_finished/'+id;
  // window.open(url, '_blank');
  window.location.href = url;

  setTimeout(function() {
    location.reload();
  }, 1000);
}
*/