<?php session_start(); 
require('connection.php');
$link=db_connection();
?>

<?php
if(!isset($_SESSION["enroll"])){
	
?>
	<script>
     alert("Good Job...!!You can't access this page directly");
	window.location="session_destroy.php";
	</script>
	<?php
	
}
else{

//$subject=$_SESSION["subject"];
//$enroll=$_SESSION["enroll"];

/*
$name=$_SESSION['name'];
$dateofexam=$_SESSION['dateofexam'];
$batchtime=$_SESSION['batchtime'];
$faculty=$_SESSION['facultyname'];
$course=$_SESSION['course'];
$lastexam=$_SESSION['lastexam'];
*/


/*
require ('answer_key.php');
$key=array();
 $key=  keyAnswers($subject);  
if(empty($key)){
$key=$_SESSION["keyanswer"];  

}else{
 
}
*/



$answer=array();
$n=1;
$yourmark=0;
$myvalidation=NULL;
for($i=0;$i<60;$i++,$n++){
    
    if(isset($_SESSION["question_no"])){
        $question_no=$_SESSION["question_no"];
        $qno=$question_no[$i];
    }else{
        $qno=$i+1;
    }
    
	$q="q".$n;
        if(isset($_POST[$q])){
          $answer[$i]=$_POST[$q];  
        }else{
         $answer[$i]="NA";    
        }
	
if(isset($key[$i]) && ($answer[$i]==$key[$i])){
	$myvalidation="VALID";
	$yourmark++;
        }else{
            $myvalidation="INVALID";
            }	
//$qno=$i+1;
$insertAnswerQuery="insert into answersheet values('$qno','$answer[$i]','$key[$i]','$myvalidation','$subject','$enroll')";
mysqli_query($link,$insertAnswerQuery);

}
$theory=$yourmark;

if($theory>=21){
	$grade="PASS";
}else{
	$grade="RE-APPEAR";
}


$insertQuery="update report set theory='$theory',grade='$grade' where subject='$subject' and enrollno='$enroll'";
mysqli_query($link,$insertQuery);



#================ pdf Answer sheet ============

        require 'check-function.php'; // for array subject name
        require 'fpdf/fpdf.php';
        $pdf= new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Courier', 'BU', 17);
        $pdf->SetY(25);
        $pdf->SetX(35);
        $pdf->SetTextColor(178, 168, 0);
        $pdf->Cell(140, 0, "CSC COMPUTER EDUCATION PVT.LTD.,",0,0,"C");
        $pdf->SetY(35);
        $pdf->SetX(60);
        $pdf->SetFont('Courier', 'BU', 13);
        $pdf->SetTextColor(153, 51, 255);
        $pdf->Cell(80, 0, "STUDENT ANSWER SHEET",0,0,"C");
        $pdf->Multicell(0, 8, "\n");
        
        
        
        $selectQuery="select student.enrollno,student.name,report.subject,report.dateofexam,report.theory,report.practical,report.total,report.grade from student inner join report on student.enrollno=report.enrollno where report.enrollno='$enroll' and report.subject='$subject' ";
          $result=mysqli_query($link,$selectQuery);
        
        while($myreprow= mysqli_fetch_array($result)){
         
            $fulldate=$myreprow['dateofexam'];
            
         $pdf->SetFont('Courier', 'B', 10);
         $pdf->setFillColor(42, 96, 100);
         $pdf->SetX(40);
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Enroll', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(35, 6,": ".$myreprow['enrollno'], 0, 0, 'L', TRUE); 
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Name', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(55, 6, ": ".$myreprow['name'], 0, 0, 'L', TRUE);
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Multicell(0, 6, "\n");
         $pdf->SetX(40);
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Date', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(35, 6, ": ".$myreprow['dateofexam'], 0, 0, 'L', TRUE);
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Subject', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(55, 6, ": ".$myreprow['subject'], 0, 0, 'L', TRUE); 
         $pdf->Multicell(0, 6, "\n");
         $pdf->SetX(40);
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Theory', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(35, 6, ": ".$myreprow['theory'], 0, 0, 'L', TRUE); 
         
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Total', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(55, 6, ": ".$myreprow['total'], 0, 0, 'L', TRUE); 
         
         $pdf->Multicell(0, 6, "\n");
         $pdf->SetX(40);
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Practical', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(35, 6, ": ".$myreprow['practical'], 0, 0, 'L', TRUE);
         
         $pdf->SetTextColor(0, 255, 247);
         $pdf->Cell(20, 6, ' Grade', 0, 0, 'L', TRUE);
         $pdf->SetTextColor(201, 211, 71);
         $pdf->Cell(55, 6, ": ".$myreprow['grade'], 0, 0, 'L', TRUE);
         
        }
        $pdf->Multicell(0, 6, "\n\n");
        $pdf->SetTextColor(0, 255, 247);
        $pdf->SetFont('Courier', 'B', 10);
        $pdf->SetX(25);
        $pdf->setFillColor(42, 96, 100);
        $pdf->Cell(25, 6, 'Q.No', 1, 0, 'C', TRUE);
        $pdf->Cell(25, 6, 'Answer', 1, 0, 'C', TRUE);
        $pdf->Cell(30, 6, 'Validation', 1, 0, 'C', TRUE);
        $pdf->Cell(25, 6, 'Q.No', 1, 0, 'C', TRUE);
        $pdf->Cell(25, 6, 'Answer', 1, 0, 'C', TRUE);
        $pdf->Cell(30, 6, 'Validation', 1, 0, 'C', TRUE);
        $pdf->Multicell(0, 6, "\n");
        
        $sql = "select qno,answer,validation from answersheet where enrollno='$enroll' and subject='$subject' "; 
$pdfResult = mysqli_query($link, $sql);
$count=1;
function NextLine($pdf){
                            
                            $pdf->SetX(25);
                            $pdf->SetFont('Courier', 'B', 10);
                            $pdf->SetFillColor(226, 255, 254);    
}
NextLine($pdf);
if(mysqli_num_rows($pdfResult)>0){
   

while ($pdfrow = mysqli_fetch_array($pdfResult)) {
                    if($count%2==0){
                                                      
                            $pdf->SetTextColor(29, 28, 47);
                            //$pdf->Cell(25,6, $pdfrow['qno'], 1, 0, 'C', TRUE);
                            $pdf->Cell(25,6, $count, 1, 0, 'C', TRUE);
                            $pdf->SetTextColor(0, 0, 255);
                            $pdf->Cell(25, 6, $pdfrow['answer'], 1, 0, 'C', TRUE);
                           
                            $pdf->SetTextColor(255, 0, 255);
                            $pdf->Cell(30,6, $pdfrow['validation'], 1, 0, 'L', TRUE);
                            $pdf->MultiCell(0, 6, "\n");
                            NextLine($pdf);
                            $count++; 
                    }else{
                           
                            $pdf->SetTextColor(29, 28, 47);
                            $pdf->Cell(25,6, $count, 1, 0, 'C', TRUE);
                            
                            $pdf->SetTextColor(0, 0, 255);
                            $pdf->Cell(25, 6, $pdfrow['answer'], 1, 0, 'C', TRUE);
                           
                            $pdf->SetTextColor(255, 0, 255);
                            $pdf->Cell(30,6, $pdfrow['validation'], 1, 0, 'L', TRUE);
                        
                            $count++;     
                    }
       
}

$mydate=  explode("-", $fulldate);
$month=getMonthName($mydate[1]);
$_SESSION['month']=$month;
//$_SESSION['filename']=$month." - " . $enroll . " - " . $subject . ".pdf";
$filename = "answersheets/".$month." - " . $enroll . " - " . $subject . ".pdf";
$pdf->Output($filename, 'F');





}else{
    ?>
    
        <script>
        alert("There is no data. Answer sheet doesn't create..");
        </script>
        
        
    <?php
}





?>
<script>
window.location="examcompleted.php";
</script>
<?php
}
?>