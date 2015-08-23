<form id='selectGodownForm'>
<?php 
//echo "<pre>";
//print_r($_SESSION['warehouseDetails']);
?>
 <?php 
 /*
echo "<pre>";
print_r($items);
print_r($_SESSION['warehouseDetails']); */
?> 
<table border="1" style="widt:100%;border:1px">
<tr>
<td>WarehouseID</td>
<td>Item Code</td>
<td>Mfg Date</td>
<td>Exp Date</td>
<td>Batch No</td>
<td>Carton</td>
<td>Pieces</td>
<td>Total Pcs</td>
<td>Quantity(Cartons)</td>
<td>Quantity(Pcs)</td>
</tr>
<?php 
$serial = 0;
foreach($_SESSION['warehouseDetails'] as $key=>$data)
{
if($data['itemCode'] == $itemCode && $data['totalPcs'] > 0)
{
	
?>
<tr>
<td>
<?php echo $data['warehouseID']; ?>
<input type="hidden"  id="warehouseID_<?php echo $serial; ?>" value="<?php echo $data['warehouseID']; ?>">
</td>
<td><?php echo $data['itemCode']; ?>
<input type="hidden"  id="itemACode_<?php echo $serial; ?>" value="<?php echo $data['itemCode']; ?>">
</td>
<td><?php echo $data['mfgDate']; ?>
<input type="hidden"  id="mfgADate_<?php echo $serial; ?>" value="<?php echo $data['mfgDate']; ?>">
</td>
<td><?php echo $data['expDate']; ?>
<input type="hidden"  id="expADate_<?php echo $serial; ?>" value="<?php echo $data['expDate']; ?>">
</td>
<td><?php echo $data['batchNo']; ?>
<input type="hidden"  id="batchANo_<?php echo $serial; ?>" value="<?php echo $data['batchNo']; ?>">
</td>
<td><?php echo $data['ctn']; ?>
<input type="hidden"  id="ctn_<?php echo $serial; ?>" value="<?php echo $data['ctn']; ?>">
</td>
<td><?php echo $data['pcs']; ?>
<input type="hidden"  id="pcs_<?php echo $serial; ?>" value="<?php echo $data['pcs']; ?>">
</td>
<td><?php echo $data['totalPcs']; ?>
<input type="hidden"  id="totalPcs_<?php echo $serial; ?>" value="<?php echo $data['totalPcs']; ?>">
</td>
<td><input type='text'  class="selectCtnClass"  id="selectCtn_<?php echo $serial;?>"  onchange="disableAllOtherTextBox(<?php echo $serial;?>);"  name="<?php echo $data['warehouseID'];?>" value="0"  onfocus="$(this).val('');"></td>
<td><input type='text'  class="selectCtnClass"  id="selectPcs_<?php echo $serial;?>"   onchange="disableAllOtherTextBox(<?php echo $serial;?>);" name="<?php echo $data['warehouseID'];?>" value="0"  onfocus="$(this).val('');" ></td>
</tr>
<?php 
$serial++;
}}?>
</table>
<input type="hidden" id="activeAvailabilityWarehouseID" >
<input type="hidden" name="itemCode" value="<?php echo $items[0]['itemCode']; ?>">
<input type="button" value="Submit" onclick="submitSelectQuantity();">
</form>
<input type="hidden" id="availabilityRowID" value="1">
<script>
function  disableAllOtherTextBox(id)
{
	var value = $('#selectCtn_'+id).val();
	if(!isNaN(value) && value.length > 0 && value > 0)
	{
		$('.selectCtnClass').attr("disabled", "disabled");
		$('#selectCtn_'+id).removeAttr("disabled");
		$('#selectPcs_'+id).removeAttr("disabled");
		$('#activeAvailabilityWarehouseID').val(id);
	}
	else
	{
		$('.selectCtnClass').removeAttr("disabled");
		$('#activeAvailabilityWarehouseID').val('');
	}
}
</script>



