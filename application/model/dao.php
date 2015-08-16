 <?php
session_start();
error_reporting(0);
if(isset($_REQUEST['dao']))
{
	$a = $_REQUEST['dao'];
	$dao = new DAO();
	$dao->$a();
}
class DAO
{
    private $host;
    private $username;
    private $password;
    
    public function DAO()
    {
        $host = 'localhost';
        $username = 'db';
        $password = 'dbpass';
        $con = mysql_connect($host,$username,$password);
        if(!$con)
        {
            echo "Not Connected to Database";
        }
    }
    public function fetch($sql)
    {
    	$result = mysql_query($sql);
    	$return = array();
    	while($row = mysql_fetch_array($result))
    	{
    		$return[] = $row;
    	}
    	return $return;
    	
    }
    public function update($sql)
    {
    	$result = mysql_query($sql);
    }
    public function pInsert($insertData,$tableName)
    {
    	foreach($insertData as $key=>$data)
    	{
    		$$key = $data;
    	}
    	$sql = "insert into ".$tableName."(";
    	foreach($insertData as $key => $data)
    	{
    		if($key != "dao" && $key!="a" && $key!="PHPSESSID")
    		{
    			$sql.= "`".$key."`,";
    		}
    	}
    	$sql = substr($sql, 0,strlen($sql)-1);
    	$sql .= ") values(";
    	foreach($insertData as $key => $data)
    	{
    		if($key != "dao" && $key!="a" && $key!="PHPSESSID")
    		{
    			$sql.= "'".$data."',";
    		}
    	}
    	$sql = substr($sql, 0,strlen($sql)-1);
    	$sql = $sql.")";
    	echo $sql;
    	$this->update($sql);
    }
    public function pUpdate($tableName,$updateData, $whereCondition)
    {
    	$sql = "update ".$tableName;
    	$sql .= "set "; 
    	foreach ($updateData as $key => $data)
    	{
    		$sql.= "`".$key."` =  '".$data. "',";
    	}
    	$sql = substr($sql, 0,strlen($sql)-1);
    	$sql.= $whereCondition;
    	echo $sql;
    	$this->update($sql);
    }
    public function pDelete($tableName,$whereCondition)
    {
    	$sql = "delete from ".$tableName."  ".$whereCondition;
    	$this->update($sql);  	
    }
    public function pSelect($tableName,$whereCondition="")
    {
    	$sql = "select  *  from ".$tableName." ".$whereCondition;
    	//echo $sql;
    	return $this->fetch($sql);
    }
    public function checkSignIn($username,$password)
    {
       $sql = "select count(*) as `count` from `ems`.`auth` where `username` = '$username'
               and `password`='$password' ";
       $result = mysql_query($sql);
       $return = array();
       while($row = mysql_fetch_array($result))
       {
       	$return[] = $row;
       }
       return $return[0]['count'];
    }
    public function getUserDetails($username)
    {
    	$userDetails = $this->pSelect("`ems`.`auth`","  where  `username` = '$username'");
    	return $userDetails[0];
    }
    //fetching general ledger account information
    public function getAccountDetails()
    {
    	$sql = "select `A`.`AccountID`,`A`.`Account`,`A`.`AccountDescription`,`B`.`Account` as `ParentAccount`  
    			from `ems`.`accounttype` `A`,`ems`.`accounttype` `B`
    			where `A`.`ParentAccountID` = `B`.`AccountID` order by `A`.`AccountID` ";
    	return $this->fetch($sql);
    }
    
    public function getWarehouseDetails($userId)
    {
    	
    	$sql = "select distinct `C`.* , `B`.*  from `ems`.`auth` `A`, `ems`.`warehousemaster` `B`, `ems`.`inventorymanagement` `C`\n"
    . "where `A`.`userId` = '$userId'"
    . "and `A`.`type` = `B`.`type`\n"
    . "and `A`.`typeID` = `B`.`partyName`\n"
    . "and `B`.`warehouseID` = `C`.`warehouseID`";
    	return $this->fetch($sql);
    }
    public function getWarehouseForHO()
    {
    	$sql = "select distinct * from `ems`.`warehousemaster` where `type` = 'HO' and `partyName`= 0";
    	return $this->fetch($sql);
    }
    public function getWarehouseByTypeAndTypeID($type,$typeID)
    {
    	$sql = "select distinct * from `ems`.`warehousemaster` where `type` = '$type' and `partyName`= $typeID";
    	return $this->fetch($sql);
    }
    public function getWarehouseSummary($userId)
    {
    	$sql = "select distinct  `B`.*  from `ems`.`auth` `A`, `ems`.`warehousemaster` `B`, `ems`.`inventorymanagement` `C`\n"
    			. "where `A`.`userId` = '$userId'"
    			. "and `A`.`type` = `B`.`type`\n"
               . "and `A`.`typeID` = `B`.`partyName`\n"
               . "and `B`.`warehouseID` = `C`.`warehouseID`";
    	return $this->fetch($sql);
    }
    
