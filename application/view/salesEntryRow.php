<?php ?>
<tr class='evenTr'>
<td valign="top">
<select name='itemCode[]'  id='itemCode_<?php  echo $rowCount; ?>'  onchange="displayAvailabilityDetail(<?php  echo $rowCount; ?>);">
<option>select</option>
<?php
foreach ($allProduct as $key=>$data)
{?>
<option value="<?php echo $data['itemCode'];?>">
<?php echo $data['itemDesc']."(".$data['itemCode'].")";?>
</option>
<?php }
?>
</select>
</td>
<td valign="top"><input type="text"  class='smallInput' name="itemDesc[]" id="itemDesc_<?php  echo $rowCount; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="packing[]" id="packing_<?php  echo $rowCount; ?>"></td>
<td valign="top"><input type="text" class='smallInput'  name="godownNo[]" id="godownNo_<?php  echo $rowCount; ?>"></td>
<td valign="top"><input type="text" class='smallInput' name="batchNo[]" id="batchNo_<?php  echo $rowCount; ?>"></td>
<td valign="top"><input type="text" class='smallInput' class='date' name="mfgDate[]" id="mfgDate_<?php  echo $rowCount; ?>"></td>
<td valign="top"><input type="text" class='date smallInput' name="expDate[]" id="expDate_<?php  echo $rowCount; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="exFreeQty[]"></td>
<td valign="top"><input type="text"  class='smallInput' name="ctn[]" id='ctn_<?php  echo $rowCount; ?>'></td>
<td valign="top"><input type="text"  class='smallInput' name="pcs[]" id='pcs_<?php  echo $rowCount; ?>'></td>
<td valign="top"><input type="text"   class='smallInput' name="totalPcs[]" id='totalPcs_<?php  echo $rowCount; ?>' onfocus='calculateTotalPcs(<?php  echo $rowCount; ?>);'></td>
<td valign="top"><input type="text"  class='smallInput' name="rate[]" id="rate_<?php  echo $rowCount; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="amount[]" id='amount_<?php  echo $rowCount; ?>' onfocus='calculateAmount(<?php  echo $rowCount; ?>);'></td>
</tr>
