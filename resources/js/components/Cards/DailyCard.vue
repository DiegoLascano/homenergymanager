<template>
    <div class="h-24 flex bg-white rounded-md">
        <div class="w-1/4 text-xs m-auto text-center">
            <svg-icon :icon="icon" class="icon-36 -my-1"></svg-icon>
        </div>
        <div class="flex w-3/4">
            <div class="w-1/2 flex flex-col my-auto">
                <div class="text-grey-800 font-semibold text-lg mb-2 font-sans">
                    {{ value }} <span class="text-grey-800 font-semibold text-sm">{{ unit }}</span>
                </div>
                <div class="text-grey-600 text-xs">
                    {{ title }}
                </div>
            </div>
            <div class="flex items-center w-1/2">
                <div :class="badge.textColor" class="text-xs mx-auto text-center">
                    <p :class="badge.backgroundColor" class="rounded-full py-1 px-2 font-semibold">{{ badge.value }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from './../SvgIcon.vue';
export default {
    components: {
        SvgIcon,
    },

    props: {
        icon: { default: 'icon-dots-horizontal' },
        url: '',
    },

    data() {
        return {
            title: 'no title',
            value: 'No data',
            unit: '',
            badge: {
                backgroundColor: 'bg-cyan-100',
                textColor: 'text-cyan-600',
                value: 'No data',
            }
        }
    },

    created(){
        window.Echo.channel('pv-updated')
            .listen('PvUpdated', event => {
                this.reload()
            });
    },

    mounted(){
        this.load()
    },

    methods: {
        load(){
            this.fetchData()
                .then(response => {
                    this.fillCard(response.data);
                });
        },

        fetchData () {
            return axios.get(this.url)
        },

        fillCard(data){
            if (data == null) {
                this.title = 'No Data';
                this.value = 'No Data';
                this.unit = 'No Data';
            } else {
                this.title = data.title;
                this.value = parseFloat(Math.round(data.value * 100) / 100).toFixed(2);
                this.unit = data.unit;
            }
        },

        reload(){
            this.load()
        }
    }
}
</script>