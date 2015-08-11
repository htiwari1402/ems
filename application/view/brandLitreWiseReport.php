<style>
.chartContainer table
{
   border: 0px solid #000000;
}
.chartContainer tr
{
   border: 0px solid #000000;
}
.chartContainer td
{
   border: 0px solid #000000;
}
#litreChartContainer
{
   clear:left;
}
.chartContainer
{
   margin-top: 2%;
   margin-bottom:2%;
}
</style>
    <script type="text/javascript">
           
            var inputData = <?php echo $inputGraphDataLitres; ?>;
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            var settings = {
                title: " Litre Wise Report",
                description: "Litre Wise Report",
                borderLineColor: '#ffffff',
                enableAnimations: true,
                showLegend: true,
                enableCrosshairs: true,
                padding: { left: 10, top: 5, right: 10, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: inputData,
                xAxis:
                    {
                        dataField: 'month',
                        valuesOnTicks: true,
                        labels: {
                            angle: -45,
                            rotationPoint: 'topright',
                            offset: {x: 0, y: -15},
                            formatFunction: function (value) {
                                return months[value] ;
                            },
                        },
                        toolTipFormatFunction: function (value) {
                        	return months[value] ;
                        }
                    },
                valueAxis:
                {
                    title: { text: 'Quantity(In Litres)<br>' }
                },
                colorScheme: 'scheme02',
                seriesGroups:
                    [
                        {
                            type: 'area',
                            alignEndPointsWithIntervals: true,
                            series: [
                                     <?php 
                                    foreach($allBrand as $key=>$data) 
                                    {?>
                                    { dataField: '<?php  echo $data['brand']; ?>', displayText:'<?php  echo $data['brand']; ?>', opacity: 0.7 },
                                    <?php 
                                    }?>
                                ]
                        }
                    ]
            };

            // setup the chart
            $('#litreChartContainer').jqxChart(settings);
    </script>

    <div id='litreChartContainer'   class="chartContainer" style="width:40%; height:250px;float:left;display:inline-block;">
    </div>

