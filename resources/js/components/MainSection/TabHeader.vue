<template>
    <div>
        <div class="tabs-header">
            <ul class="list-reset md:flex">
                <li v-for="item in items" class="tab-name" :class="{'is-active':item.isActive}">
                    <a :href="item.href" @click="selectItem(item)" class="no-underline text-grey-700 hover:text-cyan-600">
                        {{ item.name }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content bg-grey-050">
        <!-- <div class="tab-content p-2"> -->
            <slot></slot>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
export default {
        components:{
            Datepicker
        },
    data(){
        return{
            items: [],
        }
    },

    created(){
        this.items = this.$children
    },

    methods: {
        selectItem(selectedItem){
            this.items.forEach( item =>
                item.isActive = (item.name == selectedItem.name)
            )
        }
    },
}
</script>