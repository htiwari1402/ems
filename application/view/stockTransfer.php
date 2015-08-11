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
<input type="hidden" name="rowCount" value=1 id='rowCount'>
<form id='stockTransferInvoiceForm'>
From  <?php echo $_SESSION['partyName']; ?>
<?php //print_r($_SESSION['warehouseSummary']); ?>
<input type="hidden" id = 'fromWareHouse' name='from'  value="<?php  echo $_SESSION['warehouseSummary'][0]['warehouseID'];?>" >
&nbsp;&nbsp;&nbsp;&nbsp;
To 
: 
<!-- <select id='toWareHouse' name='to'  onchange="generateStockTransferInvoiceNo();">
<option>select</option>
<?php 
foreach ($allWarehouse  as $key=>$data)
{?>
<option value="<?php //echo $data['warehouseID'];?>">
<?php //echo $data['name'];?>
</option>
<?php }
?>
</select>-->
Select Type: 
<select id="type" onchange="getTypeIDForType();">
<option value="">select</option>
<option value="Branch">Branch</option>
<option value="HO">HO</option>
<option value="CF">C&F</option>
</select>
Select Name:
<select id="typeID" onchange="getWarehouseIDByTypeAndTypeID();">
</select>
<input type="hidden" name="to" id="to">
<input type="hidden" name="state" id="state">
<hr style="visibility: hidden">

<table style="width:45%;margin-top:2%;margin-left:2%;float:left;" >
<tr class='evenTr'>
<td class='labelTd'>Stock Transfer Note No</td>
<td>
<span id='invoiceNoSpan'></span>
<input type="hidden"  name="stockTransferInvoiceNo" id="invoiceNo">
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Transfer Date</td>
<td><input type="text"  name="date" class='date'></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;">
  <tr class='oddTr'>
    <td class='labelTd'>Transporter</td>
    <td><select name='transporter'>
<option>select</option>
<?php 
foreach ($allTransporter as $key=>$data)
{?>
<option value="<?php echo $data['transID'];?>">
<?php echo $data['name'];?>
</option>
<?php }
?>
</select></td>
  </tr>
  <tr class='evenTr'>
    <td class='labelTd'>LR No.</td>
    <td><input type="text" name="lrNo" id="lrNo"></td>
  </tr>
<tr class='oddTr'>
  <td class='labelTd'>Delivery Status</td>
  <td><select name="deliveryStatus" id="deliveryStatus">
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
  <td><input type="text" name="deliveryDate" class='date'></td>
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
<tr class='evenTr'>
<td valign="top">
<select name='itemCode[]'  id='itemCode_1'  onchange="displayAvailabilityDetail(1);">
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
<td valign="top"><input type="text"  class='smallInput' name="itemDesc[]" id="itemDesc_1"></td>
<td valign="top"><input type="text"  class='smallInput' name="packing[]" id="packing_1"></td>
<td valign="top"><input type="text" class='smallInput'  name="godownNo[]" id="godownNo_1"></td>
<td valign="top"><input type="text" class='smallInput' name="batchNo[]" id="batchNo_1"></td>
<td valign="top"><input type="text" class='smallInput' class='date' name="mfgDate[]" id="mfgDate_1"></td>
<td valign="top"><input type="text" class='date smallInput' name="expDate[]" id="expDate_1"></td>
<td valign="top"><input type="text"  class='smallInput' name="exFreeQty[]"></td>
<td valign="top"><input type="text"  class='smallInput' name="ctn[]" id='ctn_1'></td>
<td valign="top"><input type="text"  class='smallInput' name="pcs[]" id='pcs_1'></td>
<td valign="top"><input type="text"   class='smallInput' name="totalPcs[]" id='totalPcs_1' onfocus='calculateTotalPcs(1);'></td>
<td valign="top"><input type="text"  class='smallInput' name="rate[]" id="rate_1"></td>
<td valign="top"><input type="text"  class='smallInput' name="amount[]" id='amount_1' onfocus='calculateAmount(1);'></td>
</tr>
</table>
</form>
<input type='button' value='Add row +'  class='nu'  onclick="addAnotherRow('salesEntryTable');"  style="clear:both;display:block;">
<hr style="visibility:hidden;clear:both;">
<br></br>
<p>
<input type="button" class="nu"  id='submitInvoice'  value="Create Invoice" style="clear:both;margin-top:1%;margin:10px;" onclick="openConfirmationDialog();">
<input type="button" class="nu"  id='submitInvoice'  value="Create Stock Transfer Invoice" style="clear:both;margin-top:4%;margin:10px;display:none;" onclick="createStockTransferInvoice();">
<input type="button" class="nu"   id='addNextEntryButton'  value="Submit and add next entry" style="clear:both;display:none;margin-top:4%;margin:10px;" onclick="addStockTransferEntryAndNext()">
<input type="button" class="nu"   id='finishStockEntry'  value="Finish stock transfer" style="display:none;clear:both;margin-top:4%;margin:10px;" onclick="getInventory();">
</p>
</div>
<div id='availabilityDetail'>
</div>
<div align="center" id="confirmDialog" style="display:none;font-size:14px;">
Do you want to submit and create this invoice?
<br><br>
<span style="color:#ff0000;">Note: Changes done could not be reverted.</span>
<br><br><br>
<input type="button" class="nu" value="Confirm"  onclick="submitStockTransferInvoice();$('#confirmDialog').dialog('close');">
&nbsp;&nbsp;&nbsp;
<input type="button" class="nu" value="Cancel"  onclick="$('#confirmDialog').dialog('close');">
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