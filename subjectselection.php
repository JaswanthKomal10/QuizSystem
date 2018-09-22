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
	$subject=$_GET["extype"];
	$_SESSION["currentsubject"]=$subject;
	header("location:displayquestions.php");
}
?>
<?php
	/*
	<script>
	//window.location="displayquestions.php";
	</script>
	<?php
}
*/
?>

	
	

	