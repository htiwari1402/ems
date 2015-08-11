<option value="">select</option>
	<?php 
	foreach($subretailers as $key=>$data)
	{
	?>
	<option value="<?php  echo $data['name']; ?>">
	<?php echo $data['name']; ?>
	</option>
	<?php }?>