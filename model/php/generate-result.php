<?php
	ini_set('display_errors', '1');
	
	require_once '../session.php';	
	require_once '../controller/StudentModule.Controller.php';
	require_once '../controller/Module.Controller.php';
	require_once '../controller/Exercise.Controller.php';
	require_once '../controller/StudentAnswer.Controller.php';
	require_once '../controller/Question.Controller.php';
	require_once '../controller/ModuleMeta.Controller.php';
	require_once '../controller/MetaAnswer.Controller.php';
	require_once '../controller/Feedback.Controller.php';

	include_once(dirname(__FILE__)."/../libraries/fpdf.php");
	include_once(dirname(__FILE__)."/pdfmc.class.php");
	include_once(dirname(__FILE__)."/fpdf-add-ons.php");

		$sid 	= $_SESSION['stud_id'];
		$mid 	= $_SESSION['mod_id'];
		$score 	= $_SESSION['score'];
	
		$smc 	= new StudentModuleController();
		$mc 	= new ModuleController();
		$ec 	= new ExerciseController();
		$sac 	= new StudentAnswerController();
		$qnc 	= new QuestionController();
		$mmc 	= new ModuleMetaController();
		$mac 	= new MetaAnswerController();
		$fbc	= new FeedbackController();
		$user = null;
	
	$uc = new UserController();
	if(isset($_SESSION['uname'])){
		$user = $uc->loadUser($_SESSION['uname']);
	}
	
	$name = $user->getFirstname();
	

		
		$sm 	= $smc->loadSMbyUserID($sid, $mid);
		$m 		= $mc->loadModule($mid);
		$u 		= $uc->loadUserByID($sid);
		$qc 	= $ec->loadExercisesByType($mid,0);
		$qq 	= $ec->loadExercisesByType($mid,1);
		$totalcorrect = 0;
		$total = 0;

		$letters = range('A', 'Z');

		if($_SESSION["lang"] == 'en_US') $curlang = "english";
		else if($_SESSION["lang"] == "ar_EG") $curlang = "arabic";
		else if($_SESSION["lang"] == "es_ES") $curlang = "spanish";
		else if($_SESSION["lang"] == "zh_CN") $curlang = "chinese";

		// class PDFF extends FPDF {
		// 	function Header() {
		// 		$this->SetFont('ARIAL', '', 8);
		// 		$this->Cell(0, 3, 'STUDENTS MODULE RESULTS', 0, 1, 'L');
		// 		$this->image(dirname(__FILE__).'/../images/logo2.png', 150, 5, 50);
		// 		$this->Line(10, 15, 200, 15);
		// 		$this->Ln(5);
		// 	}		
		// }

		$pdf = new PDF();
		$pdf->SetAutoPageBreak(true);
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(180, 5, 'STUDENT PORTFOLIO', 0, 1, 'C');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Student Name: ', 0, 0, 'L');
		$pdf->Cell(90, 5, $u->getFirstname(). ' ' .$u->getLastname(), 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Module:', 0, 0, 'L');
		$pdf->Cell(90, 5, $m->getModule_name(), 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Date Started:', 0, 0, 'L');
		$pdf->Cell(90, 5, date('F j, Y H:i:s',strtotime($sm['date_started'])), 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Date Finished:', 0, 0, 'L');
		$pdf->Cell(90, 5, date('F j, Y H:i:s',strtotime($sm['date_finished'])), 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Score Percentage:', 0, 0, 'L');
		$pdf->Cell(90, 5, $score.'%', 0, 1, 'L');
		$pdf->Ln(5);

		// Start of Quick Check Results
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(180, 5, 'Quick Check Results', 0, 1, 'C');

		foreach ($qc as $exercise) {
			$eq = $qnc->loadQuestions($exercise['exercise_ID']);
			$sections = $qnc->getExerciseSections($exercise['exercise_ID']);
			$arr = explode('/', $exercise['screenshot']);
			array_splice($arr, 5, 0, $curlang );
			$ex_screenshot = implode("/", $arr);

			$pdf->image('http://corescienceready.com/dashboard/'.$ex_screenshot, 40, $pdf->GetY(), 120, 91);
			$pdf->SetFont('Arial', 'B', 8);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Ln(95);
					
			$html='<table border="1">
					<tr>
						<table><td width="300" bgcolor="#FFE4C4">&nbsp;</td><td width="200" bgcolor="#FFE4C4">'. $exercise['title'] .'</td><td width="250" bgcolor="#FFE4C4">&nbsp;</td></table>
					</tr>
					<tr>
						<td width="250" bgcolor="#FFE4C4">Activity Code</td>
						<td width="175" bgcolor="#FFE4C4">Student Answer</td>
						<td width="175" bgcolor="#FFE4C4">Correct Answer</td>
						<td width="150" bgcolor="#FFE4C4">Result</td>
					</tr>
					</table>';
			$pdf->WriteHTML($html);
			$pdf->Ln(1);

			$answer = '';
			$answers = array();
				foreach ($eq as $question) {
					$total++;
					$answer = $sac->getStudentAnswer($sm['student_module_ID'],$question['question_ID']);
					$img = 'wrong';

					for($i = 0; $i < count($sections); $i++) {
						if($question['section'] == ($i + 1)) {
							if(!isset($answers[$i])) {
								$answers[$i] = $answer;
							} else {
								$answers[$i] = $answers[$i] . ',' . $answer;
							}
						}
					}

					if ($answer == $question['correct_answer']) {
						$img = 'correct';
					}
					$html2='<table border="0">
						<tr>
							<td width="250" bgcolor="#e2e2e2">' . $exercise['shortcode'] . ' - ' . 'Question ' . $letters[$question['section'] - 1] . '</td>
							<td width="175" bgcolor="#e2e2e2">' . $answer . '</td>
							<td width="175" bgcolor="#e2e2e2">' . $question['correct_answer'] . '</td>
							<td width="150" bgcolor="#e2e2e2">' . $img . '</td>
						</tr>
					</table>';

				$pdf->WriteHTML($html2);
				$pdf->Ln(1);	
				}
				$pdf->Ln(10);

				$html3 = '<table border="0">
					<tr>
						<td width="250" bgcolor="#FFE4C4">Activity Code</td>
						<td width="500" bgcolor="#FFE4C4">Feedback</td>
					</tr>
				</table>';

				$pdf->WriteHTML($html3);
				$pdf->Ln(-7);
			
				for($i = 1; $i <= count($sections); $i++) {
					$feedback = $fbc->getFeedback($exercise['exercise_ID'], $i, $answers[$i-1]);

					if(!$feedback) {
						$feedback = $fbc->getFeedback($exercise['exercise_ID'], $i, 'X');
					}

					$html4 = '<table border="0">
						<tr>
							<td width="250" bgcolor="#e2e2e2">' . $exercise['shortcode'] . ' - ' . 'Question' . $letters[$i - 1] . '</td>
							
						</tr>
					</table>';
					$html5 = '<table border="0">
						<tr>
							<td width="500" bgcolor="#e2e2e2">' . $feedback[0] . '</td>
						</tr>
					</table>';

					$pdf->Ln(8);
					$pdf->WriteHTML($html4);
					$pdf->Ln(-6);
					$pdf->SetX(72);
					$pdf->WriteMultiHTML($html5);
					$pdf->Ln(-12);
				}		
			$pdf->addPage();
		}
		//End of Quick Check Results

		//Start of Quiz Question Results
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(180, 5, 'Quiz Question Results', 0, 1, 'C');

		foreach ($qq as $exercise) {
			$eq = $qnc->loadQuestions($exercise['exercise_ID']);
			$sections = $qnc->getExerciseSections($exercise['exercise_ID']);
			$arr = explode('/', $exercise['screenshot']);
			array_splice($arr, 5, 0, $curlang );
			$ex_screenshot = implode("/", $arr);

			$pdf->image('http://corescienceready.com/dashboard/'.$ex_screenshot, 40, $pdf->GetY(), 120, 91);
			$pdf->SetFont('Arial', 'B', 8);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Ln(95);

			$quizhtml='<table border="1">
					<tr>

						<table><td width="300" bgcolor="#FFE4C4">&nbsp;</td><td width="200" bgcolor="#FFE4C4">'. $exercise['title'] .'</td><td width="250" bgcolor="#FFE4C4">&nbsp;</td></table>
					</tr>
					<tr>
						<td width="250" bgcolor="#FFE4C4">Activity Code</td>
						<td width="175" bgcolor="#FFE4C4">Student Answer</td>
						<td width="175" bgcolor="#FFE4C4">Correct Answer</td>
						<td width="150" bgcolor="#FFE4C4">Result</td>
					</tr>
					</table>';
			$pdf->WriteHTML($quizhtml);
			$pdf->Ln(1);

			$answer = '';
			$answers = array();

			foreach ($eq as $question) {
				$total++;
				$answer = $sac->getStudentAnswer($sm['student_module_ID'],$question['question_ID']);
				$img = 'wrong';

				for($i = 0; $i < count($sections); $i++) {
					if($question['section'] == ($i + 1)) {
						if(!isset($answers[$i])) {
							$answers[$i] = $answer;
						} else {
							$answers[$i] = $answers[$i] . ',' . $answer;
						}
					}
				}

				if ($answer == $question['correct_answer']) {
					$img = 'correct';
				}

				$html2='<table border="0">
						<tr>
							<td width="250" bgcolor="#e2e2e2">' . $exercise['shortcode'] . ' - ' . 'Question ' . $letters[$question['section'] - 1] . '</td>
							<td width="175" bgcolor="#e2e2e2">' . $answer . '</td>
							<td width="175" bgcolor="#e2e2e2">' . $question['correct_answer'] . '</td>
							<td width="150" bgcolor="#e2e2e2">' . $img . '</td>
						</tr>
					</table>';

				$pdf->WriteHTML($html2);
				$pdf->Ln(1);
			}		
			$pdf->Ln(5);
			$html3 = '<table border="0">
				<tr>
					<td width="250" bgcolor="#FFE4C4">Activity Code</td>
					<td width="500" bgcolor="#FFE4C4">Feedback</td>
				</tr>
			</table>';

			$pdf->WriteHTML($html3);
			
			for($i = 1; $i <= count($sections); $i++) {
				$feedback = $fbc->getFeedback($exercise['exercise_ID'], $i, $answers[$i-1]);

				if(!$feedback) {
					$feedback = $fbc->getFeedback($exercise['exercise_ID'], $i, 'X');
				}

				$html4 = '<table border="0">
					<tr>
						<td width="250" bgcolor="#e2e2e2">' . $exercise['shortcode'] . ' - ' . 'Question' . $letters[$i - 1] . '</td>
					</tr>
				</table>';
				$html5 = '<table border="0">
					<tr>
						<td width="500" bgcolor="#e2e2e2">' . $feedback[0] . '</td>
					</tr>
					</table>';
				$pdf->Ln(1);
				$pdf->WriteHTML($html4);
				$pdf->Ln(-6);
				$pdf->SetX(72);
				$pdf->WriteMultiHTML($html5);
			}
						
			$pdf->addPage();
		}	
		//End of Quiz Question Results

		//Problem Solving
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(180, 5, 'Problem Solving', 0, 1, 'C');

		 $problem = $mmc->getModuleProblem($sm['module_ID']);
		 $answer = $mac->getProblemAnswer($sm['student_module_ID'],$problem['meta_ID']);

		$html6 = '<table border="0">
			<tr>
				<td width="100" bgcolor="#ffffff">Problem:</td> 
				<td width="750" bgcolor="#ffffff">' . $problem['meta_desc'] . '</td>
			</tr>
			<tr>
				<td width="100" bgcolor="#ffffff">Solution:</td> 
				<td width="750" bgcolor="#ffffff">' . $answer . '</td>
			</tr>
		</table>';

		$pdf->WriteMultiHTML($html6);

		// $filename="/home4/corescie/public_html/dashboard/test.pdf";
		// $pdf->Output($filename, 'F');
		$pdf->Output('example1.pdf','I');
?>
