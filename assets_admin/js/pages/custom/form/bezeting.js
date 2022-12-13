function changeSelisih(idStatusJabatan,idJabatan) {
    var existing = $(`#existing-${idStatusJabatan}-${idJabatan}`).val();
    var abk = $(`#abk-${idStatusJabatan}-${idJabatan}`).val();
    var selisih = parseInt(existing) - parseInt(abk);
    $(`#selisih-${idStatusJabatan}-${idJabatan}`).val(parseInt(selisih));
    $(`#selisihLabel-${idStatusJabatan}-${idJabatan}`).html(parseInt(selisih));
}