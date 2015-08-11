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
<td class='labelTd'>Stock Transfer Note No</td>
<td><?php echo $invoiceDetails['stockTransferInvoiceNo']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Date</td>
<td><?php echo $invoiceDetails['date']; ?></td>
</tr>
<!-- 
<tr class='evenTr'>
<td class='labelTd'>Transfer Slip No</td>
<td><?php echo $invoiceDetails['transferSlipNo']; ?></td>
</tr>-->
<tr class='oddTr'>
<td class='labelTd'>From </td>
<td><?php echo $_SESSION['partyName']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>To Warehouse</td>
<td><?php echo $invoiceDetails['to']; ?></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;" cellspacing=0>
<tr class='evenTr'>
<td class='labelTd'>LR No.</td>
<td><?php echo $invoiceDetails['lrNo']; ?></td>
</tr>
<tr class='oddTr'>
<td class='labelTd'>Transporter</td>
<td><?php echo $invoiceDetails['transporter']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Deivery Date</td>
<td><?php echo $invoiceDetails['deliveryDate']; ?></td>
</tr>
<tr class='oddTr' >
<td class='labelTd'>Delivery Status</td>
<td><?php echo $invoiceDetails['deliveryStatus']; ?></td>
</tr>
<tr class='evenTr'>
<td class='labelTd'>Remark</td>
<td>
Good transfer against form F
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
<td>Amount</td>
</tr>
<?php 
foreach($salesDetails as $key=>$data)
{
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
<td align="right"><?php echo "Rs. ".number_format($data['amount'],2); ?></td>
</tr>
<?php
}?>
<tr>
<td colspan=12>Total Amount</td>
<td align="right"><?php echo "Rs. ".number_format($invoiceDetails['totalAmount'],2); ?></td>
</tr>
</table>
</div>
<table cellspacing=0 style="float:left;margin-top:1%;margin-left: 2%;width:30%">
<tr>
<td class='oddTr'>Total Weight</td>
<td align="right"><?php echo number_format($invoiceDetails['totalWeight'],2)." Kg. "; ?></td>
</tr>
<tr>
<td class='oddTr' >Total Litres</td>
<td align="right"><?php echo number_format($invoiceDetails['totalLitres'],2)." Litres"; ?></td>
</tr>
</table>

