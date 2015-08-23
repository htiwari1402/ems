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
  width:90px;
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
<?php 
/*  echo "<pre>";
print_r($_SESSION['warehouseDetails'] );  */
?>

<form id='stockTransferInvoiceForm'>
From  <?php echo $_SESSION['partyName']; ?>
<?php //print_r($_SESSION['warehouseSummary']); ?>
<input type="hidden" id = 'fromWareHouse' name='from'  value="<?php  echo $_SESSION['warehouseSummary'][0]['warehouseID'];?>" >
&nbsp;&nbsp;&nbsp;&nbsp;
To 
:  <?php echo $toPartyName; ?>
<input type="hidden" name="to" id="to" value="<?php  echo $invoiceDetails['to']; ?>">
<input type="hidden" name="state" id="state" value="<?php  echo $invoiceDetails['state']?>">
<hr style="visibility: hidden">

<table style="width:45%;margin-top:2%;margin-left:2%;float:left;" >
<tr class='evenTr'>
<td class='labelTd'>Stock Transfer Note No</td>
<td>
<span id='invoiceNoSpan'><?php echo $invoiceDetails['stockTransferInvoiceNo']; ?></span>
<input type="hidden"  name="stockTransferInvoiceNo" id="invoiceNo" value="<?php echo $invoiceDetails['stockTransferInvoiceNo']; ?>">
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Transfer Date</td>
<td><input type="text"  name="date" class='date' value="<?php echo $invoiceDetails['date']; ?>"></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;">
  <tr class='oddTr'>
    <td class='labelTd'>Transporter</td>
    <td><select name='transporter' >
<option>select</option>
<?php 
foreach ($allTransporter as $key=>$data)
{?>
<option value="<?php echo $data['transID'];?>"  <?php  if($data['transID']==$invoiceDetails['transporter']) { echo "selected";} ?>>
<?php echo $data['name'];?>
</option>
<?php }
?>
</select></td>
  </tr>
  <tr class='evenTr'>
    <td class='labelTd'>LR No.</td>
    <td><input type="text" name="lrNo" id="lrNo" value="<?php  echo $invoiceDetails['lrNo']; ?>"></td>
  </tr>
<tr class='oddTr'>
  <td class='labelTd'>Delivery Status</td>
  <td><select name="deliveryStatus" id="deliveryStatus" value="Dispatched">
  <option value="Dispatched">
  Dispatched
  </option>
    <option value="Dispatched">
   In  Transit
  </option>
    <option value="Dispatched">
  Delivered
  </option>
  </select></td>
</tr>
<tr class='evenTr'>
  <td class='labelTd'>Deivery Date</td>
  <td><input type="text" name="deliveryDate" class='date' value="<?php  echo $invoiceDetails['deliveryDate']; ?>"></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Remark</td>
