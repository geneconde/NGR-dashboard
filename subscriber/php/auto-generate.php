<?php
	include_once '../controller/User.Controller.php';

	function generateTeachers($numTeacher, $sid) {

		$gender	   	= ['M', 'F'];

		$uc 		= new UserController();

		for($i = 1; $i <= $numTeacher; $i++) {
			$uname = generateUsername('T', $i);
			$pw = generatePassword();

			$teacher = array(
				'username' 		=> $uname,
				'password' 		=> $pw,
				'type'	   		=> 0,
				'first_name'	=> '',
				'last_name'		=> '',
				'gender'		=> $gender[rand(0,1)],
				'teacher_id'	=> '',
				'subscriber_id' => $sid,
				'grade_level'	=> 0
			);

			$uc->addUser($teacher);	
		}
	}

	function generateStudents($numStudent, $sid) {

		$gender	   	= ['M', 'F'];

		$uc 		= new UserController();

		// $t = $i - 1;
		for($j = 1; $j <= $numStudent; $j++) {
			$suname = generateUsername($usernames, 'S');
			$spw = generatePassword();

			$student = array(
				"username" 		=> $suname,
				"password" 		=> $spw,
				"type"	   		=> 2,
				"first_name"	=> $suname,
				"last_name"		=> $suname,
				"gender"		=> $gender[rand(0,1)],
				"teacher_id"	=> 0,
				'subscriber_id' => $sid,
				'grade_level'	=> 1
			);

			$uc->addUser($student);
		}

	}

	function generateTeacherStudents($numStudent, $sid, $tid) {

		$gender	   	= ['M', 'F'];

		$uc 		= new UserController();

		// $t = $i - 1;
		for($j = 1; $j <= $numStudent; $j++) {
			$suname = generateUsername($usernames, 'S');
			$spw = generatePassword();

			$student = array(
				"username" 		=> $suname,
				"password" 		=> $spw,
				"type"	   		=> 2,
				"first_name"	=> $suname,
				"last_name"		=> $suname,
				"gender"		=> $gender[rand(0,1)],
				"teacher_id"	=> $tid,
				'subscriber_id' => $sid,
				'grade_level'	=> 1
			);

			$uc->addUser($student);
		}

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
