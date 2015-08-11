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
<form id='stockTransferInvoiceForm' style="margin-top:2%">
Enter new category: &nbsp;<input type="text" name="productCategory">
</form>
<hr style="visibility:hidden;clear:both;">
<br></br>
<p>
<input type="button" class="nu"  id='submitInvoice'  value="Add Product Category" style="clear:both;display:inline-block;margin-top:4%;margin:10px;" onclick="createInvoice();">