<?php
	include_once 'libraries/fpdf.php';
	include_once 'php/pdfmc.class.php';
	include_once 'controller/User.Controller.php';

	$uc 		= new UserController();
	$users 		= $uc->getAllUsers();

	$pdf = new FPDF();
	$pdf->SetAutoPageBreak(true);
	$pdf->AddPage();

	$pdf->SetFont('ARIAL', '', 8);
	$pdf->Cell(0, 3, 'NEXGENREADY SUBSCRIBER ACCOUNT FORM', 0, 1, 'L');
	$pdf->image('images/logo2.png', 150, 5, 50);
	$pdf->Line(10, 15, 200, 15);
	$pdf->Ln(10);

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190, 5, 'USER ACCOUNTS', 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(150, 5, 'The following user accounts have been created for you.', 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->Cell(20, 5, ' ', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Username', 1, 0, 'C');
    $pdf->Cell(100, 5, 'Password', 1, 1, 'C');

    $pdf->SetFont('Arial','',11);
	
	foreach($users as $user) {
		$pdf->Cell(20, 5, ' ', 0, 0, 'C');
		$pdf->Cell(50, 5, $user->getUsername(), 1, 0, 'L');
		$pdf->Cell(100, 5, $user->getPassword(), 1, 1, 'L');
	}
	$pdf->Output('UserAccounts.pdf','I');
?>