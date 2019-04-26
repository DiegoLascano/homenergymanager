<template>
    <div>
        <button @click="toggleShow" class="text-grey-700 no-underline tracking-wide text-sm block md:hidden hover:text-cyan-600">
            <slot></slot>
        </button>
        <!-- <div v-show="showMenu" class="menu">
            <a v-for="item in items" @click.prevent="logout" v-bind:href="url" class="menu-link">
                {{ item }}
            </a>
        </div> -->
    </div>
</template>

<script>
export default {
    props:{
        // items: [],
        // url: '',
        icon: '',
    },
    data(){
        return{
            showMenu: false,
        }
    },
    mounted(){
        console.log(this.icon)
    },
    methods: {
        toggleShow(){
            this.showMenu = !this.showMenu;
            console.log(this.showMenu);
        },
    },
}
</script>

<style scoped>
    .menu{
        @apply w-32 absolute flex flex-col cursor-pointer bg-white rounded shadow-lg mt-6;
    }

    .menu-link{
        @apply text-sm font-thin tracking-wide text-grey-700 p-2 no-underline;
    }
    .menu-link:hover{
        @apply text-cyan-600;
    }
    
</style>