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
					$.ajax({
						type: 'get',
						url: 'http://127.0.0.1:8000/data',
						dataType:"json",
						success: function(response, status, jqXHR) {
							const dataPoints = Object.keys(response).map(key => [key, response[key]]);
							const chartData = [["Country", "Value"]];

							component.setState({
								dataLoadingStatus: "ready",
								chartData: chartData.concat(dataPoints)
							});
						}
					});
				}
			}
		>
			{
				(component) => {
					return component.state.dataLoadingStatus==="ready" ?
					<Chart 
						chartType="GeoChart"
						data={component.state.chartData}
						mapsApiKey={{ key: process.env.GOOGLE_MAP_KEY }}
						options={{
							title:"GeoChart"
						}}
					/>
					: <i className="fas fa-spinner fa-spin"></i>
				}
			}
		</Component>
  );
};
render(<GeoChart />, document.querySelector("#react-geochart"));
