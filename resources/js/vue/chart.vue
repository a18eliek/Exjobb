<template>
	<div class="text-center">
		<i v-if="!isDoneFetching" class="text-white fas fa-spinner fa-spin"></i>
		<template v-if="isDoneFetching">
			<GChart
				type="ColumnChart"
				:data="dataPoints"
				:options="chartOptions"
			/>
		</template>
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
		fetchData() {
			$.ajax({
				vm: this,
				type: 'get',
				url: '/data/',
				dataType:"json",
				success: function(response) {
					helpers.timerStart("fetchData->success", "chart.vue" );
					
					const chartColumns = { cols: [
						{ type: "string", id: "Country" },
						{ type: "number", label: "Total Cases" },
						{ type: "string", role: "tooltip" },
						{ type: "number", label: "Total Deaths" },
						{ type: "string", role: "tooltip" }
					]};

					const dataPoints = Object.entries(response).map(key => {
						var tooltip = key[1].country + "\nTotal Cases: " + key[1].totalCases + "\nTotal Deaths: " + key[1].totalDeaths;
						return {c: [{v: key[1].country}, {v: key[1].totalCases}, {v: tooltip}, {v: key[1].totalDeaths}, {v: tooltip}]};
					});

					this.vm.dataPoints =  {...chartColumns, ...{ rows: dataPoints } };
					this.vm.isDoneFetching = true;

					helpers.timerEnd("fetchData->success", "chart.vue" );
				}
			});
		},
	},
	created() {
		helpers.timerStart("fetchData", "chart.vue" );
		this.fetchData();
		helpers.timerEnd("fetchData", "chart.vue" );
	},
	data () {
		return {
			isDoneFetching: false,
			dataPoints : null,
			chartSettings: { 
				mapsApiKey: process.env.MIX_GOOGLE_MAPS_API 
			},
			chartData: this.dataPoints,
			chartOptions: {
				legend: { position: 'top'},
				isStacked: 'true',
			}
		}
  	}
};
</script>