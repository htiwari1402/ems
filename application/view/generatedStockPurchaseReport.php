<?php 
$totalNoOfCartons = 0;
$totalAmountInCurrency = 0;
?>

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
table,td
{
   border : 1px solid #999999;
}
</style>
<div style="margin-top:1%;">
<table cellspacing ="0" style=" width:45%;margin-top:2%;margin-left:2%;float:left;display:inline-block;" >
<tr class='evenTr'>
<td class='labelTd'>Puchase Entry No</td>
<td><?php echo $invoiceDetails['purchaseEntryNo']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Date</td>
<td><?php echo $invoiceDetails['date']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Party Invoice No</td>
<td><?php echo $invoiceDetails['partyInvoiceNo']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Lot No</td>
<td><?php echo $invoiceDetails['lotNo']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Bill of Entry No</td>
<td><?php echo $invoiceDetails['billOfEntryNo']; ?></td>
</tr>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Order Number</td>
<td>
<?php echo $invoiceDetails['orderNo']; ?>
</td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Order Date</td>
<td>
<?php echo $invoiceDetails['orderDate']; ?>
</td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;" cellspacing=0>
<tr class='evenTr'>
<td class='labelTd'>Container No.</td>
<td><?php echo $invoiceDetails['containerNo']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Bill No</td>
<td><?php echo $invoiceDetails['blNo']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Currency name</td>
<td><?php echo $invoiceDetails['currencyName']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Currency Exchange Rate</td>
<td><?php echo $invoiceDetails['currencyRate']; ?></td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Supplier Name</td>
<td><?php echo $invoiceDetails['supplierName']; ?></td>
</tr>
<tr class='evenTr' >
<td class='labelTd'>Supplier Address</td>
<td>
<?php echo $invoiceDetails['supplierAddress']; ?>
</td>
</tr>
<tr class='evenTr' >
<td class='labelTd'>Custom Duty</td>
<td>
<?php echo "Rs ".$invoiceDetails['customDuty']; ?>
</td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Clearing and forwarding charges</td>
<td>
<?php echo "Rs ".$invoiceDetails['cfCharges']; ?>
</td>
</tr>
<tr class='evenTr' >
<td class='labelTd'>Shipment arrival date</td>
<td>
<?php echo $invoiceDetails['shipDate']; ?>
</td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>BL Date</td>
<td>
<?php echo $invoiceDetails['blDate']; ?>
</td>
</tr>
</table>
<hr style="clear:both;visibility:hidden">
<br><br><br>
<table style='display:block;clear:both;margin-top: 1%; width: 96%;font-size:12px;' cellspacing="0" border="0" >
<tr class='tableHeader' >
<td>Item Code</td>
<td>Item Description</td>
<td>Packing</td>
<td>Godown No.</td>
<td>Batch No.</td>
<td>Mfg. Date</td>
<td>Exp. Date</td>
 <td>Ex. Free Qty</td> 
<td>Ctn</td>
<td>Pcs</td>
<td>Total Pcs</td>
<td>Rate/pc</td>
<td>Amount(in currency)</td>
<td>Amount</td>
</tr>
<?php 
foreach($salesDetails as $key=>$data)
{
	$totalNoOfCartons = $totalNoOfCartons + $data['ctn'];
	$totalAmountInCurrency = $totalAmountInCurrency + $data['amountCurr'];
?>
<tr>
<td><?php echo $data['itemCode'];?></td>
<td><?php echo $data['itemDesc']; ?></td>
<td><?php echo $data['packing']; ?></td>
<td><?php echo $data['godownNo']; ?></td>
<td><?php echo $data['batchNo']; ?></td>
<td><?php echo $data['mfgDate']; ?></td>
<td><?php echo $data['expDate']; ?></td>
<td><?php echo $data['exFreeQty']; ?></td>
<td><?php echo $data['ctn']; ?></td>
<td><?php echo $data['pcs']; ?></td>
<td><?php echo $data['totalPcs']; ?></td>
<td><?php echo $data['rate']; ?></td>
<td align="right"><?php echo " ".$data['amountCurr']; ?></td>
<td align="right"><?php echo "Rs. ".$data['amount']; ?></td>
</tr>
<?php
}?>
<tr>
<td colspan=8>Totals</td>
<td align="right"><?php echo $totalNoOfCartons; ?></td>
<td colspan=3>&nbsp;</td>
<td align="right"><?php echo $totalAmountInCurrency; ?></td>
<td align="right"><?php echo "Rs. ".$invoiceDetails['totalAmount']; ?></td>
</tr>
</table>
</div>
<table cellspacing=0 style="float:left;margin-top:1%;margin-left: 2%;width:30%">
<tr>
<td class='oddTr'>Total Weight</td>
<td align="right"><?php echo $invoiceDetails['totalWeight']." Kg. "; ?></td>
</tr>
<tr>
<td class='oddTr' >Total Litres</td>
<td align="right"><?php echo $invoiceDetails['totalLitres']." Litres"; ?></td>
</tr>
</table>

