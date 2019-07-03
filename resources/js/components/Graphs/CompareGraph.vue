<template> 
  <div>
        <div class="flex flex-col md:flex-row justify-between items-center p-2 border-b border-grey-300 mb-2">
            <label class="font-semibold text-xs tracking-xwide text-grey-600 ml-2">{{ title }}</label>
            <div class="md:flex">
                <div class="md:flex my-1 md:my-0 mx-0 md:mx-1">
                    <!-- <label class="text-sm text-grey-600">Primer día: </label> -->
                    <datepicker v-model = "datepicker.date2"
                            :open-date = "datepicker.date2" 
                            input-class = "w-full md:w-24 bg-grey-050 rounded p-1 text-xs hover:text-white cursor-pointer hover:bg-cyan-600 text-grey-700 text-center" 
                            calendar-class = "shadow-lg text-sm -ml-20 md:-ml-10"
                            @input = "reload" 
                            wrapper-class = "flex-1">
                    </datepicker>
                </div>
                <div class="md:flex my-1 md:my-0 mx-0 md:mx-1">
                    <!-- <label class="text-sm text-grey-600">Segundo día: </label> -->
                    <datepicker v-model = "datepicker.date1"
                            :open-date = "datepicker.date1" 
                            input-class = "w-full md:w-24 rounded bg-grey-050 p-1 text-xs hover:text-white cursor-pointer hover:bg-cyan-600 text-grey-700 text-center" 
                            calendar-class = "shadow-lg text-sm -ml-20 md:-ml-10"
                            @input = "reload" 
                            wrapper-class = "flex-1">
                    </datepicker>
                </div>
            </div>
        </div>
        <line-chart :height="200" :chart-data="chartData" :options="chartOptions"></line-chart>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import LineGraphCompare from './LineGraphCompare.vue'
export default {
    extends: LineGraphCompare,

    components: {
        Datepicker,
    },
    props: {
        title: '',
    },

    data() {
        return{
            datepicker: {
                // disabledDates: {
                //     to: new Date(2019, 3, 20),
                //     from: new Date(), //today
                // },
                date1: new Date(),
                date2: new Date(),
            },
            // days: {
            //     today: new Date(),
            //     yesterday: new Date(),
            // },
            // selectedDate: '',
            selectedDate1: new Date(),
            selectedDate2: new Date(),
        }
    },

    created() {
        this.formatDateOne();
        this.formatDateTwo();
        // this.$eventBus.$on('reload-components', (data) => {
        //     this.selectedDate = data
        //     this.formatDate()
        //     this.reload()
        // })
    },

    computed: {
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatios: false,
                // title: {
                //     display: true,
                //     text: 'Energía Generada',
                //     fontSize: 14,
                //     fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                //     padding: 10,
                // },  
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
                        title: ((tooltipItems, data) => {
                            return tooltipItems[0].label + ':00 h'
                        }),
                        label: ((tooltipItems, data) => {
                        // console.log(this)
                            return parseFloat(Math.round(tooltipItems.value * 100) / 100).toFixed(2)
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
                    date2: this.selectedDate1,
                    date1: this.selectedDate2,
                }
            })
        },
        formatDate(date) {
            var year = date.getYear() + 1900;
            var month = date.getMonth() + 1;
            var day = date.getDate();
            if (month < 10){
                month = '0' + month
            }
            if (day < 10){
                day = '0' + day
            }
            date = year+'-'+month+'-'+day;
            return date;
        },

        formatDateOne(){
            this.selectedDate1 = this.formatDate(this.datepicker.date1);
            // console.log(this.selectedDate1);
        },

        formatDateTwo(){
            this.selectedDate2 = this.formatDate(this.datepicker.date2);
            // console.log(this.selectedDate2);
        },

        reload(){
            this.formatDateOne();
            this.formatDateTwo();
            this.load();
        }
    }
}
</script>
