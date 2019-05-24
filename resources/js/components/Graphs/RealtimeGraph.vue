<template>
  <div class="bg-white rounded-md shadow-md">
      <div class="flex justify-between p-2 border-b border-grey-300 mb-2">
          <div>
            <label class="font-semibold text-xs tracking-xwide text-grey-600 ml-2">Consumo de energía </label>
            <!-- <select v-model="day1" @change="reload">
                <option v-for="n in 365">{{ n }}</option>
            </select> -->
          </div>
          <div>
            <label class="font-semibold text-xs tracking-xwide text-grey-600">{{ today }} </label>
            <!-- <select v-model="day2" @change="reload">
                <option v-for="n in 365">{{ n }}</option>
            </select> -->
          </div>
      </div>
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

    data(){
        return{
            today: new Date(),
        }
    },

    created(){
        window.Echo.channel('pv-updated')
            .listen('PvUpdated', event => {
                console.log('graph updated')
                this.reload()
            });
        this.formatDate();
    },
    
    computed: {
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatios: false,
                title: {
                    display: false,
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
                        title: ((tooltipItems, data) => {
                            return tooltipItems[0].label + ':00 h'
                        }),
                        label: ((tooltipItems, data) => {
                            return parseFloat(Math.round(tooltipItems.value * 100) / 100).toFixed(2) + ' ¢ / kWh'
                        }),
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
        formatDate() {
            const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ];
            var year = this.today.getYear() + 1900;
            var month = this.today.getMonth();
            var day = this.today.getDate();

            this.today = day+' de '+monthNames[month]+' de '+year;
            return
        }
    }
  }
</script>
