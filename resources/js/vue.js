import Vue from 'vue'
import vSelect from 'vue-select'
import Hello from './vue/hello.vue'
import VueGoogleCharts from 'vue-google-charts'
import Chart from './vue/chart.vue'
import GeoChart from './vue/geochart.vue'
import Timeline from './vue/timeline.vue'

Vue.use(VueGoogleCharts)
Vue.component('v-select', vSelect)

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

const geochart = new Vue({
    el: '#vuejs-geochart',
    components: { GeoChart },
    template: "<GeoChart/>"
});

const timeline = new Vue({
    el: '#vuejs-timeline',
    components: { Timeline },
    template: "<Timeline/>"
});