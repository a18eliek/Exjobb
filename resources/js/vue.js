import Vue from 'vue'
import vSelect from 'vue-select'
import VueGoogleCharts from 'vue-google-charts'
import Chart from './vue/chart.vue'
import GeoChart from './vue/geochart.vue'
import Timeline from './vue/timeline.vue'

Vue.use(VueGoogleCharts)
Vue.component('v-select', vSelect)

window.onload = function () {
    var chart = document.getElementById('vuejs-chart');
    if (chart) {
        const chart = new Vue({
            el: '#vuejs-chart',
            components: { Chart },
            template: "<Chart/>"
        });
    }

    var geochart = document.getElementById('vuejs-geochart');
    if (geochart) {
        const geochart = new Vue({
            el: '#vuejs-geochart',
            components: { GeoChart },
            template: "<GeoChart/>"
        });
    }

    var timeline = document.getElementById('vuejs-timeline');
    if (timeline) {
        const timeline = new Vue({
            el: '#vuejs-timeline',
            components: { Timeline },
            template: "<Timeline/>"
        });
    }
};