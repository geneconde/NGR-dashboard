<?php
	include_once 'controller/StudentDt.Controller.php';
	
	$dtid		= $_POST['dtid'];
	
	$sdc		= new StudentDtController();
	$test_set	= $sdc->getTestByDTID($dtid);
	
	foreach($test_set as $test):
		$sdtid 	= $test['student_dt_id'];
		
		$sdc->deleteTest($sdtid);
		$sdc->deleteDtAnswers($sdtid);
	endforeach;
?>