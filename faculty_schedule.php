<?php

// connect to the database
require_once("includes/all.php");

// check the faculty member requested, if they don't exist, change page
$faculty_id = isset($_GET["faculty_id"])? $_GET["faculty_id"] : "";
$faculty = get_faculty_by_id($faculty_id);

if(!$faculty){
	change_page("index.php");
}

$user = authenticate();

$role = isset($user["role"])? (int)$user["role"] : STUDENT;

// check if current user is one of these, else change page
check_user([CHAIR,SECRETARY,INSTRUCTOR]);

// FPDF framework
require('fpdf/fpdf.php');

class PDF extends FPDF{
		//Creates header
		function Header(){
			global $faculty;
			$this->Image('images/corner_TL.png', 5, 6, 30);
			$this->Image('images/corner_TR.png', 175, 6, 30);
			$this->SetFont('Arial', 'B', 35);
			$this->Cell(80);
			$this->Cell(30,20,'FACULTY SCHEDULE',0,0, 'C');
			$this->Ln();
			$this->SetLineWidth(2);
			$this->Ln();
			$this->Line(10,40,$this->getPageWidth()-10,40);
			$this->SetFont('Times', '', '20');
			$this->Cell(50,10,$faculty["full_name"],0,0,'C');
			$this->Ln(7);
			$this->SetFont('Times', '', '13');
			$this->Cell(70,10,$faculty["faculty_email"],0,0,'C');
			$this->Ln(20);
		}
		
		//Creates footer
		function Footer(){
				$this->SetY(-15);
				$this->Image('images/corner_BL.png', 5, $this->getPageHeight()-35, 30);
				$this->Image('images/corner_BR.png', 175, $this->getPageHeight()-35, 30);
				$this->SetFont('Arial', 'I', 8);
				$this->SetTextColor(0,0,0);
				$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		
		//Creates current academic info
		function CreateAcademic(){
			global $faculty;
			$this->SetFont('Arial','B',14);
			$this->Cell(15,6, 'Current Academic Info', 0,0);
			$this->Ln(1);
			$this->SetFont('Times','',12);
			$this->Ln();
			$this->SetFillColor(255,211,89);
			$this->SetTextColor(0,0,0);
			$this->SetDrawColor(247,247,231);
			$this->SetLineWidth(.4);
			$this->Cell(35,6,'Faculty Phone',1,0,'C',true);
			$this->Cell(53,6,'Office Location',1,0,'C',true);
			$this->Ln();
			$this->SetFillColor(255,235,185);
			$this->SetDrawColor(255,211,89);
			$this->SetTextColor(0,0,0);
			$this->Cell(35,6,$faculty["faculty_phone"],1,0,'C',true);
			$this->Cell(53,6,$faculty["room"],1,0,'C',true);
			$this->Ln(15);
		}
		
		// used to trim the name
		function trim_course_name($name){
			if(strlen($name) >30){
				return substr($name,0,27) . "...";
			}
			return $name;
		}
		
		//Creates teaching schedule
		function CreateSchedule(){
			global $faculty;
			$this->SetFont('Arial','B',14);
			$this->Cell(15,6, 'Spring Schedule 2021', 0,0);
			$this->Ln(1);
			$this->SetFont('Times','',12);
			$this->Ln();
			$this->SetFillColor(255,211,89);
			$this->SetTextColor(0,0,0);
			$this->SetDrawColor(247,247,231);
			$this->SetLineWidth(.4);
			$this->Cell(15,6,'CRN',1,0,'C',true);
			$this->Cell(20,6,'Course',1,0,'C',true);
			$this->Cell(60,6,'Title',1,0,'C',true);
			$this->Cell(29,6,'Time',1,0,'C',true);
			$this->Cell(18,6,'Days',1,0,'C',true);
			$this->Cell(21,6,'Location',1,0,'C',true);
			$this->Cell(25,6,'Enrolled',1,0,'C',true);
			$this->Ln();

			// query all the classes this instructor teaches before generating table
			$classes = get_classes_by_instructor($faculty["faculty_id"]);

			$this->SetFillColor(255,235,185);
			$this->SetDrawColor(255,211,89);
			foreach($classes as $class){
				$this->SetTextColor(0,0,0);
				$this->Cell(15,6,$class["class_id"],1,0,'L',true);
				$this->Cell(20,6,$class["course_title"],1,0,'L',true);
				$this->Cell(60,6,$this->trim_course_name($class["course_name"]),1,0,'L',true);
				$this->Cell(29,6,$class["time"],1,0,'L',true);
				$this->Cell(18,6,$class["days"],1,0,'L',true);
				$this->Cell(21,6,"HH " . strval($class["room_number"]),1,0,'L',true);
				$this->SetTextColor(180,101,49);
				$this->Cell(25,6,$class["students"],1,0,'L',true);
				$this->Ln();
			}
	}
		
		
		//Creates table
		function CreateTable($header, $data){
			$w = array(40,35,40,45);
			for($i=0;$i<count($header);$i++){
					$this->SetFont('Times','',11);
					$this->SetTextColor(51,136,153);
					$this->SetDrawColor(255,255,255);
					$this->SetFillColor(247,247,231);
					$this->Cell($w[$i],7,$header[$i],1,0,'C');
			}
			$this->Ln();
			$this->SetFillColor(247,247,231);
			$this->SetDrawColor(204,204,153);
			foreach($data as $index=>$row){
				$this->SetTextColor(0,0,0);
				//$line = $index == count($w) - 1? 'LRB' : 'LR';
				$this->Cell($w[0],6,$row[0],1,0);
				$this->Cell($w[1],6,$row[1],1,0);
				$this->Cell($w[2],6,$row[2],1,0);
				$this->SetTextColor(180,101,49);
				$this->Cell($w[3],6,$row[3],1,0);
				$this->Ln();
			}
		}
	
}

// instance of pdf page, and call methods to generate PDF
$pdf = new PDF();
$pdf->AliasNbPages();

$header = array('Level', 'Class', 'Minor', 'Major');

$pdf->AddPage();
$pdf->Image('images/logo_10.png', 15, 85, 175, 175);
$pdf->SetFont('Times', '', 16);
$pdf->CreateAcademic();
$pdf->CreateSchedule();
$pdf->Output();
?>