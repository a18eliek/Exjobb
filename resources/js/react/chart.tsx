import * as React from "react";
import { render } from "react-dom";
import { Chart } from "react-google-charts";
 
export default class ReactChart extends React.Component {
  render() {
    return (
        <Chart
        chartType="ColumnChart"
        data={[
                ['Year', '1', '2', '3'],
                ['2019', 1000, 400, 200],
                ['2020', 1170, 460, 250],
                ['2021', 660, 1120, 300]
            ]}
        legendToggle
        />
    );
  }
}
render(<ReactChart />, document.querySelector("#react-chart"));