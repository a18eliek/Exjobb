<template>
	<div>
		<GChart
			:settings="chartSettings"
			type="GeoChart"
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
	name: "GeoChart",
	components: {
		GChart
	},
	methods: {
		onChartReady (chart, google) {
			helpers.timerStart("onChartReady", "geochart.vue" );
			$.ajax({
				type: 'get',
				url: '/data/',
				dataType:"json",
				success: function(response, status, jqXHR) {
					helpers.timerStart("onChartReady->success", "geochart.vue" );
					/* Create the charts after operation succeeded */
					var data = new google.visualization.DataTable(response);

					data.addColumn('string', 'Country');
					data.addColumn('number', 'Total Cases');
					data.addColumn('number', 'Total Deaths');
					// data.addColumn({type: 'string', role: 'tooltip'});

					const dataPoints = Object.keys(response).map(key => [key, response[key]]);
					
					dataPoints.forEach(function(x) {
						data.addRow([x[0], x[1]['totalCases'], x[1]['totalDeaths']]);
					});

					var options = {
						region: '150'
					};

					chart.draw(data, options);
					helpers.timerEnd("onChartReady->success", "geochart.vue" );
				}
			});
			helpers.timerEnd("onChartReady", "geochart.vue" );
		}
	},
	data () {
		return {
			chartSettings: { 
				packages: ['geochart'], 
				mapsApiKey: process.env.MIX_GOOGLE_MAPS_API 
			},
	
			chartData: [
				['Country', 'Count']
			],

			chartOptions: {
				chart: {
					region: '150'
				}
			}
		}
	}
};
</script>