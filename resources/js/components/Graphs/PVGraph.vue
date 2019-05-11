<template>
  <div>
      <!-- <div class="flex justify-between p-2"> -->
          <!-- <div>
            <label>Primer día: </label>
            <select v-model="day1" @change="reload">
                <option v-for="n in 365">{{ n }}</option>
            </select>
          </div> -->
          <!-- <div>
            <label v-text="selectedDate"></label>
          </div>
          <div>
            <label>Segundo día: </label>
            <select v-model="day2" @change="reload">
                <option v-for="n in 365">{{ n }}</option>
            </select>
          </div> -->
      <!-- </div> -->
    <line-chart :height="200" :chart-data="chartData" :options="chartOptions"></line-chart>
  </div>
</template>

<script>
  import LineGraph from './LineGraph.vue'
  export default {
    extends: LineGraph,

    // props: {
    //     date: { default: 1 },
    // },

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
                    display: true,
                    text: 'Energía Generada',
                    fontSize: 14,
                    fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                    padding: 10,
                },  
                legend: {
                    display: true,
                    position: 'top',
                    // labels: {
                    //     fontColor: 'rgb(255, 99, 132)'
                    // }
                },
                scales: { 
                    yAxes: [{
                        scaleLabel: {
                            display: false,
                            fontSize: 13,
                            fontStyle: 'bold',
                            labelString: "Potencia [kWh]"
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
                        // type: 'time',
                        // time: {
                        //     unit: 'hour',
                        // },
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
                        label: ((tooltipItems, data) => {
                        // console.log(this)
                        return tooltipItems.yLabel + 'kWh'
                        })
                    }
                }
            }
        }
    },

    methods: {
        fetchData () {
            // console.log('fetching data')
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
