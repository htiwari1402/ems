<form id="accessControlForm">
<table>
<tr>
<td>Username</td>
<td><input type="text" name="username"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="password" id='password'></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input type="text" name="password" id='confirmPassword'></td>
</tr>
<tr>
<td>Employee ID</td>
<td><select name='empID'>
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
<tr>
<td>User Type</td>
<td>
<select name="type" id="type" onchange="loadAccessControlTypeID();">
<option value='HO'>Head Office</option>
<option value='Branch'>Branch</option>
<option value='CF'>C & F</option>
<option value='admin'>Admin</option>
</select>
</td>
</tr>
<tr>
<td>ID</td>
<td id='accessControlTypeID'>
</td>
</tr>
</table><br><br>
<input type='button' value='Submit' onclick='addAccessControl();'>
</form>