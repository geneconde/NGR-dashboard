<?php
	require_once 'session.php';
	require_once 'controller/StudentAnswer.Controller.php';

	$smid = $_SESSION['smid'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];

	$sac = new StudentAnswerController();
	$exists = $sac->getStudentAnswer($smid,$question);
	
	$test	= (!$exists ? "meron" : "wala" );
	
	if (!$exists)
		$sac->addStudentAnswer($smid, $question, $answer);
		
	echo $test;
?>