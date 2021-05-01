<?php

/*
FPDF is a PHP framework used to generate a PDF of a student schedule
It is class based
*/

// include all files
require_once("includes/all.php");


// get the current student logged in
$student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";
$student = get_student_by_id($student_id);

// if student doesn't exist, change page
if(!$student){
	change_page("index.php");
}

// get current user role
$user = authenticate();

$role = isset($user["role"])? (int)$user["role"] : STUDENT;

// if not any of these roles, then change page
check_user([CHAIR,SECRETARY,INSTRUCTOR,STUDENT]);


// FPDF framework
require_once('fpdf/fpdf.php');

// this PDF class is an extension of FPDF, allows the generation of a PDF file
class studentPDF extends FPDF
{
// Page header
function Header()
{
	global $student;
	$this->Image('images/corner_TL.png', 5, 6, 30);
	$this->Image('images/corner_TR.png', 175, 6, 30);
	$this->SetFont('Arial','B', 35);
	$this->Cell($this->getPageWidth()-20,45,'STUDENT SCHEDULE',0,0,'C');
	$this->SetLineWidth(2);
	$this->Line(10,40,$this->getPageWidth()-10,40);
	$this->Ln();
	$this->SetFont('Times', '', '20');
	$this->Cell(50,10,$student["full_name"],0,0,'C');
	$this->Ln();
	$this->SetFont('Times', '', '15');
	$this->Cell(60,10,$student["student_email"],0,0,'C');
	$this->Ln(20);
}

// Page footer
function Footer()
{
	$this->SetY(-15);
	$this->Image('images/corner_BL.png', 5, $this->getPageHeight()-35, 30);
	$this->Image('images/corner_BR.png', 175, $this->getPageHeight()-35, 30);
	$this->SetFont('Arial','I',8);
	$this->SetTextColor(0);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
}



//Academic header
function academicInfo()
{
	// show basic information about student
	global $student;
	$this->SetFont('Times','B','14');
	$this->Cell(60,10,'Current Academic Information',0,0,'C');
	$this->Ln();
	
	$this->SetFont('Times','',12);
	
	$this->SetLineWidth(1);
	$this->Line(10,40,$this->getPageWidth()-10,40);
	$this->SetFillColor(255,211,89);
	$this->SetTextColor(0,0,0);
	$this->SetDrawColor(247,247,231);
	$this->SetLineWidth(.4);
	$this->Cell(40,7,'Classification',1,0,'C',true);
	$this->Cell(40,7,'Major',1,0,'C',true);
	$this->Cell(40,7,'Credits',1,0,'C',true);
	$this->Ln();
	
	$this->SetDrawColor(255,211,89);
	$this->SetFillColor(255,235,185);
	
	$this->Cell(40,7,$this->get_classification_name($student["classification"]),'LR',0, 'L',true);
	$this->Cell(40,7,$student["major_name"],'LR',0, 'L',true);
	$this->Cell(40,7,get_credits_by_student($student["student_id"]),'LR',0,'L',true);
	$this->Ln();
	$this->Cell(120,0,' ','T');
	$this->Ln(15);
}
	function trim_course_name($name){
		if(strlen($name) >30){
			return substr($name,0,27) . "...";
		}
		return $name;
	}
	function get_classification_name($name){
		$str = strtoupper($name[0]);
		$str .= substr($name,1);
		return $str;
	}
//Schedule
function scheduleTable($header, $data)
{
	// show table of all of the classes the student is enrolled in
	global $student;
	//schedule header
	$this->SetFont('Times','B','14');
	$this->Cell(40,10,'Spring Schedule 2021',0,0,'C');
	$this->Ln();
	
	$this->SetFont('Times','',12);
	
	//colors
	$this->SetFillColor(255,211,89);
	$this->SetTextColor(0,0,0);
	$this->SetDrawColor(247,247,231);
	$this->SetLineWidth(.4);
	
	
	//width columns
	$w = array(15,20,55,20,20,35,25);
	//Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	
	
	
	$this->SetDrawColor(255,211,89);
	$this->SetFillColor(255,235,185);


	$classes = get_classes_by_student($student["student_id"]);

	$this->SetFillColor(255,235,185);
	$this->SetDrawColor(255,211,89);
	foreach($classes as $class){
		$this->SetTextColor(0,0,0);
		$this->Cell($w[0],6,$class["class_id"],1,0,'L',true);
		$this->Cell($w[1],6,$class["course_title"],1,0,'L',true);
		$this->Cell($w[2],6,$this->trim_course_name($class["course_name"]),1,0,'L',true);
		$this->Cell($w[3],6,$class["time"],1,0,'L',true);
		$this->Cell($w[4],6,$class["days"],1,0,'L',true);
		$this->Cell($w[5],6,"HH " . strval($class["room_number"]),1,0,'L',true);
		$this->SetTextColor(180,101,49);
		$this->Cell($w[6],6,$class["instructor_short"],1,0,'L',true);
		$this->Ln();
	}
	
	$this->Cell(array_sum($w),0,' ','T');
}


}	
// create instance of PDF class, and call methods to generate PDF.
$pdf = new studentPDF();
$pdf->AliasNbPages();


$header= array('CRN', 'Course', 'Title', 'Time', 'Days', 'Location', 'Instructor');
$data = [];
$pdf->AddPage();
$pdf->Image('images/logo_10.png', 15, 85, 175, 175);
$pdf->academicInfo();
$pdf->scheduleTable($header, $data);
$pdf->Output();
?>
