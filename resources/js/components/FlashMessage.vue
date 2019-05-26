<template>
    <div>
        <transition name="slide-fade">
            <div v-show="showFlash" class="flash-box w-1/2 md:w-1/3 lg:w-1/4 px-3 py-2" @click="toggleShow" :class="[backgroundColor, textColor]">
                <!-- <h3 class=" text-xs uppercase tracking-wide p-1">{{ title }}</h3> -->
                <p class="text-sm px-3 py-2">{{ message }}</p>
            </div>
        </transition>
        <!-- <button @click="toggleShow">Click</button> -->
    </div>
</template>

<script>
export default {
    data(){
        return{
            showFlash: false,
            message: 'message',
            // title: 'title',
            backgroundColor: 'bg-red-100',
            textColor: 'text-red-700',
        }
    },

    created(){
        window.Echo.channel('flash-message')
            .listen('FlashMessage', event => {
                // console.log(event)
                this.fillData(event)
                this.toggleShow();
        });
    },

    methods: {
        fillData(event){
            // console.log(event);
            this.message = event.message;
            if (event.title == 'error') {
                // this.title = 'Error';
                this.backgroundColor = 'bg-red-100';
                this.textColor = 'text-red-700';
            }else if(event.title == 'success'){
                // this.title = 'Success';
                this.backgroundColor = 'bg-teal-lighter';
                this.textColor = 'text-teal-darker';
            }else if(event.title == 'info'){
                // this.title = 'New event';
                this.backgroundColor = 'bg-yellow-300';
                this.textColor = 'text-yellow-800';
            }
        },

        toggleShow(){
            this.showFlash = !this.showFlash;
        }
    }
}
</script>

<style scoped>
    .flash-box{
        @apply absolute cursor-pointer rounded shadow-lg;
        right: 24px;
        top: 5rem;
        transition: 2s;
    }
    .slide-fade-enter-active {
        transition: all .4s ease;
    }
    .slide-fade-leave-active {
        transition: all .1s linear;
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(150px);
        opacity: 0;
    }
</style>