<?php
	include_once(dirname(__FILE__)."/../libraries/fpdf.php");
	include_once(dirname(__FILE__)."/pdfmc.class.php");
	include_once(dirname(__FILE__)."/../controller/User.Controller.php");
	include_once(dirname(__FILE__)."/../controller/TeacherModule.Controller.php");

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
