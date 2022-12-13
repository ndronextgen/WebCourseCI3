<div class="chart-container" style="position: relative; height:25vh;">
    <canvas id="canvas2"></canvas>
</div>

<script type="text/javascript">
    var barChartData2 = {
        labels: ["6 Bulan", "1 Tahun", "1 Tahun 6 Bulan", "2 Tahun"],
        datasets: [{
            label: 'Pensiun',

            backgroundColor: [
                // <?php //$count = 6; for($i = 1; $i <= $count; $i++) : 
                    ?>
                //   getRandomColor(),
                // <?php //endfor; 
                    ?>],

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

            data: [
                <?php echo $pensiun->jum_6b; ?>,
                <?php echo $pensiun->jum_12b; ?>,
                <?php echo $pensiun->jum_18b; ?>,
                <?php echo $pensiun->jum_24b; ?>,
                <?php echo $pensiun->jum_30b; ?>
            ]
        }]
    };
    var ctx3 = document.getElementById("canvas2").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: barChartData2,
        options: {
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            "hover": {
                "animationDuration": 0
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
            },
            title: {
                display: true,
                text: 'Pensiun'
            },
            animation: {
                duration: 0,
                onComplete: (x) => {
                    const chart = x.chart;
                    var {
                        ctx
                    } = chart;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';
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
            onClick: event => {
                // alert('Under Maintenance');
                $jQ.dialog({
                    icon: 'fa fa-info',
                    title: 'Info',
                    content: 'Fitur belum tersedia...',
                    type: 'red',
                    backgroundDismiss: true
                });
            }
        }
    });
</script>