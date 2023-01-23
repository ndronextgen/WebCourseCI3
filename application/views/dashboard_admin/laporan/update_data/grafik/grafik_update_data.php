<div class="chart-container" style="position: relative; height:25vh;">
    <canvas id="canvas"></canvas>
</div>

<script type="text/javascript">
    var barChartData = {
        labels: ["Total Pegawai (<?= $peg_total ?>)", "Sudah Update (<?= $peg_update ?>)", "Belum Update (<?= $peg_no_update ?>)"],
        datasets: [{
            label: '',
            backgroundColor: [
                'rgba(0, 0, 255, 0.3)', //biru
                'rgba(0, 255, 0, 0.3)', //hijau
                'rgba(255, 255, 0, 0.3)' //kuning

            ],
            borderColor: [
                'rgba(0, 0, 255, 1)', //biru
                'rgba(0, 255, 0, 1)', //hijau
                'rgba(255, 255, 0, 1)' //kuning
            ],
            type: 'bar',
            borderWidth: 2,
            data: [
                <?php echo $peg_total; ?>,
                <?php echo $peg_update; ?>,
                <?php echo $peg_no_update; ?>,
            ]
        }]
    };

    var ctx = document.getElementById("canvas").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            maintainAspectRatio: true,
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
                    display: true
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
                //var activePoints = myChart.getElementsAtEvent(evt);

                // $jQ.dialog({
                //     icon: 'fa fa-info',
                //     title: 'Info',
                //     content: 'Fitur belum tersedia...',
                //     type: 'red',
                //     backgroundDismiss: true
                // });
                // => activePoints is an array of points on the canvas that are at the same position as the click event.
            }
        }
    });

    // function load_to_e1(param) {
    //     alert(param);
    // }
</script>