    public function saveAccountType()
    {
    	$accountID = $_REQUEST['accountID']; 
    	$Account =  $_REQUEST['account'.$accountID];
    	$AccountDescription = $_REQUEST['accountDescription'.$accountID];
    	$ParentAccount = $_REQUEST['parentAccount'.$accountID];
    	$sql="update `ems`.`accounttype` set `Account`= '$Account', `AccountDescription`= '$AccountDescription', `ParentAccountID` = '$ParentAccount'
    	        where `AccountID` = '$accountID' ";
    	echo $sql;
    	$this->update($sql);
    }
    public function deleteAccount()
    {
    	$accountID = $_REQUEST['accountID'];
    	$sql = "delete from `ems`.`accounttype` where `AccountID`='$accountID' ";
    	$this->update($sql);
    }
    public function addNewAccount()
    {
    	$account = $_REQUEST['account'];
    	$accountDescription = $_REQUEST['accountDescription'];
    	$parentAccountID = $_REQUEST['parentAccountID'];
    	$sql="insert into `ems`.`accounttype`(`Account`,`AccountDescription`,`ParentAccountID`)
    			values('$account','$accountDescription','$parentAccountID')";
    	$this->update($sql);
    }
    public function getDCDetail()
    {
    	$sql = "select  *  from `ems`.`dcmaster`";
    	$this->fetch($sql);
    }
    public function addNewDc()
    {
    	$this->pInsert($_REQUEST,"`ems`.`dcmaster`");
    	$this->update($sql);
    }
    public function updateDC()
    {
    	$updateData = array();
    	foreach($_REQUEST as $key=>$data)
    	{
    		if($key != "dao" && $key != "whereCondition")
    		{
    			$updateData[$key] = $data;
    		}
    	}
    	$this->pUpdate("`ems`.`dcmaster`", $updateData, " where `id` =".$_REQUEST['id']);
    }
    public function deleteDc()
    {
    	$this->pDelete("`ems`.`dcmaster`", " where `id`=".$_REQUEST['id']);
    }
    public function addNewSo()
    {
    	$this->pInsert($_REQUEST,"`ems`.`employeemaster`");
    }
    public function updateSalesOfficer()
    {
    	$updateData = array();
    	foreach($_REQUEST as $key=>$data)
    	{
    		if($key != "dao" && $key != "whereCondition")
    		{
    			$updateData[$key] = $data;
    		}
    	}
    	$this->pUpdate("`ems`.`somaster`", $updateData, " where `employeeID` = ".$_REQUEST['whereCondition']);
    }
    public function createInvoice($insertData)
    {
    	$this->pInsert($insertData, "`ems`.`salesinvoice`");
    }
	public function getAllDesignations()
	{
		return $this->pSelect("`ems`.`designation`","");
	}
	public function getAllDepartments()
	{
		return $this->pSelect("`ems`.`department`","");
	}
	public function getEmployeeDetail($empID)
	{
		return $this->pSelect("`ems`.`employeemaster`","where `empID`=".$empID);
	}
	public function updateEmployeeDetail()
	{
		$updateData = array();
    	foreach($_REQUEST as $key=>$data)
    	{
    		if($key != "dao" && $key != "whereCondition")
    		{
    			$updateData[$key] = $data;
    		}
    	}
		$this->pUpdate("`ems`.`employeemaster`", $updateData, " where `empID` =".$_REQUEST['whereCondition']);
	}
	public function addSalesEntry($insertData)
	{
		$this->pInsert($insertData,"`ems`.`salesentry`");
		$ctn = $insertData['ctn'];
		$pcs = $insertData['pcs'];
		$totalPcs = $insertData['totalPcs'];
		$itemCode = $insertData['itemCode'];
		$godownNo = $insertData['godownNo'];
		$batchNo = $insertData['batchNo'];
		$packing =  $insertData['packing'];
		$sql = "select * from `ems`.`inventorymanagement` where `itemCode`= '$itemCode'   "
     			         ."and `warehouseID`='$godownNo' and `batchNo`='$batchNo'  ";
		$return = $this->fetch($sql);
		$avail = $return[0];
		 if($avail['ctn'] >= $ctn && $avail['pcs'] >= $pcs && $avail['totalPcs'] >=  $totalPcs)
		{
		$sql = " update `ems`.`inventorymanagement` "
     				    ."set `ctn` = `ctn` - $ctn,  "
     				    ."`pcs` = `pcs` -  $pcs, "
     				    ."`totalPcs` = `totalPcs` -  $totalPcs  "
     				    ." where `itemCode`= '$itemCode'   "
     			         ."and `warehouseID`='$godownNo' and `batchNo`='$batchNo' ";
		$this->update($sql);
		} 
		else if($avail['totalPcs'] >=  $totalPcs)
		{
			if($avail['pcs'] < $pcs  &&   ( ( $avail['ctn']-$ctn)*$packing)  >=  ($pcs- $avail['pcs']) )
			{
				$deductedCtn = ceil(($pcs- $avail['pcs'])/$packing);
				$totalDeductedCtn = $deductedCtn + $ctn;
				$deductedPcs = $avail['pcs'];
				$newPcs = ($deductedCtn * $packing) - ($pcs- $avail['pcs']);
				$sql = " update `ems`.`inventorymanagement` "
						."set `ctn` = `ctn` - $totalDeductedCtn,  "
						."`pcs` = $newPcs, "
						."`totalPcs` = `totalPcs` -  $totalPcs  "
						." where `itemCode`= '$itemCode'   "
						."and `warehouseID`='$godownNo' and `batchNo`='$batchNo' ";
						$this->update($sql);
			}
		}
	}
	
