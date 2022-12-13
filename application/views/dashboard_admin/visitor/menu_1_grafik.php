<!-- <<< Menu 1 >>> -->

<?php
date_default_timezone_set("Asia/Jakarta");
$bln  = date("m"); // Mendapatkan bulan sekarang
?>

<!-- BEGIN: FILTER -->
<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
    <div class="row align-items-center">
        <div class="col-xl-12 order-2 order-xl-1">
            <div class="row align-items-center">
                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                    <div class="kt-form__group kt-form__group--inline">
                        <div class="kt-form__label">
                            <label>Bulan&nbsp;:</label>
                        </div>
                        <div class="kt-form__control">
                            <select class="form-control" id="visitor_filter" onchange="filterOnChange()">
                                <!-- <option value="x">
                                    <?php //echo $this->func_table->getBulan($bln)  
                                    ?>
                                </option> -->

                                <?php
                                $x = 1;
                                while ($x <= 12) {
                                    echo "<option value='" . $x . "' " . ($bln == $x ? 'selected="selected"' : '') . ">" . $this->func_table->getBulan($x) . "</option>";
                                    $x++;
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 kt-margin-b-20-tablet-and-mobile">
                    <!-- <button type="button" class="btn btn-primary" onclick="search();">
                        Refesh
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END: FILTER -->

<div class="chart-container" style="position: relative; height:30vh; ">
    <canvas id="chart_visitor"></canvas>
</div>

<script type="text/javascript">
    var chartData = {
        labels: [
            <?php
            foreach ($monthly as $key) {
                echo '"' . $key->tgl . ' ' . $this->func_table->getBulanPendek($key->bln) . ' ' . $key->thn . '",';
            }
            ?>
        ],
        datasets: [{
            label: 'Pengunjung',
            data: [
                <?php
                foreach ($monthly as $key) {
                    echo $key->harian . ',';
                }
                ?>
            ],
            backgroundColor: [
                'rgba(191, 0, 255, 0.6)', // ungu
                'rgba(75, 0, 130, 0.6)', // nila
                'rgba(0, 0, 255, 0.6)', // biru
                'rgba(0, 255, 0, 0.6)', // hijau
                'rgba(255, 255, 0, 0.6)', // kuning
                'rgba(255, 127, 0, 0.6)', // jingga
                'rgba(255, 0, 0, 0.6)' // merah
            ],
            borderColor: [
                'rgba(191, 0, 255, 1)', // ungu
                'rgba(75, 0, 130, 1)', // nila
                'rgba(0, 0, 255, 1)', // biru
                'rgba(0, 255, 0, 1)', // hijau
                'rgba(255, 255, 0, 1)', // kuning
                'rgba(255, 127, 0, 1)', // jingga
                'rgba(255, 0, 0, 1)' // merah
            ],
            type: 'bar',
            borderWidth: 2
        }]
    };

    var options = {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            "hover": {
                "animationDuration": 0
            },
            animation: {
                duration: 0,
                onComplete: (x) => {
                    const chart = x.chart;
                    var {
                        ctx
                    } = chart;
                    ctx.textAlign = 'center';
                    // ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    ctx.textBaseline = 'bottom';
                    // Loop through each data in the datasets
                    const metaFunc = this.getDatasetMeta;
                    chart.data.datasets.forEach((dataset, i) => {
                        var meta = chart.getDatasetMeta(i);
                        meta.data.forEach((bar, index) => {
                            var data = dataset.data[index];
                            ctx.fillText(`${data}`, bar.x, bar.y + 20);
                        });
                    });
                }
            },
            plugins: {
                legend: {
                    display: false
                },
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    };

    var ctx = document.getElementById('chart_visitor').getContext('2d');
    new Chart(ctx, options);

    function load_to_e1(param) {
        alert(param);
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function filterOnChange() {
        let url = '<?= base_url() ?>';
        // alert(url);
        let frm = $("#visitor_filter");
        frm.attr("action", url + "VisitorController/filter");
        frm.attr("method", "post");
        frm.submit();
    }
    filterOnChange();
</script>