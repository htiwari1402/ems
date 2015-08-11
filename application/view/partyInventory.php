<?php
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";

$warehouseID = $_REQUEST['warehouseID'];

/* echo $warehouseID;

 */
//$g->table = "inventorymanagement";
$select_command = " select  `B`.`itemDesc` ,`A`.*  from `inventorymanagement` `A`,
		                                   `productmaster` `B` where `A`.`itemCode` = `B`.`itemCode` and `A`.`warehouseID` = ".strval($warehouseID);
$result = mysql_query($select_command);
$rows = array();
while ($row = mysql_fetch_assoc($result))
{
	$rows[] = $row;
}
?>
<style>
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
<table style="width:80%;">
<tr>
<td class="inventoryHeader">Item Code</td>
<td class="inventoryHeader">Item Description</td>
<td class="inventoryHeader">Batch No</td>
<td class="inventoryHeader">Mfg Date</td>
<td class="inventoryHeader">Exp Date</td>
<td class="inventoryHeader">Packing</td>
<td class="inventoryHeader">Carton</td>
<td class="inventoryHeader">Pieces</td>
<td class="inventoryHeader">Total Pieces</td>
</tr>
<?php 
foreach($rows as $key=>$data)
{
	if($data['totalPcs'] > 0)
	{
	?>
<tr>
<td><?php echo $data['itemCode']; ?></td>
<td><?php echo $data['itemDesc']; ?></td>
<td><?php echo $data['batchNo']; ?></td>
<td><?php echo $data['mfgDate']; ?></td>
<td><?php echo $data['expDate']; ?></td>
<td><?php echo $data['packing']; ?></td>
<td><?php echo $data['ctn']; ?></td>
<td><?php echo $data['pcs']; ?></td>
<td><?php echo $data['totalPcs']; ?></td>
</tr>	
	<?php 
	}
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
