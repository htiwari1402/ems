
<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
include "./gridOptionMaker.php";
$g = new jqgrid();
$g->table = "productmaster";
$grid["autowidth"] = true;

$sql = "select * from `ems`.`categorymaster`";
$allCategories = fetch($sql);
$categoryOptions["value"] = optionMaker($allCategories, "category", "category");

$sql = "select * from `ems`.`subcategorymaster`";
$allSubCategories = fetch($sql);
$subCategoryOptions["value"] = optionMaker($allSubCategories, "subCategory", "subCategory");

$sql = "select * from `ems`.`brandmaster`";
$allBrands = fetch($sql);
$subBrandOptions["value"] = optionMaker($allBrands, "brand", "brand");

$sql = "select * from `ems`.`unit`";
$allUnits= fetch($sql);
$unitOptions["value"] = optionMaker($allUnits, "unit", "unit");

$sql = "select * from `ems`.`packingunitmaster`";
$allPackingUnits= fetch($sql);
$packingUnitOptions["value"] = optionMaker($allPackingUnits, "packingunit", "packingunit");

$col = array();
$col["name"] = "itemCode";
$col["title"] = "Item";
$cols[] = $col;

$col = array();
$col["name"] = "productCategory";
$col["title"] = "Category";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $categoryOptions;
$cols[] = $col;

$col = array();
$col["name"] = "subCategory";
$col["title"] = "Sub Category";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $subCategoryOptions;
$cols[] = $col;

$col = array();
$col["name"] = "brand";
$col["title"] = "Brand";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $subBrandOptions;
$cols[] = $col;

$col = array();
$col["name"] = "itemDesc";
$col["title"] = "Description";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "unit";
$col["title"] = "Unit";
$col["editable"] = true;
$col['edittype'] = "select";
$col['editoptions'] = $unitOptions;
$cols[] = $col;

$col = array();
$col["name"] = "packing";
$col["title"] = "Packing";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "packingUnit";
$col["title"] = "Packing Unit";
$col["editable"] = true;
$col['edittype'] = "select";
$col['editoptions'] = $packingUnitOptions;
$cols[] = $col;

$col = array();
$col["name"] = "netWeight";
$col["title"] = "Net Weight per piece";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "grossWeight";
$col["title"] = "Gross Weight per piece";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "litres";
$col["title"] = "Litres/piece";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "salesRate";
$col["title"] = "Sales Rate";
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
<script>
$(function(){
	$(document).on('click' ,'#litres', function()
				{
			          var netWeight = $('#netWeight').val();
			          var litres = netWeight * 1.0917;
			          litres =   litres.toFixed(2);
			          $('#litres').val(litres);
			          //alert("hi");
				});
	});
</script>