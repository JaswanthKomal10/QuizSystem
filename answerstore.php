
<?php session_start(); 
require('connection.php');
$cn=getConnection();
?>

<?php
if(isset($_SESSION["enroll"])){
	
?>
	<script>
     alert("Good Job...!!You can't access this page directly");
	window.location="session_destroy.php";
	</script>
	<?php
	
}
else{
	$subject=$_SESSION["currentsubject"];
	$marks=$_SESSION["marks"];
	$examid=$_SESSION["examid"];
	
	
	$sqlrow="select * from answerdetails,questiontest where examidid=$examid and answerdetails.quesno=questiontest.serial";
	$rows=mysqli_query($cn,$sqlrow);
	require 'fpdf/fpdf.php';
    $pdf= new FPDF('P','mm','A4');
	$pdf->AddPage();
    $pdf->SetFont('Arial','',10);
	$pdf->SetRightMargin(20);
	$x=180;
	$y=4;
	while($row=mysqli_fetch_row($rows))	
	{
		//trim($row[1])
		$ques=iconv('utf-8','utf-8',trim($row[1]));
		$opt1=iconv('utf-8','utf-8',trim($row[2]));
		$opt2=iconv('utf-8','utf-8',trim($row[3]));
		$opt3=iconv('utf-8','utf-8',trim($row[4]));
		$opt4=iconv('utf-8','utf-8',trim($row[5]));
		//$text=$pdf->WordWrap($ques,120);
		$pdf->Multicell($x,$y,$ques,'0','J');
		$pdf->Multicell(1,1,"\n");
		$pdf->Multicell($x,$y,"(a)".$opt1."		"."(b)".$opt2."		".
		"(c)".$opt3."		"."(d)".$opt4);
		$pdf->Multicell(1,4,"\n");
		
		
	}
	$filename = "Pdfcollections/jaswanth.pdf";
	$pdf->Output($filename, 'F');
}
	

?>