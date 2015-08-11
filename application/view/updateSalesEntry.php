<style>
table tr td
{
	width:9%;
}
input
{
	font-size:12px;
	width:100%;
	height:100%;
}
.nu
{
	font-size:10px;
	width:100px;
	height:30px;
}
</style>
<div style="overflow:auto";>
<form id='updateSalesEntryForm'>
<table style='margin-top: 2%; width: 90%;font-size:12px;' cellspacing="0">
<tr class='tableHeader' >
<td>Invoice Number</td>
<td>Party Name</td>
<td>Party Order No</td>
<td>Transporter</td>
<td>LR No.</td>
<td>Order Date</td>
<td>Deivery Date</td>
<td>Salesman</td>
<td>Update</td>
<td>Edit</td>
<td>Delete</td>
</tr>
<?php 
$i = 0;
foreach($invoiceDetails as $key=>$data)
{
?>
<tr>
<td><?php echo $data['invoiceNo'];?></td>
<td><input type="text" name='partyName[]' value="<?php echo $data['partyName']; ?>"></td>
<td><input type="text" name='partyOrderNo[]' value="<?php echo $data['partyOrderNo']; ?>"></td>
<td><input type="text" name='transporterID[]' value="<?php echo $data['transporterID']; ?>"></td>
<td><input type="text" name='lrNo[]' value="<?php echo $data['lrNo']; ?>"></td>
<td><input type="text" name='orderDate[]' value="<?php echo $data['orderDate']; ?>"></td>
<td><input type="text" name='deliveryDate[]' value="<?php echo $data['deliveryDate']; ?>"></td>
<td><input type="text" name='salesmanID[]' value="<?php echo $data['salesmanID']; ?>"></td>
<td><input type="button" class='nu' value="Update" onclick="updateCurrentSalesInvoice(<?php echo $i.",'".$data['invoiceNo']."'";?> )"></td>
<td><input type="button" class='nu' value="Edit Sales Entry" onclick="editCurrentSalesInvoice(<?php echo $i.",'".$data['invoiceNo']."'";?>)"></td>
<td><input type="button" class='nu' value="Delete" onclick="deleteCurrentSalesInvoice(<?php echo $i.",'".$data['invoiceNo']."'";?>)"></td>
</tr>
<?php
$i++;
}?>
</table>
</form>
</div>