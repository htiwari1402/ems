<?php
include '../model/reportEngine.php';
if(isset($_REQUEST['a']))
{

$action = $_REQUEST['a'];
$action();

}
function generatePartWiseReport()
{
	$type = $_REQUEST['type'];
	$typeID = $_REQUEST['typeID'];
	$dao = new DAO();
	$debtorDetails = $dao->getReportDebtorDetails($type,$typeID);
	include "../view/partyWiseGenReport.php";
}
?>