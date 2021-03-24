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
			$.ajax({
				type: 'get',
				url: 'http://127.0.0.1:8000/data',
				dataType:"json",
				success: function(response, status, jqXHR) {
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
				}
			});
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
					title: 'GeoChart Test'
				}
			}
		}
	}
};
</script>