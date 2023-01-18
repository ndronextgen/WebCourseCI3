<div class="row">
    <div class="col-md-12">
        <input type='hidden' name='pegawai_id' id='nfilter_pegawai_id' value='<?php echo $Id; ?>'>
        <table class="top">
            <tr>
                <td style="padding: 4px;">
                    <button class="btn btn-default btn-sm btn-flat" onclick="reload_table_uk()"><i class="fa fa-refresh"></i></button>
                </td>
            </tr>
        </table>
        <hr>
    </div>
</div>

<br>

<div id="ajax_new_table"></div>

<script type="text/javascript">
    var pegawai_id = $("#nfilter_pegawai_id").val();;
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Tunjangan/get_item_table'); ?>",
        data: {
            pegawai_id: pegawai_id
        },
        beforeSend: function(f) {
            var percentVal = '<img src="<?php echo base_url("ws_assets/img/loading.gif"); ?>" style="width:3em;position:fixed;">';
            $('#ajax_new_table').html(percentVal);
        },
        success: function(data) {
            $('#ajax_new_table').html(data);
        }
    });

    function filter_uk() {
        var program = $("#nfilter_program").val();
        var kegiatan = $("#nfilter_kegiatan").val();
        var output = $("#nfilter_output").val();
        var suboutput = $("#nfilter_suboutput").val();
        var komponen = $("#nfilter_komponen").val();
        var subkomponen = $("#nfilter_subkomponen").val();
        var kd_akun = $("#nfilter_akun").val();
        var kd_berkas = $("#nfilter_kd_berkas").val();
        $.ajax({
            type: "POST",
            data: {
                kd_akun: kd_akun,
                program: program,
                kegiatan: kegiatan,
                output: output,
                suboutput: suboutput,
                komponen: komponen,
                subkomponen: subkomponen,
                kd_berkas: kd_berkas
            },
            url: "<?php echo site_url('i/modul_penyerapan/In_penyerapan/filter_uk') ?>",
            beforeSend: function(f) {
                var percentVal = '<img src="<?php echo base_url("ws_assets/img/loading.gif"); ?>" style="width:3em;position:fixed;">';
                $('#ajax_new_table').html(percentVal);
            },
            success: function(data) {
                $('#ajax_new_table').html(data);
            }
        });
    }

    function reload_table_uk() {
        tableas.ajax.reload(null, false); //reload datatable ajax 
    }
</script>