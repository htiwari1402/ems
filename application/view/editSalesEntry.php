<style>
.labelTd
{
width:30%;
}

.evenTr
{
  background-color:#f9f9f9;
}
.oddTr
{
background-color:#FAFFBD;
}
.salesEntryInput
{
  width:2%;
}
.smallInput
{
    width:80px;
}
table, tr, td
{
   border: 1px solid #999999;
}
</style>

<div align="center">
<div id='salesTypeDiv' style="display:none;">
<span id='salesTypeSpan'>Select sales type: </span>
<select id="salesTypeSelect" onchange="generateSalesInvoiceNo();">
<option value="">Select</option>
<option value="SA">State Sales</option>
<option value="SR">Return</option>
<option value="CST">CST Sales</option>
</select>
<?php 
if($_SESSION['type'] == 'HO')
{
?>
<select id="mhMu" onchange="generateSalesInvoiceNo();">
<option value="0">Select</option>
<option value="MH">Maharashtra</option>
<option value="MU">Mumbai</option>
</select>
<?php 
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;
<!-- <select id="salesOfcSelect" style="display:none;" onchange="loadLoc();">
<option value="">Select</option>
<option value="HO">HO</option>
<option value="Branch">Branch</option>
<option value="CF">C&F</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;-->
<select id="salesLocSelect"  style="display:none;" onchange="generateSalesInvoiceNo();">
<option value="">Select</option>
<?php 
foreach ($_SESSION['warehouseSummary']  as $key=>$data)
{ ?>
<option value="<?php echo $data['warehouseID'];?>">
<?php echo $data['name'];?>
</option>
<?php  }
?>
</select><br/>
<!-- <input type="button" class='nu smallButton' value="Next" onclick="selectSalesTypeAndNext();">-->
</div>
<form id='salesOrderEntryForm' >
<input type="hidden" name="fromType" value='<?php  echo $_SESSION['type']; ?>'>
<input type="hidden" name="fromTypeID" value='<?php  echo $_SESSION['typeID']; ?>'>
<table style="width:45%;margin-top:2%;margin-left:2%;float:left;" cellspacing="0" >
<tr class='evenTr'>
<td class='labelTd'>Invoice No</td>
<td>
<span id='invoiceNoSpan'><?php echo $invoiceDetails['invoiceNo']; ?></span>
<input type="hidden"  name="invoiceNo" id="invoiceNo"  value="<?php echo $invoiceDetails['invoiceNo']; ?>">
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Date</td>
<td><input type="text" class='date' name="date" value="<?php echo $invoiceDetails['date']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Party Name</td>
<td>
<select name='partyName' id='partyName'  >
<option>select</option>
<?php 
foreach($allAllowedDist as $key=>$data)
{?>
<option value="<?php echo $data['distID'];?>" onclick="setCurrentState(`<?php echo $data['state'];?>`)"   <?php  if($data['distID']== $invoiceDetails['partyName'] ){ echo "selected" ;}   ?>>                           
<?php echo $data['name'];?>
</option>
<?php }
?>
</select>
<input type="hidden" id='state' name='state' value="<?php  echo $invoiceDetails['state']; ?>">
<span style="display:none;" id='stateHtml'>

</span>
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Order No</td>
<td><input type="text" name="partyOrderNo"  value="<?php  echo $invoiceDetails['partyOrderNo']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Order Date</td>
<td><input type="text" class='date' name="orderDate" value="<?php  echo $invoiceDetails['orderDate']; ?>"></td>
</tr>
 </table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;" cellspacing="0" >
<tr class='evenTr'>
<td class='labelTd'>Transporter</td>
<td id='stateWiseTransporter'>
<select name='transporterID'>
<option>select</option>
<?php 
foreach ($allTransporter as $key=>$data)
{?>
<option value="<?php echo $data['transID'];?>" <?php  if($data['transID'] == $invoiceDetails['transporterID'] ) { echo "selected"; } ?>>
<?php echo $data['name'];?>
</option>
<?php }
?>
</select>
</td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>LR No.</td>
<td><input type="text" name="lrNo" value="<?php  echo $invoiceDetails['lrNo']; ?>"></td>
</tr>

<tr class='evenTr'>
<td class='labelTd'>Delivery Date</td>
<td><input type="text" class='date' name="deliveryDate"   value="<?php  echo $invoiceDetails['deliveryDate']; ?>"></td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Salesman</td>
<td id='stateWiseSalesman'>
<select name='salesmanID'>
<option>select</option>
<?php 
foreach ($allEmployees as $key=>$data)
{?>
<option value="<?php echo $data['empID'];?>"   <?php  if($data['empID'] == $invoiceDetails['salesmanID']) { echo "selected" ; } ?>>
<?php echo $data['name']."(".$data['empID'].")";?>
</option>
<?php }
?>
</select></td>
</tr>
</table>
</form>

<form id='salesEntryForm' >
<table id='salesEntryTable'  style="width:90%;margin-top:2%;margin-left:5%;float:left;font-size:12px;" cellspacing="0" >
<tr class='oddTr'>
<td><b>Item Code</b></td>
<td><b>Description</b></td>
<td><b>Packing</b></td>
<td><b>Godown No</b></td>
<td><b>Batch No</b></td>
<td><b>Mfg Date</b></td>
<td><b>Exp Date</b></td>
<td><b>Ex Free Qty</b></td>
<td><b>Ctn</b></td>
<td><b>Pcs</b></td>
<td><b>Total Pcs</b></td>
<td><b>Rate</b></td>
<td><b>Amount</b></td>
</tr>
<?php 
$itemCounts = 1;
foreach ($salesDetails as $k=>$salesData)
{
?>
<tr class='evenTr'>
<td valign="top">
<select name='itemCode[]'  id='itemCode_1'  onchange="displayAvailabilityDetail(1);">
<option>select</option>
<?php 
foreach ($allProduct as $key=>$data)
{?>
<option value="<?php echo $data['itemCode'];?>"   <?php if($data['itemCode'] == $salesData['itemCode']){ echo "selected";}?>>
<?php echo $data['itemDesc']."(".$data['itemCode'].")";?>
</option>
<?php }
?>
</select>
</td>
<td valign="top"><input type="text"  class='smallInput' name="itemDesc[]" id="itemDesc_<?php  echo $itemCounts; ?>" value="<?php echo $salesData['itemDesc']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="packing[]" id="packing_<?php  echo $itemCounts; ?>" value="<?php echo $salesData['packing']; ?>"></td>
<td valign="top"><input type="text" class='smallInput'  name="godownNo[]" id="godownNo_<?php  echo $itemCounts; ?>"   value="<?php echo $salesData['godownNo']; ?>"></td>
<td valign="top"><input type="text" class='smallInput' name="batchNo[]" id="batchNo_<?php  echo $itemCounts; ?>"  value="<?php echo $salesData['batchNo']; ?>"></td>
<td valign="top"><input type="text" class='smallInput' class='date' name="mfgDate[]" id="mfgDate_<?php  echo $itemCounts; ?>"  value="<?php echo $salesData['mfgDate']; ?>"></td>
<td valign="top"><input type="text" class='date smallInput' name="expDate[]" id="expDate_<?php  echo $itemCounts; ?>"  value="<?php echo $salesData['expDate']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="exFreeQty[]"></td>
<td valign="top"><input type="text"  class='smallInput' name="ctn[]" id='ctn_<?php  echo $itemCounts; ?>' value="<?php echo $salesData['ctn']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="pcs[]" id='pcs_<?php  echo $itemCounts; ?>'  value="<?php echo $salesData['pcs']; ?>"></td>
<td valign="top"><input type="text"   class='smallInput' name="totalPcs[]" id='totalPcs_<?php  echo $itemCounts; ?>' onfocus='calculateTotalPcs(<?php  echo $itemCounts; ?>);'  value="<?php echo $salesData['totalPcs']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="rate[]" id="rate_<?php  echo $itemCounts; ?>"  value="<?php echo $salesData['rate']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="amount[]" id='amount_<?php  echo $itemCounts; ?>' onfocus='calculateAmount(<?php  echo $itemCounts; ?>);'   value="<?php echo $salesData['amount']; ?>"></td>
</tr>
<?php 
$itemCounts++;
}
?>
</table>
<input type="hidden" name="rowCount" value="<?php  echo $itemCounts; ?>" id='rowCount'>
</form>
<input type='button' value='Add row +'  class='nu'  onclick="addAnotherRow('salesEntryTable');"  style="clear:both;display:block;float:left;margin-left:5%;">
<hr style="visibility:hidden;clear:both;">
<br></br>
<p>
<input type="button" class="nu"  id='submitInvoice'  value="Create Invoice" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="createInvoice();">
<input type="button" class="nu"   id='addNextEntryButton'  value="Add next entry" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="addSalesEntryAndNext();">
<input type="button" class="nu"   id='finishSalesEntry'  value="Finish sales entry" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="getSalesReportCurrent();">
<input type="button" class="nu"  id='submitInvoice'  value="Create Invoice" style="clear:both;margin-top:1%;margin:10px;" onclick="openConfirmationDialogEdit();">
</p>
</div>
<div id='testCode'>
</div>
<div id='availabilityDetail'>
</div>
<div align="center" id="confirmDialogEdit" style="display:none;font-size:14px;">
Do you want to submit and create this invoice?
<br><br>
<span style="color:#ff0000;">Note: Changes done could not be reverted.</span>
<br><br><br>
<input type="button" class="nu" value="Confirm"  onclick="submitEditSalesInvoice();$('#confirmDialogEdit').dialog('close');">
&nbsp;&nbsp;&nbsp;
<input type="button" class="nu" value="Cancel"  onclick="$('#confirmDialogEdit').dialog('close');">
</div>
















