<?php
session_start();
if(!isset($_SESSION["currentuser"])){
	
?>
	<script>
     alert("Good Job...!!You can't access this page directly");
	window.location="sessiondestroy.php";
	</script>
	<?php
	
}
else{
	?>
	
<html>
<head>
<title>onlinetest</title>
<link rel="stylesheet" href="csspage.css">
<style>
#content
{
	width:100%;
	margin:auto;
	
}
#leftcontent
{
	float:left;
	width:20%;
	height:100%;
	background-color:burlywood;
	
}

#rightcontent
{
	float:right;
	width:78%;
	height:100%;
	
	
}
.visible{
	display:none;
}
</style>
<script>
var etype=["","quants","reasoning","english"];
function show(obj)
{
	document.getElementById("opt1").style.display="none";
	document.getElementById("opt2").style.display="none";
	document.getElementById("opt3").style.display="none";
	document.getElementById("opt"+obj).style.display="block";
	document.getElementById("extype").value=etype[obj];
}
function gotopage()
{
	window.location.href="subjectselection.php?extype=" + document.getElementById("extype").value;
}
</script>
</head>
<body bgcolor="yellow" onload=show(1)>
<div class="large">
Start your test to know your score........
</div>
<div id="content">
<div id="leftcontent">
<ul>
<li><a href="javascript:show(1)">Quantitative Ability</a>
</li>
<li><a href="javascript:show(2)">Logical Reasoning</a>
</li>
<li><a href="javascript:show(3)">English Grammar</a>
</li>
</ul>
</div>
<div id="rightcontent" class="topic">
<div class="visible" id="opt1">
Quantitative ability tests the ability of a candidate to handle numerical data and solve numerical problems.This section tests your ability to analyse and understand the problem.As the nature of every problem is different,it requires application of the mind and knowledge of the tricks,formulas,process of solving.
<div>
<a class="click"  href="javascript:gotopage()">Quants test</a>
</div>
</div>
<div class="visible" id="opt2">
Logical reasoning is the process in which one uses reasoning consistently to come to a conclusion.It is the process of using a rational,systematic series of steps based on sound mathematical procedures and given statements to arrive at a conclusion.
<div>
<a class="click"  href="javascript:gotopage()">Logical Reasoning test</a>
</div>
</div>
<div class="visible" id="opt3">
English grammar is the way in which meanings are encoded into wordings in the English language.This includes the structure of words,phrases,clauses and sentences. 
<div>
<a class="click"  href="javascript:gotopage()">English test</a>
</div>
</div>
<div>
<input type="hidden"  id="extype">
</div>
</div>
</div>
</body>
</html>

<?php
}
?>

