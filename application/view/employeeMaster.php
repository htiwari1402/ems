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
<form id='soForm'>
<table style="width:45%;margin-top:2%;margin-left:2%;display:inline-block;border:0px solid #000000;float:left;" >
<tr class='evenTr'>
<td class='labelTd'>Name</td>
<td><input type="text" name="name"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Department</td>
<td>
<select name="department" id="select2">
<?php
foreach($departments as $key=>$data)
{?>
	<option value="<?php echo $data['deptCode'];?>">
    <?php echo $data['deptName'];?>
    </option>
<?php }
?>

</select></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Contact No</td>
<td><input type="text" name="contactNo" id="contactNo" /></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Address</td>
<td><textarea name="address" id="address" cols="45" rows="5"></textarea></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Email</td>
<td><input type="text" name="email"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Designation</td>
<td>
<select name="designation" id="select">
<?php
foreach($designations as $key=>$data)
{?>
	<option value="<?php echo $data['code'];?>">
    <?php echo $data['designation'];?>
    </option>
<?php }
?>

</select></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;display:inline-block;border:0px solid #000000;float:right" >
  <tr class='evenTr'>
    <td class='labelTd'>Incharge</td>
    <td><input type="text" name="incharge" id="incharge" /></td>
  </tr>
  <tr class='oddTr'>
    <td class='labelTd'>Date of Birth</td>
    <td><input type="text"  name="dob" id="dob" /></td>
  </tr>
  <tr class='evenTr'>
    <td class='labelTd'>Date of joining</td>
    <td><input type="text" name="doj" id="doj" /></td>
  </tr>
  <tr class='oddTr'>
    <td class='labelTd'>Pan No</td>
    <td><input type="text" name="panNo" id="panNo" /></td>
  </tr>
  <tr class='evenTr'>
    <td class='labelTd'>Bank Name</td>
    <td><input type="text" name="bankName" id="bankName" /></td>
  </tr>
  <tr class='oddTr'>
    <td class='labelTd'>Bank Branch</td>
    <td><input name="bankBranch" type="text" id="bankBranch" /></td>
  </tr>
  <tr class='evenTr'>
    <td class='evenTr'>Bank Account No.</td>
    <td class="evenTr"><input type="text" name="bankAccountNo" id="bankAccountNo" /></td>
  </tr>
</table>
</form>
</div>
<br/>
<hr style="visibility:hidden;margin-top:3%;">
<p style="margin-top:3%;">
<input type="button" class="nu" value="Add Employee" style="clear:both;display:block;margin-top:4%;float:right;margin-right:2%;" onclick="addEmployee();">
</p>