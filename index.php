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
<script src='js/ems.js'>
</script>
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
<style>
.coolInput
{
height:30px;
width:260px;
font-size:20px;
border: 0px solid ;
background-color:#ffffff;
padding:5px;
color:#555555;
border-radius:10px;
}
</style>
</head>
<body style="background-image:url('image/bodyBg.png'); ">

<div style="width:100%;" align="center">
<div id="loginDiv" style="width:50%;height:500px;border:1px solid #99f6f7;margin-top:5%;border-radius:20px;background-color:#adeffd">
<div style="font-size:20px;color:#555555;margin-top:2%;">
<b>Consumer Marketing (India) Private Limited</b></div>
<form id='loginFormX'  style='margin-top:18%;' >
<input class='coolInput'  type="text" id='username' name='username'>
<br><br>
<input class='coolInput'  type="password" id='password' name='password'>
<br><br>
<span id='errorMsg' style='font-size:12px;color:#ff0000;'></span>
<br><br>
<input type='button' class='bigInput nu' value='Sign In'  onclick="signIn();"> 
</form>
</div>

</div>
<div id="loading" style="display:none;" align='center'> <img src='./image/ajax-loader.gif'></div>
<script>
var winHeight = $(window).height();
$('.verticalBar').height(winHeight);
$('.nu').button();
showLoginSection();
</script>
</body>
</html> 