	public function createStockTransferInvoice($insertData)
	{
		$this->pInsert($insertData,"`ems`.`stocktransferinvoice`");
	}
	public function editStockTransferEntry($insertData,$fromWarehouse,$toWarehouse,$invoiceNo)
	{
		$sql = "delete from `ems`.`stocktransferentry` where `invoiceNo` = '$invoiceNo' ";
		$this->update($sql);
		$ctn = $insertData['ctn'];
		$pcs = $insertData['pcs'];
		$totalPcs = $insertData['totalPcs'];
		$itemCode = $insertData['itemCode'];
		$godownNo = $insertData['godownNo'];
		$fromWarehouse = $godownNo;
		$batchNo = $insertData['batchNo'];
		$mfgDate = $insertData['mfgDate'];
		$expDate = $insertData['expDate'];
		$sql = "select count(*) as `cnt` from `ems`.`inventorymanagement` where `itemCode`=' $itemCode ' "
		."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo'  ";
		$return = $this->fetch($sql);
		$availTo = $return[0]['cnt'];
		if($availTo > 0)
		{
		$sql = " update `ems`.`inventorymanagement` "
				."set `ctn` = `ctn` + $ctn,  "
				."`pcs` = `pcs` +  $pcs, "
				."`totalPcs` = `totalPcs` +  $totalPcs  "
				." where `itemCode`= '$itemCode'   "
				."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo' ";
		$this->update($sql);
		}
		else 
		{
			$sql = "insert into `ems`.`inventorymanagement`(`itemCode`,`warehouseID`,`batchNo`,`ctn`,`pcs`,`totalPcs`,`mfgDate`,`expDate`)
			values('$itemCode','$fromWarehouse','$batchNo','$ctn','$pcs','$totalPcs','$mfgDate','$expDate')";
			mysql_query($sql);
		}
		$sql = " update `ems`.`inventorymanagement` "
				."set `ctn` = `ctn` -$ctn,  "
				."`pcs` = `pcs` -  $pcs, "
				."`totalPcs` = `totalPcs` -  $totalPcs "
				." where `itemCode`= '$itemCode'   "
				."and `warehouseID`='$toWarehouse' and `batchNo`='$batchNo' ";
		$this->update($sql);
		
	}
	public function editStockPurchaseEntry($insertData,$purchaseEntryNo)
	{
		$sql= "delete from `ems`.`stockpurchaseentry` where `purchaseEntryNo`='$purchaseEntryNo' ";
		$this->update($sql);
		$ctn = $insertData['ctn'];
		$pcs = $insertData['pcs'];
		$totalPcs = $insertData['totalPcs'];
		$itemCode = $insertData['itemCode'];
		$godownNo = $insertData['godownNo'];
		$fromWarehouse = $godownNo;
		$batchNo = $insertData['batchNo'];
		$mfgDate = $insertData['mfgDate'];
		$expDate = $insertData['expDate'];
		$sql = "select count(*) as `cnt` from `ems`.`inventorymanagement` where `itemCode`=' $itemCode ' "
		."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo'  ";
		$return = $this->fetch($sql);
		$availTo = $return[0]['cnt'];
		if($availTo > 0)
		{
		$sql = " update `ems`.`inventorymanagement` "
				."set `ctn` = `ctn` - $ctn,  "
					."`pcs` = `pcs` - $pcs, "
					."`totalPcs` = `totalPcs` - $totalPcs  "
					." where `itemCode`= '$itemCode'   "
					."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo' ";
					$this->update($sql);
		}
		}
		
