<?php
	ini_set('display_errors', '1');
	include_once 'controller/Feedback.Controller.php';

	$values = array(
		"exercise_id" => $_POST['exercise-id'],
		"choice"	  => $_POST['choice'],
		"feedback"	  => $_POST['feedback']
	);
	
	$fc	= new FeedbackController();
	$fc->addFeedback($values);
	
	header("Location: feedback.php");
?>