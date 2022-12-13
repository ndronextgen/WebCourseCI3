// Class definition
var KTBootstrapDatepicker = (function () {
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>',
        };
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>',
        };
    }

    // Private functions
    var date_picker_pegawai = function () {
        // minimum setup
        $("#tanggal_lahir, #tanggal_mulai_pangkat").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd M yyyy",
            autoclose: true,
            todayBtn: true,
            clearBtn: true,
        });

        // minimum setup for modal demo
        $("#tanggal_lahir_modal").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd M yyyy",
            autoclose: true,
            todayBtn: true,
            clearBtn: true,
        });

        // input group layout for modal demo
        $("#tanggal_mulai_pangkat_modal").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd M yyyy",
            autoclose: true,
            todayBtn: true,
            clearBtn: true,
        });
    };

    var date_picker_mdlArsip_Keluarga = function () {
        $("#mdlArsip_Keluarga_tanggal_lahir_keluarga").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_mdlArsip_Pangkat = function () {
        $("#mdlArsip_Pangkat_tanggal_sk").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });

        $("#mdlArsip_Pangkat_tanggal_mulai").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_mdlArsip_Jabatan = function () {
        $("#mdlArsip_Jabatan_tmt_mulai_jabatan").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });

        $("#mdlArsip_Jabatan_tgl_sk_jabatan").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_mdlArsip_Pendidikan = function () {
        $("#mdlArsip_Pendidikan_tanggal_lulus").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_mdlArsip_Pelatihan = function () {
        $("#mdlArsip_Pelatihan_tanggal_sertifikat").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_mdlArsip_Penghargaan = function () {
        $("#mdlArsip_Penghargaan_tgl_sk_penghargaan").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_mdlArsip_Tubel = function () {
        $("#mdlArsip_Tubel_tgl_sk").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });

        $("#mdlArsip_Tubel_tgl_mulai").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });

        $("#mdlArsip_Tubel_tgl_selesai").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_frmKeluarga = function () {
        $("#frmKeluarga_tanggal_lahir_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_frmPangkat = function () {
        $("#frmPangkat_tanggal_sk_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
        $("#frmPangkat_tanggal_mulai_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_frmJabatan = function () {
        $("#frmJabatan_tmt_mulai_jabatan_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });

        $("#frmJabatan_tgl_sk_jabatan_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_frmPendidikan = function () {
        $("#frmPendidikan_tanggal_lulus_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_frmPelatihan = function () {
        $("#frmPelatihan_tanggal_sertifikat_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_frmPenghargaan = function () {
        $("#frmPenghargaan_tgl_sk_penghargaan_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    var date_picker_frmTubel = function () {
        $("#frmTubel_tgl_sk_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
        $("#frmTubel_tgl_mulai_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
        $("#frmTubel_tgl_selesai_0").datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    };

    return {
        // public functions
        init: function () {
            date_picker_pegawai();
            date_picker_mdlArsip_Keluarga();
            date_picker_mdlArsip_Pangkat();
            date_picker_mdlArsip_Jabatan();
            date_picker_mdlArsip_Pendidikan();
            date_picker_mdlArsip_Pelatihan();
            date_picker_mdlArsip_Penghargaan();
            date_picker_mdlArsip_Tubel();
            date_picker_frmKeluarga();
            date_picker_frmPangkat();
            date_picker_frmJabatan();
            date_picker_frmPendidikan();
            date_picker_frmPelatihan();
            date_picker_frmPenghargaan();
            date_picker_frmTubel();
        },
    };
})();

jQuery(document).ready(function () {
    KTBootstrapDatepicker.init();
});
