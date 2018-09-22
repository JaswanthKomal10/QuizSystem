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
else if(!isset($_SESSION["currentsubject"]))
{
?>
	<script>
    alert("Good Job...!!You can't access this page without selecting subject");
	window.location="onlinetest.php";
	</script>
	<?php
	
}
else{
	$_SESSION["totalques"]=5;
	$totalqns=$_SESSION["totalques"];
	$subject=$_SESSION["currentsubject"];
	
	
	?>
	
<html>
<head>
<title>questions</title>
<style>
.mainDivdq
{
	width:90%;
	/*background-color:greenyellow*/
	background-color:#ACEA9F;
	margin:auto;
	text-align:center;
	min-height:250px;
	margin-bottom:10px;
}

.question
{
	min-height:80px;
	font-family:times new roman;
	font-size:20px;
	background-color:powderblue;
}

.choices
{
	width:45%;
	margin-bottom:10px;
	margin-left:10px;
	margin-top:20px;
	background-color:mintcream;
	text-align:center;
	float:left;
	min-height:40px;

}
</style>
<script>
var selected=[];
var optarray=["","a","b","c","d"];
var selectedopt=[];
function makeselect(opt)
{
	opt=opt+"";
	var leng=opt.length;
	
	var no=opt.substring(0,leng-1);
//moccasin	
	document.getElementById("choice"+ no +"1").style.backgroundColor="#F5F5F5";
	document.getElementById("choice"+ no +"2").style.backgroundColor="#F5F5F5";
	document.getElementById("choice"+ no +"3").style.backgroundColor="#F5F5F5";
	document.getElementById("choice"+ no +"4").style.backgroundColor="#F5F5F5";
	document.getElementById("choice"+opt).style.backgroundColor="#00CC99";
	selected[no]=optarray[opt.substring(leng-1,leng)];
	
	
	
//alert(selected[no]);

//alert(leng);
}
function getmarks()
{
	var tot=document.getElementById("ans").value;
	var arrayname=tot.split(",");
	var totalmarks=0;
	var tl_ques=5;
	for(i=0;i<tl_ques;i++)
	{
		
		if(arrayname[i]==selected[i])
		{
			totalmarks++;
		
		}
		//document.write(selected[i]+"====="+arrayname[i]+"===="+totalmarks+"<br>");
	}
	document.getElementById("marks").value=totalmarks;
	//document.write(tot);
	//for(i=0;i<30;i++)
		
	return true;
}

</script>
</head>
<body bgcolor="plum">
<form action="marks.php" method="post" onsubmit="return getmarks();">
<?php
require("connection.php");
$cn=getconnection();
$subject=$_SESSION["currentsubject"];
$sqlrow="select * from questiontest where subject like '$subject' order by rand() limit $totalqns";
$qnnoans=array();
$count=0;
$sl=1;
$rows=mysqli_query($cn,$sqlrow);
$answers="";
while($row=mysqli_fetch_row($rows))
{
	
	//echo strlen($row[1]);
	//if(($row[1])==NULL)
	//{
	//	echo "<div class=question id='question1'><img src='csc-full\\q18.png'>";
	//}
	echo "<div class=mainDivdq>";
		if(($row[1])!=NULL)
		{
		echo "<div>";
			echo "<div class=question id='question1'>".$sl++.".".$row[1]."<br></div>";
				echo "<div class=choices id='choice$count". "1'>
				<input type='radio' name='options$count' id='opt$count". "1' value='a' onClick=makeselect('$count" . "1')>".$row[2]."<br></div>";
				echo "<div class=choices id='choice$count". "2'>
				<input type='radio' name='options$count' id='opt$count" . "2' value='b' onclick=makeselect('$count" . "2')>".$row[3]."<br></div>";
				echo "<div class=choices id='choice$count". "3'>
				<input type='radio' name='options$count' id='opt$count"."3' value='c' onclick=makeselect('$count" . "3')>".$row[4]."<br></div>";
				echo "<div class=choices id='choice$count". "4'>
				<input type='radio' name='options$count' id='opt$count"."4' value='d' onclick=makeselect('$count" . "4')>".$row[5]."<br></div>";
				//echo"<div> $row[6]</div>";
		echo "</div>";
		//$qnnoans[$row[0]]=$row[6];
		//$sl++;
		array_push($qnnoans,$row[0]);
		}
	echo "</div>";
		$answers=$answers.$row[6].",";
	$count++;	
	$_SESSION["quesans"]=$qnnoans;
}


	
?>
<input type="hidden"  id="ans" value=<?php echo $answers;?> >
<input type="hidden"  id="marks" value="" name="marks" >
<center>
	<input type="submit" value="Get Score">
</center>
</form>
</body>
</html>

<?php
}	
?>