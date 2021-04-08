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
	name: "Timeline",
	components: {
		GChart
	},
	methods: {
		onChartReady (chart, google) {
			helpers.timerStart("onChartReady", "chart.vue" );
			$.ajax({
				type: 'get',
				url: '/data/sweden',
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
					data.addColumn('number', 'Total ICU');
					data.addColumn({type: 'string', role: 'tooltip'});
					
					// Reverse the data for a better looking chart
					response.daily = helpers.reverseObject(response.daily);	
					
					// Save first date for exclusion due to it being incorrect
					let [firstDate] = Object.keys(response.daily)

					Object.entries(response.daily).forEach(([date, x]) => {
						var icu = (x.icu == null) ? "No data" : x.icu;
						var tooltip = response.country + ": " + date + "\nTotal Cases: " + x.cases + "\nTotal Deaths: " + x.deaths + " \nTotal ICU: " + icu;
						if(date != firstDate) { 
							data.addRow([date, x.cases, tooltip, x.deaths, tooltip, x.icu, tooltip]);
						}
					});

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