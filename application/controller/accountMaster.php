<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";

$g = new jqgrid();
$g->table = "accounttype";
$grid["autowidth"] = true;

$col = array();
$col["name"] = "AccountID";
$col["title"] = "Account ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "Account";
$col["title"] = "Account Name";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "AccountDescription";
$col["title"] = "Account Description";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "ParentAccountID";
$col["title"] = "Parent AccountID";
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
