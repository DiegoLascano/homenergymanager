<template>
    <div class="h-24 flex bg-white rounded-md shadow-md">
        <div class="w-1/4 text-xs m-auto text-center">
            <svg-icon :icon="icon" class="icon-36 -my-1"></svg-icon>
        </div>
        <div class="flex w-3/4">
            <div class="w-1/2 flex flex-col my-auto">
                <div class="text-grey-800 font-semibold text-lg mb-2 font-sans">
                    5,54 <span class="text-grey-800 font-semibold text-sm">kWh</span>
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
        icon: { default: 'icon-dots-horizontal'},
        title: '',
        url: '',
    },

    data() {
        return {
            badge: {
                backgroundColor: 'bg-cyan-100',
                textColor: 'text-cyan-600',
                value: '+2.56 %',
            }
        }
    },

    methods: {
        updateBadge(){
            // edit the badge options properly
        }
    }
}
</script>