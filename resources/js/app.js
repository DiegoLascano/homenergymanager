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
Vue.component('card-component', require('./components/Cards/Card.vue').default);
Vue.component('line-graph', require('./components/Graphs/LineGraph.vue').default);
Vue.component('cost-graph', require('./components/Graphs/CostGraph.vue').default);
Vue.component('pv-graph', require('./components/Graphs/PVGraph.vue').default);
Vue.component('consumption-graph', require('./components/Graphs/ConsumptionGraph.vue').default);
Vue.component('dropdown-button', require('./components/DropdownButton.vue').default);
Vue.component('sidebar-button', require('./components/SidebarButton.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});
// var app = new Vue({
//     el: '#root1',
//     data: {
//         newName: '',
//         names: ['Uno', 'Dos']
//     },
//     mounted(){
//         console.log('mounted')
//     },
//     methods: {
//         addName() {
//             this.names.push(this.newName);
//             this.newName = '';
//         }
//     }
// });

// const dropdownTest = new Vue({
//     el: '#dropdown-test',
//     components: {
//         'dropdown-component': dropdown,
//     },
//     data: {
//         count: 0,
//         activeInstrument: 'Piano',
//         instruments: [
//             'Piano',
//             'Acoustic Guitar',
//             'Drums',
//             'Trumpet'
//         ]
//     },
//     methods: {
//         changeInstrument: function(instrument) {
//             this.activeInstrument = instrument;
//         }
//     }
// });

// const vm = new Vue({
//     el: '#components-demo',
//     components: {
//         'button-counter': buttonCounter,
//         'dropdown2-component': dropdown,
//     },
//     data: {
//         count: 0,
//         activeInstrument: 'Piano',
//         instruments: [
//             'Piano',
//             'Acoustic Guitar',
//             'Drums',
//             'Trumpet'
//         ]
//     },
//     methods: {
//         changeInstrument: function(instrument) {
//             this.activeInstrument = instrument;
//         }
//     }
// });


// const vm = new Vue({
//     el: '#dropdown',
//     components: {
//         'dropdown2-component': dropdown,
//     },
//     data: {
// 		activeInstrument: 'Piano',
// 		instruments: [
// 			'Piano',
// 			'Acoustic Guitar',
// 			'Drums',
// 			'Trumpet'
// 		]
// 	},
// 	methods: {
// 		changeInstrument: function(instrument) {
// 			this.activeInstrument = instrument;
// 		}
// 	}
// })