<?php
if(isset($_REQUEST['dao']))
{
	$a = $_REQUEST['dao'];
	$dao = new ReportEngine();
	$dao->$a();
}
class ReportEngine
{
    private $host;
    private $username;
    private $password;
    
    public function ReportEngine()
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
    	while($row = mysql_fetch_assoc($result,MYSQL_ASSOC))
    	{
    		$return[] = $row;
    	}
    	return $return;
    	 
    }
    public function getMonthlySalesReport()
    {
    	$sql = "SELECT month(`date`) as `month` ,sum(`totalAmount`) as `amount`  FROM `ems`.`salesinvoice`
                      group by month(`date`)";
    	$return = $this->fetch($sql);
    	$dt = '[ {"Month": "Amount(INR)"} ';
    	 foreach($return as $key => $data)
    	{
    		$dt .= ', { " '.$data["month"]. ' " '.':" '.$data["amount"].' "}';
    	} 
    	$dt .= "]";
    	echo  $dt;
    }
    
    
    public function getStatesSalesReport()
    {
    	$sql = "SELECT `state` as `state` ,sum(`totalAmount`) as `amount`  FROM `ems`.`salesinvoice`
                      group by `state`";
    	$return = $this->fetch($sql);
    	return $return;
    }
    public function getSalesReport()
    {
    	$sql = "SELECT *  FROM `ems`.`salesinvoice`";
    	$return = $this->fetch($sql);
    	return $return;
    }
    public function getMonthlySPSalesReportByDate($sd,$ed,$parameter)
    {
    	$sql = "SELECT month(`date`) as `month` ,sum(`totalAmount`) as `amount`  FROM `ems`.`salesinvoice`
    			       where month(`date`) >= '$sd' and month(`date`) <= '$ed' and `salesmanID`='$parameter'
                      group by month(`date`)";
    	$return = $this->fetch($sql);
    	return $return;
    }
    
    public function getSPSalesReport($sd,$ed,$parameter)
    {
    	$sql = "SELECT *  FROM `ems`.`salesinvoice` where `date` >= '$sd' and `date` <= '$ed' and `salesmanID`='$parameter' ";
    	$return = $this->fetch($sql);
    	return $return;
    }
    public function getBrandWiseSalesData($inputData)
    {
    	//echo "<pre>";
    	//print_r($inputData);
    	$state = $inputData['state'];
    	$brand = $inputData['brand'];
    	$category = $inputData['category'];
    	$fromDate = $inputData['fromDate'];
    	$toDate = $inputData['toDate'];
    	$preSql = "select `X`.`brand`, 
    			sum(`X`.`amount`) as `amount`,
    			 sum(`X`.`litres`) as `litre`
    			  from 
    			( select `A`.`itemCode`, `C`.`date`, `B`.`brand`, `B`.`productCategory`, 
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres` 
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on 
    			`A`.`invoiceNo`= `C`.`invoiceNo` 
    			 where 1=1";
    	if(strlen(trim($state)) > 1 )
    	{
    		$stateSQL = " and `C`.`state` = '$state' "; 
    	}
    	else 
    	{
    		$stateSQL = " ";
    	}
    	if(strlen(trim($brand)) > 1 )
    	{
    		$brandSQL = " and `B`.`brand` = '$brand' ";
    	}
    	else
    	{
    	    $brandSQL = " ";
    	}
    	if(strlen(trim($category)) > 1 )
    	{
    		$catSQL = " and `B`.`productCategory` = '$category' ";
    	}
    	else
    	{
    		$catSQL = " ";
    	}
    	if( strlen($fromDate) >= 8)
    	{
    		$fromSQL = " and `C`.`date` > '$fromDate' ";
    	}
    	else
    	{
    		$fromSQL = " ";
    	}
    	if(strlen($toDate) >= 8)
    	{
    		$toSQL = " and `C`.`date` <= '$toDate' ";
    	}
    	else
    	{
    		$toSQL = " ";
    	}
    	$postSql =	"group by `A`.`itemCode`,`C`.`date` )
    			 X group by `brand`";
    	$return = $this->fetch($preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    	//echo $preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql;
    	return $return;
    }
    public function getBrandWiseSalesDataDateWise($inputData)
    {
    	$state = $inputData['state'];
    	$brand = $inputData['brand'];
    	$category = $inputData['category'];
    	$fromDate = $inputData['fromDate'];
    	$toDate = $inputData['toDate'];
    	$preSql = "select `X`.`brand`,
    			sum(`X`.`amount`) as `amount`,
    			 sum(`X`.`litres`) as `litre`,
    			MONTH(`X`.`date` ) as `month` from
    			( select `A`.`itemCode`, `C`.`date`, `B`.`brand`, `B`.`productCategory`,
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres`
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on
    			`A`.`invoiceNo`= `C`.`invoiceNo`  where 1=1 ";
    	if(strlen(trim($state)) > 1 )
    	{
    		$stateSQL = " and `C`.`state` = '$state' ";
    	}
    	else
    	{
    	$stateSQL = " ";
    	}
    		if(strlen(trim($brand)) > 1 )
    		{
    		$brandSQL = " and `B`.`brand` = '$brand' ";
    		}
    		else
    		{
    		$brandSQL = " ";
    		}
    		if(strlen(trim($category)) > 1 )
    			{
    			$catSQL = " and `B`.`productCategory` = '$category' ";
    	}
    	else
    				{
    					$catSQL = " ";
    			}
    			if( strlen($fromDate) >= 8)
    					{
    					$fromSQL = " and `C`.`date` > '$fromDate' ";
    	}
    	else
    	{
    	$fromSQL = " ";
    	}
    	if(strlen($toDate) >= 8)
    		{
    		$toSQL = " and `C`.`date` <= '$toDate' ";
    	}
    	else
    	{
    		$toSQL = " ";
    	}	
    	$postSql =	"group by `A`.`itemCode`,`C`.`date` )
    			 X group by `brand`,MONTH(`date`)";
    	$return = $this->fetch($preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    	return $return;
    }
    public function getCityWiseSalesData($inputData)
    {
    	//echo "<pre>";
    	//print_r($inputData);
    	$state = $inputData['state'];
    	$city = $inputData['city'];
    	$brand = $inputData['brand'];
    	$category = $inputData['category'];
    	$fromDate = $inputData['fromDate'];
    	$toDate = $inputData['toDate'];
    	$preSql = "select `X`.`city`,
    			sum(`X`.`amount`) as `amount`,
    			 sum(`X`.`litres`) as `litre`
    			  from
    			( select `A`.`itemCode`, `C`.`date`, `B`.`brand`, `B`.`productCategory`,`D`.`city`,
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres`
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on
    			`A`.`invoiceNo`= `C`.`invoiceNo` join `ems`.`distributormaster` `D`
    			on `D`.`distID` = `C`.`partyName`
    			 where 1=1";
    	if(strlen(trim($state)) > 1 )
    	{
    		$stateSQL = " and `C`.`state` = '$state' ";
    	}
    	else
    	{
    		$stateSQL = " ";
    		}
    		if(strlen(trim($brand)) > 1 )
    		{
    		$brandSQL = " and `B`.`brand` = '$brand' ";
    		}
    		else
    		{
    		$brandSQL = " ";
    	}
    	if(strlen(trim($city)) > 1 )
    	{
    		$citySQL = " and `D`.`city` = '$city' ";
    	}
    	else
    	{
    		$citySQL = " ";
    	}
    	if(strlen(trim($category)) > 1 )
    	{
    	$catSQL = " and `B`.`productCategory` = '$category' ";
    	}
    		else
    			{
    			$catSQL = " ";
    	}
    			if( strlen($fromDate) >= 8)
    	{
    	$fromSQL = " and `C`.`date` > '$fromDate' ";
    	}
    	else
    	{
    	$fromSQL = " ";
    	}
    	if(strlen($toDate) >= 8)
    	{
    	$toSQL = " and `C`.`date` <= '$toDate' ";
    	}
    	else
    	{
    	$toSQL = " ";
    	}
    	$postSql =	"group by `A`.`itemCode`,`C`.`date` )
    	X group by `city`";
    	$return = $this->fetch($preSql.$stateSQL.$citySQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    	//echo $preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql;
        	return $return;
    	}
    	public function getCityWiseSalesDataDateWise($inputData)
    	{
    	$state = $inputData['state'];
    	$city = $inputData['city'];
    	$brand = $inputData['brand'];
    	$category = $inputData['category'];
    	$fromDate = $inputData['fromDate'];
    	$toDate = $inputData['toDate'];
    	$preSql = "select `X`.`city`,
    	sum(`X`.`amount`) as `amount`,
    	sum(`X`.`litres`) as `litre`,
    	MONTH(`X`.`date` ) as `month` from
    	( select `A`.`itemCode`, `C`.`date`, `B`.`brand`, `B`.`productCategory`,`D`.`city`,
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres`
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on
    			`A`.`invoiceNo`= `C`.`invoiceNo` join `ems`.`distributormaster` `D`
    			on `D`.`distID` = `C`.`partyName`  where 1=1 ";
    	if(strlen(trim($state)) > 1 )
    	{
    		$stateSQL = " and `C`.`state` = '$state' ";
    	}
    	else
    	{
    	$stateSQL = " ";
    	}
    		if(strlen(trim($brand)) > 1 )
    		{
    	$brandSQL = " and `B`.`brand` = '$brand' ";
    	}
    		else
    			{
    			$brandSQL = " ";
    	}
    	if(strlen(trim($city)) > 1 )
    	{
    		$citySQL = " and `D`.`city` = '$city' ";
    	}
    	else
    	{
    		$citySQL = " ";
    	}
    	if(strlen(trim($category)) > 1 )
    	{
    		$catSQL = " and `B`.`productCategory` = '$category' ";
    	}
    		else
    		{
    			$catSQL = " ";
    		}
    		if( strlen($fromDate) >= 8)
    	{
    	$fromSQL = " and `C`.`date` > '$fromDate' ";
    	}
    	else
    	{
    	$fromSQL = " ";
    	}
    	if(strlen($toDate) >= 8)
    		{
    		$toSQL = " and `C`.`date` <= '$toDate' ";
    	}
    	else
    	{
    	$toSQL = " ";
    	}
    		$postSql =	"group by `A`.`itemCode`,`C`.`date` )
    		X group by `city`,MONTH(`date`)";
    		$return = $this->fetch($preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    		return $return;
    	}
    public function getProductWiseSalesData($inputData)
    {
    	//echo "<pre>";
    	//print_r($inputData);
    	$state = $inputData['state'];
    	$brand = $inputData['brand'];
    	$category = $inputData['category'];
    	$fromDate = $inputData['fromDate'];
    	$toDate = $inputData['toDate'];
    	$preSql = "select `X`.`itemDesc`,
    			sum(`X`.`ctn`) as `ctn`,
    			sum(`X`.`amount`) as `amount`,
    			 sum(`X`.`litres`) as `litre`,
    			`X`.`packing`
    			  from
    			( select `A`.`itemCode`, `C`.`date`, `B`.`brand`, `B`.`productCategory`,`B`.`packing`,`B`.`itemDesc`,`A`.`ctn`,
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres`
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on
    			`A`.`invoiceNo`= `C`.`invoiceNo`
    			 where 1=1";
    	if(strlen(trim($state)) > 1 )
    	{
    		$stateSQL = " and `C`.`state` = '$state' ";
    	}
    	else
    	{
    		$stateSQL = " ";
    		}
    		if(strlen(trim($brand)) > 1 )
    		{
    		$brandSQL = " and `B`.`brand` = '$brand' ";
    		}
    		else
    		{
    		$brandSQL = " ";
    	}
    	if(strlen(trim($category)) > 1 )
    	{
    	$catSQL = " and `B`.`productCategory` = '$category' ";
    	}
    		else
    			{
    			$catSQL = " ";
    	}
    			if( strlen($fromDate) >= 8)
    	{
    	$fromSQL = " and `C`.`date` > '$fromDate' ";
    	}
    	else
    	{
    	$fromSQL = " ";
    	}
    	if(strlen($toDate) >= 8)
    	{
    	$toSQL = " and `C`.`date` <= '$toDate' ";
    	}
    	else
    	{
    	$toSQL = " ";
    	}
    	$postSql =	"group by `A`.`itemCode`,`C`.`date` )
    	X group by `itemDesc`";
    	$return = $this->fetch($preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    	//echo $preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql;
        return $return;
    	}
    	public function getProductWiseSalesDataDateWise($inputData)
    	{
    		$state = $inputData['state'];
    		$brand = $inputData['brand'];
    		$category = $inputData['category'];
    		$fromDate = $inputData['fromDate'];
    		$toDate = $inputData['toDate'];
    		$preSql = "select `X`.`itemDesc`,
    			sum(`X`.`amount`) as `amount`,
    			 sum(`X`.`litres`) as `litre`,
    			MONTH(`X`.`date` ) as `month` from
    			( select `A`.`itemCode`, `C`.`date`, `B`.`brand`, `B`.`productCategory`,`B`.`itemDesc`,
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres`
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on
    			`A`.`invoiceNo`= `C`.`invoiceNo`  where 1=1 ";
    		if(strlen(trim($state)) > 1 )
    		{
    			$stateSQL = " and `C`.`state` = '$state' ";
    		}
    		else
    		{
    			$stateSQL = " ";
    		}
    		if(strlen(trim($brand)) > 1 )
    		{
    			$brandSQL = " and `B`.`brand` = '$brand' ";
    		}
    		else
    		{
    			$brandSQL = " ";
    		}
    		if(strlen(trim($category)) > 1 )
    		{
    			$catSQL = " and `B`.`productCategory` = '$category' ";
    		}
    		else
    		{
    			$catSQL = " ";
    		}
    		if( strlen($fromDate) >= 8)
    		{
    			$fromSQL = " and `C`.`date` > '$fromDate' ";
    		}
    		else
    		{
    			$fromSQL = " ";
    		}
    		if(strlen($toDate) >= 8)
    		{
    			$toSQL = " and `C`.`date` <= '$toDate' ";
    		}
    		else
    		{
    			$toSQL = " ";
    		}
    		$postSql =	"group by `A`.`itemCode`,`C`.`date` )
    			 X group by `itemDesc`,MONTH(`date`)";
    		$return = $this->fetch($preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    		//echo $preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql;
    		return $return;
    	}
    	public function getStateWiseSalesData($inputData)
    	{
    		//echo "<pre>";
    		//print_r($inputData);
    		$state = $inputData['state'];
    		$brand = $inputData['brand'];
    		$category = $inputData['category'];
    		$fromDate = $inputData['fromDate'];
    		$toDate = $inputData['toDate'];
    		$preSql = "select `X`.`state`,
    			sum(`X`.`amount`) as `amount`,
    			 sum(`X`.`litres`) as `litre`,
    			sum(`X`.`ctn`) as `ctn`	
    			  from
    			( select `C`.`state`,
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres`,sum(`A`.`ctn`) as `ctn`
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on
    			`A`.`invoiceNo`= `C`.`invoiceNo`
    			 where 1=1";
    		if(strlen(trim($state)) > 1 )
    		{
    			$stateSQL = " and `C`.`state` = '$state' ";
    		}
    		else
    		{
    			$stateSQL = " ";
    		}
    		if(strlen(trim($brand)) > 1 )
    		{
    			$brandSQL = " and `B`.`brand` = '$brand' ";
    		}
    		else
    		{
    			$brandSQL = " ";
    		}
    		if(strlen(trim($category)) > 1 )
    		{
    			$catSQL = " and `B`.`productCategory` = '$category' ";
    		}
    		else
    		{
    			$catSQL = " ";
    		}
    		if( strlen($fromDate) >= 8)
    		{
    			$fromSQL = " and `C`.`date` > '$fromDate' ";
    		}
    		else
    		{
    			$fromSQL = " ";
    		}
    		if(strlen($toDate) >= 8)
    		{
    			$toSQL = " and `C`.`date` <= '$toDate' ";
    		}
    		else
    		{
    			$toSQL = " ";
    		}
    		$postSql =	"group by `C`.`state` )
    	X  group by `state`";
    		$return = $this->fetch($preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    		//echo $preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql;
    		return $return;
    	}
    	public function getStateWiseSalesDataDateWise($inputData)
    	{
    		$state = $inputData['state'];
    		$brand = $inputData['brand'];
    		$category = $inputData['category'];
    		$fromDate = $inputData['fromDate'];
    		$toDate = $inputData['toDate'];
    		$preSql = "select `X`.`state`,
    			sum(`X`.`amount`) as `amount`,
    			 sum(`X`.`litres`) as `litre`,
    			MONTH(`X`.`date` ) as `month` from
    			( select `C`.`state`, `C`.`date`,
    			sum(`A`.`amountAfterTax`) as `amount`, sum(`A`.`totalLitres`) as `litres`
    			from `ems`.`salesentry` `A` join `ems`.`productmaster` `B` on
    			 `A`.`itemCode` = `B`.`itemCode` join `ems`.`salesinvoice` `C` on
    			`A`.`invoiceNo`= `C`.`invoiceNo`  where 1=1 ";
    		if(strlen(trim($state)) > 1 )
    		{
    			$stateSQL = " and `C`.`state` = '$state' ";
    		}
    		else
    		{
    			$stateSQL = " ";
    		}
    		if(strlen(trim($brand)) > 1 )
    		{
    			$brandSQL = " and `B`.`brand` = '$brand' ";
    		}
    		else
    		{
    			$brandSQL = " ";
    		}
    		if(strlen(trim($category)) > 1 )
    		{
    			$catSQL = " and `B`.`productCategory` = '$category' ";
    		}
    		else
    		{
    			$catSQL = " ";
    		}
    		if( strlen($fromDate) >= 8)
    		{
    			$fromSQL = " and `C`.`date` > '$fromDate' ";
    		}
    		else
    		{
    			$fromSQL = " ";
    		}
    		if(strlen($toDate) >= 8)
    		{
    			$toSQL = " and `C`.`date` <= '$toDate' ";
    		}
    		else
    		{
    			$toSQL = " ";
    		}
    		$postSql =	"group by `C`.`state`,`C`.`date` )
    			 X group by `state`,MONTH(`date`)";
    		$return = $this->fetch($preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql);
    		//echo $preSql.$stateSQL.$brandSQL.$catSQL.$fromSQL.$toSQL.$postSql;
    		return $return;
    	}
}
?>