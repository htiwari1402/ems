<option >select</option>
<?php 
if ($reportType == 'spr')
{
	foreach($options as $key=>$data)
	{
?>
<option value="<?php  echo $data['empID']?>">
<?php echo $data['name'];?>
</option>
<?php 
	}
}
else if ($reportType == 'dr')
{
	foreach($options as $key=>$data)
	{
?>
<option value="<?php  echo $data['distID']?>">
<?php echo $data['name'];?>
</option>
<?php 
	}
}
else if ($reportType == 'pwr')
{
	foreach($options as $key=>$data)
	{
		?>
<option value="<?php  echo $data['itemCode']?>">
<?php echo $data['itemDesc'];?>
</option>
<?php 
	}
}
else if ($reportType == 'cwr')
{
	foreach($options as $key=>$data)
	{
		?>
<option value="<?php  echo $data['category']?>">
<?php echo $data['category'];?>
</option>
<?php 
	}
}
else if ($reportType == 'bwr')
{
	foreach($options as $key=>$data)
	{
		?>
<option value="<?php  echo $data['brand']?>">
<?php echo $data['brand'];?>
</option>
<?php 
	}
}
?>
