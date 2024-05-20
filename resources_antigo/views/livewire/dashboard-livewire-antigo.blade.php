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

    <div class="pt-2 pl-2 pr-2">

        <p>{!! $this->cod_organizacao !!}</p>

        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-6 text-gray-500">
                <!-- Styles -->
                <style>
                    #chartdiv {
                        width: 100%;
                        height: 75vh;
                    }

                </style>

                <!-- Resources -->
                <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

                <!-- Chart code -->
                <script>
                    am4core.ready(function() {

                        am4core.useTheme(am4themes_animated);

                        var chart = am4core.create("chartdiv", am4charts.XYChart3D);

                        chart.data = [{!! $this->dadosGraficoCylinder !!}];

                        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                        categoryAxis.dataFields.category = "category";
                        categoryAxis.renderer.grid.template.location = 0;
                        categoryAxis.renderer.grid.template.strokeOpacity = 0;

                        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                        valueAxis.renderer.grid.template.strokeOpacity = 0;
                        valueAxis.min = -10;
                        valueAxis.max = 117;
                        valueAxis.strictMinMax = true;
                        valueAxis.renderer.baseGrid.disabled = true;
                        valueAxis.renderer.labels.template.adapter.add("text", function(text) {
                            if ((text > 100) || (text < 0)) {
                                return "";
                            }
                            else {
                                return text + "%";
                            }
                        })

                        var series1 = chart.series.push(new am4charts.ConeSeries());
                        var label = "value1";
                        series1.dataFields.valueY = "value1";
                        console.log(series1);
                        series1.dataFields.categoryX = "category";
                        series1.columns.template.width = am4core.percent(80);
                        series1.columns.template.fill = "fill1";
                        series1.columns.template.fillOpacity = 0.9;
                        series1.columns.template.stroke = "fill1";
                        series1.columns.template.strokeOpacity = 1;
                        series1.columns.template.strokeWidth = 2;

                        series1.columns.template.events.on("hit", function(ev) {
                  // console.dir(series1.target.dataItems.values[_index].categories.categoryX);
                  alert(ev.target.dataItem.categories.categoryX);
              });

                        var series2 = chart.series.push(new am4charts.ConeSeries());
                        series2.dataFields.valueY = "value2";
                        series2.dataFields.categoryX = "category";
                        series2.stacked = true;
                        series2.columns.template.width = am4core.percent(80);
                        series2.columns.template.fill = am4core.color("#333");
                        series2.columns.template.fillOpacity = 0.1;
                        series2.columns.template.stroke = am4core.color("#333");
                        series2.columns.template.strokeOpacity = 0.2;
                        series2.columns.template.strokeWidth = 2;

                    });

                    document.addEventListener('livewire:load', () => {
                        @this.on('refreshChart', (chartData) => {
                            am4core.ready(function() {

                                am4core.useTheme(am4themes_animated);

                                var chart = am4core.create("chartdiv", am4charts.XYChart3D);

                                chart.data = [{!! $this->novosDadosGraficoCylinder !!}];

                                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                                categoryAxis.dataFields.category = "category";
                                categoryAxis.renderer.grid.template.location = 0;
                                categoryAxis.renderer.grid.template.strokeOpacity = 0;

                                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                valueAxis.renderer.grid.template.strokeOpacity = 0;
                                valueAxis.min = -10;
                                valueAxis.max = 117;
                                valueAxis.strictMinMax = true;
                                valueAxis.renderer.baseGrid.disabled = true;
                                valueAxis.renderer.labels.template.adapter.add("text", function(text) {
                                    if ((text > 100) || (text < 0)) {
                                        return "";
                                    }
                                    else {
                                        return text + "%";
                                    }
                                })

                                var series1 = chart.series.push(new am4charts.ConeSeries());
                                var label = "value1";
                                series1.dataFields.valueY = "value1";
                                series1.dataFields.categoryX = "category";
                                series1.columns.template.width = am4core.percent(80);
                                series1.columns.template.fillOpacity = 0.9;
                                series1.columns.template.strokeOpacity = 1;
                                series1.columns.template.strokeWidth = 2;

                                series1.columns.template.events.on("hit", function(ev) {
  // console.dir(series1.target.dataItems.values[_index].categories.categoryX);
  alert(ev.target.dataItem.categories.categoryX);
});

                                var series2 = chart.series.push(new am4charts.ConeSeries());
                                series2.dataFields.valueY = "value2";
                                series2.dataFields.categoryX = "category";
                                series2.stacked = true;
                                series2.columns.template.width = am4core.percent(80);
                                series2.columns.template.fill = am4core.color("#000");
                                series2.columns.template.fillOpacity = 0.1;
                                series2.columns.template.stroke = am4core.color("#000");
                                series2.columns.template.strokeOpacity = 0.2;
                                series2.columns.template.strokeWidth = 2;

                            });
                        })    
                    })


                </script>

                <!-- HTML -->
                <div id="chartdiv"></div>
            </div>
        </div>


    </div>

</div>
