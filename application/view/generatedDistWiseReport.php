<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxchart.core.js"></script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<style>
table,tr,td
{
	border:1px solid #454545;
}
table
{
    font-size:15px;
    width: 40%;
}
td
{
    padding:5px;
}
.tableHeader
{
    background-color: #3fe694;
}
</style>
<table style="margin-top: 4%;float:left;clear:both;margin-left:5%" cellspacing="0">
<tr class="tableHeader">
<td>Distributor</td>
<td>Litre</td>
<td>Value</td>
</tr>
<?php 
foreach($dataSet as $key=> $data)
{
?>
<tr>
<td><?php echo $data['name'];?></td>
<td><?php echo $data['litre'];?></td>
<td><?php echo $data['amount'];?></td>
</tr>
<?php 
}
?>
</table>
<?php 
include "distLitreWiseReport.php";
?>
<?php 
include "distAmountWiseReport.php";
?>
<br><br>