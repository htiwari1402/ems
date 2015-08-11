<style>
table, tr, td
{
   border: 0px solid #000000;
}
</style>
<hr style="visibility: hidden;clear:both;margin-bottom:4%;">
<?php
//Include the code
require_once "../../libs/phplot.php";
//Define the object
$plot = new PHPlot();
$data = $monthlySalesArray;
$plot = new PHPlot(800, 600);
$plot->SetImageBorderType('none');
$plot->SetPlotType('bars');
$plot->SetFont('x_label', 4,3);
$plot->SetFont('y_label', 4,3);
$plot->SetDataType('text-data');
$plot->SetDataValues($data);
# Main plot title:
$plot->SetTitle('Monthly Report');
# Make a legend for the 3 data sets plotted:
$plot->SetLegend(array('Total Amount (INR)'));
# Turn off X tick labels and ticks because they don't apply here:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');
//Draw it
$plot->SetPrintImage(false);
$plot->DrawGraph();
?>
<img src="<?php echo $plot->EncodeImage(); ?>" style="width:600px;height:450px;display:inline-block;">
<hr style="visibility: hidden;clear:both">
<br><br><br>
<div id="reportTable" style="display:block;clear:both; margin-top:3%;">
</div>


