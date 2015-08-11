<style>
.smallButton
{
   font-size:10px;
}
</style>
<div align="center">
<form id="accountForm">
	<table style='margin-top: 2%; width: 80%; border: 1px solid #666666;'>
		<tr class='tableHeader'>
			<td>Account Name</td>
			<td>Account Description</td>
			<td>Parent Account</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
<?php
foreach ( $accountData as $key => $data ) {
	?>

<tr class='tableData'>

			<td>
			<span class="<?php  echo 'span'.$data['AccountID']; ?>"><?php echo $data['Account']; ?></span>
			<input name="account<?php echo $data['AccountID']; ?>" style="display:none;" class="<?php  echo 'input'.$data['AccountID']; ?>" type="text"  value="<?php echo $data['Account']; ?>">
			</td>
			<td>
			<span class="<?php  echo 'span'.$data['AccountID']; ?>"><?php echo $data['AccountDescription']; ?></span>
			<input name="accountDescription<?php echo $data['AccountID']; ?>" style="display:none;" class="<?php  echo 'input'.$data['AccountID']; ?>" type="text"  value="<?php echo $data['AccountDescription']; ?>">
			</td>
			<td>
			<span class="<?php  echo 'span'.$data['AccountID']; ?>"><?php echo $data['ParentAccount']; ?></span>
			<input name="parentAccount<?php echo $data['AccountID']; ?>" style="display:none;" class="<?php  echo 'input'.$data['AccountID']; ?>" type="text"  value="<?php echo $data['ParentAccount']; ?>">
			</td>
			<td>
			<input class="nu smallButton <?php  echo 'edit'.$data['AccountID']; ?>" type="button" value="Edit"  onclick="updateAccountType(<?php  echo $data['AccountID']; ?>);">
			<input style="display:none;" class="nu smallButton <?php  echo 'save'.$data['AccountID']; ?>" type="button" value="Save"  onclick="saveAccountType(<?php  echo $data['AccountID']; ?>);">
			</td>
			<td><input class="nu smallButton" type="button" value="Delete" onclick="deleteCurrentAccountDialog(<?php  echo $data['AccountID']; ?>)">
			</td>
</tr>

<?php
} ?>
</table>
</form>
<br><br>
<input type="button" class="nu smallButton" value="Add" onclick="addAccountTypeDialog();">

</div>
<div id='accountTypeDeleteConfirmDialog' style='display:none'>
Are you sure you want to delete this account  ?
</div>
<input id='currentAccountIDToDelete' type="hidden">

<div id='addNewAccountDialog' style='display:none;margin-top: 2%; width: 80%; border: 0px solid #666666;'>
       <form id="newAccountForm">
		<table style='margin-top: 2%; width: 80%; border: 1px solid #999999;'>
		<tr class='tableHeader'>
			<td>Account Name</td>
			<td>Account Description</td>
			<td>Parent Account</td>
			<td>&nbsp;</td>
			
		</tr>
		<tr>
		<td><input type="text" name="account"></td>
		<td><input type="text" name="accountDescription"></td>
		<td>
		<select name="parentAccountID">
        <?php 
        foreach( $accountData as $key => $data ) 
        {
        ?>
        <option value="<?php echo $data['AccountID']; ?>">
        <?php echo $data['Account']; ?>
        </option>
        <?php }?>
		</select>
		</td>
		<td><input type="button" value="Submit" class="nu smallButton" onclick="addCurrrentAccount();"></td>
		</tr>
		</table>
		</form>
</div>





