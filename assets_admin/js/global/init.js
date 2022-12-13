var url = getCookie('url');
var id = getCookie('id_pegawai');
var act_list = getCookie('act_list');
var lokasi_kerja = getCookie('lokasi_kerja');
var arrows;
var mst_golongan;
var mst_nama_jabatan;
var mst_status_jabatan;
var mst_pendidikan;
var mst_pelatihan;
var mst_penghargaan;

if (KTUtil.isRTL()) {
    arrows = {
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
    }
}
else {
    arrows = {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    }
}

function getMstGolonganList() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url +'api/mst_golongan/list',
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

function getMstStatusJabatanList() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/mst_status_jabatan/list',
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

function getMstNamaJabatanList() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/mst_nama_jabatan/list',
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

function getMstPendidikanList() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/mst_pendidikan/list',
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

function getMstPelatihanList() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/mst_pelatihan/list',
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

function getMstPenghargaanList() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url  +'api/mst_penghargaan/list',
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function getDataPribadi(id) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            method: "POST",      
            dataType: 'json',
            url: url +'api/mst_golongan/list',
            success: function(resp){
                resolve(resp);
            },
            error: function() {
                reject(false);
            }
        });
    });
}