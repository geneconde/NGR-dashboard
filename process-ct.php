<?php
	require_once 'session.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/DtQuestion.Controller.php';

	$userid = $user->getUserid();
	$mid 	= $_GET['mid'];
    $selection	= implode(",", $_POST['questions']);

    if($_POST['action'] == "new"):
    	$_SESSION['ct'.$userid.$mid] = $selection;
    	header("Location: create-ct.php");
   	elseif($_POST['action'] == "edit"):
   		$ctid 	= $_GET['ctid'];

   		$dtq 			= new DtQuestionController();
		$question_set 	= $dtq->getDTPool($mid);

		$ctc 	= new CumulativeTestController();
		$ct		= $ctc->getCumulativeTestByID($ctid);
		$qid	= explode(',', $ct->getQid());

   		foreach($question_set as $q):
			if(($key = array_search($q['qid'], $qid)) !== false):
			    unset($qid[$key]);
			endif;
		endforeach;

		$selection = $selection .','. implode(',', $qid);
		$qs = explode(',',$selection);
		shuffle($qs);

		$finalqs = implode(',', $qs);
		
		$ctc->updateCTQuestions($ctid, $finalqs);

   		header("Location: edit-ct.php?f=1&ctid={$ctid}&{$mid}=1");
   	endif;
?>