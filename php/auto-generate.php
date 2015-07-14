<?php
	include_once(dirname(__FILE__)."/../libraries/fpdf.php");
	include_once(dirname(__FILE__)."/pdfmc.class.php");
	include_once(dirname(__FILE__)."/../controller/User.Controller.php");
	include_once(dirname(__FILE__)."/../controller/TeacherModule.Controller.php");
	include_once(dirname(__FILE__)."/../controller/SubscriberHistory.Controller.php");

	function generateUsers($fname, $lname, $school, $numTeacher, $numStudent, $subscription, $sid) {

		$gender	   	= ['M', 'F'];
		// $subType	= ['New Client', 'Old Client'];

		$uc 		= new UserController();
		$tmc 		= new TeacherModuleController();
		$sc 		= new SubscriberController();
		$sch 		= new SubscriberHistoryController();

		$usernames 	= array();
		$name 		= $fname . ' ' . $lname ;
		$year 		= $subscription . ' year';

		// $subUser = generateUsername($usernames, 'T');
		$subUser = time();
		$subPass = generatePassword();
		$subPassE = $uc->hashPassword($subPass);
		$usernameHolder = strtolower($fname) . $subUser;
		$value = array(
				'username' 		=> strtolower($fname) . $subUser,
				'password' 		=> $subPassE,
				'type'	   		=> 3,
				'first_name'	=> $fname,
				'last_name'		=> $lname,
				'gender'		=> $gender[rand(0,1)],
				'teacher_id'	=> 0,
				'subscriber_id' => $sid
			);

		$value2 = array(
				'purchase_id'		=> 1,
				'subscriber_id'		=> $sid,
				'subscriber_option'	=> $year,
				// 'amount_paid'		=> 
				'type'				=> 'New Client'
			);

		$uc->addUser($value);

		// $old = $sch->checkSubscriberType($sid);

		// if($old != 1){
			
			$sch->addSubscriberHistory($value2);
		// }

		$pdf = new FPDF();
		$pdf->SetAutoPageBreak(true);
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(180, 5, 'USER ACCOUNTS', 0, 1, 'C');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(80, 5, 'The following are user accounts registered under:', 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Subscriber name: ', 0, 0, 'L');
		$pdf->Cell(90, 5, $name, 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'School name:', 0, 0, 'L');
		$pdf->Cell(90, 5, $school, 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Total No. of teachers:', 0, 0, 'L');
		$pdf->Cell(90, 5, $numTeacher, 0, 1, 'L');
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'No. of Students per teacher:', 0, 0, 'L');
		$pdf->Cell(90, 5, $numStudent, 0, 1, 'L');
		$pdf->Ln(5);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(80, 5, 'Your Account ' . $i, 0, 0, 'C');
		$pdf->Ln(5);
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Username', 1, 0, 'C');
	    $pdf->Cell(40, 5, 'Password', 1, 1, 'C');
			
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
		$pdf->Cell(40, 5, $usernameHolder, 1, 0, 'L');
		$pdf->Cell(40, 5, $subPass, 1, 1, 'L');
		$pdf->Ln(5);

		for($i = 1; $i <= $numTeacher; $i++) {
			$uname = generateUsername('T', $i);
			$pw = generatePassword();
			$pwE = $uc->hashPassword($pw);

			$pdf->SetFont('Arial', 'B', 8);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(80, 5, 'Teacher ' . $i, 0, 0, 'C');
			$pdf->Ln(5);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(40, 5, 'Username', 1, 0, 'C');
	    	$pdf->Cell(40, 5, 'Password', 1, 1, 'C');
			
			$pdf->SetFont('Arial', '', 8);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(40, 5, $uname, 1, 0, 'L');
			$pdf->Cell(40, 5, $pw, 1, 1, 'L');
			$pdf->Ln(5);

			$teacher = array(
				'username' 		=> $uname,
				'password' 		=> $pwE,
				'type'	   		=> 0,
				"first_name"	=> '',
				"last_name"		=> '',
				'gender'		=> $gender[rand(0,1)],
				'teacher_id'	=> 0,
				'subscriber_id' => $sid,
				'grade_level'	=> 0
			);

			$uc->addUser($teacher);	
			$tuname = $uc->loadUser($teacher['username']);
			$uid   = $tuname->getUserid();

			$tmc->addTeacherModule($uid, 'solar-power');

			$pdf->SetFont('Arial', 'B', 8);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(80, 5, 'Students under Teacher ' . $i, 0, 0, 'C');
			$pdf->Ln(5);
			$pdf->Cell(50, 5, ' ', 0, 0, 'L');
			$pdf->Cell(40, 5, 'Username', 1, 0, 'C');
    		$pdf->Cell(40, 5, 'Password', 1, 1, 'C');

    		// $t = $i - 1;
			for($j = 1; $j <= $numStudent; $j++) {
				$suname = generateStudentUsername("S", $j, $i);
				$spw = generatePassword();
				$spwE = $uc->hashPassword($spw);

	    		$pdf->SetFont('Arial', '', 8);
	    		$pdf->Cell(50, 5, ' ', 0, 0, 'L');
				$pdf->Cell(40, 5, $suname, 1, 0, 'L');
				$pdf->Cell(40, 5, $spw, 1, 1, 'L');

				$student = array(
					"username" 		=> $suname,
					"password" 		=> $spwE,
					"type"	   		=> 2,
					"first_name"	=> '',
					"last_name"		=> '',
					"gender"		=> $gender[rand(0,1)],
					"teacher_id"	=> $uid,
					'subscriber_id' => $sid,
					'grade_level'	=> 1
				);

				$uc->addUser($student);
			}

			$pdf->Ln(5);
		}

		$pdfdoc = $pdf->Output('UserAccounts.pdf','S');
		return $pdfdoc;
	}

	function generateUsername($type, $ctr) {
		// $pre = '';
 	
		// if($type == 'T') $pre = 'teacher';
		// else if($type == 'S') $pre = 'student';

		// $string = $pre . rand(1000,9999);

		// if(in_array($string, $usernames)) return generateUsername($usernames, $type);
		// else return $string;
		$string = $type. time() . $ctr; //updated to get time plus counter - raina 01-30-2015
		return $string;
	}

	function generateStudentUsername($type, $ctr, $ctr2) {
		$alphas		= range('a', 'z');
		$string = $type . time() . $ctr . $ctr2; //updated to get time plus counter - raina 01-30-2015
		return $string;
	}

	function generatePassword() {
		$alphas		= range('a', 'z');
		$numbers	= range(0, 9);
		$characters = array_merge($alphas, $numbers);

		$string = '';

		for($i = 0; $i < 9; $i++) {
			$string .= $characters[rand(0,35)];
		}

		return $string;
	}
?>
