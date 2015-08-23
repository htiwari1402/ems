<?php
if($type == "Branch")
{
	?>
	<option value="">select</option>
	<?php 
	foreach($seletedTypeID as $key=>$data)
	{
	?>
	<option value="<?php  echo $data['branchID']; ?>">
	<?php echo $data['name']; ?>
	</option>
	<?php 
     }
}
else if($type == "CF")
{
	?>
		<option value="">select</option>
		<?php
	foreach($seletedTypeID as $key=>$data)
	{
	?>
	<option value="<?php  echo $data['cfID']; ?>">
	<?php echo $data['name']; ?>
	</option>
	<?php 
     }
}
else if($type == "HO")
{?>
	<option value="">select</option>
	<?php
	?>

	<option value="0">
	<?php echo "Head office"; ?>
	</option>
<?php
 }
?>