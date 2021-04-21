<template>
	<div class="text-center">
		<i v-if="!isDoneFetching" class="text-white fas fa-spinner fa-spin"></i>
		<template v-if="isDoneFetching">
			<GChart
				:settings="chartSettings"
				type="GeoChart"
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
	name: "GeoChart",
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
					helpers.timerStart("fetchData->success", "geochart.vue" );

					const chartColumns = { cols: [
						{ type: "string", label: "Country" },
						{ type: "number", label: "Total Cases" },
						{ type: "number", label: "Total Deaths" }
					]};
					
					const dataPoints = Object.entries(response).map(key => {
						return {c: [{v: key[1].country}, {v: key[1].totalCases}, {v: key[1].totalDeaths}]};
					});

					this.vm.dataPoints = {...chartColumns, ...{ rows: dataPoints } };
			
					this.vm.isDoneFetching = true;

					helpers.timerEnd("fetchData->success", "geochart.vue" );
				}
			});
			
		},
	},
	created() {
		helpers.timerStart("fetchData", "geochart.vue" );
		this.fetchData();
		helpers.timerEnd("fetchData", "geochart.vue" );
	},
	data () {
		return {
			isDoneFetching: false,
			dataPoints: null,
			chartSettings: { 
				packages: ['geochart'], 
				mapsApiKey: process.env.MIX_GOOGLE_MAPS_API 
			},
			chartData: this.dataPoints,
			chartOptions: {
				region: '150'
			}
		}
  	}
};
</script>