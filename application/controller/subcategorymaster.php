<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
include "./gridOptionMaker.php";
$g = new jqgrid();
$g->table = "subcategorymaster";
$grid["autowidth"] = true;

$sql = "select * from `ems`.`subcategorymaster`";

$col = array();
$col["name"] = "subCategoryID";
$col["title"] = "Sub Category ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "subCategory";
$col["title"] = "Sub Category";
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
