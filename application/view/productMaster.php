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
<td class='labelTd'>Product Category</td>
<td><select name="select" id="select">
</select></td>
</tr>
<tr class='evenTr'>
  <td class='labelTd'>Brand Name</td>
  <td><input type="text" name="transferSlipNo" id="transferSlipNo"></td>
</tr>
<tr class='oddTr'>
  <td class='labelTd'>Product Description</td>
  <td><input type="text" name="from" id="from"></td>
</tr>
<tr class='evenTr'>
  <td class='labelTd'>Unit</td>
  <td><input type="text" name="to" id="to"></td>
</tr>
</table>
<table style="width:45%;margin-top:2%;margin-right:2%;float:right;display:inline-block;">
  <tr class='oddTr'>
    <td class='labelTd'>Sales Rate</td>
    <td><input type="text" name="transporter" id="transporter"></td>
  </tr>
  <tr class='evenTr'>
    <td class='labelTd'>Packing</td>
    <td><input type="text" name="lrNo" id="lrNo"></td>
  </tr>
</table>
</form>
<hr style="visibility:hidden;clear:both;">
<br></br>
<p>
<input type="button" class="nu"  id='submitInvoice'  value="Add Product" style="clear:both;display:inline-block;margin-top:4%;margin:10px;" onclick="createInvoice();">