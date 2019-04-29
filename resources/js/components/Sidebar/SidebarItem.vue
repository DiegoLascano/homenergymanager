<template>
    <div>
        <a href="#" class="sidebar-link">
            <svg-icon :icon="icon" class="icon-24 -my-1"></svg-icon>
            <slot></slot>
        </a>
    </div>
</template>

<script>
import SvgIcon from './../SvgIcon.vue';
export default {
    components: {
        SvgIcon
    },
    props: {
        icon:'',
        name: {required: true},
        selected: {default: false}
        // url: '',
    },

    mounted(){
        // console.log('sidebar-link mounted')
        // console.log(this.icon)
    }
}
</script>