// Class definition
var url = getCookie('url');

var KTSelect2 = function() {
    // Private functions
    var Select2Laporan = function() {
        $('#masa_pensiun').select2({
            placeholder: "Semua Masa Pensiun"
        });
        $('#masa_pangkat').select2({
            placeholder: "Semua Masa Pangkat"
        });
        $('#lokasi').select2({
            placeholder: "Semua Lokasi Kerja"
        });
        $('#id_lokasi_kerja').select2({
            placeholder: "Semua Lokasi Kerja"
        });
    }
    
    // Public functions
    return {
        init: function() {
            Select2Laporan();
		}
	};
}();

jQuery(document).ready(function() {
    KTSelect2.init();
});