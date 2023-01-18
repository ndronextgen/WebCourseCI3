<script type="text/javascript">
    function batal_form_1() {
        $('#modal_all_md').modal('hide');
    }

    function batal_form_2() {
        $('#modal_all').modal('hide');
    }
</script>

<style type="text/css">
    .info_pop {
        border: none;
        border-radius: 40px 10px;
        background: #e0e0de;
        font-size: 16px;
        font-weight: bold;
        font-family: "Arial Narrow";
        padding: 10px;
    }

    ol {
        counter-reset: item;
        list-style-type: none;
        line-height: 2.2;
        margin-left: -40px;
    }

    ol li {
        list-style-type: none;
        counter-increment: item;
    }

    ol li:before {
        content: counter(item);
        margin-right: 5px;
        font-size: 80%;
        background-color: #f9dd94;
        color: #7eb4e2;
        font-weight: bold;
        padding: 3px 8px;
        border-radius: 3px;
    }
</style>

<?php if (!empty($this->session->userdata("isUserShowPopup")) && !$this->session->userdata("alreadyOpenPopup")) { ?>
    <script type="text/javascript">
        function informasiList() {
            var html = "";
            <?php
                if (!empty($data_informasi)) :
                    foreach ($data_informasi as $pop) :
                        ?>
                    html += "<li><?= $pop->title; ?></li>";
            <?php
                    endforeach;
                endif;
                ?>
            return html;
        }
        Swal.fire({
            title: '',
            icon: 'info',
            width: 700,
            html: '<div class="info_pop">' +
                '<h3 style="font-family: Arial Narrow; color: #2c80f5; font-weight: bold;">' +
                '</h3>' +
                'Kami mengingatkan agar segera melengkapi data-data anda.<br>' +
                'Data yang diinput merupakan data yang sebenarnya dan dapat dipertanggungjawabkan.<br><br>' +
                '</div>' +
                '<hr>' +
                '<p style="font-weight: bold; color: red; font-size: 15px; font-family: Arial Narrow; text-align: left;">' +
                'Informasi Update Terbaru</p>' +
                '<ol style="text-align: left;font-size:15px;font-family: Arial Narrow;">' +

                informasiList() +

                '</ol>' +
                '<hr><p style="font-weight: bold; color: #2c80f5;font-size:15px;font-family: Arial Narrow;">Terima kasih</p>',
            customClass: {
                popup: 'format-pre'
            },
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Oke!',
            confirmButtonAriaLabel: 'Thumbs up, great!'
        }).then((result) => {
            $.ajax({
                url: "<?= base_url("dashboard_publik/Alreadyopenpopup"); ?>",
                type: "GET"
            });
        });
    </script>
<?php } ?>

<!-- SSO LIB -->
<script type="text/javascript" src="<?php echo base_url(); ?>asset/sso/js/all.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/sso/js/main.js"></script>

<script type="text/javascript">
    let sso = new SSO({
        sso_services_url: "https://dcktrp.jakarta.go.id/satuakses/service/",
    });
    sso.initComponent('#sso_widget');
    document.querySelector('#sso_floating_widget').style.zIndex = 99999;

    function under_maintenance() {
        $.dialog({
            icon: 'fa fa-info',
            title: 'Info',
            content: 'Sedang dalam pengerjaan...',
            type: 'red',
            backgroundDismiss: true
        });
    }

    // === begin: main container top menyesuikan tinggi navbar ===
    $(document).ready(function() {
        setTimeout(setPadding, 1000);
    });

    function setPadding() {
        $defaultNavbarHeight = 50;
        $navbarHeight = $('.navbar').height();
        $mainWrapperPadding = 5; //parseInt($(".content-wrapper").css("padding-top"));
        $newMainWrapperPadding = $mainWrapperPadding + $navbarHeight - $defaultNavbarHeight;

        if ($navbarHeight > $defaultNavbarHeight) {
            $(".content-wrapper").css("padding-top", $newMainWrapperPadding);
        }
    }

    $(window).resize(function() {
        setPadding();
    });
    // === end: main container top menyesuikan tinggi navbar ===
</script>