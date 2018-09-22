<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
require("connection.php");
$cn=getconnection();
$user=$_POST["uname"];
$pass=$_POST["pass"];
$hashuser=md5($user);
$hashpass=md5($pass);
$sql_row="select userid,hashpass from studentdetails where hashmail like '$hashuser' or hashmob like '$hashuser'";
$rows=mysqli_query($cn,$sql_row);

//mysqli_multi_query($conn, $sql)......($conn->multi_query($sql) === TRUE)
if($row=mysqli_fetch_row($rows))
{
	
	if($hashpass==$row[1])
	{
		//$sessionname=substr($row[2],0,strpos($row[2],'@'));
		$sessionname=$row[0];
		$sqlupdate="update studentdetails set logoutstatus=0,activestatus=1 where userid=$sessionname";
		mysqli_query($cn,$sqlupdate);
		$_SESSION["currentuser"]=$sessionname;
		header("location:onlinetest.php");
		
	}
	else
	{
		header("location:index.php?status=1");
	}
}
else
{
	header("location:index.php?status=2");
}
}
	
else
{
	
?>
	<script>
     alert("Good Joke....!");
	 window.location="index.php";
	</script>
	<?php
	
}
?>