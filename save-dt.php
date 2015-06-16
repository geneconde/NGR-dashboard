<?php
	require_once 'controller/StudentDt.Controller.php';
	require_once 'controller/DtQuestion.Controller.php';
	
	$sdt	= new StudentDtController();
	$dtq	= new DtQuestionController();
	
	$sdtid	= $_GET['sdtid'];
	$qid	= $_GET['qid'];
	$index	= $_GET['index'];
	$fin	= $_GET['fin'];
	$type	= $_POST['type'];
	$ans	= $_POST['choice'];
	$choice = '';
	
	if($type == 'radio'):
		$choice	= $ans;
	elseif($type == 'checkbox'):
		foreach($ans as $ch):
			$choice .= $ch;
		endforeach;
	endif;
	
	$qset	= $dtq->getTargetQuestion($qid);
	$answer	= $qset[0]['answer'];
	
	$mark	= ($choice == $answer? 1 : 0);
	
	$sc		= $sdt->getStudentDtByID($sdtid);
	$dtid	= $sc->getDTID();

	$sa		= $sdt->getStudentAnswerByQuestion($sdtid, $qid);
	
	$sdt_set	= $sdt->getStudentDtByID($sdtid);
	
	if($sa):
		$sdt->updateAnswer($sdtid, $qid, $choice, $mark);
	else:
		$values = array(
			"student_dt_id"	=> $sdtid,
			"qid"			=> $qid,
			"answer"		=> $choice,
			"mark"			=> $mark
		);
		$sdt->addStudentAnswer($values);
	endif;
	
	$index++;
	
	if($fin):
		$startdate	= $sdt_set->getStartDate();
		$sdt->finishDiagnosticTest($sdtid, $startdate);
		header("Location: confirm-dt.php?sdtid={$sdtid}&dtid={$dtid}&i={$index}");
	else: 
		header("Location: dt.php?dtid={$dtid}&i={$index}");
	endif;
?>