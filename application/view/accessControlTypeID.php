<?php 
//print_r($allBranch);
if ($type == 'HO')
{
?>
<select name='typeID'>
<option value="0">
Head Office
</option>
</select>
<?php 
}
else if( $type == 'admin')
{
?>
<select name='typeID'>
<option value="admin">
Admin
</option>
</select>
<?php 
}
else if(trim( $type) == 'Branch')
{
	
?>
<select name='typeID'>
<?php 
foreach($allBranch as $key=> $data)
{
?>
<option value="<?php  echo $data['branchID']; ?> ">
<?php echo $data['name']; ?>
</option>
<?php 
}?>
</select>
<?php 
}
else if( trim($type) == 'CF')
{
	?>
<select name='typeID'>
<?php 
foreach($allCF as $key=> $data)
{
?>
<option value="<?php  echo $data['cfID']; ?> ">
<?php echo $data['name']; ?>
</option>
<?php 
}?>
</select>
<?php 
}
?>