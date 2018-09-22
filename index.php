<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="csspage.css">
</head>
<body>
<div>
<img src="download.jpg" height="194" width="194">
</div>
<div id="loginbox">
<form action="checklogin.php" method="post">
<div class="label">
Mail/Phone </div>
<div class="inputs">
<input type=text name="uname" id="t1">
</div>
<div class="label">
Password 
</div>
<div class="inputs">
<input type=password name="pass" id="p1">
</div>
<div id="buttons">
<input type=submit value="LOGIN" align="center" class="lb">
</div>
<div  style="text-align:center; width:100%">
<a href="register.php" title="SignUP Now!!!">Haven't Registered?SignUP.</a>
</div>
<div  style="text-align:center; width:100%">
<?php

</div>if(ISSET($_GET["status"]))
{
	if($_GET["status"]==2)	
		echo "Invalid User";
	else if($_GET["status"]==1)
		echo "Password is Wrong";
	else{
		header("location:index.php");
	}
}
?>
</form>
</div>
</body>
</html>
