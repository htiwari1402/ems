<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "./gridOptionMaker.php";
include "../../libs/inc/jqgrid_dist.php";

$g = new jqgrid();
$g->table = "areamaster";
$grid["autowidth"] = true;

$sql = "select * from `ems`.`location` where `location_type`=0";
$allCountries = fetch($sql);
$countryOptions["value"] = optionMaker($allCountries, "name", "name");

$col = array();
$col["name"] = "areaID";
$col["title"] = "Area ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "areaCode";
$col["title"] = "Area Code";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "country";
$col["title"] = "Country";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =$countryOptions;
$cols[] = $col;

$col = array();
$col["name"] = "state";
$col["title"] = "State";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =array("value"=>" :select");
$cols[] = $col;

$col = array();
$col["name"] = "city";
$col["title"] = "City";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =array("value"=>" :select");
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
							              $('#partyName').html(data);
									});
				});
	});
</script>