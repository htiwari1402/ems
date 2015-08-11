<form id="updateDcAdditionalDetailsForm">
<table style="width:45%;margin-top:2%;margin-left:2%;float:left;display:inline-block;border:0px solid #000000" >
<tr class='evenTr'>
<td class='labelTd'>Debtor/ Creditor</td>
<td>
<select name="dc"><?php if( $adData['dc'] == 'd') { echo "Debtor";}  else { echo "Creditor";}?>
<option value="d"  <?php if( $adData['dc'] == 'd') { echo "selected";}  ?>  >Debtor</option>
<option value="c"  <?php if( $adData['dc'] == 'c') { echo "selected";}  ?>  >Creditor</option>
</select>
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Name</td>
<td><input type="text" name="partyName" value="<?php echo $adData['partyName']; ?>" >
</td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Address</td>
<td><textarea name="address"><?php echo $adData['address']; ?></textarea></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Contact Number</td>
<td><input type="text" name="partyContactNumber" value="<?php echo $adData['partyContactNumber']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Fax</td>
<td><input type="text" name="fax" value="<?php echo $adData['fax']; ?>"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Email</td>
<td><input type="text" name="email" value="<?php echo $adData['email']; ?>"></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;">
<tr class='oddTr'>
<td class='labelTd'>Contact Person</td>
<td><input type="text" name="contactPerson" value="<?php echo $adData['contactPerson']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Contact Number</td>
<td><input type="text" name="contactNumber" value="<?php echo $adData['contactNumber']; ?>"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Area Code</td>
<td><input type="text" name="areaCode" value="<?php echo $adData['areaCode']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Currency</td>
<td><input type="text" name="currency" value="<?php echo $adData['currency']; ?>"></td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Terms</td>
<td><input type="text" name="terms" value="<?php echo $adData['terms']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>CreditDays</td>
<td><input type="text" name="creditDays" value="<?php echo $adData['creditDays']; ?>"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Discount Category</td>
<td><input type="text" name="discountCategory" value="<?php echo $adData['discountCategory']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Discount Percentage</td>
<td><input type="text" name="discountPercent" value="<?php echo $adData['discountPercent']; ?>">
</td>
</tr>
</table>
<input style="clear:both;display:block;margin-top:2%;" type="button" value="Update" class="nu smallButton" onclick="submitupdateDcAdditionalDetailsForm(<?php  echo $adData['id']; ?>)">
</form>