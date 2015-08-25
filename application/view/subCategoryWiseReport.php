<style>
.ui-widget-content,.ui-tabs
{
	background:#ffffff;
}
</style>
<div style="width:100%;font-size:16px;color:#116493;font-weight:bold;">
SUB CATEGORY WISE REPORT
</div>
<br><br>
<form id="scWiseReportForm">
State: 
<select name="state">
<option value="0">All India</option>
<?php 
foreach($allStates as $key=>$data)
{
?>
<option value="<?php  echo $data['name']; ?>">
<?php  echo $data['name']; ?>
</option>
<?php 
}?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Brand:
<select name="brand">
<option value="0">All</option>
<?php 
foreach($allBrand as $key=>$data)
{
?>
<option value="<?php  echo $data['brand']; ?>">
<?php  echo $data['brand']; ?>
</option>
<?php 
}?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Category:
<select name="category">
<option value="0">All</option>
<?php 
foreach($alCategories as $key=>$data)
{
?>
<option value="<?php  echo $data['category']; ?>">
<?php  echo $data['category']; ?>
</option>
<?php 
}?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Sub Category:
<select name="sc">
<option value="0">All</option>
<?php 
foreach($allSC as $key=>$data)
{
?>
<option value="<?php  echo $data['subCategory']; ?>">
<?php  echo $data['subCategory']; ?>
</option>
<?php 
}?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
From:
<input type="text" class="date" name="fromDate" >
&nbsp;&nbsp;&nbsp;&nbsp;
To:
<input type="text" class="date" name="toDate">
<br>
</form>
<br>
<input type="button" class="nu" value="Generate Report" onclick="generateSCWiseReport();">

<br><br>
<div id="mainReportSC" style="width:100%;">
</div>