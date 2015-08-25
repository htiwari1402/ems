<?php
include '../model/dao.php';
include '../model/reportEngine.php';
include "../../libs/numberToWord.php";
//print_r($_SESSION);
if(isset($_REQUEST['a']))
{

$action = $_REQUEST['a'];
$action();

}
function logout()
{
	unset($_SESSION);
}
function signIn()
{
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
		//include "../../home.php";
	} 
	echo $valid;
	//header( 'Location: http://www.cmiplonline.com/home.php' ) ;
}
function welcome()
{
	include "../view/welcome.php";
}
function generalLedger()
{
	$dao = new DAO();
	$accountData  = $dao->getAccountDetails();
	//print_r($accountData);
	include "../view/generalLedgerHome.php";
}
function dcMaster()
{
	$dao = new DAO();
	$dcData = $dao->getDCDetail();
	$allWarehouse = $dao->getAllWarehouse();
	$allTransporter = $dao->getAllTransporter();
	$allEmployees = $dao->getAllEmployees();
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$allArea = $dao->getAllAreas();
	include "../view/dcInput.php";
}
function dcMasterView()
{
	$dao = new DAO();
	$dcData = $dao->pSelect("`ems`.`dcmaster`","");
	include "../view/dcMaster.php";
}
function dcAdditionalDetails()
{
	$dao = new DAO();
	$id = $_REQUEST['id'];
	$dcData = $dao->pSelect("`ems`.`dcmaster`","where `id` =".$id);
	$adData = $dcData[0];
	include "../view/dcAdditionalDetails.php";
}
function dcMasterUpdate()
{
	$dao = new DAO();
	$dcData = $dao->pSelect("`ems`.`dcmaster`","");
	include "../view/dcMasterUpdate.php";
}
function updateDcAdditionalDetails()
{
	$dao = new DAO();
	$id = $_REQUEST['id'];
	$dcData = $dao->pSelect("`ems`.`dcmaster`","where `id` =".$id);
	$adData = $dcData[0];
	include "../view/updateDcAdditionalDetails.php";
}
function soInput()
{
	$dao = new DAO();
	$designations = $dao->getAllDesignations();
	$departments = $dao->getAllDepartments();
	//echo json_encode($designations);
	include "../view/employeeMaster.php";
}
function soUpdate()
{
	$dao = new DAO();
	//$soData = $dao->pSelect("`ems`.`somaster`","");
	include "../view/soUpdateTable.php";
}
function showUpdateSo()
{
	$id = $_REQUEST['id'];
	$dao = new DAO();
	$soData = $dao->pSelect("`ems`.`somaster`"," where `employeeID`=".$id);
	$adData = $soData[0];
	include "../view/soUpdateTable.php";
}
function salesEntry()
{
	$dao = new DAO();
	//$_SESSION['username'] = $username;
	//echo $_SESSION['type'];
	$_SESSION['partyName'] = $dao->getPartyDetails($_SESSION['type'], $_SESSION['typeID']);
	$_SESSION['warehouseDetails'] = $dao->getWarehouseDetails($_SESSION['userId'] );
	$_SESSION['warehouseSummary'] = $dao->getWarehouseSummary($_SESSION['userId']);
	$allTransporter = $dao->getAllTransporter();
	$allTransporter = $dao->getStateWiseTransporter($_SESSION['state']);
	$allEmployees = $dao->getAllEmployees();
	$allEmployees = $dao->getStateWiseSalesman($_SESSION['state']);
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$allTaxCode = $dao->getAllTaxCode();
	$allAllowedDist = $dao->getAllAllowedDist($_SESSION['type'],$_SESSION['typeID']);
	include "../view/salesEntry.php";
}
function editSalesEntry()
{
	$dao = new DAO();
	//$_SESSION['username'] = $username;
	//echo $_SESSION['type'];
	$_SESSION['partyName'] = $dao->getPartyDetails($_SESSION['type'], $_SESSION['typeID']);
	$_SESSION['warehouseDetails'] = $dao->getWarehouseDetails($_SESSION['userId'] );
	$_SESSION['warehouseSummary'] = $dao->getWarehouseSummary($_SESSION['userId']);
	$invoiceNo = $_REQUEST['invoiceNo'];
	$invoiceDetails = $dao->getSalesInvoiceByInvoiceNo($invoiceNo);
	$salesDetails = $dao->getSalesEntryByInvoiceNo($invoiceNo);
	$_SESSION['editSalesInvoiceDetails'] = $invoiceDetails;
	$_SESSION['editSalesEntryDetails'] = $salesDetails;
	$allTransporter = $dao->getAllTransporter();
	$allTransporter = $dao->getStateWiseTransporter($_SESSION['state']);
	$allEmployees = $dao->getAllEmployees();
	$allEmployees = $dao->getStateWiseSalesman($_SESSION['state']);
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$allTaxCode = $dao->getAllTaxCode();
	$allAllowedDist = $dao->getAllAllowedDist($_SESSION['type'],$_SESSION['typeID']);
	include "../view/editSalesEntry.php";
}
function getEmployee()
{
	include "../view/employee.php";
}
function createInvoice()
{
	$dao = new DAO();
	$type =  $_REQUEST['type'];
	$loc =  $_REQUEST['loc'];
	$maxInvoiceID = $dao->getMaxInvoiceID();
	$max = $maxInvoiceID[0][0];
	/* echo "<pre>";
	echo $max;
	print_r($maxInvoiceID); */
	$invoiceNo = $type.$loc.str_pad($max,6,'0',STR_PAD_LEFT);
	$insertData = $_REQUEST;
	$insertData['invoiceNo'] = $invoiceNo;
	$dao->createInvoice($insertData);
	echo $invoiceNo;
}
function getEmployeeDetail()
{
    $dao = new DAO();
	$detail = $dao->getEmployeeDetail($_REQUEST['empID']);
	$empDetail= $detail[0];
	include "../view/employeeDetailUpdate.php";	
}
function getInventory()
{
	$dao =new DAO();
	//$_SESSION['username'] = $username;
	$_SESSION['partyName'] = $dao->getPartyDetails($_SESSION['type'], $_SESSION['typeID']);
	$_SESSION['warehouseDetails'] = $dao->getWarehouseDetails($_SESSION['userId'] );
	$_SESSION['warehouseSummary'] = $dao->getWarehouseSummary($_SESSION['userId']);
	$allWarehouse = $dao->getAllWarehouse();
	$allTransporter = $dao->getAllTransporter();
	$allEmployees = $dao->getAllEmployees();
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$allTaxCode = $dao->getAllTaxCode();
	include "../view/stockTransfer.php";
}

