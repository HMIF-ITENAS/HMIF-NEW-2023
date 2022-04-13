Chart.defaults.global.pointHitDetectionRadius = 1;
Chart.defaults.global.tooltips.enabled = false;
Chart.defaults.global.tooltips.mode = "index";
Chart.defaults.global.tooltips.position = "nearest";
Chart.defaults.global.tooltips.custom = coreui.ChartJS.customTooltips;
Chart.defaults.global.defaultFontColor = "#646470"; // eslint-disable-next-line no-unused-vars

var cakahimChart = new Chart(document.getElementById("cakahim-chart"), {
    type: "bar",
    data: {
        labels: [
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
        ],
        datasets: [
            {
                label: "Dipilih",
                backgroundColor: coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--success")
                ),
                borderColor: coreui.Utils.getStyle("--success"),
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false,
        },
        title: {
            display: true,
            text: "Grafik Pemilihan Calon Ketua Himpunan",
            fontSize: 20,
        },
        scales: {
            xAxes: [
                {
                    gridLines: {
                        drawOnChartArea: false,
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        stepSize: Math.ceil(250 / 5),
                        max: 250,
                    },
                },
            ],
        },
        elements: {
            point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4,
                hoverBorderWidth: 3,
            },
        },
    },
});

const getChartCakahim = () => {
    $.ajax({
        url: `${window.baseurl}/admin/api-chart/get-cakahim`,
        method: "GET",
        data: {
            status: 1,
        },
        dataType: "json", //parse the response data as JSON automatically
        success: function (response) {
            console.log(response);
            cakahimChart.data.labels = [];
            cakahimChart.data.datasets.forEach((dataset) => {
                dataset.data = [];
            });
            cakahimChart.update();
            let voters = [];
            response.map((res) => {
                voters.push(res.voters_count);
                cakahimChart.data.labels.push(res.user.nrp);
            });
            cakahimChart.data.datasets.forEach((dataset) => {
                dataset.data.push(response.voters_count);
            });
            cakahimChart.data.datasets[0].data = voters;
            let map_total = voters.map((i) => Number(i));
            let max_total = Math.max(...map_total);
            cakahimChart.options.scales.yAxes[0].ticks.max = max_total + 5;
            cakahimChart.update();
        },
    });
};
getChartCakahim();

var cabpaChart = new Chart(document.getElementById("cabpa-chart"), {
    type: "bar",
    data: {
        labels: [
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
            "M",
            "T",
            "W",
            "T",
            "F",
            "S",
            "S",
        ],
        datasets: [
            {
                label: "Dipilih",
                backgroundColor: coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--success")
                ),
                borderColor: coreui.Utils.getStyle("--success"),
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false,
        },
        title: {
            display: true,
            text: "Grafik Pemilihan Calon Ketua BPA",
            fontSize: 20,
        },
        scales: {
            xAxes: [
                {
                    gridLines: {
                        drawOnChartArea: false,
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        stepSize: Math.ceil(250 / 5),
                        max: 250,
                    },
                },
            ],
        },
        elements: {
            point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4,
                hoverBorderWidth: 3,
            },
        },
    },
});

const getChartCabpa = () => {
    $.ajax({
        url: `${window.baseurl}/admin/api-chart/get-cabpa`,
        method: "GET",
        data: {
            status: 2,
        },
        dataType: "json", //parse the response data as JSON automatically
        success: function (response) {
            console.log(response);
            cabpaChart.data.labels = [];
            cabpaChart.data.datasets.forEach((dataset) => {
                dataset.data = [];
            });
            cabpaChart.update();
            let voters = [];
            response.map((res) => {
                voters.push(res.voters_count);
                cabpaChart.data.labels.push(res.user.nrp);
            });
            cabpaChart.data.datasets.forEach((dataset) => {
                dataset.data.push(response.voters_count);
            });
            cabpaChart.data.datasets[0].data = voters;
            let map_total = voters.map((i) => Number(i));
            let max_total = Math.max(...map_total);
            cabpaChart.options.scales.yAxes[0].ticks.max = max_total + 5;
            cabpaChart.update();
        },
    });
};
getChartCabpa();
