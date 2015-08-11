<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
include "./gridOptionMaker.php";
$g = new jqgrid();
$g->table = "distributormaster";
$grid["autowidth"] = true;

$sql = "select * from `ems`.`employeemaster`";
$allEmployees = fetch($sql);
$employeeOptions["value"] = optionMaker($allEmployees, "empID", "name");

$sql = "select * from `ems`.`areamaster`";
$allAreas = fetch($sql);
$areaOptions["value"] = optionMaker($allAreas, "areaCode", "areaCode");

$sql = "select * from `ems`.`taxstructure`";
$alltaxes = fetch($sql);
$taxOptions["value"] = optionMaker($alltaxes, "taxID", "taxCode");

$sql = "select * from `ems`.`cfmaster`";
$allCF = fetch($sql);
$cfOptions["value"] = optionMaker($allCF, "cfID", "name");

$sql = "select * from `ems`.`branchmaster`";
$allBranch = fetch($sql);
$branchOptions["value"] = optionMaker($allBranch, "branchID", "name");

$sql = "SELECT * FROM `location` WHERE `location_type`=1 and `parent_id`=100";
$allCountries = fetch($sql);
$countryOptions["value"] = optionMaker($allCountries, "name", "name");


$col = array();
$col["name"] = "distID";
$col["title"] = "Distributor ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "typeOfDist";
$col["title"] = "Type of Distributor";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>"select:select;Distributor:Distributor;Stockiest:Stockiest");
$cols[] = $col;

$col = array();
$col["name"] = "name";
$col["title"] = "Name";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "type";
$col["title"] = "Type";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>"select:select;Branch:Branch;HO:HO;CF:C&F");
$cols[] = $col;

$col = array();
$col["name"] = "typeID";
$col["title"] = "Party Name";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =array("value"=>" :select");;
$cols[] = $col;

$col = array();
$col["name"] = "so";
$col["title"] = "Sales Officer";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $employeeOptions;
$cols[] = $col;

$col = array();
$col["name"] = "address";
$col["title"] = "Address";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "country";
$col["title"] = "Country";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>"India:India");;
$cols[] = $col;

$col = array();
$col["name"] = "state";
$col["title"] = "State";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =$countryOptions;
$cols[] = $col;

$col = array();
$col["name"] = "city";
$col["title"] = "City";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] =array("value"=>" :select");
$cols[] = $col;

$col = array();
$col["name"] = "contactNo";
$col["title"] = "Contact No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "areaCode";
$col["title"] = "Area";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $areaOptions;
$cols[] = $col;

$col = array();
$col["name"] = "taxCode";
$col["title"] = "Tax";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $taxOptions;
$cols[] = $col;


$col = array();
$col["name"] = "email";
$col["title"] = "Email";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "contactPerson";
$col["title"] = "Contact Person";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "contactPersonNumber";
$col["title"] = "Contact Person Mobile";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "contactPersonEmail";
$col["title"] = "Contact Person Email";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "vatTinNo";
$col["title"] = "VAT Tin No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "cstTinNo";
$col["title"] = "CST Tin No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "fssaiNo";
$col["title"] = "FSSAI No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "panNo";
$col["title"] = "PAN No";
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
	$(document).on('click' ,'#add_1', function()
				{
		              alert('add');
		              $('#country').val('India');
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
	$(document).on('click' ,'#edit_1', function()
				{
		              $('#country').val('India');
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