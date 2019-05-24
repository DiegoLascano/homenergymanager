<template>
    <div>
        <div v-show="showFlash" class="flash-box px-3 py-2" @click="toggleShow" :class="[backgroundColor, textColor]">
            <h3 class="text-sm">{{ title }}</h3>
            <p class="text-sm">El mensaje es: {{ message }}</p>
        </div>
        <!-- <button @click="toggleShow">Click</button> -->
    </div>
</template>

<script>
export default {
    data(){
        return{
            showFlash: false,
            message: 'message',
            title: 'title',
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
            this.title = event.title;
            this.message = event.message;
            if (event.title == 'error') {
                this.backgroundColor = 'bg-red-100';
                this.textColor = 'text-red-700';
            }else if(event.title == 'success'){
                this.backgroundColor = 'bg-cyan-100';
                this.textColor = 'text-cyan-800';
            }else if(event.title == 'info'){
                this.backgroundColor = 'bg-blue-lighter';
                this.textColor = 'text-blue-darker';
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
        @apply w-64 absolute cursor-pointer;
        right: 24px;
        top: 5rem;
    }
</style>