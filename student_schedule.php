<?php


	require_once('fpdf/fpdf.php');
	
	class studentPDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial','B', 40);
        $this->Cell($this->getPageWidth()-20,45,'Student Schedule',0,0,'C');
        $this->SetLineWidth(2);
        $this->Line(10,40,$this->getPageWidth()-10,40);
		$this->Ln();
		$this->SetFont('Times', '', '20');
		$this->Cell(50,10,'Cynthia Dy',0,0,'C');
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }



	//Academic information
	function academicInfo()
	{
		$this->SetFont('Times','B','12');
		$this->Cell(50,10,'Current Academic Information',0,0,'C');
		$this->Ln();
		$this->SetLineWidth(1);
        $this->Line(10,40,$this->getPageWidth()-10,40);
		$this->Cell(60,10,'Level',1,0,'C');
		$this->Cell(40,10,'Class',1,0,'C');
		$this->Cell(80,10,'Minor',1,0,'C');
		$this->Cell(80,10,'Major',1,0,'C');
		$this->Ln(30);

	}



	//Table header
	function scheduleHeader()
	{
		{
			$this->SetFont('Times','B','14');
			$this->Cell(40,10,'Spring 2021 Schedule',0,0,'C');
			$this->Ln();
			$this->Cell(20,10,'CRN',1,0,'C');
			$this->Cell(30,10,'Course',1,0,'C');
			$this->Cell(40,10,'Title',1,0,'C');
			$this->Cell(40,10,'Time',1,0,'C');
			$this->Cell(15,10,'Days',1,0,'C');
			$this->Cell(30,10,'Dates',1,0,'C');
			$this->Cell(20,10,'Period',1,0,'C');
			$this->Cell(40,10,'Location',1,0,'C');
			$this->Cell(40,10,'Instructor',1,0,'C');
			$this->Ln();
	
		}
	

	}
	

}	
	
	$pdf = new studentPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L', 'A4', 0);
	$pdf->academicInfo();
	$pdf->scheduleHeader();
	$pdf->Output();
?>