function addSalesEntry()
{
	$dao = new DAO();
	$insertData = $_REQUEST;
	$dao->addSalesEntry($insertData);
	//echo "<pre>";
	//print_r($_REQUEST);
}
function createStockTransferInvoice()
{
	$dao = new DAO();
	$from = $_REQUEST['from'];
	$to = $_REQUEST['to'];
	$date = $_REQUEST['date'];
	$invoiceNo = $from.$to.$date;
	$insertData = $_REQUEST;
	$insertData['stockTransferInvoiceNo'] = $invoiceNo;
	$dao->createStockTransferInvoice($insertData);
	echo $invoiceNo;
}
function addStockTransferEntry()
{
	$dao = new DAO();
	$insertData = $_REQUEST;
	$dao->addStockTransferEntry($insertData);
	echo "<pre>";
	print_r($_REQUEST);
}
function getProductMaster()
{
	include "../view/productMaster.php";
}
function getProductCategory()
{
	include "../view/productCategory.php";
}
function getTransportMaster()
{
	
	include "../view/transportMaster.php";
}
function getUpdateSalesEntry()
{
	$dao =new DAO();
	$invoiceDetails = $dao->getSalesInvoiceDetails();
	include "../view/updateSalesEntry.php";
}
function updateCurrentSalesInvoice()
{
	echo "<pre>";
	//print_r($_REQUEST);
	$index = $_REQUEST['index'];
	$invoiceNo = $_REQUEST['invoiceNo'];
	$updateData = array();
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'index' && $key != 'invoiceNo' && $key != 'a')
		{
		$updateData[$key]=$data[$index];
		}
		
	}
	print_r($updateData);
	$dao = new DAO();
	$dao->updateCurrentSalesInvoice($invoiceNo,$updateData);
}
function getSalesReport()
{
	include "../view/salesReport.php";
}
function getStockTransferReport()
{
	include "../view/stockTransferReport.php";
}
function getStockPurchaseReport()
{
	include "../view/stockPurchaseReport.php";
}
function generateSalesReport()
{
	$dao = new DAO();
	$invoiceNo = $_REQUEST['invoiceNo'];
	$invoiceDetails = $dao->getSalesInvoiceByInvoiceNo($invoiceNo);
	$salesDetails = $dao->getSalesEntryByInvoiceNo($invoiceNo);
	$totalWeight = 0;
	$totalLitres = 0;
	foreach ($salesDetails as $key=>$data)
	{
		$totalWeight = $totalWeight + $data['totalWeight'];
		$totalLitres = $totalLitres + $data['totalLitres'];
	}
	$invoiceDetails['partyName'] = $dao->getDistributorByID($invoiceDetails['partyName']);
	$invoiceDetails['salesmanID'] = $dao->getEmployeeNameByID($invoiceDetails['salesmanID'] );
	$invoiceDetails['transporterID'] = $dao->getTransporterNameByID($invoiceDetails['transporterID']);
	//echo convert_number(1263000);
	$totalAmountInWords = convert_number($invoiceDetails['totalAmountAfterTax']);
	//echo "<pre>";
	//print_r($invoiceDetails);
	//print_r($salesDetails);
	include "../view/generatedSalesReport.php";
}
function generateStockTransferReport()
{
	$dao = new DAO();
	$invoiceNo = $_REQUEST['invoiceNo'];
	$invoiceDetails = $dao->getStockTransferInvoiceByInvoiceNo($invoiceNo);
	$salesDetails = $dao->getStockTransferEntryByInvoiceNo($invoiceNo);
	$invoiceDetails['to'] = $dao->getPartyNameByWarehouse($invoiceDetails['to']);
	$invoiceDetails['transporter'] = $dao->getTransporterNameByID($invoiceDetails['transporter']);
	$totalWeight = 0;
	$totalLitres = 0;
	foreach ($salesDetails as $key=>$data)
	{
		$totalWeight = $totalWeight + $data['totalWeight'];
		$totalLitres = $totalLitres + $data['totalLitres'];
	}
	//echo "<pre>";
	//print_r($invoiceDetails);
	//print_r($salesDetails);
	
	include "../view/generatedStockTransferReport.php";
}
function generateStockPurchaseReport()
{
	$dao = new DAO();
	$purchaseEntryNo = $_REQUEST['purchaseEntryNo'];
	$invoiceDetails = $dao->getStockPurchaseInvoiceByInvoiceNo($purchaseEntryNo);
	$salesDetails = $dao->getStockPurchaseEntryByInvoiceNo($purchaseEntryNo);
	//$invoiceDetails['supplierName'] = $dao->getCreditorNameByID($invoiceDetails['supplierName']);
	$totalWeight = 0;
	$totalLitres = 0;
	foreach ($salesDetails as $key=>$data)
	{
		$totalWeight = $totalWeight + $data['totalWeight'];
		$totalLitres = $totalLitres + $data['totalLitres'];
	}
	//echo "<pre>";
	//print_r($invoiceDetails);
	//print_r($salesDetails);

	include "../view/generatedStockPurchaseReport.php";
}
function displayAvailability()
{
	$itemCode = $_REQUEST['itemCode'];
	$dao = new DAO();
	$items = $dao->getAvailabilityDetail($itemCode);
	include "../view/stockAvailability.php"; 
}
function submitSelectQuantity()
{
	$itemCode = $_REQUEST['itemCode'];
	$selectQuantity = array();
	$noOfCtn = 0;
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key != 'itemCode')
		{
			$selectQuantity[$key] = $data;
			$noOfCtn += $data;
		}
	}
	$godownNo = 0;
	foreach($selectQuantity as $key=>$data)
	{
		if($data != 0)
		{
			$godownNo = $key;
			break;
		}
	}
	$dao = new DAO();
	$godownDetails = $dao->getGodownDetails($godownNo,$itemCode);
	$godownDetails['totalCtn'] = $noOfCtn;
	echo json_encode($godownDetails);
}
function getItemDetailsForSale()
{
	$itemCode = $_REQUEST['itemCode'];
	$dao = new DAO();
	$itemDetails = $dao->getItemDetailsForSale($itemCode);
	echo json_encode($itemDetails);
}
function stockPurchase()
{
	$dao = new DAO();
	$_SESSION['partyName'] = $dao->getPartyDetails($_SESSION['type'], $_SESSION['typeID']);
	$_SESSION['warehouseDetails'] = $dao->getWarehouseDetails($_SESSION['userId'] );
	$_SESSION['warehouseSummary'] = $dao->getWarehouseSummary($_SESSION['userId']);
	$maxInvoiceID = $dao->getMaxStockPurchaseID();
	$max = $maxInvoiceID[0][0];
	$purchaseEntryNo = "PU".str_pad($max,6,'0',STR_PAD_LEFT);
	$allTransporter = $dao->getAllTransporter();
	$allEmployees = $dao->getAllEmployees();
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$allWarehouse = $dao->getAllWarehouse();
	$allCreditors = $dao->getAllCreditors();
	$allCurrency = $dao->getAllCurrency();
	$hoWarehouse = $dao->getWarehouseForHO();
	include "../view/stockPurchase.php";
}
function createStockPurchase()
{
	$insertData = $_REQUEST;
	$dao = new DAO();
	$dao->createStockPurchase($insertData);
}
function createEditStockPurchase()
{
	$purchaseEntryNo = $_REQUEST['purchaseEntryNo'];
	$sql = "delete from `ems`.`stockpurchase` where `purchaseEntryNo`='$purchaseEntryNo' ";
	$insertData = $_REQUEST;
	$dao = new DAO();
	$dao->update($sql);
	$dao->createStockPurchase($insertData);
}
function addSPEntry()
{
	$dao = new DAO();
	$insertData = $_REQUEST;
	$dao->addSPEntry($insertData);
}
function addAnotherRow()
{
	$dao = new DAO();
	$allTransporter = $dao->getAllTransporter();
	$allEmployees = $dao->getAllEmployees();
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$rowCount = $_REQUEST['rowCount'];
	include "../view/salesEntryRow.php";
}
function addAnotherRowSP()
{
	$dao = new DAO();
	$allTransporter = $dao->getAllTransporter();
	$allEmployees = $dao->getAllEmployees();
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$rowCount = $_REQUEST['rowCount'];
	$hoWarehouse = $dao->getWarehouseForHO();
	include "../view/salesEntryRowSP.php";
}
function createNewSalesInvoice()
{
	//echo "<pre>";
	//print_r($_REQUEST);
	$dao = new DAO();
	$dao->createInvoice($_REQUEST);
}
function createEditNewSalesInvoice()
{
	//echo "<pre>";
	//print_r($_REQUEST);
	$dao = new DAO();
	$invoiceNo = $_REQUEST['invoiceNo'];
	$sql = "delete from `ems`.`salesinvoice` where `invoiceNo`='$invoiceNo' ";
	$dao->update($sql);
	$sql = "delete from `ems`.`salesentry` where `invoiceNo`='$invoiceNo' ";
	$dao->update($sql);
	$dao->createInvoice($_REQUEST);
}
function createNewStockTransferInvoice()
{
	$stockTransferInvoiceNo = $_REQUEST['stockTransferInvoiceNo'];
	//$sql = "delete from `ems`.`stocktransferinvoice` where `stockTransferInvoiceNo`='$stockTransferInvoiceNo'";
	$dao = new DAO();
	//$dao->update($sql);
	$dao->createStockTransferInvoice($_REQUEST);
}
function createEditNewStockTransferInvoice()
{
	$stockTransferInvoiceNo = $_REQUEST['stockTransferInvoiceNo'];
	$sql = "delete from `ems`.`stocktransferinvoice` where `stockTransferInvoiceNo`='$stockTransferInvoiceNo'";
	$dao = new DAO();
	$dao->update($sql);
	$dao->createStockTransferInvoice($_REQUEST);
}
function createSalesEntry()
{
	$dao = new DAO();
	$inputData = array();
	$invoiceNo = $_REQUEST['invoiceNo'];
	
	$salesType = $_REQUEST['salesType'];
	$state = $_REQUEST['state'];
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='invoiceNo')
		{
			$arr = $data;
			foreach($arr as $k => $d)
			{
				$inputData[$k][$key] = $d;
				$inputData[$k]['invoiceNo'] = $invoiceNo;
			}
			//$dao->addSalesEntry($inputData);
		}
	}
	$invoiceTotalWeight = 0;
	$invoiceTotalLitres = 0;
	$invoiceTotalAmount = 0;
	$invoiceTotalAmountAfterTax = 0;
	$totalTax = 0;
	$totalSurcharge = 0;
	foreach($inputData as $key=>$data)
	{
		$weight = $dao->getWeight($data['itemCode']);
		$litres = $dao->getLitres($data['itemCode']);
		//echo $weight;
		//echo $litres;
		$totalWeight = $data['totalPcs'] * $weight['grossWeight'];
		$invoiceTotalWeight = $invoiceTotalWeight + $totalWeight;
		$totalLitres = $data['totalPcs']*$litres['litres'];
		$invoiceTotalLitres = $invoiceTotalLitres + $totalLitres;
		$invoiceTotalAmount = $invoiceTotalAmount + $data['amount'];
		$taxStructure = $dao->getTaxForItem($state,$data['itemCode']);
		if($salesType == 'SA' || $salesType =='ST')
		{
			$totalTax = $totalTax + ($taxStructure['vat']*$data['amount'])/100;
			$totalSurcharge = $totalSurcharge + ($taxStructure['surcharge'] * ($taxStructure['vat']*$data['amount'])/100)/100;
			$amountAfterTax = $data['amount'] + (($taxStructure['vat']*$data['amount'])/100) + (($taxStructure['surcharge'] * ($taxStructure['vat']*$data['amount'])/100)/100) ;
			$invoiceTotalAmountAfterTax = $invoiceTotalAmountAfterTax + $amountAfterTax;
		}
		else if($salesType == 'CST')
		{
			$amountAfterTax = $data['amount'] + ((($taxStructure['cst'] + $taxStructure['surcharge'])*$data['amount'] )/100);
		}
		$data['amountAfterTax'] = $amountAfterTax;
		$data['totalWeight'] = $totalWeight;
		$data['totalLitres'] = $totalLitres;
		$dao->addSalesEntry($data);
	}
	//echo "<pre>";
	//print_r($inputData);
	$dao->updateSalesInvoiceAggregates($invoiceNo,$invoiceTotalWeight,$invoiceTotalLitres,$invoiceTotalAmount,$totalTax,$totalSurcharge,$invoiceTotalAmountAfterTax);
}
function createEditSalesEntry()
{
	$dao = new DAO();
	$inputData = array();
	$invoiceNo = $_REQUEST['invoiceNo'];
    foreach($_SESSION['editSalesEntryDetails'] as $key=>$data)
    {
    	//$dao->editStockPurchaseEntry($insertData, $purchaseEntryNo);
    	$dao->editSalesEntry($data,$invoiceNo);
    }
	$salesType = $_REQUEST['salesType'];
	$state = $_REQUEST['state'];
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='invoiceNo')
		{
			$arr = $data;
			foreach($arr as $k => $d)
			{
				$inputData[$k][$key] = $d;
				$inputData[$k]['invoiceNo'] = $invoiceNo;
			}
			//$dao->addSalesEntry($inputData);
		}
	}
	$invoiceTotalWeight = 0;
	$invoiceTotalLitres = 0;
	$invoiceTotalAmount = 0;
	$invoiceTotalAmountAfterTax = 0;
	$totalTax = 0;
	$totalSurcharge = 0;
	foreach($inputData as $key=>$data)
	{
		$weight = $dao->getWeight($data['itemCode']);
		$litres = $dao->getLitres($data['itemCode']);
		//echo $weight;
		//echo $litres;
		$totalWeight = $data['totalPcs'] * $weight['grossWeight'];
		$invoiceTotalWeight = $invoiceTotalWeight + $totalWeight;
		$totalLitres = $data['totalPcs']*$litres['litres'];
		$invoiceTotalLitres = $invoiceTotalLitres + $totalLitres;
		$invoiceTotalAmount = $invoiceTotalAmount + $data['amount'];
		$taxStructure = $dao->getTaxForItem($state,$data['itemCode']);
		if($salesType == 'SA' || $salesType =='ST')
		{
			$totalTax = $totalTax + ($taxStructure['vat']*$data['amount'])/100;
			$totalSurcharge = $totalSurcharge + ($taxStructure['surcharge'] * ($taxStructure['vat']*$data['amount'])/100)/100;
			$amountAfterTax = $data['amount'] + (($taxStructure['vat']*$data['amount'])/100) + (($taxStructure['surcharge'] * ($taxStructure['vat']*$data['amount'])/100)/100) ;
			$invoiceTotalAmountAfterTax = $invoiceTotalAmountAfterTax + $amountAfterTax;
		}
		else if($salesType == 'CST')
		{
			$amountAfterTax = $data['amount'] + ((($taxStructure['cst'] + $taxStructure['surcharge'])*$data['amount'] )/100);
		}
		$data['amountAfterTax'] = $amountAfterTax;
		$data['totalWeight'] = $totalWeight;
		$data['totalLitres'] = $totalLitres;
		$dao->addSalesEntry($data);
	}
	//echo "<pre>";
	//print_r($inputData);
	$dao->updateSalesInvoiceAggregates($invoiceNo,$invoiceTotalWeight,$invoiceTotalLitres,$invoiceTotalAmount,$totalTax,$totalSurcharge,$invoiceTotalAmountAfterTax);
}
function createStockTransferEntry()
{
	$dao = new DAO();
	$fromWarehouse = $_REQUEST['from'];
	$toWarehouse = $_REQUEST['to'];
	$inputData = array();
	$invoiceNo = $_REQUEST['invoiceNo'];
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='invoiceNo')
		{
			$arr = $data;
			foreach($data as $k => $d)
			{
				$inputData[$k][$key] = $d;
				$inputData[$k]['invoiceNo'] = $invoiceNo;
			}
			//$dao->addSalesEntry($inputData);
		}
	}
	$invoiceTotalWeight = 0;
	$invoiceTotalLitres = 0;
	$invoiceTotalAmount = 0;
	//echo "<pre>";
	//print_r($inputData);
	foreach($inputData as $key=>$data)
	{
		$weight = $dao->getWeight($data['itemCode']);
		$litres = $dao->getLitres($data['itemCode']);
		//echo $weight;
		//echo $litres;
		$totalWeight = $data['totalPcs'] * $weight['grossWeight'];
		$invoiceTotalWeight = $invoiceTotalWeight + $totalWeight;
		$totalLitres = $data['totalPcs']*$litres['litres'];
		$invoiceTotalLitres = $invoiceTotalLitres + $totalLitres;
		$invoiceTotalAmount = $invoiceTotalAmount + $data['amount'];
		$data['totalWeight'] = $totalWeight;
		$data['totalLitres'] = $totalLitres;
		$dao->addStockTransferEntry($data,$fromWarehouse,$toWarehouse);
	}
	//echo "<pre>";
	//print_r($inputData);
	$dao->updateStockTransferInvoiceAggregates($invoiceNo,$invoiceTotalWeight,$invoiceTotalLitres,$invoiceTotalAmount);
}
function createEditStockTransferEntry()
{
	$dao = new DAO();
	$invoiceNo = $_REQUEST['invoiceNo'];
	$fromWarehouse = $_REQUEST['from'];
	$toWarehouse = $_REQUEST['to'];
	foreach($_SESSION['editStockTransferSalesDetail'] as $key=>$data)
	{
		$dao->editStockTransferEntry($data,$fromWarehouse,$toWarehouse,$invoiceNo);
	}
	$inputData = array();
	
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='invoiceNo')
		{
			$arr = $data;
			foreach($data as $k => $d)
			{
				$inputData[$k][$key] = $d;
				$inputData[$k]['invoiceNo'] = $invoiceNo;
			}
			//$dao->addSalesEntry($inputData);
		}
	}
	$invoiceTotalWeight = 0;
	$invoiceTotalLitres = 0;
	$invoiceTotalAmount = 0;
	//echo "<pre>";
	//print_r($inputData);
	foreach($inputData as $key=>$data)
	{
		$weight = $dao->getWeight($data['itemCode']);
		$litres = $dao->getLitres($data['itemCode']);
		//echo $weight;
		//echo $litres;
		$totalWeight = $data['totalPcs'] * $weight['grossWeight'];
		$invoiceTotalWeight = $invoiceTotalWeight + $totalWeight;
		$totalLitres = $data['totalPcs']*$litres['litres'];
		$invoiceTotalLitres = $invoiceTotalLitres + $totalLitres;
		$invoiceTotalAmount = $invoiceTotalAmount + $data['amount'];
		$data['totalWeight'] = $totalWeight;
		$data['totalLitres'] = $totalLitres;
		$dao->addStockTransferEntry($data,$fromWarehouse,$toWarehouse);
	}
	//echo "<pre>";
	//print_r($inputData);
	$dao->updateStockTransferInvoiceAggregates($invoiceNo,$invoiceTotalWeight,$invoiceTotalLitres,$invoiceTotalAmount);
}
function createStockPurchaseEntry()
{
	$dao = new DAO();
	$inputData = array();
	$purchaseEntryNo = $_REQUEST['purchaseEntryNo'];
	echo "<pre>";
	print_r($_REQUEST);
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='partyInvoiceNo')
		{
			$arr = $data;
			foreach($arr as $k => $d)
			{
				//if($key != "exFreeQty")
				//{
				$inputData[$k][$key] = $d;
				$inputData[$k]['purchaseEntryNo'] = $purchaseEntryNo;
				//}
			}
			//$dao->addSalesEntry($inputData);
		}
	}
	$invoiceTotalWeight = 0;
	$invoiceTotalLitres = 0;
	$invoiceTotalAmount = 0;
	foreach($inputData as $key=>$data)
	{
		$weight = $dao->getWeight($data['itemCode']);
		$litres = $dao->getLitres($data['itemCode']);
		//echo $weight;
		//echo $litres;
		$totalWeight = $data['totalPcs'] * $weight['grossWeight'];
		$invoiceTotalWeight = $invoiceTotalWeight + $totalWeight;
		$totalLitres = $data['totalPcs']*$litres['litres'];
		$invoiceTotalLitres = $invoiceTotalLitres + $totalLitres;
		$invoiceTotalAmount = $invoiceTotalAmount + $data['amount'];
		$data['totalWeight'] = $totalWeight;
		$data['totalLitres'] = $totalLitres;
		
		//print_r($data);
		$dao->addSPEntry($data);
	}
	//echo "<pre>";
	//print_r($inputData);
	$dao->updateStockPurchaseInvoiceAggregates($purchaseEntryNo,$invoiceTotalWeight,$invoiceTotalLitres,$invoiceTotalAmount);
}

