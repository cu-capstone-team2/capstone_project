<?php
	require('fpdf/fpdf.php');
	
	class PDF extends FPDF{
			//Creates header
			function Header(){
				$this->Image('images/design_logo.png', 5, 6, 30);
				$this->Image('images/design_logo.png', 175, 6, 30);
				$this->SetFont('Arial', 'B', 25);
				$this->Cell(80);
				$this->Cell(30,20,'FACULTY SCHEDULE', 0,0, 'C');
				$this->Ln(40);
			}
			
			//Creates footer
			function Footer(){
				$this->SetY(-15);
				$this->SetFont('Arial', 'I', 8);
				$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}
			
			//Creates table
			function CreateTable($header, $data){
				$w = array(40,35,40,45);
				for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C');
				$this->Ln();
				foreach($data as $index=>$row){
					$line = $index == count($w) - 1? 'LRB' : 'LR';
					$this->Cell($w[0],6,$row[0],$line,0);
					$this->Cell($w[1],6,$row[1],$line,0);
					$this->Cell($w[2],6,$row[2],$line,0);
					$this->Cell($w[3],6,$row[3],$line,0);
					$this->Ln();
				}
			}
		
	}
	
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	
	$header = array('Level', 'Class', 'Minor', 'Major');
	$data = [
		['Freshman', 'Yes', 'Math', 'CS'],
		['Sophmore', 'No', 'Art', 'English'],
		['Junior', 'Yes', 'N/A', 'IT'],
		['Senior', 'Yes', 'N/A', 'Biology']
	];
	
	$pdf->AddPage();
	$pdf->SetFont('Times', '', 16);
	$pdf->CreateTable($header, $data);
	$pdf->Output();
?>