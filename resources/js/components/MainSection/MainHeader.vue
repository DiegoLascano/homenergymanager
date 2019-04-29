<template>
    <div>
        <div class = "md:flex justify-between items-end md:mb-4">
            <div class = "flex flex-col font-sans text-grey-700 p-3">
                <p class = "text-2xl mb-3">Welcome back, Diego</p>
                <p class = "text-md">Datos Historicos</p>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-1 font-sans text-lg text-grey-700 p-3">
                    <datepicker :disabledDates = "datepicker.disabledDates" 
                                v-model = "datepicker.date"
                                :open-date = "datepicker.date" 
                                input-class = "w-full md:w-56 rounded p-1 text-sm text-grey-700 text-center" 
                                calendar-class = "shadow-lg text-sm md:-ml-10"
                                @input = "dateChanged" 
                                wrapper-class = "flex-1">
                    </datepicker>
                    <div class = "ml-3">
                        <svg-icon icon = "icon-calendar" class="icon-24 icon-calendar"></svg-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import SvgIcon from './../SvgIcon.vue';

export default {
    components: {
        Datepicker,
        SvgIcon
    },

    data(){
        return{
            datepicker: {
                disabledDates: {
                    from: new Date(), //today
                },
                date: new Date()
            },
            days: {
                today: new Date(),
                yesterday: new Date(),
            },
            selectedDate: '',
        }
    },

    mounted(){
        this.days.yesterday.setDate(this.days.today.getDate()-1);
        this.datepicker.date = this.days.yesterday;
        this.datepicker.disabledDates.from = this.days.yesterday;
        // console.log(this.date.today)
        // console.log(this.date.yesterday)
    },

    methods: {
        dateChanged(){
            this.selectedDate = this.datepicker.date
        }
    }
}
</script>