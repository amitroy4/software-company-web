var options = {
  series: [44, 55, 41],
  chart: {
    type: "donut",
    height: 300,
  },
  labels: ["Shoes", "Grocery", "other"],
  legend: {
    show: false,
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    pie: {
      donut: {
        labels: {
          show: true,
          total: {
            show: true,
            fontSize: "25px",
            fontFamily: "Outfit, sans-serif",
            fontWeight: 500,
            color:"rgba(var(--secondary))",
            label: "89%",
            formatter: () => "Total",
          },
        },
      }
    }
  },
  colors: ["rgba(var(--primary))", "rgba(var(--secondary))", "rgba(var(--danger))"],
  tooltip: {
    x: {
      show: false,
    },
    style: {
      fontSize: '16px',
      fontFamily: '"Outfit", sans-serif',
    },
  },
  responsive: [{
    breakpoint: 1366,
    options: {
      chart: {
        height: 240
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              total: {
                fontSize: "18px",
                fontWeight: 500,
                formatter: () => "Total ",
              },
            },
          }
        }
      },
    }
  },
    {
      breakpoint: 992,
      options: {
        chart: {
          height: 200
        },
      }
    }]

};

var chart = new ApexCharts(document.querySelector("#coursesProgress"), options);
chart.render();









@use "../utils/variables";

.apexcharts-legend.apexcharts-align-center.position-right {
    display: none;
}
.apexcharts-toolbar {
    display: none !important;
}
#sales_charts,
.chart-set{
    overflow: hidden;
}
.apexcharts-canvas {
    width: 100% !important;
}
.apex-charts .apexcharts-canvas {
    margin: 0 auto;
}
.apexcharts-legend {
    padding: 0 !important;
}
.h-250 {
    height: 250px;
}
#attendance_chart2 {
    margin: 24px 0 0;
    .attendance-percentage {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translate(-50%,-50%);
        max-width: 100px;
        text-align: center;
        color: variables.$gray-700;
        span {
            font-size: variables.$font-size-28;
            color: variables.$gray-900;
        }
    }
    .apexcharts-legend-marker {
        width: 8px !important;
        height: 3px !important;
        border-radius: 5px !important;
    }
}
#attendance_chart {
    margin: 24px 0;
    .attendance-percentage {
        position: absolute;
        left: 50%;
        top: 43%;
        transform: translate(-50%,-50%);
        max-width: 100px;
        text-align: center;
        color: variables.$gray-700;
        span {
            font-size: variables.$font-size-28;
            color: variables.$gray-900;
        }
    }
    .apexcharts-legend-marker {
        width: 8px !important;
        height: 3px !important;
        border-radius: 5px !important;
    }
}
#exam-result-chart {
    margin-left: -15px;
}









