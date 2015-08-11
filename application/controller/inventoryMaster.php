<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";

$g = new jqgrid();
//$g->table = "inventorymanagement";
$g->select_command = "select `A`.`warehouseID`,`A`.`itemCode`,`B`.`itemDesc`, `A`.`batchNo`, `A`.`mfgDate`, `A`.`expDate`, `A`.`packing`, `A`.`ctn`, `A`.`pcs`, `A`.`totalPcs`  from `inventorymanagement` `A`, `productmaster` `B` where `A`.`itemCode` = `B`.`itemCode`";
$grid["autowidth"] = true;


$g->set_columns($cols);  
$g->set_options($grid);
$g->set_actions(array(
		"add"=>false, // allow/disallow add
		"edit"=>false, // allow/disallow edit
		"delete"=>false, // allow/disallow delete
		"rowactions"=>true, // show/hide row wise edit/del/save option
		"search" => "advance", // show single/multi field search condition (e.g. simple or advance)
		"showhidecolumns" => false
)
);
$out = $g->render("1");
echo "<div style='width:90%;'>";
echo $out;
echo "</div>";
?>
