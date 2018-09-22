<html>
<head>
<title> REGISTRATION</title>
<link rel="stylesheet" href="csspage.css">
</head>
<body>
<div>
<img src="images.jpeg" height="152" width="152">
</div>
<div id="box">
<form action="actionsave.php" method="post">
<div class="label">
Name
</div>
<div class="inputs">
<input type="text" name="sname" id="n2">
</div>
<div class="label">
User ID
</div>
<div class="inputs">
<input type="text" name="uid" id="uid">
</div>
<div class="label">
Mobile Number
</div>
<div class="inputs">
<input type="text" name="mobno" id="m">
</div>
<div class="label">
Email ID
</div>
<div class="inputs">
<input type="text" name="mail" id="m1">
</div>
<div class="label">
Password
</div>
<div class="inputs">
<input type="password" name="pass" id="p1">
</div>
<div class="label">
Confirm Password
</div>
<div class="inputs">
<input type="password" name="cpass" id="p2">
</div>
<div  style="text-align:center; width:100%">
<?php
if(ISSET($_GET["status"]))
{
	if($_GET["status"]==1)
	{
		echo "Passwords does not match";
	}
	else if($_GET["status"]==2)
	{
		echo "Fill all the inputs";
	}
	else
	{
		header("location:register.php");
	}

}
?>
</div>
<div id="buttons">
<input type=submit value="REGISTER">
</div>
</form>
</div>
</body>
</html>
