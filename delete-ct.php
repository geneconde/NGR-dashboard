<?php
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/StudentCt.Controller.php';
	
	$ctid 	= $_GET['ctid'];
	
	$scc		= new StudentCtController();
	$test_set	= $scc->getStudentCtByTest($ctid);
	
	foreach($test_set as $test):
		$sctid 	= $test['student_ct_id'];
		$scc->deleteCtTest($sctid);
		$scc->deleteCtAnswers($sctid);
	endforeach;
	
	$ctc 	= new CumulativeTestController();
	$ctc->deleteCT($ctid);

	header("Location: ct-settings.php");
?>