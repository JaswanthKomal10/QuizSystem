<?php
session_start();
//echo $_SESSION["currentuser"];
if(!isset($_SESSION["currentuser"])){
	
?>
	<script>
     alert("Good Job...!!You can't access this page directly");
	 window.location="sessiondestroy.php";
	</script>
	
	<?php
	
}
else{
require("connection.php");
$cn=getconnection();

	
	?>
	
<html>
<head>
<title>Your marks</title>
<style>
.m
{
font-family:timesnewroman;
font-size:30px;
font-color:deeppink;
}
#pid
{
	font-color:green;	
}
</style>
<script>
function findDate()
{
var d=new Date();
var dt=d.getDate() + "-" + (d.getMonth()+1) + "-" + (d.getYear()+1900);
return dt;
}
</script>
</head>
<body bgcolor="tan">
<center>
<img src="boy.gif">
<div class="m">
<?php
/*$questiondisplaystatus=1;
$_SESSION["status"]=$questiondisplaystatus;*/
$qns=$_SESSION["quesans"];
//print_r($qns);
$totalqns=$_SESSION["totalques"];
$marks=$_POST["marks"];
$subject=$_SESSION["currentsubject"];
$examdate=date("Y-m-d");
//echo date_format($examdate,"Y/m/d H:i:s");
//echo $examdate;

$examid="select max(examid) from answerdetails";
$selectedopt=array();
for($i=0;$i<$totalqns;$i++)
{
	array_push($selectedopt,$_POST["options".$i]);
/*	
$sqlrows="select * from questiontest where serial=$qns[$i]";
//echo $sqlrows;
$rows=mysqli_query($cn,$sqlrows);
while($row=mysqli_fetch_row($rows))
{
	$ques=$row[1];
	
}
*/
}
$examidrow="select max(examid) from answerdetails";
$examidresrow=mysqli_query($cn,$examidrow);
while($resultexamid=mysqli_fetch_row($examidresrow))
	{
		
		if(is_null($resultexamid[0]))
		{
			$examid=1;
		}
		else
		{
			$examid=$resultexamid[0]+1;
		}
	}
	

$uname=$_SESSION["currentuser"];
$_SESSION["examid"]=$examid;
$_SESSION["marks"]=$marks;

for($i=0;$i<$totalqns;$i++)
{
	$sqlresult="insert into answerdetails values('$uname',$examid,$qns[$i],'$selectedopt[$i]')";
	mysqli_query($cn,$sqlresult);
}

//echo $examid;
//echo $uname;

//print_r($selectedopt);


$inserttestresult="insert into testrecords values('$uname',$examid,'$examdate','$subject',$marks)";
mysqli_query($cn,$inserttestresult);
echo "<p id='pid'>Your mark is $marks</p>";
/*print_r($_POST);
*/
?>
</div>
</center>
</body>
</html>

<?php	
}
?>