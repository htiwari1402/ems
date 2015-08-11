<div>
<table style='margin-top: 2%; width: 80%; border: 1px solid #666666;'>
<tr class='tableHeader'>
<td>Party Name</td>
<td>Type</td>
<td>Contact Number</td>
<td>Contact Person</td>
<td>Address</td>
<td>Update</td>
<td>Delete</td>
</tr>
<?php 
foreach($dcData as $key=>$data)
{
?>
<tr class="tableData">
<td><?php echo $data['partyName']; ?></td>
<td><?php if($data['dc'] == "d") { echo "Debtor"; } else { echo "Creditor"; } ?></td>
<td><?php echo $data['partyContactNumber']; ?></td>
<td><?php echo $data['contactPerson']; ?></td>
<td><?php echo $data['address']; ?></td>
<td><input  class="nu smallButton" type="button"   value="Update" onclick="updateDcAdditionalDetails(<?php  echo $data['id']; ?>);" ></td>
<td><input  class="nu smallButton" type="button"   value="Delete" onclick="deleteDc(<?php  echo $data['id']; ?>);" ></td>
</tr>
<?php 
}?>
</table>
</div>
<input id="deleteDcID"  type="hidden">
<div id="deleteConfirmtionDialog" style="display:none;">
Are you sure want to delete ??
</div>
<div id='dcAdditionalDetailDiv' style='margin-top:2%;'>
</div>