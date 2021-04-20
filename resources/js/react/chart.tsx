import { Chart } from "react-google-charts";
import * as React from "react";
import { render } from "react-dom";
import Component from "@reach/component-component";
 

const BarChart = () => {
	return (
		<Component 
			initialState={{dataLoadingStatus: "loading", chartData:[]}}
			didMount = {
				async function(component) {
					helpers.timerStart("didMount", "chart.tsx" );
					$.ajax({
						type: 'get',
						url: '/data/',
						dataType:"json",
						success: function(response, status, jqXHR) {
							helpers.timerStart("didMount->success", "chart.tsx" );

							const chartColumns = [[
								{ type: "string", id: "Country" },
								{ type: "number", label: "Total Cases" },
								{ type: "string", role: "tooltip" },
								{ type: "number", label: "Total Deaths" },
								{ type: "string", role: "tooltip" }
							]];

							const dataPoints = Object.entries(response).map(key => {
								var tooltip = key[1].country + "\nTotal Cases: " + key[1].totalCases + "\nTotal Deaths: " + key[1].totalDeaths;
								return [key[1].country, key[1].totalCases, tooltip, key[1].totalDeaths, tooltip];
							});
							
							component.setState({
								dataLoadingStatus: "ready",
								chartData: chartColumns.concat(dataPoints)
							});

							helpers.timerEnd("didMount->success", "chart.tsx" );
						}
					});
					helpers.timerEnd("didMount", "chart.tsx" );
				}
			}
		>
			{
				(component) => {
					return component.state.dataLoadingStatus === "ready" ? 
					<Chart 
						chartType="ColumnChart"
						data={ component.state.chartData }
						mapsApiKey={process.env.MIX_GOOGLE_MAPS_API}
						options={{
            				isStacked: 'true',
              				legend: { position: 'top', alignment: 'start' },
							tooltip: { isHtml: false }
						}}
					/>
					: <i className="fas fa-spinner fa-spin"></i>
				}
			}
		</Component>
  );
  
};
render(<BarChart />, document.querySelector("#react-chart"));
