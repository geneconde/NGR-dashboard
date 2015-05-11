<?php
require_once 'session.php';
require_once('tcpdf/tcpdf.php');
require_once('tcpdf/tcpdf_import.php');
require_once 'libraries/fpdf.php';
require_once 'php/pdfmc.class.php';
require_once 'controller/Module.Controller.php';
require_once 'controller/ModuleMeta.Controller.php';
require_once 'controller/StudentModule.Controller.php';
require_once 'controller/MetaAnswer.Controller.php';
require_once 'locale.php';

ob_start();

class MYPDF extends TCPDF {

	protected $lang = '';

    public function Header() {
		if($this->lang == "ar_EG") {
	        $image_file = K_PATH_IMAGES.'include/header.png';
	        $this->Image($image_file, 210, 0, 210, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		} else {
	        $image_file = K_PATH_IMAGES.'include/header.png';
	        $this->Image($image_file, 0, 0, 210, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		}

    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 10, _('CONFIDENTIAL'), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function setLanguage($language) 
    {
    	$this->lang = $language;
    }
}


$mid = $_GET['m'];
$userid = $user->getUserid();
$students = $uc->loadUserType(2, $userid);

$mc = new ModuleController();
$m = $mc->loadModule($mid);

$mmc = new ModuleMetaController();
$problem = $mmc->getModuleProblem($mid);

$review = _('REVIEW: ');
$problem_label = _('PROBLEM: ');
$student_answers = _('STUDENT ANSWERS');
$get_module_name = _($m->getModule_name());
$get_problem = _($problem['meta_desc']);

//TCPDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setLanguage($language);
// $lang = new MYPDF($language);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
if($language == "ar_EG") {
	$lg['a_meta_dir'] = 'rtl';
	$lg['a_meta_language'] = 'fa';
} else {
	$lg['a_meta_dir'] = 'ltr';
	$lg['a_meta_language'] = 'en';
}
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
$pdf->SetFont('aealarabiya', 'B', 12);
$pdf->AddPage();
$pdf->WriteHTML($review.$get_module_name, true, 0, true, 0);
$pdf->ln();
$pdf->WriteHTML($problem_label.$get_problem, true, 0, true, 0);
$pdf->ln();
$pdf->WriteHTML($student_answers, true, 0, true, 0);

foreach ($students as $student) {
	$ctr = 0;
	$studentmodules = $smc->loadAllStudentModule($student['user_ID'],$mid);
	
	$pdf->SetFont('aealarabiya', '', 12);
	$pdf->WriteHTML($student['first_name'] . ' ' .$student['last_name'].': ', true, 0, true, 0);
	if ($studentmodules) {
		$sm = $studentmodules[0];
		$lastscreen = $sm['last_screen'];
		if ($lastscreen == 0) {
			$answer = $mac->getProblemAnswer($sm['student_module_ID'],$problem['meta_ID']);
			// $pdf->MultiCell(0,5,$answer);
			$pdf->WriteHTML($answer, true, 0, true, 0);
			$pdf->Ln();
		}
	}
}
ob_end_clean();
$pdf->Output('Student Solutions.pdf','I');
?>