		public function editSalesEntry($insertData,$purchaseEntryNo)
		{
			$ctn = $insertData['ctn'];
			$pcs = $insertData['pcs'];
			$totalPcs = $insertData['totalPcs'];
			$itemCode = $insertData['itemCode'];
			$godownNo = $insertData['godownNo'];
			$fromWarehouse = $godownNo;
			$batchNo = $insertData['batchNo'];
			$mfgDate = $insertData['mfgDate'];
			$expDate = $insertData['expDate'];
			$sql = "select count(*) as `cnt` from `ems`.`inventorymanagement` where `itemCode`=' $itemCode ' "
			."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo'  ";
			$return = $this->fetch($sql);
			$availTo = $return[0]['cnt'];
			if($availTo > 0)
			{
			$sql = " update `ems`.`inventorymanagement` "
				."set `ctn` = `ctn` + $ctn,  "
						."`pcs` = `pcs` + $pcs, "
						."`totalPcs` = `totalPcs` + $totalPcs  "
						." where `itemCode`= '$itemCode'   "
						."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo' ";
						$this->update($sql);
			}
			}
	public function addStockTransferEntry($insertData,$fromWarehouse,$toWarehouse)
	{
		$this->pInsert($insertData,"`ems`.`stocktransferentry`");
		$ctn = $insertData['ctn'];
		$pcs = $insertData['pcs'];
		$totalPcs = $insertData['totalPcs'];
		$itemCode = $insertData['itemCode'];
		$godownNo = $insertData['godownNo'];
		$fromWarehouse = $godownNo;
		$batchNo = $insertData['batchNo'];
		$mfgDate = $insertData['mfgDate'];
		$expDate = $insertData['expDate'];
		$sql = "select * from `ems`.`inventorymanagement` where `itemCode`= '$itemCode' "
		."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo'  ";
		echo $sql;
		echo "<pre>";
		print_r($avail);
		$return = $this->fetch($sql);
		$avail = $return[0];
		if($avail['ctn'] >= $ctn && $avail['pcs'] >= $pcs && $avail['totalPcs'] >=  $totalPcs)
		{
				$sql = " update `ems`.`inventorymanagement` "
     				    ."set `ctn` = `ctn` - $ctn,  "
		     				    ."`pcs` = `pcs` -  $pcs, "
		     				    ."`totalPcs` = `totalPcs` -  $totalPcs  "
		     				    ." where `itemCode`= '$itemCode'   "
		     				    ."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo' ";
		     				    $this->update($sql);
		     				    
		     				    echo $sql;
		}
		$sql = "select count(*) as `cnt` from `ems`.`inventorymanagement` where `itemCode`=' $itemCode ' "
		."and `warehouseID`='$toWarehouse' and `batchNo`='$batchNo'  ";
		
		echo $sql;
		$return = $this->fetch($sql);
		$availTo = $return[0]['cnt'];
		echo "availTo: ".$availTo;
		echo "fromWarehouse".$fromWarehouse;
		echo "toWarehouse".$toWarehouse;
		echo "<pre>";
		print_r($avail);
		if($avail['ctn'] >= $ctn && $avail['pcs'] >= $pcs && $avail['totalPcs'] >=  $totalPcs && $availTo > 0)
		{
			echo "in update";
			$sql = " update `ems`.`inventorymanagement` "
					."set `ctn` = `ctn` +$ctn,  "
					."`pcs` = `pcs` +  $pcs, "
					."`totalPcs` = `totalPcs` +  $totalPcs  "
					." where `itemCode`= '$itemCode'   "
					."and `warehouseID`='$toWarehouse' and `batchNo`='$batchNo' ";
			$this->update($sql);
		}
		else if($avail['ctn'] >= $ctn && $avail['pcs'] >= $pcs && $avail['totalPcs'] >=  $totalPcs)
		{
			echo "in insert";
			
			$sql = "insert into `ems`.`inventorymanagement`(`itemCode`,`warehouseID`,`batchNo`,`ctn`,`pcs`,`totalPcs`,`mfgDate`,`expDate`)
					      values('$itemCode','$toWarehouse','$batchNo','$ctn','$pcs','$totalPcs','$mfgDate','$expDate')";
			echo $sql;
			mysql_query($sql);
		}
	}
	public function getSalesInvoiceDetails()
	{
		return $this->pSelect("`ems`.`salesinvoice`","");
	}
	public function updateCurrentSalesInvoice($invoiceNo,$updateData)
	{
		$this->pUpdate("`ems`.`salesinvoice`",$updateData," where `invoiceNo` = '".$invoiceNo."'");
	}
	public function getSalesInvoiceByInvoiceNo($invoiceNo)
	{
		$sql = "select * from `ems`.`salesinvoice` where `invoiceNo`='$invoiceNo' ";
		//echo $sql;
		$return =  $this->fetch($sql);
		return $return[0];
	}
	public function getStockTransferInvoiceByInvoiceNo($invoiceNo)
	{
		$return =  $this->pSelect("`ems`.`stocktransferinvoice`"," where `stockTransferInvoiceNo`=$invoiceNo");
		return $return[0];
	}
	public function getStockPurchaseInvoiceByInvoiceNo($purchaseEntryNo)
	{
		$return =  $this->pSelect("`ems`.`stockpurchase`"," where `purchaseEntryNo`='".$purchaseEntryNo."'");
		return $return[0];
	}
	public function getSalesEntryByInvoiceNo($invoiceNo)
	{
		return $this->pSelect("`ems`.`salesentry`"," where `invoiceNo`='".$invoiceNo."'");
	}
	public function getStockTransferEntryByInvoiceNo($invoiceNo)
	{
		return $this->pSelect("`ems`.`stocktransferentry`"," where `invoiceNo`=$invoiceNo");
	}
	public function getStockPurchaseEntryByInvoiceNo($purchaseEntryNo)
	{
		return $this->pSelect("`ems`.`stockpurchaseentry`"," where `purchaseEntryNo`='".$purchaseEntryNo."'");
	}
	public function getAllProduct()
	{
		return $this->pSelect("`ems`.`productmaster`","");
	}
	public function getAllTransporter()
	{
		return $this->pSelect("`ems`.`transportermaster`","");
	}
	public function getAllEmployees()
	{
		return $this->pSelect("`ems`.`employeemaster`","");
	}
	public function getAllDebtors()
	{
		return $this->pSelect("`ems`.`dcmaster`"," where `dc`='d'");
	}
	public function getAllCreditors()
	{
		return $this->pSelect("`ems`.`dcmaster`"," where `dc`='c'");
	}
	public function getMaxInvoiceID()
	{
		$sql = "select max(`invoiceID`) from `ems`.`salesinvoice`";
		return $this->fetch($sql);
	}
	public function getMaxStockPurchaseID()
	{
		$sql = "select max(`stockPurchaseID`) from `ems`.`stockpurchase`";
		return $this->fetch($sql);
	}
	public function getMaxStockInvoiceID()
	{
		$sql = "select max(`invoiceID`) from `ems`.`stocktransferinvoice`";
		return $this->fetch($sql);
	}
	
