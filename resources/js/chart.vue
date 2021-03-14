<template>
  <div>
    <GChart
      type="ColumnChart"
      :data="chartData"
      :options="chartOptions"
    />
  </div>
</template>
<script>

const default_layout = "default";
import { GChart } from 'vue-google-charts'

export default {
  computed: {},
   components: {
    GChart
  },
 data () {
    return {
      // Array will be automatically processed with visualization.arrayToDataTable function
      chartData: [
        ['Year', '1', '2', '3'],
        ['2019', 1000, 400, 200],
        ['2020', 1170, 460, 250],
        ['2021', 660, 1120, 300]
      ],
      chartOptions: {
        chart: {
          title: 'Vue.js Google Chart test'
        }
      }
    }
  }
};
</script>