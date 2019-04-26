<template>  
    <div class="inline-block" v-html="require('!!html-loader!./../../svg/' + this.icon + '.svg')"></div>
    <!-- <div class="inline-block" v-html="require('icon-' + this.icon + '.svg')"></div> -->
</template>

<script>  
export default {  
    props: ['icon'],

    mounted() {
        this.$el.firstChild.classList.add(this.$style.svg)
        this.$el.firstChild.removeAttribute('height')
        this.$el.firstChild.removeAttribute('width')
    }
}
</script>  

<style module>  
.svg {
    fill: currentColor;
    height: 2em;
    margin-top: -4px;
    vertical-align: middle;
    width: 2em;
}

</style>