<?php /* include "jqgrid_dist.php"; 
$g = new jqgrid();
$g->table = "transportermaster";
$grid["autowidth"] = true;
$g->set_options($grid);
$out = $g->render("1"); */ 
?>
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
</style>

<div align="center">
<form id='stockTransferInvoiceForm'>
<table style="width:45%;margin-top:2%;margin-left:2%;float:left;display:inline-block;border:0px solid #000000" >
<tr class='oddTr'>
<td class='labelTd'>Transporter Name</td>
<td><input type="text" name="transporterName" id="transporterName" /></td>
</tr>
<tr class='evenTr'>
  <td class='labelTd'>Address</td>
  <td><textarea name="address" id="address" cols="45" rows="5"></textarea></td>
</tr>
<tr class='oddTr'>
  <td class='labelTd'>Contact Name</td>
  <td><input type="text" name="from" id="from"></td>
</tr>
<tr class='evenTr'>
  <td class='labelTd'>Contact No</td>
  <td>&nbsp;</td>
</tr>
<tr class='evenTr'>
  <td class='oddTr'>Email</td>
  <td class="oddTr"><input type="text" name="to" id="to"></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;">
  <tr class='oddTr'>
    <td class='labelTd'>Service Tax No</td>
    <td><input type="text" name="transporter" id="transporter"></td>
  </tr>
  <tr class='evenTr'>
    <td class='labelTd'>PAN No.</td>
    <td><input type="text" name="lrNo" id="lrNo" /></td>
  </tr>
  <tr class='oddTr'>
    <td class='labelTd'>FSSAI Liecence No.</td>
    <td><input type="text" name="licenseNo" id="licenseNo" /></td>
  </tr>
  <tr class='evenTr'>
    <td class='labelTd'>Details For Delivery</td>
    <td><textarea name="detailsOfDelivery" id="detailsOfDelivery" cols="45" rows="5"></textarea></td>
  </tr>
  <tr class='oddTr'>
    <td class='labelTd'>Rate as Per State</td>
    <td><input type="text" name="textfield" id="textfield" /></td>
  </tr>
</table>
</form>

<hr style="visibility:hidden;clear:both;">
<br></br>
<p>
<input type="button" class="nu"  id='submitInvoice'  value="Add Transporter" style="clear:both;display:inline-block;margin-top:4%;margin:10px;" onclick="createInvoice();">