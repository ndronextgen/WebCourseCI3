<!-- SIDEBAR -->

<!-- LATEST JQUERY -->
<script src="https://code.jquery.com/jquery-latest.js"></script>

<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="load_content('menu1')">
                <i class="fas fa-fw fas fa-chart-bar"></i>
                <span>Grafik Pengunjung Harian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="load_content('menu2')">
                <i class="fas fa-fw fas fa-table"></i>
                <span>Data Pengunjung</span></a>
        </li>
</div>

<!-- <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="load_content('menu3')">
            <i class="fas fa-fw fas fa-chart-pie"></i>
            <span>Menu-3</span></a>
    </li> -->

<!-- MENU DENGAN SUB-MENU (DROP-DOWN) -->
<!-- <li class="nav-item dropdown <?php //echo $this->uri->segment(2) == 'products' ? 'active' : '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Products</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php //echo site_url('admin/products/add') ?>">New Product</a>
            <a class="dropdown-item" href="<?php //echo site_url('admin/products') ?>">List Product</a>
        </div>
    </li> -->

</ul>

<script>
    function load_content(menu) {
        if (menu == 'menu1') {
            var urls = "<?php echo site_url('admin/data_visitor/func_menu1'); ?>";
            document.getElementById("judul_konten").innerHTML = "Grafik Pengunjung Harian";
        } else if (menu == 'menu2') {
            var urls = "<?php echo site_url('admin/data_visitor/func_menu2'); ?>";
            document.getElementById("judul_konten").innerHTML = "Data Pengunjung";
        } else if (menu == 'menu3') {
            var urls = "<?php echo site_url('admin/data_visitor/func_menu3'); ?>";
            document.getElementById("judul_konten").innerHTML = "Judul Menu 3";
        }

        $.ajax({
            type: "POST",
            url: urls,
            beforeSend: function(b) {
                var percentVal = ' <img src="<?php echo base_url('asset/img/loading.gif'); ?>" style="width:3.5em;position:fixed;">';
                $('#isi_konten').html(percentVal);
            },
            success: function(s) {
                $('#isi_konten').html(s);
            }
        });
    }
</script>