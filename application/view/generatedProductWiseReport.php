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
<table style="margin-top: 4%;float:left;clear:both;margin-left:5%;width:70%;" cellspacing="0">
<tr class="tableHeader">
<td>Product</td>
<td>Packing</td>
<td>Sales in cartons</td>
<td>Sales in litres</td>
<td>Sales in amount</td>
</tr>
<?php 
foreach($dataSet as $key=> $data)
{
?>
<tr>
<td><?php echo $data['itemDesc'];?></td>
<td><?php echo $data['packing'];?></td>
<td><?php echo $data['ctn'];?></td>
<td><?php echo $data['litre'];?></td>
<td><?php echo $data['amount'];?></td>
</tr>
<?php 
}
?>
</table>
<?php 
include "productLitreWiseReport.php";
?>
<?php 
include "productAmountWiseReport.php";
?>
<br><br>