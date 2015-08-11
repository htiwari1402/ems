<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "./gridOptionMaker.php";
include "../../libs/inc/jqgrid_dist.php";
$g = new jqgrid();
$g->table = "taxstructure";
$grid["autowidth"] = true;

$sql = "select * from `ems`.`location` where `location_type`=1 and `parent_id` = 100";
$indianStates = fetch($sql);
$stateOptions["value"] = optionMaker($indianStates, "name", "name");

$sql = "select * from `ems`.`categorymaster`";
$category = fetch($sql);
$categoryOption["value"] = optionMaker($category,"categoryID","category"); 

$col = array();
$col["name"] = "taxID";
$col["title"] = "Tax ID";
$cols[] = $col;

$col = array();
$col["name"] = "taxCode";
$col["title"] = "Tax Code";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "areaCode";
$col["title"] = "Area Code";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "state";
$col["title"] = "State";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =$stateOptions;
$cols[] = $col;

$col = array();
$col["name"] = "vat";
$col["title"] = "VAT";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "cst";
$col["title"] = "CST";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "surcharge";
$col["title"] = "Surcharge";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "wef";
$col["title"] = "Effective date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "category";
$col["title"] = "Category";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =$categoryOption;
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
<script>
$(function(){
	$(document).on('click' ,'#wef', function()
			{
		            $('#wef').datepicker({dateFormat:"yy-mm-dd"});
			});	
	});
</script>