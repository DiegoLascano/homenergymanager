<template>
  <div>
    <line-chart :height="200" :chart-data="chartData" :options="chartOptions"></line-chart>
    <!-- <line-chart :height="200" :chart-data="chartData" :options="chartOptions"></line-chart> -->
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

    mounted () {
        this.load()
    },
    methods: {
        load () {
            this.fetchData()
                .then(response => {
                    // console.log(response.data)
                    this.fillData(response.data)
            })
        },
        fetchData () {
            return axios.get(this.url)
        },

        fillData (data) {
            // console.log(data),
            this.chartData = {
                labels: data.labels,
                datasets: [
                    // {
                    //     label: data.datasets.label,
                    //     backgroundColor: data.datasets.backgroundColor,
                    //     borderColor: data.datasets.borderColor,
                    //     pointBackgroundColor: data.datasets.pointBackgroundColor,
                    //     pointBorderColor: data.datasets.pointBorderColor,
                    //     steppedLine: true,
                    //     data: data.datasets.data
                    // }, 
                    {
                        label: data.datasets[0].label,
                        backgroundColor: 'rgba(20, 145, 153, 0.1)',
                        borderColor: 'rgba(14, 126, 134, 1)',
                        pointBackgroundColor: 'rgba(20, 145, 153, 0.1)',
                        pointBorderColor: 'rgba(4, 78, 83, 1)',
                        steppedLine: true,
                        data: data.datasets[0].data
                    }, 
                    {
                        label: data.datasets[1].label,
                        backgroundColor: 'rgba(241, 147, 194, 0.2)',
                        borderColor: 'rgba(218, 73, 145, 1)',
                        pointBackgroundColor: 'rgba(241, 147, 194, 0.1)',
                        pointBorderColor: 'rgba(195, 44, 120, 1)',
                        steppedLine: true,
                        data: data.datasets[1].data
                    }
                ]
            }
        },

        reload () {
            this.load()
        }
    }
  }
</script>
