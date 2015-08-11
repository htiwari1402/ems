++<style>
.inventoryHeader
{
    background-color:#2293f7 ;
    border:1px solid #3e3e3e;
    color:#ffffff;
}
table,tr,td
{
  border:1px solid #3e3e3e;
}
</style>
<table style="width:80%;" cellspacing="0">
<tr class="inventoryHeader">
<td>Stock Transfer Note No</td>
<td>Date</td>
<td>Litres </td>
<td>Amount</td>
<td>Weight</td>
<td>Edit</td>
</tr>
<?php 
foreach($rows as $key=>$data)
{
	?>
<tr>
<td><?php echo $data['stockTransferInvoiceNo']; ?></td>
<td><?php echo $data['date']; ?></td>
<td><?php echo $data['totalLitres']; ?> </td>
<td><?php echo $data['totalAmount']; ?></td>
<td><?php echo $data['totalWeight']; ?></td>
<td><input type="button" value="EDIT" class="nu" onclick="editStockTransferInvoice(<?php echo $data['stockTransferInvoiceNo']; ?>)"></td>
</tr>	
	<?php 
}
echo "</table>";
//echo $select_command;
/* $g = new jqgrid();
$g->select_command = strval($select_command);
$grid["autowidth"] = true;


$g->set_columns($cols);
$g->set_options($grid);
$g->set_actions(array(
		"add"=>true, // allow/disallow add
		"edit"=>true, // allow/disallow edit
		"delete"=>true, // allow/disallow delete
		"rowactions"=>true, // show/hide row wise edit/del/save option
		"search" => "advance", // show single/multi field search condition (e.g. simple or advance)
		"showhidecolumns" => false
)
);
$out = $g->render("1");
echo "<div style='width:90%;'>";
echo $out;
echo "</div>"; */ 
?>