	public function getAvailabilityDetail($itemCode)
	{
		$sql = "select * from `ems`.`inventorymanagement` where `itemCode`='$itemCode'";
		return $this->fetch($sql);		
	}
   public function getGodownDetails($warehouseID, $itemCode)
   {
   	  $sql = "select  *  from `ems`.`inventorymanagement` where `warehouseID` = '$warehouseID' and `itemCode` = '$itemCode' ";
   	  $return = array();
   	  $return =  $this->fetch($sql);
   	  return $return[0];
   }
   public function getItemDetailsForSale($itemCode)
   {
   	  $sql = "select * from `ems`.`productmaster` where  `itemCode` = '$itemCode' "; 
   	  $return = $this->fetch($sql);
   	  return $return[0] ;
     }
     public function getAllWarehouse()
     {
     	$return = $this->pSelect("`ems`.`warehousemaster`","");
     	return $return;
     }
     public function getAllAreas()
     {
     	$return = $this->pSelect("`ems`.`areamaster`","");
     	return $return;
     }
     public function createStockPurchase($insertData)
     {
     	$this->pInsert($insertData, "`ems`.`stockpurchase`");
     }
     public function addSPEntry($insertData)
     {
     	$data = $insertData;
     	$itemCode = $data['itemCode'];
     	$godownNo = $data['godownNo'];
     	$batchNo = $data['batchNo'];
     	$mfgDate = $data['mfgDate'];
     	$expDate = $data['expDate'];
     	$packing = $data['packing'];
     	$ctn = $data['ctn'];
     	$pcs = $data['pcs'];
     	$totalPcs = $data['totalPcs'];
     	$this->pInsert($insertData, "`ems`.`stockpurchaseentry`");
     	$sql = "select count(*) as `cnt` from `ems`.`inventorymanagement` where `itemCode`='$itemCode'"
     			    ."and `warehouseID`='$godownNo' and `batchNo`='$batchNo'";
     	$cnt = $this->fetch($sql);
     	$cnt = $cnt[0]['cnt'];
     	if($cnt >= 1)
     	{
     		$sql = " update `ems`.`inventorymanagement` "
     				    ."set `ctn` = `ctn` + $ctn,  "
     				    ."`pcs` = `pcs` + $pcs, "
     				    ."`totalPcs` = `totalPcs` + $totalPcs  "
     				    ." where `itemCode`= $itemCode   "
     			         ."and `warehouseID`=$godownNo and `batchNo`='$batchNo' ";
     		echo $sql;
     		$this->update($sql);
     	}
     	else 
     	{
     		$sql = "insert into `ems`.`inventorymanagement` "
						."(`warehouseID`,`itemCode`,`batchNo`,`packing`,`mfgDate`,`expDate`,`ctn`,`pcs`,`totalPcs`) "
						."values('$godownNo','$itemCode','$batchNo','$packing','$mfgDate','$expDate','$ctn','$pcs','$totalPcs') ";
     		echo $sql;
     		$this->update($sql);	
     	}
     }
     public function getWeight($itemCode)
     {
     	$sql = "select `grossWeight` from `ems`.`productmaster` where `itemCode` = '$itemCode' ";
     	$return  =  $this->fetch($sql);
     	return $return[0];
     }
     public function getLitres($itemCode)
     {
     	$sql = "select `litres` from `ems`.`productmaster` where `itemCode` = '$itemCode' ";
     	$return  =  $this->fetch($sql);
     	return $return[0];
     }
     public function updateSalesInvoiceAggregates($invoiceNo,$totalWeight,$totalLitres,$totalAmount,$totalTax,$totalSurcharge,$invoiceTotalAmountAfterTax)
     {
     	$updateData = array();
     	$updateData['totalWeight'] = $totalWeight;
     	$updateData['totalLitres'] = $totalLitres;
     	$updateData['totalAmount'] = $totalAmount;
     	$updateData['totalTax'] = $totalTax;
     	$updateData['totalSurcharge'] = $totalSurcharge;
     	$updateData['totalAmountAfterTax'] = $invoiceTotalAmountAfterTax; 
     	$this->pUpdate("`ems`.`salesinvoice`", $updateData," where `invoiceNo` = '$invoiceNo'");
     }
     public function updateStockTransferInvoiceAggregates($invoiceNo,$totalWeight,$totalLitres,$totalAmount)
     {
     	$updateData = array();
     	$updateData['totalWeight'] = $totalWeight;
     	$updateData['totalLitres'] = $totalLitres;
     	$updateData['totalAmount'] = $totalAmount;
     	$this->pUpdate("`ems`.`stocktransferinvoice`", $updateData," where `stockTransferInvoiceNo` = $invoiceNo");
     }
     public function updateStockPurchaseInvoiceAggregates($purchaseEntryNo,$totalWeight,$totalLitres,$totalAmount)
     {
     	$updateData = array();
     	$updateData['totalWeight'] = $totalWeight;
     	$updateData['totalLitres'] = $totalLitres;
     	$updateData['totalAmount'] = $totalAmount;
     	$this->pUpdate("`ems`.`stockpurchase`", $updateData," where `purchaseEntryNo` = '$purchaseEntryNo'");
     }
     public function getAllTaxCode()
     {
     	$return = $this->pSelect("`ems`.`taxstructure`"," ");
     	return $return;
     }
     public function getAllBranch()
     {
     	$return = $this->pSelect("`ems`.`branchmaster`"," ");
     	return $return;
     }
     public function getAllCF()
     {
     	$return = $this->pSelect("`ems`.`cfmaster`"," ");
     	return $return;
     }
     public function addAccessControl()
     {
     	$this->pInsert($_REQUEST, "`ems`.`auth`");
     }
     public function getAllCountry()
     {
     	$sql = "select * from `ems`.`location` where `location_type`=0";
     	$return = $this->pSelect($sql);
     	return $return;
     }
     public function getStateByCountry($country)
     {
     	$sql = "select * from `ems`.`location` where `location_type`=1 and `parent_id` = ("
     			    ."select distinct location_id from `ems`.`location` where name = '$country')";
     	echo $sql;
     	$return = $this->fetch($sql);
     	return $return;
     }
     public function getCityByState($state)
     {
     	$sql = "select * from `ems`.`location` where `location_type`=2 and `parent_id` = ("
     			     ."select distinct location_id from `ems`.`location` where name = '$state')";
     	$return = $this->fetch($sql);
     	return $return;
     }
     public function getTypeIDByType($type)
     {
     	if ($type == 'Branch')
     	{
     		$sql = "select * from `ems`.`branchmaster`";
     		$return = $this->fetch($sql);
     		return $return;
     	}
     	else if($type == 'CF')
     	{
     		$sql = "select * from `ems`.`cfmaster`";
     		$return = $this->fetch($sql);
     		return $return;
     	}
     }
     public function getBranchDetailByID($typeID)
     {
     	$sql = "select * from `ems`.`branchmaster` where `branchID` = $typeID";
     	$return = $this->fetch($sql);
     	return $return[0];
     }
     public function getCFDetailByID($typeID)
     {
     	$sql = "select * from `ems`.`cfmaster` where `cfID`= $typeID";
     	$return = $this->fetch($sql);
     	return $return[0];
     }
     public function getPartyDetails($type, $typeID)
     {
     	if($type == 'Branch')
     	{
     		$sql = "select * from `ems`.`branchmaster` where `branchID` = $typeID ";
     		$return = $this->fetch($sql);
     		return $return[0]['name'];
     	}
     	else if($type == 'CF')
     	{
     		$sql = "select * from `ems`.`cfmaster` where `cfID` = $typeID ";
     		$return = $this->fetch($sql);
     		return $return[0]['name'];
     	}
     	else if($type == 'HO')
     	{
     		return "Consumer Marketing (I) Pvt Ltd, Mumbai";
     	}
     }
     public function getAllCurrency()
     {
     	$sql = "select * from `ems`.`currencymaster`";
     	return $this->fetch($sql);
     }
     public function loadCurrencySign($currencyName)
     {
     	$sql = "select * from `ems`.`currencymaster` where `currencyName`='$currencyName' ";
     	$return = $this->fetch($sql);
     	return $return[0]['currencySign'];
     }
     public function getAllAllowedDist($type,$typeID)
     {
     	if($type == "HO")
     	{
     		$sql = "select * from `ems`.`distributormaster` where 
     				`typeOfDist`='Stockiest' or
     				(`typeOfDist`='Distributor' and `type`='HO') ";
     		return $this->fetch($sql);
     	}
     	else {
     		$sql = "select * from `ems`.`distributormaster` where `type`='$type' and `typeID`= '$typeID' ";
     		return $this->fetch($sql);
     	}
     }
     public function getStateOfDistributor($distID)
     {
     	$sql = "select * from `ems`.`distributormaster` where `distID` = $distID";
     	$return = $this->fetch($sql);
     	return $return[0]['state'];
     }
     public function getStateWiseTransporter($state)
     {
     	$sql = "select * from `ems`.`transportermaster` where `state` = '$state'";
     	$return = $this->fetch($sql);
     	return $return;
     }
     public function getStateWiseSalesman($state)
     {
     	$sql = "select * from `ems`.`employeemaster` where `state` ='$state'";
     	$return = $this->fetch($sql);
     	return $return;
     }
     public function getBasicPriceFromItemCode($itemCode,$state)
     {
     	$sql = "select * from `ems`.`basicpricemaster` where `wef` ="
     			."(select max(`wef`) from `ems`.`basicpricemaster` where `itemCode`='$itemCode')"
     			." and `itemCode`='$itemCode'  and `state` = '$state' ";
     	$return = $this->fetch($sql);
     	return $return;
     }
     public function getTaxForItem($state,$itemCode)
     {
     	$sql = "select `A`.* from `ems`.`taxstructure` `A`,`ems`.`productmaster` `B`,`ems`.`categorymaster` `C`\n"
    . " where `B`.`productCategory` = `C`.`category`"
    . " and `A`.`category` = `C`.`categoryID`"
    . " and `B`.`itemCode` = '$itemCode' "
    . " and `A`.`state` = '$state' "
    . " group by `A`.`category`,`A`.`state` having `A`.`wef` = max(`A`.`wef`)";
     	$return = $this->fetch($sql);
     	return $return[0];
     }
     public function getDistributorByID($id)
     {
     	$sql = "select `name` from `ems`.`distributormaster` where `distID`='$id' ";
     	$return = $this->fetch($sql);
     	return $return[0]['name'];
     }
     public function getSupplierDetailsByID($supplierID)
     {
     	$sql = "select * from `ems`.`dcmaster` `A`,`ems`.`currencymaster` `B` where `id`='$supplierID' and `A`.`currency` = `B`.`currencyName` ";
     	$return = $this->fetch($sql);
     	return $return[0];
     }
     public function getSubRetailerByType($type)
     {
     	$sql = "select * from`ems`. `subretailermaster` where `retailerType` = '$type'";
     	$return = $this->fetch($sql);
     	return $return;
     }
     public function getAllStates()
     {
     	$sql = "select * from `ems`.`location` where `location_type`=1 and `parent_id` = 100";
     	$indianStates = $this->fetch($sql);
     	return $indianStates;
     }
     public function getAllProducts()
     {
     	$sql = "select * from `ems`.`productmaster` ";
     	$allProducts = $this->fetch($sql);
     	return $allProducts;
     }
     public function getAllCategories()
     {
     	$sql = "select * from `ems`.`categorymaster` ";
     	$allProducts = $this->fetch($sql);
     	return $allProducts;
     }
     public function getAllBrands()
     {
     	$sql = "select * from `ems`.`brandmaster` ";
     	$allProducts = $this->fetch($sql);
     	return $allProducts;
     }
     public function getSalesPersonByState($state)
     {
     	$sql ="select * from `ems`.`employeemaster` where `state`='$state'";
     	$all = $this->fetch($sql);
     	return $all;
     }
     public function getDistributorByState($state)
     {
     	$sql ="select * from `ems`.`distributormaster` where `state`='$state'";
     	$all = $this->fetch($sql);
     	return $all;
     }
     public function getStateByBranchID($id)
     {
     	$sql = "select `state`  from `ems`.`branchmaster` where `branchID` = '$id' ";
     	$return = $this->fetch($sql);
     	return $return[0]['state'];
     }
     public function getStateByCFID($id)
     {
     	$sql = "select `state`  from `ems`.`cfmaster` where `cfID` = '$id' ";
     	$return = $this->fetch($sql);
     	return $return[0]['state'];
     }
     public function getCreditorNameByID($id)
     {
     	$sql = "SELECT `partyName` FROM `dcmaster` WHERE `dc`= 'c' and `id`='$id'";
     	$return = $this->fetch($sql);
     	return $return[0]['partyName'];
     }
     public function getEmployeeNameByID($id)
     {
     	$sql = "select `name` from `ems`.`employeemaster` where `empID` = '$id' ";
     	$return = $this->fetch($sql);
     	return $return[0]['name'];
     }
     public function getPartyNameByWarehouse($warehouseID)
     {
     	$sql = "select `type`, `partyName` from `ems`.`warehousemaster` where `warehouseID` =".$warehouseID;
     	$return = $this->fetch($sql);
     	$finalReturn = $this->getPartyDetails($return[0]['type'],$return[0]['partyName']);
     	return $finalReturn;
     }
     public function getTransporterNameByID($transporterID)
     {
     	$sql = "select `name` from `ems`.`transportermaster` where `transID`=".$transporterID;
     	$return =  $this->fetch($sql);
     	return $return[0]['name'];
     }
     public function getItemDetailsByCode()
     {
     	$sql = "select * from `ems`.`productmaster` where `itemCode`=".$_REQUEST['itemCode'];
     	$return =  $this->fetch($sql);
     	echo $return[0]['itemDesc'];
     }
     public function checkStockTransferAvailability($insertData)
     {
     	$ctn = $insertData['ctn'];
     	$pcs = $insertData['pcs'];
     	$totalPcs = $insertData['totalPcs'];
     	$itemCode = $insertData['itemCode'];
     	$godownNo = $insertData['godownNo'];
     	$fromWarehouse = $godownNo;
     	$batchNo = $insertData['batchNo'];
     	$mfgDate = $insertData['mfgDate'];
     	$expDate = $insertData['expDate'];
     	$sql = "select * from `ems`.`inventorymanagement` where `itemCode`= '$itemCode' "
     	."and `warehouseID`='$fromWarehouse' and `batchNo`='$batchNo'  ";
     	//echo $sql;
     	$return = $this->fetch($sql);
     	$avail = $return[0];
     	if($avail['totalPcs'] >=  $totalPcs)
     	{
     		return 0;
     	}
     	else {  return 1;  }
     }
     public function getPartyWiseInvoiceNo($warehouseString)
     {
     	$sql = "select * from `ems`.`stocktransferinvoice` where `from` in ($warehouseString) ";
     	//echo $sql;
     	$result = $this->fetch($sql);
     	return $result;
     }
     public function getAllStockPurchase()
     {
     	$sql = "select * from `ems`.`stockpurchase`";
     	$result = $this->fetch($sql);
     	return $result;
     }
}
?>