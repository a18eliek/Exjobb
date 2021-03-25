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
			helpers.timerStart("onChartReady", "timeline.vue" );

			$.ajax({
				type: 'get',
				url: "http://127.0.0.1:8000/data/swe",
				dataType: "json",
			}).done(function (jsonData) {
					helpers.timerStart("onChartReady->success", "timeline.vue" );
					// Create the charts after operation succeeded 
					var data = new google.visualization.DataTable(jsonData);
					data.addColumn('string', 'Country');
					data.addColumn('number', 'Weekly ' + jsonData['indicator']);
					data.addColumn('number', 'Total '  + jsonData['indicator']);
					data.addColumn({type: 'string', role: 'tooltip'});

					const dataPoints = Object.keys(jsonData['data']).map(key => [key, jsonData['data'][key]]);

					dataPoints.forEach(function(x) {
						var tooltip = x[1]['start'] + ' - ' + x[1]['end'] + '\nWeekly ' + jsonData['indicator'] + ': ' + x[1]['weekly'] + '\nTotal '  + jsonData['indicator'] + ': ' + x[1]['cumulative'];
						data.addRow([x[1]['start'] + ' - ' + x[1]['end'], x[1]['weekly'], x[1]['cumulative'], tooltip]);
					})

					var options = {
						title: jsonData['country'] + ' - ' + jsonData['source'],
						isStacked: true,
						legend: { position: 'top', maxLines: 3 },
        				bar: { groupWidth: '75%' },
					};

					chart.draw(data, options);
					helpers.timerEnd("onChartReady->success", "timeline.vue" );
			}).fail(function (jq, text, err) {
				console.log(text + ' - ' + err);
			});

			helpers.timerEnd("onChartReady", "timeline.vue" );
		}
	},
	data () {
		return {
			chartData: [
				['Country', 'Weekly', 'Total'], [0, 0, 0]
			],
			chartOptions: {
				legend: 'none',
			}
		}
  }
};
</script>