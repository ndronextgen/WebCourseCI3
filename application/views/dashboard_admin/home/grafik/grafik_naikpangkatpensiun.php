<div class="chart-container" style="position: relative; height:25vh;">
    <canvas id="canvas2"></canvas>
</div>

<script type="text/javascript">

var barChartData2 = {
            labels: ["Naik Pangkat", "Pensiun"],
            datasets: [{
                label: 'Naik Pangkat/Pensiun',
                backgroundColor: [
                        <?php $count = 2; for($i = 1; $i <= $count; $i++) : ?>
                          getRandomColor(),
                        <?php endfor; ?>],
                type: 'bar',
                borderWidth: 1,
                data: [<?php echo $naik_pangkat; ?>,<?php echo $pensiun; ?>]
            }
            // , {
            //     label: 'WFH',
            //     backgroundColor: "#8f1300",
            //     borderWidth: 1,
            //     data: [9]
            // }
        ]
        };
		var ctx2 = document.getElementById("canvas2").getContext('2d');
		var myChart2 = new Chart(ctx2, {
			type: 'bar',
			data: barChartData2,
			options: {
                tooltips: {
                mode: 'index',
                intersect: false,
                },
                hover: {
                mode: 'nearest',
                intersect: true
                },
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero:true
                    }
                }]
                },
                responsive: true,
                maintainAspectRatio: false,
                // legend: {
                //     position: 'top',
                // },

                plugins: {
                    legend: {
                        display: false
                    },
                },
                
                title: {
                    display: true,
                    text: 'Naik Pangkat/Pensiun'
                }
            }
		});
</script>