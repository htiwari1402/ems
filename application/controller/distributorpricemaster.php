<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
include "./gridOptionMaker.php";
$g = new jqgrid();
$g->table = "distributorretailpricemaster";
$grid["autowidth"] = true;

$sql = "select * from `ems`.`location` where `location_type`=1 and `parent_id` = 100";
$indianStates = fetch($sql);
$stateOptions["value"] = optionMaker($indianStates, "name", "name");

$sql = "select * from `ems`.`productmaster` ";
$product = fetch($sql);
$productOptions["value"] = optionMaker($product, "itemCode", "itemDesc");

$col = array();
$col["name"] = "itemCode";
$col["title"] = "Item Code";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $productOptions;
$cols[] = $col;

$col = array();
$col["name"] = "itemDesc";
$col["title"] = "Item Description";
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
$col["name"] = "rate";
$col["title"] = "Basic Price";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "wef";
$col["title"] = "Effective Date";
$col["editable"] = true;
$cols[] = $col;

$g->set_columns($cols);  
$g->set_options($grid);
$g->set_actions(array(
		"add"=>true, // allow/disallow add
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
<script>
$(function(){
	$(document).on('click' ,'#wef', function()
			{
		            $('#wef').datepicker({dateFormat:"yy-mm-dd"});
			});	
	});
$(function(){
	$(document).on('change' ,'#itemCode', function()
			{
		            var itemCode = $('#itemCode').val();
		            $.post("./application/model/dao.php",
							"dao=getItemDetailsByCode&itemCode="+itemCode,
							function(data)
							{
					              $('#itemDesc').val(data);
							});
		            $('#wef').datepicker({dateFormat:"yy-mm-dd"});
			});	
	});
</script>
