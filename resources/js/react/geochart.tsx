import { Chart } from "react-google-charts";
import * as React from "react";
import { render } from "react-dom";
import Component from "@reach/component-component";

const GeoChart = () => {
	return (
		<Component 
			initialState={{dataLoadingStatus: "loading", chartData:[]}}
			didMount = {
				async function(component) {
					helpers.timerStart("didMount", "geochart.tsx" );
					$.ajax({
						type: 'get',
						url: '/data/',
						dataType:"json",
						success: function(response, status, jqXHR) {
							helpers.timerStart("didMount->success", "geochart.tsx" );

							const chartData = [["Country", "Total Cases", "Total Deaths"]];
							const dataPoints = Object.entries(response).map(key => {
								return [key[1].country, key[1].totalCases, key[1].totalDeaths];
							});
							
							component.setState({
								dataLoadingStatus: "ready",
								chartData: chartData.concat(dataPoints)
							});

							helpers.timerEnd("didMount->success", "geochart.tsx" );
						}
					});
					helpers.timerEnd("didMount", "geochart.tsx" );
				}
			}
		>
			{
				(component) => {
					return component.state.dataLoadingStatus==="ready" ? 
					<Chart 
						chartType="GeoChart"
						data={component.state.chartData}
						mapsApiKey={process.env.MIX_GOOGLE_MAPS_API}
						options={{
							title:"GeoChart",
							region: "150"
						}}
					/>
					: <i className="fas fa-spinner fa-spin"></i>
				}
			}
		</Component>
  );
  
};
render(<GeoChart />, document.querySelector("#react-geochart"));
