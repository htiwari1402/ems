<?php
include "./application/model/dao.php";
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
//$userType = $_REQUEST['userType'];
$dao = new DAO();
$valid = $dao->checkSignIn($username,$password);
if($valid > 0)
{
	$_SESSION['username'] = $username;
	$userDetails = $dao->getUserDetails($username);
	$_SESSION['userId'] = $userDetails['userId'];
	$_SESSION['empID'] = $userDetails['empID'];
	$_SESSION['type'] = trim($userDetails['type']);
	$_SESSION['typeID'] = $userDetails['typeID'];
	$_SESSION['partyName'] = $dao->getPartyDetails($_SESSION['type'], $_SESSION['typeID']);
	$_SESSION['warehouseDetails'] = $dao->getWarehouseDetails($_SESSION['userId'] );
	$_SESSION['warehouseSummary'] = $dao->getWarehouseSummary($_SESSION['userId']);
	$type = $_SESSION['type'];
	if($type == 'Branch')
	{
		$sql = "select * from `ems`.`branchmaster` where `branchID` = $typeID ";
		$return = $dao->fetch($sql);
		$_SESSION['state'] =  $return[0]['state'];
	}
	else if($type == 'CF')
	{
		$sql = "select * from `ems`.`cfmaster` where `cfID` = $typeID ";
		$return = $dao->fetch($sql);
		$_SESSION['state'] =  $return[0]['state'];
	}
	else if($type == 'HO')
	{
		$_SESSION['state'] =  "Maharashtra";
	}
 if(isset($_SESSION['username']) and strlen($_SESSION['username']) > 0)
 {
     include "home.php";
     ?>

     
     
     <?php 
 }
 }
 ?>