<div class="py-12">
    <div class="max-w-34xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <script src="https://cdn.amcharts.com/lib/4/core.js"></script>

            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                
                <div class="mt-6 text-gray-500">
                    <!-- Styles -->
                    <style>
                    #chartdiv {
                      width: 100%;
                      min-height: 65vh !Important;
                  }

              </style>

              <!-- Resources -->
              <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
              <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
              <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

              <!-- Chart code -->
              <script>
                am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart3D);

chart.titles.create().text = "Crude oil reserves";

// Add data
chart.data = [{
  "category": "SA",
  "value1": 30,
  "value2": 70
}, {
  "category": "SG",
  "value1": 15,
  "value2": 85
}, {
  "category": "2018 Q3",
  "value1": 40,
  "value2": 60
}, {
  "category": "2018 Q4",
  "value1": 55,
  "value2": 45
}];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.grid.template.strokeOpacity = 0;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.grid.template.strokeOpacity = 0;
valueAxis.min = -17;
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

// Create series
var series1 = chart.series.push(new am4charts.ConeSeries());
series1.dataFields.valueY = "value1";
series1.dataFields.categoryX = "category";
series1.columns.template.width = am4core.percent(80);
series1.columns.template.fillOpacity = 0.9;
series1.columns.template.strokeOpacity = 1;
series1.columns.template.strokeWidth = 2;

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

}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>
</div>
</div>

</div>
</div>
</div>