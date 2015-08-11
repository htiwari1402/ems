<table style="width:45%;margin-top:2%;margin-left:2%;float:left;display:inline-block;border:0px solid #000000" >
<tr class='evenTr'>
<td class='labelTd'>Debtor/ Creditor</td>
<td>
<?php if( $adData['dc'] == 'd') { echo "Debtor";}  else { echo "Creditor";}?>
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Name</td>
<td><?php echo $adData['partyName']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Address</td>
<td><?php echo $adData['address']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Contact Number</td>
<td><?php echo $adData['partyContactNumber']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Fax</td>
<td><?php echo $adData['fax']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Email</td>
<td><?php echo $adData['email']; ?></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;">
<tr class='oddTr'>
<td class='labelTd'>Contact Person</td>
<td><?php echo $adData['contactPerson']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Contact Number</td>
<td><?php echo $adData['contactNumber']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Area Code</td>
<td><?php echo $adData['areaCode']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Currency</td>
<td><?php echo $adData['currency']; ?></td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Terms</td>
<td><?php echo $adData['terms']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>CreditDays</td>
<td><?php echo $adData['creditDays']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Discount Category</td>
<td><?php echo $adData['discountCategory']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Discount Percentage</td>
<td><?php echo $adData['discountPercent']; ?></td>
</tr>
</table>