<?php
if($type == "Branch")
{
	?>
	<option value="">select</option>
	<?php 
	foreach($seletedTypeID as $key=>$data)
	{
	?>
	<option value="<?php  echo $data['branchID']; ?>"  <?php  if($data['branchID'] == $toPartyDetails['typeID']) { echo "selected"; }?> >
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
	<option value="<?php  echo $data['cfID']; ?>"   <?php  if($data['cfID'] == $toPartyDetails['typeID']) { echo "selected"; }?>>
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