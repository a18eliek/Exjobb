import Vue from 'vue'
import VueGoogleCharts from 'vue-google-charts'
import Chart from './vue/chart.vue'
import GeoChart from './vue/geochart.vue'
import Timeline from './vue/timeline.vue'

Vue.use(VueGoogleCharts);

window.onload = function () {
    if (document.getElementById('vuejs-chart')) {
        const chart = new Vue({
            el: '#vuejs-chart',
            components: { Chart },
            template: "<Chart/>"
        });
    }

    if (document.getElementById('vuejs-geochart')) {
        const geochart = new Vue({
            el: '#vuejs-geochart',
            components: { GeoChart },
            template: "<GeoChart/>"
        });
    }

    if (document.getElementById('vuejs-timeline')) {
        const timeline = new Vue({
            el: '#vuejs-timeline',
            components: { Timeline },
            template: "<Timeline/>"
        });
    }
};