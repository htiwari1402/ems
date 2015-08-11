<!DOCTYPE html>
<html>
<head>
<title>Enterprise Management System</title>
<link rel="stylesheet" href='css/styles.css'>
<link rel="stylesheet" href='libs/jquery-ui.css'>
<script src="js/script.js"></script>
<script src="libs/jquery.js"></script>
<script src="libs/jquery-ui.js"></script>
</head>
<body>
<div id='firstBar' class='verticalBar' align='center'>
<img id='mainLogo' src='image/companyFullLogo.png'><br><br><br><br>
<span style="font-family:Cambria;font-size:32px;color:#000000;">Consumer&nbsp;&nbsp;&nbsp; Marketing&nbsp;&nbsp;&nbsp; Private&nbsp;&nbsp;&nbsp;Limited</span>
<!-- <img id='subLogo' src='images/logo_sub.png'> -->
<br/></br>
</div>
<div id='secondBar' class='verticalBar' align='center'>
<div id='loginForm' style="margin-top: 55%;display:none;">
<form id='loginFormX' action='home.php'>
<input class='bigInput' type="text" id='username' name='username'>
<br><br>
<input class='bigInput' type="password" id='password' name='password'>
<br><br>
<span id='errorMsg' style='font-size:12px;color:#ff0000;'></span>
<br><br>
<input type='button' class='bigInput nu' value='Sign In' onclick='signIn();'> 
</form>
</div>
</div>
<script>
var winHeight = $(window).height();
$('.verticalBar').height(winHeight);
$('.nu').button();
showLoginSection();
</script>
</body>
</html> 