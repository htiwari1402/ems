<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
include "./gridOptionMaker.php";
$g = new jqgrid();
$g->table = "stockpurchase";
$grid["autowidth"] = true;

$col = array();
$col["name"] = "stockPurchaseID";
$col["title"] = "Stock Purchase ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "partyInvoiceNo";
$col["title"] = "Party Invoice No";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "date";
$col["title"] = "Date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "purchaseEntryNo";
$col["title"] = "Purchase Entry No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "partyInvoiceDate";
$col["title"] = "Party Invoice Date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "lotNo";
$col["title"] = "Lot No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "billOfEntryNo";
$col["title"] = "Bill of entry No.";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "containerNo";
$col["title"] = "Container No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "blNo";
$col["title"] = "Bill No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "blNo";
$col["title"] = "Bill No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "currencyRate";
$col["title"] = "Currency Rate";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "supplierName";
$col["title"] = "Supplier Name";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "supplierAddress";
$col["title"] = "Supplier Address";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalAmount";
$col["title"] = "Total Amount";
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

$col = array();
$col["name"] = "customDuty";
$col["title"] = "Custom Duty";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "cfCharges";
$col["title"] = "CF Charges";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "currencyName";
$col["title"] = "Currency Name";
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
echo "<div style='width:90%;font-size:12px !important;'>";
echo $out;
echo "</div>";
?>
<script>
$(function(){
	$(document).on('change' ,'#country', function()
				{
		              var country= $('#country').val();
			          $.post("./application/controller/control.php",
									"a=getStateByCountry&country="+country,
									function(data)
									{
							              $('#state').html(data);
									});
				});
	});
$(function(){
	$(document).on('change' ,'#state', function()
				{
		              var state= $('#state').val();
			          $.post("./application/controller/control.php",
									"a=getCityByState&state="+state,
									function(data)
									{
							              $('#city').html(data);
									});
				});
	});
$(function(){
	$(document).on('change' ,'#type', function()
				{
		              var type= $('#type').val();
			          $.post("./application/controller/control.php",
									"a=getTypeIDByType&type="+type,
									function(data)
									{
							              $('#typeID').html(data);
									});
				});
	});
</script>