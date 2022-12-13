<script>
    function simpan() {

        //var max_nominal = parseInt($("#max_nominal").val());
        var sisa_pagu = parseInt($("#sisa_pagu").val());
        var alokasi = $("#alokasi").val();
        var alokasi_reg = parseInt(alokasi.split('.').join(""));


        if (alokasi_reg > sisa_pagu) {
            alert("Nominal Alokasi Lebih besar dari Pagu Anggaran!!!");
        } else if (alokasi_reg <= sisa_pagu) {
            ajax_edit();
        }
    }

    function ajax_edit() {
        var formData = new FormData($('#form_data_item')[0]);
        $.ajax({
            url: "<?php echo site_url('i/modul_penyerapan/In_penyerapan/update_temp_item'); ?>",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            // success: function (response) {
            //     alert(response);
            //     reload_table_item_pilihan();
            // }
            beforeSend: function(f) {
                var percentVal = ' <img src="<?php echo base_url('ws_assets/img/loading.gif'); ?>" style="width:30px;"> Mohon Ditunggu ...!';
                $('#pesan').html(percentVal);
            },
            success: function(response) {
                alert(response);
                //var percentVal = ' <img src="<?php //echo base_url('ws_assets/img/loading.gif');
                                                ?>" style="width:2.5em;position:fixed;">';
                $('#pesan').html('Data Berhasil Diupdate... !');
                reload_table_item_pilihan();
            }
        });
    }
</script>

<div class="row">
    <div class="col-md-12">
        <div class="box-body table-responsive">
            <form name="form_data_item" id="form_data_item" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control form-control-sm" name="kd_Id" id="kd_Id">
                <input type="hidden" class="form-control form-control-sm" name="kd_berkas" id="kd_berkas">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Nama Item</label>
                                <input type="text" class="form-control form-control-sm" name="nmitem" id="nmitem" placeholder="Nama Item" disabled>
                            </div>
                        </div>
                        <!-- <div class="row">
                        <div class="form-group col-12">
                            <label>Pagu Anggaran</label>
                            <input type="text" class="form-control form-control-sm" name="max_nominal" id="max_nominal" placeholder="Pagu Anggaran" disabled>
                        </div>
                    </div> -->
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Pagu Anggaran</label>
                                <input type="text" class="form-control form-control-sm" name="max_nominal" id="max_nominal" placeholder="Pagu Anggaran" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label>Sisa Pagu</label>
                                <input type="text" class="form-control form-control-sm" name="sisa_pagu" id="sisa_pagu" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Nominal</label>
                                <input type="text" class="form-control form-control-sm" name="alokasi" id="alokasi" placeholder="Alokasi">
                            </div>
                            <div class="form-group col-4">
                                <label>PPN</label>
                                <input type="text" class="form-control form-control-sm" name="ppn" id="ppn" placeholder="PPN">
                            </div>
                            <div class="form-group col-4">
                                <label>PPH</label>
                                <input type="text" class="form-control form-control-sm" name="pph" id="pph" placeholder="pph">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Nomor BKU</label>
                                <input type="text" class="form-control form-control-sm" name="nobku" id="nobku" placeholder="Nomor BKU">
                            </div>
                            <div class="form-group col-6">
                                <label>File</label>
                                <input type="hidden" class="form-control form-control-sm" name="nmfile_lama" id="nmfile_lama">
                                <input type="file" class="form-control form-control-sm" name="nmfile" id="nmfile">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-3">
                                <button id='btn_tmb' type='button' onclick="simpan()" class='btn btn-block btn-success btn-xs'>Ubah Data</button>
                            </div>
                            <div class="form-group col-3" id='pesan'>
                                <!-- <button id='btn_tmb' type='button' onclick="simpan()" class='btn btn-block btn-success btn-xs'>Ubah Data</button> -->
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#max_nominal').maskMoney({
            prefix: '',
            thousands: '.',
            decimal: ',',
            precision: 0
        });
        $('#alokasi').maskMoney({
            prefix: '',
            thousands: '.',
            decimal: ',',
            precision: 0
        });
        $('#ppn').maskMoney({
            prefix: '',
            thousands: '.',
            decimal: ',',
            precision: 0
        });
        $('#pph').maskMoney({
            prefix: '',
            thousands: '.',
            decimal: ',',
            precision: 0
        });
    });
</script>