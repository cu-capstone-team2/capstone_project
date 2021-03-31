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
		$this->Ln();
		$this->SetFont('Times', '', '15');
		$this->Cell(60,10,'cyndy@cameron.edu',0,0,'C');
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }



	//Academic header
	function academicInfo()
	{
		$this->SetFont('Times','','12');
		$this->Cell(60,10,'Current Academic Information',0,0,'C');
		$this->Ln();
		
		$this->SetLineWidth(1);
       	$this->Line(10,40,$this->getPageWidth()-10,40);
		$this->Cell(40,10,'Class.',1,0,'C');
		$this->Cell(80,10,'Major',1,0,'C');
		$this->Ln();
		
		$this->Cell(40,10,'Freshman','LR',0, 'L');
		$this->Cell(80,10,'Computer Science','LR',0, 'L');
		$this->Ln();
		$this->Cell(120,0,' ','T');
		$this->Ln(15);
	}


	//Schedule
	function scheduleTable($header, $data)
	{
		//schedule header
		$this->SetFont('Times','','12');
		$this->Cell(40,10,'Spring Schedule 2021',0,0,'C');
		$this->Ln();	
		
		
		//width columns
		$w = array(15,20,55,20,20,35,25);
		//Header
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
		$this->Ln();
		//Data
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,$row[1],'LR');
			$this->Cell($w[2],6,$row[2],'LR',0, 'L');
			$this->Cell($w[3],6,$row[3],'LR',0, 'C');
			$this->Cell($w[4],6,$row[4],'LR',0, 'C');
			$this->Cell($w[5],6,$row[5],'LR',0, 'C');
			$this->Cell($w[6],6,$row[6],'LR',0, 'L');
			

			$this->Ln();
	
		}
		$this->Cell(array_sum($w),0,' ','T');
	

	}
	

}	
	
	$pdf = new studentPDF();
	$pdf->AliasNbPages();
	
	
	$header= array('CRN', 'Course', 'Title', 'Time', 'Days', 'Location', 'Instructor');
	$data= [
		['123', 'CS 4231', 'Operating Systems', '12-1:45', 'MW', 'Howell Hall 204', 'Zhao'],
		['234', 'CS 4112', 'Algorithms Analysis ', '11-12:15', 'TTR', 'Howell Hall 206', 'Monian'],
		['765', 'IT 3603', 'Human Computer Interface', '11-12:15', 'MW', 'Howell Hall 207', 'Johari'],
		['643', 'CS 2154', 'Discrete Math', '9-10:45', 'TTR', 'Howell Hall 209', 'Drissi'],
		['543', 'IT 4342', 'Worksplace Safety', '-','-','Online', 'Hickerson']
	];


	//$pdf->AddPage('L', 'A4', 0);
	$pdf->AddPage();
	$pdf->academicInfo();
	$pdf->scheduleTable($header, $data);
	$pdf->Output();
?>