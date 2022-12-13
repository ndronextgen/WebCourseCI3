<div class="chart-container" style="position: relative; height:25vh;">
    <canvas id="chart_status_pegawai"></canvas>
</div>

<script type="text/javascript">
    var options = {
        type: 'pie',
        data: {
            labels: [
                <?php foreach ($status_data as $status_data) : ?> 
                    '<?= $status_data->nama_status ?>',
                <?php endforeach ?>
            ],
            datasets: [{
                label: '# of Votes',
                data: [
                    <?php foreach ($pegawai_data as $row) {
                        echo '"' . $row->jml . '",';
                    } ?>
                ],
                backgroundColor: [
                    // <?php //$count = 6; for($i = 1; $i <= $count; $i++) : 
                        ?>
                    // getRandomColor(),
                    // <?php //endfor; 
                        ?>

                    'rgba(0, 0, 255, 0.6)', // BI
                    'rgba(0, 255, 0, 0.6)', // HI
                    'rgba(255, 255, 0, 0.6)', // KU
                    'rgba(255, 127, 0, 0.6)', // JI
                    'rgba(255, 0, 0, 0.6)', // ME
                    'rgba(75, 0, 130, 0.6)' // NI

                ],

                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    color: 'white'
                }
            }]
        },

        options: {
            plugins: {
                legend: {
                    labels: {
                        generateLabels(chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                const {
                                    labels: {
                                        pointStyle
                                    }
                                } = chart.legend.options;

                                return data.labels.map((label, i) => {
                                    const meta = chart.getDatasetMeta(0);
                                    const style = meta.controller.getStyle(i);

                                    return {
                                        text: `${label}: ${data['datasets'][0].data[i]}`,
                                        fillStyle: style.backgroundColor,
                                        strokeStyle: style.borderColor,
                                        lineWidth: style.borderWidth,
                                        pointStyle: pointStyle,
                                        hidden: !chart.getDataVisibility(i),

                                        // Extra data used for toggling the correct item
                                        index: i
                                    };
                                });
                            }
                            return [];
                        }
                    },
                    position: 'left',

                    onClick(e, legendItem, legend) {
                        legend.chart.toggleDataVisibility(legendItem.index);
                        legend.chart.update();
                    }
                }
            },
            responsive: true,
            chartArea: {
                backgroundColor: '#000000'
            },
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                x: {
                    display: false
                }
            },
        }
    }

    var ctx = document.getElementById('chart_status_pegawai').getContext('2d');
    new Chart(ctx, options);
</script>