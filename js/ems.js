function showLoginSection()
{
	var winWidth = $(window).width();
	var winHeight = $(window).height();
	var firstWidth = (0.7)*winWidth;
	var secondWidth = (0.3)*winWidth;
	var logoHeight = (0.25)*winHeight;
	var logoTopMargin = (0.2)*winHeight;
	$('#firstBar').css('width',firstWidth);
	$('#secondBar').css('width',secondWidth);
	$('#mainLogo').css('height',logoHeight);
	$('#mainLogo').css('width',logoHeight);
	$('#mainLogo').css('margin-top',logoTopMargin);
	$('#startButton').hide();
	$('#loginForm').show();
}
function showMenuBar()
{
$('#menuBar').animate({
		   height: '120px'
	},300);	
$('#showMenuBubble').hide();
$('#hideMenuBubble').show();
}
function hideMenuBar()
{
$('#menuBar').animate({
		   height: '0px',
	},300);	
	$('#showMenuBubble').show();
	$('#hideMenuBubble').hide();
}
function signIn()
{
	var postData = $('#loginFormX').serialize();
	//alert(postData);
	$.post('./application/controller/control.php',
			'a=signIn&'+postData,
			function(responseText)
			{
		      
		    	 // openLoading();
		    	  $('#loading').dialog({
		   	       autoOpen:false,
		   	       width:150,
		   	       height:120,
		   	       title:'Loading',
		   	       modal:true
		   	    });
		   	$('.ui-dialog-titlebar').hide();
		   	$('#loading').dialog('open');
		   	//$('body').html(responseText);
		   	//$('#loading').dialog('close');
		    	  setTimeout(function(){ window.location.assign("home.php"); }, 200);
		    	 // window.location.assign("home.php");
			}
			);
}
function logout()
{
	$.post('./application/controller/control.php',
			'a=logout');
	window.location.assign("index.php");
}
function getWelcome()
{
	var postData = 'a=welcome';
	action(postData,'main');
	loadMenu('mainMenu');
}
function getGeneralLedger()
{
	/*var postData = 'a=generalLedger';
	action(postData,'main');*/
	//loadMenu('generalLedgerMenu');
	$.post('./application/controller/accountMaster.php','',function(data){
		$('#main').html(data);
		$('.ui-jqgrid-htable').css("font-size","11px");
		$('.ui-jqgrid-btable').css("font-size","11px");
		});
}
function updateAccountType(id)
{
	$('.span'+id).hide();
	$('.input'+id).show();
	$('.edit'+id).hide();
	$('.save'+id).show();
}
function saveAccountType(id)
{
	var postData = 'dao=saveAccountType&accountID='+id+'&'+$('#accountForm').serialize();
	dbAction(postData,"Success","Data updated successfully !!!");
	getGeneralLedger();
	$('.span'+id).show();
	$('.input'+id).hide();
	$('.edit'+id).show();
	$('.save'+id).hide();
}
function deleteCurrentAccountDialog(id)
{
	$('#currentAccountIDToDelete').val(id);
	$('#accountTypeDeleteConfirmDialog').dialog({
		   autoOpen:false,
	       width:500,
	       height:220,
	       title:'Confirmation',
	       modal:true,
	       buttons: [
	                 {
	                   text: "Yes",
	                   click: function() {
	                	   $('#accountTypeDeleteConfirmDialog').dialog('close');
	                     deleteCurrrentAccount();
	                   }
	                 },
	                 {
		                   text: "No",
		                   click: function() {
		                	   $('#accountTypeDeleteConfirmDialog').dialog('close');
		                   }
		                 }
	               ]
	});
	$('#accountTypeDeleteConfirmDialog').dialog('open');
	
}
function deleteCurrrentAccount()
{
	var id=$('#currentAccountIDToDelete').val();
	var postData = 'dao=deleteAccount&accountID='+id;
	dbAction(postData,"Success","Account deleted successfully !!!");
	getGeneralLedger();
}
function addAccountTypeDialog()
{
	$('#addNewAccountDialog').slideDown('slow');

}
function addCurrrentAccount()
{
	var postData = 'dao=addNewAccount&'+$('#newAccountForm').serialize();
	dbAction(postData,"Success","Account added successfully!!!");
	getGeneralLedger();
}
function getDcMaster()
{
	//var postData = 'a=dcMaster';
	//action(postData,'main');
	getDCMasterAwesome();
	loadMenu('dcMenu');
}
function createDc()
{
	var postData = 'dao=addNewDc&'+$('#dcForm').serialize();
	dbAction(postData,"Success","Data updated successfully !!!");
	getDcMaster();
}
function getDcMasterView()
{
	var postData = 'a=dcMasterView';
	action(postData,'main');
}
function viewDcAdditionalDetails(id)
{
	var postData = 'a=dcAdditionalDetails&id='+id;
	action(postData,'dcAdditionalDetailDiv');
}
function getDcMasterUpdate()
{
	var postData = 'a=dcMasterUpdate'; 
	action(postData,'main');
}
function updateDcAdditionalDetails(id)
{
	var postData = 'a=updateDcAdditionalDetails&id='+id;
	action(postData,'dcAdditionalDetailDiv');
}
function submitupdateDcAdditionalDetailsForm(id)
{
	var postData = 'dao=updateDC&id='+id+"&"+$('#updateDcAdditionalDetailsForm').serialize();
	dbAction(postData,"Success","Data updated successfully !!!" );
	getDcMasterUpdate();
}
function deleteDc(id)
{
	$('#deleteDcID').val(id);
	$('#deleteConfirmtionDialog').dialog({
		   autoOpen:false,
	       width:500,
	       height:220,
	       title:'Confirmation',
	       modal:true,
	       buttons: [
	                 {
	                   text: "Yes",
	                   click: function() {
	                	   $('#deleteConfirmtionDialog').dialog('close');
	                     deleteCurrentDc();
	                   }
	                 },
	                 {
		                   text: "No",
		                   click: function() {
		                	   $('#deleteConfirmtionDialog').dialog('close');
		                   }
		                 }
	               ]
	});
	$('#deleteConfirmtionDialog').dialog('open');
	
}
function deleteCurrentDc()
{
	var id = $('#deleteDcID').val();
	var postData = 'dao=deleteDc&id='+id;
	dbAction(postData,'Success','Deleted successfully !!!');
	getDcMasterUpdate();
}
function getSO()
{
	/*var postData = 'a=soInput';
	action(postData, 'main');*/
	$.post('./application/controller/employeeMaster.php','',
				function(data)
				{
					$('#main').html(data);
					$('.ui-jqgrid-htable').css("font-size","11px");
 					$('.ui-jqgrid-btable').css("font-size","11px");
				}
				);
	
	loadMenu('employee');
}
function addEmployee()
{
	var postData = "dao=addNewSo&"+$('#soForm').serialize();
	dbAction(postData,'Success','Data updated successfully !!!');
	getSO();
}
function getSoUpdate()
{
   var postData = 'a=soUpdate';
   action(postData,'main');
}
function showUpdateSo(id)
{
	var postData = 'a=showUpdateSo&id='+id;
	action(postData,'soUpdateTable');
}
function updateSalesOfficer(id)
{
	var postData = "dao=updateSalesOfficer&whereCondition="+id+"&"+$('#soUpdateForm').serialize();
	dbAction(postData,'Success','Data updated successfully !!!');
	getSoUpdate();
}
function getSalesEntry()
{
	var postData = 'a=salesEntry';
	action(postData,'main');
	$('#salesOrderEntryForm').hide();
	$('#submitInvoice').hide();
}
function proceedToSalesEntry()
{
	$('#salesOrderEntryForm').hide();
	$('#salesEntryForm').show();
	$('#submitInvoice').hide();
	$('#proceedToSalesEntryButton').hide();
	$('#addNextEntryButton').show();
	$('#finishSalesEntry').show();
}
function getEmployee()
{
	var postData='a=getEmployee';
	action(postData,'main');
	loadMenu('employee');
	getSO();
}
function getSales()
{
	var postData = 'a=salesEntry';
	action(postData, 'main');
	$('#salesOrderEntryForm').hide();
	$('#submitInvoice').hide();
	loadMenu('salesMenu');
}
function selectSalesTypeAndNext()
{
	$('#salesOrderEntryForm').show();
	$('#submitInvoice').show();
	$('#salesTypeDiv').hide();
}
function createInvoice()
{
	var type = $('#salesTypeSelect').val();
	var loc = $('#salesLocSelect').val();
    var postData = 'a=createInvoice&type='+type+'&loc='+loc+'&'+$('#salesOrderEntryForm').serialize();	
    openLoading();
	$.post('./application/controller/control.php',
			postData,
			function(responseText)
				{
					$('#salesInvoiceName').html(responseText);
					$('#salesInvoiceInput').val(responseText);
					closeLoading();
					nu();		
				},
			'html'
			);
  /* $('#salesOrderEntryForm').hide();
   $('#salesEntryForm').show();
   $('#submitInvoice').hide();
   $('#addNextEntryButton').show();
   $('#finishSalesEntry').show();*/
}
function addSalesEntryAndNext()
{
	var postData = 'a=addSalesEntry&'+$('#salesEntryForm').serialize();
	action(postData,'testCode');
}
function getEmployeeDetail()
{
	var empID = $('#empID').val();
	var postData = 'a=getEmployeeDetail&empID='+empID;
	action(postData,'employeeDetail');
}
function updateEmployeeDetail()
{
	var postData = 'dao=updateEmployeeDetail&whereCondition='+$('#empID').val()+'&'+$('#soForm').serialize();
	dbAction(postData,"Success","Data updated successfully !!!");
	getSoUpdate();
}
function getInventory()
{
	var postData = "a=getInventory";
	action(postData,'main');
	loadMenu('inventoryMenu');
}
function createStockTransferInvoice()
{
	var transferSlipNo = $('#transferSlipNo').val();
	var postData = 'a=createStockTransferInvoice&'+$('#stockTransferInvoiceForm').serialize();
	$.post('./application/controller/control.php',
			postData,
			function(responseText)
				{
					$('#invoiceName').html(transferSlipNo);
					$('#invoiceInput').val(transferSlipNo);
					closeLoading();
					nu();		
				},
			'html'
			);
   $('#stockTransferInvoiceForm').hide();
   $('#stockTransferEntryForm').show();
   $('#submitInvoice').hide();
   $('#addNextEntryButton').show();
   $('#finishStockEntry').show();
}
function addStockTransferEntryAndNext()
{
	var postData = 'a=addStockTransferEntry&'+$('#stockTransferEntryForm').serialize();
	action(postData,'testCode');
}
function getProductMaster()
{
	/*var postData = 'a=getProductMaster';
	action(postData,'main'); */
	$.post('./application/controller/productmaster.php','',
			function(data)
			{
				$('#main').html(data);
				$('.ui-jqgrid-htable').css("font-size","11px");
					$('.ui-jqgrid-btable').css("font-size","11px");
			});
	loadMenu('productMenu');
}
function getProductCategory()
{
	var postData = 'a=getProductCategory';
	action(postData,'main');
}
function getTransportMaster()
{
	$.post(
			'./application/controller/transportMaster.php','',
			function(data)
			{
				$('#main').html(data);
				$('.ui-jqgrid-htable').css("font-size","11px");
					$('.ui-jqgrid-btable').css("font-size","11px");
			}
			);
	loadMenu('transportMenu');
}
function getTransportMaster()
{
	$.post(
			'./application/controller/transportMaster.php','',
			function(data)
			{
				$('#main').html(data);
				$('.ui-jqgrid-htable').css("font-size","11px");
					$('.ui-jqgrid-btable').css("font-size","11px");
			}
			);
	loadMenu('transportMenu');
}
function getUpdateSalesEntry()
{
	var postData = 'a=getUpdateSalesEntry';
	action(postData,'main');
}
function updateCurrentSalesInvoice(index, invoiceNo)
{
	var postData = 'a=updateCurrentSalesInvoice&index='+index+'&invoiceNo='+invoiceNo+'&'+$('#updateSalesEntryForm').serialize();
	emptyAction(postData,'Success','Data updated successfully');
	getUpdateSalesEntry();
}
function getSalesReport()
{
	var postData = 'a=getSalesReport';
	action(postData,'main');	
}
function getStockTransferReport()
{
	var postData = 'a=getStockTransferReport';
	action(postData,'main');	
}
function getStockPurchaseReport()
{
	var postData = 'a=getStockPurchaseReport';
	action(postData,'main');	
}
function generateSalesReport()
{
	var postData = 'a=generateSalesReport&invoiceNo='+$('#invoiceNo').val();
	action(postData,'main');
}
function generateStockTransferReport()
{
	var postData = 'a=generateStockTransferReport&invoiceNo='+$('#invoiceNo').val();
	action(postData,'main');
}
function generateStockPurchaseReport()
{
	var postData = 'a=generateStockPurchaseReport&purchaseEntryNo='+$('#purchaseEntryNo').val();
	action(postData,'main');
}
function getAreaMaster()
{
	$.post('./application/controller/areaMaster.php','',function(data)
			{$('#main').html(data);
			$('.ui-jqgrid-htable').css("font-size","11px");
				$('.ui-jqgrid-btable').css("font-size","11px");
			});
}
function getWarehouseMaster()
{
	$.post('./application/controller/warehouseMaster.php','',function(data)
			{$('#main').html(data);
			$('.ui-jqgrid-htable').css("font-size","11px");
				$('.ui-jqgrid-btable').css("font-size","11px");
			});
}
function getInventoryManagement()
{
	$.post(
			'./application/controller/inventoryMaster.php'
			,'',
			function(data)
			{
				$('#main').html(data);
				$('.ui-jqgrid-htable').css("font-size","11px");
					$('.ui-jqgrid-btable').css("font-size","11px");
			}
			);
}
function displayAvailabilityDetail(rowID)
{
	var itemCode = $('#itemCode_'+rowID).val();
	var state = $('#state').val();
	//alert(itemCode);
	$.post('./application/controller/control.php','a=getItemDetailsForSale&itemCode='+itemCode, 
			      function(data){
							var obj =  jQuery.parseJSON(data);
							$('#itemDesc_'+rowID).val(obj.itemDesc);
							$('#packing_'+rowID).val(obj.packing);
							//$('#rate_'+rowID).val(obj.salesRate);
	});
	$.post('./application/controller/control.php','a=getBasicPriceFromItemCode&itemCode='+itemCode+'&state='+state,
		      function(data){
		                data = data.trim();
		                if(!isNaN(data))
		                {$('#rate_'+rowID).val(data);}
		                else 
		                {$('#rate_'+rowID).val('');}
});
	var postData = 'a=displayAvailability&itemCode='+itemCode;
	$.post('./application/controller/control.php',postData,
			function(data)
			{
		        $('#availabilityDetail').html('');
				$('#availabilityDetail').html(data);
				$('#availabilityRowID').val(rowID);
				$('#availabilityDetail').dialog({
				       autoOpen:false,
				       width:1000,
				       height:600,
				       title:'Availability',
				       modal:true
				    });
				$('#availabilityDetail').dialog('open');
			});
}
function displayAvailabilityDetailSP(rowID)
{
	var itemCode = $('#itemCode_'+rowID).val();
	//alert(itemCode);
	$.post('./application/controller/control.php','a=getItemDetailsForSale&itemCode='+itemCode,
			      function(data){
							var obj =  jQuery.parseJSON(data);
							$('#itemDesc_'+rowID).val(obj.itemDesc);
							$('#packing_'+rowID).val(obj.packing);
							$('#rate_'+rowID).val(obj.salesRate);
	});
}
function submitSelectQuantity()
{
	var rowID = $('#availabilityRowID').val();
	var postData = 'a=submitSelectQuantity&'+$('#selectGodownForm').serialize();
	/*$.post('./application/controller/control.php',
			postData,
			function(data)
			{
				var obj =  jQuery.parseJSON(data);
				$('#godownNo_'+rowID).val(obj.warehouseID);
				$('#batchNo_'+rowID).val(obj.batchNo);
				$('#mfgDate_'+rowID).val(obj.mfgDate);
				$('#expDate_'+rowID).val(obj.expDate);
				$('#ctn_'+rowID).val(obj.totalCtn);
				$('#availabilityDetail').html('');
				$('#availabilityDetail').dialog('close');
			}
	       );*/
	var serialID = $('#activeAvailabilityWarehouseID').val();
	serialID = serialID.trim();
	var packing = parseFloat($('#packing_'+rowID).val());
	var selectedCartons = parseFloat($('#selectCtn_'+serialID).val());
	var selectedPieces = parseFloat($('#selectPcs_'+serialID).val());
	var totalWarehousePieces = parseFloat($('#totalPcs_'+serialID).val());
	alert((packing*selectedCartons)+selectedPieces);
	alert(totalWarehousePieces);
	if( (packing*selectedCartons)+selectedPieces <=   totalWarehousePieces)
	{
	$('#godownNo_'+rowID).val($('#warehouseID_'+serialID).val());
	$('#batchNo_'+rowID).val($('#batchANo_'+serialID).val());
	$('#mfgDate_'+rowID).val($('#mfgADate_'+serialID).val());
	$('#expDate_'+rowID).val($('#expADate_'+serialID).val());
	$('#ctn_'+rowID).val($('#selectCtn_'+serialID).val());
	$('#pcs_'+rowID).val($('#selectPcs_'+serialID).val());
	calculateTotalPcs(rowID);
	calculateAmount(rowID);
	$('#availabilityDetail').dialog('close');
	}
	else {   alert("Insufficient quantity in warehouse. Please correct !!!"); }
	
	//alert($('#batchNo_'+serialID).val());
}
function calculateTotalPcs(rowID)
{
	var packing = $('#packing_'+rowID).val();
	var ctn = $('#ctn_'+rowID).val();
	var pcs = $('#pcs_'+rowID).val();
	var totalPcs = parseFloat((ctn * packing)) + parseFloat(pcs);
	$('#totalPcs_'+rowID).val(totalPcs);
}
function calculateAmount(rowID)
{
var rate = $('#rate_'+rowID).val();
var totalPcs = $('#totalPcs_'+rowID).val();
var amount = parseFloat(rate)*parseFloat(totalPcs);
amount = amount.toFixed(2);
$('#amount_'+rowID).val(amount);
}
function calculateAmountCurr(rowID)
{
var rate = $('#rate_'+rowID).val();
var totalPcs = $('#totalPcs_'+rowID).val();
var amount = parseFloat(rate)*parseFloat(totalPcs);
amount = amount.toFixed(2);
$('#amountCurr_'+rowID).val(amount);
}
function calculateAmountInr(rowID)
{
var amountCurr = $('#amountCurr_'+rowID).val();
var currencyRate = $('#currencyRate').val();
var amountInr = amountCurr * currencyRate;
amountInr = amountInr.toFixed(2);
$('#amount_'+rowID).val(amountInr);
}

