<?php


	require_once('fpdf/fpdf.php');
	
	$pdf = new FPDF('P');
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->Cell(40,10, 'This is the students schedule!');
	$pdf->Output();
?>