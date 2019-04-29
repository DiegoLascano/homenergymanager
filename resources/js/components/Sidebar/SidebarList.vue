<template>
    <div>
        <div class="sidebar-list">
            <ul>
                <li v-for="item in items">
                    <!-- <svg-icon :icon="item.icon" class="icon-24 -my-1"></svg-icon> -->
                    {{ item.name }}
                </li>
            </ul>
        </div>
        <div v-show="false">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import SvgIcon from './../SvgIcon.vue';
export default {
    components:{
        SvgIcon,
    },
    data(){
        return{
            items: [],
        }
    },
    created(){
        this.items = this.$children;
    },
    mounted() {
        console.log(this.$children);
    },
}
</script>