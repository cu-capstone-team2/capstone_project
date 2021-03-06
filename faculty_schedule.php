<?php
	require('fpdf/fpdf.php');
	
	$pdf = new FPDF('P');
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->Cell(40,10, 'This is the faculty schedule!');
	$pdf->Output();
?>