function createEditStockPurchaseEntry()
{
	$dao = new DAO();
	$purchaseEntryNo = $_REQUEST['purchaseEntryNo'];
	foreach($_SESSION['editStockPurchaseSalesDetail'] as $key=>$data)
	{
		//$dao->editStockTransferEntry($data,$fromWarehouse,$toWarehouse);
		$dao->editStockPurchaseEntry($data,$purchaseEntryNo);
	}
	$inputData = array();
	
	echo "<pre>";
	print_r($_REQUEST);
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='partyInvoiceNo')
		{
			$arr = $data;
			foreach($arr as $k => $d)
			{
				//if($key != "exFreeQty")
				//{
				$inputData[$k][$key] = $d;
				$inputData[$k]['purchaseEntryNo'] = $purchaseEntryNo;
				//}
			}
			//$dao->addSalesEntry($inputData);
		}
	}
	$invoiceTotalWeight = 0;
	$invoiceTotalLitres = 0;
	$invoiceTotalAmount = 0;
	foreach($inputData as $key=>$data)
	{
		$weight = $dao->getWeight($data['itemCode']);
		$litres = $dao->getLitres($data['itemCode']);
		//echo $weight;
		//echo $litres;
		$totalWeight = $data['totalPcs'] * $weight['grossWeight'];
		$invoiceTotalWeight = $invoiceTotalWeight + $totalWeight;
		$totalLitres = $data['totalPcs']*$litres['litres'];
		$invoiceTotalLitres = $invoiceTotalLitres + $totalLitres;
		$invoiceTotalAmount = $invoiceTotalAmount + $data['amount'];
		$data['totalWeight'] = $totalWeight;
		$data['totalLitres'] = $totalLitres;

		//print_r($data);
		$dao->addSPEntry($data);
	}
	//echo "<pre>";
	//print_r($inputData);
	$dao->updateStockPurchaseInvoiceAggregates($purchaseEntryNo,$invoiceTotalWeight,$invoiceTotalLitres,$invoiceTotalAmount);
}

