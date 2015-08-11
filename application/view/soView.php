<table style='margin-top: 2%; width: 80%; border: 1px solid #666666;'>
<tr class='tableHeader'>
<td>Name</td>
<td>Contact</td>
<td>Address</td>
<td>Designation</td>
<td>Date of birth</td>
<td>Area code</td>
<td>Update</td>
</tr>
<?php 
foreach($soData as $key => $data)
{
?>
<tr>
<td><?php echo $data['name']; ?></td>
<td><?php echo $data['contact']; ?></td>
<td><?php echo $data['address']; ?></td>
<td><?php echo $data['designation']; ?></td>
<td><?php echo $data['dob']; ?></td>
<td><?php echo $data['areaCode']; ?></td>
<td><input type="button" class="nu smallButton" value="Update" onclick="showUpdateSo(<?php  echo $data['employeeID']; ?>);"></td>
</tr>
<?php 	
}
?>
</table>
<div id="soUpdateTable" style="display: inline-block;margin-top:2%;">
</div>