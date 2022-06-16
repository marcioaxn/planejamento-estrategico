<div class="">

    <div class="flex flex-wrap w-full pt-1">

        <div class="w-full md:w-1/1 px-3 pt-1">

            <div class="pt-1 pb-1 pl-3 pr-3 bg-white rounded-md border-2 border-gray-300 border-opacity-25 text-gray-600 text-lg items-center font-semibold text-lg " style="text-align: center!Important;">
                Dashboard
            </div>

        </div>

        <div class="w-full md:w-1/1 pt-0 pb-0 pl-3 pr-3 ">

            <style type="text/css">select { text-align-last:center; }</style>

            <div class="col-span-6 sm:col-span-4">
                {!! Form::select('cod_organizacao', $this->organization, null, ['class' => 'w-full border-2 border-gray-300 border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 text-blue-500 text-center pt-1 h-10', 'style' => 'cursor: pointer;text-align: center !Important;', 'wire:model' => "cod_organizacao", 'autocomplete' => 'off', 'wire:change' => 'foo']) !!}
            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 px-3 py-3 gap-4 ">

        <div class="w-full text-center font-semibold ">

            Percentual do Alcance das Metas dos Planos de Ações dos Objetivos Estratégicos em {!! $this->ano !!}

        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 px-3 py-3 gap-4 ">

        <div class="w-full col-span-2 ">

            <div class="grid grid-cols-1 md:grid-cols-6 px-3 py-3 gap-4 ">

                <div class="w-full ">

                    <p class="mb-4">
                        {!! Form::select('mesSelecionado', $this->meses, null, ['class' => 'w-full border-2 border-gray-300 border-opacity-25 font-semibold text-sm sm:text-base focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 text-blue-500 text-center pt-1 h-10', 'style' => 'cursor: pointer;text-align: center !Important;', 'wire:model' => "mesSelecionado", 'autocomplete' => 'off', 'wire:change' => 'foo']) !!}
                    </p>

                    <p>
                        {!! $this->grau_satisfacao !!}
                    </p>

                </div>

                <div class="w-full col-span-3 ">

                    Gráfico de coluna das áreas

                    @php // Os gráficos a seguir são feitos utilizando uma biblioteca Javascript da Apex Charts => https://github.com/apexcharts/apexcharts.js @endphp

                    @php // Início do gráfico de colunas contendo o percentual de cada unidade da organização referente ao mês anterior ou ao selecionado. @endphp

                    @php // Este será mostrado quando o ano selecionado for igual ao ano vigente @endphp

                    <div id="chart"></div>

                    <script>

                        setTimeout(function () {

                            var colors = [
                            '#65a30d',
                            '#f59e0b',
                            '#65a30d',
                            '#65a30d',
                            '#fde047'
                            ]

                            var options = {
                                series: [{
                                    data: [100, 92, 100, 100, 67]
                                }],
                                chart: {
                                    height: 350,
                                    type: 'bar',
                                    events: {
                                        click: function(chart, w, e) {
                                            console.log(chart, w, e)
                                        }
                                    }
                                },
                                grid: {
                                    show: false,
                                    xaxis: {
                                        lines: {
                                            show: false
                                        }
                                    },  
                                    yaxis: {
                                        lines: { 
                                            show: false
                                        }
                                    },
                                },
                                colors: colors,
                                plotOptions: {
                                    bar: {
                                        columnWidth: '45%',
                                        distributed: true,
                                        borderRadius:12,
                                        dataLabels: {
                                            position: 'top',
                                        }
                                    }
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: function (val) {
                                        return val + "%";
                                    },
                                    offsetY: -20,
                                    style: {
                                        fontSize: '12px',
                                        colors: ["#000000","#000000","#000000","#000000","#000000"]
                                    }
                                },
                                fill: {
                                    type: 'gradient',
                                },
                                legend: {
                                    show: false
                                },
                                yaxis: {
                                    show: false,
                                    min: 0,
                                    max: 110,
                                },
                                xaxis: {
                                    categories: ["CISET","IN","SA","SAJ","SEME"],
                                    labels: {
                                        style: {
                                            fontSize: '12px'
                                        }
                                    }
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#chart"), options);

                            chart.render();

                        }, 369);

                        setTimeout(function () {



                        }, 369);

                    </script>

                    @php // Fim do gráfico de colunas contendo o percentual de cada unidade da organização referente ao mês anterior ou ao selecionado. @endphp

                </div>

                <div class="w-full col-span-2 ">

                    Gráfico de coluna da Unidade

                    @php // Início do gráfico de colunas contendo o percentual da unidade ativa ou selecionada referente ao mês anterior ou ao selecionado. @endphp

                    @php // Este será mostrado quando o ano selecionado for igual ao ano vigente @endphp

                    <div id="chartA3"></div>

                    <script>

                        var colors = [
                        '#f59e0b'
                        ]

                        var options = {
                            series: [{
                                data: [92]
                            }],
                            chart: {
                                height: 350,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        console.log(chart, w, e)
                                    }
                                }
                            },
                            grid: {
                                show: false,
                                xaxis: {
                                    lines: {
                                        show: false
                                    }
                                },  
                                yaxis: {
                                    lines: { 
                                        show: false
                                    }
                                },
                            },
                            colors: colors,
                            plotOptions: {
                                bar: {
                                    columnWidth: '45%',
                                    distributed: true,
                                    borderRadius:12,
                                    dataLabels: {
                                        position: 'top',
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                formatter: function (val) {
                                    return val + "%";
                                },
                                offsetY: -20,
                                style: {
                                    fontSize: '12px',
                                    colors: ["#000000"]
                                }
                            },
                            fill: {
                                type: 'gradient',
                            },
                            legend: {
                                show: false
                            },
                            yaxis: {
                                show: false,
                                min: 0,
                                max: 110,
                            },
                            xaxis: {
                                categories: ["Secretaria-Geral SG"],
                                labels: {
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#chartA3"), options);
                        chart.render();

                    </script>

                    @php // Fim do gráfico de colunas contendo o percentual da unidade ativa ou selecionada referente ao mês anterior ou ao selecionado. @endphp

                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-6 px-3 py-3 gap-4 ">

                <div class="w-full ">
                    &nbsp;
                </div>

                <div class="w-full col-span-3 ">

                    Gráfico de coluna das áreas

                    @php // Início do gráfico de colunas contendo o percentual de cada unidade da organização referente ao acumulado entre o mês anterior ao ao selecionado. @endphp

                    @php // Este será mostrado sempre @endphp

                    <div id="chartA4"></div>

                    <script>

                        var colors = [
                        '#65a30d',
                        '#f59e0b',
                        '#65a30d',
                        '#65a30d',
                        '#65a30d'
                        ]

                        var options = {
                            series: [{
                                data: [100, 90, 100, 100, 100]
                            }],
                            chart: {
                                height: 350,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        console.log(chart, w, e)
                                    }
                                }
                            },
                            grid: {
                                show: false,
                                xaxis: {
                                    lines: {
                                        show: false
                                    }
                                },  
                                yaxis: {
                                    lines: { 
                                        show: false
                                    }
                                },
                            },
                            colors: colors,
                            plotOptions: {
                                bar: {
                                    columnWidth: '45%',
                                    distributed: true,
                                    borderRadius:12,
                                    dataLabels: {
                                        position: 'top',
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                formatter: function (val) {
                                    return val + "%";
                                },
                                offsetY: -20,
                                style: {
                                    fontSize: '12px',
                                    colors: ["#000000","#000000","#000000","#000000","#000000"]
                                }
                            },
                            fill: {
                                type: 'gradient',
                            },
                            legend: {
                                show: false
                            },
                            yaxis: {
                                show: false,
                                min: 0,
                                max: 110,
                            },
                            xaxis: {
                                categories: ["CISET","IN","SA","SAJ","SEME"],
                                labels: {
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#chartA4"), options);
                        chart.render();

                    </script>

                    @php // Fim do gráfico de colunas contendo o percentual de cada unidade da organização referente ao acumulado entre o mês anterior ao ao selecionado. @endphp

                </div>

                <div class="w-full col-span-2 ">

                    Gráfico de coluna da Unidade

                    @php // Início do gráfico de colunas contendo o percentual da unidade ativa ou selecionada referente ao acumulado entre o mês anterior ao ao selecionado. @endphp

                    <div id="chartA5"></div>

                    <script>

                        var colors = [
                        '#65a30d'
                        ]

                        var options = {
                            series: [{
                                data: [98]
                            }],
                            chart: {
                                height: 350,
                                type: 'bar',
                                events: {
                                    click: function(chart, w, e) {
                                        console.log(chart, w, e)
                                    }
                                }
                            },
                            grid: {
                                show: false,
                                xaxis: {
                                    lines: {
                                        show: false
                                    }
                                },  
                                yaxis: {
                                    lines: { 
                                        show: false
                                    }
                                },
                            },
                            colors: colors,
                            plotOptions: {
                                bar: {
                                    columnWidth: '45%',
                                    distributed: true,
                                    borderRadius:12,
                                    dataLabels: {
                                        position: 'top',
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                formatter: function (val) {
                                    return val + "%";
                                },
                                offsetY: -20,
                                style: {
                                    fontSize: '12px',
                                    colors: ["#000000"]
                                }
                            },
                            fill: {
                                type: 'gradient',
                            },
                            legend: {
                                show: false
                            },
                            yaxis: {
                                show: false,
                                min: 0,
                                max: 110,
                            },
                            xaxis: {
                                categories: ["Secretaria-Geral SG"],
                                labels: {
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#chartA5"), options);
                        chart.render();

                    </script>

                    @php // Fim do gráfico de colunas contendo o percentual da unidade ativa ou selecionada referente ao acumulado entre o mês anterior ao ao selecionado. @endphp

                </div>

            </div>

        </div>

        <div class="w-full ">

            <div class="w-full md:w-1/1 px-3 pt-3">

                Resultado Anual Acumulado

                @php // Início dos gráficos de radial bar contendo o percentual da unidade ativa ou selecionada e das unidades a ela vinculadas referente ao acumulado do ano. @endphp

            </div>

            <div class="flex w-full md:w-1/1 px-2 pt-3 justify-center">

                <div class="items-center" id="chartB6"></div>

                <script>

                    var colors = [
                    '#dc2626'
                    ]

                    var options = {
                        chart: {
                            height: 199,
                            type: "radialBar"
                        },
                        colors: colors,
                        series: [16],
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    margin: 15,
                                    size: "59%"
                                },

                                dataLabels: {
                                    showOn: "always",
                                    name: {
                                        offsetY: -9,
                                        show: true,
                                        color: "#888",
                                        fontSize: "14px"
                                    },
                                    value: {
                                        color: "#111",
                                        fontSize: "17px",
                                        show: true,
                                        offsetY: 0
                                    }
                                }
                            }
                        },
                        fill: {
                            type: 'solid'
                        },
                        labels: ["SG"]
                    };

                    var chart = new ApexCharts(document.querySelector("#chartB6"), options)

                    chart.render();

                </script>

            </div>

            <div class="flex flex-wrap justify-center ">

                <div class="w-24 items-center" id="chartB1"></div>

                <script>

                    var colors = [
                    '#dc2626'
                    ]

                    var options = {
                        chart: {
                            height: 133,
                            type: "radialBar"
                        },
                        colors: colors,
                        series: [18],
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    margin: 15,
                                    size: "66%"
                                },

                                dataLabels: {
                                    showOn: "always",
                                    name: {
                                        offsetY: -9,
                                        show: true,
                                        color: "#888",
                                        fontSize: "11px"
                                    },
                                    value: {
                                        color: "#111",
                                        fontSize: "14px",
                                        show: true,
                                        offsetY: 0
                                    }
                                }
                            }
                        },

                        stroke: {
                            lineCap: "round"
                        },
                        labels: ["CISET"]
                    };

                    var chart = new ApexCharts(document.querySelector("#chartB1"), options)

                    chart.render();

                </script>

                <div class="w-24 items-center" id="chartB2"></div>

                <script>

                    var colors = [
                    '#dc2626'
                    ]

                    var options = {
                        chart: {
                            height: 133,
                            type: "radialBar"
                        },
                        colors: colors,
                        series: [17],
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    margin: 15,
                                    size: "66%"
                                },

                                dataLabels: {
                                    showOn: "always",
                                    name: {
                                        offsetY: -9,
                                        show: true,
                                        color: "#888",
                                        fontSize: "11px"
                                    },
                                    value: {
                                        color: "#111",
                                        fontSize: "14px",
                                        show: true,
                                        offsetY: 0
                                    }
                                }
                            }
                        },

                        stroke: {
                            lineCap: "round"
                        },
                        labels: ["IN"]
                    };

                    var chart = new ApexCharts(document.querySelector("#chartB2"), options)

                    chart.render();

                </script>

                <div class="w-24 items-center" id="chartB3"></div>

                <script>

                    var colors = [
                    '#dc2626'
                    ]

                    var options = {
                        chart: {
                            height: 133,
                            type: "radialBar"
                        },
                        colors: colors,
                        series: [15],
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    margin: 15,
                                    size: "66%"
                                },

                                dataLabels: {
                                    showOn: "always",
                                    name: {
                                        offsetY: -9,
                                        show: true,
                                        color: "#888",
                                        fontSize: "11px"
                                    },
                                    value: {
                                        color: "#111",
                                        fontSize: "14px",
                                        show: true,
                                        offsetY: 0
                                    }
                                }
                            }
                        },

                        stroke: {
                            lineCap: "round"
                        },
                        labels: ["SA"]
                    };

                    var chart = new ApexCharts(document.querySelector("#chartB3"), options)

                    chart.render();

                </script>

                <div class="w-24 items-center" id="chartB4"></div>

                <script>

                    var colors = [
                    '#dc2626'
                    ]

                    var options = {
                        chart: {
                            height: 133,
                            type: "radialBar"
                        },
                        colors: colors,
                        series: [2],
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    margin: 15,
                                    size: "66%"
                                },

                                dataLabels: {
                                    showOn: "always",
                                    name: {
                                        offsetY: -9,
                                        show: true,
                                        color: "#888",
                                        fontSize: "11px"
                                    },
                                    value: {
                                        color: "#111",
                                        fontSize: "14px",
                                        show: true,
                                        offsetY: 0
                                    }
                                }
                            }
                        },

                        stroke: {
                            lineCap: "round"
                        },
                        labels: ["SAJ"]
                    };

                    var chart = new ApexCharts(document.querySelector("#chartB4"), options)

                    chart.render();

                </script>

                <div class="w-24 items-center" id="chartB5"></div>

                <script>

                    var colors = [
                    '#dc2626'
                    ]

                    var options = {
                        chart: {
                            height: 133,
                            type: "radialBar"
                        },
                        colors: colors,
                        series: [30],
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    margin: 15,
                                    size: "66%"
                                },

                                dataLabels: {
                                    showOn: "always",
                                    name: {
                                        offsetY: -9,
                                        show: true,
                                        color: "#888",
                                        fontSize: "11px"
                                    },
                                    value: {
                                        color: "#111",
                                        fontSize: "14px",
                                        show: true,
                                        offsetY: 0
                                    }
                                }
                            }
                        },

                        stroke: {
                            lineCap: "round"
                        },
                        labels: ["SEME"]
                    };

                    var chart = new ApexCharts(document.querySelector("#chartB5"), options)

                    chart.render();

                </script>

                @php // Fim dos gráficos de radial bar contendo o percentual da unidade ativa ou selecionada e das unidades a ela vinculadas referente ao acumulado do ano. @endphp

            </div>

        </div>

    </div>

</div>

</div>
