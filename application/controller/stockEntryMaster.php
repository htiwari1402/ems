<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
$g = new jqgrid();
$g->table = "stocktransferentry";
$grid["autowidth"] = true;

$col = array();
$col["name"] = "salesentryID";
$col["title"] = "Sales Entry ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "invoiceNo";
$col["title"] = "Invoice No";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "itemCode";
$col["title"] = "Item";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "itemDesc";
$col["title"] = "Description";
$col["editable"] = true;
$cols[] = $col;


$col = array();
$col["name"] = "packing";
$col["title"] = "Packing";
$col["editable"] = true;
$cols[] = $col;


$col = array();
$col["name"] = "godownNo";
$col["title"] = "Godown No.";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "batchNo";
$col["title"] = "Batch No.";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "mfgDate";
$col["title"] = "Mfg Date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "expDate";
$col["title"] = "Exp Date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "exFreeQty";
$col["title"] = "Ex Free Qty";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "ctn";
$col["title"] = "Ctn";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "pcs";
$col["title"] = "Pcs";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalPcs";
$col["title"] = "Total Pcs";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "rate";
$col["title"] = "Rate";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "amount";
$col["title"] = "Amount";
$col["editable"] = true;
$cols[] = $col; 

$col = array();
$col["name"] = "totalWeight";
$col["title"] = "Total Weight";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalLitres";
$col["title"] = "Total Litres";
$col["editable"] = true;
$cols[] = $col;

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
echo "</div>";
?>
