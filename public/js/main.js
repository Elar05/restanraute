"use strict";
$(function () {
    chart1();
    chart3();
    chart7();
});

function chart1() {
    $.post(
        `main/getVentasPorMes`,
        {},
        function (data, textStatus, jqXHR) {
            const { series, categories } = data
            var options = {
                chart: {
                    height: 350,
                    type: "bar",
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: "rounded",
                        columnWidth: "55%",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                series,
                xaxis: {
                    categories,
                    labels: {
                        style: {
                            colors: "#9aa0ac",
                        },
                    },
                },
                yaxis: {
                    title: {
                        text: "cantidad de ventas",
                    },
                    labels: {
                        style: {
                            color: "#9aa0ac",
                        },
                    },
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " ventas en este mes";
                        },
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);

            chart.render();
        },
        "json"
    );
}

function chart3() {
    $.post(
        `main/getTotalVentasPorMes`,
        {},
        function (data, textStatus, jqXHR) {
            const { series, categories } = data
            var options = {
                chart: {
                    height: 350,
                    type: "bar",
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: "rounded",
                        columnWidth: "55%",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                series,
                xaxis: {
                    categories,
                    labels: {
                        style: {
                            colors: "#9aa0ac",
                        },
                    },
                },
                yaxis: {
                    title: {
                        text: "Total de ventas",
                    },
                    labels: {
                        style: {
                            color: "#9aa0ac",
                        },
                    },
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "S/ " + val + " soles";
                        },
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart3"), options);

            chart.render();
        },
        "json"
    );
}

function chart7() {
    $.post(
        `main/getCantidadTipoPedido`,
        {},
        function (data, textStatus, jqXHR) {
            const { series, labels } = data
            var options = {
                chart: {
                    width: 360,
                    type: "pie",
                },
                labels,
                series,
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    },
                ],
            };

            var chart = new ApexCharts(document.querySelector("#chart7"), options);

            chart.render();
        },
        "json"
    );
}