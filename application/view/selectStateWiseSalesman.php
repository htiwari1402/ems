<select name='salesmanID'>
<option>select</option>
<?php 
foreach ($salesman as $key=>$data)
{?>
<option value="<?php echo $data['empID'];?>">
<?php echo $data['name'];?>
</option>
<?php }
?>
</select>
