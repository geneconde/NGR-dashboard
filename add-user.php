<?php
	/* Uncomment if adding 2500 accounts.
	include_once "libraries/UserFactory.class.php";
	
	$gender	   	= ["M","F"];
	$letters	= ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
	
	$uf = new UserFactory();
	
	for($i = 1, $x = 100; $i < 51; $i++) {
		$teacher = array(
			"username" 		=> "teacher".$i,
			"password" 		=> $letters[rand(0,25)].$letters[rand(0,25)].$letters[rand(0,25)].$letters[rand(0,25)].rand(1000,9999),
			"type"	   		=> 0,
			"first_name"	=> "teacher".$i,
			"gender"		=> $gender[rand(0,1)],
			"teacher_id"	=> 0
		);
		
		$uf->addUser($teacher);	
		$uname = $uf->loadUser($teacher["username"]);
		$uid   = $uname->getUserid();
		
		for($j = 1; $j < 51; $j++) {
			$student = array(
				"username" 		=> "student".($x+$j),
				"password" 		=> $letters[rand(0,25)].$letters[rand(0,25)].$letters[rand(0,25)].$letters[rand(0,25)].rand(1000,9999),
				"type"	   		=> 2,
				"first_name"	=> "student".($x+$j),
				"gender"		=> $gender[rand(0,1)],
				"teacher_id"	=> $uid
			);
			
			$uf->addUser($student);
		}
		$x+=50;
	}
	*/
?>