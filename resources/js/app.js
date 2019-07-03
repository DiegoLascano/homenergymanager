/**
 * Imports
 */

// For Chart.js
import Chart from 'chart.js';
window.Chart = Chart;

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('line-graph', require('./components/Graphs/LineGraph.vue').default);
// Vue.component('linegraph-compare', require('./components/Graphs/LineGraphCompare.vue').default);
Vue.component('historical-graph', require('./components/Graphs/HistoricalGraph.vue').default);
Vue.component('pv-graph', require('./components/Graphs/PVGraph.vue').default);
Vue.component('consumption-graph', require('./components/Graphs/ConsumptionGraph.vue').default);
Vue.component('realtime-graph', require('./components/Graphs/RealtimeGraph.vue').default);
Vue.component('compare-graph', require('./components/Graphs/CompareGraph.vue').default);

Vue.component('user-control', require('./components/UserControlButton.vue').default);
Vue.component('sidebar-button', require('./components/SidebarButton.vue').default);
Vue.component('svg-icon', require('./components/SvgIcon.vue').default);
Vue.component('sidebar-item', require('./components/Sidebar/SidebarItem.vue').default);
// Vue.component('sidebar-list', require('./components/Sidebar/SidebarList.vue').default);
Vue.component('main-header', require('./components/MainSection/MainHeader.vue').default);
Vue.component('tab-header', require('./components/MainSection/TabHeader.vue').default);
Vue.component('tab-content', require('./components/MainSection/TabContent.vue').default);
Vue.component('daily-card', require('./components/Cards/DailyCard.vue').default);
Vue.component('daily-cost', require('./components/Cards/CostCard.vue').default);
Vue.component('daily-savings', require('./components/Cards/SavingsCard.vue').default);
Vue.component('daily-energy', require('./components/Cards/EnergyCard.vue').default);
Vue.component('historical-card', require('./components/Cards/HistoricalCard.vue').default);
Vue.component('historical-cost', require('./components/Cards/HistoricalCostCard.vue').default);
Vue.component('historical-savings', require('./components/Cards/HistoricalSavingsCard.vue').default);
Vue.component('historical-energy', require('./components/Cards/HistoricalEnergyCard.vue').default);
// Vue.component('daily-cost', require('./components/Cards/DailyCost.vue').default);

Vue.component('flash-message', require('./components/FlashMessage.vue').default);

Vue.component('pv-input', require('./components/PVreal/pvInput.vue').default);

Vue.component('sidebar-menu', require('./components/Sidebar/Sidebar.vue').default);

Vue.prototype.$eventBus = new Vue()

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});