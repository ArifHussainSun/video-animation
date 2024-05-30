

var radialoptions2 = {
    series: [72],
    chart: { type: "radialBar", width: 60, height: 60, sparkline: { enabled: !0 } },
    dataLabels: { enabled: !1 },
    colors: ["#34c38f"],
    plotOptions: { radialBar: { hollow: { margin: 0, size: "60%" }, track: { margin: 0 }, dataLabels: { show: !1 } } },
},
radialchart2 = new ApexCharts(document.querySelector("#radialchart-2"), radialoptions2);
radialchart2.render();
var radialoptions3 = {
    series: [54],
    chart: { type: "radialBar", width: 60, height: 60, sparkline: { enabled: !0 } },
    dataLabels: { enabled: !1 },
    colors: ["#f46a6a"],
    plotOptions: { radialBar: { hollow: { margin: 0, size: "60%" }, track: { margin: 0 }, dataLabels: { show: !1 } } },
},
radialchart3 = new ApexCharts(document.querySelector("#radialchart-3"), radialoptions3);
radialchart3.render();
