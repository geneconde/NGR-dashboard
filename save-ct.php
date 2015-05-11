<?php
	require_once 'controller/StudentCt.Controller.php';
	require_once 'controller/DtQuestion.Controller.php';
	
	$scc	= new StudentCtController();
	$dtq	= new DtQuestionController();
	
	$sctid	= $_GET['sctid'];
	$qid	= $_GET['qid'];
	$index	= $_GET['index'];
	$fin	= $_GET['fin'];
	$type	= $_POST['type'];
	$ans	= $_POST['choice'];
	$choice = '';
	
	echo $type;

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
	
	$sc		= $scc->getStudentCtByID($sctid);
	$ctid	= $sc->getCTID();

	$sa		= $scc->getCTStudentAnswerByQuestion($sctid, $qid);

	if($sa):
		$scc->updateAnswer($sctid, $qid, $choice, $mark);
	else:
		$values = array(
			"student_ct_id"	=> $sctid,
			"qid"			=> $qid,
			"answer"		=> $choice,
			"mark"			=> $mark
		);
		$scc->addStudentAnswer($values);
	endif;
	
	$index++;
	
	if($fin):
		$startdate	= $sc->getStartDate();
		$scc->finishCumulativeTest($sctid, $startdate);
		header("Location: ct-results.php?sctid={$sctid}");
	else: 
		header("Location: ct.php?ctid={$ctid}&i={$index}");
	endif;
?>