    <html>

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>SignaturePad eraser feature</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <script type="text/javascript" src="https://szimek.github.io/signature_pad/js/signature_pad.umd.js"></script>

        <style id="compiled-css" type="text/css">
            .wrapper {
                position: relative;
                width: 400px;
                height: 200px;
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .signature-pad {
                position: absolute;
                left: 0;
                top: 0;
                width: 400px;
                height: 200px;
                background-color: white;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <form id="ttdForm" action="<?= base_url("dashboard_publik/signature_test"); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="formUrl" name="formUrl">
                <div class="wrapper">
                    <canvas id="signature-pad" class="signature-pad" width="600" height="300" style="touch-action: none; user-select: none;"></canvas>
                </div>
                <button type="button" id="save-ttd" class="btn btn-primary">Submit</button>
            </form>
            <img src="<?= @$this->session->flashdata("saved"); ?>" width="300" height="300">
        </div>

        <button id="save-png">Save as PNG</button>
        <button id="save-jpeg">Save as JPEG</button>
        <button id="save-svg">Save as SVG</button>
        <button id="draw">Draw</button>
        <button id="erase">Erase</button>
        <button id="clear">Clear</button>
        <script type="text/javascript">
            var canvas = document.getElementById('signature-pad');

            function resizeCanvas() {
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }
            window.onresize = resizeCanvas;
            resizeCanvas();
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)', // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
                minWidth: 1,
                maxWidth: 1,
                penColor: "rgb(66, 133, 244)"
            });
            document.getElementById('save-ttd').addEventListener('click', function() {
                if (signaturePad.isEmpty()) {
                    return alert("Please provide a signature first.");
                }
                const form = document.getElementById("ttdForm");
                var data = signaturePad.toDataURL('image/svg+xml');
                document.getElementById("formUrl").value = encodeURIComponent(data);
                form.submit();
            });

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });
        </script>
    </body>

    </html>