
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
.salesEntryInput
{
  width:90px;
}
.smallInput
{
    width:80px;
}
</style>
<?php 
//echo "<pre>";
//print_r($hoWarehouse);
?>
<div align="center">

<form id='stockPurchaseForm' >
<table style="width:45%;margin-top:2%;margin-left:2%;float:left;display:inline-block;border:0px solid #000000" >
<tr class='oddTr'>
<td class='labelTd'>Date</td>
<td><input type="text" class='date' name="date"  value="<?php  echo $invoiceDetails['date']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Purchase Entry Number</td>
<td>
<?php echo $invoiceDetails['purchaseEntryNo']; ?>
<input type="hidden" name='purchaseEntryNo'  id="purchaseEntryNo" value="<?php echo $invoiceDetails['purchaseEntryNo']; ?>">
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Party Invoice Number</td>
<td><input type="text" name="partyInvoiceNo" id="invoiceNo" value="<?php echo $invoiceDetails['partyInvoiceNo']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Party Inoice Date</td>
<td>
<input type="text" name="partyInvoiceDate" class="date" value="<?php echo $invoiceDetails['partyInvoiceDate']; ?>"> 
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Lot Number</td>
<td>
<input type="text" name="lotNo" value="<?php echo $invoiceDetails['lotNo']; ?>" > 
</td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Bill of entry number</td>
<td>
<input type="text" name="billOfEntryNo" value="<?php echo $invoiceDetails['billOfEntryNo']; ?>" > 
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Container Number</td>
<td>
<input type="text" name="containerNo"  value="<?php echo $invoiceDetails['containerNo']; ?>" > 
</td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Order Number</td>
<td>
<input type="text" name="orderNo"   value="<?php echo $invoiceDetails['orderNo']; ?>"> 
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Order Date</td>
<td>
<input type="text"  class="date" name="orderDate"   value="<?php echo $invoiceDetails['orderDate']; ?>"> 
</td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;">
<tr class='evenTr'>
<td class='labelTd'>BL Number</td>
<td><input type="text" name="blNo"   value="<?php echo $invoiceDetails['blNo']; ?>"></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Currency name</td>
<td>
<select name='currencyName' id='currencyName'  onchange="loadCurrencySign();" >
<option>select</option>
<?php 
foreach ($allCurrency as $key=>$data)
{?>
<option value="<?php echo $data['currencyName'];?>" <?php  if($data['currencyName'] == $invoiceDetails['currencyName'])  { echo "selected"; } ?>>
<?php echo $data['currencyName'];?>
</option>
<?php }
?>
</select>
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Currency Exchange Rate</td>
<td><input type="text" id='currencyRate' name="currencyRate" value="<?php  echo $invoiceDetails['currencyRate']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Supplier Name</td>
<td>
<select  id='supplierName'  onchange="loadCreditorDetails();">
<option>select</option>
<?php 
foreach ($allCreditors as $key=>$data)
{?>
<option value="<?php echo $data['id'];?>" <?php  if($data['partyName'] == $invoiceDetails['supplierName'])  { echo "selected"; } ?>>
<?php echo $data['partyName'];?>
</option>
<?php }
?>
</select>
<input type="hidden" name='supplierName' id='supplierShowName' value="<?php  echo $invoiceDetails['supplierName']; ?>">
</td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Supplier Address</td>
<td>
<textarea name='supplierAddress' id='supplierAddress' >
<?php  echo $invoiceDetails['supplierAddress']; ?>
</textarea>
</td>
</tr>
<tr class='evenTr' >
<td class='labelTd'>Custom Duty</td>
<td>
<input type="text" name='customDuty' value="<?php  echo $invoiceDetails['customDuty']; ?>">
</td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Clearing and forwarding charges</td>
<td>
<input type="text" name='cfCharges' value="<?php  echo $invoiceDetails['cfCharges'];?>">
</td>
</tr>
<tr class='evenTr' >
<td class='labelTd'>Shipment arrival date</td>
<td>
<input type="text" class="date"  name='shipDate'  value="<?php  echo $invoiceDetails['shipDate'];?>">
</td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>BL Date</td>
<td>
<input type="text" class="date"  name='blDate'  value="<?php  echo $invoiceDetails['blDate'];?>">
</td>
</tr>
</table>
</form>
<form id='stockPurchaseEntryForm' >
<table id='salesEntryTable'  style="width:90%;margin-top:2%;margin-left:5%;float:left;display:inline-block;border:0px solid #000000;font-size:12px;" >
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
<td><b>Rate/Pcs</b></td>
<td><b>Amount(Currency)</b></td>
<td><b>Amount(INR)</b></td>
</tr>
<?php 
$itemCounts = 1;
foreach($salesDetails as $key=>$salesData)
{

?>
<tr class='evenTr'>
<td valign="top">
<select name='itemCode[]'  id='itemCode_<?php echo $itemCounts; ?>'  onchange="displayAvailabilityDetailSP(<?php echo $itemCounts; ?>);">
<option>select</option>
<?php 
foreach ($allProduct as $key=>$data)
{?>
<option value="<?php echo $data['itemCode'];?>"  <?php  if($data['itemCode']==$salesData['itemCode']){ echo "selected"; } ?>>
<?php echo $data['itemDesc']."(".$data['itemCode'].")";?>
</option>
<?php }
?>
</select>
</td>
<td valign="top"><input type="text"  class='smallInput' name="itemDesc[]" id="itemDesc_<?php echo $itemCounts;?>" value="<?php  echo $salesData['itemDesc']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="packing[]" id="packing_<?php echo $itemCounts;?>"  value="<?php  echo $salesData['packing']; ?>"></td>
<!-- <td valign="top"><input type="text" class='smallInput'  name="godownNo[]" id="godownNo_<?php echo $itemCounts;?>"></td> -->
<td valign="top">
<select name='godownNo[]' id='godownNo_<?php echo $itemCounts;?>'  class='smallInput' >
<option>select</option>
<?php 
foreach ($hoWarehouse as $key=>$data)
{?>
<option value="<?php echo $data['warehouseID'];?>"  <?php  if($data['warehouseID']==$salesData['godownNo']){ echo "selected"; } ?>>
<?php echo $data['name'];?>
</option>
<?php }
?>
</select></td>
<td valign="top"><input type="text" class='smallInput' name="batchNo[]" id="batchNo_<?php echo $itemCounts;?>" value="<?php  echo $salesData['batchNo']; ?>"></td>
<td valign="top"><input type="text" class='date smallInput' class='date' name="mfgDate[]" id="mfgDate_<?php echo $itemCounts;?>" value="<?php  echo $salesData['mfgDate']; ?>"></td>
<td valign="top"><input type="text" class='date smallInput' name="expDate[]" id="expDate_<?php echo $itemCounts;?>" value="<?php  echo $salesData['expDate']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="exFreeQty[]"></td>
<td valign="top"><input type="text"  class='smallInput' name="ctn[]" id='ctn_<?php echo $itemCounts;?>'  value="<?php  echo $salesData['ctn']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="pcs[]" id='pcs_<?php echo $itemCounts;?>'  value="<?php  echo $salesData['pcs']; ?>"></td>
<td valign="top"><input type="text"   class='smallInput' name="totalPcs[]" id='totalPcs_<?php echo $itemCounts;?>'  onfocus='calculateTotalPcs(<?php echo $itemCounts;?>);'   value="<?php  echo $salesData['totalPcs']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="rate[]" id="rate_<?php echo $itemCounts;?>"  value="<?php  echo $salesData['rate']; ?>"></td>
<td valign="top"><span class='currencySignID'></span><input type="text"  class='smallInput' name="amountCurr[]" id='amountCurr_<?php echo $itemCounts;?>'  onfocus='calculateAmountCurr(<?php echo $itemCounts;?>);'     value="<?php  echo $salesData['amountCurr']; ?>"></td>
<td valign="top"><span>Rs.</span><input type="text"  class='smallInput' name="amount[]" id='amount_<?php echo $itemCounts;?>'  onfocus='calculateAmountInr(<?php echo $itemCounts;?>);'    value="<?php  echo $salesData['amount']; ?>"></td>
</tr>
<?php
$itemCounts++;
} 

?>
</table>
<input type="hidden" name="rowCount" value="<?php  echo $itemCounts; ?>" id='rowCount'>
</form>
<input type='button' value='Add row +'  class='nu'  onclick="addAnotherRowSP('salesEntryTable');"  style="clear:both;display:block;">
<hr style="visibility:hidden;clear:both;">
<br></br>
<p>
<input type="button" class="nu"  id='submitInvoice'  value="Create Invoice" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="createInvoiceStockPurchase();">
<input type="button" class="nu"   id='addNextEntryButton'  value="Submit and add next entry" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="addStockPurchaseEntryAndNext();">
<input type="button" class="nu"   id='finishSalesEntry'  value="Finish purchase entry" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="getStockPurchase();">
<input type="button" class="nu"  id='submitInvoice'  value="Create Invoice" style="clear:both;margin-top:1%;margin:10px;" onclick="submitEditStockPurchase();">
</p>
</div>
<div id='testCode'>
</div>
<div id='availabilityDetail'>
</div>
















