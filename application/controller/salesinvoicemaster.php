<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
include "./gridOptionMaker.php";
$g = new jqgrid();
$g->table = "salesinvoice";
$grid["autowidth"] = true;

$col = array();
$col["name"] = "invoiceID";
$col["title"] = "Invoice ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "invoiceNo";
$col["title"] = "Invoice No";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "date";
$col["title"] = "Date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "partyName";
$col["title"] = "Party Name";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "partyOrderNo";
$col["title"] = "Party Order No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "transporterID";
$col["title"] = "Transporter ID";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "lrNo";
$col["title"] = "LR No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "orderDate";
$col["title"] = "Order Date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "deliveryDate";
$col["title"] = "Delivery Date";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "salesmanID";
$col["title"] = "Salesman ID";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "loc";
$col["title"] = "LOC";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "type";
$col["title"] = "Type";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalAmount";
$col["title"] = "Total Amount";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalWeight";
$col["title"] = "Total Weightt";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalLitres";
$col["title"] = "Total Litres";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "fromType";
$col["title"] = "From Type";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "fromTypeID";
$col["title"] = "From Type ID";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalAmountAfterTax";
$col["title"] = "Total Amount After Tax";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalTax";
$col["title"] = "Total Tax";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "totalSurcharge";
$col["title"] = "Total Surcharge$";
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