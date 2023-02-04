<?php 
if($this->session->userdata('ses_user') != '' OR $this->session->userdata('ses_id') != ''){ 
	redirect(base_url('Dashboard'));
} else {
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>WZ-COURSE</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="<?php echo base_url('assets/images/kursus.png'); ?>" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url('assets/css/theme-default.css'); ?>"/>
        <!-- EOF CSS INCLUDE -->  \
        <style type="text/css">
            #map {
                    border-radius:.125em;border:2px solid #1978cf;box-shadow: 0 0 8px #999;
                    width:100%;
                    height:200px;
                }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>                            
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please Input</div>
                    <form action="<?php echo base_url('register/aksi_register'); ?>" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name='Nama_anggota' class="form-control" placeholder="Nama Lengkap"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name='Alamat' class="form-control" placeholder="Alamat"/>
                        </div>
                    </div>
                    <div id="map"></div>
                    <input type="hidden" value="" id="latlng">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name='Email' class="form-control" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name='password' class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-info btn-block">Register</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2022 WZ-COURSE
                    </div>
            </div>
            
        </div>
        
    </body>
</html>
<script>
    var map = L.map('map').setView([-6.2064364, 106.7992815], 7);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    map.locate({ setView: true, maxZoom: 13 });
    setInterval(ajaxCall, 55000);

    function ajaxCall() {
        map.locate({ setView: true, maxZoom: 13 });
    }
    map.on('click', function (e) {
    geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
      if (error) {
        return;
      }
      alert(result.latlng)
    });
  });
</script>

<?php } ?>