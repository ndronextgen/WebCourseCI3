<div class="chart-container" style="position: relative; height:25vh;">
    <canvas id="canvas"></canvas>
</div>

<script type="text/javascript">
    var barChartData2 = {
        labels: ["6 Bulan", "1 Tahun", "1 Tahun 6 Bulan", "2 Tahun"],
        datasets: [{
                label: 'Naik Pangkat',
                backgroundColor: [
                    // <?php //$count = 6; for($i = 1; $i <= $count; $i++) : 
                        ?>
                    //   getRandomColor(),
                    // <?php //endfor; 
                        ?>

                    'rgba(255, 0, 0, 0.6)', //merah
                    'rgba(255, 255, 0, 0.6)', //kuning
                    'rgba(0, 255, 0, 0.6)', //hijau
                    'rgba(0, 0, 255, 0.6)' //biru

                ],
                borderColor: [
                    'rgba(255, 0, 0, 1)', //merah
                    'rgba(255, 255, 0, 1)', //kuning
                    'rgba(0, 255, 0, 1)', //hijau
                    'rgba(0, 0, 255, 1)' //biru
                ],
                type: 'bar',
                borderWidth: 2,
                data: [<?php echo $naik_pangkat->jum_6b; ?>, <?php echo $naik_pangkat->jum_12b; ?>, <?php echo $naik_pangkat->jum_18b; ?>, <?php echo $naik_pangkat->jum_24b; ?>, <?php echo $naik_pangkat->jum_30b; ?>]
            }
            // , {
            //     label: 'WFH',
            //     backgroundColor: "#8f1300",
            //     borderWidth: 1,
            //     data: [9]
            // }
        ]
    };
    var ctx2x = document.getElementById("canvas").getContext('2d');
    var myChart2 = new Chart(ctx2x, {
        type: 'bar',
        data: barChartData2,
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
            },
            onClick: event => {
                //var activePoints = myChart2.getElementsAtEvent(evt);
                // alert('Under Maintenance');
                $jQ.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Fitur belum tersedia...',
                    type: 'red',
                    backgroundDismiss: true
                });
                // => activePoints is an array of points on the canvas that are at the same position as the click event.
            }
        }
    });


    function load_to_e1(param) {
        alert(param);

    }
</script>