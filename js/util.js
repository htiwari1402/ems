//STANDARD AJAX FUNCTION

function action(param, division)
{
	openLoading();
	$.post('./application/controller/control.php',
			param,
			function(responseText)
				{
					if(division.length > 0)
						{
							    $('#'+division).html(responseText);
							    closeLoading();
							    nu();
						}
				},
			'html'
			);
}
function actionReport(param, division)
{
	openLoading();
	$.post('./application/controller/reportControl.php',
			param,
			function(responseText)
				{
					if(division.length > 0)
						{
							    $('#'+division).html(responseText);
							    closeLoading();
							    nu();
						}
				},
			'html'
			);
}

function emptyAction(param,title, message)
{
	openLoading();
	$.post('./application/controller/control.php',
			param,
			function(responseText)
				{
					showAlert(title,message);
					closeLoading();
					nu();	
				},
			'html'
			);
}
function dbAction(param,title, message)
{
	$('#loading').dialog({
	       autoOpen:false,
	       width:150,
	       height:120,
	       title:'Loading',
	       modal:true
	    });
	$('.ui-dialog-titlebar').hide();
	$('#loading').dialog('open');
	$.post('./application/model/dao.php',
			param,
			function(responseText)
				{
					//showAlert(title,message);
					$('#loading').dialog('close');
					nu();	
				},
			'html'
			);
}
function dbActionDebug(param,title, message)
{
	openLoading();
	$.post('./application/model/dao.php',
			param,
			function(responseText)
				{
					showAlert(title,responseText);
					closeLoading();
					nu();	
				},
			'html'
			);
}

//LOADING FUNCTION

function openLoading()
{
	$('#loading').dialog({
	       autoOpen:false,
	       width:150,
	       height:120,
	       title:'Loading',
	       modal:true
	    });
	$('.ui-dialog-titlebar').hide();
	$('#loading').dialog('open');
}

function closeLoading()
{
	$('#loading').dialog('close');
}



//ALERT DIALOG

function showAlert(header,content)
{
	$('#alert').dialog({
        autoOpen:false,
        width:400,
        height:200,
        modal:true,
        title:header,
        buttons: [ { text: "Ok", click: function() { $( this ).dialog( "close" ); } } ]
        
    });
    $('#alert').html(content);
    $('#alert').dialog('open');
}
function hideAlert()
{
	$('#alert').dialog('close');
}

//VALIDATION

function isAlphaNumeric(string)
{
	var regx = /^[A-Za-z0-9]+$/;
    if (!regx.test(string)) 
    {
       return false;
    }
    return true;
}

function isNumeric(string)
{
	var regx = /[0-9]+/;
    if (!regx.test(string)) 
    {
       return false;
    }
    return true;	
}
function isAlpha(string)
{
	var regx = /^[A-Za-z]+$/;
    if (!regx.test(string)) 
    {
       return false;
    }
    return true;
}

function isEmail(string)
{
	var x=string;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	  {
	  return false;
	  }
	else
	  return true;	
	
}

//JQUERY UI STYLING

function nu()
{
	$('.nu').button();
	//$('.date').datepicker({dateFormat:"yy-mm-dd"});
	$( ".date" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
	      dateFormat:"yy-mm-dd"
	    });
}

function loadMenu(module)
{
	$.post('./application/controller/menuControl.php','a='+module,
			function(responseText)
			{
				$('#menuBar').html(responseText);
			});
	
}
function addAnotherRow(tableName)
{
	var rowCount = $('#rowCount').val();
	rowCount++;
	$('#rowCount').val(rowCount);
	$.post('./application/controller/control.php','a=addAnotherRow&tableName='+tableName+'&rowCount='+rowCount,
				function(responseText)
				{
						$('#'+tableName+ ' tr' ).last().after(responseText);	
						$('.date').datepicker({dateFormat:"yy-mm-dd"});
				});
}
function addAnotherRowSP(tableName)
{
	var rowCount = $('#rowCount').val();
	rowCount++;
	$('#rowCount').val(rowCount);
	$.post('./application/controller/control.php','a=addAnotherRowSP&tableName='+tableName+'&rowCount='+rowCount,
				function(responseText)
				{
						$('#'+tableName+ ' tr' ).last().after(responseText);	
						$('.date').datepicker({dateFormat:"yy-mm-dd"});
						loadCurrencySign();
				});
}
