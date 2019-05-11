<template>
  <div>
      <!-- <div class="flex justify-between p-2">
          <div>
            <label>Primer día: </label>
            <select v-model="day1" @change="reload">
                <option v-for="n in 365">{{ n }}</option>
            </select>
          </div>
          <div>
            <label>Segundo día: </label>
            <select v-model="day2" @change="reload">
                <option v-for="n in 365">{{ n }}</option>
            </select>
          </div>
      </div> -->
    <line-chart :height="200" :chart-data="chartData" :options="chartOptions"></line-chart>
  </div>
</template>

<script>
  import LineGraphCompare from './LineGraphCompare.vue'
  export default {
    extends: LineGraphCompare,

    // props: {
    //     day1: { default: 1 },
    //     day2: {default:50}
    // },

    // data(){
    //     return{

    //     }
    // },

    // created(){
    //     window.Echo.channel()
    // },
    
    computed: {
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatios: false,
                title: {
                    display: true,
                    text: 'Consumo de Energía Planificada',
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
                        // scaleLabel: {
                        //     display: true,
                        //     fontSize: 13,
                        //     fontStyle: 'bold',
                        //     labelString: "Costo [¢ / kWh]"
                        // },
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
                        // scaleLabel: {
                        //     display: true,
                        //     fontSize: 13,
                        //     fontStyle: 'bold',
                        //     labelString: "Horas"
                        // },
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

    methods: {
        // fetchData () {
        //     console.log()
        //     return axios.get(this.url, { 
        //         params: {
        //             day1: this.day1,
        //             day2: this.day2
        //         }
        //     })
        // },
    }
  }
</script>
