<?php
	require_once 'session.php';	
	include_once 'header.php';
	include_once 'controller/DtQuestionController.php';
	
	$mid = $_GET['module_id'];
	$dtf = new DtQuestionController();
	
	if(isset($_POST['add-question'])) {
		$question 	= $_POST['question'];
		$choices	= $_POST['choice-a'].":".$_POST['choice-b'].":".$_POST['choice-c'].":".$_POST['choice-d'];
		$answer		= $_POST['answer'];
		$order		= null;
		
		if		($answer == "A") $order = 0;
		else if	($answer == "B") $order = 1;
		else if	($answer == "C") $order = 2;
		else if	($answer == "D") $order = 3;
		
		$values = array(
			"module_id"		=> $mid,
			"question"		=> $question,
			"choices"		=> $choices,
			"answer"		=> $answer,
			"answer_order" 	=> $order,
		);
		
		$dtf->addQuestion($values);
		header("Location: add-dt-question.php?module_id={$mid}&f=1");
	}
?>