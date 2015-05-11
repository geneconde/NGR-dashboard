<?php
	require_once 'session.php';
	include_once 'php/functions.php';
	
	$studentdtid	= $_POST['sdtid'];
	$qid			= $_POST['qid'];
	$answer			= $_POST['answer'];
	
	$sdt 			= new StudentDtController();
	$sanswer		= $sdt->getTargetAnswer($studentdtid, $qid);
	
	$dtf			= new DtQuestionController();
	$question		= $dtf->getTargetQuestion($qid);
	
	$mark 			= ($question[0]['answer'] == $answer ? 1 : 0 );
	
	if($sanswer) {
		$sdt->updateAnswer($studentdtid, $qid, $answer, $mark);
	} else {
		$sdtavalues = array(
			"sdtid" 	=> $studentdtid,
			"qid"		=> $qid,
			"answer"	=> $answer,
			"mark"		=> $mark,
		);
		$sdt->addStudentAnswer($sdtavalues);
	}
?>