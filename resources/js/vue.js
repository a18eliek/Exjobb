import Vue from 'vue'
import Hello from './vue/hello.vue'
import VueGoogleCharts from 'vue-google-charts'
import Chart from './vue/chart.vue'

Vue.use(VueGoogleCharts)

const hello = new Vue({
    el: '#vuejs-test',
    components: { Hello },
    template: "<Hello/>"
});

const chart = new Vue({
    el: '#vuejs-chart',
    components: { Chart },
    template: "<Chart/>"
});