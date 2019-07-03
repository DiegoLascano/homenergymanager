<template>
    <transition name="slide-fade">
        <div v-show="show">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
export default {
    data(){
        return{
            show: true,
        }
    },

    created(){
        this.$eventBus.$on('toggle-sidebar', (data) => {
            this.toggleShow()
        })
    },

    methods: {
        toggleShow(){
            this.show = !this.show;
        }
    },
}
</script>

<style scoped>
    .slide-fade-enter-active {
        transition: all .6s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s linear;
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateY(-100px);
        opacity: 0;
    }
</style>