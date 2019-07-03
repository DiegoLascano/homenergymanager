<template>
    <div class="my-3">
        <div class = "md:flex justify-between items-end md:px-3">
            <div class = "flex flex-col font-sans text-grey-700">
                <p class = "text-2xl mb-3">{{ headerTitle }}</p>
                <p class = "text-md">{{ headerMessage }}</p>
            </div>
            <div v-show="showCalendar" class="flex flex-col">
                <div class="datepicker-container flex flex-1 font-sans text-lg text-grey-700 md:p-3 mt-3 md:mt-0">
                    <datepicker :disabledDates = "datepicker.disabledDates" 
                                v-model = "datepicker.date"
                                :open-date = "datepicker.date" 
                                input-class = "w-full md:w-56 rounded p-1 text-sm hover:text-white hover:bg-cyan-600 cursor-pointer text-grey-700 text-center" 
                                calendar-class = "shadow-lg text-sm md:-ml-10"
                                @input = "reload" 
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

    props: {
        headerTitle: '',
        headerMessage: '',
        showCalendar: { default:false },
    },

    data(){
        return{
            datepicker: {
                disabledDates: {
                    from: new Date(), //today
                    to: new Date(2019, 4, 31),
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
        reload(){
            // this.selectedDate = this.datepicker.date
            this.$eventBus.$emit('reload-components', this.datepicker.date)
        }
    }
}
</script>