<td>
Good transfer against form F
</td>
</tr>
</table>
</form>
<form id='stockTransferEntryForm' >
<table id='salesEntryTable'  style="width:90%;margin-top:2%;margin-left:5%;float:left;font-size:12px;" >
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
foreach ($salesDetails as $itemKey=>$itemData)
{?>
<tr class='evenTr'>
<td valign="top">
<select name='itemCode[]'  id='itemCode_<?php echo $itemCounts;?>'  onchange="displayAvailabilityDetail(<?php echo $itemCounts;?>);">
<option>select</option>
<?php 
foreach ($allProduct as $key=>$data)
{?>
<option value="<?php echo $data['itemCode'];?>"   <?php if($data['itemCode'] == $itemData['itemCode']){ echo "selected";}?>>
<?php echo $data['itemDesc']."(".$data['itemCode'].")";?>
</option>
<?php }
?>
</select>
</td>
<td valign="top"><input type="text"  class='smallInput' name="itemDesc[]" id="itemDesc_<?php echo $itemCounts;?>"  value="<?php  echo $itemData['itemDesc']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="packing[]" id="packing_<?php echo $itemCounts;?>" value="<?php  echo $itemData['packing']; ?>"></td>
<td valign="top"><input type="text" class='smallInput'  name="godownNo[]" id="godownNo_<?php echo $itemCounts;?>" value="<?php  echo $itemData['godownNo']; ?>"></td>
<td valign="top"><input type="text" class='smallInput' name="batchNo[]" id="batchNo_<?php echo $itemCounts;?>"  value="<?php  echo $itemData['batchNo']; ?>"></td>
<td valign="top"><input type="text" class='smallInput' class='date' name="mfgDate[]" id="mfgDate_<?php echo $itemCounts;?>" value="<?php  echo $itemData['mfgDate']; ?>"></td>
<td valign="top"><input type="text" class='date smallInput' name="expDate[]" id="expDate_<?php echo $itemCounts;?>" value="<?php  echo $itemData['expDate']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="exFreeQty[]"></td>
<td valign="top"><input type="text"  class='smallInput' name="ctn[]" id='ctn_<?php echo $itemCounts;?>' value="<?php  echo $itemData['ctn']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="pcs[]" id='pcs_<?php echo $itemCounts;?>' value="<?php  echo $itemData['pcs']; ?>"></td>
<td valign="top"><input type="text"   class='smallInput' name="totalPcs[]" id='totalPcs_<?php echo $itemCounts;?>' onfocus='calculateTotalPcs(1);' value="<?php  echo $itemData['totalPcs']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="rate[]" id="rate_<?php echo $itemCounts;?>" value="<?php  echo $itemData['rate']; ?>"></td>
<td valign="top"><input type="text"  class='smallInput' name="amount[]" id='amount_<?php echo $itemCounts;?>' onfocus='calculateAmount(1);' value="<?php  echo $itemData['amount']; ?>"></td>
</tr>
<?php 
$itemCounts++;
}
?>
</table>
</form>
<input type='button' value='Add row +'  class='nu'  onclick="addAnotherRow('salesEntryTable');"  style="clear:both;display:block;">
<hr style="visibility:hidden;clear:both;">
<br></br>
<p>
<input type="button" class="nu"  id='submitInvoice'  value="Create Invoice" style="clear:both;margin-top:1%;margin:10px;" onclick="openConfirmationDialogEditStock();">
<input type="button" class="nu"  id='submitInvoice'  value="Create Stock Transfer Invoice" style="clear:both;margin-top:4%;margin:10px;display:none;" onclick="createStockTransferInvoice();">
<input type="button" class="nu"   id='addNextEntryButton'  value="Submit and add next entry" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="addStockTransferEntryAndNext()">
<input type="button" class="nu"   id='finishStockEntry'  value="Finish stock transfer" style="display:none;clear:both;margin-top:4%;margin:10px;" onclick="getInventory();">
</p>
</div>

<input type="hidden" name="rowCount" value='<?php echo($itemCounts); ?>' id='rowCount'>

<div id='availabilityDetail'>
</div>
<div align="center" id="confirmDialogEditStock" style="display:none;font-size:14px;">
Do you want to submit and create this invoice?
<br><br>
<span style="color:#ff0000;">Note: Changes done could not be reverted.</span>
<br><br><br>
<input type="button" class="nu" value="Confirm"  onclick="submitEditStockTransferInvoice();$('#confirmDialogEditStock').dialog('close');">
&nbsp;&nbsp;&nbsp;
<input type="button" class="nu" value="Cancel"  onclick="$('#confirmDialogEditStock').dialog('close');">
</div>
<script>
function getTypeIDForType()
{
var type= $('#type').val();
$.post("./application/controller/control.php",
				"a=getTypeIDByType&type="+type,
				function(data)
				{
		              $('#typeID').html(data);
				});
}
function getWarehouseIDByTypeAndTypeID()
{
	var type = $('#type').val();
	var typeID = $('#typeID').val();
	$.post("./application/controller/control.php",
			"a=getWarehouseIDByTypeAndTypeID&type="+type+"&typeID="+typeID,
			function(data)
			{
		           data = data.trim();
	              $('#to').val(data);
	              generateStockTransferInvoiceNo();
			});
	$.post("./application/controller/control.php",
                    "a=getStateByTypeID&type="+type+"&typeID="+typeID,
                    function(data)
                    {
		                  data = data.trim();
		                  $('#state').val(data);
                    });
}
</script>