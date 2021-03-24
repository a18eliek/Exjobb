<template>
	<div>
		<GChart
			type="ColumnChart"
			:data="chartData"
			:options="chartOptions"
			@ready="onChartReady"
		/>
	</div>
</template>
<script>

const default_layout = "default";
import { GChart } from 'vue-google-charts'

export default {
	name: "Chart",
	components: {
		GChart
	},
	methods: {
		onChartReady (chart, google) {
			helpers.timerStart("onChartReady", "chart.vue" );
			$.ajax({
				type: 'get',
				url: 'http://127.0.0.1:8000/data',
				dataType:"json",
				success: function(response, status, jqXHR) {
					helpers.timerStart("onChartReady->success", "chart.vue" );
					/* Create the charts after operation succeeded */
					var data = new google.visualization.DataTable(response);

					data.addColumn('string', 'Country');
					data.addColumn('number', 'Count');

					const dataPoints = Object.keys(response).map(key => [key, response[key]]);
					data.addRows(dataPoints);

					var options = {
						title:'GeoChart Test'
					};

					chart.draw(data, options);
					helpers.timerEnd("onChartReady->success", "chart.vue" );
				}
			});
			helpers.timerEnd("onChartReady", "chart.vue" );
		}
	},
	data () {
		return {
			chartData: [
				['Country', 'Value'], [0, 0]
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