<?php
	require_once 'session.php';
	include_once 'controller/StudentDt.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	
	$sdtid		= $_GET['sdtid'];
	
	$dtc		= new DiagnosticTestController();
	$sdt 		= new StudentDtController();
	$sdt_set	= $sdt->getStudentDtByID($sdtid);
	
	$dt_set		= $dtc->getDiagnosticTestByID($sdt_set->getDTID());
	$questions	= explode(',', $dt_set->getQid());
	
	$sa_set		= $sdt->getAnsweredQuestions($sdtid);

	$sanswers		= array();
	
	foreach($sa_set as $sa)
		array_push($sanswers, $sa['qid']);
	
	foreach($questions as $row):
		if(!in_array($row, $sanswers)):
			$sdtavalues = array(
				"student_dt_id" 	=> $sdtid,
				"qid"				=> $row,
				"answer"			=> "None",
				"mark"				=> 0,
			);
			
			$sdt->addStudentAnswer($sdtavalues);
		endif;
	endforeach;
	
	$startdate	= $sdt_set->getStartDate();
	$sdt->finishDiagnosticTest($sdtid, $startdate);
?>