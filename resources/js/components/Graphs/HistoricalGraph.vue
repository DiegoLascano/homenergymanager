<template>
  <div class="bg-white rounded-md shadow-md">
      <div class="flex justify-between p-2 border-b border-grey-300 mb-2">
          <div>
            <label class="font-semibold text-xs tracking-xwide text-grey-600 ml-2">{{ title }}</label>
          </div>
          <div>
            <label class="font-semibold text-xs tracking-xwide text-grey-600">{{ today }} </label>
          </div>
      </div>
    <line-chart :height="200" :chart-data="chartData" :options="chartOptions"></line-chart>
  </div>
</template>

<script>
// import LineGraph from './LineGraph.vue'
import LineGraphCompare from './LineGraphCompare.vue'

export default {
    extends: LineGraphCompare,

    props: {
        title: '',
    },

    data() {
        return{
            selectedDate: new Date(),
        }
    },

    created() {
        this.formatDate();
        this.$eventBus.$on('reload-components', (data) => {
            this.selectedDate = data
            this.formatDate()
            this.reload()
        })
    },

    computed: {
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatios: false,
                title: {
                    display: false,
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
                            display: false,
                            fontSize: 13,
                            fontStyle: 'bold',
                            labelString: "Costo [¢ / kWh]"
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
                            display: false,
                            fontSize: 13,
                            fontStyle: 'bold',
                            labelString: "Horas"
                        },
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            // autoSkip: true,
                            maxTicksLimit: 8,
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    callbacks: {
                        title: ((tooltipItems, data) => {
                            return tooltipItems[0].label + ':00 h'
                        }),
                        label: ((tooltipItems, data) => {
                            // console.log(this)
                            // return tooltipItems.yLabel + ' ¢ / kWh'
                            return parseFloat(Math.round(tooltipItems.value * 100) / 100).toFixed(2)
                        })
                    }
                }
            }
        }
    },

    methods: {
        fetchData () {
            return axios.get(this.url, { 
                params: {
                    date: this.selectedDate,
                }
            })
        },

        formatDate() {
            var year = this.selectedDate.getYear() + 1900;
            var month = this.selectedDate.getMonth() + 1;
            var day = this.selectedDate.getDate();
            if (month < 10){
                month = '0' + month
            }
            if (day < 10){
                day = '0' + day
            }
            this.selectedDate = year+'-'+month+'-'+day;
            return
        }
    }
}
</script>
