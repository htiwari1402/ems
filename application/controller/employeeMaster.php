<?php 
mysql_connect("localhost","db","dbpass");
mysql_select_db("ems");
include "../../libs/inc/jqgrid_dist.php";
include "./gridOptionMaker.php";

$sql = "select * from `ems`.`location` where `location_type`=1 and `parent_id` = 100";
$indianStates = fetch($sql);
$stateOptions["value"] = optionMaker($indianStates, "name", "name");

$allDepartments = fetch("select * from `ems`.`department`");
$allDesignations = fetch("select * from `ems`.`designation`");
$departmentString ='';
foreach($allDepartments as $key=> $data)
{
	$departmentString .= $data['deptCode'].":".$data['deptName'].";";
}
$departmentOptions = array();
$departmentOptions["value"]=substr($departmentString,0,strlen($departmentString)-1);

$designString ='';
foreach($allDesignations as $key=> $data)
{
	$designString .= $data['code'].":".$data['designation'].";";
}
$designOptions = array();
$designOptions["value"]=substr($designString,0,strlen($designString)-1);

$g = new jqgrid();
$g->table = "employeemaster";
$grid["autowidth"] = true;

$col = array();
$col["name"] = "empID";
$col["title"] = "Employee ID";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["name"] = "name";
$col["title"] = "Name";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "department";
$col["title"] = "Department";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $departmentOptions;
$cols[] = $col;

$col = array();
$col["name"] = "contactNo";
$col["title"] = "Contact No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "address";
$col["title"] = "Address";
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
$col["name"] = "email";
$col["title"] = "Email";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "designation";
$col["title"] = "Designation";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = $designOptions;
$cols[] = $col;

$col = array();
$col["name"] = "incharge";
$col["title"] = "Incharge";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "dob";
$col["title"] = "DOB";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "doj";
$col["title"] = "DOJ";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "panNo";
$col["title"] = "Pan No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "bankName";
$col["title"] = "Bank Name";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "bankAccountNo";
$col["title"] = "Bank Account No";
$col["editable"] = true;
$cols[] = $col;

$col = array();
$col["name"] = "bankBranch";
$col["title"] = "Bank Branch";
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
