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
            <ul class="list-reset">
                <li v-for="item in items" v-bind:key="item.id" class="menu-link">
                    <a v-bind:href="item.route" class="menu-text no-underline text-grey-600 text-sm">{{ item.name }}</a>
                </li>
                <li class="menu-link border-t">
                    <a class="menu-text no-underline text-grey-600 text-sm" :href="logoutRoute" @click.prevent="logout">Logout</a>
                </li>
            </ul>
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
        url: '',
        icon: '',
    },
    data(){
        return{
            showMenu: false,
            logoutRoute: 'http://homenergymanager.test/logout',
            items: [],
        }
    },
    mounted(){
        // console.log(this.url)
        this.load()
    },

    methods: {
        toggleShow(){
            this.showMenu = !this.showMenu;
            // console.log(this.showMenu);  
        },

        logout(){
            document.getElementById('logout-form').submit();
        },

        load(){
            this.fetchData()
                .then(response => {
                    this.fillData(response.data);
                });
        },

        fetchData () {
            return axios.get(this.url)
        },

        fillData(data) {
            Object.keys(data).forEach(key => {
                this.items[key]= data[key];
            })
            // console.log(this.items)
    },
        }
}
</script>

<style scoped>
    .menu{
        @apply w-32 absolute flex flex-col cursor-pointer bg-white rounded shadow-lg mt-6;
        right: -20px;
    }

    .menu-link{
        @apply text-sm font-thin tracking-wide text-grey-700 px-3 py-2 no-underline;
    }
    
    .menu-text:hover{
        @apply text-cyan-600;
    }
</style>