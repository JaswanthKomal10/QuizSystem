<?php
require("connection.php");
if($_SERVER['REQUEST_METHOD']=='POST')
{
$cn=getconnection();

$name=$_POST["sname"];
$mobno=$_POST["mobno"];
$userid=$_POST["uid"];
$mail=$_POST["mail"];
$pass=$_POST["pass"];
$cpass=$_POST["cpass"];
$hashmail=md5($mail);
$hashmob=md5($mobno);
if($name!=null && $mobno!=null && $mail!=null && $pass!=null && $cpass!=null)
{
if($pass==$cpass)
{
	
	$hasspass=md5($cpass);
	$sql="insert into studentdetails values('$name','$mobno','$hashmail','$userid','$mail','$hashmob','$pass','$hasspass',0,0,1)";
	//$response=mysqli_query($cn,$sql);
	//echo $response;
	mysqli_query($cn,$sql);
	header("location:index.php");
}
else
{
	header("location:register.php?status=1");
}
}
else
{
	header("location:register.php?status=2");
}
}
else
{
	
?>
	<script>
     alert("Good Joke....!");
	 window.location="register.php";
	</script>
	<?php
	
}
?>