function generateSalesInvoiceNo()
{
	$dao = new DAO();
	$type =  $_REQUEST['type'];
	$maxInvoiceID = $dao->getMaxInvoiceID();
	$max = $maxInvoiceID[0][0];
	$prefix = getInitialsParty($_SESSION['type'],$_SESSION['typeID']);
	/* echo "<pre>";
	 echo $max;
	print_r($maxInvoiceID); */
	//echo $prefix.$_SESSION['type'];
	$invoiceNo = $type.$prefix.str_pad($max,6,'0',STR_PAD_LEFT);
	echo $invoiceNo;
}
function getInitialsParty($type,$typeID)
{
	$dao = new DAO();
	if($type == 'Branch')
	{
		$branchDetail = $dao->getBranchDetailByID($typeID);
		$name = $branchDetail['name'];
		$city = $branchDetail['city'];
		return substr($name, 0,1).substr($city,0,1);
	}
	else if($type == 'CF')
	{
		$cfDetail = $dao->getCFDetailByID($typeID);
		$name = $cfDetail['name'];
		$city = $cfDetail['city'];
		return substr($name, 0,1).substr($city,0,1);
	}
}

function generateStockTransferInvoiceNo()
{
	$dao = new DAO();
	$from = $_REQUEST['from'];
	$to = $_REQUEST['to'];
	$maxInvoiceID = $dao->getMaxStockInvoiceID();
	$max = $maxInvoiceID[0][0];
	/* echo "<pre>";
	 echo $max;
	print_r($maxInvoiceID); */
	$invoiceNo = $from.$to.str_pad($max,6,'0',STR_PAD_LEFT);
	echo $invoiceNo;
}
function getAccessControl()
{
	$dao = new DAO();
	$allEmployees = $dao->getAllEmployees();
	include "../view/accessControl.php";
}
function loadAccessControlTypeID()
{
	$type = $_REQUEST['type'];
	$dao = new DAO();
	$allBranch = $dao->getAllBranch();
	$allCF = $dao->getAllCF();
	include "../view/accessControlTypeID.php";
}
function getReportMaster()
{
	$dao = new DAO();
	$allDebtors = $dao->getAllDebtors();
	$allBranch = $dao->getAllBranch();
	$allCF = $dao->getAllCF();
	$allStates = $dao->getAllStates();
	$allProducts = $dao->getAllProducts();
	$alCategories = $dao->getAllCategories();
	$allBrand = $dao->getAllBrands();
	$allDist = $dao->getAllDistributors();
	include "../view/reportMaster.php";
}
function getStateByCountry()
{
	$country = $_REQUEST['country'];
	$dao = new DAO();
	$selectedStates = $dao->getStateByCountry($country);
	include "../view/stateSelectOptions.php";
}
function  getCityByState()
{
	$state = $_REQUEST['state'];
	$dao = new DAO();
	$selectedStates = $dao->getCityByState($state);
	include "../view/stateSelectOptions.php";
}
function  getTypeIDByType()
{
	$type = $_REQUEST['type'];
	$dao = new DAO();
	$seletedTypeID = $dao->getTypeIDByType($type);
	include "../view/typeIDSelectOptions.php";
}
function  getTypeIDByTypeForEdit()
{
	$type = $_REQUEST['type'];
	$typeID = $_REQUEST['typeID'];
	$toPartyDetails['typeID'] = $typeID;
	$dao = new DAO();
	$seletedTypeID = $dao->getTypeIDByType($type);
	include "../view/typeIDSelectOptionsForEdit.php";
}
function loadCurrencySign()
{
	$dao =new DAO();
	$currencyName = $_REQUEST['currencyName'];
	$currencySign = $dao->loadCurrencySign($currencyName);
	echo $currencySign;
}
 function getStateOfDistributor()
 {
 	$distID = $_REQUEST['distID'];
 	$dao = new DAO();
 	echo trim($dao->getStateOfDistributor($distID));
 }
 function getStateWiseTransporter()
 {
 	$state = $_REQUEST['state'];
 	$dao = new DAO();
 	$transporter = $dao->getStateWiseTransporter($state);
 	include("../view/selectStateWiseTransporter.php");
 }
 function getStateWiseSalesman()
 {
 	$state = $_REQUEST['state'];
 	$dao = new DAO();
 	$salesman= $dao->getStateWiseSalesman($state);
 	include("../view/selectStateWiseSalesman.php");
 }
