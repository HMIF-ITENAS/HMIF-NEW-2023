/* eslint-disable object-shorthand */

/* global Chart, coreui, coreui.Utils.getStyle, coreui.Utils.hexToRgba */

/**
 * --------------------------------------------------------------------------
 * CoreUI Boostrap Admin Template (v3.4.0): main.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */

/* eslint-disable no-magic-numbers */
// Disable the on-canvas tooltip
Chart.defaults.global.pointHitDetectionRadius = 1;
Chart.defaults.global.tooltips.enabled = false;
Chart.defaults.global.tooltips.mode = 'index';
Chart.defaults.global.tooltips.position = 'nearest';
Chart.defaults.global.tooltips.custom = coreui.ChartJS.customTooltips;
Chart.defaults.global.defaultFontColor = '#646470'; // eslint-disable-next-line no-unused-vars

var cardChart1 = new Chart(document.getElementById('card-chart1'), {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: 'Anggota Per Angkatan',
      backgroundColor: 'transparent',
      borderColor: 'rgba(255,255,255,.55)',
      pointBackgroundColor: coreui.Utils.getStyle('--primary'),
      data: []
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          color: 'transparent',
          zeroLineColor: 'transparent'
        },
        ticks: {
          fontSize: 2,
          fontColor: 'transparent'
        }
      }],
      yAxes: [{
        display: false,
        ticks: {
          display: false,
          min: 35,
          max: 89
        }
      }]
    },
    elements: {
      line: {
        borderWidth: 1
      },
      point: {
        radius: 4,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
}); // eslint-disable-next-line no-unused-vars
$.ajax({
  url: `${window.baseurl}/admin/api-chart/get-users-by-angkatan`,
  method: "GET",
  dataType: "json", //parse the response data as JSON automatically
  success: function (res) {
    cardChart1.data.labels = [];
    cardChart1.data.datasets[0].data = [];
    cardChart1.update();
    let total = []
    for (i in res) {
      cardChart1.data.labels.push(res[i].label);
      total.push(res[i].total)
    }
    cardChart1.data.datasets[0].data = total
    let map_total = total.map(i => Number(i))
    let max_total = Math.max(...map_total)
    cardChart1.options.scales.yAxes[0].ticks.max = max_total + 5
    cardChart1.update()
  }
});

var cardChart2 = new Chart(document.getElementById('card-chart2'), {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
      label: 'Postingan',
      backgroundColor: 'transparent',
      borderColor: 'rgba(255,255,255,.55)',
      pointBackgroundColor: coreui.Utils.getStyle('--info'),
      data: [1, 18, 9, 17, 34, 22, 11]
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          color: 'transparent',
          zeroLineColor: 'transparent'
        },
        ticks: {
          fontSize: 2,
          fontColor: 'transparent'
        }
      }],
      yAxes: [{
        display: false,
        ticks: {
          display: false,
          min: -4,
          max: 39
        }
      }]
    },
    elements: {
      line: {
        tension: 0.00001,
        borderWidth: 1
      },
      point: {
        radius: 4,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
}); // eslint-disable-next-line no-unused-vars

$.ajax({
  url: `${window.baseurl}/admin/api-chart/get-posts-by-month`,
  method: "GET",
  dataType: "json", //parse the response data as JSON automatically
  success: function (response) {
    cardChart2.data.labels = [];
    cardChart2.data.datasets[0].data = [];
    cardChart2.update();
    let total = []
    response.map(res => {
      cardChart2.data.labels.push(res.month);
      total.push(res.total)
      // console.log(res.month)
    })

    cardChart2.data.datasets[0].data = total
    let map_total = total.map(i => Number(i))
    let max_total = Math.max(...map_total)
    cardChart2.options.scales.yAxes[0].ticks.max = max_total + 5
    cardChart2.update()
  }
});

var cardChart3 = new Chart(document.getElementById('card-chart3'), {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
      label: 'Aspirasi Internal',
      backgroundColor: 'rgba(255,255,255,.2)',
      borderColor: 'rgba(255,255,255,.55)',
      data: [78, 81, 80, 45, 34, 12, 40]
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    },
    elements: {
      line: {
        borderWidth: 2
      },
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
});

$.ajax({
  url: `${window.baseurl}/admin/api-chart/get-internal-by-month`,
  method: "GET",
  dataType: "json", //parse the response data as JSON automatically
  success: function (response) {
    cardChart3.data.labels = [];
    cardChart3.data.datasets[0].data = [];
    cardChart3.update();
    let total = []
    response.map(res => {
      cardChart3.data.labels.push(res.month);
      total.push(res.total)
      // console.log(res.month)
    })

    cardChart3.data.datasets[0].data = total
    let map_total = total.map(i => Number(i))
    let max_total = Math.max(...map_total)
    cardChart3.options.scales.yAxes[0].ticks.max = max_total + 5
    cardChart3.update()
  }
});

var cardChart4 = new Chart(document.getElementById('card-chart4'), {
  type: 'bar',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April'],
    datasets: [{
      label: 'Aspirasi External',
      backgroundColor: 'rgba(255,255,255,.2)',
      borderColor: 'rgba(255,255,255,.55)',
      data: [78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98, 34, 84, 67, 82],
      barPercentage: 0.6
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    }
  }
}); // eslint-disable-next-line no-unused-vars

$.ajax({
  url: `${window.baseurl}/admin/api-chart/get-external-by-month`,
  method: "GET",
  dataType: "json", //parse the response data as JSON automatically
  success: function (response) {
    cardChart4.data.labels = [];
    cardChart4.data.datasets[0].data = [];
    cardChart4.update();
    let total = []
    response.map(res => {
      cardChart4.data.labels.push(res.month);
      total.push(res.total)
      // console.log(res.month)
    })

    cardChart4.data.datasets[0].data = total
    let map_total = total.map(i => Number(i))
    let max_total = Math.max(...map_total)
    cardChart4.options.scales.yAxes[0].ticks.max = max_total + 5
    cardChart4.update()
  }
});

var mainChart = new Chart(document.getElementById('main-chart'), {
  type: 'line',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S'],
    datasets: [{
      label: 'My First dataset',
      backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle('--info'), 10),
      borderColor: coreui.Utils.getStyle('--info'),
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: [165, 180, 70, 69, 77, 57, 125, 165, 172, 91, 173, 138, 155, 89, 50, 161, 65, 163, 160, 103, 114, 185, 125, 196, 183, 64, 137, 95, 112, 175]
    }, {
      label: 'My Second dataset',
      backgroundColor: 'transparent',
      borderColor: coreui.Utils.getStyle('--success'),
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: [92, 97, 80, 100, 86, 97, 83, 98, 87, 98, 93, 83, 87, 98, 96, 84, 91, 97, 88, 86, 94, 86, 95, 91, 98, 91, 92, 80, 83, 82]
    }, {
      label: 'My Third dataset',
      backgroundColor: 'transparent',
      borderColor: coreui.Utils.getStyle('--danger'),
      pointHoverBackgroundColor: '#fff',
      borderWidth: 1,
      borderDash: [8, 5],
      data: [65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65, 65]
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          drawOnChartArea: false
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true,
          maxTicksLimit: 5,
          stepSize: Math.ceil(250 / 5),
          max: 250
        }
      }]
    },
    elements: {
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4,
        hoverBorderWidth: 3
      }
    }
  }
});
//# sourceMappingURL=main.js.map