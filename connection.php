<?php
function getconnection()
{
	$connection= mysqli_connect("localhost","root","jaswanth","studentperformance");
	return $connection;
}
?>