function getSalesReportCurrent()
{
	 var currentInvoiceNo = $('#invoiceNo').val();
	$.post(
			       './application/controller/control.php','a=getSalesReport',
			       function(data)
			       {
			    	   $('#main').html(data);
			    	   $('#invoiceNo').val(currentInvoiceNo);
			    	   generateSalesReport();
			       }
			       
			      );
}
function getStockTransferReportCurrent()
{
	 var currentInvoiceNo = $('#invoiceNo').val();
	$.post(
			       './application/controller/control.php','a=getStockTransferReport',
			       function(data)
			       {
			    	   $('#main').html(data);
			    	   $('#invoiceNo').val(currentInvoiceNo);
			    	   generateStockTransferReport();
			       }
			       
			      );
}
function getStockPurchaseReportCurrent()
{
	 var currentInvoiceNo = $('#purchaseEntryNo').val();
	$.post(
			       './application/controller/control.php','a=getStockPurchaseReport',
			       function(data)
			       {
			    	   $('#main').html(data);
			    	   $('#purchaseEntryNo').val(currentInvoiceNo);
			    	   generateStockPurchaseReport();
			       }
			       
			      );
}
function getStockPurchase()
{
	var postData = 'a=stockPurchase';
	action(postData,'main');
	loadMenu('stockPurchaseMenu');
	$('#salesOrderEntryForm').hide();
	$('#submitInvoice').hide();
}
function createInvoiceStockPurchase()
{
	var purchaseEntryNo = $('#purchaseEntryNo').val();
    var postData = 'a=createStockPurchase&'+$('#salesOrderEntryForm').serialize();	
    openLoading();
	$.post('./application/controller/control.php',
			postData,
			function(responseText)
				{
					alert(responseText);
					$('#purchaseEntryNoItem').val(purchaseEntryNo);
					$('#purchaseEntryNoSpan').html(purchaseEntryNo);
					closeLoading();
					nu();		
				},
			'html'
			);
   $('#salesOrderEntryForm').hide();
   $('#salesEntryForm').show();
   $('#submitInvoice').hide();
   $('#addNextEntryButton').show();
   $('#finishSalesEntry').show();
}
function addStockPurchaseEntryAndNext()
{
	var postData = 'a=addSPEntry&'+$('#salesEntryForm').serialize();
	action(postData,'testCode');
}

