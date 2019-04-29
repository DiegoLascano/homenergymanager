<template>
    <div>
        <button @click="toggleShow" :class="{'is-Active': showMenu}" class="flex items-center text-grey-700 no-underline tracking-wide text-sm hover:text-cyan-600">
            <svg-icon :icon="icon" class="icon-36 -my-1 mr-1"></svg-icon>
            <div class="hidden md:block" :class="{'text-cyan-600': showMenu}">
                <slot></slot>
            </div>
            <svg-icon icon="icon-cheveron-down" class="icon-24 icon-cheveron-down -my-1 mr-1"></svg-icon>
        </button>
        <div v-show="showMenu" class="menu">
            <a v-for="item in items" @click.prevent="logout" v-bind:href="url" class="menu-link">
                {{ item }}
            </a>
        </div>
    </div>
</template>

<script>
import SvgIcon from './SvgIcon.vue';

export default {
    components: {
        SvgIcon,
    },
    props:{
        items: [],
        url: '',
        icon: '',
    },
    data(){
        return{
            showMenu: false,
        }
    },
    mounted(){
        // console.log('Dropdown Button Mounted')
    },
    methods: {
        toggleShow(){
            this.showMenu = !this.showMenu;
            // console.log(this.showMenu);  
        },
        logout(){
            document.getElementById('logout-form').submit();
        }
    },
}
</script>

<style scoped>
    .menu{
        @apply w-32 absolute flex flex-col cursor-pointer bg-white rounded shadow-lg mt-6;
        right: -20px;
    }

    .menu-link{
        @apply text-sm font-thin tracking-wide text-grey-700 p-2 no-underline;
    }
    .menu-link:hover{
        @apply text-cyan-600;
    }
</style>