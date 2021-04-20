window.onload = function () {
    if (document.getElementById('react-chart')) {
        require('./react/chart.tsx');
    }

    if (document.getElementById('react-geochart')) {
        require('./react/geochart.tsx');
    }
};