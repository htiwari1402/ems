<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="./image/icon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title >Enterprise Management System</title>
<link rel="stylesheet" href='libs/jquery-ui.css'>
<link rel="stylesheet" href='css/styles.css'>
<script  src='libs/jquery.js'>
</script>
<script  src='libs/jquery-ui.js'>
</script>
<script src='js/ems17-08-2015.js'>
</script>
<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxchart.core.js"></script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src='js/util.js'>
</script>
<link rel="stylesheet" type="text/css" href="./libs/js/themes/ems/jquery-ui.custom.css"></link>
<link rel="stylesheet" type="text/css" href="./libs/js/jqgrid/css/ui.jqgrid.css"></link>
<script src="./libs/js/jquery.min.js" type="text/javascript">
</script>
<script src="./libs/js/jquery.min.js" type="text/javascript">
</script>
<script src="./libs/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript">
</script>
<script src="./libs/js/jqgrid/js/jquery.jqgrid.min.js" type="text/javascript">
</script>
<script src="./libs/js/themes/jquery-ui.custom.min.js" type="text/javascript">
</script>
</head>
<body>
<div id='header' align="center">
<div class='leftHeaderSpan'>
<img src="./images/home.png" height="25" width="25" onClick="getWelcome();" style="cursor:pointer">
&nbsp;&nbsp;&nbsp;
Hello ! <?php echo $_SESSION['username']; ?>
</div>
<!-- img id='centreLogo' src='images/logo.jpg'-->
<div class='rightHeaderSpan'>
<img src="./image/menu.png" id='showMenuBubble' height="25" width="25" onClick="showMenuBar();" style="cursor:pointer">
<img src="./image/menu.png" id='hideMenuBubble'  height="25" width="25" onClick="hideMenuBar();" style="cursor:pointer;display:none;">
&nbsp;&nbsp;&nbsp;
<span style='cursor:pointer' onclick='logout();'>Logout</span>
</div>
</div>	
<div id="main" align="center">
<?php include "application/view/welcome.php"; ?>
</div>
<div id='menuBar' align="center">
<?php include "application/view/menus/mainMenu.php";?>
</div>

<div id='loading' style='display:none' align='center'>
            <img src='./image/ajax-loader.gif'>
            </div>
        <div id='alert' style='display:none' align='center'>
            </div>
            <div id='alert' style='display:none' align='center'>
            </div>
</body>
</html> 