function getBasicPriceFromItemCode()
{
	$itemCode = $_REQUEST['itemCode'];
	$state = $_REQUEST['state'];
	$dao = new DAO();
	$basicPrice = $dao->getBasicPriceFromItemCode($itemCode,$state);
	echo $basicPrice[0]['rate'];  
} 
function getWarehouseIDByTypeAndTypeID()
{
	$type = $_REQUEST['type'];
	$typeID = $_REQUEST['typeID'];
	$dao = new DAO();
	$warehouses = $dao->getWarehouseByTypeAndTypeID($type,$typeID);
	echo $warehouses[0]['warehouseID'];
}
function loadCreditorDetails()
{
	$dao = new DAO();
	$supplierID = $_REQUEST['supplierID'];
	$supplierDetails = $dao->getSupplierDetailsByID($supplierID);
	echo json_encode($supplierDetails);
}
function getSubRetailerByType()
{
	$type = $_REQUEST['type'];
	$dao = new DAO();
	$subretailers =  $dao->getSubRetailerByType($type);
	include "../view/selectSubRetailer.php";
}
function loadReportParameter()
{
	$dao = new DAO();
	$reportType = $_REQUEST['reportType'];
	$state = $_REQUEST['state'];
	if ($reportType == 'spr')
	{
		$options = $dao->getSalesPersonByState($state);
	}
	else if ($reportType == 'dr')
	{
		$options = $dao->getDistributorByState($state);
	}
	else if ($reportType == 'pwr')
	{
		$options = $dao->getAllProduct();
	}
	else if ($reportType == 'cwr')
	{
		$options = $dao->getAllCategories();
	}
	else if ($reportType == 'bwr')
	{
		$options = $dao->getAllBrands();
	}
	include "../view/options.php";
}
function getMonthByNumber($num)
{
	$month = "";
	switch($num)
	{
		case 0:  $month = "N/A";
						break;
		case 1:  $month = "Jan";
						break;
		case 2:  $month = "Feb";
						break;
		case 3:  $month = "Mar";
						break;
		case 4:  $month = "Apr";
						break;
		case 5:  $month = "May";
						break;
		case 6:  $month = "June";
						break;
		case 7:  $month = "July";
						break;
		case 8:  $month = "Aug";
						break;
		case 9:  $month = "Sep";
						break;
		case 10:  $month = "Oct";
						break;
		case 11:  $month = "Nov";
						break;
		case 12:  $month = "Dec";
						break;
		default:  $month = "N/A";
						   break;
	}
	return $month;
}
/* function generateReport()
{
	if($_REQUEST['reportType']== "sr")
	{
	$re = new ReportEngine();
	$monthlySales = $re->getMonthlySalesReport();
	$stateSales = $re->getStatesSalesReport();
	$allSales = $re->getSalesReport();
	//echo "<pre>";
	//print_r($monthlySales);
	$monthlySalesArray = array();
	foreach($monthlySales as $key=>$data)
	{
		$monthlySalesArray[] = array(getMonthByNumber($data['month']),$data['amount']);
	}
	$stateSalesArray = array();
	foreach($stateSales as $key=>$data)
	{
		$stateSalesArray[] = array($data['state'],$data['amount']);
	}
	include "../view/generateReport.php";
	}
	else if($_REQUEST['reportType']== "spr")
	{
		$region = $_REQUEST['state'];
		$startDate = $_REQUEST['startDate'];
		$endDate = $_REQUEST['endDate'];
		$parameter = $_REQUEST['param'];
		$re = new ReportEngine();
		$monthlySales = $re->getMonthlySPSalesReportByDate($startDate, $endDate, $parameter);
		$monthlySalesArray = array();
		foreach($monthlySales as $key=>$data)
		{
			$monthlySalesArray[] = array(getMonthByNumber($data['month']),$data['amount']);
		}
		include "../view/generateSPReport.php";
	}
} */
function getStateByTypeID()
{
	$type = $_REQUEST['type'];
	$typeID = $_REQUEST['typeID'];
	$dao = new DAO();
	if($type == 'HO')
	{
		echo "Maharashtra";
	}
	else if($type == 'Branch')
	{
		$state = $dao->getStateByBranchID($typeID);
		echo $state;
	}
	else if($type == 'CF')
	{
		$state = $dao->getStateByCFID($typeID);
		echo $state;
	}
	else
	 {
	 	echo "Maharashtra";
	}
}
function getReport()
{
	include "../../report.html";
}
function getCurrentWarehouseID()
{
	$type = $_SESSION['type'];
	$typeID = $_SESSION['typeID'];
	$dao = new DAO();
	$warehouses = $dao->getWarehouseByTypeAndTypeID($type,$typeID);
	echo $warehouses[0]['warehouseID'];
}
function checkStockTransferAvailability()
{
	$dao = new DAO();
    $inputData = array();
	$flag = 0;
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='to' && $key != 'from')
		{
			$arr = $data;
			foreach($arr as $k => $d)
			{
				$inputData[$k][$key] = $d;
				//$inputData[$k]['invoiceNo'] = $invoiceNo;
			}
		}
	}
	foreach ($inputData as $key=>$insertData)
	{	
	    $flag += $dao->checkStockTransferAvailability($insertData);
	}
	echo $flag;
}
function checkSalesAvailability()
{
	$dao = new DAO();
	$inputData = array();
	$flag = 0;
	foreach($_REQUEST as $key=>$data)
	{
		if($key != 'a' && $key!='to' && $key != 'from')
		{
			$arr = $data;
			foreach($arr as $k => $d)
			{
				$inputData[$k][$key] = $d;
				//$inputData[$k]['invoiceNo'] = $invoiceNo;
			}
		}
	}
	foreach ($inputData as $key=>$insertData)
	{
		$flag += $dao->checkStockTransferAvailability($insertData);
	}
	echo $flag;
}
function generateBrandWiseReport()
{
	$re = new ReportEngine();
	$dao = new DAO();
	$allBrand = $dao->getAllBrands();
	$dataSet = $re->getBrandWiseSalesData($_REQUEST);
	$dataSetDateWise = $re->getBrandWiseSalesDataDateWise($_REQUEST);
	$arrLitre = array();
	$totalArrLitres = array();
	$arrAmount = array();
	$totalArrAmount = array();
	foreach($dataSetDateWise as $key=>$data)
	{
	    $arrLitre[$data['month']][$data['brand']] = $data['litre'];	
	    $arrLitre[$data['month']]['month'] = $data['month'];
	}
	foreach($arrLitre as $key=>$data)
	{
		$totalArrLitres[ ] = $data;
	}
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrAmount[$data['month']][$data['brand']] = $data['amount'];
		$arrAmount[$data['month']]['month'] = $data['month'];
	}
	foreach($arrAmount as $key=>$data)
	{
		$totalArrAmount[ ] = $data;
	}
	$inputGraphDataLitres = json_encode($totalArrLitres);
	$inputGraphDataAmount = json_encode($totalArrAmount);
	include "../view/generatedBrandWiseReport.php";
}
function generateCityWiseReport()
{
	$re = new ReportEngine();
	$dao = new DAO();
	//$allBrand = $dao->getAllBrands();
	$dataSet = $re->getCityWiseSalesData($_REQUEST);
	$dataSetDateWise = $re->getCityWiseSalesDataDateWise($_REQUEST);
	$arrLitre = array();
	$totalArrLitres = array();
	$arrAmount = array();
	$totalArrAmount = array();
	$allCity = array();
	$allCityAl = array();
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrLitre[$data['month']][$data['city']] = $data['litre'];
		$arrLitre[$data['month']]['month'] = $data['month'];
		$allCity[$data['city']] = 1;
	}
	foreach($allCity as $key=>$data)
	{
		$allCityAl[] = array("city"=>$key);
	}
	foreach($arrLitre as $key=>$data)
	{
		$totalArrLitres[ ] = $data;
	}
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrAmount[$data['month']][$data['city']] = $data['amount'];
		$arrAmount[$data['month']]['month'] = $data['month'];
	}
	foreach($arrAmount as $key=>$data)
	{
		$totalArrAmount[ ] = $data;
	}
	$inputGraphDataLitres = json_encode($totalArrLitres);
	$inputGraphDataAmount = json_encode($totalArrAmount);
	include "../view/generatedCityWiseReport.php";
}
function generateDistWiseReport()
{
	$re = new ReportEngine();
	$dao = new DAO();
	//$allBrand = $dao->getAllBrands();
	$dataSet = $re->getDistWiseSalesData($_REQUEST);
	$dataSetDateWise = $re->getDistWiseSalesDataDateWise($_REQUEST);
	$arrLitre = array();
	$totalArrLitres = array();
	$arrAmount = array();
	$totalArrAmount = array();
	$allCity = array();
	$allCityAl = array();
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrLitre[$data['month']][$data['name']] = $data['litre'];
		$arrLitre[$data['month']]['month'] = $data['month'];
		$allCity[$data['name']] = 1;
	}
	foreach($allCity as $key=>$data)
	{
		$allCityAl[] = array("city"=>$key);
	}
	foreach($arrLitre as $key=>$data)
	{
		$totalArrLitres[ ] = $data;
	}
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrAmount[$data['month']][$data['name']] = $data['amount'];
		$arrAmount[$data['month']]['month'] = $data['month'];
	}
	foreach($arrAmount as $key=>$data)
	{
		$totalArrAmount[ ] = $data;
	}
	$inputGraphDataLitres = json_encode($totalArrLitres);
	$inputGraphDataAmount = json_encode($totalArrAmount);
	include "../view/generatedDistWiseReport.php";
}
function generateCategoryWiseReport()
{
	$re = new ReportEngine();
	$dao = new DAO();
	//$allBrand = $dao->getAllBrands();
	$dataSet = $re->getCategoryWiseSalesData($_REQUEST);
	$dataSetDateWise = $re->getCategoryWiseSalesDataDateWise($_REQUEST);
	$arrLitre = array();
	$totalArrLitres = array();
	$arrAmount = array();
	$totalArrAmount = array();
	$allCity = array();
	$allCityAl = array();
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrLitre[$data['month']][$data['productCategory']] = $data['litre'];
		$arrLitre[$data['month']]['month'] = $data['month'];
		$allCity[$data['productCategory']] = 1;
	}
	foreach($allCity as $key=>$data)
	{
		$allCityAl[] = array("city"=>$key);
	}
	foreach($arrLitre as $key=>$data)
	{
		$totalArrLitres[ ] = $data;
	}
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrAmount[$data['month']][$data['productCategory']] = $data['amount'];
		$arrAmount[$data['month']]['month'] = $data['month'];
	}
	foreach($arrAmount as $key=>$data)
	{
		$totalArrAmount[ ] = $data;
	}
	$inputGraphDataLitres = json_encode($totalArrLitres);
	$inputGraphDataAmount = json_encode($totalArrAmount);
	include "../view/generatedCategoryWiseReport.php";
}
function generateProductWiseReport()
{
	$re = new ReportEngine();
	$dao = new DAO();
	$allBrand = $dao->getAllBrands();
	$allProduct = array();
	$dataSet = $re->getProductWiseSalesData($_REQUEST);
	$dataSetDateWise = $re->getProductWiseSalesDataDateWise($_REQUEST);
	$arrLitre = array();
	$totalArrLitres = array();
	$arrAmount = array();
	$totalArrAmount = array();
	$arrProd = array();
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrLitre[$data['month']][$data['itemDesc']] = $data['litre'];
		$arrLitre[$data['month']]['month'] = $data['month'];
		$arrProd[$data['itemDesc']]  = 1;
	}
	foreach($arrProd as $key=>$data)
	{
		$allProduct[] = array("itemDesc" => $key); 
	}
	foreach($arrLitre as $key=>$data)
	{
		$totalArrLitres[ ] = $data;
	}
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrAmount[$data['month']][$data['itemDesc']] = $data['amount'];
		$arrAmount[$data['month']]['month'] = $data['month'];
	}
	foreach($arrAmount as $key=>$data)
	{
		$totalArrAmount[ ] = $data;
	}
	$inputGraphDataLitres = json_encode($totalArrLitres);
	$inputGraphDataAmount = json_encode($totalArrAmount);
	include "../view/generatedProductWiseReport.php";
}
function generateStateWiseReport()
{
	$re = new ReportEngine();
	$dao = new DAO();
	$allBrand = $dao->getAllBrands();
	$allState = array();
	$dataSet = $re->getStateWiseSalesData($_REQUEST);
	$dataSetDateWise = $re->getStateWiseSalesDataDateWise($_REQUEST);
	$arrLitre = array();
	$totalArrLitres = array();
	$arrAmount = array();
	$totalArrAmount = array();
	$arrState = array();
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrLitre[$data['month']][$data['state']] = $data['litre'];
		$arrLitre[$data['month']]['month'] = $data['month'];
		$arrState[$data['state']]  = 1;
	}
	foreach($arrState as $key=>$data)
	{
		$allState[] = array("state" => $key);
	}
	foreach($arrLitre as $key=>$data)
	{
		$totalArrLitres[ ] = $data;
	}
	foreach($dataSetDateWise as $key=>$data)
	{
		$arrAmount[$data['month']][$data['state']] = $data['amount'];
		$arrAmount[$data['month']]['month'] = $data['month'];
	}
	foreach($arrAmount as $key=>$data)
	{
		$totalArrAmount[ ] = $data;
	}
	$inputGraphDataLitres = json_encode($totalArrLitres);
	$inputGraphDataAmount = json_encode($totalArrAmount);
	include "../view/generatedStateWiseReport.php";
}
function getEditStockTransfer()
{
	$dao =new DAO();
	//$_SESSION['username'] = $username;
	$_SESSION['partyName'] = $dao->getPartyDetails($_SESSION['type'], $_SESSION['typeID']);
	$_SESSION['warehouseDetails'] = $dao->getWarehouseDetails($_SESSION['userId'] );
	$_SESSION['warehouseSummary'] = $dao->getWarehouseSummary($_SESSION['userId']);
	$editStockInvoiceNo = $_REQUEST['invoiceNo'];
	$invoiceDetails = $dao->getStockTransferInvoiceByInvoiceNo($editStockInvoiceNo);
	$salesDetails = $dao->getStockTransferEntryByInvoiceNo($editStockInvoiceNo);
	$_SESSION['editStockTransferInvoiceDetail'] = $invoiceDetails;
	$_SESSION['editStockTransferSalesDetail'] = $salesDetails;
	$toPartyName = $dao->getPartyNameByWarehouse($invoiceDetails['to']);
	$toPartyDetails= $dao->getTypeByWarehouse($invoiceDetails['to']);
	$allWarehouse = $dao->getAllWarehouse();
	$allTransporter = $dao->getAllTransporter();
	$allEmployees = $dao->getAllEmployees();
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$allTaxCode = $dao->getAllTaxCode();
	include "../view/editStockTransfer.php";
}
function getEditStockPurchase()
{
	$dao =new DAO();
	//$_SESSION['username'] = $username;
	$_SESSION['partyName'] = $dao->getPartyDetails($_SESSION['type'], $_SESSION['typeID']);
	$_SESSION['warehouseDetails'] = $dao->getWarehouseDetails($_SESSION['userId'] );
	$_SESSION['warehouseSummary'] = $dao->getWarehouseSummary($_SESSION['userId']);
	$editStockInvoiceNo = $_REQUEST['invoiceNo'];
	$invoiceDetails = $dao->getStockPurchaseInvoiceByInvoiceNo($editStockInvoiceNo);
	$salesDetails = $dao->getStockPurchaseEntryByInvoiceNo($editStockInvoiceNo);
	$_SESSION['editStockPurchaseInvoiceDetail'] = $invoiceDetails;
	$_SESSION['editStockPurchaseSalesDetail'] = $salesDetails;
	$allTransporter = $dao->getAllTransporter();
	$allEmployees = $dao->getAllEmployees();
	$allDebtors = $dao->getAllDebtors();
	$allProduct = $dao->getAllProduct();
	$allWarehouse = $dao->getAllWarehouse();
	$allCreditors = $dao->getAllCreditors();
	$allCurrency = $dao->getAllCurrency();
	$hoWarehouse = $dao->getWarehouseForHO();
/* 	echo "<pre>";
	echo $editStockInvoiceNo;
	print_r($invoiceDetails);
	print_r($salesDetails); */
	include "../view/editStockPurchase.php";
}

function getStockInvoiceMaster()
{
	$dao = new DAO();
	$toWarehouse = $dao->getWarehouseByTypeAndTypeID($_SESSION['type'], $_SESSION['typeID']);
	$warehouseString = "";
	foreach($toWarehouse as $key=>$data)
	{
		$warehouseString .= $data['warehouseID'].",";
	}
	$warehouseString = substr($warehouseString, 0,strlen($warehouseString)-1);
	$rows = $dao->getPartyWiseInvoiceNo($warehouseString);
	include "../view/stockTransferMaster.php";
}
function getStockPurchaseMaster()
{
	$dao = new DAO();
	$rows = $dao->getAllStockPurchase();
	include "../view/stockPurchaseMaster.php";
}
function getSalesInvoiceMaster()
{
	$dao = new DAO();
	$sql = "select  *  from `ems`.`salesinvoice` where `fromType`='".$_SESSION['type']."' and `fromTypeID`='".$_SESSION['typeID']."' ";
	$rows = $dao->fetch($sql);
	include "../view/salesInvoiceMaster.php";
}

?>


