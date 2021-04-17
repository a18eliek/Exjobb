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
				url: '/data/',
				dataType:"json",
				success: function(response, status, jqXHR) {
					helpers.timerStart("onChartReady->success", "chart.vue" );
					/* Create the charts after operation succeeded */
					var data = new google.visualization.DataTable(response);

					data.addColumn('string', 'Country');
					data.addColumn('number', 'Total Cases');
					data.addColumn({type: 'string', role: 'tooltip'});
					data.addColumn('number', 'Total Deaths');
					data.addColumn({type: 'string', role: 'tooltip'});

					const dataPoints = Object.entries(response).map(key => {
						var tooltip = key[1].country + "\nTotal Cases: " + key[1].totalCases + "\nTotal Deaths: " + key[1].totalDeaths;
						return [key[1].country, key[1].totalCases, tooltip, key[1].totalDeaths, tooltip];
					});

					data.addRows(dataPoints);

					var options = {
						isStacked: 'true',
						legend: { position: 'top', alignment: 'start' }
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
			chartSettings: { 
				mapsApiKey: process.env.MIX_GOOGLE_MAPS_API 
			},
			chartData: [
				['Country', 'Value'], [0, 0]
			],
			chartOptions: {
				legend: { position: 'none'}
			}
		}
  }
};
</script>