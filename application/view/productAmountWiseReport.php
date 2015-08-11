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
</style>
    <script type="text/javascript">
            
            var inputData2 = <?php echo $inputGraphDataAmount; ?>;
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            var settings2 = {
                title: " Amount Wise Report",
                description: "Amount Wise Report",
                enableAnimations: true,
                borderLineColor: '#ffffff',
                showLegend: true,
                enableCrosshairs: true,
                padding: { left: 10, top: 5, right: 10, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: inputData2,
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
                    title: { text: 'Amount(in INR)<br>' }
                },
                colorScheme: 'scheme05',
                seriesGroups:
                    [
                        {
                            type: 'line',
                            alignEndPointsWithIntervals: true,
                            series: [
                                     <?php 
                                    foreach($allProduct  as $key=>$data) 
                                    {?>
                                    { dataField: '<?php  echo $data['itemDesc']; ?>', displayText:'<?php  echo $data['itemDesc']; ?>', opacity: 0.7 },
                                    <?php 
                                    }?>
                                ]
                        }
                    ]
            };

            // setup the chart
            $('#amountProductChartContainer').jqxChart(settings2);
    </script>

    <div id='amountProductChartContainer'  class="chartContainer" style="width:40%;height:250px;float:right;display:inline-block;margin-right:5%;">
    </div>

