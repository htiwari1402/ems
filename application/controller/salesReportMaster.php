<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";

$g = new jqgrid();
//$g->table = "inventorymanagement";
$region = $_REQUEST['state'];
$startDate = $_REQUEST['startDate'];
$endDate = $_REQUEST['endDate'];
$parameter = $_REQUEST['param'];
if($_REQUEST['reportType'] == 'sr')
{
    $g->select_command ="SELECT *  FROM `ems`.`salesinvoice`";
}
else if($_REQUEST['reportType'] == 'spr')
{
	$g->select_command ="SELECT *  FROM `ems`.`salesinvoice` where `date` >= '$startDate' and `date` <= '$endDate' and `salesmanID`='$parameter' ";
}
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
echo "</div>";
?>

