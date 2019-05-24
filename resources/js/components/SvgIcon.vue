<template>  
    <!-- <div v-html="require('!!html-loader!./../../svg/' + this.icon + '.svg')" v-once></div> -->
    <div class="inline-block" v-html="require('!!html-loader!./../../svg/' + this.icon + '.svg')" v-once></div>
</template>

<script>  
export default {  
    props: ['icon', 'addClass'],

    mounted() {
        // these are the original code lines
        // this.$el.firstChild.classList.add(this.$style.svg)
        // this.$el.firstChild.removeAttribute('height')
        // this.$el.firstChild.removeAttribute('width')

        // these are edited code lines to accept classes
        this.$el.removeAttribute('class');
        this.$el.firstChild.classList.add(...this.$vnode.data.staticClass.split(' '));
        this.$el.outerHTML = this.$el.innerHTML;
    }
}
</script>  

<style module>  
.svg {
    fill: currentColor;
    height: 1em;
    margin-top: -4px;
    vertical-align: middle;
    width: 1em;
}

</style>