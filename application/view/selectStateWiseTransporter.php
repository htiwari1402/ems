<select name='transporterID'>
<option>select</option>
<?php 
foreach ($transporter as $key=>$data)
{?>
<option value="<?php echo $data['transID'];?>">
<?php echo $data['name'];?>
</option>
<?php }
?>
</select>