function loadOfc()
{
	$('#salesOfcSelect').show();
}
function loadLoc()
{
	$('#salesLocSelect').show();
}
function generateSalesInvoiceNo()
{
	var typ 	=	 	$('#salesTypeSelect').val();
	if($('#mhMu').val() == "MH" ||$('#mhMu').val() == "MU" )
		{
		    typ = typ + $('#mhMu').val();
		}
	//alert(typ);
	var postData = 'a=generateSalesInvoiceNo&type='+typ;
	$.post(
					'./application/controller/control.php',
					postData,
					function(data)
					{
						data = data.trim();
					    $('#invoiceNoSpan').html(data);
					    $('#invoiceNo').val(data);
					});
}
function generateStockTransferInvoiceNo()
{
	var from = $('#fromWareHouse').val();
	var to = $('#to').val();
	//alert(typ);
	var postData = 'a=generateStockTransferInvoiceNo&from='+from+'&to='+to;
	$.post(
					'./application/controller/control.php',
					postData,
					function(data)
					{
					    $('#invoiceNoSpan').html(data);
					    $('#invoiceNo').val(data);
					});
}
function submitSalesInvoice()
{
	var availData = 'a=checkSalesAvailability&'+$('#salesEntryForm').serialize();
	$.post('./application/controller/control.php', availData,
			function(flag)
			{
		        flag = parseInt(flag);
		        if(flag > 0)
		        	{
		        	    alert('You have entered totalPcs that exceeds availability in warehouse');
		        	}
		        else{
	var invoiceNo = $('#invoiceNo').val();
	var salesType = $('#salesTypeSelect').val();
	var state = $('#state').val();
	var postData = 'a=createNewSalesInvoice&invoiceNo='+invoiceNo+'&'+ $('#salesOrderEntryForm').serialize();
	$.post(
			       './application/controller/control.php', postData,
			       function(data)
			       {
			    	   var postData2 = 'a=createSalesEntry&invoiceNo='+invoiceNo+'&'+ $('#salesEntryForm').serialize()+'&salesType='+salesType+'&state='+state;
			    		$.post(
			    						'./application/controller/control.php', postData2,
			    						function(data2)
			    						{
			    							getSalesReportCurrent();
			    							//$('#testCode').html(data);
			    						});
			       });
		        }
		        });
	
}
function submitEditSalesInvoice()
{
	var invoiceNo = $('#invoiceNo').val();
	var salesType = $('#salesTypeSelect').val();
	var state = $('#state').val();
	var postData = 'a=createEditNewSalesInvoice&invoiceNo='+invoiceNo+'&'+ $('#salesOrderEntryForm').serialize();
	$.post(
			       './application/controller/control.php', postData,
			       function(data)
			       {
			    	   var postData2 = 'a=createEditSalesEntry&invoiceNo='+invoiceNo+'&'+ $('#salesEntryForm').serialize()+'&salesType='+salesType+'&state='+state;
			    		$.post(
			    						'./application/controller/control.php', postData2,
			    						function(data2)
			    						{
			    							getSalesReportCurrent();
			    							//$('#testCode').html(data);
			    						});
			       });
	
}
function submitStockTransferInvoice()
{
	var availData = 'a=checkStockTransferAvailability&'+$('#stockTransferEntryForm').serialize();
	$.post('./application/controller/control.php', availData,
			function(flag)
			{
		        flag = parseInt(flag);
		        if(flag > 0)
		        	{
		        	    alert('You have entered totalPcs that exceeds availability in warehouse');
		        	}
		        else{
		        		        
    var invoiceNo = $('#invoiceNo').val();
	invoiceNo = invoiceNo.trim();
	var from = $('#fromWareHouse').val();
	var to = $('#to').val();
	var postData = 'a=createNewStockTransferInvoice&stockTransferInvoiceNo='+invoiceNo+'&'+ $('#stockTransferInvoiceForm').serialize();
	$.post(
			       './application/controller/control.php', postData,
			       function(data)
			       {
			    	   var postData2 = 'a=createStockTransferEntry&invoiceNo='+invoiceNo+'&'+ $('#stockTransferEntryForm').serialize()+'&to='+to+'&from='+from;
			    		$.post(
			    						'./application/controller/control.php', postData2,
			    						function(data2)
			    						{
			    						//	alert(data2);
			    							//$('#main').html(data2);
			    							getStockTransferReportCurrent();
			    							//$('#testCode').html(data);
			    						});
			       });
		        }
			});
}
function submitEditStockTransferInvoice()
{	        		        
    var invoiceNo = $('#invoiceNo').val();
	invoiceNo = invoiceNo.trim();
	var from = $('#fromWareHouse').val();
	var to = $('#to').val();
	var postData = 'a=createEditNewStockTransferInvoice&stockTransferInvoiceNo='+invoiceNo+'&'+ $('#stockTransferInvoiceForm').serialize();
	$.post(
			       './application/controller/control.php', postData,
			       function(data)
			       {
			    	   var postData2 = 'a=createEditStockTransferEntry&invoiceNo='+invoiceNo+'&'+ $('#stockTransferEntryForm').serialize()+'&to='+to+'&from='+from;
			    		$.post(
			    						'./application/controller/control.php', postData2,
			    						function(data2)
			    						{
			    						//	alert(data2);
			    							//$('#main').html(data2);
			    							getStockTransferReportCurrent();
			    							//$('#testCode').html(data);
			    						});
			       });
}
function submitStockPurchase()
{
	var purchaseEntryNo = $('#purchaseEntryNo').val();
	var postData = 'a=createStockPurchase&'+ $('#stockPurchaseForm').serialize();
	$.post(
			       './application/controller/control.php', postData,
			       function(data)
			       {
			    	   var postData2 = 'a=createStockPurchaseEntry&purchaseEntryNo='+purchaseEntryNo+'&'+ $('#stockPurchaseEntryForm').serialize();
			    		$.post(
			    						'./application/controller/control.php', postData2,
			    						function(data2)
			    						{
			    							getStockPurchaseReportCurrent();
			    							//$('#testCode').html(data);
			    						});
			       });
	
}
function submitEditStockPurchase()
{
	var purchaseEntryNo = $('#purchaseEntryNo').val();
	var postData = 'a=createEditStockPurchase&'+ $('#stockPurchaseForm').serialize();
	$.post(
			       './application/controller/control.php', postData,
			       function(data)
			       {
			    	   var postData2 = 'a=createEditStockPurchaseEntry&purchaseEntryNo='+purchaseEntryNo+'&'+ $('#stockPurchaseEntryForm').serialize();
			    		$.post(
			    						'./application/controller/control.php', postData2,
			    						function(data2)
			    						{
			    							getStockPurchaseReportCurrent();
			    							//$('#testCode').html(data);
			    						});
			       });
	
}
function getTaxMaster()
{
     $.post('./application/controller/taxMaster.php',
                   '',
                   function(data)
                   {
    	 					$('#main').html(data);
    	 					$('.ui-jqgrid-htable').css("font-size","11px");
    	 					$('.ui-jqgrid-btable').css("font-size","11px");
    	 					$('#wef').datepicker({dateFormat:"yy-mm-dd"});
                   });	
}
$('#add_1').click(function(){
	$('#wef').datepicker({dateFormat:"yy-mm-dd"});
});
$('#edit_1').click(function(){
	$('#wef').datepicker({dateFormat:"yy-mm-dd"});
});
function getDCMasterAwesome()
{
	$.post('./application/controller/dcMaster.php',
            '',
            function(data)
            {
	 					$('#main').html(data);
	 					$('.ui-jqgrid-htable').css("font-size","11px");
	 					$('.ui-jqgrid-btable').css("font-size","11px");
            });	
}
function getBranchMaster()
{
	$.post('./application/controller/branchMaster.php',
            '',
            function(data)
            {
	 					$('#main').html(data);
	 					$('.ui-jqgrid-htable').css("font-size","11px");
	 					$('.ui-jqgrid-btable').css("font-size","11px");
            });	
}

