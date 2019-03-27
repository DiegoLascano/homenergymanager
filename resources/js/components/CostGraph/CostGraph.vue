<template>
  <div>
    <line-chart :height="200" :chart-data="chartData" :options="chartOptions"></line-chart>
  </div>
</template>

<script>
  import LineChart from './LineChart.js'

  export default {
    components: {
        LineChart
    },

    props: ['url'],

    data () {
        return {
            chartData: null,
        }
    },

    computed: {
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatios: false,
                title: {
                    display: true,
                    text: 'Precio de la energía por horas',
                    fontSize: 16,
                    fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                    padding: 10,
                },  
                // legend: {
                //     display: true,
                //     labels: {
                //         fontColor: 'rgb(255, 99, 132)'
                //     }
                // },
                scales: { 
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            fontSize: 13,
                            fontStyle: 'bold',
                            labelString: "Costo de energía [¢ / kWh]"
                        },
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            min: 0,
                            // callback: (value, index, values) => {
                            //     return `${value} ¢`;
                            // },
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            fontSize: 13,
                            fontStyle: 'bold',
                            labelString: "Horas"
                        },
                        gridLines: {
                            display: false,
                        },
                    }]
                },
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: ((tooltipItems, data) => {
                        // console.log(this)
                        return tooltipItems.yLabel + ' ¢ / kWh'
                        })
                    }
                }
            }
        }
    },

    mounted () {
        this.getData ()
    },
    methods: {
        getData () {
            axios.get(this.url)
                .then(response => {
                    this.fillData(response.data)
                })
        },
        fillData (data) {
            this.chartData = {
                labels: data.labels,
                datasets: [
                    {
                        label: data.datasets.label,
                        backgroundColor: data.datasets.backgroundColor,
                        borderColor: data.datasets.borderColor,
                        pointBackgroundColor: data.datasets.pointBackgroundColor,
                        pointBorderColor: data.datasets.pointBorderColor,
                        steppedLine: true,
                        data: data.datasets.data
                    }, 
                    // {
                    //     label: data.datasets[0].label,
                    //     backgroundColor: data.datasets[0].backgroundColor,
                    //     borderColor: data.datasets[0].borderColor,
                    //     pointBackgroundColor: data.datasets[0].pointBackgroundColor,
                    //     pointBorderColor: data.datasets[0].pointBorderColor,
                    //     data: data.datasets[0].data
                    // }, 
                    // {
                    //     label: data.datasets[1].label,
                    //     backgroundColor: data.datasets[1].backgroundColor,
                    //     borderColor: data.datasets[1].borderColor,
                    //     pointBackgroundColor: data.datasets[1].pointBackgroundColor,
                    //     pointBorderColor: data.datasets[1].pointBorderColor,
                    //     data: data.datasets[1].data
                    // }
                ]
            }
        }
    }
  }
</script>

<style>
  .small {
    max-width: 600px;
    margin: auto;
  }
</style>
