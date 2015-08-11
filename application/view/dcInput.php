<style>
.labelTd
{
width:30%;
}
table tr td
{
  border :0px solid #000000;
}
.evenTr
{
  background-color:#f9f9f9;
}
.oddTr
{
background-color:#FAFFBD;
}
</style>

<div align="center">
<form id='dcForm'>
<table style="width:45%;margin-top:2%;margin-left:2%;float:left;display:inline-block;border:0px solid #000000" >
<tr class='oddTr'>
<td class='labelTd'>Debtor/ Creditor</td>
<td>
<select name="dc">
<option value="d">Debtor</option>
<option value="c">Creditor</option>
</select>
</td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Associated Officer</td>
<td><select name='associatedOfficer'>
<option>select</option>
<?php 
foreach ($allEmployees as $key=>$data)
{?>
<option value="<?php echo $data['empID'];?>">
<?php echo $data['name']."(".$data['empID'].")";?>
</option>
<?php }
?>
</select></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Name</td>
<td><input type="text"  name="partyName"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Address</td>
<td><textarea name="address"></textarea></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Contact Number</td>
<td><input type="text" name="partyContactNumber"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Fax</td>
<td><input type="text" name="fax"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Email</td>
<td><input type="text" name="email"></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;">
<tr class='oddTr'>
<td class='labelTd'>Contact Person</td>
<td><input type="text" name="contactPerson"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Contact Number</td>
<td><input type="text" name="contactNumber"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Area Code</td>
<td><select name='areaCode'>
<option>select</option>
<?php 
foreach ($allArea as $key=>$data)
{?>
<option value="<?php echo $data['areaID'];?>">
<?php echo $data['areaCode']."(".$data['areaID'].")";?>
</option>
<?php }
?>
</select></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Currency</td>
<td><input type="text" name="currency"></td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Terms</td>
<td><textarea name="terms"></textarea></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>CreditDays</td>
<td><input type="text" name="creditDays"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Discount Category</td>
<td><input type="text" name="discountCategory"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Discount Percentage</td>
<td><input type="text" name="discountPercent"></td>
</tr>
</table>
</form>
<hr style="margin-top:20%;display:block;clear:both;visibility:hidden">
</div>
<p><input type="button" class="nu" value="Add +" style="clear:both;display:block;margin-top:2%;" onclick="createDc();"></p>