function getCFMaster()
{
	$.post('./application/controller/cfMaster.php',
            '',
            function(data)
            {
	 					$('#main').html(data);
	 					$('.ui-jqgrid-htable').css("font-size","11px");
	 					$('.ui-jqgrid-btable').css("font-size","11px");
            });	
}
function getDistributorMaster()
{
	$.post('./application/controller/distributorMaster.php',
            '',
            function(data)
            {
	 					$('#main').html(data);
	 					$('.ui-jqgrid-htable').css("font-size","11px");
	 					$('.ui-jqgrid-btable').css("font-size","11px");
            });	
}
function getAccessControl()
{
		var postData = 'a=getAccessControl';
		action(postData,'main');
		loadMenu('accessControl');
}
function loadAccessControlTypeID()
{
	var type = $('#type').val();
	var postData = 'a=loadAccessControlTypeID&type='+type;
	action(postData,'accessControlTypeID');
}
function addAccessControl()
{
	var postData = 'dao=addAccessControl&'+$('#accessControlForm').serialize();
	dbAction(postData,"Success","Data updated successfully !!!");
	alert('User Created');
	getAccessControl();
}
function getReportMaster()
{
	var postData = "a=getReportMaster";
	action(postData,"main");
	//loadMenu("reportMasterMenu");
}
function getReportMaster_old()
{
	window.location = "report.html";
}
function generatePartWiseReport()
{
	var postData = 'a=generatePartWiseReport&'+$('#partyWiseForm').serialize();
	actionReport(postData,'mainReport');
}
function getCategoryMaster()
{
     $.post(
    		 			'./application/controller/categorymaster.php',
    		 			'',
    		 			function(data)
    		 			{
    		 				$('#main').html(data);
    		 			}
     );	
}
function getSubCategoryMaster()
{
	$.post(
 			'./application/controller/subcategorymaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
}
function getBrandMaster()
{
	$.post(
 			'./application/controller/brandmaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
}
function getUnitMaster()
{
	$.post(
 			'./application/controller/unitmaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
}
function getPackingUnitMaster()
{
	$.post(
 			'./application/controller/packingunitmaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
}
function getCurrencyMaster()
{
	$.post(
 			'./application/controller/currencyMaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
}
function loadCurrencySign()
{
	var currencyName = $('#currencyName').val();
	var postData = 'a=loadCurrencySign&currencyName='+currencyName;
	$.post('./application/controller/control.php',
			       postData,
			       function(data)
			       {
		                $('.currencySignID').each(function(){
		                	$(this).html(data);
		                });
			       });
}
function getPriceMaster()
{
	$.post(
 			'./application/controller/basicpricemaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
	loadMenu("pricemasterMenu");
}
function getMRPMaster()
{
	$.post(
 			'./application/controller/mrpmaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
	loadMenu("pricemasterMenu");
}
function getRetailerMaster()
{
	$.post(
 			'./application/controller/retailermaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
 			
);
	loadMenu("retailmasterMenu");
}
function getSubRetailerMaster()
{
	$.post(
 			'./application/controller/subretailermaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);	
	loadMenu("retailmasterMenu");
}
function getModernTradeMaster()
{
	$.post(
 			'./application/controller/moderntradepricemaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
	loadMenu("pricemasterMenu");
}
function getDistributorRetailPriceMaster()
{
	$.post(
 			'./application/controller/distributorpricemaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);
	loadMenu("pricemasterMenu");
}
function setCurrentState(distID)
{
	var postData = 'a=getStateOfDistributor&distID='+distID;
	$.post('./application/controller/control.php',
			      postData,
			      function(text)
			      {
		             text = text.trim();
		             $('#state').val(text);
		             postData = 'a=getStateWiseTransporter&state='+text;
		             action(postData,'stateWiseTransporter');
		             postData2 = 'a=getStateWiseSalesman&state='+text;
		             action(postData2,'stateWiseSalesman');
			      });
}
function getSalesInvoiceMaster()
{
	var postData = 'a=getSalesInvoiceMaster';
	action(postData,'main');
}
function getSalesEntryMaster()
{
	$.post(
 			'./application/controller/salesEntryMaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);	
}
function getStockInvoiceMaster()
{
	var postData = 'a=getStockInvoiceMaster';
	action(postData,"main");
}
function getStockEntryMaster()
{
	$.post(
 			'./application/controller/stockEntryMaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);	
}
function getPurchaseInvoiceMaster()
{
    var postData = 'a=getStockPurchaseMaster';
    action(postData,'main');
}
function getPurchaseEntryMaster()
{
	$.post(
 			'./application/controller/purchaseEntryMaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);	
}
function loadCreditorDetails()
{
    var supplierID = $('#supplierName').val();	
    $.post(
    		        './application/controller/control.php?a=loadCreditorDetails&supplierID='+supplierID,
    		        '',
    		        function(data)
    		        {
    		        	var obj =  jQuery.parseJSON(data);
						$('#supplierAddress').val(obj.address);
						$('#supplierShowName').val(obj.partyName);
						$('#currencyName').val(obj.currency);
    		        });
}
function loadReportParameters()
{
	var reportType = $('#reportType').val();
	var state = $('#reportRegion').val();
	$.post('./application/controller/control.php?a=loadReportParameter&reportType='+reportType+'&state='+state,
			     '',
			     function (data)
			     {
						$('#reportParameter').html(data);
			     })
};
function loadOptions()
{
	
	var reportType = $('#reportType').val();
	var state = $('#reportRegion').val();
	if(reportType == 'sr')
		{
		     $('#reportParameter').hide();
		     $('#parameterText').hide();
		     $('#reportRegion').hide();
		 	 $('#startDate').hide();
		 	 $('#endDate').hide();
		 	 $(".textSelect").hide();
		}
	else
		{
		     $('#reportParameter').show();
	         $('#parameterText').show();
	         $('#reportRegion').show();
		 	 $('#startDate').show();
		 	 $('#endDate').show();
		 	$(".textSelect").show();
		}
	$.post('./application/controller/control.php?a=loadReportParameter&reportType='+reportType+'&state='+state,
			     '',
			     function (data)
			     {
						$('#reportParameter').html(data);
			     })
};
/*function generateReport()
{
	var reportType = $('#reportType').val();
	var state = $('#reportRegion').val();
	var startDate = $('#startDate').val();
	var endDate = $('#endDate').val();
	var param = $('#reportParameter').val();
	var postData = 'a=generateReport&reportType='+reportType+'&state='+state+'&startDate='+startDate+'&endDate='+endDate+'&param='+param;
	action(postData,'mainReport');
	$.post(
 			'./application/controller/salesReportMaster.php?reportType='+reportType+'&state='+state+'&startDate='+startDate+'&endDate='+endDate+'&param='+param,
 			'',
 			function(data)
 			{
 				$('#reportTable').html(data);
 				$('.ui-jqgrid .ui-jqgrid-htable').css('font-size','11px !important');
 				$('.ui-jqgrid tr.ui-row-ltr td').css('font-size','11px !important');
 			});
	//action(postData,'mainReport');
}*/
function getAccessMaster()
{
	$.post(
 			'./application/controller/accessmaster.php',
 			'',
 			function(data)
 			{
 				$('#main').html(data);
 			}
);	
}
function getPartyInventory()
{
	$.post(
			'./application/controller/control.php',
 			'a=getCurrentWarehouseID',
 			function(data){
				var postData = 'warehouseID='+data.trim();
				$.post(
			 			'./application/view/partyInventory.php',
			 			postData,
			 			function(data)
			 			{
			 				$('#main').html(data);
			 			}
			);	
			}
	);
}
function openConfirmationDialog()
{
	$('#confirmDialog').dialog({
	       autoOpen:false,
	       width:500,
	       height:150,
	       title:'Loading',
	       modal:true
	    });
	$('.ui-dialog-titlebar').hide();
	$('#confirmDialog').dialog('open');	
}
function generateBrandWiseReport()
{
	var postData = "a=generateBrandWiseReport&"+$('#brandWiseReportForm').serialize();
	action(postData,"mainReport");
}
function generateProductWiseReport()
{
	var postData = "a=generateProductWiseReport&"+$('#productWiseReportForm').serialize();
	action(postData,"mainProductReport");
}
function generateStateWiseReport()
{
	var postData = "a=generateStateWiseReport&"+$('#stateWiseReportForm').serialize();
	action(postData,"mainStateReport");
}
function editStockTransferInvoice(id)
{
     var postData = 'a=getEditStockTransfer&invoiceNo='+id;
     action(postData,"main");
}
function editStockPurchaseInvoice(id)
{
	var postData = 'a=getEditStockPurchase&invoiceNo='+id;
    action(postData,"main");
}
function editSalesInvoice(id)
{
   var postData  = 'a=editSalesEntry&invoiceNo='+id;
   action(postData,'main');
}


