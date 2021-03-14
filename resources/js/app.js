import Vue from 'vue'
import VueGoogleCharts from 'vue-google-charts'
Vue.use(VueGoogleCharts)

require('./bootstrap');

require('alpinejs');
require('./hello.tsx');

import Hello from './hello.vue'

const hello = new Vue({
    el: '#vuejs-test',
    components: { Hello }
});


import Chart from './chart.vue'

const chart = new Vue({
    el: '#vuejs-chart',
    components: { Chart }
});